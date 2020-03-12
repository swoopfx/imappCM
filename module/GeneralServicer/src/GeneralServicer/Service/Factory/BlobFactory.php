<?php
namespace GeneralServicer\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use GeneralServicer\Service\BlobService;
use GeneralServicer\Entity\Document;
use ZendService\WindowsAzure\Storage\Storage;
use ZendService\WindowsAzure\Credentials\AbstractCredentials;
use ZendService\WindowsAzure\RetryPolicy\RetryN;
use ZendService\WindowsAzure\Storage\Blob\Blob;
use ZendService\WindowsAzure\RetryPolicy\AbstractRetryPolicy;
use Zend\Http\Client\Adapter\Proxy;
use MicrosoftAzure\Storage\Blob\BlobRestProxy;
use GeneralServicer\Service\GeneralService;

/**
 *
 * @author swoopfx
 *        
 */
class BlobFactory implements FactoryInterface
{

    private $generalService;

    private $azureBlob;

    private $auth;

    private $userId;

    private $brokerCentralUid;

    private $container;

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
        $service = new BlobService();
        $connectionString = ($_SERVER['APPLICATION_ENV'] == 'development' ? GeneralService::GENERAL_BLOB_CONNECTION_STRING : GeneralService::GENERAL_BLOB_LIVE_CONNECTION_STRING );
        $blobClient = BlobRestProxy::createBlobService($connectionString);
//         var $blobClient->getContainerProperties("power");
        $generalService = $serviceLocator->get('GeneralServicer\Service\GeneralService');
        $this->generalService = $generalService;
        $centralBrokerUid = $generalService->getCentralUid();
        // var_dump($centralBrokerUid);
        $em = $generalService->getEntityManager();
        $this->auth = $generalService->getAuth();
        $urlView = $generalService->getUrlViewHelper();
        
        
        $service->setEntityManager($em)
            ->setUserId($generalService->getUserId())
            ->setBlobClient($blobClient)
            ->setUrlView($urlView)
            ->setCentralBrokerUid($centralBrokerUid);
        
        return $service;
    }

    private function getUserId()
    {
        if ($this->auth->hasIdentity()) {
            $this->userId = $this->auth->getIdentity()->getId();
        }
    }
}

