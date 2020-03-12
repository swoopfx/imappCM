<?php
namespace Object\Service;

use Object\Entity\ObjectBroker;
use Object\Entity\ObjectMotorData;
use Object\Entity\ObjectBuildingData;
use Object\Entity\ObjectTravel;
use Object\Entity\ObjectPersonData;
use Object\Entity\ObjectBusinessEquipment;

class ObjectService
{

    protected $entityManager;

    protected $auth;

    protected $identity;

    protected $userId;

    private $objectEntity;

    private $objectSession;

    private $centralBrokerId;

    private $userRoleId;

    private $brokerId;

    private $brokerChildId;

    private $motherBrokerId;

    private $objectBrokerEntity;

    private $cusrrencyService;

    private $generalServie;

    const OBJECT_TYPE_MOTOR = 1;

    const OBJECT_TYPE_BUILDING = 2;

    const OBJECT_TYPE_NON_BUSINESS_ITEM = 3;

    const OBJECT_TYPE_BUSINESS_ITEM = 4;

    const OBJECT_TYPE_LIFE_OR_PERSON = 5;

    const OBJECT_TPE_LIFESTYLE = 7;

    const OBJECT_TYPE_SPORTS = 8;

    const OBJECT_TYPE_TRAVEL = 9;

    const OBJECT_TYPE_BUSINESS = 11;

    const OBJECT_TYPE_OTHERS = 100;

    const OBJECT_STATUS_PROCESSING = 1;

    const OBJECT_STATUS_PROCESSED_LOCKED = 2;

    public function getObjectBrokerId($id)
    {
        $em = $this->entityManager;
        $object = $em->find("Object\Entity\Object", $id);
        $customerBrokerId = $object->getCustomer()
            ->getCustomerBroker()
            ->getBroker()
            ->getId();
        return $customerBrokerId;
    }

    public function hydrateObject($objectEntity)
    {
        // generate pre-event here
        $em = $this->entityManager;
        // $objectBrokerEntity = $this->objectBrokerEntity;
        $objectEntity->setCreatedOn(new \DateTime());
        $objectEntity->setObjectUid($this->generateObjectUid());
        $objectEntity->setObjectStatus($em->find("Object\Entity\ObjectStatus", ObjectService::OBJECT_STATUS_PROCESSING));
        $objectEntity->setIsHidden(false);
        $objectEntity->setValueLocked(false);
        $objectEntity->setObjectValue($this->cusrrencyService->cleanInputedValue($objectEntity->getObjectValue()));
        $objectBroker = new ObjectBroker();
        $objectBroker->setBroker($em->find("Users\Entity\InsuranceBrokerRegistered", $this->generalServie->getCentralBroker()));
        $objectBroker->setObject($objectEntity);

        try {
            $em->persist($objectBroker);
            $em->persist($objectEntity);
            $em->flush();
            // var_dump($objectEntity);
            return $objectEntity->getId();
        } catch (\Exception $e) {
            echo "Something went wrong ";
        }
    }

    /**
     *
     * @param object $data
     * @param ObjectBusinessEquipment $entity
     */
    public function completeBusinessItemInfo($data, $entity)
    {
        $em = $this->entityManager;
        
// var_dump($data);
        $entity->setEquipmentDesc($data->getEquipmentDesc())
            ->setEquipmentUid($data->getEquipmentUid())
            ->setItemNo($data->getItemNo())
            ->setItemNo($data->getItemNo())
            ->setMake($data->getMake())
            ->setPurchaseDate($data->getPurchaseDate())
            ->setPurchaseValue($em->find("Settings\Entity\EquipmentPurchaseValue", $data->getPurchaseValue()))
            ->setRegNo($data->getRegNo())
            ->setUpdatedOn(new \DateTime())
            ->setYearManufacture($data->getYearManufacture());

//            $em->persist($entity); 
        return $entity;
    }

    /**
     * This function provides a means for the hydration/completion
     * of the object Motor provided th
     *
     * @param object $data
     * @param ObjectMotorData $entity
     * @return object $entity
     */
    public function completeMotorInfo($data, $entity)
    {
        // $entity = new ObjectMotorData();
        $em = $this->entityManager;

        $entity->setChasisNumber($data->getChasisNumber())
            ->setDateCreated(new \DateTime())
            ->setDateUpdated(new \DateTime())
            ->setEngineNumber($data->getEngineNumber())
            ->setMakeYear($data->getMakeYear())
            ->setMotorModel($data->getMotorModel())
            ->setMotorNumber($data->getMotorNumber())
            ->setMotorType($em->find("Settings\Entity\MotorType", $data->getMotorType()))
            ->setMotorValueType($em->find("Settings\Entity\VehicleValueType", $data->getMotorValueType()))
            ->setNumberOfSeats($data->getNumberOfSeats())
            ->setYearOfManu($data->getYearOfManu());
        $em->persist($entity);
        return $entity;
    }

    /**
     *
     * @param object $data
     * @param ObjectBuildingData $entity
     * @return object
     */
    public function completeBuildingInfo($data, $entity)
    {
        $em = $this->entityManager;
        // var_dump("GTRRR");
        // try{
        // var_dump("WERE");
        // var_dump($data);
        // $entity = new ObjectBuildingData();
        $entity->setBuildingType($em->find("Settings\Entity\BuildingType", $data->getBuildingType()))
            ->setCity($data->getCity())
            ->setCountry($em->find("Settings\Entity\Country", $data->getCountry()))
            ->setFloorArea($data->getFloorArea())
            ->setHouseAdd1($data->getHouseAdd1())
            ->setHouseAdd2($data->getHouseAdd2())
            ->setHouseDescription($data->getHouseDescription())
            ->setIsFireAlarmSystem($data->getIsFireAlarmSystem())
            ->setIsFireProtectionSystem($data->getIsFireProtectionSystem())
            ->setIsIntruderAlarmSystem($data->getIsIntruderAlarmSystem())
            ->setNoOfRooms($data->getNoOfRooms())
            ->setNoOfStoreys($data->getNoOfStoreys())
            ->setRoofType($em->find("Settings\Entity\BuildingRoofType", $data->getRoofType()))
            ->setState($em->find("Settings\Entity\Zone", $data->getState()))
            ->setWallType($em->find("Settings\Entity\BuildingWallType", $data->getWallType()));
        // var_dump("WEQ");

        $em->persist($entity);
        return $entity;
        // }catch (\Exception $e){
        // var_dump($e->getMessage());
        // }
    }

    /**
     *
     * @param object $data
     * @param ObjectPersonData $entity
     */
    public function completeLifeInfo($data, $entity)
    {
        $em = $this->entityManager;

        $entity->setCreatedOn(new \DateTime())
            ->setUpdatedOn(new \DateTime())
            ->setAddress($data->getAddress())
            ->setAge($data->getAge())
            ->setBvn($data->getBvn())
            ->setCityId($em->find("Settings\Entity\Zone", $data->getCityId()))
            ->setCommunicationMethod($data->getCommunicationMethod())
            ->setCountryId($em->find("Settings\Entity\Country", $data->getCountryId()))
            ->setFirstname($data->getFirstname())
            ->setIsMarried($data->getIsMarried())
            ->setIsNigerian($data->getIsNigerian())
            ->setLastname($data->getLastname())
            ->setMaidenName($data->getMaidenName())
            ->setMobileNumber($data->getMobileNumber())
            ->setOthername($data->getOthername())
            ->setSex($em->find("Settings\Entity\Sex", $data->getSex()))
            ->setTitle($em->find("Settings\Entity\Title", $data->getTitle()));

        return $entity;
    }

    public function completeOthersInfo()
    {}

    /**
     *
     * @param object $data
     * @param ObjectTravel $entity
     */
    public function completeObjectTravel($data, $entity)
    {
        $em = $this->entityManager;
        $entity->setAge($data->getAge())
            ->
        // ->setMobileNumber($data->getNumber())
        setPassportDateCreated($data->getPassportDateCreated())
            ->setPassportExpiryDate($data->getPassportExpiryDate())
            ->setPassportName($data->getPassportName())
            ->setTitle($em->find("Settings\Entity\Title", $data->getTitle()))
            ->setPassportNumber($data->getPassportNumber())
            ->setPlaceOfIssue($data->getPlaceOfIssue())
            ->setSex($data->getSex());

        // $em->persist();
        return $entity;
    }

    public function processObjectHydration($objectEntity)
    {
        return $objectEntity;
    }

    public function getBrokerObjects()
    {
        $em = $this->entityManager;
        $data = "";
        return $data;
    }

    public function getObjectEntity()
    {
        return $this->objectEntity;
    }

    public function getObjectSession()
    {
        return $this->objectSession;
    }

    public function getAllBrokerObject()
    {
        $em = $this->entityManager;
        $data = $em->getRepository("Object\Entity\Object")->findObjects($this->centralBrokerId);
        return $data;
    }

    public function generateObjectUid()
    {
        $const = "obj";
        $id = $this->userId;
        $code = \uniqid($const) . $id;
        return $code;
    }

    // public static function staticObjectUid(){
    // $const = "obj";
    // $id = $this->userId;
    // $code = \uniqid($const) . $id;
    // return $code;
    // }
    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }

    public function setAuth($auth)
    {
        $this->auth = $auth;
        return $this;
    }

    public function setUserId($id)
    {
        $this->userId = $id;
        return $this;
    }

    public function setUserRoleId($id)
    {
        $this->userRoleId = $id;
        return $this;
    }

    public function setBrokerId($id)
    {
        $this->brokerId = $id;
        return $this;
    }

    public function setMotherBrokerId($id)
    {
        $this->motherBrokerId = $id;
        return $this;
    }

    public function setObjectBrokerEntity($entity)
    {
        $this->objectBrokerEntity = $entity;
        return $this;
    }

    public function setCurrencyService($xserv)
    {
        $this->cusrrencyService = $xserv;
        return $this;
    }

    public function setGeneralService($xserv)
    {
        $this->generalServie = $xserv;
        return $this;
    }

    public function setObjectSession($sess)
    {
        $this->objectSession = $sess;
        return $this;
    }

    public function setCentralBrokerId($id)
    {
        $this->centralBrokerId = $id;
        return $this;
    }

    public function setObjectEntity($ent)
    {
        $this->objectEntity = $ent;
        return $this;
    }
}