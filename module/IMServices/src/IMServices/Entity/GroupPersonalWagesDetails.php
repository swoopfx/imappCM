<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;
use Settings\Entity\OccupationalCategory;

/**
 * This identifies the wages information for Group Personal Accident information
 * @ORM\Entity
 * @ORM\Table(name="group_personal_wages_details")
 *
 * @author otaba
 *        
 */
class GroupPersonalWagesDetails
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\OccupationalCategory")
     *
     * @var OccupationalCategory
     */
    private $occupation;

    /**
     * @ORM\Column(name="other_occupation", type="string", nullable=true)
     * 
     * @var string
     */
    private $otherOccupation;

    /**
     * @ORM\Column(name="number_of_employee", type="string", nullable=true)
     *
     * @var string
     */
    private $numberOfEmployee;

    /**
     * @ORM\Column(name="gross_annual_salary", type="string", nullable=true)
     *
     * @var string
     */
    private $grossAnnualSalary;

    /**
     * @ORM\Column(name="is_death", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isDeath;

    /**
     * @ORM\Column(name="is_loss_of_limbs", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isLossOfLimbs;

    /**
     * @ORM\Column(name="is_loss_of_eyes", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isLossOfEyes;

    // private
    
    /**
     * This is amount to be covered for Total temporary disablement
     * @ORM\Column(name="temporary_disable_total", type="string", nullable=true)
     * 
     * @var string
     */
    private $temporaryDisablementTotal;

    /**
     * This is the amount to be covered for permanent disablement
     * @ORM\Column(name="permanent_disablement", type="string", nullable=true)
     * 
     * @var string
     */
    private $permanentDisablement;

    /**
     * @ORM\Column(name="medical_expense_limit", type="string", nullable=true)
     * 
     * @var string
     */
    private $medicalExpenseLimit;

    /**
     * @ORM\ManyToOne(targetEntity="GroupPeronalAccident", inversedBy="wagesDetails")
     * 
     * @var GroupPeronalAccident
     */
    private $groupPersonalAccident;

    /**
     */
    public function __construct()
    {
        
        // TODO - Insert your code here
    }

    public function getId()
    {
        return $this->id;
    }

    public function getOccupation()
    {
        return $this->occupation;
    }

    public function setOccupation($set)
    {
        $this->occupation = $set;
        return $this;
    }

    public function getNumberOfEmployee()
    {
        return $this->numberOfEmployee;
    }

    public function setNumberOfEmployee($num)
    {
        $this->numberOfEmployee = $num;
        return $this;
    }

    public function getGrossAnnualSalary()
    {
        return $this->grossAnnualSalary;
    }

    public function setGrossAnnualSalary($set)
    {
        $this->grossAnnualSalary = $set;
        return $this;
    }

    public function getIsDeath()
    {
        return $this->isDeath;
    }

    public function setIsDeath($det)
    {
        $this->isDeath = $det;
        return $this;
    }

    public function getIsLossOfLimbs()
    {
        return $this->isLossOfLimbs;
    }

    public function setIsLossOfLimbs($limbs)
    {
        $this->isLossOfLimbs = $limbs;
        return $this;
    }

    public function getIsLossOfEyes()
    {
        return $this->isLossOfEyes;
    }

    public function setIsLossOfEyes($eyes)
    {
        $this->isLossOfEyes = $eyes;
        return $this;
    }

    public function getTemporaryDisablementTotal()
    {
        return $this->temporaryDisablementTotal;
    }

    public function setTemporaryDisablementTotal($temp)
    {
        $this->temporaryDisablementTotal = $temp;
        return $this;
    }

    public function getTemporaryDisablementpartial()
    {
        return $this->temporaryDisablementpartial;
    }

    public function setTemporaryDisablementpartial($temp)
    {
        $this->temporaryDisablementpartial = $temp;
        return $this;
    }

    public function getPermanentDisablement()
    {
        return $this->permanentDisablement;
    }

    public function setPermanentDisablement($ment)
    {
        $this->permanentDisablement = $ment;
        return $this;
    }

    public function getGroupPersonalAccident()
    {
        return $this->groupPersonalAccident;
    }

    public function setGroupPersonalAccident($set)
    {
        $this->groupPersonalAccident = $set;
        return $this;
    }
    /**
     * @return the $otherOccupation
     */
    public function getOtherOccupation()
    {
        return $this->otherOccupation;
    }

    /**
     * @param string $otherOccupation
     */
    public function setOtherOccupation($otherOccupation)
    {
        $this->otherOccupation = $otherOccupation;
        return $this;
    }

    /**
     * @return the $medicalExpenseLimit
     */
    public function getMedicalExpenseLimit()
    {
        return $this->medicalExpenseLimit;
    }

    /**
     * @param string $medicalExpenseLimit
     */
    public function setMedicalExpenseLimit($medicalExpenseLimit)
    {
        $this->medicalExpenseLimit = $medicalExpenseLimit;
        return $this;
    }

}

