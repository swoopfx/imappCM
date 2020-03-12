<?php
namespace Customer\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Customer\Controller\ObjectController;
use Zend\Session\Container;

/**
 *
 * @author otaba
 *        
 */
class ObjectControllerFactory implements FactoryInterface
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
        $ctr = new ObjectController();
        $customerObjectSession = new Container("customer_object_session");
        
        $clientGeneralService = $serviceLocator->getServiceLocator()->get('Customer\Service\ClientGeneralService');
        $boardService = $serviceLocator->getServiceLocator()->get('Customer\Service\CustomerBoardService');
        $clientBlobService = $serviceLocator->getServiceLocator()->get("Customer\Service\ClientBlobService");
        $objectForm = $serviceLocator->getServiceLocator()
            ->get("FormElementManager")
            ->get("Object\Form\ObjectForm");
        
            
        $dropZoneUploadForm = $serviceLocator->getServiceLocator()
            ->get("FormElementManager")
            ->get("GeneralServicer\Form\DropZoneDocUploadForm");
        
        $uploadForm = $serviceLocator->getServiceLocator()
            ->get("FormElementManager")
            ->get("GeneralServicer\Form\UploadForm");
        
        $blobService = $serviceLocator->getServiceLocator()->get("GeneralServicer\Service\BlobService");
        
        $currencyService = $serviceLocator->getServiceLocator()->get("GeneralServicer\Service\CurrencyService");
        
        $em = $clientGeneralService->getGeneralService()->getEntityManager();
        $ctr->setEntityManager($em)
            ->setCustomerBoardService($boardService)
            ->setCustomerObjectSession($customerObjectSession)
            ->setObjectForm($objectForm)
            ->setCurrencyService($currencyService)
            ->setDropZoneUploadForm($dropZoneUploadForm)
            ->setClientBlobService($clientBlobService)
            ->setUploadForm($uploadForm)
            ->setBlobService($blobService)
            ->setCLientGeneralService($clientGeneralService);
        // ->setGenericUploadForm($genericUploadForm);
        
        return $ctr;
    }
}

