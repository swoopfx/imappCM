<?php
namespace Settings\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Entity
 * @ORM\Table(name="cover_duration")
 * 
 * @author otaba
 *        
 */
class CoverDuration
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(name="duration", type="string",  nullable=false)
     * @var string
     */
    private $duration;

    public function __construct()
    {}

    public function getId()
    {
        return $this->id;
    }

    public function getDuration()
    {
        return $this->duration;
    }

    public function setDuration($dur)
    {
        $this->duration = $dur;
        return $this;
    }
}

