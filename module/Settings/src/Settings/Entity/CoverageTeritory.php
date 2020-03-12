<?php
namespace Settings\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CoverageTeritory
 *
 * @ORM\Table(name="coverage_teritory")
 * @ORM\Entity
 */
class CoverageTeritory
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
     * @var string @ORM\Column(name="coverage_name", type="string", length=45, nullable=true)
     */
    private $coverageName;

    /**
     * Get idcoverageTeritory
     *
     * @return integer
     */
    public function getIdcoverageTeritory()
    {
        return $this->idcoverageTeritory;
    }

    /**
     * Set coverageName
     *
     * @param string $coverageName            
     *
     * @return CoverageTeritory
     */
    public function setCoverageName($coverageName)
    {
        $this->coverageName = $coverageName;
        
        return $this;
    }

    /**
     * Get coverageName
     *
     * @return string
     */
    public function getCoverageName()
    {
        return $this->coverageName;
    }
}
