<?php
namespace Customer\View\Helper\Object;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;
use Object\Service\ObjectService;

/**
 * This view helper defines the action button in the list of propertie at the customer interface
 *
 * @author otaba
 *        
 */
class CustomerObjectActionHelper extends AbstractHelper implements ServiceLocatorAwareInterface
{

    private $servicelocator;

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
        return $this->servicelocator;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\ServiceLocatorAwareInterface::setServiceLocator()
     *
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->servicelocator = $serviceLocator;
        return $this;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\View\Helper\Navigation\HelperInterface::render()
     *
     */
    public function __invoke($objectEntity)
    {
        $url = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("ViewHelperManager")
            ->get("url");
        
        $link = "<a data-toggle='tooltip' data-placement='top' title='Click to Complete your Property details' href='" . $url("cus_object/default", array(
            "action" => "pre-complete",
            "id" => $objectEntity->getId()
        )) . "' class='btn btn-sm btn-success' style='width:100%'> Finalize </a>";
        $objectType = $objectEntity->getObjectType()->getId();
        switch ($objectType) {
            case ObjectService::OBJECT_TYPE_MOTOR:
                $motorEntity = $objectEntity->getObjectMotor();
                if ($motorEntity == NULL) {
                    return $link;
                }else{
                    return NULL;
                }
                break;
            
            case ObjectService::OBJECT_TYPE_LIFE_OR_PERSON:
                $personEntity = $objectEntity->getObjectLife();
                if ($personEntity == NULL) {
                    return $link;
                }else{
                    return NULL;
                }
                break;
            
            case ObjectService::OBJECT_TYPE_BUSINESS:
                
                $businessEntity = $objectEntity->getObjectBusiness();
                if ($businessEntity == NULL) {
                    return $link;
                }else{
                    return NULL;
                }
                
                break;
            case ObjectService::OBJECT_TYPE_BUILDING:
                $buildingEntity = $objectEntity->getObjectBuilding();
                if ($buildingEntity == NULL) {
                    return $link;
                }else{
                    return NULL;
                }
                break;
            
            case ObjectService::OBJECT_TYPE_BUSINESS_ITEM:
                $businessEquipment = $objectEntity->getBusinessEquipment();
                if ($businessEquipment == NULL) {
                    return $link;
                }else{
                    return NULL;
                }
                break;
            
            case ObjectService::OBJECT_TYPE_TRAVEL:
                $objectTravel = $objectEntity->getObjectTravel();
                if ($objectTravel == NULL) {
                    return $link;
                }else{
                    return NULL;
                }
                break;
            
            case ObjectService::OBJECT_TYPE_OTHERS:
                $objectOthers = $objectEntity->getObjectOthers();
                if ($objectOthers == NULL) {
                    return $link;
                }else{
                    return NULL;
                }
                break;
                
            case ObjectService::OBJECT_TYPE_NON_BUSINESS_ITEM:
                $nonObjectBusiness = $objectEntity->getObjectNonBusinessEquipment();
                if ($nonObjectBusiness == NULL) {
                    return $link;
                }else{
                    return NULL;
                }
                break;
        }
    }
}

