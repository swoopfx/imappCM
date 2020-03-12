<?php
namespace Claims\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="claims_marine")
 * @author otaba
 *
 */
class ClaimsMarine
{
    
    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    // TODO - Insert your code here
    public function __construct()
    {

        // TODO - Insert your code here
    }
}

