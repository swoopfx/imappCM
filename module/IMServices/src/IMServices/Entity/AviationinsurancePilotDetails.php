<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="aviation_insurance_pilot_details")
 * 
 * @author otaba
 *        
 */
class AviationinsurancePilotDetails
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(name="pilot_name", type="string", nullable=true)
     * 
     * @var string
     */
    private $pilotName;

    /**
     * @ORM\Column(name="pilot_dob", type="datetime", nullable=true)
     * 
     * @var \DateTime
     */
    private $pilotDOb;

    /**
     * @ORM\Column(name="flying_hours", type="string", nullable=true)
     * 
     * @var string
     */
    private $flyingHours;

    /**
     * @ORM\Column(name="licence_number", type="string", nullable=true)
     * 
     * @var string
     */
    private $licenceNumber;

    /**
     * @ORM\Column(name="is_previous_accident", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isPreviousAccident;

    /**
     * @ORM\ManyToOne(targetEntity="AviationInsurance", inversedBy="pilotDetails")
     * 
     * @var AviationInsurance
     */
    private $aviationInsurance;

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
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return the $pilotName
     */
    public function getPilotName()
    {
        return $this->pilotName;
    }

    /**
     * @param string $pilotName
     */
    public function setPilotName($pilotName)
    {
        $this->pilotName = $pilotName;
        return $this;
    }

    /**
     * @return the $pilotDOb
     */
    public function getPilotDOb()
    {
        return $this->pilotDOb;
    }

    /**
     * @param DateTime $pilotDOb
     */
    public function setPilotDOb($pilotDOb)
    {
        $this->pilotDOb = $pilotDOb;
        return $this;
    }

    /**
     * @return the $flyingHours
     */
    public function getFlyingHours()
    {
        return $this->flyingHours;
    }

    /**
     * @param string $flyingHours
     */
    public function setFlyingHours($flyingHours)
    {
        $this->flyingHours = $flyingHours;
        return $this;
    }

    /**
     * @return the $licenceNumber
     */
    public function getLicenceNumber()
    {
        return $this->licenceNumber;
    }

    /**
     * @param string $licenceNumber
     */
    public function setLicenceNumber($licenceNumber)
    {
        $this->licenceNumber = $licenceNumber;
        return $this;
    }

    /**
     * @return the $isPreviousAccident
     */
    public function getIsPreviousAccident()
    {
        return $this->isPreviousAccident;
    }

    /**
     * @param boolean $isPreviousAccident
     */
    public function setIsPreviousAccident($isPreviousAccident)
    {
        $this->isPreviousAccident = $isPreviousAccident;
        return $this;
    }

    /**
     * @return the $aviationInsurance
     */
    public function getAviationInsurance()
    {
        return $this->aviationInsurance;
    }

    /**
     * @param \IMServices\Entity\AviationInsurance $aviationInsurance
     */
    public function setAviationInsurance($aviationInsurance)
    {
        $this->aviationInsurance = $aviationInsurance;
        return $this;
    }

}

