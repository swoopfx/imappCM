<?php
namespace Settings\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="flat_rate_commision")
 * 
 * @author swoopfx
 *        
 */
class FlatRateCommision
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(name="flat_rate", type="string", nullable=false, unique=true)
     * 
     * @var string
     */
    private $flateRate;

    public function __construct()
    {}

    public function getId()
    {
        return $this->id;
    }

    public function getFlatRate()
    {
        return $this->flateRate;
    }

    public function setFlatRate($rate)
    {
        $this->flateRate = $rate;
        return $this;
    }
}

