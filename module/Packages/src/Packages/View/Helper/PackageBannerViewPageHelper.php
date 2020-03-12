<?php
namespace Packages\View\Helper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;


/**
 *
 * @author otaba
 *        
 */
class PackageBannerViewPageHelper extends AbstractHelper implements ServiceLocatorAwareInterface
{

    private $servicelocator;

    /**
     */
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
        return $this->servicelocator;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\ServiceLocatorAwareInterface::setServiceLocator()
     *
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->servicelocator = $serviceLocator;
        return $this;
    }

    public function __invoke($packageEntity)
    {
        $generalService = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("GeneralServicer\Service\GeneralService");
        
      
        $partial = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("ViewHelperManager")
            ->get("partial");
       
        
       
        $basePath = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("ViewHelperManager")
            ->get("basePath");
        $em = $generalService->getEntityManager();
        
        if ($packageEntity->getPackageImage() == NULL) {
            return $basePath("img/insure-logo/no_image_available_s_large.jpg");
        } else {
            return $packageEntity->getPackageImage()->getDocUrl();
        }
        // $path = "";
        // if ($packageLogoId == NULL || $packageLogoId == " ") {
        // $path = $basePath("img/insure-logo/no_image_available_s_large.jpg");
        // } else {
        // $path = "";
        // }
        // return $path;
    }
}

