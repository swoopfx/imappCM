<?php
namespace Job\Controller;

use Zend\Mvc\Controller\AbstractActionController;

/**
 *
 * @author otaba
 *        
 */
class PaymentjobController extends AbstractActionController
{

    private $entityManager;

    private $ravePaymentService;

    private $smsService;

    /**
     */
    public function __construct()
    {
        
        // TODO - Insert your code here
    }

    /**
     * This Notify customer of an upcoming payment due in 7, 3, 1 day(s)
     *
     * @return mixed
     */
    public function micropaymentnotificationAction()
    {
        $em = $this->entityManager;
        $data  = $em->getRepository("Transactions\Entity\MicroPayment")->findExpiringMicroPayment();
        foreach ($data as $dat){
            
        }
        return $this->getResponse()->setContent(NULL);
    }
    
    
    private function sendToCustomer(){
//         $var
    }

    /**
     * This automatically activates a micro payment recurring bill on an account
     * If the payment was successful the status is changed to success
     * else the status is failed
     *
     * @return mixed;
     */
    public function activatemicropaymentAction()
    {
        $em = $this->entityManager;
        $ravePaymentService = $this->ravePaymentService;
        /**
         * Get A list of Micropayment due for today
         * Get The customer associated to the Invoice associated to the micropayment
         * Get The user id of that customer
         * get the rave auth card on record
         * send a payment notice to rave
         * If successfull send a notification to the customer and change the status
         * then send a notification to the broker and child brokers assigned to the customer
         * if failed send a notification to the customer 
         * and change the status of the micro payment to failed 
         */
        return $this->getResponse()->setContent(NULL);
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }

    public function setRavePaymentService($xserv)
    {
        $this->ravePaymentService = $xserv;
        return $this;
    }

    public function setSmsService($xserv)
    {
        $this->smsService = $xserv;
        return $this;
    }
}

