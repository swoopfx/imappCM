<?php
namespace Customer\Service;

/**
 *
 * @author otaba
 *        
 */
class CustomerProposalService
{

    private $entityManager;
    
    private $clientGeneralService ;
    
    /**
     */
    public function __construct()
    {
        
        // TODO - Insert your code here
    }
    
//     public function getCustomerProposalDoc($proposalId){
//         $em = $this->entityManager;
//         $docArray = array();
//         $doc
//         return $docArray;
//     }
    
    public function setEntityManager($em){
        $this->entityManager = $em;
        return $this;
    }
    
    public function setClientGeneralService($xserv){
        $this->clientGeneralService = $xserv;
        return $this;
    }
}

