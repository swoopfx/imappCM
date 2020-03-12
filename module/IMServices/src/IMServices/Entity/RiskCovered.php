<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RiskCovered
 *
 * @ORM\Table(name="risk_covered")
 * @ORM\Entity
 */
class RiskCovered
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
     * @var string @ORM\Column(name="risk_type", type="string", length=45, nullable=true)
     */
    private $riskType;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set riskType
     *
     * @param string $riskType            
     *
     * @return RiskCovered
     */
    public function setRiskType($riskType)
    {
        $this->riskType = $riskType;
        
        return $this;
    }

    /**
     * Get riskType
     *
     * @return string
     */
    public function getRiskType()
    {
        return $this->riskType;
    }
}
