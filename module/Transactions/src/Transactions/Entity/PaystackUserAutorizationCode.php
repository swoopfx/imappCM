<?php
namespace Transactions\Entity;

use Doctrine\ORM\Mapping as ORM;
use CsnUser\Entity\User;

/**
 * @ORM\Entity
 * @ORM\Table(name="paystack_user_authorization")
 *
 * @author otaba
 *        
 */
class PaystackUserAutorizationCode
{

    /**
     *
     * @var integer This is only genertated upon successful transaction
     *      @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="CsnUser\Entity\User")
     *
     * @var User
     */
    private $user;

    /**
     * @ORM\Column(name="authorization_code", type="string", nullable=false)
     *
     * @var string
     */
    private $authorizatioCode;

    /**
     * @ORM\Column(name="bin", type="string", nullable=true)
     *
     * @var string
     */
    private $bin;

    /**
     * This represents the last four digit of the card
     * @ORM\Column(name="last_four", type="string", nullable=true)
     *
     * @var string
     */
    private $lastFour;

    /**
     * @ORM\Column(name="exp_month", type="string", nullable=true)
     *
     * @var string
     */
    private $expMonth;

    /**
     * @ORM\Column(name="exp_year", type="string", nullable=true)
     *
     * @var string
     */
    private $expYear;

    /**
     * @ORM\Column(name="bank", type="string", nullable=true)
     *
     * @var string
     */
    private $bank;

    /**
     * This is the brand of the card used , visa, mastercard
     * @ORM\Column(name="brand", type="string", nullable=true)
     *
     * @var string
     */
    private $brand;

    /**
     * @ORM\Column(name="signature", type="string", nullable=true)
     *
     * @var string
     */
    private $signature;

    /**
     * @ORM\Column(name="created_on", type="datetime", nullable=true)
     *
     * @var datetime
     */
    private $createdOn;

    /**
     * @ORM\Column(name="updated_on", type="datetime", nullable=true)
     *
     * @var datetime
     */
    private $updatedOn;

    /**
     * @ORM\COlumn(name="is_hidden", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isHidden;

    /**
     */
    public function __construct()
    {
        
       
    }

    public function getId()
    {
        return $this->id;
    }
    
    public function getUser(){
        return $this->user;
    }
    
    public function setUser($user){
        $this->user = $user;
        return $this;
    }

    public function getAuthorizatioCode()
    {
        return $this->authorizatioCode;
    }

    public function setAuthorizatioCode($auth)
    {
        $this->authorizatioCode = $auth;
        return $this;
    }

    public function getBin()
    {
        return $this->bin;
    }

    public function setBin($bin)
    {
        $this->bin = $bin;
        return $this;
    }

    public function getLastFour()
    {
        return $this->lastFour;
    }

    public function setLastFour($four)
    {
        $this->lastFour = $four;
        return $this;
    }

    public function getExpMonth()
    {
        return $this->expMonth;
    }

    public function setExpMonth($mth)
    {
        $this->expMonth = $mth;
        return $this;
    }

    public function getExpYear()
    {
        return $this->expYear;
    }

    public function setExpYear($year)
    {
        $this->expYear = $year;
        return $this;
    }

    public function getBank()
    {
        return $this->bank;
    }

    public function setBank($bank)
    {
        $this->bank = $bank;
        return $this;
    }

    public function getBrand()
    {
        return $this->brand;
    }

    public function setBrand($brand)
    {
        $this->brand = $brand;
        return $this;
    }

    public function getSignature()
    {
        return $this->signature;
    }

    public function setSignature($sign)
    {
        $this->signature = $sign;
        return $this;
    }

    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    public function setCreatedOn($date)
    {
        $this->createdOn = $date;
        $this->updatedOn = $date;
        return $this;
    }

    public function getUpdatedOn()
    {
        return $this->updatedOn;
    }

    public function setUpdatedOn($date)
    {
        $this->updatedOn = $date;
        return $this;
    }

    public function getIsHidden()
    {
        return $this->isHidden;
    }

    public function setisHidden($hide)
    {
        $this->isHidden = $hide;
        return $this;
    }
}

