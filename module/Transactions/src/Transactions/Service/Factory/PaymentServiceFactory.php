<?php
namespace Transactions\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Transactions\Service\PaymentService;
use Transactions\Entity\Transaction;
use Zend\Http\Client;
use Zend\Json\Json;
use Zend\Session\Container;

/**
 *
 * @author swoopfx
 *        
 */
class PaymentServiceFactory implements FactoryInterface
{

    private $auth;

    private $em;

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $serve = new PaymentService();
        $transact = new Transaction();
        
        $moneyWaveSession = new Container("moneyWaveSession");
        
        $user = NULL;
        $generalService = $serviceLocator->get('GeneralServicer\Service\GeneralService');
        
        $em = $generalService->getEntityManager();
        $auth = $generalService->getAuth();
        $paymentCryptService = $serviceLocator->get('GeneralServicer\Service\PaymentCryptService');
        $invoiceService = $serviceLocator->get('Transactions\Service\InvoiceService');
        $transactionService = $serviceLocator->get("Transactions\Service\TransactionService");
        $myCurrencyFormat = $serviceLocator->get("ViewHelperManager")->get("myCurrencyFormat");
        $mailService = $generalService->getMailService();
        $flashMessenger = $generalService->getFlashMessenger();
        $centralBrokerId = $generalService->getCentralBroker();
        if ($auth->hasIdentity()) {
            $user = $auth->getIdentity();
        }
//         $moneyWaveAuth = $this->moneyWaveAuth();
//         $moneyWaveSession->auth = $moneyWaveAuth->token;
        $serve->setEntityManager($em)
            ->setUser($user)
            ->setTransactEntity($transact)
            ->setPaymentServiceCrypt($paymentCryptService)
            ->setUserId($generalService->getUserId())
            ->setMailService($mailService)
            ->setGeneralService($generalService)
            ->setFlashMessager($flashMessenger)
            ->setRedirect($generalService->getRedirect())
            ->setInvoiceService($invoiceService)
            ->setTransactionService($transactionService)
            ->setCurrencyFormat($myCurrencyFormat)
            ->setCentralBrokerId($centralBrokerId)
            ->setMoneyWaveSession($moneyWaveSession);
        return $serve;
    }

    private function moneyWaveAuth()
    {
        $client = new Client();
        $client->setUri("https://live.moneywaveapi.co/v1/merchant/verify");
        $client->setHeaders(array(
            'Content-Type' => 'application/json'
            // 'Authorization' => PaymentService::MONEYWAVE_AUTH
        ));
        // Explode Card Name
        $client->setMethod("POST");
        $post = array(
            "apiKey" => "lv_2F706LLSDY63CYFQRZRR",
            "secret" => "lv_LHT6U40D2HMMQWFBEC4E0U9RPB4JX9"
        );
        
        $client->setRawBody(Json::encode($post));
        $resp = $client->send();
        $body = Json::decode($resp->getBody());
        return $body;
    }
}

