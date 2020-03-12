<?php
namespace GeneralServicer\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use CsnUser\Service\UserService;

/**
 *
 * @author swoopfx
 *        
 */
class SetupPlugin extends AbstractPlugin
{

    protected $pluginManager;
    
    private $generalService;

    protected $redirect;

    protected $options;

    protected $auth;

    protected $roleId;

    protected $redirectPlugin;

    protected $userId;

    protected $isProfile;

    private $isActive;
    
    private $brokerSub;
    // This is an indicator that user has a valid subscription
    

    public function setupRedirect()
    {
        
        
      // if($this->auth->)
        
        if ($this->isProfile == FALSE) {
            
            switch ($this->roleId) {
                
              
                case UserService::USER_ROLE_SETUP_AGENT:
                    
                    /**
                     * Redirects to agents setup page
                     */
                    $this->agentSetup();
                    break;
                
                case UserService::USER_ROLE_SETUP_BROKER:
                    $this->brokerSetup();
                    break;
                // default:
                // $this->redirect->redirectToLogout();
            }
        } elseif ($this->isProfile == true && $this->getIsValid() == false) { // if the account has not been paid for ie activated/
            switch ($this->roleId) {
                case UserService::USER_ROLE_BROKER:
                case UserService::USER_ROLE_SETUP_BROKER:
                    $this->brokerNotActive();
                    break;
                
                case UserService::USER_ROLE_AGENT:
                    $this->agentNotActive();
                    break;
                case UserService::USER_ROLE_BROKER_CHILD:
                    // this redidirects to a no active page on the platform meant for the children
                    break;
            }
        } 

//         else {
//             $this->redirect->toRoute($this->options->getLoginRedirectRoute());
//         }
    }

    private function userProfileSetup()
    {
        return $this->redirect->toRoute('user_ind', array(
            'action' => 'set-profile'
        ));
    }
    
    private function getIsValid(){
        switch ($this->generalService->getUserRoleId()){
            case UserService::USER_ROLE_BROKER:
            case UserService::USER_ROLE_SETUP_BROKER:
                return $this->generalService->getBrokerSubscription()->getIsValid();
                break;
            case UserService::USER_ROLE_BROKER_CHILD:
                return ''; // thie mother broker subscription
                break;
        }
    }

    private function companyProfileSetup()
    {
        // this handles redirection to the comapny setiup form
    }

    private function brokerSetup()
    {
        return $this->redirect->toRoute('user_broker', array(
            'action' => 'setup'
        ));
    }

    private function brokerNotActive()
    {
        return $this->redirect->toRoute('user_broker', array(
            'action' => 'info'
        ));
    }

    private function agentSetup()
    {
        return $this->redirect->toRoute('user_agent', array(
            'action' => 'setup'
        ));
    }

    private function agentNotActive()
    {
        return $this;
    }
    
    // Begin Setters
    
    public function setGeneralService($se){
        $this->generalService = $se;
        return $this;
    }
    public function setOptions($ops)
    {
        $this->options = $ops;
        return $this;
    }

    public function setAuth($ath)
    {
        $this->auth = $ath;
        return $this;
    }

    public function setRoleId($role)
    {
        $this->roleId = $role;
        return $this;
    }
    
    // public function setRedirectPlugin($red)
    // {
    // $this->redirectPlugin = $red;
    
    // return $this;
    // }
    public function setUserId($id)
    {
        $this->userId = $id;
        return $this;
    }
    public function setRedirect($rd)
    {
        $this->redirect = $rd;
        return $this;
    }

    public function setIsProfile($is)
    {
        $this->isProfile = $is;
        return $this;
    }
    
    private function getIsActive(){
        if($this->brokerSub != NULL){
            $this->isActive = $this->brokerSub->getIsValid();
        }
    }

    public function setIsActive($active)
    {
        $this->isActive = $active;
        return $this;
        // This defines if the subscription is active
    }
    
    public function setBrokerSub($syb){
        $this->brokerSub = $syb;
        return $this;
    }
    
    // End Setters
}

