<?php
namespace Transactions\Service;

use Zend\Http\Client;
use Zend\Json\Json;
use Zend\Session\Container;
use Transactions\Entity\MoneyWaveResponse;

/**
 *
 * @author otaba
 *        
 */
class MoneyWavePaymentService
{

    private $entityManager;

    private $clientGeneralService;

    private $moneywaveSession;

    private $userEntity;

    private $centralBrokerId;

    private $transactionEntity;

    private $moneyWaveResponse;

    // Set Variables
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

    private $otp;

    // Wallet details
    private $firstname;

    private $lastname;

    private $phonenumber;

    private $email;

    // private
    private $walletLock;

    private $walletSender;

    private $walletRef;

    const MONEYWAVE_PAYMENT_URI = "http://staging1flutterwave.co:8080/pwc/rest/card/mvva/pay";

    const PAYMENT_RESPONSE_SUCCESS = 1;

    const PAYMENT_RESPONSE_NOT_SUCCESS = 2;

    const MONEYWAVE_URL_REDIRECT = "https://cm.imapp.ng/board/payment";

    const MONEYWAVE_DASHBOARD_REDIRECT = "https://cm.imapp.ng/dashboard";

    const MONEYWAVE_LIVE_URI = "https://live.moneywaveapi.co/";

    /**
     */
    public function __construct()
    {
        
        // TODO - Insert your code here
    }

    /**
     * This function is called whenever there is a successful moneywave transaction
     */
    public function moneyWaveSuccess()
    {
        $em = $this->entityManager;
        $body = $this->moneyWaveResponse;
        $clientGeneralSession = $this->clientGeneralService->getGeneralSession();
        $invoiceId = $clientGeneralSession->InvoiceId;
        $transfer = $body->data->transfer;
        $monetwaveResponseEntity = new MoneyWaveResponse();
        $monetwaveResponseEntity->setCreatedOn(new \DateTime())
            ->setFlutterChargeReference($transfer->flutterChargeReference)
            ->setFlutterDisburseReference($transfer->flutterDisburseReference)
            ->setFlutterDisburseResponseCode($transfer->flutterDisburseResponseCode)
            ->setInvoice($em->find("Transactions\Entity\Invoice", $invoiceId))
            ->setIsCardValidationSuccessful($transfer->isCardValidationSuccessful)
            ->setIsDeliverySuccessFul($transfer->isDeliverySuccessful)
            ->setResponseId($transfer->id)
            ->setResponseType($transfer->type);
        // ->setTransaction($ra);
        
        $em->persist($monetwaveResponseEntity);
        $em->flush();
    }

    public function sendMoney()
    {
        $client = new Client();
        $this->calculateAmountPayable();
        $moneywavePayableSession = new Container("moneywave_payable_session");
        $userEntity = $this->userEntity;
        $client->setUri("https://live.moneywaveapi.co/v1/transfer");
        $client->setHeaders(array(
            'Content-Type' => 'application/json',
            'Authorization' => $this->moneywaveSession->auth
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
            "card_no" => $this->cleanCard($this->cardNo),
            "cvv" => $this->cvv,
            "pin" => $this->pin, // optional required when using VERVE card
            "expiry_year" => $this->expiryYear,
            "expiry_month" => $this->expiryMonth,
            // "charge_auth" => "PIN", // optional required where card is a local Mastercard
            "apiKey" => "lv_2F706LLSDY63CYFQRZRR",
            "amount" => $moneywavePayableSession->amountPayable,
            "narration" => $this->narration, // Optional
            "fee" => 100,
            "medium" => "web",
            "redirecturl" => MoneyWavePaymentService::MONEYWAVE_URL_REDIRECT
        );
        
        $client->setRawBody(Json::encode($post));
        $response = $client->send();
        if (! $response->isSuccess()) {
            throw new \Exception("There was a problem accessing the creating yor account");
        } elseif ($response->isSuccess()) {
            $body = Json::decode($response->getBody());
            if ($body->status == false) {
                throw new \Exception($body->message);
            } else {
                $respon = array(
                    "status" => true,
                    "response" => $response
                );
                
                return $respon;
            }
        }
        // $body = Json::decode($resp->getBody());
    }

    private function cleanCard($card)
    {
        return str_replace(" ", "", trim($card));
    }

    public function sendOtp()
    {
        $client = new Client();
        $client->setUri("https://live.moneywaveapi.co/v1/transfer/charge/auth/card");
        $client->setHeaders(array(
            'Content-Type' => 'application/json',
            'Authorization' => $this->moneywaveSession->auth
        ));
        // Explode Card Name
        $client->setMethod("POST");
        $this_moneywave_session = new Container("this_moneywave_session");
        $post = array(
            'transactionRef' => $this_moneywave_session->ref,
            'otp' => $this->otp
        );
        
        $client->setRawBody(Json::encode($post));
        $response = $client->send();
        if (! $response->isSuccess()) {
            throw new \Exception("There was a problem accessing the creating yor account");
        } elseif ($response->isSuccess()) {
            $body = Json::decode($response->getBody());
            if ($body->status == false) {
                throw new \Exception($body->message);
            } else {
                $respon = array(
                    "status" => true,
                    "response" => $response
                );
                
                return $respon;
            }
        }
    }

    // /**
    // * This function sends funds from the moneywave wallet
    // * This is in combination withh the rave pay
    // * such that if the recurrent bill of rave pay is successful,
    // * The broker becomes settled from the moneywave account
    // */
    // public function sendFromWallet()
    // {
    // $client = new Client();
    // $client->setUri("https://live.moneywaveapi.co/v1/disburse");
    // $client->setHeaders(array(
    // 'Content-Type' => 'application/json',
    // 'Authorization' => $this->moneywaveSession->auth
    // ));
    // $client->setMethod("POST");
    // $post = array(
    // "lock" => $this->walletLock,
    // "amount" => $this->amount,
    // "bankcode" => $this->moneyWaveBankCode,
    // "accountNumber" => $this->recipientsAcc,
    // "currency" => $this->currency,
    // "senderName" => $this->walletSender,
    // "narration" => $this->narration, // Optional
    // "ref" => $this->walletRef
    // );
    
    // $client->setRawBody(Json::encode($post));
    // $response = $client->send();
    // if (! $response->isSuccess()) {
    // throw new \Exception("There was a problem accessing the creating yor account");
    // } elseif ($response->isSuccess()) {
    // $body = Json::decode($response->getBody());
    // if ($body->status == false) {
    // throw new \Exception($body->message);
    // } else {
    // $respon = array(
    // "status" => true,
    // "response" => $response
    // );
    
    // return $respon;
    // }
    // }
    // }
    
    /**
     * This method defines charging a card and puttin it in a wallet
     *
     * @throws \Exception
     * @return string|boolean
     */
    public function cardToWallet()
    {
        $em = $this->entityManager;
        $moneywaveSession = $this->moneywaveSession;
        $client = new Client();
        $client->setUri(MoneyWavePaymentService::MONEYWAVE_LIVE_URI . "v1/transfer");
        $client->setMethod("POST");
        $client->setHeaders(array(
            'Content-Type' => 'application/json',
            'Authorization' => $this->moneywaveSession->auth
        ));
        
        $post = array(
            "firstname" => $this->firstname,
            "lastname" => $this->lastname,
            "email" => $this->email,
            "phonenumber" => $this->phonenumber,
            "recipient" => "wallet",
            "card_no" => $this->cardNo,
            "cvv" => $this->cvv,
            "pin" => $this->pin,
            "expiry_year" => "20" . $this->expiryYear,
            "expiry_month" => $this->expiryMonth,
            // "charge_auth"=>"PIN",
            
            "recipient_id" => "", // TODO Configure it to the user_ref
            "apiKey" => "lv_2F706LLSDY63CYFQRZRR",
            "amount" => $this->amount,
            "fee" => "0",
            "redirecturl" => MoneyWavePaymentService::MONEYWAVE_DASHBOARD_REDIRECT,
            "medium" => "web"
        
        );
        
        $client->setRawBody(json_encode($post));
        $response = $client->send();
        if ($response->isSuccess()) {
            $this_moneywave_session = new Container("this_moneywave_session");
            $body = json_decode($response->getBody());
            if ($body->status == "success" && $body->data->transfer->flutterChargeResponseCode == "02") {
                $this_moneywave_session->ref = $body->data->transfer->flutterChargeReference;
                // $moneywaveSession->
                
                return "OTP";
            } elseif ($body->status == "success" && $body->data->transfer->flutterChargeResponseCode == "00") {
                return TRUE;
            } elseif ($body->status == "error" && $body->data->transfer->flutterChargeResponseCode == "02") {
                throw new \Exception($body->message);
            }
        } else {
            throw new \Exception("We could not connect to payment Server. please try again latter");
        }
    }

    /**
     * This function caluculates the amount payable to brokers
     * by removing all charges on the account
     */
    public function calculateAmountPayable()
    {
        // $amountPayable = ($amount-100)/1.03;
        // return $amountPayable;
        $payableSession = new Container("moneywave_payable_session"); // This is a session of the calucalated
        
        $payableSession->imappComission = $this->amount * 0.03;
        $payableSession->imappflatDeductible = 155;
        $payableSession->amountPayable = ($this->amount - ($payableSession->imappComission + $payableSession->imappflatDeductible));
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

    public function setOtp($otp)
    {
        $this->otp = $otp;
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
        $name['middle_name'] = (isset($parts[2])) ? $parts[1] : '.';
        $name['last_name'] = (isset($parts[2])) ? $parts[2] : (isset($parts[1]) ? $parts[1] : 'IMAPP');
        
        return $name;
    }

    // Begin Card Setters
    
    // Begin Setters
    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }

    public function setMoneyWaveSession($wave)
    {
        $this->moneywaveSession = $wave;
        return $this;
    }

    public function setMoneyWaveResponse($res)
    {
        $this->moneyWaveResponse = $res;
        return $this;
    }

    public function setUserEntity($user)
    {
        $this->userEntity = $user;
        return $this;
    }

    public function setWalletLock($lock)
    {
        $this->walletLock = $lock;
        return $this;
    }

    public function setWalletSender($send)
    {
        $this->walletSender = $send;
        return $this;
    }

    public function setWalletRef($ref)
    {
        $this->walletRef = $ref;
        return $this;
    }

    public function setClientGeneralService($xserv)
    {
        $this->clientGeneralService = $xserv;
        return $this;
    }
    
    public function setFirstname($name){
        $this->firstname = $name;
        return $this;
    }
    
    public function setLastname($name){
        $this->lastname = $name;
        return $this;
    }
    
    public function setEmail($mail){
        $this->email  = $mail;
        return $this;
    }
    
    public function setPhonenumber($num){
        $this->phonenumber = $num;
        return $this;
    }
    
    
}

