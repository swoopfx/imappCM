<?php
namespace Job\Controller;

use Zend\Mvc\Controller\AbstractActionController;

/**
 *
 * @author swoopfx
 *        
 */
class ReminderController extends AbstractActionController
{
   private $reminderService;
   
   private $dateClaculation;
        
    public  function expirePolicyAction(){
        
    }
    /**
     * This sends notification to all brokers whose subscription is about to expire
     */
    public function brokerSubscriptionAction(){
        
    }
    
    public function setReminderService($serve){
        $this->reminderService = $serve;
        return $this;
    }
    
    
}

