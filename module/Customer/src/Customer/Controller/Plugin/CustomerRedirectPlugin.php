<?php
namespace Customer\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use CsnUser\Service\UserService;

class CustomerRedirectPlugin extends AbstractPlugin
{

    private $entityManager;

    private $auth;

    private $clientSession;

    private $hiddenSession;

    private $brokerId;

    private $redirect;

    private $request;

    private $referer;

    private $userRole;

    // private
    
    /**
     * This sums up all redirection to the appropraite channel
     * based on the logical conclusion
     */
    public function totalRedirection()
    {
        
        // $this->alreadyLoggedIn();
        $this->notCustomerRedirection();
        $this->notLoggedInRedirection();
    }

    /**
     * This is used when the user is either in the client
     * register, login , changePasswordPage
     */
    public function partialRedirection()
    {
        $this->alreadyLoggedIn();
        $this->notCustomerRedirection();
         //$this->notLoggedInRedirection();
    }

    /**
     * If User is NOt logged in it takes the use to the login page after full and successful logout
     */
    private function notLoggedInRedirection()
    {
        if (! $this->auth->hasIdentity()) {
            
            $this->logoutCondition();
            //$this->getredirect()->toRoute("client_login");
        }
    }

    public function alreadyLoggedIn()
    {
        /**
         * There is a bug here
         * This should only be available o the customer register page
         */
        // $this->redirectToPreviousUrl();
        if ($this->auth->hasIdentity() == true && $this->referer == false && $this->auth->getIdentity()
            ->getRole()
            ->getId() == UserService::USER_ROLE_CUSTOMER) {
            $this->getredirect()->toRoute("board");
        }
    }

    public function redirectToPreviousUrl()
    {
        $request = $this->request;
        $thisUrl = $request->getRequestUri();
        $urlString = substr($thisUrl, 0, 10);
        $matchingString = "/q-client/";
        if ($this->referer != false && $urlString == $matchingString && $this->auth->hasIdentity() == true) {
            $previousUrl = $this->referer->getUri();
            $this->getredirect()->toUrl($previousUrl);
        }
    }

    /**
     * Redirects as the user role is not a customer
     */
    private function notCustomerRedirection()
    {
        $em = $this->entityManager;
        $broker = NULL;
        $brokerUid = NULL;
        
        if (count($this->hiddenSession) != 0) {
            $broker = $em->find("Users\Entity\InsuranceBrokerRegistered", $this->hiddenSession->id);
            $brokerUid = $broker->getBrokerUid();
        }
        if ($this->auth->hasIdentity() == true) {
            $ass = $this->auth->getIdentity()
                ->getRole()
                ->getId();
            if ($this->auth->getIdentity()
                ->getRole()
                ->getId() != UserService::USER_ROLE_CUSTOMER) {
                $this->logoutCondition();
            }
        }
    }

    private function logoutCondition()
    {
        // var_dump($this->hiddenSession->id);
        $em = $this->entityManager;
        if (count($this->hiddenSession) == 0) {
            var_dump($this->hiddenSession->id);
           
            $this->getredirect()->toRoute("client_logout");
        } else {
            var_dump($this->hiddenSession->id);
            $broker = $em->find("Users\Entity\InsuranceBrokerRegistered", $this->hiddenSession->id);
            $brokerUid = $broker->getBrokerUid();
            $this->getredirect()->toRoute("client_login", array("brokerid"=>$brokerUid));
        }
    }

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

    public function setCLientSession($sess)
    {
        $this->clientSession = $sess;
        return $this;
    }

    public function setBrokerId($ids)
    {
        $this->brokerId = $ids;
        return $this;
    }

    public function getredirect()
    {
        return $this->getController()
            ->getPluginManager()
            ->get('Redirect');
    }

    public function setRedirect($red)
    {
        $this->redirect = $red;
        return $this;
    }

    public function setReferer($ref)
    {
        $this->referer = $ref;
        return $this;
    }

    public function setRequest($set)
    {
        $this->request = $set;
        return $this;
    }

    public function setUserRole($role)
    {
        $this->userRole = $role;
        return $this;
    }

    public function setHiddenSession($sess)
    {
        $this->hiddenSession = $sess;
        return $this;
    }
}