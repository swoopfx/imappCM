<?php
namespace Settings\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="marine_cargo_packaging_type")
 * @author otaba
 *        
 */
class MarineCargPackagingType
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(name="package", type="string", nullable=true)
     * 
     * @var string
     */
    private $package;

    /**
     */
    public function __construct()
    {
        
        // TODO - Insert your code here
    }

    public function getId()
    {
        return $this->id;
    }

    public function getPackage()
    {
        return $this->package;
    }

    public function setPackage($pack)
    {
        $this->package = $pack;
        return $this;
    }
}

