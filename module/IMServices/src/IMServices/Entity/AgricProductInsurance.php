<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
// use Settings\Entity\Duration;
use Settings\Entity\MicroPaymentStructure;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * provide insurance for agricultural produce
 * @ORM\Entity
 * @ORM\Table(name="agric_produce_insurance")
 *
 * @author otaba
 *        
 */
class AgricProductInsurance
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * Provide cover for property
     *
     * @ORM\Column(name="is_cover_property", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isCoverProperty;

    /**
     * Provide Cover for agricultural produce
     * @ORM\Column(name="is_cover_agric_produce", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isCoverAgriculturalProduce;

    /**
     * This could also be termed as cover List
     * @ORM\OneToMany(targetEntity="AgricPropertyInsuranceList", mappedBy="agricProperty")
     * 
     * @var Collection
     */
    private $propertyList;

    /**
     * @ORM\Column(name="total_cover_value", type="string", nullable=true)
     *
     * @var string
     */
    private $totalCoverValue;

    /**
     * @ORM\Column(name="is_regular_inspected", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isRegularlyInspected;

    /**
     * @ORM\Column(name="last_date_inspected", type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $lastDateInspected;
    
    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\MicroPaymentStructure")
     * @var MicroPaymentStructure
     */
    private $inspectionDuration;

    /**
     * @ORM\Column(name="is_previous_claims", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isPreviousClaim;

    /**
     * @ORM\Column(name="is_previous_decline", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isPreviousDecline;

    /**
     * @ORM\Column(name="decline_details", type="text", nullable=true)
     *
     * @var text
     */
    private $declineDetails;

    /**
     * @ORM\Column(name="is_canceled", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isCanceled;

    /**
     * @ORM\Column(name="cancel_details", type="text", nullable=true)
     *
     * @var text
     */
    private $cancelDetails;

    /**
     *
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     *
     * @param number $id            
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     *
     * @return the $isCoverProperty
     */
    public function getIsCoverProperty()
    {
        return $this->isCoverProperty;
    }

    /**
     *
     * @param boolean $isCoverProperty            
     */
    public function setIsCoverProperty($isCoverProperty)
    {
        $this->isCoverProperty = $isCoverProperty;
        return $this;
    }

    /**
     *
     * @return the $isCoverAgriculturalProduce
     */
    public function getIsCoverAgriculturalProduce()
    {
        return $this->isCoverAgriculturalProduce;
    }

    /**
     *
     * @param boolean $isCoverAgriculturalProduce            
     */
    public function setIsCoverAgriculturalProduce($isCoverAgriculturalProduce)
    {
        $this->isCoverAgriculturalProduce = $isCoverAgriculturalProduce;
        return $this;
    }

    /**
     *
     * @return the $propertyList
     */
    public function getPropertyList()
    {
        return $this->propertyList;
    }

//     /**
//      *
//      * @param \Doctrine\Common\Collections\Collection $propertyList            
//      */
//     public function setPropertyList($propertyList)
//     {
//         $this->propertyList = $propertyList;
//         return $this;
//     }

    /**
     *
     * @param AgricPropertyInsuranceList $propertyList            
     */
    public function addPropertyList($propertyList)
    {
        if (! $this->propertyList->contains($propertyList)) {
            $this->propertyList->add($propertyList);
            $propertyList->setAgricProperty($this);
        }
    }
    
    
    /**
     * 
     * @param AgricPropertyInsuranceList $propertList
     */
    public function removePropertyList($propertList){
        if($this->propertyList->contains($propertList)){
            $this->propertyList->removeElement($propertList);
            $propertList->setAgricProperty(NULL);
        }
    }

    /**
     *
     * @return the $totalCoverValue
     */
    public function getTotalCoverValue()
    {
        return $this->totalCoverValue;
    }

    /**
     *
     * @param string $totalCoverValue            
     */
    public function setTotalCoverValue($totalCoverValue)
    {
        $this->totalCoverValue = $totalCoverValue;
        return $this;
    }

    /**
     *
     * @return the $isRegularlyInspected
     */
    public function getIsRegularlyInspected()
    {
        return $this->isRegularlyInspected;
    }

    /**
     *
     * @param boolean $isRegularlyInspected            
     */
    public function setIsRegularlyInspected($isRegularlyInspected)
    {
        $this->isRegularlyInspected = $isRegularlyInspected;
        return $this;
    }

    /**
     *
     * @return the $lastDateInspected
     */
    public function getLastDateInspected()
    {
        return $this->lastDateInspected;
    }

    /**
     *
     * @param DateTime $lastDateInspected            
     */
    public function setLastDateInspected($lastDateInspected)
    {
        $this->lastDateInspected = $lastDateInspected;
        return $this;
    }

    /**
     *
     * @return the $isPreviousClaim
     */
    public function getIsPreviousClaim()
    {
        return $this->isPreviousClaim;
    }

    /**
     *
     * @param boolean $isPreviousClaim            
     */
    public function setIsPreviousClaim($isPreviousClaim)
    {
        $this->isPreviousClaim = $isPreviousClaim;
        return $this;
    }

    /**
     *
     * @return the $isPreviousDecline
     */
    public function getIsPreviousDecline()
    {
        return $this->isPreviousDecline;
    }

    /**
     *
     * @param boolean $isPreviousDecline            
     */
    public function setIsPreviousDecline($isPreviousDecline)
    {
        $this->isPreviousDecline = $isPreviousDecline;
        return $this;
    }

    /**
     *
     * @return the $declineDetails
     */
    public function getDeclineDetails()
    {
        return $this->declineDetails;
    }

    /**
     *
     * @param \IMServices\Entity\text $declineDetails            
     */
    public function setDeclineDetails($declineDetails)
    {
        $this->declineDetails = $declineDetails;
        return $this;
    }

    /**
     *
     * @return the $isCanceled
     */
    public function getIsCanceled()
    {
        return $this->isCanceled;
    }

    /**
     *
     * @param boolean $isCanceled            
     */
    public function setIsCanceled($isCanceled)
    {
        $this->isCanceled = $isCanceled;
        return $this;
    }

    /**
     *
     * @return the $cancelDetails
     */
    public function getCancelDetails()
    {
        return $this->cancelDetails;
    }

    /**
     *
     * @param \IMServices\Entity\text $cancelDetails            
     */
    public function setCancelDetails($cancelDetails)
    {
        $this->cancelDetails = $cancelDetails;
        return $this;
    }

    /**
     */
    public function __construct()
    {
        
       $this->propertyList = new ArrayCollection();
    }
    /**
     * @return the $inspectionDuration
     */
    public function getInspectionDuration()
    {
        return $this->inspectionDuration;
    }

    /**
     * @param \Settings\Entity\MicroPaymentStructure $inspectionDuration
     */
    public function setInspectionDuration($inspectionDuration)
    {
        $this->inspectionDuration = $inspectionDuration;
        return $this;
    }

}

