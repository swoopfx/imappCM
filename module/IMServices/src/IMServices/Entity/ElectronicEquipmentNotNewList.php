<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="electronic_equipment_not_new_list")
 * 
 * @author otaba
 *        
 */
class ElectronicEquipmentNotNewList
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * A unique id to identify the device
     * @ORM\Column(name="device_id", type="string", nullable=true)
     * 
     * @var string
     */
    private $deviceId;

    /**
     * Name on Device
     * @ORM\Column(name="device_name", type="string", nullable=true)
     * 
     * @var string
     */
    private $deviceName;

    /**
     * @ORM\Column(name="value_acquired", type="string", nullable=true)
     * 
     * @var string
     */
    private $valueAcquired;

    /**
     * @ORM\Column(name="descriiptionss", type="text", nullable=true)
     * 
     * @var text
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="ElectronicEquipment", inversedBy="notNewList")
     * 
     * @var ElectronicEquipment
     */
    private $electonicEquipment;

    /**
     */
    public function __construct()
    {
        
        // TODO - Insert your code here
    }
    /**
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return the $deviceId
     */
    public function getDeviceId()
    {
        return $this->deviceId;
    }

    /**
     * @return the $deviceName
     */
    public function getDeviceName()
    {
        return $this->deviceName;
    }

    /**
     * @return the $valueAcquired
     */
    public function getValueAcquired()
    {
        return $this->valueAcquired;
    }

    /**
     * @return the $description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return the $electonicEquipment
     */
    public function getElectonicEquipment()
    {
        return $this->electonicEquipment;
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
     * @param string $deviceId
     */
    public function setDeviceId($deviceId)
    {
        $this->deviceId = $deviceId;
        return $this;
    }

    /**
     * @param string $deviceName
     */
    public function setDeviceName($deviceName)
    {
        $this->deviceName = $deviceName;
        return $this;
    }

    /**
     * @param string $valueAcquired
     */
    public function setValueAcquired($valueAcquired)
    {
        $this->valueAcquired = $valueAcquired;
        return $this;
    }

    /**
     * @param \IMServices\Entity\text $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @param \IMServices\Entity\ElectronicEquipment $electonicEquipment
     */
    public function setElectonicEquipment($electonicEquipment)
    {
        $this->electonicEquipment = $electonicEquipment;
        return $this;
    }

}

