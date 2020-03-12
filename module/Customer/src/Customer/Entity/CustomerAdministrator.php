<?php
namespace Customer\Entity;


use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="customer_administrator")
 * @author swoopfx
 *        
 */
class CustomerAdministrator
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
     * @ORM\Column(name="aministrator", type="string", nullable=false)
     * @var string
     */
    private $administrator;
    
    public function __construct()
    {
        
        // TODO - Insert your code here
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function getAdministrator(){
        return $this->administrator;
    }
    
    public function setAdministrator($admin){
        $this->administrator = $admin;
        return $this;
    }
}

