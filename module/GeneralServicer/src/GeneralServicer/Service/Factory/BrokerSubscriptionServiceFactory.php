<?php
namespace GeneralServicer\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use GeneralServicer\Service\BrokerSubscriptionService;


/**
 *
 * @author swoopfx
 *        
 */
class BrokerSubscriptionServiceFactory implements FactoryInterface
{

    private $auth;
    
    private $user;
    public function __construct()
    {
        
        // TODO - Insert your code here
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        
        $service = new BrokerSubscriptionService();
        $em = $serviceLocator->get('doctrine.entitymanager.orm_default');
         $this->auth = $serviceLocator->get('Zend\Authentication\AuthenticationService');
         
         $this->getUser();
         
         $service->setEntityManager($em)->setUser($this->user);
        return $service;
    }
    
    private function getUser(){
        if ($this->auth->hasIdentity()){
            $this->user = $this->auth->getIdentity();
        }
    }
}

