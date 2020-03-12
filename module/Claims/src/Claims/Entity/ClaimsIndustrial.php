<?php
namespace Claims\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="claims_industrial")
 * @author otaba
 *        
 */
class ClaimsIndustrial
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
   
    
    /**
     */
    public function __construct()
    {
        
        // TODO - Insert your code here
    }
}

