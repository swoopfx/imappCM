<?php
namespace Settings\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="commentor")
 * 
 * @author swoopfx
 *        
 */
class Commentor
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer")
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(name="commentor", type="string", nullable=false)
     * 
     * @var string
     */
    private $commentor;

    public function __construct()
    {}

    public function getId()
    {
        return $this->id;
    }

    public function getCommentor()
    {
        return $this->commentor;
    }

    public function setCommentor($com)
    {
        $this->commentor = $com;
        return $this;
    }
}

