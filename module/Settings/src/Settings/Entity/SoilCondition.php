<?php
namespace Settings\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * This defines the condition of the soil
 * ROCK, GRAVEL, CLAY, SAND, FILLED
 * @ORM\Entity
 * @ORM\Table(name="soil_condition")
 * @author otaba
 *        
 */
class SoilCondition
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @ORM\Column(name="condition", type="string", nullable=false)
     * @var string
     */
    private $condition;
    
    /**
     */
    public function __construct()
    {
        
        
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function getCondition(){
        return $this->condition;
    }
    
    public function setCondition($cond){
        $this->condition = $cond;
        return $this;
    }
}

