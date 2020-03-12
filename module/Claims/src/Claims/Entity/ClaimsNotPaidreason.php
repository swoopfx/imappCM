<?php
namespace Claims\Entity;


use Doctrine\ORM\Mapping as ORM;
/**
 *
 *@ORM\Entity
 *@ORM\Table(name="claims_not_paid_reason")
 * @author otaba
 *        
 */
class ClaimsNotPaidreason
{

    /**
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     *
     * @var integer
     */
    private $id;
    
    private $claims;
    
    private $reason;
    
    private $createdOn;
    
    
    
    public function __construct()
    {}
    
    public function getId(){
        return $this->id;
    }
    
    public function getClaims(){
        return $this->claims;
        
    }
    
    public function setClaims($cla){
        $this->claims = $cla;
        return $this;
    }
}

