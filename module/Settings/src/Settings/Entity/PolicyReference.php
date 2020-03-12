<?php
namespace Settings\Entity;


use Doctrine\ORM\Mapping as ORM;
/**
 * This refers if the policy was generated from an offer or a proposal
 * @ORM\Entity
 * @ORM\Table(name="policy_refrence")
 * @author swoopfx
 *        
 */
class PolicyReference
{
    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    
    /**
     * @ORM\Column(name="reference", type="string", nullable=false)
     * @var string
     */
    private $reference;
    
    
    public function __construct()
    {
        
        // TODO - Insert your code here
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function getReference(){
        return  $this->reference;
    }
    
    public function setReference($ref){
        $this->reference = $ref;
        return $this;
    }
}

