<?php
namespace Transactions\View\Helper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;


/**
 * This class displays condition  text description based on the type of invoice
 *  a switch case is caled 
 *  
 * @author otaba
 *        
 */
class InvoiceDescriptionHelper extends AbstractHelper implements ServiceLocatorAwareInterface
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

    public function __invoke($invoiceCategoryId){
        switch ($invoiceCategoryId){
            case "": 
                break;
                
                default: 
                    break;
        }
    }
}

