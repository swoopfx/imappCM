<?php
namespace Users\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AgentAddress
 *
 * @ORM\Table(name="agent_address")
 * @ORM\Entity
 */
class AgentAddress
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
     * @var string @ORM\Column(name="address1", type="string", length=45, nullable=true)
     */
    private $address1;

    /**
     *
     * @var string @ORM\Column(name="address2", type="string", length=45, nullable=true)
     */
    private $address2;

    /**
     *
     * @var string @ORM\Column(name="zip_code", type="string", length=11, nullable=true)
     */
    private $zipCode;

    /**
     *
     * @var integer @ORM\Column(name="country", type="integer", nullable=true)
     */
    private $country;

    /**
     *
     * @var integer @ORM\Column(name="state", type="integer", nullable=true)
     */
    private $state;

    /**
     *
     * @var string @ORM\Column(name="email", type="string", length=45, nullable=true)
     */
    private $email;

    /**
     *
     * @var \DateTime @ORM\Column(name="date_entered", type="datetime", nullable=true)
     */
    private $dateEntered;

    /**
     *
     * @var \DateTime @ORM\Column(name="date_updated", type="datetime", nullable=true)
     */
    private $dateUpdated;

    /**
     * @ORM\ManyToOne(targetEntity="Users\Entity\InsuranceAgent")
     * @ORM\JoinColumn(name="agent_id", referencedColumnName="id")
     * 
     * @var InsuranceAgent
     */
    private $agent_id;

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
     * Set address1
     *
     * @param string $address1            
     *
     * @return AgentAddress
     */
    public function setAddress1($address1)
    {
        $this->address1 = $address1;
        
        return $this;
    }

    /**
     * Get address1
     *
     * @return string
     */
    public function getAddress1()
    {
        return $this->address1;
    }

    /**
     * Set address2
     *
     * @param string $address2            
     *
     * @return AgentAddress
     */
    public function setAddress2($address2)
    {
        $this->address2 = $address2;
        
        return $this;
    }

    /**
     * Get address2
     *
     * @return string
     */
    public function getAddress2()
    {
        return $this->address2;
        
    }

    /**
     * Set zipCode
     *
     * @param string $zipCode            
     *
     * @return AgentAddress
     */
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;
        
        return $this;
    }

    /**
     * Get zipCode
     *
     * @return string
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * Set country
     *
     * @param integer $country            
     *
     * @return AgentAddress
     */
    public function setCountry($country)
    {
        $this->country = $country;
        
        return $this;
    }

    /**
     * Get country
     *
     * @return integer
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set state
     *
     * @param integer $state            
     *
     * @return AgentAddress
     */
    public function setState($state)
    {
        $this->state = $state;
        
        return $this;
    }

    /**
     * Get state
     *
     * @return integer
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set email
     *
     * @param string $email            
     *
     * @return AgentAddress
     */
    public function setEmail($email)
    {
        $this->email = $email;
        
        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set dateEntered
     *
     * @param \DateTime $dateEntered            
     *
     * @return AgentAddress
     */
    public function setDateEntered($dateEntered)
    {
        $this->dateEntered = $dateEntered;
        
        return $this;
    }

    /**
     * Get dateEntered
     *
     * @return \DateTime
     */
    public function getDateEntered()
    {
        return $this->dateEntered;
    }

    /**
     * Set dateUpdated
     *
     * @param \DateTime $dateUpdated            
     *
     * @return AgentAddress
     */
    public function setDateUpdated($dateUpdated)
    {
        $this->dateUpdated = $dateUpdated;
        
        return $this;
    }

    /**
     * Get dateUpdated
     *
     * @return \DateTime
     */
    public function getDateUpdated()
    {
        return $this->dateUpdated;
    }

    /**
     * Set relatedAgent
     *
     * @param \All\Entity\InsuranceBrokerRegistered $relatedAgent            
     *
     * @return AgentAddress
     */
    public function setRelatedAgent(\Users\Entity\InsuranceAgent $relatedAgent = null)
    {
        $this->relatedAgent = $relatedAgent;
        
        return $this;
    }

    /**
     * Get relatedAgent
     *
     * @return \All\Entity\InsuranceBrokerRegistered
     */
    public function getRelatedAgent()
    {
        return $this->relatedAgent;
    }
}
