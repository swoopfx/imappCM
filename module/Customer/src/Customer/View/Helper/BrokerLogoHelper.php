<?php
namespace Customer\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorAwareInterface;

/**
 * This class gets the
 *
 * @author otaba
 *        
 */
class BrokerLogoHelper extends AbstractHelper implements ServiceLocatorAwareInterface
{

    private $serviceLocator;

    /**
     * This view helper gets the actual id of the broker in session
     * Uses that id to get the logo of the broker in session
     */
    public function __invoke($brokerId)
    {
        $path = "";
        $service = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("Customer\Service\ClientGeneralService");
        
            return $service->loginPageLogo($brokerId);
    }

    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    public function setServiceLocator(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        return $this;
    }
}