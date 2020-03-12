<?php
namespace Object\Entity;

use Doctrine\ORM\Mapping as ORM;
use Settings\Entity\OccupationalCategory;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="object_business")
 *
 * @author otaba
 *        
 */
class ObjectBusiness
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(name="business_name", type="string", nullable=true)
     *
     * @var string
     */
    private $businessName;

    /**
     * @ORM\Column(name="business_desc", type="text", nullable=true)
     *
     * @var text
     */
    private $businessDesc;

    /**
     * @ORM\ManyToMany(targetEntity="Settings\Entity\OccupationalCategory")
     * @ORM\JoinTable(name="object_business_occupation",
     * joinColumns={
     * @ORM\JoinColumn(name="object_business", referencedColumnName="id")
     * },
     * inverseJoinColumns={
     * @ORM\JoinColumn(name="occupation", referencedColumnName="id")
     * }
     * )
     *
     * @var Collection
     */
    private $businessCategory;

    /**
     * @ORM\Column(name="business_reg_no", type="string", nullable=true)
     *
     * @var string
     */
    private $businessRegNo;

    /**
     * @ORM\Column(name="business_address", type="text", nullable=true)
     *
     * @var text
     */
    private $businessAddress;

    /**
     * @ORM\OneToOne(targetEntity="Object", inversedBy="objectBusiness")
     *
     * @var Object
     */
    private $object;

    /**
     */
    public function __construct()
    {
        $this->businessCategory = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getBusinessName()
    {
        return $this->businessName;
    }

    public function setBusinessName($name)
    {
        $this->businessName = $name;
        return $this;
    }

    public function getBusinessDesc()
    {
        return $this->businessDesc;
    }

    public function setBusinessDesc($desc)
    {
        $this->businessDesc = $desc;
        return $this;
    }

    public function getBusinessCategory()
    {
        return $this->businessCategory;
    }

    /**
     *
     * @param OccupationalCategory $cat            
     */
    public function addBusinessCategory($cat)
    {
        if (! $this->businessCategory->contains($cat)) {
            $this->businessCategory->add($cat);
        }
        
        return $this;
    }

    public function removeBusinessCategory($cat)
    {
        if ($this->businessCategory->contains($cat)) {
            $this->businessCategory->removeElement($cat);
        }
        
        return $this;
    }

    // public function setBusinessCategory($cat)
    // {
    // $this->businessCategory = $cat;
    // return $this;
    // }
    public function getObject()
    {
        return $this->object;
    }

    /**
     *
     * @param Object $obj            
     * @return \Object\Entity\ObjectBusiness
     */
    public function setObject($obj)
    {
        $this->object = $obj;
        $obj->setObjectBusiness($this);
        return $this;
    }

    public function getBusinessRegNo()
    {
        return $this->businessRegNo;
    }

    public function setBusinessRegNo($reg)
    {
        $this->businessRegNo = $reg;
        return $this;
    }

    public function getBusinessAddress()
    {
        return $this->businessAddress;
    }

    public function setBusinessAddress($add)
    {
        $this->businessAddress = $add;
        return $this;
    }
}

