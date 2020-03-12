<?php
namespace Transactions\Service;

use Zend\Http\Client;
use Transactions\Entity\Transaction;
use Zend\Session\Container;
use GeneralServicer\Service\GeneralService;
use Transactions\Entity\RaveTransfer;
use Transactions\Entity\RaveCardToken;

/**
 * @deprecated
 * @author otaba
 *        
 */
class RavePaymentService
{

    private $entityManager;

    private $ravePaymentSession;

    private $clientGeneralService;

    private $transactionService;

    /**
     * Begin CArd Details
     *
     * @var unknown
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

    // bank transfer details
    private $bank;

    private $accountNumber;

    private $passcode;

    private $redirect_url;

    const RAVE_DEMO_URL = "https://ravesandboxapi.flutterwave.com/";

    const RAVE_LIVE_URL = "https://api.ravepay.co/";

    const RAVE_CONTENT_TYPE = "application/json";

    const RAVE_PUBLIC_KEY = "FLWPUBK-ac7b6b5cd4cc7def4ed7773d2ac89e56-X";

    const RAVE_SECRET_KEY = "FLWSECK-262dbc2005e0230cce3fd23d629de28c-X";

    const RAVE_OTP_VALIDATION_MODE = "OTP";

    const RAVE_GTBANK_CODE = "058";

    const RAVE_FIRST_BANK_CODE = "011";

    const RAVE_GTB_REDIRECTION_URL = GeneralService::CM_URL . "board/payment";

    const RAVE_GENERAL_REDIRECTION_URL = GeneralService::CM_URL . "board/payment";

    const RAVE_TRANSFER_STATUS_INITIATED = 10;

    const RAVE_TRANSFER_STATUS_SUCCESS = 50;

    const RAVE_TRANSFER_STATUS_FAILED = 100;

    /**
     */
    public function __construct()
    {}

    /**
     * this is the amount transaferable to the broker
     * After successful deductions of 3% and N100
     * 3% = 1.4% flutterwave charge and 1.6
     *
     * @return number
     */
    public function calculateTransferAmount()
    {
        $generalSession = $this->clientGeneralService->getGeneralSession();
        $calculated = (float) (97 * $generalSession->amountSent) / 100; // calculates 97% of the amount deducted
        $amountTransferable = $calculated - 100; // deducts the transafer fee and our own N55 standard charge
        return $amountTransferable;
    }

   

    public function raveWebHook()
    {}

    private function getKey($seckey)
    {
        $hashedkey = md5($seckey);
        $hashedkeyLast12 = substr($hashedkey, - 12);
        
        $secretkeyadjusted = str_replace("FLWSECK-", "", $seckey);
        $secretkeyadjustedfirst12 = substr($secretkeyadjusted, 0, 12);
        
        $encryptionkey = $secretkeyadjustedfirst12 . $hashedkeyLast12;
        
        return $encryptionkey;
    }

    private function encrypt3Des($data, $key)
    {
        $encData = openssl_encrypt($data, "DES-EDES", $key, OPENSSL_RAW_DATA);
        return base64_encode($encData);
    }

    // Rave Card processes
    
    /**
     * This function processes the card through encryption
     *
     * @param unknown $data            
     */
    private function process($data)
    {
        $secKey = RavePaymentService::RAVE_SECRET_KEY;
        
        $key = $this->getKey($secKey);
        
        $dataReq = json_encode($data);
        $post_enc = $this->encrypt3Des($dataReq, $key);
        
        $postData = array(
            'PBFPubKey' => RavePaymentService::RAVE_PUBLIC_KEY,
            'client' => $post_enc,
            'alg' => '3DES-24'
        );
        return $postData;
    }

    /**
     * This initiates bank transfer payment
     *
     * @return string
     */
    public function initiateBankPayment()
    {
        $ravePaymentSession = $this->ravePaymentSession;
        $client = new Client();
        $client->setUri(RavePaymentService::RAVE_LIVE_URL . "flwv3-pug/getpaidx/api/charge");
        $client->setHeaders(array(
            'Content-Type' => 'application/json'
        ));
        $data = array(
            "PBFPubKey" => RavePaymentService::RAVE_PUBLIC_KEY,
            "accountbank" => $this->bank,
            "accountnumber" => $this->accountNumber,
            "payment_type" => "",
            "currency" => $this->currency,
            "amount" => $this->amount,
            "email" => $this->email,
            "passcode" => $this->passcode, // Date of birth on account required by zenith bank account holder
            "phonenumber" => $this->phoneNumber,
            "firstname" => $this->firstName,
            "lastname" => $this->lastName,
            "IP" => $this->ip,
            "txRef" => $this->txRef,
            "redirect_url" => $this->redirect_url,
            "country" => "NG"
        
        );
        
        $postData = $this->process($data);
        
        $client->setRawBody(json_encode($postData));
        $response = $client->send();
        if ($response->isSuccess()) {
            $body = json_decode($response->getBody());
            
            if ($body->data->chargeResponseCode == "02" && $body->status == "success") {
                $ravePaymentSession->flwRef = $body->data->flwRef;
                $ravePaymentSession->validatinstruction = $body->data->validateInstructions->instruction;
                $ravePaymentSession->paymenttype = $body->data->paymentType;
                $ravePaymentSession->authUrl = $body->data->authurl;
                $ravePaymentSession->valparams = $body->data->validateInstructions->valparams;
                $ravePaymentSession->bank = $this->bank;
                if ($this->bank == RavePaymentService::RAVE_GTBANK_CODE) { // if it is GTBANK
                    $ravePaymentSession->authh = "GTB";
                    return "GTB";
                } elseif ($this->bank == RavePaymentService::RAVE_FIRST_BANK_CODE) {
                    $ravePaymentSession->authh = "FBN";
                    return "FBN";
                } elseif ($this->bank != RavePaymentService::RAVE_GTBANK_CODE && $this->bank != RavePaymentService::RAVE_FIRST_BANK_CODE) { // is not GTBANK
                    $ravePaymentSession->authh = "OTB";
                    return "OTP";
                } else {
                    // Every thing went well
                }
            }
        }
    }

    /**
     * This function initiates the payment
     * to be made
     * 
     * @throws \Exception
     * @return string|NULL
     */
    
    public function initiateCardPayment()
    {
        $ravePaymentSession = $this->ravePaymentSession;
        $client = new Client();
        $client->setUri(RavePaymentService::RAVE_LIVE_URL . "flwv3-pug/getpaidx/api/charge");
        $client->setMethod("POST");
        $client->setHeaders(array(
            'Content-Type' => 'application/json'
            // 'Authorization' => $this->moneywaveSession->auth
        ));
        
        $data = array(
            'PBFPubKey' => RavePaymentService::RAVE_PUBLIC_KEY,
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
            // $body = json_decode($response->getBody());
            throw new \Exception("There was a problem initiating this card");
        } else {
            $body = json_decode($response->getBody());
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
            } elseif ($body->data->suggested_auth == "NOAUTH_INTERNATIONAL" || $body->data->suggestes_auth == "AVS_VBVSECURECODE") {
                return "NOAUTH";
            } else {
                return NULL;
            }
        }
    }

    public function confirmCardPayment()
    {
        $ravePaymentSession = $this->ravePaymentSession;
        if ($ravePaymentSession->suggested_auth == "PIN") {
            // A Call to setPin must be called
            return $this->pinConfirmation();
        } elseif ($ravePaymentSession->suggested_auth == "NOAUTH_INTERNATIONAL" || $ravePaymentSession->suggested_auth == "AVS_VBVSECURECODE") {
            $this->noAuthConfirmation();
        } else {
            
        }
    }

    /**
     * Initiate SetPin Before calling this function
     *
     * @return string
     */
    private function pinConfirmation()
    {
        //
        // $client = new Client();
        $ravePaymentSession = $this->ravePaymentSession;
        $client = new Client();
        $client->setUri(RavePaymentService::RAVE_LIVE_URL . "flwv3-pug/getpaidx/api/charge");
        $client->setMethod("POST");
        $client->setHeaders(array(
            'Content-Type' => 'application/json'
            // 'Authorization' => $this->moneywaveSession->auth
        ));
        
        $data = array(
            'PBFPubKey' => RavePaymentService::RAVE_PUBLIC_KEY,
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

    private function noAuthConfirmation()
    {
        $client = new Client();
        $ravePaymentSession = $this->ravePaymentSession;
        
        $client->setUri(RavePaymentService::RAVE_LIVE_URL . "flwv3-pug/getpaidx/api/charge");
        $client->setMethod("POST");
        $client->setHeaders(array(
            'Content-Type' => 'application/json'
            // 'Authorization' => $this->moneywaveSession->auth
        ));
        $data = array(
            "PBFPubKey" => RavePaymentService::RAVE_PUBLIC_KEY,
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
            } elseif ($body->data->chargeResponseCode == "02") {
                return "AVS"; // authenticateion required
            }
        } else {
            throw new \Exception("We had a problem confirming the payment");
        }
    }

    private function vbvConfirmation()
    {}

    // BEGIN VALIDATION
    /**
     * This function validates the card payment to be made on rave
     */
    public function validateCardPayment()
    {
        $ravePaymentSession = $this->ravePaymentSession;
        if ($ravePaymentSession->authModelUsed == "PIN") {
            $otp = $this->otp;
            $res = $this->otpValidation();
            return $res;
        } elseif ($ravePaymentSession->authModelUsed == "VBVSECURECODE") {}
    }

    public function validateBankPayment()
    {
        $ravePaymentSession = $this->ravePaymentSession;
        
        if ($ravePaymentSession->authh == "GTB") {
            // call the GTBANK validation
        } elseif ($ravePaymentSession->authh == "FBN") {
            // call first bank validation
        } elseif ($ravePaymentSession->authh == "OTP") {
            // Must have set the otp variable
            $this->otpbankValidate();
        }
    }

    /**
     * This method defines a bank OTP validation
     *
     * @throws \Exception
     * @return boolean
     */
    public function otpbankValidate()
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
        $client->setUri(RavePaymentService::RAVE_LIVE_URL . "flwv3-pug/getpaidx/api/validate");
        $client->setMethod("POST");
        $client->setHeaders(array(
            'Content-Type' => 'application/json'
            // 'Authorization' => $this->moneywaveSession->auth
        ));
        
        $data = array(
            "PBFPubKey" => RavePaymentService::RAVE_PUBLIC_KEY,
            "transactionreference" => $ravePaymentSession->flwRef,
            "otp" => $this->otp
        );
        
        $client->setRawBody(json_encode($data));
        $response = $client->send();
        if ($response->isSuccess()) {
            $body = json_decode($response->getBody());
            if ($body->data->chargeResponseCode == "00") {
                $ravePaymentSession->chargeResponseCode = $body->data->responsecode;
                $ravePaymentSession->acctvalrespcode = $body->data->acctvalrespcode;
                $ravePaymentSession->txRef = $body->data->txRef;
                // $ravePaymentSession->user_token = $body->data->tx->user_token;
                // $ravePaymentSession->embed_token = $body->data->tx->embed_token;
                $ravePaymentSession->id = $body->data->id;
                $transactionEntity = new Transaction();
                // Store the transaction into a database ;
                $transactionEntity->setCreatedOn(new \DateTime())
                    ->setInvoice($invoiceEntity)
                    ->setPaymentDate(new \DateTime())
                    ->setPaymentMode($em->find("Settings\Entity\PaymentMode", TransactionService::TRANSACTION_PAYMENT_MODE_FLUTTERWAVE))
                    ->setTransactStatus($em->find("Transactions\Entity\TransactionStatus", TransactionService::TRANSACTION_STATUS_SUCCESS))
                    ->setTransactUid($this->transactionService->generateTransactionUid());
                
                // Change the status of the invoice to either paying for micro or paid for non micro payment
                
                if ($invoiceEntity->getIsMicro()) {
                    $invoiceEntity->setStatus($em->find("Transactions\Entity\InvoiceStatus", InvoiceService::INVOICE_PAYING_STATUS));
                    // Get the actual micro payment
                    $micropaymentActiveSession = new Container("micropayment_active_session");
                    $microPaymentEntity = $em->find("Transactions\Entity\MicroPayment", $micropaymentActiveSession->id);
                    $microPaymentEntity->setStatus($em->find("Transactions\Entity\TransactionStatus", TransactionService::TRANSACTION_STATUS_SUCCESS));
                    $microPaymentEntity->setUpdatedOn(new \DateTime());
                    
                    $em->persist($microPaymentEntity);
                    $em->persist($invoiceEntity);
                } else {
                    $invoiceEntity->setStatus($em->find("Transactions\Entity\InvoiceStatus", InvoiceService::INVOICE_PAID_STATUS));
                    $em->persist($invoiceEntity);
                }
                
                // send a notification to the customers email for successful payment
                $userEntity = $em->find("CsnUser\Entity\User", $clientGeneralService->getUserId());
                $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $clientGeneralService->getBrokerId());
                $messagePointer['to'] = $userEntity->getEmail();
                $messagePointer['subject'] = "Succesful Payment";
                $messagePointer['fromName'] = $clientGeneralService->getBrokerName();
                
                $template['template'] = "";
                $template['var'] = array(
                    "logo" => $clientGeneralService->getBrokerLogo(),
                    "brokername " => $clientGeneralService->getBrokerName(),
                    "broker" => $brokerEntity
                );
                $generalService->sendMails($messagePointer, $template);
                
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            throw new \Exception("Validating your OTP came with some issue, please try again Latter");
        }
    }

    /**
     * This method defines a card OTP validation
     *
     * @throws \Exception
     * @return boolean
     */
    private function otpValidation()
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
        $client->setUri(RavePaymentService::RAVE_LIVE_URL . "flwv3-pug/getpaidx/api/validatecharge");
        $client->setMethod("POST");
        $client->setHeaders(array(
            'Content-Type' => 'application/json'
            // 'Authorization' => $this->moneywaveSession->auth
        ));
        
        $data = array(
            "PBFPubKey" => RavePaymentService::RAVE_PUBLIC_KEY,
            "transaction_reference" => $ravePaymentSession->flwRef,
            "otp" => $otp
        );
        
        $client->setRawBody(json_encode($data));
        $response = $client->send();
        if ($response->isSuccess()) {
            $body = json_decode($response->getBody());
            if ($body->data->data->responsecode == "00") {
                $ravePaymentSession->responseCode = $body->data->data->responsecode;
                $ravePaymentSession->chargeResponseCode = $body->data->tx->chargeResponseCode;
                $ravePaymentSession->chargeCurrency = $body->data->tx->currency;
                $ravePaymentSession->user_token = $body->data->tx->chargeToken->user_token;
                $ravePaymentSession->embed_token = $body->data->tx->chargeToken->embed_token;
                $transactionEntity = new Transaction();
                // Store the transaction into a database ;
                $transactionEntity->setCreatedOn(new \DateTime())
                    ->setInvoice($invoiceEntity)
                    ->setPaymentDate(new \DateTime())
                    ->setPaymentMode($em->find("Settings\Entity\PaymentMode", TransactionService::TRANSACTION_PAYMENT_MODE_FLUTTERWAVE))
                    ->setTransactStatus($em->find("Transactions\Entity\TransactionStatus", TransactionService::TRANSACTION_STATUS_SUCCESS))
                    ->setTransactUid($this->transactionService->generateTransactionUid());
                
                // Change the status of the invoice to either paying for micro or paid for non micro payment
                
                if ($invoiceEntity->getIsMicro()) {
                    $invoiceEntity->setStatus($em->find("Transactions\Entity\InvoiceStatus", InvoiceService::INVOICE_PAYING_STATUS));
                    // Get the actual micro payment
                    $micropaymentActiveSession = new Container("micropayment_active_session");
                    $microPaymentEntity = $em->find("Transactions\Entity\MicroPayment", $micropaymentActiveSession->id);
                    $microPaymentEntity->setStatus($em->find("Transactions\Entity\TransactionStatus", TransactionService::TRANSACTION_STATUS_SUCCESS));
                    $microPaymentEntity->setUpdatedOn(new \DateTime());
                    
                    $em->persist($microPaymentEntity);
                    $em->persist($invoiceEntity);
                } else {
                    $invoiceEntity->setStatus($em->find("Transactions\Entity\InvoiceStatus", InvoiceService::INVOICE_PAID_STATUS));
                    $em->persist($invoiceEntity);
                }
                
                // send a notification to the customers email for successful payment
                $userEntity = $em->find("CsnUser\Entity\User", $clientGeneralService->getUserId());
                $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $clientGeneralService->getBrokerId());
                $messagePointer['to'] = $userEntity->getEmail();
                $messagePointer['subject'] = "Succesful Payment";
                $messagePointer['fromName'] = $clientGeneralService->getBrokerName();
                
                $template['template'] = "";
                $template['var'] = array(
                    "logo" => $clientGeneralService->getBrokerLogo(),
                    "brokername " => $clientGeneralService->getBrokerName(),
                    "broker" => $brokerEntity
                );
                $generalService->sendMails($messagePointer, $template);
                
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            throw new \Exception("Validating your OTP came with some issue, please try again Latter");
        }
    }

    private function vbvValidation()
    {}

    /**
     * This funcion verfies the card payment made to the rave account
     * This is used to confirm that all transaction completed
     * And it is prequel to othe r relative transactions like transfer
     */
    public function verifyCardPayment()
    {
        $ravePaymentSession = $this->ravePaymentSession;
        $em = $this->entityManager;
        $generalService = $this->clientGeneralService->getGeneralService();
        $clientGeneralService = $this->clientGeneralService;
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
                    
                    
                    
                    //TODO  Send email to broker inidicating a transfer has been initiated also inicating the invoice paid for
                    // TODO Complete this email notification
                    $userEntity = $em->find("CsnUser\Entity\User", $clientGeneralService->getUserId());
                    $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $clientGeneralService->getBrokerId());
                    $messagePointer['to'] = $userEntity->getEmail();
                    $messagePointer['subject'] = "Customer Payment";
                    $messagePointer['fromName'] = "IMAPP CM"; // $clientGeneralService->getBrokerName();
                    
                    $template['template'] = "";
                    $template['var'] = array(
                        "logo" => $clientGeneralService->getBrokerLogo(),
                        "brokername " => $clientGeneralService->getBrokerName(),
                        "broker" => $brokerEntity
                    );
                    $generalService->sendMails($messagePointer, $template);
                    
                    // send a mail to child broker initcating the invoice paid for
                    // TODO Complete this email notification
                    $messagePointer['to'] = $userEntity->getEmail();
                    $messagePointer['subject'] = "Customer Payment";
                    $messagePointer['fromName'] = "IMAPP CM"; // $clientGeneralService->getBrokerName();
                    
                    $template['template'] = "";
                    $template['var'] = array(
                        "logo" => $clientGeneralService->getBrokerLogo(),
                        "brokername " => $clientGeneralService->getBrokerName(),
                        "broker" => $brokerEntity
                    );
                    $generalService->sendMails($messagePointer, $template);
                    
                    return TRUE; // meaning verification was successfull
                } else {
                    return FALSE; // meaning there was something wrong with the verification
                }
            } else {
                throw new \Exception("The verification process had some challenges");
            }
        }
        // Verify the card payment
        // Send a notification to the broker
        // copy the child broker(s)
        // If the
    }

    public function raveTransfer()
    {
        $em = $this->entityManager;
        $clientGeneralService = $this->clientGeneralService;
        $client = new Client();
        $client->setUri(RavePaymentService::RAVE_LIVE_URL . "v2/gpx/transfers/create");
        $client->setHeaders(array(
            'Content-Type' => 'application/json'
            // 'Authorization' => $this->moneywaveSession->auth
        ));
        $client->setMethod("POST");
        $post = array(
            "account_bank" => $this->transferBank,
            "account_number" => $this->transferAcc,
            "amount" => $this->transferAmount,
            "currency" => $this->transferCurrency,
            "seckey" => RavePaymentService::RAVE_SECRET_KEY,
            "reference" => $this->transferRef()
        );
        
        $client->setRawBody(json_encode($post));
        $response = $client->send();
        
        if ($response->isSuccess()) {
            $body = json_decode($response->getBody());
            if ($body->status == "success") {
                $raveTransfer = new RaveTransfer();
                $raveTransfer->setCreatedOn(new \DateTime())
                    ->setReference($body->data->reference)
                    ->setStatus($em->find("Transactions\Entity\RaveTransferStatus", RavePaymentService::RAVE_TRANSFER_STATUS_INITIATED))
                    ->setTransferId($body->data->id);
                $em->persist($raveTransfer);
                $em->flush();
                
                // send mail to broker about transafer initiated
                
                $generalService = $this->clientGeneralService->getGeneralService();
                
                $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $clientGeneralService->getBrokerId());
                $messagePointer['to'] = $brokerEntity->getUser()->getEmail();
                $messagePointer['subject'] = "Payout Initiated";
                $messagePointer['fromName'] = GeneralService::APP_NAME;
                
                $template['template'] = ""; // TODO - Define a payout initiated mail template
                $template['var'] = array(
                    "logo" => $generalService->getImappLogo(),
                    "brokername " => GeneralService::APP_COMPANY_NAME
                    // "broker" => $brokerEntity
                );
                $generalService->sendMails($messagePointer, $template);
            }
        } else {
            // hydrate dataase for error in transfer
            throw new \Exception("There was a problem connecting to the transaferserver");
        }
    }

    public function saveCard($user)
    {
        $em = $this->entityManager;
        $ravePaymentSession = $this->ravePaymentSession;
        // $client
        
        $raceCardTokenEntity = new RaveCardToken();
        $raceCardTokenEntity->setCardExpiryMonth($ravePaymentSession->cardExpiryMonth)
            ->setCardExpiryYear($ravePaymentSession->cardExpiryYear)
            ->setCreatedOn(new \DateTime())
            ->setCustomerPhone($ravePaymentSession->customerPhone)
            ->setEmbededToken($ravePaymentSession->embededToken)
            ->setLast4Digit($ravePaymentSession->last4Digit)
            ->setUser($user)
            ->setShortcode($ravePaymentSession->shortcode);
        
        $em->persist($raceCardTokenEntity);
        $em->flush();
    }

    public function chargeSavedCard()
    {}

    private function transferRef()
    {
        $const = "trsref";
        $code = \uniqid($const);
        return $code;
    }

    /**
     * This is a the card to be charged
     *
     * @param string $card            
     * @return mixed
     */
    private function cleanCard($card)
    {
        return str_replace(" ", "", trim($card));
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }

    public function setRavePaymentSession($sess)
    {
        $this->ravePaymentSession = $sess;
        return $this;
    }

    public function setCardNo($number)
    {
        $this->cardNo = $number;
        return $this;
    }

    public function setCardCvv($cvv)
    {
        $this->cardCvv = $cvv;
        return $this;
    }

    public function getCardMonth($mth)
    {
        $this->cardMonth = $mth;
        return $this;
    }

    public function setCardYear($year)
    {
        $this->cardYear = $year;
        return $this;
    }

    public function setCardPin($pin)
    {
        $this->cardPin = $pin;
        return $this;
    }

    public function setCurrency($cur)
    {
        $this->currency = $cur;
        return $this;
    }

    public function setAmount($am)
    {
        $this->amount = $am;
        return $this;
    }

    public function setCountry($count)
    {
        $this->country = $count;
        return $this;
    }

    public function setEmail($mail)
    {
        $this->email = $mail;
        return $this;
    }

    public function setPhoneNumber($num)
    {
        $this->phoneNumber = $num;
        return $this;
    }

    public function setFirstName($name)
    {
        $this->firstName = $name;
        return $this;
    }

    public function setLastName($name)
    {
        $this->lastName = $name;
        return $this;
    }

    public function setIp($ip)
    {
        $this->ip = $ip;
        return $this;
    }

    public function setTxRef($ref)
    {
        $this->txRef = $ref;
        return $this;
    }

    public function setOtp($otp)
    {
        $this->otp = $otp;
        return $this;
    }

    public function setBillingzip($zip)
    {
        $this->billingzip = $zip;
        return $this;
    }

    public function setBillingcity($city)
    {
        $this->billingcity = $city;
        return $this;
    }

    public function setBillingaddress($add)
    {
        $this->billingaddress = $add;
        return $this;
    }

    public function setBillingstate($state)
    {
        $this->billingstate = $state;
        return $this;
    }

    public function setBillingCountry($country)
    {
        $this->billingcountry = $country;
        return $this;
    }

    public function setClientGeneralService($xserv)
    {
        $this->clientGeneralService = $xserv;
        return $this;
    }

    public function setTransactionService($xserv)
    {
        $this->transactionService = $xserv;
        return $this;
    }

    public function setTransferBank($bank)
    {
        $this->transferBank = $bank;
        return $this;
    }

    public function setTransferAmount($amount)
    {
        $this->transferAmount = $amount;
        return $this;
    }

    public function setTransferCurrency($cur)
    {
        $this->transferCurrency = $cur;
        return $this;
    }

    public function setTransferAcc($acc)
    {
        $this->transferAcc = $acc;
        return $this;
    }

    public function setBank($bnk)
    {
        $this->bank = $bnk;
        return $this;
    }

    public function setAccountNumber($acc)
    {
        $this->accountNumber = $acc;
        return $this;
    }

    public function setPassCode($code)
    {
        $this->passcode = $code;
        return $this;
    }

    public function setRedirectUrl($url)
    {
        $this->redirect_url = $url;
        return $this;
    }
}

