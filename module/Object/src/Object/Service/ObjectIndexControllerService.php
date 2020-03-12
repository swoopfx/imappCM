<?php
namespace Object\Service;

/**
 *
 * @author swoopfx
 *        
 */
class ObjectIndexControllerService
{

    protected $entityManager;

    protected $motorEntity;

    protected $objectEntity;

    protected $objectId;

    protected $userId;

    protected $auth;
    
    protected $redirect;
    
    protected $objectUid;

    public function __construct()
    {}

    public function hydrateSubmittedForm($objectEntity, $otherData, $data)
    {
        try {
//             echo $data['objectFieldset']['objectType'];
//             \var_dump($data);
            
            switch ($data['objectFieldset']['objectType']) {
                case '1':
                case 1:
                   
                    $this->hydrateMotorData($objectEntity, $otherData, $data);
                    break;
                
                case '2':
                case 2:
                    // $this->hydrateHouseData($data['objectFieldset']['objectHouse'], $objectId);
                    break;
                
                case '3':
                    
                    break;
                
                case '4':
                    
                    break;
            }
            
           $this->redirect->toRoute('object/default', array('action'=>'view-all-object'));
        } catch (\Exception $e) {
            echo 'There was an error';
        }
    }

    private function hydrateObject($data)
    {
        
        // $em->persist($this->objectEntity);
        // $em->flush();
        // return $this->objectEntity->getId();
    }
    
    private function setStatus(){
       
    }

    private function hydrateMotorData($objectEntity, $objectMotor, $data)
    {
        //\var_dump($data);
        $em = $this->entityManager;
        $processing = $em->find('Settings\Entity\Status', 6); // processing
        $objectProcessing = $em->getRepository('Object\Entity\ObjectStatus')->findBy(array(
            'objectStatus'=>$processing->getId()
        ));
        
        // $this->objectEntity->setObjectName($data['objectFieldset']['objectName']);
        // $this->objectEntity->setObjectInfo($data['objectFieldset']['objectInfo']);
         $objectEntity->setCreatedOn(new \DateTime());
        // $this->objectEntity->setObjectValue($data['objectFieldset']['objectValue']);
        $objectEntity->setObjectUid($this->objectUid);
        $objectEntity->setIsHidden(False);
        $value = \floatval(\str_replace(',', '', $data['objectFieldset']['objectValue']));
        $objectEntity->setObjectValue($value);
        // $this->objectEntity->setObjectType($em->find('Settings\Entity\ObjectType', $data['objectFieldset']['objectType']));
         $objectEntity->setUser($em->find('CsnUser\Entity\User', $this->userId));
         $objectMotor->setMotorType($em->find('Settings\Entity\MotorType', $data['objectFieldset']['objectMotor']['motorType']));
         $objectMotor->setMotorValueType($em->find('Settings\Entity\VehicleValueType', $data['objectFieldset']['objectMotor']['motorValueType']));
         $objectMotor->setMotorNumber($data['objectFieldset']['objectMotor']['motorNumber']);
        // //$this->motorEntity->setRegistrationNumber($data['objectFieldset']['objectMotor']['registrationNumber']);
        $objectMotor->setEngineNumber($data['objectFieldset']['objectMotor']['engineNumber']);
        $objectMotor->setChasisNumber($data['objectFieldset']['objectMotor']['chasisNumber']);
        $objectMotor->setNumberOfSeats($data['objectFieldset']['objectMotor']['numberOfSeats']);
        $objectEntity->setObjectStatus($em->find('Object\Entity\ObjectStatus', 1)); // processing 
        
        
        $objectEntity->setCurrency($em->find('Settings\Entity\Currency', $data['objectFieldset']['currency']));
        //$this->objectEntity->getObjectMotor()->setObject($this->objectEntity);
        $objectEntity->seValueLocked( FAlSE);
       
        
        $objectEntity->setObjectMotor($objectMotor);
         $objectMotor->setObject($objectEntity);
         $objectMotor->setDateCreated(new \DateTime());
        $em->persist($objectEntity);
        $em->persist($objectMotor);
        $em->flush();
       
        ;
    }

    private function hydrateHouseData($data)
    {}

    private function hydratePersonData($data)
    {}

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        
        return $this;
    }

    public function setMotorEntity($entity)
    {
        $this->motorEntity = $entity;
        
        return $this;
    }

    public function setObjectEntity($entity)
    {
        $this->objectEntity = $entity;
        
        return $this;
    }

    public function setUserId($auth)
    {
        $this->auth = $auth;
        if ($this->auth->hasIdentity()) {
            $this->userId = $this->auth->getIdentity()->getId();
        }
    }
    
    public function setRedirect($redirect){
        $this->redirect = $redirect;
        
        return $this;
    }
    
    public function setObjectUid($serv){
       $this->objectUid = $serv->generateObjectUid();
    }
}

