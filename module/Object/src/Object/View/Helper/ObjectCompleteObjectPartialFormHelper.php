<?php
namespace Object\View\Helper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;
use Object\Service\ObjectService;

/**
 * this class makes sure the right partial form is loaded
 * This depends on the category of form requested
 *
 * @author otaba
 *        
 */
class ObjectCompleteObjectPartialFormHelper extends AbstractHelper implements ServiceLocatorAwareInterface
{

    private $serviceLocator;

    /**
     */
    public function __construct()
    {}

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\ServiceLocatorAwareInterface::getServiceLocator()
     *
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\ServiceLocatorAwareInterface::setServiceLocator()
     *
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        return $this;
    }

    public function __invoke($objectEntity, $objectForm)
    {
        $partial = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("ViewHelperManager")
            ->get("partial");
        $objectForm->get("objectFieldset")
            ->get("objectType")
            ->setAttributes(array(
            "disabled" => "disabled"
        ));
        $basicForm = $partial("object-form-snipet", array(
            "objectField" => $objectForm->get("objectFieldset")
        ));
        
        $objectType = $objectEntity->getObjectType()->getId();
        
        switch ($objectType) {
            case ObjectService::OBJECT_TYPE_MOTOR:
                return $basicForm . $partial("object-motor-data-snipet", array(
                    "objectMotorData" => $objectForm->get("objectFieldset")->get("objectMotor")
                ));
                break;
            
            case ObjectService::OBJECT_TPE_LIFESTYLE:
                return $partial("object-business-equipment-snipet", array(
                    "objectBusinessEquipment" => $objectForm->get("objectFieldset")->get("businessEquipment")
                ));
                break;
            
            case ObjectService::OBJECT_TYPE_BUILDING:
                return $basicForm.$partial("object-building-data-snipet", array(
                "objectBuilding" => $objectForm->get("objectFieldset")->get("objectBuilding")
                ));
                break;
            
            case ObjectService::OBJECT_TYPE_BUSINESS:
               
                return $basicForm.$partial("object-business-snipet-form", array(
                "objectBusiness" => $objectForm->get("objectFieldset")->get("objectBusiness")
                ));
                break;
            
            case ObjectService::OBJECT_TYPE_BUSINESS_ITEM:
                return $basicForm. $partial("object-business-equipment-snipet", array(
                    "objectBusinessEquipment" => $objectForm->get("objectFieldset")->get("businessEquipment")
                ));
                break;
               
            
            case ObjectService::OBJECT_TYPE_LIFE_OR_PERSON:
                return $basicForm.$partial("object-person-snippet-form", array(
                "objectPerson" => $objectForm->get("objectFieldset")->get("objectLife")
                ));
                break;
            case ObjectService::OBJECT_TYPE_NON_BUSINESS_ITEM:
                return $basicForm.$partial("object-no-business-equipment-form-snipet", array(
                "objectNonBusiness" => $objectForm->get("objectFieldset")->get("objectNonBusinessEquipment")
                ));
                break;
            
            case ObjectService::OBJECT_TYPE_OTHERS:
                return $basicForm . $partial("object-others-snipet-form", array(
                "objectothers" => $objectForm->get("objectFieldset")->get("objectOthers")
                ));
                break;
                
            
            case ObjectService::OBJECT_TYPE_SPORTS:
                return $partial("", array(
                    "objectForm" => $objectForm
                ));
                break;
            
            case ObjectService::OBJECT_TYPE_TRAVEL:
                return $basicForm . $partial("object-travel-snipet-form", array(
                "objectTravel" => $objectForm->get("objectFieldset")->get("objectTravel")
                ));
                
                break;
        }
    }
}

