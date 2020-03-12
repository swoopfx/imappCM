<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Settings\Entity\Insurer;
use Doctrine\Common\Collections\ArrayCollection;
use GeneralServicer\Entity\Document;

/**
 * @ORM\Entity
 * @ORM\Table(name="fidelity_gauratee")
 *
 * @author otaba
 *        
 */
class FidelityGaurantee
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * Provide a brief description of the operations in the workplace, what you do
     * @ORM\Column(name="breif_description", type="text", nullable=true)
     * 
     * @var text
     */
    private $briefDescription;

    /**
     * @ORM\Column(name="is_other_instruments", type="boolean", nullable=true)
     * @var boolean
     */
    private $isOtherInstruments;
    
    /**
     * State other instruments, articles or goods involved in your operation capable of conversion through fraud and dishonesty
     * @ORM\Column(name="other_instruments", type="text", nullable=true)
     * 
     * @var string
     */
    private $otherInstrument;

    /**
     * How long have you or the Company had been operating
     * @ORM\Column(name="operation_duration", type="string", nullable=true)
     * 
     * @var string
     */
    private $operationDuration;

    /**
     * @ORM\Column(name="is_reference_form", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isReferenceForm;

    /**
     * @ORM\Column(name="is_previous_insure", type="boolean", nullable=true),
     *
     * @var boolean
     */
    private $isPreviousInsure;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\Insurer")
     *
     * @var Insurer
     */
    private $previousInsure;

    /**
     * Has there been any loss through employee’s fraud and/or dishonesty?
     * @ORM\Column(name="is_previous_loss", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isPrevuiousLoss;

    /**
     * Number of loses made
     * @ORM\Column(name="loss_number_of_occurence", type="string", nullable=true)
     * 
     * @var string
     */
    private $lossNumberOfOccurence;

    /**
     * the maximum amount of direct loss per occurrence
     * @ORM\Column(name="max_amount_of_loss", type="string", nullable=true)
     * 
     * @var string
     */
    private $maxAmountOfLoss;

    /**
     *
     * This defines all security measure that takes place to reduce fraud
     * like comparing cashbooks with counter foil voucher and abnk statement
     * @ORM\Column(name="security_measure", type="text", nullable=true)
     *
     * @var text
     */
    private $securityMeasure;

    /**
     * This determines measure used to tackle reoccurence of such loss
     * @ORM\Column(name="previous_loss", type="text", nullable=true)
     *
     * @var text
     */
    private $previousLoss;

    /**
     * @ORM\Column(name="is_employee_power_on_acc", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isEmployeePowerOnAcc;

    /**
     * This defines the maximum amount signable by this emplaoyee
     * @ORM\Column(name="employee_max_acc_payout", type="string", nullable=true)
     *
     * @var string
     */
    private $employeeMaxAccPayout;

    /**
     * Defines a clear understanding used for system used to detect fictitious payroll
     * @ORM\Column(name="fictious_payroll", type="text", nullable=true)
     *
     * @var text
     */
    private $fictiousPayroll;

    /**
     *
     * @ORM\Column(name="balance_book_frequency", type="string", nullable=true)
     *
     * @var string
     */
    private $balanceBookFrequency;
    
    /**
     * Frequnt audit takes place
     * @ORM\Column(name="is_audit", type="boolean", nullable=true)
     * @var boolean
     */
    private $isAudit;

    /**
     * How often is audit made on account
     * @ORM\Column(name="audit_duration", type="string", nullable=true)
     *
     * @var string
     */
    private $auditDuration;

    /**
     * Auditors details
     * @ORM\Column(name="auditor", type="string", nullable=true)
     *
     * @var string
     */
    private $auditor;

    /**
     * Defines if the customer just want generated based on an unamed basis
     * If so the EmployeeFidelity List is hidden
     * @ORM\Column(name="is_unamed_basis", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isUnamedBasis;

    /**
     * Total number of staff:
     * @ORM\Column(name="unamed_total_number_of_staff", type="string", nullable=true)
     * 
     * @var string
     */
    private $unamedTotalNumberOfStaff;

    /**
     * Amount per person:
     * @ORM\Column(name="unamed_amountPer_person", type="string", nullable=true)
     * 
     * @var string
     */
    private $unamedAmountPerPerson;

    /**
     * Total amount to be guaranteed:
     * @ORM\Column(name="unamed_total_amount_gaurateed", type="string", nullable=true)
     * 
     * @var string
     */
    private $unamedTotalAmountGuarateed;

    /**
     * Aggregate amount guaranteed:
     * @ORM\Column(name="unamed_aggregated_amount_gaurateed", type="string", nullable=true)
     * 
     * @var string
     */
    private $unamedAggregatedAmountGaurateed;

    // /**
    // * This is a list of all the signed reference form of the employees
    // * @ORM\ManyToMany(targetEntity="GeneralServicer\Entity\Document")
    // * @ORM\JoinTable(name="fidelity_guaratee_referece_forms", joinColumns={
    // * @ORM\JoinColumn(name="fidelity_guaraty", referencedColumnName="id")
    // * },
    // * inverseJoinColumns={
    // * @ORM\JoinColumn(name="referenceform", referencedColumnName="id", unique=true)
    // * })
    // * @var Collection
    // */
    private $referenceForm;

    /**
     * @ORM\OneToMany(targetEntity="IMServices\Entity\FidelityGuarateeList", mappedBy="fidelityGuaratee")
     *
     * @var Collection
     */
    private $employeeFidelityList;

    /**
     */
    public function __construct()
    {
        $this->referenceForm = new ArrayCollection();
        $this->employeeFidelityList = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getIsReferenceForm()
    {
        return $this->isReferenceForm;
    }

    public function setIsReferenceForm($form)
    {
        $this->isReferenceForm = $form;
        return $this;
    }

    public function getIsPreviousInsure()
    {
        return $this->isPreviousInsure;
    }

    public function setIsPreviousInsure($ins)
    {
        $this->isPreviousInsure = $ins;
        return $this;
    }

    public function getPreviousInsure()
    {
        return $this->previousInsure;
    }

    public function setPreviousInsure($pre)
    {
        $this->previousInsure = $pre;
        return $this;
    }

    public function getPreviousLoss()
    {
        return $this->previousLoss;
    }

    public function setPreviousLoss($loss)
    {
        $this->previousLoss = $loss;
        return $this;
    }

    public function getIsEmployeePowerAcc()
    {
        return $this->isEmployeePowerOnAcc;
    }

    public function setIsEmployeePowerOnAcc($set)
    {
        $this->isEmployeePowerOnAcc = $set;
        return $this;
    }

    public function getSoloMaxAmount()
    {
        return $this->soloMaxAmount;
    }

    public function setSoloMaxAmount($max)
    {
        $this->soloMaxAmount = $max;
        return $this;
    }

    public function getJointMaxAmount()
    {
        return $this->jointMaxAmount;
    }

    public function setJointMaxAmount($joint)
    {
        $this->jointMaxAmount = $joint;
        return $this;
    }

    public function getFictiousPayroll()
    {
        return $this->fictiousPayroll;
    }

    public function setFictiousPayroll($fic)
    {
        $this->fictiousPayroll = $fic;
        return $this;
    }

    public function getSecurityMeasure()
    {
        return $this->securityMeasure;
    }

    public function setSecurityMeasure($sec)
    {
        $this->securityMeasure = $sec;
        return $this;
    }

    public function getBalanceBookFrequency()
    {
        return $this->balanceBookFrequency;
    }

    public function setBalanceBookFrequency($bal)
    {
        $this->balanceBookFrequency = $bal;
        return $this;
    }

    public function getAuditDuration()
    {
        return $this->auditDuration;
    }

    public function setAuditDuration($dur)
    {
        $this->auditDuration = $dur;
        return $this;
    }

    public function getAuditor()
    {
        return $this->auditor;
    }

    public function setAuditor($aud)
    {
        $this->auditor = $aud;
        return $this;
    }

    public function getEmployeeFidelityList()
    {
        return $this->employeeFidelityList;
    }

    /**
     *
     * @param FidelityGuarateeList $list            
     */
    public function addEmployeeFidelityList($list)
    {
        if (! $this->employeeFidelityList->contains($list)) {
            $this->employeeFidelityList->add($list);
            $list->setFidelityGuaratee($this);
        }
        return $this;
    }

    /**
     *
     * @param FidelityGuarateeList $list            
     */
    public function removeEmployeeFidelityList($list)
    {
        if ($this->employeeFidelityList->contains($list)) {
            $this->employeeFidelityList->removeElement($list);
            $list->setFidelityGuaratee(NULL);
        }
        
        return $this;
    }

    /**
     *
     * @return the $briefDescription
     */
    public function getBriefDescription()
    {
        return $this->briefDescription;
    }

    /**
     *
     * @param \IMServices\Entity\text $briefDescription            
     */
    public function setBriefDescription($briefDescription)
    {
        $this->briefDescription = $briefDescription;
        return $this;
    }

    /**
     *
     * @return the $otherInstrument
     */
    public function getOtherInstrument()
    {
        return $this->otherInstrument;
    }

    /**
     *
     * @param field_type $otherInstrument            
     */
    public function setOtherInstrument($otherInstrument)
    {
        $this->otherInstrument = $otherInstrument;
        return $this;
    }

    /**
     *
     * @return the $isPrevuiousLoss
     */
    public function getIsPrevuiousLoss()
    {
        return $this->isPrevuiousLoss;
    }

    /**
     *
     * @param boolean $isPrevuiousLoss            
     */
    public function setIsPrevuiousLoss($isPrevuiousLoss)
    {
        $this->isPrevuiousLoss = $isPrevuiousLoss;
        return $this;
    }

    /**
     *
     * @return the $employeeMaxAccPayout
     */
    public function getEmployeeMaxAccPayout()
    {
        return $this->employeeMaxAccPayout;
    }

    /**
     *
     * @param string $employeeMaxAccPayout            
     */
    public function setEmployeeMaxAccPayout($employeeMaxAccPayout)
    {
        $this->employeeMaxAccPayout = $employeeMaxAccPayout;
        return $this;
    }

    /**
     *
     * @return the $isUnamedBasis
     */
    public function getIsUnamedBasis()
    {
        return $this->isUnamedBasis;
    }

    /**
     *
     * @param boolean $isUnamedBasis            
     */
    public function setIsUnamedBasis($isUnamedBasis)
    {
        $this->isUnamedBasis = $isUnamedBasis;
        return $this;
    }

    /**
     *
     * @return the $unamedTotalNumberOfStaff
     */
    public function getUnamedTotalNumberOfStaff()
    {
        return $this->unamedTotalNumberOfStaff;
    }

    /**
     *
     * @param string $unamedTotalNumberOfStaff            
     */
    public function setUnamedTotalNumberOfStaff($unamedTotalNumberOfStaff)
    {
        $this->unamedTotalNumberOfStaff = $unamedTotalNumberOfStaff;
        return $this;
    }

    /**
     *
     * @return the $unamedAmountPerPerson
     */
    public function getUnamedAmountPerPerson()
    {
        return $this->unamedAmountPerPerson;
    }

    /**
     *
     * @param string $unamedAmountPerPerson            
     */
    public function setUnamedAmountPerPerson($unamedAmountPerPerson)
    {
        $this->unamedAmountPerPerson = $unamedAmountPerPerson;
        return $this;
    }

    /**
     *
     * @return the $unamedTotalAmountGuarateed
     */
    public function getUnamedTotalAmountGuarateed()
    {
        return $this->unamedTotalAmountGuarateed;
    }

    /**
     *
     * @param string $unamedTotalAmountGuarateed            
     */
    public function setUnamedTotalAmountGuarateed($unamedTotalAmountGuarateed)
    {
        $this->unamedTotalAmountGuarateed = $unamedTotalAmountGuarateed;
        return $this;
    }

    /**
     *
     * @return the $aggregatedAmountGaurateed
     */
    public function getAggregatedAmountGaurateed()
    {
        return $this->aggregatedAmountGaurateed;
    }

    /**
     *
     * @param string $aggregatedAmountGaurateed            
     */
    public function setAggregatedAmountGaurateed($aggregatedAmountGaurateed)
    {
        $this->aggregatedAmountGaurateed = $aggregatedAmountGaurateed;
        return $this;
    }

    /**
     *
     * @return the $referenceForm
     */
    public function getReferenceForm()
    {
        return $this->referenceForm;
    }

    /**
     *
     * @param Document $form            
     */
    public function addReferenceForm($form)
    {
        if (! $this->referenceForm->contains($form)) {
            $this->referenceForm->add($form);
        }
        return $this;
    }

    public function removeReferenceForm($form)
    {
        if ($this->referenceForm->contains($form)) {
            $this->referenceForm->removeElement($form);
        }
    }

    /**
     *
     * @param \Doctrine\Common\Collections\Collection $referenceForm            
     */
    public function setReferenceForm($referenceForm)
    {
        $this->referenceForm = $referenceForm;
        return $this;
    }

    /**
     *
     * @return the $isEmployeePowerOnAcc
     */
    public function getIsEmployeePowerOnAcc()
    {
        return $this->isEmployeePowerOnAcc;
    }

    /**
     *
     * @param \Doctrine\Common\Collections\Collection $employeeFidelityList            
     */
    public function setEmployeeFidelityList($employeeFidelityList)
    {
        $this->employeeFidelityList = $employeeFidelityList;
        return $this;
    }
    /**
     * @return the $operationDuration
     */
    public function getOperationDuration()
    {
        return $this->operationDuration;
    }

    /**
     * @return the $lossNumberOfOccurence
     */
    public function getLossNumberOfOccurence()
    {
        return $this->lossNumberOfOccurence;
    }

    /**
     * @return the $maxAmountOfLoss
     */
    public function getMaxAmountOfLoss()
    {
        return $this->maxAmountOfLoss;
    }

    /**
     * @return the $unamedAggregatedAmountGaurateed
     */
    public function getUnamedAggregatedAmountGaurateed()
    {
        return $this->unamedAggregatedAmountGaurateed;
    }

    /**
     * @param string $operationDuration
     */
    public function setOperationDuration($operationDuration)
    {
        $this->operationDuration = $operationDuration;
        return $this;
    }

    /**
     * @param string $lossNumberOfOccurence
     */
    public function setLossNumberOfOccurence($lossNumberOfOccurence)
    {
        $this->lossNumberOfOccurence = $lossNumberOfOccurence;
        return $this;
    }

    /**
     * @param string $maxAmountOfLoss
     */
    public function setMaxAmountOfLoss($maxAmountOfLoss)
    {
        $this->maxAmountOfLoss = $maxAmountOfLoss;
        return $this;
    }

    /**
     * @param string $unamedAggregatedAmountGaurateed
     */
    public function setUnamedAggregatedAmountGaurateed($unamedAggregatedAmountGaurateed)
    {
        $this->unamedAggregatedAmountGaurateed = $unamedAggregatedAmountGaurateed;
        return  $this;
    }
    /**
     * @return the $isOtherInstruments
     */
    public function getIsOtherInstruments()
    {
        return $this->isOtherInstruments;
    }

    /**
     * @param boolean $isOtherInstruments
     */
    public function setIsOtherInstruments($isOtherInstruments)
    {
        $this->isOtherInstruments = $isOtherInstruments;
    }
    /**
     * @return the $isAudit
     */
    public function getIsAudit()
    {
        return $this->isAudit;
    }

    /**
     * @param boolean $isAudit
     */
    public function setIsAudit($isAudit)
    {
        $this->isAudit = $isAudit;
        return $this;
    }



}

