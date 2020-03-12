<?php
namespace Claims\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="claims_machinery_breakdown")
 * @author otaba
 *        
 */
class ClaimsMachineryBreakdown
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    private $lossDate;
    
    
    /**
     * This define damaged part and extent
     * @ORM\Column(name="damaged_part", type="text", nullable=true)
     * @var text
     */
    private $damagedPart;
    
    private $damageDesc;
    
    /**
     *  This defines all people all situation responsible for loss
     *  @ORM\Column(name="loss_responsibility", type="text", nullable=true)
     * @var unknown
     */
    private $lossResposibility;
    
    private $isLossByTheft;
    
    private $isPoliceInformed;
    
    private $policeLocation;
    
    
    
    /**
     */
    public function __construct()
    {
        
        // TODO - Insert your code here
    }
}

