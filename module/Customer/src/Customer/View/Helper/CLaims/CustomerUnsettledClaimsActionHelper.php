<?php
namespace Customer\View\Helper\CLaims;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;
use Claims\Service\ClaimsService;

/**
 *
 * @author otaba
 *        
 */
class CustomerUnsettledClaimsActionHelper extends AbstractHelper implements ServiceLocatorAwareInterface
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

    public function __invoke($unsettledClaimsEntity)
    {
        $url = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("ViewHelperManager")
            ->get("url");

        $claimsStatus = $unsettledClaimsEntity->getClaimStatus();
        $jsonUid = json_encode(array(
            "data"=>$unsettledClaimsEntity->getClaimUid()
        ));
        switch ($claimsStatus->getId()) {
           
            case ClaimsService::CLAIMS_STATUS_INITIATED:
                return "<a href='" . $url("cus_claims/default", array(
                    "action" => "pre-lay",
                    "id" => $unsettledClaimsEntity->getClaimUid()
                )) . "' style='width: 100%' class='btn btn-primary btn-xs'> Complete Claims Details</a>";
                // Show Complete Claims Form Button
                break;
            case ClaimsService::CLAIMS_STATUS_COMPLETED:
                return "<a href='" . $url("cus_claims/default", array(
                    "action" => "pre-lay",
                    "id" => $unsettledClaimsEntity->getClaimUid()
                )) . "' style='width: 100%' class='btn btn-default btn-xs'> View Claims Details</a>";
                // Show Complete Claims Form Button
                break;

            case ClaimsService::CLAIMS_STATUS_PROCESSING:
                return "<a id='sending_data_button'  data-ajax-loader='claimsAction' data-json='{$jsonUid}' data-href='" . $url("cus_claims/default", array(
                    "action" => "pre-board",
//                     "id" => $unsettledClaimsEntity->getId()
                )) . "'  class='btn btn-danger btm-xs ajax_element'> <i class='fa fa-eye'></i></a>";

                break;
            case ClaimsService::CLAIMS_STATUS_DECLINED:
                // modal view to reason declined 
                break;
                
            case ClaimsService::CLAIMS_STATUS_SETTLED_AND_PAID:
                // modal view to amount paid and another view to the actual claim
                break;
                
            case ClaimsService::CLAIMS_STATUS_SETTLED_AND_UNPAID:
                // modal view to reason unpaid and another view to the actual claim
                break;
        }
    }
}

