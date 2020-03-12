<?php
namespace Settings\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InBoard Drive
 * Stern-Drive
 * Four stroke
 * two stroke engines
 * Jet Drives
 * OutBound Drive
 * Surface-Drive
 * Pod Drives
 * Others
 * @ORM\Entity
 * @ORM\Table(name="marine_engine_type")
 * @author otaba
 *        
 */
class MarineEngineType
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @ORM\Column(name="type", type="string", nullable=false)
     * @var string
     */
    private $type;
    
    /**
     */
    public function __construct()
    {
        
        // TODO - Insert your code here
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function getType(){
        return $this->type;
    }
    
    public function setType($type){
        $this->type = $type;
        return $this;
    }
    
}

