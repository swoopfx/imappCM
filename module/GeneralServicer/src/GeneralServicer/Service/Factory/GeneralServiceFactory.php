<?php
namespace GeneralServicer\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use GeneralServicer\Service\GeneralService;
use CsnUser\Service\UserService;
use Zend\Session\Container;

/**
 *
 * @author swoopfx
 *        
 */
class GeneralServiceFactory implements FactoryInterface
{

    private $auth;

    private $userId;

    private $em;

    private $userRole;

    private $brokerChildId;

    private $brokerChild;

    private $brokerId;

    private $motherBrokerId;

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $serve = new GeneralService();
        $generalSession = new Container("general");
        $em = $serviceLocator->get('doctrine.entitymanager.orm_default');
        $this->em = $em;
        $auth = $serviceLocator->get('Zend\Authentication\AuthenticationService');
        
        $authorizationService= $serviceLocator->get("ZfcRbac\Service\AuthorizationService");
        $urlPlugin = $serviceLocator->get("ControllerPluginManager")->get("Url");
        $urlViewHelper = $serviceLocator->get("ViewHelperManager")->get("url");
        $flashMessaenger = $serviceLocator->get('ControllerPluginManager')->get('FlashMessenger');
        $redirect = $serviceLocator->get('ControllerPluginManager')->get('redirect');
        $viewRenderer = $serviceLocator->get("ViewRenderer");
        $request = $serviceLocator->get("Request");
        $viewHelperManager = $serviceLocator->get('ViewHelperManager');
        $basePath = $viewHelperManager->get('basePath');
        $uploadForm = $serviceLocator->get("FormElementManager")->get("GeneralServicer\Form\GeneralUploadForm");

        $mailService = $serviceLocator->get('acmailer.mailservice.default');
        
        $this->auth = $auth;
        $this->getuserId();
        $this->getBrokerId();
        $this->getBrokerChildId();
        $this->getMotherBrokerId();
        $this->getUserRole();
        
        $serve->setEntityManager($em)
            ->setUserId($this->userId)
            ->setAuth($this->auth)
            ->setBrokerId($this->brokerId)
            ->setChildBrokerId($this->brokerChildId)
            ->setMotherBroker($this->motherBrokerId)
            ->setUserRoleId($this->userRole)
            ->setChildBroker($this->brokerChild)
            ->setMailService($mailService)
            ->setUrl($urlPlugin)
            ->setAuthorization($authorizationService)
            ->setFlashMessenger($flashMessaenger)
            ->setRedirtect($redirect)
            ->setViewRender($viewRenderer)
            ->setRequest($request)
            ->setUrlViewHelper($urlViewHelper)
            ->setGeneralSession($generalSession)
            ->setUploadForm($uploadForm)
//             ->setPdfModelService($pdfModelService)
            ->setBasePath($basePath);
        
        return $serve;
    }

    private function getUserRole()
    {
        if ($this->auth->hasIdentity()) {
            $data = $this->auth->getIdentity()
                ->getRole()
                ->getId();
            $this->userRole = $data;
            return $data;
        }
    }

    private function getuserId()
    {
        if ($this->auth->hasIdentity()) {
            
            $this->userId = $this->auth->getIdentity()->getId();
        }
    }

    /**
     * this get the broker id
     */
    private function getBrokerId()
    {
        if ($this->auth->hasIdentity()) {
            $userRole = $this->auth->getIdentity()
                ->getRole()
                ->getId();
            if ($userRole == UserService::USER_ROLE_BROKER || $userRole == UserService::USER_ROLE_SETUP_BROKER) {
                $criteria = array(
                    'user' => $this->userId
                );
                
                $data = $this->em->getRepository('Users\Entity\InsuranceBrokerRegistered')->findOneBy($criteria);
                if ($data != NULL) {
                    $this->brokerId = $data->getId();
                    return $data->getId();
                } else {
                    return NULL;
                }
            }
        }
    }

    private function getBrokerChildId()
    {
        if ($this->auth->hasIdentity()) {
            $userRole = $this->auth->getIdentity()
                ->getRole()
                ->getId();
            if ($userRole == UserService::USER_ROLE_BROKER_CHILD) {
                $criteria = array(
                    'user' => $this->userId
                );
                
                $data = $this->em->getRepository('GeneralServicer\Entity\BrokerChild')->findOneBy($criteria);
                if ($data != NULL) {
                    $this->brokerChild = $data;
                    $this->brokerChildId = $data->getId();
                    return $data->getId();
                }
            }
        }
    }

    /**
     * This gets the mother Broker Id
     * Provided the user is a child
     */
    private function getMotherBrokerId()
    {
        if ($this->auth->hasIdentity()) {
            $userRole = $this->auth->getIdentity()
                ->getRole()
                ->getId();
            if ($userRole == UserService::USER_ROLE_BROKER_CHILD) {
                $criteria = array(
                    'user' => $this->userId
                );
                
                $data = $this->em->getRepository('GeneralServicer\Entity\BrokerChild')->findOneBy($criteria);
                if ($data != NULL) {
                    $this->motherBrokerId = $data->getBroker()->getId();
                    
                    return $this->motherBrokerId;
                }
            }
        }
    }
}

