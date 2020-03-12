<?php
namespace Transactions\Entity;

use Doctrine\ORM\Mapping as ORM;
use CsnUser\Entity\User;

/**
 * This calls saves details of the card used
 * @ORM\Entity
 * @ORM\Table(name="rave_card_token")
 *
 * @author otaba
 *        
 */
class RaveCardToken
{

    /**
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var integer
     */
    private $id;

    /**
     * @ORM\Column(name="card_expiry_month", type="string", nullable=true)
     *
     * @var string
     */
    private $cardExpiryMonth;

    /**
     * @ORM\Column(name="card_expiry_year", type="string", nullable=true)
     *
     * @var string
     */
    private $cardExpiryYear;

    /**
     * @ORM\Column(name="customer_phone", type="string", nullable=true)
     *
     * @var string
     */
    private $customerPhone;

    /**
     * @ORM\Column(name="embeded_token", type="string", nullable=true)
     *
     * @var string
     */
    private $embededToken;

    /**
     * @ORM\Column(name="short_code", type="string", nullable=true)
     *
     * @var string
     */
    private $shortcode;

    /**
     * @ORM\Column(name="last_4_digit", type="string", nullable=true)
     *
     * @var string
     */
    private $last4Digit;

    /**
     * @ORM\Column(name="created_on", type="datetime", nullable=true)
     *
     * @var string
     */
    private $createdOn;
    
    /**
     * @ORM\OneToOne(targetEntity="CsnUser\Entity\User")
     * @var User
     */
    private $user;

    /**
     */
    public function __construct()
    {
        
        // TODO - Insert your code here
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCardExpiryMonth()
    {
        return $this->cardExpiryMonth;
    }

    public function setCardExpiryMonth($moth)
    {
        $this->cardExpiryMonth = $moth;
        return $this;
    }

    public function getCardExpiryYear()
    {
        return $this->cardExpiryYear;
    }

    public function setCardExpiryYear($year)
    {
        $this->cardExpiryYear = $year;
        return $this;
    }

    public function getCustomerPhone()
    {
        return $this->customerPhone;
    }

    public function setCustomerPhone($phone)
    {
        $this->customerPhone = $phone;
        return $this;
    }

    public function getEmbededToken()
    {
        return $this->embededToken;
    }

    public function setEmbededToken($token)
    {
        $this->embededToken = $token;
        return $this;
    }

    public function getShortcode()
    {
        return $this->shortcode;
    }

    public function setShortcode($code)
    {
        $this->shortcode = $code;
        return $this;
    }

    public function getLast4Digit()
    {
        return $this->last4Digit;
    }

    public function setLast4Digit($digit)
    {
        $this->last4Digit = $digit;
        return $this;
    }

    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    public function setCreatedOn($set)
    {
        $this->createdOn = $set;
        return $this;
    }
    
    public function getUser(){
        return $this->user;
    }
    
    public function setUser($user){
        $this->user = $user;
        return $this;
    }
}

