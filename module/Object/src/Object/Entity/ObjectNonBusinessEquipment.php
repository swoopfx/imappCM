<?php
namespace Object\Entity;

use Doctrine\ORM\Mapping as ORM;
// use Settings\Entity\NonBusinessEquipment;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity
 * @ORM\Table(name="object_non_business_equipement")
 *
 * @author otaba
 *        
 */
class ObjectNonBusinessEquipment
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="Object\Entity\Object", inversedBy="objectNonBusinessEquipment")
     *
     * @var Object
     */
    private $object;

    /**
     * @ORM\ManyToMany(targetEntity="Settings\Entity\BusinessEquipments")
     * @ORM\JoinTable(name="object_non_business_equipment_category",
     * joinColumns={
     * @ORM\JoinColumn(name="object_non_business", referencedColumnName="id")
     * },
     * inverseJoinColumns={
     * @ORM\JoinColumn(name="equipment", referencedColumnName="id")
     * }
     * )
     *
     * @var Collection
     */
    private $equipmentCategory;

    /**
     * @ORM\Column(name="equipment_name", type="string", nullable=true)
     *
     * @var string
     */
    private $equipmentName;

    // /**
    // * This is either the IMEI or some unique number on the device
    // * @var string
    // */
    // private $equipmentId;
    
    /**
     * @ORM\Column(name="equipment_desc", type="text", nullable=true)
     *
     * @var text
     */
    private $equipmentDesc;

    /**
     * This is either the IMEI or some unique number on the device
     * @ORM\Column(name="equipment_uid", type="string", nullable=true)
     *
     * @var string
     */
    private $equipmentUid;

    /**
     * @ORM\Column(name="created_on", type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $creatdOn;

    /**
     * @ORM\Column(name="updated_on", type="string", nullable=true)
     *
     * @var \DateTime
     */
    private $updatedOn;

    public function __construct()
    {
        $this->equipmentCategory = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }
    
   

    public function getEquipmentName()
    {
        return $this->equipmentName;
    }

    public function setEquipmentName($name)
    {
        $this->equipmentName = $name;
        return $this;
    }

    public function getEquipmentCategory()
    {
        return $this->equipmentCategory;
    }

    public function addEquipmentCategory($cat)
    {
        if (! $this->equipmentCategory->contains($cat)) {
            $this->equipmentCategory->add($cat);
        }
        return $this;
    }

    public function removeEquipmentCategory($cat)
    {
        if ($this->equipmentCategory->contains($cat)) {
            $this->equipmentCategory->removeElement($cat);
        }
        return $this;
    }

    // public function setEquipmentCategory($cat){
    // $this->equipmentCategory = $cat;
    // return $this;
    // }
    public function getEquipmentDesc()
    {
        return $this->equipmentDesc;
    }

    public function setEquipmentDesc($desc)
    {
        $this->equipmentDesc = $desc;
        return $this;
    }

    public function getEquipmentUid()
    {
        return $this->equipmentUid;
    }

    public function setEquipmentUid($dert)
    {
        $this->equipmentUid = $dert;
        return $this;
    }

    public function getCreatedOn()
    {
        return $this->creatdOn;
    }

    public function setCreatedOn($ins)
    {
        $this->creatdOn = $ins;
        $this->updatedOn = $ins;
        return $this;
    }

    public function getUpdatedOn()
    {
        return $this->updatedOn;
    }

    public function setUpdatedOn($set)
    {
        $this->updatedOn = $set;
        return $this;
    }
    
    /**
     * 
     * @param Object $obj
     */
    public function setObject($obj){
        $this->object = $obj;
        $obj->setObjectNonBusinessEquipment($this);
        return $this;
    }
    
    public function getObject(){
        return $this->object;
    }
}

