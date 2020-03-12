<?php
namespace Customer\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\Plugin\FlashMessenger;
use Zend\Barcode\Barcode;
use WasabiLib\Modal\WasabiModal;
use WasabiLib\Modal\WasabiModalView;
use WasabiLib\Ajax\Response;
use WasabiLib\Ajax\Redirect;

class PolicyController extends AbstractActionController
{

    private $entityManager;

    private $customerBoardService;

    private $customer_policy_session;

    private $clientGeneralService;

    private $claimsPreForm;

    private $renewPolicyForm;

    private $renderer;
    
    private $policyService;

    public function onDispatch(\Zend\Mvc\MvcEvent $e)
    {
        $response = parent::onDispatch($e);
        $this->customerRedirectPlugin()->totalRedirection();
        $this->layout()->setTemplate('client-layout-board');
        return $response;
    }

    // Begin Modal
    
    public function specialtermsmodalAction(){
        $response = new Response();
        $modal = new WasabiModal("standard", "Special Terms");
        
        $modalView = new WasabiModalView("#wasabi", $this->renderer, $modal);
        $response->add($modalView);
        return $this->getResponse()->setContent($response);
    }
    public function renewpolicyAction()
    {
        $em = $this->entityManager;
        $response = new Response();
        $data = $this->params()->fromQuery("data", NULL);
       // $customerPolicySession = $this->customer_policy_session;
       $renewPolicyForm = $this->renewPolicyForm;
       $renewPolicyForm->setAttributes(array(
           "id" => "simpleForm",
           "class" => "form-horizontal form-label-left ajax_element",
           "data-ajax-loader" => "selectObjectLoader",
           "action" => $this->url()
           ->fromRoute("cus_policy/default", array(
               "action" => "processrenewpolicy"
           ))
       ));
       $renewPolicyForm->get("renewPolicyFeildset")->get("isPaid")->setAttributes(array(
           "disabled"=>"disabled"
       ));
       $renewPolicyForm->get("renewPolicyFeildset")->get("isChangePremium")->setAttributes(array(
           "disabled"=>"disabled"
       ));
       $request = $this->getRequest();
       
       if($request->isPost()){
           
       }else{
        if ($data == NULL) {
            $this->flashmessenger()->addErrorMessage("No Policy Identifier");
            $redirect = new Redirect($this->url()->fromRoute("cus_policy"));
            $response->add($redirect);
        } else {
            $policyEntity = $em->find("Policy\Entity\Policy", $data);
            
            
            $viewModel = new ViewModel(array(
                "renewPolicyForm" => $renewPolicyForm,
                "policyEntity"=>$policyEntity,
                "invoiceEntity"=>$this->policyService->getPolicyActiveInvoice($policyEntity),
//                 "data"=>$data
            ));
            $viewModel->setTemplate("policy_renew_policy_customer_form");
            $modal = new WasabiModal("standard", "Renew Policy");
            $modal->setContent($viewModel);
//             $modal->setSize('modal-lg');
            
            $modalView = new WasabiModalView("#wasabi", $this->renderer, $modal);
           
            $response->add($modalView);
        }
       }
        
        return $this->getResponse()->setContent($response);
    }
    
    public function processrenewpolicyAction(){
        
    }
    
    
    public function messageAction(){
        $response = new Response();
        $modal = new WasabiModal("standard", "Broker Communication");

        $modalView = new WasabiModalView("#wasabi", $this->renderer, $modal);
        $response->add($modalView);
        return $this->getResponse()->setContent($response);
    }

    // End modal
    public function indexAction()
    {
        $claimsPreForm = $this->claimsPreForm;
        $customerBoardService = $this->customerBoardService;
        $policy = $customerBoardService->customerPolicy();
        
        $view = new ViewModel(array(
            "policy" => $policy,
            "claimsPreForm" => $claimsPreForm
        ));
        return $view;
    }

    /**
     * This
     */
    public function coverNoteAction()
    {
        $view = new ViewModel(array(
        ));
        return $view;
    }

    public function viewCoverNoteAction()
    {
        $em = $this->entityManager;
        $coverNoteUid = $this->params()->fromRoute("id", NULL);
        if ($coverNoteUid == NULL) {
            $this->flashmessenger()->addErrorMessage("No Covernote Identifier available for this request");
            $this->redirect()->toRoute("cus_policy/default", array(
                "action" => "cover-note"
            ));
        }
        $coverNoteEntity = $em->getRepository("Policy\Entity\CoverNote")->findOneBy(array(
            "coverUid" => $coverNoteUid
        ));
        // var_dump($this->customerBoardService);
        if ($coverNoteEntity == NULL) {
            $this->flashmessenger()->addErrorMessage("No Covernote Identifier available for this request");
            $this->redirect()->toRoute("cus_policy/default", array(
                "action" => "cover-note"
            ));
        }
        // var_dump($this->customerBoardService->getBrokerId());
        $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $this->clientGeneralService->getBrokerId());
        $view = new ViewModel(array(
            "coverNoteEntity" => $coverNoteEntity,
            "brokerEntity" => $brokerEntity
        ));
        return $view;
    }

    public function viewAction()
    {
        $em = $this->entityManager;
        $customerPolicySession = $this->customer_policy_session;
        $id = $this->params()->fromRoute("id", NULL);
        if ($id == NULL) {
            $this->flashmessenger()->addErrorMessage("No Policy Identifier available for this request");
            $this->redirect()->toRoute("cus_policy");
        }
        // $policy = $em->find("Policy\Entity\Policy", $id);
        $policy = $em->getRepository("Policy\Entity\Policy")->findOneBy(array(
            "policyUid" => $id
        ));
        $customerPolicySession->id = $policy->getId();
        
        if ($policy == NULL) {
            $this->flashmessenger()->addErrorMessage("This policy does not exist");
            $this->redirect()->toRoute("cus_policy");
        }
        
        $barcodeOptions = array(
            "text" => strtoupper($policy->getPolicyCode())
        );
        $resOptions = array(
            "imageType" => "gif"
        );
        $barCodeImage = Barcode::factory("code39", "image", $barcodeOptions, $resOptions);
        $view = new ViewModel(array(
            "policy" => $policy,
            "barCodeImage" => $barCodeImage
        ));
        return $view;
    }

    public function preRenewAction()
    {
        $policyId = $this->params()->fromRoute("id", NULL);
        if ($policyId == NULL) {
            $this->flashmessenger()->addErrorMessage("N0 identifier available for this policy");
            $this->redirect()->toRoute("cus_policy");
        }
        
        $this->customer_policy_session->policyId = $policyId;
        if ($this->customer_policy_session->policyId != NULL) {
            $this->redirect()->toRoute("cus_policy/default", array(
                "action" => "renew"
            ));
        } else {
            $this->flashmessenger()->addErrorMessage("No Session Identified for this policy");
            $this->redirect()->toRoute("cus_policy");
        }
        
        return $this->getResponse()->setContent(NULL);
    }

    public function renewAction()
    {
        $em = $this->entityManager;
        $policyId = $this->customer_policy_session->policyId;
        if ($policyId == NULL) {
            $this->flashmessenger()->addErrorMessage("No identifier for this Policy");
            $this->redirect()->toRoute("cus_policy");
        }
        $policyEntity = $em->find("Policy\Entity\Policy", $policyId);
        
        // Renews a Policy
        $view = new ViewModel(array(
            "policy" => $policyEntity
        ));
        return $view;
    }

    public function upComingRenewalsAction()
    {
        $em = $this->entityManager;
        $policy = $em->getRepository("Policy\Entity\Policy")->findCustomerUpcomingRenewablePolicy($this->clientGeneralService->getCustomerId());
        $view = new ViewModel(array(
            "policy" => $policy
        ));
        return $view;
    }

    public function ExpiredPolicyAction()
    {
        $em = $this->entityManager;
        $policy = $em->getRepository("Policy\Entity\Policy")->findCustomerExpiredPolicy($this->clientGeneralService->getCustomerId());
        $view = new ViewModel(array(
            "policy" => $policy
        ));
        return $view;
    }

    public function terminatedPolicyAction()
    {
        $em = $this->entityManager;
        $policy = $em->getRepository("Policy\Entity\Policy")->findCustomerTerminatedPolicy($this->clientGeneralService->getCustomerId());
        $view = new ViewModel(array(
            "policy" => $policy
        ));
        return $view;
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

    public function setCustomerPolicySession($sess)
    {
        $this->customer_policy_session = $sess;
        return $this;
    }

    public function setClientGeneralService($gen)
    {
        $this->clientGeneralService = $gen;
        return $this;
    }

    public function setClaimsPreForm($form)
    {
        $this->claimsPreForm = $form;
        return $this;
    }

    public function setRenewPolicyForm($form)
    {
        $this->renewPolicyForm = $form;
        return $this;
    }

    public function setRenderer($ren)
    {
        $this->renderer = $ren;
        return $this;
    }
    /**
     * @param $this $customer_policy_session
     */
    public function setCustomer_policy_session($customer_policy_session)
    {
        $this->customer_policy_session = $customer_policy_session;
        return $this;
    }

    /**
     * @param $this $policyService
     */
    public function setPolicyService($policyService)
    {
        $this->policyService = $policyService;
        return $this;
    }

}