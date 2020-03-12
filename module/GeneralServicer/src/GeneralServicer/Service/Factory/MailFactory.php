<?php
namespace GeneralServicer\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
// use GeneralServicer\Service\MailService;

/**
 *
 * @author swoopfx
 *        
 */
class MailFactory implements FactoryInterface
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
//         $mail = new MailService();
//         $generalService = $serviceLocator->get('GeneralServicer\Service\GeneralService');
        
//         $em = $generalService->getEntityManager();
//         // $pluginManager = $serviceLocator->get('ControllerPluginManager');
//         // $viewManager = $serviceLocator->get('ViewManager');
//        // $mailService = $generalService->getMailService();
//         $viewRender = $generalService->getViewRender();
        
//         $mail->setEntityManager($em)
//             //->setMailService($mailService)
//             ->setViewRenderer($viewRender);
        
        return $mail;
    }
}

