<?php
namespace Claims\View\Helper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;
use Claims\Service\ClaimsService;

/**
 *
 * @author otaba
 *        
 */
class ClaimsBrokerActionConditionHelper extends AbstractHelper implements ServiceLocatorAwareInterface
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

    public function __invoke($claimsEntity)
    {
        $url = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("ViewHelperManager")
            ->get("url");

        $json = json_encode(array(
            "data" => $claimsEntity->getId()
        ));

        $claimsStatus = $claimsEntity->getClaimStatus()->getId();
        switch ($claimsStatus) {
            case ClaimsService::CLAIMS_STATUS_INITIATED:
                return "<p data-ajax-loader='claimprocess{$claimsEntity->getId()}'  style='color: red;'>The customer has not completed the required form</p><a id='sending_data_button' class='ajax_element btn btn-sm btn-app' data-json='{$json}'  data-ajax-loader='claimsAction' style='width: 100%' data-href='" . $url("claims/default", array(
                    "action" => "remind"
                )) . "'><i class='fa fa-clock-o'></i>Remind Customer</a>";
                break;

            case ClaimsService::CLAIMS_STATUS_COMPLETED:
                return "<a data-ajax-loader='claimprocess{$claimsEntity->getId()}' data-json ='{$json}' id='sending_data_button' style='width: 100%' data-href='" . $url('claims/default', array(
                    'action' => "pre-process"
                )) . "' class='ajax_element btn btn-app'>Manage Claims</a>";
                break;

            case ClaimsService::CLAIMS_STATUS_PROCESSING:
                return "<a data-ajax-loader='claimprocess{$claimsEntity->getId()} 'data-json ='{$json}' id='sending_data_button' style='width: 100%' data-href='" . $url('claims/default', array(
                    'action' => "pre-process"
                )) . "' class=' ajax_element btn btn-xs btn-primary'>Continue Processing</a>";
                break;

            case ClaimsService::CLAIMS_STATUS_DECLINED:
                return "<p style='color: red;'>" . ($claimsEntity->getDeclineReason() == NULL ? "No reason Indicated" : $claimsEntity->getDeclineReason()) . "</p>" . "<br>" . "<a data-ajax-loader='claimprocess{$claimsEntity->getId()}' data-json ='{$json}' id='sending_data_button' style='width: 100%' data-href='" . $url('claims/default', array(
                    'action' => "pre-process"
                )) . "' class='ajax_element btn btn-primary btn-xs'>View</a>";
                break;

            case ClaimsService::CLAIMS_STATUS_APPROVED_PROCESSING_PAYMENT:
                return "<a data-ajax-loader='claimprocess{$claimsEntity->getId()}' data-json ='{$json}' id='sending_data_button' style='width: 100%' data-href='" . $url('claims/default', array(
                    'action' => "pre-process"
                )) . "' class='ajax_element btn btn-app'>Manage Claims</a>";
                break;

            case ClaimsService::CLAIMS_STATUS_SETTLED_AND_PAID:
                return "<a data-ajax-loader='claimprocess{$claimsEntity->getId()}' data-json ='{$json}' id='sending_data_button' style='width: 100%' data-href='" . $url('claims/default', array(
                    'action' => "pre-process"
                )) . "' class='ajax_element btn btn-primary btn-xs'>View</a>";
                break;
        }
    }
}

