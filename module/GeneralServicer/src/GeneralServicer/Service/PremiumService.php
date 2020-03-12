<?php
namespace GeneralServicer\Service;

use Zend\Session\Container;

/**
 * Callinfg this class 
 * The setValuetype must be set
 * The setObjectArray nmust be set 
 * The PremiumT=REate must be set
 * @author swoopfx
 *         This class handles every thing related
 *         to the generation of premium
 *        
 */
class PremiumService
{

    private $premiumRate;
    
    private $objectTotalSummed;
    
    private $objectsArray;
    
    private $valueType; // This defines if it is fixed or percentile
    
    private $premiumValue;
    
    private $tottalObject;
   
    
    const PREMIUM_VALUE_TYPE_FIXED = 1;
    
    const PREMIUM_VALUE_TYPE_PERCENTAGE = 2;
    
   
    /**
     * This function gets the availale premium Usable for the proposal
     */
     public function getProposalUsablePremium($proposalEntity){
         $premiumSession = new Container("proposal_premium");
         if($proposalEntity->getIsManualPremium() == TRUE){
             return $proposalEntity->getManualPremium()->getPremium();
         }else{
             return $premiumSession->premium;
         }
         
//          return NULL;
     }

    public function flatRateCalculation()
    {
       
        $value = $this->tottalObject * $this->premiumRate;
        return $value;
    }

    public function percentageRateCalculation()
    {
       $value =  ((float)$this->objectTotalSummed  * (float)$this->premiumRate)/100;
       return $value;
        
    }
    
    public function objectTotalSum(){
        
            $count = count($this->objectsArray);
            $totalValue = 0 ;
            for ($i = 0; $i < $count ; $i++){
                $totalValue = $totalValue + $this->objectsArray[$i]->getValue();
               
            }
            $this->tottalObject = count($this->objectsArray);
           $this->objectTotalSummed = $totalValue;
            
       
    }
    

    public function premiumCalculator(){
        $this->objectTotalSum();
        
        switch ($this->valueType){
            case PremiumService::PREMIUM_VALUE_TYPE_FIXED:
               return  $this->premiumValue = $this->flatRateCalculation();
                break;
                
            case PremiumService::PREMIUM_VALUE_TYPE_PERCENTAGE:
               return  $this->premiumValue = $this->percentageRateCalculation();
                break;
        }
    }
    

   
    
    // Begin Internal Setters and getters
    
   
    public function setPremiumRate($rate){
        $this->premiumRate = $rate;
        return $this;
    }
    
    public function setObjectsArray($obj){
        $this->objectsArray = $obj;
        return $this; 
    }
    
    public function setValueType($type){
        $this->valueType = $type;
        return $this;
    }
   
    
    public function getPremiumValue(){
        return $this->premiumValue;
    }
    
    
    // End internal Setters and getters

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }

    public function setExcessValue($value)
    {
        $this->excessValue = $value;
        return $this;
    }

    public function setPercentageValue($pers)
    {
        $this->percentageValue = $pers;
        
        return $this;
    }
}

