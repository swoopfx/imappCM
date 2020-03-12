<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;
//use Settings\Entity\MachinePurchaseState;

/**
 * This is also used by mahinery breakdown , This is also as a computer all risk
 * @ORM\Entity
 * @ORM\Table(name="plant_all_risk")
 *
 * @author otaba
 *        
 */
class PlantAllRisk
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    
//     /**
//      * @ORM\Column(name="plant_name", type="string", nullable=true)
//      * @var unknown
//      */
//     private $plantName;

//     /**
//      *
//      *
//      * This defines if the plant was purchased used or new
//      * @ORM\ManyToOne(targetEntity="Settings\Entity\MachinePurchaseState")
//      *
//      * @var MachinePurchaseState
//      */
//     private $plantPurchaseState;

    /**
     * @ORM\Column(name="plant_desciption", type="text", nullable=true)
     *
     * @var text
     */
    private $plantDesciption;

    // This provides description of the plant
    
    /**
     * @ORM\Column(name="purchase_date", type="datetime", nullable=true)
     *
     * @var Datetime
     */
    private $purchaseDate;

    /**
     * text
     * @ORM\Column(name="plant_use", type="text", nullable=true)
     *
     * @var text
     */
    private $plantUse;

    // This describes the what the plant is used for
    
    /**
     * @ORM\Column(name="plant_use_duration", type="string", nullable=true)
     *
     * @var string
     */
    private $plantUseDuration;

    // This describes how often the plant is being used e.g everyday
    
    /**
     * @ORM\Column(name="last_service_date", type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $lastServiceDate;

    // This is the date of the last service
    
    /**
     * @ORM\Column(name="service_company", type="text", nullable=true)
     *
     * @var text
     */
    private $servicingCompany;

    // Tis is the details of the serviceing company
    
    /**
     * @ORM\Column(name="location_of_use", type="text", nullable=true)
     *
     * @var text
     */
    private $locationOfUse;
    
    /**
     * @ORM\Column(name="is_declaration", type="boolean", nullable=true)
     * @var boolean
     */
    private $isDeclaration;

    // This is the address of where plant is being used
    public function __construct()
    {
        
        
    }

    public function getId()
    {
        return $this->id;
    }
    
//     public function getPlantName(){
//         return $this->plantName;
//     }
    
//     public function setPlantName($name){
//         $this->plantName = $name;
//         return $this;
//     }

//     public function getPlantPurchaseState()
//     {
//         return $this->plantPurchaseState;
//     }

//     public function setPlantPurchaseState($state)
//     {
//         $this->plantPurchaseState = $state;
//         return $this;
//     }

    public function getPlantDesciption()
    {
        return $this->plantDesciption;
    }

    public function setPlantDesciption($desc)
    {
        $this->plantDesciption = $desc;
        return $this;
    }

    public function getPurchaseDate()
    {
        return $this->purchaseDate;
    }

    public function setPurchaseDate($date)
    {
        $this->purchaseDate = $date;
        return $this;
    }

    public function getPlantUse()
    {
        return $this->plantUse;
    }

    public function setPlantUse($use)
    {
        $this->plantUse = $use;
        return $this;
    }

    public function getPlantUseDuration()
    {
        return $this->plantUseDuration;
    }

    public function setPlantUseDuration($dur)
    {
        $this->plantUseDuration = $dur;
        return $this;
    }

    public function getLastServiceDate()
    {
        return $this->lastServiceDate;
    }

    public function setLastServiceDate($date)
    {
        $this->lastServiceDate = $date;
        return $this;
    }

    public function getServicingCompany()
    {
        return $this->servicingCompany;
    }

    public function setServicingCompany($com)
    {
        $this->servicingCompany = $com;
        return $this;
    }

    public function getLocationOfUse()
    {
        return $this->locationOfUse;
    }

    public function setLocationOfUse($use)
    {
        $this->locationOfUse = $use;
        return $this;
    }
    
    public function getIsDeclaration(){
        return $this->isDeclaration;
    }
}

