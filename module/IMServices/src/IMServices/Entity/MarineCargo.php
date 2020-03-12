<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;
use Settings\Entity\MarineCargPackagingType;
use Settings\Entity\MarineCargoCoverType;
use Settings\Entity\MarineCargoTransitMode;
// use Doctrine\Common\Collections\Collection;
use Proposal\Entity\Proposal;
// use Policy\Entity\PolicyFloat;
// use Packages\Entity\Packages;
// use Object\Entity\Object;
use Offer\Entity\Offer;
use Doctrine\Common\Collections\ArrayCollection;
use Settings\Entity\Currency;
use Settings\Entity\VesselType;

/**
 * @ORM\Entity
 * @ORM\Table(name="marine_cargo")
 *
 * @author otaba
 *        
 */
class MarineCargo
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(name="cargo_nature", type="text", nullable=true)
     *
     * @var text
     */
    private $cargoNature;

    /**
     * @ORM\Column(name="other_vessel_type", type="string", nullable=true)
     * 
     * @var string
     */
    private $otherVesselType;

    // /**
    // * @ORM\ManyToOne(targetEntity="Object\Entity\Object")
    // *
    // * @var Object
    // */
    // private $object;
    
    /**
     * @ORM\Column(name="experienc_yearss", type="string", nullable=true)
     *
     * @var string
     */
    private $experienceYears;

    /**
     * This is eiter
     * Cartons, Bags , Woodcase, bundles or others
     *
     * @ORM\ManyToOne(targetEntity="Settings\Entity\MarineCargPackagingType")
     *
     * @var MarineCargPackagingType
     */
    private $packagingType;

    /**
     * @ORM\Column(name="others_package", type="string", nullable=true)
     *
     * @var string
     */
    private $othersPackage;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\MarineCargoTransitMode")
     *
     * @var MarineCargoTransitMode
     */
    private $transitMode;

    /**
     * This -s either open cover or Single transit
     * @ORM\ManyToOne(targetEntity="Settings\Entity\MarineCargoCoverType")
     *
     * @var MarineCargoCoverType
     */
    private $coverType;

    /**
     * This is the value of the cargo
     * @ORM\Column(name="cargo_value", nullable=true, type="string")
     *
     * @var string
     */
    private $cargoValue;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\Currency")
     * 
     * @var Currency
     */
    private $currency;

    /**
     * @ORM\Column(name="max_sum_insured", type="string", nullable=true)
     * This is the maximum sum insured by conveyance
     * 
     * @var string
     */
    private $maxSumInsured;

    /**
     * @ORM\Column(name="expected_premium", type="string", nullable=true)
     *
     * @var string
     */
    private $expectedPremium;

    /**
     * This is port of departure
     * @ORM\Column(name="voyage_from", type="string", nullable=true)
     *
     * @var string
     */
    private $voyageFrom;

    /**
     *
     * This is port of destination
     * @ORM\Column(name="voyage_to", type="string", nullable=true)
     *
     * @var string
     */
    private $voyageTo;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Settings\Entity\VesselType")
     * 
     * @var VesselType
     */
    private $typeOfVessel;

    /**
     *
     * @ORM\Column(name="name_of_vessel", type="string", nullable=true)
     * 
     * @var string
     */
    private $nameOfVessel;

    /**
     * @ORM\Column(name="is_containized", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isContainized;

    /**
     * @ORM\Column(name="is_previous_decline", type="boolean", nullable=true)
     *
     * @var string
     */
    private $isPreviousDecline;

    /**
     * @ORM\Column(name="decline_reason", type="text", nullable=true)
     *
     * @var string
     */
    private $declineReason;

    // /**
    // * @ORM\OneToMany(targetEntity="Offer\Entity\Offer", mappedBy="marineCargo")
    // *
    // * @var Collection
    // *
    // */
    // private $offer;
    
    // /**
    // * @ORM\OneToMany(targetEntity="Proposal\Entity\Proposal", mappedBy="marineCargo")
    // *
    // *
    // * @var Collection
    // *
    // */
    // private $proposal;
    
    // /**
    // * @ORM\OneToMany(targetEntity="Policy\Entity\PolicyFloat", mappedBy="marineCargo")
    // *
    // * @var Collection
    // */
    // private $floatingPolicy;
    
    // /**
    // * @ORM\OneToMany(targetEntity="Packages\Entity\Packages", mappedBy="marineCargo")
    // *
    // * @var Collection
    // */
    // private $package;
    
    /**
     * @ORM\Column(name="created_on", type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $createdOn;

    /**
     * @ORM\Column(name="is_decalaration", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isDeclaration;

    /**
     */
    public function __construct()
    {
        $this->offer = new ArrayCollection();
        $this->proposal = new ArrayCollection();
        $this->floatingPolicy = new ArrayCollection();
        $this->package = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCargoNature()
    {
        return $this->cargoNature;
    }

    public function setCargoNature($natur)
    {
        $this->cargoNature = $natur;
        return $this;
    }

    public function getCargoValue()
    {
        return $this->cargoValue;
    }

    public function setCargoValue($value)
    {
        $this->cargoValue = $value;
        return $this;
    }

    public function getObject()
    {
        return $this->object;
    }

    public function setObject($obj)
    {
        $this->object = $obj;
        return $this;
    }

    public function getExperienceYears()
    {
        return $this->experienceYears;
    }

    public function setExperienceYears($years)
    {
        $this->experienceYears = $years;
        return $this;
    }

    public function getPackagingType()
    {
        return $this->packagingType;
    }

    public function getOthersPackag()
    {
        return $this->othersPackage;
    }

    public function setOthersPackag($pak)
    {
        $this->othersPackage = $pak;
        return $this;
    }

    public function getTransitMode()
    {
        return $this->transitMode;
    }

    public function setTransitMode($mode)
    {
        $this->transitMode = $mode;
        return $this;
    }

    public function getCoverType()
    {
        return $this->coverType;
    }

    public function setCoverType($type)
    {
        $this->coverType = $type;
        return $this;
    }

    public function getMaxSumInsured()
    {
        return $this->maxSumInsured;
    }

    public function setMaxSumInsured($max)
    {
        $this->maxSumInsured = $max;
        return $this;
    }

    public function getExpectedPremium()
    {
        return $this->expectedPremium;
    }

    public function setExpectedPremium($val)
    {
        $this->expectedPremium = $val;
        return $this;
    }

    public function getVoyageFrom()
    {
        return $this->voyageFrom;
    }

    public function setVoyageFrom($from)
    {
        $this->voyageFrom = $from;
        return $this;
    }

    public function getVoyageTo()
    {
        return $this->voyageTo;
    }

    public function setVoyageTo($to)
    {
        $this->voyageTo = $to;
        return $this;
    }

    public function getIsPreviousDecline()
    {
        return $this->isPreviousDecline;
    }

    public function setIsPreviousDecline($bool)
    {
        $this->isPreviousDecline = $bool;
        return $this;
    }

    public function getDeclineReason()
    {
        return $this->declineReason;
    }

    public function setDeclineReason($rea)
    {
        $this->declineReason = $rea;
        return $this;
    }

    public function getOffer()
    {
        return $this->offer;
    }

    /**
     *
     * @param Offer $offer            
     * @return \IMServices\Entity\MarineCargo
     */
    public function addOffer($offer)
    {
        if (! $this->offer->contains($offer)) {
            $this->offer->add($offer);
        }
        return $this;
    }

    /**
     *
     * @param Offer $offer            
     * @return \IMServices\Entity\MarineCargo
     */
    public function removeOffer($offer)
    {
        if ($this->offer->contains($offer)) {
            $this->offer->removeElement($offer);
        }
        return $this;
    }

    public function getProposal()
    {
        return $this->proposal;
    }

    public function addProposal($proposal)
    {
        if (! $this->proposal->contains($proposal)) {
            $this->proposal->add($proposal);
        }
        return $this;
    }

    public function removeProposal($proposal)
    {
        if ($this->proposal->contains($proposal)) {
            $this->proposal->removeElement($proposal);
        }
        return $this;
    }

    public function getFloatingPolicy()
    {
        return $this->floatingPolicy;
    }

    public function addFloatingPolicy($policy)
    {
        if (! $this->floatingPolicy->contains($policy)) {
            $this->floatingPolicy->add($policy);
        }
        return $this;
    }

    public function removeFloatingPolicy($policy)
    {
        if ($this->floatingPolicy->contains($policy)) {
            $this->floatingPolicy->removeElement($policy);
        }
        return $this;
    }

    public function getPackage()
    {
        return $this->package;
    }

    public function addPackage($pack)
    {
        if (! $this->package->contains($pack)) {
            $this->floatingPolicy->add($pack);
        }
        return $this;
    }

    public function removePackage($pack)
    {
        if ($this->package->contains($pack)) {
            $this->package->add($pack);
        }
        return $this;
    }

    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    public function setCreatedOn($date)
    {
        $this->createdOn = $date;
        return $this;
    }

    public function getIsDeclaration()
    {
        return $this->isDeclaration;
    }

    public function setIsDeclaration($dec)
    {
        $this->isDeclaration = $dec;
        return $this;
    }

    /**
     *
     * @return the $otherVesselType
     */
    public function getOtherVesselType()
    {
        return $this->otherVesselType;
    }

    /**
     *
     * @param string $otherVesselType            
     */
    public function setOtherVesselType($otherVesselType)
    {
        $this->otherVesselType = $otherVesselType;
        return $this;
    }

    /**
     *
     * @return the $othersPackage
     */
    public function getOthersPackage()
    {
        return $this->othersPackage;
    }

    /**
     *
     * @param string $othersPackage            
     */
    public function setOthersPackage($othersPackage)
    {
        $this->othersPackage = $othersPackage;
        return $this;
    }

    /**
     *
     * @return the $currency
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     *
     * @param \Settings\Entity\Currency $currency            
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    /**
     *
     * @return the $typeOfVessel
     */
    public function getTypeOfVessel()
    {
        return $this->typeOfVessel;
    }

    /**
     *
     * @param string $typeOfVessel            
     */
    public function setTypeOfVessel($typeOfVessel)
    {
        $this->typeOfVessel = $typeOfVessel;
        return $this;
    }

    /**
     *
     * @return the $nameOfVessel
     */
    public function getNameOfVessel()
    {
        return $this->nameOfVessel;
    }

    /**
     *
     * @param \Settings\Entity\VesselType $nameOfVessel            
     */
    public function setNameOfVessel($nameOfVessel)
    {
        $this->nameOfVessel = $nameOfVessel;
        return $this;
    }

    /**
     *
     * @return the $isContainized
     */
    public function getIsContainized()
    {
        return $this->isContainized;
    }

    /**
     *
     * @param boolean $isContainized            
     */
    public function setIsContainized($isContainized)
    {
        $this->isContainized = $isContainized;
        return $this;
    }

    /**
     *
     * @param \Settings\Entity\MarineCargPackagingType $packagingType            
     */
    public function setPackagingType($packagingType)
    {
        $this->packagingType = $packagingType;
        return $this;
    }
}

