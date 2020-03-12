<?php
namespace Job\Controller;

use Zend\Mvc\Controller\AbstractActionController;

/**
 *
 * @author otaba
 *        
 */
class ObjectjobController extends AbstractActionController
{
    
    private $entityManager;
    
    private $generalService;
    
    private $clientGeneralService;

    /**
     */
    public function __construct()
    {}
    
    public function jobObjectIncompleteAction(){
        
        return $this->getResponse()->setContent(NULL);
    }
    
    public function setEntityManager($em){
        $this->entityManager = $em;
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

