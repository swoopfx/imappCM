<?php
namespace Settings\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This defines the broker activation type
 * Be it Commission or contrat
 * Commision Defines a 3% deduction on every transaction
 * Contract is a flat rate for defined at a specific
 * @ORM\Entity
 * @ORM\Table(name="activation_type")
 * 
 * @author otaba
 *        
 */
class ActivationType
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(name="type", type="string", nullable=false)
     */
    private $type;

    /**
     */
    public function __construct()
    {}

    public function getId()
    {
        return $this->id;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }
}

