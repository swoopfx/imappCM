<?php
namespace Claims\View\Helper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;
use Policy\Service\CoverNoteService;
use IMServices\Service\IMService;

class ClaimsDetailsViewHelper extends AbstractHelper implements ServiceLocatorAwareInterface
{

    private $serviceLocator;

    public function __construct()
    {

        // TODO - Insert your code here
    }

    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        return $this;
    }

    public function __invoke($claimsEntity)
    {
        $partial = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("ViewHelperManager")
            ->get("partial");

        // var_dump($claimsEntity->getClaimsMotor());
        // $frame = "";
        if ($claimsEntity->getIsDefaultClaims() == TRUE) {
            return $partial("claims-default-details-snippet", array(
                "details" => $claimsEntity->getClaimsDefault()
            ));
        } else {
            $specificServiceId = CoverNoteService::getSpecificTypeId($claimsEntity->getPolicy()->getCoverNote());
            switch ($specificServiceId) {

                case IMService::IM_SPECIFIC_SERVICE_BURGLARY_HOUSE_BREAKING:
                    return $partial("claims-details-buglary-snippet", array(
                        "details" => $claimsEntity->getClaimsBuglary()
                    ));
                    break;

                case IMService::IM_SPECIFIC_SERVICE_EMPLOYERS_LIABILITY:
                    //
                    return $partial("claims-employee-liability-details-snippet", array(
                        "details" => $claimsEntity->getClaimsEmployeeLiability()
                    ));
                    break;
                case IMService::IM_SPECIFIC_SERVICE_MARINE_CARGO_ICC_A:
                case IMService::IM_SPECIFIC_SERVICE_MARINE_CARGO_ICC_B:
                case IMService::IM_SPECIFIC_SERVICE_MARINE_CARGO_ICC_C:
                    return $partial("claims-marine-cargo-details-snippet", array(
                        "details" => $claimsEntity->getClaimsMarineCargo()
                    ));
                    break;
                case IMService::IM_SPECIFIC_SERVICE_MOTOR_COMPREHENSIVE_MOTOR:
                case IMService::IM_SPECIFIC_SERVICE_MOTOR_THIRD_PARTY_FIRE_THEFT:
                case IMService::IM_SPECIFIC_SERVICE_MOTOR_THIRD_PARTY_MOTOR:

                    // var_dump($claimsEntity->getClaimsMotor());
                    return $partial("claims-motors-details-snippet", array(
                        "details" => $claimsEntity->getClaimsMotor()
                    ));
                    break;

                case IMService::IM_SPECIFIC_SERVICE_PROFESSIONAL_INDEMNTY:
                    return $partial("claims-details-professional-indemnity-snippet", array(
                    "details" => $claimsEntity->getClaimsProfessionalIndemnity()
                    ));
                    break;
                default:
                    return $partial("claims-default-details-snippet", array(
                        "details" => $claimsEntity->getClaimsDefault()
                    ));
                    break;
            }
        }
    }
}

