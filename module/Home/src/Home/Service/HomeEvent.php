<?php
namespace Home\Service;

use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\EventManager;
use Home\Entity\LoggerTest;

class HomeEvent implements EventManagerAwareInterface
{
    
    private $eventManager;

    // TODO - Insert your code here
    public function __construct()
    {

        // TODO - Insert your code here
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
    
    
    public function home($params){
        $response = $this->getEventManager();
        $response->trigger(__FUNCTION__, $this,$params);
        
//         $logger = new LoggerTest();
//         $logger->setLoggedDate(new \DateTime())->setUser($this->identity());
//         $em = $this->entityManager;
//         $em->persist($logger);
//         $em->flush();
       
        
        
        
//         $response->trigger(__FUNCTION__.'post', $this, array("logger"=>$logger));
// //         return $logger;
    }

}

