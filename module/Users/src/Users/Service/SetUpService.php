<?php
namespace Users\Service;

class SetUpService
{

    private $entityManager;

    private $userId;

    private $isSub;

    private $mths;
    
    private $startDate ;
    
    private $endDate;
    
    private $subscription;
    
    private $brokerId;

    public function __construct()
    {}

    /**
     * Used to set the begin and end data of subscription
     * also used to get the amount payable by the aervice rendered
     * @param integer $months  
     *            
     */
    public function calculateService($months, $package, $date= NULL)
    {
        $this->mths = $months;
       $startDate = NULL;
        // sets the end date 
        $amountPayable = $this->calculateBrokerAmountPayable($package); // this calculates the actual amount
        $this->promoDate();
        if($date == NULL){
            $startDate = new \DateTime();
        }else{
            $startDate = new \DateTime($date);
        }
        $startDate = new \DateTime();
        $addMonths = 'P'.$this->mths.'M'; // sets the string for the date interval
        $interval = new \DateInterval($addMonths); // sets the actual interval
        $endDate = $startDate->add($interval);
        /**
         * get the time value of the months entered above
         * add the number of months entered in the varialble above
         * Datetime calculation
         */
       $start = new \DateTime();
        $mth['startDate'] = $start;
        $mth['endDate'] = $endDate;
        $mth['price'] = $amountPayable;
        $mth['mths'] = $this->mths;
        return $mth;
    }
    
    public function calculateBrokerAmountPayable($package){
        /**
         * this calculation is the total selected months 
         * multiplied by the amount srelated to the package slected 
         * 
         */
        $em = $this->entityManager;
        $pacakg = $em->find('Settings\Entity\Packages', $package);
        $pricePerMonth = $pacakg->getPrice();
        $months =(int) $this->mths;
        $pricePerMonth = (int)$pricePerMonth; // get the price of the package selected 
        $result = $months * $pricePerMonth;
        
        return $result;
        
            
        
         
    }

    /**
     * $this is used the check if the user is just registering for the first time
     * To which an additinal 1 moonth is added to his registration
     */
    private function promoDate()
    {
        if ($this->brokerId == NULL) { // meanin if this is the first entry into the subscription table
            $this->mths = $this->mths + 0;
        }
        
    }
    
//     private function subscriptionC(){
//         if ($this->brokerId != NULL){
//             $this->endDate = $this->subscription->getEndDate();
//             $this->startDate = $this->subscription->getStartDate();
//             /**
//              * if end date is less 
//              */
//         }
//     }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        
        return $this;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
        
        return $this;
    }

    public function setIsSub($bool)
    {
        $this->isSub = $bool;
        return $this;
    }
    
    public function setSubscription($sub){
        $this->subscription = $sub;
        return $this;
    }
    
    public function setBrokerId($id){
        $this->brokerId = $id;
        return $this;
    }
}

