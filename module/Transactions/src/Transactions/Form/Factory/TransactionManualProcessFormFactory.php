<?php
namespace Transactions\Form\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Transactions\Form\TransactionManualProcessForm;


/**
 *
 * @author otaba
 *        
 */
class TransactionManualProcessFormFactory implements FactoryInterface
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
        $form = new TransactionManualProcessForm();
         $generalService = $serviceLocator->getServiceLocator()->get("GeneralServicer\Service\GeneralService");
         $em = $generalService->getEntityManager();
        $form->setEntityManager($em);

        return $form;
    }
}

