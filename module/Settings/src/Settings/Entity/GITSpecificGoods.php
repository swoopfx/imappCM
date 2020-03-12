<?php
namespace Settings\Entity;


use Doctrine\ORM\Mapping as ORM;
use IMServices\Entity\GoodsInTransit;

/**
 * This are flamableor restricted goods or special cases goods
 * Options are 
 * none of the category
 * Tobacco or Cigarretes
 * Wine or Spirits
 * No Ferrous Metals
 * Flammable Products 
 * Weapons
 * 
 * 
 * @ORM\Entity
 * @ORM\Table(name="git_specific_goods")
 * 
 * @author otaba
 *        
 */
class GITSpecificGoods
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @ORM\Column(name="service", type="string", nullable=false)
     *
     * @var string
     */
    private $service;
    
    
    
    
    
    public function getid(){
        return $this->id;
    }
    
    public function getService(){
        return $this->service;
    }
    
    public function setService($zserv){
        $this->service = $zserv;
        return $this;
    }
   

}

