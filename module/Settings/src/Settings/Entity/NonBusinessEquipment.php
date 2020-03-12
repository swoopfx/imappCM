<?php
namespace Settings\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="non_business_equipment")
 * @author otaba
 *        
 */
class NonBusinessEquipment
{
    
    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
     /**
     *
     * Electrical Equipments
     * Non Electrical Equipments
     * @ORM\Column(name="equipments", type="string", nullable=false)
     * 
     * @var string
     */
    private $equipments;

    /**
     */
    public function __construct()
    {}
    
    public function getId(){
        return $this->id;
    }
    
    public function getEquipments(){
        return $this->equipments;
    }
    
    public function setEquipments($eq){
        $this->equipments = $eq;
        return $this;
    }
}

