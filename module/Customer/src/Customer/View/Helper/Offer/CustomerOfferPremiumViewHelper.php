<?php
namespace Customer\View\Helper\Offer;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Session\Container;

/**
 *
 * @author otaba
 *        
 */
class CustomerOfferPremiumViewHelper extends AbstractHelper implements ServiceLocatorAwareInterface
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
        $url = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("ViewHelperManager")
            ->get("url");
        $currencyFormat = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("ViewHelperManager")
            ->get("myCurrencyFormat");
        
        $premiumService = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("GeneralServicer\Service\PremiumService");
        
        if ($offerEntity->getValue() == NULL || $offerEntity->getValueType() == NULL) {
            return "<p>Please wait for Broker to enter evaluate your details and provide the premium rate. Once this is done you would receive a notification</p>";
        } elseif (count($offerEntity->getObject()) == 0) {
            return "<p style='text-align: center;'><a href='#modal-include-object' data-toggle='modal'
						class='btn btn-white btn-flat btn-primary'
						class='btn btn-white paper-shadow relative' data-z='0.5'
						data-hover-z='1' data-animated style='width: 100%' > Include a Property</a> <br> OR <br>
 <a href='#modal-register-object' data-toggle='modal'
						class='btn btn-white btn-flat btn-primary'
						class='btn btn-white paper-shadow relative' data-z='0.5'
						data-hover-z='1' data-animated style='width: 100%' > Register New Property </a></p>";
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

    private function premiumCondition($offerEntity, $premiumSession, $currency)
    {
        $url = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("ViewHelperManager")
            ->get("url");
        $currencyFormat = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("ViewHelperManager")
            ->get("myCurrencyFormat");
        if ($offerEntity->getIsManualPremium() == TRUE) {
            $premiumSession->premium = $offerEntity->getManualPremium()->getPremium();
            $premiumSession->premiumCurrency = $offerEntity->getManualPremium()
                ->getCurrency()
                ->getId();
            return "<h2>" . $currencyFormat($offerEntity->getManualPremium()->getPremium(), $offerEntity->getManualPremium()
                ->getCurrency()
                ->getCode()) . "</h2>";
        } else {
            
            return "<h2>" . $currencyFormat($premiumSession->premium, $currency) . "</h2>";
        }
    }
}

