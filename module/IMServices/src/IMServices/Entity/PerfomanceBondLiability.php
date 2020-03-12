<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;
use Settings\Entity\PerformanceBondLiabilityType;

/**
 * @ORM\Entity
 * @ORM\Table(name="perfomance_bond_liabitiy");
 *
 * @author otaba
 *        
 */
class PerfomanceBondLiability
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\PerformanceBondLiabilityType")
     * 
     * @var PerformanceBondLiabilityType
     */
    private $liabilityType;

    /**
     * @ORM\Column(name="lender_name", type="string", nullable=true)
     * 
     * @var string
     */
    private $lenderName;

    /**
     * @ORM\Column(name="repayment_amount", type="string", nullable=true)
     * 
     * @var string
     */
    private $repayAmount;

    /**
     * @ORM\Column(name="amount_owing", type="string", nullable=true)
     * 
     * @var string
     */
    private $amountOwing;

    /**
     * @ORM\ManyToOne(targetEntity="IMServices\Entity\PerformanceBond", inversedBy="bondLiability")
     * 
     * @var PerformanceBond
     */
    private $performanceBond;

    /**
     */
    public function __construct()
    {
        
        // TODO - Insert your code here
    }

    /**
     *
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     *
     * @return the $liabilityType
     */
    public function getLiabilityType()
    {
        return $this->liabilityType;
    }

    /**
     *
     * @return the $lenderName
     */
    public function getLenderName()
    {
        return $this->lenderName;
    }

    /**
     *
     * @return the $repayAmount
     */
    public function getRepayAmount()
    {
        return $this->repayAmount;
    }

    /**
     *
     * @return the $performanceBond
     */
    public function getPerformanceBond()
    {
        return $this->performanceBond;
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
     * @param \Settings\Entity\PerformanceBondLiabilityType $liabilityType            
     */
    public function setLiabilityType($liabilityType)
    {
        $this->liabilityType = $liabilityType;
        return $this;
    }

    /**
     *
     * @param string $lenderName            
     */
    public function setLenderName($lenderName)
    {
        $this->lenderName = $lenderName;
        return $this;
    }

    /**
     *
     * @param string $repayAmount            
     */
    public function setRepayAmount($repayAmount)
    {
        $this->repayAmount = $repayAmount;
        return $this;
    }

    /**
     *
     * @param \IMServices\Entity\PerformanceBond $performanceBond            
     */
    public function setPerformanceBond($performanceBond)
    {
        $this->performanceBond = $performanceBond;
        return $this;
    }
    /**
     * @return the $amountOwing
     */
    public function getAmountOwing()
    {
        return $this->amountOwing;
    }

    /**
     * @param string $amountOwing
     */
    public function setAmountOwing($amountOwing)
    {
        $this->amountOwing = $amountOwing;
        return $this;
    }

}

