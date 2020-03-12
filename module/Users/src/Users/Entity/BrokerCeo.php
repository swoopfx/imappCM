<?php
namespace Users\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="broker_ceo")
 * 
 * @author otaba
 *        
 */
class BrokerCeo
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(name="firstname", type="string", nullable=true)
     * 
     * @var string
     */
    private $firstname;

    /**
     * @ORM\Column(name="lastname", type="string", nullable=true)
     * 
     * @var string
     */
    private $lastname;

    /**
     * @ORM\Column(name="email", type="string", nullable=true)
     * 
     * @var string
     */
    private $email;

    /**
     * @ORM\Column(name="phone", type="string", nullable=true)
     * 
     * @var string
     */
    private $phone;

    /**
     * @ORM\Column(name="linked_in", type="string", nullable=true)
     * 
     * @var string
     */
    private $linkedIn;

    /**
     * @ORM\Column(name="facebook", type="string", nullable=true)
     * 
     * @var string
     */
    private $facebook;

    /**
     * @ORM\Column(name="tweeter", type="string", nullable=true)
     * 
     * @var string
     */
    private $tweeter;

    /**
     * @ORM\OneToOne(targetEntity="Users\Entity\InsuranceBrokerRegistered", inversedBy="ceo")
     * 
     * @var InsuranceBrokerRegistered
     */
    private $broker;
    
    
    /**
     * @ORM\Column(name="created_on", type="datetime", nullable=true)
     * @var \DateTime
     */
    private $createdOn;
    
    /**
     * @ORM\Column(name="updated_on", type="datetime", nullable=true)
     * @var \DateTime
     */
    private $updatedOn;

    public function getId()
    {
        return $this->id;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function setFirstname($name)
    {
        $this->firstname = $name;
        return $this;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function setLastname($name)
    {
        $this->lastname = $name;
        return $this;
    }
    
    public function getFullName(){
        return $this->lastname." ".$this->firstname;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    public function getLinkedIn()
    {
        return $this->linkedIn;
    }

    public function setLinkedIn($link)
    {
        $this->linkedIn = $link;
        return $this;
    }

    public function setFacebook($book)
    {
        $this->facebook = $book;
        return $this;
    }

    public function getFacebook()
    {
        return $this->facebook;
    }

    public function getTweeter()
    {
        return $this->tweeter;
    }

    public function setTweeter($tweet)
    {
        $this->tweeter = $tweet;
        return $this;
    }

    public function getBroker()
    {
        return $this->broker;
    }

    public function setBroker($broker)
    {
        $this->broker = $broker;
        return $this;
    }
    
    public function getCreatedOn(){
        return $this->createdOn;
    }
    
    public function setCreatedOn($date){
        $this->createdOn = $date;
        $this->updatedOn = $date;
        return $this;
    }
    
    public function setUpdatedOn($date){
        $this->updatedOn = $date;
        return $this;
    }
    
    public function getUpdatedOn(){
        return $this->updatedOn;
    }
}

