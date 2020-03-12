<?php
namespace Policy\Event;

use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\EventManager\EventManager;
use Policy\Entity\Policy;
use Home\Entity\LoggerTest;
use Zend\Di\ServiceLocator;

class PolicyEvent extends ServiceLocator implements EventManagerAwareInterface
{
    
    private $eventManager;
    
    private $serviceLocator;

    public function __construct()
    {

//         $der = $this->ge
    }

    public function setEventManager(EventManagerInterface $eventManager)
    {

        $eventManager->setIdentifiers(array(__CLASS__, get_called_class()));
        $this->eventManager = $eventManager;
        return $this;
    }

    public function getEventManager()
    {

        if($this->eventManager === NULL ){
            $this->setEventManager(new EventManager());
        }
        
        return $this->eventManager;
    }
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        return $this;
    }
    
    /**
     * This provides all activity that takes place whenever a policy is generated 
     * @param Policy $policyEntity
     */
    public function policygeneration(){
        
//         var_dump("HUUUU")
        try{
        $generalService = $this->get("GeneralServicer\Service\GeneralService");
        var_dump($generalService);
        
        //->getServiceLocator()->get("GeneralServicer\Service\GeneralService");
//         $em = $generalService->getEntityManager();
        }catch(\Exception $e){
            var_dump($e->getMessage());
        }
//         $logger = new LoggerTest();
//                 $logger->setLoggedDate(new \DateTime())->setUser($this->identity());
//                 $em = $this->entityManager;
//                 $em->persist($logger);
//                 $em->flush();
        /**
         * Mails to the customer
         */
        
    }

}

