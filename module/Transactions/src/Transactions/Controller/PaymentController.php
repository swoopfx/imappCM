<?php
namespace Transactions\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use WasabiLib\Ajax\Response;
use WasabiLib\Modal\WasabiModal;

/**
 *
 * @author swoopfx
 *        
 */
class PaymentController extends AbstractActionController
{
    private $entityManager;
    
    private $paymentService;
    
    private $generalService;
    
    private $raveCardPaymentService;
    
    
    
    
    
   
    
    public function indexAction(){
        $em = $this->entityManager;
        $allManualPayment = 
        $view = new ViewModel();
        return $view;
    }
    
    /**
     * This function gets the invoice entity meant to be paid
     * Processes the logic for payment 
     * Confirms otp 
     */
   public function processpaymentAction(){
       $em = $this->entityManager;
      
       $raveCardPaymentService = $this->raveCardPaymentService;
       $generalService = $this->generalService;
       $generalSession = $generalService->getGeneralSession();
       $invoiceId = $generalSession->brokerInvoiceId;
       $response = new Response();
       return $this->getResponse()->setContent($response);
   }
    
    public function viewManualPaymentAction(){
        $em = $this->entityManager;
        $paymentService = $this->paymentService;
        $allPayment = $paymentService->getAllAmanualPayment();
       // var_dump($allPayment);
       //var_dump(count($allPayment));
        $view = new ViewModel(array(
            "allPayment"=>$allPayment
        ));
        return $view;
    }
    
    
    
    public function setEntityManager($em){
        $this->entityManager = $em;
        return $this;
    }
    
    public function setPaymentService($xserv){
        $this->paymentService = $xserv;
        return $this;
    }
    /**
     * @return the $raveCardPaymentService
     */
    public function getRaveCardPaymentService()
    {
        return $this->raveCardPaymentService;
    }

    /**
     * @param field_type $raveCardPaymentService
     */
    public function setRaveCardPaymentService($raveCardPaymentService)
    {
        $this->raveCardPaymentService = $raveCardPaymentService;
        return $this;
    }
    /**
     * @return the $generalService
     */
    public function getGeneralService()
    {
        return $this->generalService;
    }

    /**
     * @param field_type $generalService
     */
    public function setGeneralService($generalService)
    {
        $this->generalService = $generalService;
        return $this;
    }

    
    

    
   
}

