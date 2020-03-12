<?php
namespace Customer\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Customer\Service\ClientGeneralService;
use Zend\Session\Container;

// use MicrosoftAzure\Storage\Blob\Models\Container;

/**
 *
 * @author swoopfx
 *        
 */
class ClientGeneralServiceFactory implements FactoryInterface
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
        $xserv = new ClientGeneralService();
        $session = new Container('clientSession');
        $customerProposalSession = new Container("customer_proposal_session");
        
        $hiddenSession = new Container("hiddenSession");
        $hiddenSession->setExpirationSeconds(60 * 60 * 24 * 180);
        
        $generalServie = $serviceLocator->get('GeneralServicer\Service\GeneralService');
        $mailService = $serviceLocator->get('acmailer.mailservice.default');
        $request = $serviceLocator->get("Request");
        $em = $generalServie->getEntityManager();
        $auth = $generalServie->getAuth();
        $xserv->setClientAuth($auth)
            ->setEntityManager($em)
            ->setClientSession($session)
            ->setGeneralService($generalServie)
            ->setRedirect($generalServie->getRedirect())
            ->setRequest($request)
            ->setHiddenSession($hiddenSession)
            ->setUserId($generalServie->getUserId())
            ->setMailService($mailService)
            ->setCustomerProposalSession($customerProposalSession);
        return $xserv;
    }

    private function getBrokerId()
    {
        $session = new Container("clientSession");
        $session->getManager()
            ->getStorage()
            ->clear();
    }
}

