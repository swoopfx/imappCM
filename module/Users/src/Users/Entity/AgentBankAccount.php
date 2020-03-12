<?php
namespace Users\Entity;

use Doctrine\ORM\Mapping as ORM;
use Settings\Entity\NigeriaBanks;

/**
 * AgentBankAccount
 *
 * @ORM\Table(name="agent_bank_account")
 * @ORM\Entity
 */
class AgentBankAccount
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
     * @var string @ORM\Column(name="bank_name", type="string", length=200, nullable=false)
     */
    /**
     *
     * @var \Settings\Entity\NigeriaBanks @ORM\ManyToOne(targetEntity="Settings\Entity\NigeriaBanks")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="bank_name", referencedColumnName="id")
     *      })
     */
    private $bankName;

    /**
     *
     * @var string @ORM\Column(name="account_name", type="string", length=200, nullable=false)
     */
    private $accountName;

    /**
     *
     * @var integer @ORM\Column(name="bank_account_no", type="integer", nullable=false)
     */
    private $bankAccountNo;

    /**
     *
     * @var string @ORM\Column(name="swift_code", type="string", length=45, nullable=true)
     */
    private $swiftCode;

    /**
     *
     * @var string @ORM\Column(name="sort_code", type="string", length=45, nullable=true)
     */
    private $sortCode;

    /**
     *
     * @var string @ORM\Column(name="bank_address", type="string", length=45, nullable=true)
     */
    private $bankAddress;

    /**
     *
     * @var integer @ORM\Column(name="paymentmode", type="integer", nullable=true)
     */
    private $paymentmode;

    /**
     *
     * @var \Users\Entity\InsuranceAgentRegistered @ORM\OneToOne(targetEntity="Users\Entity\InsuranceAgent", inversedBy="bankAccount")
     *     
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="agent_id", referencedColumnName="id")
     *      })
     */
    private $agent;

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
     * Set bankName
     *
     * @param NigeriaBanks $bankName            
     *
     * @return AgentBankAccount
     */
    public function setBankName(NigeriaBanks $bankName)
    {
        $this->bankName = $bankName;
        
        return $this;
    }

    /**
     * Get bankName
     *
     * @return NigeriaBanks
     */
    public function getBankName()
    {
        return $this->bankName;
    }

    /**
     * Set accountName
     *
     * @param string $accountName            
     *
     * @return AgentBankAccount
     */
    public function setAccountName($accountName)
    {
        $this->accountName = $accountName;
        
        return $this;
    }

    /**
     * Get accountName
     *
     * @return string
     */
    public function getAccountName()
    {
        return $this->accountName;
    }

    /**
     * Set bankAccountNo
     *
     * @param integer $bankAccountNo            
     *
     * @return AgentBankAccount
     */
    public function setBankAccountNo($bankAccountNo)
    {
        $this->bankAccountNo = $bankAccountNo;
        
        return $this;
    }

    /**
     * Get bankAccountNo
     *
     * @return integer
     */
    public function getBankAccountNo()
    {
        return $this->bankAccountNo;
    }

    /**
     * Set swiftCode
     *
     * @param string $swiftCode            
     *
     * @return AgentBankAccount
     */
    public function setSwiftCode($swiftCode)
    {
        $this->swiftCode = $swiftCode;
        
        return $this;
    }

    /**
     * Get swiftCode
     *
     * @return string
     */
    public function getSwiftCode()
    {
        return $this->swiftCode;
    }

    /**
     * Set sortCode
     *
     * @param string $sortCode            
     *
     * @return AgentBankAccount
     */
    public function setSortCode($sortCode)
    {
        $this->sortCode = $sortCode;
        
        return $this;
    }

    /**
     * Get sortCode
     *
     * @return string
     */
    public function getSortCode()
    {
        return $this->sortCode;
    }

    /**
     * Set bankAddress
     *
     * @param string $bankAddress            
     *
     * @return AgentBankAccount
     */
    public function setBankAddress($bankAddress)
    {
        $this->bankAddress = $bankAddress;
        
        return $this;
    }

    /**
     * Get bankAddress
     *
     * @return string
     */
    public function getBankAddress()
    {
        return $this->bankAddress;
    }

    /**
     * Set paymentmode
     *
     * @param integer $paymentmode            
     *
     * @return AgentBankAccount
     */
    public function setPaymentmode($paymentmode)
    {
        $this->paymentmode = $paymentmode;
        
        return $this;
    }

    /**
     * Get paymentmode
     *
     * @return integer
     */
    public function getPaymentmode()
    {
        return $this->paymentmode;
    }

    /**
     *
     * @param \Users\Entity\InsuranceAgentRegistered $agent
     *            @eturn AgentBankAccount
     */
    public function setBroker(\Users\Entity\InsuranceBrokerRegistered $agent = null)
    {
        $this->agent = $agent;
        
        return $this;
    }

    /**
     * Get broker
     *
     * @return \Users\Entity\InsuranceAgentRegistered
     */
    public function getBroker()
    {
        return $this->agent;
    }
}
