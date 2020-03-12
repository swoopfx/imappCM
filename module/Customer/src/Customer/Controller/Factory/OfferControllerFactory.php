<?php
namespace Customer\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Customer\Controller\OfferController;

/**
 *
 * @author otaba
 *        
 */
class OfferControllerFactory implements FactoryInterface
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
        $ctr = new OfferController();
        $renderer = $serviceLocator->getServiceLocator()->get("ViewRenderer");
        $offerService = $serviceLocator->getServiceLocator()->get("Offer\Service\OfferService");
        $clientGeneralService = $serviceLocator->getServiceLocator()->get('Customer\Service\ClientGeneralService');
        $boardService = $serviceLocator->getServiceLocator()->get('Customer\Service\CustomerBoardService');
        $objectService = $serviceLocator->getServiceLocator()->get('Object\Service\ObjectService');
        $messageService = $serviceLocator->getServiceLocator()->get("Messages\Service\MessageService");
        $offerForm = $serviceLocator->getServiceLocator()
            ->get("FormElementManager")
            ->get("Offer\Form\OfferForm");
        $objectForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get("Object\Form\ObjectForm");
        
        $selectObjectForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get("Object\Form\SelectObjectForm");
        
        $messageForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get("Messages\Form\MessageForm");
        $em = $clientGeneralService->getEntityManager();
        $generalSession = $clientGeneralService->getGeneralService()->getGeneralSession();
        $ctr->setCustomerBoardService($boardService)
            ->setEntityManager($em)
            ->setOfferService($offerService)
            ->setClientGeneralService($clientGeneralService)
            ->setOfferForm($offerForm)
            ->setObjectForm($objectForm)
            ->setObjectService($objectService)
            ->setMessageForm($messageForm)
            ->setMessageService($messageService)
            ->setGeneralSession($generalSession)
            ->setSelectObjectForm($selectObjectForm)
            ->setRenderer($renderer);
        return $ctr;
    }
}

