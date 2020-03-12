<?php
/**
 * This handles all non categorized services for the application 
 * That is non insurance specific services 
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/GeneralServicer for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace GeneralServicer;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\ModuleManager\ModuleManager;
use Zend\EventManager\StaticEventManager;
use GeneralServicer\Service\TriggerService;
use GeneralServicer\Entity\Notifications;
use Policy\Entity\PolicyNotification;
use GeneralServicer\Service\GeneralService;

class Module implements AutoloaderProviderInterface
{

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php'
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    // if we're in a namespace deeper than one level we need to fix the \ in the path
                    __NAMESPACE__ => __DIR__ . '/src/' . str_replace('\\', '/', __NAMESPACE__)
                )
            )
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function onBootstrap(MvcEvent $e)
    {

        // You may not need to do this if you're doing it elsewhere in your
        // application
        $app = $e->getApplication();
        $sm = $app->getServiceManager();
        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        // $notificationEventManager = StaticEventManager::getInstance();
        $sharedEventManager = $app->getEventManager()->getSharedManager();
        $sharedEventManager->attach("Zend\Mvc\Controller\AbstractActionController", TriggerService::TIGGER_NOTIFICATION, function ($e) use ($sm) {
            $em = $sm->get("doctrine.entitymanager.orm_default");

            $notificationEntity = new Notifications();

            // $user = $e->getParam("user");
            $topic = $e->getParam("topic");
            $type = $e->getParam("type");
            $url = $e->getParam("url");
            $message = $e->getParam("message");
            $initiator = $e->getParam("initiator");
            $recipient = $e->getParam("recipient");
            $policy = $e->getParam("policy");
            $isAction = $e->getParam("action");
            
            $initiatorEntity = ($initiator == NULL ? NULL : $em->find("CsnUser\Entity\User", $initiator));
            $recipientEntity = ($recipient == NULL ? NULL : $em->find("CsnUser\Entity\User", $recipient));
            try {

                $notificationEntity->setCreatedOn(new \DateTime())
                    ->setMessage($message)
                    ->setNotificationType($em->find("Settings\Entity\NotificationType", $type))
                    ->setNotificationUrl($url)
                    ->setCreatedOn(new \DateTime())
                    ->setInitiator($initiatorEntity)
                    ->setRecipient($recipientEntity)
                    ->setIsAction($isAction)
                    ->setIsRead(FALSE)
                    ->setTopic($topic);

                if ($type == TriggerService::NOTIFICATION_TYPE_POLICY_ACTION) {
                    $policyNotificationEntity = new PolicyNotification();
                    $policyNotificationEntity->setNotification($notificationEntity)
                        ->setPolicy($em->find("Policy\Entity\Policy", $policy));
                    $em->persist($notificationEntity);
                }

                $em->persist($policyNotificationEntity);
                $em->flush();
            } catch (\Exception $e) {
                // log error
                var_dump($e->getMessage());
            }
        });

        $sharedEventManager->attach("Zend\Mvc\Controller\AbstractActionController", TriggerService::TRIGGER_GENERAL_EMAIL_SEND, function ($e) use ($app) {
            $sm = $app->getServiceManager();
            // $em = $sm->get("doctrine.entitymanager.orm_default");
            /**
             *
             * @var GeneralService $generalService
             */
            $generalService = $sm->get("GeneralServicer\Service\GeneralService");
            $messagePointers = $e->getParam("messagePointers");
            $template = $e->getParam("template");

            // insert a try catch
            try {
                $generalService = $generalService->sendMails($messagePointers, $template);
            } catch (\Exception $e) {
                // log error
            }
        });
    }

    // public function init(ModuleManager $moduleManager)
    // {
    // $sharedEvent = $moduleManager->getEventManager()->getSharedManager();
    // $sharedEvent->attach(__NAMESPACE__, 'dispatch', function ($e) {
    // $controller = $e->getTarget();
    // $controller->layout('layout/layout.phtml');
    // });
    // }
}
