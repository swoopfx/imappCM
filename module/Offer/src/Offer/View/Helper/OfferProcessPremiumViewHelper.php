<?php
namespace Offer\View\Helper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Session\Container;

/**
 *
 * @author otaba
 *        
 */
class OfferProcessPremiumViewHelper extends AbstractHelper implements ServiceLocatorAwareInterface
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

    public function __invoke($offerEntity)
    {
        $premiumSession = new Container("offer_premium");
        $premiumSession->premium = NULL;
        $url = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("ViewHelperManager")
            ->get("url");
        
            $json = array(
                "type"=>"standard"
            );
        $currencyFormat = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("ViewHelperManager")
            ->get("myCurrencyFormat");
        
        $premiumService = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("GeneralServicer\Service\PremiumService");
        
        if ($offerEntity->getValue() == NULL || $offerEntity->getValueType() == NULL) {
            return "<button id='btn3' class='ajax_element btn btn-primary btn-danger btn-xs'
						data-json='".json_encode($json)."' data-href='".$url("offer/default", array("action"=>"completeoffer"))."'
						style='width: 100%;'>Complete the offer Form</button>";
        } elseif (count($offerEntity->getObject()) == 0) {
            return "<p style='text-align: center;'><a style='width: 100%;' href='' data-toggle='modal' data-target='.select-property-modal-lg' class='btn btn-xs btn-success'>Include a Property</a> <br> OR <br> <a href='' data-toggle='modal' style='width: 100%' data-target='.bs-object-modal-lg' class='btn btn-primary btn-xs'>Register New Property</a></p>";
        } elseif ($offerEntity->getValue() != NULL && $offerEntity->getValueType() != NULL && count($offerEntity->getObject()) > 0) {
            $premiumService->setValueType($offerEntity->getValueType()
                ->getId())
                ->setObjectsArray($offerEntity->getObject())
                ->setPremiumRate($offerEntity->getValue());
            $objectArray = $offerEntity->getObject();
            
            $premium = $premiumService->premiumCalculator();
            $currency = $objectArray[count($objectArray) - 1]->getCurrency()->getCode();
            $premiumSession->premiumCurrency = $objectArray[count($objectArray) - 1]->getCurrency()->getId();
            $premiumSession->premium = $premium;
            return $this->premiumCondition($offerEntity, $premiumSession, $currency);
           
            
        }
    }
    
    private function premiumCondition($offerEntity, $premiumSession, $currency){
        $url = $this->getServiceLocator()
        ->getServiceLocator()
        ->get("ViewHelperManager")
        ->get("url");
        $currencyFormat = $this->getServiceLocator()
        ->getServiceLocator()
        ->get("ViewHelperManager")
        ->get("myCurrencyFormat");
        if($offerEntity->getIsManualPremium() == TRUE){
            $premiumSession->premium = $offerEntity->getManualPremium()->getPremium();
            $premiumSession->premiumCurrency = $offerEntity->getManualPremium()->getCurrency()->getId();
            return "<h2>".$currencyFormat($offerEntity->getManualPremium()->getPremium(), $offerEntity->getManualPremium()->getCurrency()->getCode())."</h2><a href='".$url("offer/default", array("action"=>"remove-manual-premium"))."' class='btn btn-danger btn-xs'>Remove Manual Premium</a>  <i data-toggle='tooltip' data-placement='top' title='Remove manually generated premium ' class='fa fa-info-circle'></i>";
        }else{
           
            return "<h2>" . $currencyFormat($premiumSession->premium, $currency) . "</h2><br><a data-toggle='modal' data-target='.bs-manual-premium-modal-lg'  href='#' class='btn btn-success btn-xs'>Generate Manual Premium</a> <i data-toggle='tooltip' data-placement='top' title='Manually generate a premium if the auto generated premium does not seem correct' class='fa fa-info-circle'></i>";
        }
    }
}

