<?php
/**
 * CsnUser - Coolcsn Zend Framework 2 User Module
 * 
 * @link https://github.com/coolcsn/CsnUser for the canonical source repository
 * @copyright Copyright (c) 2005-2013 LightSoft 2005 Ltd. Bulgaria
 * @license https://github.com/coolcsn/CsnUser/blob/master/LICENSE BSDLicense
 * @author Stoyan Cheresharov <stoyan@coolcsn.com>
 * @author Svetoslav Chonkov <svetoslav.chonkov@gmail.com>
 * @author Nikola Vasilev <niko7vasilev@gmail.com>
 * @author Stoyan Revov <st.revov@gmail.com>
 * @author Martin Briglia <martin@mgscreativa.com>
 */
namespace CsnUser;

use Zend\ModuleManager\ModuleManager;
use Zend\Mvc\MvcEvent;
use Zend\EventManager\StaticEventManager;
use GeneralServicer\Service\TriggerService;
use Wallet\Entity\Wallet;
use Wallet\Service\WalletService;

class Module
{

    public function getConfig()
    {
        return include __DIR__ . '/../../config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/../../src/' . __NAMESPACE__
                )
            )
        );
    }

    public function init(ModuleManager $moduleManager)
    {
        $sharedEvent = $moduleManager->getEventManager()->getSharedManager();
        $sharedEvent->attach(__NAMESPACE__, 'dispatch', function ($e) {
            $controller = $e->getTarget();
            $controller->layout('layout/login');
        });
    }

    public function onBootstrap(MvcEvent $e)
    {
        $app = $e->getApplication();
        $sm = $app->getServiceManager();

        $csnUserEvent = StaticEventManager::getInstance();
        $csnUserEvent->attach("Zend\Mvc\Controller\AbstractActionController", TriggerService::TRIGGER_REGISTER_BROKER, function ($e) use ($sm) {
            $em = $sm->get("doctrine.entitymanager.orm_default");

            $user = $e->getParam("user");
            $walletEntity = new Wallet();
            $walletEntity->setBalance("0")
                ->setBookBalance("0")
                ->setCreatedOn(new \DateTime())
                ->setUpdatedOn(new \DateTime())
                ->setUser($em->find("CsnUser\Entity\User", $user))
                ->setWalletUid(WalletService::generateWalletUid());

            try {
                $em->persist($walletEntity);
                $em->flush();
            } catch (\Exception $e) {}
        });
    }
}
