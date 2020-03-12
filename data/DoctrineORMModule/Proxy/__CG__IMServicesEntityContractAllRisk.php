<?php

namespace DoctrineORMModule\Proxy\__CG__\IMServices\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class ContractAllRisk extends \IMServices\Entity\ContractAllRisk implements \Doctrine\ORM\Proxy\Proxy
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
            return ['__isInitialized__', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'id', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'contractName', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'contractAddress', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'supervisingEngineer', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'nearestAirport', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'nearestLandmark', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'contractDescription', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'mainContractor', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'consultingEngineer', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'contractStartDate', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'contractEndDate', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'isTesting', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'testingStartDate', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'testingEndDate', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'isMaintenance', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'maintenanceStartDate', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'maintenanceEndDate', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'isSimilarConstruction', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'previousContructionName', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'isExtension', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'existingPlant', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'isCivilCompleted', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'civilWork', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'isAgravatedRisk', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'isAgravatedFire', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'isAgravatedExplosion', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'isEarthQuake', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'soilCondition', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'otherSoil', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'isGeologicalFault', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'geologicalFault', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'possibleFireLoss', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'possibleQuakeLoss', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'possibleOtherLoss', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'isScafolding', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'scafoldDesc', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'isExcavatorNMachine', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'isThirdLiability', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'isAdjacentBuilding', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'isOtherRisk', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'isSpecialExtension', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'isExpressFriegthExtesion', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'isOvertimeExtension', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'isNightWorkExtension', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'isPublicHolidayExtension', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'valueList', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'contractValue', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'currency', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'object', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'createdOn'];
        }

        return ['__isInitialized__', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'id', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'contractName', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'contractAddress', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'supervisingEngineer', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'nearestAirport', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'nearestLandmark', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'contractDescription', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'mainContractor', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'consultingEngineer', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'contractStartDate', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'contractEndDate', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'isTesting', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'testingStartDate', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'testingEndDate', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'isMaintenance', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'maintenanceStartDate', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'maintenanceEndDate', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'isSimilarConstruction', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'previousContructionName', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'isExtension', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'existingPlant', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'isCivilCompleted', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'civilWork', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'isAgravatedRisk', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'isAgravatedFire', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'isAgravatedExplosion', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'isEarthQuake', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'soilCondition', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'otherSoil', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'isGeologicalFault', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'geologicalFault', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'possibleFireLoss', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'possibleQuakeLoss', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'possibleOtherLoss', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'isScafolding', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'scafoldDesc', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'isExcavatorNMachine', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'isThirdLiability', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'isAdjacentBuilding', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'isOtherRisk', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'isSpecialExtension', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'isExpressFriegthExtesion', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'isOvertimeExtension', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'isNightWorkExtension', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'isPublicHolidayExtension', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'valueList', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'contractValue', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'currency', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'object', '' . "\0" . 'IMServices\\Entity\\ContractAllRisk' . "\0" . 'createdOn'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (ContractAllRisk $proxy) {
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
    public function getContractName()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getContractName', []);

        return parent::getContractName();
    }

    /**
     * {@inheritDoc}
     */
    public function setContractName($name)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setContractName', [$name]);

        return parent::setContractName($name);
    }

    /**
     * {@inheritDoc}
     */
    public function getContractAddress()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getContractAddress', []);

        return parent::getContractAddress();
    }

    /**
     * {@inheritDoc}
     */
    public function setContractAddress($add)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setContractAddress', [$add]);

        return parent::setContractAddress($add);
    }

    /**
     * {@inheritDoc}
     */
    public function getSupervisingEngineer()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSupervisingEngineer', []);

        return parent::getSupervisingEngineer();
    }

    /**
     * {@inheritDoc}
     */
    public function setSupervisingEngineer($eng)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSupervisingEngineer', [$eng]);

        return parent::setSupervisingEngineer($eng);
    }

    /**
     * {@inheritDoc}
     */
    public function getNearestLandmark()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNearestLandmark', []);

        return parent::getNearestLandmark();
    }

    /**
     * {@inheritDoc}
     */
    public function setNearestLandmark($near)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setNearestLandmark', [$near]);

        return parent::setNearestLandmark($near);
    }

    /**
     * {@inheritDoc}
     */
    public function getNearestAirport()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNearestAirport', []);

        return parent::getNearestAirport();
    }

    /**
     * {@inheritDoc}
     */
    public function setNearestAirport($near)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setNearestAirport', [$near]);

        return parent::setNearestAirport($near);
    }

    /**
     * {@inheritDoc}
     */
    public function getContractDescription()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getContractDescription', []);

        return parent::getContractDescription();
    }

    /**
     * {@inheritDoc}
     */
    public function setContractDescription($desc)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setContractDescription', [$desc]);

        return parent::setContractDescription($desc);
    }

    /**
     * {@inheritDoc}
     */
    public function getContractValue()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getContractValue', []);

        return parent::getContractValue();
    }

    /**
     * {@inheritDoc}
     */
    public function setContractValue($val)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setContractValue', [$val]);

        return parent::setContractValue($val);
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
    public function setCurrency($cur)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCurrency', [$cur]);

        return parent::setCurrency($cur);
    }

    /**
     * {@inheritDoc}
     */
    public function getObject()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getObject', []);

        return parent::getObject();
    }

    /**
     * {@inheritDoc}
     */
    public function setObject($obj)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setObject', [$obj]);

        return parent::setObject($obj);
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
    public function getCoverDetails()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCoverDetails', []);

        return parent::getCoverDetails();
    }

    /**
     * {@inheritDoc}
     */
    public function setCoverDetails($det)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCoverDetails', [$det]);

        return parent::setCoverDetails($det);
    }

    /**
     * {@inheritDoc}
     */
    public function getMainContractor()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMainContractor', []);

        return parent::getMainContractor();
    }

    /**
     * {@inheritDoc}
     */
    public function setMainContractor($mainContractor)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setMainContractor', [$mainContractor]);

        return parent::setMainContractor($mainContractor);
    }

    /**
     * {@inheritDoc}
     */
    public function getConsultingEngineer()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getConsultingEngineer', []);

        return parent::getConsultingEngineer();
    }

    /**
     * {@inheritDoc}
     */
    public function setConsultingEngineer($consultingEngineer)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setConsultingEngineer', [$consultingEngineer]);

        return parent::setConsultingEngineer($consultingEngineer);
    }

    /**
     * {@inheritDoc}
     */
    public function getContractStartDate()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getContractStartDate', []);

        return parent::getContractStartDate();
    }

    /**
     * {@inheritDoc}
     */
    public function setContractStartDate($contractStartDate)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setContractStartDate', [$contractStartDate]);

        return parent::setContractStartDate($contractStartDate);
    }

    /**
     * {@inheritDoc}
     */
    public function getContractEndDate()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getContractEndDate', []);

        return parent::getContractEndDate();
    }

    /**
     * {@inheritDoc}
     */
    public function setContractEndDate($contractEndDate)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setContractEndDate', [$contractEndDate]);

        return parent::setContractEndDate($contractEndDate);
    }

    /**
     * {@inheritDoc}
     */
    public function getIsTesting()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIsTesting', []);

        return parent::getIsTesting();
    }

    /**
     * {@inheritDoc}
     */
    public function setIsTesting($isTesting)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsTesting', [$isTesting]);

        return parent::setIsTesting($isTesting);
    }

    /**
     * {@inheritDoc}
     */
    public function getTestingStartDate()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTestingStartDate', []);

        return parent::getTestingStartDate();
    }

    /**
     * {@inheritDoc}
     */
    public function setTestingStartDate($testingStartDate)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setTestingStartDate', [$testingStartDate]);

        return parent::setTestingStartDate($testingStartDate);
    }

    /**
     * {@inheritDoc}
     */
    public function getTestingEndDate()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTestingEndDate', []);

        return parent::getTestingEndDate();
    }

    /**
     * {@inheritDoc}
     */
    public function setTestingEndDate($testingEndDate)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setTestingEndDate', [$testingEndDate]);

        return parent::setTestingEndDate($testingEndDate);
    }

    /**
     * {@inheritDoc}
     */
    public function getIsMaintenance()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIsMaintenance', []);

        return parent::getIsMaintenance();
    }

    /**
     * {@inheritDoc}
     */
    public function setIsMaintenance($isMaintenance)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsMaintenance', [$isMaintenance]);

        return parent::setIsMaintenance($isMaintenance);
    }

    /**
     * {@inheritDoc}
     */
    public function getMaintenanceStartDate()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMaintenanceStartDate', []);

        return parent::getMaintenanceStartDate();
    }

    /**
     * {@inheritDoc}
     */
    public function setMaintenanceStartDate($maintenanceStartDate)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setMaintenanceStartDate', [$maintenanceStartDate]);

        return parent::setMaintenanceStartDate($maintenanceStartDate);
    }

    /**
     * {@inheritDoc}
     */
    public function getMaintenanceEndDate()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMaintenanceEndDate', []);

        return parent::getMaintenanceEndDate();
    }

    /**
     * {@inheritDoc}
     */
    public function setMaintenanceEndDate($maintenanceEndDate)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setMaintenanceEndDate', [$maintenanceEndDate]);

        return parent::setMaintenanceEndDate($maintenanceEndDate);
    }

    /**
     * {@inheritDoc}
     */
    public function getIsSimilarConstruction()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIsSimilarConstruction', []);

        return parent::getIsSimilarConstruction();
    }

    /**
     * {@inheritDoc}
     */
    public function setIsSimilarConstruction($isSimilarConstruction)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsSimilarConstruction', [$isSimilarConstruction]);

        return parent::setIsSimilarConstruction($isSimilarConstruction);
    }

    /**
     * {@inheritDoc}
     */
    public function getPreviousContructionName()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPreviousContructionName', []);

        return parent::getPreviousContructionName();
    }

    /**
     * {@inheritDoc}
     */
    public function setPreviousContructionName($previousContructionName)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPreviousContructionName', [$previousContructionName]);

        return parent::setPreviousContructionName($previousContructionName);
    }

    /**
     * {@inheritDoc}
     */
    public function getIsExtension()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIsExtension', []);

        return parent::getIsExtension();
    }

    /**
     * {@inheritDoc}
     */
    public function setIsExtension($isExtension)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsExtension', [$isExtension]);

        return parent::setIsExtension($isExtension);
    }

    /**
     * {@inheritDoc}
     */
    public function getExistingPlant()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getExistingPlant', []);

        return parent::getExistingPlant();
    }

    /**
     * {@inheritDoc}
     */
    public function setExistingPlant($existingPlant)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setExistingPlant', [$existingPlant]);

        return parent::setExistingPlant($existingPlant);
    }

    /**
     * {@inheritDoc}
     */
    public function getIsCivilCompleted()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIsCivilCompleted', []);

        return parent::getIsCivilCompleted();
    }

    /**
     * {@inheritDoc}
     */
    public function setIsCivilCompleted($isCivilCompleted)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsCivilCompleted', [$isCivilCompleted]);

        return parent::setIsCivilCompleted($isCivilCompleted);
    }

    /**
     * {@inheritDoc}
     */
    public function getCivilWork()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCivilWork', []);

        return parent::getCivilWork();
    }

    /**
     * {@inheritDoc}
     */
    public function setCivilWork($civilWork)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCivilWork', [$civilWork]);

        return parent::setCivilWork($civilWork);
    }

    /**
     * {@inheritDoc}
     */
    public function getIsAgravatedRisk()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIsAgravatedRisk', []);

        return parent::getIsAgravatedRisk();
    }

    /**
     * {@inheritDoc}
     */
    public function setIsAgravatedRisk($isAgravatedRisk)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsAgravatedRisk', [$isAgravatedRisk]);

        return parent::setIsAgravatedRisk($isAgravatedRisk);
    }

    /**
     * {@inheritDoc}
     */
    public function getIsAgravatedFire()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIsAgravatedFire', []);

        return parent::getIsAgravatedFire();
    }

    /**
     * {@inheritDoc}
     */
    public function setIsAgravatedFire($isAgravatedFire)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsAgravatedFire', [$isAgravatedFire]);

        return parent::setIsAgravatedFire($isAgravatedFire);
    }

    /**
     * {@inheritDoc}
     */
    public function getIsAgravatedExplosion()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIsAgravatedExplosion', []);

        return parent::getIsAgravatedExplosion();
    }

    /**
     * {@inheritDoc}
     */
    public function setIsAgravatedExplosion($isAgravatedExplosion)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsAgravatedExplosion', [$isAgravatedExplosion]);

        return parent::setIsAgravatedExplosion($isAgravatedExplosion);
    }

    /**
     * {@inheritDoc}
     */
    public function getIsEarthQuake()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIsEarthQuake', []);

        return parent::getIsEarthQuake();
    }

    /**
     * {@inheritDoc}
     */
    public function setIsEarthQuake($isEarthQuake)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsEarthQuake', [$isEarthQuake]);

        return parent::setIsEarthQuake($isEarthQuake);
    }

    /**
     * {@inheritDoc}
     */
    public function getSoilCondition()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSoilCondition', []);

        return parent::getSoilCondition();
    }

    /**
     * {@inheritDoc}
     */
    public function setSoilCondition($soilCondition)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSoilCondition', [$soilCondition]);

        return parent::setSoilCondition($soilCondition);
    }

    /**
     * {@inheritDoc}
     */
    public function getOtherSoil()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getOtherSoil', []);

        return parent::getOtherSoil();
    }

    /**
     * {@inheritDoc}
     */
    public function setOtherSoil($otherSoil)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setOtherSoil', [$otherSoil]);

        return parent::setOtherSoil($otherSoil);
    }

    /**
     * {@inheritDoc}
     */
    public function getIsGeologicalFault()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIsGeologicalFault', []);

        return parent::getIsGeologicalFault();
    }

    /**
     * {@inheritDoc}
     */
    public function setIsGeologicalFault($isGeologicalFault)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsGeologicalFault', [$isGeologicalFault]);

        return parent::setIsGeologicalFault($isGeologicalFault);
    }

    /**
     * {@inheritDoc}
     */
    public function getGeologicalFault()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getGeologicalFault', []);

        return parent::getGeologicalFault();
    }

    /**
     * {@inheritDoc}
     */
    public function setGeologicalFault($geologicalFault)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setGeologicalFault', [$geologicalFault]);

        return parent::setGeologicalFault($geologicalFault);
    }

    /**
     * {@inheritDoc}
     */
    public function getPossibleFireLoss()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPossibleFireLoss', []);

        return parent::getPossibleFireLoss();
    }

    /**
     * {@inheritDoc}
     */
    public function setPossibleFireLoss($possibleFireLoss)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPossibleFireLoss', [$possibleFireLoss]);

        return parent::setPossibleFireLoss($possibleFireLoss);
    }

    /**
     * {@inheritDoc}
     */
    public function getPossibleQuakeLoss()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPossibleQuakeLoss', []);

        return parent::getPossibleQuakeLoss();
    }

    /**
     * {@inheritDoc}
     */
    public function setPossibleQuakeLoss($possibleQuakeLoss)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPossibleQuakeLoss', [$possibleQuakeLoss]);

        return parent::setPossibleQuakeLoss($possibleQuakeLoss);
    }

    /**
     * {@inheritDoc}
     */
    public function getPossibleOtherLoss()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPossibleOtherLoss', []);

        return parent::getPossibleOtherLoss();
    }

    /**
     * {@inheritDoc}
     */
    public function setPossibleOtherLoss($possibleOtherLoss)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPossibleOtherLoss', [$possibleOtherLoss]);

        return parent::setPossibleOtherLoss($possibleOtherLoss);
    }

    /**
     * {@inheritDoc}
     */
    public function getIsScafolding()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIsScafolding', []);

        return parent::getIsScafolding();
    }

    /**
     * {@inheritDoc}
     */
    public function setIsScafolding($isScafolding)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsScafolding', [$isScafolding]);

        return parent::setIsScafolding($isScafolding);
    }

    /**
     * {@inheritDoc}
     */
    public function getScafoldDesc()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getScafoldDesc', []);

        return parent::getScafoldDesc();
    }

    /**
     * {@inheritDoc}
     */
    public function setScafoldDesc($scafoldDesc)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setScafoldDesc', [$scafoldDesc]);

        return parent::setScafoldDesc($scafoldDesc);
    }

    /**
     * {@inheritDoc}
     */
    public function getIsExcavatorNMachine()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIsExcavatorNMachine', []);

        return parent::getIsExcavatorNMachine();
    }

    /**
     * {@inheritDoc}
     */
    public function setIsExcavatorNMachine($isExcavatorNMachine)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsExcavatorNMachine', [$isExcavatorNMachine]);

        return parent::setIsExcavatorNMachine($isExcavatorNMachine);
    }

    /**
     * {@inheritDoc}
     */
    public function getIsThirdLiability()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIsThirdLiability', []);

        return parent::getIsThirdLiability();
    }

    /**
     * {@inheritDoc}
     */
    public function setIsThirdLiability($isThirdLiability)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsThirdLiability', [$isThirdLiability]);

        return parent::setIsThirdLiability($isThirdLiability);
    }

    /**
     * {@inheritDoc}
     */
    public function getIsAdjacentBuilding()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIsAdjacentBuilding', []);

        return parent::getIsAdjacentBuilding();
    }

    /**
     * {@inheritDoc}
     */
    public function setIsAdjacentBuilding($isAdjacentBuilding)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsAdjacentBuilding', [$isAdjacentBuilding]);

        return parent::setIsAdjacentBuilding($isAdjacentBuilding);
    }

    /**
     * {@inheritDoc}
     */
    public function getIsSpecialExtension()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIsSpecialExtension', []);

        return parent::getIsSpecialExtension();
    }

    /**
     * {@inheritDoc}
     */
    public function setIsSpecialExtension($isSpecialExtension)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsSpecialExtension', [$isSpecialExtension]);

        return parent::setIsSpecialExtension($isSpecialExtension);
    }

    /**
     * {@inheritDoc}
     */
    public function getIsExpressFriegthExtesion()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIsExpressFriegthExtesion', []);

        return parent::getIsExpressFriegthExtesion();
    }

    /**
     * {@inheritDoc}
     */
    public function setIsExpressFriegthExtesion($isExpressFriegthExtesion)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsExpressFriegthExtesion', [$isExpressFriegthExtesion]);

        return parent::setIsExpressFriegthExtesion($isExpressFriegthExtesion);
    }

    /**
     * {@inheritDoc}
     */
    public function getIsOvertimeExtension()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIsOvertimeExtension', []);

        return parent::getIsOvertimeExtension();
    }

    /**
     * {@inheritDoc}
     */
    public function setIsOvertimeExtension($isOvertimeExtension)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsOvertimeExtension', [$isOvertimeExtension]);

        return parent::setIsOvertimeExtension($isOvertimeExtension);
    }

    /**
     * {@inheritDoc}
     */
    public function getIsNightWorkExtension()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIsNightWorkExtension', []);

        return parent::getIsNightWorkExtension();
    }

    /**
     * {@inheritDoc}
     */
    public function setIsNightWorkExtension($isNightWorkExtension)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsNightWorkExtension', [$isNightWorkExtension]);

        return parent::setIsNightWorkExtension($isNightWorkExtension);
    }

    /**
     * {@inheritDoc}
     */
    public function getIsPublicHolidayExtension()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIsPublicHolidayExtension', []);

        return parent::getIsPublicHolidayExtension();
    }

    /**
     * {@inheritDoc}
     */
    public function setIsPublicHolidayExtension($isPublicHolidayExtension)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsPublicHolidayExtension', [$isPublicHolidayExtension]);

        return parent::setIsPublicHolidayExtension($isPublicHolidayExtension);
    }

    /**
     * {@inheritDoc}
     */
    public function getValueList()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getValueList', []);

        return parent::getValueList();
    }

    /**
     * {@inheritDoc}
     */
    public function addValueList($valueList)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addValueList', [$valueList]);

        return parent::addValueList($valueList);
    }

    /**
     * {@inheritDoc}
     */
    public function removeValueList($valueList)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeValueList', [$valueList]);

        return parent::removeValueList($valueList);
    }

    /**
     * {@inheritDoc}
     */
    public function setValueList($valueList)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setValueList', [$valueList]);

        return parent::setValueList($valueList);
    }

    /**
     * {@inheritDoc}
     */
    public function getIsOtherRisk()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIsOtherRisk', []);

        return parent::getIsOtherRisk();
    }

    /**
     * {@inheritDoc}
     */
    public function setIsOtherRisk($isOtherRisk)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsOtherRisk', [$isOtherRisk]);

        return parent::setIsOtherRisk($isOtherRisk);
    }

}
