<?php
namespace Transactions\Service;

/**
 * This provides all logic for all payment made by the broker 
 * 
 * @author otaba
 *        
 */
class BrokerPaymentService
{
    private $entityManager;
    
    private $generalService; 
    
    private $raveCardPaymentService;
    
//     private $

    // TODO - Insert your code here
    
    /**
     */
    public function __construct()
    {
        
        // TODO - Insert your code here
    }
    
    public function processPayment(){
        $em = $this->entityManager;
    }
}

