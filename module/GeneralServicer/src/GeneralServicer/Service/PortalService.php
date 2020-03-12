<?php
namespace GeneralServicer\Service;

class PortalService
{
    
    private $generalService;
    
    private $entityManager;
    
    private $portalType;
    
//     private 

    // TODO - Insert your code here
    public function __construct()
    {

        // TODO - Insert your code here
    }
    
//     public function getPortal
    
    public function getPortalType(){
        
    }
    /**
     * @param mixed $generalService
     */
    public function setGeneralService($generalService)
    {
        $this->generalService = $generalService;
        return $this;
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
     * @param mixed $portalType
     */
    public function setPortalType($portalType)
    {
        $this->portalType = $portalType;
        return $this;
    }

}

