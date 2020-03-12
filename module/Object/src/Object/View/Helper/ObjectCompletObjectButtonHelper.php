<?php
namespace Object\View\Helper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;
use Object\Service\ObjectService;

/**
 *
 * @author otaba
 *        
 */
class ObjectCompletObjectButtonHelper extends AbstractHelper implements ServiceLocatorAwareInterface
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

    public function __invoke($objetcEntity)
    {
        $url = $this->getServiceLocator()
        ->getServiceLocator()
        ->get("ViewHelperManager")
        ->get("url");
        $currencyFormat = $this->getServiceLocator()
        ->getServiceLocator()
        ->get("ViewHelperManager")
        ->get("myCurrencyFormat");
        
        $frame = "";
       
        $u =   "<a data-toggle='tooltip' data-placement='top' title='Complete Information' class='btn btn-success btn-xs' href='".$url("object/default", array("action"=>"pre-complete", "inf"=>$objetcEntity->getId()))."'><i class='fa fa-edit'></i></a>";
        
        $objectType = $objetcEntity->getObjectType()->getId();
        switch ($objectType) {
            case ObjectService::OBJECT_TYPE_MOTOR:
               
               
                if($objetcEntity->getObjectMotor() == NULL){
                   return $u; // return "<a data-toggle='tooltip' data-placement='top' title='Complete Propert Information' class='btn btn-success btn-xs' style='width: 100%;' href='".$url("object/default", array("action"=>"pre-complete", "inf"=>$objetcEntity->getId()))."'><i class='fa fa-edit'></i></a>";
                }
                break;
            case ObjectService::OBJECT_TYPE_BUILDING:
                if($objetcEntity->getObjectBuilding() == NULL){
                    return $u ; //return "<a data-toggle='tooltip' data-placement='top' title='Complete Propert Information' class='btn btn-success btn-xs' style='width: 100%;' href='".$url("object/default", array("action"=>"pre-complete", "inf"=>$objetcEntity->getId()))."'><i class='fa fa-edit'></i></a>";
                }
                break;
                
            case ObjectService::OBJECT_TPE_LIFESTYLE:
                if($objetcEntity->getObjectLifeStyle() == NULL){
                    return $u; //return "<a data-toggle='tooltip' data-placement='top' title='Complete Propert Information' class='btn btn-success btn-xs' style='width: 100%;' href='".$url("object/default", array("action"=>"pre-complete", "inf"=>$objetcEntity->getId()))."'><i class='fa fa-edit'></i></a>";
                }
                break;
                
            case ObjectService::OBJECT_TYPE_LIFE_OR_PERSON:
                if($objetcEntity->getObjectLife() == NULL){
                   return $u; //return "<a data-toggle='tooltip' data-placement='top' title='Complete Propert Information' class='btn btn-success btn-xs' style='width: 100%;' href='".$url("object/default", array("action"=>"pre-complete", "inf"=>$objetcEntity->getId()))."'><i class='fa fa-edit'></i></a>";
                }
                break;
                
            case ObjectService::OBJECT_TYPE_BUSINESS_ITEM:
                if($objetcEntity->getBusinessEquipment() == NULL){
                    return "<a data-toggle='tooltip' data-placement='top' title='Complete Propert Information' class='btn btn-success btn-xs' style='width: 100%;' href='".$url("object/default", array("action"=>"pre-complete", "inf"=>$objetcEntity->getId()))."'><i class='fa fa-edit'></i></a>";
                }
                break;
                
            case ObjectService::OBJECT_TYPE_OTHERS:
                if($objetcEntity->getObjectOthers() == NULL){
                    return "<a data-toggle='tooltip' data-placement='top' title='Complete Propert Information' class='btn btn-success btn-xs' style='width: 100%;' href='".$url("object/default", array("action"=>"pre-complete", "inf"=>$objetcEntity->getId()))."'><i class='fa fa-edit'></i></a>";
                }
                break;
                
            case ObjectService::OBJECT_TYPE_SPORTS:
                if($objetcEntity->getObjectSport() == NULL){
                    return "<a data-toggle='tooltip' data-placement='top' title='Complete Propert Information' class='btn btn-success btn-xs' style='width: 100%;' href='".$url("object/default", array("action"=>"pre-complete", "inf"=>$objetcEntity->getId()))."'><i class='fa fa-edit'></i></a>";
                }
                break;
                
            case ObjectService::OBJECT_TYPE_TRAVEL:
                if($objetcEntity->getObjectTravel() == NULL){
                   return $url;
                }
                break;
            case ObjectService::OBJECT_TYPE_NON_BUSINESS_ITEM:
                if($objetcEntity->getObjectNonBusinessEquipment() != NULL){
                    return $url;
                }
                break;
            case ObjectService::OBJECT_TYPE_BUSINESS:
                if($objetcEntity->getObjectBusiness() == NULL){
                    return $url;
                }
                break;
                
        }
        
        return $frame;
    }
}

