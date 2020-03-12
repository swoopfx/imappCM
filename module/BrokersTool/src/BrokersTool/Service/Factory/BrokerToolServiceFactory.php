<?php
namespace BrokersTool\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use BrokersTool\Service\BrokerToolService;
use CsnUser\Entity\User;
use Users\Entity\BrokerChildProfile;
use GeneralServicer\Entity\BrokerChild;

/**
 *
 * @author swoopfx
 *        
 */
class BrokerToolServiceFactory implements FactoryInterface
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
        $xserv = new BrokerToolService();
        $userEntity = new User();
        
        $brokerChildEntity = new BrokerChild();
        $generalService = $serviceLocator->get('GeneralServicer\Service\GeneralService');
        $smsService = $serviceLocator->get('SMS\Service\SMSService');
        // $mailService = $generalService->getMailService();
        $redirect = $serviceLocator->get('ControllerPluginManager')->get('redirect');
        $em = $generalService->getEntityManager();
        $brokerId = $generalService->getBrokerId();
        $centralBrokerId = $generalService->getCentralBroker();
        $xserv->setGeneralService($generalService)
            ->setEntityManager($em)
            ->setUserEntity($userEntity)
            ->setBrokerChildEntity($brokerChildEntity)
            ->setSmsService($smsService)
            ->setRedirect($redirect)
            ->setControllerPluginManager($serviceLocator->get("ControllerPluginManager"))
            ->setBrokerId($brokerId)
            ->setUrlViewHelper($generalService->getUrlViewHelper())
            ->setCentralBrokerId($centralBrokerId);
        return $xserv;
    }
}

