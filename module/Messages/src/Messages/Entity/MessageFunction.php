<?php
namespace Messages\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="message_function")
 * 
 * @author otaba
 *        
 */
class MessageFunction
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * This is either sender or recipient
     *
     * @ORM\Column(name="function", type="string", nullable=false)
     * 
     * @var string
     */
    private $function;

    /**
     */
    public function __construct()
    {}

    public function getId()
    {
        return $this->id;
    }

    public function getFunction()
    {
        return $this->function;
    }

    public function setFunction($func)
    {
        $this->function = $func;
        return $this;
    }
}

