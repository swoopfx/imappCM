<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Db\Sql\Ddl\Column\Datetime;
use Doctrine\Common\Collections\Collection;
use Settings\Entity\Zone;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\ENtity
 * @ORM\Table(name="crop_agric_insurance")
 *
 * @author otaba
 *        
 */
class CropAgricInsurance
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(name="cover_start_date", type="datetime", nullable=true)
     *
     * @var Datetime
     */
    private $coverStartDate;

    /**
     * @ORM\Column(name="cover_end_date", type="datetime", nullable=true)
     *
     * @var Datetime
     */
    private $coverEndDate;

    /**
     * Thisprovides a detailed address of the farm
     * 
     * @var text
     */
    private $farmAddress;

    /**
     * @ORM\Column(name="farm_nearest_village", type="string", nullable=true)
     * 
     * @var text
     */
    private $farmNearestVillage;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\Zone")
     * 
     * @var Zone
     */
    private $farmState;

    /**
     * @ORM\Column(name="farm_size", type="string", nullable=true)
     * 
     * @var string
     */
    private $farmSize;

    /**
     * This defines the total area of plantation which is usually
     * Equal to or less than the farmSize
     * @ORM\Column(name="farm_are_planted", type="string", nullable=true)
     * 
     * @var string
     */
    private $farmAreaPlanted;

    /**
     * @ORM\Column(name="crop_planting_date", type="datetime", nullable=true)
     * 
     * @var \DateTime
     */
    private $cropPlantingDate;

    /**
     * @ORM\Column(name="estimated_harvest_date", type="datetime", nullable=true)
     * 
     * @var \DateTime
     */
    private $estimatedHarvetDate;

    /**
     * Year season commence, this is figure in year
     * @ORM\Column(name="season_commencement", type="string", nullable=true)
     * 
     * @var string
     */
    private $seasonCommencement;

    /**
     * Year season End, this is figure in year
     * @ORM\Column(name="season_end", type="string", nullable=true)
     * 
     * @var string
     */
    private $seasonEnd;

    /**
     * Estimated Cost Of clearing land
     * @ORM\Column(name="estimated_cost_land_clearing", type="string", nullable=true)
     * 
     * @var string
     */
    private $estimatedCostLandClearing;

    /**
     * Estimated Cost Of Planting
     * @ORM\Column(name="estimated_cost_planting", type="string", nullable=true)
     * 
     * @var string
     */
    private $estimatedCostPlanting;

    /**
     * Estimated Cost Of Irrigation
     * @ORM\Column(name="estimated_cost_irrigation", type="string", nullable=true)
     * 
     * @var string
     */
    private $estimatesCostIrrigation;

    /**
     * Estimated Cost on weed and pest control
     * @ORM\Column(name="estimated_cost_weed_pest_control", type="string", nullable=true)
     * 
     * @var string
     */
    private $estimatedCostWeedPestControl;

    /**
     * An Estimated cost on transportation
     * @ORM\Column(name="estimated_cost_transportation", type="string", nullable=true)
     * 
     * @var string
     */
    private $estinmatedCostTransportation;

    /**
     * Interest On loan
     * @ORM\Column(name="estimated_cost_interest_loan", type="string", nullable=true)
     * 
     * @var string
     */
    private $estimatedCostInterestLoan;

    /**
     * @ORM\Column(name="estimated_cost_harvesting", type="string", nullable=true)
     * 
     * @var string
     */
    private $estmatedCostHarvesting;

    /**
     * @ORM\Column(name="estimated_cost_miscellanous", type="string", nullable=true)
     * 
     * @var string
     */
    private $estimatedCostMiscellanous;

    /**
     * Defines if the irrigation exist on the farm
     * @ORM\Column(name="is_irrigation", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isIrrigation;

    /**
     * @ORM\Column(name="_crop_seed_variety", type="string", nullable=true)
     * 
     * @var string
     */
    private $cropSeedVariety;

    /**
     * @ORM\Column(name="crop_type_insured", type="string", nullable=true)
     *
     * @var string;
     */
    private $cropTypeInsured;

    /**
     * @ORM\Column(name="years_in_business", type="string", nullable=true)
     *
     * @var string
     */
    private $yearInBusiness;

    /**
     * @ORM\OneToMany(targetEntity="CropAgricStaffDetails", mappedBy="cropAgricInsurance")
     *
     * @var Collection
     */
    private $staffDetails;

    /**
     * @ORM\OneToMany(targetEntity="CropAgricCropDetails", mappedBy="cropAgricInsurance")
     *
     * @var Collection
     */
    private $cropDetails;

//     /**
//      * @ORM\Column(name="crop_biggest_threat", type="string", nullable=true)
//      *
//      * @var string
//      */
//     private $cropsBiggestThreat;

    /**
     * @ORM\Column(name="threat_management", type="text", nullable=true)
     *
     * @var text
     */
    private $threatManagement;

    /**
     * Any other risk management toiol used no listed as a threat above
     * @ORM\Column(name="special_risk_management", type="text", nullable=true)
     *
     * @var text
     */
    private $specialRiskManagment;

    /**
     * Breeding, milk, leather, other, egg, Meat
     * This defines some services on watchlist by some insurer
     * @ORM\ManyToMany(targetEntity="Settings\Entity\CropAgricPeril")
     * @ORM\JoinTable(name="crop_agric_insurance_peril", joinColumns={
     * @ORM\JoinColumn(name="crop_insurance", referencedColumnName="id")
     * },
     * inverseJoinColumns={
     * @ORM\JoinColumn(name="crop_peril", referencedColumnName="id")
     * })
     *
     * @var Collection
     *
     */
    private $cropPerilCoverList;

    public function __construct()
    {
        $this->cropPerilCoverList = new ArrayCollection();
        $this->cropDetails = new ArrayCollection();
        $this->staffDetails = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     *
     * @return the $cropSeedVariety
     */
    public function getCropSeedVariety()
    {
        return $this->cropSeedVariety;
    }

    /**
     *
     * @param string $cropSeedVariety            
     */
    public function setCropSeedVariety($cropSeedVariety)
    {
        $this->cropSeedVariety = $cropSeedVariety;
        return $this;
    }

    public function getCoverStartDate()
    {
        return $this->coverStartDate;
    }

    public function setCoverStartDate($date)
    {
        $this->coverStartDate = $date;
        return $this;
    }

    public function getCoverEndDate()
    {
        return $this->coverEndDate;
    }

    public function setCoverEndDate($end)
    {
        $this->coverEndDate = $end;
        return $this;
    }

    /**
     *
     * @return the $farmAddress
     */
    public function getFarmAddress()
    {
        return $this->farmAddress;
    }

    /**
     *
     * @return the $farmNearestVillage
     */
    public function getFarmNearestVillage()
    {
        return $this->farmNearestVillage;
    }

    /**
     *
     * @return the $farmState
     */
    public function getFarmState()
    {
        return $this->farmState;
    }

    /**
     *
     * @return the $farmSize
     */
    public function getFarmSize()
    {
        return $this->farmSize;
    }

    /**
     *
     * @return the $farmAreaPlanted
     */
    public function getFarmAreaPlanted()
    {
        return $this->farmAreaPlanted;
    }

    /**
     *
     * @return the $cropPlantingDate
     */
    public function getCropPlantingDate()
    {
        return $this->cropPlantingDate;
    }

    /**
     *
     * @return the $estimatedHarvetDate
     */
    public function getEstimatedHarvetDate()
    {
        return $this->estimatedHarvetDate;
    }

    /**
     *
     * @return the $seasonCommencement
     */
    public function getSeasonCommencement()
    {
        return $this->seasonCommencement;
    }

    /**
     *
     * @return the $seasonEnd
     */
    public function getSeasonEnd()
    {
        return $this->seasonEnd;
    }

    /**
     *
     * @return the $estimatedCostLandClearing
     */
    public function getEstimatedCostLandClearing()
    {
        return $this->estimatedCostLandClearing;
    }

    /**
     *
     * @return the $estimatedCostPlanting
     */
    public function getEstimatedCostPlanting()
    {
        return $this->estimatedCostPlanting;
    }

    /**
     *
     * @return the $estimatesCostIrrigation
     */
    public function getEstimatesCostIrrigation()
    {
        return $this->estimatesCostIrrigation;
    }

    /**
     *
     * @return the $estimatedCostWeedPestControl
     */
    public function getEstimatedCostWeedPestControl()
    {
        return $this->estimatedCostWeedPestControl;
    }

    /**
     *
     * @return the $estinmatedCostTransportation
     */
    public function getEstinmatedCostTransportation()
    {
        return $this->estinmatedCostTransportation;
    }

    /**
     *
     * @return the $estimatedCostInterestLoan
     */
    public function getEstimatedCostInterestLoan()
    {
        return $this->estimatedCostInterestLoan;
    }

    /**
     *
     * @return the $estmatedCostHarvesting
     */
    public function getEstmatedCostHarvesting()
    {
        return $this->estmatedCostHarvesting;
    }

    /**
     *
     * @return the $estimatedCostMiscellanous
     */
    public function getEstimatedCostMiscellanous()
    {
        return $this->estimatedCostMiscellanous;
    }

    /**
     *
     * @return the $isIrrigation
     */
    public function getIsIrrigation()
    {
        return $this->isIrrigation;
    }

    /**
     *
     * @return the $specialRiskManagment
     */
    public function getSpecialRiskManagment()
    {
        return $this->specialRiskManagment;
    }

    /**
     *
     * @param \IMServices\Entity\text $farmAddress            
     */
    public function setFarmAddress($farmAddress)
    {
        $this->farmAddress = $farmAddress;
        return $this;
    }

    /**
     *
     * @param \IMServices\Entity\text $farmNearestVillage            
     */
    public function setFarmNearestVillage($farmNearestVillage)
    {
        $this->farmNearestVillage = $farmNearestVillage;
        return $this;
    }

    /**
     *
     * @param \Settings\Entity\Zone $farmState            
     */
    public function setFarmState($farmState)
    {
        $this->farmState = $farmState;
        return $this;
    }

    /**
     *
     * @param string $farmSize            
     */
    public function setFarmSize($farmSize)
    {
        $this->farmSize = $farmSize;
        return $this;
    }

    /**
     *
     * @param string $farmAreaPlanted            
     */
    public function setFarmAreaPlanted($farmAreaPlanted)
    {
        $this->farmAreaPlanted = $farmAreaPlanted;
        return $this;
    }

    /**
     *
     * @param DateTime $cropPlantingDate            
     */
    public function setCropPlantingDate($cropPlantingDate)
    {
        $this->cropPlantingDate = $cropPlantingDate;
        return $this;
    }

    /**
     *
     * @param DateTime $estimatedHarvetDate            
     */
    public function setEstimatedHarvetDate($estimatedHarvetDate)
    {
        $this->estimatedHarvetDate = $estimatedHarvetDate;
        return $this;
    }

    /**
     *
     * @param string $seasonCommencement            
     */
    public function setSeasonCommencement($seasonCommencement)
    {
        $this->seasonCommencement = $seasonCommencement;
        return $this;
    }

    /**
     *
     * @param string $seasonEnd            
     */
    public function setSeasonEnd($seasonEnd)
    {
        $this->seasonEnd = $seasonEnd;
        return $this;
    }

    /**
     *
     * @param string $estimatedCostLandClearing            
     */
    public function setEstimatedCostLandClearing($estimatedCostLandClearing)
    {
        $this->estimatedCostLandClearing = $estimatedCostLandClearing;
        return $this;
    }

    /**
     *
     * @param string $estimatedCostPlanting            
     */
    public function setEstimatedCostPlanting($estimatedCostPlanting)
    {
        $this->estimatedCostPlanting = $estimatedCostPlanting;
        return $this;
    }

    /**
     *
     * @param string $estimatesCostIrrigation            
     */
    public function setEstimatesCostIrrigation($estimatesCostIrrigation)
    {
        $this->estimatesCostIrrigation = $estimatesCostIrrigation;
        return $this;
    }

    /**
     *
     * @param string $estimatedCostWeedPestControl            
     */
    public function setEstimatedCostWeedPestControl($estimatedCostWeedPestControl)
    {
        $this->estimatedCostWeedPestControl = $estimatedCostWeedPestControl;
        return $this;
    }

    /**
     *
     * @param string $estinmatedCostTransportation            
     */
    public function setEstinmatedCostTransportation($estinmatedCostTransportation)
    {
        $this->estinmatedCostTransportation = $estinmatedCostTransportation;
        return $this;
    }

    /**
     *
     * @param string $estimatedCostInterestLoan            
     */
    public function setEstimatedCostInterestLoan($estimatedCostInterestLoan)
    {
        $this->estimatedCostInterestLoan = $estimatedCostInterestLoan;
        return $this;
    }

    /**
     *
     * @param string $estmatedCostHarvesting            
     */
    public function setEstmatedCostHarvesting($estmatedCostHarvesting)
    {
        $this->estmatedCostHarvesting = $estmatedCostHarvesting;
        return $this;
    }

    /**
     *
     * @param string $estimatedCostMiscellanous            
     */
    public function setEstimatedCostMiscellanous($estimatedCostMiscellanous)
    {
        $this->estimatedCostMiscellanous = $estimatedCostMiscellanous;
        return $this;
    }

    /**
     *
     * @param boolean $isIrrigation            
     */
    public function setIsIrrigation($isIrrigation)
    {
        $this->isIrrigation = $isIrrigation;
        return $this;
    }

    /**
     *
     * @param \Doctrine\Common\Collections\Collection $staffDetails            
     */
    public function setStaffDetails($staffDetails)
    {
        $this->staffDetails = $staffDetails;
        return $this;
    }

    /**
     *
     * @param \Doctrine\Common\Collections\Collection $cropDetails            
     */
    public function setCropDetails($cropDetails)
    {
        $this->cropDetails = $cropDetails;
        return $this;
    }

    public function getCropTypeInsured()
    {
        return $this->cropTypeInsured;
    }

    public function setCropTypeInsured($crop)
    {
        $this->cropTypeInsured = $crop;
        return $this;
    }

    public function getYearInBusiness()
    {
        return $this->yearInBusiness;
    }

    public function setYearInBusiness($year)
    {
        $this->yearInBusiness = $year;
        return $this;
    }

    public function getStaffDetails()
    {
        return $this->staffDetails;
    }

    public function addStaffDetails($details)
    {
        if (! $this->staffDetails->contains($details)) {
            $this->staffDetails->add($details);
        }
        return $this;
    }

    public function removeStaffDetails($details)
    {
        if ($this->staffDetails->contains($details)) {
            $this->staffDetails->removeElement($details);
        }
        
        return $this;
    }

    public function getCropDetails()
    {
        return $this->cropDetails;
    }

    public function addCropDetails($crop)
    {
        if (! $this->cropDetails->contains($crop)) {
            $this->cropDetails->add($crop);
        }
        
        return $this;
    }

    public function removeCropDetails($crop)
    {
        if ($this->cropDetails->contains($crop)) {
            $this->cropDetails->removeElement($crop);
        }
        return $this;
    }

    public function getCropsBiggestThreat()
    {
        return $this->cropsBiggestThreat;
    }

    public function setCropsBiggestThreat($crop)
    {
        $this->cropsBiggestThreat = $crop;
        return $this;
    }

    public function getThreatManagement()
    {
        return $this->threatManagement;
    }

    public function setThreatManagement($dre)
    {
        $this->threatManagement = $dre;
        return $this;
    }

    public function getSpecialRiskManagement()
    {
        return $this->specialRiskManagment;
    }

    public function setSpecialRiskManagment($spec)
    {
        $this->specialRiskManagment = $spec;
        return $this;
    }

    public function getCropPerilCoverList()
    {
        return $this->cropPerilCoverList;
    }

    public function addCropPerilCoverList($list)
    {
        if (! $this->cropPerilCoverList->contains($list)) {
            foreach ($list as $li) {
                $this->cropPerilCoverList[] = $li;
            }
        }
        
        return $this;
    }

    public function removeCropPerilCoverList($list)
    {
        if ($this->cropPerilCoverList->contains($list)) {
            $this->cropPerilCoverList->removeElement($list);
        }
        return $this;
    }
}

