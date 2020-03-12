<?php
namespace Customer\View\Helper\Object;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;
use Object\Service\ObjectService;

/**
 *
 * @author otaba
 *        
 */
class CustomerAllObjectStatus extends AbstractHelper implements ServiceLocatorAwareInterface
{

    private $serviceLocator;

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

    public function __invoke($objectEntity)
    {
        $url = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("ViewHelperManager")
            ->get("url");
        $objectType = $objectEntity->getObjectType()->getId();
        switch ($objectType) {
            case ObjectService::OBJECT_TYPE_MOTOR:
                $motorEntity = $objectEntity->getObjectMotor();
                if ($motorEntity == NULL) {
                    return "<span class='btn btn-xs btn-danger'><i class='fa fa-car'> </i> Incomplete Details</span>";
                } else {
                    return "<span class='btn btn-xs btn-success'><i class='fa fa-car'> </i> Completed and Locked</span>";
                }
                break;
            
            case ObjectService::OBJECT_TYPE_BUSINESS:
                $businessEntity = $objectEntity->getObjectBusiness();
                if ($businessEntity == NULL) {
                    return "<span class='btn btn-xs btn-danger'><i class='fa fa-line-chart'> </i> Incomplete  Details</span>";
                } else {
                    return "<span class='btn btn-xs btn-success'><i class='fa fa-line-chart'> </i> Completed and Locked</span>";
                }
                break;
            case ObjectService::OBJECT_TYPE_BUILDING:
                $buildingEntity = $objectEntity->getObjectBuilding();
                if ($buildingEntity == NULL) {
                    return "<span class='btn btn-xs btn-danger'><i class='fa fa-university'> </i> Incomplete Details</span>";
                } else {
                    return "<span class='btn btn-xs btn-success'><i class='fa fa-university'> </i> Completed and Locked</span>";
                }
                break;
            case ObjectService::OBJECT_TYPE_BUSINESS_ITEM:
                $businessEquipment = $objectEntity->getBusinessEquipment();
                if ($businessEquipment == NULL) {
                    return "<span class='btn btn-xs btn-danger'><i class='fa fa-suitcase'> </i> Incomplete  Details</span>";
                } else {
                    return "<span class='btn btn-xs btn-success'><i class='fa fa-suitcase'> </i> Completed and Locked</span>";
                }
                break;
            case ObjectService::OBJECT_TYPE_TRAVEL:
                $objectTravel = $objectEntity->getObjectTravel();
                if ($objectTravel == NULL) {
                    return "<span class='btn btn-xs btn-danger'><i class='fa fa-plane'> </i> Incomplete Details</span>";
                } else {
                    return "<span class='btn btn-xs btn-success'><i class='fa fa-plane'> </i> Completed and Locked</span>";
                }
                break;
                
            case ObjectService::OBJECT_TYPE_OTHERS:
                $objectOthers = $objectEntity->getObjectOthers();
                if ($objectOthers == NULL) {
                    return "<span class='btn btn-xs btn-danger'><i class='fa fa-wrench'> </i> Incomplete Details</span>";
                } else {
                    return "<span class='btn btn-xs btn-success'><i class='fa fa-wrench'> </i> Completed and Locked</span>";
                }
                break;
                
            case ObjectService::OBJECT_TYPE_LIFE_OR_PERSON:
                $objectPerson = $objectEntity->getObjectLife();
                if ($objectPerson == NULL) {
                    return "<span class='btn btn-xs btn-danger'><i class='md md-accessibility'> </i> Incomplete Details</span>";
                } else {
                    return "<span class='btn btn-xs btn-success'><i class='md md-accessibility'> </i> Completed and Locked</span>";
                }
                break;
                
            case ObjectService::OBJECT_TYPE_NON_BUSINESS_ITEM:
                $objectNonBusiness = $objectEntity->getObjectNonBusinessEquipment();
                if ($objectNonBusiness == NULL) {
                    return "<span class='btn btn-xs btn-danger'><i class='fa fa-minus-square-o'> </i> Incomplete Details</span>";
                } else {
                    return "<span class='btn btn-xs btn-success'><i class='fa fa-minus-square-o'> </i> Completed and Locked</span>";
                }
                break;
        }
    }
}

