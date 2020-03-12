<?php
namespace Proposal\Entity;

use Doctrine\ORM\Mapping as ORM;
use Settings\Entity\AccountEffect;

/**
 * This is generated when premium is calculated
 * It also comes with additional values
 * as deduction or addition
 * @ORM\Entity
 * @ORM\Table(name="proposal_value")
 *
 * @author swoopfx
 *        
 */
class ProposalValue
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="Proposal\Entity\Proposal")
     * @ORM\JoinColumn(name="proposal", referencedColumnName="id")
     * 
     * @var Proposal
     */
    private $proposal;

    /**
     * @ORM\Column(name="proposal_value", type="string", nullable=false)
     * 
     * @var String
     */
    private $proposalValue; // this is the generated Premium

    /**
     * @ORM\Column(name="desc", type="text", nullable=false)
     * 
     * @var String
     */
    private $desc;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\AccountEffect")
     * @ORM\JoinColumn(name="effect", referencedColumnName="id")
     * 
     * @var AccountEffect
     */
    private $effect;

    public function __construct()
    {}

    public function getId()
    {
        return $this->id;
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

    public function getProposalValue()
    {
        return $this->proposalValue;
    }

    public function setProposalValue($val)
    {
        $this->proposalValue = $val;
        return $this;
    }

    public function getDesc()
    {
        return $this->desc;
    }

    public function setDesc($desc)
    {
        $this->desc = $desc;
        return $this;
    }

    public function getEffect()
    {
        $this->effect;
    }

    public function setEffect($eefe)
    {
        $this->effect = $eefe;
        return $this;
    }
}

