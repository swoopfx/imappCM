<?php
namespace Users\Service;

use Users\Entity\User;
use Zend\Session\SessionManager;

/**
 *
 * @author swoopfx
 *        
 */
class AuthProcessService
{

    /**
     * This defines the entityManager
     *
     * @var unknown
     */
    private $entityManager;

    /**
     * This defines thw options configuration of the authentication service
     *
     * @var unknown
     */
    private $options;

    /**
     * This captures the identity of the user
     *
     * @var unknown
     */
    private $identity;

    private $translator;

    private $authService;

    private $ert;

    private $user;

    private $errorView;
    
    // TODO - Insert your code here
    public function __construct()
    {}

    public function processLogin($requestObject, $form, $params)
    {
        $forView = array();
        $user = $this->user;
        // ,the form is instatiATED IN THE CONTROLLER
        $messages = null;
        /**
         * these are messages to be displayed to the user
         * whenever there is an issue
         */
        
        $form->setValidationGroup('usernameOrEmail', 'password', 'rememberme', 'csrf', 'captcha');
        $form->setData($requestObject->getPost());
        if ($form->isValid()) {
            $data = $form->getData();
            $authService = $this->authService->getAdapter();
            $adapter = $authService->getAdapter();
            $usernameOrEmail = $params->fromPost('usernameOrEmail');
            try {
                $authResult = false;
                $forView['authResult'] = $authResult;
                $userdata = $this->entityManager->getRepository('Users\Entity\User')->getUsersIdentity($usernameOrEmail);
                /**
                 * Call the variable in the database
                 */
                
                if (! isset($userdata)) { // TODO - confirm if the condition is correct
                    $forView['message'] = $this->translator->translate("The Username or Email is not valid");
                    $forView['error'] = $this->translator->translate('Your authentication credentials are not valid');
                    $forView['navMenu'] = '';
                    $forView['form'] = $form;
                    $forView['authResult'] = $authResult;
                }
                
                if ($user->getState()->getId() < 2) {
                    $forView['message'] = $this->translator->translate('Your username is disabled. Please contact an administrator.');
                    $forView['error'] = $this->translator->translate('Your authentication credentials are not valid');
                    $forView['form'] = $form;
                    $forView['navMenu'] = '';
                    $forView['authResult'] = $authResult;
                }
                $authResult = $this->authenticatefromForm($adapter, $params);
                $forView['authResult'] = $authResult;
            } catch (\Exception $e) {
                /**
                 * return error view form the service locator
                 */
                
                return $this->errorView->creatErrorView($this->translator->translate('Something went wrong during login, Please, Try again later.'), $e, $this->options->getDisplayExceptions(), '');
            }
            
            /**
             * insert the forview parameters here
             */
            
            return $forView;
        }
    }

    /**
     * This function authenticates data submitted by the user form
     * and makes sure the remeber me is active
     *
     * @param AuthServiceAdapter $adapter            
     * @param unknown $params            
     * @return boolean
     */
    function authenticatefromForm($adapter, $params)
    {
        $adapter->setIdentityValue($this->user->getUsername());
        $adapter->setCredentialValue($params->fromPost('password'));
        $authResult = $this->authService->authenticate();
        if ($authResult->isValid()) {
            $identity = $authResult->getIdentity();
            $this->authService->getStorage()->write($identity);
            /**
             * This function stores the rmember me for 14 days
             */
            $this->rememberMe($params);
            
            /**
             * return true that the function authentication was successful
             */
            return true;
        } else {
            /**
             * return false that the use authentication was not successful
             */
            
            return false;
        }
    }

    function rememberMe($params)
    {
        if ($params->fromPost('rememberme')) {
            $time = 1209600; // 14 days (1209600/3600) = 336 hours => 336/24 = 14 days
            $sessionMananger = new SessionManager();
            $sessionMananger->rememberMe($time);
        }
    }

    function logoutProcess()
    {
        $auth = $this->authService;
        if ($auth->hasIdentity()) {
            $auth->clearIdentity();
            $sessionManager = new SessionManager();
            $sessionManager->forgetMe();
        }
        
        // at the logout action, make a redirection to the logout redirection pages
    }

    protected function setAllData($data, $entity)
    {
        // TODO - Use this to store all informatiion into the set ata
        // attribute of all this variable of the entity
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
    }

    public function setidentity($id)
    {
        $this->identity = $id;
    }

    public function setOptions($op)
    {
        $this->options = $op;
    }

    public function setAuthService($as)
    {
        $this->authService = $as;
    }

    public function setTranslator($tr)
    {
        $this->translator = $tr;
    }

    public function setUserEntity($user)
    {
        $this->user = $user;
    }

    public function test()
    {
        return "power to the people";
    }

    public function setErrorView($ev)
    {
        return $this->errorView = $ev;
    }
}

?>