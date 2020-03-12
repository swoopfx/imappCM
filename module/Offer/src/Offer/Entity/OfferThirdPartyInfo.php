<?php
namespace Offer\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OfferThirdPartyInfo
 *
 * @ORM\Table(name="offer_third_party_info")
 * @ORM\Entity
 */
class OfferThirdPartyInfo
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
     * @var string @ORM\Column(name="third_party_name", type="string", length=200, nullable=true)
     */
    private $thirdPartyName;

    /**
     *
     * @var string @ORM\Column(name="third_party_phone", type="string", length=200, nullable=true)
     */
    private $thirdPartyPhone;

    /**
     *
     * @var string @ORM\Column(name="third_party_email", type="string", length=200, nullable=false)
     */
    private $thirdPartyEmail;

    /**
     *
     * @var integer @ORM\Column(name="offer_id", type="integer", nullable=true)
     */
    private $offerId;

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
     * Set thirdPartyName
     *
     * @param string $thirdPartyName            
     *
     * @return OfferThirdPartyInfo
     */
    public function setThirdPartyName($thirdPartyName)
    {
        $this->thirdPartyName = $thirdPartyName;
        
        return $this;
    }

    /**
     * Get thirdPartyName
     *
     * @return string
     */
    public function getThirdPartyName()
    {
        return $this->thirdPartyName;
    }

    /**
     * Set thirdPartyPhone
     *
     * @param string $thirdPartyPhone            
     *
     * @return OfferThirdPartyInfo
     */
    public function setThirdPartyPhone($thirdPartyPhone)
    {
        $this->thirdPartyPhone = $thirdPartyPhone;
        
        return $this;
    }

    /**
     * Get thirdPartyPhone
     *
     * @return string
     */
    public function getThirdPartyPhone()
    {
        return $this->thirdPartyPhone;
    }

    /**
     * Set thirdPartyEmail
     *
     * @param string $thirdPartyEmail            
     *
     * @return OfferThirdPartyInfo
     */
    public function setThirdPartyEmail($thirdPartyEmail)
    {
        $this->thirdPartyEmail = $thirdPartyEmail;
        
        return $this;
    }

    /**
     * Get thirdPartyEmail
     *
     * @return string
     */
    public function getThirdPartyEmail()
    {
        return $this->thirdPartyEmail;
    }

    /**
     * Set offerId
     *
     * @param integer $offerId            
     *
     * @return OfferThirdPartyInfo
     */
    public function setOfferId($offerId)
    {
        $this->offerId = $offerId;
        
        return $this;
    }

    /**
     * Get offerId
     *
     * @return integer
     */
    public function getOfferId()
    {
        return $this->offerId;
    }
}
