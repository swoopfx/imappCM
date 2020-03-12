<?php
namespace Claims\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table("claims_default")
 * 
 * @author otaba
 *        
 */
class ClaimsDefault
{

    /**
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     *
     * @var integer
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="Claims\Entity\CLaims", inversedBy="claimsDefault", cascade={"persist", "remove"})
     *
     * @var Claims;
     */
    private $claims;

    /**
     * @ORM\Column(name="claims_details", type="text", nullable=true)
     * 
     * @var string
     */
    private $claimsDetails;

    /**
     * @ORM\Column(name="estimated_claims", type="string", nullable=true)
     * 
     * @var string
     */
    private $estimatedClaims;

    /**
     *
     * @ORM\Column(name="created_on", type="datetime", nullable=true)
     * 
     * @var \Datetime
     */
    private $createdOn;

    /**
     */
    public function __construct()
    {}
    /**
     * @return string $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string $claims
     */
    public function getClaims()
    {
        return $this->claims;
    }

    /**
     * @return string $claimsDetails
     */
    public function getClaimsDetails()
    {
        return $this->claimsDetails;
    }

    /**
     * @return \Datetime $estimatedClaims
     */
    public function getEstimatedClaims()
    {
        return $this->estimatedClaims;
    }

    /**
     * @return \DateTime $createdOn
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
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
     * @param \Claims\Entity\Claims; $claims
     */
    public function setClaims($claims)
    {
        $this->claims = $claims;
        return $this;
    }

    /**
     * @param string $claimsDetails
     */
    public function setClaimsDetails($claimsDetails)
    {
        $this->claimsDetails = $claimsDetails;
        return $this;
    }

    /**
     * @param string $estimatedClaims
     */
    public function setEstimatedClaims($estimatedClaims)
    {
        $this->estimatedClaims = $estimatedClaims;
        return $this;
    }

    /**
     * @param \Datetime $createdOn
     */
    public function setCreatedOn($createdOn)
    {
        $this->createdOn = $createdOn;
        return $this;
    }

}

