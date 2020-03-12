<?php
namespace Users\Service;

use Users\Entity\IndividualInfo;

/**
 *
 * @author swoopfx
 *        
 */
class UsersService
{

   
    
    protected $entityManager;
    
    protected $IndEntity;
    
    protected $userRole;
    protected $auth;
    protected $userId;
    protected $comEntity;
    protected $agentEntity;
    protected $brokerEntity;
    
    public function __construct()
    {}
    
    public function getUserInfo(){
        
        /**
         * this function checks the user permission level
         * Maps to the required Entity to be called 
         */
     
        $der = $this->userRole->getId(); 
        switch ($der){
            case '10': // Profiled individual role 
           
            return $this->getIndInfo();
            
                break;
              
            case'50':// profiled company role 
                return $this->getComInfo();
                break;
        }
    }
    
    private function getIndInfo(){
        $em = $this->entityManager;
       return  $em->getRepository('Users\Entity\IndividualInfo')->findOneBy(array('user'=>$this->userId));
        
    }
    private function getComInfo(){
        $em = $this->entityManager;
       return  $em->getRepository('Users\Entity\CompanyInfo')->findOneBY(array('user'=>$this->userId));
    }
    
    
    
    public function setEntityManager($em){
        $this->entityManager = $em;
        return $this;
    }
    
    
    
    public function setUserId($auth){
        $this->auth = $auth ;
        if ($this->auth->hasIdentity()) {
            $this->userId = $this->auth->getIdentity()->getId();
            $this->userRole = $this->auth->getIdentity()->getRole();
             
        }
    }
}

