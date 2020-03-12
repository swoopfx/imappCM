<?php
namespace Settings\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This is either air or sea
 * @ORM\Entity
 * @ORM\Table(name="marine_cargo_transit_mode")
 * @author otaba
 *        
 */
class MarineCargoTransitMode
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @ORM\Column(name="transit_mode", type="string", nullable=false)
     *
     * @var string
     */
    private $transitMode;
    
    
    public function __construct()
    {
        
        // TODO - Insert your code here
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function getTransitMode(){
        return $this->transitMode;
    }
    
    public function setTransitMode($mode){
         $this->transitMode = $mode;
         return $this;
    }
}

