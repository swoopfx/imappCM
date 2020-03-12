<?php
namespace Settings\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * African Territorial Waters
 * Atlatic Ocean
 * Pacific Ocean
 * Persian Gulf
 * @ORM\Entity
 * @ORM\Table(name="marine_territorial_limit")
 * @author otaba
 *        
 */
class MarineTerritorialLimit
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @ORM\Column(name="territory", type="string", nullable=true)
     * @var strings
     */
    private $territory;
    
    /**
     */
    public function __construct()
    {
        
        // TODO - Insert your code here
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function getTerritory(){
        return $this->territory;
    }
    
    public function setTerritory($ter){
        $this->territory = $ter;
        return $this;
    }
}

