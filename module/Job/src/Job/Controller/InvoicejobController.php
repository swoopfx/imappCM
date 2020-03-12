<?php
namespace Job\Controller;

use Zend\Mvc\Controller\AbstractActionController;

/**
 *
 * @author otaba
 *        
 */
class InvoicejobController extends AbstractActionController
{
    
    private $entityManager;
    
    private $generalService ;
    
    private $clientGeneralService;

    /**
     */
    public function __construct()
    {}
    
    /**
     * job-expiring-invoice-notify
     * This action notifies the customer of an expiring invoice which is still open 
     * and unpaid
     * 
     * @return mixed
     */
    public function jobExpiringInvoiceNotifyAction(){
       $em = $this->entityManager;
       $generalService = $this->generalService;
       $clientGeneralService = $this->clientGeneralService;
       $expiringInvoice = $em->getRepository("Transactions\Entity\Invoice")->findJobExpiringInvoice();
       foreach ($expiringInvoice as $invoice){
           $template = array(
               "var"=>array(
                   "logo"=>$clientGeneralService->loginPageLogo($invoice->getCustomer()->getCustomerBroker()->getBroker()->getId()),
                   "brokerName"=>$invoice->getCustomer()->getCustomerBroker()->getBroker()->getCompanyName(),
                   "invoice"=>$invoice,
               ),
               "template"=>"general-customer-invoice-expiring", // TODO design the mail 
           );
           $messagePointers = array(
               "to" => $invoice->getCustomer()->getUser()->getEmail(),
               "fromName" => $invoice->getCustomer()->getCustomerBroker()->getBroker()->getCompanyName(),
               "subject" => "Expiring Invoice"
           );
           $this->generalService->sendMails($messagePointers, $template);
       }
        return $this->getResponse()->setContent(NULL);
    }
    
    
   
    
    public function setEntityManager($em){
        $this->entityManager = $em ;
        return $this;
    }
    
    public function setGeneralService($xserv){
        $this->generalService = $xserv;
        return $this;
    }
    
    public function setClientGeneralService($xserv){
        $this->clientGeneralService = $xserv;
        return $this;
    }
}

