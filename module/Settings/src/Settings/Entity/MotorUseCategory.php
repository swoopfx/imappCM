<?php
namespace Settings\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @author swoopfx
 *         @ORM\Table(name="motor_use_category")
 *         @ORM\Entity
 *        
 */
class MotorUseCategory
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
     * @var string @ORM\Column(name="motor_use_category", type="string", length=200, nullable=true)
     */
    private $useCategory;

    public function __construct()
    {}

    public function getId()
    {
        return $this->id;
    }

    public function getUseCategory()
    {
        return $this->useCategory;
    }

    public function setUseCategory($use)
    {
        $this->useCategory = $use;
        
        return $this;
    }
}

