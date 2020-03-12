<?php
namespace Settings\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * All Risk
 * TPL
 * TotalLoss
 * TPL only
 * 
 * @ORM\Entity
 * @ORM\Table(name="marine_hull_cover_type")
 * @author otaba
 *        
 */
class MarineHullCoverType
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
     * @ORM\Column(name="desc", type="text", nullable=true)
     * @var string
     */
    private $desc;
    
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
    
    public function getDesc(){
        return $this->desc;
    }
    
    public function setDesc($desc){
        $this->desc = $desc;
        return $this;
    }
}

