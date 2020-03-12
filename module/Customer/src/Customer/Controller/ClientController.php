<?php
namespace Customer\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\SessionManager;
use CsnUser\Service\UserService;
use Zend\Http\PhpEnvironment\RemoteAddress;
use WasabiLib\Ajax\GritterMessage;
use WasabiLib\Ajax\Response;
use WasabiLib\Modal\WasabiModal;
use WasabiLib\Modal\WasabiModalConfigurator;
use WasabiLib\Modal\WasabiModalView;

/**
 *
 * @author swoopfx
 *        
 */
class ClientController extends AbstractActionController
{

    private $userService;

    private $entityManager;

    private $auth;

    private $customerEntity;

    private $loginForm;

    private $registerForm;

    private $resetPasswordForm;

    private $options;

    private $clientgeneralService;

    private $customerService;

    private $clientService;

    private $smsService;

    private $newUserService;

    private $clientSession;

    // this hold the ID of the broker involved
    private $hiddenSesssion;

    private $forgotPasswordForm;

    // $Tis is the hidden session used by the hidden thing
    public function onDispatch(\Zend\Mvc\MvcEvent $e)
    {
        $response = parent::onDispatch($e);
        
        $this->layout()->setTemplate('client-layout-login');
        return $response;
    }
    
    /**
     * This function is the hook used by rave for event driven achitecture
     * Whenever the hook is called
     * @return mixed
     */
    public function hookAction(){
        return $this->getResponse()->setContent(NULL);
    }
    

    public function loginAction()
    {
        $this->customerRedirectPlugin()->partialRedirection();
        /**
         * If user is already logged in redirect to sureBoard
         */
        
//         $req = $this->getRequest();
//         $servParam = $req->getServer();
//         $rem = $servParam->get("REMOTE_ADDR");
        
        $remAdd = new RemoteAddress();
        $ip = $remAdd->getIpAddress();
        
//         var_dump($rem);
//         var_dump($ip);
//         $resw = "5670";
//         var_dump(doubleval($resw));
        
        $customer = NULL;
        $messages = null;
        $em = $this->entityManager;
        $brokerId = $this->params()->fromRoute("brokerid", NULL);
        $criteria = array(
            'brokerUid' => $brokerId
        );
        if ($brokerId == NULL) {
            $this->flashmessenger()->addErrorMessage("You have not entered the correct brokers id");
            $this->redirect()->toRoute("client_logout");
        }
        
        $broker = $em->getRepository("Users\Entity\InsuranceBrokerRegistered")->findOneBy($criteria);
        if ($broker == NULL) {
            // set a flash indication the Id is not assocaiated with any broker
            $this->flashMessenger()->addErrorMessage("This Broker does not exist in our records");
            $this->redirect()->toRoute('client_logout');
        }
        $form = $this->loginForm;
        $form->setAttributes(array(
            'action' => $this->url()
                ->fromRoute('client_login', array(
                'brokerid' => $brokerId
            ))
        ));
        $cus = NULL;
        $request = $this->getRequest();
        if ($request->isPost()) {
            $data = $request->getPost();
            
            $form->setData($data);
            
            if ($form->isValid()) {
                
                $data = $form->getData();
                $auth = $this->auth;
                // var_dump($auth);
                $adapter = $auth->getAdapter();
                $clientField = $this->params()->fromPost('clientLoginField');
                $phonenumber = $clientField['phonenumber'];
                
                try {
                    $customer = $this->userService->selectUserDQL($phonenumber);
                    // var_dump($customer);
                    if (count($customer) > 0) {
                        $cus = $customer[0];
                    }
                    if (count($cus) == 0) {
                        $messages = 'The username or email is not valid!';
                        return new ViewModel(array(
                            'error' => 'Your authentication credentials are not valid',
                            'form' => $form,
                            'messages' => $messages
                            // 'navMenu' => $this->options->getNavMenu()
                        ));
                    }
                    if ($cus->getRole()->getId() != UserService::USER_ROLE_CUSTOMER) {
                        $messages = 'You are not registered as a customer on our platform';
                        return new ViewModel(array(
                            'error' => 'Customer Error',
                            'form' => $form,
                            'messages' => $messages
                            // 'navMenu' => $this->options->getNavMenu()
                        ));
                    }
                    
                    $adapter->setIdentity($cus->getUsername());
                    $adapter->setCredential($clientField['pin']);
                    
                    $authResult = $auth->authenticate();
                    // if authentication is valid
                    // register The container Session for the client
                    if ($authResult->isValid()) {
                        
                        // var_dump($this->clientSession);
                        $identity = $authResult->getIdentity();
                        $auth->getStorage()->write($identity);
                        $this->clientSession->brokerId = $broker->getId();
                        $this->clientSession->brokerEntity = $broker;
                        $this->clientService->id = $broker->getId();
                        $this->hiddenSesssion->id = $broker->getBrokeruid();
                        if ($this->params()->fromPost('rememberme')) {
                            $time = 1209600; // 14 days (1209600/3600 = 336 hours => 336/24 = 14 days)
                            $sessionManager = new SessionManager();
                            $sessionManager->rememberMe($time);
                        }
                        
                        // put the login redirection condition here
                        // Such that if the reirection conditions is met it redirects to the previous url
                        
                        $this->customerRedirectPlugin()->redirectToPreviousUrl();
                        
                        $this->redirect()->toRoute("board");
                    } else {
                        $this->flashmessenger()->addErrorMessage("There was an error with you login details");
                    }
                    foreach ($authResult->getMessages() as $message) {
                        $messages .= "$message\n";
                    }
                } catch (\Exception $e) {
                    $this->flashmessenger()->addErrorMessage("There was an error with you login detail");
                }
            }
        }
        
        $view = new ViewModel(array(
            'form' => $form,
            'broker' => $broker
        ));
        return $view;
    }

    public function forgotAction()
    {
        $em = $this->entityManager;
        $brokerid = $this->params()->fromRoute("brokerid");
        $request = $this->getRequest();
        $broker = $em->getRepository("Users\Entity\InsuranceBrokerRegistered")->findOneBy(array(
            "brokerUid" => $brokerid
        ));
        $forgotPasswordForm = $this->forgotPasswordForm;
        // $forgotPasswordForm->setAttributes(array(
        // "action" => $this->url()
        // ->fromRoute("client_forgot", $broker->getBrokerUid())
        // ));
        if ($request->isPost()) {
            $post = $request->getPost();
            $postData = $post["forgottenPasswordField"]['usernameoremail'];
            $dql = "SELECT u FROM CsnUser\Entity\User u WHERE (u.username = :user OR u.email = :user) AND u.role = :role";
            $userEntity = $em->createQuery($dql)
                ->setParameters(array(
                'user' => $postData,
                "role" => UserService::USER_ROLE_CUSTOMER
            ))
                ->getResult();
            $user = $userEntity[0];
            if ($user == NULL) {
                $this->flashmessenger()->addErrorMessage("This user is not registered as customer with us");
                $this->redirect()->toRoute("client_forgot", array(
                    "brokerid" => $broker->getBrokerUid()
                ));
            } else {
                $token = md5(uniqid(mt_rand(), true));
                
                $user->setRegistrationToken($token)->setUpdatedOn(new \DateTime());
                try {
                    $fullLink = $this->url()->fromRoute("client_def", array(
                        "action" => "reset-password",
                        "id" => $user->getId(),
                        "i" => $token
                    ), array(
                        'force_canonical' => true
                    ));
                    /**
                     * Send email notification
                     * and sms notification
                     */
                    $em->persist($user);
                    $em->flush();
                    
                    $this->flashmessenger()->addSuccessMessage("A notification has been sent to your registered email");
                    $this->redirect()->toRoute("client_forgot", array(
                        "brokerid" => $broker->getBrokerUid()
                    ));
                } catch (\Exception $e) {
                    $this->flashmessenger()->addErrorMessage("There was a problem sending the reset informaton");
                    $this->redirect()->toRoute("client_forgot", array(
                        "brokerid" => $broker->getBrokerUid()
                    ));
                }
            }
        }
        $view = new ViewModel(array(
            "form" => $forgotPasswordForm,
            "broker" => $broker
        ));
        return $view;
    }

    public function resetPasswordAction()
    {
        $em = $this->entityManager;
        $params = $this->params()->fromRoute();
        $userId = $params["id"];
        $token = $params["i"];
        $userEntity = $em->find("CsnUser\Entity\User", $userId);
        $thisDate = new \DateTime();
        $userUpdatedDate = $userEntity->getUpdatedOn();
        $userToken = $userEntity->getRegistrationToken();
        $customerEntity = $em->getRepository("Customer\Entity\Customer")->findOneBy(array(
            "user" => $userEntity->getId()
        ));
        $brokerEntity = $customerEntity->getCustomerBroker()->getBroker();
        $brokerUid = $brokerEntity->getBrokerUid();
        
        // else var_dump($thisDate->diff($userUpdatedDate)->format("%a"));
        if ($thisDate > $userUpdatedDate && $thisDate->diff($userUpdatedDate)->format("%a") >= 1) {
            $this->flashmessenger()->addErrorMessage("The session for this link has expired");
            $this->redirect()->toRoute("client_login", array(
                "brokerid" => $brokerUid
            ));
        } else {
            if ($token == $userToken) {
                $pin = $this->customerService->pinCodeGenerator();
                $messa = "Your new PIN is " . $pin;
                $this->smsService->setCentralBrokerId($brokerEntity->getId())
                    ->sendBrokerSms($userEntity->getUsername(), "IMAPP", $messa);
                
                try {
                    /**
                     * Send email
                     */
                    $generalService = $this->clientgeneralService->getGeneralService();
                    
                    $messagePointer["to"] = $userEntity->getEmail();
                    $messagePointer['fromName'] = $brokerEntity->getCompanyName();
                    $messagePointer['subject'] = "Reset PinCode";
                    
                    $template = array(
                        "var" => array(
                            "logo" => "", // canonical logo link 
                            "pin" => $pin,
                            "username" => $userEntity->getUsername()
                        ),
                        "template" => ""
                    );
                    
                    $generalService->sendMails();
                    
                    $userEntity->setPassword(UserService::encryptPassword($pin))->setUpdatedOn(new \DateTime());
                    
                    $em->persist($userEntity);
                    $em->flush();
                    
                    $this->flashmessenger()->addSuccessMessage("New Password has been sent to ur mail" . $pin);
                    $this->redirect()->toRoute("client_login", array(
                        "brokerid" => $brokerUid
                    ));
                } catch (\Exception $e) {
                    $this->flashmessenger()->addErrorMessage("There was a problem reseting your pin");
                    $this->redirect()->toRoute("client_login", array(
                        "brokerid" => $brokerUid
                    ));
                }
            } else {
                $this->flashmessenger()->addErrorMessage("The token does not correspond");
                $this->redirect()->toRoute("client_login", array(
                    "brokerid" => $brokerUid
                ));
            }
        }
        
        /**
         * Check the dat of the last update
         * if it is more than 24 houres do
         * Do not process the
         *
         * select the user id and compare the token to see it maches one sent over the wire
         * if it does not match
         * notofy the user
         *
         * if all things workds fine n
         * generate a 4 difgit pin code ,
         * Send as an sms
         * and an email
         */
        return $this->getResponse()->setContent(NULL);
    }
    
   

    public function logoutAction()
    {
        $auth = $this->auth;
        if ($auth->hasIdentity()) {
            $auth->clearIdentity();
            
            $sessionManager = new SessionManager();
            $sessionManager->forgetMe();
        }
        
        $view = new ViewModel();
        return $view;
    }

    public function confirmEmailAction()
    {
        // Use this to confirm the email address of the customer
        // check if the user has already been confirmed
        // check if the id is available
        // if not redirect to login page with fklash messages
        //
        $token = $this->params()->fromRoute('id');
        try {
            $entityManager = $this->entityManager;
            if ($token !== '' && $user = $entityManager->getRepository('CsnUser\Entity\User')->findOneBy(array(
                'registrationToken' => $token
            ))) {
                $user->setRegistrationToken(md5(uniqid(mt_rand(), true)));
                $user->setState($entityManager->find('CsnUser\Entity\State', 2));
                $user->setEmailConfirmed(1);
                $entityManager->persist($user);
                $entityManager->flush();
                
                $viewModel = new ViewModel(array(
                    'navMenu' => $this->options->getNavMenu()
                ));
                $viewModel->setTemplate('csn-user/registration/confirm-email-success');
                return $viewModel;
            } else {
                return $this->redirect()->toRoute('user-index', array(
                    'action' => 'login'
                ));
            }
        } catch (\Exception $e) {
            // return $this->getServiceLocator()->get('csnuser_error_view')->createErrorView(
            // $this->getTranslatorHelper()->translate('Something went wrong during the activation of your account! Please, try again later.'),
            // $e,
            // $this->options->getDisplayExceptions(),
            // $this->options->getNavMenu()
            // );
        }
    }

    /**
     * This makes sure the customer registeres on the appliaction relateive to
     *
     * @return \Zend\View\Model\ViewModel
     */
    public function registerAction()
    {
        $this->customerRedirectPlugin()->alreadyLoggedIn();
        $smsService = $this->smsService;
        // $smsService->sendGeneralSms("08092907113");
        $em = $this->entityManager;
        $registerForm = $this->registerForm;
        $customerEntity = $this->customerEntity;
        $clientService = $this->clientService;
        $registerForm->bind($customerEntity);
        $brokerId = $this->params()->fromRoute("brokerid", NULL);
        $criteria = array(
            'brokerUid' => $brokerId
        );
        
        // create url to submit the form
        $submitionUrl = $this->url()->fromRoute('client_register', array(
            'brokerid' => $brokerId
        ));
        
        // set The form action value
        $registerForm->setAttributes(array(
            'action' => $submitionUrl
        ));
        
        // set Pin code vlidators here
        
        $broker = $em->getRepository("Users\Entity\InsuranceBrokerRegistered")->findOneBy($criteria);
        if ($broker == NULL) {
            // set a flash indication the Id is not assocaiated with any broker
            $this->redirect()->toRoute('client_logout');
        }
        $registerForm->bind($customerEntity);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $data = $request->getPost();
            $registerForm->setData($data);
            $this->setRegisterValidationGroup($registerForm);
            if ($registerForm->isValid()) {
                $res = $clientService->hydrateRegisterClient($customerEntity, $broker);
                if ($res != NULL) {
                    $this->flashmessenger()->addSuccessMessage("Successfully registered on our platform ");
                    $this->redirect()->toRoute("client_login", array(
                        "brokerid" => $brokerId
                    ));
                } else {
                    $this->flashmessenger()->addErrorMessage("There wa a problem registering you");
                    $this->redirect()->toRoute("client_register", array(
                        "brokerid" => $brokerId
                    ));
                }
            }
        }
        // echo $this->getBaseUrl();
        
        $view = new ViewModel(array(
            'broker' => $broker,
            'form' => $registerForm
        ));
        // 're'=>$ue
        
        return $view;
    }

    private function setRegisterValidationGroup($form)
    {
        return $form->setValidationGroup(array(
            'csrf',
            'customerFieldset' => array(
                'user' => array(
                    'username',
                    'email'
                ),
                'name',
                // 'address1',
                // 'address2',
                'city',
                'state',
                'country'
            )
        ));
    }

    /**
     * This page is called whenever there is no hidden session available
     *
     * @return \Zend\View\Model\ViewModel
     */
    public function landingAction()
    {
        $view = new ViewModel();
        return $view;
    }

    // begin setters
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

    public function setOptions($op)
    {
        $this->options = $op;
        return $this;
    }

    public function setLoginForm($form)
    {
        $this->loginForm = $form;
        return $this;
    }

    public function setRegisterForm($form)
    {
        $this->registerForm = $form;
        return $this;
    }

    public function setGeneralService($xser)
    {
        $this->clientgeneralService = $xser;
        return $this;
    }

    public function setCustomerEntity($entity)
    {
        $this->customerEntity = $entity;
        return $this;
    }

    public function setCustomerService($xserv)
    {
        $this->customerService = $xserv;
        return $this;
    }

    public function setClientService($service)
    {
        $this->clientService = $service;
        return $this;
    }

    public function setClientGeneralService($service)
    {
        $this->clientgeneralService = $service;
        return $this;
    }

    public function setSmsService($xserv)
    {
        $this->smsService = $xserv;
        return $this;
    }

    public function setNewUserService($xserv)
    {
        $this->newUserService = $xserv;
        return $this;
    }

    public function setHiddenSession($sess)
    {
        $this->hiddenSesssion = $sess;
        return $this;
    }

    public function setUserService($xserv)
    {
        $this->userService = $xserv;
        return $this;
    }

    public function setClientSession($sess)
    {
        $this->clientSession = $sess;
        return $this;
    }

    public function setForgotPasswordForm($form)
    {
        $this->forgotPasswordForm = $form;
        return $this;
    }
}

