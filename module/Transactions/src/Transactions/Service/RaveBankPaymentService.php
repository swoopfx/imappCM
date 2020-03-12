<?php
namespace Transactions\Service;

use Zend\Http\Client;

/**
 *
 * @author otaba
 *        
 */
class RaveBankPaymentService extends RavePaymentGeneralSettings implements RaveBankPaymentInterface
{

    private $entityManager;

    private $ravePaymentSession;

    private $clientGeneralService;

    private $ravePaymentGeneralSetting;

    private $transactionService;

    // Transfer data
    private $transferBank;

    private $transferAcc;

    private $transferAmount;

    private $transferCurrency;

    // bank transfer details
    private $bank;

    private $currency;

    private $amount;

    private $email;

    private $phoneNumber;

    private $ip;

    private $txRef;

    private $accountNumber;

    private $passcode;

    private $redirect_url;

    /**
     */
    public function __construct()
    {
        parent::__construct();
        // TODO - Insert your code here
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Transactions\Service\RaveBankPaymentInterface::confirmPayment()
     *
     */
    public function confirmPayment()
    {
        
        // TODO - Insert your code here
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Transactions\Service\RaveBankPaymentInterface::initiateBankPayment()
     *
     */
    public function initiateBankPayment()
    {
        $ravePaymentSession = $this->ravePaymentSession;
        $client = new Client();
        $client->setUri(RavePaymentGeneralSettings::RAVE_LIVE_URL . "flwv3-pug/getpaidx/api/charge");
        $client->setHeaders(array(
            'Content-Type' => 'application/json'
        ));
        $data = array(
            "PBFPubKey" => RavePaymentService::RAVE_PUBLIC_KEY,
            "accountbank" => $this->bank,
            "accountnumber" => $this->accountNumber,
            "payment_type" => "account",
            "currency" => "NGN",
            "amount" => $this->amount,
            "email" => $this->email,
            "passcode" => $this->passcode, // Date of birth on account required by zenith bank account holder
            "phonenumber" => $this->phoneNumber,
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
            
            if ($body->data->chargeResponseCode == "02") {
                $ravePaymentSession->flwRef = $body->data->flwRef;
                $ravePaymentSession->instruction = $body->data->validateInstructions->instruction;
                $ravePaymentSession->paymenttype = $body->data->paymentType;
                $ravePaymentSession->authUrl = $body->data->authurl;
                $ravePaymentSession->valparams = $body->data->validateInstructions->valparams[0];
                $ravePaymentSession->bank = $this->bank;
                if ($this->bank == RavePaymentService::RAVE_GTBANK_CODE) { // if it is GTBANK
                    $ravePaymentSession->authh = "GTB";
                    return "GTB";
                } elseif ($this->bank == RavePaymentService::RAVE_FIRST_BANK_CODE) {
                    $ravePaymentSession->authh = "FBN";
                    return "FBN";
                } elseif ($this->bank != RavePaymentService::RAVE_GTBANK_CODE && $this->bank != RavePaymentService::RAVE_FIRST_BANK_CODE && $ravePaymentSession->valparams == "OTP") { // is not GTBANK
                    $ravePaymentSession->authh = "OTP";
                    return "OTP";
                } else {
                    // TODO
                    throw new \Exception("Unexpected Result, Please try again");
                }
            } elseif ($body->data->chargeResponseCode == "00") {
                return TRUE; // meaning the charging reequired no other validation
            } else {
                throw new \Exception("Account transfer could not be initiated");
            }
        }
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Transactions\Service\RaveBankPaymentInterface::validatePayment()
     *
     */
    public function validatePayment()
    {
        
        // TODO - Insert your code here
    }

    /**
     *
     * @return the $entityManager
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }

    /**
     *
     * @return the $ravePaymentSession
     */
    public function getRavePaymentSession()
    {
        return $this->ravePaymentSession;
    }

    /**
     *
     * @return the $clientGeneralService
     */
    public function getClientGeneralService()
    {
        return $this->clientGeneralService;
    }

    /**
     *
     * @return the $ravePaymentGeneralSetting
     */
    public function getRavePaymentGeneralSetting()
    {
        return $this->ravePaymentGeneralSetting;
    }

    /**
     *
     * @return the $transactionService
     */
    public function getTransactionService()
    {
        return $this->transactionService;
    }

    /**
     *
     * @return the $transferBank
     */
    public function getTransferBank()
    {
        return $this->transferBank;
    }

    /**
     *
     * @return the $transferAcc
     */
    public function getTransferAcc()
    {
        return $this->transferAcc;
    }

    /**
     *
     * @return the $transferAmount
     */
    public function getTransferAmount()
    {
        return $this->transferAmount;
    }

    /**
     *
     * @return the $transferCurrency
     */
    public function getTransferCurrency()
    {
        return $this->transferCurrency;
    }

    /**
     *
     * @return the $bank
     */
    public function getBank()
    {
        return $this->bank;
    }

    /**
     *
     * @return the $accountNumber
     */
    public function getAccountNumber()
    {
        return $this->accountNumber;
    }

    /**
     *
     * @return the $passcode
     */
    public function getPasscode()
    {
        return $this->passcode;
    }

    /**
     *
     * @return the $redirect_url
     */
    public function getRedirect_url()
    {
        return $this->redirect_url;
    }

    /**
     *
     * @param field_type $entityManager            
     */
    public function setEntityManager($entityManager)
    {
        $this->entityManager = $entityManager;
        return $this;
    }

    /**
     *
     * @param field_type $ravePaymentSession            
     */
    public function setRavePaymentSession($ravePaymentSession)
    {
        $this->ravePaymentSession = $ravePaymentSession;
        
        return $this;
    }

    /**
     *
     * @param field_type $clientGeneralService            
     */
    public function setClientGeneralService($clientGeneralService)
    {
        $this->clientGeneralService = $clientGeneralService;
        
        return $this;
    }

    /**
     *
     * @param field_type $ravePaymentGeneralSetting            
     */
    public function setRavePaymentGeneralSetting($ravePaymentGeneralSetting)
    {
        $this->ravePaymentGeneralSetting = $ravePaymentGeneralSetting;
        return $this;
    }

    /**
     *
     * @param field_type $transactionService            
     */
    public function setTransactionService($transactionService)
    {
        $this->transactionService = $transactionService;
        return $this;
    }

    /**
     *
     * @param field_type $transferBank            
     */
    public function setTransferBank($transferBank)
    {
        $this->transferBank = $transferBank;
        return $this;
    }

    /**
     *
     * @param field_type $transferAcc            
     */
    public function setTransferAcc($transferAcc)
    {
        $this->transferAcc = $transferAcc;
        return $this;
    }

    /**
     *
     * @param field_type $transferAmount            
     */
    public function setTransferAmount($transferAmount)
    {
        $this->transferAmount = $transferAmount;
        return $this;
    }

    /**
     *
     * @param field_type $transferCurrency            
     */
    public function setTransferCurrency($transferCurrency)
    {
        $this->transferCurrency = $transferCurrency;
        return $this;
    }

    /**
     *
     * @param field_type $bank            
     */
    public function setBank($bank)
    {
        $this->bank = $bank;
        return $this;
    }

    /**
     *
     * @param field_type $accountNumber            
     */
    public function setAccountNumber($accountNumber)
    {
        $this->accountNumber = $accountNumber;
        return $this;
    }

    /**
     *
     * @param field_type $passcode            
     */
    public function setPasscode($passcode)
    {
        $this->passcode = $passcode;
        return $this;
    }

    /**
     *
     * @param field_type $redirect_url            
     */
    public function setRedirect_url($redirect_url)
    {
        $this->redirect_url = $redirect_url;
        return $this;
    }

    /**
     *
     * @return the $currency
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     *
     * @return the $amount
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     *
     * @return the $email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     *
     * @return the $phoneNumber
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     *
     * @return the $ip
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     *
     * @return the $txRef
     */
    public function getTxRef()
    {
        return $this->txRef;
    }

    /**
     *
     * @param field_type $currency            
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     *
     * @param field_type $amount            
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     *
     * @param field_type $email            
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     *
     * @param field_type $phoneNumber            
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }

    /**
     *
     * @param field_type $ip            
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
        return $this;
    }

    /**
     *
     * @param field_type $txRef            
     */
    public function setTxRef($txRef)
    {
        $this->txRef = $txRef;
        return $this;
    }
}

