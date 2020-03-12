<?php
namespace Transactions\Service;

use Zend\Http\Client;
use Transactions\Entity\Transaction;
use Zend\Session\Container;
use Transactions\Entity\RaveCardToken;
use Transactions\Entity\BrokerTransfer;
use Transactions\Entity\BrokerTransferDetails;
use Transactions\Entity\NoBrokerAccount;
use GeneralServicer\Service\GeneralService;
use GeneralServicer\Service\TriggerService;

/**
 *
 * @author otaba
 *        
 */
class RaveCardPaymentService extends RavePaymentGeneralSettings implements RaveCardPaymentInterface
{

    private $entityManager;

    private $ravePaymentSession;

    private $clientGeneralService;

    private $customerBoardService;

    private $ravePaymentGeneralSetting;

    private $transactionService;

    private $mailService;

    /**
     *
     * @var GeneralService
     */
    private $generalService;

    /**
     * Begin CArd Details
     *
     * @var string
     */
    private $cardNo;

    private $cardCvv;

    private $cardMonth;

    private $cardYear;

    private $cardPin;

    private $currency;

    private $amount;

    private $country;

    private $email;

    private $phoneNumber;

    private $firstName;

    private $lastName;

    private $ip;

    private $txRef;

    private $otp;

    private $redirect_url;

    // Card Billing information
    private $billingzip;

    private $billingcity;

    private $billingaddress;

    private $billingstate;

    private $billingcountry;

    // Transfer data
    private $transferBank;

    private $transferAcc;

    private $transferAmount;

    private $transferCurrency;

    private $transferNarration;

    // Preauth DAta
    private $embededToken;

    /**
     */
    public function __construct()
    {}

    /**
     * (non-PHPdoc)
     *
     * @see \Transactions\Service\RaveCardPaymentInterface::validateCardPayment()
     *
     */
    public function validateCardPayment()
    {}

    /**
     * This generate the amount to be trasfered to the broker after eery transaction
     *
     * @param string|float $amount
     * @return number
     */
    private function brokerTransaferAmount($amount)
    {
        // $brokersFee = "";
        $imappCharge = $amount * TransactionService::IMAPP_COMMISION;
        $transferFee = TransactionService::IMAPP_TRANSFER_FEE;
        $totalDeduction = $imappCharge + $transferFee;
        $brokersFee = $amount - $totalDeduction;
        return $brokersFee;
    }
    
    /**
     * This reurns the amount to be credited to the brokers wallet after every transaction 
     * The result is a deduction of IMAPP service charge 
     * @param float $amount
     * @return float
     */
    private function brokerCreditedAmount($amount):float
    {
        $imappCharge = $amount * TransactionService::IMAPP_COMMISION;
        $creditedFee = $amount - $imappCharge;
        return floatval($creditedFee);
    }

    /**
     * Saves a card in our database
     *
     * @return boolean|mixed
     */
    public function saveCard()
    {
        $em = $this->entityManager;
        $clientGeneralService = $this->clientGeneralService;
        $ravePaymentSession = $this->ravePaymentSession;
        $userEntity = $em->find("CsnUser\Entity\User", $clientGeneralService->getUserId());
        $ravecardTokenEntity = new RaveCardToken();
        $ravecardTokenEntity->setCardExpiryMonth($ravePaymentSession->cardExpiryMonth)
            ->setCardExpiryYear($ravePaymentSession->cardExpiryYear)
            ->setCreatedOn(new \DateTime())
            ->setCustomerPhone($ravePaymentSession->phoneNumber)
            ->setEmbededToken($ravePaymentSession->embedtoken)
            ->setLast4Digit($ravePaymentSession->last4Digit)
            ->setShortcode($ravePaymentSession->shortcode)
            ->setUser($userEntity);

        try {
            $em->persist($ravecardTokenEntity);
            $em->flush();
            return TRUE;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function resendOtp()
    {}

    public static function generateTransferCode()
    {
        $const = "trs";
        $code = \uniqid($const);
        return $code;
    }

    /**
     * This function initiate transfer to broker
     * Stores the status into a database
     */
    public function initiateBrokerTransfer($amount = 0)
    {
        $em = $this->entityManager;
        // $ravePaymentSession = $this->ravePaymentSession;
        $clientGeneralService = $this->clientGeneralService;
        $brokerId = $clientGeneralService->getBrokerId();
        $client = new Client();
        $client->setUri(RavePaymentGeneralSettings::RAVE_LIVE_URL . "v2/gpx/transfers/create");
        $client->setMethod("POST");
        $client->setHeaders(array(
            'Content-Type' => 'application/json'
        ));
        if (isset($this->amount)) {
            $amount = $this->amount;
        }
        if ($amount == 0) {
            throw new \Exception("Amount cannot be 0");
        } else {
            $reference = RaveCardPaymentService::generateTransferCode();
            $this->brokerTransaferAmount();
            $transferAmount = $amount;
            $url = $this->generalService->getUrlViewHelper();
            $post = array(
                "account_bank" => $this->transferBank,
                "account_number" => $this->transferAcc,
                "amount" => $transferAmount,
                "seckey" => RavePaymentGeneralSettings::RAVE_SECRET_KEY,
                "narration" => $this->transferNarration,
                "currency" => $this->transferCurrency,
                "reference" => $reference,
                "callback_url" => $url("webhook/default", array(
                    "controller" => "Initiatebrokertransfer"
                ), array(
                    'force_canonical' => true
                ))
            );
            $client->setRawBody(json_encode($post));

            $response = $client->send();
            if ($response->isSuccess()) {
                $body = json_decode($response->getBody());

                if ($brokerId != NULL) {
                    $brokerTrasnferEntity = new BrokerTransfer();
                    $brokerTrasnferEntity->setBroker($em->find("Users\Entity\InsuranceBrokerRegistered", $brokerId))
                        ->setTransferReference($reference)
                        ->setStatus($em->find("Transactions\Entity\BrokerTransferStatus", TransactionService::BROKER_TRANSFER_STATUS_INITIATED));

                    $em->persist($brokerTrasnferEntity);
                    $transferDetails = new BrokerTransferDetails();
                    $transferDetails->setAccName($body->data->fullname)
                    ->setAccNumber($body->data->account_number)
                    ->setBrokerTransfer($brokerTrasnferEntity)
                    ->setDateEntered($body->data->date_created)
                    ->setIsApproved($body->data->is_approved)
                    ->setResponseId($body->data->id)
                    ->setResponseStatus($body->data->status);
                    
                    $em->persist($transferDetails);
                    $em->flush();
                }
               

                // Send a mail notification to broker
                // $mailService = $this->mailService;
                $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $brokerId);
                $messagePonters = array(
                    "to" => $brokerEntity->getUser()->getEmail(),
                    "fromName" => "IMAPP CM",
                    "subject" => "Transfer Initiated " . GeneralService::CM_PRODUCT_NAME
                );
                // Get the amount being transfered to broker
                // Deduct trnasfer fee from the amount
                // deduct IMAPP own commision

                $message = "Amount Initiated :" . $transferAmount . "<br>Transfer Charge : " . TransactionService::IMAPP_TRANSFER_FEE . "<br> Transaction Id :" . $ravePaymentSession->transactionId . " <br> Transafer Id :" . $brokerTrasnferEntity->getTransferReference() . "<br>";
                $template = array();
                $template['template'] = "general-customer-default-mail";
                $template['var'] = array(
                    "logo" => $clientGeneralService->getGeneralService()->getImappLogo(),
                    "title" => "Transfer Initiated",
                    "message" => $message,
                    "broker" => $brokerEntity->getBrokerName()
                );

                // send SMS notification to broker email

                $this->generalService->sendMails($messagePonters, $template);
                $this->getEventManager()->trigger(TriggerService::TRIGGER_BROKER_TRANSFER_INITIATED, $this, array(
                    "amount" => $transferAmount,
                    "transfer"=>$brokerTrasnferEntity->getId(),
                    "user" => $brokerEntity->getUser()
                        ->getId()
                ));
            }
        }
    }

    /**
     * This function hydtartes database to show that the transaction could not be verified
     * Or the transaction was not successful
     */
    private function errorflushTransaction()
    {}

    /**
     * This function provides a flush
     * and creates a post transaction logic
     * Provided the transaction was successful
     *
     * @throws \Exception
     */
    private function flushTransaction()
    {
        $em = $this->entityManager;
        $ravePaymentSession = $this->ravePaymentSession;
        $transactionEntity = new Transaction();
        $clientGeneralService = $this->clientGeneralService;

        $generalSession = $this->clientGeneralService->getGeneralSession();
        $invoiceId = $generalSession->InvoiceId;
        if ($invoiceId == NULL) {
            throw new \Exception("No Invoice could be located for this payment");
        }
        $isMicroPayment = NULL;
        $invoiceEntity = $em->find("Transactions\Entity\Invoice", $invoiceId);
        $transactionNumber = $this->transactionService->generateTransactionUid();
        // Store the transaction into a database ;
        $transactionEntity->setCreatedOn(new \DateTime())
            ->setInvoice($invoiceEntity)
            ->setPaymentDate(new \DateTime())
            ->setPaymentMode($em->find("Settings\Entity\PaymentMode", TransactionService::TRANSACTION_PAYMENT_MODE_FLUTTERWAVE))
            ->setTransactStatus($em->find("Transactions\Entity\TransactionStatus", TransactionService::TRANSACTION_STATUS_SUCCESS))
            ->setTransactUid($transactionNumber);
        $em->persist($transactionEntity); // persist transation

        // Change the status of the invoice to either paying for micro or paid for non micro payment

        $ravePaymentSession->transactionId = $transactionNumber;

        if ($invoiceEntity->getIsMicro()) {
            $isMicroPayment = TRUE;
            $invoiceEntity->setStatus($em->find("Transactions\Entity\InvoiceStatus", InvoiceService::INVOICE_PAYING_STATUS));
            // Get the actual micro payment
            $micropaymentActiveSession = new Container("micropayment_active_session");
            $microPaymentEntity = $em->find("Transactions\Entity\MicroPayment", $micropaymentActiveSession->id);
            $microPaymentEntity->setStatus($em->find("Transactions\Entity\TransactionStatus", TransactionService::TRANSACTION_STATUS_SUCCESS));
            $microPaymentEntity->setUpdatedOn(new \DateTime());

            $em->persist($microPaymentEntity); // persist MIcroPayment
            $em->persist($invoiceEntity); // persist Invoice
        } else {
            $invoiceEntity->setStatus($em->find("Transactions\Entity\InvoiceStatus", InvoiceService::INVOICE_PAID_STATUS));
            $em->persist($invoiceEntity); // persist alternate invoice
        }
        $em->flush();

        // Notify Cutomer of payment via mail
        if ($clientGeneralService->getCustomerId() != NULL) {
            if ($transactionEntity->getPaymentMode()->getId() == TransactionService::TRANSACTION_PAYMENT_MODE_FLUTTERWAVE) {
                $paymentMode = "Card Payment";
            }
            $customerEntity = $em->find("Customer\Entity\Customer", $clientGeneralService->getCustomerId());
            $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $clientGeneralService->getBrokerId());
            $customerUserEntity = $customerEntity->getUser();
            $serviceDescription = "Being Service for " . $invoiceEntity->getCoverNote()
                ->getCoverCategory()
                ->getCategory() . " Acquisitiion";
            // $childBroker = $customerEntity->getAssignedChildBroker();
            // $childBrokerEmail = array();
            // if (count($childBroker) > 0) {
            // foreach ($childBroker as $child) {
            // $childBrokerEmail[] = $child->getUser()->getEmail();
            // }
            // }
            // Send email message to customer
            $messagePonters = array(
                "to" => $customerUserEntity->getEmail(),
                "fromName" => $brokerEntity->getBrokerName(),
                "subject" => "Transaction"
                // "replyTo" => $brokerEntity->getUser()->getEmail(),
                // "addReplyTo" => $childBrokerEmail,
                // "addCc" => $childBrokerEmail
            );
            $template = array();
            $template['template'] = "general-customer-transaction";
            $template['var'] = array(
                "customerName" => $customerEntity->getName(),
                "orderDate" => $transactionEntity->getPaymentDate(),
                "orderId" => $transactionEntity->getTransactUid(),
                "paymentMode" => $paymentMode,
                "serviceDescription" => $serviceDescription,
                "paymentType" => ($isMicroPayment == TRUE ? "Installmenstal Payment" : "Direct Payment"),
                "amount" => $ravePaymentSession->chargedamount,
                "currency" => "NGN",
                "isMicroPayment" => $isMicroPayment,
                // "microPaymentTable"=>$microPaymentTable,
                "brokerName" => $brokerEntity->getBrokerName()
            );

            $clientGeneralService->sendMails($messagePonters, $template);

            // End sent to customer mail
        }

        // if ($clientGeneralService->getBrokerId() != NULL) {
        // $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $clientGeneralService->getBrokerId());
        // // Initiate Transfer
        // $this->initiateBrokerTransfer();
        // }
    }

    /**
     * (non-PHPdoc)
     * This function verifies the payment of the card payment
     *
     *
     * There is a posiblity the
     *
     * @see \Transactions\Service\RaveCardPaymentInterface::ComfirmCardPayment()
     *
     */
    public function confirmCardPayment()
    {
        $ravePaymentSession = $this->ravePaymentSession;
        $generalService = $this->generalService;
        $userId = $generalService->getUserId();
        $this->getEventManager()->trigger(TriggerService::TRIGGER_CUSTOMER_AVAILABLE_BALANCE_VERIFIED, $this, array(
            "bookbalalnce" => $this->brokerCreditedAmount($ravePaymentSession->amount),
            "user"=>$userId
        ));
        $generalSession = $this->clientGeneralService->getGeneralSession();
        $invoiceId = $generalSession->InvoiceId;
        if ($invoiceId == NULL) {
            throw new \Exception("No Invoice could be located for this payment");
        }

        if ($ravePaymentSession->responseCode == "00" && $ravePaymentSession->chargeResponseCode == "00") {
            $client = new Client();
            $client->setUri(RavePaymentGeneralSettings::RAVE_LIVE_URL . "flwv3-pug/getpaidx/api/v2/verify");
            $client->setMethod("POST");
            $client->setHeaders(array(
                'Content-Type' => 'application/json'
            ));
            $post = array(
                "txref" => $ravePaymentSession->txRef,
                "SECKEY" => RavePaymentGeneralSettings::RAVE_SECRET_KEY
            );

            $client->setRawBody(json_encode($post));
            $response = $client->send();
            if ($response->isSuccess()) {
                $body = json_decode($response->getBody());
                if ($body->data->chargecode == "00") {
                    $ravePaymentSession->embedtoken = $body->data->card->card_tokens[0]->embedtoken;
                    $ravePaymentSession->cardExpiryMonth = $body->data->card->expirymonth;
                    $ravePaymentSession->cardExpiryYear = $body->data->card->expiryyear;
                    $ravePaymentSession->shortcode = $body->data->card->card_tokens[0]->shortcode;
                    $ravePaymentSession->last4Digit = $body->data->card->last4digits;
                    $ravePaymentSession->customerPhone = $body->data->custphone;
                    $ravePaymentSession->chargedamount = $body->data->chargedamount;
                    if ($body->data->chargedamount >= $ravePaymentSession->amount) {
                        
                        $this->getEventManager()->trigger(TriggerService::TRIGGER_CUSTOMER_AVAILABLE_BALANCE_VERIFIED, $this, array(
                            "balance" => $this->brokerCreditedAmount($body->data->chargedamount),
                            "user"=>$userId
                        ));
                        $this->flushTransaction(); // flushes transaction and invoice entity
                        return TRUE; // meaning the charged amount >= the sent amount
                    } else {
                        $triggerParam = array(
                            "type"=>"Charged Amount Error",
                            "desc"=>"The charged amount is lower than the required amount "
                        );
                        $this->getEventManager()->trigger(TriggerService::TRIGGER_CUSTOMER_CARD_VERIFICATION_ERROR, $this, $triggerParam);
                        return FALSE; // meaning the  transaction was faulty at this point the value deducted is smaller than the 
                    }
                } elseif ($body->data->chargecode == "02") {
                    // this means requires some validation of some sort
                    return "VALD"; // requires validation
                } else {
                    return FALSE; // meaning there was something wrong with the verification
                }
            } else {
                throw new \Exception("The verification process had some challenges");
            }
        }
    }

    /**
     * This function validates the otp and returns a transaction entity if true
     *
     * @throws \Exception
     * @return boolean
     */
    public function otpValidation()
    {
        $em = $this->entityManager;
        // Initiate the SetOtp before calling this
        $generalService = $this->clientGeneralService->getGeneralService();
        $clientGeneralService = $this->clientGeneralService;
        $ravePaymentSession = $this->ravePaymentSession;
        $generalSession = $this->clientGeneralService->getGeneralSession();
        $invoiceId = $generalSession->InvoiceId;
        if ($invoiceId == NULL) {
            throw new \Exception("No Invoice could be located for this payment");
        }
        $invoiceEntity = $em->find("Transactions\Entity\Invoice", $invoiceId);
        $client = new Client();
        $client->setUri(RavePaymentGeneralSettings::RAVE_LIVE_URL . "flwv3-pug/getpaidx/api/validatecharge");
        $client->setMethod("POST");
        $client->setHeaders(array(
            'Content-Type' => 'application/json'
            // 'Authorization' => $this->moneywaveSession->auth
        ));

        $data = array(
            "PBFPubKey" => RavePaymentGeneralSettings::RAVE_PUBLIC_KEY,
            "transaction_reference" => $ravePaymentSession->flwRef,
            "otp" => $this->otp
        );

        $client->setRawBody(json_encode($data));
        $userEntity = $em->find("CsnUser\Entity\User", $clientGeneralService->getUserId());
        $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", ($clientGeneralService->getBrokerId() == NULL ? $this->generalService->getCentralBroker() : $clientGeneralService->getBrokerId()));
        $response = $client->send();
        if ($response->isSuccess()) {
            $body = json_decode($response->getBody());
            // verify payment here
            if ($body->data->data->responsecode == "00") {
                $ravePaymentSession->responseCode = $body->data->data->responsecode;
                $ravePaymentSession->chargeResponseCode = $body->data->tx->chargeResponseCode;
                $ravePaymentSession->chargeCurrency = $body->data->tx->currency;
                $ravePaymentSession->user_token = $body->data->tx->chargeToken->user_token;
                $ravePaymentSession->embed_token = $body->data->tx->chargeToken->embed_token;
                $ravePaymentSession->charged_amount = $body->data->tx->charged_amount;
                $ravePaymentSession->txRef = $body->data->tx->txRef;

                /**
                 * Define a post transcation logic for both successful and none succesful transaction
                 * Edit Invoice
                 * Store Transaction in Database
                 * If Micro Payment is active for update micro payment table
                 *
                 * Initiate the transfer to brokers account
                 * Enter status of payment of broker transfer into the database
                 */

                $this->setTxRef($ravePaymentSession->txRef);
                $confirmationresponse = $this->confirmCardPayment();
                // $em->flush();

                if ($confirmationresponse == TRUE) {
                    // if broker session id is set and defined
                    // if broker account number is set initiate transfer
                    // else hydrate not broker account number
                    // initiate broker transfer to the central broker account;

                    // Initiate Broker Transfer
                    if ($clientGeneralService->getBrokerId() != NULL) {
                        if ($brokerEntity->getBrokerBankAccount() != NULL) {
                            $this->initiateBrokerTransfer();
                        } else {
                            $noBrokerAccountEntity = new NoBrokerAccount();
                            try {
                                $noBrokerAccountEntity->setAmountPaid($ravePaymentSession->charged_amount)
                                    ->setBroker($brokerEntity)
                                    ->setCreatedOn(new \DateTime())
                                    ->setStatus($em->find("Transactions\Entity\NoBrokerAccountStatus", TransactionService::NO_BROKER_ACC_STATUS_TRANSFER_ERROR))
                                    ->setTransactionRef($ravePaymentSession->txRef)
                                    ->setUser($userEntity);

                                $em->persist($noBrokerAccountEntity);
                                $em->flush();
                            } catch (\Exception $e) {
                                return $e->getMessage();
                            } finally {
                                $this->postpaymentmail($ravePaymentSession, $brokerEntity, $userEntity, $invoiceEntity, $clientGeneralService, $generalService);
                            }
                        }
                    } else {
                        // send mail to the caller
                        // this is possibly the broker email being payment for sms or any other servcice
                    }

                    // send a notification to the customers email for successful payment

                    return TRUE;
                } else {

                    return FALSE;
                }
            } else {
                return FALSE; //
            }
        } else {
            throw new \Exception("Validating your OTP came with some issue, please try again Latter");
        }
    }

    public function postpaymentmail($ravePaymentSession, $brokerEntity, $userEntity, $invoiceEntity, $clientGeneralService, $generalService)
    {
        $messagePointer = array();
        $template = array();

        $messagePointer['to'] = $userEntity->getEmail();
        $messagePointer['subject'] = "Succesful Transaction";
        $messagePointer['fromName'] = $clientGeneralService->getBrokerName();

        $template['template'] = "general-successful-transaction"; // TODO generate mail template for the notification
        $template['var'] = array(
            "logo" => $clientGeneralService->getBrokerLogo(),
            "brokername " => $clientGeneralService->getBrokerName(),
            "broker" => $brokerEntity,
            "transactionNumber" => $ravePaymentSession->txRef,
            "invoiceNumber" => $invoiceEntity->getInvoiceUid(),
            "paymentType" => "Card",
            "date" => date("M j, Y H:i"),
            "amount" => $ravePaymentSession->chargedamount,
            "currency" => $invoiceEntity->getCurrency()->getCode()
        );
        $generalService->sendMails($messagePointer, $template);
    }

    /**
     * This handles the card on record and its used througn an embeded Token
     *
     * @throws \Exception
     * @return boolean
     */
    public function preAuthCharge()
    {
        $em = $this->entityManager;
        $clientGeneralService = $this->clientGeneralService;
        $userEntity = $em->find("CsnUser\Entity\User", $clientGeneralService->getUserId());

        $ravePaymentSession = $this->ravePaymentSession;
        $client = new Client();
        $client->setUri(RavePaymentGeneralSettings::RAVE_LIVE_URL . "flwv3-pug/getpaidx/api/tokenized/charge");
        $client->setMethod("POST");
        $client->setHeaders(array(
            'Content-Type' => 'application/json'
            // 'Authorization' => $this->moneywaveSession->auth
        ));

        $data = array(
            "currency" => $this->currency,
            "SECKEY" => RavePaymentGeneralSettings::RAVE_SECRET_KEY,
            "token" => $this->embededToken,
            "country" => "NG",
            "amount" => $this->amount,
            "email" => $userEntity->getEmail(),
            "IP" => $this->ip,
            "txRef" => $this->txRef
        );

        $client->setRawBody(json_encode($data));
        $response = $client->send();

        if (! $response->isSuccess()) {
            throw new \Exception("This Card can not be charged please try again ");
        } else {
            $body = json_decode($response->getBody());
            if ($body->status == "success") {
                if (property_exists($body->data, "chargeResponseCode")) {
                    if ($body->data->chargeResponseCode == "00") {
                        $ravePaymentSession->txRef = $body->data->txRef;
                        $ravePaymentSession->flwRef = $body->data->flwRef;

                        $this->setTxRef($ravePaymentSession->txRef);
                        $confirmationresponse = $this->confirmCardPayment();

                        if ($confirmationresponse == TRUE) {
                            $this->flushTransaction();
                            return TRUE;
                        } else {
                            return FALSE;
                        }
                    } elseif ($body->data->chargeResponseCode == "O2") {
                        // calls for validation of transaction
                        // Occaasionally takes place in verve cards
                    } else {
                        return false;
                    }
                }
            } else {
                throw new \Exception($body->message);
            }
        }
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Transactions\Service\RaveCardPaymentInterface::initiateCardPayment()
     *
     */
    public function initiateCardPayment()
    {
        $ravePaymentSession = $this->ravePaymentSession;
        $client = new Client();
        $client->setUri(RavePaymentGeneralSettings::RAVE_LIVE_URL . "flwv3-pug/getpaidx/api/charge");
        $client->setMethod("POST");
        $client->setHeaders(array(
            'Content-Type' => 'application/json'
            // 'Authorization' => $this->moneywaveSession->auth
        ));

        $data = array(
            'PBFPubKey' => RavePaymentGeneralSettings::RAVE_PUBLIC_KEY,
            'cardno' => $this->cleanCard($this->cardNo),
            'currency' => $this->currency,
            'country' => 'NG',
            'cvv' => $this->cleanCard($this->cardCvv),
            'amount' => $this->amount,

            'expiryyear' => $this->cardYear,
            'expirymonth' => $this->cardMonth,
            'email' => $this->email,
            'IP' => $this->ip,
            'txRef' => $this->txRef
        );

        $postData = $this->process($data);

        $client->setRawBody(json_encode($postData));
        $response = $client->send();

        if (! $response->isSuccess()) {

            throw new \Exception("There was a problem initiating this card");
        } else {
            $body = json_decode($response->getBody());
            if ($body->status == "success") {
                $this->getEventManager()->trigger(TriggerService::TRIGGER_CUSTOMER_CARD_PAYMENT_INITIATED_PRE, $this, array());
                if (property_exists($body->data, "suggested_auth")) { // requires an extra suggested authorization like PIN
                    $ravePaymentSession->cardNo = $this->cleanCard($this->cardNo);
                    $ravePaymentSession->currency = $this->currency;
                    $ravePaymentSession->cardCvv = $this->cleanCard($this->cardCvv);
                    $ravePaymentSession->cardMonth = $this->cardMonth;
                    $ravePaymentSession->cardYear = $this->cardYear;
                    // $ravePaymentSession->cardPin = $this->cardPin;
                    $ravePaymentSession->suggested_auth = $body->data->suggested_auth;
                    $ravePaymentSession->amount = $this->amount;
                    $ravePaymentSession->email = $this->email;
                    $ravePaymentSession->phoneNumber = $this->phoneNumber;
                    $ravePaymentSession->ip = $this->ip;
                    $ravePaymentSession->txRef = $this->txRef;
                    if ($body->data->suggested_auth == "PIN") {
                        return "PIN";
                    } elseif ($body->data->suggested_auth == "NOAUTH_INTERNATIONAL") {
                        return "NOAUTH";
                    } elseif ($body->data->suggested_auth == "AVS_VBVSECURECODE") {
                        return "AVS";
                    }
                } elseif (property_exists($body->data, "chargeResponseCode")) {
                    if ($body->data->chargeResponseCode == "02") { // Require confirmation
                        if ($body->data->authModelUsed != NULL || ! isEmpty($body->data->authModelUsed)) { // possible OTP or VBVSECURE
                            $ravePaymentSession->chargeResponseMessage = $body->data->chargeResponseMessage;
                            $ravePaymentSession->txRef = $body->data->txRef;
                            $ravePaymentSession->flwRef = $body->data->flwRef;
                            $ravePaymentSession->charged_amount = $body->data->charged_amount;
                            $ravePaymentSession->orderRef = $body->data->orderRef;
                            if ($this->isOtp($body->data->authModelUsed) || $body->data->authModelUsed = "OTP") {
                                return "OTP";
                            } elseif ($body->data->authModelUsed == "VBVSECURECODE") {
                                $ravePaymentSession->authurl = $body->data->authurl;
                                $ravePaymentSession->vbvrespcode = $body->data->vbvrespcode;
                                return "VBV";
                            }
                        }
                    } elseif ($body->data->chargeResponseCode == "00") { // direct charge was successful
                                                                         // redirect to the successful page
                        $ravePaymentSession->responseCode = $body->data->data->responsecode;
                        $ravePaymentSession->chargeResponseCode = $body->data->tx->chargeResponseCode;
                        $ravePaymentSession->chargeCurrency = $body->data->tx->currency;
                        $ravePaymentSession->user_token = $body->data->tx->chargeToken->user_token;
                        $ravePaymentSession->embed_token = $body->data->tx->chargeToken->embed_token;
                        $ravePaymentSession->charged_amount = $body->data->tx->charged_amount;
                        $ravePaymentSession->txRef = $body->data->tx->txRef;
                        return TRUE;
                    }
                }
            } else {
                throw new \Exception($body->message);
            }
        }
    }

    private function isOtp($text)
    {
        $contains = FALSE;
        if (strpos($text, "OTP") !== FALSE) {
            return TRUE; // meaning it contains the word OTP
        } else {
            return FALSE; // meaning it does not conatin the word OTP
        }
    }

    /**
     * Initiate SetPin Before calling this function
     *
     * @return string
     */
    public function pinConfirmation()
    {
        //
        // $client = new Client();
        $ravePaymentSession = $this->ravePaymentSession;
        $client = new Client();
        $client->setUri(RavePaymentGeneralSettings::RAVE_LIVE_URL . "flwv3-pug/getpaidx/api/charge");
        $client->setMethod("POST");
        $client->setHeaders(array(
            'Content-Type' => 'application/json'
            // 'Authorization' => $this->moneywaveSession->auth
        ));

        $data = array(
            'PBFPubKey' => RavePaymentGeneralSettings::RAVE_PUBLIC_KEY,
            'cardno' => $ravePaymentSession->cardNo,
            'currency' => $ravePaymentSession->currency,
            'country' => 'NG',
            'cvv' => $ravePaymentSession->cardCvv,
            'amount' => $ravePaymentSession->amount,
            'expiryyear' => $ravePaymentSession->cardYear,
            'expirymonth' => $ravePaymentSession->cardMonth,
            'suggested_auth' => 'PIN',
            'pin' => $this->cardPin,
            'email' => $ravePaymentSession->email,
            'IP' => $ravePaymentSession->ip,
            'txRef' => $ravePaymentSession->txRef
            // 'device_fingerprint' => '69e6b7f0sb72037aa8428b70fbe03986c'
        );

        $postData = $this->process($data);

        $client->setRawBody(json_encode($postData));
        $response = $client->send();

        if ($response->isSuccess()) {
            $body = json_decode($response->getBody());
            $ravePaymentSession->authModelUsed = $body->data->authModelUsed;
            $ravePaymentSession->paymentType = $body->data->paymentType;
            $ravePaymentSession->flwRef = $body->data->flwRef;

            if ($body->data->chargeResponseCode == "02") { // means requires validation
                                                           // Thids notifies for a OnetimePassword Validation

                return "OTP";
            } elseif ($body->data->chargeResponseCode == "00") {
                return TRUE;
            }
        } else {
            throw new \Exception("We had a problem confirmaing youtr pincode");
        }
    }

    /**
     * This Initiate/Confirm The Inetrtional transaction through car billing billing address
     *
     * @throws \Exception
     * @return boolean|string
     */
    public function avsConfirmation()
    {
        $client = new Client();
        $ravePaymentSession = $this->ravePaymentSession;

        $client->setUri(RavePaymentGeneralSettings::RAVE_LIVE_URL . "flwv3-pug/getpaidx/api/charge");
        $client->setMethod("POST");
        $client->setHeaders(array(
            'Content-Type' => 'application/json'
            // 'Authorization' => $this->moneywaveSession->auth
        ));
        $data = array(
            "PBFPubKey" => RavePaymentGeneralSettings::RAVE_PUBLIC_KEY,
            "cardno" => $ravePaymentSession->cardNo,
            "cvv" => $ravePaymentSession->cardCvv,
            "expirymonth" => $ravePaymentSession->cardMonth,
            "expiryyear" => $ravePaymentSession->cardYear,
            "currency" => $ravePaymentSession->currency,
            "country" => "NG",
            "amount" => $ravePaymentSession->amount,
            "email" => $ravePaymentSession->email,
            "phonenumber" => $ravePaymentSession->phoneNumber,
            "IP" => $ravePaymentSession->ip,
            "txRef" => $ravePaymentSession->txRef,
            "suggested_auth" => $ravePaymentSession->suggested_auth,
            "billingzip" => $this->billingzip,
            "billingcity" => $this->billingcity,
            "billingaddress" => $this->billingaddress,
            "billingstate" => $this->billingstate,
            "billingcountry" => $this->billingcountry,
            "redirect_url" => $this->redirect_url
        );

        $postData = $this->process($data);

        $client->setRawBody(json_encode($postData));
        $response = $client->send();
        if ($response->isSuccess()) {
            $body = json_decode($response->getBody());
            $ravePaymentSession->authModelUsed = $body->data->authModelUsed;
            $ravePaymentSession->paymentType = $body->data->paymentType;
            $ravePaymentSession->flwRef = $body->data->flwRef;
            $ravePaymentSession->authurl = $body->data->authurl;
            if ($body->data->chargeResponseCode == "00") {
                return TRUE;
            } elseif ($body->data->chargeResponseCode == "02" || $ravePaymentSession->authModelUsed == "VBVSECURECODE") {
                $ravePaymentSession->vbvUrl = $body->data->authurl;
                return "AVS"; // authenticateion required
            } else {
                // Shouldnt reach this point but
                // If it does , there was an unspecified challenge
                return "ERR";
            }
        } else {
            throw new \Exception("We had a problem confirming the payment");
        }
    }

    // Begin Setter
    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }

    /**
     *
     * @return object $entityManager
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }

    /**
     *
     * @return object $ravePaymentSession
     */
    public function getRavePaymentSession()
    {
        return $this->ravePaymentSession;
    }

    /**
     *
     * @return object $clientGeneralService
     */
    public function getClientGeneralService()
    {
        return $this->clientGeneralService;
    }

    /**
     *
     * @return object $transactionService
     */
    public function getTransactionService()
    {
        return $this->transactionService;
    }

    /**
     *
     * @param object $ravePaymentSession
     */
    public function setRavePaymentSession($ravePaymentSession)
    {
        $this->ravePaymentSession = $ravePaymentSession;
        return $this;
    }

    /**
     *
     * @return object $embededToken
     */
    public function getEmbededToken()
    {
        return $this->embededToken;
    }

    /**
     *
     * @param object $embededToken
     */
    public function setEmbededToken($embededToken)
    {
        $this->embededToken = $embededToken;
        return $this;
    }

    /**
     *
     * @param object $clientGeneralService
     */
    public function setClientGeneralService($clientGeneralService)
    {
        $this->clientGeneralService = $clientGeneralService;
        return $this;
    }

    /**
     *
     * @param object $transactionService
     */
    public function setTransactionService($transactionService)
    {
        $this->transactionService = $transactionService;

        return $this;
    }

    /**
     *
     * @return object $cardNo
     */
    public function getCardNo()
    {
        return $this->cardNo;
    }

    /**
     *
     * @return object $cardCvv
     */
    public function getCardCvv()
    {
        return $this->cardCvv;
    }

    /**
     *
     * @return object $cardMonth
     */
    public function getCardMonth()
    {
        return $this->cardMonth;
    }

    /**
     *
     * @return object $cardYear
     */
    public function getCardYear()
    {
        return $this->cardYear;
    }

    /**
     *
     * @return object $cardPin
     */
    public function getCardPin()
    {
        return $this->cardPin;
    }

    /**
     *
     * @return object $currency
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     *
     * @return object $amount
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     *
     * @return object $country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     *
     * @return object $email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     *
     * @return object $phoneNumber
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     *
     * @return object $firstName
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     *
     * @return object $lastName
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     *
     * @return object $ip
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     *
     * @return object $txRef
     */
    public function getTxRef()
    {
        return $this->txRef;
    }

    /**
     *
     * @return object $otp
     */
    public function getOtp()
    {
        return $this->otp;
    }

    /**
     *
     * @return object $billingzip
     */
    public function getBillingzip()
    {
        return $this->billingzip;
    }

    /**
     *
     * @return object $billingcity
     */
    public function getBillingcity()
    {
        return $this->billingcity;
    }

    /**
     *
     * @return object $billingaddress
     */
    public function getBillingaddress()
    {
        return $this->billingaddress;
    }

    /**
     *
     * @return object $billingstate
     */
    public function getBillingstate()
    {
        return $this->billingstate;
    }

    /**
     *
     * @return object $billingcountry
     */
    public function getBillingcountry()
    {
        return $this->billingcountry;
    }

    /**
     *
     * @return object $transferBank
     */
    public function getTransferBank()
    {
        return $this->transferBank;
    }

    /**
     *
     * @return object $transferAcc
     */
    public function getTransferAcc()
    {
        return $this->transferAcc;
    }

    /**
     *
     * @return object $transferAmount
     */
    public function getTransferAmount()
    {
        return $this->transferAmount;
    }

    /**
     *
     * @return object $transferCurrency
     */
    public function getTransferCurrency()
    {
        return $this->transferCurrency;
    }

    /**
     *
     * @param object $cardNo
     */
    public function setCardNo($cardNo)
    {
        $this->cardNo = $cardNo;
        return $this;
    }

    /**
     *
     * @param object $cardCvv
     */
    public function setCardCvv($cardCvv)
    {
        $this->cardCvv = $cardCvv;
        return $this;
    }

    /**
     *
     * @param object $cardMonth
     */
    public function setCardMonth($cardMonth)
    {
        $this->cardMonth = $cardMonth;
        return $this;
    }

    /**
     *
     * @param object $cardYear
     */
    public function setCardYear($cardYear)
    {
        $this->cardYear = $cardYear;
        return $this;
    }

    /**
     *
     * @param object $cardPin
     */
    public function setCardPin($cardPin)
    {
        $this->cardPin = $cardPin;
        return $this;
    }

    /**
     *
     * @param object $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     *
     * @param object $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     *
     * @param object $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }

    /**
     *
     * @param object $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     *
     * @param object $phoneNumber
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }

    /**
     *
     * @param object $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     *
     * @param object $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     *
     * @param object $ip
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
        return $this;
    }

    /**
     *
     * @param object $txRef
     */
    public function setTxRef($txRef)
    {
        $this->txRef = $txRef;
        return $this;
    }

    /**
     *
     * @param object $otp
     */
    public function setOtp($otp)
    {
        $this->otp = $otp;
        return $this;
    }

    /**
     *
     * @return object $redirect_url
     */
    public function getRedirect_url()
    {
        return $this->redirect_url;
    }

    /**
     *
     * @param object $redirect_url
     */
    public function setRedirect_url($redirect_url)
    {
        $this->redirect_url = $redirect_url;
        return $this;
    }

    /**
     *
     * @param object $billingzip
     */
    public function setBillingzip($billingzip)
    {
        $this->billingzip = $billingzip;
        return $this;
    }

    /**
     *
     * @param object $billingcity
     */
    public function setBillingcity($billingcity)
    {
        $this->billingcity = $billingcity;
        return $this;
    }

    /**
     *
     * @param object $billingaddress
     */
    public function setBillingaddress($billingaddress)
    {
        $this->billingaddress = $billingaddress;
        return $this;
    }

    /**
     *
     * @param object $billingstate
     */
    public function setBillingstate($billingstate)
    {
        $this->billingstate = $billingstate;
        return $this;
    }

    /**
     *
     * @param object $billingcountry
     */
    public function setBillingcountry($billingcountry)
    {
        $this->billingcountry = $billingcountry;
        return $this;
    }

    /**
     *
     * @param object $transferBank
     */
    public function setTransferBank($transferBank)
    {
        $this->transferBank = $transferBank;
        return $this;
    }

    /**
     *
     * @param object $transferAcc
     */
    public function setTransferAcc($transferAcc)
    {
        $this->transferAcc = $transferAcc;
        return $this;
    }

    /**
     *
     * @param object $transferAmount
     */
    public function setTransferAmount($transferAmount)
    {
        $this->transferAmount = $transferAmount;
        return $this;
    }

    /**
     *
     * @param object $transferCurrency
     */
    public function setTransferCurrency($transferCurrency)
    {
        $this->transferCurrency = $transferCurrency;
        return $this;
    }

    /**
     *
     * @return object $ravePaymentGeneralSetting
     */
    public function getRavePaymentGeneralSetting()
    {
        return $this->ravePaymentGeneralSetting;
    }

    /**
     *
     * @param object $ravePaymentGeneralSetting
     */
    public function setRavePaymentGeneralSetting($ravePaymentGeneralSetting)
    {
        $this->ravePaymentGeneralSetting = $ravePaymentGeneralSetting;
        return $this;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Transactions\Service\RaveCardPaymentInterface::ComfirmCardPayment()
     */
    /**
     *
     * @return object $transferNarration
     */
    public function getTransferNarration()
    {
        return $this->transferNarration;
    }

    /**
     *
     * @param object $transferNarration
     */
    public function setTransferNarration($transferNarration)
    {
        $this->transferNarration = $transferNarration;
        return $this;
    }

    /**
     *
     * @return object $mailService
     */
    public function getMailService()
    {
        return $this->mailService;
    }

    /**
     *
     * @param object $mailService
     */
    public function setMailService($mailService)
    {
        $this->mailService = $mailService;
        return $this;
    }

    /**
     *
     * @return object $customerBoardService
     */
    public function getCustomerBoardService()
    {
        return $this->customerBoardService;
    }

    /**
     *
     * @param object $customerBoardService
     */
    public function setCustomerBoardService($customerBoardService)
    {
        $this->customerBoardService = $customerBoardService;
        return $this;
    }

    /**
     *
     * @return mixed
     */
    public function getGeneralService()
    {
        return $this->generalService;
    }

    /**
     *
     * @param mixed $generalService
     */
    public function setGeneralService($generalService)
    {
        $this->generalService = $generalService;
        return $this;
    }
}

