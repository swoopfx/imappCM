<?php
namespace GeneralServicer\Service;

use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\EventManager;


/**
 *
 * @author otaba
 *        
 */
class MailEventManager implements EventManagerAwareInterface
{
    
    private $eventManger;

    /**
     */
    public function __construct()
    {
        
        // TODO - Insert your code here
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\EventManager\EventManagerAwareInterface::setEventManager()
     *
     */
    public function setEventManager(EventManagerInterface $eventManager)
    {
        
        $this->eventManger = $eventManager;
        return $this;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\EventManager\EventsCapableInterface::getEventManager()
     *
     */
    public function getEventManager()
    {
        
        if(!$this->eventManger instanceof EventManagerAwareInterface){
            $this->setEventManager(new EventManager(array(__CLASS__, get_called_class())));
        }
        return $this->eventManger;
    }
}

