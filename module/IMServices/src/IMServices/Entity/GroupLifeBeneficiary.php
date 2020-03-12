<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="group_life_beneficiary")
 * 
 * @author otaba
 *        
 */
class GroupLifeBeneficiary
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="GroupLife", inversedBy="beneficiary")
     * 
     * @var GroupLife
     */
    private $groupLife;

    /**
     * @ORM\Column(name="employee_name", type="string", nullable=true)
     * 
     * @var string
     */
    private $employeeName;

    /**
     * @ORM\Column(name="beneficiary_name", type="string", nullable=true)
     * 
     * @var string
     */
    private $beneficiaryName;

    /**
     * @ORM\Column(name="percentage_alloted", type="string", nullable=true)
     * 
     * @var string
     */
    private $percentageAlloted;

    /**
     * @ORM\Column(name="emolument_per_annum", type="string", nullable=true)
     * 
     * @var string
     */
    private $emolumentPerAnnum;

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

    public function getGroupLife()
    {
        return $this->groupLife;
    }

    public function setGroupLife($life)
    {
        $this->groupLife = $life;
        return $this;
    }

    public function getEmployeeName()
    {
        return $this->employeeName;
    }

    public function setEmployeeName($name)
    {
        $this->employeeName = $name;
        return $this;
    }

    public function getBeneficiaryName()
    {
        return $this->beneficiaryName;
    }

    public function setBeneficiaryName($set)
    {
        $this->beneficiaryName;
        return $this;
    }

    public function getPercentageAlloted()
    {
        return $this->percentageAlloted;
    }

    public function setPercentageAlloted($lot)
    {
        $this->percentageAlloted = $lot;
        return $this;
    }
    /**
     * @return the $emolumentPerAnnum
     */
    public function getEmolumentPerAnnum()
    {
        return $this->emolumentPerAnnum;
    }

    /**
     * @param string $emolumentPerAnnum
     */
    public function setEmolumentPerAnnum($emolumentPerAnnum)
    {
        $this->emolumentPerAnnum = $emolumentPerAnnum;
        return $this;
    }

}

