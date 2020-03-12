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
class CustomerLayoutCustomerNameHelper extends AbstractHelper implements ServiceLocatorAwareInterface
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

    public function __invoke()
    {
        $identity = $this->getServiceLocator()
        ->getServiceLocator()
        ->get("ViewHelperManager")
        ->get("identity");
        
        $clientGeneralService = $this->getServiceLocator()->getServiceLocator()->get("Customer\Service\ClientGeneralService");
        $customerId = $clientGeneralService->getCustomerId();
        $em = $clientGeneralService->getEntityManager();
        $customerEntity = $em->find("Customer\Entity\Customer", $customerId);
        if($identity){
            return $customerEntity->getName();
        }else{
            return "";
        }
    }
}

