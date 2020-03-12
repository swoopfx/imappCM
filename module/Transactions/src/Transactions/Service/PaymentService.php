<?php
namespace Transactions\Service;

use GeneralServicer\Service\FlutterwaveService;
use Zend\Http\Client;
use Zend\Json\Json;
use Transactions\Entity\Transaction;
use Transactions\Entity\Invoice;
use Transactions\Entity\FlutterwaveResponse;
use GeneralServicer\Service\CurrencyService;
use Zend\Http\Request;


/**
 *
 * @author swoopfx
 *        
 */
class PaymentService
{

    private $invoiceService;

    private $entityManager;

    private $user;

    private $userId;

    private $transactEntity;

    private $transactionService;

    private $invoiceEntity;

    private $brokerSubEntity;

    private $paymentServiceCrypt;

    private $amount;

    private $authModel;

    private $cardNo;

    private $narration;

    private $merchantId;

    private $expiryYear;

    private $expiryMonth;

    private $cvv;

    private $country;

    private $customerId;

    private $currency;

    private $cardName;

    private $pin;

    private $recipientsAcc;

    private $moneyWaveBankCode;

    private $centralBrokerId;

    private $mailService;

    private $generalService;

    private $invoiceId;

    private $customerInvoiceId;

    private $flashMessage;

    private $redirect;

    private $currencyFormat;

    private $moneyWaveSession;

    private $otp;

    /**
     */
    private $customerBrokerId;

    const FLUTTERWAVE_PAYMENT_URI = "http://staging1flutterwave.co:8080/pwc/rest/card/mvva/pay";

    const PAYMENT_RESPONSE_SUCCESS = 1;

    const PAYMENT_RESPONSE_NOT_SUCCESS = 2;

    const MONEYWAVE_AUTH = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MTg3OCwibmFtZSI6ImktTWFuYWdlciBTb2x1dGlvbnMiLCJhY2NvdW50TnVtYmVyIjoiIiwiYmFua0NvZGUiOiI5OTkiLCJpc0FjdGl2ZSI6dHJ1ZSwiZW52aXJvbm1lbnQiOiJsaXZlIiwiY2FuX2dvbGl2ZSI6dHJ1ZSwiY291bnRkb3duIjpudWxsLCJjb21wbGlhbmNlIjo5LCJjcmVhdGVkQXQiOiIyMDE3LTEwLTEwVDIzOjE5OjAyLjAwMFoiLCJ1cGRhdGVkQXQiOiIyMDE3LTExLTA3VDE2OjUzOjM3LjAwMFoiLCJkZWxldGVkQXQiOm51bGwsImlhdCI6MTUxMDA4MzkyMywiZXhwIjoxNTEwMDkxMTIzfQ.5ADpO3zgdGS3Dvls5pOQAokwmWvEOn8s2YLD1vW9UdY";

    public function __construct()
    {
        
        // TODO - Insert your code here
    }

    /**
     * This function handles the payment of setup for brokers
     * The data invcludes invoice Id
     * SubscripptionId
     */
    public function brokerSetupPayment($data)
    {
        $em = $this->entityManager;
        $httpClient = new Client();
    }

    public function payImapp()
    {
        $res = $this->flutterwavePaymentProcess();
        return $res;
    }

    /**
     * This function sends a mail for a successful transaction
     */
    public function imappPaymentEmail($to, $transactionEntity, $channel = "E-Payment")
    {
        $mailService = $this->mailService;
        $urlViewHelper = $this->generalService->getUrlViewHelper();
        $varArray = array(
            "logo" => $urlViewHelper('user-index', array(), array(
                'force_canonical' => true
            )) . "images/logow.png",
            "totalPaid" => $transactionEntity->getInvoice()->getAmount(),
            "service" => $this->currencyFormat(($transactionEntity->getInvoice()
                ->getAmount() / 1.05), $transactionEntity->getInvoice()
                ->getCurrency()
                ->getCode()),
            'vat' => $this->currencyFormat(($transactionEntity->getInvoice()
                ->getAmount() / 0.05), $transactionEntity->getInvoice()
                ->getCurrency()
                ->getCode()),
            "receiptNo" => $transactionEntity->getransactUid(),
            "invoiceNo" => $transactionEntity->getInvoice()->getInvoiceUid(),
            "brokerName" => $$transactionEntity->getInvoice()
                ->getCustomer()
                ->getCustomerBroker()
                ->getBroker()
                ->getBrokerName(),
            "channel" => $channel,
            "narration" => $this->narrationCondition($transactionEntity->getInvoice()
                ->getInvoiceCategory()
                ->getId())
        
        );
        
        $mailService = $this->mailService;
        $mailService->getMessage()
            ->addTo($to)
            ->setFrom("info@imapp.ng", "IMAPP CM");
        $mailService->setTemplate("general-broker-receipt", $varArray)->setSubject("IMAPP CM : PAYMENT RECEIPT");
        $mailService->send();
    }

    private function narrationCondition($invoiceCat)
    {
        switch ($invoiceCat) {
            case InvoiceService::INVOICE_CAT_BROKER_SUB:
                return "This is full payment for subscription ";
                break;
            
            case InvoiceService::INVOICE_CAT_SMS_SUB:
                return "This is payment for SMS credits";
                break;
            
            case InvoiceService::INVOICE_CAT_ADVERT:
                
                return "This is full payment for advert services";
                break;
            default:
                return "Full payment for services";
                break;
        }
    }

    private function invoiceProcessing()
    {
        $em = $this->entityManager;
        if ($this->invoiceId != NULL) {
            $invoice = $em->find("Transactions\Entity\Invoice", $this->invoiceId);
        } else {
            $invoice = new Invoice();
            $invoice->setInvoiceUid($this->invoiceService->generateInvoiceNumber());
            $invoice->setGeneratedOn(new \DateTime());
            $invoice->setAmount($this->amount);
            $invoice->setExpiryDate(new \DateTime());
        }
        
        $invoice->setInvoiceCategory($em->find("Transactions\Entity\InvoiceCategory", InvoiceService::INVOICE_CAT_SMS_SUB));
        $invoice->setCurrency($em->find("Settings\Entity\Currency", CurrencyService::NIGERIA_NAIRA));
        
        return $invoice;
    }

    private function transactionProcess()
    {
        $em = $this->entityManager;
        $transaction = new Transaction();
        $transaction->setCreatedOn(new \DateTime());
        $transaction->setInvoice($this->invoiceProcessing());
        $transaction->setPaymentDate(new \DateTime());
        $transaction->setPaymentMode($em->find());
        return $transaction;
    }

    public function brokerPaymentProcess()
    {
        $em = $this->entityManager;
        $mail = $this->mailService;
        $response = $this->brokerFlutterPay();
        if ($response->isSuccess()) {
            $body = Json::decode($response->getBody());
            $flutterResponseCode = $body->data->responsecode;
            $flutterStatus = $body->status;
            if ($flutterResponseCode == "00") {
                
                $flutterResponseMessage = $body->data->responsemessage;
                $flutterResponseToken = $body->data->responsetoken;
                $flutterResponseTrasactRefernce = $body->data->transactionreference;
                $flutterResponseOtptransactionidentifier = $body->data->otptransactionidentifier;
                
                $invoiceEntity = $em->find("Transactions\Entity\Invoice", $this->customerInvoiceId);
                $invoiceEntity->setModifiedOn(new \DateTime())->setStatus($em->find("Transactions\Entity\InvoiceStatus", InvoiceService::INVOICE_PAID_STATUS));
                
                $transactionEntity = new Transaction();
                $transactionEntity->setCreatedOn(new \DateTime())
                    ->setInvoice($invoiceEntity)
                    ->setPaymentDate(new \DateTime())
                    ->setPaymentMode($em->find("Settings\Entity\PaymentMode", TransactionService::TRANSACTION_PAYMENT_MODE_FLUTTERWAVE))
                    ->setTransactStatus($em->find("Transactions\Entity\TransactionStatus", TransactionService::TRANSACTION_STATUS_SETTLED))
                    ->setTransactUid($this->transactionService->generateTransactionUid());
                
                $flutterResponse = new FlutterwaveResponse();
                $flutterResponse->setDateCreated(new \DateTime())
                    ->setOtptransactionidentifier($flutterResponseOtptransactionidentifier)
                    ->setResponseCode($flutterResponseCode)
                    ->setResponseMessage($flutterResponseMessage)
                    ->setResponseToken($flutterResponseToken)
                    ->setTransaction($transactionEntity)
                    ->setTransactionReference($flutterResponseTrasactRefernce);
                
                try {
                    $em->persist($invoiceEntity);
                    $em->persist($transactionEntity);
                    $em->persist($flutterResponse);
                    $em->flush();
                    
                    return array(
                        "status" => PaymentService::PAYMENT_RESPONSE_SUCCESS,
                        "response" => $flutterResponse
                    );
                } catch (\Exception $e) {
                    return array(
                        "status" => PaymentService::PAYMENT_RESPONSE_NOT_SUCCESS,
                        "message" => "Technoical Error"
                    );
                }
            } else {
                return PaymentService::PAYMENT_RESPONSE_NOT_SUCCESS;
            }
        }
    
    /**
     * Get Broker Entity
     */
    }

    public function flutterwavePaymentProcess()
    {
        $em = $this->entityManager;
        $mail = $this->mailService;
        $user = $this->user;
        $response = $this->flutterwavePay();
        
        if ($response->isSuccess()) {
            
            $body = Json::decode($response->getBody());
            $flutterResponseCode = $body->data->responsecode;
            $flutterStatus = $body->status;
            
            if ($flutterResponseCode == "00") {
                
                $flutterResponseMessage = $body->data->responsemessage;
                $flutterResponseToken = $body->data->responsetoken;
                $flutterResponseTrasactRefernce = $body->data->transactionreference;
                $flutterResponseOtptransactionidentifier = $body->data->otptransactionidentifier;
                
                $invoice = $this->invoiceProcessing();
                $transaction = $this->transactionProcess();
                
                $flutterResponse = new FlutterwaveResponse();
                $flutterResponse->setTransaction($transaction)
                    ->setDateCreated(new \DateTime())
                    ->setResponseCode($flutterResponseCode)
                    ->setResponseMessage($flutterResponseMessage)
                    ->setResponseToken($flutterResponseToken)
                    ->setTransactionReference($flutterResponseTrasactRefernce)
                    ->setOtptransactionidentifier($flutterResponseOtptransactionidentifier);
                
                try {
                    $em->persist($invoice);
                    $em->persist($transaction);
                    $em->persist($flutterResponse);
                    $em->flush();
                    
                    // $mail->setTemplate("email/receipt", array(
                    // 'imappLogo' => $this->generalService->getImappLogo(),
                    // 'currency' => '',
                    // 'totalPaid' => $this->amount,
                    // 'brokerName' => $this->generalService->getyBroker()
                    // ->getBrokerName()
                    // ));
                    // $mail->setSubject("IMAPP Receipt")->addTo($user->getEmail());
                    // $mail->send();
                    // send reciept of payment to the actual broker making payment
                    
                    return true;
                } catch (\Exception $e) {
                    
                    // $this->flashMessage->addErrorMessage("Payment was successful but could not be hydrated");
                    echo "Something went wrong";
                    return false;
                }
            } else {
                $this->flashMessage->addErrorMessage("The transaction was denied");
                // $this->redirect->toRoute('user_broker', array(
                // 'action' => 'info'
                // ));
            }
        } else {
            // $this->flashMessage->addErrorMessage("Transaction Denied");
            echo "Could not connect to payment gateway";
            return false;
        }
    }

    /**
     * This process the flutterwave payment for brokers
     *
     * @return \Zend\Http\Response
     */
    private function brokerFlutterPay()
    
    {
        
        $em = $this->entityManager;
        $paymentCrypt = $this->paymentServiceCrypt;
        
        $customerBrokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $this->customerBrokerId);
        $brokerMerchantId = $customerBrokerEntity->getBrokerFlutterwaveAccount()->getMerchatId();
        
        $brokerEncrptyKey = $customerBrokerEntity->getBrokerFlutterwaveAccount()->getEncryptKey();
        
        $client = new Client();
        $client->setUri("http://staging1flutterwave.co:8080/pwc/rest/card/mvva/pay");
        
        $en_amount = $paymentCrypt->encrypt3Des($this->amount, $brokerEncrptyKey);
        $en_card_no = $paymentCrypt->encrypt3Des($this->cardNo, $brokerEncrptyKey);
        $en_card_exp_mth = $paymentCrypt->encrypt3Des($this->expiryMonth, $brokerEncrptyKey);
        $en_card_exp_year = $paymentCrypt->encrypt3Des($this->expiryYear, $brokerEncrptyKey);
        $en_card_cvv = $paymentCrypt->encrypt3Des($this->cvv, $brokerEncrptyKey);
        $en_custId = $paymentCrypt->encrypt3Des($this->customerId, $brokerEncrptyKey);
        $en_currency = $paymentCrypt->encrypt3Des($this->currency, $brokerEncrptyKey);
        $en_country = $paymentCrypt->encrypt3Des(FlutterwaveService::FLUTTERWAVE_COUNTRY, $brokerEncrptyKey);
        $en_authModel = $paymentCrypt->encrypt3Des(FlutterwaveService::FLUTTERWAVE_AUTH_METHOD, $brokerEncrptyKey);
        $en_narration = $paymentCrypt->encrypt3Des($this->narration, $brokerEncrptyKey);
        
        $client->setHeaders(array(
            'Content-Type' => 'application/json'
            // 'Authorization' => 'Basic SS1NYW5hZ2VyOk9sdXdhc2V1bjFA'
        ));
        
        $client->setMethod(Request::METHOD_POST);
        $post = array(
            "amount" => $en_amount,
            "authmodel" => $en_authModel,
            "cardno" => $en_card_no,
            "narration" => $en_narration,
            "merchantid" => $brokerMerchantId,
            "expiryyear" => $en_card_exp_year,
            "expirymonth" => $en_card_exp_mth,
            "cvv" => $en_card_cvv,
            "country" => $en_country,
            "custid" => $en_custId,
            "currency" => $en_currency
        );
        // var_dump($post);
        $client->setRawBody(Json::encode($post));
        
        $response = $client->send();
        
        return $response;
    }

    /**
     * This function pays I-Manager Solutions
     */
    public function imappPay()
    {}

    /**
     * This function pays Brokers
     */
    public function brokerPay()
    {}
    /**
     * This function caluculates the amount payable to brokers 
     * by removing all  charges on the account 
     */
    public function calculateAmountPayable($amount){
        $amountPayable =  ($amount-100)/1.014;
        return $amountPayable;
    }

    // Begin Money wave proccessing 
    /**
     * This function calls the Money wave payment API 
     *  and provides a http response
     * @return mixed|void|array|stdClass|NULL|boolean|number|string|unknown
     */
    public function moneywavePay()
    {
        $userEntity = $this->user;
        $client = new Client();
        $client->setUri("https://live.moneywaveapi.co/v1/transfer");
        $client->setHeaders(array(
            'Content-Type' => 'application/json',
            'Authorization' => $this->moneyWaveSession->auth
        ));
        // Explode Card Name
        $client->setMethod("POST");
        $splitName = $this->splitFullName($this->cardName);
        $firstName = $splitName['first_name'];
        $lastName = $splitName['last_name'];
        $post = array(
            "firstname" => $firstName,
            "lastname" => $lastName,
            "email" => $userEntity->getEmail(),
            "phonenumber" => $userEntity->getUserName(),
            "recipient_bank" => $this->moneyWaveBankCode,
            "recipient_account_number" => $this->recipientsAcc,
            "card_no" => $this->cardNo,
            "cvv" => $this->cvv,
            "pin" => $this->pin, // optional required when using VERVE card
            "expiry_year" => $this->expiryYear,
            "expiry_month" => $this->expiryMonth,
            "charge_auth" => "PIN", // optional required where card is a local Mastercard
            "apiKey" => "lv_2F706LLSDY63CYFQRZRR",
            "amount" => $this->calculateAmountPayable($this->amount),
            "narration" => $this->narration, // Optional
            "fee" => 45,
            "medium" => "web",
            "redirecturl" => "https://google.com"
        );
        
        $client->setRawBody(Json::encode($post));
        $resp = $client->send();
        $body = Json::decode($resp->getBody());
        if($resp->isSuccess()){
            $this->moneyWaveSession->refCode = $body->data->transfer->flutterChargeReference;
        }
        
        return $body;
    }

    public function moneyWaveOtpConfirmation()
    {
        $client = new Client();
        $client->setUri("https://live.moneywaveapi.co/v1/transfer/charge/auth/card");
        $client->setHeaders(array(
            'Content-Type' => 'application/json',
            'Authorization' => $this->moneyWaveSession->auth
        ));
        $client->setMethod("POST");
        $post = array(
            'transactionRef' => $this->moneyWaveSession->refCode,
            'otp' => $this->otp
        );
        
        $client->setRawBody(Json::encode($post));
        $resp = $client->send();
        $body = Json::decode($resp->getBody());
        return $body;
    }

    public function fetchAccountName()
    {
        $client = new Client();
        $client->setUri("https://live.moneywaveapi.co/v1/resolve/account");
        $client->setMethod("POST");
        $client->setHeaders(array(
            'Content-Type' => 'application/json',
            'Authorization' => $this->moneyWaveSession->auth
        ));
        
        $post = array(
            "account_number" => $this->recipientsAcc,
            "bank_code" => $this->moneyWaveBankCode
        );
        
        $client->setRawBody(Json::encode($post));
        $resp = $client->send();
        $body = Json::decode($resp->getBody());
        return $body;
    }
    
    // End MoneyWave Processing 
    
    private function cleanExpiryYear(){
        
    }

    private function splitFullName($name)
    {
        $parts = array();
        
        while (strlen(trim($name)) > 0) {
            $name = trim($name);
            $string = preg_replace('#.*\s([\w-]*)$#', '$1', $name);
            $parts[] = $string;
            $name = trim(preg_replace('#' . $string . '#', '', $name));
        }
        
        if (empty($parts)) {
            return false;
        }
        
        $parts = array_reverse($parts);
        $name = array();
        $name['first_name'] = $parts[0];
        $name['middle_name'] = (isset($parts[2])) ? $parts[1] : '';
        $name['last_name'] = (isset($parts[2])) ? $parts[2] : (isset($parts[1]) ? $parts[1] : '');
        
        return $name;
    }

    private function flutterwavePay()
    {
        $paymentCrypt = $this->paymentServiceCrypt;
        $client = new Client();
        $client->setUri(PaymentService::FLUTTERWAVE_PAYMENT_URI);
        // $client->setAdapter('Zend\Http\Client\Adapter\Curl');
        $en_amount = $paymentCrypt->encrypt3Des($this->amount, FlutterwaveService::FLUTTERWAVE_ENCRYPT_KEY);
        $en_card_no = $paymentCrypt->encrypt3Des($this->cardNo, FlutterwaveService::FLUTTERWAVE_ENCRYPT_KEY);
        $en_card_exp_mth = $paymentCrypt->encrypt3Des($this->expiryMonth, FlutterwaveService::FLUTTERWAVE_ENCRYPT_KEY);
        $en_card_exp_year = $paymentCrypt->encrypt3Des($this->expiryYear, FlutterwaveService::FLUTTERWAVE_ENCRYPT_KEY);
        $en_card_cvv = $paymentCrypt->encrypt3Des($this->cvv, FlutterwaveService::FLUTTERWAVE_ENCRYPT_KEY);
        $en_custId = $paymentCrypt->encrypt3Des($this->customerId, FlutterwaveService::FLUTTERWAVE_ENCRYPT_KEY);
        $en_currency = $paymentCrypt->encrypt3Des($this->currency, FlutterwaveService::FLUTTERWAVE_ENCRYPT_KEY);
        $en_country = $paymentCrypt->encrypt3Des(FlutterwaveService::FLUTTERWAVE_COUNTRY, FlutterwaveService::FLUTTERWAVE_ENCRYPT_KEY);
        $en_authModel = $paymentCrypt->encrypt3Des(FlutterwaveService::FLUTTERWAVE_AUTH_METHOD, FlutterwaveService::FLUTTERWAVE_ENCRYPT_KEY);
        $en_narration = $paymentCrypt->encrypt3Des($this->narration, FlutterwaveService::FLUTTERWAVE_ENCRYPT_KEY);
        
        $client->getRequest()
            ->getHeaders()
            ->addHeaders(array(
            'Content-Type' => 'application/json'
        ));
        $client->setMethod("POST");
        $post = array(
            "amount" => $en_amount,
            "authmodel" => $en_authModel,
            "cardno" => $en_card_no,
            "narration" => $en_narration,
            "merchantid" => FlutterwaveService::FLUTTERWAVE_MERCHANTID,
            "expiryyear" => $en_card_exp_year,
            "expirymonth" => $en_card_exp_mth,
            "cvv" => $en_card_cvv,
            "country" => $en_country,
            "custid" => $en_custId,
            "currency" => $en_currency
        );
        $client->setRawBody(Json::encode($post));
        
        $response = $client->send();
        return $response;
    }

    public function getAllAmanualPayment()
    {
        $em = $this->entityManager;
        $data = $em->getRepository("Transactions\Entity\Transaction")->findAllManulaPayment($this->centralBrokerId);
        // var_dump($this->centralBrokerId);
        return $data;
    }

    // Begin Local Setters
    public function setOtp($otp)
    {
        $this->otp = $otp;
        return $this;
    }

    public function setCustomerInvoiceId($inv)
    {
        $this->customerInvoiceId = $inv;
        return $this;
    }

    public function setCustomerBrokerId($broker)
    {
        $this->customerBrokerId = $broker;
        return $this;
    }

    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    public function setCvv($cvv)
    {
        $this->cvv = $cvv;
        return $this;
    }

    public function setPin($pin)
    {
        $this->pin = $pin;
        return $this;
    }

    public function setCustomerId($custId)
    {
        $this->customerId = $custId;
        return $this;
    }

    public function setExpireMonth($mth)
    {
        $this->expiryMonth = $mth;
        return $this;
    }

    public function setExpireYear($yesr)
    {
        $this->expiryYear = $yesr;
        return $this;
    }

    public function setCardName($name)
    {
        $this->cardName = $name;
        return $this;
    }

    public function setCardNo($number)
    {
        $this->cardNo = $number;
        return $this;
    }

    public function setNarration($narration)
    {
        $this->narration = $narration;
        return $this;
    }

    public function setCurrency($currency)
    {
        $this->currency = $currency;
        return $this;
    }

    public function getCustomerId()
    {
        return $this->customerId;
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    public function getCvc()
    {
        return $this->cvv;
    }

    public function getCardNo()
    {
        return $this->cardNo;
    }

    public function setRecipientsAcc($acc)
    {
        $this->recipientsAcc = $acc;
        return $this;
    }

    public function setMoneyWaveBankCode($code)
    {
        $this->moneyWaveBankCode = $code;
        return $this;
    }

    // End Loca setters
    
    // Begin Setters
    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }

    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    public function setTransactEntity($entity)
    {
        $this->transactEntity = $entity;
        return $this;
    }

    public function setInvoiceEntity($entity)
    {
        $this->invoiceEntity = $entity;
        return $this;
    }

    public function setBrokerSubEntity($entity)
    {
        $this->brokerSubEntity = $entity;
        return $this;
    }

    public function setPaymentServiceCrypt($crypt)
    {
        $this->paymentServiceCrypt = $crypt;
        return $this;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
        return $this;
    }

    public function setMailService($xserv)
    {
        $this->mailService = $xserv;
        return $this;
    }

    public function setGeneralService($xserv)
    {
        $this->generalService = $xserv;
        return $this;
    }

    public function setCentralBrokerId($id)
    {
        $this->centralBrokerId = $id;
        return $this;
    }

    public function setInvoiceId($id)
    {
        $this->invoiceId = $id;
        return $this;
    }

    public function setFlashMessager($xserv)
    {
        $this->flashMessage = $xserv;
        return $this;
    }

    public function setRedirect($red)
    {
        $this->redirect = $red;
        return $this;
    }

    public function setInvoiceService($xserv)
    {
        $this->invoiceService = $xserv;
        return $this;
    }

    public function setTransactionService($xserv)
    {
        $this->transactionService = $xserv;
        return $this;
    }

    public function setCurrencyFormat($form)
    {
        $this->currencyFormat = $form;
        return $this;
    }

    public function setMoneyWaveSession($sess)
    {
        $this->moneyWaveSession = $sess;
        return $this;
    }
    
    // End Setters
}

