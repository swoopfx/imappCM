<?php
namespace BrokersTool\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use BrokersTool\Controller\BrokerToolController;
use CsnUser\Entity\User;

/**
 *
 * @author swoopfx
 *        
 */
class BrokerToolControllerFactory implements FactoryInterface
{

    /**
     */
    public function __construct()
    {
        
        // TODO - Insert your code here
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $ctr = new BrokerToolController();
        $userEntity = new User();
        
        $generalService = $serviceLocator->getServiceLocator()->get('GeneralServicer\Service\GeneralService');
        $em = $generalService->getEntityManager();
        $userFormHelper = $serviceLocator->getServiceLocator()->get('csnuser_user_form');
        // $uploadForm = $serviceLocator->getServiceLocator()->get('GeneralServicer\Form\GeneralUploadForm');
        $brokerTollService = $serviceLocator->getServiceLocator()->get('BrokersTool\Service\BrokerToolService');
        $brokerId = $generalService->getBrokerId();
        $viewRender = $serviceLocator->getServiceLocator()->get("ViewRenderer");
        // $blobService = $serviceLocator->getServiceLocator()->get("Azure\Service\BlobService");
        $addSaffForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get('BrokersTool\Form\AddStaffForm');
        
        $uploadForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get('GeneralServicer\Form\GeneralUploadForm');
        
        $staffPhoneNumberForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get('BrokersTool\Form\StaffPhoneNumberForm');
        
        $staffEmailForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get('BrokersTool\Form\StaffEmailForm');
        
        $brokerFlutterForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get('Transactions\Form\BrokerFlutterwaveForm');
        $mail = $generalService->getMailService();
        // $mailer = $serviceLocator->getServiceLocator()->get("GeneralServicer\Service\MailService");
        $smsService = $serviceLocator->getServiceLocator()->get('SMS\Service\SMSService');
        
        $dropZoneUploadForm = $serviceLocator->getServiceLocator()
            ->get("FormElementManager")
            ->get("GeneralServicer\Form\DropZoneDocUploadForm");
        
        $ctr->setGeneralService($generalService)
            ->setUserEntity($userEntity)
            ->setUserFormHelper($userFormHelper)
            ->setAddStaffForm($addSaffForm)
            ->setBrokerTollService($brokerTollService)
            ->setEntityManager($em)
            ->setFlutterForm($brokerFlutterForm)
            ->setBrokerId($brokerId)
            ->setMailService($mail)
            ->setUploadForm($uploadForm)
            ->setSmsService($smsService)
            ->setRenderer($viewRender)
            ->setDropZoneForm($dropZoneUploadForm)
            ->setStaffPhoneNumberForm($staffPhoneNumberForm)
            ->setStaffEmailForm($staffEmailForm);
        // ->setBlobService($blobService);
        return $ctr;
    }
}

