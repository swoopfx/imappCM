<?php
namespace Policy\Entity;

use Doctrine\ORM\Mapping as ORM;
use GeneralServicer\Entity\Notifications;

/**
 *
 * @ORM\Entity
 * @ORM\Table(name="policy_notification")
 * @author otaba
 *        
 */
class PolicyNotification
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
     * @ORM\ManyToOne(targetEntity="GeneralServicer\Entity\Notifications")
     * @var Notifications
     */
    private $notification;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Policy", inversedBy="policyActivity")
     * @var Policy
     */
    private $policy;

    // TODO - Insert your code here
    public function __construct()
    {

        // TODO - Insert your code here
    }
    /**
     * @return number
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \GeneralServicer\Entity\Notifications
     */
    public function getNotification()
    {
        return $this->notification;
    }

    /**
     * @return \Policy\Entity\Policy
     */
    public function getPolicy()
    {
        return $this->policy;
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
     * @param \GeneralServicer\Entity\Notifications $notification
     */
    public function setNotification($notification)
    {
        $this->notification = $notification;
        return $this;
    }

    /**
     * @param \Policy\Entity\Policy $policy
     */
    public function setPolicy($policy)
    {
        $this->policy = $policy;
        return $this;
    }

}

