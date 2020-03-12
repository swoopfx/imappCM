<?php
namespace Customer\View\Helper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;


/**
 *
 * @author otaba
 *        
 */
class CustomerBrokerLogoHelper extends AbstractHelper implements ServiceLocatorAwareInterface
{
    
    private $serviceLocator;

    /**
     */
    public function __construct()
    {
        
        // TODO - Insert your code here
    }

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

    

    public function __invoke(){
        
        $clientGeneralService = $this->getServiceLocator()->getServiceLocator()->get("Customer\Service\ClientGeneralService");
        $em = $clientGeneralService->getEntityManager();
        $base = $clientGeneralService->getGeneralService()->getBasePath();
        if ($clientGeneralService->getClientAuth()->hasIdentity()) {
            if ($clientGeneralService->getClientSession()->brokerId != NULL) {
                $data = $em->find("Users\Entity\InsuranceBrokerRegistered", $clientGeneralService->getClientSession()->brokerId);
                if ($data->getCompanyLogo() != NULL) {
                    return $data->getCompanyLogo()->getDocUrl();
                } else {
                    
                    return $base("images/logow.png");
                }
            }
        }

//         $service = $this->getServiceLocator()->getServiceLocator()->get("Customer\Service\ClientGeneralService");
//         return $service->getBrokerLogo();
    }
}

