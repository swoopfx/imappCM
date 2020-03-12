<?php
namespace Settings\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="live_stock_rearing_method")
 * @author otaba
 *        
 */
class LiveStockRearingMethod
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @ORM\Column(name="method", type="string", nullable=true)
     * @var string
     */
    private $method;
    
    /**
     */
    public function __construct()
    {
        
        // TODO - Insert your code here
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function getMethod(){
        return $this->method;
    }
    
    public function setMethod($method){
        $this->method = $method;
        return $this;
    }
}

