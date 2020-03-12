<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;
use Settings\Entity\InsuranceServiceType;
use Doctrine\Common\Collections\Collection;
use Settings\Entity\LiveStockRearingMethod;
use Doctrine\Common\Collections\ArrayCollection;
use Settings\Entity\Insurer;

/**
 * @ORM\Entity
 * @ORM\Table(name="live_stock_farm_insurance")
 *
 * @author otaba
 *        
 */
class LiveStockFarmInsurance
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(name="no_of_livestock", type="string", nullable=true)
     *
     * @var string
     */
    private $noOfLivestock;

    /**
     * This is the age animal leaves for slaugther
     * In months
     * @ORM\Column(name="slauter_age", type="string", nullable=true)
     * 
     * @var string
     */
    private $slauterAge;

    /**
     * Is all animals that would be insured
     * @ORM\Column(name="is_all_insured", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isAllInsured;

    /**
     * @ORM\OneToMany(targetEntity="LivestockInsuredList", mappedBy="liveStockInsurance")
     * 
     * @var Collection
     */
    private $livestockInsuredList;

    /**
     * @ORM\Column(name="no_of_insured_animals", type="string", nullable=true)
     *
     * @var string
     */
    private $noOfInsuredAnimals;

    /**
     * Breeding, milk, leather, other, egg, Meat
     * This defines some services on watchlist by some insurer
     * @ORM\ManyToMany(targetEntity="Settings\Entity\FarmAnimalUse")
     * @ORM\JoinTable(name="livestock_farm_use_animal", joinColumns={
     * @ORM\JoinColumn(name="livestock_farm", referencedColumnName="id")
     * },
     * inverseJoinColumns={
     * @ORM\JoinColumn(name="farm_animal", referencedColumnName="id")
     * })
     *
     * @var Collection
     *
     */
    private $useOfAnimals;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\LiveStockRearingMethod")
     *
     * @var LiveStockRearingMethod
     */
    private $rearingMethod;

    /**
     * @ORM\Column(name="other_method", type="string", nullable=true)
     *
     * @var string
     */
    private $otherMethod;

    /**
     * @ORM\Column(name="feeding_method_source", type="text", nullable=true)
     *
     * @var text
     */
    private $feedingMethodandSource;

    /**
     * Identifies if theere exist a veitnary doctor
     * @ORM\Column(name="is_vetinary_doctor", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isVetinaryDoctor = false;

    /**
     * The na e of the vetinary doctor
     * @ORM\Column(name="vet_name", type="string", nullable=true)
     *
     * @var string
     */
    private $vetName;

    /**
     * The qualification of the vetinary doctor
     * @ORM\Column(name="vet_qualification", type="string", nullable=true)
     *
     * @var string
     */
    private $vetQualification;

    /**
     * @ORM\Column(name="vet_year_responsible_for_farm", type="string", nullable=true)
     *
     * @var string
     */
    private $vetYearResponsibleforFarm;

    /**
     * @ORM\Column(name="vet_contact_details", type="text", nullable=true)
     *
     * @var text
     */
    private $vetContactDetails;

    /**
     * @ORM\Column(name="vacinnation", type="string", nullable=true)
     *
     * @var text
     */
    private $vacinnation;

    /**
     * @ORM\Column(name="mortality_rate", type="text", nullable=true)
     *
     * @var string
     *
     */
    private $mortalityRate;

    /**
     * @ORM\Column(name="loss_history", type="text", nullable=true)
     *
     * @var Text
     */
    private $lossHistory;

    /**
     * @ORM\Column(name="is_animal_in_good_condition", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isAnimalInGoodCondition = FALSE;

    /**
     * This is only wshown if the animal condition is not good
     * @ORM\Column(name="condition_status", type="text", nullable=true)
     *
     * @var text
     */
    private $conditionStatus;

    /**
     * @ORM\Column(name="is_other_insurer", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isOtherInsurer = FALSE;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\Insurer")
     *
     * @var Insurer
     */
    private $otherInsurer;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\InsuranceServiceType")
     *
     * @var InsuranceServiceType
     */
    private $otherInsurance;

    /**
     *
     * @ORM\Column(name="is_subsidized_insurance", type="boolean", nullable=true, options={"default" : 0})
     *
     * @var boolean
     */
    private $isSubsidizedInsurance;

    /**
     * @ORM\Column(name="subsidized_insurance", type="text", nullable=true)
     *
     * @var InsuranceServiceType
     */
    private $subsidizedInsurance = FALSE;

    /**
     * Defines if the gorvernment subsidizes agricultural product at point of infectioin
     * @ORM\Column(name="is_subsidized_infected", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isSubsidizedInfectedAnimals = FALSE;

    /**
     */
    public function __construct()
    {
        $this->useOfAnimals = new ArrayCollection();
        // $this->mortalityRate = new ArrayCollection();
        // $this->lossHistory = new ArrayCollection();
        $this->livestockInsuredList = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNoOfLivestock()
    {
        return $this->noOfLivestock;
    }

    public function setNoOfLivestock($set)
    {
        $this->noOfLivestock = $set;
        return $this;
    }

    public function getNoOfInsuredAnimals()
    {
        return $this->noOfInsuredAnimals;
    }

    public function setNoOfInsuredAnimals($set)
    {
        $this->noOfInsuredAnimals = $set;
        return $this;
    }

    public function getUseOfAnimals()
    {
        return $this->useOfAnimals;
    }

    public function addUseOfAnimals($animals)
    {
        if (! $this->useOfAnimals->contains($animals)) {
            foreach ($animals as $anime) {
                $this->useOfAnimals->add($anime);
            }
        }
        return $this;
    }

    public function removeUseOfAnimals($animals)
    {
        if ($this->useOfAnimals->contains($animals)) {
            $this->useOfAnimals->removeElement($animals);
        }
        
        return $this;
    }

    public function getRearingMethod()
    {
        return $this->rearingMethod;
    }

    public function setRearingMethod($method)
    {
        $this->rearingMethod = $method;
        return $this;
    }

    public function getOtherMethod()
    {
        return $this->otherMethod;
    }

    public function setOtherMethod($metohd)
    {
        $this->otherMethod = $metohd;
        return $this;
    }

    public function getFeedingMethodandSource()
    {
        return $this->feedingMethodandSource;
    }

    public function setFeedingMethodandSource($source)
    {
        $this->feedingMethodandSource = $source;
        return $this;
    }

    public function getIsVetinaryDoctor()
    {
        return $this->isVetinaryDoctor;
    }

    public function setIsVetinaryDoctor($doc)
    {
        $this->isVetinaryDoctor = $doc;
        return $this;
    }

    public function getVetName()
    {
        return $this->vetName;
    }

    public function setVetName($name)
    {
        $this->vetName = $name;
        return $this;
    }

    public function getVetQualification()
    {
        return $this->vetQualification;
    }

    public function setVetQualification($set)
    {
        $this->vetQualification = $set;
        return $this;
    }

    public function getVetYearResponsibleforFarm()
    {
        return $this->vetYearResponsibleforFarm;
    }

    public function setVetYearResponsibleforFarm($set)
    {
        $this->vetYearResponsibleforFarm = $set;
        return $this;
    }

    public function getVetContactDetails()
    {
        return $this->vetContactDetails;
    }

    public function setVetContactDetails($set)
    {
        $this->vetContactDetails = $set;
        return $this;
    }

    public function getVaccination()
    {
        return $this->vacinnation;
    }

    public function setVaccination($set)
    {
        $this->vacinnation = $set;
        return $this;
    }

    public function getMortalityRate()
    {
        return $this->mortalityRate;
    }

    /**
     *
     * @param LiveStockMortaityRate $rate            
     * @return \IMServices\Entity\LiveStockFarmInsurance
     */
    public function addMortalityRate($rate)
    {
        foreach ($rate as $rat) {
            if (! $this->mortalityRate->contains($rat)) {
                $this->mortalityRate->add($rat);
                $rat->setLivestockFarmInsurance($this);
            }
        }
        return $this;
    }

    public function removeMortalityRate($rate)
    {
        if ($this->mortalityRate->contains($rate)) {
            $this->mortalityRate->add($rate);
        }
        
        return $this;
    }

    public function getLossHistory()
    {
        return $this->lossHistory;
    }

    /**
     *
     * @param LiveStockLossHistory $history            
     * @return \IMServices\Entity\LiveStockFarmInsurance
     */
    public function addLossHistory($history)
    {
        foreach ($history as $his) {
            if (! $this->lossHistory->contains($his)) {
                $this->lossHistory[] = $his;
                $his->setLivestockFarmInsurance($this);
            }
        }
        return $this;
    }

    /**
     *
     * @param LiveStockLossHistory $history            
     */
    public function removeLossHistory($history)
    {
        foreach ($history as $his) {
            if ($this->lossHistory->contains($his)) {
                $this->lossHistory->removeElement($his);
                $his->setLivestockFarmInsurance(NULL);
            }
        }
        return $this;
    }

    public function setLossHistory($his)
    {
        $this->lossHistory = $his;
        return $this;
    }

    public function getIsAnimalInGoodCondition()
    {
        return $this->isAnimalInGoodCondition;
    }

    public function setIsAnimalInGoodCondition($set)
    {
        $this->isAnimalInGoodCondition = $set;
        return $this;
    }

    public function getConditionStatus()
    {
        return $this->conditionStatus;
    }

    public function setConditionStatus($set)
    {
        $this->conditionStatus = $set;
        return $this;
    }

    public function getIsOtherInsurer()
    {
        return $this->isOtherInsurer;
    }

    public function setIsOtherInsurer($set)
    {
        $this->isOtherInsurer = $set;
        return $this;
    }

    public function getOtherInsurer()
    {
        return $this->otherInsurer;
    }

    public function setOtherInsurer($set)
    {
        $this->otherInsurer = $set;
        return $this;
    }

    public function getOtherInsurance()
    {
        return $this->otherInsurance;
    }

    public function setOtherInsurance($set)
    {
        $this->otherInsurance = $set;
        return $this;
    }

    public function getIsSubsidizedInsurance()
    {
        return $this->isSubsidizedInsurance;
    }

    public function setIsSubsidizedInsurance($set)
    {
        $this->isSubsidizedInsurance = $set;
        return $this;
    }

    public function getSubsidizedInsurance()
    {
        return $this->subsidizedInsurance;
    }

    public function setSubsidizedInsurance($set)
    {
        $this->subsidizedInsurance = $set;
        return $this;
    }

    public function getIsSubsidizedInfectedAnimals()
    {
        return $this->isSubsidizedInfectedAnimals;
    }

    public function setIsSubsidizedInfectedAnimals($sub)
    {
        $this->isSubsidizedInfectedAnimals = $sub;
        return $this;
    }
    /**
     * @return the $slauterAge
     */
    public function getSlauterAge()
    {
        return $this->slauterAge;
    }

    /**
     * @param string $slauterAge
     */
    public function setSlauterAge($slauterAge)
    {
        $this->slauterAge = $slauterAge;
        return $this;
    }

    /**
     * @return the $isAllInsured
     */
    public function getIsAllInsured()
    {
        return $this->isAllInsured;
    }

    /**
     * @param boolean $isAllInsured
     */
    public function setIsAllInsured($isAllInsured)
    {
        $this->isAllInsured = $isAllInsured;
        return $this;
    }

    /**
     * @return the $vacinnation
     */
    public function getVacinnation()
    {
        return $this->vacinnation;
    }

    /**
     * @param \IMServices\Entity\text $vacinnation
     */
    public function setVacinnation($vacinnation)
    {
        $this->vacinnation = $vacinnation;
        return   $this;
    }

//     /**
//      * @return the $isSubsidizedInfectedAnimals
//      */
//     public function getIsSubsidizedInfectedAnimals()
//     {
//         return $this->isSubsidizedInfectedAnimals;
//     }

    /**
     * @param string $mortalityRate
     */
    public function setMortalityRate($mortalityRate)
    {
        $this->mortalityRate = $mortalityRate;
        return $this;
    }
    /**
     * @return the $livestockInsuredList
     */
    public function getLivestockInsuredList()
    {
        return $this->livestockInsuredList;
    }


}

