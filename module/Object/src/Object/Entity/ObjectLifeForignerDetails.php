<?php
namespace Object\Entity;

use Doctrine\ORM\Mapping as ORM;
use Settings\Entity\Country;

/**
 *
 * @ORM\Entity
 * @ORM\Table(name="object_life_foriegner_details")
 * @author otaba
 *        
 */
class ObjectLifeForignerDetails
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="ObjectLife")
     * @var ObjectLife
     */
    private $objectLife;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\Country")
     * @var Country
     */
    private $nationality;

    /**
     * @ORM\Column(name="is_dual_citizen", type="boolean", nullable=true)
     * @var boolean
     */
    private $isDualCititzen;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\Country")
     * @var Country
     */
    private $countryDualCitizen;

    /**
     * @ORM\Column(name="residence_permit", type="string", nullable=true)
     * @var string
     */
    private $residencePermit;

    /**
     * @ORM\Column(name="tinzzz", type="string", nullable=true)
     * @var string
     */
    private $tin;

    /**
     * @ORM\Column(name="foriegn_address", type="text", nullable=true)
     * @var string
     */
    private $foriegnAddress;

    /**
     * @ORM\Column(name="foreign_phone", type="text", nullable=true)
     * @var string
     */
    private $foriegnPhone;

    /**
     * @ORM\Column(name="place_of_birth", type="string", nullable=true)
     * @var string
     */
    private $placeOfBirth;

    /**
     * @ORM\Column(name="created_on", type="datetime", nullable=true)
     * @var \DateTime
     */
    private $createdOn;

    /**
     * @ORM\Column(name="updated_on", type="datetime", nullable=true)
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
     * @return mixed
     */
    public function getObjectLife()
    {
        return $this->objectLife;
    }

    /**
     * @return mixed
     */
    public function getNationality()
    {
        return $this->nationality;
    }

    /**
     * @return mixed
     */
    public function getIsDualCititzen()
    {
        return $this->isDualCititzen;
    }

    /**
     * @return mixed
     */
    public function getCountryDualCitizen()
    {
        return $this->countryDualCitizen;
    }

    /**
     * @return mixed
     */
    public function getResidencePermit()
    {
        return $this->residencePermit;
    }

    /**
     * @return mixed
     */
    public function getTin()
    {
        return $this->tin;
    }

    /**
     * @return mixed
     */
    public function getForiegnAddress()
    {
        return $this->foriegnAddress;
    }

    /**
     * @return mixed
     */
    public function getForiegnPhone()
    {
        return $this->foriegnPhone;
    }

    /**
     * @return mixed
     */
    public function getPlaceOfBirth()
    {
        return $this->placeOfBirth;
    }

    /**
     * @return mixed
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    /**
     * @return mixed
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
     * @param mixed $objectLife
     */
    public function setObjectLife($objectLife)
    {
        $this->objectLife = $objectLife;
        return $this;
    }

    /**
     * @param mixed $nationality
     */
    public function setNationality($nationality)
    {
        $this->nationality = $nationality;
        return $this;
    }

    /**
     * @param mixed $isDualCititzen
     */
    public function setIsDualCititzen($isDualCititzen)
    {
        $this->isDualCititzen = $isDualCititzen;
        return $this;
    }

    /**
     * @param mixed $countryDualCitizen
     */
    public function setCountryDualCitizen($countryDualCitizen)
    {
        $this->countryDualCitizen = $countryDualCitizen;
        return $this;
    }

    /**
     * @param mixed $residencePermit
     */
    public function setResidencePermit($residencePermit)
    {
        $this->residencePermit = $residencePermit;
        return $this;
    }

    /**
     * @param mixed $tin
     */
    public function setTin($tin)
    {
        $this->tin = $tin;
        return $this;
    }

    /**
     * @param mixed $foriegnAddress
     */
    public function setForiegnAddress($foriegnAddress)
    {
        $this->foriegnAddress = $foriegnAddress;
        return $this;
    }

    /**
     * @param mixed $foriegnPhone
     */
    public function setForiegnPhone($foriegnPhone)
    {
        $this->foriegnPhone = $foriegnPhone;
        return $this;
    }

    /**
     * @param mixed $placeOfBirth
     */
    public function setPlaceOfBirth($placeOfBirth)
    {
        $this->placeOfBirth = $placeOfBirth;
        return $this;
    }

    /**
     * @param mixed $createdOn
     */
    public function setCreatedOn($createdOn)
    {
        $this->createdOn = $createdOn;
        return $this;
    }

    /**
     * @param mixed $updatedOn
     */
    public function setUpdatedOn($updatedOn)
    {
        $this->updatedOn = $updatedOn;
        return $this;
    }

}

