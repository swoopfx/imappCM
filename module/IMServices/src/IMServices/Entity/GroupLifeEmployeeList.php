<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="group_life_employee_list")
 * @author otaba
 *        
 */
class GroupLifeEmployeeList
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(name="employee_name", type="string", nullable=true)
     *
     * @var string
     */
    private $employeeName;

    /**
     * total Annual Emolument
     * @ORM\Column(name="annual_emolument", type="string", nullable=true)
     *
     * @var string
     */
    private $annualEmolument;

    /**
     *
     * @ORM\Column(name="life_assurance_benefit", type="string", nullable=true)
     *
     * @var string
     */
    private $lifeAssuranceBenefit;

    /**
     * @ORM\Column(name="beneficiary", type="string", nullable=true)
     *
     * @var string
     */
    private $beneficiary;

    /**
     * @ORM\ManyToOne(targetEntity="GroupLife", inversedBy="groupLifeEmployeeList")
     *
     * @var GroupLife
     */
    private $groupLife;

    public function __construct()
    {}

    /**
     *
     * @return the $employeeName
     */
    public function getEmployeeName()
    {
        return $this->employeeName;
    }

    /**
     *
     * @return the $annualEmolument
     */
    public function getAnnualEmolument()
    {
        return $this->annualEmolument;
    }

    /**
     *
     * @return the $lifeAssuranceBenefit
     */
    public function getLifeAssuranceBenefit()
    {
        return $this->lifeAssuranceBenefit;
    }

    /**
     *
     * @return the $beneficiary
     */
    public function getBeneficiary()
    {
        return $this->beneficiary;
    }

    /**
     *
     * @return the $groupLife
     */
    public function getGroupLife()
    {
        return $this->groupLife;
    }

    /**
     *
     * @param string $employeeName            
     */
    public function setEmployeeName($employeeName)
    {
        $this->employeeName = $employeeName;
        return $this;
    }

    /**
     *
     * @param string $annualEmolument            
     */
    public function setAnnualEmolument($annualEmolument)
    {
        $this->annualEmolument = $annualEmolument;
        return $this;
    }

    /**
     *
     * @param string $lifeAssuranceBenefit            
     */
    public function setLifeAssuranceBenefit($lifeAssuranceBenefit)
    {
        $this->lifeAssuranceBenefit = $lifeAssuranceBenefit;
        return $this;
    }

    /**
     *
     * @param string $beneficiary            
     */
    public function setBeneficiary($beneficiary)
    {
        $this->beneficiary = $beneficiary;
        return $this;
    }

    /**
     *
     * @param \IMServices\Entity\GroupLife $groupLife            
     */
    public function setGroupLife($groupLife)
    {
        $this->groupLife = $groupLife;
        return $this;
    }
}

