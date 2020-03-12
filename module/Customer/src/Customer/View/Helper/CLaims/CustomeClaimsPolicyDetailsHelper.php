<?php
namespace Customer\View\Helper\CLaims;

use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorAwareInterface;

/**
 *
 * @author otaba
 *        
 */
class CustomeClaimsPolicyDetailsHelper extends AbstractHelper implements ServiceLocatorAwareInterface
{

    private $serviceLocator;

    /**
     */
    public function __construct()
    {
        
        // TODO - Insert your code here
    }

    public function __invoke($policy)
    {
        $serviceLocator = $this->getServiceLocator()->getServiceLocator();
        $viewManager = $serviceLocator->get("ViewHelperManager");
        $partialViewHelper = $viewManager->get("partial");
        $urlViewHelper = $viewManager->get("url");
        $view = "";
        return $view;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Zend\ServiceManager\ServiceLocatorAwareInterface::setServiceLocator()
     */
    public function setServiceLocator(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        return $this;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Zend\ServiceManager\ServiceLocatorAwareInterface::getServiceLocator()
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }
}

