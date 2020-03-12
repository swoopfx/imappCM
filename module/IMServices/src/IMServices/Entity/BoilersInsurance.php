<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="boiler_insurance")
 * 
 * @author otaba
 *        
 */
class BoilersInsurance
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * Chief engineer name
     * @ORM\Column(name="chief_engineer", type="string", nullable=true)
     * 
     * @var string
     */
    private $chiefEngineer;

    /**
     * @ORM\Column(name="start_date", type="datetime", nullable=true)
     * 
     * @var \DateTime
     */
    private $startDate;

    /**
     *
     * @ORM\Column(name="end_date", type="datetime", nullable=true)
     * 
     * @var \DateTime
     */
    private $endDate;

    /**
     * nature of business
     * @ORM\Column(name="nature_of_business", type="string", nullable=true)
     * 
     * @var string
     */
    private $natureOfBusiness;

    /**
     * if there was previously insured by another insurer
     * @ORM\Column(name="is_previously_insured", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isPreviouslyInsured;

    /**
     * if above is true
     * identify if there was an accident
     * @ORM\Column(name="is_previous_accidents", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isPreviousAccident;
    
    /**
     * @ORM\Column(name="accident_measure", type="text", nullable=true)
     * @var text 
     */
    private $accidentMeasures;

    /**
     * include main steam and feed water piping in the cover
     * @ORM\Column(name="is_include_steam", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isIncludeSteam;

    /**
     * Idenfy if there should be a full cover
     * @ORM\Column(name="is_cover_all", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isCoverAll;

    /**
     * @ORM\Column(name="exclude_part", type="text", nullable=true)
     * 
     * @var text
     */
    private $excludedPart;

    /**
     * Boiler is in good condition
     * @ORM\Column(name="is_good_condition", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isGoodCondition;

    /**
     * if not Define defect part
     * @ORM\Column(name="defect_part", type="string", nullable=true)
     * 
     * @var string
     */
    private $defectPart;

    /**
     * The specific part periodically inspected and requires attention
     * @ORM\Column(name="part_periodically_inspected", type="string", nullable=true)
     * 
     * @var string
     */
    private $partPeriodicallyinspected;

    /**
     * Who makes the inpection
     * @ORM\Column(name="inspection_by", type="string", nullable=true)
     * 
     * @var string
     */
    private $inspectionBy;

    /**
     * Last Instection Date
     * @ORM\Column(name="last_inspection_date", type="datetime", nullable=true)
     * 
     * @var \DateTime
     */
    private $lastInspectionDate;

    /**
     * What is the maximum load on safety value? PSi
     * @ORM\Column(name="max_safety_load_level", type="string", nullable=true)
     * 
     * @var string
     */
    private $maxSafetyLoadLevel;

    /**
     * What is the working pressure
     * @ORM\Column(name="working_pressure", type="string", nullable=true)
     * 
     * @var string
     */
    private $workingPressure;

    /**
     * @ORM\OneToMany(targetEntity="BoilerCoverDetails", mappedBy="boiler")
     * @var Collection
     */
    private $coverList;

    /**
     */
    public function __construct()
    {
        $this->coverList = new ArrayCollection();
    }
    /**
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return the $chiefEngineer
     */
    public function getChiefEngineer()
    {
        return $this->chiefEngineer;
    }

    /**
     * @param string $chiefEngineer
     */
    public function setChiefEngineer($chiefEngineer)
    {
        $this->chiefEngineer = $chiefEngineer;
        return $this;
    }

    /**
     * @return the $startDate
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param DateTime $startDate
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
        return $this;
    }

    /**
     * @return the $endDate
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @param DateTime $endDate
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
        return $this;
    }

    /**
     * @return the $natureOfBusiness
     */
    public function getNatureOfBusiness()
    {
        return $this->natureOfBusiness;
    }

    /**
     * @param string $natureOfBusiness
     */
    public function setNatureOfBusiness($natureOfBusiness)
    {
        $this->natureOfBusiness = $natureOfBusiness;
        return $this;
    }

    /**
     * @return the $isPreviouslyInsured
     */
    public function getIsPreviouslyInsured()
    {
        return $this->isPreviouslyInsured;
    }

    /**
     * @param boolean $isPreviouslyInsured
     */
    public function setIsPreviouslyInsured($isPreviouslyInsured)
    {
        $this->isPreviouslyInsured = $isPreviouslyInsured;
        return $this;
    }

    /**
     * @return the $isPreviousAccident
     */
    public function getIsPreviousAccident()
    {
        return $this->isPreviousAccident;
    }

    /**
     * @param boolean $isPreviousAccident
     */
    public function setIsPreviousAccident($isPreviousAccident)
    {
        $this->isPreviousAccident = $isPreviousAccident;
        return $this;
    }

    /**
     * @return the $isIncludeSteam
     */
    public function getIsIncludeSteam()
    {
        return $this->isIncludeSteam;
    }

    /**
     * @param boolean $isIncludeSteam
     */
    public function setIsIncludeSteam($isIncludeSteam)
    {
        $this->isIncludeSteam = $isIncludeSteam;
        return $this;
    }

    /**
     * @return the $isCoverAll
     */
    public function getIsCoverAll()
    {
        return $this->isCoverAll;
    }

    /**
     * @param boolean $isCoverAll
     */
    public function setIsCoverAll($isCoverAll)
    {
        $this->isCoverAll = $isCoverAll;
        return $this;
    }

    /**
     * @return the $excludedPart
     */
    public function getExcludedPart()
    {
        return $this->excludedPart;
    }

    /**
     * @param string $excludedPart
     */
    public function setExcludedPart($excludedPart)
    {
        $this->excludedPart = $excludedPart;
        return $this;
    }

    /**
     * @return the $isGoodCondition
     */
    public function getIsGoodCondition()
    {
        return $this->isGoodCondition;
    }

    /**
     * @param boolean $isGoodCondition
     */
    public function setIsGoodCondition($isGoodCondition)
    {
        $this->isGoodCondition = $isGoodCondition;
        return $this;
    }

    /**
     * @return the $defectPart
     */
    public function getDefectPart()
    {
        return $this->defectPart;
    }

    /**
     * @param string $defectPart
     */
    public function setDefectPart($defectPart)
    {
        $this->defectPart = $defectPart;
        return $this;
    }

    /**
     * @return the $partPeriodicallyinspected
     */
    public function getPartPeriodicallyinspected()
    {
        return $this->partPeriodicallyinspected;
    }

    /**
     * @param string $partPeriodicallyinspected
     */
    public function setPartPeriodicallyinspected($partPeriodicallyinspected)
    {
        $this->partPeriodicallyinspected = $partPeriodicallyinspected;
        return $this;
    }

    /**
     * @return the $inspectionBy
     */
    public function getInspectionBy()
    {
        return $this->inspectionBy;
    }

    /**
     * @param string $inspectionBy
     */
    public function setInspectionBy($inspectionBy)
    {
        $this->inspectionBy = $inspectionBy;
        return $this;
    }

    /**
     * @return the $lastInspectionDate
     */
    public function getLastInspectionDate()
    {
        return $this->lastInspectionDate;
    }

    /**
     * @param DateTime $lastInspectionDate
     */
    public function setLastInspectionDate($lastInspectionDate)
    {
        $this->lastInspectionDate = $lastInspectionDate;
        return $this;
    }

    /**
     * @return the $maxSafetyLoadLevel
     */
    public function getMaxSafetyLoadLevel()
    {
        return $this->maxSafetyLoadLevel;
    }

    /**
     * @param string $maxSafetyLoadLevel
     */
    public function setMaxSafetyLoadLevel($maxSafetyLoadLevel)
    {
        $this->maxSafetyLoadLevel = $maxSafetyLoadLevel;
        return $this;
    }

    /**
     * @return the $workingPressure
     */
    public function getWorkingPressure()
    {
        return $this->workingPressure;
    }

    /**
     * @param string $workingPressure
     */
    public function setWorkingPressure($workingPressure)
    {
        $this->workingPressure = $workingPressure;
        return $this;
    }

    /**
     * @return the $coverList
     */
    public function getCoverList()
    {
        return $this->coverList;
    }
    
    /**
     * 
     * @param BoilerCoverDetails $coverList
     */
    public function addCoverList($coverList){
        if(!$this->coverList->contains($coverList)){
            $this->coverList->add($coverList);
            $coverList->setBoiler($this);
        }
        return $this;
    }
    
    /**
     *
     * @param BoilerCoverDetails $coverList
     */
    public function removeCoverList($coverList){
        if($this->coverList->contains($coverList)){
            $this->coverList->removeElement($coverList);
            $coverList->setBoiler(NULL);
        }
        return $this;
    }

    /**
     * @param field_type $coverList
     */
    public function setCoverList($coverList)
    {
        $this->coverList = $coverList;
        return $this;
    }
    /**
     * @return the $accidentMeasures
     */
    public function getAccidentMeasures()
    {
        return $this->accidentMeasures;
    }

    /**
     * @param \IMServices\Entity\text $accidentMeasures
     */
    public function setAccidentMeasures($accidentMeasures)
    {
        $this->accidentMeasures = $accidentMeasures;
        return $this;
    }


}

