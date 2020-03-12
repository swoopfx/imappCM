<?php
namespace Settings\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InsuranceSpecificService
 *
 * @ORM\Table(name="insurance_specific_service")
 * @ORM\Entity
 */
class InsuranceSpecificService
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
     * @var OfferServiceType @ORM\ManyToOne(targetEntity="Settings\Entity\InsuranceServiceType")
     *      @ORM\JoinColumn(name="insurance_service_id", referencedColumnName="id")
     *     
     */
    private $insuranceServiceType;

    /**
     * @ORM\Column(name="specific_service", type="string")
     *
     * @var unknown
     */
    private $specificService;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\CommisionType")
     * @ORM\JoinColumn(name="commision_type", referencedColumnName="id")
     * 
     * @var CommisionType
     */
    private $commisionType;
    
    /**
     * @ORM\Column(name="description", type="text", nullable=true)
     * @var text 
     */
    private $description;

    public function getId()
    {
        return $this->id;
    }

    public function setSpecificService($service)
    {
        $this->specificService = $service;
        return $this;
    }

    public function getSpecificService()
    {
        return $this->specificService;
    }

    public function getInsuranceServiceType()
    {
        return $this->insuranceServiceType;
    }

    public function setInsuranceServiceType($offer)
    {
        $this->insuranceServiceType = $offer;
        return $this;
    }

    public function getCommisionType()
    {
        return $this->commisionType;
    }

    public function setCommisionType($type)
    {
        $this->commisionType;
        return $this;
    }
    
    public function getDescription(){
        return $this->description;
    }
    
    public function setDescription($desc){
        $this->description = $desc;
        return $this;
    }
}

?>