<?php
namespace Users\Service;

use CsnUser\Service\UserService;

/**
 *
 * @author swoopfx
 *        
 */
class BrokerGeneralService
{
    private $auth;
    
    private $entityManager;
    
    private $userEntity;
    
    private $brokerId;
    
    private $brokerInvoiceId;
    
    private $userId;
    
    private $customRedirect;
    
    private $userRoleId;
    
    private $generalService ;
   
    
    
    public function brokerInfo(){
        
       
     
        $em = $this->entityManager;
        $info = $em->getRepository('Users\Entity\InsuranceBrokerRegistered')->findOneBy(array('user'=>$this->userId));
        if($info != NULL){
            $this->brokerId = $info->getId();
            return $info;
        }
       
  
    }
    
    public function brokerSubscription(){
      
        /**
         * This defines the total number of of avalable users
         * It also shows the number of registered users and the balance
         * Defines the pakage being used 
         * @var array $res
         */
        $broker = $this->brokerId;
        $em = $this->entityManager ;
        
        $res = $em->getRepository('GeneralServicer\Entity\BrokerSubscription')->findOneBy(array(
            'broker'=>$broker
        ));
        if($res != NULL){
            $this->brokerInvoiceId = $res->getInvoice();
        }
       
            
        return $res;
      
    }
    
    public function getSubscription(){
        switch ($this->userRoleId){
            case UserService::USER_ROLE_BROKER:
            case UserService::USER_ROLE_SETUP_BROKER:
                return $this->generalService->getBrokerSubscription();
                break;
            case UserService::USER_ROLE_BROKER_CHILD:
                return $this->generalService->getMotherBrokerSubscription();
                break;
                
                
        }
        
    }
    
    public function getBrokerBankAccounts(){
        $brokerId = $this->brokerId;
        $em = $this->entityManager;
        $data = $em->find("Users\Entity\InsuranceBrokerRegistered", $brokerId);
        if($data != NULL){
            return $data->getBrokerBankAccount();
        }
    }
    
    public function getChildBrokerFromBroker($broker_id){
        
    }
    
    public function getBrokerInvoices(){
        
    }
    
   

 

    /**
     * This returns the auto generated code/token for the broker
     *
     * @return NULL
     */
    private function generateBrokerCode()
    {
        $brokerConst = 'brk';
        $brokerCode = NULL;
        
        $code = md5(uniqid(mt_rand(), true));
        
        $brokerCode = $brokerCode . $code.$this->userEntity->getId();
        
        return $brokerCode;
    }

    /**
     * Use to get the brkers terms and conditions form the database
     *
     * @return NULL
     */
    private function getBrokerTerms()
    {
        $brokerTerms = NULL;
        return $brokerTerms;
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }
    
//     public function setUserEntity($entity){
//         $this->userEntity = $entity;
//         return $this;
//     }
    
    public function setUserId($userId){
        $this->userId = $userId;
        return $this;
    }
    
    public function setAuth($auth){
        $this->auth = $auth;
        return $this;
    }
    
    public function setRedirect($red){
        
        $this->customRedirect = $red;
        return $this;
    }
    
    public function setGeneralService($serve){
        $this->generalService = $serve;
        return $this;
    }
    
    public function setUserRoleId($id){
        $this->userRoleId = $id;
        return $this;
    }
    
    public function setBrokerId($id){
        $this->brokerId = $id ;
        return $this;
    }
    // public function
}

?>