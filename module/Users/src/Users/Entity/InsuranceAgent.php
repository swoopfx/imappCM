<?php
namespace Users\Entity;

use Doctrine\ORM\Mapping as ORM;
use Settings\Entity\IdentityType;
use GeneralServicer\Entity\AgentSubscription;
use CsnUser\Entity\User;

/**
 * InsuranceAgent
 *
 * @ORM\Table(name="insurance_agent")
 * @ORM\Entity
 */
class InsuranceAgent
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
     * @ORM\Column(name="agent_name", type="string", nullable=true)
     * 
     * @var string
     */
    private $agentName;

    /**
     *
     * @var string @ORM\Column(name="agent_profile", type="text", nullable=true)
     */
    private $agentProfile;

    /**
     * @ORM\Column(name="identity_number", type="string")
     * 
     * @var string
     */
    private $identificationNo;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\IdentityType")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="identity_id", referencedColumnName="id")
     *      })
     * 
     * @var IdentityType
     */
    private $identityType;

    /**
     * @ORM\Column(name="issue_date", type="date", nullable=true)
     * Identification Issuance Date
     * @var date
     */
    private $issuanceDate;

    /**
     * @ORM\Column(name="expire_date", type="date", nullable=true)
     * Identification Expiry Date 
     * @var date
     */
    private $expiryDate;

    /**
     * This is a link to the document of identification 
     * @var
     *
     */
    private $identificationDoc;

    /**
     *
     * @var \DateTime @ORM\Column(name="date_entered", type="datetime", nullable=true)
     */
    private $dateEntered;

    /**
     *
     * @var \DateTime @ORM\Column(name="date_modified", type="datetime", nullable=true)
     */
    private $dateModified;

    /**
     *
     * @var boolean @ORM\Column(name="is_agent_verified", type="boolean", nullable=true)
     */
    private $isAgentVerified;

    /**
     *
     * @var string @ORM\Column(name="agent_token", type="string", length=200, nullable=true)
     */
    private $agentToken;

    /**
     *
     * @var string @ORM\Column(name="agent_code", type="string", length=100, nullable=false)
     */
    private $agentCode;

    /**
     *
     * @var \CsnUser\Entity\User @ORM\ManyToOne(targetEntity="CsnUser\Entity\User")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *      })
     */
    private $user;

    /**
     *
     * This is a one to one Bidirectional mapping to the agents account
     * 
     * @var \Users\Entity\AgentBankAccount @ORM\OneToOne(targetEntity="Users\Entity\AgentBankAccount")
     */
    private $bankAccount;

    /**
     * @ORM\OneToOne(targetEntity="GeneralServicer\Entity\AgentSubscription")
     * 
     * @var AgentSubscription
     */
    private $subscription;

    /**
     * @ORM\Column(name="is_verified", type="boolean")
     * 
     * @var boolean
     */
    private $isVerified;
    
    /**
     * Pick idea from the Csn User my friends
     *  and friends with me 
     * @var unknown
     */
    private $agentGroup;
    
   

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
     * Set companyLogo
     *
     * @param string $companyLogo            
     *
     * @return InsuranceAgentRegistered
     */
    public function setCompanyLogo($companyLogo)
    {
        $this->companyLogo = $companyLogo;
        
        return $this;
    }

    /**
     * Get companyLogo
     *
     * @return string
     */
    public function getCompanyLogo()
    {
        return $this->companyLogo;
    }

    /**
     * Set agentProfile
     *
     * @param string $agentProfile            
     *
     * @return InsuranceAgentRegistered
     */
    public function setAgentProfile($agentProfile)
    {
        $this->agentProfile = $agentProfile;
        
        return $this;
    }

    /**
     * Get agentProfile
     *
     * @return string
     */
    public function getAgentProfile()
    {
        return $this->agentProfile;
    }

    /**
     * Set dateEntered
     *
     * @param \DateTime $dateEntered            
     *
     * @return InsuranceAgentRegistered
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
     * Set dateModified
     *
     * @param \DateTime $dateModified            
     *
     * @return InsuranceAgentRegistered
     */
    public function setDateModified($dateModified)
    {
        $this->dateModified = $dateModified;
        
        return $this;
    }

    /**
     * Get dateModified
     *
     * @return \DateTime
     */
    public function getDateModified()
    {
        return $this->dateModified;
    }

    /**
     * Set isAgentVerified
     *
     * @param boolean $isAgentVerified            
     *
     * @return InsuranceAgentRegistered
     */
    public function setIsAgentVerified($isAgentVerified)
    {
        $this->isAgentVerified = $isAgentVerified;
        
        return $this;
    }

    /**
     * Get isAgentVerified
     *
     * @return boolean
     */
    public function getIsAgentVerified()
    {
        return $this->isAgentVerified;
    }

    /**
     * Set agentToken
     *
     * @param string $agentToken            
     *
     * @return InsuranceAgentRegistered
     */
    public function setAgentToken($agentToken)
    {
        $this->agentToken = $agentToken;
        
        return $this;
    }

    /**
     * Get agentToken
     *
     * @return string
     */
    public function getAgentToken()
    {
        return $this->agentToken;
    }

    /**
     * Set agentCode
     *
     * @param string $agentCode            
     *
     * @return InsuranceAgentRegistered
     */
    public function setAgentCode($agentCode)
    {
        $this->agentCode = $agentCode;
        
        return $this;
    }

    /**
     * Get agentCode
     *
     * @return string
     */
    public function getAgentCode()
    {
        return $this->agentCode;
    }

    /**
     * Set user
     *
     * @param \All\Entity\User $user            
     *
     * @return InsuranceAgentRegistered
     */
    public function setUser(User $user = null)
    {
        $this->user = $user;
        
        return $this;
    }

    /**
     * Get user
     *
     * @return \All\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set idAgent
     *
     * @param \All\Entity\InsuranceBrokerAvailable $idAgent            
     *
     * @return InsuranceAgentRegistered
     */
    public function setIdAgent(\Settings\Entity\InsuranceBrokerAvailable $idAgent = null)
    {
        $this->idAgent = $idAgent;
        
        return $this;
    }

    /**
     * Get idAgent
     *
     * @return \All\Entity\InsuranceBrokerAvailable
     */
    public function getIdAgent()
    {
        return $this->idAgent;
    }
}
