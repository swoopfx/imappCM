<?php
namespace Policy\Entity;


use Doctrine\ORM\Mapping as ORM;
use Users\Entity\InsuranceBrokerRegistered;
/**
 * @ORM\Entity
 * @ORM\Table(name="policy_broker")
 * @author swoopfx
 *        
 */
class PolicyBroker
{
    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    
    /**
     * @ORM\ManyToOne(targetEntity="Users\Entity\InsuranceBrokerRegistered")
     * @ORM\JoinColumn(name="broker", referencedColumnName="id")
     * @var InsuranceBrokerRegistered
     */
    private $broker;
    
    
    /**
     * @ORM\ManyToOne(targetEntity="Policy\Entity\CoverNote", inversedBy="broker")
     * @ORM\JoinColumn(name="cover_note", referencedColumnName="id")
     * @var unknown
     */
    private $coverNote;
    
    /**
     * @ORM\OneToOne(targetEntity="Policy\Entity\PolicyChildBroker", mappedBy="policyBroker", cascade={"persist", "remove"})
     * @var PolicyChildBroker
     */
   private $policyChildBroker;
   
    
    public function  getId(){
        return $this->id;
    }
    
    public function getBroker(){
        return $this->broker;
    }
    
    public function setBroker($broker){
        $this->broker = $broker;
    }
    
    public function getPolicy(){
        return $this->policy;
    }
    
    public function setPolicy($pol){
        $this->policy = $pol  ;
        return $this;
    }
    
    public function getPolicyChildBroker(){
        return $this->policyChildBroker;
    }
    
    public function setPolicyChildBroker($broker){
        $this->policyChildBroker = $broker;
        return $this;
    }
}

