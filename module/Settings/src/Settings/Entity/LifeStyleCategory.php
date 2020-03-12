<?php
namespace Settings\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="lifetyle_category")
 *
 * @author otaba
 *        
 */
class LifeStyleCategory
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(name="life_style", type="string", nullable=false)
     *
     * @var string
     */
    private $lifeStyle;

    public function __construct()
    {}

    public function getId()
    {
        return $this->id;
    }

    public function getLifeStyle()
    {
        return $this->lifeStyle;
    }

    public function setLifeStyle($style)
    {
        $this->lifeStyle = $style;
        return $this;
    }
}

