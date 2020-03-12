<?php
namespace Settings\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Options are
 * Rail
 * Road
 * Water
 * Air
 * Post
 *
 * Other
 *
 * @ORM\Entity
 * @ORM\Table(name="transport_medium")
 * 
 * @author otaba
 *        
 */
class TransportMedium
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(name="medium", type="string", nullable=false)
     * 
     * @var string
     */
    private $medium;

    /**
     */
    public function __construct()
    {}

    public function getId()
    {
        return $this->id;
    }

    public function getMedium()
    {
        return $this->medium;
    }

    public function setMedium($med)
    {
        $this->medium = $med;
        return $this;
    }
}

