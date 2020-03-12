<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Policy for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Policy\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use CsnUser\Service\UserService;

class IndexController extends AbstractActionController
{

    private $generalService;

    private $policyService;

    public function indexAction()
    {
        return array();
    }

    public function myPolicyAction()
    {
        $policyService = $this->policyService;
        $policy = $policyService->getMyPolicy();
        $view = new ViewModel(array(
            'policy' => $policy
        ));
        
        return $view;
    }

    /**
     * This gets the policy related to the company
     * Provided the children is logged on
     * 
     * @return \Zend\View\Model\ViewModel
     */
    public function companyPolicyAction()
    {
        $policyService = $this->policyService;
        $userId = $this->identity()
            ->getRole()
            ->getId();
        switch ($userId) {
            case UserService::USER_ROLE_BROKER:
            case UserService::USER_ROLE_SETUP_BROKER:
                $this->redirect()->toRoute('policy/default', array(
                    'action' => 'my-policy-b'
                ));
                break;
            case UserService::USER_ROLE_BROKER_CHILD:
                $companyPolicy = $policyService->getMotherBrokerPolicy();
                $view = new Viewmodel(array(
                    'companyPolicy'=>$companyPolicy,
                ));
                return $view;
                break;
                
            case UserService::USER_ROLE_AGENT:
                break;
        }
    }

    public function myPolicyAAction()
    {}

    public function setgeneralService($service)
    {
        $this->generalService = $service;
        return $this;
    }

    public function setPolicyService($serveice)
    {
        $this->policyService = $serveice;
        return $this;
    }
}
