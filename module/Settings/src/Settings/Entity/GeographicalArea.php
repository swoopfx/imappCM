<?php
namespace Settings\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * Options are \
 * North East
 * North West
 * North Central
 * South East
 * South West
 * South South
 * FCT
 * All 
 * 
 * @ORM\Entity
 * @ORM\Table(name="geographical_area")
 * 
 * @author otaba
 *        
 */
class GeographicalArea
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(name="area", type="string", nullable=false)
     * 
     * @var string
     */
    private $area;

    /**
     */
    public function __construct()
    {
        
        // TODO - Insert your code here
    }

    public function getId()
    {
        return $this->id;
    }

    public function getArea()
    {
        return $this->area;
    }

    public function setArea($area)
    {
        $this->area = $area;
        return $this;
    }
}

