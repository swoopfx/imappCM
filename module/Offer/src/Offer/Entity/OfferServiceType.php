<?php
namespace Offer\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This include the type of service required eg.
 * motor insurance , personal insurance
 *
 * @author swoopfx
 *        
 */
/**
 * OfferServiceType
 *
 * @ORM\Table(name="offer_service_type")
 * @ORM\Entity
 */
class OfferServiceType
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
     * @var string @ORM\Column(name="offer_service", type="string", length=300, nullable=false)
     */
    private $offerService;

    /**
     *
     * @return number
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     *
     * @return string
     */
    public function getOfferService()
    {
        return $this->offerService;
    }

    /**
     *
     * @param unknown $offerService            
     * @return \Settings\Entity\OfferServiceType
     */
    public function setOfferService($offerService)
    {
        $this->offerService = $offerService;
        return $this;
    }
}

?>