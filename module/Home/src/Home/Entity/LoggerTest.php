<?php
namespace Home\Entity;

use Doctrine\ORM\Mapping as ORM;
use CsnUser\Entity\User;

/**
 * @ORM\Entity
 * @ORM\Table(name="logger_test");
 * @author otaba
 *
 */
class LoggerTest
{
    /**
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     *
     * @var integer
     */
    private $id;
    
    /**
     * @ORM\Column(name="logged_date", type="datetime", nullable=true)
     * @var \DateTime
     */
    private $loggedDate;
    
    /**
     * @ORM\ManyToOne(targetEntity="CsnUser\Entity\User")
     * @var User
     */
    private $user;
    /**
     * @return number
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \DateTime
     */
    public function getLoggedDate()
    {
        return $this->loggedDate;
    }

    /**
     * @return \CsnUser\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param \DateTime $loggedDate
     */
    public function setLoggedDate($loggedDate)
    {
        $this->loggedDate = $loggedDate;
        return $this;
    }

    /**
     * @param \CsnUser\Entity\User $user
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

   
}

