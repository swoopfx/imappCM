<?php
namespace Proposal\Form\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Proposal\Form\SelectCustomerForm;

/**
 *
 * @author swoopfx
 *        
 */
class SelectCustomerFormFactory implements FactoryInterface
{

    private $em;

    private $userId;

    private $auth;

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
        $form = new SelectCustomerForm();
        $this->em = $serviceLocator->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $this->auth = $serviceLocator->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
        $this->getUserId();
        
        $form->setEntityManager($this->em)
            ->setUserId($this->userId)
            ->setAuth($this->auth)
            ->setBroker($this->getBrokerId());
        return $form;
    }

    protected function getBrokerId()
    {
        $brokerChild = $this->em->find('GeneralServicer\Entity\BrokerChild', $this->userId);
        if ($brokerChild != NULL) {
            return $brokerChild->getBroker()->getId();
        } else {
            $broker = $this->em->find('Users\Entity\InsuranceBrokerRegistered', $this->userId);
            return $broker->getId();
        }
    }

    protected function getUserId()
    {
        if ($this->auth->hasIdentity()) {
            $this->userId = $this->auth->getIdentity()->getId();
        }
    }
}

