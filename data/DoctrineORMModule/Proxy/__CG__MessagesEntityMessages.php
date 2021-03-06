<?php

namespace DoctrineORMModule\Proxy\__CG__\Messages\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Messages extends \Messages\Entity\Messages implements \Doctrine\ORM\Proxy\Proxy
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
            return ['__isInitialized__', '' . "\0" . 'Messages\\Entity\\Messages' . "\0" . 'id', '' . "\0" . 'Messages\\Entity\\Messages' . "\0" . 'broker', '' . "\0" . 'Messages\\Entity\\Messages' . "\0" . 'messageTitle', '' . "\0" . 'Messages\\Entity\\Messages' . "\0" . 'messageUid', '' . "\0" . 'Messages\\Entity\\Messages' . "\0" . 'createdOn', '' . "\0" . 'Messages\\Entity\\Messages' . "\0" . 'updatedOn', '' . "\0" . 'Messages\\Entity\\Messages' . "\0" . 'messageEntered', '' . "\0" . 'Messages\\Entity\\Messages' . "\0" . 'messageCategory', '' . "\0" . 'Messages\\Entity\\Messages' . "\0" . 'offer', '' . "\0" . 'Messages\\Entity\\Messages' . "\0" . 'packages', '' . "\0" . 'Messages\\Entity\\Messages' . "\0" . 'proposals', '' . "\0" . 'Messages\\Entity\\Messages' . "\0" . 'floatPolicy', '' . "\0" . 'Messages\\Entity\\Messages' . "\0" . 'policy', '' . "\0" . 'Messages\\Entity\\Messages' . "\0" . 'portal', '' . "\0" . 'Messages\\Entity\\Messages' . "\0" . 'customer'];
        }

        return ['__isInitialized__', '' . "\0" . 'Messages\\Entity\\Messages' . "\0" . 'id', '' . "\0" . 'Messages\\Entity\\Messages' . "\0" . 'broker', '' . "\0" . 'Messages\\Entity\\Messages' . "\0" . 'messageTitle', '' . "\0" . 'Messages\\Entity\\Messages' . "\0" . 'messageUid', '' . "\0" . 'Messages\\Entity\\Messages' . "\0" . 'createdOn', '' . "\0" . 'Messages\\Entity\\Messages' . "\0" . 'updatedOn', '' . "\0" . 'Messages\\Entity\\Messages' . "\0" . 'messageEntered', '' . "\0" . 'Messages\\Entity\\Messages' . "\0" . 'messageCategory', '' . "\0" . 'Messages\\Entity\\Messages' . "\0" . 'offer', '' . "\0" . 'Messages\\Entity\\Messages' . "\0" . 'packages', '' . "\0" . 'Messages\\Entity\\Messages' . "\0" . 'proposals', '' . "\0" . 'Messages\\Entity\\Messages' . "\0" . 'floatPolicy', '' . "\0" . 'Messages\\Entity\\Messages' . "\0" . 'policy', '' . "\0" . 'Messages\\Entity\\Messages' . "\0" . 'portal', '' . "\0" . 'Messages\\Entity\\Messages' . "\0" . 'customer'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Messages $proxy) {
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
    public function getMessageTitle()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMessageTitle', []);

        return parent::getMessageTitle();
    }

    /**
     * {@inheritDoc}
     */
    public function setMessageTitle($mess)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setMessageTitle', [$mess]);

        return parent::setMessageTitle($mess);
    }

    /**
     * {@inheritDoc}
     */
    public function getMessageUid()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMessageUid', []);

        return parent::getMessageUid();
    }

    /**
     * {@inheritDoc}
     */
    public function setMessageUid($uid)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setMessageUid', [$uid]);

        return parent::setMessageUid($uid);
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
    public function getCreatedOn()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCreatedOn', []);

        return parent::getCreatedOn();
    }

    /**
     * {@inheritDoc}
     */
    public function getUpdatedOn()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUpdatedOn', []);

        return parent::getUpdatedOn();
    }

    /**
     * {@inheritDoc}
     */
    public function setUpdatedOn($date)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUpdatedOn', [$date]);

        return parent::setUpdatedOn($date);
    }

    /**
     * {@inheritDoc}
     */
    public function addMessageEntered(\Messages\Entity\MessageEntered $message)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addMessageEntered', [$message]);

        return parent::addMessageEntered($message);
    }

    /**
     * {@inheritDoc}
     */
    public function removeMessageEntered(\Messages\Entity\MessageEntered $message)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeMessageEntered', [$message]);

        return parent::removeMessageEntered($message);
    }

    /**
     * {@inheritDoc}
     */
    public function getMessageEntered()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMessageEntered', []);

        return parent::getMessageEntered();
    }

    /**
     * {@inheritDoc}
     */
    public function getMessageCatgory()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMessageCatgory', []);

        return parent::getMessageCatgory();
    }

    /**
     * {@inheritDoc}
     */
    public function setMessageCategory($cat)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setMessageCategory', [$cat]);

        return parent::setMessageCategory($cat);
    }

    /**
     * {@inheritDoc}
     */
    public function getOffer()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getOffer', []);

        return parent::getOffer();
    }

    /**
     * {@inheritDoc}
     */
    public function setOffer($offer)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setOffer', [$offer]);

        return parent::setOffer($offer);
    }

    /**
     * {@inheritDoc}
     */
    public function getPackages()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPackages', []);

        return parent::getPackages();
    }

    /**
     * {@inheritDoc}
     */
    public function setPackages($pack)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPackages', [$pack]);

        return parent::setPackages($pack);
    }

    /**
     * {@inheritDoc}
     */
    public function getProposals()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getProposals', []);

        return parent::getProposals();
    }

    /**
     * {@inheritDoc}
     */
    public function setProposals($prop)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setProposals', [$prop]);

        return parent::setProposals($prop);
    }

    /**
     * {@inheritDoc}
     */
    public function getCustomer()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCustomer', []);

        return parent::getCustomer();
    }

    /**
     * {@inheritDoc}
     */
    public function setCustomer($cus)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCustomer', [$cus]);

        return parent::setCustomer($cus);
    }

    /**
     * {@inheritDoc}
     */
    public function getFloatPolicy()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFloatPolicy', []);

        return parent::getFloatPolicy();
    }

    /**
     * {@inheritDoc}
     */
    public function setFloatPolicy($float)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setFloatPolicy', [$float]);

        return parent::setFloatPolicy($float);
    }

    /**
     * {@inheritDoc}
     */
    public function getPortal()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPortal', []);

        return parent::getPortal();
    }

    /**
     * {@inheritDoc}
     */
    public function getBroker()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getBroker', []);

        return parent::getBroker();
    }

    /**
     * {@inheritDoc}
     */
    public function getPolicy()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPolicy', []);

        return parent::getPolicy();
    }

    /**
     * {@inheritDoc}
     */
    public function setBroker($broker)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setBroker', [$broker]);

        return parent::setBroker($broker);
    }

    /**
     * {@inheritDoc}
     */
    public function setPolicy($policy)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPolicy', [$policy]);

        return parent::setPolicy($policy);
    }

    /**
     * {@inheritDoc}
     */
    public function getMessageCategory()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMessageCategory', []);

        return parent::getMessageCategory();
    }

}
