<?php
namespace Claims\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 *
 * @ORM\Entity
 * @ORM\Table(name="claims_motor_accident")
 *
 * @author otaba
 *        
 */
class ClaimsMotorAccident
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
     *
     * @ORM\OneToOne(targetEntity="Claims\Entity\CLaims", inversedBy="claimsMotor")
     *
     * @var Claims;
     */
    private $claims;

    /**
     *
     * @ORM\OneToOne(targetEntity="Claims\Entity\ClaimsDriverDetails", mappedBy="claimsMotorAccident" ,  cascade={"persist", "remove"})
     *
     * @var ClaimsDriverDetails
     */
    private $driverDetails;

    /**
     *
     * @ORM\Column(name="witness1", type="string", nullable=true)
     *
     * @var string
     */
    private $witness1;

    /**
     *
     * @ORM\Column(name="witness1_phone", type="string", nullable=true)
     */
    private $witness1Phone;

    /**
     *
     * @ORM\Column(name="witness1address", type="text", nullable=true)
     *
     * @var string
     */
    private $witness1Address;

    /**
     *
     * @ORM\Column(name="witness2", type="string", nullable=true)
     *
     * @var String
     */
    private $witness2;

    /**
     *
     * @ORM\Column(name="witness2address", type="text", nullable=true)
     *
     * @var string
     */
    private $witness2Address;

    /**
     *
     * @ORM\Column(name="damage_details", type="text", nullable=true)
     *
     * @var string
     */
    private $damageDetails;

    /**
     *
     * @ORM\Column(name="repair_estimates", type="string", nullable=true)
     *
     * @var string
     */
    private $repairEstimate;

    /**
     *
     * @ORM\Column(name="repairer_name", type="string", nullable=true)
     *
     * @var string
     */
    private $repairerName;

    /**
     *
     * @ORM\Column(name="repairer_phone", type="string", nullable=true)
     *
     * @var string
     */
    private $repairerPhone;

    /**
     *
     * @ORM\Column(name="repair_address", type="text", nullable=true)
     *
     * @var string
     */
    private $repairerAddress;

    /**
     *
     * @ORM\Column(name="motor_location", type="string", nullable=true)
     *
     * @var string
     */
    private $motorLocation;

    /**
     *
     * @ORM\OneToMany(targetEntity="Claims\Entity\ClaimsThirdPartyDetails", mappedBy="claimsMotorAccident")
     *
     * @var Collection
     */
    private $thirdpartyDetails;

    /**
     *
     * @ORM\Column(name="created_on", type="datetime", nullable=true)
     * @var \DateTime
     */
    private $createdOn;

    /**
     */
    public function __construct()
    {
        $this->thirdpartyDetails = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    // public function getThirdPartyDetails()
    // {
    // return $this->thirdpartyDetails;
    // }
    public function addThirdpartyDetails(ClaimsThirdPartyDetails $details)
    {
        if (! $this->thirdpartyDetails->contains($details)) {
            $this->thirdpartyDetails->add($details);
        }

        return $this;
    }

    public function removeThirdpartyDetails(ClaimsThirdPartyDetails $detail)
    {
        if ($this->thirdpartyDetails->contains($detail)) {
            $this->thirdpartyDetails->removeElement($detail);
        }
        return $this;
    }

    /**
     *
     * @return \Claims\Entity\Claims;
     */
    public function getClaims()
    {
        return $this->claims;
    }

    /**
     *
     * @return \Claims\Entity\ClaimsDriverDetails
     */
    public function getDriverDetails()
    {
        return $this->driverDetails;
    }

    /**
     *
     * @return string
     */
    public function getWitness1()
    {
        return $this->witness1;
    }

    /**
     *
     * @return mixed
     */
    public function getWitness1Phone()
    {
        return $this->witness1Phone;
    }

    /**
     *
     * @return string
     */
    public function getWitness1Address()
    {
        return $this->witness1Address;
    }

    /**
     *
     * @return string
     */
    public function getWitness2()
    {
        return $this->witness2;
    }

    /**
     *
     * @return string
     */
    public function getWitness2Address()
    {
        return $this->witness2Address;
    }

    /**
     *
     * @return string
     */
    public function getDamageDetails()
    {
        return $this->damageDetails;
    }

    /**
     *
     * @return string
     */
    public function getRepairEstimate()
    {
        return $this->repairEstimate;
    }

    /**
     *
     * @return string
     */
    public function getRepairerName()
    {
        return $this->repairerName;
    }

    /**
     *
     * @return string
     */
    public function getRepairerPhone()
    {
        return $this->repairerPhone;
    }

    /**
     *
     * @return string
     */
    public function getRepairerAddress()
    {
        return $this->repairerAddress;
    }

    /**
     *
     * @return string
     */
    public function getMotorLocation()
    {
        return $this->motorLocation;
    }

    /**
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getThirdpartyDetails()
    {
        return $this->thirdpartyDetails;
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
     * @param \Claims\Entity\Claims; $claims
     */
    public function setClaims($claims)
    {
        $this->claims = $claims;
        return $this;
    }

    /**
     *
     * @param \Claims\Entity\ClaimsDriverDetails $driverDetails
     */
    public function setDriverDetails($driverDetails)
    {
        $this->driverDetails = $driverDetails;
        return $this;
    }

    /**
     *
     * @param string $witness1
     */
    public function setWitness1($witness1)
    {
        $this->witness1 = $witness1;
        return $this;
    }

    /**
     *
     * @param mixed $witness1Phone
     */
    public function setWitness1Phone($witness1Phone)
    {
        $this->witness1Phone = $witness1Phone;
        return $this;
    }

    /**
     *
     * @param string $witness1Address
     */
    public function setWitness1Address($witness1Address)
    {
        $this->witness1Address = $witness1Address;
        return $this;
    }

    /**
     *
     * @param string $witness2
     */
    public function setWitness2($witness2)
    {
        $this->witness2 = $witness2;
        return $this;
    }

    /**
     *
     * @param string $witness2Address
     */
    public function setWitness2Address($witness2Address)
    {
        $this->witness2Address = $witness2Address;
        return $this;
    }

    /**
     *
     * @param string $damageDetails
     */
    public function setDamageDetails($damageDetails)
    {
        $this->damageDetails = $damageDetails;
        return $this;
    }

    /**
     *
     * @param string $repairEstimate
     */
    public function setRepairEstimate($repairEstimate)
    {
        $this->repairEstimate = $repairEstimate;
        return $this;
    }

    /**
     *
     * @param string $repairerName
     */
    public function setRepairerName($repairerName)
    {
        $this->repairerName = $repairerName;
        return $this;
    }

    /**
     *
     * @param string $repairerPhone
     */
    public function setRepairerPhone($repairerPhone)
    {
        $this->repairerPhone = $repairerPhone;
        return $this;
    }

    /**
     *
     * @param string $repairerAddress
     */
    public function setRepairerAddress($repairerAddress)
    {
        $this->repairerAddress = $repairerAddress;
        return $this;
    }

    /**
     *
     * @param string $motorLocation
     */
    public function setMotorLocation($motorLocation)
    {
        $this->motorLocation = $motorLocation;
        return $this;
    }

    /**
     *
     * @param \Doctrine\Common\Collections\Collection $thirdpartyDetails
     */
    public function setThirdpartyDetails($thirdpartyDetails)
    {
        $this->thirdpartyDetails = $thirdpartyDetails;
        return $this;
    }

    /**
     *
     * @return \DateTime
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    /**
     *
     * @param \DateTime $createdOn
     */
    public function setCreatedOn($createdOn)
    {
        $this->createdOn = $createdOn;
        return $this;
    }
}

