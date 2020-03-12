<?php
namespace Users\View\Helper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 *
 * @author swoopfx
 *        
 */
class InvoiceBearerForSetupViewHelper extends AbstractHelper implements ServiceLocatorAwareInterface
{

    public function __invoke($infos)
    {
        $info = $this->frame($infos);
        return $info;
    }
    private function frame($info){
        $frame = '';
        $frame = "<div class='col-sm-4 invoice-col'>
                          To
                          <address>
                                          <strong>". $info->getCompanyName."</strong> 
                                          <br>".$info->getFullAddress()."
                                          <br>".$info->getCityAndCountry()."
                                          <br><strong>Tel:</strong>".$info->getTelePhone()."
                                          <br> <strong>Email:</strong>". $info->getCompanyEmail()."
                                      </address>
                        </div>";
        return $frame;
    }

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
        
        // TODO - Insert your code here
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\ServiceLocatorAwareInterface::setServiceLocator()
     *
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        
        // TODO - Insert your code here
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\View\Helper\Navigation\HelperInterface::render()
     *
     */
    public function render($container = null)
    {
        
        // TODO - Insert your code here
    }
}

