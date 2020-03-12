<?php
namespace Customer\View\Helper\Object;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;
use Object\Service\ObjectService;
use Settings\Service\SettingsService;

/**
 *
 * @author otaba
 *        
 */
class CustomerObjectFullDetailsViewHelper extends AbstractHelper implements ServiceLocatorAwareInterface
{

    private $serviceLocator;

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
        
        $dateFormat = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("ViewHelperManager")
            ->get("dateFormat");
        
        if ($objectEntity->getObjectType() != NULL) {
            $objectType = $objectEntity->getObjectType()->getId();
            switch ($objectType) {
                case ObjectService::OBJECT_TYPE_BUILDING:
                    $buildingEntity = $objectEntity->getObjectBuilding();
                    $frame = $this->frame("House Address", $buildingEntity->getFullAddress());
                    $frame .= $this->frame("Building Type", ($buildingEntity->getBuildingType() != NULL ? $buildingEntity->getBuildingType()
                        ->getType() : ""));
                    $frame .= $this->frame("Description", ($buildingEntity->getHouseDescription() != NULL ? $buildingEntity->getHouseDescription() : " "));
                    $frame .= $this->frame("Wall Type", ($buildingEntity->getWallType() != NULL ? $buildingEntity->getWallType()
                        ->getWallType() : ""));
                    $frame .= $this->frame("Roof Type", ($buildingEntity->getRoofType() != NULL ? $buildingEntity->getRoofType()
                        ->getRoofType() : ""));
                    $frame .= $this->frame("Floor Area", ($buildingEntity->getFloorArea() != NULL ? $buildingEntity->getFloorArea() . "sqm" : ""));
                    $frame .= $this->frame("No Of Rooms", ($buildingEntity->getNoOfRooms() != NULL ? $buildingEntity->getNoOfRooms() : ""));
                    $frame .= $this->frame("Has intruder alarm system", ($buildingEntity->getIsIntruderAlarmSystem() != TRUE ? "<strong style='color: green'>Yes</strong>" : "<strong style='color: red'>No</strong>"));
                    $frame .= $this->frame("Has fire alarm system", ($buildingEntity->getIsFireAlarmSystem() != TRUE ? "<strong style='color: green'>Yes</strong>" : "<strong style='color: red'>No</strong>"));
                    $frame .= $this->frame("Has fire protection system", ($buildingEntity->getIsFireProtectionSystem() != TRUE ? "<strong style='color: green'>Yes</strong>" : "<strong style='color: red'>No</strong>"));
                    return $frame;
                    break;
                case ObjectService::OBJECT_TYPE_BUSINESS:
                    $businessEntity = $objectEntity->getObjectBusiness();
                    $catString = "";
                    
                    foreach ($businessEntity->getBusinessCategory() as $category) {
                        $catString .= $category->getOccupation() . " <br> ";
                    }
                    $frame = $this->frame("Business Name", $businessEntity->getBusinessName());
                    $frame .= $this->frame("Business Description", ($businessEntity->getBusinessDesc() != NULL ? $businessEntity->getBusinessDesc() : ""));
                    $frame .= $this->frame("Business Reg. Number", ($businessEntity->getBusinessRegNo() != NULL ? $businessEntity->getBusinessRegNo() : ""));
                    $frame .= $this->frame("Business Category", ($businessEntity->getBusinessCategory() != NULL ? $catString : ""));
                    $frame .= $this->frame("Business Address", ($businessEntity->getBusinessAddress() != NULL ? $businessEntity->getBusinessAddress() : ""));
                    return $frame;
                    break;
                case ObjectService::OBJECT_TYPE_LIFE_OR_PERSON:
                    $lifeEntity = $objectEntity->getObjectLife();
                    $frame = $this->frame("Title", ($lifeEntity->getTitle() != NULL ? $lifeEntity->getTitle()
                        ->getTitle() : ""));
                    $frame .= $this->frame("Sex", ($lifeEntity->getSex() != NULL ? $lifeEntity->getSex()
                        ->getSex() : ''));
                    $frame .= $this->frame("First Name", ($lifeEntity->getFirstname() != NULL ? $lifeEntity->getFirstName() : ''));
                    $frame .= $this->frame("Last Name", ($lifeEntity->getLastname() != NULL ? $lifeEntity->getLastname() : ""));
                    $frame .= $this->frame("Other Name", ($lifeEntity->getOthername() != NULL ? $lifeEntity->getOthername() : ""));
                    $frame .= $this->frame("Mobile Number", ($lifeEntity->getMobileNumber() != NULL ? $lifeEntity->getMobileNumber() : ""));
                    $frame .= $this->frame("Address ", ($lifeEntity->getFullAddress() != NULL ? $lifeEntity->getFullAddress() : ""));
                    $frame .= $this->frame("Date Of Birth ", ($lifeEntity->getAge() != NULL ? $dateFormat($lifeEntity->getAge(), \IntlDateFormatter::MEDIUM, \IntlDateFormatter::NONE, "en_us") : ""));
                    if ($lifeEntity->getIsMarried() == True && $lifeEntity->getSex()->getId() == SettingsService::SEX_FEMALE) {
                        $frame .= $this->frame("Maiden Name", ($lifeEntity->getMaidenName() != NULL ? $lifeEntity->getMaidenName() : ""));
                    }
                    $catString = '';
                    foreach ($lifeEntity->getOccupation() as $category) {
                        $catString .= $category->getOccupation() . "<br> ";
                    }
                    $frame .= $this->frame("Occupation Category ", ($lifeEntity->getOccupation() != NULL ? $catString : ""));
                    $frame .= $this->frame("Ocupation Post", ($lifeEntity->getOccupationPost() != NULL ? $lifeEntity->getOccupationPost() : ""));
                    return $frame;
                    break;
                
                case ObjectService::OBJECT_TYPE_MOTOR:
                    $motorEntity = $objectEntity->getObjectMotor();
                    
                    $frame = $this->frame("Motor Brand", ($motorEntity->getMotorType() != NULL ? $motorEntity->getMotorType()
                        ->getMotor() : ""));
                    $frame .= $this->frame("Motor Model", ($motorEntity->getMotorModel() != NULL ? $motorEntity->getMotorModel()
                        : ""));
                   
                    $frame .= $this->frame("Make Year", ($motorEntity->getMakeYear() != Null ? $dateFormat($motorEntity->getMakeYear(), \IntlDateFormatter::MEDIUM, \IntlDateFormatter::NONE, "en_us") : " "));
                    $frame .= $this->frame("Motor Value Type", ($motorEntity->getMotorValueType() != NULL ? $motorEntity->getMotorValueType()
                        ->getValueType() : ""));
                    $frame .= $this->frame("Motor Plate Number", ($motorEntity->getMotorNumber() != NULL ? $motorEntity->getMotorNumber() : ""));
                    $frame .= $this->frame("Engine Number", ($motorEntity->getEngineNumber() != NULL ? $motorEntity->getEngineNumber() : ""));
                    $frame .= $this->frame("Chasis Number", ($motorEntity->getChasisNumber() != NULL ? $motorEntity->getChasisNumber() : ""));
                    $frame .= $this->frame("Number Of Seats", ($motorEntity->getNumberOfSeats() != NULL ? $motorEntity->getNumberOfSeats() : ""));
                    return $frame;
                    break;
                case ObjectService::OBJECT_TYPE_OTHERS:
                    $othersEntity = $objectEntity->geObjecttOthers();
                    
                    break;
                case ObjectService::OBJECT_TYPE_BUSINESS_ITEM:
                    $businessItemEntity = $objectEntity->getBusinessEquipment();
                    $catString = "";
                    foreach ($businessItemEntity->getEquipmentCategory() as $item) {
                        $catString .= $item->getEquipments() . "<br>";
                    }
                    $frame = $this->frame("Equipment Category", (count($businessItemEntity->getEquipmentCategory()) > 0 ? $catString : ""));
                    $frame .= $this->frame("Description", ($businessItemEntity->getEquipmentDesc() != NULL ? $businessItemEntity->getEquipmentDesc() : ""));
                    $frame .= $this->frame("Equipment Identifier", ($businessItemEntity->getEquipmentUid() != NULL ? $businessItemEntity->getEquipmentUid() : ""));
                    $frame .= $this->frame("Equipment Brand", ($businessItemEntity->getMake() != NULL ? $businessItemEntity->getMake() : ""));
                    $frame .= $this->frame("Equipment Reg. No", ($businessItemEntity->getRegNo() != NULL ? $businessItemEntity->getRegNo() : ""));
                    $frame .= $this->frame("Purchase Date", ($businessItemEntity->getPurchaseDate() != NULL ? $dateFormat($businessItemEntity->getPurchaseDate(), \IntlDateFormatter::LONG, \IntlDateFormatter::NONE, "en_Us") : ""));
                    $frame .= $this->frame("Purchase Value", ($businessItemEntity->getPurchaseValue() != NULL ? "<span class='badge badge-success'>" . $businessItemEntity->getPurchaseValue()
                        ->getValue() . "</span" : ""));
                    return $frame;
                    break;
                case ObjectService::OBJECT_TYPE_NON_BUSINESS_ITEM:
                    $personalItemEntity = $objectEntity->getObjectNonBusinessEquipment();
                    foreach ($personalItemEntity->getEquipmentCategory() as $item) {
                        $catString .= $item->getEquipments() . "<br>";
                        $frame = $this->frame("Equipment Category", (count($personalItemEntity->getEquipmentCategory()) > 0 ? $catString : ""));
                        return $frame;
                    }
                    break;
                
                case ObjectService::OBJECT_TYPE_TRAVEL:
                    $travelEntity = $objectEntity->getObjectTravel();
                    $frame = $this->frame("Title", ($travelEntity->getTitle() != NULL ? $travelEntity->getTitle()
                        ->getTitle() : ""));
                    $frame .= $this->frame("Sex", ($travelEntity->getSex() != NULL ? $travelEntity->getSex()
                        ->getSex() : ""));
                    $frame .= $this->frame("Passport Name", ($travelEntity->getPassportName() != NULL ? $travelEntity->getPassportName() : ""));
                    $frame .= $this->frame("Passport Number", ($travelEntity->getPassportNumber() != NULL ? $travelEntity->getPassportNumber() : ""));
                    $frame .= $this->frame("Date Issued", ($travelEntity->getPassportDateCreated() != NULL ? $dateFormat($travelEntity->getPassportDateCreated(), \IntlDateFormatter::LONG, \IntlDateFormatter::NONE, "en_us") : ""));
                    $frame .= $this->frame("Expiry Date", ($travelEntity->getPassportExpiryDate() != NULL ? $dateFormat($travelEntity->getPassportExpiryDate(), \IntlDateFormatter::LONG, \IntlDateFormatter::NONE, "en_us") : ""));
                    $frame .= $this->frame("Place Of Issue", ($travelEntity->getPlaceOfIssue() != NULL ? $travelEntity->getPlaceOfIssue() : ""));
                    $frame .= $this->frame("Mobile Number", ($travelEntity->getMobileNumber() != NULL ? $travelEntity->getMobileNumber() : ""));
                    return $frame;
                    break;
            }
        }
    }

    private function frame($label, $value)
    {
        $frame = "<tr>
										<td><strong>" . $label . "</strong></td>
										<td> " . $value . "</td>

									</tr>";
        
        return $frame;
    }
}

