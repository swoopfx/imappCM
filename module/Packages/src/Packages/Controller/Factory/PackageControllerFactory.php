<?php
namespace Packages\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Packages\Controller\PackageController;
use Packages\Entity\Packages;
use Packages\Form\CreatePackagesForm;

/**
 *
 * @author otaba
 *        
 */
class PackageControllerFactory implements FactoryInterface
{

    /**
     */
    public function __construct()
    {}

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $ctr = new PackageController();
        $packageEntity = new Packages();
        $generalService = $serviceLocator->getServiceLocator()->get("GeneralServicer\Service\GeneralService");
        $blobService = $serviceLocator->getServiceLocator()->get("GeneralServicer\Service\BlobService");
        $centralBrokerId = $generalService->getCentralBroker();
        $createPackageForm = $serviceLocator->getServiceLocator()
            ->get("FormElementManager")
            ->get("Packages\Form\CreatePackagesForm");
        
        $featuredPackageForm = $serviceLocator->getServiceLocator()
            ->get("FormElementManager")
            ->get("Packages\Form\FeaturedPackageForm");
        
        $bannerUploadForm = $serviceLocator->getServiceLocator()
            ->get("FormElementManager")
            ->get("GeneralServicer\Form\LogoUploadForm");
        
        $dropZoneUploadForm = $serviceLocator->getServiceLocator()
            ->get("FormElementManager")
            ->get("GeneralServicer\Form\DropZoneDocUploadForm");
        // $bannerUploadForm = $generalService->getUploadForm();
        $packageService = $serviceLocator->getServiceLocator()->get("Packages\Service\PackageService");
        $em = $generalService->getEntityManager();
        $renderer = $generalService->getViewRender();
        $ctr->setEntityManager($em)
            ->setCreatePackageForm($createPackageForm)
            ->setGeneralService($generalService)
            ->setPackageEntity($packageEntity)
            ->setRenderer($renderer)
            ->setBannerUploadForm($bannerUploadForm)
            ->setPackageService($packageService)
            ->setFeaturedPackageForm($featuredPackageForm)
            ->setCentralBrokerId($centralBrokerId)
            ->setBlobService($blobService)
            ->setDropZoneForm($dropZoneUploadForm);
        
        return $ctr;
    }
}

