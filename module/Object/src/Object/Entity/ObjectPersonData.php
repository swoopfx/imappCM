<?php
namespace Object\Entity;

use Doctrine\ORM\Mapping as ORM;
use Settings\Entity\OccupationalCategory;
use Settings\Entity\Sex;
use Settings\Entity\Title;
use Settings\Entity\Country;
use Settings\Entity\Zone;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * ObjectPersonData
 *
 * @ORM\Table(name="object_person_data")
 * @ORM\Entity
 */
class ObjectPersonData
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
     * @ORM\ManyToOne(targetEntity="Settings\Entity\Title")
     *
     * @var Title
     */
    private $title;

    /**
     *
     * @var string @ORM\Column(name="firstname", type="string", length=100, nullable=true)
     */
    private $firstname;

    /**
     *
     * @var string @ORM\Column(name="lastname", type="string", length=100, nullable=true)
     */
    private $lastname;

    /**
     *
     * @var string @ORM\Column(name="othername", type="string", length=100, nullable=true)
     */
    private $othername;

    /**
     *
     * @var string @ORM\Column(name="mobile_number", type="string", length=100, nullable=true)
     */
    private $mobileNumber;

    /**
     *
     * @var string @ORM\Column(name="is_married", type="boolean", length=200, nullable=true)
     */
    private $isMarried;

    /**
     *
     * @var string @ORM\Column(name="maiden_name", type="string", length=200, nullable=true)
     */
    private $maidenName;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Settings\Entity\Sex")
     *
     * @var Sex
     */
    private $sex;

    // /**
    // *
    // * @var string @ORM\Column(name="correspodence_add", type="text", nullable=false)
    // */
    // private $correspodenceAdd;

    /**
     *
     * @var \DateTime @ORM\Column(name="age", type="datetime", nullable=true)
     */
    private $age;

    /**
     * If the person is not Nigerianit
     * It fills the foreiners details
     * @ORM\Column(name="is_nigerian", type="boolean", nullable=true)
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
     * @var string @ORM\Column(name="address", type="string", length=250, nullable=true)
     */
    private $address;

    /**
     *
     * @var Country @ORM\ManyToOne(targetEntity="Settings\Entity\Country")
     *     
     */
    private $countryId;

    /**
     *
     * @var Zone @ORM\ManyToOne(targetEntity="Settings\Entity\Zone")
     */
    private $cityId;

    /**
     *
     * @ORM\Column(name="bvnss", type="string", nullable=true)
     * @var string
     */
    private $bvn;

    /**
     *
     * @var \Object\Entity\Object @ORM\OneToOne(targetEntity="Object\Entity\Object", inversedBy="objectPerson")
     *     
     */
    private $object;

//     /**
//      *
//      * @ORM\ManyToMany(targetEntity="Settings\Entity\OccupationalCategory")
//      * @ORM\JoinTable(name="object_person_occupation",
//      * joinColumns={
//      * @ORM\JoinColumn(name="object_person", referencedColumnName="id")
//      * },
//      * inverseJoinColumns={
//      * @ORM\JoinColumn(name="occupation", referencedColumnName="id")
//      * }
//      * )
//      *
//      * @var Collection
//      *
//      */
//     private $occupation;

//     /**
//      *
//      * @ORM\Column(name="occupation_post", type="string", nullable=true)
//      *
//      * @var string
//      */
//     private $occupationPost;

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

//     /**
//      *
//      * @ORM\OneToMany(targetEntity="Object\Entity\ObjectLifeBeneficiary", mappedBy="objectLife")
//      * @var Collection
//      */
//     private $beneficiary;

    /**
     *
     * @ORM\OneToOne(targetEntity="Object\Entity\ObjectLifeForignerDetails")
     * @var ObjectLifeForignerDetails
     */
    private $objectLifeForignerDetails;

    /**
     *
     * @ORM\Column(name="created_on", type="datetime", nullable=true)
     * @var \DateTime
     */
    private $createdOn;

    /**
     *
     * @ORM\Column(name="updated_on", type="datetime", nullable=true)
     * @var \DateTime
     */
    private $updatedOn;

    public function __construct()
    {
//         $this->occupation = new ArrayCollection();
//         $this->beneficiary = new ArrayCollection();
        $this->bjectLifeMedicalHistory = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     * @return ObjectPersonData
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     * @return ObjectPersonData
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    public function getOthername()
    {
        return $this->othername;
    }

    public function setOthername($name)
    {
        $this->othername = $name;
        return $this;
    }

    public function getMobileNumber()
    {
        return $this->mobileNumber;
    }

    public function setMobileNumber($num)
    {
        $this->mobileNumber = $num;
        return $this;
    }

    public function getIsMarried()
    {
        return $this->isMarried;
    }

    public function setIsMarried($mar)
    {
        $this->isMarried = $mar;
        return $this;
    }

    public function getMaidenName()
    {
        return $this->maidenName;
    }

    public function setMaidenName($name)
    {
        $this->maidenName = $name;
        return $this;
    }
    
    public function getFullname(){
        return $this->title->getTitle()." ".($this->getLastname() == NULL ? "" : $this->lastname)." ".($this->getFirstname() == NULL ? "" : $this->firstname);
    }

    public function getFullAddress()
    {
        return ($this->address == NULL ? "" : $this->address) . " " . $this->cityId->getZoneName() . ", " . $this->countryId->getCountryName() . ", ";
    }

    public function getSex()
    {
        return $this->sex;
    }

    public function setSex($sex)
    {
        $this->sex = $sex;
        return $this;
    }

    /**
     * Set age
     *
     * @param \DateTime $age
     * @return ObjectPersonData
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return \DateTime
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return ObjectPersonData
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set countryId
     *
     * @param integer $countryId
     * @return ObjectPersonData
     */
    public function setCountryId($countryId)
    {
        $this->countryId = $countryId;

        return $this;
    }

    /**
     * Get countryId
     *
     * @return integer
     */
    public function getCountryId()
    {
        return $this->countryId;
    }

    /**
     * Set cityId
     *
     * @param integer $cityId
     * @return ObjectPersonData
     */
    public function setCityId($cityId)
    {
        $this->cityId = $cityId;

        return $this;
    }

    /**
     * Get cityId
     *
     * @return integer
     */
    public function getCityId()
    {
        return $this->cityId;
    }

    /**
     * Set object
     *
     * @param \Object\Entity\Object $object
     * @return ObjectPersonData
     */
    public function setObject(\Object\Entity\Object $object = null)
    {
        $this->object = $object;
        $this->object->setObjectLife($this);
        return $this;
    }

    /**
     * Get object
     *
     * @return \Object\Entity\Object
     */
    public function getObject()
    {
        return $this->object;
    }

    public function getOccupation()
    {
        return $this->occupation;
    }

    // public function setOccupation($occ)
    // {
    // $this->occupation = $occ;
    // return $this;
    // }

    /**
     *
     * @param OccupationalCategory $occu
     * @return \Object\Entity\ObjectPersonData
     */
    public function addOccupation($occu)
    {
        if (! $this->occupation->contains($occu)) {
            $this->occupation->add($occu);
        }

        return $this;
    }

    /**
     *
     * @param OccupationalCategory $occu
     * @return \Object\Entity\ObjectPersonData
     */
    public function removeOccupation($occu)
    {
        if ($this->occupation->contains($occu)) {
            $this->occupation->removeElement($occu);
        }

        return $this;
    }

    public function getOccupationPost()
    {
        return $this->occupationPost;
    }

    public function setOccupationPost($post)
    {
        $this->occupationPost = $post;
        return $this;
    }

    // , indexes={@ORM\Index(name="FK_Person_property_object_idx", columns={"object_id"})}

    /**
     *
     * @return boolean
     */
    public function getIsNigerian()
    {
        return $this->isNigerian;
    }

    /**
     *
     * @return \Object\Entity\ObjectLifeForignerDetails
     */
    public function getObjectLifeForiegnerDetails()
    {
        return $this->objectLifeForiegnerDetails;
    }

    /**
     *
     * @return string
     */
    public function getBvn()
    {
        return $this->bvn;
    }

    /**
     *
     * @return string
     */
    public function getCommunicationMethod()
    {
        return $this->communicationMethod;
    }

    /**
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getObjectLifeMedicalHistory()
    {
        return $this->objectLifeMedicalHistory;
    }

    /**
     *
     * @return \Object\Entity\ObjectLifeBeneficiary
     */
    public function getBeneficiary()
    {
        return $this->beneficiary;
    }

    /**
     *
     * @return \Object\Entity\ObjectLifeForignerDetails
     */
    public function getObjectLifeForignerDetails()
    {
        return $this->objectLifeForignerDetails;
    }

    /**
     *
     * @param boolean $isNigerian
     */
    public function setIsNigerian($isNigerian)
    {
        $this->isNigerian = $isNigerian;
        return $this;
    }

    /**
     *
     * @param \Object\Entity\ObjectLifeForignerDetails $objectLifeForiegnerDetails
     */
    public function setObjectLifeForiegnerDetails($objectLifeForiegnerDetails)
    {
        $this->objectLifeForiegnerDetails = $objectLifeForiegnerDetails;
        return $this;
    }

    /**
     *
     * @param string $bvn
     */
    public function setBvn($bvn)
    {
        $this->bvn = $bvn;
        return $this;
    }

    /**
     *
     * @param \Doctrine\Common\Collections\Collection $occupation
     */
    public function setOccupation($occupation)
    {
        $this->occupation = $occupation;
        return $this;
    }

    /**
     *
     * @param string $communicationMethod
     */
    public function setCommunicationMethod($communicationMethod)
    {
        $this->communicationMethod = $communicationMethod;
        return $this;
    }

    /**
     *
     * @param \Doctrine\Common\Collections\Collection $objectLifeMedicalHistory
     */
    public function setObjectLifeMedicalHistory($objectLifeMedicalHistory)
    {
        $this->objectLifeMedicalHistory = $objectLifeMedicalHistory;
        return $this;
    }

    public function addObjectLifeMedicalHistory($objectLifeMedicalHistory)
    {
        if (! $this->objectLifeMedicalHistory->contains($objectLifeMedicalHistory)) {
            $this->objectLifeMedicalHistory->add($objectLifeMedicalHistory);
        }
        return $this;
    }

    public function removeObjectLifeMedicalHistory($objectLifeMedicalHistory)
    {
        if ($this->objectLifeMedicalHistory->contains($objectLifeMedicalHistory)) {
            $this->objectLifeMedicalHistory->removeElement($objectLifeMedicalHistory);
        }
        return $this;
    }

    /**
     *
     * @param \Object\Entity\ObjectLifeBeneficiary $beneficiary
     */
    public function setBeneficiary($beneficiary)
    {
        $this->beneficiary = $beneficiary;

        return $this;
    }

    public function addBeneficiary($beneficiary)
    {
        if (! $this->beneficiary->contains($beneficiary)) {
            $this->beneficiary->add($beneficiary);
        }
        return $this;
    }

    public function removeBeneficiary($beneficiary)
    {
        if ($this->beneficiary->contains($beneficiary)) {
            $this->beneficiary->removeElement($beneficiary);
        }
        return $this;
    }

    /**
     *
     * @param \Object\Entity\ObjectLifeForignerDetails $objectLifeForignerDetails
     */
    public function setObjectLifeForignerDetails($objectLifeForignerDetails)
    {
        $this->objectLifeForignerDetails = $objectLifeForignerDetails;
        return $this;
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

}
