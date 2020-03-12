<?php
namespace GeneralServicer\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use GeneralServicer\Service\ImprintService;

/**
 *
 * @author swoopfx
 *        
 */
class ImprintServiceFactory implements FactoryInterface
{

    private $userId;

    private $profiled;

    private $auth;

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $service = new ImprintService();
        $generalService = $serviceLocator->get("GeneralServicer\Service\GeneralService");
        $em = $generalService->getEntityManager();
        $this->auth = $generalService->getAuth();
        $centralBrokerId = $generalService->getCentralBroker();
        $viewHelperManager = $serviceLocator->get('ViewHelperManager');
        $basePath = $viewHelperManager->get('basePath');
        $userId = $this->getUserId();
        $role = $this->getUserRole();
        $service->setEnetityManager($em)
            ->setbasePath($basePath)
            ->setUserId($userId)
            ->setRole($role)
            ->setIsProfiled($this->profiled)
            ->setCentralBrokerId($centralBrokerId)
            ->setGeneralService($generalService);
        return $service;
    }

    private function getUserId()
    {
        if ($this->auth->hasIdentity()) {
            $userId = $this->auth->getIdentity()->getId();
            $this->profiled = $this->auth->getIdentity()->getProfiled();
            return $userId;
        } else {
            return NULL;
        }
    }

    private function getUserRole()
    {
        if ($this->auth->hasIdentity()) {
            $userRole = $this->auth->getIdentity()
                ->getRole()
                ->getId();
            return $userRole;
        }
    }
}

?>