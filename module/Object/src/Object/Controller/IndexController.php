<?php
namespace Object\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Object\Entity\Object;
use Object\Service\ObjectService;
use Zend\Session\Container;
use WasabiLib\Ajax\Response;
use WasabiLib\Modal\WasabiModalView;
use WasabiLib\Modal\WasabiModal;
use WasabiLib\Modal\Info;
use WasabiLib\Ajax\Redirect;
use Object\Entity\ObjectMotorData;
use Object\Entity\ObjectBuildingData;
use Object\Entity\ObjectPersonData;
use WasabiLib\Ajax\GritterMessage;
use WasabiLib\Modal\Dialog;
use WasabiLib\Modal\Button;
use Object\Entity\ObjectOthers;
use Object\Form\ObjectOthersForm;
use Object\Entity\ObjectTravel;
use Object\Form\ObjectTravelForm;
use Doctrine\ORM\EntityManager;
use Object\Entity\ObjectBusiness;
use Object\Form\ObjectBusinessForm;
use Object\Entity\ObjectBusinessEquipment;
use Object\Form\ObjectLifeForm;
use Object\Form\ObjectBusinessItemForm;

class IndexController extends AbstractActionController
{

    /**
     *
     * @var EntityManager
     */
    private $entityManager;

    private $options;

    private $objectForm;

    /**
     *
     * @var ObjectService
     */
    private $objectService;

    private $usersService;

    private $objectEntity;

    private $centralBrokerId;

    private $dropZoneForm;

    private $uploadForm;

    private $blobService;

    private $renderer;

    // Inner Form
    private $objectMotorForm;

    private $objectBuildingForm;

    /**
     *
     * @var ObjectLifeForm
     */
    private $objectLifeForm;

    private $objectLifeStyleForm;

    private $objectNonBusinessItemForm;

    /**
     *
     * @var ObjectBusinessItemForm
     */
    private $objectBusinessItemForm;

    /**
     *
     * @var ObjectTravelForm
     */
    private $objectTravelForm;

    /**
     *
     * @var ObjectBusinessForm
     */
    private $objectBusinessForm;

    /**
     *
     * @var ObjectOthersForm
     */
    private $objectOthersForm;

    private $objectSportsForm;

    private function noAuthoriaton($id)
    {
        $objectService = $this->objectService;
        if ($objectService->getObjectBrokerId($id) != $this->centralBrokerId) {
            $this->flashmessenger()->addErrorMessage("You are not authorized to view this page ");
            $this->redirect()->toRoute();
        }
    }

    public function onDispatch(\Zend\Mvc\MvcEvent $e)
    {
        $response = parent::onDispatch($e);
        // $response = parent::on
        $this->redirectPlugin()->redirectCondition();
        return $response;
    }

    // Begin Modal
    /**
     *
     * @return mixed
     */
    public function completemodalAction()
    {
        $em = $this->entityManager;
        $response = new Response();
        $objectService = $this->objectService;
        $objectSession = $objectService->getObjectSession();
        $objectForm = $this->objectForm;
        // $objectViewSession = new Container("object_view_session");

        /**
         *
         * @var Object $objectEntity
         */
        $objectEntity = $em->find("Object\Entity\Object", $objectSession->objectId);
        $objectMotorEntity = NULL;
        $objectMotorForm = $this->objectMotorForm;
        $objectBuildingForm = $this->objectBuildingForm;
        $objectLifeForm = $this->objectLifeForm;
        $gritter = new GritterMessage();
        $template = "";
        $var = "";
        $request = $this->getRequest();
        
        
        // Form generation
        if ($objectEntity->getObjectType()->getId() == ObjectService::OBJECT_TYPE_MOTOR) {
            $objectMotorEntity = $objectEntity->getObjectMotor();
            if ($objectMotorEntity == NULL) {
                $objectMotorEntity = new ObjectMotorData();
            }

            // Submition processing
            if ($request->isPost()) {
                $post = $request->getPost();

                // Process Motor form
                $objectMotorForm->setData($post);
                $objectMotorForm->setValidationGroup(array(
                    "csrf",
                    "objectMotorFieldset" => array(
                        "motorModel",
                        "motorType",
                        "makeYear",
                        "motorValueType",
                        "motorNumber",
                        "engineNumber",
                        "chasisNumber",
                        "numberOfSeats"
                    )
                ));

                if ($objectMotorForm->isValid()) {
                    $data = $objectMotorForm->getData();
                    $objectEntity->setUpdateOn(new \DateTime())->setValueLocked(TRUE);
                    $objectMotorEntity->setObject($objectEntity);
                    $objectMotorEntity = $objectService->completeMotorInfo($data, $objectMotorEntity);

                    try {
                        $em->persist($objectEntity);
                        $em->persist($objectMotorEntity);
                        $em->flush();
                        $this->flashmessenger()->addSuccessMessage("Successfullty Completed info");
                        $redirect = new Redirect("/object/view");
                        $response = new Response();
                        $response->add($redirect);
                        return $this->getResponse()->setContent($response);
                    } catch (\Exception $e) {
                        $gritter->setTitle("Error!!");
                        $gritter->setText("Error : System could not complete property information");
                        $gritter->setType(GritterMessage::TYPE_ERROR);

                        $response->add($gritter);
                    }
                }
            }

            $objectMotorForm->setAttributes(array(
                "action" => $this->url()
                    ->fromRoute("object/default", array(
                    "action" => "completemodal"
                )),
                "id" => "simpleForm",
                "class" => "form-horizontal form-label-left ajax_element",
                "data-ajax-loader" => "myLoader"
            ));
            $objectMotorForm->bind($objectMotorEntity);
            $template = "object-modal-motor-form-snippet";
            $var = array(
                "objectMotorForm" => $objectMotorForm
            );
        } elseif ($objectEntity->getObjectType()->getId() == ObjectService::OBJECT_TYPE_BUILDING) {
            // TODO - Building Not fully processed
            
            $objectBuildingEntity = $objectEntity->getObjectBuilding();
            if ($objectBuildingEntity == NULL) {
                $objectBuildingEntity = new ObjectBuildingData();
            }

            if ($request->isPost()) {
                $post = $request->getPost();
                $objectBuildingForm->setData($post);
                $objectBuildingForm->setValidationGroup(array(
                    "csrf",
                    "objectBuildingFieldset" => array(
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
                ));
                if ($objectBuildingForm->isValid()) {
                    
                    $data = $objectBuildingForm->getData();
//                    
                    $objectBuildingEntity = $objectService->completeBuildingInfo($data, $objectBuildingEntity);
//                    
                    $objectBuildingEntity->setObject($objectEntity);
                    $objectEntity->setUpdateOn(new \DateTime())->setValueLocked(TRUE);
                    try {
                        
                        $em->persist($objectEntity);
                        $em->persist($objectBuildingEntity);
                        $em->flush();
                        $this->flashmessenger()->addSuccessMessage("Successfullty Completed info");
                        $redirect = new Redirect("/object/view");

                        $response->add($redirect);
                        return $this->getResponse()->setContent($response);
                    } catch (\Exception $e) {}
                }
            }
            $objectBuildingForm->setAttributes(array(
                "action" => $this->url()
                    ->fromRoute("object/default", array(
                    "action" => "completemodal"
                )),
                "id" => "simpleForm",
                "class" => "form-horizontal form-label-left ajax_element",
                "data-ajax-loader" => "myLoader"
            ));

            // $objectBuildingForm->setAttributes(array(
            // "id" => "simpleForm",
            // "action"=>$this->url()->fromRoute("object/default", array("action"=>"completemodal"))
            // ));

            $objectBuildingForm->bind($objectBuildingEntity);
            $template = "object-modal-building-form-snippet";
            $var = array(
                "objectBuildingForm" => $objectBuildingForm
            );
        } elseif ($objectEntity->getObjectType()->getId() == ObjectService::OBJECT_TYPE_LIFE_OR_PERSON) {
            $objectLifeEntity = $objectEntity->getObjectLife();

            $objectLifeForm = $this->objectLifeForm; // reference to objectPersonForm
                                                     // $objectLifeForm->setA
            if ($objectLifeEntity == NULL) {
                $objectLifeEntity = new ObjectPersonData();
            }

            if ($request->isPost()) {
                $post = $this->params()->fromPost();
                $objectLifeForm->setData($post);
                $objectLifeForm->setValidationGroup(array(
                    "objectLifeFieldset" => array(
                        "title",
                        "firstname",
                        "lastname",
                        "othername",
                        "mobileNumber",
                        "isMarried",
                        "maidenName",
                        "sex",
                        "age",
                        "isNigerian",
                        "address",
                        "countryId",
                        "cityId",
                        "bvn",
                        "communicationMethod"
                    )
                ));
                if ($objectLifeForm->isValid()) {
                    $data = $objectLifeForm->getData();
                    try {
                        $objectLifeEntity = $this->objectService->completeLifeInfo($data, $objectLifeEntity);
                        $objectLifeEntity->setObject($objectEntity);
                        $objectEntity->setUpdateOn(new \DateTime())->setValueLocked(TRUE);
                        $em->persist($objectLifeEntity);
                        $em->flush();

                        $gritter->setTitle("Complete");
                        $gritter->setText("Updated the life information");
                        $gritter->setType(GritterMessage::TYPE_SUCCESS);

                        $response->add($gritter);
                        $this->flashMessenger()->addSuccessMessage("Updated the life information");
                        $redirect = new Redirect($this->url()->fromRoute("object/default", array(
                            "action" => "view"
                        )));

                        $response->add($redirect);
                        return $this->getResponse()->setContent($response);
                    } catch (\Exception $e) {
                        $gritter->setTitle("Error");
                        $gritter->setText("Error updating ife information");
                        $gritter->setType(GritterMessage::TYPE_ERROR);

                        $response->add($gritter);
                        return $this->getResponse()->setContent($response);
                    }
                } else {
                    $gritter->setTitle("Validation Error");
                    $gritter->setText("Form filled does not meet minimum validation requirements");
                    $gritter->setType(GritterMessage::TYPE_ERROR);
                    $response->add($gritter);
                    return $this->getResponse()->setContent($response);
                }
            }
            $objectLifeForm->bind($objectLifeEntity);
            $objectLifeForm->setAttributes(array(
                "action" => $this->url()
                    ->fromRoute("object/default", array(
                    "action" => "completemodal"
                )),
                "id" => "simpleForm",
                "class" => "form-horizontal form-label-left ajax_element",
                "data-ajax-loader" => "myLoader"
            ));
            // $objectLifeForm->bind($objectLifeEntity);
            $template = "object-modal-life-form-snippet";
            $var = array(
                "objectLifeForm" => $objectLifeForm
            );
        } elseif ($objectEntity->getObjectType()->getId() == ObjectService::OBJECT_TYPE_BUSINESS) {
            var_dump("HEY");
            $objectBusinessForm = $this->objectBusinessForm;
            
            $objectBusinessEntity = $objectEntity->getObjectBusiness();
            if ($objectBusinessEntity == NULL) {
                $objectBusinessEntity = new ObjectBusiness();
            }
            $objectBusinessForm->bind($objectBusinessEntity);
            $objectBusinessForm->setAttributes(array(
                "action" => $this->url()
                ->fromRoute("object/default", array(
                    "action" => "completemodal"
                )),
                "id" => "simpleForm",
                "class" => "form-horizontal form-label-left ajax_element",
                "data-ajax-loader" => "myLoader"
            ));
            // $objectLifeForm->bind($objectLifeEntity);
            $template = "object-modal-business-form-snippet";
            $var = array(
                "objectBusinessForm" => $objectBusinessForm
            );
        } elseif ($objectEntity->getObjectType()->getId() == ObjectService::OBJECT_TYPE_BUSINESS_ITEM) {
            $objectBusinessItemForm = $this->objectBusinessItemForm;
            $objectBusinessItemEntity = $objectEntity->getBusinessEquipment();
            if ($objectBusinessItemEntity == NULL) {
                $objectBusinessItemEntity = new ObjectBusinessEquipment();
            }
            if ($request->isPost()) {
                $post = $this->params()->fromPost();
                $objectBusinessItemForm->setData($post);
                $objectBusinessItemForm->setValidationGroup(array(
                    "objectBusinessItemFieldset"=>array(
                        "equipmentCategory",
                        "equipmentDesc",
                        "itemNo",
                        "make",
                        "regNo",
                        "yearManufacture",
                        "purchaseDate",
                        "purchaseValue",
                    )
                ));
                if ($objectBusinessItemForm->isValid()) {
                    try {
                        $data = $objectBusinessItemForm->getData();
//                         $entity = $objectBusinessItemEntity;
                        $objectEntity->setValueLocked(TRUE)->setUpdateOn(new \DateTime());
                        $objectBusinessItemEntity = $this->objectService->completeBusinessItemInfo($data, $objectBusinessItemEntity);
//                         var_dump("KIIII");
                        $objectBusinessItemEntity->setObject($objectEntity);
                        
                        foreach ($data->getEquipmentCategory() as $equip) {
                            foreach ($equip as $quip) {
                                $objectBusinessItemEntity->addEquipmentCategory($quip);
                            }
                        }
                        $em->persist($objectBusinessItemEntity);
                        $em->persist($objectEntity);
                        $em->flush();
                        
                        $gritter->setTitle("Success");
                        $gritter->setText("Successfully Updated Business Item");
                        $gritter->setType(GritterMessage::TYPE_ERROR);
                        
                        $response->add($gritter);
                        $this->flashMessenger()->addSuccessMessage("Successfully updated business item");
                        
                        $redirect = new Redirect($this->url()->fromRoute("object\default", array("action"=>"view")));
                        
                        $response->add($redirect);
                        
                    } catch (\Exception $e) {
                        $gritter->setTitle("Hydration Error");
                        $gritter->setText("Error updating equipment information ");
                        $gritter->setType(GritterMessage::TYPE_ERROR);
                        
                        $response->add($gritter);
                    }
                }
            }

            $objectBusinessItemForm->setAttributes(array(
                "action" => $this->url()
                    ->fromRoute("object/default", array(
                    "action" => "completemodal"
                )),
                "id" => "simpleForm",
                "class" => "form-horizontal form-label-left ajax_element",
                "data-ajax-loader" => "myLoader"
            ));
            // $objectLifeForm->bind($objectLifeEntity);
            $template = "object-modal-business-item-form-snippet";
            $var = array(
                "objectBusinessItemForm" => $objectBusinessItemForm
            );
        } elseif ($objectEntity->getObjectType()->getId() == ObjectService::OBJECT_TYPE_NON_BUSINESS_ITEM) {} elseif ($objectEntity->getObjectType()->getId() == ObjectService::OBJECT_TYPE_SPORTS) {} elseif ($objectEntity->getObjectType()->getId() == ObjectService::OBJECT_TYPE_TRAVEL) {
            $objectTravelForm = $this->objectTravelForm;
            $objectTravelEntity = $objectEntity->getObjectTravel();
            if ($objectTravelEntity == NULL) {
                $objectTravelEntity = new ObjectTravel();
            }

            if ($request->isPost()) {
                $post = $request->getPost();
                $objectTravelForm->setData($post);
                $objectTravelForm->setValidationGroup(array(
                    "objectTravelFieldset" => array(
                        "passportName",
                        "title",
                        "sex",
                        "placeOfIssue",
                        "age",
                        "passportDateCreated",
                        "passportExpiryDate",
                        "passportNumber"
                    )
                ));

                if ($objectTravelForm->isValid()) {
                    $data = $objectTravelForm->getData();
                    $objectTravelEntity = $this->objectService->completeObjectTravel($data, $objectTravelEntity);
                    $objectTravelEntity->setObject($objectEntity);
                    $objectEntity->setUpdateOn(new \DateTime())
                        ->setObjectTravel($objectTravelEntity)
                        ->setValueLocked(TRUE);
                    try {
                        $em->persist($objectEntity);
                        $em->persist($objectTravelEntity);

                        $em->flush();
                        $this->flashMessenger()->addSuccessMessage("Success: Completed the property details");
                        $gritter->setTitle("Success");
                        $gritter->setText("Success: Completed the property details");
                        $gritter->setType(GritterMessage::TYPE_SUCCESS);

                        $response->add($gritter);

                        $redirect = new Redirect($this->url()->fromRoute("object/default", array(
                            "action" => "view"
                        )));

                        $response->add($redirect);

                        return $this->getResponse()->setContent($response);
                    } catch (\Exception $e) {
                        $gritter->setTitle("Error");
                        $gritter->setText("Error: Hydration Error, please contact administrator");
                        $gritter->setType(GritterMessage::TYPE_ERROR);

                        $response->add($gritter);
                        return $this->getResponse()->setContent($response);
                    }
                }
            }
            $objectTravelForm->bind($objectTravelEntity);
            $objectTravelForm->setAttributes(array(
                "action" => $this->url()
                    ->fromRoute("object/default", array(
                    "action" => "completemodal"
                )),
                "id" => "simpleForm",
                "class" => "form-horizontal form-label-left ajax_element",
                "data-ajax-loader" => "myLoader"
            ));
            // $objectLifeForm->bind($objectLifeEntity);
            $template = "object-modal-travel-form-snippet";
            $var = array(
                "objectTravelForm" => $objectTravelForm
            );
        } else {
            $objectOthersForm = $this->objectOthersForm;
            if ($request->isPost()) {
                $objectOthersEntity = $objectEntity->getObjectOthers();
                if ($objectOthersEntity == NULL) {
                    $objectOthersEntity = new ObjectOthers();
                    $post = $this->params()->fromPost();
                    $objectOthersForm->setData($post);

                    if ($objectOthersForm->isValid()) {
                        $data = $objectOthersForm->getData();
                    }
                }
            }
            $objectOthersForm->setAttributes(array(
                "action" => $this->url()
                    ->fromRoute("object/default", array(
                    "action" => "completemodal"
                )),
                "id" => "simpleForm",
                "class" => "form-horizontal form-label-left ajax_element",
                "data-ajax-loader" => "myLoader"
            ));

            $template = "object-others-snipet-form";
            $var = array(
                "objectothers" => $objectOthersForm
            );
        }
    

        $viewModel = new ViewModel($var);
        $viewModel->setTemplate($template);

        $modal = new WasabiModal("standard", "Property Completetion");
        $modal->setContent($viewModel);

        $modalView = new WasabiModalView("#complete_object", $this->renderer, $modal);

        $response = new Response();
        $response->add($modalView);
        return $this->getResponse()->setContent($response);
    }

    /**
     *
     * @return mixed
     */
    public function editmodalAction()
    {
        $em = $this->entityManager;
        $objectForm = $this->objectForm;
        $response = new Response();
        $objectViewSession = $this->objectService->getObjectSession();
        $objectEntity = $em->find("Object\Entity\Object", $objectViewSession->objectId);
        $objectForm->setAttributes(array(
            "action" => $this->url()
                ->fromRoute("object/default", array(
                "action" => "editmodal"
            )),
            "id" => "simpleForm",
            "class" => "form-horizontal form-label-left ajax_element",
            "data-ajax-loader" => "myLoader"
        ));
        $objectForm->bind($objectEntity);
        $gritter = new GritterMessage();
        $request = $this->getRequest();
        if ($request->isPost()) {
            $post = $request->getPost();
            $objectForm->setData($post);
            $objectForm->setValidationGroup(array(
                "csrf",
                "objectFieldset" => array(
                    "objectName",
                    "value",
                    "currency"
                )
            ));
            if ($objectForm->isValid()) {
                $data = $objectForm->getData();

                $objectEntity->setObjectName($data->getObjectName())
                    ->setUpdateOn(new \DateTime())
                    ->setValue(\floatval(\str_replace(',', '', $data->getValue())))
                    ->setCurrency($em->find("Settings\Entity\Currency", $data->getCurrency()));
                try {

                    $em->persist($objectEntity);
                    $em->flush();
                    $this->flashmessenger()->addSuccessMessage("Successfullty Edited the information");

                    $redirect = new Redirect("/object/view");
                    $gritter->setTitle("Success");
                    $gritter->setText("Property Successfully edited");
                    $gritter->setType(GritterMessage::TYPE_SUCCESS);

                    $response->add($gritter);

                    $response->add($redirect);
                    return $this->getResponse()->setContent($response);
                } catch (\Exception $e) {
                    $this->flashmessenger()->addErrorMessage($e->getMessage());
                }
            }
        }
        $viewModel = new ViewModel(array(
            "objectForm" => $objectForm,
            "objectEntity" => $objectEntity
        ));
        $viewModel->setTemplate("object-modal-form-snippet");
        $modal = new WasabiModal("standard", "Edit Property Basic Info");
        $modal->setContent($viewModel);

        $modalView = new WasabiModalView("#complete_object", $this->renderer, $modal);
        $response = new Response();
        $response->add($modalView);
        return $this->getResponse()->setContent($response);
    }

    public function deleteobjectconfirmmodalAction()
    {
        $response = new Response();
        $id = $this->params()->fromQuery("data", NULL);
        $em = $this->entityManager;
        $objectEnitity = $em->find("Object\Entity\Object", $id);

        $dialog = new Dialog("Dialog", "Are you sure", "This property will be removed from the stack <br> It would not be visible and available to you and the customer", Dialog::TYPE_SUCCESS);
        $cbutton = new Button("Accept");
        $cbutton->setAction($this->url()
            ->fromRoute("object/default", array(
            "action" => "delete",
            "inf" => $objectEnitity->getObjectUid()
        )));

        $dialog->setConfirmButton($cbutton);
        $modalView = new WasabiModalView("#wasabi", $this->renderer, $dialog);
        $response->add($modalView);
        return $this->getResponse()->setContent($response);
    }

    public function deleteAction()
    {
        $response = new Response();
        $em = $this->entityManager;
        /**
         *
         * @var Object $objectEntity
         */
        $objectEntity = NULL;
        $uid = $this->params()->fromRoute("inf", NULL);
        $gritter = new GritterMessage();
        $objectEntity = $em->getRepository("Object\Entity\Object")->findOneBy(array(
            "objectUid" => $uid
        ));
        try {
            $objectEntity->setIsHidden(TRUE)->setUpdateOn(new \DateTime());

            $em->persist($objectEntity);
            $em->flush();

            $gritter->setTitle("Success");
            $gritter->setText("Successfully Deleted Property");
            $gritter->setType(GritterMessage::TYPE_SUCCESS);

            $response->add($gritter);
            $this->flashMessenger()->addSuccessMessage("Successfully Deleted property");
            $redirect = new Redirect($this->url()->fromRoute("object/default", array(
                "action" => "all"
            )));
            $response->add($redirect);
        } catch (\Exception $e) {
            $gritter->setTitle("Error");
            $gritter->setText("Could Not delete property");
            $gritter->setType(GritterMessage::TYPE_ERROR);
            $response->add($gritter);
        }
        return $this->getResponse()->setContent($response);
    }

    // End Modal
    public function allAction()
    {
        // $em = $this->entityManager;
        $objectService = $this->objectService;
        $allobject = $objectService->getAllBrokerObject();
        $view = new ViewModel(array(
            "allObjects" => $allobject
        ));
        return $view;
    }

    private function objectNotMine($customerId)
    {
        $em = $this->entityManager;
        /**
         * if supplied broker attached to the customer Id os not equal to logged in
         * broker then the customer does not belong to the sesion
         */
        $suppliedCustomerbroker = $em->getRepository("Customer\Entity\CustomerBroker")->findOneBy(array(
            "customer" => $customerId
        ));
        if ($suppliedCustomerbroker->getBroker()->getId() != $this->centralBrokerId) {
            $this->flashmessenger()->addErrorMessage("This customer does not belong o you");
            return $this->redirect()->toRoute("customer");
        }
    }

    public function customerObjectAction()
    {
        $em = $this->entityManager;
        $customerId = $this->params()->fromRoute("inf", NULL);

        if ($customerId == NULL) {
            $this->flashmessenger()->addErrorMessage("No identifier available for this property");
            $this->redirect()->toRoute("object");
        }
        $objects = $em->getRepository("Object\Entity\Object")->findBy(array(
            "customer" => $customerId
        ));
        $this->objectNotMine($customerId);
        $objects = $em->getRepository("Object\Entity\Object")->findBy(array(
            "customer" => $customerId
        ));
        $customerEntity = $em->find("Customer\Entity\Customer", $customerId);
        $view = new ViewModel(array(
            "objects" => $objects,
            "customer" => $customerEntity
        ));
        return $view;
    }

    public function indexAction()
    {
        $em = $this->entityManager;
        $objectService = $this->objectService;

        $allobject = $objectService->getAllBrokerObject();
        // var_dump($allobject);
        $view = new ViewModel(array(
            "allObjects" => $allobject
        ));
        return $view;
    }

    public function preCompleteAction()
    {
        $em = $this->entityManager;
        $objectId = $this->params()->fromRoute("inf", NULL);
        if ($objectId == NULL) {
            $this->flashmessenger()->addErrorMessage("Identifier not available for this property");
            $this->redirect()->toRoute("object/default", array(
                "action" => "all"
            ));
        }
        return $this->getResponse()->setContent(NULL);
    }

    /**
     * Use this action to complee the ObjectDetails
     *
     * @return \Zend\View\Model\ViewModel
     */
    public function completeAction()
    {
        $em = $this->entityManager;

        $view = new ViewModel();
        return $view;
    }

    /**
     * This is used to pas the entry point for editing and and processing Properties
     */
    public function preProcessAction()
    {
        $em = $this->entityManager;
        $objectServe = $this->objectService;
        $objectEntity = new Object();
        $objectSession = $objectServe->getObjectSession();
        $id = $this->params()->fromRoute("inf", NULL); // this is the customer ID
        if ($id == NULL) {
            $this->flashmessenger()->addErrorMessage("This customer Identity was not seleted");
            $this->redirect()->toRoute("object");
        }
        // $objectEntity = $em->find("Object\Entity\Object", $id);
        $this->noAuthoriaton($id);
        try {
            $em->persist($objectEntity);
            $em->flush();
            $objectSession->objectId = $objectEntity->getId();
            $this->redirect()->toRoute("object/default", array(
                "action" => "process"
            ));
        } catch (\Exception $e) {
            $this->redirect()->toRoute("object");
        }
        $this->getResponse()->setContent(NULL);
    }

    /**
     * this function gets the objecct id from the registered session
     * Finds the type of object
     * disply the adequate form based on the specific object
     *
     * @return \Zend\View\Model\ViewModel
     */
    public function processAction()
    {
        $em = $this->entityManager;
        $objectService = $this->objectService;
        $objectId = $this->objectService->getObjectSession()->objectId;
        $objectEntity = $em->find("Object\Entity\Object", $objectId);
        $objectForm = "";
        $uploadForm = "";
        $request = $this->getRequest();

        $view = new ViewModel(array(
            "objectForm" => $objectForm
            // "uploadForm" => ""
        ));
        return $view;
    }

    public function newAction()
    {
        $customerData = NULL;
        $em = $this->entityManager;
        $form = $this->objectForm;
        $objectEntity = $this->objectEntity;
        $objectService = $this->objectService;

        $customer = $this->params()->fromRoute('inf', NULL);

        $form->bind($objectEntity);

        if ($customer != NULL) {
            $customerData = $em->find('Customer\Entity\Customer', $customer);
            $form->setAttributes(array(
                'action' => '/object/new/' . $customerData->getId()
            ));
        }
        if ($this->getRequest()->isPost()) {

            $data = $this->getRequest()->getPost();
            $form->setData($data);
            // var_dump($data);
            $this->newObjectValidattion($form, $data);
            if ($form->isValid()) {
                // do hydration here
                if ($objectEntity->getObjectType()->getId() == ObjectService::OBJECT_TYPE_MOTOR) {
                    $objectEntity->getObjectMotor()->setObject($objectEntity);
                }
                $res = $objectService->hydrateObject($objectEntity);
                if ($res != NULL) {
                    $this->redirect()->toRoute('object/default', array(
                        'action' => 'view-object',
                        'inf' => $res
                    ));
                }
            } else {
                echo 'validation error';
            }
        }
        $view = new ViewModel(array(
            'form' => $form,
            'customerData' => $customerData
        ));
        return $view;
    }

    public function createAction()
    {
        $em = $this->entityManager;
        $objectService = - $this->objectService;
        $objectSession = $objectService->getObjectSession();
        $objectEntity = $objectService->getObjectEntity();
        $id = $this->params()->fromRoute("inf", NULL); // This is the customerId
        if ($id == NULL) {
            $this->flashmessenger()->addErrorMessage("An Object must be assigned to a customer");
            $this->redirect()->toRoute("object");
        }

        $objectEntity->setCustomer($em->find("Customer\Entity\Customer", $id))
            ->setCreatedOn(new \DateTime())
            ->setIsHidden(FALSE)
            ->setObjectStatus($em->find("Object\Entity\ObjectStatus", ObjectService::OBJECT_STATUS_PROCESSING))
            ->setObjectUid($objectService->generateObjectUid());
        try {
            $em->persist($objectEntity);
            $em->flush();
            $this->redirect()->toRoute("object/default", array(
                "action" => "pre-process",
                "inf" => $objectEntity->getId()
            ));
        } catch (\Exception $e) {
            $this->flashmessenger()->addErrorMessage("An Error occured while trying to cretae the property");
            $this->redirect()->toRoute("object");
        }
        $this->getResponse()->setContent(NULL);
    }

    private function noCustomerRedirection($customer)
    {
        if ($customer == NULL) {
            $this->redirect()->toRoute("customer/default", array(
                "action" => "all"
            ));
        }
    }

    private function newObjectValidattion($form, $data)
    {
        $group = array();
        $cat = $data['objectFieldset']['objectType'];
        switch ($cat) {
            case ObjectService::OBJECT_TYPE_MOTOR:
                $group = array(
                    'csrf',
                    'objectFieldset' => array(
                        'customer',
                        'objectName',
                        'objectInfo',
                        'objectValue',
                        'currency',
                        'objectType',

                        'objectMotor' => array(
                            'motorType',
                            'motorValueType',
                            'motorNumber',
                            'object',
                            // 'registrationNumber',
                            'engineNumber',
                            'chasisNumber',
                            // 'typeOfBody',
                            // 'yearOfManu',
                            'numberOfSeats'
                        )
                    )
                );
                break;
        }
        $form->setValidationGroup($group);
    }

    public function uploadAction()
    {
        $objectViewSession = $this->objectService->getObjectSession();
        $em = $this->entityManager;

        $request = $this->getRequest();
        if ($request->isPost() || $request->isXmlHttpRequest()) {
            $files = $this->params()->fromFiles('file');

            $res = $this->blobService->uploadBlob($files);

            if ($res != NULL) {
                $objectEntity = $em->find("Object\Entity\Object", $objectViewSession->objectId);
                $objectEntity->addDocument($res)->setUpdateOn(new \DateTime());
                $em->persist($objectEntity);
                $em->persist($res);
                $em->flush();
            }
        }
        return $this->getResponse()->setContent(NULL);
    }

    public function removedocAction()
    {
        $em = $this->entityManager;
        $docId = $this->params()->fromRoute("inf", NULL);
        if ($docId == NULL) {
            $this->flashmessenger()->addErrorMessage("No visible identity  to be remoived");
            $this->redirect()->toRoute("object/default", array(
                "action" => "process"
            ));
        }
        $docEntity = $em->find("GeneralServicer\Entity\Document", $docId);
        $objectViewSession = new Container("object_view_session");
        $objectId = $objectViewSession->objectId;
        $objectEntity = $em->find("Object\Entity\Object", $objectViewSession->objectId);

        try {
            $objectEntity->removeDocument($docEntity)->setUpdateOn(new \DateTime());
            $em->persist($objectEntity);
            $em->flush();
            $this->flashmessenger()->addSuccessMessage("Successfully removed the document"); // $this->flashmessenger()->addSuccessMessage("Logo Successfully uploaded");
            $this->redirect()->toRoute("object/default", array(
                "action" => "view"
            ));
        } catch (\Exception $e) {
            $this->flashmessenger()->addErrorMessage($e->getMessages());
            $this->redirect()->toRoute("object/default", array(
                "action" => "view"
            ));
        }
        return $this->getResponse()->setContent(NULL);
    }

    public function viewAction()
    {
        $em = $this->entityManager;
        // var_dump($this->objectLifeForm);
        $dropZoneForm = $this->dropZoneForm;
        $object = NULL;
        $objectSession = $this->objectService->getObjectSession();
        $dropZoneForm->setAttributes(array(
            "action" => $this->url()
                ->fromRoute("object/default", array(
                "action" => "upload"
            ))
        ));
        $id = $this->params()->fromRoute("inf", NULL); // object ID
        if ($id == NULL) {
            $id = $objectSession->objectUid;
            if ($id == NULL) {
                // $id = $objectSession->objectUid;
                $this->flashMessenger()->addErrorMessage("Identifier absent");
                return $this->redirect()->toRoute("object/default", array(
                    "action" => "all"
                ));
            }
        }
        if ($id != NULL) {

            // $object = $em->find("Object\Entity\Object", $id);
            $object = $em->getRepository("Object\Entity\Object")->findOneBy(array(
                "objectUid" => $id
            ));

            $objectSession->objectId = $object->getId();
            $objectSession->objectUid = $object->getObjectUid();
        }
        $view = new ViewModel(array(
            "object" => $object,
            "dropZoneForm" => $dropZoneForm
        ));
        return $view;
    }

    private function getAllObjects()
    {
        return $this->object_service->getAllObjects();
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }

    public function setOptions($op)
    {
        $this->options = $op;
        return $this;
    }

    public function setNewObjectForm($form)
    {
        $this->objectForm = $form;
        return $this;
    }

    public function setObjectService($ob)
    {
        $this->objectService = $ob;
        return $this;
    }

    public function setObjectEntity($entity)
    {
        $this->objectEntity = $entity;
        return $this;
    }

    public function setCentralBrokerId($id)
    {
        $this->centralBrokerId = $id;
        return $this;
    }

    public function setUploadForm($form)
    {
        $this->uploadForm = $form;
        return $this;
    }

    public function setDropZoneForm($form)
    {
        $this->dropZoneForm = $form;
        return $this;
    }

    public function setBlobService($xserv)
    {
        $this->blobService = $xserv;
        return $this;
    }

    public function setRenderer($ren)
    {
        $this->renderer = $ren;
        return $this;
    }

    // Begin Object Internal form
    public function setObjectMotorForm($form)
    {
        $this->objectMotorForm = $form;
        return $this;
    }

    public function setObjectBuildingForm($form)
    {
        $this->objectBuildingForm = $form;
        return $this;
    }

    public function setObjectLifeForm($form)
    {
        $this->objectLifeForm = $form;
        return $this;
    }

    public function setObjectLifeStyleForm($form)
    {
        $this->objectLifeStyleForm = $form;
        return $this;
    }

    public function setObjecBusinessItemForm($form)
    {
        $this->objectBusinessItemForm = $form;
        return $this;
    }

    public function setObjectBusinessForm($form)
    {
        $this->objectBusinessForm = $form;
        return $this;
    }

    public function setObjectNonBusinessItemForm($form)
    {
        $this->objectNonBusinessItemForm = $form;
        return $this;
    }

    public function setObjectTravelForm($form)
    {
        $this->objectTravelForm = $form;
        return $this;
    }

    public function setObjectSportsForm($form)
    {
        $this->objectSportsForm = $form;
        return $this;
    }

    public function setObjectOthersForm($form)
    {
        $this->objectOthersForm = $form;
        return $this;
    }

    public function setObjectBusinessItemForm($form)
    {
        $this->objectBusinessItemForm = $form;
        return $this;
    }

    // public function setObjectLifeForm($objectLifeForm){
    // $this->objectLifeForm = $objectLifeForm;
    // return $this;
    // }
}

