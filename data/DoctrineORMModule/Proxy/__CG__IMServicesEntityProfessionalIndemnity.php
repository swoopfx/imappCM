<?php

namespace DoctrineORMModule\Proxy\__CG__\IMServices\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class ProfessionalIndemnity extends \IMServices\Entity\ProfessionalIndemnity implements \Doctrine\ORM\Proxy\Proxy
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
     * @var array properties to be lazy loaded, with keys being the property
     *            names and values being their default values
     *
     * @see \Doctrine\Common\Proxy\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = [];



    /**
     * @param \Closure $initializer
     * @param \Closure $cloner
     */
    public function __construct($initializer = null, $cloner = null)
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
            return ['__isInitialized__', '' . "\0" . 'IMServices\\Entity\\ProfessionalIndemnity' . "\0" . 'id', '' . "\0" . 'IMServices\\Entity\\ProfessionalIndemnity' . "\0" . 'headOffice', '' . "\0" . 'IMServices\\Entity\\ProfessionalIndemnity' . "\0" . 'otherOffice', '' . "\0" . 'IMServices\\Entity\\ProfessionalIndemnity' . "\0" . 'isOutStandingIndemnity', '' . "\0" . 'IMServices\\Entity\\ProfessionalIndemnity' . "\0" . 'indemnityValue', '' . "\0" . 'IMServices\\Entity\\ProfessionalIndemnity' . "\0" . 'currency', '' . "\0" . 'IMServices\\Entity\\ProfessionalIndemnity' . "\0" . 'isAlternativePractice', '' . "\0" . 'IMServices\\Entity\\ProfessionalIndemnity' . "\0" . 'alternativePractice', '' . "\0" . 'IMServices\\Entity\\ProfessionalIndemnity' . "\0" . 'indemnityStart', '' . "\0" . 'IMServices\\Entity\\ProfessionalIndemnity' . "\0" . 'indemnityEnd', '' . "\0" . 'IMServices\\Entity\\ProfessionalIndemnity' . "\0" . 'annualBrokerageIncome', '' . "\0" . 'IMServices\\Entity\\ProfessionalIndemnity' . "\0" . 'isUnderwritingAgent', '' . "\0" . 'IMServices\\Entity\\ProfessionalIndemnity' . "\0" . 'profession', '' . "\0" . 'IMServices\\Entity\\ProfessionalIndemnity' . "\0" . 'professionalBody', '' . "\0" . 'IMServices\\Entity\\ProfessionalIndemnity' . "\0" . 'membership', '' . "\0" . 'IMServices\\Entity\\ProfessionalIndemnity' . "\0" . 'professionDuration', '' . "\0" . 'IMServices\\Entity\\ProfessionalIndemnity' . "\0" . 'partnerDetails', '' . "\0" . 'IMServices\\Entity\\ProfessionalIndemnity' . "\0" . 'isPreviousInsure', '' . "\0" . 'IMServices\\Entity\\ProfessionalIndemnity' . "\0" . 'isDeclined', '' . "\0" . 'IMServices\\Entity\\ProfessionalIndemnity' . "\0" . 'isSubjectToIncrease', '' . "\0" . 'IMServices\\Entity\\ProfessionalIndemnity' . "\0" . 'isSpecialRestriction', '' . "\0" . 'IMServices\\Entity\\ProfessionalIndemnity' . "\0" . 'specialRestriction', '' . "\0" . 'IMServices\\Entity\\ProfessionalIndemnity' . "\0" . 'isOtherCountery', '' . "\0" . 'IMServices\\Entity\\ProfessionalIndemnity' . "\0" . 'otherCountry', '' . "\0" . 'IMServices\\Entity\\ProfessionalIndemnity' . "\0" . 'isAdditonalInfo', '' . "\0" . 'IMServices\\Entity\\ProfessionalIndemnity' . "\0" . 'totalPartners', '' . "\0" . 'IMServices\\Entity\\ProfessionalIndemnity' . "\0" . 'totalStaff', '' . "\0" . 'IMServices\\Entity\\ProfessionalIndemnity' . "\0" . 'isCoverAllStaff', '' . "\0" . 'IMServices\\Entity\\ProfessionalIndemnity' . "\0" . 'limitIndemnity'];
        }

        return ['__isInitialized__', '' . "\0" . 'IMServices\\Entity\\ProfessionalIndemnity' . "\0" . 'id', '' . "\0" . 'IMServices\\Entity\\ProfessionalIndemnity' . "\0" . 'headOffice', '' . "\0" . 'IMServices\\Entity\\ProfessionalIndemnity' . "\0" . 'otherOffice', '' . "\0" . 'IMServices\\Entity\\ProfessionalIndemnity' . "\0" . 'isOutStandingIndemnity', '' . "\0" . 'IMServices\\Entity\\ProfessionalIndemnity' . "\0" . 'indemnityValue', '' . "\0" . 'IMServices\\Entity\\ProfessionalIndemnity' . "\0" . 'currency', '' . "\0" . 'IMServices\\Entity\\ProfessionalIndemnity' . "\0" . 'isAlternativePractice', '' . "\0" . 'IMServices\\Entity\\ProfessionalIndemnity' . "\0" . 'alternativePractice', '' . "\0" . 'IMServices\\Entity\\ProfessionalIndemnity' . "\0" . 'indemnityStart', '' . "\0" . 'IMServices\\Entity\\ProfessionalIndemnity' . "\0" . 'indemnityEnd', '' . "\0" . 'IMServices\\Entity\\ProfessionalIndemnity' . "\0" . 'annualBrokerageIncome', '' . "\0" . 'IMServices\\Entity\\ProfessionalIndemnity' . "\0" . 'isUnderwritingAgent', '' . "\0" . 'IMServices\\Entity\\ProfessionalIndemnity' . "\0" . 'profession', '' . "\0" . 'IMServices\\Entity\\ProfessionalIndemnity' . "\0" . 'professionalBody', '' . "\0" . 'IMServices\\Entity\\ProfessionalIndemnity' . "\0" . 'membership', '' . "\0" . 'IMServices\\Entity\\ProfessionalIndemnity' . "\0" . 'professionDuration', '' . "\0" . 'IMServices\\Entity\\ProfessionalIndemnity' . "\0" . 'partnerDetails', '' . "\0" . 'IMServices\\Entity\\ProfessionalIndemnity' . "\0" . 'isPreviousInsure', '' . "\0" . 'IMServices\\Entity\\ProfessionalIndemnity' . "\0" . 'isDeclined', '' . "\0" . 'IMServices\\Entity\\ProfessionalIndemnity' . "\0" . 'isSubjectToIncrease', '' . "\0" . 'IMServices\\Entity\\ProfessionalIndemnity' . "\0" . 'isSpecialRestriction', '' . "\0" . 'IMServices\\Entity\\ProfessionalIndemnity' . "\0" . 'specialRestriction', '' . "\0" . 'IMServices\\Entity\\ProfessionalIndemnity' . "\0" . 'isOtherCountery', '' . "\0" . 'IMServices\\Entity\\ProfessionalIndemnity' . "\0" . 'otherCountry', '' . "\0" . 'IMServices\\Entity\\ProfessionalIndemnity' . "\0" . 'isAdditonalInfo', '' . "\0" . 'IMServices\\Entity\\ProfessionalIndemnity' . "\0" . 'totalPartners', '' . "\0" . 'IMServices\\Entity\\ProfessionalIndemnity' . "\0" . 'totalStaff', '' . "\0" . 'IMServices\\Entity\\ProfessionalIndemnity' . "\0" . 'isCoverAllStaff', '' . "\0" . 'IMServices\\Entity\\ProfessionalIndemnity' . "\0" . 'limitIndemnity'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (ProfessionalIndemnity $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy->__getLazyProperties() as $property => $defaultValue) {
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
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function getPartnerDetails()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPartnerDetails', []);

        return parent::getPartnerDetails();
    }

    /**
     * {@inheritDoc}
     */
    public function addPartnerDetails($det)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addPartnerDetails', [$det]);

        return parent::addPartnerDetails($det);
    }

    /**
     * {@inheritDoc}
     */
    public function removePartnerDetails($det)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removePartnerDetails', [$det]);

        return parent::removePartnerDetails($det);
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
    public function setId($id)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setId', [$id]);

        return parent::setId($id);
    }

    /**
     * {@inheritDoc}
     */
    public function getHeadOffice()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getHeadOffice', []);

        return parent::getHeadOffice();
    }

    /**
     * {@inheritDoc}
     */
    public function setHeadOffice($headOffice)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setHeadOffice', [$headOffice]);

        return parent::setHeadOffice($headOffice);
    }

    /**
     * {@inheritDoc}
     */
    public function getOtherOffice()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getOtherOffice', []);

        return parent::getOtherOffice();
    }

    /**
     * {@inheritDoc}
     */
    public function setOtherOffice($otherOffice)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setOtherOffice', [$otherOffice]);

        return parent::setOtherOffice($otherOffice);
    }

    /**
     * {@inheritDoc}
     */
    public function getIndemnityValue()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIndemnityValue', []);

        return parent::getIndemnityValue();
    }

    /**
     * {@inheritDoc}
     */
    public function setIndemnityValue($indemnityValue)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIndemnityValue', [$indemnityValue]);

        return parent::setIndemnityValue($indemnityValue);
    }

    /**
     * {@inheritDoc}
     */
    public function getCurrency()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCurrency', []);

        return parent::getCurrency();
    }

    /**
     * {@inheritDoc}
     */
    public function setCurrency($currency)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCurrency', [$currency]);

        return parent::setCurrency($currency);
    }

    /**
     * {@inheritDoc}
     */
    public function getIsAlternativePractice()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIsAlternativePractice', []);

        return parent::getIsAlternativePractice();
    }

    /**
     * {@inheritDoc}
     */
    public function setIsAlternativePractice($isAlternativePractice)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsAlternativePractice', [$isAlternativePractice]);

        return parent::setIsAlternativePractice($isAlternativePractice);
    }

    /**
     * {@inheritDoc}
     */
    public function getAlternativePractice()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAlternativePractice', []);

        return parent::getAlternativePractice();
    }

    /**
     * {@inheritDoc}
     */
    public function setAlternativePractice($alternativePractice)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAlternativePractice', [$alternativePractice]);

        return parent::setAlternativePractice($alternativePractice);
    }

    /**
     * {@inheritDoc}
     */
    public function getIndemnityStart()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIndemnityStart', []);

        return parent::getIndemnityStart();
    }

    /**
     * {@inheritDoc}
     */
    public function setIndemnityStart($indemnityStart)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIndemnityStart', [$indemnityStart]);

        return parent::setIndemnityStart($indemnityStart);
    }

    /**
     * {@inheritDoc}
     */
    public function getIndemnityEnd()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIndemnityEnd', []);

        return parent::getIndemnityEnd();
    }

    /**
     * {@inheritDoc}
     */
    public function setIndemnityEnd($indemnityEnd)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIndemnityEnd', [$indemnityEnd]);

        return parent::setIndemnityEnd($indemnityEnd);
    }

    /**
     * {@inheritDoc}
     */
    public function getAnnualBrokerageIncome()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAnnualBrokerageIncome', []);

        return parent::getAnnualBrokerageIncome();
    }

    /**
     * {@inheritDoc}
     */
    public function setAnnualBrokerageIncome($annualBrokerageIncome)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAnnualBrokerageIncome', [$annualBrokerageIncome]);

        return parent::setAnnualBrokerageIncome($annualBrokerageIncome);
    }

    /**
     * {@inheritDoc}
     */
    public function getIsUnderwritingAgent()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIsUnderwritingAgent', []);

        return parent::getIsUnderwritingAgent();
    }

    /**
     * {@inheritDoc}
     */
    public function setIsUnderwritingAgent($isUnderwritingAgent)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsUnderwritingAgent', [$isUnderwritingAgent]);

        return parent::setIsUnderwritingAgent($isUnderwritingAgent);
    }

    /**
     * {@inheritDoc}
     */
    public function getProfession()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getProfession', []);

        return parent::getProfession();
    }

    /**
     * {@inheritDoc}
     */
    public function setProfession($profession)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setProfession', [$profession]);

        return parent::setProfession($profession);
    }

    /**
     * {@inheritDoc}
     */
    public function getProfessionalBody()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getProfessionalBody', []);

        return parent::getProfessionalBody();
    }

    /**
     * {@inheritDoc}
     */
    public function setProfessionalBody($professionalBody)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setProfessionalBody', [$professionalBody]);

        return parent::setProfessionalBody($professionalBody);
    }

    /**
     * {@inheritDoc}
     */
    public function getMembership()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMembership', []);

        return parent::getMembership();
    }

    /**
     * {@inheritDoc}
     */
    public function setMembership($membership)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setMembership', [$membership]);

        return parent::setMembership($membership);
    }

    /**
     * {@inheritDoc}
     */
    public function getProfessionDuration()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getProfessionDuration', []);

        return parent::getProfessionDuration();
    }

    /**
     * {@inheritDoc}
     */
    public function setProfessionDuration($professionDuration)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setProfessionDuration', [$professionDuration]);

        return parent::setProfessionDuration($professionDuration);
    }

    /**
     * {@inheritDoc}
     */
    public function getIsPreviousInsure()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIsPreviousInsure', []);

        return parent::getIsPreviousInsure();
    }

    /**
     * {@inheritDoc}
     */
    public function setIsPreviousInsure($isPreviousInsure)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsPreviousInsure', [$isPreviousInsure]);

        return parent::setIsPreviousInsure($isPreviousInsure);
    }

    /**
     * {@inheritDoc}
     */
    public function getIsDeclined()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIsDeclined', []);

        return parent::getIsDeclined();
    }

    /**
     * {@inheritDoc}
     */
    public function setIsDeclined($isDeclined)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsDeclined', [$isDeclined]);

        return parent::setIsDeclined($isDeclined);
    }

    /**
     * {@inheritDoc}
     */
    public function getIsSubjectToIncrease()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIsSubjectToIncrease', []);

        return parent::getIsSubjectToIncrease();
    }

    /**
     * {@inheritDoc}
     */
    public function setIsSubjectToIncrease($isSubjectToIncrease)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsSubjectToIncrease', [$isSubjectToIncrease]);

        return parent::setIsSubjectToIncrease($isSubjectToIncrease);
    }

    /**
     * {@inheritDoc}
     */
    public function getIsSpecialRestriction()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIsSpecialRestriction', []);

        return parent::getIsSpecialRestriction();
    }

    /**
     * {@inheritDoc}
     */
    public function setIsSpecialRestriction($isSpecialRestriction)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsSpecialRestriction', [$isSpecialRestriction]);

        return parent::setIsSpecialRestriction($isSpecialRestriction);
    }

    /**
     * {@inheritDoc}
     */
    public function getSpecialRestriction()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSpecialRestriction', []);

        return parent::getSpecialRestriction();
    }

    /**
     * {@inheritDoc}
     */
    public function setSpecialRestriction($specialRestriction)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSpecialRestriction', [$specialRestriction]);

        return parent::setSpecialRestriction($specialRestriction);
    }

    /**
     * {@inheritDoc}
     */
    public function getIsOtherCountery()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIsOtherCountery', []);

        return parent::getIsOtherCountery();
    }

    /**
     * {@inheritDoc}
     */
    public function setIsOtherCountery($isOtherCountery)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsOtherCountery', [$isOtherCountery]);

        return parent::setIsOtherCountery($isOtherCountery);
    }

    /**
     * {@inheritDoc}
     */
    public function getOtherCountry()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getOtherCountry', []);

        return parent::getOtherCountry();
    }

    /**
     * {@inheritDoc}
     */
    public function addOtherCountry($country)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addOtherCountry', [$country]);

        return parent::addOtherCountry($country);
    }

    /**
     * {@inheritDoc}
     */
    public function removeOtherCountry($country)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeOtherCountry', [$country]);

        return parent::removeOtherCountry($country);
    }

    /**
     * {@inheritDoc}
     */
    public function getIsAdditonalInfo()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIsAdditonalInfo', []);

        return parent::getIsAdditonalInfo();
    }

    /**
     * {@inheritDoc}
     */
    public function setIsAdditonalInfo($isAdditonalInfo)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsAdditonalInfo', [$isAdditonalInfo]);

        return parent::setIsAdditonalInfo($isAdditonalInfo);
    }

    /**
     * {@inheritDoc}
     */
    public function getTotalPartners()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTotalPartners', []);

        return parent::getTotalPartners();
    }

    /**
     * {@inheritDoc}
     */
    public function setTotalPartners($totalPartners)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setTotalPartners', [$totalPartners]);

        return parent::setTotalPartners($totalPartners);
    }

    /**
     * {@inheritDoc}
     */
    public function getTotalStaff()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTotalStaff', []);

        return parent::getTotalStaff();
    }

    /**
     * {@inheritDoc}
     */
    public function setTotalStaff($totalStaff)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setTotalStaff', [$totalStaff]);

        return parent::setTotalStaff($totalStaff);
    }

    /**
     * {@inheritDoc}
     */
    public function getIsCoverAllStaff()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIsCoverAllStaff', []);

        return parent::getIsCoverAllStaff();
    }

    /**
     * {@inheritDoc}
     */
    public function setIsCoverAllStaff($isCoverAllStaff)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsCoverAllStaff', [$isCoverAllStaff]);

        return parent::setIsCoverAllStaff($isCoverAllStaff);
    }

    /**
     * {@inheritDoc}
     */
    public function getLimitIndemnity()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getLimitIndemnity', []);

        return parent::getLimitIndemnity();
    }

    /**
     * {@inheritDoc}
     */
    public function setLimitIndemnity($limitIndemnity)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setLimitIndemnity', [$limitIndemnity]);

        return parent::setLimitIndemnity($limitIndemnity);
    }

    /**
     * {@inheritDoc}
     */
    public function getIsOutStandingIndemnity()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIsOutStandingIndemnity', []);

        return parent::getIsOutStandingIndemnity();
    }

    /**
     * {@inheritDoc}
     */
    public function setIsOutStandingIndemnity($isOutStandingIndemnity)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsOutStandingIndemnity', [$isOutStandingIndemnity]);

        return parent::setIsOutStandingIndemnity($isOutStandingIndemnity);
    }

}