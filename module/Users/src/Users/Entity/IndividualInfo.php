<?php
namespace Users\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IndividualInfo
 *
 * @ORM\Table(name="individual_info", uniqueConstraints={@ORM\UniqueConstraint(name="user_id_UNIQUE", columns={"user_id"})})
 * @ORM\Entity
 */
class IndividualInfo
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
     * @var string @ORM\Column(name="firstname", type="string", length=100, nullable=false)
     */
    private $firstname;

    /**
     *
     * @var string @ORM\Column(name="lastname", type="string", length=100, nullable=false)
     */
    private $lastname;

    /**
     *
     * @var string @ORM\Column(name="othername", type="string", length=100, nullable=true)
     */
    private $othername;

    /**
     *
     * @var date @ORM\Column(name="dob", type="date", length=100, nullable=true)
     */
    private $dob;

    /**
     *
     * @var integer @ORM\Column(name="created_on", type="datetime", nullable=true)
     */
    private $createdOn;

    /**
     *
     * @var integer @ORM\Column(name="updated_on", type="datetime", nullable=true)
     */
    private $updatedOn;

    /**
     *
     * @var \CsnUser\Entity\User @ORM\ManyToOne(targetEntity="CsnUser\Entity\User")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *      })
     */
    private $user;

    /**
     *
     * @var \Users\Entity\IndividualContact @ORM\OneToOne(targetEntity="Users\Entity\IndividualContact", cascade={"persist", "remove"})
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="contact_id", referencedColumnName="id")
     *      })
     */
    private $contact;

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
     * Set firstname
     *
     * @param string $firstname            
     * @return IndividualInfo
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
        
        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname            
     * @return IndividualInfo
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
        
        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set othername
     *
     * @param string $othername            
     * @return IndividualInfo
     */
    public function setOthername($othername)
    {
        $this->othername = $othername;
        
        return $this;
    }

    /**
     * Get othername
     *
     * @return string
     */
    public function getOthername()
    {
        return $this->othername;
    }

    /**
     * Set dob
     *
     * @param string $dob            
     * @return IndividualInfo
     */
    public function setDob($dob)
    {
        $this->dob = $dob;
        
        return $this;
    }

    /**
     * Get dob
     *
     * @return string
     */
    public function getDob()
    {
        return $this->dob;
    }

    /**
     * Set createdOn
     *
     * @param \DateTime $createdOn            
     * @return IndividualInfo
     */
    public function setCreatedOn($createdOn)
    {
        $this->createdOn = $createdOn;
        
        return $this;
    }

    /**
     * Get createdOn
     *
     * @return integer
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    /**
     * Set updatedOn
     *
     * @param integer $updatedOn            
     * @return IndividualInfo
     */
    public function setUpdatedOn($updatedOn)
    {
        $this->updatedOn = $updatedOn;
        
        return $this;
    }

    /**
     * Get updatedOn
     *
     * @return integer
     */
    public function getUpdatedOn()
    {
        return $this->updatedOn;
    }

    /**
     * Set user
     *
     * @param \CsnUser\Entity\User $user            
     * @return IndividualInfo
     */
    public function setUser(\CsnUser\Entity\User $user)
    {
        $this->user = $user;
        
        return $this;
    }

    /**
     * Get user
     *
     * @return \CsnUser\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    public function getContact()
    {
        return $this->contact;
    }

    public function setContact($cc)
    {
        $this->contact = $cc;
        return $this;
    }
}
