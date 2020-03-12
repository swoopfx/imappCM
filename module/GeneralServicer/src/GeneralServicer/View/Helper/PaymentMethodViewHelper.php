<?php
namespace GeneralServicer\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorAwareInterface;

/**
 *
 * @author swoopfx
 *        
 */
class PaymentMethodViewHelper extends AbstractHelper implements ServiceLocatorAwareInterface
{
    private $serviceManager;
    
    private $serviceLocator;

    public function __invoke()
    {
        $this->serviceManager = $this->getServiceLocator()->getServicelocator()->get('ViewHelperManager');
        $basePath = $this->serviceManager->get('basePath');
        $visa = $basePath('images/visa.png'); // location to visa png image
        $mastercard = $basePath('images/mastercard.png') ; // location to mastercard image 
        $frame = '';
        $frame .= $this->frame($visa, 'Visa');
        $frame .= $this->frame($mastercard, 'MasterCard');
        
        return $frame;
        
    }

   

    private function frame($location, $name = 'Payment')
    {
        $frame = "<img src=" . $location . " alt=" . $name . ">";
        return $frame;
    }

  

    /**
     * {@inheritDoc}
     * @see \Zend\ServiceManager\ServiceLocatorAwareInterface::setServiceLocator()
     */
    public function setServiceLocator(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        
        return $this;
        
    }

    /**
     * {@inheritDoc}
     * @see \Zend\ServiceManager\ServiceLocatorAwareInterface::getServiceLocator()
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
        
    }

}

