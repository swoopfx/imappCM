<?php
namespace Object\Entity;

use Doctrine\ORM\Mapping as ORM;
use Object\Entity\ObjectLifeForignerDetails;
use CsnUser\Entity\Language;
use Settings\Entity\OccupationalCategory;
use Doctrine\Common\Collections\Collection;
use Settings\Entity\Title;
use Doctrine\Common\Collections\ArrayCollection;

/**
 *
 * @ORM\Entity
 * @ORM\Table(name="object_life")
 * @author otaba
 *        
 */
class ObjectLife
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
     * @ORM\ManyToOne(targetEntity="Object")
     * @var Object
     */
    private $object;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\Title")
     * @var Title
     */
    private $title;

    /**
     *
     * @ORM\Column(name="last_name", type="string", nullable=true)
     * @var string
     *
     */
    private $lastName;

    /**
     *
     * @ORM\Column(name="first_name", type="string", nullable=true)
     *
     *
     * @var string
     */
    private $firstName;

    /**
     *
     * @ORM\Column(name="middle_name", type="string", nullable=true)
     * @var string
     */
    private $middleName;

    /**
     *
     * @ORM\Column(name="is_married", type="boolean", nullable=true)
     * @var boolean
     */
    private $isMarried;

    /**
     *
     * @ORM\Column(name="maiden_name", type="string", nullable=true)
     * @var string
     */
    private $maidenName;

    /**
     *
     * @ORM\Column(name="dobsss", type="datetime", nullable=true)
     * @var \DateTime
     */
    private $dob;

    /**
     * If the person is not Nigerianit
     * It fills the foreiners details
     *
     * @var boolean
     */
    private $isNigerian;

    /**
     *
     * @ORM\OneToOne(targetEntity="Object\Entity\ObjectLifeForignerDetails")
     * @var ObjectLifeForignerDetails
     */
    private $objectLifeForiegnerDetails;

    /**
     *
     * @ORM\Column(name="bvnss", type="string", nullable=true)
     * @var string
     */
    private $bvn;

    /**
     *
     * @ORM\Column(name="telephone", type="string", nullable=true)
     * @var string
     */
    private $telephoneNumber;

    /**
     *
     * @ORM\Column(name="address", type="string", nullable=true)
     * @var string
     */
    private $address;

    /**
     *
     * @ORM\ManyToOne(targetEntity="CsnUser\Entity\Language")
     * @var Language
     */
    private $language;

    /**
     * Either email, Phone, fax
     *
     * @ORM\Column(name="communication_method", type="string", nullable=true)
     * @var string
     */
    private $communicationMethod;

    /**
     *
     * @ORM\OneToMany(targetEntity="ObjectLifeMedicalHistroy", mappedBy="objectLife")
     * @var Collection
     */
    private $objectLifeMedicalHistory;

    

    /**
     *
     * @ORM\OneToMany(targetEntity="Object\Entity\ObjectLifeBeneficiary", mappedBy="objectLife")
     * @var ObjectLifeBeneficiary
     */
    private $beneficiary;

    /**
     *
     * @ORM\OneToOne(targetEntity="Object\Entity\ObjectLifeForignerDetails")
     * @var ObjectLifeForignerDetails
     */
    private $objectLifeForignerDetails;

    // TODO - Insert your code here
    public function __construct()
    {

        $this->objectLifeMedicalHistory = new ArrayCollection();
    }
    /**
     * @return number
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return object
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getMiddleName()
    {
        return $this->middleName;
    }

    /**
     * @return boolean
     */
    public function getIsMarried()
    {
        return $this->isMarried;
    }

    /**
     * @return string
     */
    public function getMaidenName()
    {
        return $this->maidenName;
    }

    /**
     * @return \DateTime
     */
    public function getDob()
    {
        return $this->dob;
    }

   

    /**
     * @return boolean
     */
    public function getIsNigerian()
    {
        return $this->isNigerian;
    }

    /**
     * @return \Object\Entity\ObjectLifeForignerDetails
     */
    public function getObjectLifeForiegnerDetails()
    {
        return $this->objectLifeForiegnerDetails;
    }

    /**
     * @return string
     */
    public function getBvn()
    {
        return $this->bvn;
    }

    /**
     * @return string
     */
    public function getTelephoneNumber()
    {
        return $this->telephoneNumber;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @return \CsnUser\Entity\Language
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @return string
     */
    public function getCommunicationMethod()
    {
        return $this->communicationMethod;
    }

    /**
     * @return \Object\Entity\ObjectLifeMedicalHistroy
     */
    public function getObjectLifeMedicalHistory()
    {
        return $this->objectLifeMedicalHistory;
    }

    /**
     * @return string
     */
    public function getJobTitle()
    {
        return $this->jobTitle;
    }

    /**
     * @return \Object\Entity\ObjectLifeBeneficiary
     */
    public function getBeneficiary()
    {
        return $this->beneficiary;
    }

    /**
     * @return \Object\Entity\ObjectLifeForignerDetails
     */
    public function getObjectLifeForignerDetails()
    {
        return $this->objectLifeForignerDetails;
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
     * @param object $object
     */
    public function setObject($object)
    {
        $this->object = $object;
        return $this;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @param string $middleName
     */
    public function setMiddleName($middleName)
    {
        $this->middleName = $middleName;
        return $this;
    }

    /**
     * @param boolean $isMarried
     */
    public function setIsMarried($isMarried)
    {
        $this->isMarried = $isMarried;
        return $this;
    }

    /**
     * @param string $maidenName
     */
    public function setMaidenName($maidenName)
    {
        $this->maidenName = $maidenName;
        return $this;
    }

    /**
     * @param \DateTime $dob
     */
    public function setDob($dob)
    {
        $this->dob = $dob;
        return $this;
    }

   

    /**
     * @param boolean $isNigerian
     */
    public function setIsNigerian($isNigerian)
    {
        $this->isNigerian = $isNigerian;
        return $this;
    }

    /**
     * @param \Object\Entity\ObjectLifeForignerDetails $objectLifeForiegnerDetails
     */
    public function setObjectLifeForiegnerDetails($objectLifeForiegnerDetails)
    {
        $this->objectLifeForiegnerDetails = $objectLifeForiegnerDetails;
        return $this;
    }

    /**
     * @param string $bvn
     */
    public function setBvn($bvn)
    {
        $this->bvn = $bvn;
        return $this;
    }

    /**
     * @param string $telephoneNumber
     */
    public function setTelephoneNumber($telephoneNumber)
    {
        $this->telephoneNumber = $telephoneNumber;
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
     * @param \CsnUser\Entity\Language $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
        return $this;
    }

    /**
     * @param string $communicationMethod
     */
    public function setCommunicationMethod($communicationMethod)
    {
        $this->communicationMethod = $communicationMethod;
        return $this;
    }

    /**
     * @param \Object\Entity\ObjectLifeMedicalHistroy $objectLifeMedicalHistory
     */
    public function setObjectLifeMedicalHistory($objectLifeMedicalHistory)
    {
        $this->objectLifeMedicalHistory = $objectLifeMedicalHistory;
        return $this;
    }

    /**
     * @param string $jobTitle
     */
    public function setJobTitle($jobTitle)
    {
        $this->jobTitle = $jobTitle;
        return $this;
    }

    /**
     * @param \Object\Entity\ObjectLifeBeneficiary $beneficiary
     */
    public function setBeneficiary($beneficiary)
    {
        $this->beneficiary = $beneficiary;
        return $this;
    }

    /**
     * @param \Object\Entity\ObjectLifeForignerDetails $objectLifeForignerDetails
     */
    public function setObjectLifeForignerDetails($objectLifeForignerDetails)
    {
        $this->objectLifeForignerDetails = $objectLifeForignerDetails;
        return $this;
    }

}

