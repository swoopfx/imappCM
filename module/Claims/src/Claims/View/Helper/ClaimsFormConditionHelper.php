<?php
namespace Claims\View\Helper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;
use Policy\Service\CoverNoteService;
use GeneralServicer\Service\GeneralService;
use IMServices\Service\IMService;

/**
 *
 * @author otaba
 *        
 */
class ClaimsFormConditionHelper extends AbstractHelper implements ServiceLocatorAwareInterface
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

    public function __invoke($claimsEntity, $claimsForm)
    {
        $partial = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("ViewHelperManager")
            ->get("partial");
        $coverCategoryId = $claimsEntity->getPolicy()
            ->getCoverNote()
            ->getCoverCategory()
            ->getId();
        $claimsSerive = $this->getServiceLocator()
            ->getServicelocator()
            ->get("Claims\Service\ClaimsService");

        $generalService = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("GeneralServicer\Service\GeneralService");
        $serviceTypeId = $claimsSerive->claimsFormServiceType($claimsEntity->getPolicy()
            ->getCoverNote());

        $coverServiceId = $generalService->getSpecificServiceTypeId($claimsEntity->getPolicy()
            ->getCoverNote());
        // var_dump($coverServiceId);
        $policyType = $claimsEntity;
        if ($coverCategoryId == CoverNoteService::COVERNOTE_CATEGORY_OFFER) {
            $claimsEntity->getPolicy()
                ->getCoverNote()
                ->getOffer(); // get The Insuracne service Type
        }
        switch ($coverServiceId) {

            case IMService::IM_SPECIFIC_SERVICE_BURGLARY_HOUSE_BREAKING:
                return $partial("claims-form-burglary-snippet", array(
                    "form" => $claimsForm
                ));
                break;

            case IMService::IM_SPECIFIC_SERVICE_CASH_IN_TRANSIT:

                return $partial("claims-form-cash-in-transit-snipet", array(
                    "form" => $claimsForm
                ));
                break;

            case IMService::IM_SPECIFIC_SERVICE_CONTRACT_ALL_RISK:
                return $partial("claims-form-contract-all-risk-snippet", array(
                    "form" => $claimsForm
                ));
                break;

            case IMService::IM_SPECIFIC_SERVICE_EMPLOYERS_LIABILITY:
                return $partial("claims-form-employee-liability-snippet", array(
                    "form" => $claimsForm
                ));
                break;

            case IMService::IM_SPECIFIC_SERVICE_FIRE_PERIL:

                return $partial("claims-form-fire-loss-snippet", array(
                    "form" => $claimsForm
                ));
                break;

            case IMService::IM_SPECIFIC_SERVICE_FIDELITY_GUARATEE:
                return $partial("claims-form-fidelity-gauratee-snippet", array(
                    "form" => $claimsForm
                ));
                break;

            case IMService::IM_SPECIFIC_SERVICE_GIT_ALL_RISK:
            case IMService::IM_SPECIFIC_SERVICE_GIT_RESTRICTED_COVER:
                return $partial("claims-form-git-snipet", array(
                    "form" => $claimsForm
                ));

                break;

            case IMService::IM_SPECIFIC_SERVICE_MARINE_CARGO_ICC_A:
            case IMService::IM_SPECIFIC_SERVICE_MARINE_CARGO_ICC_B:
            case IMService::IM_SPECIFIC_SERVICE_MARINE_CARGO_ICC_C:
                return $partial("claims-form-marine-cargo-snippet", array(
                    "form" => $claimsForm
                ));
                break;
            case IMService::IM_SPECIFIC_SERVICE_MOTOR_COMPREHENSIVE_MOTOR:
            case IMService::IM_SPECIFIC_SERVICE_MOTOR_THIRD_PARTY_FIRE_THEFT:
            case IMService::IM_SPECIFIC_SERVICE_MOTOR_THIRD_PARTY_MOTOR:
                // $claimsMotor = $claimsFieldset->get("claimsMotor");
                // var_dump("HYU");
                return $partial("claims-form-motor-snipet", array(
                    "form" => $claimsForm
                    // "formFields" => "claims-form-motor-snipet"
                ));

                break;
                
                
            case IMService::IM_SPECIFIC_SERVICE_PROFESSIONAL_INDEMNTY:
//                 claims-form-professional-indemnity-snippet
                return $partial("claims-form-professional-indemnity-snippet", array(
                "form" => $claimsForm
                // "formFields" => "claims-form-motor-snipet"
                ));
                break;

            case GeneralService::INSURANCE_SERVICE_AGRIC:
                // return $partial("", array());
                return "";
                break;

            default:
                return $partial("claims-form-default-snippet", array(
                    "form" => $claimsForm
                ));

                break;
        }
    }
}

