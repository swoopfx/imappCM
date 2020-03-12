<?php
namespace Settings\Entity;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="motor_model")
 * @author otaba
 *        
 */
class MotorModel
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    
    /**
     * @ORM\Column(name="model", type="string", nullable=false)
     * @var unknown
     */
    private $model;
    
    
    /**
     *  @ORM\ManyToOne(targetEntity="Settings\Entity\MotorType")
     *   @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="motor_type", referencedColumnName="id")
     *      })
     * @var MotorType
     */
    private $motorType;
    
    public function __construct()
    {
        
        // TODO - Insert your code here
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function getModel(){
        return $this->model;
    }
    
    public function setModel($mod){
        $this->model = $mod;
        return $this;
    }
    
    public function getMotorType(){
        return $this->motorType;
    }
    
    public function setMotorType($type){
        $this->motorType = $type;
        return $this;
    }
}

