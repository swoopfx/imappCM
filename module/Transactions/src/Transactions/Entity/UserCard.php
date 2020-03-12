<?php
namespace Transactions\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="user_card")
 * 
 * @author otaba
 *        
 */
class UserCard
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
     * @ORM\Column(name="cc_name", type="string", nullable=true)
     * @var string;
     */
    private $cc_name;
    
    /**
     * @ORM\Column(name="cc_number", type="string", nullable=true)
     * @var string
     */
    private $cc_number;
    
    /**
     * @ORM\Column(name="cc_cvc", type="string", nullable=true)
     * @var string
     */
    private  $cc_cvc;
    
    /**
     * @ORM\Column(name="cc_month", type="string", nullable=true)
     * @var string
     */
    private $cc_month;
    
    /**
     * @ORM\Column(name="cc_year", type="string", nullable=true)
     * @var string
     */
    private $cc_year;
    
    
    /**
     * @ORM\Column(name="cc_pin", type="string", nullable=true)
     * @var string
     */
    private $cc_pin;
    


    /**
     */
    public function __construct()
    {
        
        // TODO - Insert your code here
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function getCcName(){
        return $this->cc_name;
    }
    
    public function setCcName($name){
        $this->cc_name = $name;
        return $this;
    }
    
    public function getCcNumber(){
        return $this->cc_number;
    }
    
    public function setCcNumber($num){
        $this->cc_number = $num;
        return $this;
    }
    
    public function getCcCvc(){
        return $this->cc_cvc;
    }
    
    public function setCcCvc($cc){
        $this->cc_cvc = $cc;
        return $this;
    }
    
    
    public function getCcMonth(){
        return  $this->cc_month;
    }
    
    public function setCcMonth($month){
        $this->cc_month = $month;
        return $this;
    }
    
    public function getCcYear(){
        return $this->cc_year;
    }
    
    public function setCcYear($year){
        $this->cc_year = $year;
        return $this;
    }
    
    public function getCcPin(){
        return $this->cc_pin;
    }
    
    public function setCcPin($pin){
        $this->cc_pin = $pin;
        return $this;
    }
}

