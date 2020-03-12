<?php
namespace Customer\View\Helper\Packages;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 *
 * @author otaba
 *        
 */
class CustomerPackageImageHelper extends AbstractHelper implements ServiceLocatorAwareInterface
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

    public function __invoke($packageEntity)
    {
        $basePath = $this->getServiceLocator()->getServiceLocator()->get("ViewHelperManager")->get("basePath");
        
        if($packageEntity->getPackageImage() == NULL){
            $path = $basePath("img/insure-logo/no_image_available_s_large.jpg");
            return $path;
        }else{
            return $packageEntity->getPackageImage()->getDocUrl();
            // Get the image url 
            // return $this pathe ot the image 
        }
    }
}

