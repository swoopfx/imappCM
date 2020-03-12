<?php
namespace Settings\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="notification_type")
 * @author otaba
 *        
 */
class NotificationType
{

     /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @ORM\Column(name="type", type="string", nullable=true)
     * @var string
     */
    private $type;
    
    public function __construct()
    {}
    
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

