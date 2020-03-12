<?php
namespace Offer\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OfferSpecificService
 *
 * @ORM\Table(name="offer_specific_service")
 * @ORM\Entity
 */
class OfferSpecificService
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
     * @var OfferServiceType @ORM\ManyToOne(targetEntity="OfferServiceType")
     *      @ORM\JoinColumn(name="offer_service_id", referencedColumnName="id")
     *     
     */
    private $offerServiceType;

    /**
     * @ORM\Column(name="specific_service", type="string")
     *
     * @var unknown
     */
    private $specificService;

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

    public function getOfferServiceType()
    {
        return $this->offerServiceType;
    }

    public function setOfferServiceType($offer)
    {
        $this->offerServiceType = $offer;
        return $this;
    }
}

?>