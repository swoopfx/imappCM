<?php
namespace Settings\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Options are 
 * Marble, Earth, Tiles, Ceramics, Concrete, Terrazo
 * @ORM\Entity
 * @ORM\Table(name="building_floor_type")
 * 
 * @author otaba
 *        
 */
class BuildingFloorType
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(name="floor_type", type="string", nullable=false)
     * 
     * @var string
     */
    private $floorType;

    public function __construct()
    {}

    public function getId()
    {
        return $this->id;
    }

    public function getFloorType()
    {
        return $this->floorType;
    }

    public function setFloorType($type)
    {
        $this->floorType = $type;
        return $this;
    }
}

