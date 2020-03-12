<?php
namespace Transactions\Entity;

/**
 * This include Bank Transfer
 * Flutterwave
 * PayStack 
 * 
 */
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="transaction_mode")
 * @author Moyinoluwa
 *
 */
class TransactionMode
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
    * @var string @ORM\Column(name="mode", type="string",  nullable=true)
    */
    private $mode;
    
    /**
     * @return integer
     */
    public function getId(){
        return $this->id;
    }
    
    /**
     * 
     * @return string
     */
    public function getMode(){
        return $this->mode ; 
    }
    
    
    /**
     * 
     * @param string $mode
     * @return \Transactions\Entity\TransactionMode
     */
    public function setMode($mode){
        $this->mode = $mode;
        
        return $this;
    }
}

