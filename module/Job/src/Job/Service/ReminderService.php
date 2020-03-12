<?php
namespace Job\Service;

/**
 *
 * @author swoopfx
 *        
 */
class ReminderService
{
    private $entityManager;
    
    private $mail;
   public function notification(){
       
   }
   
   private function sendNotification(){
       
   }
    public function setEntityManager($em){
        $this->entityManager = $em ;
        return $this;
    }
    
    public function setMail($mail){
        $this->mail = $mail;
        return $this;
    }
}

