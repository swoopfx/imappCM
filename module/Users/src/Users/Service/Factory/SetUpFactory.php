<?php
namespace Users\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Users\Service\SetUpService;


class SetUpFactory implements FactoryInterface
{

    private $auth;

    private $em;
    
    private $subscription;

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $sub = new SetUpService();
        $generalService = $serviceLocator->get('GeneralServicer\Service\GeneralService');
        $this->em = $generalService->getEntityManager();
        $this->auth = $generalService->getAuth();
        
        
        $userId = $generalService->getUserId();
        $brokerId = $generalService->getBrokerId();
        $isSub = $this->getSubscription($brokerId);
        
        $sub->setEntityManager($this->em)
            ->setUserId($userId)
            ->setBrokerId($generalService->getBrokerId())
            ->setIsSub($isSub)->setSubscription($this->subscription);
        return $sub;
    }

    

    private function getSubscription($broker)
    {
        if ($broker != NULL) {
            $sub = $this->em->getRepository('GeneralServicer\Entity\BrokerSubscription')->findOneBy(array(
                'broker' => $broker
                
            ));
             
            
            
        }
    }
}

