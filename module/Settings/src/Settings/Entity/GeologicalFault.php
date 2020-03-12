<?php
namespace Settings\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="geological_fault")
 * @author otaba
 *        
 */
class GeologicalFault
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @ORM\Column(name="fault", type="string", nullable=true)
     * @var string
     */
    private $fault;
    
    
    /**
     */
    public function __construct()
    {
        
        
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function getFault(){
        return $this->fault;
    }
    
    public function setFault($fault){
        $this->fault = $fault;
        return $this;
    }
}

