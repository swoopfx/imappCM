<?php

namespace DoctrineORMModule\Proxy\__CG__\GeneralServicer\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Notifications extends \GeneralServicer\Entity\Notifications implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Proxy\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Proxy\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Common\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array<string, null> properties to be lazy loaded, indexed by property name
     */
    public static $lazyPropertiesNames = array (
);

    /**
     * @var array<string, mixed> default values of properties to be lazy loaded, with keys being the property names
     *
     * @see \Doctrine\Common\Proxy\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = array (
);



    public function __construct(?\Closure $initializer = null, ?\Closure $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return ['__isInitialized__', '' . "\0" . 'GeneralServicer\\Entity\\Notifications' . "\0" . 'id', '' . "\0" . 'GeneralServicer\\Entity\\Notifications' . "\0" . 'notificationType', '' . "\0" . 'GeneralServicer\\Entity\\Notifications' . "\0" . 'topic', '' . "\0" . 'GeneralServicer\\Entity\\Notifications' . "\0" . 'recipientBroker', '' . "\0" . 'GeneralServicer\\Entity\\Notifications' . "\0" . 'notificationUrl', '' . "\0" . 'GeneralServicer\\Entity\\Notifications' . "\0" . 'message', '' . "\0" . 'GeneralServicer\\Entity\\Notifications' . "\0" . 'initiator', '' . "\0" . 'GeneralServicer\\Entity\\Notifications' . "\0" . 'recipient', '' . "\0" . 'GeneralServicer\\Entity\\Notifications' . "\0" . 'createdOn', '' . "\0" . 'GeneralServicer\\Entity\\Notifications' . "\0" . 'isRead', '' . "\0" . 'GeneralServicer\\Entity\\Notifications' . "\0" . 'isAction'];
        }

        return ['__isInitialized__', '' . "\0" . 'GeneralServicer\\Entity\\Notifications' . "\0" . 'id', '' . "\0" . 'GeneralServicer\\Entity\\Notifications' . "\0" . 'notificationType', '' . "\0" . 'GeneralServicer\\Entity\\Notifications' . "\0" . 'topic', '' . "\0" . 'GeneralServicer\\Entity\\Notifications' . "\0" . 'recipientBroker', '' . "\0" . 'GeneralServicer\\Entity\\Notifications' . "\0" . 'notificationUrl', '' . "\0" . 'GeneralServicer\\Entity\\Notifications' . "\0" . 'message', '' . "\0" . 'GeneralServicer\\Entity\\Notifications' . "\0" . 'initiator', '' . "\0" . 'GeneralServicer\\Entity\\Notifications' . "\0" . 'recipient', '' . "\0" . 'GeneralServicer\\Entity\\Notifications' . "\0" . 'createdOn', '' . "\0" . 'GeneralServicer\\Entity\\Notifications' . "\0" . 'isRead', '' . "\0" . 'GeneralServicer\\Entity\\Notifications' . "\0" . 'isAction'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Notifications $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy::$lazyPropertiesDefaults as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', []);
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', []);
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @deprecated no longer in use - generated code now relies on internal components rather than generated public API
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getId', []);

        return parent::getId();
    }

    /**
     * {@inheritDoc}
     */
    public function getNotificationType()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNotificationType', []);

        return parent::getNotificationType();
    }

    /**
     * {@inheritDoc}
     */
    public function setNotificationType($note)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setNotificationType', [$note]);

        return parent::setNotificationType($note);
    }

    /**
     * {@inheritDoc}
     */
    public function getNotificationUrl()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNotificationUrl', []);

        return parent::getNotificationUrl();
    }

    /**
     * {@inheritDoc}
     */
    public function setNotificationUrl($url)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setNotificationUrl', [$url]);

        return parent::setNotificationUrl($url);
    }

    /**
     * {@inheritDoc}
     */
    public function getMessage()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMessage', []);

        return parent::getMessage();
    }

    /**
     * {@inheritDoc}
     */
    public function setMessage($message)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setMessage', [$message]);

        return parent::setMessage($message);
    }

    /**
     * {@inheritDoc}
     */
    public function getCreatedOn()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCreatedOn', []);

        return parent::getCreatedOn();
    }

    /**
     * {@inheritDoc}
     */
    public function setCreatedOn($date)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCreatedOn', [$date]);

        return parent::setCreatedOn($date);
    }

    /**
     * {@inheritDoc}
     */
    public function getInvoice()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getInvoice', []);

        return parent::getInvoice();
    }

    /**
     * {@inheritDoc}
     */
    public function setInvoice($inv)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setInvoice', [$inv]);

        return parent::setInvoice($inv);
    }

    /**
     * {@inheritDoc}
     */
    public function getTopic()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTopic', []);

        return parent::getTopic();
    }

    /**
     * {@inheritDoc}
     */
    public function setTopic($topic)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setTopic', [$topic]);

        return parent::setTopic($topic);
    }

    /**
     * {@inheritDoc}
     */
    public function getInitiator()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getInitiator', []);

        return parent::getInitiator();
    }

    /**
     * {@inheritDoc}
     */
    public function getRecipient()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getRecipient', []);

        return parent::getRecipient();
    }

    /**
     * {@inheritDoc}
     */
    public function getIsRead()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIsRead', []);

        return parent::getIsRead();
    }

    /**
     * {@inheritDoc}
     */
    public function getIsAction()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIsAction', []);

        return parent::getIsAction();
    }

    /**
     * {@inheritDoc}
     */
    public function setInitiator($initiator)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setInitiator', [$initiator]);

        return parent::setInitiator($initiator);
    }

    /**
     * {@inheritDoc}
     */
    public function setRecipient($recipient)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setRecipient', [$recipient]);

        return parent::setRecipient($recipient);
    }

    /**
     * {@inheritDoc}
     */
    public function setIsRead($isRead)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsRead', [$isRead]);

        return parent::setIsRead($isRead);
    }

    /**
     * {@inheritDoc}
     */
    public function setIsAction($isAction)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsAction', [$isAction]);

        return parent::setIsAction($isAction);
    }

    /**
     * {@inheritDoc}
     */
    public function getRecipientBroker()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getRecipientBroker', []);

        return parent::getRecipientBroker();
    }

    /**
     * {@inheritDoc}
     */
    public function setRecipientBroker($recipientBroker)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setRecipientBroker', [$recipientBroker]);

        return parent::setRecipientBroker($recipientBroker);
    }

}
