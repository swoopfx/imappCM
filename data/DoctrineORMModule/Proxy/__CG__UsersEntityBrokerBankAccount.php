<?php

namespace DoctrineORMModule\Proxy\__CG__\Users\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class BrokerBankAccount extends \Users\Entity\BrokerBankAccount implements \Doctrine\ORM\Proxy\Proxy
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
            return ['__isInitialized__', '' . "\0" . 'Users\\Entity\\BrokerBankAccount' . "\0" . 'id', '' . "\0" . 'Users\\Entity\\BrokerBankAccount' . "\0" . 'bankName', '' . "\0" . 'Users\\Entity\\BrokerBankAccount' . "\0" . 'accountName', '' . "\0" . 'Users\\Entity\\BrokerBankAccount' . "\0" . 'bankAccountNo', '' . "\0" . 'Users\\Entity\\BrokerBankAccount' . "\0" . 'swiftCode', '' . "\0" . 'Users\\Entity\\BrokerBankAccount' . "\0" . 'sortCode', '' . "\0" . 'Users\\Entity\\BrokerBankAccount' . "\0" . 'bankAddress', '' . "\0" . 'Users\\Entity\\BrokerBankAccount' . "\0" . 'broker', '' . "\0" . 'Users\\Entity\\BrokerBankAccount' . "\0" . 'createdOn', '' . "\0" . 'Users\\Entity\\BrokerBankAccount' . "\0" . 'updatedOn'];
        }

        return ['__isInitialized__', '' . "\0" . 'Users\\Entity\\BrokerBankAccount' . "\0" . 'id', '' . "\0" . 'Users\\Entity\\BrokerBankAccount' . "\0" . 'bankName', '' . "\0" . 'Users\\Entity\\BrokerBankAccount' . "\0" . 'accountName', '' . "\0" . 'Users\\Entity\\BrokerBankAccount' . "\0" . 'bankAccountNo', '' . "\0" . 'Users\\Entity\\BrokerBankAccount' . "\0" . 'swiftCode', '' . "\0" . 'Users\\Entity\\BrokerBankAccount' . "\0" . 'sortCode', '' . "\0" . 'Users\\Entity\\BrokerBankAccount' . "\0" . 'bankAddress', '' . "\0" . 'Users\\Entity\\BrokerBankAccount' . "\0" . 'broker', '' . "\0" . 'Users\\Entity\\BrokerBankAccount' . "\0" . 'createdOn', '' . "\0" . 'Users\\Entity\\BrokerBankAccount' . "\0" . 'updatedOn'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (BrokerBankAccount $proxy) {
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
    public function getBroker()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getBroker', []);

        return parent::getBroker();
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
    public function setBankName($bankName)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setBankName', [$bankName]);

        return parent::setBankName($bankName);
    }

    /**
     * {@inheritDoc}
     */
    public function getBankName()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getBankName', []);

        return parent::getBankName();
    }

    /**
     * {@inheritDoc}
     */
    public function setAccountName($accountName)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAccountName', [$accountName]);

        return parent::setAccountName($accountName);
    }

    /**
     * {@inheritDoc}
     */
    public function getAccountName()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAccountName', []);

        return parent::getAccountName();
    }

    /**
     * {@inheritDoc}
     */
    public function setBankAccountNo($bankAccountNo)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setBankAccountNo', [$bankAccountNo]);

        return parent::setBankAccountNo($bankAccountNo);
    }

    /**
     * {@inheritDoc}
     */
    public function getBankAccountNo()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getBankAccountNo', []);

        return parent::getBankAccountNo();
    }

    /**
     * {@inheritDoc}
     */
    public function setSwiftCode($swiftCode)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSwiftCode', [$swiftCode]);

        return parent::setSwiftCode($swiftCode);
    }

    /**
     * {@inheritDoc}
     */
    public function getSwiftCode()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSwiftCode', []);

        return parent::getSwiftCode();
    }

    /**
     * {@inheritDoc}
     */
    public function setSortCode($sortCode)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSortCode', [$sortCode]);

        return parent::setSortCode($sortCode);
    }

    /**
     * {@inheritDoc}
     */
    public function getSortCode()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSortCode', []);

        return parent::getSortCode();
    }

    /**
     * {@inheritDoc}
     */
    public function setBankAddress($bankAddress)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setBankAddress', [$bankAddress]);

        return parent::setBankAddress($bankAddress);
    }

    /**
     * {@inheritDoc}
     */
    public function getBankAddress()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getBankAddress', []);

        return parent::getBankAddress();
    }

    /**
     * {@inheritDoc}
     */
    public function setPaymentmode($paymentmode)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPaymentmode', [$paymentmode]);

        return parent::setPaymentmode($paymentmode);
    }

    /**
     * {@inheritDoc}
     */
    public function getPaymentmode()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPaymentmode', []);

        return parent::getPaymentmode();
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
    public function setCreatedOn($created)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCreatedOn', [$created]);

        return parent::setCreatedOn($created);
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
    public function getUpdatedOn()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUpdatedOn', []);

        return parent::getUpdatedOn();
    }

    /**
     * {@inheritDoc}
     */
    public function getDefaultBankAccunt()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDefaultBankAccunt', []);

        return parent::getDefaultBankAccunt();
    }

}