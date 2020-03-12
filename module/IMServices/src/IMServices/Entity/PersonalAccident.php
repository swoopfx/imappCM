<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * PersonalAccident
 *
 * @ORM\Table(name="personal_accident")
 * @ORM\Entity
 */
class PersonalAccident
{

    // string @ORM\Column(name="accident_sum_cover", type="decimal", precision=15, scale=4, nullable=false)
    
    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    // string @ORM\Column(name="death_sum_cover", type="decimal", precision=15, scale=4, nullable=false)
    /**
     * Estimated Premiuum
     * @ORM\Column(name="estimated_premium", type="string", nullable=true)
     *
     * @var string
     *
     */
    private $estimatedPremium;
    

    /**
     * Cover Start Date
     * @ORM\Column(name="cover_start_date", type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $coverStartDate;

    /**
     * Cover End Date
     * ORM\Column(name="cover_start_date", type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $coverEndDate;

    /**
     * List of peop;e to be insured 
     * @ORM\OneToMany(targetEntity="PersonalAccidentInsuredList", mappedBy="personalAccident")
     *
     * @var Collection
     */
    private $insuredList;

    /**
     * Engage in any hazardous sports that are likely to cause bodily injury
     * @ORM\Column(name="is_engage_in_hazard_sport", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isEngageInHazardSport;

    /**
     * @ORM\Column(name="hazard_details", type="text", nullable=true)
     *
     * @var text
     */
    private $hazardDetails;

    /**
     * Had any disease, infirmity, illness, or physical defect?
     * @ORM\Column(name="is_affected_by_disease", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isAnyAffectedByDisease;

    /**
     * Disease Details
     * @ORM\Column(name="disease_details", type="text", nullable=true)
     *
     * @var text
     */
    private $diseaseDetails;

    /**
     * If a previous Insurer Exist
     * @ORM\Column(name="is_previous_insurer", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isPreviousInsurer;

    /**
     * If a previous Insurance, ever deferred, refused, terminated or have special terms imposed?
     * @ORM\Column(name="is_previous_decline", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isPreviousDecline;

    // /**
    // *
    // * @var \IMServices\Entity\AccidentCovergae @ORM\ManyToOne(targetEntity="IMServices\Entity\AccidentCovergae")
    // * @ORM\JoinColumns({
    // * @ORM\JoinColumn(name="accident_coverage_id", referencedColumnName="id")
    // * })
    // */
    // private $accidentCoverage;
    public function __construct()
    {
        $this->insuredList = new ArrayCollection();
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
        return $this;
    }

    /**
     *
     * @return the $estimatedPremium
     */
    public function getEstimatedPremium()
    {
        return $this->estimatedPremium;
    }

    /**
     *
     * @param string $estimatedPremium            
     */
    public function setEstimatedPremium($estimatedPremium)
    {
        $this->estimatedPremium = $estimatedPremium;
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
     * @return the $coverEndDate
     */
    public function getCoverEndDate()
    {
        return $this->coverEndDate;
    }

    /**
     *
     * @param DateTime $coverEndDate            
     */
    public function setCoverEndDate($coverEndDate)
    {
        $this->coverEndDate = $coverEndDate;
        return $this;
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
     * @param PersonalAccidentInsuredList $insuredList            
     */
    public function addInsuredList($insuredList)
    {
        if (! $this->insuredList->contains($insuredList)) {
            $this->insuredList->add($insuredList);
            $insuredList->setPersonalAccident($this);
        }
        return $this;
    }

    /**
     *
     * @param PersonalAccidentInsuredList $insuredList            
     */
    public function removeInsuredList($insuredList)
    {
        if ($this->insuredList->contains($insuredList)) {
            $this->insuredList->removeElement($insuredList);
            $insuredList->setPersonalAccident($this);
        }
        return $this;
    }

    // /**
    // * @param \Doctrine\Common\Collections\Collection $insuredList
    // */
    // public function setInsuredList($insuredList)
    // {
    // $this->insuredList = $insuredList;
    // return $this;
    // }
    
    /**
     *
     * @return the $isEngageInHazardSport
     */
    public function getIsEngageInHazardSport()
    {
        return $this->isEngageInHazardSport;
    }

    /**
     *
     * @param boolean $isEngageInHazardSport            
     */
    public function setIsEngageInHazardSport($isEngageInHazardSport)
    {
        $this->isEngageInHazardSport = $isEngageInHazardSport;
        return $this;
    }

    /**
     *
     * @return the $hazardDetails
     */
    public function getHazardDetails()
    {
        return $this->hazardDetails;
    }

    /**
     *
     * @param \IMServices\Entity\text $hazardDetails            
     */
    public function setHazardDetails($hazardDetails)
    {
        $this->hazardDetails = $hazardDetails;
        return $this;
    }

    /**
     *
     * @return the $isAnyAffectedByDisease
     */
    public function getIsAnyAffectedByDisease()
    {
        return $this->isAnyAffectedByDisease;
    }

    /**
     *
     * @param boolean $isAnyAffectedByDisease            
     */
    public function setIsAnyAffectedByDisease($isAnyAffectedByDisease)
    {
        $this->isAnyAffectedByDisease = $isAnyAffectedByDisease;
        return $this;
    }

    /**
     *
     * @return the $diseaseDetails
     */
    public function getDiseaseDetails()
    {
        return $this->diseaseDetails;
    }

    /**
     *
     * @param \IMServices\Entity\text $diseaseDetails            
     */
    public function setDiseaseDetails($diseaseDetails)
    {
        $this->diseaseDetails = $diseaseDetails;
        return $this;
    }

    /**
     *
     * @return the $isPreviousInsurer
     */
    public function getIsPreviousInsurer()
    {
        return $this->isPreviousInsurer;
    }

    /**
     *
     * @param boolean $isPreviousInsurer            
     */
    public function setIsPreviousInsurer($isPreviousInsurer)
    {
        $this->isPreviousInsurer = $isPreviousInsurer;
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
}
