<?php
namespace Transactions\Entity;


use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="broker_payment_settings")
 * @author swoopfx
 *        
 */
class BrokerPaymentSettings
{
    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Transactions\Entity\BrokerPaymentChannel")
     * @ORM\JoinColumn(name="broker_payment_channel", referencedColumnName="id")
     * @var BrokerPaymentChannel
     */
    private $paymentChannel;
    
    
    private $isActive;
    
   
    
    
    
    public function getId(){
        return $this->id;
    }
    
    public function getPaymentChannel(){
        return $this->paymentChannel;
    }
    
    public function setPaymentChannel($channel){
        $this->paymentChannel  = $channel;
        return $this;
    }
    
    public function getIsActive(){
        return $this->isActive;
    }
    
    public function setIsActive($is){
     $this->isActive = $is;   
    }
}

