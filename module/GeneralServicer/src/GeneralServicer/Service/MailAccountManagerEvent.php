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
class MailAccountManagerEvent implements EventManagerAwareInterface
{
    private $managerEmail;
    
    private $eventManager;

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
        
        $this->eventManager = $eventManager;
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
        
        if (null === $this->eventManager) {
            $this->setEventManager(new EventManager());
        }
        
        return $this->eventManager;
    }
    
    public function mailManagers(){
        
    }
}

