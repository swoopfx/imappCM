<?php
namespace GeneralServicer\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use GeneralServicer\Service\PusherChatkitService;
use Chatkit\Chatkit;
use Zend\Session\Container;
use GeneralServicer\Service\GeneralService;

// use Chatkit\
class PusherChatkitServiceFactory implements FactoryInterface
{

    public function __construct()
    {

        // TODO - Insert your code here
    }

    public function createService(ServiceLocatorInterface $serviceLocator)
    {

        // Instance Locator : v1:us1:e3d9dfc6-46fa-4743-9c29-6ad8e994a903
        // Secret Key: 0dfa2930-d187-4f47-8933-3093d8ea0b59:JAqxILrZDVnmiwC3JnDqYElVjamQugQSJH5qrnBEI+w=
        $xserv = new PusherChatkitService();

        /**
         *
         * @var GeneralService $generalService
         */
        $generalService = $serviceLocator->get('GeneralServicer\Service\GeneralService');
        $auth = $generalService->getAuth();
        $chatkitSession = new Container("pusher_chatkit_session");
        $userId = NULL;

        if ($auth->hasIdentity()) {
            $userId = $generalService->getUserId();

            $pusherUser = NULL;
            $pusherAuth = NULL;
            $em = $generalService->getEntityManager();
//             var_dump("KIII");
            if ($userId != NULL) {
                $userEntity = $em->find("CsnUser\Entity\User", $userId);
                try {
                    $chatKit = new Chatkit([
                        'instance_locator' => 'v1:us1:844af1f9-32db-4a29-b6cf-33bb9b4b3b28',
                        'key' => '82bcc41e-262f-4a9c-8ec3-92e1e2051596:o2Mo9r/p5hmQMH0Cm7qMd5bptESSvkvAZut4VLz/InU='
                    ]);
                } catch (\Exception $e) {
                    // var_dump($e->getMessage());
                    // var_dump($pusherAuth["body"]);
                }

                $xserv->setUserEntity($userEntity)
                    ->setChatKit($chatKit)
                    ->setChatkitSession($chatkitSession);
            } else {
                throw new \Exception("User Identity absent");
            }
        }
        // var_dump("MIU");
        return $xserv;
    }

/**
 *
 * @param object $auth
 */
    // private function setPusherAuth($auth)
    // {
    // $chatkitSession = new Container("pusher_chatkit_session");
    // if ($auth != NULL || is_string($auth["body"]["access_token"])) {
    // $chatkitSession->token = $auth["body"];
    // }
    // }
}

