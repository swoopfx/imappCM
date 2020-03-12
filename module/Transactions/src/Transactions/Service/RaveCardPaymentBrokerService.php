<?php
namespace Transactions\Service;

use Transactions\Service\RavePaymentGeneralSettings;
use Transactions\Service\RaveCardPaymentInterface;
use Zend\Http\Client;
use GeneralServicer\Service\GeneralService;
use Doctrine\ORM\EntityManager;
use Zend\Session\Container;
use Transactions\Entity\Transaction;
use Transactions\Entity\Invoice;
use Users\Entity\InsuranceBrokerRegistered;

class RaveCardPaymentBrokerService extends RavePaymentGeneralSettings implements RaveCardPaymentInterface
{

    /**
     *
     * @var EntityManager
     */
    private $entityManager;

    /**
     *
     * @var GeneralService
     */
    private $generalService;

    private $transactionService;

    private $ravePaymentSession;

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

    // TODO - Insert your code here
    public function __construct()
    {

        // TODO - Insert your code here
    }

    /**
     *
     * @return mixed
     */
    public function getEntityManager()
    {
        return $this->entityManager;
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
     * @param mixed $entityManager
     */
    public function setEntityManager($entityManager)
    {
        $this->entityManager = $entityManager;
        return $this;
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

    /**
     *
     * @return mixed
     */
    public function getTransactionService()
    {
        return $this->transactionService;
    }

    /**
     *
     * @param mixed $transactionService
     */
    public function setTransactionService($transactionService)
    {
        $this->transactionService = $transactionService;
        return $this;
    }

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
        $generalService = $this->generalService;

        $generalSession = $generalService->getGeneralSession();
        $invoiceId = $generalSession->brokerInvoiceId;
        if ($invoiceId == NULL) {
            throw new \Exception("No Invoice could be located for this payment");
        } else {

            try {
                /**
                 *
                 * @var Invoice $invoiceEntity
                 */
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

                // if ($invoiceEntity->getIsMicro()) {
                $isMicroPayment = TRUE;
                // $invoiceEntity->setStatus($em->find("Transactions\Entity\InvoiceStatus", InvoiceService::INVOICE_PAYING_STATUS));
                // // Get the actual micro payment
                // $micropaymentActiveSession = new Container("micropayment_active_session");
                // $microPaymentEntity = $em->find("Transactions\Entity\MicroPayment", $micropaymentActiveSession->id);
                // $microPaymentEntity->setStatus($em->find("Transactions\Entity\TransactionStatus", TransactionService::TRANSACTION_STATUS_SUCCESS));
                // $microPaymentEntity->setUpdatedOn(new \DateTime());

                // $em->persist($microPaymentEntity); // persist MIcroPayment
                // $em->persist($invoiceEntity); // persist Invoice
                // } else {
                $invoiceEntity->setStatus($em->find("Transactions\Entity\InvoiceStatus", InvoiceService::INVOICE_PAID_STATUS));
                $em->persist($invoiceEntity); // persist alternate invoice
                                              // }
                $em->flush();

                // Notify Broker of payment via mail
                if ($generalService->getCentralBroker() != NULL) {
                    if ($transactionEntity->getPaymentMode()->getId() == TransactionService::TRANSACTION_PAYMENT_MODE_FLUTTERWAVE) {
                        $paymentMode = "Card Payment";
                    }
                    // $customerEntity = $em->find("Customer\Entity\Customer", $clientGeneralService->getCustomerId());
                    /**
                     *
                     * @var InsuranceBrokerRegistered $brokerEntity
                     */
                    $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $generalService->getCentralBroker());
                    // $customerUserEntity = $customerEntity->getUser();
                    $serviceDescription = "Being Service for " . $invoiceEntity->getInvoiceCategory()->getCategory() . " Acquisitiion";
                    // $childBroker = $customerEntity->getAssignedChildBroker();
                    // $childBrokerEmail = array();
                    // if (count($childBroker) > 0) {
                    // foreach ($childBroker as $child) {
                    // $childBrokerEmail[] = $child->getUser()->getEmail();
                    // }
                    // }
                    // Send email message to customer
                    $messagePonters = array(
                        "to" => GeneralService::CM_BILLING_EMAIL, // change to billing department
                        "fromName" => GeneralService::CM_PRODUCT_NAME,
                        "subject" => "Transaction"
                        // "replyTo" => $brokerEntity->getUser()->getEmail(),
                        // "addReplyTo" => $childBrokerEmail,
                        // "addCc" => $childBrokerEmail
                    );
                    $template = array();
                    $template['template'] = "general-customer-transaction";
                    $template['var'] = array(
                        "customerName" => $brokerEntity->getCompanyName(),
                        "orderDate" => $transactionEntity->getPaymentDate(),
                        "orderId" => $transactionEntity->getTransactUid(),
                        "paymentMode" => $paymentMode,
                        "serviceDescription" => $serviceDescription,
                        "paymentType" => ($isMicroPayment == TRUE ? "Installmenstal Payment" : "Direct Payment"),
                        "amount" => $ravePaymentSession->chargedamount,
                        "currency" => "NGN",
                        "isMicroPayment" => $isMicroPayment
                        // "microPaymentTable"=>$microPaymentTable,
                        // "brokerName" => $brokerEntity->getBrokerName()
                    );

                    $generalService->sendMails($messagePonters, $template);

                    // End sent to customer mail
                }
            } catch (\Exception $e) {

                return FALSE;
            }
        }

        // if ($clientGeneralService->getBrokerId() != NULL) {
        // $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $clientGeneralService->getBrokerId());
        // // Initiate Transfer
        // $this->initiateBrokerTransfer();
        // }
    }

    public function validateCardPayment()
    {}

    public function confirmCardPayment()
    {
        $ravePaymentSession = $this->ravePaymentSession;

        $generalSession = $this->generalService->getGeneralSession();
        $invoiceId = $generalSession->brokerInvoiceId;
        if ($invoiceId == NULL) {
            throw new \Exception("No Invoice could be located for this payment");
        }

        if ($ravePaymentSession->responseCode == "00" && $ravePaymentSession->chargeResponseCode == "00") {
            $client = new Client();
            $client->setUri(RavePaymentService::RAVE_LIVE_URL . "flwv3-pug/getpaidx/api/v2/verify");
            $client->setMethod("POST");
            $client->setHeaders(array(
                'Content-Type' => 'application/json'
            ));
            $post = array(
                "txref" => $ravePaymentSession->txRef,
                "SECKEY" => RavePaymentService::RAVE_SECRET_KEY
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

                        $this->flushTransaction(); // flushes transaction and invoice entity
                        return TRUE; // meaning the charged amount >= the sent amount
                    } else {
                        return FALSE;
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

    public function pinConfirmation()
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
            throw new \Exception("We had a problem confirmaing your pincode");
        }
    }

    /**
     * Makes an OTP validation of the transction
     *
     * @throws \Exception
     * @return string|boolean
     */
    public function otpConfirmation()
    {
        $em = $this->entityManager;
        // Initiate the SetOtp before calling this
        $generalService = $this->generalService;
        $ravePaymentSession = $this->ravePaymentSession;
        $generalSession = $this->clientGeneralService->getGeneralSession();
        $invoiceId = $generalSession->brokerInvoiceId;
        if ($invoiceId == NULL) {
            throw new \Exception("No Invoice could be located for this payment");
        } else {
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
            $userEntity = $em->find("CsnUser\Entity\User", $generalService->getUserId());
            $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $this->generalService->getCentralBroker());
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
                        // if ($clientGeneralService->getBrokerId() != NULL) {
                        // if ($brokerEntity->getBrokerBankAccount() != NULL) {
                        // $this->initiateBrokerTransfer();
                        // } else {
                        // $noBrokerAccountEntity = new NoBrokerAccount();
                        // try {
                        // $noBrokerAccountEntity->setAmountPaid($ravePaymentSession->charged_amount)
                        // ->setBroker($brokerEntity)
                        // ->setCreatedOn(new \DateTime())
                        // ->setStatus($em->find("Transactions\Entity\NoBrokerAccountStatus", TransactionService::NO_BROKER_ACC_STATUS_TRANSFER_ERROR))
                        // ->setTransactionRef($ravePaymentSession->txRef)
                        // ->setUser($userEntity);

                        // $em->persist($noBrokerAccountEntity);
                        // $em->flush();
                        // } catch (\Exception $e) {
                        // return $e->getMessage();
                        // } finally {
                        // $this->postpaymentmail($ravePaymentSession, $brokerEntity, $userEntity, $invoiceEntity, $clientGeneralService, $generalService);
                        // }
                        // }
                        // } else {
                        // // send mail to the caller
                        // // this is possibly the broker email being payment for sms or any other servcice
                        // }

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
    }

    /**
     *
     * @return mixed
     */
    public function getRavePaymentSession()
    {
        return $this->ravePaymentSession;
    }

    /**
     *
     * @return mixed
     */
    public function getCardNo()
    {
        return $this->cardNo;
    }

    /**
     *
     * @return mixed
     */
    public function getCardCvv()
    {
        return $this->cardCvv;
    }

    /**
     *
     * @return mixed
     */
    public function getCardMonth()
    {
        return $this->cardMonth;
    }

    /**
     *
     * @return mixed
     */
    public function getCardYear()
    {
        return $this->cardYear;
    }

    /**
     *
     * @return mixed
     */
    public function getCardPin()
    {
        return $this->cardPin;
    }

    /**
     *
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     *
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     *
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     *
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     *
     * @return mixed
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     *
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     *
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     *
     * @return mixed
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     *
     * @return mixed
     */
    public function getTxRef()
    {
        return $this->txRef;
    }

    /**
     *
     * @return mixed
     */
    public function getOtp()
    {
        return $this->otp;
    }

    /**
     *
     * @return mixed
     */
    public function getRedirect_url()
    {
        return $this->redirect_url;
    }

    /**
     *
     * @return mixed
     */
    public function getBillingzip()
    {
        return $this->billingzip;
    }

    /**
     *
     * @return mixed
     */
    public function getBillingcity()
    {
        return $this->billingcity;
    }

    /**
     *
     * @return mixed
     */
    public function getBillingaddress()
    {
        return $this->billingaddress;
    }

    /**
     *
     * @return mixed
     */
    public function getBillingstate()
    {
        return $this->billingstate;
    }

    /**
     *
     * @return mixed
     */
    public function getBillingcountry()
    {
        return $this->billingcountry;
    }

    /**
     *
     * @return mixed
     */
    public function getTransferBank()
    {
        return $this->transferBank;
    }

    /**
     *
     * @return mixed
     */
    public function getTransferAcc()
    {
        return $this->transferAcc;
    }

    /**
     *
     * @return mixed
     */
    public function getTransferAmount()
    {
        return $this->transferAmount;
    }

    /**
     *
     * @return mixed
     */
    public function getTransferCurrency()
    {
        return $this->transferCurrency;
    }

    /**
     *
     * @return mixed
     */
    public function getTransferNarration()
    {
        return $this->transferNarration;
    }

    /**
     *
     * @return mixed
     */
    public function getEmbededToken()
    {
        return $this->embededToken;
    }

    /**
     *
     * @param mixed $ravePaymentSession
     */
    public function setRavePaymentSession($ravePaymentSession)
    {
        $this->ravePaymentSession = $ravePaymentSession;
        return $this;
    }

    /**
     *
     * @param mixed $cardNo
     */
    public function setCardNo($cardNo)
    {
        $this->cardNo = $cardNo;
        return $this;
    }

    /**
     *
     * @param mixed $cardCvv
     */
    public function setCardCvv($cardCvv)
    {
        $this->cardCvv = $cardCvv;
        return $this;
    }

    /**
     *
     * @param mixed $cardMonth
     */
    public function setCardMonth($cardMonth)
    {
        $this->cardMonth = $cardMonth;
        return $this;
    }

    /**
     *
     * @param mixed $cardYear
     */
    public function setCardYear($cardYear)
    {
        $this->cardYear = $cardYear;
        return $this;
    }

    /**
     *
     * @param mixed $cardPin
     */
    public function setCardPin($cardPin)
    {
        $this->cardPin = $cardPin;
        return $this;
    }

    /**
     *
     * @param mixed $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     *
     * @param mixed $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     *
     * @param mixed $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }

    /**
     *
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     *
     * @param mixed $phoneNumber
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }

    /**
     *
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     *
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     *
     * @param mixed $ip
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
        return $this;
    }

    /**
     *
     * @param mixed $txRef
     */
    public function setTxRef($txRef)
    {
        $this->txRef = $txRef;
        return $this;
    }

    /**
     *
     * @param mixed $otp
     */
    public function setOtp($otp)
    {
        $this->otp = $otp;
        return $this;
    }

    /**
     *
     * @param mixed $redirect_url
     */
    public function setRedirect_url($redirect_url)
    {
        $this->redirect_url = $redirect_url;
        return $this;
    }

    /**
     *
     * @param mixed $billingzip
     */
    public function setBillingzip($billingzip)
    {
        $this->billingzip = $billingzip;
        return $this;
    }

    /**
     *
     * @param mixed $billingcity
     */
    public function setBillingcity($billingcity)
    {
        $this->billingcity = $billingcity;
        return $this;
    }

    /**
     *
     * @param mixed $billingaddress
     */
    public function setBillingaddress($billingaddress)
    {
        $this->billingaddress = $billingaddress;
        return $this;
    }

    /**
     *
     * @param mixed $billingstate
     */
    public function setBillingstate($billingstate)
    {
        $this->billingstate = $billingstate;
        return $this;
    }

    /**
     *
     * @param mixed $billingcountry
     */
    public function setBillingcountry($billingcountry)
    {
        $this->billingcountry = $billingcountry;
        return $this;
    }

    /**
     *
     * @param mixed $transferBank
     */
    public function setTransferBank($transferBank)
    {
        $this->transferBank = $transferBank;
        return $this;
    }

    /**
     *
     * @param mixed $transferAcc
     */
    public function setTransferAcc($transferAcc)
    {
        $this->transferAcc = $transferAcc;
        return $this;
    }

    /**
     *
     * @param mixed $transferAmount
     */
    public function setTransferAmount($transferAmount)
    {
        $this->transferAmount = $transferAmount;
        return $this;
    }

    /**
     *
     * @param mixed $transferCurrency
     */
    public function setTransferCurrency($transferCurrency)
    {
        $this->transferCurrency = $transferCurrency;
        return $this;
    }

    /**
     *
     * @param mixed $transferNarration
     */
    public function setTransferNarration($transferNarration)
    {
        $this->transferNarration = $transferNarration;
        return $this;
    }

    /**
     *
     * @param mixed $embededToken
     */
    public function setEmbededToken($embededToken)
    {
        $this->embededToken = $embededToken;
        return $this;
    }
}

