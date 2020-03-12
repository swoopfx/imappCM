<?php
namespace Claims\Entity;


use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="claims_plant_all_risk")
 * @author otaba
 *        
 */
class ClaimsPlantAllRisk
{
    
    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    private $lossDate;
    
    private $damageFullAccount;
    
    
    
   

    /**
     */
    public function __construct()
    {}
}

