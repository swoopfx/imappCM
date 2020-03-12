<?php
namespace Transactions\Service;

use CsnUser\Service\UserService;
use Zend\Session\Container;
use Offer\Service\OfferService;
use Proposal\Service\ProposalService;
use Transactions\Entity\Transaction;
use Packages\Service\PackageService;
use Packages\Service\AcquirePackagesService;

/**
 *
 * @author swoopfx
 *        
 */
class InvoiceService
{

    protected $auth;

    protected $userId;

    private $user;

    protected $entityManager;

    private $amount;

    private $invoiceEntity;

    private $generalService;

    private $centralBrokerId;

    private $mailService;

    private $transactionService;

    private $microPaymentSession;

    const NIGERIA_NAIRA_CURRENCY = 1;

    const INVOICE_CAT_BROKER_SUB = 1;

    const INVOICE_CAT_AGENT_SUB = 2;

    const INVOICE_CAT_SMS_SUB = 3;

    const INVOICE_CAT_ADVERT = 4;

    const INVOICE_CAT_POLICY = 5;

    const INVOICE_CAT_PACKAGE = 6;

    const INVOICE_CAT_OFFER = 7;

    const INVOICE_CAT_PROPOSAL = 8;

    const INVOICE_CATADVERT_SUB = 4;

    const INVOICE_PAID_STATUS = 1;

    const INVOICE_UNPAID_STATUS = 2;

    const INVOICE_PAYING_STATUS = 4; // The invoice is being payed instalmentally 

    const INVOICE_EXPIRED_STATUS = 3;

    public function invoiceMail($messagePointers, $var, $template)
    {
        $mailService = $this->mailService;
        $message = $mailService->getMessage();
        $message->addTo($messagePointers['to'])
            ->setFrom("info@imapp.ng", $messagePointers['fromName'])
            ->setSubject($messagePointers['subject']);
        $mailService->setTemplate($template, $var);
        $mailService->send();
    }

    public function processPayment()
    {
        $em = $this->entityManager;
        $invoiceSession = new Container("invoice_session");
        
        $invoiceEntity = $em->find("Transactions\Entity\Invoice", $invoiceSession->invoiceId);
        $invoiceCategoryId = $invoiceEntity->getInvoiceCategory()->getId();
        if ($invoiceCategoryId == InvoiceService::INVOICE_CAT_OFFER) {
            
            return $this->processOffer();
        } elseif ($invoiceCategoryId == InvoiceService::INVOICE_CAT_PACKAGE) {
            return $this->processPackage();
        } elseif ($invoiceCategoryId == InvoiceService::INVOICE_CAT_PROPOSAL) {
            return $this->processProposal();
        } elseif ($invoiceCategoryId == InvoiceService::INVOICE_CAT_POLICY) {
            return $this->processPolicy();
        }
        
        // return $this->getResponse()->setContent(NULL);
    }

    private function processInvoice($invoiceEntity)
    {
        $em = $this->entityManager;
        $transactionService = $this->transactionService;
        $invoiceEntity->setStatus($em->find("Transactions\Entity\InvoiceStatus", InvoiceService::INVOICE_PAID_STATUS))
            ->setModifiedOn(new \DateTime())
            ->setIsOpen(FALSE);
        
        $transaction = new Transaction();
        $transaction->setTransactUid($transactionService->generateTransactionUid())
            ->setPaymentDate(new \DateTime())
            ->setInvoice($invoiceEntity)
            ->setTransactStatus($em->find("Transactions\Entity\TransactionStatus", TransactionService::TRANSACTION_STATUS_SUCCESS))
            ->setPaymentMode($invoiceEntity->getManualProcess()
            ->getPaymentMode())
            ->setCreatedOn(new \DateTime());
        
        $invoiceEntity->addTransaction($transaction);
        $em->persist($transaction);
        $em->persist($invoiceEntity);
        return $em;
    }

    private function processOffer()
    {
        $em = $this->entityManager;
        $generalService = $this->generalService;
        $flash = $generalService->getFlashMessenger();
        $redirect = $generalService->getRedirect();
        $invoiceSession = new Container("invoice_session");
        $invoiceEntity = $em->find("Transactions\Entity\Invoice", $invoiceSession->invoiceId);
        $offerEntity = $invoiceEntity->getOffer();
        
        $offerEntity->setUpdatedOn(new \DateTime())->setOfferStatuses($em->find("Offer\Entity\OfferStatus", OfferService::OFFER_STATUS_PAID));
        // var_dump("Ya it got ham");
        $em = $this->processInvoice($invoiceEntity);
        try {
            
            $em->persist($offerEntity);
            
            $em->flush();
            
            $flash->addSuccessMessage("Successfully processed the invoice");
            $flash->addSuccessMessage("CoverNote can now be generated");
            return true;
        } catch (\Exception $e) {
            $flash->addErrorMessage("The Manual= Payment Could not be processed");
            return false;
        }
    }

    private function processProposal()
    {
        $em = $this->entityManager;
        $generalService = $this->generalService;
        $flash = $generalService->getFlashMessenger();
        $redirect = $generalService->getRedirect();
        $invoiceSession = new Container("invoice_session");
        $invoiceEntity = $em->find("Transactions\Entity\Invoice", $invoiceSession->invoiceId);
        $proposalEntity = $invoiceEntity->getProposal();
        $proposalEntity->setUpdatedOn(new \DateTime())->setProposalStatus($em->find("Proposal\Entity\ProposalStatus", ProposalService::PROPOSAL_STATUS_PAID));
        $em = $this->processInvoice($invoiceEntity);
        try {
            $em->persist($proposalEntity);
            
            $em->flush();
            
            $flash->addSuccessMessage("Successfully processed the invoice");
            $flash->addSuccessMessage("CoverNote can now be generated");
            
            return true;
        } catch (\Exception $e) {
            $flash->addErrorMessage("The Manual Payment Could not be processed");
            return false;
        }
    }

    private function processPackage()
    {
        $em = $this->entityManager;
        $generalService = $this->generalService;
        $flash = $generalService->getFlashMessenger();
        $redirect = $generalService->getRedirect();
        $invoiceSession = new Container("invoice_session");
        $invoiceEntity = $em->find("Transactions\Entity\Invoice", $invoiceSession->invoiceId);
        $packageEntity = $invoiceEntity->getPackages();
        $packageEntity->setUpdatedOn(new \DateTime())->setAcquiredPackageStatus($em->find("Packages\Entity\PackageStatus", AcquirePackagesService::ACQUIRED_PACKAGE_PAID));
        $em = $this->processInvoice($invoiceEntity);
        try {
            $em->persist($packageEntity);
            // $em->persist($invoiceEntity);
            $em->flush();
            
            $flash->addSuccessMessage("Successfully processed the invoice");
            $flash->addSuccessMessage("CoverNote can now be generated");
            return true;
        } catch (\Exception $e) {
            $flash->addErrorMessage("The Manual Payment Could not be processed");
            return false;
        }
    }

    /**
     *
     * @param int $div
     *            This is the divisiblibility value or duration
     * @param float $value
     *            This is the total mount meant to be divivided
     * @return array
     */
    public function generateMicroPayment(int $div, float $value)
    {
        $result = array();
        $dividedValue = $value / $div; // return decimal aprimate to 2 decimal point
        $amountPayable = "";
        if ($div == 2) {
            $amountPayable = $dividedValue + 200;
            for ($i = 0; $i < $div; $i ++) {
                
                if ($i == 0) {
                    $result["dueDate"][$i] = new \DateTime();
                } 
                else {
                    $date = clone $result["dueDate"][$i - 1];
                    $addMonths = "P6M";
                    $interval = new \DateInterval($addMonths);
                    $result["dueDate"][$i] = $date->add($interval);
                }
                $result["value"][$i] = $amountPayable;
            }
            return $result;
        } elseif ($div == 4) {
            $date = NULL;
            $amountPayable = $dividedValue + 180;
            for ($i = 0; $i < $div; $i ++) {
                
                if ($i == 0) {
                    $result["dueDate"][$i] = new \DateTime();
                } else {
                    $date = clone $result["dueDate"][$i - 1];
                    $addMonths = "P3M";
                    $interval = new \DateInterval($addMonths);
                    $result["dueDate"][$i] = $date->add($interval);
                }
                $result["value"][$i] = $amountPayable;
            }
            return $result;
        } elseif ($div == 12) {
            $date = NULL;
            $amountPayable = $dividedValue + 240;
            for ($i = 0; $i < $div; $i ++) {
                
                if ($i != 0) {
                    
                    $date = clone $result["dueDate"][$i - 1];
                    $addMonths = "P1M";
                    $interval = new \DateInterval($addMonths);
                    $result["dueDate"][$i] = $date->add($interval);
                } else {
                    $result["dueDate"][$i] = new \DateTime();
                }
                $result["value"][$i] = $amountPayable;
            }
            return $result;
        } elseif ($div == 52) {
            $date = NULL;
            $flatrate = 300;
            $amountPayable = $dividedValue + $flatrate;
            for ($i = 0; $i < $div; $i ++) {
                
                if ($i == 0) {
                    $result["dueDate"][$i] = new \DateTime();
                } else {
                    $date = clone $result["dueDate"][$i - 1];
                    $addMonths = "P1W";
                    $interval = new \DateInterval($addMonths);
                    $result["dueDate"][$i] = $date->add($interval);
                }
                $result["value"][$i] = $amountPayable;
                $result["flatrate"][$i] = $flatrate;
            }
            return $result;
        }
        
        return $result;
    }

    /**
     * This function gets the value of the
     */
    public function getMicroPaymentPayabale()
    {
    /**
     * if
     */
    }

    public function processPolicy()
    {}

    public function brokerSetupInvoice()
    {
        
        /**
         * Tis function setup all the required information
         * for the broker setup Invoice
         */
        $em = $this->entityManager;
        $invoiceEntity = $this->invoiceEntity;
        $invoiceEntity->setUserId($this->userId);
        $invoiceEntity->setGeneratedOn(new \DateTime());
        $invoiceEntity->setAmount($this->amount);
        $invoiceEntity->setStatus($em->find('Transactions\Entity\InvoiceStatus', UNPAID)); // Paid and Unpaid // set it as unpaid
        $invoiceEntity->setInvoiceCategory($em->find('Transactions\Entity\InvoiceCategory', 2)); // This is Broker SetUp Invoice
        $invoiceEntity->setCurrency($em->find('Settings\Entity\Currency', 1)); // tis is set to Naira
        try {} catch (\Exception $e) {
            echo 'Invoice generation error';
        }
    }

    public function updateBrokerSub($invoiceEntity, $subEntity)
    {
        
        // This is called once payment is made for the subscription
        $invoiceEntity->setInoviceStatus();
        $subEntity->setIsValid();
    }

    public function getLatestInvoices()
    {
        // this function getas all the first 50 invoices of the user
        if ($this->userId != Null) {
            $em = $this->entityManager;
            $criteria = array(
                'user' => $this->userId
            );
            $order = array(
                'id' => 'DESC'
            );
            $limit = 50;
            
            $transact = $em->getRepository('Transactions\Entity\InvoiceUser')->findBy($criteria, $order, $limit);
            return $transact;
        }
    }

    public function getBrokerCustomerExpiredInvoices()
    {
        $em = $this->entityManager;
        $data = $em->getRepository("Transactions\Entity\Invoice")->findBrokerExpiredInvoice($this->centralBrokerId);
        return $data;
    }

    public function getBrokerCustomerExpiringInvoice()
    {
        $em = $this->entityManager;
        $data = $em->getRepository("Transactions\Entity\Invoice")->findBrokerExpiringInvoice($this->centralBrokerId);
        return $data;
    }

    public function getBrokerCustomerInvoices()
    {
        $em = $this->entityManager;
        $data = $em->getRepository("Transactions\Entity\Invoice")->findBrokerCustomerInvoices($this->centralBrokerId); // call the centralBrokerId
        
        return $data;
    }

    /**
     * This function gets all expiring invoices for a particular customer
     *
     * @param int $customerId            
     * @return object
     */
    public function getCustomerExpiringInvoice($customerId)
    {
        $em = $this->entityManager;
        $data = $em->getRepository("Transactions\Entity\Invoice")->findCustomerExpiringInvoice($customerId); // call the centralBrokerId
        return $data;
    }

    public function invoiceReminderNotification()
    {
        // call mail service
        // insert all variables
        // call the send instance
        // if mail was successful return true else return false
    }

    public function getSetupInvoices()
    {
        $em = $this->entityManager;
        
        $invoice = $em->getRepository('Transactions\Entity\Invoice')->findSetUpInvoices($this->userId);
        return $invoice;
    }

    public function getMyCustomerExpiredInvoice()
    {
        $userRole = $this->generalService->getUserRoleId();
        switch ($userRole) {
            case UserService::USER_ROLE_BROKER:
                return $this->getBrokerCustomerExpiredInvoice();
                break;
            case UserService::USER_ROLE_BROKER_CHILD:
                return $this->getBrokerCustomerExpiredInvoice();
                // return $this->getBrokerChildCustomerExpiredInvoice();
                break;
        }
    }

    public function getMyCustomerUnpiadInvoice()
    {
        $userRole = $this->generalService->getUserRoleId();
        switch ($userRole) {
            case UserService::USER_ROLE_BROKER:
                return $this->getBrokerCustomerExpiredInvoice();
                break;
            case UserService::USER_ROLE_BROKER_CHILD:
                return $this->getBrokerChildCustomerExpiredInvoice();
                break;
        }
    }

    public function getMicroPaymentSession()
    {
        return $this->microPaymentSession;
    }

    private function getBrokerCustomerExpiredInvoice()
    {
        $em = $this->entityManager;
        $brokerId = $this->generalService->getBrokerId();
        $data = $em->getRepository('Transactions\Entity\Invoice')->findExpiredBrokerCustomerInvoice($brokerId);
        
        return $data;
    }

    private function getBrokerChildCustomerExpiredInvoice()
    {
        $em = $this->entityManager;
        $childBrokerId = $this->generalService->getChildBrokerId();
        $data = $em->getRepository('Transactions\Entity\Invoice')->findExpiredChildBrokerCustomerInvoice($childBrokerId);
        return $data;
    }

    public function createInvoice()
    {
    /**
     * Use this function to create an invoice into the db
     */
    }
    
    public static function generateUidStatic(){
        $const = "inv";
        $code = \uniqid($const) . mt_rand(1, 300);
        return $code;
    }

    public function generateInvoiceNumber()
    {
        $const = "inv";
        $code = \uniqid($const) . $this->userId;
        return $code;
    }

    public function setUserId($user)
    {
        $this->userId = $user;
        return $this;
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }

    public function setInvoiceEntity($entity)
    {
        $this->invoiceEntity = $entity;
        return $this;
    }

    public function setAmount($amount)
    {
        $this->amount = $amount;
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

    public function setMailService($xserv)
    {
        $this->mailService = $xserv;
        return $this;
    }

    public function setTransactionService($xserv)
    {
        $this->transactionService = $xserv;
        return $this;
    }

    public function setMicroPaymentSession($sess)
    {
        $this->microPaymentSession = $sess;
        return $this;
    }
}

?>