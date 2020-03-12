<?php
namespace Settings\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InsuranceAgentAvailable
 *
 * @ORM\Table(name="insurance_agent_available", uniqueConstraints={@ORM\UniqueConstraint(name="broker_name_UNIQUE", columns={"company_name"})})
 * @ORM\Entity
 */
class InsuranceAgentAvailable
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
     * @var string @ORM\Column(name="company_name", type="string", length=200, nullable=false)
     */
    private $companyName;

    /**
     *
     * @var integer @ORM\Column(name="rb_number", type="integer", nullable=false)
     */
    private $rbNumber;

    /**
     *
     * @var string @ORM\Column(name="name_of_ceo", type="string", length=300, nullable=true)
     */
    private $nameOfCeo;

    /**
     *
     * @var string @ORM\Column(name="rba_number", type="string", length=45, nullable=true)
     */
    private $rbaNumber;

    /**
     *
     * @var string @ORM\Column(name="registered_phone_number", type="string", length=100, nullable=true)
     */
    private $registeredPhoneNumber;

    /**
     *
     * @var string @ORM\Column(name="dob", type="string", length=100, nullable=true)
     */
    private $dob;

    /**
     *
     * @var string @ORM\Column(name="year", type="string", length=45, nullable=true)
     */
    private $year;

    /**
     *
     * @var string @ORM\Column(name="registered_address", type="text", nullable=true)
     */
    private $registeredAddress;

    /**
     *
     * @var string @ORM\Column(name="registered_email", type="string", length=45, nullable=true)
     */
    private $registeredEmail;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set companyName
     *
     * @param string $companyName            
     *
     * @return InsuranceAgentAvailable
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
     *
     * @return InsuranceAgentAvailable
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
     *
     * @return InsuranceAgentAvailable
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
     *
     * @return InsuranceAgentAvailable
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
     *
     * @return InsuranceAgentAvailable
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
     *
     * @return InsuranceAgentAvailable
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
     *
     * @return InsuranceAgentAvailable
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
     *
     * @return InsuranceAgentAvailable
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
     *
     * @return InsuranceAgentAvailable
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
