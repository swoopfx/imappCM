<?php
namespace Settings\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * These are
 * Mortgages/Secured Home Loan
 * Unsecured Loans / Personal Loans
 * Lease / Hire Purchase
 * Credit / Store Card
 * Tax Liabilities
 * Lawsuites
 * Product Warranty
 * Others
 *
 * @ORM\Entity
 * @ORM\Table(name="performance_bond_liability_type")
 * 
 * @author otaba
 *        
 */
class PerformanceBondLiabilityType
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(name="lia_type", type="string", nullable=true)
     * 
     * @var string
     */
    private $type;

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
     * @return the $type
     */
    public function getType()
    {
        return $this->type;
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
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

}

