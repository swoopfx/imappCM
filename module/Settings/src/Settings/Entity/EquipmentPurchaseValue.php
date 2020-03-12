<?php
namespace Settings\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="equipment_purchase_value")
 * 
 * @author otaba
 *        
 */
class EquipmentPurchaseValue
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer")
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     *     
     */
    private $id;

    /**
     * @ORM\Column(name="value", type="string")
     * 
     * @var string
     */
    private $value;

    public function getId()
    {
        return $this->is;
    }

    public function setValue($val)
    {
        $this->value = $val;
        return $this;
    }

    public function getValue()
    {
        return $this->value;
    }
}

