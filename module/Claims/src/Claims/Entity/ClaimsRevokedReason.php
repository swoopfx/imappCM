<?php
namespace Claims\Entity;


use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="claims_revoked_reason")
 * @author otaba
 *        
 */
class ClaimsRevokedReason
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
    
//     /**
//      * @ORM\OneToOne(targetEntity="")
//      * @var unknown
//      */
    private $claims;
    
    private $reason;

    /**
     */
    public function __construct()
    {}
    
    public function getId(){
        return $this->id;
    }
    
    public function getClaims(){
        return $this->claims;
    }
    
    public function setClaims($ck){
        $this->claims = $ck;
        return $this;
    }
}

