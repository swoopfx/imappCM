<?php
namespace Proposal\Service;

/**
 *
 * @author otaba
 *        
 */
class PremiumGeneratorService
{

    private $entityManager;
    
    private $proposalSession;
    
    public function __construct()
    {
        
        // TODO - Insert your code here
    }
    
    public function generatePremium(){
        
    }
    
    public function generateInvoice(){
        
    }
    
    public function setEntityManager($em){
        $this->entityManager = $em ;
        return $this;
    }
}

