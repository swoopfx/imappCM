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
class ImprintLogoHelper extends AbstractHelper implements ServiceLocatorAwareInterface
{

    protected $serviceLocator;

    protected $helperManager;

    protected $serviceManager;

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

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\View\Helper\Navigation\HelperInterface::render()
     *
     */
    public function __invoke()
    {
        $logoPath = '';
        $this->helperManager = $this->getServiceLocator();
        
        $this->serviceManager = $this->helperManager->getServiceLocator();
        $generalService = $this->serviceManager->get("GeneralServicer\Service\GeneralService");
        $imprint = $this->serviceManager->get('general_service_imprint');
        return $generalService->imprintLogo();
    }
}

?>