<?php
namespace Settings\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="business_equipments")
 * 
 * @author otaba
 *        
 */
class BusinessEquipments
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * Industrial Equipments
     * Medical Equipments
     * Agricultural Equipments
     * Technological Equipments
     * Construction Equipments
     * Electrical Equipments
     * Mechanical Equipments
     * Sports Equipments
     * Others
     *
     * @ORM\Column(name="equipments", type="string", nullable=false)
     * 
     * @var string
     */
    private $equipments;

    /**
     */
    public function __construct()
    {}

    public function getId()
    {
        return $this->id;
    }

    public function getEquipments()
    {
        return $this->equipments;
    }

    public function setEquipments($equip)
    {
        $this->equipments = $equip;
        return $this;
    }
}

