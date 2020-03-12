<?php
namespace Home\View\Helper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 *
 * @author swoopfx
 *        
 */
class IsNotificationHeader extends AbstractHelper implements ServiceLocatorAwareInterface
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
    }

    public function __invoke(){
        $homeService = $this->getServiceLocator()->getServiceLocator()->get('Home\Service\HomeService');
        $info = $homeService->isNotificatioReady();
        if ($info == TRUE){
            return "<span class='badge bg-red'>NOTIFICATIONS</span>";
        }
            else "<span class='badge bg-red'>OUTSTANDING SETUP</span>";
    }
}

