<?php
namespace Proposal\Entity;

use Doctrine\ORM\Mapping as ORM;
use GeneralServicer\Entity\BrokerChild;

/**
 * This Entity maps a child broker to a proposal
 * ie brokerchild assigned to the proposal 
 * @ORM\Entity
 * @ORM\Table(name="broker_child_proposal")
 * @author swoopfx
 *        
 */
class BrokerChildProposal
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
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="broker_child", referencedColumnName="id")
     * })
     * 
     * @var BrokerChild
     */
    private $brokerChild;

    /**
     * @ORM\OneToOne(targetEntity="Proposal\Entity\ProposalBroker", inversedBy="brokerChildProposal")
     * @ORM\JoinColumn(name="proposal", referencedColumnName="id")
     *
     * @var ProposalBroker
     */
    private $proposalBroker;
    


    public function __construct()
    {
        
        // TODO - Insert your code here
    }

    public function getId()
    {
        return $this->id;
    }

    public function getBrokerChild()
    {
        return $this->brokerChild;
    }

    public function setBrokerChild($child)
    {
        $this->brokerChild = $child;
        return $this;
    }

   
    
    public function getProposalBroker(){
        return $this->proposalBroker;
    }
    
    public function  setProposalBroker($broker){
        $this->proposalBroker = $broker;
        return $this;
    }
}

