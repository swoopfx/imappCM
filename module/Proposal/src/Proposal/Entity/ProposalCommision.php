<?php
namespace Proposal\Entity;

use Doctrine\ORM\Mapping as ORM;
use Settings\Entity\FlatRateCommision;
use Settings\Entity\PercentageCommision;
/**
 * @ORM\Entity
 * @ORM\Table(name="proposal_commision")
 * @author swoopfx
 *        
 */
class ProposalCommision
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
     * @var Proposal
     */
    private $proposal;
    
    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\FlatRateCommision")
     * @ORM\JoinColumn(name="proposal", referencedColumnName="id")
     * @var FlatRateCommision
     */
    private $flatRate;
    
    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\PercentageCommision")
     * @ORM\JoinColumn(name="proposal", referencedColumnName="id")
     * @var PercentageCommision
     */
    private $percetageRate;
    
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
        return $this;
    }
    
    public function getFlatRate(){
        return $this->flatRate;
    }
    
    public function setFlataRate($flat){
        $this->flatRate = $flat;
        return $this;
    }
    
    public function getPercentageRate(){
        return $this->percetageRate ;
    }
    
    public function setPercentage($per){
        $this->percetageRate = $per;
        return $this;
    }
}

