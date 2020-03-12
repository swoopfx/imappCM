<?php
namespace Settings\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This is either deduction or addition
 * @ORM\Entity
 * @ORM\Table(name="account_effect")
 * 
 * @author swoopfx
 *        
 */
class AccountEffect
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * This comes as deduction or addition
     * @ORM\Column(name="effect", type="string", nullable=false)
     * 
     * @var string
     */
    private $effect;

    public function __construct()
    {}

    public function getId()
    {
        return $this->id;
    }

    public function setEffect($eff)
    {
        $this->effect = $eff;
        return $this;
    }

    public function getEffect()
    {
        return $this->effect;
    }
}

