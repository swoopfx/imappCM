<?php
namespace Object\Entity;

use Doctrine\ORM\Mapping as ORM;
use Settings\Entity\MaritalStatus;

/**
 *
 * @ORM\Entity
 * @ORM\Table(name="object_life_beneficiary")
 * @author otaba
 *        
 */
class ObjectLifeBeneficiary
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Object\Entity\ObjectPersonData", inversedBy="beneficiary")
     * @var ObjectPersonData
     */
    private $objectLife;

    /**
     *
     * @ORM\Column(name="object_life_beneficiary_name", type="string", nullable=true)
     * @var string
     */
    private $beneficiaryName;

    /**
     *
     * @ORM\Column(name="object_life_beneficiary_dob", type="string",  nullable=true)
     * @var string
     */
    private $beneficiaryDob;

    /**
     * Relationship to the applicatnt
     *
     * @ORM\Column(name="relationship", type="string",  nullable=true)
     * @var string
     */
    private $relationship;

    /**
     * Occupation of the beneficiary
     *
     * @ORM\Column(name="occupation", type="string",  nullable=true)
     * @var string
     */
    private $occupation;

    /**
     * Marital Status
     *
     * @ORM\ManyToOne(targetEntity="Settings\Entity\MaritalStatus")
     * @var MaritalStatus
     */
    private $maritalStatus;

    /**
     *
     * @ORM\Column(name="address", type="text",  nullable=true)
     * @var string
     */
    private $address;

    /**
     *
     * @ORM\Column(name="telephone", type="string",  nullable=true)
     * @var string
     */
    private $telephone;

    /**
     *
     * @ORM\Column(name="created_on", type="datetime",  nullable=true)
     * @var \DateTime
     */
    private $createdOn;

    /**
     *
     * @ORM\Column(name="updated_on", type="datetime",  nullable=true)
     * @var \DateTime
     */
    private $updatedOn;

    // TODO - Insert your code here
    public function __construct()
    {

        // TODO - Insert your code here
    }
    /**
     * @return number
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getBeneficiaryName()
    {
        return $this->beneficiaryName;
    }

    /**
     * @return string
     */
    public function getBeneficiaryDob()
    {
        return $this->beneficiaryDob;
    }

    /**
     * @return string
     */
    public function getRelationship()
    {
        return $this->relationship;
    }

    /**
     * @return string
     */
    public function getOccupation()
    {
        return $this->occupation;
    }

    /**
     * @return \Settings\Entity\MaritalStatus
     */
    public function getMaritalStatus()
    {
        return $this->maritalStatus;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedOn()
    {
        return $this->updatedOn;
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
     * @param string $beneficiaryName
     */
    public function setBeneficiaryName($beneficiaryName)
    {
        $this->beneficiaryName = $beneficiaryName;
        return $this;
    }

    /**
     * @param string $beneficiaryDob
     */
    public function setBeneficiaryDob($beneficiaryDob)
    {
        $this->beneficiaryDob = $beneficiaryDob;
        return $this;
    }

    /**
     * @param string $relationship
     */
    public function setRelationship($relationship)
    {
        $this->relationship = $relationship;
        return $this;
    }

    /**
     * @param string $occupation
     */
    public function setOccupation($occupation)
    {
        $this->occupation = $occupation;
        return $this;
    }

    /**
     * @param \Settings\Entity\MaritalStatus $maritalStatus
     */
    public function setMaritalStatus($maritalStatus)
    {
        $this->maritalStatus = $maritalStatus;
        return $this;
    }

    /**
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @param string $telephone
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
        return $this;
    }

    /**
     * @param \DateTime $createdOn
     */
    public function setCreatedOn($createdOn)
    {
        $this->createdOn = $createdOn;
        $this->updatedOn = $createdOn;
        return $this;
    }

    /**
     * @param \DateTime $updatedOn
     */
    public function setUpdatedOn($updatedOn)
    {
        $this->updatedOn = $updatedOn;
        return $this;
    }
    /**
     * @return \Object\Entity\ObjectLife
     */
    public function getObjectLife()
    {
        return $this->objectLife;
    }

    /**
     * @param \Object\Entity\ObjectLife $objectLife
     */
    public function setObjectLife($objectLife)
    {
        $this->objectLife = $objectLife;
        return $this;
    }


}

