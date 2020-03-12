<?php
namespace Packages\View\Helper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Session\Container;

/**
 *
 * @author otaba
 *        
 */
class PackageBannerHelper extends AbstractHelper implements ServiceLocatorAwareInterface
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

    public function __invoke($bannerForm)
    {
        $generalService = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("GeneralServicer\Service\GeneralService");
        
        $em = $generalService->getEntityManager();
        $partial = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("ViewHelperManager")
            ->get("partial");
        $em = $generalService->getEntityManager();
        $path = "";
        $bannerSession = new Container("package_banner_session");
        if ($bannerSession->docId != NULL) {
            $docEntity = $em->find("GeneralServicer\Entity\Document", $bannerSession->docId);
            return $partial("package_banner_upload_form", array(
                "bannerUploadForm" => $bannerForm
            )) . "<br>
<div class='col-md-45'>
                        <div class='thumbnail'>
                          <div class='image view view-first'>
                            <img style='width: 100%; display: block;' src='" . $docEntity->getDocUrl() . "' alt='image' />
                            
                          </div>
                          
                        </div>
                      </div>";
        } else {
            return $partial("package_banner_upload_form", array(
                "bannerUploadForm" => $bannerForm
            ));
        }
    }
}

