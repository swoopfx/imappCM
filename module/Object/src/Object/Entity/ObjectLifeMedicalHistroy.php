<?php
namespace Object\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Entity
 * @ORM\Table(name="object_life_medical_history")
 * @author otaba
 *        
 */
class ObjectLifeMedicalHistroy
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
     * @ORM\ManyToOne(targetEntity="ObjectPersonData", inversedBy="objectLifeMedicalHistory")
     * @var ObjectPersonData
     */
    private $objectLife;

    /**
     * Name of the sickeness
     *
     * @ORM\Column(name="ailment", type="string", nullable=true)
     * @var string
     */
    private $ailment;

    /**
     *
     * @ORM\Column(name="doctor_name", type="string", nullable=true)
     * @var string
     */
    private $doctorName;

    /**
     * This is email phone number
     *
     * @ORM\Column(name="doctor_info", type="text", nullable=true)
     * @var string
     */
    private $doctorInfo;

    /**
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     * @var string
     */
    private $desccription;

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

   
    /**
     * @return number
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \Object\Entity\ObjectLife
     */
    public function getObjectLife()
    {
        return $this->objectLife;
    }

    /**
     * @return string
     */
    public function getAilment()
    {
        return $this->ailment;
    }

    /**
     * @return string
     */
    public function getDoctorName()
    {
        return $this->doctorName;
    }

    /**
     * @return string
     */
    public function getDoctorInfo()
    {
        return $this->doctorInfo;
    }

    /**
     * @return string
     */
    public function getDesccription()
    {
        return $this->desccription;
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
     * @param \Object\Entity\ObjectLife $objectLife
     */
    public function setObjectLife($objectLife)
    {
        $this->objectLife = $objectLife;
        return $this;
    }

    /**
     * @param string $ailment
     */
    public function setAilment($ailment)
    {
        $this->ailment = $ailment;
        return $this;
    }

    /**
     * @param string $doctorName
     */
    public function setDoctorName($doctorName)
    {
        $this->doctorName = $doctorName;
        return $this;
    }

    /**
     * @param string $doctorInfo
     */
    public function setDoctorInfo($doctorInfo)
    {
        $this->doctorInfo = $doctorInfo;
        return $this;
    }

    /**
     * @param string $desccription
     */
    public function setDesccription($desccription)
    {
        $this->desccription = $desccription;
        return $this;
    }

    /**
     * @param \DateTime $createdOn
     */
    public function setCreatedOn($createdOn)
    {
        $this->createdOn = $createdOn;
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

