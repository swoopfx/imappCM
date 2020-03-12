<?php
namespace Proposal\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Proposal\Service\ProposalService;
use Proposal\Entity\ProposalBroker;
// use Proposal\Entity\BrokerChildProposal;
use Proposal\Entity\Proposal;
use Zend\Session\Container;

/**
 *
 * @author swoopfx
 *        
 */
class ProposalServiceFactory implements FactoryInterface
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
        $service = new ProposalService();
        $proposalEntity = new Proposal();
        $brokerProposalEntity = new ProposalBroker();
        
        $proposalSession = new Container('proposalSession');
        $proposalSession->setExpirationSeconds(60 * 60 * 24);
        
        // $childBrokerProposalEntity = new BrokerChildProposal();
        $generalService = $serviceLocator->get('GeneralServicer\Service\GeneralService');
        $premiumService = $serviceLocator->get("GeneralServicer\Service\PremiumService");
        $userRoleId = $generalService->getUserRoleId();
        $em = $generalService->getEntityManager();
        $centralBrokerId = $generalService->getCentralBroker();
        $brokerId = $generalService->getBrokerId();
        $redirect = $generalService->getRedirect();
        $flashMessage = $generalService->getFlashMessenger();
        $service->setGeneralService($generalService)
            ->setBrokerProposalEntity($brokerProposalEntity)
            ->setProposalEntity($proposalEntity)
            ->setEntityManager($em)
            ->setUserRoleId($userRoleId)
            ->setBrokerId($brokerId)
            ->setMotherBrokerId($generalService->getMotherBrokerId())
            ->setChildBrokerId($generalService->getChildBrokerId())
            ->setUserId($generalService->getUserId())
            ->setProposalSession($proposalSession)
            ->setCentralBrokerId($centralBrokerId)
            ->setRedirect($redirect)
            ->setFlashMessage($flashMessage)->setPremiumService($premiumService);
        
        return $service;
    }
}

