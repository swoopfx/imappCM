<?php
namespace Transactions\View\Helper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;


/**
 *
 * @author swoopfx
 *        
 */
class PaymentMethodHelper extends AbstractHelper implements ServiceLocatorAwareInterface
{

    protected $serviceLocator;
    
    public function __construct()
    {}
    
    public function __invoke(){
        /**
         * Gets all the information for the payment\
         *  type availab;le on the platfor 
         */
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

    
}

