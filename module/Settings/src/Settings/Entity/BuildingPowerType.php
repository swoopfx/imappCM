<?php
namespace Settings\Entity;


use Doctrine\ORM\Mapping as ORM;


/**
 * Options are 
 * CentralGrid Only
 * Deisel/Petrol Generator Only
 * CentralGrid and Deisel/Petrol Generator
 * Gas Turbine Only
 * Wind Turbine Only
 * Solar Panels Only 
 * CentralGrid and Solar Panels
 * Other Renewable Energy
 * Others 
 * 
 * @ORM\Entity
 * @ORM\Table(name="building_power_type")
 * @author otaba
 *        
 */
class BuildingPowerType
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @ORM\Column(name="power_type", type="string", nullable=false)
     * @var string
     */
    private $powerType;
    
    
    public function __construct()
    {
        
        // TODO - Insert your code here
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function getPowerType(){
        return $this->powerType;
        
    }
    
    public function setPowerType($type){
        $this->powerType = $type;
        return $this;
    }
}

