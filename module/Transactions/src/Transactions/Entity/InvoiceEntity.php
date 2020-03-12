<?php
namespace Transactions\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * The entity is categorized as Users and Customers 
 * if Customers it would detail from whon and to whm 
 * @author swoopfx
  * @ORM\Entity
 * @ORM\Table(name="invoice_entity")
 *        
 */
class InvoiceEntity
{
 /**
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var integer
     */
    private $id;
    
    
    /**
     * @ORM\Column(name="entity", type="string", nullable=false)
     *
     * @var string
     */
    private $entity;
    
  
    
    public function __construct()
    {
        
        // TODO - Insert your code here
    }
    
    public function getId(){
        return $this->id; 
    }
    
    /**
     * 
     * @return string
     */
    public function getEntity(){
        return $this->entity;
        
    }
    
   
    /**
     * 
     * @param string $cat
     */
    public function setEntity($cat){
        $this->entity = $cat;
        
        return $this;
    }
}

