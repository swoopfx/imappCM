<?php
namespace Customer\View\Helper\Packages;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Session\Container;

/**
 *
 * @author otaba
 *        
 */
class CustomerPackagePremiumViewHelper extends AbstractHelper implements ServiceLocatorAwareInterface
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

    public function __invoke($customerPackageEntity)
    {
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
            return "<p style='text-align: center;'><a href='#modal-include-object' data-toggle='modal'
						class='btn  btn-flat btn-primary'
						class='btn  paper-shadow relative' data-z='0.5'
						data-hover-z='1' data-animated style='width: 100%' > Include a Property</a> <br> OR <br>
 <a href='#modal-register-object' data-toggle='modal'
						class='btn btn-white btn-flat btn-primary'
						class='btn btn-white paper-shadow relative' data-z='0.5'
						data-hover-z='1' data-animated style='width: 100%' > Register New Property </a></p>";
        } else {
            $premiumService->setValueType($customerPackageEntity->getPackages()
                ->getValueType()
                ->getId())
                ->setObjectsArray($customerPackageEntity->getObject())
                ->setPremiumRate($customerPackageEntity->getPackages()
                ->getValue());
            $objectArray = $customerPackageEntity->getObject();
            
            $premium = $premiumService->premiumCalculator();
            $currency = $objectArray[count($objectArray) - 1]->getCurrency()->getCode();
            $premiumSession->premiumCurrency = $objectArray[count($objectArray) - 1]->getCurrency()->getId();
            $premiumSession->premium = $premium;
            return "<h2>" . $currencyFormat($premium, $currency) . "</h2>";
        }
    }
}

