<?php
namespace IMServices\Entity;


use Doctrine\ORM\Mapping as ORM;
use Settings\Entity\Currency;
/**
 * @ORM\Entity
 * @ORM\Table(name="fire_and_special_peril_cover_list")
 * @author otaba
 *        
 */
class FireAndSpecialPerilCOverList
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @ORM\Column(name="listname", type="string", nullable=true)
     * @var string
     */
    private $listName;
    
    /**
     * @ORM\Column(name="listValue", type="string", nullable=true)
     * 
     * @var string
     */
    private $listValue;
    
    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\Currency")
     * @var Currency
     */
    private $currency;
    
    /**
     * @ORM\ManyToOne(targetEntity="FireAndSpecialPeril", inversedBy="coverList")
     * 
     * @var FireAndSpecialPeril
     */
    private $fireAndSpecialPeril;
    
    
    public function __construct()
    {
        
        // TODO - Insert your code here
    }
    
    public function getId(){
        return $this->id;
        
    }
    
    
    public function getListName(){
        return $this->listName;
    }
    
    public function setListName($name){
        $this->listName = $name;
        return $this;
    }
    
    
    public function getListValue(){
        return $this->listValue;
        
    }
    
    public function setListValue($value){
        $this->listValue = $value;
        return $this;
    }

    public function getCurrency(){
        return $this->currency;
    }
    
    
    public function setCurrency($cur){
        $this->currency = $cur;
        return $this;
    }
    
    
    public function getFireAndSpecialPeril(){
        return $this->fireAndSpecialPeril;
    }
    
    public function setFireAndSpecialPeril($fire){
        $this->fireAndSpecialPeril = $fire;
         return $this;
    }
    
    
}

