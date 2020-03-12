<?php
namespace Settings\Entity;


use Doctrine\ORM\Mapping as ORM;
/**
 * This is either Agent or Broker
 * @ORM\Entity
 * @ORM\Table(name="administrator")
 * @author swoopfx
 *        
 */
class Administrator
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @ORM\Column(name="administrator", type="string", nullable=false)
     * @var string
     */
    private $administrator;
    public function __construct()
    {}
    
    public function getId(){
        return $this->id;
    }
    
    public function getAdministrator(){
        return $this->administrator;
    }
    
    public function setAdministrator($admin){
        $this->administrator = $admin ;
        return $this;
    }
}

