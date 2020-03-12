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
class BrokerPackageHelper extends AbstractHelper implements ServiceLocatorAwareInterface
{

    private $serviceLocator;
    
    private $entityManager;
    
    
    public function __invoke($object){
        $view = array();
        foreach($object->getValueOptions() as $key => $value){
            $view = $this->frame($value);
        }
    }
    private function frame($key, $value){
        
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
  
}

