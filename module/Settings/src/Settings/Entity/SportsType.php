<?php
namespace Settings\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="sports_type")
 * 
 * @author otaba
 *        
 */
class SportsType
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(name="sport", type="string", nullable=false)
     * 
     * @var string
     */
    private $sport;

    public function __construct()
    {}

    public function getId()
    {
        return $this->id;
    }

    public function getSport()
    {
        return $this->sport;
    }

    public function setSport($sport)
    {
        $this->sport = $sport;
        return $this;
    }
}

