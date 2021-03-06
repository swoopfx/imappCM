<?php

namespace DoctrineORMModule\Proxy\__CG__\Policy\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Policy extends \Policy\Entity\Policy implements \Doctrine\ORM\Proxy\Proxy
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
            return ['__isInitialized__', '' . "\0" . 'Policy\\Entity\\Policy' . "\0" . 'id', '' . "\0" . 'Policy\\Entity\\Policy' . "\0" . 'policyName', '' . "\0" . 'Policy\\Entity\\Policy' . "\0" . 'documents', '' . "\0" . 'Policy\\Entity\\Policy' . "\0" . 'extraInfo', '' . "\0" . 'Policy\\Entity\\Policy' . "\0" . 'policyCode', '' . "\0" . 'Policy\\Entity\\Policy' . "\0" . 'policyStatus', '' . "\0" . 'Policy\\Entity\\Policy' . "\0" . 'isLocked', '' . "\0" . 'Policy\\Entity\\Policy' . "\0" . 'policyUid', '' . "\0" . 'Policy\\Entity\\Policy' . "\0" . 'createdOn', '' . "\0" . 'Policy\\Entity\\Policy' . "\0" . 'updatedOn', '' . "\0" . 'Policy\\Entity\\Policy' . "\0" . 'coverNote', '' . "\0" . 'Policy\\Entity\\Policy' . "\0" . 'isActive', '' . "\0" . 'Policy\\Entity\\Policy' . "\0" . 'startDate', '' . "\0" . 'Policy\\Entity\\Policy' . "\0" . 'endDate', '' . "\0" . 'Policy\\Entity\\Policy' . "\0" . 'claims', '' . "\0" . 'Policy\\Entity\\Policy' . "\0" . 'suspendedReason', '' . "\0" . 'Policy\\Entity\\Policy' . "\0" . 'otherSuspension', '' . "\0" . 'Policy\\Entity\\Policy' . "\0" . 'reasonDescription', '' . "\0" . 'Policy\\Entity\\Policy' . "\0" . 'isAutoRenew', '' . "\0" . 'Policy\\Entity\\Policy' . "\0" . 'policyActivity', '' . "\0" . 'Policy\\Entity\\Policy' . "\0" . 'isSpecialTerms', '' . "\0" . 'Policy\\Entity\\Policy' . "\0" . 'specialTerms'];
        }

        return ['__isInitialized__', '' . "\0" . 'Policy\\Entity\\Policy' . "\0" . 'id', '' . "\0" . 'Policy\\Entity\\Policy' . "\0" . 'policyName', '' . "\0" . 'Policy\\Entity\\Policy' . "\0" . 'documents', '' . "\0" . 'Policy\\Entity\\Policy' . "\0" . 'extraInfo', '' . "\0" . 'Policy\\Entity\\Policy' . "\0" . 'policyCode', '' . "\0" . 'Policy\\Entity\\Policy' . "\0" . 'policyStatus', '' . "\0" . 'Policy\\Entity\\Policy' . "\0" . 'isLocked', '' . "\0" . 'Policy\\Entity\\Policy' . "\0" . 'policyUid', '' . "\0" . 'Policy\\Entity\\Policy' . "\0" . 'createdOn', '' . "\0" . 'Policy\\Entity\\Policy' . "\0" . 'updatedOn', '' . "\0" . 'Policy\\Entity\\Policy' . "\0" . 'coverNote', '' . "\0" . 'Policy\\Entity\\Policy' . "\0" . 'isActive', '' . "\0" . 'Policy\\Entity\\Policy' . "\0" . 'startDate', '' . "\0" . 'Policy\\Entity\\Policy' . "\0" . 'endDate', '' . "\0" . 'Policy\\Entity\\Policy' . "\0" . 'claims', '' . "\0" . 'Policy\\Entity\\Policy' . "\0" . 'suspendedReason', '' . "\0" . 'Policy\\Entity\\Policy' . "\0" . 'otherSuspension', '' . "\0" . 'Policy\\Entity\\Policy' . "\0" . 'reasonDescription', '' . "\0" . 'Policy\\Entity\\Policy' . "\0" . 'isAutoRenew', '' . "\0" . 'Policy\\Entity\\Policy' . "\0" . 'policyActivity', '' . "\0" . 'Policy\\Entity\\Policy' . "\0" . 'isSpecialTerms', '' . "\0" . 'Policy\\Entity\\Policy' . "\0" . 'specialTerms'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Policy $proxy) {
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
    public function getPolicyName()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPolicyName', []);

        return parent::getPolicyName();
    }

    /**
     * {@inheritDoc}
     */
    public function setPolicyName($policy)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPolicyName', [$policy]);

        return parent::setPolicyName($policy);
    }

    /**
     * {@inheritDoc}
     */
    public function getCoverNote()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCoverNote', []);

        return parent::getCoverNote();
    }

    /**
     * {@inheritDoc}
     */
    public function setCoverNote($note)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCoverNote', [$note]);

        return parent::setCoverNote($note);
    }

    /**
     * {@inheritDoc}
     */
    public function getPolicyCode()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPolicyCode', []);

        return parent::getPolicyCode();
    }

    /**
     * {@inheritDoc}
     */
    public function setPolicyCode($code)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPolicyCode', [$code]);

        return parent::setPolicyCode($code);
    }

    /**
     * {@inheritDoc}
     */
    public function getDocuments()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDocuments', []);

        return parent::getDocuments();
    }

    /**
     * {@inheritDoc}
     */
    public function addDocuments($docs)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addDocuments', [$docs]);

        return parent::addDocuments($docs);
    }

    /**
     * {@inheritDoc}
     */
    public function removeDocuments($docs)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeDocuments', [$docs]);

        return parent::removeDocuments($docs);
    }

    /**
     * {@inheritDoc}
     */
    public function getExtraInfo()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getExtraInfo', []);

        return parent::getExtraInfo();
    }

    /**
     * {@inheritDoc}
     */
    public function setExtraInfo($desc)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setExtraInfo', [$desc]);

        return parent::setExtraInfo($desc);
    }

    /**
     * {@inheritDoc}
     */
    public function getPolicyStatus()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPolicyStatus', []);

        return parent::getPolicyStatus();
    }

    /**
     * {@inheritDoc}
     */
    public function setPolicyStatus($status)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPolicyStatus', [$status]);

        return parent::setPolicyStatus($status);
    }

    /**
     * {@inheritDoc}
     */
    public function setIsLocked($lock)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsLocked', [$lock]);

        return parent::setIsLocked($lock);
    }

    /**
     * {@inheritDoc}
     */
    public function getIsLocked()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIsLocked', []);

        return parent::getIsLocked();
    }

    /**
     * {@inheritDoc}
     */
    public function getPolicyUid()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPolicyUid', []);

        return parent::getPolicyUid();
    }

    /**
     * {@inheritDoc}
     */
    public function setPolicyUid($uid)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPolicyUid', [$uid]);

        return parent::setPolicyUid($uid);
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
    public function getIsActive()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIsActive', []);

        return parent::getIsActive();
    }

    /**
     * {@inheritDoc}
     */
    public function setIsActive($active)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsActive', [$active]);

        return parent::setIsActive($active);
    }

    /**
     * {@inheritDoc}
     */
    public function getClaims()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getClaims', []);

        return parent::getClaims();
    }

    /**
     * {@inheritDoc}
     */
    public function addClaims(\Claims\Entity\Claims $claim)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addClaims', [$claim]);

        return parent::addClaims($claim);
    }

    /**
     * {@inheritDoc}
     */
    public function removeClaims(\Claims\Entity\Claims $claim)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeClaims', [$claim]);

        return parent::removeClaims($claim);
    }

    /**
     * {@inheritDoc}
     */
    public function getStartDate()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getStartDate', []);

        return parent::getStartDate();
    }

    /**
     * {@inheritDoc}
     */
    public function setStartDate($date)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setStartDate', [$date]);

        return parent::setStartDate($date);
    }

    /**
     * {@inheritDoc}
     */
    public function getEndDate()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEndDate', []);

        return parent::getEndDate();
    }

    /**
     * {@inheritDoc}
     */
    public function setEndDate($date)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEndDate', [$date]);

        return parent::setEndDate($date);
    }

    /**
     * {@inheritDoc}
     */
    public function getSuspendedReason()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSuspendedReason', []);

        return parent::getSuspendedReason();
    }

    /**
     * {@inheritDoc}
     */
    public function setSuspendedReason($reason)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSuspendedReason', [$reason]);

        return parent::setSuspendedReason($reason);
    }

    /**
     * {@inheritDoc}
     */
    public function getIsAutoRenew()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIsAutoRenew', []);

        return parent::getIsAutoRenew();
    }

    /**
     * {@inheritDoc}
     */
    public function setIsAutoRenew($ren)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsAutoRenew', [$ren]);

        return parent::setIsAutoRenew($ren);
    }

    /**
     * {@inheritDoc}
     */
    public function getRenewedPremium()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getRenewedPremium', []);

        return parent::getRenewedPremium();
    }

    /**
     * {@inheritDoc}
     */
    public function setRenewedPremium($renewedPremium)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setRenewedPremium', [$renewedPremium]);

        return parent::setRenewedPremium($renewedPremium);
    }

    /**
     * {@inheritDoc}
     */
    public function getPolicyActivity()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPolicyActivity', []);

        return parent::getPolicyActivity();
    }

    /**
     * {@inheritDoc}
     */
    public function getOtherSuspension()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getOtherSuspension', []);

        return parent::getOtherSuspension();
    }

    /**
     * {@inheritDoc}
     */
    public function getReasonDescription()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getReasonDescription', []);

        return parent::getReasonDescription();
    }

    /**
     * {@inheritDoc}
     */
    public function setOtherSuspension($otherSuspension)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setOtherSuspension', [$otherSuspension]);

        return parent::setOtherSuspension($otherSuspension);
    }

    /**
     * {@inheritDoc}
     */
    public function setReasonDescription($reasonDescription)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setReasonDescription', [$reasonDescription]);

        return parent::setReasonDescription($reasonDescription);
    }

    /**
     * {@inheritDoc}
     */
    public function getIsSpecialTerms()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIsSpecialTerms', []);

        return parent::getIsSpecialTerms();
    }

    /**
     * {@inheritDoc}
     */
    public function getSpecialTerms()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSpecialTerms', []);

        return parent::getSpecialTerms();
    }

    /**
     * {@inheritDoc}
     */
    public function setIsSpecialTerms($isSpecialTerms)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsSpecialTerms', [$isSpecialTerms]);

        return parent::setIsSpecialTerms($isSpecialTerms);
    }

    /**
     * {@inheritDoc}
     */
    public function setSpecialTerms($specialTerms)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSpecialTerms', [$specialTerms]);

        return parent::setSpecialTerms($specialTerms);
    }

}
