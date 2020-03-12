<?php
namespace GeneralServicer\Service;

/**
 *
 * @author swoopfx
 *        
 */
class DateCalculationService
{

    private $entityManager;

    private $brokerId;

    private $subscriptionEndDate;

    private $subsRemainingDays;

    private $policyRemainDays;
    
    // public function notification(){
    // $presentDate = new \DateTime();
    // $expirationDate = $this->subscriptionEndDate;
    // $remainingDays = $expirationDate->diff($presentDate);
    
    // }
    public function getSubscpritionDays()
    {
        return (int) $this->subsRemainingDays->days;
    }

    public function getPolicyRemainingDays()
    {
        return $this->policyRemainDays->days;
    }
    
    
    public function reminderSubsEndDateSerach($broekrId){
        
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }

    public function setSubsEndDate($date)
    {
        if ($date != NULL) {
            $this->subscriptionEndDate = $date;
            $presentDate = new \DateTime();
            $expirationDate = $this->subscriptionEndDate;
            $this->subsRemainingDays = $expirationDate->diff($presentDate);
            return $this;
        }
    }
}

