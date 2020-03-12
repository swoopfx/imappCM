<?php
namespace Packages\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Packages\Service\AcquirePackagesService;
use Customer\Entity\CustomerPackageInitiator;
use Object\Entity\Object;
use Object\Service\ObjectService;
use Transactions\Entity\Invoice;
use Zend\Session\Container;
use Transactions\Service\InvoiceService;
use Policy\Entity\CoverNote;
use Policy\Service\CoverNoteService;
use Messages\Entity\Messages;
use Messages\Entity\MessageEntered;
use Messages\Service\MessageService;

/**
 *
 * @author otaba
 *        
 */
class AcquirePackagesController extends AbstractActionController
{

    private $entityManager;

    private $acquiredSession;

    private $generalService;

    private $packageService;

    private $selectObjectForm;

    private $newObjectform;

    private $objectService;

    private $invoiceService;

    private $messageForm;

    private $messageService;
    
    private $coverNoteService;
    
    private $mailService;
    
    private $centralBrokerId;

    public function onDispatch(\Zend\Mvc\MvcEvent $e)
    {
        $response = parent::onDispatch($e);
        // $response = parent::on
        $this->redirectPlugin()->redirectCondition();
        return $response;
    }

    private function initiatorExist($userId, $customerPackageId)
    {
        $em = $this->entityManager;
        $criteria = array(
            "customerPackges" => $customerPackageId,
            "packageProcessor" => $userId
        );
        $Initiator = $em->getRepository("Customer\Entity\CustomerPackageInitiator")->findOneBy($criteria);
        if ($Initiator == NULL) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /**
     * This function locates if the user or broker is assigned directly or indirectly to
     * this package
     */
    private function noAuthorization()
    {}

    /**
     * This begins the processing of an acquired package
     */
    public function preProcessAction()
    {
        $em = $this->entityManager;
        $acquiredPackageSession = $this->acquiredSession;
        
        $id = $this->params()->fromRoute("id", NULL); // this is the customer Package Id
        $packageEntity = $em->find("Customer\Entity\CustomerPackage", $id);
        $user = $this->identity();
        if ($id == NULL) {
            $this->flashmessenger()->addErrorMessage("There is no identifier for this acquired objects");
            $this->redirect()->toRoute("acquired-packages");
        }
        
        if ($packageEntity->getAcquiredPackageStatus()->getId() == AcquirePackagesService::ACQUIRED_PACKAGE_PAID) {
            
            $packageEntity->setAcquiredPackageStatus($em->find("Packages\Entity\PackageStatus", AcquirePackagesService::ACQUIRED_PACKAGE_PAID_PROCESSING))
                ->setUpdateOn(new \DateTime());
        }
        
        // Assign the customerPackage to a broker this makes sure we know who initialized the processing
        $intiator = new CustomerPackageInitiator();
        $intiator->setCreatedOn(new \DateTime())
            ->setPackageProcessor($em->find("CsnUser\Entity\User", $user->getId()))
            ->setCustomerPackages($em->find("Customer\Entity\CustomerPackage", $id));
        try {
            
            $em->persist($packageEntity);
            $em->persist($intiator);
            $em->flush();
            $acquiredPackageSession->acquiredId = $id;
            $this->redirect()->toRoute("acquired-packages/default", array(
                "action" => "process"
            ));
        } catch (\Exception $e) {
            $this->flashmessenger()->addErrorMessage("Something went wrong processing the customer package");
            $this->redirect()->toRoute("acquired-packages");
        }
        return $this->getResponse()->setContent(NULL);
    }

    /**
     * once the package has been initialized this makes sure the processing constinues
     */
    public function continueProcessAction()
    {
        $em = $this->entityManager;
        $acquiredPackageSession = $this->acquiredSession;
        
        $id = $this->params()->fromRoute("id", NULL); // this is the customer Package Id
        $user = $this->identity();
        if ($id == NULL) {
            $this->flashmessenger()->addErrorMessage("There is no identifier for this acquired objects");
            $this->redirect()->toRoute("acquired-packages");
        }
        $packageEntity = $em->find("Customer\Entity\CustomerPackage", $id);
        if ($packageEntity->getAcquiredPackageStatus()->getId() == AcquirePackagesService::ACQUIRED_PACKAGE_PAID) {
            $packageEntity->setAcquiredPackageStatus($em->find("Packages\Entity\PackageStatus", AcquirePackagesService::ACQUIRED_PACKAGE_PAID_PROCESSING))
                ->setUpdateOn(new \DateTime());
        }
        $isIntitiator = $this->initiatorExist($this->identity()
            ->getId(), $id);
        
        // Assign the customerPackage to a broker this makes sure we know who initialized the processing
        if ($isIntitiator == FALSE) {
            $intiator = new CustomerPackageInitiator();
            $intiator->setCreatedOn(new \DateTime())
                ->setPackageProcessor($em->find("CsnUser\Entity\User", $user->getId()))
                ->setCustomerPackages($em->find("Customer\Entity\CustomerPackage", $id));
            $em->persist($intiator);
        }
        try {
            $em->persist($packageEntity);
            
            $em->flush();
            $acquiredPackageSession->acquiredId = $id;
            $this->redirect()->toRoute("acquired-packages/default", array(
                "action" => "process"
            ));
        } catch (\Exception $e) {
            $this->flashmessenger()->addErrorMessage("Something went wrong processing the customer package");
            $this->redirect()->toRoute("acquired-packages");
        }
        return $this->getResponse()->setContent(NULL);
    }

    public function cancelAction()
    {
        $em = $this->entityManager;
        $id = $this->params()->fromRoute("id", NULL);
        
        if ($id == NULL) {
            $this->flashmessenger()->addErrorMessage("There was no identifier for this request");
            $this->redirect()->toRoute("acquired-packages");
        }
        
        $customerPackageEntity = $em->find("Customer\Entity\CustomerPackage", $id);
        $customerPackageEntity->setIsHidden(TRUE)->setUpdatedOn(new \DateTime());
        try {
            $em->persist($customerPackageEntity);
            $em->flush();
            $this->flashmessenger()->addSuccessMessage("The customer package was successfully cancelled");
            $this->redirect()->toRoute("acquired-packages");
        } catch (\Exception $e) {
            $this->flashmessenger()->addErrorMessage("There was a problem canceling this customer package");
        }
        $this->getResponse()->setContent(NULL);
    }

    public function restoreAction()
    {
        $em = $this->entityManager;
        $id = $this->params()->fromRoute("id", NULL);
        
        if ($id == NULL) {
            $this->flashmessenger()->addErrorMessage("There was no identifier for this request");
            $this->redirect()->toRoute("acquired-packages");
        }
        
        $customerPackageEntity = $em->find("Customer\Entity\CustomerPackage", $id);
        $customerPackageEntity->setIsHidden(FALSE)->setUpdatedOn(new \DateTime());
        try {
            $em->persist($customerPackageEntity);
            $em->flush();
            $this->flashmessenger()->addSuccessMessage("The customer package was successfully cancelled");
            $this->redirect()->toRoute("acquired-packages");
        } catch (\Exception $e) {
            $this->flashmessenger()->addErrorMessage("There was a problem canceling this customer package");
        }
        $this->getResponse()->setContent(NULL);
    }

    public function sendMessageAction()
    {
        $em = $this->entityManager;
        $acquiredSession = $this->acquiredSession;
        $acquiredId = $acquiredSession->acquiredId;
        $messageService = $this->messageService;
        $customerPackageEntity = $em->find("Customer\Entity\CustomerPackage", $acquiredId);
        $messageEntity = "";
        if ($customerPackageEntity->getMessages() == NULL) {
            $messageEntity = new Messages();
        } else {
            $messageEntity = $customerPackageEntity->getMessages();
        }
        $request = $this->getRequest();
        // $messageEntity = new Messages();
        if ($request->isPost()) {
            $post = $request->getPost();
            $messageEntered = new MessageEntered();
            $messageEntity->setCreatedOn(new \DateTime())
            ->setMessageCategory($em->find("Settings\Entity\CoverCategory", CoverNoteService::COVERNOTE_CATEGORY_PACKAGES))
            ->setPackages($customerPackageEntity)
            ->setMessageUid($messageService->messageUid())
            ->addMessageEntered($messageEntered);
            
            $postMessageEntered = $post['messageEntered']['messageText'];
            
            $messageEntered->setCreatedOn(new \DateTime())
            ->setBrokerFunction($em->find("Messages\Entity\MessageFunction", MessageService::MESSAGES_FUNCTION_SENDER))
            ->setCustomerFunction($em->find("Messages\Entity\MessageFunction", MessageService::MESSAGE_FUNCTION_RECEIVER))
            ->setMessageStatus($em->find("Messages\Entity\MessageStatus", MessageService::MESSAGE_STATUS_UNREAD))
            ->setMessageText($postMessageEntered)
            ->setMessages($messageEntity);
            
            // var_dump("Hello");
            try {
                $em->persist($messageEntity);
                
                $em->flush();
                
                /**
                 * Send Email notification to the customer inicatng a message has been sent
                 */
                $this->flashmessenger()->addSuccessMessage("Message was successfully Delivered");
                $this->redirect()->toRoute("acquired-packages/default", array(
                    "action" => "process"
                ));
            } catch (\Exception $e) {
                $this->flashmessenger()->addErrorMessage("The message could not be send now, please try again later ");
                $this->redirect()->toRoute("acquired-packages/default", array(
                    "action" => "process"
                ));
            }
        }
        return $this->getResponse()->setContent(NULL);
    }

    public function processAction()
    {
        $em = $this->entityManager;
        $request = $this->getRequest();
       // var_dump($request->getRequestUri());
        $objectForm = $this->newObjectform;
        $messageForm = $this->messageForm;
        $messageForm->setAttributes(array(
            "method" => "POST",
            "action" => $this->url()
            ->fromRoute("acquired-packages/default", array(
                "action" => "send-message"
            ))
        ));
        $selectObjectForm = $this->selectObjectForm;
        $acquiredSession = $this->acquiredSession;
        $acquiredId = $acquiredSession->acquiredId;
        
        if ($acquiredId == NULL) {
            $this->flashmessenger()->addErrorMessage("There is no identifier for this customer acquired package");
            $this->redirect()->toRoute("acquired-packages");
        }
        
        $customerPackageEntity = $em->find("Customer\Entity\CustomerPackage", $acquiredId);
        $broker = $customerPackageEntity->getPackages()->getBroker();
        $view = new ViewModel(array(
            "customerPackageEntity" => $customerPackageEntity,
            "objectForm" => $objectForm,
            "broker" => $broker,
            "messageForm"=>$messageForm,
            "selectObjectForm" => $selectObjectForm
        ));
        return $view;
    }

    public function removeObjectAction()
    {
        $em = $this->entityManager;
        $acquiredSession = $this->acquiredSession;
        $acquiredId = $acquiredSession->acquiredId;
        // $objectService = $this->objectService;
        $objectId = $this->params()->fromRoute("id", NULL);
        $customerPackageEntity = $em->find("Customer\Entity\CustomerPackage", $acquiredId);
        $objectEntity = $em->find("Object\Entity\Object", $objectId);
        // $offerEntity = $em->find("Offer\Entity\Offer", $offerId);
        $customerPackageEntity->setUpdatedOn(new \DateTime());
        $customerPackageEntity->removeObject($objectEntity);
        
        try {
            $em->persist($customerPackageEntity);
            $em->flush();
            $this->flashmessenger()->addSuccessMessage("The Property was successfully removed");
            $this->redirect()->toRoute("acquired-packages/default", array(
                "action" => "process"
            ));
        } catch (\Exception $e) {
            $this->flashmessenger()->addErrorMessage("There was an error while removing the property");
            $this->redirect()->toRoute("acquired-packages/default", array(
                "action" => "process"
            ));
        }
        
        return $this->getResponse()->setContent(NULL);
    }

    public function selectObjectProcessAction()
    {
        $em = $this->entityManager;
        
        $objectService = $this->objectService;
        $request = $this->getRequest();
        $acquiredSession = $this->acquiredSession;
        $acquiredId = $acquiredSession->acquiredId;
        $customerPackageEntity = $em->find("Customer\Entity\CustomerPackage", $acquiredId);
        if ($request->isPost()) {
            $post = $request->getPost();
            if (count($post["selectObjectfield"]['object']) > 0) {
                foreach ($post["selectObjectfield"]['object'] as $obj) {
                    
                    $objectEntity = $em->find("Object\Entity\Object", $obj);
                    $customerPackageEntity->addObject($objectEntity);
                }
            }
            
            try {
                $em->persist($customerPackageEntity);
                $em->flush();
                
                $this->flashmessenger()->addSuccessMessage("Property successfully included");
                $this->redirect()->toRoute("acquired-packages/default", array(
                    "action" => "process"
                ));
            } catch (\Exception $e) {
                $this->flashmessenger()->addErrorMessage("The property could not be included");
                $this->redirect()->toRoute("acquired-packages/default", array(
                    "action" => "process"
                ));
            }
        }
        return $this->getResponse()->setContent(NULL);
    }

    public function objectFormProcessAction()
    {
        $em = $this->entityManager;
        $acquiredSession = $this->acquiredSession;
        $acquiredId = $acquiredSession->acquiredId;
        $objectService = $this->objectService;
        $request = $this->getRequest();
        $customerPackageEntity = $em->find("Customer\Entity\CustomerPackage", $acquiredId);
        
        $objectEntity = new Object();
        $objectForm = $this->newObjectform;
        $objectForm->bind($objectEntity);
        if ($request->isPost()) {
            $post = $request->getPost();
            $strippedValue = str_replace(',', '', $post["value"]);
            
            $objectEntity->setCreatedOn(new \DateTime())
                ->setCustomer($em->find("Customer\Entity\Customer", $customerPackageEntity->getCustomer()
                ->getId()))
                ->setCurrency($em->find("Settings\Entity\Currency", $post['currency']))
                ->setValue($strippedValue)
                ->setObjectName($post["objectName"])
                ->setIsHidden(FALSE)
                ->setObjectStatus($em->find("Object\Entity\ObjectStatus", ObjectService::OBJECT_STATUS_PROCESSING))
                ->setObjectType($em->find("Settings\Entity\ObjectType", $post["objectType"]))
                ->setObjectUid($objectService->generateObjectUid())
                ->setValueLocked(FALSE);
            //
            
            $customerPackageEntity->addObject($objectEntity);
            $customerPackageEntity->setUpdatedOn(new \DateTime());
            
            try {
                $em->persist($objectEntity);
               // var_dump("Help");
                $em->persist($customerPackageEntity);
                $em->flush();
                
                $this->flashmessenger()->addSuccessMessage("The property was successfully created");
                $this->redirect()->toRoute("acquired-packages/default", array(
                    "action" => "process"
                ));
            } catch (\Exception $e) {
                $this->flashmessenger()->addError("There was an Error creating this Property");
                $this->redirect()->toRoute("acquired-packages\default", array(
                    "action" => "process"
                ));
            }
        }
        return $this->getResponse()->setContent(NULL);
    }

    public function invoiceGenerateAction()
    {
        $em = $this->entityManager;
        $acquiredSession = $this->acquiredSession;
        $acquiredId = $acquiredSession->acquiredId;
        $invoiceService = $this->invoiceService;
        
        $customerPackageEntity = $em->find("Customer\Entity\CustomerPackage", $acquiredId);
        if ($customerPackageEntity->getInvoice() != NULL) {
            $invoiceEntity = $customerPackageEntity->getInvoice();
        } else {
            $invoiceEntity = new Invoice();
        }
        
        $premiumSession = new Container("customer_package_premium");
        
        $invoiceEntity->setAmount($premiumSession->premium)
            ->setCustomer($em->find("Customer\Entity\Customer", $customerPackageEntity->getCustomer()
            ->getId()))
            ->setGeneratedOn(new \DateTime())
            ->setExpiryDate(new \DateTime())
            ->setInvoiceCategory($em->find("Transactions\Entity\InvoiceCategory", InvoiceService::INVOICE_CAT_PACKAGE))
            ->setInvoiceUid($invoiceService->generateInvoiceNumber())
            ->setStatus($em->find("Transactions\Entity\InvoiceStatus", InvoiceService::INVOICE_UNPAID_STATUS))
            ->setCurrency($em->find("Settings\Entity\Currency", $premiumSession->premiumCurrency))
            ->setIsOpen(TRUE)
            ->setPackages($customerPackageEntity);
        
        try {
            $em->persist($invoiceEntity);
            
            $em->flush();
            $this->flashmessenger()->addSuccessMessage("Invoice Successfully Generated");
            $this->redirect()->toRoute("acquired-packages/default", array(
                "action" => "process"
            ));
        } catch (\Exception $e) {
            $this->flashmessenger()->addErrorMessage("The invoice could not be generated ");
            $this->redirect()->toRoute("acquired-packages/default", array(
                "action" => "process"
            ));
        }
        
        return $this->getResponse()->setContent(NULL);
    }

    public function generateCoverNoteAction()
    {
        $em = $this->entityManager;
        $mailService = $this->mailService;
        $coverNoteService = $this->coverNoteService;
        $coverNoteSession = $coverNoteService->getCoverNoteSession();
        $acquiredSession = $this->acquiredSession;
        $acquiredId = $acquiredSession->acquiredId;
        $customerPackageEntity = $em->find("Customer\Entity\CustomerPackage", $acquiredId);
        var_dump("HI");
        if ($customerPackageEntity->getCoverNote() == NULL) {
            $coverNoteEntity = new CoverNote();
            $coverNoteEntity->setDateCreated(new \DateTime());
        } else {
            $coverNoteEntity = $customerPackageEntity->getCoverNote();
        }
        
        
        $customerPackageEntity->setIsPolicized(TRUE)->setUpdatedOn(new \DateTime())->setAcquiredPackageStatus($em->find("Packages\Entity\PackageStatus", AcquirePackagesService::ACQUIRED_PACKAGE_SETTLED));
        
      
        $coverNoteEntity->setInsurer($customerPackageEntity->getPackages()->getPackagedInsurer());
        //var_dump("LOW");
        $dueDate = new \DateTime();
        $addMonths = 'P1M'; // sets the string for the date interval
        $interval = new \DateInterval($addMonths); // sets the actual interval
        $dueDate->add($interval);
        
        $coverNoteEntity->setCoverUid($this->coverNoteService->coverNoteUid())
        ->setCustomer($customerPackageEntity->getCustomer())
        ->setBroker($em->find("Users\Entity\InsuranceBrokerRegistered", $this->centralBrokerId))
        ->setIsHidden(false)
        ->setCoverStatus($em->find("Policy\Entity\CoverNoteStatus", CoverNoteService::COVERNOTE_STATUS_PROCESSING_POLICY))
        ->setCoverCategory($em->find("Settings\Entity\CoverCategory", CoverNoteService::COVERNOTE_CATEGORY_PACKAGES))
        ->setPackage($customerPackageEntity)
        ->setIsPolicy(FALSE)
        ->setDueDate($dueDate);
        
        try {
            $em->persist($customerPackageEntity);
            $em->persist($coverNoteEntity);
            $em->flush();
            /**
             * Send Mail Notification
             */
            $coverNoteSession->coverNoteId = $coverNoteEntity->getId();
            $this->flashmessenger()->addSuccessMessage("Cover Note was successfuly Generated and the customer has beeen Notified");
            $this->redirect()->toRoute("cover-note/default", array(
                "action" => "pre-view", "id"=>$coverNoteEntity->getId()
            ));
        } catch (\Exception $e) {
            $this->flashmessenger()->addSuccessMessage("There was a problem generating the coverNote");
            $this->redirect()->toRoute("acquired-packages/default", array(
                "action" => "process"
            ));
        }
        return $this->getResponse()->setContent(NULL);
    }

    public function indexAction()
    {
        $em = $this->entityManager;
        $packageService = $this->packageService;
        $customerPackages = $packageService->getAllCustomerAcquiredPackage();
        // var_dump($customerPackages);
        $view = new ViewModel(array(
            "customerPackages" => $customerPackages
        ));
        return $view;
    }

    public function sendReminderAction()
    {
        /**
         * this sends a reminder to the customersemail associated to the package
         * also remember to create a jobs to do the reminder automatically
         */
        $em = $this->entityManager;
        $mailService = "";
        $acquirePackageId = $this->params()->fromRoute("id", NULL);
        if ($acquirePackageId == NULL) {
            $this->flashmessenger()->addErrorMessage("There is no Identifeir for this Acquired Package");
            $this->redirect()->toRoute("acquired-packages");
        }
        
        $acquiredPackageEntity = $em->find("Customer\Entity\CustomerPackage", $acquirePackageId);
        $customerEmail = $acquiredPackageEntity->getCustomer()
            ->getUser()
            ->getEmail();
        
        /**
         * Process sending email to this email
         */
        
        $this->getResponse()->setContent("NULL");
    }

    // Begin Setters
    public function setPackageService($xserv)
    {
        $this->packageService = $xserv;
        return $this;
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }

    public function setGeneralService($gen)
    {
        $this->generalService = $gen;
        return $this;
    }

    public function setAcquiredSession($sess)
    {
        $this->acquiredSession = $sess;
        return $this;
    }

    public function setNewObjectform($form)
    {
        $this->newObjectform = $form;
        return $this;
    }

    public function setSelectObjectForm($form)
    {
        $this->selectObjectForm = $form;
        return $this;
    }

    public function setObjectService($xserv)
    {
        $this->objectService = $xserv;
        return $this;
    }

    public function setInvoiceService($xserv)
    {
        $this->invoiceService = $xserv;
        return $this;
    }

    public function setMessageForm($form)
    {
        $this->messageForm = $form;
        return $this;
    }

    public function setMessageService($xserv)
    {
        $this->messageService = $xserv;
        return $this;
    }
    
    public function setCoverNoteService($xserv){
        $this->coverNoteService = $xserv;
        return $this;
    }
    public function setMailService($xserv){
        $this->mailService = $xserv;
        return $this;
    }
    
    public function setCentralBrokerId($id){
        $this->centralBrokerId = $id;
        return $this;
    }
    
    // End Setters
}

