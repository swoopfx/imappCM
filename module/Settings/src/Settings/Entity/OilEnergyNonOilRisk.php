<?php
namespace Settings\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="oil_energy_non_oil_risk")
 * @author otaba
 *        
 */
class OilEnergyNonOilRisk
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @ORM\Column(name="risk", type="string", nullable=true)
     * @var string
     */
    private $risk;
    
    /**
     */
    public function __construct()
    {
        
        
    }
    /**
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return the $risk
     */
    public function getRisk()
    {
        return $this->risk;
    }

    /**
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param string $risk
     */
    public function setRisk($risk)
    {
        $this->risk = $risk;
        return $this;
    }

    
    
}

