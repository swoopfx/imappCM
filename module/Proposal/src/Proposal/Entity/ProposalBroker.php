<?php
namespace Proposal\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This maps a proposal to a broker
 * @ORM\Entity
 * @ORM\Table(name="proposal_broker")
 *
 * @author swoopfx
 *        
 */
class ProposalBroker
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
     * 
     * @var InsuranceBrokerRegistered
     */
    private $broker;

    /**
     * @ORM\OneToOne(targetEntity="Proposal\Entity\Proposal", inversedBy="proposalBroker")
     * @ORM\JoinColumn(name="proposal", referencedColumnName="id")
     * 
     * @var Proposal
     */
    private $proposal;
    
    /**
     * @ORM\OneToOne(targetEntity="Proposal\Entity\BrokerChildProposal", mappedBy="proposalBroker",  cascade={"persist", "remove"} )
     * @var BrokerChildProposal
     */
    private $brokerChildProposal;
    


    public function __construct()
    {
        
        // TODO - Insert your code here
    }

    public function getBroker()
    {
        return $this->broker;
    }

    public function setBroker($broker)
    {
        $this->broker = $broker;
        return $this;
    }

    public function getProposal()
    {
        return $this->proposal;
    }

    public function setProposal($prop)
    {
        $this->proposal = $prop;
        return $this;
    }
    
   public function getBrokerChildProposal(){
       return $this->brokerChildProposal;
   }
    
    
}

