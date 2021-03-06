<?php

namespace DoctrineORMModule\Proxy\__CG__\IMServices\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class CoverDetails extends \IMServices\Entity\CoverDetails implements \Doctrine\ORM\Proxy\Proxy
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
            return ['__isInitialized__', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'id', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'agricPropertyInsurance', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'boilerInsurance', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'motorInsurance', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'cashInSafeInsurance', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'cashInTransitInsurance', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'aviationInsurance', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'buglary', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'cropAgricIinsurance', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'livestockAgricInsurance', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'consequentialLoss', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'contractAllRisk', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'directorsLiability', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'electronicAllRisk', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'electonicEquipment', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'employersLiability', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'erectionAllRisk', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'fidelityGaruantee', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'fireNSpecialPeril', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'git', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'groupLife', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'groupPersonalAccident', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'homeInsurance', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'lifePolicy', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'machineryBreakdown', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'marineCargo', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'marineHull', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'oilEnergyInsurance', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'occupiersLiability', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'personalAccident', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'plantAllRisk', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'professionalIndemnity', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'propertyInsurance', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'publicLiability', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'travelInsurance', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'workmenCompensation', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'createdOn', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'updatedOn'];
        }

        return ['__isInitialized__', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'id', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'agricPropertyInsurance', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'boilerInsurance', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'motorInsurance', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'cashInSafeInsurance', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'cashInTransitInsurance', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'aviationInsurance', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'buglary', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'cropAgricIinsurance', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'livestockAgricInsurance', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'consequentialLoss', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'contractAllRisk', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'directorsLiability', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'electronicAllRisk', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'electonicEquipment', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'employersLiability', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'erectionAllRisk', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'fidelityGaruantee', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'fireNSpecialPeril', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'git', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'groupLife', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'groupPersonalAccident', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'homeInsurance', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'lifePolicy', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'machineryBreakdown', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'marineCargo', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'marineHull', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'oilEnergyInsurance', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'occupiersLiability', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'personalAccident', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'plantAllRisk', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'professionalIndemnity', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'propertyInsurance', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'publicLiability', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'travelInsurance', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'workmenCompensation', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'createdOn', '' . "\0" . 'IMServices\\Entity\\CoverDetails' . "\0" . 'updatedOn'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (CoverDetails $proxy) {
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
    public function getAgricPropertyInsurance()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAgricPropertyInsurance', []);

        return parent::getAgricPropertyInsurance();
    }

    /**
     * {@inheritDoc}
     */
    public function setAgricPropertyInsurance($agricPropertyInsurance)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAgricPropertyInsurance', [$agricPropertyInsurance]);

        return parent::setAgricPropertyInsurance($agricPropertyInsurance);
    }

    /**
     * {@inheritDoc}
     */
    public function getBoilerInsurance()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getBoilerInsurance', []);

        return parent::getBoilerInsurance();
    }

    /**
     * {@inheritDoc}
     */
    public function setBoilerInsurance($boilerInsurance)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setBoilerInsurance', [$boilerInsurance]);

        return parent::setBoilerInsurance($boilerInsurance);
    }

    /**
     * {@inheritDoc}
     */
    public function getMotorInsurance()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMotorInsurance', []);

        return parent::getMotorInsurance();
    }

    /**
     * {@inheritDoc}
     */
    public function getCashInSafeInsurance()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCashInSafeInsurance', []);

        return parent::getCashInSafeInsurance();
    }

    /**
     * {@inheritDoc}
     */
    public function setCashInSafeInsurance($cashInSafeInsurance)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCashInSafeInsurance', [$cashInSafeInsurance]);

        return parent::setCashInSafeInsurance($cashInSafeInsurance);
    }

    /**
     * {@inheritDoc}
     */
    public function getCashInTransitInsurance()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCashInTransitInsurance', []);

        return parent::getCashInTransitInsurance();
    }

    /**
     * {@inheritDoc}
     */
    public function setCashInTransitInsurance($cashInTransitInsurance)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCashInTransitInsurance', [$cashInTransitInsurance]);

        return parent::setCashInTransitInsurance($cashInTransitInsurance);
    }

    /**
     * {@inheritDoc}
     */
    public function getBuglary()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getBuglary', []);

        return parent::getBuglary();
    }

    /**
     * {@inheritDoc}
     */
    public function setBuglary($bug)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setBuglary', [$bug]);

        return parent::setBuglary($bug);
    }

    /**
     * {@inheritDoc}
     */
    public function getAviationInsurance()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAviationInsurance', []);

        return parent::getAviationInsurance();
    }

    /**
     * {@inheritDoc}
     */
    public function setAviationInsurance($aviationInsurance)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAviationInsurance', [$aviationInsurance]);

        return parent::setAviationInsurance($aviationInsurance);
    }

    /**
     * {@inheritDoc}
     */
    public function getConsequentialLoss()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getConsequentialLoss', []);

        return parent::getConsequentialLoss();
    }

    /**
     * {@inheritDoc}
     */
    public function setConsequentialLoss($loss)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setConsequentialLoss', [$loss]);

        return parent::setConsequentialLoss($loss);
    }

    /**
     * {@inheritDoc}
     */
    public function getContractAllRisk()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getContractAllRisk', []);

        return parent::getContractAllRisk();
    }

    /**
     * {@inheritDoc}
     */
    public function setContractAllRisk($risk)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setContractAllRisk', [$risk]);

        return parent::setContractAllRisk($risk);
    }

    /**
     * {@inheritDoc}
     */
    public function getDirectorsLiability()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDirectorsLiability', []);

        return parent::getDirectorsLiability();
    }

    /**
     * {@inheritDoc}
     */
    public function setDirectorsLiability($directorsLiability)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDirectorsLiability', [$directorsLiability]);

        return parent::setDirectorsLiability($directorsLiability);
    }

    /**
     * {@inheritDoc}
     */
    public function getElectronicAllRisk()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getElectronicAllRisk', []);

        return parent::getElectronicAllRisk();
    }

    /**
     * {@inheritDoc}
     */
    public function setElectronicAllRisk($risk)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setElectronicAllRisk', [$risk]);

        return parent::setElectronicAllRisk($risk);
    }

    /**
     * {@inheritDoc}
     */
    public function setEmployersLiability($re)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEmployersLiability', [$re]);

        return parent::setEmployersLiability($re);
    }

    /**
     * {@inheritDoc}
     */
    public function getErectionAllRisk()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getErectionAllRisk', []);

        return parent::getErectionAllRisk();
    }

    /**
     * {@inheritDoc}
     */
    public function setErectionAllRisk($rec)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setErectionAllRisk', [$rec]);

        return parent::setErectionAllRisk($rec);
    }

    /**
     * {@inheritDoc}
     */
    public function getFidelityGaruantee()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFidelityGaruantee', []);

        return parent::getFidelityGaruantee();
    }

    /**
     * {@inheritDoc}
     */
    public function setFidelityGaruantee($fid)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setFidelityGaruantee', [$fid]);

        return parent::setFidelityGaruantee($fid);
    }

    /**
     * {@inheritDoc}
     */
    public function getFireNSpecialPeril()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFireNSpecialPeril', []);

        return parent::getFireNSpecialPeril();
    }

    /**
     * {@inheritDoc}
     */
    public function setFireNSpecialPeril($peril)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setFireNSpecialPeril', [$peril]);

        return parent::setFireNSpecialPeril($peril);
    }

    /**
     * {@inheritDoc}
     */
    public function getGit()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getGit', []);

        return parent::getGit();
    }

    /**
     * {@inheritDoc}
     */
    public function setGit($git)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setGit', [$git]);

        return parent::setGit($git);
    }

    /**
     * {@inheritDoc}
     */
    public function getGroupLife()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getGroupLife', []);

        return parent::getGroupLife();
    }

    /**
     * {@inheritDoc}
     */
    public function setGroupLife($life)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setGroupLife', [$life]);

        return parent::setGroupLife($life);
    }

    /**
     * {@inheritDoc}
     */
    public function getGroupPersonalAccident()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getGroupPersonalAccident', []);

        return parent::getGroupPersonalAccident();
    }

    /**
     * {@inheritDoc}
     */
    public function setGroupPersonalAccident($grp)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setGroupPersonalAccident', [$grp]);

        return parent::setGroupPersonalAccident($grp);
    }

    /**
     * {@inheritDoc}
     */
    public function getHomeProperty()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getHomeProperty', []);

        return parent::getHomeProperty();
    }

    /**
     * {@inheritDoc}
     */
    public function setHomeProperty($prop)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setHomeProperty', [$prop]);

        return parent::setHomeProperty($prop);
    }

    /**
     * {@inheritDoc}
     */
    public function getLifePolicy()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getLifePolicy', []);

        return parent::getLifePolicy();
    }

    /**
     * {@inheritDoc}
     */
    public function setLifePolicy($pol)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setLifePolicy', [$pol]);

        return parent::setLifePolicy($pol);
    }

    /**
     * {@inheritDoc}
     */
    public function getMarineCargo()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMarineCargo', []);

        return parent::getMarineCargo();
    }

    /**
     * {@inheritDoc}
     */
    public function setMarineCargo($marine)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setMarineCargo', [$marine]);

        return parent::setMarineCargo($marine);
    }

    /**
     * {@inheritDoc}
     */
    public function getPersonalAccident()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPersonalAccident', []);

        return parent::getPersonalAccident();
    }

    /**
     * {@inheritDoc}
     */
    public function setPersonalAccident($acci)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPersonalAccident', [$acci]);

        return parent::setPersonalAccident($acci);
    }

    /**
     * {@inheritDoc}
     */
    public function getPlantAllRisk()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPlantAllRisk', []);

        return parent::getPlantAllRisk();
    }

    /**
     * {@inheritDoc}
     */
    public function setPlantAllRisk($risk)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPlantAllRisk', [$risk]);

        return parent::setPlantAllRisk($risk);
    }

    /**
     * {@inheritDoc}
     */
    public function getProfessionalIndemnity()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getProfessionalIndemnity', []);

        return parent::getProfessionalIndemnity();
    }

    /**
     * {@inheritDoc}
     */
    public function setProfessionalIndemnity($set)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setProfessionalIndemnity', [$set]);

        return parent::setProfessionalIndemnity($set);
    }

    /**
     * {@inheritDoc}
     */
    public function getPropertInsurance()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPropertInsurance', []);

        return parent::getPropertInsurance();
    }

    /**
     * {@inheritDoc}
     */
    public function setPropertyInsurance($ins)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPropertyInsurance', [$ins]);

        return parent::setPropertyInsurance($ins);
    }

    /**
     * {@inheritDoc}
     */
    public function getPublicLiability()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPublicLiability', []);

        return parent::getPublicLiability();
    }

    /**
     * {@inheritDoc}
     */
    public function setPublicLiability($set)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPublicLiability', [$set]);

        return parent::setPublicLiability($set);
    }

    /**
     * {@inheritDoc}
     */
    public function getTravelInsurance()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTravelInsurance', []);

        return parent::getTravelInsurance();
    }

    /**
     * {@inheritDoc}
     */
    public function setTravelInsurance($set)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setTravelInsurance', [$set]);

        return parent::setTravelInsurance($set);
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
    public function setCreatedOn($set)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCreatedOn', [$set]);

        return parent::setCreatedOn($set);
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
    public function setUpdatedOn($set)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUpdatedOn', [$set]);

        return parent::setUpdatedOn($set);
    }

    /**
     * {@inheritDoc}
     */
    public function getEmployersLiability()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEmployersLiability', []);

        return parent::getEmployersLiability();
    }

    /**
     * {@inheritDoc}
     */
    public function getPropertyInsurance()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPropertyInsurance', []);

        return parent::getPropertyInsurance();
    }

    /**
     * {@inheritDoc}
     */
    public function setMotorInsurance($motorInsurance)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setMotorInsurance', [$motorInsurance]);

        return parent::setMotorInsurance($motorInsurance);
    }

    /**
     * {@inheritDoc}
     */
    public function getCropAgricIinsurance()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCropAgricIinsurance', []);

        return parent::getCropAgricIinsurance();
    }

    /**
     * {@inheritDoc}
     */
    public function setCropAgricIinsurance($cropAgricIinsurance)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCropAgricIinsurance', [$cropAgricIinsurance]);

        return parent::setCropAgricIinsurance($cropAgricIinsurance);
    }

    /**
     * {@inheritDoc}
     */
    public function getLivestockAgricInsurance()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getLivestockAgricInsurance', []);

        return parent::getLivestockAgricInsurance();
    }

    /**
     * {@inheritDoc}
     */
    public function setLivestockAgricInsurance($livestockAgricInsurance)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setLivestockAgricInsurance', [$livestockAgricInsurance]);

        return parent::setLivestockAgricInsurance($livestockAgricInsurance);
    }

    /**
     * {@inheritDoc}
     */
    public function getMarineHull()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMarineHull', []);

        return parent::getMarineHull();
    }

    /**
     * {@inheritDoc}
     */
    public function setMarineHull($marineHull)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setMarineHull', [$marineHull]);

        return parent::setMarineHull($marineHull);
    }

    /**
     * {@inheritDoc}
     */
    public function getOilEnergyInsurance()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getOilEnergyInsurance', []);

        return parent::getOilEnergyInsurance();
    }

    /**
     * {@inheritDoc}
     */
    public function setOilEnergyInsurance($oilEnergyInsurance)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setOilEnergyInsurance', [$oilEnergyInsurance]);

        return parent::setOilEnergyInsurance($oilEnergyInsurance);
    }

    /**
     * {@inheritDoc}
     */
    public function getElectonicEquipment()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getElectonicEquipment', []);

        return parent::getElectonicEquipment();
    }

    /**
     * {@inheritDoc}
     */
    public function setElectonicEquipment($electonicEquipment)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setElectonicEquipment', [$electonicEquipment]);

        return parent::setElectonicEquipment($electonicEquipment);
    }

    /**
     * {@inheritDoc}
     */
    public function getWorkmenCompensation()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getWorkmenCompensation', []);

        return parent::getWorkmenCompensation();
    }

    /**
     * {@inheritDoc}
     */
    public function setWorkmenCompensation($workmenCompensation)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setWorkmenCompensation', [$workmenCompensation]);

        return parent::setWorkmenCompensation($workmenCompensation);
    }

    /**
     * {@inheritDoc}
     */
    public function getHomeInsurance()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getHomeInsurance', []);

        return parent::getHomeInsurance();
    }

    /**
     * {@inheritDoc}
     */
    public function setHomeInsurance($homeInsurance)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setHomeInsurance', [$homeInsurance]);

        return parent::setHomeInsurance($homeInsurance);
    }

    /**
     * {@inheritDoc}
     */
    public function getMachineryBreakdown()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMachineryBreakdown', []);

        return parent::getMachineryBreakdown();
    }

    /**
     * {@inheritDoc}
     */
    public function setMachineryBreakdown($machineryBreakdown)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setMachineryBreakdown', [$machineryBreakdown]);

        return parent::setMachineryBreakdown($machineryBreakdown);
    }

    /**
     * {@inheritDoc}
     */
    public function getOccupiersLiability()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getOccupiersLiability', []);

        return parent::getOccupiersLiability();
    }

    /**
     * {@inheritDoc}
     */
    public function setOccupiersLiability($occupiersLiability)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setOccupiersLiability', [$occupiersLiability]);

        return parent::setOccupiersLiability($occupiersLiability);
    }

}
