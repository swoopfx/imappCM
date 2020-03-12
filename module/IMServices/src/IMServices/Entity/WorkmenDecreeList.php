<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;
use Settings\Entity\EmployeeCategory;
use Settings\Entity\GroupLifeMemberClass;

/**
 * @ORM\Entity
 * @ORM\Table(name="workmen_decree_list")
 * @author otaba
 *        
 */
class WorkmenDecreeList
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\GroupLifeMemberClass")
     * 
     * @var GroupLifeMemberClass
     */
    private $employeeCategoree;

    /**
     * @ORM\Column(name="number_of_employee", type="string", nullable=true)
     * 
     * @var string
     */
    private $numberOfEmployee;

    /**
     * @ORM\Column(name="cash_compensation", type="string", nullable=true)
     * 
     * @var string
     */
    private $cashCompensation;

    /**
     * @ORM\Column(name="other_sompensation", type="string", nullable=true)
     * 
     * @var string
     */
    private $otherCompensation;

    /**
     * @ORM\Column(name="total_compensation", type="string", nullable=true)
     * 
     * @var string
     */
    private $totalCompensation;

    /**
     * @ORM\ManyToOne(targetEntity="WorkmenCompensation", inversedBy="decreeList")
     * 
     * @var WorkmenCompensation
     */
    private $workmenCopensation;

    /**
     */
    public function __construct()
    {
        
        // TODO - Insert your code here
    }
    /**
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return the $employeeCategoree
     */
    public function getEmployeeCategoree()
    {
        return $this->employeeCategoree;
    }

    /**
     * @return the $numberOfEmployee
     */
    public function getNumberOfEmployee()
    {
        return $this->numberOfEmployee;
    }

    /**
     * @return the $cashCompensation
     */
    public function getCashCompensation()
    {
        return $this->cashCompensation;
    }

    /**
     * @return the $otherCompensation
     */
    public function getOtherCompensation()
    {
        return $this->otherCompensation;
    }

    /**
     * @return the $totalCompensation
     */
    public function getTotalCompensation()
    {
        return $this->totalCompensation;
    }

    /**
     * @return the $workmenCopensation
     */
    public function getWorkmenCopensation()
    {
        return $this->workmenCopensation;
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
     * @param \Settings\Entity\EmployeeCategory $employeeCategoree
     */
    public function setEmployeeCategoree($employeeCategoree)
    {
        $this->employeeCategoree = $employeeCategoree;
        return $this;
    }
    

    /**
     * @param string $numberOfEmployee
     */
    public function setNumberOfEmployee($numberOfEmployee)
    {
        $this->numberOfEmployee = $numberOfEmployee;
        return $this;
    }

    /**
     * @param string $cashCompensation
     */
    public function setCashCompensation($cashCompensation)
    {
        $this->cashCompensation = $cashCompensation;
        return $this;
    }

    /**
     * @param string $otherCompensation
     */
    public function setOtherCompensation($otherCompensation)
    {
        $this->otherCompensation = $otherCompensation;
        return $this;
    }

    /**
     * @param string $totalCompensation
     */
    public function setTotalCompensation($totalCompensation)
    {
        $this->totalCompensation = $totalCompensation;
        return $this;
    }

    /**
     * @param \IMServices\Entity\WorkmenCompensation $workmenCopensation
     */
    public function setWorkmenCopensation($workmenCopensation)
    {
        $this->workmenCopensation = $workmenCopensation;
        return $this;
    }

}

