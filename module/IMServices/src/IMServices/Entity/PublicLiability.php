<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="public_liability")
 *
 * @author otaba
 *        
 */
class PublicLiability
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="PublicLiabilityEmployeeDetails", mappedBy="publicLiability")
     *
     * @var Collection
     */
    private $employeeDetails;

    /**
     * state the estimated total annual wages
     * (including remuneration of working partners and directors) for own premises
     * @ORM\Column(name="own_premises_total_wages", type="string", nullable=true)
     *
     * @var string
     */
    private $ownPremisesTotalWages;

    /**
     * state the estimated total annual wages
     * (including remuneration of working partners and directors) for
     * @ORM\Column(name="else_where_total_wages", type="string", nullable=true)
     *
     * @var string
     */
    private $elsewhereTotalWages;

    /**
     * Estimated total annual payments to sub-contractors on own premises
     * @ORM\Column(name="own_subconractors_payment", type="string", nullable=true)
     *
     * @var string
     */
    private $ownSubContractorsPayment;

    /**
     * Estimated total annual payments to sub-contractors on:
     * @ORM\Column(name="else_sub_contractors_payment", type="string", nullable=true)
     *
     * @var string
     */
    private $elseSubContractorsPayment;

    /**
     * Are all the premises in good state of repair?
     * @ORM\Column(name="is_good_sate", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isGoodState;

    /**
     * Have you any good lifts, cranes or hoists?
     * @ORM\Column(name="is_good_lifts", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isGoodLifts;

    /**
     * Are such lifts, cranes or hoists regularly inspected to meet statutory requirements?
     * @ORM\Column(name="Is_crane_regularly_inspected", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isCraneRegularlyinspected;

    /**
     * @ORM\Column(name="inspection_by", type="string", nullable=true)
     *
     * @var string
     */
    private $inspectionBy;

    /**
     * 5.
     * State what acids, gases, chemicals, explosives
     * or radio-active materials will be used and to what extent?
     * @ORM\Column(name="is_explosive_material", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isExplosiveMaterial;

    /**
     * @ORM\Column(name="explosives_acids", type="string", nullable=true)
     * 
     * @var string
     */
    private $explosiveAcids;

    /**
     * Limits of indemnity required:
     * @ORM\Column(name="indemnity_limit", type="string", nullable=true)
     *
     * @var string
     */
    private $indemnityLimit;

    /**
     * Identifies if food poisoning should be included
     * @ORM\Column(name="is_food_poison", type="boolean", nullable=true)
     *
     * @var boolean;
     */
    private $isFoodpoison;

    /**
     * Should include fire and explosion
     * @ORM\Column(name="is_fire_exlosion", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isFireNExplosion;

    /**
     * Any other special requirements
     * @ORM\Column(name="is_special", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isSpecial;

    /**
     * Special Requirements Details
     * @ORM\Column(name="special_details", type="string", nullable=true)
     *
     * @var string
     */
    private $specialDetails;

    /**
     * @ORM\Column(name="is_previous_insurer", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isPreviousInsure;

    /**
     * @ORM\Column(name="is_decline", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isDeclined;

    /**
     * @ORM\Column(name="is_refused_renew", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isRefusedRenew;

    /**
     * @ORM\Column(name="is_special_reason", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isPecialReason;

    /**
     * @ORM\Column(name="special_reason", type="string", nullable=true)
     *
     * @var string
     */
    private $specialReason;

    public function __construct()
    {
        $this->employeeDetails = new ArrayCollection();
        // $this->liabilityDetails = new ArrayCollection();
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
     * @return the $liabilityDetails
     */
    public function getLiabilityDetails()
    {
        return $this->liabilityDetails;
    }

    /**
     *
     * @param \Doctrine\Common\Collections\Collection $liabilityDetails            
     */
    public function setLiabilityDetails($liabilityDetails)
    {
        $this->liabilityDetails = $liabilityDetails;
        return $this;
    }

    /**
     *
     * @return the $ownPremisesTotalWages
     */
    public function getOwnPremisesTotalWages()
    {
        return $this->ownPremisesTotalWages;
    }

    /**
     *
     * @param string $ownPremisesTotalWages            
     */
    public function setOwnPremisesTotalWages($ownPremisesTotalWages)
    {
        $this->ownPremisesTotalWages = $ownPremisesTotalWages;
        return $this;
    }

    /**
     *
     * @return the $elsewhereTotalWages
     */
    public function getElsewhereTotalWages()
    {
        return $this->elsewhereTotalWages;
    }

    /**
     *
     * @param string $elsewhereTotalWages            
     */
    public function setElsewhereTotalWages($elsewhereTotalWages)
    {
        $this->elsewhereTotalWages = $elsewhereTotalWages;
        return $this;
    }

    /**
     *
     * @return the $ownSubContractorsPayment
     */
    public function getOwnSubContractorsPayment()
    {
        return $this->ownSubContractorsPayment;
    }

    /**
     *
     * @param string $ownSubContractorsPayment            
     */
    public function setOwnSubContractorsPayment($ownSubContractorsPayment)
    {
        $this->ownSubContractorsPayment = $ownSubContractorsPayment;
        return $this;
    }

    /**
     *
     * @return the $elseSubContractorsPayment
     */
    public function getElseSubContractorsPayment()
    {
        return $this->elseSubContractorsPayment;
    }

    /**
     *
     * @param string $elseSubContractorsPayment            
     */
    public function setElseSubContractorsPayment($elseSubContractorsPayment)
    {
        $this->elseSubContractorsPayment = $elseSubContractorsPayment;
        return $this;
    }

    /**
     *
     * @return the $isGoodState
     */
    public function getIsGoodState()
    {
        return $this->isGoodState;
    }

    /**
     *
     * @param boolean $isGoodState            
     */
    public function setIsGoodState($isGoodState)
    {
        $this->isGoodState = $isGoodState;
        return $this;
    }

    /**
     *
     * @return the $isGoodLifts
     */
    public function getIsGoodLifts()
    {
        return $this->isGoodLifts;
    }

    /**
     *
     * @param boolean $isGoodLifts            
     */
    public function setIsGoodLifts($isGoodLifts)
    {
        $this->isGoodLifts = $isGoodLifts;
        return $this;
    }

    /**
     *
     * @return the $isCraneRegularlyinspected
     */
    public function getIsCraneRegularlyinspected()
    {
        return $this->isCraneRegularlyinspected;
    }

    /**
     *
     * @param boolean $isCraneRegularlyinspected            
     */
    public function setIsCraneRegularlyinspected($isCraneRegularlyinspected)
    {
        $this->isCraneRegularlyinspected = $isCraneRegularlyinspected;
        return $this;
    }

    /**
     *
     * @return the $inspectionBy
     */
    public function getInspectionBy()
    {
        return $this->inspectionBy;
    }

    /**
     *
     * @param string $inspectionBy            
     */
    public function setInspectionBy($inspectionBy)
    {
        $this->inspectionBy = $inspectionBy;
        return $this;
    }

    /**
     *
     * @return the $isExplosiveMaterial
     */
    public function getIsExplosiveMaterial()
    {
        return $this->isExplosiveMaterial;
    }

    /**
     *
     * @param boolean $isExplosiveMaterial            
     */
    public function setIsExplosiveMaterial($isExplosiveMaterial)
    {
        $this->isExplosiveMaterial = $isExplosiveMaterial;
        return $this;
    }

    /**
     *
     * @return the $indemnityLimit
     */
    public function getIndemnityLimit()
    {
        return $this->indemnityLimit;
    }

    /**
     *
     * @param string $indemnityLimit            
     */
    public function setIndemnityLimit($indemnityLimit)
    {
        $this->indemnityLimit = $indemnityLimit;
        return $this;
    }

    /**
     *
     * @return the $isFoodpoison
     */
    public function getIsFoodpoison()
    {
        return $this->isFoodpoison;
    }

    /**
     *
     * @param \IMServices\Entity\boolean; $isFoodpoison            
     */
    public function setIsFoodpoison($isFoodpoison)
    {
        $this->isFoodpoison = $isFoodpoison;
        return $this;
    }

    /**
     *
     * @return the $isFireNExplosion
     */
    public function getIsFireNExplosion()
    {
        return $this->isFireNExplosion;
    }

    /**
     *
     * @param boolean $isFireNExplosion            
     */
    public function setIsFireNExplosion($isFireNExplosion)
    {
        $this->isFireNExplosion = $isFireNExplosion;
        return $this;
    }

    /**
     *
     * @return the $isSpecial
     */
    public function getIsSpecial()
    {
        return $this->isSpecial;
    }

    /**
     *
     * @param boolean $isSpecial            
     */
    public function setIsSpecial($isSpecial)
    {
        $this->isSpecial = $isSpecial;
        return $this;
    }

    /**
     *
     * @return the $specialDetails
     */
    public function getSpecialDetails()
    {
        return $this->specialDetails;
    }

    /**
     *
     * @param string $specialDetails            
     */
    public function setSpecialDetails($specialDetails)
    {
        $this->specialDetails = $specialDetails;
        return $this;
    }

    /**
     *
     * @return the $isPreviousInsure
     */
    public function getIsPreviousInsure()
    {
        return $this->isPreviousInsure;
    }

    /**
     *
     * @param boolean $isPreviousInsure            
     */
    public function setIsPreviousInsure($isPreviousInsure)
    {
        $this->isPreviousInsure = $isPreviousInsure;
        return $this;
    }

    /**
     *
     * @return the $isDeclined
     */
    public function getIsDeclined()
    {
        return $this->isDeclined;
    }

    /**
     *
     * @param boolean $isDeclined            
     */
    public function setIsDeclined($isDeclined)
    {
        $this->isDeclined = $isDeclined;
        return $this;
    }

    /**
     *
     * @return the $isRefusedRenew
     */
    public function getIsRefusedRenew()
    {
        return $this->isRefusedRenew;
    }

    /**
     *
     * @param boolean $isRefusedRenew            
     */
    public function setIsRefusedRenew($isRefusedRenew)
    {
        $this->isRefusedRenew = $isRefusedRenew;
        return $this;
    }

    /**
     *
     * @return the $isPecialReason
     */
    public function getIsPecialReason()
    {
        return $this->isPecialReason;
    }

    /**
     *
     * @param boolean $isPecialReason            
     */
    public function setIsPecialReason($isPecialReason)
    {
        $this->isPecialReason = $isPecialReason;
        return $this;
    }

    /**
     *
     * @return the $specialReason
     */
    public function getSpecialReason()
    {
        return $this->specialReason;
    }

    /**
     *
     * @param string $specialReason            
     */
    public function setSpecialReason($specialReason)
    {
        $this->specialReason = $specialReason;
        return $this;
    }

    /**
     *
     * @return the $noOfEmployees
     */
    public function getNoOfEmployees()
    {
        return $this->noOfEmployees;
    }

    /**
     *
     * @param string $noOfEmployees            
     */
    public function setNoOfEmployees($noOfEmployees)
    {
        $this->noOfEmployees = $noOfEmployees;
        return $this;
    }

    /**
     *
     * @return the $natureOfWork
     */
    public function getNatureOfWork()
    {
        return $this->natureOfWork;
    }

    /**
     *
     * @param \IMServices\Entity\text $natureOfWork            
     */
    public function setNatureOfWork($natureOfWork)
    {
        $this->natureOfWork = $natureOfWork;
        return $this;
    }

    /**
     *
     * @return the $insuranceConnection
     */
    public function getInsuranceConnection()
    {
        return $this->insuranceConnection;
    }

    /**
     *
     * @param \IMServices\Entity\Text $insuranceConnection            
     */
    public function setInsuranceConnection($insuranceConnection)
    {
        $this->insuranceConnection = $insuranceConnection;
        return $this;
    }

    /**
     *
     * @return the $employeeDetails
     */
    public function getEmployeeDetails()
    {
        return $this->employeeDetails;
    }

    /**
     *
     * @param PublicLiabilityEmployeeDetails $details            
     */
    public function addEmployeeDetails($details)
    {
        if (! $this->employeeDetails->contains($details)) {
            $this->employeeDetails[] = $details;
            $details->setPublicLiability($this);
        }
        return $this;
    }

    /**
     *
     * @param PublicLiabilityEmployeeDetails $details            
     */
    public function removeEmployeeDetails($details)
    {
        if ($this->employeeDetails->contains($details)) {
            $this->employeeDetails->removeElement($details);
            $details->setPublicLiability(NULL);
        }
        return $this;
    }
    /**
     * @return the $explosiveAcids
     */
    public function getExplosiveAcids()
    {
        return $this->explosiveAcids;
    }

    /**
     * @param string $explosiveAcids
     */
    public function setExplosiveAcids($explosiveAcids)
    {
        $this->explosiveAcids = $explosiveAcids;
        return $this;
    }

}

