<?php
namespace Customer\Service;

use Transactions\Service\InvoiceService;
use Offer\Service\OfferService;
use Proposal\Service\ProposalService;
use Packages\Service\AcquirePackagesService;

// use Offer\Service\OfferService;
class CustomerBoardService
{

    private $entityManager;

    private $brokerId;

    private $customerId;

    private $clientGeneralService;

    private $auth;

    private $transactionId;

    public function __construct()
    {}

    private function processOffer()
    {
        $em = $this->entityManager;
        $generalService = $this->clientGeneralService->getGeneralService();
        $flash = $generalService->getFlashMessenger();
        $redirect = $generalService->getRedirect();
        
        $generalSession = $this->clientGeneralService->getGeneralSession();
        $invoiceId = $generalSession->InvoiceId;
        
        $invoiceEntity = $em->find("Transactions\Entity\Invoice", $invoiceId);
        $offerEntity = $invoiceEntity->getOffer();
        
        $offerEntity->setUpdatedOn(new \DateTime())->setOfferStatuses($em->find("Offer\Entity\OfferStatus", OfferService::OFFER_STATUS_PAID));
        // var_dump("Ya it got ham");
        // $em = $this->processInvoice($invoiceEntity);
        
        $em->persist($offerEntity);
        
        $em->flush();
        
        $flash->addSuccessMessage("Successfully processed the invoice");
        $flash->addSuccessMessage("Account Manager would get back to you on a covernote");
    }

    private function processProposal()
    {
        $em = $this->entityManager;
        $generalService = $this->clientGeneralService->getGeneralService();
        $flash = $generalService->getFlashMessenger();
        $redirect = $generalService->getRedirect();
        
        $generalSession = $this->clientGeneralService->getGeneralSession();
        $invoiceId = $generalSession->InvoiceId;
        
        $invoiceEntity = $em->find("Transactions\Entity\Invoice", $invoiceId);
        $proposalEntity = $invoiceEntity->getProposal();
        $proposalEntity->setUpdatedOn(new \DateTime())->setProposalStatus($em->find("Proposal\Entity\ProposalStatus", ProposalService::PROPOSAL_STATUS_PAID));
        // var_dump("Ya it got ham");
        // $em = $this->processInvoice($invoiceEntity);
        
        $em->persist($proposalEntity);
        
        $em->flush();
        
        $flash->addSuccessMessage("Successfully processed the invoice");
        $flash->addSuccessMessage("Account Manager would get back to you on a covernote");
    }

    private function processPackage()
    {
        $em = $this->entityManager;
        $generalService = $this->clientGeneralService->getGeneralService();
        $flash = $generalService->getFlashMessenger();
        $redirect = $generalService->getRedirect();
        
        $generalSession = $this->clientGeneralService->getGeneralSession();
        $invoiceId = $generalSession->InvoiceId;
        
        $invoiceEntity = $em->find("Transactions\Entity\Invoice", $invoiceId);
        // var_dump("Ya it got ham");
        // $em = $this->processInvoice($invoiceEntity);
        
        $packageEntity = $invoiceEntity->getPackages();
        $packageEntity->setUpdatedOn(new \DateTime())->setAcquiredPackageStatus($em->find("Packages\Entity\PackageStatus", AcquirePackagesService::ACQUIRED_PACKAGE_PAID));
        
        $em->persist($packageEntity);
        
        $em->flush();
        
        $flash->addSuccessMessage("Successfully processed the invoice");
        $flash->addSuccessMessage("Account Manager would get back to you on a covernote");
    }

    /**
     * This send a notification to the customer
     * Changes the state of the invoice and
     */
    public function customerPaymentAction()
    {
        $em = $this->entitmanager;
        $customerEntity = $em->find("Customer\Entity\Customer", $this->customerId);
        $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $this->brokerId);
        $generalSession = $this->clientGeneralService->getGeneralSession();
        $invoiceId = $generalSession->InvoiceId;
        $transactionEntity = $em->find("Transactions\Entity\Transaction", $this->transactionId);
        $invoiceEntity = $em->find("Transactions\Entity\Invoice", $invoiceId);
        $invoiceEntity->setStatus($em->find("Transactions\Entity\InvoiceStatus", InvoiceService::INVOICE_PAID_STATUS));
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
        
        $em->persist($invoiceEntity);
        $em->flush();
        
        $generalService = $this->clientGeneralService->getGeneralService();
        
        $messagePointer['to'] = $customerEntity->getUser()->getEmail();
        $messagePointer['fromName'] = $brokerEntity->getBrokerName();
        $messagePointer['subject'] = "Payment: Success";
        
        $template['template'] = "general-customer-payment-receipt-email";
        $template['var'] = array(
            "logo" => $this->clientGeneralService->getBrokerLogo(),
            "brokerName" => $brokerEntity->getBrokerName(),
            "totalPaid" => $invoiceEntity->getAmount(),
            "invoiceNo" => $invoiceEntity->getInvoiceUid(),
            "receiptNo" => $transactionEntity->getTransactUid(),
            "service" => $invoiceEntity->getInvoiceCategory()->getCategory()
        );
        $generalService->sendMails($messagePointer, $template);
        
        $messagePointer['to'] = $brokerEntity->getUser()->getEmail();
        $messagePointer['fromName'] = "IMAPP";
        $messagePointer['subject'] = "PAYMENT";
        
        $template['template'] = "general-mail-default";
        $template['var'] = array(
            "logo" => $this->clientGeneralService->getGeneralService()->getCmLogo(),
            "title" => "Service Payment",
            "message" => "A payment has been made for " . $invoiceEntity->getInvoiceCategory()->getCategory() . " by " . $customerEntity->getName()
        );
        
        $generalService->sendMails($messagePointer, $template);
        
        $childBrokers = $messagePointer['to'] = $brokerEntity->getUser()->getEmail();
        $messagePointer['fromName'] = "IMAPP";
        $messagePointer['subject'] = "PAYMENT";
        
        $template['template'] = "general-mail-default";
        $template['var'] = array(
            "logo" => $this->clientGeneralService->getGeneralService()->getCmLogo(),
            "title" => "Service Payment",
            "message" => "A payment has been made for " . $invoiceEntity->getInvoiceCategory()->getCategory() . " by " . $customerEntity->getName()
        );
        
        $generalService->sendMails($messagePointer, $template);
        if (count($this->assignedChildBroker()) > 0) {
            foreach ($this->assignedChildBroker() as $broker) {
                $generalService->sendMails($messagePointer, $template);
                
                $childBrokers = $messagePointer['to'] = $broker->getUser()->getEmail();
                $messagePointer['fromName'] = "IMAPP";
                $messagePointer['subject'] = "PAYMENT";
                
                $template['template'] = "general-mail-default";
                $template['var'] = array(
                    "logo" => $this->clientGeneralService->getGeneralService()->getCmLogo(),
                    "title" => "Service Payment",
                    "message" => "A payment has been made for " . $invoiceEntity->getInvoiceCategory()->getCategory() . " by " . $customerEntity->getName()
                );
                
                $generalService->sendMails($messagePointer, $template);
            }
        }
    }

    public function allBrokersPackages()
    {
        $em = $this->entityManager;
        $data = $em->getRepository("Packages\Entity\Packages")->findBy(array(
            'broker' => $this->clientGeneralService->getBrokerId()
        ));
        return $data;
    }

    public function allBrokerFilteredPackages($id)
    {
        $em = $this->entityManager;
        $data = $em->getRepository("Packages\Entity\Packages")->findBy(array(
            'broker' => $this->clientGeneralService->getBrokerId(),
            "serviceType" => $id
        ));
        return $data;
    }

    public function getSpecificCustomerPackage($id)
    {}

    /**
     * This gets all proposals associated to the customer
     */
    public function customerProposals()
    {
        $em = $this->entityManager;
        $data = $em->getRepository("Proposal\Entity\Proposal")->findCustomerBrokerProposal($this->customerId, $this->brokerId);
        // var_dump($this->brokerId);
        return $data;
    }

    public function customerActiveOffers()
    {
        $em = $this->entityManager;
        $data = $em->getRepository("Offer\Entity\Offer")->findCustomerOffer($this->customerId, $this->brokerId);
        return $data;
    }

    public function customerTransactions()
    {
        $em = $this->entityManager;
        $data = $em->getRepository("Transaction\Entity\Transactions");
        return $data;
    }

    public function customerInvoices()
    {
        $em = $this->entityManager;
        $data = $em->getRepository("Transactions\Entity\Invoice")->findCustomerInvoice($this->customerId, $this->brokerId);
        // var_dump($data);
        return $data;
    }

    public function customerActivePackage()
    {
        $em = $this->entityManager;
        $data = $em->getRepository("Customer\Entity\Customer")->findCustomerActivePackages($this->customerId, $this->brokerId);
        return $data;
    }

    public function featuredPackages()
    {
        $em = $this->entityManager;
        $data = $em->getRepository()->findFeaturedPackages($this->brokerId);
        return $data;
    }

    /**
     * This gets all offer associated to the user
     * Apparently get all offer whose status is active
     *
     * @return array
     */
    public function customerOffer()
    {
        $em = $this->entityManager;
        $data = $em->getRepository("Offer\Entity\Offer")->findCustomerOffer($this->customerId, $this->brokerId);
        // $data = array();
        
        return $data;
    }

    public function assignedChildBroker()
    {
        $em = $this->entityManager;
        // $data = $em->getRepository("Customer\Entity\Customer")->getCustomerAssignedBroker($this->customerId, $this->brokerId);
        // return $data;
        $customerEntity = $em->find("Customer\Entity\Customer", $this->customerId);
        return $customerEntity->getAssignedChildBroker();
    }

    /**
     * This geta all analyzed risk of this customer
     *
     * @return array
     */
    public function customerRisk()
    {
        $data = array();
        return $data;
    }

    public function customerPolicy()
    {
        $em = $this->entityManager;
        $data = $em->getRepository("Policy\Entity\Policy")->findCustomerPolicy($this->customerId);
        
        return $data;
    }

    public function customerCoverNote()
    {
        $em = $this->entityManager;
        $data = $em->getRepository("Policy\Entity\Policy")->findCustomerCoverNote($this->customerId);
        
        return $data;
    }

    /**
     * This gets all claims associated to the customer
     * The claims must be open
     *
     * @return array
     */
    public function customerClaims()
    {
        $em = $this->entityManager;
        
        $data = $em->getRepository("Claims\Entity\CLaims")->findCustomerUnsettledClaims($this->customerId);
        // $data = array();
        return $data;
    }

    public function customerObjects()
    {
        $em = $this->entityManager;
        $data = $em->getRepository("Object\Entity\Object")->findCustomerObject($this->customerId);
        return $data;
    }

    /**
     * This ois all messages toi the
     *
     * @return array
     */
    public function customerMessages()
    {
        $em = $this->entityManager;
        // $brokerId = NULL;
        $data = NULL;
        // $data = $em->getRepository ( "Customer\Entity\CustomerMessages" )->findBy ( array (
        // "broker" => $this->brokerId,
        // 'customer' => $this->clientGeneralService->getCustomerId ()
        // ) );
        // $data = array();
        return $data;
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }

    public function setBrokerId($brokerId)
    {
        $this->brokerId = $brokerId;
        return $this;
    }

    public function setClientGeneralService($ser)
    {
        $this->clientGeneralService = $ser;
        return $this;
    }

    public function setCustomerId()
    {
        $this->customerId = $this->clientGeneralService->getCustomerId();
        return $this;
    }

    public function setAuth($auth)
    {
        $this->auth = $auth;
        return $this;
    }

    public function setTransactionId($id)
    {
        $this->transactionId = $id;
        return $this;
    }
}