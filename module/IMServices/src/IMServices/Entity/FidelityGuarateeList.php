<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fidelity_guarantee_list")
 * This is the list of employee for the fidelity gauraty
 * 
 * @author otaba
 *        
 */
class FidelityGuarateeList
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(name="employee_fullname", type="string", nullable=true)
     *
     * @var string
     */
    private $employyefullName;

    // /**
    // * @ORM\Column(name="employee_lastname", type="string", nullable=true)
    // * @var string
    // */
    // private $employeeLastname;
    
    // /**
    // * @ORM\Column(name="employee_firstname", type="string", nullable=true)
    // * @var string
    // */
    // private $employeeFirstname;
    
    /**
     * This is otherwise known as Designation
     * @ORM\Column(name="employee_capacity", type="string", nullable=true)
     *
     * @var string
     */
    private $employeeCapacity;

    /**
     * @ORM\Column(name="employee_guaratee_amount", type="string", nullable=true)
     *
     * @var string
     */
    private $employeeGuarateeAmount;

    /**
     * @ORM\Column(name="years_in_service", type="string", nullable=true)
     *
     * @var string
     */
    private $yearsdOfService;

    /**
     *
     * @ORM\Column(name="employee_salary", type="string", nullable=true)
     *
     * @var string
     *
     */
    private $employeeSalary;

    /**
     * @ORM\ManyToOne(targetEntity="IMServices\Entity\FidelityGaurantee", inversedBy="employeeFidelityList")
     *
     * @var FidelityGaurantee
     */
    private $fidelityGuaratee;

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

    public function getFidelityGuaratee()
    {
        return $this->fidelityGuaratee;
    }

    public function setFidelityGuaratee($set)
    {
        $this->fidelityGuaratee = $set;
        return $this;
    }

    /**
     *
     * @return the $employyefullName
     */
    public function getEmployyefullName()
    {
        return $this->employyefullName;
    }

    /**
     *
     * @param string $employyefullName            
     */
    public function setEmployyefullName($employyefullName)
    {
        $this->employyefullName = $employyefullName;
        return $this;
    }

    // public function getEmployeeLastname(){
    // return $this->employeeLastname;
    // }
    
    // public function setEmployeeLastname($name){
    // $this->employeeLastname = $name;
    // return $this;
    // }
    
    // public function getEmployeeFirstname(){
    // return $this->employeeFirstname;
    // }
    
    // public function setEmployeeFirstname($name){
    // $this->employeeFirstname = $name;
    // return $this;
    // }
    public function getEmployeeCapacity()
    {
        return $this->employeeCapacity;
    }

    public function setEmployeeCapacity($cap)
    {
        $this->employeeCapacity = $cap;
        return $this;
    }

    public function getEmployeeGuarateeAmount()
    {
        return $this->employeeGuarateeAmount;
    }

    public function setEmployeeGuarateeAmount($amount)
    {
        $this->employeeGuarateeAmount = $amount;
        return $this;
    }

    public function getYearsdOfService()
    {
        return $this->yearsdOfService;
    }

    public function setYearsdOfService($years)
    {
        $this->yearsdOfService = $years;
        return $this;
    }

    public function getEmployeeSalary()
    {
        return $this->employeeSalary;
    }

    public function setEmployeeSalary($em)
    {
        $this->employeeSalary = $em;
        return $this;
    }
}

