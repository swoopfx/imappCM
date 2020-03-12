<?php
namespace Customer\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Customer\Service\ClientService;

/**
 *
 * @author swoopfx
 *        
 */
class ClinetServiceFactory implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $xserv = new ClientService();
        
        $generalService = $serviceLocator->get('GeneralServicer\Service\GeneralService');
        $smsService = $serviceLocator->get('SMS\Service\SMSService');
        $url = $serviceLocator->get('ControllerPluginManager')->get('url');
        $em = $generalService->getEntityManager();
        $mailService = $generalService->getMailService();
        $xserv->setEntityManager($em)
            ->setGeneralService($generalService)
            ->setMailService($mailService)
            ->setUrl($url)
            ->setSMSservice($smsService);
        return $xserv;
    }
}