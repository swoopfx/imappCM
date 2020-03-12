<?php
namespace Settings\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * Breeding, milk, leather, other, egg, Meat
 * @ORM\Entity
 * @ORM\Table(name="farm_animal_use")
 * @author otaba
 *        
 */
class FarmAnimalUse
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @ORM\Column(name="use", type="string", nullable=true)
     * @var string
     */
    private $use;
    
    /**
     */
    public function __construct()
    {
        
        // TODO - Insert your code here
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function getUse(){
        return $this->use;
    }
    
    
    public function setUse($use){
        $this->use = $use;
        return $this;
    }
}

