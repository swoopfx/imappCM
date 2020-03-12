<?php
namespace Claims\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * 
 * @ORM\Table(name="claims_broker")
 * @author swoopfx
 *        
 */
class ClaimsBroker
{
    // TODO - Insert your code here
    
    /**
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var integer
     */
    private $id;
    /**
     * @ORM\OneToOne(targetEntity="Claims\Entity\CLaims", inversedBy="claimsBroker")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="claims", referencedColumnName="id")
     *      })
     * @var Claims
     */
    private $claims;
    
    /**
     * @ORM\ManyToOne(targetEntity="Users\Entity\InsuranceBrokerRegistered")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="broker", referencedColumnName="id")
     *      })
     * @var Claims
     */
    private $broker;
    
    public function __construct()
    {
        
        // TODO - Insert your code here
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function getClaims(){
        return $this->claims;
    }
    
    public function setClaims($set){
        $this->claims = $set;
        return $this; 
    }
    
    public function  getBroker(){
       return $this->broker;
       
    }
    
    public function setBroker($set){
        $this->broker = $set;
        return $this;
    }
}

