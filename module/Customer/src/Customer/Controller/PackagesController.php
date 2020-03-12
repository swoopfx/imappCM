<?php
namespace Customer\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Customer\Entity\CustomerPackage;
use Zend\Session\Container;
use Object\Entity\Object;
use Object\Service\ObjectService;
use Packages\Service\AcquirePackagesService;
use Transactions\Service\InvoiceService;
use Transactions\Entity\Invoice;
use Messages\Entity\Messages;
use Messages\Entity\MessageEntered;
use Policy\Service\CoverNoteService;
use Messages\Service\MessageService;

class PackagesController extends AbstractActionController
{

    private $entityManager;

    private $customerBoardService;

    private $customerPackageService;

    private $customerPackageEntity;

    private $clientGeneralService;

    private $acquiredPackageService;
    
    private $selectObjectForm;

    private $objectForm;

    private $objectService;

    private $invoiceService;
    
    private $messageForm;
    
    private $messageService;

    public function onDispatch(\Zend\Mvc\MvcEvent $e)
    {
        $response = parent::onDispatch($e);
        $this->customerRedirectPlugin()->totalRedirection();
        $this->layout()->setTemplate('client-layout-board');
        return $response;
    }

    public function indexAction()
    {
        $customerBoardService = $this->customerBoardService;
        
        $id = $this->params()->fromRoute("id", NULL);
        $brokerPackages = NULL;
        if ($id !== NULL) {
            $brokerPackages = $customerBoardService->allBrokerFilteredPackages($id);
        } else {
            
            $brokerPackages = $customerBoardService->allBrokersPackages();
        }
        $view = new ViewModel(array(
            'packages' => $brokerPackages
        ));
        return $view;
    }

    /**
     * This viewa all active packages on the platform
     *
     * @return \Zend\View\Model\ViewModel
     */
    public function activeAction()
    {
        $em = $this->entityManager;
        $customerBoardService = $this->customerBoardService;
        $activePackages = $customerBoardService->customerActivePackage();
        $view = new ViewModel(array(
            'packages' => $activePackages
        ));
        
        return $view;
    }

    /**
     * This action get a value and displays the actual
     * filetered version of Packages on tand displa them
     *
     * @return \Zend\View\Model\ViewModel
     */
    // public function filterAction() {
    // $em = $this->entityManager;
    // $id = $this->params ()->fromRoute ( "id", NULL );
    
    // return $view;
    // }
    public function viewAction()
    {
        $em = $this->entityManager;
        
        $id = $this->params()->fromRoute("id", NULL);
       // $package = $em->find("Packages\Entity\Packages", $id);
        $package = $em->getRepository("Packages\Entity\Packages")->findOneBy(array(
            "packageUid"=>$id
        ));
        $view = new ViewModel(array(
            'package' => $package
        ));
        
        return $view;
    }
    
    public function selectObjectProcessAction(){
        $em = $this->entityManager;
        // $objectService = $this->objectService;
        $request = $this->getRequest();
        //         $offerService = $this->offerService;
        //         $offerId = $offerService->getOfferSession()->offerId;
        $acquirePackageSession = new Container("acquire_package");
        $id = $acquirePackageSession->customerPackageId;
        $customerPackageEntity = $em->find("Customer\Entity\CustomerPackage", $id);
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
                $this->redirect()->toRoute("cus_pack/default", array(
                    "action" => "acquire"
                ));
            } catch (\Exception $e) {
                $this->flashmessenger()->addErrorMessage("The property could not be included");
                $this->redirect()->toRoute("cus_pack/default", array(
                    "action" => "acquire"
                ));
            }
        }
        return $this->getResponse()->setContent(NULL);
    }
    
   
    
    public function sendMessageAction(){
        $em = $this->entityManager;
        $acquirePackageSession = new Container("acquire_package");
        $id = $acquirePackageSession->customerPackageId;
        $customerPackageEntity = $em->find("Customer\Entity\CustomerPackage", $id);
        // $customerOfferSession->isFromOfferNowAction = TRUE;
        $messageService = $this->messageService;
        //$id = $customerOfferSession->offerId;
       
        
        $messageEntity = "";
        
        if($customerPackageEntity->getMessages() == NULL){
            $messageEntity = new Messages();
        }else{
            $messageEntity = $customerPackageEntity->getMessages();
        }
        
        $request = $this->getRequest();
        if($request->isPost()){
            $post = $request->getPost();
            $messageEntered = new MessageEntered();
            $messageEntity->setCreatedOn(new \DateTime())
            ->setMessageCategory($em->find("Settings\Entity\CoverCategory", CoverNoteService::COVERNOTE_CATEGORY_PACKAGES))
            ->setPackages($customerPackageEntity)
            ->setMessageUid($messageService->messageUid())
            ->addMessageEntered($messageEntered);
            
            $postMessageEntered = $post['messageEntered']['messageText'];
            
            $messageEntered->setCreatedOn(new \DateTime())
            ->setBrokerFunction($em->find("Messages\Entity\MessageFunction", MessageService::MESSAGE_FUNCTION_RECEIVER))
            ->setCustomerFunction($em->find("Messages\Entity\MessageFunction", MessageService::MESSAGES_FUNCTION_SENDER))
            ->setMessageStatus($em->find("Messages\Entity\MessageStatus", MessageService::MESSAGE_STATUS_UNREAD))
            ->setMessageText($postMessageEntered)
            ->setMessages($messageEntity);
            
            try{
                $em->persist($messageEntity);
                // $em->persist($messageEntered);
                $em->flush();
                /**
                 * Send Email Notification
                 */
                
                $this->flashmessenger()->addSuccessMessage("Message was successfully Delivered");
                $this->redirect()->toRoute("cus_pack/default", array(
                    "action" => "acquire"
                ));
                
            }catch (\Exception $e){
                $this->flashmessenger()->addErrorMessage("The message could not be send now, please try again later ");
                $this->redirect()->toRoute("cus_pack/default", array(
                    "action" => "acquire"
                ));
            }
            
        }
        return $this->getResponse()->setContent(NULL);
    }
    
    

    public function preacquireAction()
    {
        $em = $this->entityManager;
        
        $clinetGeneralService = $this->clientGeneralService;
        
        $acquirePackageSession = new Container("acquire_package");
        $id = $this->params()->fromRoute("id", NULL);
        $customerPackageEntity = new CustomerPackage();
        $acquiredPackageService = $this->acquiredPackageService;
        $customerPackageEntity->setPackages($em->find("Packages\Entity\Packages", $id))
            ->setCustomer($em->find("Customer\Entity\Customer", $clinetGeneralService->getCustomerId()))
            ->setIsActive(TRUE)
            ->setCreatedOn(new \DateTime())
            ->setCustomerPackageUid($acquiredPackageService->generarateCustomerPackageUid())
            ->setIsHidden(FALSE)
            ->setIsPolicized(FALSE)
            ->setAcquiredPackageStatus($em->find("Packages\Entity\PackageStatus", AcquirePackagesService::ACQUIRED_PACKAGE_PROCESSING));
        
        $packageEntity = $em->find("Packages\Entity\Packages", $id);
        try {
            
            $em->persist($customerPackageEntity);
            $em->flush();
            $acquirePackageSession->customerPackageId = $customerPackageEntity->getId();
            $this->redirect()->toRoute("cus_pack/default", array(
                "action" => "acquire"
            ));
        } catch (\Exception $e) {
            $this->flashmessenger()->addErrorMessage("There was a problem processing you request");
            $this->redirect()->toRoute("cus_pack", array(
                "action" => "view",
                "id" => $packageEntity->getPackageUid()
            ));
        }
        
        return $this->getResponse()->setContent(NULL);
    }

    /**
     * This is defined as continue acquire
     */
    public function conAcquireAction()
    {
        
        /**
         * This collects the customerPackageId
         *
         * @var unknown $em
         */
        $em = $this->entityManager;
        $clinetGeneralService = $this->clientGeneralService;
        $acquirePackageSession = new Container("acquire_package");
        $id = $this->params()->fromRoute("id", NULL);
        $acquirePackageSession->customerPackageId = $id;
        $this->redirect()->toRoute("cus_pack/default", array(
            "action" => "acquire"
        ));
        return $this->getResponse()->setContent(NULL);
    }

    public function acquireAction()
    {
        $em = $this->entityManager;
        $clinetGeneralService = $this->clientGeneralService;
        $generalService = $clinetGeneralService->getGeneralService();
        $generalSession = $generalService->getGeneralSession();
        $generalSession->currentCustomerid = $this->clientGeneralService->getCustomerId();
        //var_dump($generalSession->currentCustomerid);
        $customerPackageService = $this->customerPackageService;
        $acquirePackageSession = new Container("acquire_package");
        $objectForm = $this->objectForm;
        $selectObjectForm = $this->selectObjectForm;
        $messageForm = $this->messageForm;
        $messageService = $this->messageService;
        
        $messageForm->setAttributes(array(
            "action"=>$this->url()->fromRoute("cus_pack/default", array("action"=>"send-message")),
            "method"=>"POST"
        ));
        /**
         * If the reditrection is succesful
         * get The information about the customerPackage from the database
         * Create a payment scheme
         * Create a form for entering the value of the object
         * Create an ajax form for object entering
         * or selecting objects from the database
         */
        $id = $acquirePackageSession->customerPackageId;
        $customerPackage = $em->find("Customer\Entity\CustomerPackage", $id);
        
        $objectCategory = $customerPackage->getPackages()
            ->getPackageCategory()
            ->getId();
        $customerPackageService->setObjectTypeCategory($objectCategory)->setCustomerPackageId($id); // defines if this is motor
        $objects = $customerPackageService->customerPackageObject();
        
        $view = new ViewModel(array(
            'package' => $customerPackage,
            "objectForm" => $objectForm,
            "objectCategory" => $objectCategory,
            "objects" => $objects,
            "selectObjectForm"=>$selectObjectForm,
            "messageForm"=>$messageForm,
        ));
        
        return $view;
    }

    public function objectFormProcessAction()
    {
        $em = $this->entityManager;
        $acquirePackageSession = new Container("acquire_package");
        $objectForm = $this->objectForm;
        $objectService = $this->objectService;
        $clientGeneralService = $this->clientGeneralService;
        $customerPackageId = $acquirePackageSession->customerPackageId;
        $request = $this->getRequest();
        $objectEntity = new Object();
        $customerPackageEntity = $em->find("Customer\Entity\CustomerPackage", $customerPackageId);
        // $objectForm->bind($customerPackageEntity);
        if ($request->isPost()) {
            
            $post = $request->getPost();
            $strippedValue = str_replace(',', '', $post["value"]);
            $objectEntity->setCreatedOn(new \DateTime())
                ->setCustomer($em->find("Customer\Entity\Customer", $clientGeneralService->getCustomerId()))
                ->setCurrency($em->find("Settings\Entity\Currency", $post['currency']))
                ->setValue($strippedValue)
                ->setObjectName($post["objectName"])
                ->setIsHidden(FALSE)
                ->setObjectStatus($em->find("Object\Entity\ObjectStatus", ObjectService::OBJECT_STATUS_PROCESSING))
                ->setObjectType($em->find("Settings\Entity\ObjectType", $post["objectType"]))
                ->setObjectUid($objectService->generateObjectUid())
                ->setValueLocked(FALSE);
                
            $customerPackageEntity->addObject($objectEntity);
            $customerPackageEntity->setUpdatedOn(new \DateTime());
            var_dump('hi');
            try {
                $em->persist($objectEntity);
                $em->persist($customerPackageEntity);
                $em->flush();
                
                $this->flashmessenger()->addSuccessMessage("The Property was successfully registered");
                $this->redirect()->toRoute("cus_pack/default", array(
                    "action" => "acquire"
                ));
            } catch (\Exception $e) {
                $this->flashmessenger()->addErrorMessage("THe proprety was not successfully registered");
                $this->redirect()->toRoute("cus_pack/default", array(
                    "action" => "acquire"
                ));
            }
        }
        $this->getResponse()->setContent(NULL);
    }

    public function prePaymentAction()
    {
        $em = $this->entityManager;
        $invoiceEntity = "";
        $acquirePackageSession = new Container("acquire_package");
        $clientGeneralService = $this->clientGeneralService;
        
        $generalSession = $clientGeneralService->getGeneralSession();
        
        $customerPackageId = $acquirePackageSession->customerPackageId;
        $premiumSession = new Container("customer_package_premium");
        $customerPackageEntity = $em->find("Customer\Entity\CustomerPackage", $customerPackageId);
        
        if ($customerPackageEntity->getInvoice() != NULL) {
            $invoiceEntity = $customerPackageEntity->getInvoice();
        } else {
            $invoiceEntity = new Invoice();
            
            $invoiceEntity->setGeneratedOn(new \DateTime());
        }
        // var_dump("papa");
        
        $invoiceEntity->setAmount($premiumSession->premium)
            ->setCurrency($em->find("Settings\Entity\Currency", $premiumSession->premiumCurrency))
            ->setCustomer($em->find("Customer\Entity\Customer", $this->clientGeneralService->getCustomerId()))
            ->setGeneratedOn(new \DateTime())
            ->setExpiryDate(new \DateTime())
            ->setInvoiceCategory($em->find("Transactions\Entity\InvoiceCategory", InvoiceService::INVOICE_CAT_PACKAGE))
            ->
        setInvoiceUid($this->invoiceService->generateInvoiceNumber())
            ->setIsOpen(TRUE)
            ->setStatus($em->find("Transactions\Entity\InvoiceStatus", InvoiceService::INVOICE_UNPAID_STATUS))
            ->setModifiedOn(new \DateTime())
            ->setPackages($customerPackageEntity);
        ;
        
        try {
            $em->persist($invoiceEntity);
            $em->flush();
            $generalSession->InvoiceId = $invoiceEntity->getId();
            $this->redirect()->toRoute("board/default", array(
                "action" => "payment"
            ));
        } catch (\Exception $e) {
            $this->flashmessenger()->addErrorMessage("There was a problem processing the invoice");
            $this->redirect()->toRoute("cus_pack/default", array(
                "action" => "active"
            ));
        }
        return $this->getResponse()->setContent(NULL);
    }

    public function removeObjectAction()
    {
        $em = $this->entityManager;
        $objectId = $this->params()->fromRoute("id", NULL);
        $objectEntity = $em->find("Object\Entity\Object", $objectId);
        $customerPackageSession = new Container("acquire_package");
        $customerPackageId = $customerPackageSession->customerPackageId;
        $customerPackageEntity = $em->find("Customer\Entity\CustomerPackage", $customerPackageId);
        
        $customerPackageEntity->setUpdatedOn(new \DateTime());
        $customerPackageEntity->removeObject($objectEntity);
        var_dump("HI");
        try {
            $em->persist($customerPackageEntity);
            $em->flush();
            $this->flashmessenger()->addSuccessMessage("The property was successfully removed ");
            $this->redirect()->toRoute("cus_pack/default", array(
                "action" => "acquire"
            ));
        } catch (\Exception $e) {
            $this->flashmessenger()->addErrorMessage("There was a challenge removing this property from the package");
            $this->redirect()->toRoute("cus_pack/default", array(
                "action" => "acquire"
            ));
        }
        return $this->getResponse()->setContent(NULL);
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }

    public function setCustomerBoardService($xserv)
    {
        $this->customerBoardService = $xserv;
        return $this;
    }

    public function setCustomerPackageService($xserv)
    {
        $this->customerPackageService = $xserv;
        return $this;
    }

    public function setCustomerPackageEntity($entity)
    {
        $this->customerPackageEntity = $entity;
        return $this;
    }

    public function setClientGeneralService($xserv)
    {
        $this->clientGeneralService = $xserv;
        return $this;
    }

    public function setAcquiredPackageService($xserv)
    {
        $this->acquiredPackageService = $xserv;
        return $this;
    }

    public function setObjectForm($form)
    {
        $this->objectForm = $form;
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
    
    public function setSelectObjetForm($form){
        $this->selectObjectForm= $form;
        return $this;
    }
    
    public function setMessageForm($form){
        $this->messageForm =  $form;
        return $this;
        
    }
    
    public function setMessageService($xserv){
        $this->messageService = $xserv;
        return $this;
    }
}