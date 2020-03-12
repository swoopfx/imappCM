<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="electronics_equipment_insurance_list")
 *
 * @author otaba
 *        
 */
class ElectronicEquipmentInsuredList
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(name="equipment_name", type="string", nullable=true)
     *
     * @var string
     */
    private $equipmentName;

    /**
     * @ORM\Column(name="is_new", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isNew;

    /**
     * @ORM\Column(name="equipment_desc", type="text", nullable=true)
     *
     * @var text
     */
    private $equipmentDec;

    /**
     * @ORM\Column(name="insured_amount", type="string", nullable=true)
     *
     * @var string
     */
    private $insuredAmount;

    /**
     * If a specific Part should be insured
     * @ORM\Column(name="remarks", type="text", nullable=true)
     * 
     * @var text
     */
    private $remarks;

    /**
     * @ORM\Column(name="replacement_value", type="string", nullable=true)
     * 
     * @var string
     */
    private $replacementValue;

    /**
     * @ORM\ManyToOne(targetEntity="ElectronicEquipment", inversedBy="insuredList")
     *
     * @var ElectronicEquipment
     */
    private $electronicEquipment;

    /**
     */
    public function __construct()
    {
        
        // TODO - Insert your code here
    }

    /**
     *
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     *
     * @param number $id            
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     *
     * @return the $equipmentName
     */
    public function getEquipmentName()
    {
        return $this->equipmentName;
    }

    /**
     *
     * @param string $equipmentName            
     */
    public function setEquipmentName($equipmentName)
    {
        $this->equipmentName = $equipmentName;
        return $this;
    }

    /**
     *
     * @return the $equipmentDec
     */
    public function getEquipmentDec()
    {
        return $this->equipmentDec;
    }

    /**
     *
     * @param \IMServices\Entity\text $equipmentDec            
     */
    public function setEquipmentDec($equipmentDec)
    {
        $this->equipmentDec = $equipmentDec;
        return $this;
    }

    /**
     *
     * @return the $insuredAmount
     */
    public function getInsuredAmount()
    {
        return $this->insuredAmount;
    }

    /**
     *
     * @param string $insuredAmount            
     */
    public function setInsuredAmount($insuredAmount)
    {
        $this->insuredAmount = $insuredAmount;
        return $this;
    }

    public function getElectronicEquipment()
    {
        return $this->electronicEquipment;
    }

    public function setElectronicEquipment($elect)
    {
        $this->electronicEquipment = $elect;
        return $this;
    }

    /**
     *
     * @return the $isNew
     */
    public function getIsNew()
    {
        return $this->isNew;
    }

    /**
     *
     * @return the $remarks
     */
    public function getRemarks()
    {
        return $this->remarks;
    }

    /**
     *
     * @return the $replacementValue
     */
    public function getReplacementValue()
    {
        return $this->replacementValue;
    }

    /**
     *
     * @param boolean $isNew            
     */
    public function setIsNew($isNew)
    {
        $this->isNew = $isNew;
        return $this;
    }

    /**
     *
     * @param \IMServices\Entity\text $remarks            
     */
    public function setRemarks($remarks)
    {
        $this->remarks = $remarks;
        return $this;
    }

    /**
     *
     * @param string $replacementValue            
     */
    public function setReplacementValue($replacementValue)
    {
        $this->replacementValue = $replacementValue;
        return $this;
    }
}

