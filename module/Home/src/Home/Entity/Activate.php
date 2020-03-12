<?php
namespace Home\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 *This is the login values for activation 
 *
 * @ORM\Entity
 * @ORM\Table(name="activate")
 * @author otaba
 *        
 */
class Activate
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
    
    /**
     * @ORM\Column(name="details", type="string", nullable=true)
     * @var string
     */
    private $details;

    /**
     */
    public function __construct()
    {}
    
    public function getId(){
        return $this->id;
    }
    
    public function getDetails(){
        return $this->details;
    }
    
    public function setDetails($det){
        $this->details = $det;
        return $this;
    }
}

