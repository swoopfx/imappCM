<?php
namespace Transactions\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Transactions\Service\MoneyWavePaymentService;
use Zend\Http\Client;
use Zend\Session\Container;
use Transactions\Entity\Transaction;
use Zend\Json\Json;

/**
 *
 * @author otaba
 *        
 */
class MoneyWavePaymentServiceFactory implements FactoryInterface
{

    /**
     */
    public function __construct()
    {}

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $xserv = new MoneyWavePaymentService();
        $transactionEntity = new Transaction();
        $moneyWaveSession = new Container("moneyWaveSession");
        $generalService = $serviceLocator->get("GeneralServicer\Service\GeneralService");
        $clientGeneralService = $serviceLocator->get("GeneralServicer\Service\GeneralService");
        
//         $moneyWaveAuth = $this->moneyWaveAuth();
//         $moneyWaveSession->auth = $moneyWaveAuth->token;
        $auth = $generalService->getAuth();
        $paymentCryptService = $serviceLocator->get('GeneralServicer\Service\PaymentCryptService');
        $invoiceService = $serviceLocator->get('Transactions\Service\InvoiceService');
        $transactionService = $serviceLocator->get("Transactions\Service\TransactionService");
        $myCurrencyFormat = $serviceLocator->get("ViewHelperManager")->get("myCurrencyFormat");
        //$mailService = $generalService->getMailService();
        $flashMessenger = $generalService->getFlashMessenger();
        $centralBrokerId = $generalService->getCentralBroker();
        if ($auth->hasIdentity()) {
            $user = $auth->getIdentity();
            $xserv->setUserEntity($user);
        }
        
        $xserv->setEntityManager($generalService->getEntityManager())
            ->setMoneyWaveSession($moneyWaveSession);
        return $xserv;
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

