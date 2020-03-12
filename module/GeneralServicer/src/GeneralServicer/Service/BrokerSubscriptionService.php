<?php
namespace GeneralServicer\Service;

/**
 *
 * @author swoopfx
 *        
 */
class BrokerSubscriptionService
{
    private $entityManager;
    
    private $user;
    
    
    public function __construct()
    {
        
        // TODO - Insert your code here
    }
    
    public function getBrokerSubscription($broker){
        $sub = Null ;
        $em = $this->entityManager;
        $sub = $em->getRepository('GeneralServicer\Entity\BrokerSubscription')->findOneBy(array(
            'broker'=>$broker,
        ));
        return $sub;
    }
    
    // Begin Setters
    
    public function setEntityManager($em){
        $this->entityManager = $em ;
        return $this;
    }
    
    public function setUser($user){
        $this->user = $user ;
        return $this;
    }
    
    
    
   // End Setters
}

