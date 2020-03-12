<?php
namespace Object\Entity;


use Doctrine\ORM\Mapping as ORM;
use Settings\Entity\BusinessEquipments;
use Settings\Entity\EquipmentPurchaseValue;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * @ORM\Entity
 * @ORM\Table(name="object_business_equipment")
 * @author otaba
 *        
 */
class ObjectBusinessEquipment
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @ORM\OneToOne(targetEntity="Object\Entity\Object", inversedBy="businessEquipment")
     * @var Object
     */
    private $object;
    
    /**
     * @ORM\ManyToMany(targetEntity="Settings\Entity\BusinessEquipments")
     * @ORM\JoinTable(name="object_business_equipment_category",
     * joinColumns={
     * @ORM\JoinColumn(name="object_business", referencedColumnName="id")
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
     * This includes its use
     * @ORM\Column(name="equipment_desc", type="text", nullable=true)
     * @var string
     */
    private $equipmentDesc;
    
    /**
     * @ORM\Column(name="equipment_uid", type="string", nullable=true)
     * @var string
     */
    private $equipmentUid;
    
    /**
     * @ORM\Column(name="item_number", type="string", nullable=true)
     * @var string
     */
    private $itemNo;
    
    /**
     * @ORM\Column(name="make", type="string", nullable=true)
     * @var string
     */
    private $make;
    
     /**
     * @ORM\Column(name="reg_number", type="string", nullable=true)
     * @var string
     */
    private $regNo;
    
    /**
     * @ORM\Column(name="year_manufacture", type="datetime", nullable=true)
     */
    private $yearManufacture;
    
    /**
     * @ORM\Column(name="purchase_date", type="datetime", nullable=true)
     * @var \Datetime
     */
    private $purchaseDate;
    
    
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
    
    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\EquipmentPurchaseValue")
     * @var EquipmentPurchaseValue
     */
    private $purchaseValue;
    
    private $durationOfService;
    
    private $servicingCompany;
    
    public function __construct()
    {
        $this->equipmentCategory = new ArrayCollection();
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function getEquipmentCategory(){
        return $this->equipmentCategory;
    }
    
    public function addEquipmentCategory($cat){
        if(!$this->equipmentCategory->contains($cat)){
            $this->equipmentCategory->add($cat);
        }
        return $this;
    }
    
    public function removeEquipmentCategory($cat){
        if($this->equipmentCategory->contains($cat)){
            $this->equipmentCategory->removeElement($cat);
        }
        return $this;
    }
    
//     public function setEquipmentCategory($cat){
//         $this->equipmentCategory  = $cat;
//         return $this;
//     }
    
    public function getEquipmentDesc(){
        return $this->equipmentDesc;
    }
    
    public function setEquipmentDesc($desc){
        $this->equipmentDesc = $desc;
        return $this;
    }
    
    public function getEquipmentUid(){
        return $this->equipmentUid;
    }
    
    public function setEquipmentUid($dert){
        $this->equipmentUid = $dert;
        return $this;
    }
    
    public function getItemNo(){
        return $this->itemNo;
    }
    
    public function setItemNo($no){
        $this->itemNo = $no;
        return $this;
    }
    
    public function getMake(){
        return $this->make;
    }
    
    public function setMake($make){
        $this->make = $make;
        return $this;
    }
    
    public function getRegNo(){
        return $this->regNo;
    }
    
    public function setRegNo($no){
        $this->regNo = $no;
        return $this;
    }
    
    public function getYearManufacture(){
        return $this->yearManufacture;
    }
    
    public function setYearManufacture($year){
        $this->yearManufacture = $year;
        return $this;
    }
    
    
    public function getPurchaseDate(){
        return $this->purchaseDate;
    }
    
    public function setPurchaseDate($date){
        $this->purchaseDate = $date;
        return $this;
    }
    
    public function getCreatedOn(){
        return $this->createdOn;
    }
    
    public function setCreatedOn($ins){
         $this->createdOn = $ins;
        $this->updatedOn = $ins;
        return $this;
    }
    
    public function getUpdatedOn(){
        return $this->updatedOn;
    }
    
    public function setUpdatedOn($set){
        $this->updatedOn = $set;
        return $this;
    }
    
    public function getObject(){
        return $this->object;
    }
    /**
     * 
     * @param Object $obj
     * @return \Object\Entity\ObjectBusinessEquipment
     */
    public function setObject($obj){
        $this->object = $obj;
        $obj->setBusinessEquipment($this);
        return $this;
    }
    
    public function getPurchaseValue(){
        return $this->purchaseValue;
    }
    
    public function  setPurchaseValue($val){
        $this->purchaseValue = $val;
        return $this;
    }
}

