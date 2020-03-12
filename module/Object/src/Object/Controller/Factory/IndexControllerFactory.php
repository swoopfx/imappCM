<?php
namespace Object\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Object\Controller\IndexController;
use Object\Entity\Object;

// use Zend\ServiceManager\ServiceLocatorInterface;

/**
 *
 * @author swoopfx
 *        
 */
class IndexControllerFactory implements FactoryInterface
{

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $ctr = new IndexController();
        $objectEntity = new Object();
        $renderer = $serviceLocator->getServiceLocator()->get("ViewRenderer");
        $generalService = $serviceLocator->getServiceLocator()->get('GeneralServicer\Service\GeneralService');
        // $op = $serviceLocator->getServiceLocator()->get('csnuser_module_options');
        $blobService = $serviceLocator->getServiceLocator()->get("GeneralServicer\Service\BlobService");

        $uploadForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get("GeneralServicer\Form\UploadForm");

        $dropZoneUploadForm = $serviceLocator->getServiceLocator()
            ->get("FormElementManager")
            ->get("GeneralServicer\Form\DropZoneDocUploadForm");

        $objectForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get('Object\Form\ObjectForm');

        $objectBusinessForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get("Object\Form\ObjectBusinessForm");
        
//             var_dump($objectBusinessForm);

        $objectMotorForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get('Object\Form\ObjectMotorForm');

        $objectBuildingForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get('Object\Form\ObjectBuildingForm');

        $objectLifeForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get('Object\Form\ObjectLifeForm');

        $objectTravelForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get('Object\Form\ObjectTravelForm');

        $objectLifeForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get("Object\Form\ObjectPersonForm");

        $objectBusinessEquipmentForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get("Object\Form\ObjectBusinessItemForm");

        $objectService = $serviceLocator->getServiceLocator()->get('Object\Service\ObjectService');
        $centralBrokerId = $generalService->getCentralBroker();

        $em = $generalService->getEntityManager();

        $ctr->setNewObjectForm($objectForm)
            ->setEntityManager($em)
            ->setObjectService($objectService)
            ->setObjectEntity($objectEntity)
            ->setCentralBrokerId($centralBrokerId)
            ->setDropZoneForm($dropZoneUploadForm)
            ->setObjectBusinessItemForm($objectBusinessEquipmentForm)
            ->setUploadForm($uploadForm)
            ->setBlobService($blobService)
            ->setRenderer($renderer)
            ->setObjectMotorForm($objectMotorForm)
            ->setObjectLifeForm($objectLifeForm)
            ->setObjectTravelForm($objectTravelForm)
            ->setObjectBusinessForm($objectBusinessForm)
            ->setObjectBuildingForm($objectBuildingForm)
            ->setObjectLifeForm($objectLifeForm);
        return $ctr;
    }
}

?>