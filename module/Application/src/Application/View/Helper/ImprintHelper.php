<?php
namespace Application\View\Helper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 *
 * @author swoopfx
 *        
 */
class ImprintHelper extends AbstractHelper implements ServiceLocatorAwareInterface
{

    protected $serviceLocator;

    protected $helperManager;

    protected $serviceManager;

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

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\View\Helper\Navigation\HelperInterface::render()
     *
     */
    public function __invoke()
    {
        $this->helperManager = $this->getServiceLocator();
        
        $this->serviceManager = $this->helperManager->getServiceLocator();
        $imprint = $this->serviceManager->get('general_service_imprint');
        return $imprint->imprintName();
    }
}

?>