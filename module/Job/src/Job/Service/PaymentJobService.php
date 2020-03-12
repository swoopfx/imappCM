<?php
namespace Job\Service;

/**
 *
 * @author otaba
 *        
 */
class PaymentJobService
{

    private $entityManager;
    
    /**
     */
    public function __construct()
    {
        
        // TODO - Insert your code here
    }
    
    public function setEntiyManager($em){
        $this->entityManager = $em ;
        return $this;
    }
}

