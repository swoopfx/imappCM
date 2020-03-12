<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;
use Settings\Entity\Currency;

/**
 * @ORM\Entity
 * @ORM\Table(name="contract_all_risk_value_list")
 * @author otaba
 *        
 */
class ContractAllRiskValueList
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    
    /**
     * This defines the machinery or tool for the project
     * @ORM\Column(name="value_name", type="string")
     * @var string
     */
    private $valueName;
    
    /**
     * This defines the value of the machinery
     * 
     * @ORM\Column(name="value", type="string", nullable=true)
     * @var string
     */
    private $value;
    
    /**
     * The currency of the value of the machinery
     * @ORM\ManyToOne(targetEntity="Settings\Entity\Currency")
     * @var Currency
     */
    private $currency;
    
    /**
     * @ORM\ManyToOne(targetEntity="IMServices\Entity\ContractAllRisk", inversedBy="valueList")
     * @var ContractAllRisk
     */
    private $contractAllRisk;
    
    /**
     */
    public function __construct()
    {
        
        // TODO - Insert your code here
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function getValueName(){
        return $this->valueName;
    }
    
    public function setValueName($name){
        $this->valueName = $name;
        return $this;
    }
    
    public function getValue(){
        return $this->value;
    }
        
    
    public function setValue($vla){
        $this->value = $vla;
        return $this; 
    }
    
    public function getContractAllRisk(){
        return $this->contractAllRisk;
    }
    
    public function setContractAllRisk($risk){
        $this->contractAllRisk = $risk;
        return $this;
    }
    
    public function getCurrency(){
        return $this->currency;
    }
    
    public function setCurrency($set){
        $this->currency = $set;
        return $this;
    }
}

