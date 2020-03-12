<?php
namespace Transactions\Entity;

use Doctrine\ORM\Mapping as ORM;
use Proposal\Entity\Proposal;

/**
 * @ORM\Entity
 * @ORM\Table(name="proposal_invoice")
 * @author swoopfx
 *        
 */
class ProposalInvoice
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
     * @ORM\ManyToOne(targetEntity="Proposal\Entity\Proposal")
     * @ORM\JoinColumn(name="proposal", referencedColumnName="id")
     */
    private $proposal;
    
    
    /**
     * @ORM\OneToOne(targetEntity="Transactions\Entity\Invoice", inversedBy="proposalInvoice")
     * @ORM\JoinColumn(name="invoice", referencedColumnName="id")
     * @var Invoice
     */
    private $invoice;
    public function __construct()
    {}
    
    public function getId(){
        return $this->id;
    }
    
    public function getProposal(){
        return $this->proposal;
    }
    
    public function setProposal($prop){
        $this->proposal = $prop;
    }
    
    public function getInvoice(){
        return $this->invoice;
    }
    
    public function setInvoice($in){
        $this->invoice = $in;
        return $this;
    }
}

