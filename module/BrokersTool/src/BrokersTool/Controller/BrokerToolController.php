<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/BrokersTool for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace BrokersTool\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Transactions\Entity\BrokerFlutterwaveAccount;
use Zend\Mail\Message;
use WasabiLib\Ajax\Response;
use WasabiLib\Modal\Info;
use WasabiLib\Modal\WasabiModalView;
use WasabiLib\Modal\WasabiModal;
use WasabiLib\Ajax\Redirect;
use CsnUser\Service\UserService;
use Zend\Session\Container;
use WasabiLib\Ajax\GritterMessage;

class BrokerToolController extends AbstractActionController
{

    private $generalService;

    private $mailService;

    private $userEntity;

    private $userFormHelper;

    private $addStaffForm;

    private $brokerToolService;

    private $assignCustomerEntity;

    private $entityManager;

    private $brokerFlutterForm;

    private $brokerId;

    private $mailer;

    private $smsService;

    private $uploadForm;

    private $dropZoneForm;

    private $blobService;

    private $renderer;

    private $staffPhoneNumberForm;

    private $staffEmailForm;

    public function indexAction()
    {
        return array();
    }

    public function onDispatch(\Zend\Mvc\MvcEvent $e)
    {
        $response = parent::onDispatch($e);
        // $response = parent::on
        $this->redirectPlugin()->redirectCondition();
        return $response;
    }

    public function registerstaffmodalAction()
    {
        $response = new Response();
        $generalServie = $this->generalService;
        $userEntity = $this->userEntity;
        $form = $this->addStaffForm;
        $form->setAttributes(array(
            "data-ajax-loader" => "myLoader",
            "id" => "simpleForm",
            "class" => "ajax_element form-horizontal form-label-left",
            "action" => "/broker-tool/registerstaffmodal"
        ));
        $brokerToolService = $this->brokerToolService;
        $smsService = $this->smsService;
        $entityManager = $generalServie->getEntityManager();
        $form->bind($userEntity);
        $request = $this->getRequest();
        $gritter = new GritterMessage();
        if ($brokerToolService->registeredStaffCondition() == false) {
            // $this->flashMessenger()->addErrorMessage("You have exhausted all your staff space");
            // $this->redirect()->toRoute("dashboard");

            $gritter->setTitle("Maximum Staff");
            $gritter->setText("You have exhausted maximum number of staff");
            $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);
            $gritter->setType(GritterMessage::TYPE_ERROR);

            $response->add($gritter);
        } else {

            if ($request->isPost()) {

                $form->setData($request->getPost());
                $this->staffValidationGroup($form);
                if ($form->isValid()) {
                    $data = $form->getData();
                    $res = NULL;
                    // var_dump($data);
                    // try{
                    $res = $brokerToolService->hydrateAddStaff($userEntity, $data);
                    if ($res != NULL) {

                        $gritter->setTitle("Success");
                        $gritter->setText("Successfully Registered a Staff");
                        $gritter->setType(GritterMessage::TYPE_SUCCESS);
                        $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);

                        $response->add($gritter);
                        $this->flashmessenger()->addSuccessMessage("Successfully Registered a Staff " . $res);

                        $redirect = new Redirect($this->url()->fromRoute("dashboard"));
                        $response->add($redirect);
                    } else {
                        $gritter->setTitle("Error");
                        $gritter->setText("Could not register a new jstaff at this time, please try again latter");
                        $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);
                        $gritter->setType(GritterMessage::TYPE_ERROR);

                        $response->add($gritter);
                    }
                }
            } else {
                $viewModel = new ViewModel(array(
                    'staffForm' => $form
                ));
                $viewModel->setTemplate("broker-tool-add-staff-fieldset-snippet");
                $modal = new WasabiModal("standard", "Register Staff");
                $modal->setContent($viewModel);

                $wasabiModal = new WasabiModalView("#wasabi_modal", $this->renderer, $modal);
                $response->add($wasabiModal);
            }
        }

        return $this->getResponse()->setContent($response);
    }

    public function setupbankaccmodalAction()
    {
        $response = new Response();

        return $this->getResponse()->setContent($response);
    }

    /**
     * *
     * This privides action on the proper editin of a brokers phone number
     * Provide tool to change the phone number of a broker
     *
     * @return mixed
     */
    public function changephonemodalAction()
    {
        $em = $this->entityManager;
        $response = new Response();
        $request = $this->getRequest();
        $staffPhoneNumberForm = $this->staffPhoneNumberForm;
        $smsService = $this->smsService;
        $staffPhoneNumberForm->setAttributes(array(
            "data-ajax-loader" => "soader",
            "id" => "simpleForm",
            "class" => "ajax_element form-horizontal form-label-left",
            "action" => "changephonemodal"
        ));
        $staffId = $this->params()->fromQuery("data", NULL); // this is the staff ubique id

        $editSession = new Container("chane_phone_session");
        if ($staffId != NULL) {
            $editSession->staffId = $staffId;
        } else {
            $staffId = $editSession->staffId;
        }

        if ($staffId == NULL) {

            $this->flashmessenger()->addErrorMessage("No identifier provided");
            $redirect = new Redirect($this->url()->fromRoute("brokers-tool/default", array(
                "action" => "add-staff"
            )));
            $response = new Response();
            $response->add($redirect);
            return $this->getResponse()->setContent($response);
        }

        $staffEntity = $em->getRepository("GeneralServicer\Entity\BrokerChild")->findOneBy(array(
            "brokerChildUid" => $staffId
        ));

        $userEntity = $staffEntity->getUser();
        // $staffForm->bind($userEntity);

        if ($request->isPost()) {
            $post = $request->getPost();

            $staffPhoneNumberForm->setData($post);
            if ($staffPhoneNumberForm->isValid()) {
                // $change = "";
                $data = $staffPhoneNumberForm->getData();
                $username = $data->getUsername();
                $userEntity->setUserName($username);
                try {
                    $em->persist($userEntity);
                    $em->flush();
                    $this->flashmessenger()->addSuccessMessage($username);
                    $redirect = new Redirect($this->url()->fromRoute("brokers-tool/default", array(
                        "action" => "add-staff"
                    )));
                    $response->add($redirect);
                } catch (\Exception $e) {
                    $this->flashmessenger()->addErrorMessage($e->getMessage());
                    $redirect = new Redirect($this->url()->fromRoute("brokers-tool/default", array(
                        "action" => "add-staff"
                    )));
                    $response = new Response();
                    $response->add($redirect);
                } finally {
                    // TODO fix this encapsulate it in a succes condition
                    $smsMessage = "Welcome aboard, your phone number " . $username . " has been assigned to new customers";
                    $smsService->sendBrokerSms($username, NULL, $smsMessage);
                }
                // Send SMS

                // Send Email
                return $this->getResponse()->setContent($response);
            }
        } else {
            $viewmodel = new ViewModel(array(
                "staffPhoneNumberForm" => $staffPhoneNumberForm
            ));
            $viewmodel->setTemplate("brokers-tool-change-phone-number-form");
            $modal = new WasabiModal("standard", "CHANGE PHONE NUMBER");
            $modal->setContent($viewmodel);

            $modalView = new WasabiModalView("#wasabi_modal", $this->renderer, $modal);

            $response = new Response();
            $response->add($modalView);
        }

        return $this->getResponse()->setContent($response);
    }

    public function changeemailmodalAction()
    {
        $staffId = $this->params()->fromQuery("data", NULL);
        $em = $this->entityManager;
        $response = new Response();
        $stafEmailForm = $this->staffEmailForm;
        $stafEmailForm->setAttributes(array(
            "data-ajax-loader" => "soader",
            "id" => "simpleForm",
            "class" => "ajax_element form-horizontal form-label-left",
            "action" => "changephonemodal"
        ));
        $mailEditSession = new Container("mail_edit_session");
        if ($staffId != NULL) {
            $mailEditSession->staffId = $staffId;
        } else {
            $staffId = $mailEditSession->staffId;
        }
        $request = $this->getRequest();
        // if($request->isPost()){

        // }else{
        // // Show Form
        // }
        if ($staffId == NULL) {
            $gritter = new GritterMessage();
            $gritter->setText("Broker Id not Available ");
            $gritter->setTitle("Absent Broker ID");
            $gritter->setType(GritterMessage::TYPE_ERROR);
            $response->add($gritter);
        } else {
            $staffEntity = $em->getRepository("GeneralServicer\Entity\BrokerChild")->findOneBy(array(
                "brokerChildUid" => $staffId
            ));

            $userEntity = $staffEntity->getUser();

            if ($request->isPost()) {
                $post = $request->getPost();
                $stafEmailForm->setData($post);
                if ($stafEmailForm->isValid()) {
                    $data = $stafEmailForm->getData();
                    $email = $data->getEmail();
                    $userEntity->setEmail($email);
                    try {
                        $em->persist($userEntity);
                        $em->flush();

                        $this->flashmessenger()->addSuccessMessage("Successfully changed the email");
                        $redirect = new Redirect($this->url()->fromRoute("brokers-tool/default", array(
                            "action" => "add-staff"
                        )));
                        $response->add($redirect);
                    } catch (\Exception $e) {
                        $gritter = new GritterMessage();
                        $gritter->setText("A problem Occured : " . $e->getMessage());
                        $gritter->setTitle("Hydration Error !!");
                        $gritter->setType(GritterMessage::TYPE_ERROR);
                        $response->add($gritter);
                    } finally {
                        // send a mail notification to new email
                    }
                }
            } else {
                $viewmodel = new ViewModel(array(
                    "staffEmailForm" => $stafEmailForm
                ));
                $viewmodel->setTemplate("brokers-tool-change-email-form");
                $modal = new WasabiModal("standard", "CHANGE BROKER EMAIL");
                $modal->setContent($viewmodel);

                $modalView = new WasabiModalView("#wasabi_modal", $this->renderer, $modal);
                $response->add($modalView);
            }
        }

        // $response = new Response();

        return $this->getResponse()->setContent($response);
    }

    /*
     * Begin modal and Async
     */
    public function editstaffmodalAction()
    {
        $em = $this->entityManager;
        $staffForm = $this->addStaffForm;
        $staffForm->setAttributes(array(
            "data-ajax-loader" => "myLoader",
            "id" => "simpleForm",
            "class" => "ajax_element form-horizontal form-label-left",
            "action" => "editstaffmodal"
        ));
        $staffForm->get("userBasicField")
            ->get("username")
            ->setAttributes(array(
            "disabled" => "disabled"
        ));
        $staffForm->get("userBasicField")
            ->get("email")
            ->setAttributes(array(
            "disabled" => "disabled"
        ));
        $request = $this->getRequest();
        $viewModel = new ViewModel(array(
            "staffForm" => $staffForm
        ));
        $staffId = $this->params()->fromQuery("data", NULL); // this is the staff ubique id

        $editSession = new Container("edit_staff_session");
        if ($staffId != NULL) {
            $editSession->staffId = $staffId;
        } else {
            $staffId = $editSession->staffId;
        }

        if ($staffId == NULL) {

            $this->flashmessenger()->addErrorMessage("No identifier provided");
            $redirect = new Redirect($this->url()->fromRoute("brokers-tool/default", array(
                "action" => "add-staff"
            )));
            $response = new Response();
            $response->add($redirect);
            return $this->getResponse()->setContent($response);
        }

        $staffEntity = $em->getRepository("GeneralServicer\Entity\BrokerChild")->findOneBy(array(
            "brokerChildUid" => $staffId
        ));

        $userEntity = $staffEntity->getUser();
        $staffForm->bind($userEntity);

        $viewModel->setTemplate("broker-tool-add-staff-fieldset-snippet");

        $modal = new WasabiModal("standard", "Edit/Re-Assign  Staff");
        $modal->setContent($viewModel);

        if ($request->isPost()) {
            $post = $request->getPost();

            $staffForm->setValidationGroup(array(
                "userBasicField" => array(
                    // "username",
                    "password",
                    // "email",
                    "passwordVerify",
                    "brokerChild" => array(
                        "firstname",
                        "lastname"
                    )
                )
                // "csrf"
            ));

            $staffForm->setData($post);

            if ($staffForm->isValid()) {

                $data = $staffForm->getData();

                $brokerChildEntity = $userEntity->getBrokerChild();
                $userEntity->
                // ->setUsername($post['userBasicField']['username'])
                setPassword(UserService::encryptPassword($data->getPassword()));
                // ->setEmail($post['userBasicField']['email']);
                $brokerChildEntity->setModifiedOn(new \DateTime())
                    ->setFirstname($data->getBrokerChild()
                    ->getFirstname())
                    ->setLastname($data->getBrokerChild()
                    ->getLastname());

                try {
                    $em->persist($userEntity);
                    $em->flush();
                    $this->flashmessenger()->addSuccessMessage("Successfully edited the information ");
                    $redirect = new Redirect($this->url()->fromRoute("brokers-tool/default", array(
                        "action" => "add-staff"
                    )));
                    $response = new Response();

                    /**
                     * TODO Send mail notification
                     * with the details
                     */

                    $response->add($redirect);
                    return $this->getResponse()->setContent($response);
                } catch (\Exception $e) {
                    $this->flashmessenger()->addErrorMessage($e->getMessage());
                    $redirect = new Redirect($this->url()->fromRoute("brokers-tool/default", array(
                        "action" => "add-staff"
                    )));
                    $response = new Response();
                    $response->add($redirect);
                    return $this->getResponse()->setContent($response);
                }
            }
        }

        $modalView = new WasabiModalView("#wasabi_modal", $this->renderer, $modal);

        $response = new Response();
        $response->add($modalView);
        return $this->getResponse()->setContent($response);
    }

    /**
     * This function show the deails of the registered staff
     *
     * @return mixed
     */
    public function viewstaffmodalAction()
    {
        $response = new Response();
        $staffUId = $this->params()->fromQuery("data", NULL);
        $em = $this->entityManager;
        if ($staffUId != NULL) {
            // show information about staff
            $staffEntity = $em->getRepository("GeneralServicer\Entity\BrokerChild")->findOneBy(array(
                "brokerChildUid" => $staffUId
            ));
            $viewModel = new ViewModel(array(
                "staffEntity" => $staffEntity
            ));
            $viewModel->setTemplate("brokers-tool-staff-details-snippet");

            $modal = new WasabiModal("standard", "View Staff Details");
            $modal->setContent($viewModel);

            $modalView = new WasabiModalView("#wasabi_modal", $this->renderer, $modal);

            $response->add($modalView);
        } else {
            $gritter = new GritterMessage();
            $gritter->setText("Staff Identity could not be located");
            $gritter->setTitle("Staff Id Error !");
            $gritter->setType(GritterMessage::TYPE_ERROR);
            $response->add($gritter);
        }
        return $this->getResponse()->setContent($response);
    }

    // /*
    // * End modal and async
    // */
    // public function mailAction()
    // {
    // $mailService = $this->mailService;
    // $fullLink = $this->url()->fromRoute('user-register', array(
    // 'action' => 'confirm-email',
    // 'id' => "1234567890"
    // ), array(
    // 'force_canonical' => true
    // ));

    // $imapLogo = $this->url()->fromRoute('welcome', array(), array(
    // 'force_canonical' => true
    // )) . "/images/logow.png";

    // // $mailer = $this->mail;

    // $var = [
    // 'logo' => $imapLogo,
    // 'confirmLink' => $fullLink . $imapLogo
    // ];
    // // Begin Mail

    // $message = $mailService->getMessage();
    // $message->addTo("swoopfx@gmail.com")
    // ->setFrom("info@imapp.ng", "IMAPP CM")
    // ->setSubject("IMAPP CM: Confirm Email");

    // $mailService->setTemplate('general-user-confirm-email', $var);

    // $mailService->send();
    // $view = new ViewModel();
    // return $view;
    // }
    public function changelogoAction()
    {
        $em = $this->entityManager;
        $form = $this->dropZoneForm;
        $viewModel = new ViewModel(array(
            "dropZoneUploadForm" => $form
        ));
        $viewModel->setTemplate("general-dropzone-upload-form-snippet");
        $modal = new WasabiModal("standard", "Change Logo");
        $modal->setContent($viewModel);

        $modalView = new WasabiModalView("#wasabi_modal", $this->renderer, $modal);

        $response = new Response();
        $response->add($modalView);
        return $this->getResponse()->setContent($response);
    }

    public function addStaffAction()
    {
        $generalServie = $this->generalService;
        $userEntity = $this->userEntity;
        $form = $this->addStaffForm;
        $brokerToolService = $this->brokerToolService;
        $smsService = $this->smsService;
        $entityManager = $generalServie->getEntityManager();
        $registeredStaff = $brokerToolService->getRegisteredStaffs();
        $form->bind($userEntity);
        // $form->bind ()

        $request = $this->getRequest();
        if ($brokerToolService->registeredStaffCondition() == false) {
            $this->flashMessenger()->addErrorMessage("You have exhausted all your staff space");
            $this->redirect()->toRoute("dashboard");
        } else {

            if ($request->isPost()) {

                $form->setData($request->getPost());
                $this->staffValidationGroup($form);
                if ($form->isValid()) {
                    $data = $form->getData();
                    $res = NULL;
                    // var_dump($data);
                    $res = $brokerToolService->hydrateAddStaff($userEntity, $data);
                    if ($res != NULL) {

                        $this->flashmessenger()->addSuccessMessage("Successfully Registered a Staff ");
                        $this->redirect()->toRoute("brokers-tool/default", array(
                            "action" => "add-staff"
                        ));
                    } else {
                        $this->flashmessenger()->addErrorMessage("There was a problem registering this staff on the platform");
                        $this->redirect()->toRoute("brokers-tool/default", array(
                            "action" => "add-staff"
                        ));
                    }
                }
            }
        }

        // $form = $userFormHelper->createUserForm($userEntity, 'CreateUser');
        $view = new ViewModel(array(
            'form' => $form,
            'registeredStaff' => $registeredStaff
        ));
        return $view;
    }

    /**
     *
     * @return \Zend\View\Model\ViewModel
     */
    public function messagesAction()
    {
        $view = new ViewModel(array());
        return $view;
    }

    private function staffValidationGroup($form)
    {
        return $form->setValidationGroup(array(
            'userBasicField' => array(
                'brokerChild' => array(
                    'firstname',
                    'lastname'
                ),
                'username',
                'email',
                'password',
                'passwordVerify'
            ),
            'csrf'
        ));
    }

    /**
     *
     * @return \Zend\View\Model\ViewModel
     */
    public function brokerflutterwaveAction()
    {
        $em = $this->entityManager;
        $showForm = false;
        $flutterForm = $this->brokerFlutterForm;
        $brokerId = $this->brokerId;

        $brokerFlutterAccount = $em->getRepository("Transactions\Entity\BrokerFlutterwaveAccount")->findOneBy(array(
            'broker' => $brokerId
        ));
        if ($brokerFlutterAccount != NULL) {
            $showForm = false;
        } else {

            $showForm = true;
            $brokerFlutterAccount = new BrokerFlutterwaveAccount();
        }
        // echo $brokerFlutterAccount->getMerchatId();
        $flutterForm->bind($brokerFlutterAccount);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $data = $request->getPost();
            $flutterForm->setData($data);
            if ($flutterForm->isValid()) {
                $brokerFlutterAccount->setBroker($em->find("Users\Entity\InsuranceBrokerRegistered", $brokerId));
                // $newData = $flutterForm->getData();
                // check if the account exist
                $brokerFlutterAccount->setCreateOn(new \DateTime());
                try {
                    $em->persist($brokerFlutterAccount);
                    $em->flush();
                    $this->flashmessenger()->addSuccessMessage("You have successfully updated your payment gateway");
                    $this->redirect()->toRoute("brokers-tool/default", array(
                        "action" => "brokerflutterwave"
                    ));
                } catch (\Exception $e) {}
            }
        }
        $view = new ViewModel(array(
            'showForm' => $showForm,
            'flutterForm' => $flutterForm
        ));
        return $view;
    }

    public function editflutteraccountAction()
    {
        $em = $this->entityManager;
        $flutterForm = $this->brokerFlutterForm;
        $request = $this->getRequest();
        $brokerId = $this->brokerId;
        $brokerFlutterAccount = $em->getRepository("Transactions\Entity\BrokerFlutterwaveAccount")->findOneBy(array(
            'broker' => $brokerId
        ));

        $flutterForm->bind($brokerFlutterAccount);
        if ($request->isPOst()) {
            $data = $request->getPost();
            $flutterForm->setData($data);
        }
        $view = new ViewModel(array(
            'flutterForm' => $flutterForm
        ));
        return $view;
    }

    public function editStaffAction()
    {
        $generalService = $this->generalService;
        $em = $generalService->getEntityManager();
        $id = $this->params()->fromRoute('id', NULL);
        $entity = "CsnUser\Entity\User";
        $form = $this->addStaffForm;
        $this->redirectPlugin()->idStatusRedirection($id, $entity);
        $staffEntity = $em->find($entity, $id);
        $form->bind($staffEntity);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $this->staffValidationGroup($form);
            if ($form->isValid()) {
                // do proper hydration;
                // If all data was
            }
        }
        $view = new ViewModel(array(
            'form' => $form
        ));
        return $view;
    }

    public function assignBrokerAction()
    {
        /**
         * This action assigns a child broker to a customer
         *
         * @var Ambiguous $view
         */
        $generalService = $this->generalService;
        $em = $generalService->getEntityManager();

        $view = new ViewModel(array());
        return $view;
    }

    public function setGeneralService($general)
    {
        $this->generalService = $general;
        return $this;
    }

    public function setUserEntity($entity)
    {
        $this->userEntity = $entity;
        return $this;
    }

    public function setUserFormHelper($entity)
    {
        $this->userFormHelper = $entity;
        return $this;
    }

    public function setAddStaffForm($form)
    {
        $this->addStaffForm = $form;
        return $this;
    }

    public function setBrokerTollService($xserv)
    {
        $this->brokerToolService = $xserv;
        return $this;
    }

    public function setAssignCustomerEntity($entity)
    {
        $this->assignCustomerEntity = $entity;
        return $this;
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }

    public function setFlutterForm($form)
    {
        $this->brokerFlutterForm = $form;
        return $this;
    }

    public function setBrokerId($id)
    {
        $this->brokerId = $id;
        return $this;
    }

    public function setMailService($serv)
    {
        $this->mailService = $serv;
        return $this;
    }

    public function setMailer($mailer)
    {
        $this->mailer = $mailer;
        return $this;
    }

    public function setSmsService($serv)
    {
        $this->smsService = $serv;
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

    public function setRenderer($ren)
    {
        $this->renderer = $ren;
        return $this;
    }

    public function setDropZoneForm($form)
    {
        $this->dropZoneForm = $form;
        return $this;
    }

    public function setStaffPhoneNumberForm($form)
    {
        $this->staffPhoneNumberForm = $form;
        return $this;
    }

    /**
     *
     * @param string $staffEmailForm
     */
    public function setStaffEmailForm($staffEmailForm)
    {
        $this->staffEmailForm = $staffEmailForm;
        return $this;
    }
}
