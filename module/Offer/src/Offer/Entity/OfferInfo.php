<?php
namespace Offer\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OfferInfo
 *
 * @ORM\Table(name="offer_info", indexes={@ORM\Index(name="FK_additional_info_offer_idx", columns={"offer_id"})})
 * @ORM\Entity
 */
class OfferInfo
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
     * @var string @ORM\Column(name="additional_info1", type="text", nullable=true)
     */
    private $additionalInfo1;

    /**
     *
     * @var string @ORM\Column(name="additional_info2", type="text", nullable=true)
     */
    private $additionalInfo2;

    /**
     *
     * @var \DateTime @ORM\Column(name="date_created", type="datetime", nullable=true)
     */
    private $dateCreated;

    /**
     *
     * @var \DateTime @ORM\Column(name="date_updated", type="datetime", nullable=true)
     */
    private $dateUpdated;

    /**
     *
     * @var \Work\Entity\Offer @ORM\ManyToOne(targetEntity="Offer\Entity\Offer")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="offer_id", referencedColumnName="id")
     *      })
     */
    private $offer;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set additionalInfo1
     *
     * @param string $additionalInfo1            
     * @return OfferInfo
     */
    public function setAdditionalInfo1($additionalInfo1)
    {
        $this->additionalInfo1 = $additionalInfo1;
        
        return $this;
    }

    /**
     * Get additionalInfo1
     *
     * @return string
     */
    public function getAdditionalInfo1()
    {
        return $this->additionalInfo1;
    }

    /**
     * Set additionalInfo2
     *
     * @param string $additionalInfo2            
     * @return OfferInfo
     */
    public function setAdditionalInfo2($additionalInfo2)
    {
        $this->additionalInfo2 = $additionalInfo2;
        
        return $this;
    }

    /**
     * Get additionalInfo2
     *
     * @return string
     */
    public function getAdditionalInfo2()
    {
        return $this->additionalInfo2;
    }

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated            
     * @return OfferInfo
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;
        
        return $this;
    }

    /**
     * Get dateCreated
     *
     * @return \DateTime
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * Set dateUpdated
     *
     * @param \DateTime $dateUpdated            
     * @return OfferInfo
     */
    public function setDateUpdated($dateUpdated)
    {
        $this->dateUpdated = $dateUpdated;
        
        return $this;
    }

    /**
     * Get dateUpdated
     *
     * @return \DateTime
     */
    public function getDateUpdated()
    {
        return $this->dateUpdated;
    }

    /**
     * Set offer
     *
     * @param \Offer\Entity\Offer $offer            
     * @return OfferInfo
     */
    public function setOffer(\Offer\Entity\Offer $offer = null)
    {
        $this->offer = $offer;
        
        return $this;
    }

    /**
     * Get offer
     *
     * @return \Work\Entity\Offer
     */
    public function getOffer()
    {
        return $this->offer;
    }
}
