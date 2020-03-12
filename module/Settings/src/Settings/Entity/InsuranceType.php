<?php
namespace Settings\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * This is used by the system to categorize the specific insurance services 
 * So a service can be categorized to more than one insurance type
 * @ORM\Entity
 * @ORM\Table(name="insurance_type")
 * @ORM\Entity(repositoryClass="Settings\Entity\Repository\InsuranceTypeRepository")
 * @author swoopfx
 *        
 */
class InsuranceType
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     *
     * @var string @ORM\Column(name="type", type="string", length=200, nullable=false)
     */
    private $type;
    
    public function __construct()
    {}
    
    /**
     * 
     * @return number
     */
    public function getId(){
        
        return $this->id;
    }
    
    /**
     * 
     * @param InsuranceType $type
     * @return \Settings\Entity\InsuranceType
     */
    public function setType($type){
        $this->type = $type;
        return $this;
    }
    
    /**
     * 
     * @return string
     */
    public function getType(){
        return $this->type;
    }
}

