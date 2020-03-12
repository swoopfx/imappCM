<?php
namespace IMServices\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="live_stock_loss_history")
 * @author otaba
 *        
 */
class LiveStockLossHistory
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @ORM\Column(name="year", type="string", nullable=true)
     * @var string
     */
    private $year;
    
    /**
     * @ORM\Column(name="loss", type="string", nullable=true)
     * @var string
     */
    private $loss;
    
    /**
     * @ORM\Column(name="cause", type="text", nullable=true)
     * @var text 
     */
    private $cause ;
    
    /**
     * @ORM\Column(name="value_lost", type="string", nullable=true)
     * @var string
     */
    private $valueLost;
    
//     /**
//      * @ORM\ManyToOne(targetEntity="LiveStockFarmInsurance", inversedBy="lossHistory")
//      * @var LiveStockFarmInsurance
//      */
    private $livestockFarmInsurance;
    
    /**
     */
    public function __construct()
    {
        
        // TODO - Insert your code here
    }
    
    public function getId(){
        return $this->id;
        
    }
    
    public function getYear(){
        return $this->year;
    }
    
    public function setYear($set){
        $this->year = $set;
        return $this;
    }
    
    public function getLoss(){
        return $this->loss;
    }
    
    public function setLoss($set){
        $this->loss = $set;
        return $this;
    }
    
    public function getCause(){
        return $this->cause;
    }
    
    public function setCause($set){
        $this->cause = $set;
        return $this;;
    }
    
    public function etValueLost(){
        return $this->valueLost;
    }
    
    
    public function setValueLost($lost){
        $this->valueLost = $lost;
        return $this;
    }
    
    public function getLivestockFarmInsurance(){
        return $this->livestockFarmInsurance;
    }
    
    public function setLivestockFarmInsurance($live){
        $this->livestockFarmInsurance = $live;
        return $this;
    }
}

