<?php
namespace Settings\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;
use Transactions\Entity\Invoice;
use Transactions\Service\InvoiceService;
use GeneralServicer\Service\CurrencyService;

/**
 *
 * @author swoopfx
 *        
 */
class AccountController extends AbstractActionController
{

    private $renewalForm;

    private $generalService;

    private $entityManager;

    private $invoiceService;
    
    private $otpForm;
    
    private $paymentService;
    
    private $smsService ;
    
    private  $mailService;
    
    private $brokerSub;
    
    private $centralBrokerId;
    
    private $brokerForm;

    public function __construct()
    {}
    
    public function editProfileAction(){
        $em = $this->entityManager;
        $brokerForm = $this->brokerForm;
        $centralBrokerId = $this->centralBrokerId;
        $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $centralBrokerId);
        if($brokerEntity == NULL){
            $this->flashmessenger()->addErrorMessage("No Identifier for this Edit Rpofile");
            $this->redirect()->toRoute("dashboard");
        }
        $brokerForm->setAttributes(array(
            "action"=>$this->url()->fromRoute("sub_account/default", array("action"=>"edit-profile")),
        ));
        $brokerForm->bind($brokerEntity);
        $view = new ViewModel(array(
            "brokerEntity"=>$brokerEntity,
            "brokerForm"=>$brokerForm,
        ));
        return $view;
    }

    public function renewAccountAction()
    {
        
        $em = $this->entityManager;
        $form = $this->renewalForm;
        $paymentService = $this->paymentService;
        $smsService = $this->smsService;
        $generalService = $this->generalService;
        $centralBrokerId = $this->centralBrokerId;
        $otPForm = $this->otpForm;
        $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $centralBrokerId);
        $repo = $em->getRepository('Settings\Entity\Packages')->findBy(array(
            'packageCategory' => 2
        ));
//         $brokerId = $this->generalService->getBrokerId();
//         $sub = $this->generalService->getSubscription();
        if ($brokerEntity == NULL) {
            $this->flashmessenger()->addErrorMessage("We could v not get the Broker Identitfier");
            $this->redirect()->toRoute("dashboard");
        }
        //$broker = $em->find("Users\Entity\InsuranceBrokerRegistered", $brokerId);
        $invoiceService = $this->invoiceService;
        $request = $this->getRequest();
        
        if ($request->isPost()) {
            $data = $request->getPost();
            //$form->setData($data);
            //if ($form->isValid()) {
                // if the submit button is clicked
                // generate Invoice
                // innput total months into a session
                // Thi is used to calaulate the xtension of the expiry Date , and SMS
                //$data = $form->getData();
                
            
                //Begin Invoice processing
                $invoiceEntity = new Invoice();
                $invoiceEntity->setAmount($data['totalAmount']);
                $invoiceEntity->setGeneratedOn(new \DateTime());
                $invoiceEntity->setInvoiceCategory($em->find("Transactions\Entity\InvoiceCategory", InvoiceService::INVOICE_CAT_BROKER_SUB));
                $invoiceEntity->setInvoiceUid($invoiceService->generateInvoiceNumber());
                $invoiceEntity->setStatus($em->find("Transactions\Entity\InvoiceStatus", InvoiceService::INVOICE_UNPAID_STATUS));
                $invoiceEntity->setCurrency($em->find("Settings\Entity\Currency", CurrencyService::NIGERIA_NAIRA));
                $invoiceEntity->setIsOpen(TRUE);
                $invoiceEntity->getInvoiceUser()->setUser($this->identity());
                $invoiceEntity->getInvoiceUser()->setInvoice($invoiceEntity);
                
                // End Invoice Processing 
                
                // Begin Payment Processing
                
                // End Payment Processing 
                try {
                    $em->persist($invoiceEntity);
                    $em->flush();
                    $sessInvocie = new Container('renew-invoice');
                    $sessInvocie->setExpirationSeconds(60 * 60 * 24);
                    $sessInvocie->invoice = $invoiceEntity->getId(); // set Invoice Id
                    $data = $form->getData();
                    $this->redirect()->toRoute("sub_account", array(
                        'action' => 'renew-invoice'
                    ));
                } catch (\Exception $e) {}
            }
      // }
        $view = new ViewModel(array(
            'form' => $form,
            
            'broker' => $brokerEntity,
            'repo' => $repo
        ));
        return $view;
    }
    
    public function otpAction(){
        return $this->getResponse()->setContent(NULL);
    }

    public function renewInvoiceAction()
    {
        $em = $this->entityManager;
        $sessInvoice = new Container('renew-invoice');
        $invoice = $em->find("", $sessInvoice->invoice);
        $view = new ViewModel(array(
            
            'invoice' => $invoice
        ));
        return $this;
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }

    public function setRenewalForm($form)
    {
        $this->renewalForm = $form;
        return $this;
    }

    public function setgeneralService($xserv)
    {
        $this->generalService = $xserv;
        return $this;
    }

    public function setInvoiceService($xserv)
    {
        $this->invoiceService = $xserv;
        return $this;
    }
    
    public function setOptForm($form){
        $this->otpForm = $form;
        return $this;
    }
    
    public function setPaymentService($xserv){
        $this->paymentService = $xserv;
        return $this;
    }
    
    public function setSmsService($xserv){
        $this->smsService = $xserv;
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
    
    public function setBrokerForm($form){
        $this->brokerForm = $form;
        return $this;
    }
}

