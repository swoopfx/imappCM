<?php
namespace Object\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Object\Service\ObjectService;
use Object\Entity\Object;
use GeneralServicer\Service\GeneralService;

/**
 *
 * @author otaba
 *        
 */
class ObjectViewDetailsViewHepper extends AbstractHelper implements ServiceLocatorAwareInterface
{

    private $serviceLocator;

    /**
     */
    public function __construct()
    {}

    /**
     *
     * @param Object $objetcEntity
     * @return string|NULL
     */
    public function __invoke($objetcEntity)
    {
        $url = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("ViewHelperManager")
            ->get("url");
        $escapehtml = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("ViewHelperManager")
            ->get("escapehtml");

        $dateformat = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("ViewHelperManager")
            ->get("dateformat");
        $currencyFormat = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("ViewHelperManager")
            ->get("myCurrencyFormat");

        $frame = "";
        $objectType = $objetcEntity->getObjectType()->getId();
        switch ($objectType) {
            case ObjectService::OBJECT_TYPE_MOTOR:

                if ($objetcEntity->getObjectMotor() != NULL) {
                    $motor = $objetcEntity->getObjectMotor();
                    $info = "<tr>
				<th>Motor Type</th>
					<td>" . $motor->getMotorType()->getMotor() . "</td>

				</tr>
<tr>
				<th>Motor Model</th>
					<td>" . $motor->getMotorModel() . "</td>

				</tr>
<tr>
				<th>Motor Value Type</th>
					<td>" . $motor->getMotorValueType()->getValueType() . "</td>

				</tr>
<tr>
				<th>Plate Number</th>
					<td>" . $motor->getMotorNumber() . "</td>

				</tr>
<tr>
				<th>Chasis Number</th>
					<td>" . $motor->getChasisNumber() . "</td>

				</tr>
";
                    return $this->frame($info);
                } else {
                    return NULL;
                }
                // else {
                // return "<a id='btn3' data-json='{'type':'standard'}' data-href='completeModal'
                // class=' ajax_element btn btn-success btn-xs' style='width: 100%;' ><i class='fa fa-edit'></i> Edit Property </a>";
                // }
                break;
            case ObjectService::OBJECT_TYPE_BUILDING:

                if ($objetcEntity->getObjectBuilding() != NULL) {
                    /**
                     *
                     * @var \Object\Entity\ObjectBuildingData $building
                     */
                    $building = $objetcEntity->getObjectBuilding();
                    $info = "<tr>
				<th>Building Type</th>
					<td>" . ($building->getBuildingType() == NULL ? GeneralService::GENERAL_EMPTY_FIELD : $building->getBuildingType()->getType()) . "</td>
					    
				</tr>
<tr>
				<th>Building Address</th>
					<td>" . ($building->getFullAddress() == NULL ? GeneralService::GENERAL_EMPTY_FIELD : $building->getFullAddress()) . "</td>
					    
				</tr>
<tr>
				<th>Floor Area</th>
					<td>" . ($building->getFloorArea() == NULL ? GeneralService::GENERAL_EMPTY_FIELD : $building->getFloorArea() . "<sup>2</sup>") . "</td>
					    
				</tr>

<tr>
				<th>Building Description</th>
					<td>" . ($building->getHouseDescription() == NULL ? GeneralService::GENERAL_EMPTY_FIELD : $building->getHouseDescription()) . "</td>
					    
				</tr>

<tr>
				<th>Has Fire Alarm System</th>
					<td>" . ($building->getIsFireAlarmSystem() == NULL ? GeneralService::GENERAL_EMPTY_FIELD : $this->trueFalseHelper($building->getIsFireAlarmSystem())) . "</td>
					    
				</tr>

<tr>
				<th>Has Fire Protection System</th>
					<td>" . ($building->getIsFireProtectionSystem() == NULL ? GeneralService::GENERAL_EMPTY_FIELD : $this->trueFalseHelper($building->getIsFireProtectionSystem())) . "</td>
					    
				</tr>

<tr>
				<th>Has Intruder Alarm System</th>
					<td>" . ($building->getIsIntruderAlarmSystem() == NULL ? GeneralService::GENERAL_EMPTY_FIELD : $this->trueFalseHelper($building->getIsFireProtectionSystem())) . "</td>
					    
				</tr>

<tr>
				<th>Has Intruder Alarm System</th>
					<td>" . ($building->getIsIntruderAlarmSystem() == NULL ? GeneralService::GENERAL_EMPTY_FIELD : $this->trueFalseHelper($building->getIsFireProtectionSystem())) . "</td>
					    
				</tr>

";
                    return $this->frame($info);
                } else {
                    return NULL;
                }

                break;

            case ObjectService::OBJECT_TPE_LIFESTYLE:

                break;

            case ObjectService::OBJECT_TYPE_LIFE_OR_PERSON:
                if ($objetcEntity->getObjectLife() != NULL) {
                    $lifeEntity = $objetcEntity->getObjectLife();
                    $info = "<tr>
				<th> Full Name</th>
					<td>" . $escapehtml($lifeEntity->getFullname()) . "</td>
					    
				</tr>
<tr>
				<th>Phone Number</th>
					<td>" . $escapehtml(($lifeEntity->getMobileNumber() == NULL ? GeneralService::GENERAL_EMPTY_FIELD : $lifeEntity->getMobileNumber())) . "</td>
					    
				</tr>
<tr>
				<th>Sex</th>
					<td>" . $escapehtml($lifeEntity->getSex()->getSex()) . "</td>
					    
				</tr>
<tr>
				<th>Date of Birth</th>
					<td>" . $dateformat($lifeEntity->getAge(), \IntlDateFormatter::MEDIUM, \IntlDateFormatter::NONE, "en_us") . "</td>
					    
				</tr>
<tr>
				<th>Address</th>
					<td>" . $lifeEntity->getFullAddress() . "</td>
					    
				</tr>
";
                    return $this->frame($info);
                }

                break;

            case ObjectService::OBJECT_TYPE_BUSINESS_ITEM:
                if ($objetcEntity->getBusinessEquipment() != NULL) {
                    /**
                     *
                     * @var \Object\Entity\ObjectBusinessEquipment $equipment
                     */
                    $equipment = $objetcEntity->getBusinessEquipment();
                    $info = "<tr>
				<th> Equipment Description</th>
					<td>" . $escapehtml($equipment->getEquipmentDesc()) . "</td>
					    
				</tr>
<tr>
				<th>Phone Number</th>
					<td>" . ($equipment->getEquipmentUid() == NULL ? GeneralService::GENERAL_EMPTY_FIELD : $escapehtml($equipment->getEquipmentUid())) . "</td>
					    
				</tr>
<tr>
				<th>Equipment Registration No</th>
					<td>" . $escapehtml($equipment->getItemNo()) . "</td>
					    
				</tr>
<tr>
				<th>Purchase Date</th>
					<td>" . $dateformat($equipment->getPurchaseDate(), \IntlDateFormatter::MEDIUM, \IntlDateFormatter::NONE, "en_us") . "</td>
					    
				</tr>
<tr>
				<th>Purchase Value Cat.</th>
					<td>" . ($equipment->getPurchaseValue() == NULL ? GeneralService::GENERAL_EMPTY_FIELD : $equipment->getPurchaseValue()->getValue()) . "</td>
					    
				</tr>
";
                    return $this->frame($info);
                }
                break;

            case ObjectService::OBJECT_TYPE_OTHERS:
                break;

            case ObjectService::OBJECT_TYPE_TRAVEL:
                if ($objetcEntity->getObjectTravel() != NULL) {
                    $travelEntity = $objetcEntity->getObjectTravel();
                    $info = "<tr>
				<th>Passport Name</th>
					<td>" . $escapehtml($travelEntity->getTitle()->getTitle()) . " " . $escapehtml($travelEntity->getPassportName()) . "</td>
					    
				</tr>
<tr>
				<th>Passport Number</th>
					<td>" . $escapehtml($travelEntity->getPassportNumber()) . "</td>
					    
				</tr>
<tr>
				<th>Sex</th>
					<td>" . $escapehtml($travelEntity->getSex()->getSex()) . "</td>
					    
				</tr>
<tr>
				<th>Date of Issue</th>
					<td>" . $dateformat($travelEntity->getPassportDateCreated(), \IntlDateFormatter::MEDIUM, \IntlDateFormatter::NONE, "en_us") . "</td>
					    
				</tr>
<tr>
				<th>Date Expire</th>
					<td>" . $dateformat($travelEntity->getPassportExpiryDate(), \IntlDateFormatter::MEDIUM, \IntlDateFormatter::NONE, "en_us") . "</td>
					    
				</tr>
";
                    return $this->frame($info);
                }
                break;
        }

        return $frame;
    }

    private function frame($info)
    {
        $frame = "
<div class='table-responsive'>
		<table class='table table-hover'>

			<tbody>
				" . $info . "
			</tbody>
		</table>
	</div>";

        return $frame;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Zend\ServiceManager\ServiceLocatorAwareInterface::setServiceLocator()
     */
    public function setServiceLocator(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        return $this;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Zend\ServiceManager\ServiceLocatorAwareInterface::getServiceLocator()
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }
}

