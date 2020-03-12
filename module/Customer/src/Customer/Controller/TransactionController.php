<?php
namespace Customer\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use WasabiLib\Ajax\Response;

/**
 *
 * @author otaba
 *        
 */
class TransactionController extends AbstractActionController
{

    private $entityManager;

    private $clientGeneralService;

    private $renderer;

    /**
     */
    public function __construct()
    {

        // TODO - Insert your code here
    }

    /**
     * This function creates a pdf of the transaction made
     *
     * @return mixed
     */
    public function recieptpdfAction()
    {
        $response = new Response();
        $transactionUid = $this->params()->fromQuery("data", NULL);
        return $this->getResponse()->setContent($response);
    }
    
    public function invoicepdfAction(){
        $response = new Response();
        $invoiceUid = $this->params()->fromQuery("data", NULL);
        $em = $this->entityManager;
        $broker = $this->clientGeneralService->getNrokerId();
        if($invoiceUid != NULL){
            $viewModel = new ViewModel();
        }
        
        return $this->getResponse()->setContent($response);
    }

    public function indexAction()
    {

        // cus_transact
        $view = new ViewModel();
        return $view;
    }

    public function viewAction()
    {
        $view = new ViewModel();
        return $this;
    }
    /**
     * @return mixed
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }

    /**
     * @return mixed
     */
    public function getClientGeneralService()
    {
        return $this->clientGeneralService;
    }

    /**
     * @return mixed
     */
    public function getRenderer()
    {
        return $this->renderer;
    }

    /**
     * @param mixed $entityManager
     */
    public function setEntityManager($entityManager)
    {
        $this->entityManager = $entityManager;
        return $this;
    }

    /**
     * @param mixed $clientGeneralService
     */
    public function setClientGeneralService($clientGeneralService)
    {
        $this->clientGeneralService = $clientGeneralService;
        return $this;
    }

    /**
     * @param mixed $renderer
     */
    public function setRenderer($renderer)
    {
        $this->renderer = $renderer;
        return $this;
    }

}

