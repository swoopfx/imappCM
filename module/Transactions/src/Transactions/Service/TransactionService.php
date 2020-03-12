<?php
namespace Transactions\Service;

use Transactions\Entity\Transaction;
use Transactions\Entity\Invoice;
use Zend\Session\Container;

/**
 *
 * @author swoopfx
 *        
 */
class TransactionService
{

    private $entitmanager;

    private $user;

    private $userId;

    private $customerId;

    private $centralBrokerId;

    private $generalService;

    private $invoiceId;

    private $clientGeneralService;

    const TRANSACTION_STATUS_SETTLED = 1;

    // Also success
    const TRANSACTION_STATUS_UNSETTLED = 2;

    // also Failed
    const TRANSACTION_STATUS_SUCCESS = 1;

    const TRANSACTION_STATUS_FAILED = 2;

    const TRANSACTION_STATUS_PENDING = 3;

    const TRANSACTION_PAYMENT_MODE_FLUTTERWAVE = 1;

    const TRANSACTION_PAYMENT_MODE_PAYSTACK_CARD = 1;

    const TRANSACTION_PAYMENT_MODE_PAYSTACK_TRANSFER = 2;

    const TRANSACTION_PAYMENT_MODE_CASH = 6;

    const TRANSACTION_PAYMENT_MODE_BANK_TRANSFER = 2;

    const TRANSACTION_PAYMENT_MODE_BANK_DEPOSIT = 5;
    
    
    const TRANSACTION_MANUAL_PAYMENT_MODE_CASH = 10;
    
    const TRANSACTION_MANUAL_PAYMENT_MODE_CHEQUE = 50;
    
    
    
    
    const NO_BROKER_ACC_STATUS_TRANSFER_ERROR = 10;
    
    const NO_BROKER_ACC_STATUS_TRANSFER_INITIATED = 100;
    
    const NO_BROKER_ACC_STATUS_TRANSFER_COMPLETE = 200;

    // micro payment constants
    const MICRO_PAYMENT_WEEKLY = 2;

    const MICRO_PAYMENT_MONTHLY = 4;

    const MICRO_PAYMENT_QUATERTLY = 7;

    const MICRO_PAYMENT_6_MONTHS = 10;
    
    const BROKER_TRANSFER_STATUS_INITIATED = 1;
    
    const BROKER_TRANSFER_STATUS_COMPLETED = 10 ; 
    
    const BROKER_TRANSFER_STATUS_FAILED = 100;
    
    
    const TRANSACTION_VAT = 5; // percentage of VAT collected
    
    
    const IMAPP_COMMISION = 0.032; // This is the percentage value we collect for every transaction on the platform
    
    const IMAPP_TRANSFER_FEE = 100;
    
    const IMAPP_EXTRA_CHARGE = 30;
    
    /**
     *  This is the cost on every transfer from broker to broker bank account
     * @var integer
     */
    const TRASACTION_TRANSFER_COST = 100;

    public function __construct()
    {}

    /**
     * This function gets the amount payable
     * If Micro ,
     * It filters through the micro payment and gets most recent payment
     *
     * @param Invoice $invoiceEntity            
     * @return Invoice
     */
    public function getpayableAmount($invoiceEntity)
    {
        if ($invoiceEntity->getIsMicro()) {
            return $this->filterMicro($invoiceEntity);
        } else {
            return $invoiceEntity;
        }
    }
    
    public function getpayableValue($invoiceEntity){
        if ($invoiceEntity->getIsMicro()) {
            $micro = $this->filterMicro($invoiceEntity);
            return $micro->getValue();
        } else {
            return $invoiceEntity->getAmount();
        }
    }

    /**
     * This filters through the list of micrpayment for the particular invoice and gets the next payment
     */
    private function filterMicro($invoiceEntity)
    {
        $em = $this->entitmanager;
        $dataArray = $em->getRepository("Transactions\Entity\MicroPayment")->findBy(array(
            "invoice" => $invoiceEntity->getId()
        ));
        foreach ($dataArray as $set) {
            if ($set->getStatus()->getId() == TransactionService::TRANSACTION_STATUS_PENDING) {
                $micropayment_session = new Container("micropayment_active_session"); // this is the active payment
                $micropayment_session->id = $set->getId();
                return $set;
                break;
            }
        }
    }

    public function microPaymentGenerator($value, $duration)
    {
        $arrayRes = array(); // this keeps an array of the payment to be made and date be made
        
        return $arrayRes;
    }

    // private function sixMonthsCalc($val){
    // $duration = 2 ;
    // $splitVal = $val / $duration;
    // $dateArray = array();
    // for($i = 0; $i < $duration ; $i++){
    // $dateArray
    // }
    // }
    
    /**
     * This is a list of the lates 50 transaction on the platform
     *
     * @return Transaction
     * @var object
     */
    public function getLatestTransactions()
    {
        if ($this->user != Null) {
            $em = $this->entitmanager;
            $criteria = array(
                'user' => $this->user->getId()
            
            );
            $order = array(
                'id' => 'DESC'
            );
            $limit = 50;
            
            $transact = $em->getRepository('Transactions\Entity\Transaction')->findBy($criteria, $order, $limit);
            return $transact;
        }
    }

    public function getCustomerManualPayment($manuLPaymentEntity)
    {
        if ($manuLPaymentEntity != NULL) {
            $cat = $manuLPaymentEntity->getPaymentMode()->getId();
            if ($cat == TransactionService::TRANSACTION_PAYMENT_MODE_CASH) {
                return $manuLPaymentEntity->getCash();
            } elseif ($cat == TransactionService::TRANSACTION_PAYMENT_MODE_BANK_TRANSFER) {
                return $manuLPaymentEntity->getBankTransfer();
            } elseif ($cat == TransactionService::TRANSACTION_PAYMENT_MODE_BANK_DEPOSIT) {
                return $manuLPaymentEntity->getBankDeposit();
            }
        }
    }

    public static function generateStaticUid(){
        $const = "trs";
        $code = \uniqid($const);
        return $code;
    }
    public function generateTransactionUid()
    {
        $const = "trs";
        $code = \uniqid($const);
        return $code;
    }

    public function transactionSuccess()
    {
        /**
         * Create a new transaction Entity
         * A reciept mail is sent to customer
         * A notification mail is sent to broker
         * A notification is sent to all child broker
         * Change Invoice Status
         * If
         */
        $em = $this->entitmanager;
        $clientGeneralService = $this->clientGeneralService;
        $generalSession = $this->clientGeneralService->getGeneralSession();
        $invoiceId = $generalSession->InvoiceId;
        $invoiceEntity = $em->find("Transactions\Entity\Invoice", $invoiceId);
        $transactionEntity = new Transaction();
        $transactionEntity->setCreatedOn(new \DateTime())
            ->setInvoice($invoiceEntity)
            ->setPaymentDate(new \DateTime())
            ->setTransactUid($this->generateTransactionUid());
        $micropayment_session = new Container("micropayment_active_session");
        if ($invoiceEntity->getIsMicro() == True) {
            
            $microPaymentEntity = $em->find("Transactions\Entity\MicroPayment", $micropayment_session->id);
            $microPaymentEntity->setUpdatedOn(new \DateTime())
                ->setStatus($em->find("Transactions\Entity\TransactionStatus", TransactionService::TRANSACTION_STATUS_SUCCESS))
                ->addTransaction($transactionEntity);
            $invoiceEntity->setModifiedOn(new \DateTime())->setStatus($em->find("Transactions\Entity\InvoiceStatus", InvoiceService::INVOICE_PAYING_STATUS));
            $em->persist($transactionEntity);
            $em->persist($microPaymentEntity);
            $em->persist($invoiceEntity);
        } else {
           
            $transactionEntity->setInvoice($invoiceEntity)
                ->setUpdatedOn(new \DateTime())
                ->setPaymentDate(new \DateTime())
                ->setPaymentMode($em->find("Settings\Entity\PaymentMode", TransactionService::TRANSACTION_PAYMENT_MODE_FLUTTERWAVE));
            $invoiceEntity->setModifiedOn(new \DateTime())->setStatus($em->find("Transactions\Entity\InvoiceStatus", InvoiceService::INVOICE_PAID_STATUS));
            
            $em->persist($transactionEntity);
            $em->persist($invoiceEntity);
            
            
        }
        // Send SMS
        try{
            $em->flush();
            // Send Customer a transaction receipt
            // Send Broker a payment notification
            // send child broker a payment Notification
            return $transactionEntity->getTransactUid();
        }catch (\Exception $e){
            return false;
        }
       
        
        
    }

    public function brokerPaymentPostAction()
    {
        $em = $this->entitmanager;
        $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $this->centralBrokerId);
        $generalSession = $this->generalService->getGeneralSession();
        $invoiceId = $generalSession->invoiceId;
        $invoiceEntity = $em->find("Transactions\Entity\Invoice", $invoiceId);
        $invoiceEntity->setStatus($em->find("Transactions\Entity\InvoiceStatus", InvoiceService::INVOICE_PAID_STATUS));
        $messagePointer['to'] = $brokerEntity->getUser()->getEmail();
        $messagePointer['subject'] = "Succesful Payment";
        $messagePointer['fromName'] = "IMAPP CM";
        
        $template['template'] = "";
        $template['var'] = array(
            "logo" => "",
            "" => ""
        );
        $this->generalService->sendMails($messagePointer, $template);
        
        $em->persist($invoiceEntity);
        $em->flush();
        // send email
    }

    public function setEntityManager($em)
    {
        $this->entitmanager = $em;
        return $this;
    }

    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    public function setUserId($id)
    {
        $this->userId = $id;
        return $this;
    }

    public function setCentralBrokerId($id)
    {
        $this->centralBrokerId = $id;
        return $this;
    }

    public function setGeneralService($xserv)
    {
        $this->generalService = $xserv;
        return $this;
    }

    public function setInvoiceId($id)
    {
        $this->invoiceId = $id;
        return $this;
    }

    public function setCustomerId($id)
    {
        $this->customerId = $id;
        return $this;
    }
}

