<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="electronic_equipment")
 *
 * @author otaba
 *        
 */
class ElectronicEquipment
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * Defines if all lectronic witin building is to be insured
     * @ORM\Column(name="is_insure_all", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isInsureAll;

    /**
     * Identifies all device was purchased new
     * @ORM\Column(name="is_all_new", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isAllNew;

    /**
     * @ORM\OneToMany(targetEntity="ElectronicEquipmentNotNewList", mappedBy="electonicEquipment")
     *
     * @var Collection
     */
    private $notNewList;

    /**
     * Total Cost of all the insured product
     * @ORM\Column(name="estimated_sum_total", type="string", nullable=true)
     *
     * @var string
     */
    private $estimatedSumTotal;

    /**
     * This is available if the above insure all is false
     * A list of equipments to be insured
     * @ORM\OneToMany(targetEntity="ElectronicEquipmentInsuredList", mappedBy="electronicEquipment")
     *
     * @var Collection
     */
    private $insuredList;

    /**
     * Describtion of the type of business taken place
     * @ORM\Column(name="business_type", type="string", nullable=true)
     *
     * @var string
     */
    private $businesType;

    /**
     * Adddress and building type
     * @ORM\Column(name="equipment_location", type="text", nullable=true)
     *
     * @var text
     */
    private $equipmentLocation;

    /**
     * Identifies if the device where previously insured
     * @ORM\Column(name="is_previously_insured", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isPreviouslyInsured;

    /**
     * @ORM\Column(name="cover_start_date", type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $coverStartDate;

    /**
     * Device is maintained according to manufacturere specification
     * @ORM\Column(name="is_maintenance_spec", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isMaintenaceSpec;

    /**
     * Operators are trained with respect to manufacturers spec
     * @ORM\Column(name="is_trained_operators", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isTrainedOperators;

    /**
     * Include risk for theft
     * @ORM\Column(name="is_theft_risk", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isTheftRIsk;

    /**
     * @ORM\Column(name="is_electronic_device", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isElectronicDevice;

    /**
     * SIte contains dangerous chemicals liek acids
     * @ORM\Column(name="is_dangerous_materials", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isDangerousMaterial;

    // if it is electrnic select scope of cover
    
    /**
     * @ORM\ManyToMany(targetEntity="Settings\Entity\ElectronicEquipmentScopeOfCover", cascade={"persist","remove"})
     * @ORM\JoinTable(name="electronic_equipment_equipment_scope", joinColumns={
     * @ORM\JoinColumn(name="electronic", referencedColumnName="id")
     * },
     * inverseJoinColumns={
     * @ORM\JoinColumn(name="scope", referencedColumnName="id")
     * })
     *
     *
     * @var Collection
     *
     */
    private $scopeOfCover;

    /**
     */
    public function __construct()
    {
        $this->insuredList = new ArrayCollection();
        $this->scopeOfCover = new ArrayCollection();
    }

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
    }

    /**
     *
     * @return the $isInsureAll
     */
    public function getIsInsureAll()
    {
        return $this->isInsureAll;
    }

    /**
     *
     * @param boolean $isInsureAll            
     */
    public function setIsInsureAll($isInsureAll)
    {
        $this->isInsureAll = $isInsureAll;
    }

    /**
     *
     * @return the $isAllNew
     */
    public function getIsAllNew()
    {
        return $this->isAllNew;
    }

    /**
     *
     * @param boolean $isAllNew            
     */
    public function setIsAllNew($isAllNew)
    {
        $this->isAllNew = $isAllNew;
    }

    /**
     *
     * @return the $notNewList
     */
    public function getNotNewList()
    {
        return $this->notNewList;
    }

    /**
     *
     * @param ElectronicEquipmentNotNewList $notNewList            
     */
    public function addNotNewList($notNewList)
    {
        if (! $this->notNewList->contains($notNewList)) {
            $this->notNewList[] = $notNewList;
            $notNewList->setElectonicEquipment($this);
        }
        return $this;
    }

    public function removeNotNewList($notNewList)
    {
        if ($this->notNewList->contains($notNewList)) {
            $this->notNewList->removeElement($notNewList);
            $notNewList->setElectonicEquipment(NULL);
        }
        return $this;
    }

    /**
     *
     * @return the $estimatedSumTotal
     */
    public function getEstimatedSumTotal()
    {
        return $this->estimatedSumTotal;
    }

    /**
     *
     * @param string $estimatedSumTotal            
     */
    public function setEstimatedSumTotal($estimatedSumTotal)
    {
        $this->estimatedSumTotal = $estimatedSumTotal;
    }

    /**
     *
     * @return the $insuredList
     */
    public function getInsuredList()
    {
        return $this->insuredList;
    }

    /**
     *
     * @param ElectronicEquipmentInsuredList $insuredList            
     */
    public function addInsuredList($insuredList)
    {
        if (! $this->insuredList->contains($insuredList)) {
            $this->insuredList[] = $insuredList;
            $insuredList->setElectronicEquipment($insuredList);
        }
    }

    /**
     *
     * @param ElectronicEquipmentInsuredList $insuredList            
     */
    public function removeInsuredList($insuredList)
    {
        if (! $this->insuredList->contains($insuredList)) {
            $this->insuredList->removeElement($insuredList);
            $insuredList->setElectronicEquipment(NULL);
        }
    }

    // /**
    // * @param \Doctrine\Common\Collections\Collection $insuredList
    // */
    // public function setInsuredList($insuredList)
    // {
    // $this->insuredList = $insuredList;
    // }
    
    /**
     *
     * @return the $businesType
     */
    public function getBusinesType()
    {
        return $this->businesType;
    }

    /**
     *
     * @param string $businesType            
     */
    public function setBusinesType($businesType)
    {
        $this->businesType = $businesType;
        return $this;
    }

    /**
     *
     * @return the $equipmentLocation
     */
    public function getEquipmentLocation()
    {
        return $this->equipmentLocation;
    }

    /**
     *
     * @param \IMServices\Entity\text $equipmentLocation            
     */
    public function setEquipmentLocation($equipmentLocation)
    {
        $this->equipmentLocation = $equipmentLocation;
        return $this;
    }

    /**
     *
     * @return the $isPreviouslyInsured
     */
    public function getIsPreviouslyInsured()
    {
        return $this->isPreviouslyInsured;
    }

    /**
     *
     * @param boolean $isPreviouslyInsured            
     */
    public function setIsPreviouslyInsured($isPreviouslyInsured)
    {
        $this->isPreviouslyInsured = $isPreviouslyInsured;
        return $this;
    }

    /**
     *
     * @return the $coverStartDate
     */
    public function getCoverStartDate()
    {
        return $this->coverStartDate;
    }

    /**
     *
     * @param DateTime $coverStartDate            
     */
    public function setCoverStartDate($coverStartDate)
    {
        $this->coverStartDate = $coverStartDate;
        return $this;
    }

    /**
     *
     * @return the $isMaintenaceSpec
     */
    public function getIsMaintenaceSpec()
    {
        return $this->isMaintenaceSpec;
    }

    /**
     *
     * @param boolean $isMaintenaceSpec            
     */
    public function setIsMaintenaceSpec($isMaintenaceSpec)
    {
        $this->isMaintenaceSpec = $isMaintenaceSpec;
        return $this;
    }

    /**
     *
     * @return the $isTrainedOperators
     */
    public function getIsTrainedOperators()
    {
        return $this->isTrainedOperators;
    }

    /**
     *
     * @param boolean $isTrainedOperators            
     */
    public function setIsTrainedOperators($isTrainedOperators)
    {
        $this->isTrainedOperators = $isTrainedOperators;
        return $this;
    }

    /**
     *
     * @return the $isTheftRIsk
     */
    public function getIsTheftRIsk()
    {
        return $this->isTheftRIsk;
    }

    /**
     *
     * @param boolean $isTheftRIsk            
     */
    public function setIsTheftRIsk($isTheftRIsk)
    {
        $this->isTheftRIsk = $isTheftRIsk;
        return $this;
    }

    /**
     *
     * @return the $isElectronicDevice
     */
    public function getIsElectronicDevice()
    {
        return $this->isElectronicDevice;
    }

    /**
     *
     * @param boolean $isElectronicDevice            
     */
    public function setIsElectronicDevice($isElectronicDevice)
    {
        $this->isElectronicDevice = $isElectronicDevice;
        return $this;
    }

    /**
     *
     * @return the $isDangerousMaterial
     */
    public function getIsDangerousMaterial()
    {
        return $this->isDangerousMaterial;
    }

    /**
     *
     * @param boolean $isDangerousMaterial            
     */
    public function setIsDangerousMaterial($isDangerousMaterial)
    {
        $this->isDangerousMaterial = $isDangerousMaterial;
        return $this;
    }

    /**
     *
     * @return the $scopeOfCover
     */
    public function getScopeOfCover()
    {
        return $this->scopeOfCover;
    }

    /**
     *
     * @param \Doctrine\Common\Collections\Collection $scopeOfCover            
     */
    public function addScopeOfCover($scopeOfCover)
    {
        foreach ($scopeOfCover as $cover) {
            if (! $this->scopeOfCover->contains($cover)) {
                $this->scopeOfCover->add($cover);
            }
        }
        return $this;
    }

    public function removeScopeOfCover($scopeOfCover)
    {
        foreach ($scopeOfCover as $cover) {
            if ($this->scopeOfCover->contains($cover)) {
                $this->scopeOfCover->removeElement($cover);
            }
        }
        return $this;
    }
}

