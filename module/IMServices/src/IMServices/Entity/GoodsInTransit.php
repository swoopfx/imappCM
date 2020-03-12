<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;
use Settings\Entity\GeographicalArea;
use Settings\Entity\TransportMedium;
use Settings\Entity\GITSpecificGoods;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="good_in_trnasit")
 *
 * @author otaba
 *        
 */
class GoodsInTransit
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * This defines the nature and description of goods being moved by facility
     * @ORM\Column(name="good_description", type="text", nullable=true)
     *
     * @var text
     */
    private $goodDescription;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\GeographicalArea")
     *
     * @var GeographicalArea Define geographical area of business
     */
    private $geographicalArea;

    /**
     * @ORM\Column(name="other_geographical_area", type="string", nullable=true)
     *
     * @var string
     */
    private $otherGeographicalArea;

    /**
     * This is either Raill, Road, Water, Post, Others
     * @ORM\ManyToOne(targetEntity="Settings\Entity\TransportMedium")
     *
     * @var TransportMedium
     */
    private $transportMedium;

    /**
     * @ORM\Column(name="other_transport_medium", type="string", nullable=true)
     *
     * @var string
     */
    private $otherTransportMedium;

    /**
     * This defines some services on watchlist by some insurer
     * @ORM\ManyToMany(targetEntity="Settings\Entity\GITSpecificGoods", cascade={"persist","remove"})
     * @ORM\JoinTable(name="git_special_goods", joinColumns={
     * @ORM\JoinColumn(name="git_id", referencedColumnName="id")
     * },
     * inverseJoinColumns={
     * @ORM\JoinColumn(name="specific_goods_id", referencedColumnName="id")
     * })
     *
     * 
     * @var Collection
     *
     */
    private $specificGoods;

    /**
     * This defines if the soting facility is always locked and attended
     * @ORM\Column(name="is_locked_and_attended", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isLockeNAttended;

    /**
     * If the facitlity has anti theft device
     *
     * @ORM\Column(name="is_anti_theft_device", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isAntiTheftDevice;

    /**
     * The anti theft device it contains
     * @ORM\Column(name="anti_theft_device", type="string", nullable=true)
     *
     * @var string
     */
    private $antiTheftDevice;

    /**
    * The details of the vehicle available
    * @ORM\OneToMany(targetEntity="IMServices\Entity\GITVehicleDetails", mappedBy="git", cascade={"persist","remove"})
    *
    * @var Collection
    */
    private $vehicleDetails;
    
    /**
     * This is the yearly estimate in Naira
     * of goods sent
     * @ORM\Column(name="yearly_total_estimate", type="string", nullable=true)
     *
     * @var string
     */
    private $yearlyTotalEstimate;

    /**
     * This defines a limit to apply in respect of any consignment
     * @ORM\Column(name="estimated_limit", type="string", nullable=true)
     *
     * @var string
     */
    private $estimatedLimit;

    /**
     * @ORM\Column(name="is_other_insurance", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isOtherInsurance;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\Insurer")
     *
     * @var string
     */
    private $otherInsurance;

    /**
     * @ORM\Column(name="is_previous_decline", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isPreviousDecline;

    /**
     *
     * This defines if previous insurer increase the premium rate
     * @ORM\Column(name="is_increase_contribution", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isIncreaseContribution;

    /**
     * This signify if the previous insurer required a special term
     * @ORM\Column(name="is_require_special_term", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isRequireSpecialTerm;

    /**
     * @ORM\Column(name="special_term", type="text", nullable=true)
     *
     * @var text
     */
    private $specialTerm;

    /**
     * @ORM\Column(name="is_cancel_policy", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isCanceledPolicy;

    /**
     * This defines if there has been a previous loss by an insurer
     * @ORM\Column(name="is_previous_loss", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isPreviousLoss;

    /**
     * Any additional information required by insurer
     * @ORM\Column(name="additional_info", type="text", nullable=true)
     *
     * @var text
     */
    private $additionalInfo;

    /**
     * @ORM\Column(name="is_declaration", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isDeclaration;

    // /**
    // * @ORM\OneToOne(targetEntity="CoverDetails")
    // * @var CoverDetails
    // */
    // private $coverDetails;
    public function __construct()
    {
        $this->specificGoods = new ArrayCollection();
        $this->vehicleDetails = new ArrayCollection();
    }

    /**
     *
     * @return the $goodDescription
     */
    public function getGoodDescription()
    {
        return $this->goodDescription;
    }

    public function setGoodDescription($goods)
    {
        $this->goodDescription = $goods;
        return $this;
    }

    public function getGeographicalArea()
    {
        return $this->geographicalArea;
    }

    public function setGeographicalArea($area)
    {
        $this->geographicalArea = $area;
        return $this;
    }

    public function getTransportMedium()
    {
        return $this->transportMedium;
    }

    public function setTransportMedium($trans)
    {
        $this->transportMedium = $trans;
        return $this;
    }

    public function getSpecificGoods()
    {
        return $this->specificGoods;
    }

    /**
     *
     * @param GITSpecificGoods $goods            
     * @return \IMServices\Entity\GoodsInTransit
     */
    public function addSpecificGoods($goods)
    {
        if (! $this->specificGoods->contains($goods)) {
            foreach ($goods as $good) {
                $this->specificGoods->add($good);
                
            }
        }
        
        return $this;
    }

    public function removeSpecificGoods($goods)
    {
        if ($this->specificGoods->contains($goods)) {
            foreach ($goods as  $good){
                $this->specificGoods->removeElement($good);
            }
        }
        return $this;
    }

    // public function setSpecificGoods($goods){
    // $this->specificGoods = $goods;
    // return $this;
    // }
    public function getIsLockeNAttended()
    {
        return $this->isLockeNAttended;
    }

    public function setIsLockeNAttended($bool)
    {
        $this->isLockeNAttended = $bool;
        return $this;
    }

    public function getIsAntiTheftDevice()
    {
        return $this->isAntiTheftDevice;
    }

    public function setIsAntiTheftDevice($dev)
    {
        $this->isAntiTheftDevice = $dev;
        return $this;
    }

    public function getAntiTheftDevice()
    {
        return $this->antiTheftDevice;
    }

    public function setAntiTheftDevice($dev)
    {
        $this->antiTheftDevice = $dev;
        return $this;
    }

    public function getVehicleDetails()
    {
        return $this->vehicleDetails;
    }

    /**
     *
     * @param GITVehicleDetails $details            
     * @return \IMServices\Entity\GoodsInTransit
     */
    public function addVehicleDetails($details)
    {
        if (! $this->vehicleDetails->contains($details)) {
            $this->vehicleDetails->add($details);
            $details->setGit($this);
        }
        
        return $this;
    }

    /**
     *
     * @param GITVehicleDetails $details            
     * @return \IMServices\Entity\GoodsInTransit
     */
    public function removeVehicleDetails($details)
    {
        if ($this->vehicleDetails->contains($details)) {
            $this->vehicleDetails->removeElement($details);
            $details->setGit(NULL);
        }
        
        return $this;
    }

    public function getYearlyTotalEstimate()
    {
        return $this->yearlyTotalEstimate;
    }

    public function setYearlyTotalEstimate($year)
    {
        $this->yearlyTotalEstimate = $year;
        return $this;
    }

    public function getEstimatedLimit()
    {
        return $this->estimatedLimit;
    }

    public function setEstimatedLimit($limit)
    {
        $this->estimatedLimit = $limit;
        return $this;
    }

    public function getIsOtherInsurance()
    {
        return $this->isOtherInsurance;
    }

    public function setIsOtherInsurance($ins)
    {
        $this->isOtherInsurance = $ins;
        return $this;
    }

    public function getOtherInsurance()
    {
        return $this->otherInsurance;
    }

    public function setOtherInsurance($ins)
    {
        $this->otherInsurance = $ins;
        return $this;
    }

    public function getIsPreviousDecline()
    {
        return $this->isPreviousDecline;
    }

    public function setIsPreviousDecline($dec)
    {
        $this->isPreviousDecline = $dec;
        return $this;
    }

    public function getIsIncreaseContribution()
    {
        return $this->isIncreaseContribution;
    }

    public function setIsIncreaseContribution($cont)
    {
        $this->isIncreaseContribution = $cont;
        return $this;
    }

    public function getIsRequireSpecialTerm()
    {
        return $this->isRequireSpecialTerm;
    }

    public function setIsRequireSpecialTerm($term)
    {
        $this->isRequireSpecialTerm = $term;
        return $this;
    }

    public function getSpecialTerm()
    {
        return $this->specialTerm;
    }

    public function setSpecialTerm($term)
    {
        $this->specialTerm = $term;
        return $this;
    }

    public function getIsPreviousLoss()
    {
        return $this->isPreviousLoss;
    }

    public function setIsPreviousLoss($loss)
    {
        $this->isPreviousLoss = $loss;
        return $this;
    }

    public function getCoverDetails()
    {
        return $this->coverDetails;
    }

    public function setCoverDetails($det)
    {
        $this->coverDetails = $det;
        return $this;
    }

    /**
     *
     * @return the $otherGeographicalArea
     */
    public function getOtherGeographicalArea()
    {
        return $this->otherGeographicalArea;
    }

    /**
     *
     * @param string $otherGeographicalArea            
     */
    public function setOtherGeographicalArea($otherGeographicalArea)
    {
        $this->otherGeographicalArea = $otherGeographicalArea;
        return $this;
    }

    /**
     *
     * @return the $otherTransportMedium
     */
    public function getOtherTransportMedium()
    {
        return $this->otherTransportMedium;
    }

    /**
     *
     * @param string $otherTransportMedium            
     */
    public function setOtherTransportMedium($otherTransportMedium)
    {
        $this->otherTransportMedium = $otherTransportMedium;
        return $this;
    }

    /**
     *
     * @return the $isCanceledPolicy
     */
    public function getIsCanceledPolicy()
    {
        return $this->isCanceledPolicy;
    }

    /**
     *
     * @param boolean $isCanceledPolicy            
     */
    public function setIsCanceledPolicy($isCanceledPolicy)
    {
        $this->isCanceledPolicy = $isCanceledPolicy;
        return $this;
    }

    /**
     *
     * @return the $isDeclaration
     */
    public function getIsDeclaration()
    {
        return $this->isDeclaration;
    }

    /**
     *
     * @param boolean $isDeclaration            
     */
    public function setIsDeclaration($isDeclaration)
    {
        $this->isDeclaration = $isDeclaration;
        return $this;
    }

    /**
     *
     * @param \IMServices\Entity\text $additionalInfo            
     */
    public function setAdditionalInfo($additionalInfo)
    {
        $this->additionalInfo = $additionalInfo;
        return $this;
    }
}

