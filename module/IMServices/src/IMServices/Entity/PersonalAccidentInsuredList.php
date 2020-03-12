<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="personal_accident_insured_list")
 * @author otaba
 *        
 */
class PersonalAccidentInsuredList
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(name="insured_name", type="string", nullable=true)
     * 
     * @var string
     */
    private $insuredName;

    /**
     * @ORM\Column(name="dob", type="string", nullable=true)
     * 
     * @var string
     */
    private $dob;

    /**
     * @ORM\Column(name="occupation", type="string", nullable=true)
     * 
     * @var string
     */
    private $occupation;

    /**
     * @ORM\Column(name="death_compensation", type="string", nullable=true)
     * 
     * @var string
     */
    private $deathCompensation;

    /**
     * This is a permanent diability compansation
     * @ORM\Column(name="disability_p_compensation", type="string", nullable=true)
     * 
     * @var string
     */
    private $disabilityPCompensation;

    /**
     * This is compensation for temporary disability
     * @ORM\Column(name="disability_t_compensation", type="string", nullable=true)
     * 
     * @var string
     */
    private $disabilityTCompensation;

    /**
     * This is compensation for medical related issues
     * @ORM\Column(name="medical_compensation", type="string", nullable=true)
     * 
     * @var string
     */
    private $medicalCompensation;

    /**
     * @ORM\ManyToOne(targetEntity="personalAccident", inversedBy="insuredList")
     * 
     * @var PersonalAccident
     */
    private $personalAccident;

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
     * @return the $insuredName
     */
    public function getInsuredName()
    {
        return $this->insuredName;
    }

    /**
     * @param string $insuredName
     */
    public function setInsuredName($insuredName)
    {
        $this->insuredName = $insuredName;
        return $this;
    }

    /**
     * @return the $dob
     */
    public function getDob()
    {
        return $this->dob;
    }

    /**
     * @param string $dob
     */
    public function setDob($dob)
    {
        $this->dob = $dob;
        return $this;
    }

    /**
     * @return the $occupation
     */
    public function getOccupation()
    {
        return $this->occupation;
    }

    /**
     * @param string $occupation
     */
    public function setOccupation($occupation)
    {
        $this->occupation = $occupation;
        return $this;
    }

    /**
     * @return the $deathCompensation
     */
    public function getDeathCompensation()
    {
        return $this->deathCompensation;
    }

    /**
     * @param string $deathCompensation
     */
    public function setDeathCompensation($deathCompensation)
    {
        $this->deathCompensation = $deathCompensation;
        return $this;
    }

    /**
     * @return the $disabilityPCompensation
     */
    public function getDisabilityPCompensation()
    {
        return $this->disabilityPCompensation;
    }

    /**
     * @param string $disabilityPCompensation
     */
    public function setDisabilityPCompensation($disabilityPCompensation)
    {
        $this->disabilityPCompensation = $disabilityPCompensation;
        return $this;
    }

    /**
     * @return the $disabilityTCompensation
     */
    public function getDisabilityTCompensation()
    {
        return $this->disabilityTCompensation;
    }

    /**
     * @param string $disabilityTCompensation
     */
    public function setDisabilityTCompensation($disabilityTCompensation)
    {
        $this->disabilityTCompensation = $disabilityTCompensation;
        return $this;
    }

    /**
     * @return the $medicalCompensation
     */
    public function getMedicalCompensation()
    {
        return $this->medicalCompensation;
    }

    /**
     * @param string $medicalCompensation
     */
    public function setMedicalCompensation($medicalCompensation)
    {
        $this->medicalCompensation = $medicalCompensation;
        return $this;
    }

    /**
     * @return the $personalAccident
     */
    public function getPersonalAccident()
    {
        return $this->personalAccident;
    }

    /**
     * @param \IMServices\Entity\PersonalAccident $personalAccident
     */
    public function setPersonalAccident($personalAccident)
    {
        $this->personalAccident = $personalAccident;
        return $this;
    }

}

