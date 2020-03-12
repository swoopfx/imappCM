<?php
namespace Claims\Entity;

use Doctrine\ORM\Mapping as ORM;
use Settings\Entity\PersonalAccidentDisabilityStatus;

/**
 * @ORM\Entity
 * @ORM\Table(name="claims_personal_accident")
 * @author otaba
 *
 */
class ClaimsPersonalAccident
{
    
    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @ORM\Column(name="accident_details", type="text", nullable=true)
     * @var string
     */
    private $accidentDetails;
    
    /**
     * This include name phone number and if possible address of the witness
     * 
     * @ORM\Column(name="witness_details", type="text", nullable=true)
     * @var string
     */
    private $witnessDetails;
    
    /**
     * @ORM\Column(name="injury_details", type="text", nullable=true)
     * @var string
     */
    private $injuryDetails;
    
    /**
     *  a doctor has examined the insured 
     * 
     * @ORM\Column(name="is_doctor", type="boolean", nullable=true)
     * @var string
     *
     * @var boolean
     */
    private $isDoctor;
    
    /**
     * Details of the doctor, including name, phone and possibly hospital name 
     * 
     * @ORM\Column(name="doctor_details", type="text", nullable=true)
     * @var string
     *
     * @var string
     */
    private $doctorDetails;
    
    /**
     * @ORM\Column(name="is_usual_doctor", type="boolean", nullable=true)
     * @var string
     */
    private $isUsualDoctor;
    
    /**
     * @ORM\Column(name="is_disabled", type="boolean", nullable=true)
     * @var string
     */
    private $isDisabled;
    
    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\PersonalAccidentDisabilityStatus")
     * Temporary or permanent
     * @var PersonalAccidentDisabilityStatus
     */
    private $disabledStatus;
    
    /**
     * @ORM\Column(name="disable_duration", type="string", nullable=true)
     * how loong have you been disabled in months 
     * @var string
     */
    private $disabledDuration;
    
    /**
     * This is the certificate issued by the hospital, of filled by them 
     * @ORM\Column(name="is_include_medical_certificate", type="boolean", nullable=true)
     * @var boolean
     */
    private $isIncludeMedicalCertificate;
    /**
     * @return number
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getAccidentDetails()
    {
        return $this->accidentDetails;
    }

    /**
     * @return string
     */
    public function getWitnessDetails()
    {
        return $this->witnessDetails;
    }

    /**
     * @return string
     */
    public function getInjuryDetails()
    {
        return $this->injuryDetails;
    }

    /**
     * @return string
     */
    public function getIsDoctor()
    {
        return $this->isDoctor;
    }

    /**
     * @return string
     */
    public function getDoctorDetails()
    {
        return $this->doctorDetails;
    }

    /**
     * @return string
     */
    public function getIsUsualDoctor()
    {
        return $this->isUsualDoctor;
    }

    /**
     * @return string
     */
    public function getIsDisabled()
    {
        return $this->isDisabled;
    }

    /**
     * @return \Settings\Entity\PersonalAccidentDisabilityStatus
     */
    public function getDisabledStatus()
    {
        return $this->disabledStatus;
    }

    /**
     * @return string
     */
    public function getDisabledDuration()
    {
        return $this->disabledDuration;
    }

    /**
     * @return boolean
     */
    public function isIsIncludeMedicalCertificate()
    {
        return $this->isIncludeMedicalCertificate;
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
     * @param string $accidentDetails
     */
    public function setAccidentDetails($accidentDetails)
    {
        $this->accidentDetails = $accidentDetails;
        return $this;
    }

    /**
     * @param string $witnessDetails
     */
    public function setWitnessDetails($witnessDetails)
    {
        $this->witnessDetails = $witnessDetails;
        return $this;
    }

    /**
     * @param string $injuryDetails
     */
    public function setInjuryDetails($injuryDetails)
    {
        $this->injuryDetails = $injuryDetails;
        return $this;
    }

    /**
     * @param string $isDoctor
     */
    public function setIsDoctor($isDoctor)
    {
        $this->isDoctor = $isDoctor;
        return $this;
    }

    /**
     * @param string $doctorDetails
     */
    public function setDoctorDetails($doctorDetails)
    {
        $this->doctorDetails = $doctorDetails;
        return $this;
    }

    /**
     * @param string $isUsualDoctor
     */
    public function setIsUsualDoctor($isUsualDoctor)
    {
        $this->isUsualDoctor = $isUsualDoctor;
        return $this;
    }

    /**
     * @param string $isDisabled
     */
    public function setIsDisabled($isDisabled)
    {
        $this->isDisabled = $isDisabled;
        return $this;
    }

    /**
     * @param \Settings\Entity\PersonalAccidentDisabilityStatus $disabledStatus
     */
    public function setDisabledStatus($disabledStatus)
    {
        $this->disabledStatus = $disabledStatus;
        return $this;
    }

    /**
     * @param string $disabledDuration
     */
    public function setDisabledDuration($disabledDuration)
    {
        $this->disabledDuration = $disabledDuration;
        return $this;
    }

    /**
     * @param boolean $isIncludeMedicalCertificate
     */
    public function setIsIncludeMedicalCertificate($isIncludeMedicalCertificate)
    {
        $this->isIncludeMedicalCertificate = $isIncludeMedicalCertificate;
        return $this;
    }

    
    
}

