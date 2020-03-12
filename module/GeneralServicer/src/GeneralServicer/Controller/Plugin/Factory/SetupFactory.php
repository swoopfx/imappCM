<?php
namespace GeneralServicer\Controller\Plugin\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use GeneralServicer\Controller\Plugin\SetupPlugin;

/**
 *
 * @author swoopfx
 *        
 */
class SetupFactory implements FactoryInterface
{

    private $entityManager;

    private $userRole;

    private $broker;

    private $agent;

    private $auth;

    /**
     *
     * @var object
     */
    private $brokerSubscription;
    // this is an Object
    
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
        $isValid = NULL;
        $plugin = new SetupPlugin();
        $generalService = $serviceLocator->getServiceLocator()->get('GeneralServicer\Service\GeneralService');
        $em = $generalService->getEntityManager();
        $this->entityManager = $em;
        $op = $serviceLocator->getServiceLocator()->get('csnuser_module_options');
        $auth = $generalService->getAuth();
        $redirect = $serviceLocator->getServiceLocator()
            ->get('ControllerPluginManager')
            ->get('redirect');
        
        $this->auth = $auth;
        $brokerSub = NULL;
        $this->getBroker();
        $plugin->setAuth($auth);
        if ($auth->hasIdentity()) {
            $role = $auth->getIdentity()
                ->getRole()
                ->getId();
            $this->userRole = $role;
            $plugin->setRoleId($role);
            
            $profile = $auth->getIdentity()->getProfiled();
            $plugin->setIsProfile($profile);
            $brokerSub = $generalService->getSubscription();
        }
        
        $plugin->setRedirect($redirect)
            ->setOptions($op)
            ->setIsActive($isValid)
            ->setBrokerSub($brokerSub)
            ->setGeneralService($generalService);
        
        return $plugin;
    }

    private function getBroker()
    {
        $em = $this->entityManager;
        if ($this->auth->hasIdentity()) {
            $broker = $em->getRepository('Users\Entity\InsuranceBrokerRegistered')->findOneBy(array(
                'user' => $this->auth->getIdentity()
                    ->getId()
            ));
            $this->broker = $broker;
        }
    }
}

