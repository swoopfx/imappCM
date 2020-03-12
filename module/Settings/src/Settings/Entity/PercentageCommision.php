<?php
namespace Settings\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="percentage_commision")
 * @author swoopfx
 *        
 */
class PercentageCommision
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @ORM\Column(name="percentage", type="string", nullable=false, unique=true)
     * @var string
     */
    private $percentage;
    
    public function __construct()
    {}
    
    public function getId(){
        return $this->id;
    }
    
    public function getPercentage(){
        return $this->percentage;
    }
    
    public function setPercentage($per){
        $this->percentage = $per;
        return $this;
    }
    
    
}

