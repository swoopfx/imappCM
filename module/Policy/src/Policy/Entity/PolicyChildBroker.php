<?php
namespace Policy\Entity;

use Doctrine\ORM\Mapping as ORM;
use GeneralServicer\Entity\BrokerChild;

/**
 * @ORM\Entity
 * @ORM\Table(name="policy_child_broker")
 * @author swoopfx
 *        
 */
class PolicyChildBroker
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="GeneralServicer\Entity\BrokerChild")
     * @ORM\JoinColumn(name="broker_child", referencedColumnName="id")
     * 
     * @var BrokerChild
     */
    private $brokerChild;

    /**
     * @ORM\OneToOne(targetEntity="Policy\Entity\PolicyBroker", inversedBy="policyChildBroker")
     * @ORM\JoinColumn(name="policy_broker", referencedColumnName="id")
     * @var unknown
     */
    private $policyBroker;

    public function getId()
    {
        return $this->id;
    }

    public function getBrokerChild()
    {
        return $this->brokerChild;
    }

    public function setBrokerChild($broker)
    {
        $this->brokerChild = $broker;
    }
    
    public function getPolicyBroker(){
        return $this->policyBroker;
    }
    
    public function setPolicyBroker($broker){
        $this->policyBroker = $broker;
        return $this;
    }
}

