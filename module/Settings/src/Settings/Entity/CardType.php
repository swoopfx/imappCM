<?php
namespace All\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CardType
 *
 * @ORM\Table(name="card_type")
 * @ORM\Entity
 */
class CardType
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
     * @var string @ORM\Column(name="card_type_name", type="string", length=100, nullable=true)
     */
    private $cardTypeName;

    /**
     *
     * @var string @ORM\Column(name="card_type_logo", type="string", length=100, nullable=true)
     */
    private $cardTypeLogo;

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
     * Set cardTypeName
     *
     * @param string $cardTypeName            
     *
     * @return CardType
     */
    public function setCardTypeName($cardTypeName)
    {
        $this->cardTypeName = $cardTypeName;
        
        return $this;
    }

    /**
     * Get cardTypeName
     *
     * @return string
     */
    public function getCardTypeName()
    {
        return $this->cardTypeName;
    }

    /**
     * Set cardTypeLogo
     *
     * @param string $cardTypeLogo            
     *
     * @return CardType
     */
    public function setCardTypeLogo($cardTypeLogo)
    {
        $this->cardTypeLogo = $cardTypeLogo;
        
        return $this;
    }

    /**
     * Get cardTypeLogo
     *
     * @return string
     */
    public function getCardTypeLogo()
    {
        return $this->cardTypeLogo;
    }
}
