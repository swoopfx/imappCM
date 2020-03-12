<?php
namespace Packages\Service;

use Zend\Session\Container;

/**
 *
 * @author otaba
 *        
 */
class PackageService
{

    private $entityManager;

    private $centralBrokerId;

    private $redirect;

    private $flash;

    private $userId;

    public function createPackageHydrate($packageEntity)
    {
        $em = $this->entityManager;
        $packageBannerSession = new Container("package_banner_session");
        $value = \floatval(\str_replace(',', '', $packageEntity->getValue()));
        // var_dump("LOW");
        // var_dump($packageEntity->getServiceType());
        $packageEntity->setCreatedOn(new \DateTime())
            ->setBroker($em->find("Users\Entity\InsuranceBrokerRegistered", $this->centralBrokerId))
            ->setValue($value)
            ->setIsActive(TRUE)
            ->setPackageUid($this->generatePackageCode())
            ->setIsHidden(False);
        // var_dump("KHY");
        if ($packageBannerSession->bannerId != NULL) {
            $packageEntity->setPackageImage($em->find("GeneralServicer\Entity\Document", $packageBannerSession->bannerId));
        }
        return $packageEntity;
    }

    private function conditionalHydration($entity)
    {
        switch ($entity->getPackageCategory()->getId()) {
            case "":
                break;
        }
    }

    public function getAllCustomerAcquiredPackage()
    {
        $em = $this->entityManager;
        // echo $this->centralBrokerId;
        $data = $em->getRepository("Packages\Entity\Packages")->findAllCustomerAcquiredPackages($this->centralBrokerId);
        return $data;
    }

    public function generatePackageCode()
    {
        $const = "pack";
        if ($this->userId != NULL) {
            $id = $this->userId;
        } else {
            $id == 00;
        }
        $code = \uniqid($const) . $id;
        return $code;
    }

    public function brokerPackages()
    {
        $em = $this->entityManager;
        $data = $em->getRepository("Packages\Entity\Packages")->findBrokerPackages($this->centralBrokerId);
        // var_dump($data);
        return $data;
    }

    public function recomendPackage()
    {}

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }

    public function setCentralBrokerId($id)
    {
        $this->centralBrokerId = $id;
        return $this;
    }

    public function setRedirect($red)
    {
        $this->redirect = $red;
        return $this;
    }

    public function setFlash($fla)
    {
        $this->flash = $fla;
        return $this;
    }

    public function setUserId($id)
    {
        $this->userId = $id;
        return $this;
    }
}

