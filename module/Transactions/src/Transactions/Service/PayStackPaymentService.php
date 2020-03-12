<?php
namespace Transactions\Service;

use Zend\Http\Client;
use Zend\Http\Request;
use Zend\Json\Json;

/**
 *
 * @author otaba
 *        
 */
class PayStackPaymentService
{

    private $entityManager;

    private $userId;

    private $invoiceService;

    private $centralBrokerId;

    private $businessName;

    private $settlementBank;

    private $myCurrencyFormat;

    private $accountNumber;

    private $percentageCharge;

    // Begin card details
    private $cardNo;

    private $cardName;

    private $cardCvv;

    private $cardPin;

    private $cardMonth;

    private $cardYear;

    private $amount;
    
    private $reference;
    
    private $otp;
    
    private $paystackAuth;

    const PAYSTACK_LIVE_SECRET_KEY = "";

    const PAYSTACK_SECRET_KEY = "sk_test_22d2f0571470b5da62a508d1338feab9e19ec0a6";

    const PAYSTACK_CHARGE_CARD = "https://api.paystack.co/charge";

    const PAYSTACK_INITIALIZE_TRANSACTION = "https://api.paystack.co/transaction/initialize";

    const PAYSTACK_CREATE_SUB_ACCOUNT = "https://api.paystack.co/subaccount";

    // const PAYSTCK_UPDATE_SUB_ACCOUNT = "http://api.paystack.co/subaccount/";
    
    /**
     */
    public function __construct()
    {
        $this->percentageCharge = 3; // indicates 3%
    }

    public function payStackCreateSubAccount()
    {
        $em = $this->entityManager;
        $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $this->centralBrokerId);
        $client = new Client();
        $client->setUri("https://api.paystack.co/subaccount", array(
            'adapter' => 'Zend\Http\Client\Adapter\Curl'
        ));
        $client->setHeaders(array(
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . PayStackPaymentService::PAYSTACK_SECRET_KEY
        ));
        
        $client->setMethod(Request::METHOD_POST);
        $post = array(
            "business_name" => $this->businessName,
            "settlement_bank" => $this->settlementBank,
            "account_number" => $this->accountNumber,
            "percentage_charge" => $this->percentageCharge, // set as 3%
            "primary_contact_email" => $brokerEntity->getUser()->getEmail(),
            "primary_contact_name" => $brokerEntity->getCompanyName(),
            "primary_contact_phone" => $brokerEntity->getUser()->getUsername(),
            "settlement_schedule" => "auto"
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
                return $respon = array(
                    "status" => true,
                    "response" => $response
                );
            }
        }
    }
    
    public function sendOtp(){
        $em = $this->entityManager;
        $client = new Client();
        $client->setUri("https://api.paystack.co/charge/submit_otp", array(
            'adapter' => 'Zend\Http\Client\Adapter\Curl'
        ));
        $client->setHeaders(array(
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . PayStackPaymentService::PAYSTACK_SECRET_KEY
        ));
        $client->setMethod(Request::METHOD_POST);
        $post = array(
            "otp"=>$this->otp,
            "reference"=>$this->reference,
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
                return $respon = array(
                    "status" => true,
                    "response" => $response
                );
            }
        }
    }

    public function cardCharge()
    {
        $em = $this->entityManager;
        $userEntity = $em->find("CsnUser\Entity\User", $this->userId);
        $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $this->centralBrokerId);
        $client = new Client();
        $client->setUri("https://api.paystack.co/subaccount", array(
            'adapter' => 'Zend\Http\Client\Adapter\Curl'
        ));
        $client->setHeaders(array(
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . PayStackPaymentService::PAYSTACK_SECRET_KEY
        ));
        
        $client->setMethod(Request::METHOD_POST);
        $post = array(
            "email" => $userEntity->getEmail(),
            "amount" => $this->cleanAmount($this->amount),
            "metadata" => array(
                "custom_fields" => array(
                    "variable_name"=>$this->cardName
                )
            ),
            "card" => array(
                "cvv" => $this->cardCvv,
                "number" => $this->cardNo,
                "expiry_month" => $this->cardMonth,
                "expiry_year" => $this->cardYear
            ),
            " pin" => $this->cardPin
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
                return $respon = array(
                    "status" => true,
                    "response" => $response
                );
            }
        }
    }

    public function bankCharge()
    {}

    public function authCharge()
    {
        $em = $this->entityManager;
        $userEntity = $em->find("CsnUser\Entity\User", $this->userId);
        $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $this->centralBrokerId);
        $client = new Client();
        $client->setUri("https://api.paystack.co/subaccount", array(
            'adapter' => 'Zend\Http\Client\Adapter\Curl'
        ));
        $client->setHeaders(array(
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . PayStackPaymentService::PAYSTACK_SECRET_KEY
        ));
        
        $client->setMethod(Request::METHOD_POST);
        $post = array(
            
            'email'=>$userEntity->getEmail(),
            'amount'=>$this->cleanAmount($this->amount),
            "metadata" => array(
                "custom_fields" => array(
                    "variable_name"=>$this->cardName
                )
            ),
        'authorization_code'=>$this->paystackAuth,
        'pin'=>$this->cardPin,
            
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
                return $respon = array(
                    "status" => true,
                    "response" => $response
                );
            }
        }
    }
    
    public function sedOtp(){
        
    }

    private function cleanAmount($amount)
    {
        return $amount * 100;
    }

    public function brokerPay()
    {
        $em = $this->entityManager;
        $client = new Client();
        $userEntity = $em->find("CsnUser\Entity\User", $this->centralBrokerId);
        $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $this->centralBrokerId);
        $client->setUri(PayStackPaymentService::PAYSTACK_INITIALIZE_TRANSACTION)->setHeaders(array(
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . PayStackPaymentService::PAYSTACK_SECRET_KEY
        ));
        
        $post = array(
            "email" => $userEntity->getEmail(),
            "amount" => $this->cleanAmount($this->amount),
            "card" => array(
                "number" => $this->cardNo,
                "cvv" => $this->cardCvv,
                "expiry_month" => $this->cardMonth,
                "expiry_year" => $this->cardYear
            ),
            "pin" => $this->cardPin
        
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
                return $respon = array(
                    "status" => true,
                    "response" => $response
                );
            }
        }
    }

    /**
     * This handles payment by customers into the brokers account
     */
    public function customerPay()
    {
        $em = $this->entityManager;
        $client = new Client();
        $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $this->centralBrokerId);
        $client->setUri(PayStackPaymentService::PAYSTACK_INITIALIZE_TRANSACTION)->setHeaders(array(
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . PayStackPaymentService::PAYSTACK_SECRET_KEY
        ));
        
        $post = array(
            ""
        );
    }

    public function getAccountNumber()
    {}

    public function getSettlementBank()
    {}

    // Begin Setters
    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }

    public function setPercentageCharge($charge)
    {
        $this->percentageCharge = $charge;
        return $this;
    }

    public function setSettlementBank($bank)
    {
        $this->settlementBank = $bank;
        return $this;
    }

    public function setAccountNumber($number)
    {
        $this->accountNumber = $number;
        return $this;
    }

    public function setBusinessName($name)
    {
        $this->businessName = $name;
        return $this;
    }

    public function setInvoiceService($xserv)
    {
        $this->invoiceService = $xserv;
        return $this;
    }
    
    public function setAmount($amount){
        $this->amount = $amount;
        return $this;
    }

    public function setCentralBrokerId($id)
    {
        $this->centralBrokerId = $id;
        return $this;
    }

    public function setMyCurrencyFormat($xserv)
    {
        $this->myCurrencyFormat = $xserv;
        return $this;
    }

    public function setUserId($id)
    {
        $this->userId = $id;
        return $this;
    }

    public function setCardNo($no)
    {
        $this->cardNo = $no;
        return $this;
    }

    public function setCardName($name)
    {
        $this->cardName = $name;
        return $this;
    }

    public function setCardCvv($cvv)
    {
        $this->cardCvv = $cvv;
        return $this;
    }

    public function setCardPin($pin)
    {
        $this->cardPin = $pin;
        return $this;
    }

    public function setCardMonth($month)
    {
        $this->cardMonth = $month;
        return $this;
    }

    public function setCardyear($year)
    {
        $this->cardYear = $year;
        return $this;
    }
    
    public function setReference($ref){
        $this->reference = $ref;
        return $this;
    }
    
    public function setOtp($otp){
        $this->otp = $otp;
        return $this;
    }
    
    public function setPaystackAuth($auth){
        $this->paystackAuth = $auth;
        return $this;
    }
    
    // End Setters
}

