<?php
namespace Users\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Users\Controller\IndController;
use Users\Entity\IndividualInfo;
use Users\Entity\IndividualContact;

/**
 *
 * @author swoopfx
 *        
 */
class IndControllerFactory implements FactoryInterface
{

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $ctr = new IndController();
        $op = $serviceLocator->getServiceLocator()->get('csnuser_module_options');
        $em = $serviceLocator->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $mail = $serviceLocator->getServiceLocator()->get('mail.transport');
        $trans = $serviceLocator->getServiceLocator()->get('MvcTranslator');
        $errorPage = $serviceLocator->getServiceLocator()->get('csnuser_error_view');
        
        $ctr->setErrorPage($errorPage);
        $ctr->setMail($mail);
        $ctr->setEntityManager($em);
        $ctr->setOptions($op);
        $profileForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get('Users\Form\AgentSetupInfoForm');
        
        $ctr->setProfileForm($profileForm);
        
        $indEntity = new IndividualInfo();
        $ctr->setIndInfo($indEntity);
        
        $indContact = new IndividualContact();
        $ctr->setContactInfo($indContact);
        
        return $ctr;
    }
}

