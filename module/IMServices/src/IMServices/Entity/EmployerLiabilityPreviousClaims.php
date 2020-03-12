<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="employer_liability_previous_claims")
 *
 * @author otaba
 *        
 */
class EmployerLiabilityPreviousClaims
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(name="yearOfClaim", type="datetime", nullable=true)
     *
     * @var datetime;
     */
    private $yearOfClaim;

    /**
     * @ORM\Column(name="no_of_accidents", type="string", nullable=true)
     *
     * @var string
     */
    private $noOfAccidents;

    /**
     * @ORM\Column(name="wages", type="string", nullable=true)
     *
     * @var string
     */
    private $wages;

    /**
     * This identifies the total number of settled claims
     * @ORM\Column(name="settled_claims", type="string", nullable=true)
     *
     * @var string
     */
    private $settledClaims;

    /**
     * Tis identifies the cost in Naira of settled Claims
     * @ORM\Column(name="cost_of_settled_claims", type="string", nullable=true)
     *
     * @var string
     */
    private $costOfSettledClaims;

    /**
     * @ORM\Column(name="created_on", type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $createdOn;

    /**
     * @ORM\Column(name="updated_on", type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $updatedOn;

    /**
     * @ORM\ManyToOne(targetEntity="IMServices\Entity\EmployerLiability", inversedBy="previousClaims")
     * 
     * @var EmployerLiability
     */
    private $employerLiability;

    public function __construct()
    {}

    public function getId()
    {
        return $this->id;
    }

    public function getWages()
    {
        return $this->wages;
    }

    public function setWages($wage)
    {
        $this->wages = $wage;
        return $this;
    }

    public function getYearOfClaim()
    {
        return $this->yearOfClaim;
    }

    public function setYearOfClaim($claim)
    {
        $this->yearOfClaim = $claim;
        return $this;
    }

    public function getNoOfAccidents()
    {
        return $this->noOfAccidents;
    }

    public function setNoOfAccidents($dent)
    {
        $this->noOfAccidents = $dent;
        return $this;
    }

    public function getSettledClaims()
    {
        return $this->settledClaims;
    }

    public function setSettledClaims($claims)
    {
        $this->settledClaims = $claims;
        return $this;
    }

    public function getCostOfSettledClaims()
    {
        return $this->costOfSettledClaims;
    }

    public function setCostOfSettledClaims($cost)
    {
        $this->costOfSettledClaims = $cost;
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

    public function getUpdatedOn()
    {
        return $this->updatedOn;
    }

    public function setUpdatedOn($on)
    {
        $this->updatedOn = $on;
        return $this;
    }

    public function getEmployerLiability()
    {
        return $this->employerLiability;
    }

    public function setEmployerLiability($low)
    {
        $this->employerLiability = $low;
        return $this;
    }
}

