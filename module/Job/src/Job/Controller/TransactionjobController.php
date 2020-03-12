<?php
namespace Job\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class TransactionjobController extends AbstractActionController
{
    
    private $entityManager;
    
    private $generalService;
    
    private $smsService;
    
    private $clientGeneralService;

    // TODO - Insert your code here
    public function __construct()
    {

        // TODO - Insert your code here
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
    public function getGeneralService()
    {
        return $this->generalService;
    }

    /**
     * @return mixed
     */
    public function getSmsService()
    {
        return $this->smsService;
    }

    /**
     * @return mixed
     */
    public function getClientGeneralService()
    {
        return $this->clientGeneralService;
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
     * @param mixed $generalService
     */
    public function setGeneralService($generalService)
    {
        $this->generalService = $generalService;
        return $this;
    }

    /**
     * @param mixed $smsService
     */
    public function setSmsService($smsService)
    {
        $this->smsService = $smsService;
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

}

