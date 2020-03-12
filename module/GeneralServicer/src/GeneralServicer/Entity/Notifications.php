<?php
namespace GeneralServicer\Entity;

use Doctrine\ORM\Mapping as ORM;
use Settings\Entity\NotificationType;
use CsnUser\Entity\User;
use Users\Entity\InsuranceBrokerRegistered;

/**
 *
 * @ORM\Entity(repositoryClass="GeneralServicer\Entity\Repository\NotificationsRepository")
 * @ORM\Table(name="notifications")
 *
 * @author otaba
 *        
 */
class Notifications
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
     * @ORM\ManyToOne(targetEntity="Settings\Entity\NotificationType")
     *
     * @var NotificationType
     */
    private $notificationType;

    /**
     *
     * @ORM\Column(name="topic", type="string", nullable=true)
     * @var string
     */
    private $topic;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Users\Entity\InsuranceBrokerRegistered")
     * @var InsuranceBrokerRegistered
     */
    private $recipientBroker;

    /**
     *
     * @ORM\Column(name="notification_url", type="string", nullable=true)
     *
     * @var string
     */
    private $notificationUrl;

    /**
     *
     * @ORM\Column(name="message", type="string", nullable=true)
     *
     * @var string
     */
    private $message;

    /**
     * Defines who initited the Notification
     * Options are either broker or cutomer
     *
     * @ORM\ManyToOne(targetEntity="CsnUser\Entity\User")
     * @var User
     */
    private $initiator;

    /**
     * Intended Recipeint of the Notification
     *
     * @ORM\ManyToOne(targetEntity="CsnUser\Entity\User")
     * @var User
     */
    private $recipient;

    /**
     *
     * @ORM\Column(name="created_on", type="datetime", nullable=true)
     *
     * @var string
     */
    private $createdOn;

    /**
     * This smust be used whenever the the action is true
     *
     * @ORM\Column(name="is_read", type="boolean", nullable=true, options={"default" : 0})
     * @var boolean
     */
    private $isRead;

    /**
     * Defines if the notification should be one the recipent needs to to action on
     *
     * @ORM\Column(name="is_action", type="boolean", nullable=true, options={"default" : 0})
     * @var boolean
     */
    private $isAction;

    public function __construct()
    {}

    public function getId()
    {
        return $this->id;
    }

    public function getNotificationType()
    {
        return $this->notificationType;
    }

    public function setNotificationType($note)
    {
        $this->notificationType = $note;
        return $this;
    }

    public function getNotificationUrl()
    {
        return $this->notificationUrl;
    }

    public function setNotificationUrl($url)
    {
        $this->notificationUrl = $url;
        return $this;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    public function setCreatedOn($date)
    {
        $this->createdOn = $date;
        return $this;
    }

    public function getInvoice()
    {
        return $this->invoice;
    }

    public function setInvoice($inv)
    {
        $this->invoice = $inv;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getTopic()
    {
        return $this->topic;
    }

    /**
     *
     * @param string $topic
     */
    public function setTopic($topic)
    {
        $this->topic = $topic;
        return $this;
    }

    /**
     *
     * @return \CsnUser\Entity\User
     */
    public function getInitiator()
    {
        return $this->initiator;
    }

    /**
     *
     * @return \CsnUser\Entity\User
     */
    public function getRecipient()
    {
        return $this->recipient;
    }

    /**
     *
     * @return boolean
     */
    public function getIsRead()
    {
        return $this->isRead;
    }

    /**
     *
     * @return boolean
     */
    public function getIsAction()
    {
        return $this->isAction;
    }

    /**
     *
     * @param \CsnUser\Entity\User $initiator
     */
    public function setInitiator($initiator)
    {
        $this->initiator = $initiator;
        return $this;
    }

    /**
     *
     * @param \CsnUser\Entity\User $recipient
     */
    public function setRecipient($recipient)
    {
        $this->recipient = $recipient;
        return $this;
    }

    /**
     *
     * @param boolean $isRead
     */
    public function setIsRead($isRead)
    {
        $this->isRead = $isRead;
        return $this;
    }

    /**
     *
     * @param boolean $isAction
     */
    public function setIsAction($isAction)
    {
        $this->isAction = $isAction;
        return $this;
    }
    /**
     * @return \Users\Entity\InsuranceBrokerRegistered
     */
    public function getRecipientBroker()
    {
        return $this->recipientBroker;
    }

    /**
     * @param \Users\Entity\InsuranceBrokerRegistered $recipientBroker
     */
    public function setRecipientBroker($recipientBroker)
    {
        $this->recipientBroker = $recipientBroker;
        return $this;
    }

}

