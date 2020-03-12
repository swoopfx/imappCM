<?php
namespace Proposal\Form\Fieldset\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Proposal\Form\Fieldset\ProposalFieldset;

/**
 *
 * @author swoopfx
 *        
 */
class ProposalFieldsetFactory implements FactoryInterface
{

    private $em;

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
        $fieldset = new ProposalFieldset();
        $generalService = $serviceLocator->getServiceLocator()->get('GeneralServicer\Service\GeneralService');
        $myCurrency = $serviceLocator->getServiceLocator()->get("ViewHelperManager")->get("myCurrencyFormat");
        $this->em = $generalService->getEntityManager();
        $centralBrokerId = $generalService->getCentralBroker();
        $customerId = $generalService->getGeneralSession()->currentCustomerid;
        $fieldset->setEntityManager($this->em)
            ->setBroker($centralBrokerId)
            ->setCustomerId($customerId)
            ->setMyCurrency($myCurrency);
        
        return $fieldset;
    }
}

