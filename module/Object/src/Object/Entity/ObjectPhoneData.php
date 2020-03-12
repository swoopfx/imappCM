<?php
namespace Object\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ObjectPhoneData
 *
 * @ORM\Table(name="object_phone_data", indexes={@ORM\Index(name="FK_object_motor_property_objectid1_idx", columns={"object_id"})})
 * @ORM\Entity
 */
class ObjectPhoneData
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
     * @var integer @ORM\Column(name="id_object", type="integer", nullable=false)
     */
    private $idObject;

    /**
     *
     * @var integer @ORM\Column(name="motor_type", type="integer", nullable=false)
     */
    private $motorType;

    /**
     *
     * @var integer @ORM\Column(name="motor_value_type", type="integer", nullable=true)
     */
    private $motorValueType;

    /**
     *
     * @var string @ORM\Column(name="motor_number", type="string", length=45, nullable=true)
     */
    private $motorNumber;

    /**
     *
     * @var string @ORM\Column(name="object_motor_datacol", type="string", length=45, nullable=true)
     */
    private $objectMotorDatacol;

    /**
     *
     * @var \DateTime @ORM\Column(name="date_created", type="datetime", nullable=true)
     */
    private $dateCreated;

    /**
     *
     * @var \DateTime @ORM\Column(name="date_updated", type="datetime", nullable=true)
     */
    private $dateUpdated;

    /**
     *
     * @var \Object\Entity\Object @ORM\ManyToOne(targetEntity="Object\Entity\Object")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="object_id", referencedColumnName="id")
     *      })
     */
    private $object;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idObject
     *
     * @param integer $idObject            
     *
     * @return ObjectPhoneData
     */
    public function setIdObject($idObject)
    {
        $this->idObject = $idObject;
        
        return $this;
    }

    /**
     * Get idObject
     *
     * @return integer
     */
    public function getIdObject()
    {
        return $this->idObject;
    }

    /**
     * Set motorType
     *
     * @param integer $motorType            
     *
     * @return ObjectPhoneData
     */
    public function setMotorType($motorType)
    {
        $this->motorType = $motorType;
        
        return $this;
    }

    /**
     * Get motorType
     *
     * @return integer
     */
    public function getMotorType()
    {
        return $this->motorType;
    }

    /**
     * Set motorValueType
     *
     * @param integer $motorValueType            
     *
     * @return ObjectPhoneData
     */
    public function setMotorValueType($motorValueType)
    {
        $this->motorValueType = $motorValueType;
        
        return $this;
    }

    /**
     * Get motorValueType
     *
     * @return integer
     */
    public function getMotorValueType()
    {
        return $this->motorValueType;
    }

    /**
     * Set motorNumber
     *
     * @param string $motorNumber            
     *
     * @return ObjectPhoneData
     */
    public function setMotorNumber($motorNumber)
    {
        $this->motorNumber = $motorNumber;
        
        return $this;
    }

    /**
     * Get motorNumber
     *
     * @return string
     */
    public function getMotorNumber()
    {
        return $this->motorNumber;
    }

    /**
     * Set objectMotorDatacol
     *
     * @param string $objectMotorDatacol            
     *
     * @return ObjectPhoneData
     */
    public function setObjectMotorDatacol($objectMotorDatacol)
    {
        $this->objectMotorDatacol = $objectMotorDatacol;
        
        return $this;
    }

    /**
     * Get objectMotorDatacol
     *
     * @return string
     */
    public function getObjectMotorDatacol()
    {
        return $this->objectMotorDatacol;
    }

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated            
     *
     * @return ObjectPhoneData
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;
        
        return $this;
    }

    /**
     * Get dateCreated
     *
     * @return \DateTime
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * Set dateUpdated
     *
     * @param \DateTime $dateUpdated            
     *
     * @return ObjectPhoneData
     */
    public function setDateUpdated($dateUpdated)
    {
        $this->dateUpdated = $dateUpdated;
        
        return $this;
    }

    /**
     * Get dateUpdated
     *
     * @return \DateTime
     */
    public function getDateUpdated()
    {
        return $this->dateUpdated;
    }

    /**
     * Set object
     *
     * @param \All\Entity\Object $object            
     *
     * @return ObjectPhoneData
     */
    public function setObject(\Object\Entity\Object $object = null)
    {
        $this->object = $object;
        
        return $this;
    }

    /**
     * Get object
     *
     * @return \All\Entity\Object
     */
    public function getObject()
    {
        return $this->object;
    }
}
