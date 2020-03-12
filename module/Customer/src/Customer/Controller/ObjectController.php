<?php
namespace Customer\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Object\Service\ObjectService;
use Object\Entity\ObjectMotorData;
use Object\Entity\ObjectBuildingData;
use Object\Entity\ObjectPersonData;
use Object\Entity\ObjectTravel;
use Object\Entity\ObjectBusiness;
use Object\Entity\ObjectBusinessEquipment;
use Object\Entity\ObjectOthers;
use Object\Entity\ObjectNonBusinessEquipment;

/**
 *
 * @author otaba
 *        
 */
class ObjectController extends AbstractActionController
{

    private $entityManager;

    private $customerBoardService;

    private $customerObjectSession;

    private $objectForm;

    private $currencyService;

    private $dropZoneUploadForm;

    private $clientBlobService;

    private $clientGeneralService;

    private $blobService;

    private $uploadForm;

    /**
     */
    public function onDispatch(\Zend\Mvc\MvcEvent $e)
    {
        $response = parent::onDispatch($e);
        $this->customerRedirectPlugin()->totalRedirection();
        $this->layout()->setTemplate('client-layout-board');
        return $response;
    }

    public function indexAction()
    {
        $customerBoardService = $this->customerBoardService;
        $objects = $customerBoardService->customerObjects();
        $view = new ViewModel(array(
            "objects" => $objects
        ));
        return $view;
    }

    public function viewAction()
    {
        $em = $this->entityManager;
        $customerObjectSession = $this->customerObjectSession;
        $uploadForm = $this->uploadForm;
        $uploadForm->setAttributes(array(
            "action" => $this->url()
                ->fromRoute("cus_object/default", array(
                "action" => "upload"
            ))
        ));
        $dropZoneUploadForm = $this->dropZoneUploadForm;
        
        $dropZoneUploadForm->setAttributes(array(
            "action" => $this->url()
                ->fromRoute("cus_object/default", array(
                "action" => "dropzoneupload"
            ))
        ));
        $objectUid = $this->params()->fromRoute("id", NULL);
        if ($objectUid == NULL) {
            $this->flashmessenger()->addErrorMessage("No identifier for this property");
            $this->redirect()->toRoute("cus_object");
        }
        $objectEntity = $em->getRepository("Object\Entity\Object")->findOneBy(array(
            "objectUid" => $objectUid
        ));
        $customerObjectSession->objectId = $objectEntity->getId();
        if ($objectEntity == NULL) {
            $this->flashmessenger()->addErrorMessage("Sorry this unique identifer does not exist for tnis property");
            $this->redirect()->toRoute("cus_object");
        }
        
        $view = new ViewModel(array(
            "objectEntity" => $objectEntity,
            "uploadForm" => $uploadForm,
            "dropZoneForm" => $dropZoneUploadForm
        ));
        return $view;
    }

    public function preCompleteAction()
    {
        $em = $this->entityManager;
        $objectId = $this->params()->fromRoute("id", NULL);
        if ($objectId == NULL) {
            $this->flashmessenger()->addErrorMessage("No identifier available for this property");
            $this->redirect()->toRoute("cus_object");
        }
        
        $customerObjectSession = $this->customerObjectSession;
        $customerObjectSession->objectId = $objectId;
        $this->redirect()->toRoute("cus_object/default", array(
            "action" => "complete"
        ));
        return $this->getResponse()->setContent(NULL);
    }

    public function dropzoneuploadAction()
    {
        $em = $this->entityManager;
        $clientBlobService = $this->blobService;
        $clientBlobService->setCentralBrokerUid($this->clientGeneralService->getBrokerUid());
        $customerObjectSession = $this->customerObjectSession;
        $objectId = $customerObjectSession->objectId;
        $objectEntity = $em->find("Object\Entity\Object", $objectId);
        $request = $this->getRequest();
        if ($request->isPost() || $request->isXmlHttpRequest()) {
            $files = $this->params()->fromFiles('file');
            // var_dump($files[0]);
            $res = $clientBlobService->uploadBlob($files);
            // $this->redirect()->toRoute("home");
            if ($res != False) {
                
                $docEntity = $em->find("GeneralServicer\Entity\Document", $res);
                try {
                    
                    $objectEntity->addDocument($docEntity)->setUpdateOn(new \DateTime());
                    
                    $em->persist($objectEntity);
                    $em->flush();
                } catch (\Exception $e) {}
                // $url = $docEntity->getDocUrl();
                // $docUrl = "<img src='" . $url . "' height=50>";
                // $this->flashmessenger()->addSuccessMessage("Logo Successfully uploaded" . $url); // $this->flashmessenger()->addSuccessMessage("Logo Successfully uploaded");
                // return $this->redirect()->toRoute("cus_object/default", array(
                // "action" => "view", "id"=>$objectEntity->getObjectUid()
                // ));
                // return $this->redirect()->toRoute("dashboard");
                // $responce = new Response(new InnerHtml("#uploaded_doc", $docUrl)) ; // this should be a thumbnail of the uploaded file
            }
        }
        return $this->getResponse()->setContent(NULL);
    }

    public function completeAction()
    {
        $em = $this->entityManager;
        $objectForm = $this->objectForm;
        $uploadForm = $this->uploadForm;
        $uploadForm->setAttributes(array(
            "id" => "frm",
            "action" => $this->url()
                ->fromRoute("cus_object/default", array(
                "action" => "upload"
            ))
        ));
        $uploadForm->get("upload")->setAttributes(array(
            "id" => "btnUpload"
        ));
        // $uploadForm->get("file")->setAttributes(array(
        // "id"=>"btnUpload"
        // ));
        $dropZoneUploadForm = $this->dropZoneUploadForm;
        
        $dropZoneUploadForm->setAttributes(array(
            "action" => $this->url()
                ->fromRoute("cus_object/default", array(
                "action" => "dropzoneupload"
            ))
        ));
        $customerObjectSession = $this->customerObjectSession;
        $clientBlobService = $this->clientBlobService;
        $objectId = $customerObjectSession->objectId;
        $objectEntity = $em->find("Object\Entity\Object", $objectId);
        $objectType = $objectEntity->getObjectType()->getId();
        $objectForm->bind($objectEntity);
        $objectForm->setAttributes(array(
            "method" => "POST",
            "action" => $this->url()
                ->fromRoute("cus_object/default", array(
                "action" => "complete"
            ))
        ));
        $request = $this->getRequest();
        if ($request->isPost()) {
            $post = $request->getPost();
            $objectForm->setData($post);
            // $post["objectFieldset"]["objectMotorData"]["makeYear"]['month'] = 1;
            // var_dump($post["objectFieldset"]["objectMotorData"]["makeYear"]);
            // var_dump(new \DateTime());
            $this->validationGroup($objectForm, $objectType);
            
            // var_dump($post);
            if ($objectForm->isValid()) {
                
                if ($objectType == ObjectService::OBJECT_TYPE_MOTOR) {
                    try {
                        $data = $objectForm->getData();
                        // var_dump($data->getObjectMotor()->getMotorType()->getId());
                        $motorData = $data->getObjectMotor();
                        $motorPost = $post["objectFieldset"]["objectMotor"];
                        $objectEntity->setValueLocked(true)
                            ->setUpdateOn(new \DateTime())
                            ->setValue($this->currencyService->cleanInputedValue($data->getValue()));
                        // $objectEntity->setValueLocked(true)->setUpdateOn(new \DateTime());
                        $motorEntity = new ObjectMotorData();
                        $motorEntity->setDateCreated(new \DateTime())
                            ->setObject($objectEntity)
                            ->setMotorType($em->find("Settings\Entity\MotorType", $motorPost["motorType"]))
                            ->setMotorValueType($em->find("Settings\Entity\VehicleValueType", $motorData->getMotorValueType()
                            ->getId()))
                            ->setMotorModel($motorData->getMotorModel())
                            ->setMakeYear($motorData->getMakeYear())
                            ->setEngineNumber($motorData->getEngineNumber())
                            ->setMotorNumber($motorData->getMotorNumber())
                            ->setChasisNumber($motorData->getChasisNumber())
                            ->setNumberOfSeats($motorData->getNumberOfSeats());
                        
                        $em->persist($motorEntity);
                        $em->persist($objectEntity);
                        
                        /**
                         * Send Email notification to customer
                         */
                        $em->flush();
                        // var_dump("HOT");
                        
                        $this->flashmessenger()->addSuccessMessage("Successfully completed the property information");
                        $this->redirect()->toRoute("cus_object");
                    } catch (\Exception $e) {
                        $this->flashmessenger()->addErrorMessage("There was a problem processing this motor property");
                        // $this->redirect()->toRoute("cus_object/default", array(
                        // "action" => "complete"
                        // ));
                    }
                } elseif ($objectType == ObjectService::OBJECT_TPE_LIFESTYLE) {
                    // process Lifestyle
                } elseif ($objectType == ObjectService::OBJECT_TYPE_BUILDING) {
                    // var_dump("HERE");
                    try {
                        $data = $objectForm->getData();
                        $buildingData = $data->getObjectBuilding();
                        // var_dump($data->getObjectBuilding()->getIsFireProtectionSystem());
                        // var_dump($data->getObjectBuilding()->getIsFireAlarmSystem());
                        // var_dump($data->getObjectBuilding()->getIsIntruderAlarmSystem());
                        // var_dump($buildingData->getHouseDescription());
                        $buildingEntity = new ObjectBuildingData();
                        $buildingPost = $post["objectFieldset"]["objectBuilding"];
                        $objectEntity->setValueLocked(true)
                            ->setUpdateOn(new \DateTime())
                            ->setValue($this->currencyService->cleanInputedValue($data->getValue()));
                        
                        // $buildingEntity
                        
                        $buildingEntity->setState($em->find("Settings\Entity\Zone", $buildingPost["state"]))
                            ->setObject($objectEntity)
                            ->setCountry($em->find("Settings\Entity\Country", $buildingPost["country"]))
                            ->setRoofType($em->find("Settings\Entity\BuildingRoofType", $buildingPost["roofType"]))
                            ->setWallType($em->find("Settings\Entity\BuildingWallType", $buildingPost["wallType"]))
                            ->setHouseDescription($buildingData->getHouseDescription())
                            ->setHouseAdd1($buildingData->getHouseAdd1())
                            ->setHouseAdd2($buildingData->getHouseAdd2())
                            ->setBuildingType($em->find("Settings\Entity\BuildingType", $buildingData->getBuildingType()))
                            ->setCity($buildingData->getCity())
                            ->setNoOfRooms($buildingData->getNoOfRooms())
                            ->setIsFireAlarmSystem($buildingData->getIsFireAlarmSystem())
                            ->setIsFireProtectionSystem($buildingData->getIsFireProtectionSystem())
                            ->setIsIntruderAlarmSystem($buildingData->getIsIntruderAlarmSystem())
                            ->setFloorArea($buildingData->getFloorArea());
                        
                        $em->persist($buildingEntity);
                        $em->persist($objectEntity);
                        
                        $em->flush();
                        
                        $this->flashmessenger()->addSuccessMessage("Successfully Completed Property");
                        $this->redirect()->toRoute("cus_object");
                    } catch (\Exception $e) {
                        $this->flashmessenger()->addErrorMessage("There was a problem processing this building property");
                        $this->redirect()->toRoute("cus_object/default", array(
                            "action" => "complete"
                        ));
                    }
                } elseif ($objectType == ObjectService::OBJECT_TYPE_BUSINESS) {
                    $data = $objectForm->getData();
                    
                    $businessData = $data->getObjectBusiness();
                    $objectEntity->setValueLocked(true)
                        ->setUpdateOn(new \DateTime())
                        ->setValue($this->currencyService->cleanInputedValue($data->getValue()));
                    
                    try {
                        $objectBusinessEntity = new ObjectBusiness();
                        $objectBusinessEntity->setObject($objectEntity)
                            ->setBusinessAddress($businessData->getBusinessAddress())
                            ->setBusinessDesc($businessData->getBusinessDesc())
                            ->setBusinessName($businessData->getBusinessName())
                            ->setBusinessRegNo($businessData->getBusinessRegNo());
                        
                        foreach ($businessData->getBusinessCategory() as $business) {
                            foreach ($business as $bus) {
                                $objectBusinessEntity->addBusinessCategory($bus);
                            }
                        }
                        
                        $em->persist($objectEntity);
                        $em->persist($objectBusinessEntity);
                        $em->flush();
                        
                        $this->flashmessenger()->addSuccessMessage("Successfully completed the business information");
                        $this->redirect()->toRoute("cus_object");
                    } catch (\Exception $e) {
                        $this->flashmessenger()->addErrorMessage("There was a problem completing this business property ");
                        $this->redirect()->toRoute("cus_object/default", array(
                            "action" => "complete"
                        ));
                    }
                } elseif ($objectType == ObjectService::OBJECT_TYPE_BUSINESS_ITEM) {
                    $data = $objectForm->getData();
                    $businesItemData = $data->getBusinessEquipment();
                    // var_dump($businesItemData->getYearManufacture())
                    $objectEntity->setValueLocked(true)
                        ->setUpdateOn(new \DateTime())
                        ->setValue($this->currencyService->cleanInputedValue($data->getValue()));
                    
                    try {
                        $objectBusinessEquipmentEntity = new ObjectBusinessEquipment();
                        $objectBusinessEquipmentEntity->setObject($objectEntity)
                            ->setEquipmentDesc($businesItemData->getEquipmentDesc())
                            ->setEquipmentUid($businesItemData->getEquipmentUid())
                            ->setItemNo($businesItemData->getItemNo())
                            ->setMake($businesItemData->getMake())
                            ->setPurchaseValue($businesItemData->getPurchaseValue())
                            ->setPurchaseDate($businesItemData->getPurchaseDate())
                            ->setRegNo($businesItemData->getRegNo())
                            ->setYearManufacture($businesItemData->getYearManufacture());
                        
                        foreach ($businesItemData->getEquipmentCategory() as $equip) {
                            foreach ($equip as $quip) {
                                $objectBusinessEquipmentEntity->addEquipmentCategory($quip);
                            }
                        }
                        
                        $em->persist($objectBusinessEquipmentEntity);
                        $em->persist($objectEntity);
                        
                        $em->flush();
                        
                        $this->flashmessenger()->addSuccessMessage("Successfully completed business equipment ");
                        $this->redirect()->toRoute("cus_object");
                    } catch (\Exception $e) {
                        $this->flashmessenger()->addErrorMessage("There was a problem updating your business Equipment information");
                        $this->redirect()->toRoute("cus_object");
                    }
                } elseif ($objectType == ObjectService::OBJECT_TYPE_LIFE_OR_PERSON) {
                    try {
                        $data = $objectForm->getData();
                        $personData = $data->getObjectLife();
                        
                        $objectBusinessEntity = new ObjectBusiness();
                        // var_dump($personData->getOccupation());
                        
                        $objectEntity->setValueLocked(true)
                            ->setUpdateOn(new \DateTime())
                            ->setValue($this->currencyService->cleanInputedValue($data->getValue()));
                        
                        $personData = $data->getObjectLife();
                        $objectLifeEntity = new ObjectPersonData();
                        $objectLifeEntity->setTitle($personData->getTitle())
                            ->setObject($objectEntity)
                            ->setAddress($personData->getAddress())
                            ->setAge($personData->getAge())
                            ->setCityId($personData->getCityId())
                            ->setCountryId($personData->getCountryId())
                            ->setFirstname($personData->getFirstName())
                            ->setLastname($personData->getLastName())
                            ->setIsMarried($personData->getIsMarried())
                            ->setMaidenName($personData->getMaidenName())
                            ->setMobileNumber($personData->getMobileNumber())
                            ->setOthername($personData->getOthername())
                            ->setSex($personData->getSex())
                            ->setOccupationPost($personData->getOccupationPost());
                        
                        foreach ($personData->getOccupation() as $occupation) {
                            foreach ($occupation as $oo) {
                                $objectLifeEntity->addOccupation($oo);
                            }
                        }
                        
                        $em->persist($objectLifeEntity);
                        $em->persist($objectEntity);
                        
                        $em->flush();
                        $this->flashmessenger()->addSuccessMessage("Successfully completed property information");
                        $this->redirect()->toRoute("cus_object");
                    } catch (\Exception $e) {
                        $this->flashmessenger()->addErrorMessage("There was a problem processing this Bio Data");
                        $this->redirect()->toRoute("cus_object/default", array(
                            "action" => "complete"
                        ));
                    }
                } elseif ($objectType == ObjectService::OBJECT_TYPE_NON_BUSINESS_ITEM) {
                    $data = $objectForm->getData();
                    var_dump($objectForm->getData()->getEquipmentUid());
                    $nonBusinessData = $data->getObjectNonBusinessEquipment();
                    
                    $objectEntity->setValueLocked(true)
                        ->setUpdateOn(new \DateTime())
                        ->setValue($this->currencyService->cleanInputedValue($data->getValue()));
                    
                    try {
                        
                        $nonBusinessEntity = new ObjectNonBusinessEquipment();
                        $nonBusinessEntity->setCreatedOn(new \DateTime())
                            ->setEquipmentDesc($nonBusinessData->getEquipmentDesc())
                            ->setEquipmentName($nonBusinessData->getEquipmentName())
                            ->setEquipmentUid($nonBusinessData->getEquipmentUid())
                            ->setObject($objectEntity);
                        
                        foreach ($nonBusinessEntity->getEquipmentCategory() as $equip) {
                            foreach ($equip as $quip) {
                                $nonBusinessEntity->addEquipmentCategory($quip);
                            }
                        }
                        $em->persist($objectEntity);
                        $em->persist($nonBusinessEntity);
                        
                        $em->flush();
                        
                        $this->flashmessenger()->addSuccessMessage("Successfully completed the property information");
                    } catch (\Exception $e) {
                        $this->flashmessenger()->addErrorMessage("There was a problem completing the information");
                        $this->redirect()->toRoute("cus_object/default", array(
                            "action" => "complete"
                        ));
                    }
                } elseif ($objectType == ObjectService::OBJECT_TYPE_OTHERS) {
                    $data = $objectForm->getData();
                    $othersData = $data->getObjectOthers();
                    // var_dump($othersData->getObjectType());
                    $objectEntity->setValueLocked(true)
                        ->setUpdateOn(new \DateTime())
                        ->setValue($this->currencyService->cleanInputedValue($data->getValue()));
                    try {
                        $objectOthersEntity = new ObjectOthers();
                        $objectOthersEntity->setObject($objectEntity)
                            ->setDescription($othersData->getDescription())
                            ->setInfoDefnition1($othersData->getInfoDefnition1())
                            ->setInfoDefnition2($othersData->getInfoDefnition2())
                            ->setInfoDefnition3($othersData->getInfoDefnition3())
                            ->setInfoDefnition4($othersData->getInfoDefnition4())
                            ->setInfoDefnition5($othersData->getInfoDefnition5())
                            ->setInformation1($othersData->getInformation1())
                            ->setInformation2($othersData->getInformation2())
                            ->setInformation3($othersData->getInformation3())
                            ->setInformation4($othersData->getInformation4())
                            ->setInformation5($othersData->getInformation5())
                            ->setName($othersData->getName())
                            ->setObjectType($othersData->getObjectType());
                        
                        $em->persist($objectEntity);
                        $em->persist($objectOthersEntity);
                        
                        $em->flush();
                        
                        $this->flashmessenger()->addSuccessMessage("Successfully completed the information");
                        $this->redirect()->toRoute("cus_object");
                    } catch (\Exception $e) {}
                    // process others
                } elseif ($objectType == ObjectService::OBJECT_TYPE_SPORTS) {
                    // process sports
                } elseif ($objectType == ObjectService::OBJECT_TYPE_TRAVEL) {
                    $data = $objectForm->getData();
                    try {
                        $travelData = $data->getObjectTravel();
                        
                        $objectEntity->setValueLocked(true)
                            ->setUpdateOn(new \DateTime())
                            ->setValue($this->currencyService->cleanInputedValue($data->getValue()));
                        
                        $objectTravelEntity = new ObjectTravel();
                        // var_dump("HI");
                        $objectTravelEntity->setObject($objectEntity)
                            ->setPassportName($travelData->getPassportName())
                            ->setPassportDateCreated($travelData->getPassPortDateCreated())
                            ->setPassportNumber($travelData->getPassportNumber())
                            ->setPassportExpiryDate($travelData->getPassportExpiryDate())
                            ->setPlaceOfIssue($travelData->getPlaceOfIssue())
                            ->setTitle($travelData->getTitle())
                            ->setSex($travelData->getSex())
                            ->setAge($travelData->getAge());
                        
                        // var_dump("LOW");
                        
                        $em->persist($objectTravelEntity);
                        $em->persist($objectEntity);
                        
                        $em->flush();
                        
                        $this->flashmessenger()->addSuccessMessage("The travel documents was successfully updated");
                        $this->redirect()->toRoute("cus_object");
                    } catch (\Exception $e) {
                        
                        $this->flashmessenger()->addErrorMessage("There was a problem processing this travel documents");
                        $this->redirect()->toRoute("cus_object/default", array(
                            "action" => "complete"
                        ));
                    }
                }
            }
            // else{
            // $this->flashmessenger()->addErrorMessage("Invalid form submitted");
            // $this->redirect()->toRoute("cus_object/default", array("action"=>"complete"));
            // }
        
        /**
         * if it is complete
         * lock the value of the property
         */
        }
        $view = new ViewModel(array(
            "objectEntity" => $objectEntity,
            "objectForm" => $objectForm,
            "dropZoneForm" => $dropZoneUploadForm,
            "uploadForm" => $uploadForm
        ));
        return $view;
    }

    public function uploadAction()
    {
        $em = $this->entityManager;
        $clientBlobService = $this->blobService;
        $clientBlobService->setCentralBrokerUid($this->clientGeneralService->getBrokerUid());
        $customerObjectSession = $this->customerObjectSession;
        $objectId = $customerObjectSession->objectId;
        $objectEntity = $em->find("Object\Entity\Object", $objectId);
        $request = $this->getRequest();
        if ($request->isPost() || $request->isXmlHttpRequest()) {
            $files = $this->params()->fromFiles('file');
            // var_dump($files[0]);
            $res = $this->blobService->uploadBlob($files[0]);
            // $this->redirect()->toRoute("home");
            if ($res != False) {
                
                $docEntity = $em->find("GeneralServicer\Entity\Document", $res);
                try {
                    
                    $objectEntity->addDocument($docEntity)->setUpdateOn(new \DateTime());
                    
                    $em->persist($objectEntity);
                    $em->flush();
                } catch (\Exception $e) {}
                // $url = $docEntity->getDocUrl();
                // $docUrl = "<img src='" . $url . "' height=50>";
                // $this->flashmessenger()->addSuccessMessage("Logo Successfully uploaded" . $url); // $this->flashmessenger()->addSuccessMessage("Logo Successfully uploaded");
                // return $this->redirect()->toRoute("cus_object/default", array(
                // "action" => "view", "id"=>$objectEntity->getObjectUid()
                // ));
                // return $this->redirect()->toRoute("dashboard");
                // $responce = new Response(new InnerHtml("#uploaded_doc", $docUrl)) ; // this should be a thumbnail of the uploaded file
            }
        }
        return $this->getResponse()->setContent(NULL);
    }

    private function validationGroup($form, $objectType)
    {
        if ($objectType == ObjectService::OBJECT_TYPE_MOTOR) {
            return $form->setValidationGroup(array(
                // "csrf",
                "objectFieldset" => array(
                    "objectName",
                    "currency",
                    "value",
                    "objectMotor" => array(
                        "motorType",
                        "motorModel",
                        "makeYear",
                        "motorValueType",
                        "engineNumber",
                        "motorNumber",
                        "chasisNumber",
                        "numberOfSeats"
                    
                    )
                )
            ));
        } elseif ($objectType == ObjectService::OBJECT_TYPE_BUILDING) {
            return $form->setValidationGroup(array(
                // "csrf",
                "objectFieldset" => array(
                    "objectName",
                    "currency",
                    "value",
                    "objectBuilding" => array(
                        "houseAdd1",
                        "houseAdd2",
                        "houseDescription",
                        "noOfRooms",
                        "city",
                        "country",
                        "state",
                        "wallType",
                        "roofType",
                        "floorArea",
                        "buildingType",
                        "isIntruderAlarmSystem",
                        "isFireAlarmSystem",
                        "isFireProtectionSystem"
                    
                    )
                )
            ));
        } elseif ($objectType == ObjectService::OBJECT_TYPE_TRAVEL) {
            return $form->setValidationGroup(array(
                // "csrf",
                "objectFieldset" => array(
                    "objectName",
                    "currency",
                    "value",
                    "objectTravel" => array(
                        "passportName",
                        "title",
                        "sex",
                        "placeOfIssue",
                        "age",
                        "passportDateCreated",
                        "passportExpiryDate",
                        "passportNumber"
                    
                    )
                
                )
            ));
        } elseif ($objectType == ObjectService::OBJECT_TYPE_LIFE_OR_PERSON) {
            return $form->setValidationGroup(array(
                // "csrf",
                "objectFieldset" => array(
                    "objectName",
                    "currency",
                    "value",
                    "objectLife" => array(
                        "title",
                        "firstname",
                        "lastname",
                        "othername",
                        "mobileNumber",
                        "isMarried",
                        "maidenName",
                        "sex",
                        "age",
                        "address",
                        "countryId",
                        "cityId",
                        "occupation",
                        "occupationPost"
                    )
                )
            ));
        } elseif ($objectType == ObjectService::OBJECT_TYPE_BUSINESS) {
            return $form->setValidationGroup(array(
                // "csrf",
                "objectFieldset" => array(
                    "objectName",
                    "currency",
                    "value",
                    "objectBusiness" => array(
                        "businessName",
                        "businessDesc",
                        "businessCategory",
                        "businessRegNo",
                        "businessAddress"
                    )
                )
            ));
        } elseif ($objectType == ObjectService::OBJECT_TYPE_BUSINESS_ITEM) {
            return $form->setValidationGroup(array(
                // "csrf",
                "objectFieldset" => array(
                    "objectName",
                    "currency",
                    "value",
                    "businessEquipment" => array(
                        "equipmentCategory",
                        "equipmentDesc",
                        // "equipmentUid",
                        "itemNo",
                        "make",
                        "regNo",
                        "yearManufacture",
                        "purchaseDate",
                        "purchaseValue"
                    )
                )
            ));
        } elseif ($objectType == ObjectService::OBJECT_TYPE_OTHERS) {
            return $form->setValidationGroup(array(
                // "csrf",
                "objectFieldset" => array(
                    "objectName",
                    "currency",
                    "value",
                    "objectOthers" => array(
                        "name",
                        "objectType",
                        "description",
                        "infoDefnition1",
                        "information1",
                        "infoDefnition2",
                        "information2",
                        "infoDefnition3",
                        "information3",
                        "infoDefnition4",
                        "information4",
                        "infoDefnition5",
                        "information5"
                    
                    )
                )
            ));
        } elseif ($objectType == ObjectService::OBJECT_TYPE_NON_BUSINESS_ITEM) {
            return $form->setValidationGroup(array(
                // "csrf",
                "objectFieldset" => array(
                    "objectName",
                    "currency",
                    "value",
                    "objectNonBusinessEquipment" => array(
                        "equipmentCategory",
                        "equipmentName",
                        "equipmentDesc",
                        "equipmentUid"
                    )
                )
            ));
        }
    /**
     * Get if the post object category is motor
     * hence validate object form
     *
     * else if it is building
     * Validatie building infor
     * etc
     *
     * then return The form
     */
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }

    public function setCustomerBoardService($xserv)
    {
        $this->customerBoardService = $xserv;
        return $this;
    }

    public function setCustomerObjectSession($sess)
    {
        $this->customerObjectSession = $sess;
        return $this;
    }

    public function setObjectForm($form)
    {
        $this->objectForm = $form;
        return $this;
    }

    public function setCurrencyService($xserv)
    {
        $this->currencyService = $xserv;
        return $this;
    }

    public function setDropZoneUploadForm($form)
    {
        $this->dropZoneUploadForm = $form;
        return $this;
    }

    public function setClientBlobService($xserv)
    {
        $this->clientBlobService = $xserv;
        return $this;
    }

    public function setUploadForm($form)
    {
        $this->uploadForm = $form;
        return $this;
    }

    public function setBlobService($xserv)
    {
        $this->blobService = $xserv;
        return $this;
    }

    public function setCLientGeneralService($xserv)
    {
        $this->clientGeneralService = $xserv;
        return $this;
    }
}

