<?php
namespace Settings\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="crop_agric_peril")
 * @author otaba
 *        
 */
class CropAgricPeril
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    
    /**
     * @ORM\Column(name="peril", type="string", nullable=true)
     * @var string
     */
    private $peril;
    
    
    /**
     */
    public function __construct()
    {
        
        // TODO - Insert your code here
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function getPeril(){
        return $this->peril;
    }
    
    public function setPeril($peril){
        $this->peril = $peril;
        return $this;
    }
}

