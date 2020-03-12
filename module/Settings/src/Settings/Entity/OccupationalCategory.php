<?php
namespace Settings\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="occupation_category")
 * 
 * @author otaba
 *        
 */
class OccupationalCategory
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(name="occupation", type="string", nullable=false)
     */
    private $occupation;
    
   

    /**
     */
    public function __construct()
    {}

    public function getId()
    {
        return $this->id;
    }

    public function getOccupation()
    {
        return $this->occupation;
    }

    public function setOccupation($occup)
    {
        $this->occupation = $occup;
        return $this;
    }
}

