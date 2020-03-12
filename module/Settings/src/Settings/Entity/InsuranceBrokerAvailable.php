<?php
namespace Settings\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InsuranceBrokerAvailable
 * This Entity gets all the available insurance brker in the database
 * @ORM\Table(name="insurance_broker_available", uniqueConstraints={@ORM\UniqueConstraint(name="broker_name_UNIQUE", columns={"company_name"})})
 * @ORM\Entity
 */
class InsuranceBrokerAvailable
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    /**
     *
     * @var string @ORM\Column(name="rb_number", type="string", nullable=false)
     */
    private $rbNumber;

    /**
     *
     * @var string @ORM\Column(name="company_name", type="string", length=200, nullable=false)
     */
    private $companyName;

   

    
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set companyName
     *
     * @param string $companyName            
     * @return InsuranceBrokerAvailable
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;
        
        return $this;
    }

    /**
     * Get companyName
     *
     * @return string
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * Set rbNumber
     *
     * @param integer $rbNumber            
     * @return InsuranceBrokerAvailable
     */
    public function setRbNumber($rbNumber)
    {
        $this->rbNumber = $rbNumber;
        
        return $this;
    }

    /**
     * Get rbNumber
     *
     * @return integer
     */
    public function getRbNumber()
    {
        return $this->rbNumber;
    }

    /**
     * Set nameOfCeo
     *
     * @param string $nameOfCeo            
     * @return InsuranceBrokerAvailable
     */
    public function setNameOfCeo($nameOfCeo)
    {
        $this->nameOfCeo = $nameOfCeo;
        
        return $this;
    }

    /**
     * Get nameOfCeo
     *
     * @return string
     */
    public function getNameOfCeo()
    {
        return $this->nameOfCeo;
    }

    /**
     * Set rbaNumber
     *
     * @param string $rbaNumber            
     * @return InsuranceBrokerAvailable
     */
    public function setRbaNumber($rbaNumber)
    {
        $this->rbaNumber = $rbaNumber;
        
        return $this;
    }

    /**
     * Get rbaNumber
     *
     * @return string
     */
    public function getRbaNumber()
    {
        return $this->rbaNumber;
    }

    /**
     * Set registeredPhoneNumber
     *
     * @param string $registeredPhoneNumber            
     * @return InsuranceBrokerAvailable
     */
    public function setRegisteredPhoneNumber($registeredPhoneNumber)
    {
        $this->registeredPhoneNumber = $registeredPhoneNumber;
        
        return $this;
    }

    /**
     * Get registeredPhoneNumber
     *
     * @return string
     */
    public function getRegisteredPhoneNumber()
    {
        return $this->registeredPhoneNumber;
    }

    /**
     * Set dob
     *
     * @param string $dob            
     * @return InsuranceBrokerAvailable
     */
    public function setDob($dob)
    {
        $this->dob = $dob;
        
        return $this;
    }

    /**
     * Get dob
     *
     * @return string
     */
    public function getDob()
    {
        return $this->dob;
    }

    /**
     * Set year
     *
     * @param string $year            
     * @return InsuranceBrokerAvailable
     */
    public function setYear($year)
    {
        $this->year = $year;
        
        return $this;
    }

    /**
     * Get year
     *
     * @return string
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set registeredAddress
     *
     * @param string $registeredAddress            
     * @return InsuranceBrokerAvailable
     */
    public function setRegisteredAddress($registeredAddress)
    {
        $this->registeredAddress = $registeredAddress;
        
        return $this;
    }

    /**
     * Get registeredAddress
     *
     * @return string
     */
    public function getRegisteredAddress()
    {
        return $this->registeredAddress;
    }

    /**
     * Set registeredEmail
     *
     * @param string $registeredEmail            
     * @return InsuranceBrokerAvailable
     */
    public function setRegisteredEmail($registeredEmail)
    {
        $this->registeredEmail = $registeredEmail;
        
        return $this;
    }

    /**
     * Get registeredEmail
     *
     * @return string
     */
    public function getRegisteredEmail()
    {
        return $this->registeredEmail;
    }
}
