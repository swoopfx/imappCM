<?php
namespace  Wallet\Service;

use Zend\EventManager\EventManager;
use GeneralServicer\Service\GeneralService;
use ZfcBase\EventManager\EventProvider;
use Wallet\Entity\Wallet;

class WalletService extends  EventProvider
{
    
    const WALLET_TRANSACTION_TYPE_WITHDRAW = 100;
    
    const WALLET_TRANSACTION_TYPE_CREDIT = 200;
    
//     const WALLET_TRANSACTION_STATUS_

    const WALLET_ACTIVITY_TYPE_BOOK_BALANCE = 10;
    
    const WALLET_ACTIVITY_TYPE_AVAILABLE_BALANCE = 100;
    
    const WALLET_ACTIVITY_TYPE_CREDIT = 200;
    
    const WALLET_ACTIVITY_TYPE_DEBIT = 300;
    
    const WALLET_ACTIVITY_TYPE_PASSWORD_CREATION = 400;
    
    const WALLET_ACTIVITY_TYPE_PASSWORD_EDIT = 500;
    
    
    private $entityManager;
    
    private $walletSession;
    
    /**
     * 
     * @var GeneralService
     */
    private $generalService;
    
//     private 

    // TODO - Insert your code here
    public function __construct()
    {

        // TODO - Insert your code here
    }
    
    public function getTransation(){
        $em = $this->entityManager;
        $this->getEventManager()->trigger(__FUNCTION__, $this, array('user' => $this->generalService->getUserId()));
//         $this->getUserMapper()->insert($user);
        $this->getEventManager()->trigger(__FUNCTION__.'.post', $this, array('user' => $this->generalService->getUserId()));
        
    }
    
    public function getAvaialableBalance($user){
        $em = $this->entityManager;
       
        /**
         * 
         * @var Wallet $balance
         */
        
        $balance = $em->getRepository("Wallet\Entity\Wallet")->findOneBy(array("user"=>$user));
        
        if(isset($balance)){
            
            return $balance->getBalance();
            
        }else{
            return 0;
        }
    }
    
    public function getBookBalance(){
        $em = $this->entityManager;
        
        /**
         *
         * @var Wallet $balance
         */
        
        $balance = $em->getRepository("Wallet\Entity\Wallet")->findOneBy(array("user"=>$this->generalService->getUserId()));
        
        if(isset($balance)){
            
            return $balance->getBookBalance();
            
        }else{
            return 0;
        }
    }
    
    public static function generateWalletUid(){
        $const = "wallet";
//         $id = $this->userId;
        $code = \uniqid($const);
        return $code;
    }
    
    /**
     * 
     * @return float|number
     */
    public function getLastWithrawal($user){
        $em = $this->entityManager;
       
        if($this->generalService->getUserId() !== NULL){
           
            $withdrawal = $em->getRepository("Wallet\Entity\Wallet")->findLastWithdrawal($user);
            
            if(count($withdrawal) > 0){
               
                return $withdrawal[0]->getAmount();
                
            }else{
                return 0;
            }
        }
        
    }
    
    public function getTotalRevenue(){
        
    }
    
    public function getTotalExpenditure(){
        
        
    }
    
    public function getWalletSession(){
        return $this->walletSession;
    }
    
    // Begin Setters
    
    
    

    /**
     * @param mixed $entityManager
     */
    public function setEntityManager($entityManager)
    {
        $this->entityManager = $entityManager;
        return $this;
    }

    /**
     * @param mixed $generalService
     */
    public function setGeneralService($generalService)
    {
        $this->generalService = $generalService;
        return $this;
    }
    
    public function setWalletSession($session){
        $this->walletSession = $session;
        return $this;
    }
    
    // End setters
}

