<?php
namespace Customer\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use WasabiLib\Ajax\Response;
use WasabiLib\Ajax\GritterMessage;
use WasabiLib\Modal\WasabiModal;
use WasabiLib\Modal\WasabiModalConfigurator;
use WasabiLib\Modal\WasabiModalView;

class InvoiceController extends AbstractActionController
{

    // public function onDispatch(\Zend\Mvc\MvcEvent $e)
    // {
    // $response = parent::onDispatch($e);
    
    // //$this->layout()->setTemplate('client-layout-board');
    // return $response;
    // }
    private $entityManager;
    
    private $clientGeneralService;
    
    private $customerBoardService;
    
    private $renderer;
    
    private $centralBrokerId;

    public function indexAction()
    {
        $this->layout()->setTemplate('client-layout-board');
        $this->customerRedirectPlugin()->totalRedirection();
        $clientGeneralService = $this->clientGeneralService;
        $customerBoardService = $this->customerBoardService;
        $invoices = $customerBoardService->customerInvoices();
        $view = new ViewModel(array(
            "invoices"=>$invoices
        ));
        return $view;
    }
    
    public function invoicepreviewmodalAction(){
        $em = $this->entityManager;
        $response = new Response();
        $invoiceId = $this->params()->fromQuery("data", NULL);
        $centralBrokerId = $this->clientGeneralService->getBrokerId();
        if ($invoiceId == NULL) {
            $gritter = new GritterMessage();
            $gritter->setType(GritterMessage::TYPE_ERROR);
            $gritter->setText("Invoice ID not transmitted");
            $gritter->setTitle("Invoice Id Error");
            $response->add($gritter);
        } else {
            $invoiceEntity = $em->find("Transactions\Entity\Invoice", $invoiceId);
            $broker = $em->find("Users\Entity\InsuranceBrokerRegistered", $centralBrokerId);
            $viewModel = new ViewModel(array(
                "invoice" => $invoiceEntity,
                "broker" => $broker
            ));
            $viewModel->setTemplate("proposal-invoice-preview-modal");
            $modal = new WasabiModal("standard", "Invoice Preview");
            $modal->setSize(WasabiModalConfigurator::MODAL_LG);
            $modal->setContent($viewModel);
            
            $modalView = new WasabiModalView("#dialog", $this->rend, $modal);
            
            $response->add($modalView);
        }
        return $this->getResponse()->setContent($response);
    }

    public function viewAction()
    {
        $em = $this->entityManager;
        $clientGeneralService = $this->clientGeneralService;
        $generalSession = $clientGeneralService->getGeneralSession();
        
        if ($this->identity() == TRUE) {
            $this->customerRedirectPlugin()->totalRedirection();
            $this->layout()->setTemplate('client-layout-board');
        } else {
            $this->layout()->setTemplate("customer-layout-invoice");
        }
        //$this->layout()->setTemplate("customer-layout-invoice");
        
        $invoiceUid = $this->params()->fromRoute("id", NULL);
        if($invoiceUid == NULL ){
            $this->flashmessenger()->addErrorMessage("There is no Invoice Identifier available");
            $this->redirect()->toRoute("cus_invoice");
        }
        $criteria = array(
            "invoiceUid"=>$invoiceUid,
        );
        $invoiceEntity = $em->getRepository("Transactions\Entity\Invoice")->findOneBy($criteria);
        $generalSession->InvoiceId = $invoiceEntity->getId();
        $view = new ViewModel(array(
            "invoiceEntity"=>$invoiceEntity,
        ));
        return $view;
    }
    
    
    
    public function transactionsAction(){
        $em = $this->entityManager;
        
        $this->layout()->setTemplate('client-layout-board');
        $view = new ViewModel();
        return $view;
    }
    
   

    public function payAction()
    {
        $this->customerRedirectPlugin()->totalRedirection();
        $this->customerRedirectPlugin()->totalRedirection();
        $view = new ViewModel();
        return $view;
    }
    
    public function setEntityManager($em){
        $this->entityManager = $em ;
        return $this;
    }
    
    public function setCustomerBoardService($xserv){
        $this->customerBoardService = $xserv;
        return $this;
    }
    
    public function setClientGeneralService($xserv){
        $this->clientGeneralService = $xserv;
        return $this;
    }
    
    public function setRenderer($ren){
        $this->renderer = $ren;
        return $this;
    }
}