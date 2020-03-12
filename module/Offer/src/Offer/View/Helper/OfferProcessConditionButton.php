<?php
namespace Offer\View\Helper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;
use Offer\Service\OfferService;
use Offer\Entity\Offer;


/**
 *
 * @author otaba
 *        
 */
class OfferProcessConditionButton extends AbstractHelper implements ServiceLocatorAwareInterface
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

    

    public function __invoke($offerEntity){
        
        $offerStatus = $offerEntity->getOfferStatuses()->getId();
        $offerId = $offerEntity->getId();
        $url = $this->getServiceLocator()
        ->getServiceLocator()
        ->get("ViewHelperManager")
        ->get("url");
        $json = json_encode(array("data"=>$offerEntity->getOfferCode()));
        if($offerStatus == OfferService::OFFER_STATUS_UNSAVED){
             return "<p style='color: red;'><strong>The customer has not inputed the required information</strong></p><a id='sending_data_button' data-ajax-loader='offerreminder' data-json='{$json}' href='".$url("offer/default", array("action"=>"remind"))."'  class='btn btn-primary btn-xs ajax_element' style='width:100%'>Send Reminder</a>";
        }else{
        switch($offerStatus){
            case OfferService::OFFER_STATUS_PROCESSING:
            case OfferService::OFFER_STATUS_PAID:
                return "<a  href='" . $url("offer/default", array(
                "action" => "continue",
                "id" => $offerId
                )) . "' class='btn btn-success btn-xs' style='width: 100%;'> <i class='fa fa-send'></i> Continue Processing</a>";
                break;
                
            default: 
                return "<a href='" . $url("offer/default", array(
                "action" => "pre-process",
                "id" => $offerId
                )) . "' class='btn btn-success btn-xs ' style='width: 100%;><i class='fa fa-send'></i> Commence Process </a>";
                break;
        }
        }
    }
}

