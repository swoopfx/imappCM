<?php
namespace Policy\Entity;

use Doctrine\ORM\Mapping as ORM;
use Transactions\Entity\Invoice;
use Settings\Entity\PolicyCoverDuration;

/**
 * This class provides a model that sets a hook for policy abput to be renewed
 * pending payment by customer
 *
 * @ORM\Entity
 * @ORM\Table(name="policy_hook")
 * @author otaba
 *        
 */
class PolicyHook
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
     * @ORM\ManyToOne(targetEntity="Policy\Entity\Policy")
     * @var Policy
     */
    private $policy;

    /**
     *
     * @ORM\Column(name="hook_id", type="string", nullable=true)
     * @var string
     */
    private $hookId;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Settings\Entity\PolicyCoverDuration")
     * @var PolicyCoverDuration
     */
    private $renewDuration;

    /**
     *
     * @ORM\Column(name="policy_end_date", type="datetime", nullable=true)
     * @var \DateTime
     */
    private $policyEndDate;

    /**
     *
     * @ORM\Column(name="new_premium", type="string", nullable=true)
     * @var string
     */
    private $newPremium;

    /**
     *
     * @ORM\Column(name="reason_for_change", type="string", nullable=true)
     * @var string
     */
    private $reasonForChange;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Transactions\Entity\Invoice")
     * @var Invoice
     */
    private $invoice;

    /**
     *
     * @ORM\Column(name="created_on", type="datetime", nullable=true)
     * @var \DateTime
     */
    private $createdon;

    /**
     *
     * @ORM\Column(name="updated_on", type="datetime", nullable=true)
     * @var \DateTime
     */
    private $updateOn;

    /**
     *
     * @ORM\ManyToOne(targetEntity="PolicyHookStatus")
     * @var PolicyHookStatus
     */
    private $policyHookStatus;

    public function __construct()
    {

        // TODO - Insert your code here
    }

    /**
     *
     * @return number
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     *
     * @return \Policy\Entity\Policy
     */
    public function getPolicy()
    {
        return $this->policy;
    }

    /**
     *
     * @return string
     */
    public function getHookId()
    {
        return $this->hookId;
    }

    /**
     *
     * @return \Transactions\Entity\Invoice
     */
    public function getInvoice()
    {
        return $this->invoice;
    }

    /**
     *
     * @return \DateTime
     */
    public function getCreatedon()
    {
        return $this->createdon;
    }

    /**
     *
     * @return \DateTime
     */
    public function getUpdateOn()
    {
        return $this->updateOn;
    }

    /**
     *
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     *
     * @param \Policy\Entity\Policy $policy
     */
    public function setPolicy($policy)
    {
        $this->policy = $policy;
        return $this;
    }

    /**
     *
     * @param string $hookId
     */
    public function setHookId($hookId)
    {
        $this->hookId = $hookId;
        return $this;
    }

    /**
     *
     * @param \Transactions\Entity\Invoice $invoice
     */
    public function setInvoice($invoice)
    {
        $this->invoice = $invoice;
        return $this;
    }

    /**
     *
     * @param \DateTime $createdon
     */
    public function setCreatedon($createdon)
    {
        $this->createdon = $createdon;
        $this->updateOn = $createdon;
        return $this;
    }

    /**
     *
     * @param \DateTime $updateOn
     */
    public function setUpdateOn($updateOn)
    {
        $this->updateOn = $updateOn;
        return $this;
    }

    /**
     *
     * @return \Settings\Entity\PolicyCoverDuration
     */
    public function getRenewDuration()
    {
        return $this->renewDuration;
    }

    /**
     *
     * @return string
     */
    public function getNewPremium()
    {
        return $this->newPremium;
    }

    /**
     *
     * @return string
     */
    public function getReasonForChange()
    {
        return $this->reasonForChange;
    }

    /**
     *
     * @param \Settings\Entity\PolicyCoverDuration $renewDuration
     */
    public function setRenewDuration($renewDuration)
    {
        $this->renewDuration = $renewDuration;
        return $this;
    }

    /**
     *
     * @param string $newPremium
     */
    public function setNewPremium($newPremium)
    {
        $this->newPremium = $newPremium;
        return $this;
    }

    /**
     *
     * @param string $reasonForChange
     */
    public function setReasonForChange($reasonForChange)
    {
        $this->reasonForChange = $reasonForChange;
        return $this;
    }

    /**
     *
     * @return \DateTime
     */
    public function getPolicyEndDate()
    {
        return $this->policyEndDate;
    }

    /**
     *
     * @param \DateTime $policyEndDate
     */
    public function setPolicyEndDate($policyEndDate)
    {
        $this->policyEndDate = $policyEndDate;
        return $this;
    }
    /**
     * @return \Policy\Entity\PolicyHookStatus
     */
    public function getPolicyHookStatus()
    {
        return $this->policyHookStatus;
    }

    /**
     * @param \Policy\Entity\PolicyHookStatus $policyHookStatus
     */
    public function setPolicyHookStatus($policyHookStatus)
    {
        $this->policyHookStatus = $policyHookStatus;
        return $this;
    }

}

