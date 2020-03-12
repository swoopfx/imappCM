<?php
namespace Settings\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Junior
 * Senior
 * Management
 * @ORM\Entity
 * @ORM\Table(name="group_life_member_class")
 * @author otaba
 *        
 */
class GroupLifeMemberClass
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @ORM\Column(name="class", type="string", nullable=false)
     * @var string
     */
    private $class;
    
    /**
     */
    public function __construct()
    {
        
        // TODO - Insert your code here
    }
    
    public function gtId(){
        return $this->id;
    }
    
    public function getClass(){
        return $this->class;
    }
    
    public function setClass($class){
        $this->class = $class;
        return $this;
    }
}

