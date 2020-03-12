<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Settings\Entity\OilEnergyNonOilRisk;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * This identifies entity for Oil/Gas and Energy insurance
 * @ORM\Entity
 * @ORM\Table(name="oil_gas_energy_insurance")
 *
 * @author otaba
 *        
 */
class OilEnergyInsurance
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     *
     * @ORM\ManyToMany(targetEntity="Settings\Entity\OilEnergyNonOilRisk")
     * @ORM\JoinTable(name="non_oil_risk_oil_energy",
     * joinColumns={@ORM\JoinColumn(name="oil_energy_id", referencedColumnName="id")},
     * inverseJoinColumns={@ORM\JoinColumn(name="non_oil_id", referencedColumnName="id")}
     * )
     *
     * @var Collection
     */
    private $nonOilRisk;

    /**
     * @ORM\Column(name="others_non_oil_risk", type="string", nullable=true)
     *
     * @var string
     */
    private $othersNonoilRisk;

    /**
     * 
     * @ORM\ManyToMany(targetEntity="Settings\Entity\OilEnergyOilRisk")
     * @ORM\JoinTable(name="oil_risk_oil_energy",
     * joinColumns={@ORM\JoinColumn(name="oil_energy_id", referencedColumnName="id")},
     * inverseJoinColumns={@ORM\JoinColumn(name="oil_id", referencedColumnName="id")}
     * )
     *
     * @var Collection
     */
    private $oilRisk;

    /**
     * @ORM\Column(name="others_oil_risk", type="string", nullable=true)
     *
     * @var string
     */
    private $otherOilRisk;

    /**
     * @ORM\Column(name="no_of_employees", type="string", nullable=true)
     *
     * @var string
     */
    private $noOfEmployees;

    /**
     * @ORM\Column(name="is_previously_insured", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isPreviouslyInsured;

    /**
     * @ORM\Column(name="is_previously_claims", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isPreviousClaims;

    /**
     * Loss history in the past five years
     * @ORM\Column(name="loss_detail", type="text", nullable=true)
     * 
     * @var text
     */
    private $lossDetails;

    /**
     *
     * @ORM\Column(name="is_previously_decline", type="boolean", nullable=true)
     *
     *
     * @var boolean
     */
    private $isPreviousDecline;

    /**
     * @ORM\Column(name="decline_reason", type="text", nullable=true)
     *
     * @var text
     */
    private $declineReason;

    /**
     */
    public function __construct()
    {
        $this->nonOilRisk = new ArrayCollection();
        $this->oilRisk = new ArrayCollection();
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
     * @return the $nonOilRisk
     */
    public function getNonOilRisk()
    {
        return $this->nonOilRisk;
    }

    // /**
    // * @param \Doctrine\Common\Collections\Collection $nonOilRisk
    // */
    // public function setNonOilRisk($nonOilRisk)
    // {
    // $this->nonOilRisk = $nonOilRisk;
    // return $this;
    // }
    
    /**
     *
     * @param OilEnergyNonOilRisk $risk            
     * @return \IMServices\Entity\OilEnergyInsurance
     */
    public function addNonOilRisk($risk)
    {
        if (! $this->nonOilRisk->contains($risk)) {
            foreach ($risk as $risks) {
                $this->nonOilRisk->add($risks);
            }
        }
        return $this;
    }

    public function removeNonOilRisk($risk)
    {
        if ($this->nonOilRisk->contains($risk)) {
            $this->nonOilRisk->removeElement($risk);
        }
        
        return $this;
    }

    /**
     *
     * @return the $othersNonoilRisk
     */
    public function getOthersNonoilRisk()
    {
        return $this->othersNonoilRisk;
    }

    /**
     *
     * @param string $othersNonoilRisk            
     */
    public function setOthersNonoilRisk($othersNonoilRisk)
    {
        $this->othersNonoilRisk = $othersNonoilRisk;
        return $this;
    }

    /**
     *
     * @return the $oilRisk
     */
    public function getOilRisk()
    {
        return $this->oilRisk;
    }

    public function addOilRisk($risk)
    {
        if (! $this->oilRisk->contains($risk)) {
            foreach ($risk as $risks) {
                $this->oilRisk->add($risks);
            }
        }
        return $this;
    }

    public function removeOilRisk($risk)
    {
        if ($this->oilRisk->contains($risk)) {
            $this->oilRisk->removeElement($risk);
        }
        return $this;
    }

    // /**
    // * @param \Doctrine\Common\Collections\Collection $oilRisk
    // */
    // public function setOilRisk($oilRisk)
    // {
    // $this->oilRisk = $oilRisk;
    // return $this;
    // }
    
    /**
     *
     * @return the $otherOilRisk
     */
    public function getOtherOilRisk()
    {
        return $this->otherOilRisk;
    }

    /**
     *
     * @param \IMServices\Entity\unknown $otherOilRisk            
     */
    public function setOtherOilRisk($otherOilRisk)
    {
        $this->otherOilRisk = $otherOilRisk;
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
     * @return the $isPreviousClaims
     */
    public function getIsPreviousClaims()
    {
        return $this->isPreviousClaims;
    }

    /**
     *
     * @param boolean $isPreviousClaims            
     */
    public function setIsPreviousClaims($isPreviousClaims)
    {
        $this->isPreviousClaims = $isPreviousClaims;
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
     * @return the $declineReason
     */
    public function getDeclineReason()
    {
        return $this->declineReason;
    }

    /**
     *
     * @param \IMServices\Entity\text $declineReason            
     */
    public function setDeclineReason($declineReason)
    {
        $this->declineReason = $declineReason;
        return $this;
    }
    /**
     * @return the $lossDetails
     */
    public function getLossDetails()
    {
        return $this->lossDetails;
    }

    /**
     * @param \IMServices\Entity\text $lossDetails
     */
    public function setLossDetails($lossDetails)
    {
        $this->lossDetails = $lossDetails;
        return $this;
    }

}

