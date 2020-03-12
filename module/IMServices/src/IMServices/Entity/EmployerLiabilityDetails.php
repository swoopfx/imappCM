<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="employer_liability_details")
 *
 * @author otaba
 *        
 */
class EmployerLiabilityDetails
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(name="employee_description", type="string", nullable=true)
     *
     * @var string
     */
    private $employeeDescription;

    /**
     * @ORM\Column(name="numbers_of_employee", type="string", nullable=true)
     *
     * @var string
     */
    private $numbersOfEmployee;

    /**
     * @ORM\Column(name="estimated_period_wage", type="string", nullable=true)
     *
     * @var string
     */
    private $estimatedPeriodWage;

    /**
     * @ORM\ManyToOne(targetEntity="IMServices\Entity\EmployerLiability", inversedBy="employeeDetails")
     *
     * @var EmployerLiability
     */
    private $employerLiability;

    /**
     */
    public function __construct()
    {}

    public function getId()
    {
        return $this->id;
    }

    public function getEmployeeDescription()
    {
        return $this->employeeDescription;
    }

    public function setEmployeeDescription($emp)
    {
        $this->employeeDescription = $emp;
        return $this;
    }

    public function getEstimatedPeriodWage()
    {
        return $this->estimatedPeriodWage;
    }

    public function setEstimatedPeriodWage($set)
    {
        $this->estimatedPeriodWage = $set;
        return $this;
    }

    public function getEmployerLiability()
    {
        return $this->employerLiability;
    }

    public function setEmployerLiability($emp)
    {
        $this->employerLiability = $emp;
        return $this;
    }
    /**
     * @return the $numbersOfEmployee
     */
    public function getNumbersOfEmployee()
    {
        return $this->numbersOfEmployee;
    }

    /**
     * @param string $numbersOfEmployee
     */
    public function setNumbersOfEmployee($numbersOfEmployee)
    {
        $this->numbersOfEmployee = $numbersOfEmployee;
        return $this;
    }

}

