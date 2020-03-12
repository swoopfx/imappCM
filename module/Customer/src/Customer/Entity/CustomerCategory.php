<?php
namespace Customer\Entity;


use Doctrine\ORM\Mapping as ORM;
/**
 * 
 * This defines if the customer is either an individual or a company
 * @ORM\Entity
 * @ORM\Table(name="customer_category")
 * @author swoopfx
 *        
 */
class CustomerCategory
{
    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * This is either individual or Organisation
     * @ORM\Column(name="category", type="string", nullable=false)
     * @var string
     */
    private $category;
    
    /**
     * @ORM\Column(name="avatar", type="string", nullable=false)
     * @var string
     */
    private $avatar;
    
    
    public function __construct()
    {
        
        // TODO - Insert your code here
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function getCategory(){
        return $this->category;
    }
    
    public function setCategory($cat){
        $this->category = $cat;
        return $this;
    }
    
    public function getAvatar(){
        return $this->avatar ;
    }
    
    public function setAvatar($ava){
        $this->avatar = $ava;
        return $this;
    }
}

