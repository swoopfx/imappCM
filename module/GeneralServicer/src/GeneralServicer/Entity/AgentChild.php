<?php
namespace GeneralServicer\Entity;

use Doctrine\ORM\Mapping as ORM;
use CsnUser\Entity\User;
use Users\Entity\InsuranceAgent;

/**
 * @ORM\Table(name="agent_child")
 * @ORM\Entity
 *
 * @author swoopfx
 *        
 */
class AgentChild
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Users\Entity\InsuranceAgent")
     * @ORM\JoinColumn(name="agent_id", referencedColumnName="id")
     *
     * @var InsuranceAgent
     */
    protected $agent;

    /**
     * @ORM\ManyToOne(targetEntity="CsnUser\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * 
     * @var User
     */
    protected $user;

    public function __construct()
    {}

    public function getId()
    {
        return $this->getId();
    }

    public function getAgent()
    {
        return $this->agent;
    }

    public function setAgent($broker)
    {
        $this->agent = $broker;
        
        return $this;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($uid)
    {
        $this->user = $uid;
        
        return $this;
    }
}

