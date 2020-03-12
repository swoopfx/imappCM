<?php
namespace Settings\Entity;

use Doctrine\ORM\Mapping as ORM;
use Settings\Entity\InsuranceType;
use Doctrine\Common\Collections\Collection;

/**
 * This include the type of service required eg.
 * motor insurance , personal insurance
 *
 * @author swoopfx
 *        
 */
/**
 * InsuranceServiceType
 *
 * @ORM\Table(name="insurance_service_type")
 * @ORM\Entity
 */
class InsuranceServiceType
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
     * @var string @ORM\Column(name="insurance_service", type="string", length=300, nullable=false)
     */
    private $insuranceService;
    
    /**This defines if the insurance service is life or non life insurance  or composite
     * @var Collection
     * @ORM\ManyToMany(targetEntity="Settings\Entity\InsuranceType", , inversedBy="assignedChildBroker")
     * InsuranceType
     */
    private $insuraceServiceCategory;

    /**
     * This checks if the package is active 
     * It appears in the categories 
     * @var boolean@ORM\Column(name="is_active", type="boolean", nullable=false)
     */
    
    private $isActive;
   
    
    public function getId()
    {
        return $this->id;
    }

    /**
     *
     * @return string
     */
    public function getInsuranceService()
    {
        return $this->insuranceService;
    }

    /**
     *
     * @param unknown $offerService            
     * @return \Settings\Entity\InsuranceServiceType
     */
    public function setInsuranceService($offerService)
    {
        $this->insuranceService = $offerService;
        return $this;
    }
    
    public function getInsuraceServiceCategory(){
        return $this->insuraceServiceCategory;
    }
    
    public function addInsuraceServiceCategory($ins){
        foreach ($ins as $insurance){
            $this->insuraceServiceCategory[] = $insurance;
        }
    }
}

?>