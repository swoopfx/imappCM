<?php

namespace DoctrineORMModule\Proxy\__CG__\Policy\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class CoverNote extends \Policy\Entity\CoverNote implements \Doctrine\ORM\Proxy\Proxy
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
            return ['__isInitialized__', '' . "\0" . 'Policy\\Entity\\CoverNote' . "\0" . 'id', '' . "\0" . 'Policy\\Entity\\CoverNote' . "\0" . 'customer', '' . "\0" . 'Policy\\Entity\\CoverNote' . "\0" . 'invoice', '' . "\0" . 'Policy\\Entity\\CoverNote' . "\0" . 'coverUid', '' . "\0" . 'Policy\\Entity\\CoverNote' . "\0" . 'dateCreated', '' . "\0" . 'Policy\\Entity\\CoverNote' . "\0" . 'dateUpdated', '' . "\0" . 'Policy\\Entity\\CoverNote' . "\0" . 'dueDate', '' . "\0" . 'Policy\\Entity\\CoverNote' . "\0" . 'isRenewable', '' . "\0" . 'Policy\\Entity\\CoverNote' . "\0" . 'isHidden', '' . "\0" . 'Policy\\Entity\\CoverNote' . "\0" . 'coverStatus', '' . "\0" . 'Policy\\Entity\\CoverNote' . "\0" . 'insurer', '' . "\0" . 'Policy\\Entity\\CoverNote' . "\0" . 'coverCategory', '' . "\0" . 'Policy\\Entity\\CoverNote' . "\0" . 'coverRefernce', '' . "\0" . 'Policy\\Entity\\CoverNote' . "\0" . 'proposal', '' . "\0" . 'Policy\\Entity\\CoverNote' . "\0" . 'offer', '' . "\0" . 'Policy\\Entity\\CoverNote' . "\0" . 'package', '' . "\0" . 'Policy\\Entity\\CoverNote' . "\0" . 'policyFloat', '' . "\0" . 'Policy\\Entity\\CoverNote' . "\0" . 'policy', '' . "\0" . 'Policy\\Entity\\CoverNote' . "\0" . 'isPolicy', '' . "\0" . 'Policy\\Entity\\CoverNote' . "\0" . 'isMultipleInsurer', '' . "\0" . 'Policy\\Entity\\CoverNote' . "\0" . 'multipleInsurer', '' . "\0" . 'Policy\\Entity\\CoverNote' . "\0" . 'finalService', '' . "\0" . 'Policy\\Entity\\CoverNote' . "\0" . 'finalSpecificService', '' . "\0" . 'Policy\\Entity\\CoverNote' . "\0" . 'premiumPayable', '' . "\0" . 'Policy\\Entity\\CoverNote' . "\0" . 'premiumChangeReason'];
        }

        return ['__isInitialized__', '' . "\0" . 'Policy\\Entity\\CoverNote' . "\0" . 'id', '' . "\0" . 'Policy\\Entity\\CoverNote' . "\0" . 'customer', '' . "\0" . 'Policy\\Entity\\CoverNote' . "\0" . 'invoice', '' . "\0" . 'Policy\\Entity\\CoverNote' . "\0" . 'coverUid', '' . "\0" . 'Policy\\Entity\\CoverNote' . "\0" . 'dateCreated', '' . "\0" . 'Policy\\Entity\\CoverNote' . "\0" . 'dateUpdated', '' . "\0" . 'Policy\\Entity\\CoverNote' . "\0" . 'dueDate', '' . "\0" . 'Policy\\Entity\\CoverNote' . "\0" . 'isRenewable', '' . "\0" . 'Policy\\Entity\\CoverNote' . "\0" . 'isHidden', '' . "\0" . 'Policy\\Entity\\CoverNote' . "\0" . 'coverStatus', '' . "\0" . 'Policy\\Entity\\CoverNote' . "\0" . 'insurer', '' . "\0" . 'Policy\\Entity\\CoverNote' . "\0" . 'coverCategory', '' . "\0" . 'Policy\\Entity\\CoverNote' . "\0" . 'coverRefernce', '' . "\0" . 'Policy\\Entity\\CoverNote' . "\0" . 'proposal', '' . "\0" . 'Policy\\Entity\\CoverNote' . "\0" . 'offer', '' . "\0" . 'Policy\\Entity\\CoverNote' . "\0" . 'package', '' . "\0" . 'Policy\\Entity\\CoverNote' . "\0" . 'policyFloat', '' . "\0" . 'Policy\\Entity\\CoverNote' . "\0" . 'policy', '' . "\0" . 'Policy\\Entity\\CoverNote' . "\0" . 'isPolicy', '' . "\0" . 'Policy\\Entity\\CoverNote' . "\0" . 'isMultipleInsurer', '' . "\0" . 'Policy\\Entity\\CoverNote' . "\0" . 'multipleInsurer', '' . "\0" . 'Policy\\Entity\\CoverNote' . "\0" . 'finalService', '' . "\0" . 'Policy\\Entity\\CoverNote' . "\0" . 'finalSpecificService', '' . "\0" . 'Policy\\Entity\\CoverNote' . "\0" . 'premiumPayable', '' . "\0" . 'Policy\\Entity\\CoverNote' . "\0" . 'premiumChangeReason'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (CoverNote $proxy) {
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
    public function getCoverRefernce()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCoverRefernce', []);

        return parent::getCoverRefernce();
    }

    /**
     * {@inheritDoc}
     */
    public function setCoverRefernce($coverRefernce)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCoverRefernce', [$coverRefernce]);

        return parent::setCoverRefernce($coverRefernce);
    }

    /**
     * {@inheritDoc}
     */
    public function addCoverNoteCert(\Doctrine\Common\Collections\Collection $coverNotes)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addCoverNoteCert', [$coverNotes]);

        return parent::addCoverNoteCert($coverNotes);
    }

    /**
     * {@inheritDoc}
     */
    public function removeCoverNoteCert(\Doctrine\Common\Collections\Collection $coverNotes)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeCoverNoteCert', [$coverNotes]);

        return parent::removeCoverNoteCert($coverNotes);
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
    public function setCoverUid($uid)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCoverUid', [$uid]);

        return parent::setCoverUid($uid);
    }

    /**
     * {@inheritDoc}
     */
    public function getCoverUid()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCoverUid', []);

        return parent::getCoverUid();
    }

    /**
     * {@inheritDoc}
     */
    public function getCoverStatus()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCoverStatus', []);

        return parent::getCoverStatus();
    }

    /**
     * {@inheritDoc}
     */
    public function setCoverStatus($coverStatus)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCoverStatus', [$coverStatus]);

        return parent::setCoverStatus($coverStatus);
    }

    /**
     * {@inheritDoc}
     */
    public function setInsurer($ins)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setInsurer', [$ins]);

        return parent::setInsurer($ins);
    }

    /**
     * {@inheritDoc}
     */
    public function getInsurer()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getInsurer', []);

        return parent::getInsurer();
    }

    /**
     * {@inheritDoc}
     */
    public function getCoverCategory()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCoverCategory', []);

        return parent::getCoverCategory();
    }

    /**
     * {@inheritDoc}
     */
    public function setCoverCategory($cat)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCoverCategory', [$cat]);

        return parent::setCoverCategory($cat);
    }

    /**
     * {@inheritDoc}
     */
    public function setDateCreated($dateCreated)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDateCreated', [$dateCreated]);

        return parent::setDateCreated($dateCreated);
    }

    /**
     * {@inheritDoc}
     */
    public function getDateCreated()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDateCreated', []);

        return parent::getDateCreated();
    }

    /**
     * {@inheritDoc}
     */
    public function setDateUpdated($dateUpdated)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDateUpdated', [$dateUpdated]);

        return parent::setDateUpdated($dateUpdated);
    }

    /**
     * {@inheritDoc}
     */
    public function getDateUpdated()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDateUpdated', []);

        return parent::getDateUpdated();
    }

    /**
     * {@inheritDoc}
     */
    public function getDueDate()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDueDate', []);

        return parent::getDueDate();
    }

    /**
     * {@inheritDoc}
     */
    public function setDueDate($date)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDueDate', [$date]);

        return parent::setDueDate($date);
    }

    /**
     * {@inheritDoc}
     */
    public function setIsRenewable($isRenewable)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsRenewable', [$isRenewable]);

        return parent::setIsRenewable($isRenewable);
    }

    /**
     * {@inheritDoc}
     */
    public function getPolicyBegins()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPolicyBegins', []);

        return parent::getPolicyBegins();
    }

    /**
     * {@inheritDoc}
     */
    public function setPolicyBegins($date)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPolicyBegins', [$date]);

        return parent::setPolicyBegins($date);
    }

    /**
     * {@inheritDoc}
     */
    public function getPolicyEnds()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPolicyEnds', []);

        return parent::getPolicyEnds();
    }

    /**
     * {@inheritDoc}
     */
    public function setPolicyEnds($date)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPolicyEnds', [$date]);

        return parent::setPolicyEnds($date);
    }

    /**
     * {@inheritDoc}
     */
    public function getIsRenewable()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIsRenewable', []);

        return parent::getIsRenewable();
    }

    /**
     * {@inheritDoc}
     */
    public function setIsHidden($isHidden)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsHidden', [$isHidden]);

        return parent::setIsHidden($isHidden);
    }

    /**
     * {@inheritDoc}
     */
    public function getIsHidden()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIsHidden', []);

        return parent::getIsHidden();
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
    public function setOffer(\Offer\Entity\Offer $offer = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setOffer', [$offer]);

        return parent::setOffer($offer);
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
    public function getInvoice()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getInvoice', []);

        return parent::getInvoice();
    }

    /**
     * {@inheritDoc}
     */
    public function addIdDoc(\GeneralServicer\Entity\Document $idDoc)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addIdDoc', [$idDoc]);

        return parent::addIdDoc($idDoc);
    }

    /**
     * {@inheritDoc}
     */
    public function removeIdDoc(\GeneralServicer\Entity\Document $idDoc)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeIdDoc', [$idDoc]);

        return parent::removeIdDoc($idDoc);
    }

    /**
     * {@inheritDoc}
     */
    public function getIdDoc()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIdDoc', []);

        return parent::getIdDoc();
    }

    /**
     * {@inheritDoc}
     */
    public function addInsurer(\Doctrine\Common\Collections\Collection $insurer)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addInsurer', [$insurer]);

        return parent::addInsurer($insurer);
    }

    /**
     * {@inheritDoc}
     */
    public function removeInsurer(\Doctrine\Common\Collections\Collection $insurer)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeInsurer', [$insurer]);

        return parent::removeInsurer($insurer);
    }

    /**
     * {@inheritDoc}
     */
    public function getUser()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUser', []);

        return parent::getUser();
    }

    /**
     * {@inheritDoc}
     */
    public function getPackage()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPackage', []);

        return parent::getPackage();
    }

    /**
     * {@inheritDoc}
     */
    public function setPackage($pack)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPackage', [$pack]);

        return parent::setPackage($pack);
    }

    /**
     * {@inheritDoc}
     */
    public function getProposal()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getProposal', []);

        return parent::getProposal();
    }

    /**
     * {@inheritDoc}
     */
    public function setProposal($prop)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setProposal', [$prop]);

        return parent::setProposal($prop);
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
    public function getBroker()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getBroker', []);

        return parent::getBroker();
    }

    /**
     * {@inheritDoc}
     */
    public function setPolicy($pol)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPolicy', [$pol]);

        return parent::setPolicy($pol);
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
    public function setIsPolicy($pol)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsPolicy', [$pol]);

        return parent::setIsPolicy($pol);
    }

    /**
     * {@inheritDoc}
     */
    public function getIsPolicy()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIsPolicy', []);

        return parent::getIsPolicy();
    }

    /**
     * {@inheritDoc}
     */
    public function getPolicyFloat()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPolicyFloat', []);

        return parent::getPolicyFloat();
    }

    /**
     * {@inheritDoc}
     */
    public function setPolicyFloat($float)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPolicyFloat', [$float]);

        return parent::setPolicyFloat($float);
    }

    /**
     * {@inheritDoc}
     */
    public function getFinalInsurer()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFinalInsurer', []);

        return parent::getFinalInsurer();
    }

    /**
     * {@inheritDoc}
     */
    public function getIsMultipleInsurer()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIsMultipleInsurer', []);

        return parent::getIsMultipleInsurer();
    }

    /**
     * {@inheritDoc}
     */
    public function getMultipleInsurer()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMultipleInsurer', []);

        return parent::getMultipleInsurer();
    }

    /**
     * {@inheritDoc}
     */
    public function getFinalService()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFinalService', []);

        return parent::getFinalService();
    }

    /**
     * {@inheritDoc}
     */
    public function getFinalSpecificService()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFinalSpecificService', []);

        return parent::getFinalSpecificService();
    }

    /**
     * {@inheritDoc}
     */
    public function setId($id)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setId', [$id]);

        return parent::setId($id);
    }

    /**
     * {@inheritDoc}
     */
    public function setFinalInsurer($finalInsurer)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setFinalInsurer', [$finalInsurer]);

        return parent::setFinalInsurer($finalInsurer);
    }

    /**
     * {@inheritDoc}
     */
    public function setIsMultipleInsurer($isMultipleInsurer)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsMultipleInsurer', [$isMultipleInsurer]);

        return parent::setIsMultipleInsurer($isMultipleInsurer);
    }

    /**
     * {@inheritDoc}
     */
    public function setMultipleInsurer($multipleInsurer)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setMultipleInsurer', [$multipleInsurer]);

        return parent::setMultipleInsurer($multipleInsurer);
    }

    /**
     * {@inheritDoc}
     */
    public function addMultipleInsurer($insurer)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addMultipleInsurer', [$insurer]);

        return parent::addMultipleInsurer($insurer);
    }

    /**
     * {@inheritDoc}
     */
    public function removeMultipleInsurer($insurer)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeMultipleInsurer', [$insurer]);

        return parent::removeMultipleInsurer($insurer);
    }

    /**
     * {@inheritDoc}
     */
    public function setFinalService($finalService)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setFinalService', [$finalService]);

        return parent::setFinalService($finalService);
    }

    /**
     * {@inheritDoc}
     */
    public function setFinalSpecificService($finalSpecificService)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setFinalSpecificService', [$finalSpecificService]);

        return parent::setFinalSpecificService($finalSpecificService);
    }

    /**
     * {@inheritDoc}
     */
    public function getPremiumPayable()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPremiumPayable', []);

        return parent::getPremiumPayable();
    }

    /**
     * {@inheritDoc}
     */
    public function setPremiumPayable($premiumPayable)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPremiumPayable', [$premiumPayable]);

        return parent::setPremiumPayable($premiumPayable);
    }

    /**
     * {@inheritDoc}
     */
    public function setInvoice($invoice)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setInvoice', [$invoice]);

        return parent::setInvoice($invoice);
    }

    /**
     * {@inheritDoc}
     */
    public function getPremiumChangeReason()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPremiumChangeReason', []);

        return parent::getPremiumChangeReason();
    }

    /**
     * {@inheritDoc}
     */
    public function setPremiumChangeReason($premiumChangeReason)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPremiumChangeReason', [$premiumChangeReason]);

        return parent::setPremiumChangeReason($premiumChangeReason);
    }

}
