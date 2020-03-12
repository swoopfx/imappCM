<?php
namespace Settings\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="building_wall_type")
 *
 * @author otaba
 *        
 */
class BuildingWallType
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(name="wall_type", type="string", nullable=false)
     *
     * @var string
     */
    private $wallType;

    

    public function getId()
    {
        return $this->id;
    }

    public function getWallType()
    {
        return $this->wallType;
    }

    public function setWallType($wall)
    {
        $this->wallType = $wall;
        return $this;
    }
}

