<?php
namespace Wallet;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\ModuleManager\ModuleManager;
use Zend\EventManager\StaticEventManager;
use Zend\EventManager\Event;
use GeneralServicer\Service\TriggerService;
use Wallet\Entity\Wallet;
use GeneralServicer\Service\GeneralService;
use Wallet\Entity\WalletTransaction;
use Wallet\Service\WalletService;
use Transactions\Service\TransactionService;
use Wallet\Entity\WalletActivity;

class Module implements AutoloaderProviderInterface
{

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__
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

        $em = $sm->get("doctrine.entitymanager.orm_default");
        $eventManager = $app->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        $walletEventManager = StaticEventManager::getInstance();
        $walletEventManager->attach("Wallet\Service\WalletService", "getTransation", function ($e) use ($sm) {
            //
            // $em = $sm->get("doctrine.entitymanager.orm_default");

            // $user = $e->getParam("user");

            // $loEntity = new \Home\Entity\LoggerTest();
            // $loEntity->setLoggedDate(new \DateTime())->setUser($em->find("CsnUser\Entity\User", $user));

            // $em->persist($loEntity);
            // $em->flush();
            // $this->sss($sm);
        });

        // Passcode creation listener
        $walletEventManager->attach("Zend\Mvc\Controller\AbstractActionController", TriggerService::TRIGGER_WALLET_PASSCODE_CREATED, function ($e) use ($app) {
            $sm = $app->getServiceManager();
            $em = $sm->get("doctrine.entitymanager.orm_default");
            $eventManager = $app->getEventManager();

            /**
             * This sends an email , SMS notification
             */
            $userId = $e->getParam("user");
            $walletId = $e->getParam("wallet");
            $generalService = $sm->get("GeneralServicer\Service\GeneralService");
            $userEntity = $em->find("CsnUser\Entity\User", $userId);
            $walletEntity = $em->find("Wallet\Entity\Wallet", $walletId);
            try {
                /**
                 *
                 * @var GeneralService $generalService
                 */
                $messagePointers = array(
                    "to" => $userEntity->getEmail(),
                    "fromName" => GeneralService::APP_NAME,
                    "subject" => "Wallet Passcode Generated"
                );

                $template = array(
                    "template" => "general-mail-default", // use generic mail design
                    "var" => array(
                        // use generic mail variables
                        "logo" => $generalService->getImappLogo(),
                        "title" => "Wallet Passcode Generated",
                        "message" => "The wallet passcode has been successfully generated, it can be used for withrawaal of funds and servers as a security measure"
                    )
                );

                // insert a try catch
                $generalService = $generalService->sendMails($messagePointers, $template);
            } catch (\Exception $e) {
                // trigger error log
            }
        });

        // Broker Transfer Initiated Listener

        $walletEventManager->attach("Transactions\Service\RaveCardPaymentService", TriggerService::TRIGGER_BROKER_TRANSFER_INITIATED, function ($e) use ($app) {
            $user = $e->getParam("user");
            $amount = $e->getParam("amount");
            $transferId = $e->getParam("transfer");
            $sm = $app->getServiceManager();
            $em = $sm->get("doctrine.entitymanager.orm_default");
            /**
             *
             * @var Wallet $walletEntity
             */
            $walletEntity = $em->getRepository("Wallet\Entity\Wallet")
                ->findOneBy(array(
                "user" => $user
            ));

            // This reducess the available balance but maintains the book balance
            // Upon completion the book balance is altered
            $bookeBalance = $walletEntity->getBalance();
            $newBalance = $bookeBalance - $amount;
            $walletEntity->setBalance($newBalance)
                ->setUpdatedOn(new \DateTime());

            $walletActivityEntity = new WalletActivity();
            $walletActivityEntity->setCreatedOn(new \DateTime())
                ->setName("Broker initiated withdrawal")
                ->setType($em->find("Wallet\Entity\WalletActivityType", WalletService::WALLET_ACTIVITY_TYPE_DEBIT))
                ->setWallet($walletEntity)
                ->setDesc("withdrawal of {$bookeBalance} has been initiated from {$walletEntity->getWalletUid()} wallet");

                $brokerTransferEntity = $em->find("Transactions\Entity\BrokerTransfer", $transferId);
                $brokerTransferEntity->setWallet($walletEntity);
                
            try {
                $em->persist($brokerTransferEntity);
                $em->persist($walletActivityEntity);
                $em->persist($walletEntity);
                $em->flush();
            } catch (\Exception $e) {
                // / Log Error
            }
        });

        // Broker Verified transaction/credited Listener
        /**
         * This hydrates the wallet balance accordingly
         */
        $walletEventManager->attach("Transactions\Service\RaveCardPaymentService", TriggerService::TRIGGER_CUSTOMER_AVAILABLE_BALANCE_VERIFIED, function ($e) use ($app) {
            $sm = $app->getServiceManager();
            $balance = $e->getParam("balance");
            $user = $e->getParam("user");
            $em = $sm->get("doctrine.entitymanager.orm_default");
            /**
             *
             * @var Wallet $walletEntity
             */
            $walletEntity = $em->getRepository("Wallet\Entity\Wallet")
                ->findOneBy(array(
                "user" => $user
            ));
            $availableBalance = $walletEntity->getBalance(); // zthis is the balance as of the transaction
            $newBalance = floatval($availableBalance) + floatval($balance);

            $walletEntity->setBalance($newBalance)
                ->setUpdatedOn(new \DateTime());

            $walletTransactionEntity = new WalletTransaction();
            $walletTransactionEntity->setAmount($balance)
                ->setCreatedOn(new \DateTime())
                ->setStatus($em->find("Transactions\Entity\TransactionStatus", TransactionService::TRANSACTION_STATUS_SUCCESS))
                ->setTransactionType($em->find("Wallet\Entity\WalletTransactionType", WalletService::WALLET_TRANSACTION_TYPE_CREDIT))
                ->setWallet($walletEntity);
            // TODO hydrate wallet Activity

            $walletActivityEntity = new WalletActivity();
            $walletActivityEntity->setCreatedOn(new \DateTime())
                ->setType($em->find("Wallet\Entity\WalletActivityType", WalletService::WALLET_ACTIVITY_TYPE_CREDIT))
                ->setWallet($walletEntity)
                ->setName("Credit Activity")
                ->setDesc("{$balance} has been credited to broker wallet, and the new balance is {$newBalance}");
            try {
                $em->persist($walletActivityEntity);
                $em->persist($walletEntity);
                $em->persist($walletTransactionEntity);

                $em->flush();
            } catch (\Exception $e) {
                // Error Log Reporting
            }
        });

        // Broker Book Balance credited Listener
        $walletEventManager->attach("Transactions\Service\RaveCardPaymentService", TriggerService::TRIGGER_CUSTOMER_BOOK_BALANCE_VERIFIED, function ($e) use ($app) {
            $sm = $app->getServiceManager();
            $bookBalance = $e->getParam("bookbalalnce");
            $user = $e->getParam("user");
            $em = $sm->get("doctrine.entitymanager.orm_default");
            /**
             *
             * @var Wallet $walletEntity
             */
            $walletEntity = $em->getRepository("Wallet\Entity\Wallet")
                ->findOneBy(array(
                "user" => $user
            ));

            $presentBookBalance = $walletEntity->getBookBalance();
            $newBookBalance = floatval($bookBalance) + floatval($presentBookBalance);

            $walletEntity->setBookBalance($newBookBalance)
                ->setUpdatedOn(new \DateTime());

            $walletActivity = new WalletActivity();
            $walletActivity->setCreatedOn(new \DateTime())
                ->setName("Book Balance Activity")
                ->setType($em->find("Wallet\Entity\WalletActivityType", WalletService::WALLET_ACTIVITY_TYPE_BOOK_BALANCE))
                ->setWallet($walletEntity)
                ->setDesc("{$bookBalance} has been inititated into the wallet {$walletEntity->getWalletUid()}");

            try {
                $em->persist($walletActivity);
                $em->persist($walletEntity);

                $em->flush();
            } catch (\Exception $e) {}
        });
    }

    private function sss($sm)
    {
        // $app = $e->getApplication();
        // $sm = $app->getServiceManager();
        $em = $sm->get("doctrine.entitymanager.orm_default");

        $loEntity = new \Home\Entity\LoggerTest();
        $loEntity->setLoggedDate(new \DateTime());

        $em->persist($loEntity);
        $em->flush();
    }

    public function init(ModuleManager $moduleManager)
    {
        $sharedEvent = $moduleManager->getEventManager()->getSharedManager();
        $sharedEvent->attach(__NAMESPACE__, 'dispatch', function ($e) {
            $controller = $e->getTarget();
            $controller->layout('layout/layout.phtml');
        });
    }
}