<?php
namespace Settings\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="sex")
 * @author otaba
 *        
 */
class Sex
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
   private $id;
   
   
   /**
    * @ORM\Column(name="sex", type="string", nullable=false)
    * @var string
    */
   private $sex;
   
    public function __construct()
    {}
    
    public function getId(){
        return $this->id;
    }
    
    public function getSex(){
        return $this->sex;
        
    }
    
    public function setSex($sex){
        $this->sex = $sex;
        return $this;
    }
}

