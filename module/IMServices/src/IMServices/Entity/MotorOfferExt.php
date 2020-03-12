<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MotorOfferExt
 *
 * @ORM\Table(name="motor_offer_ext")
 * @ORM\Entity
 */
class MotorOfferExt
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
     * @var string @ORM\Column(name="functions", type="text", nullable=true)
     */
    private $functions;

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
     * Set functions
     *
     * @param string $functions            
     *
     * @return MotorOfferExt
     */
    public function setFunctions($functions)
    {
        $this->functions = $functions;
        
        return $this;
    }

    /**
     * Get functions
     *
     * @return string
     */
    public function getFunctions()
    {
        return $this->functions;
    }
}
