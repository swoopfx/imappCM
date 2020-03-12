<?php
namespace Settings\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * This include specific online transaction 
 * Like flutterwave, paystack
 * @ORM\Entity
 * @ORM\Table(name="online_transaction")
 * @author Moyinoluwa
 *        
 */
class OnlineTransaction
{
    /**
     *
     * @var integer This is only genertated upon successful transaction
     *      @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * 
     * @ORM\Column(name="type", type="string")
     * @var string
     */
    private $type;
    
    public function __construct()
    {
        
        
    }
    
    /**
     * 
     * @return number
     */
    public function getId(){
        return $this->id;
    }
    
    /**
     * 
     * @return string
     */
    public function getType(){
        return $this->type;
    }
    
    /**
     * 
     * @param unknown $type
     * @return \Settings\Entity\OnlineTransaction
     */
    public function setType($type){
        $this->type = $type;
        return $this;
    }
}

