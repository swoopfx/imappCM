<?php
namespace Offer\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorAwareInterface;

/**
 *
 * @author swoopfx
 *        
 */
class OfferFormHelper extends AbstractHelper implements ServiceLocatorAwareInterface
{

    public function __invoke()
    {
        
        /*
         * TODO - use this function to design the layout of the from
         * which would be called from the view of the action
         */
    }
    /**
     * {@inheritDoc}
     * @see \Zend\ServiceManager\ServiceLocatorAwareInterface::setServiceLocator()
     */
    public function setServiceLocator(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator)
    {
        // TODO Auto-generated method stub
        
    }

    /**
     * {@inheritDoc}
     * @see \Zend\ServiceManager\ServiceLocatorAwareInterface::getServiceLocator()
     */
    public function getServiceLocator()
    {
        // TODO Auto-generated method stub
        
    }

}

?>