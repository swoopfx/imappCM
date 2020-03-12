<?php
namespace SMS\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use SMS\Service\SMSService;
use SMS\Entity\SMSAccount;
use SMS\Entity\SMSBroker;

class SMSServiceFactory implements FactoryInterface
{

    private $centralBrokerId;

    private $entityManager;

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $xserv = new SMSService();
        $smsAccount = new SMSAccount();

        $generalService = $serviceLocator->get('GeneralServicer\Service\GeneralService');
        $this->centralBrokerId = $generalService->getCentralBroker();
        $em = $generalService->getEntityManager();
        $this->entityManager = $em;
        $smsBroker = $this->brokerSmsAccount();
        $xserv->setSmsBroker($smsBroker)
            ->setEntityManager($em)
            ->setBrokerId($generalService->getBrokerId())
            ->setMotherBrokerId($generalService->getMotherBrokerId())
            ->setUserRoleId($generalService->getUserRoleId())
            ->setCentralBrokerId($this->centralBrokerId)
            ->setGeneralService($generalService)
            ->setSmsAccount($smsAccount);

        return $xserv;
    }

    private function brokerSmsAccount()
    {
        $brokerSms = NULL;
        $centralBrokerId = $this->centralBrokerId;
        $em = $this->entityManager;
        if ($centralBrokerId != NULL) {
            $brokerSms = $em->find("SMS\Entity\SMSBroker", $centralBrokerId);
        } else {
            $brokerSms = new SMSBroker();
        }
        return $brokerSms;
    }
}



