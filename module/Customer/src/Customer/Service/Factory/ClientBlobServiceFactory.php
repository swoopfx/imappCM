<?php
namespace Customer\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Customer\Service\ClientBlobService;
use MicrosoftAzure\Storage\Blob\BlobRestProxy;
use GeneralServicer\Service\GeneralService;

/**
 *
 * @author otaba
 *        
 */
class ClientBlobServiceFactory implements FactoryInterface
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
        $xserv = new ClientBlobService();
        $blobClient = BlobRestProxy::createBlobService(GeneralService::GENERAL_BLOB_CONNECTION_STRING);
        $clientGeneralService = $serviceLocator->get("Customer\Service\ClientGeneralService");
        $em = $clientGeneralService->getEntityManager();
        $xserv->setClientGeneralService($clientGeneralService)
            ->setEntityManager($em)
            ->setBlobClient($blobClient)
            ->setCentralBrokerUid($clientGeneralService->getBrokerUid());
        return $xserv;
    }
}

