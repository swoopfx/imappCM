<?php
namespace Settings\Entity;


use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="building_type")
 * @author otaba
 *        
 */
class BuildingType
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * This is either residential or non residential
     * @ORM\Column(name="building_type", type="string", nullable=false)
     *
     * @var string
     */
    private $type;
    
    
    public function __construct()
    {}
    
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

