<?php
namespace Proposal\Form\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Proposal\Form\ProposalForm;


/**
 *
 * @author swoopfx
 *        
 */
class ProposalFormFactory implements FactoryInterface
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
        
        $form = new ProposalForm();
        $em = $serviceLocator->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        
        return $form;
    }
}

