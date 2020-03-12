<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This is the entity for motor insurance on a fleet basis
 * @ORM\Entity
 * @ORM\Table(name="motor_fleet")
 * 
 * @author otaba
 *        
 */
class MotorFleetData
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
    
    public function getId(){
        
    }
}

