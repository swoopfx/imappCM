<?php
namespace Packages\View\Helper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Session\Container;


/**
 *
 * @author otaba
 *        
 */
class AcquiredPackagesEstimatedPremiumHelper extends AbstractHelper implements ServiceLocatorAwareInterface
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

   
    public function __invoke($customerPackageEntity){
        $premiumSession = new Container("customer_package_premium");
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
        
        if (count($customerPackageEntity->getObject()) == 0) {
            return "<p style='text-align: center;'><a style='width: 100%;' href='' data-toggle='modal' data-target='.select-property-modal-lg' class='btn btn-xs btn-success'>Include a Property</a> <br> OR <br> <a href='' data-toggle='modal' style='width: 100%' data-target='.bs-object-modal-lg' class='btn btn-primary btn-xs'>Register New Property</a></p>";
        } elseif ($customerPackageEntity->getPackages()->getValue() != NULL && $customerPackageEntity->getPackages()->getValueType() != NULL && count($customerPackageEntity->getObject()) > 0) {
            $premiumService->setValueType($customerPackageEntity->getPackages()->getValueType()
                ->getId())
                ->setObjectsArray($customerPackageEntity->getObject())
                ->setPremiumRate($customerPackageEntity->getPackages()->getValue());
                $objectArray = $customerPackageEntity->getObject();
                
                $premium = $premiumService->premiumCalculator();
                $currency = $objectArray[count($objectArray) - 1]->getCurrency()->getCode();
                $premiumSession->premiumCurrency = $objectArray[count($objectArray) - 1]->getCurrency()->getId();
                $premiumSession->premium = $premium;
                return "<h2>" . $currencyFormat($premium, $currency) . "</h2>";
        }
    }
}

