<?php
namespace Settings\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="building_roof_type")
 * 
 * @author otaba
 *        
 */
class BuildingRoofType
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(name="roof_type", type="string", nullable=false)
     *
     * @var string
     */
    private $roofType;

    public function __construct()
    {}

    public function getId()
    {
        return $this->id;
    }

    public function getRoofType()
    {
        return $this->roofType;
    }

    public function setRoofType($type)
    {
        $this->roofType = $type;
        return $this;
    }
}

