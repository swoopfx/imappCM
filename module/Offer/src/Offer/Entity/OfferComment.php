<?php
namespace Offer\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OfferComment
 *
 * @ORM\Table(name="offer_comment", indexes={@ORM\Index(name="FK_comments_offer_idx", columns={"offer_id"})})
 * @ORM\Entity
 */
class OfferComment
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
     * @var string @ORM\Column(name="comment", type="text", nullable=true)
     */
    private $comment;

    /**
     *
     * @var \DateTime @ORM\Column(name="date_entered", type="datetime", nullable=true)
     */
    private $dateEntered;

    /**
     *
     * @var \DateTime @ORM\Column(name="date_modified", type="datetime", nullable=true)
     */
    private $dateModified;

    /**
     *
     * @var \Offer\Entity\Offer @ORM\ManyToOne(targetEntity="Offer\Entity\Offer")
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
     * Set comment
     *
     * @param string $comment            
     * @return OfferComment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
        
        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set dateEntered
     *
     * @param \DateTime $dateEntered            
     * @return OfferComment
     */
    public function setDateEntered($dateEntered)
    {
        $this->dateEntered = $dateEntered;
        
        return $this;
    }

    /**
     * Get dateEntered
     *
     * @return \DateTime
     */
    public function getDateEntered()
    {
        return $this->dateEntered;
    }

    /**
     * Set dateModified
     *
     * @param \DateTime $dateModified            
     * @return OfferComment
     */
    public function setDateModified($dateModified)
    {
        $this->dateModified = $dateModified;
        
        return $this;
    }

    /**
     * Get dateModified
     *
     * @return \DateTime
     */
    public function getDateModified()
    {
        return $this->dateModified;
    }

    /**
     * Set offer
     *
     * @param \Offer\Entity\Offer $offer            
     * @return OfferComment
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
