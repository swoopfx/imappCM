<?php
namespace Claims\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use GeneralServicer\Entity\Document;

/**
 *
 * @ORM\Entity
 * @ORM\Table(name="claims_cash_in_transit")
 * @author otaba
 *        
 */
class ClaimsCashInTransit
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
     * @ORM\Column(name="loss_date", type="datetime", nullable=true)
     * @var \Datetime
     */
    private $lossDate;

    /**
     *
     * @ORM\Column(name="loss_by_whom", type="string", nullable=true)
     * @var string
     */
    private $lossByWhom;

    /**
     * This siginifies the fact that the person placing this claims
     * has accepted the fact and attested to some facts
     *
     * @ORM\Column(name="is_attested", type="boolean", nullable=true)
     * @var boolean
     */
    private $isAttested;

    /**
     * Defines if the police has been contacted
     *
     * @ORM\Column(name="is_police", type="boolean", nullable=true)
     * @var boolean
     */
    private $isPolice;

    /**
     *
     * @ORM\Column(name="police_contact_date", type="datetime", nullable=true)
     * @var \Datetime
     */
    private $policeContactDate;

    /**
     *
     * @ORM\Column(name="is_police_report", type="boolean", nullable=true)
     * @var boolean
     */
    private $isPoliceReport;

    /**
     *
     * @ORM\Column(name="police_station", type="string", nullable=true)
     * @var string
     */
    private $policeStation;

    /**
     * This is a detail process of recovery made for the missing cash
     *
     * @ORM\Column(name="recovery_step", type="text", nullable=true)
     * @var string
     */
    private $recoveryStep;

    /**
     *
     * @ORM\OneToMany(targetEntity="Claims\Entity\ClaimLossList", mappedBy="claimsCashInTransit")
     * @var Collection
     */
    private $listLoss;

    /**
     *
     * @ORM\Column(name="employee_in_charge", type="string", nullable=true)
     * @var string
     */
    private $employeeInCharge;

    /**
     *
     * @ORM\Column(name="employee_service_year", type="integer", nullable=true)
     * @var integer
     */
    private $employeeServiceYears;

    /**
     *
     * @ORM\Column(name="is_employee_in_service", type="boolean", nullable=true)
     * @var \DateTime
     */
    private $isEmployeeInService;

    /**
     * Annual salary of employee
     * @ORM\Column(name="employee_salary", type="string", nullable=true)
     * @var integer
     */
    private $employeeSalary;

    /**
     * This defines if the employee has been in a previous loss
     *
     * @ORM\Column(name="is_employee_previous_loss", type="boolean", nullable=true)
     * @var boolean
     */
    private $isEmployeeInPreviousLoss;

    /**
     *
     * @ORM\Column(name="reason_doubt_employee_integrity", type="text", nullable=true)
     * @var string
     */
    private $reasonDoubtEmployeeIntegrity;

    /**
     *
     * @ORM\OneToOne(targetEntity="Claims\Entity\CLaims",  cascade={"persist", "remove"})
     *
     * @var Claims;
     */
    private $claims;

    public function __construct()
    {
        $this->listLoss = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getLossDate()
    {
        return $this->lossDate;
    }

    public function setLossDate($date)
    {
        $this->lossDate = $date;
        return $this;
    }

    public function getLossByWhom()
    {
        return $this->lossByWhom;
    }

    public function setLossByWhom($whom)
    {
        $this->lossByWhom = $whom;
        return $this;
    }

    public function getIsAttested()
    {
        return $this->isAttested;
    }

    public function setIsAttested($att)
    {
        $this->isAttested = $att;
        return $this;
    }

    public function getPoliceContactDate()
    {
        return $this->policeContactDate;
    }

    public function setPoliceContactDate($date)
    {
        $this->policeContactDate = $date;
        return $this;
    }

    public function getPoliceStation()
    {
        return $this->policeStation;
    }

    public function setPoliceStation($tion)
    {
        $this->policeStation = $tion;
        return $this;
    }

    public function getPoliceReport()
    {
        return $this->policeReport;
    }

    public function setPoliceReport($rep)
    {
        $this->policeReport = $rep;
        return $this;
    }

    public function getRecoveryStep()
    {
        return $this->recoveryStep;
    }

    public function setRecoveryStep($step)
    {
        $this->recoveryStep = $step;
        return $this;
    }

    public function getListLoss()
    {
        return $this->listLoss;
    }

    public function setListLoss($loss)
    {
        $this->listLoss = $loss;
        return $this;
    }

    /**
     *
     * @param ClaimLossList $loss
     */
    public function addListLoss($loss)
    {
        if (! $this->listLoss->contains($loss)) {
            $this->listLoss->add($loss);
            $loss->setClaimsCashInTransit($this);
        }
        return $this;
    }

    /**
     *
     * @param ClaimLossList $loss
     */
    public function removeListLoss($loss)
    {
        if ($this->listLoss->contains($loss)) {
            $this->listLoss->removeElement($loss);
            $loss->setClaimsCashInTransit(NULL);
        }
    }

    public function getEmployeeInCharge()
    {
        return $this->employeeInCharge;
    }

    public function setEmployeeInCharge($em)
    {
        $this->mployeeInCharge = $em;
        return $this;
    }

    public function getEmployeeServiceYears()
    {
        return $this->employeeServiceYears;
    }

    public function setEmployeeServiceYears($year)
    {
        $this->employeeServiceYears = $year;
        return $this;
    }

    public function getIsEmployeeInService()
    {
        return $this->isEmployeeInService;
    }

    public function setIsEmployeeInService($is)
    {
        $this->isEmployeeInService = $is;
        return $this;
    }

    public function getEsEmployeeInService()
    {
        return $this->employeeSalary;
    }

    public function setEmployeeSalary($em)
    {
        $this->employeeSalary = $em;
        return $this;
    }

    public function getIsEmployeeInPreviousLoss()
    {
        return $this->isEmployeeInPreviousLoss;
    }

    public function setIsEmployeeInPreviousLoss($prev)
    {
        $this->isEmployeeInPreviousLoss = $prev;
        return $this;
    }

    public function getReasonDoubtEmployeeIntegrity()
    {
        return $this->reasonDoubtEmployeeIntegrity;
    }

    public function setReasonDoubtEmployeeIntegrity($rea)
    {
        return $this->reasonDoubtEmployeeIntegrity;
    }

    public function getClaims()
    {
        return $this->claims;
    }

    public function setClaims($claim)
    {
        $this->claims = $claim;
        return $this;
    }
    /**
     * @return number
     */
    public function getEmployeeSalary()
    {
        return $this->employeeSalary;
    }

//     /**
//      * @return boolean
//      */
//     public function isIsEmployeeInPreviousLoss()
//     {
//         return $this->isEmployeeInPreviousLoss;
//     }
    
    
    public function getIsPolice(){
        return $this->isPolice;
    }

    /**
     * @param boolean $isPolice
     */
    public function setIsPolice($isPolice)
    {
        $this->isPolice = $isPolice;
    }
    
    public function getIsPoliceReport(){
        return $this->isPoliceReport;
    }

    /**
     * @param boolean $isPoliceReport
     */
    public function setIsPoliceReport($isPoliceReport)
    {
        $this->isPoliceReport = $isPoliceReport;
        return $this;
    }

}

