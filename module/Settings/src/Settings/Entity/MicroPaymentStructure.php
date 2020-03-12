<?php
namespace Settings\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="micro_payment_structure")
 * @author otaba
 *        
 */
class MicroPaymentStructure
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @ORM\Column(name="micro_text", type="string")
     * @var string
     */
    private $microText;
    
    /**
     * This is used as the divisiblility entity for the actual 
     * @ORM\Column(name="micro_value", type="string")
     * @var string
     */
    private $microValue;
    
    
    
    public function __construct()
    {}
    
    public function getId(){
        return $this->id;
    }
    
    public function getMicroText(){
        return $this->microText;
    }
    
    public function setMicroText($set){
        $this->microText = $set;
        return $this;
    }
    
    public function getMicroValue(){
        return $this->microValue;
    }
    
    public function setMicroValue($val){
        $this->microValue = $val;
        return $val;
    }
}

