<?php
namespace Users\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use function Zend\Mvc\Controller\redirect;
use Settings\Service\SettingsService;
use Transactions\Service\InvoiceService;
use CsnUser\Service\UserService;
use Users\Entity\BrokerActivation;
use WasabiLib\Ajax\Response;
use WasabiLib\Modal\WasabiModal;
use WasabiLib\Modal\WasabiModalView;
use WasabiLib\Ajax\GritterMessage;

/**
 * BrokerController
 *
 * @author
 *
 * @version
 *
 */
class BrokerController extends AbstractActionController
{

    private $entityManager;

    private $setUpInfoForm;

    private $setUpDataForm;

    private $packageForm;

    private $dataEntity;

    private $subEntity;

    // This is the subscription entity
    private $brokerSetupService;

    private $brokerGeneralService;

    private $invoiceForm;

    private $transactService;

    private $invoiceService;

    private $paymentForm;
    
    private $dropzoneForm;

    private $brokerSubService;

    private $generalService;

    private $uploadForm;

    private $paymentService;

    private $mailService;

    private $mailer;

    private $smsService;

    private $centralBrokerId;

    private $renderer;

    private $blobService;

    /**
     * Begin Modal
     */
    public function editprofilemodalAction()
    {
        $em = $this->entityManager;
        $response = new Response();
        $brokerForm = $this->setUpDataForm;
        $request = $this->getRequest();
        $centralBrokerId = $this->centralBrokerId;
        $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $centralBrokerId);
        if ($brokerEntity == NULL) {
            // $gritter = new GritterMessage();
            // $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);
            // $gritter->setText("There is No Broker identified ");
            // // $gritter->set
            // $response->add($gritter);
        } else {
            $brokerForm->bind($brokerEntity);
            $brokerForm->setAttributes(array(
                "data-ajax-loader" => "myLoader",
                "id" => "simpleForm",
                "class" => "form-horizontal form-label-left ajax_element",
                "action" => $this->url()
                    ->fromRoute("user_broker", array(
                    "action" => "editprofilemodal"
                ))
            ));
            $brokerForm->get("broker_setup_data")
                ->get("idInduranceBoker")
                ->setAttributes(array(
                "disabled" => "disabled"
            ));
            if ($request->isPost()) {
                $post = $request->getPost();
                $brokerForm->setData($post);
                $brokerForm->setValidationGroup(array(
                    'csrf',
                    'broker_setup_data' => array(

                        'brokerEmail',
                        'brokerWebsite',
                        'officialPhone',
                        // 'idInduranceBoker',
                        'brokerProfile',

                        'address1',
                        'address2',
                        'zipCode',
                        'country',
                        'state'
                    )
                ));

                if ($brokerForm->isValid()) {
                    $brokerEntity->setDateModified(new \DateTime());

                    try {
                        $em->persist($brokerEntity);
                        $em->flush();
                        $this->flashmessenger()->addSuccessMessage("profile successfully updated");
                        $redirect = new \WasabiLib\Ajax\Redirect($this->url()->fromRoute("user_broker", array(
                            "action" => "info"
                        )));
                        $response->add($redirect);
                        // $this->flashmessenger()->addSuccessMessage("profile successfully updated");
                        // $this->redirect()->toRoute("user_broker", array(
                        // "action" => "info"
                        // ));
                    } catch (\Exception $e) {
                        $this->flashmessenger()->addErrorMessage("There was a problem updating this profile");
                        $this->redirect()->toRoute("user_broker", array(
                            "action" => "info"
                        ));
                    }
                } else {
                    // var_dump($post);
                    $this->flashmessenger()->addErrorMessage("Form is Invalid");
                    $this->redirect()->toRoute("user_broker", array(
                        "action" => "info"
                    ));
                }
            } else {
                $viewModel = new ViewModel(array(
                    'brokerForm' => $brokerForm
                ));
                $viewModel->setTemplate("user-broker-profile-form");

                $modal = new WasabiModal("standard", "Edit Profile");
                $modal->setContent($viewModel);

                $modalView = new WasabiModalView("#wasabi_modal", $this->renderer, $modal);

                $response->add($modalView);
            }
        }
        return $this->getResponse()->setContent($response);
    }

    /**
     * End Modal
     */

    /**
     *
     * {@inheritdoc}
     *
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $this->layout('layout/welcome.phtml');

        return new ViewModel();
    }

    public function setupAction()
    {
        $this->redirectPlugin()->redirectToLogout();
        // $this->redirectPlugin()->redirectCondition();
        $em = $this->entityManager;
        // If this user has already started the process,
        // Redirect to edit action
        // If user is not logged in and point to login page
        // if user is setup grant access to the setup service
        // Else throw an exception
        $setUpForm = $this->setUpInfoForm;
        $setUpInfo = $em->find('Settings\Entity\Terms', SettingsService::TERMS_BROKER_SETUP);
        $request = $this->getRequest();
        if ($request->isPost()) {

            $data = $request->getPost();
            $setUpForm->setData($data);
            if ($setUpForm->isValid()) {
                if ($request->getPost('acceptance') == 1) {
                    $this->redirect()->toRoute('user_broker', array(
                        'action' => 'setup-data'
                    ));
                }
            }
        }
        $view = new ViewModel(array(
            'setUpForm' => $setUpForm,
            'info' => $setUpInfo
        ));
        $this->layout('layout/layout.phtml');
        return $view;
    }

    public function setupDataAction()
    {
        /**
         * Upon siuccessful setup
         * update the isProfiled in the USer table to true
         * also chane role to broker
         *
         * @var unknown
         */
        $em = $this->entityManager;
        $generalService = $this->generalService;
        // if the broker id is not null redirect to dashboard
        $this->redirectPlugin()->redirectToLogout();
        // $repo = $em->getRepository('Settings\Entity\Packages')->findBy(array(
        // 'packageCategory' => 2
        // ));

        $dataEntity = $this->dataEntity;

        $setUpDataForm = $this->setUpDataForm;
        $setUpDataForm->get('broker_setup_data')
            ->get('subscription')
            ->get('package')
            ->setAttributes(array(
            'value' => 1
        ));
        $uploadForm = $this->uploadForm;
        $setUpDataForm->bind($dataEntity);
        $request = $this->getRequest();
        $setUpDataForm->get("broker_setup_data")
            ->get("subscription")
            ->get("package")
            ->setAttributes(array(
            "value" => 1
        ));

        if ($request->isPost()) {
            $data = $request->getPost();
            $setUpDataForm->setData($data);
            $this->setupValidationGroup($setUpDataForm);
            // var_dump("help");
            if ($setUpDataForm->isValid()) {

                $brokerActviationEntity = new BrokerActivation();
                $brokerActviationEntity->setActivation($em->find("Settings\Entity\ActivationType", SettingsService::BROKER_ACTIVATION_COMMISION))
                    ->setBroker($dataEntity);

                $dataEntity->setBrokerActivation($brokerActviationEntity);
                $user= $this->identity();
                if ($data["broker_setup_data"]["subscription"]['package'] == 1) {
                    $res = $this->brokerSetupService->hydrateBrokerFreeSetup($dataEntity);
                    $imapLogo ="";
                    if ($res === TRUE) {
                        // This process commision basis account
                        $this->flashmessenger()->addSuccessMessage("Welcome aboard IMAPP CM");

                        $customerLoginLink = $this->url()->fromRoute('login', array(), array(
                            'force_canonical' => true
                        )) . "{$dataEntity->getBrokerUid()}";
                        $var = [
                            'logo' => $imapLogo,
                            // 'confirmLink' => $fullLink,
                            "brokerLogin" => $this->url()->fromRoute('login', array(), array(
                                'force_canonical' => true
                            )),
                            "customerLogin" => $this->url()->fromRoute('client_login', array(
                                "brokerid" => $dataEntity->getBrokerUid()
                            ), array(
                                'force_canonical' => true
                            )),
                            "customerRegister" => $this->url()->fromRoute('client_register', array(
                                "brokerid" => $dataEntity->getBrokerUid()
                            ), array(
                                'force_canonical' => true
                            ))
                        ];

                        $this->blobService->createContainer($dataEntity->getBrokerUid());
                        $template['template'] = "general-broker-config-email";
                        $template['var'] = $var;

                        $messagePointer['to'] = $user->getEmail();
                        $messagePointer['fromName'] = "IMAPP CM";
                        $messagePointer['subject'] = "IMAPP CM CONFIG: Welcome Aboard";
                        // if ($dataEntity->getEmail() != NULL) {
                        // $messagePointer["addCc"] = $dataEntity->getEmail();
                        // }
                        $this->generalService->sendMails($messagePointer, $template);
                        $this->redirect()->toRoute("dashboard");
                    }
                } else {
                    // This should process non coimmision basis account
                    // meaning payed account
                   
                    $res = $this->brokerSetupService->hydrateBrokerSetup($dataEntity);
                    if ($res === TRUE) {
                        $this->flashmessenger()->addSuccessMessage("Please make payment and finalize your service");
                        $this->redirect()->toRoute('user_broker', array(
                            'action' => 'setup-invoice'
                        ));
                    }
                }
            }
        }
        $view = new ViewModel(array(
            'setUpDataForm' => $setUpDataForm,
            'uploadForm' => $uploadForm
        ));
        return $view;
    }

    public function uploadLogoAction()
    {
        $request = $this->getRequest();
        /**
         * verify the image is upload and not empty
         * Try progress with zend progress
         */
        var_dump($request);
        if ($request->isXmlHttpRequest()) {
            $files = $this->params()->fromFiles('companylogo');
            $code = $this->filesService->persistFiles($files);
            return new JsonModel([
                'code' => $code
            ]);
        }
    }

    public function setupInvoiceAction()
    {
        $em = $this->entityManager;
        // $mailer = $this->mailer;
        $user = $this->identity();
        $paymentService = $this->paymentService;
        $brokeInvoiceSession = $this->brokerSetupService->getBrokerSetupInvoiceSession();

        $id = $brokeInvoiceSession->invoiceId;

        if ($id == NULL) {
            // redirect to the info page
            $this->redirect()->toRoute('user_broker', array(
                'action' => 'info'
            ));
        }
        $invoiceInfo = $em->find("Transactions\Entity\Invoice", $id);

        $invoiceForm = $this->invoiceForm;
        $brokerService = $this->brokerGeneralService;
        $brokerInfo = $brokerService->brokerInfo();
        $brokerSub = $this->brokerSubService->getBrokerSubscription($brokerInfo->getId());
        $payForm = $this->paymentForm;
        $request = $this->getRequest();
        $payForm->setAttributes(array(
            'action' => $this->url()
                ->fromRoute("user_broker", array(
                "action" => "setup-invoice"
            ))
        ));
        if ($request->isPost()) {

            $data = $request->getPost();
            $cardNumber = $data['card_payment']['number'];
            $card = str_replace(" ", "", $cardNumber);
            $cardName = $data['card_payment']['name'];
            $cardCvc = $data['card_payment']['cvc'];
            $amount = $data['card_payment']['amount'];
            $invoiceId = $data['card_payment']['invoice'];
            $currency = $data['card_payment']['currency'];
            $strip = str_replace(" ", "", $data['card_payment']['expiry']);
            $month = substr($strip, 0, 2);
            $year = substr($strip, - 2, 3);

            $narate = "Payment for Setup subscription, billed to " . $cardName;
            $paymentService->setCustomerId($user->getId())
                ->setCvv($cardCvc)
                ->setExpireMonth($month)
                ->setExpireYear($year)
                ->setCardNo($card)
                ->setNarration($narate)
                ->setAmount($amount)
                ->setInvoiceId($invoiceId)
                ->setCurrency($currency);

            $res = $paymentService->payImapp();

            /**
             * use front end validator
             * Process payment of the whole stuff
             * if payment is successful Update status of the acount to active ,
             * send sms for successful payment
             * and redirect to dashboard
             * else redirect here
             * if payment is successful send configuration email and welcome aborad sms
             */
            if ($res == true) {
                $brokerSub->setIsValid(true);
                $invoiceInfo->setIsOpen(false)->setStatus($em->find("Transactions\Entity\InvoiceStatus", InvoiceService::INVOICE_PAID_STATUS));
                $user->setRole($em->find("CsnUser\Entity\Role ", UserService::USER_ROLE_BROKER));
                try {
                    $em->persist($user);
                    $em->persist($invoiceInfo);
                    $em->persist($brokerSub);
                    $em->flush();

                    // Send cofig Mail

                    // Begin send sms
                    $message = "Welcome aboard IMAPP CM start making money";
                    $this->smsService->setTo($user->getUsername())
                        ->setFrom("IMAPP CM")
                        ->setMessage($message);
                    $this->smsService->send();
                    // End sms
                    $this->flashmessenger()->addSuccessMessage("Welcome Aboard, please check your email for instructions and configurations");
                    $this->redirect()->toRoute("dashboard");
                } catch (\Exception $e) {}
            }
            if ($res == false) {
                $this->redirect()->refresh();
                $this->flashmessenger()->addErrorMessage("We could not setup your account");
            }
        }
        $isSetup = TRUE;
        $view = new ViewModel(array(
            'brokerInfo' => $brokerInfo,
            'invoiceInfo' => $invoiceInfo,
            'invoiceForm' => $invoiceForm,
            'brokerSub' => $brokerSub,
            'payForm' => $payForm,
            "isSetup" => $isSetup
        ));
        return $view;
    }

    /**
     *
     * This action is only used if the broker has
     * created a profile but not paid or cleared his invoice
     * This displays the broekr details and the unpaid invoice
     *
     * @return \Zend\View\Model\ViewModel
     */
    public function infoAction()
    {
        $this->redirectPlugin()->redirectToLogout();
        $user = $this->identity();
        $em = $this->entityManager;
        $brokerForm = $this->setUpDataForm;

        $centralBrokerId = $this->centralBrokerId;
        $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $centralBrokerId);
        if ($brokerEntity == NULL) {
            $this->flashmessenger()->addErrorMessage("No Identifier for this Edit Rpofile");
            $this->redirect()->toRoute("dashboard");
        }
        $brokerForm->bind($brokerEntity);
        $brokerForm->setAttributes(array(
            "action" => $this->url()
                ->fromRoute("sub_account/default", array(
                "action" => "edit-profile"
            ))
        ));
        // $mail = $this->mailService;
        $invoiceService = $this->invoiceService;
        $transactService = $this->transactService;
        $brokerGenServe = $this->brokerGeneralService;
        $paymentService = $this->paymentService;
        $request = $this->getRequest();
        $brokerInfo = $brokerGenServe->brokerInfo();
        $brokerSub = $brokerGenServe->getSubscription();
        $setUpInvoice = $invoiceService->getSetupInvoices();
        // $invoiceEntity = $setUpInvoice->getInvoice();
        // $transact = $transactService->getLatestTransactions();
        $payForm = $this->paymentForm;
        $payForm->setAttributes(array(
            'action' => $this->url()
                ->fromRoute('user_broker', array(
                'action' => 'info'
            ), array())
        ));

        $brokerForm->setAttributes(array(
            "action" => $this->url()
                ->fromRoute("user_broker", array(
                "action" => "info"
            ))
        ));
        $brokerForm->get("broker_setup_data")
            ->get("idInduranceBoker")
            ->setAttributes(array(
            "disabled" => "disabled"
        ));

        if ($request->isPost()) {
            $post = $request->getPost();
            $brokerForm->setData($post);
            $brokerForm->setValidationGroup(array(
                'csrf',
                'broker_setup_data' => array(

                    'brokerEmail',
                    'brokerWebsite',
                    'officialPhone',
                    // 'idInduranceBoker',
                    'brokerProfile',

                    'address1',
                    'address2',
                    'zipCode',
                    'country',
                    'state'
                )
            ));

            if ($brokerForm->isValid()) {
                $brokerEntity->setDateModified(new \DateTime());

                try {
                    $em->persist($brokerEntity);
                    $em->flush();

                    $this->flashmessenger()->addSuccessMessage("profile successfully updated");
                    $this->redirect()->toRoute("user_broker", array(
                        "action" => "info"
                    ));
                } catch (\Exception $e) {
                    $this->flashmessenger()->addErrorMessage("There was a problem updating this profile");
                    $this->redirect()->toRoute("user_broker", array(
                        "action" => "info"
                    ));
                }
            } else {
                // var_dump($post);
                $this->flashmessenger()->addErrorMessage("Form is Invalid");
                $this->redirect()->toRoute("user_broker", array(
                    "action" => "info"
                ));
            }
        }

        $view = new ViewModel(array(
            'brokerInfo' => $brokerInfo,
            'brokerSub' => $brokerSub,
            'brokerInvoice' => $setUpInvoice,
            'brokerTransact' => NULL,
            "brokerForm" => $brokerForm,
            'payForm' => $payForm
        ));
        return $view;
    }

    private function setupValidationGroup($form)
    {
        $group = array(
            // 'csrf',
            'broker_setup_data' => array(
                'subscription' => array(
                    'package'
                ),
                'brokerEmail',
                'brokerWebsite',
                'officialPhone',
                'idInduranceBoker',
                'brokerProfile',
                'brokerProfile',
                'address1',
                'address2',
                'zipCode',
                'country',
                'state'
            )
        );
        return $form->setValidationGroup($group);
    }
    
    public function profileAction(){
        $em = $this->entityManager;
        $centralBrokerId = $this->centralBrokerId;
        $brokerEntity = NULL;
        $dropzoneForm = $this->dropzoneForm;
        $dropzoneForm->setAttributes(array(
            "action"=>$this->url()->fromRoute("settings/default", array("action"=>"newlogoupload"))
        ));
        if($centralBrokerId == NULL){
            $this->flashMessenger()->addErrorMessage("Absent Identier");
            return $this->redirect()->toRoute("dashboard");
        }else{
            $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $centralBrokerId);
            
        }
        
        $viewModel = new ViewModel(array(
            "brokerInfo"=>$brokerEntity,
            "dropZoneForm"=>$dropzoneForm
        ));
        return $viewModel;
    }

    public function getPackageDetailsAction()
    {
        $json = new JsonModel(array());

        return $json;
    }

    private function rbaCondition($data, $entity)
    {
        $res = $this->brokerSetupService->rbaConfirmation($data);
        if ($res == true) {
            $entity->setIsBrokerVerified(true);
        } else {
            $entity->setIsBrokerVerified(false);
        }
    }

    public function setupPackageAction()
    {
        $view = new ViewModel();
        return $view;
    }

    // Begin Setters
    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }

    public function setSetUpInfoForm($form)
    {
        $this->setUpInfoForm = $form;

        return $this;
    }

    public function setSetUpDataForm($form)
    {
        $this->setUpDataForm = $form;

        return $this;
    }

    public function setPackageForm($form)
    {
        $this->packageForm = $form;
        return $this;
    }

    public function setDataEntity($entity)
    {
        $this->dataEntity = $entity;

        return $this;
    }

    public function setBrokerSetupService($service)
    {
        $this->brokerSetupService = $service;

        return $this;
    }

    public function setBrokerGeneralService($serve)
    {
        $this->brokerGeneralService = $serve;
        return $this;
    }

    public function setTransactService($service)
    {
        $this->transactService = $service;
        return $this;
    }

    public function setInvoiceService($service)
    {
        $this->invoiceService = $service;
        return $this;
    }

    public function setPaymentForm($form)
    {
        $this->paymentForm = $form;
        return $this;
    }

    public function setBrokerSubService($serve)
    {
        $this->brokerSubService = $serve;
        return $this;
    }

    public function setGeneralService($ser)
    {
        $this->generalService = $ser;
        return $this;
    }

    public function setUploadForm($form)
    {
        $this->uploadForm = $form;
        return $this;
    }

    public function setPaymentService($xserrv)
    {
        $this->paymentService = $xserrv;
        return $this;
    }

    public function setMailService($xserv)
    {
        $this->mailService = $xserv;
        return $this;
    }

    public function setMailer($mail)
    {
        $this->mailer = $mail;
        return $this;
    }

    public function setSmsService($xserv)
    {
        $this->smsService = $xserv;
        return $this;
    }

    public function setCentralBrokerId($id)
    {
        $this->centralBrokerId = $id;
        return $this;
    }

    public function setRenderer($ren)
    {
        $this->renderer = $ren;
        return $this;
    }
    // ENd Setters

    /**
     * @param mixed $blobService
     */
    public function setBlobService($blobService)
    {
        $this->blobService = $blobService;
        return $this;
    }
    /**
     * @param mixed $dropzoneForm
     */
    public function setDropzoneForm($dropzoneForm)
    {
        $this->dropzoneForm = $dropzoneForm;
        return $this;
    }

}