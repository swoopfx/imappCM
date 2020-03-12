<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PersonMedicalProperty
 *
 * @ORM\Table(name="person_medical_property", indexes={@ORM\Index(name="FKobject_person_medical_data_idx", columns={"idobject_person_data"})})
 * @ORM\Entity
 */
class PersonMedicalProperty
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
     * @var integer @ORM\Column(name="bloodtype", type="integer", nullable=true)
     */
    private $bloodtype;

    /**
     *
     * @var integer @ORM\Column(name="bloodgroup", type="integer", nullable=true)
     */
    private $bloodgroup;

    /**
     *
     * @var \Object\Entity\ObjectPersonData @ORM\ManyToOne(targetEntity="Object\Entity\ObjectPersonData")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="idobject_person_data", referencedColumnName="id")
     *      })
     */
    private $idobjectPersonData;

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
     * Set bloodtype
     *
     * @param integer $bloodtype            
     *
     * @return PersonMedicalProperty
     */
    public function setBloodtype($bloodtype)
    {
        $this->bloodtype = $bloodtype;
        
        return $this;
    }

    /**
     * Get bloodtype
     *
     * @return integer
     */
    public function getBloodtype()
    {
        return $this->bloodtype;
    }

    /**
     * Set bloodgroup
     *
     * @param integer $bloodgroup            
     *
     * @return PersonMedicalProperty
     */
    public function setBloodgroup($bloodgroup)
    {
        $this->bloodgroup = $bloodgroup;
        
        return $this;
    }

    /**
     * Get bloodgroup
     *
     * @return integer
     */
    public function getBloodgroup()
    {
        return $this->bloodgroup;
    }

    /**
     * Set idobjectPersonData
     *
     * @param \All\Entity\ObjectPersonData $idobjectPersonData            
     *
     * @return PersonMedicalProperty
     */
    public function setIdobjectPersonData(\All\Entity\ObjectPersonData $idobjectPersonData = null)
    {
        $this->idobjectPersonData = $idobjectPersonData;
        
        return $this;
    }

    /**
     * Get idobjectPersonData
     *
     * @return \All\Entity\ObjectPersonData
     */
    public function getIdobjectPersonData()
    {
        return $this->idobjectPersonData;
    }
}
