<?php
namespace Settings\Entity;


use Doctrine\ORM\Mapping as ORM;
use Offer\Entity\Offer;
use Packages\Entity\Packages;
use Proposal\Entity\Proposal;
use Policy\Entity\PolicyFloat;

/**
 * @ORM\Entity
 * @ORM\Table(name="policy_cover_termed_value")
 * @author otaba
 *        
 */
class PolicyCoverTermedValue
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id ; 
    
    /**
     * @ORM\Column(name="value", type="string", nullable=true)
     * @var string
     */
    private $value;
    
    /**
     * @ORM\OneToOne(targetEntity="Proposal\Entity\Proposal", inversedBy="termedDuration")
     * @var Proposal
     */
    private $proposal;
    
    /**
     * @ORM\OneToOne(targetEntity="Offer\Entity\Offer", inversedBy="termedDuration")
     * @var Offer
     */
    private $offer;
    
    /**
     * @ORM\OneToOne(targetEntity="Packages\Entity\Packages", inversedBy="termedDuration")
     * @var Packages
     */
    private $packages;
    
    
    /**
     * @ORM\OneToOne(targetEntity="Policy\Entity\PolicyFloat", inversedBy="termedDuration")
     * @var PolicyFloat
     */
    private $floatPolicy;
    
    /**
     */
    public function __construct()
    {
        
        // TODO - Insert your code here
    }
    
    
    public function getId(){
        return $this->id;
        
    }
    
    public function getValue(){
        return $this->value;
    }
    
    public function setValue($val){
        $this->value = $val;
        return $this;
    }
    
    public function getProposal(){
        return $this->proposal;
    }
    
    public function setProposal($prop){
        $this->proposal = $prop;
        return $this;
    }
    
    public function getOffer(){
        return $this->offer;
    }
    
    public function setOffer($offer){
        $this->offer = $offer;
        return $this;
    }
    
    public function getPackages(){
        return $this->packages;
    }
    
    public function setPackages($pack){
        $this->packages = $pack;
        return $this;
    }
    
    public function getFloatPolicy(){
        return $this->floatPolicy;
    }
    
    public function setFloatPolicy($pol){
        $this->floatPolicy = $pol;
        return $this;
    }
    
    
}

