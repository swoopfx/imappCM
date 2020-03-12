<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="git_vehicle_details")
 *
 * @author otaba
 *        
 */
class GITVehicleDetails
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(name="reg_no", type="string", nullable=true)
     *
     * @var string
     */
    private $regNo;
    
    
//     private $vehicleType;

    /**
     *
     * @var \Settings\Entity\MotorType @ORM\ManyToOne(targetEntity="Settings\Entity\MotorType")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="car_make", referencedColumnName="id")
     *      })
     */
    private $carMake;

    /**
     * @ORM\Column(name="other_make", type="string", nullable=true)
     *
     * @var string
     */
    private $otherMake;

    /**
     *
     * @var \Settings\Entity\MotorTypeOfBody @ORM\ManyToOne(targetEntity="Settings\Entity\MotorTypeOfBody")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="type_of_body", referencedColumnName="id")
     *      })
     */
    private $bodyType;

//     /**
//      *
//      * @var \Settings\Entity\VehicleValueType @ORM\ManyToOne(targetEntity="Settings\Entity\VehicleValueType")
//      *      @ORM\JoinColumns({
//      *      @ORM\JoinColumn(name="motor_value_type", referencedColumnName="id")
//      *      })
//      */
//     private $motorValueType;

    /**
     * @ORM\Column(name="make_year", type="datetime", nullable=true)
     *
     * @var string
     */
    private $manuYear;

    /**
     * @ORM\Column(name="max_capacity", type="string", nullable=true)
     *
     * @var string
     */
    private $maxCapacity;

//     /**
//      * @ORM\Column(name="is_cab_locked", type="boolean", nullable=true)
//      *
//      * @var string
//      */
//     private $isCabLocked;

//     /**
//      * @ORM\Column(name="is_body_locked", type="boolean", nullable=true)
//      *
//      * @var string
//      */
//     private $isBodyLocked;

//     /**
//      * @ORM\Column(name="commercial_lisence", type="string", nullable=true)
//      *
//      * @var string
//      */
//     private $commercialLisence;
    
    
    /**
     * @ORM\ManyToOne(targetEntity="IMServices\Entity\GoodsInTransit", inversedBy="vehicleDetails")
     * @var GoodsInTransit
     */
    private $git;
    /**
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
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
     * @return the $regNo
     */
    public function getRegNo()
    {
        return $this->regNo;
    }

    /**
     * @param string $regNo
     */
    public function setRegNo($regNo)
    {
        $this->regNo = $regNo;
        return $this;
    }

    /**
     * @return the $carMake
     */
    public function getCarMake()
    {
        return $this->carMake;
    }

    /**
     * @param \Settings\Entity\MotorType $carMake
     */
    public function setCarMake($carMake)
    {
        $this->carMake = $carMake;
        return $this;
    }

    /**
     * @return the $otherMake
     */
    public function getOtherMake()
    {
        return $this->otherMake;
    }

    /**
     * @param string $otherMake
     */
    public function setOtherMake($otherMake)
    {
        $this->otherMake = $otherMake;
        return $this;
    }

    /**
     * @return the $bodyType
     */
    public function getBodyType()
    {
        return $this->bodyType;
    }

    /**
     * @param \Settings\Entity\MotorTypeOfBody $bodyType
     */
    public function setBodyType($bodyType)
    {
        $this->bodyType = $bodyType;
        return $this;
    }

    /**
     * @return the $manuYear
     */
    public function getManuYear()
    {
        return $this->manuYear;
    }

    /**
     * @param string $manuYear
     */
    public function setManuYear($manuYear)
    {
        $this->manuYear = $manuYear;
        return $this;
    }
    

    /**
     * @return the $maxCapacity
     */
    public function getMaxCapacity()
    {
        return $this->maxCapacity;
    }

    /**
     * @param string $maxCapacity
     */
    public function setMaxCapacity($maxCapacity)
    {
        $this->maxCapacity = $maxCapacity;
        return $this;
    }

    /**
     * @return the $git
     */
    public function getGit()
    {
        return $this->git;
    }

    /**
     * @param \IMServices\Entity\GoodsInTransit $git
     */
    public function setGit($git)
    {
        $this->git = $git;
        return $this;
    }

    


   
}

