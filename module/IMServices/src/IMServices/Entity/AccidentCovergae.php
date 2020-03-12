<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AccidentCovergae
 *
 * @ORM\Table(name="accident_coverage")
 * @ORM\Entity
 */
class AccidentCovergae
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idaccidentCovergae;

    /**
     *
     * @var string @ORM\Column(name="accident_coverage", type="string", length=100, nullable=false)
     */
    private $accedentCoverage;

    /**
     *
     * @var string @ORM\Column(name="coverage_desscription", type="text", nullable=true)
     */
    private $coverageDesscription;

    /**
     * Get idaccidentCovergae
     *
     * @return integer
     */
    public function getIdaccidentCovergae()
    {
        return $this->idaccidentCovergae;
    }

    /**
     * Set accedentCoverage
     *
     * @param string $accedentCoverage            
     *
     * @return AccidentCovergae
     */
    public function setAccedentCoverage($accedentCoverage)
    {
        $this->accedentCoverage = $accedentCoverage;
        
        return $this;
    }

    /**
     * Get accedentCoverage
     *
     * @return string
     */
    public function getAccedentCoverage()
    {
        return $this->accedentCoverage;
    }

    /**
     * Set coverageDesscription
     *
     * @param string $coverageDesscription            
     *
     * @return AccidentCovergae
     */
    public function setCoverageDesscription($coverageDesscription)
    {
        $this->coverageDesscription = $coverageDesscription;
        
        return $this;
    }

    /**
     * Get coverageDesscription
     *
     * @return string
     */
    public function getCoverageDesscription()
    {
        return $this->coverageDesscription;
    }
}
