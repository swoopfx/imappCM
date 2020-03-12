<?php
namespace Object\Form\Fieldset\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Object\Form\Fieldset\SelectObjectFieldset;
use GeneralServicer\Service\GeneralService;
use Zend\Session\Container;

/**
 *
 * @author otaba
 *        
 */
class SelectObjectFeildsetFactory implements FactoryInterface
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
        $field = new SelectObjectFieldset();
        $generalService = $serviceLocator->getServiceLocator()->get('GeneralServicer\Service\GeneralService');
        $myCurrency = $serviceLocator->getServiceLocator()->get("ViewHelperManager")->get("myCurrencyFormat");
      // $centralBrokerId = NULL;
        $em = $generalService->getEntityManager();
        
            $centralBrokerId = $generalService->getCentralBroker();
           // var_dump($centralBrokerId);
        if($centralBrokerId == NULL){
            $session = new Container('clientSession');
            $centralBrokerId = $session->brokerId;
            //var_dump($centralBrokerId);
        }
        
        $customerId = $generalService->getGeneralSession()->currentCustomerid;
        $field->setBroker($centralBrokerId)
            ->setEntityManager($em)
            ->setMyCurrencyFormat($myCurrency)
            ->setCustomerId($customerId);
        return $field;
    }
}

