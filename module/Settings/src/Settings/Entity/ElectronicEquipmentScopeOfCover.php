<?php
namespace Settings\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * 
 * Fire, lighting, explosion, falling aircraft.
 * Smoke, soot, corrosive gasses.
 *  Water and humidity.
 *  Short circuits and other electrical fafaults.
 *  Design, manufacturing, assembly and erection fault, defects in casting and material, workshop errors, bad workmanship.
 *  Faulty operation, lack of skill, gross negligence.
 *  Malicious act on the part of the workmen, employ , third parties.
 *  Burglary.
 *  Hail.
 *  Subsidence, Landslide, rockslide,
 *  Avalanche
 * @ORM\Entity
 * @ORM\Table(name="electronic_scope_of_cover")
 * 
 * @author otaba
 *        
 */
class ElectronicEquipmentScopeOfCover
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(name="scope", type="string", nullable=true)
     * 
     * @var string
     */
    private $scope;

    /**
     */
    public function __construct()
    {
        
        // TODO - Insert your code here
    }
    /**
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return the $scope
     */
    public function getScope()
    {
        return $this->scope;
    }

    /**
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param string $scope
     */
    public function setScope($scope)
    {
        $this->scope = $scope;
        return $this;
    }

}

