<?php
namespace Settings\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Water
 * Foam
 * Automatic
 * CO2
 * Others
 * 
 * @ORM\Entity
 * @ORM\Table(name="fire_extinguisher")
 * @author otaba
 *        
 */
class FireExtinguisher
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @ORM\Column(name="type", type="string", nullable=false)
     * @var string
     */
    private $type;
    
    /**
     */
    public function __construct()
    {
        
        // TODO - Insert your code here
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function getType(){
        return $this->type;
    }
    
    public function setType($type){
        $this->type = $type;
        return $this;
    }
}

