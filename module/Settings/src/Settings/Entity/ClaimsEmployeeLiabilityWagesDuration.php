<?php
namespace Settings\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Weekly
 * Monthly
 * @ORM\Entity
 * @ORM\Table(name="claims_employee_liability_wages_duration")
 * @author otaba
 *
 */
class ClaimsEmployeeLiabilityWagesDuration
{
    
    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @ORM\Column(name="duration")
     * @var string
     */
    private $duration ;

    // TODO - Insert your code here
    public function __construct()
    {

        // TODO - Insert your code here
    }
    
    
}

