<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="public_liability_employee_details")
 * @author otaba
 *        
 */
class PublicLiabilityEmployeeDetails
{

   
    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    
    /**
    * @ORM\Column(name="no_of_employees", type="string", nullable=true)
    *
    * @var string
    */
    private $noOfEmployees;
    
    /**
    * @ORM\Column(name="nature_of_work", type="text", nullable=true)
    *
    * @var text
    */
    private $natureOfWork;
    
    /**
    * @ORM\Column(name="insurance_connection", type="text", nullable=true)
    *
    * @var Text
    */
    private $insuranceConnection;
    
    /**
     * @ORM\ManyToOne(targetEntity="PublicLiability", inversedBy="employeeDetails")
     * @var PublicLiability
     */
    private $publicLiability;
    
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
     * @return the $noOfEmployees
     */
    public function getNoOfEmployees()
    {
        return $this->noOfEmployees;
    }

    /**
     * @return the $natureOfWork
     */
    public function getNatureOfWork()
    {
        return $this->natureOfWork;
    }

    /**
     * @return the $insuranceConnection
     */
    public function getInsuranceConnection()
    {
        return $this->insuranceConnection;
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
     * @param string $noOfEmployees
     */
    public function setNoOfEmployees($noOfEmployees)
    {
        $this->noOfEmployees = $noOfEmployees;
        return $this;
    }

    /**
     * @param \IMServices\Entity\text $natureOfWork
     */
    public function setNatureOfWork($natureOfWork)
    {
        $this->natureOfWork = $natureOfWork;
        return $this;
    }

    /**
     * @param \IMServices\Entity\Text $insuranceConnection
     */
    public function setInsuranceConnection($insuranceConnection)
    {
        $this->insuranceConnection = $insuranceConnection;
        return $this;
    }
    /**
     * @return the $publicLiability
     */
    public function getPublicLiability()
    {
        return $this->publicLiability;
    }

    /**
     * @param \IMServices\Entity\PublicLiability $publicLiability
     */
    public function setPublicLiability($publicLiability)
    {
        $this->publicLiability = $publicLiability;
        return $this;
    }


}

