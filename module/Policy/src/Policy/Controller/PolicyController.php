<?php
namespace Policy\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
// use Zend\Session\Container;
use Policy\Entity\Policy;
use Policy\Service\PolicyService;
use Policy\Entity\CoverNote;
use Policy\Entity\PolicyFloat;
use Policy\Service\CoverNoteService;
use WasabiLib\Ajax\Redirect;
use WasabiLib\Ajax\Response;
use WasabiLib\Modal\WasabiModal;
use WasabiLib\Modal\WasabiModalConfigurator;
use WasabiLib\Modal\WasabiModalView;
use WasabiLib\Ajax\GritterMessage;
use WasabiLib\Modal\Dialog;
use WasabiLib\Modal\Button;
use Policy\Form\PolicySpecialTermsForm;
use Zend\Form\Form;
use Zend\Form\Fieldset;
use Doctrine\ORM\EntityManager;
use Zend\Session\Container;
use GeneralServicer\Service\TriggerService;
use GeneralServicer\Entity\Document;
use Policy\Form\PolicyForm;
use Policy\Entity\PolicyStatus;
use Policy\Form\PolicyPremiumPayableForm;
use Policy\Entity\PolicyHook;

// use Zend\Db\Sql\Ddl\Column\Date;

/**
 *
 * @author otaba
 *        
 */
class PolicyController extends AbstractActionController
{

    /**
     *
     * @var EntityManager
     */
    private $entityManager;

    /**
     *
     * @var PolicyService
     */
    private $policyService;

    private $mailService;

    private $centralBrokerId;

    private $coverNoteService;

    private $policyGenerationForm;

    private $policyUploadForm;

    private $smsService;

    private $generalService;

    private $customerService;

    private $brokerCustomerSession;

    private $policyFloatForm;

    private $policyRevokeForm;

    private $policySpecialTermsForm;

    private $policyStatusForm;

    /**
     *
     * @var PolicyPremiumPayableForm
     */
    private $policyPremiumPayableForm;

    // for floating policy not attched to a proposal, offer , or package
    private $renewPolicyForm;

    // form for the renewal of policy
    /**
     *
     * @var PolicyForm
     */
    private $policyForm;

    private $dropZoneForm;

    private $blobService;

    private $renderer;

    private $policySession;

    public function onDispatch(\Zend\Mvc\MvcEvent $e)
    {
        $response = parent::onDispatch($e);
        // $response = parent::on
        $this->redirectPlugin()->redirectCondition();
        return $response;
    }

    public function __construct()
    {}

    // Begin modal
    public function policyhookreminderAction()
    {
        $response = new Response();
        $gritter = new GritterMessage();
        try {

            $em = $this->entityManager;
            $data = $this->params()->fromQuery("data");
            // $brokerId = $this->centralBrokerId;
            // var_dump("");
            $broker = $em->find("Users\Entity\InsuranceBrokerRegistered", $this->centralBrokerId);
            /**
             *
             * @var PolicyHook $policyHookEntity
             */
            $policyHookEntity = $em->getRepository("Policy\Entity\PolicyHook")->findOneBy(array(
                "hookId" => $data
            ));

            $policyEntity = $policyHookEntity->getPolicy();
            $mailParam = array(
                "messagePointers" => array(
                    "to" => $policyEntity->getCoverNote()
                        ->getCustomer()
                        ->getUser()
                        ->getEmail(),
                    "fromName" => $broker->getBrokerName(),
                    "subject" => "Policy Renewal Reminder"
                ),
                "template" => array(
                    "template" => "general-mail-default",
                    "var" => array(
                        "logo" => $this->generalService->getBrokerAbsoluteLogo(),
                        "message" => "We are waiting  for your action on the finalization of the policy {$policyHookEntity->getPolicy()->getPolicyCode()}, please login to you portal to finalze the renewal process",

                        // "message" => "Your claim title {$claimsEntity->getClaimTopic()} funds has been disbursed",
                        "title" => "Policy Renewal Reminder"
                    )
                )
            );
            $this->getEventManager()->trigger(TriggerService::TRIGGER_GENERAL_EMAIL_SEND, $this, $mailParam);
          
            $gritter->setText("Successfully reminder customer");
            $gritter->setTitle("Reminder Success");
            $gritter->setType(GritterMessage::TYPE_SUCCESS);
            $response->add($gritter);
            return $this->getResponse()->setContent($response);
        } catch (\Exception $e) {
            $gritter->setTitle("Error");
            $gritter->setText("There ws a preoblem reminding the customer");
            $gritter->setType(GritterMessage::TYPE_ERROR);
            
            $response->add($gritter);
        }
    }

    public function pendingpolicyhookAction()
    {
        try {

            $em = $this->entityManager;
            $response = new Response();
            $modal = new WasabiModal("standard", "View Pending Renewal");
            $policyService = $this->policyService;
            $policySession = $policyService->getPolicySession();
            $policyId = $policySession->policyId;
            $policyEntity = $em->getRepository("Policy\Entity\Policy")->findOneBy(array(
                "policyUid" => $policyId
            ));
            $hooks = $policyService->getPolicyHookRenewable($policyEntity->getId());

            $viewModel = new ViewModel(array(
                "hooks" => $hooks
            ));
            $viewModel->setTemplate("policy-policy-hook-renewal-list-snippet");

            $modal->setContent($viewModel);
            $modalView = new WasabiModalView("#wasabi_modal", $this->renderer, $modal);

            $response->add($modalView);
            return $this->getResponse()->setContent($response);
        } catch (\Exception $e) {
            var_dump($e->getMessage());
        }
    }

    public function viewpremiumchangereasonmodalAction()
    {
        $em = $this->entityManager;
        $response = new Response();
        $modal = new WasabiModal("standard", "Reason for premium change");
        $policyService = $this->policyService;
        $policySession = $policyService->getPolicySession();
        $policyId = $policySession->policyId;
        if ($policyId == NULL) {
            $redirect = new Redirect($this->url()->fromRoute("policy/default", array(
                "action" => "manage"
            )));
            $response->add($redirect);
            return $this->getResponse()->setContent($response);
        }
        $policyEntity = $em->getRepository("Policy\Entity\Policy")->findOneBy(array(
            "policyUid" => $policyId
        ));
        $viewModel = new ViewModel(array(
            "desc" => $policyEntity->getCoverNote()->getPremiumChangeReason()
        ));
        $viewModel->setTemplate("proposal-desc-modal");
        $modal->setContent($viewModel);
        $modalView = new WasabiModalView("#wasabi_modal", $this->renderer, $modal);
        $response->add($modalView);
        return $this->getResponse()->setContent($response);
    }

    public function changepolicystatusmodalAction()
    {
        $em = $this->entityManager;
        $response = new Response();
        $policyStatusForm = $this->policyStatusForm;
        $policyStatusForm->setAttributes(array(
            "id" => "simpleForm",
            "class" => "form-horizontal form-label-left ajax_element",
            "data-ajax-loader" => "changepolicystatusmodal",
            "action" => $this->url()
                ->fromRoute("policy/default", array(
                "action" => "changepolicystatusmodal"
            ))
        ));
        $gritter = new GritterMessage();
        $request = $this->getRequest();
        if ($request->isPost()) {
            $post = $request->getPost();
            $policyStatusForm->setData($post);
            if ($policyStatusForm->isValid()) {
                $data = $post['policyStatusFieldset']['status'];
                $policyService = $this->policyService;
                $policySession = $policyService->getPolicySession();
                $policyId = $policySession->policyId;
                if ($policyId != NULL) {
                    /**
                     *
                     * @var Policy $policyEntity
                     */
                    $policyEntity = $em->getRepository("Policy\Entity\Policy")->findOneBy(array(
                        "policyUid" => $policyId
                    ));
                    /**
                     *
                     * @var PolicyStatus $policyStatusEntity
                     */
                    $policyStatusEntity = $em->find("Policy\Entity\PolicyStatus", $data);
                    $policyEntity->setPolicyStatus($policyStatusEntity)->setUpdatedOn(new \DateTime());
                    $em->persist($policyEntity);
                    $em->flush();
                    $gritter->setTitle("Success");
                    $gritter->setText("Policy Status Changed");
                    $gritter->setType(GritterMessage::TYPE_SUCCESS);
                    $gritter->setSticky(TRUE);

                    $response->add($gritter);

                    $redirect = new Redirect($this->url()->fromRoute("policy/default", array(
                        "action" => "manage"
                    )));
                    $notificationParam = array(
                        "topic" => "Changed Policy Status",
                        "type" => TriggerService::NOTIFICATION_TYPE_POLICY_ACTION,
                        "message" => "The status of the policy was chaged to " . $policyStatusEntity->getStatus()->getStatusWord(),
                        "policy" => $policyEntity->getId(),
                        "url" => $this->url()->fromRoute("policy/default", array(
                            "action" => "premanage",
                            "id" => $policyId
                        ), array(
                            'force_canonical' => true
                        ))
                    );
                    $this->getEventManager()->trigger(TriggerService::TIGGER_NOTIFICATION, $this, $notificationParam);

                    $response->add($redirect);
                } else {
                    $gritter->setTitle("Identifier Error");
                    $gritter->setText("The policy Identifier is absent");
                    $gritter->setType(GritterMessage::TYPE_ERROR);
                    $gritter->setSticky(TRUE);

                    $response->add($gritter);
                }
            }
        } else {
            $modal = new WasabiModal("standard", "Change Policy Status");
            $viewModel = new ViewModel(array(
                "form" => $policyStatusForm
            ));
            $viewModel->setTemplate("policy-status-form-snippet");
            $modal->setContent($viewModel);
            $modalView = new WasabiModalView("#wasabi_modal", $this->renderer, $modal);
            $response->add($modalView);
        }
        return $this->getResponse()->setContent($response);
    }

    public function changepremiumpayablemodalAction()
    {
        $em = $this->entityManager;
        $response = new Response();
        $policyPremiumPayableForm = $this->policyPremiumPayableForm;
        $policyPremiumPayableForm->setAttributes(array(
            "id" => "simpleForm",
            "class" => "form-horizontal form-label-left ajax_element",
            "data-ajax-loader" => "changepolicystatusmodal",
            "action" => $this->url()
                ->fromRoute("policy/default", array(
                "action" => "changepremiumpayablemodal"
            ))
        ));
        $request = $this->getRequest();
        $gritter = new GritterMessage();
        if ($request->isPost()) {
            $post = $request->getPost();
            $policyPremiumPayableForm->setData($post);

            if ($policyPremiumPayableForm->isValid()) {

                $premium = $post['policyPremiumPayableFieldset']['premiumPayable'];
                $reason = $post['policyPremiumPayableFieldset']['premiumChangeReason'];
                $policyService = $this->policyService;
                $policySession = $policyService->getPolicySession();
                $policyId = $policySession->policyId;
                if ($policyId != NULL) {
                    /**
                     *
                     * @var Policy $policyEntity
                     */
                    $policyEntity = $em->getRepository("Policy\Entity\Policy")->findOneBy(array(
                        "policyUid" => $policyId
                    ));
                    $coverNoteEntity = $policyEntity->getCoverNote();
                    $coverNoteEntity->setPremiumPayable($premium)->setPremiumChangeReason($reason);

                    $policyEntity->setUpdatedOn(new \DateTime());
                    $em->persist($coverNoteEntity);
                    $em->persist($policyEntity);
                    try {
                        $em->flush();
                        $gritter->setTitle("Success");
                        $gritter->setText("Policy Status Changed");
                        $gritter->setType(GritterMessage::TYPE_SUCCESS);
                        $gritter->setSticky(TRUE);

                        $response->add($gritter);

                        $redirect = new Redirect($this->url()->fromRoute("policy/default", array(
                            "action" => "manage"
                        )));
                        $notificationParam = array(
                            "topic" => "Changed Policy premium Value",
                            "type" => TriggerService::NOTIFICATION_TYPE_POLICY_ACTION,
                            "action" => TRUE,

                            "message" => "The Value of the premium was changed to &#8358;{$premium}",
                            "policy" => $policyEntity->getId(),
                            "url" => $this->url()->fromRoute("policy/default", array(
                                "action" => "premanage",
                                "id" => $policyId
                            ), array(
                                'force_canonical' => true
                            ))
                        );
                        $this->getEventManager()->trigger(TriggerService::TIGGER_NOTIFICATION, $this, $notificationParam);

                        $response->add($redirect);
                    } catch (\Exception $e) {
                        var_dump($e->getMessage());
                    }
                } else {
                    $gritter->setTitle("Identifier Error");
                    $gritter->setText("The policy Identifier is absent");
                    $gritter->setType(GritterMessage::TYPE_ERROR);
                    $gritter->setSticky(TRUE);

                    $response->add($gritter);
                }
            }
        } else {

            $modal = new WasabiModal("standard", "Change Premium Payable");
            $viewModel = new ViewModel(array(
                "form" => $policyPremiumPayableForm
            ));
            $viewModel->setTemplate("policy-premium-payable-form-snippet");
            $modal->setContent($viewModel);
            $modalView = new WasabiModalView("#wasabi_modal", $this->renderer, $modal);
            $response->add($modalView);
        }
        return $this->getResponse()->setContent($response);
    }

    public function viewallpropertylistmodalAction()
    {
        $response = new Response();
        $modal = new WasabiModal("standard", "View All Property List");
        $viewModel = new ViewModel();

        $modalView = new WasabiModalView("#wasabi_modal", $this->renderer, $modal);
        $response->add($modalView);
        return $this->getResponse()->setContent($response);
    }

    public function renewpolicymodalAction()
    {
        $response = new Response();
        $em = $this->entityManager;
        $gritter = new GritterMessage();
        $policyService = $this->policyService;
        $policySession = $policyService->getPolicySession();
        $data = $this->params()->fromQuery("data", NULL);

        // $renewPolicyForm = $this->renewPolicyForm;
        $renewPolicyForm = $this->renewPolicyForm;
        $renewFieldset = $renewPolicyForm->get("renewPolicyFeildset");
        // $selectDate = new Fieldset();
        $user = $this->identity();
        $id = NULL;

        if ($data != NULL) {
            $id = $data;
            $policySession->policyId = $id;
        } else {
            $id = $policySession->policyId;
        }

        if ($id != NULL) {
            /**
             *
             * @var Policy $policyEntity
             */
            $policyEntity = $em->getRepository("Policy\Entity\Policy")->findOneBy(array(
                "policyUid" => $id
            ));
        }
        $renewPolicyForm->setAttributes(array(
            "id" => "simpleForm",
            "class" => "form-horizontal form-label-left ajax_element",
            "data-ajax-loader" => "renewPolicy",
            "action" => $this->url()
                ->fromRoute("policy/default", array(
                "action" => "renewpolicymodal"
            ))
        ));
        $request = $this->getRequest();
        if ($request->isPost()) {
            $post = $request->getPost();
            $renewPolicyForm->setData($post);
            if ($renewPolicyForm->isValid()) {
                $data = $renewPolicyForm->getData();
                $fieldsetData = $data["renewPolicyFeildset"];
                // $gritter->setType(GritterMessage::TYPE_SUCCESS);
                // $gritter->setTitle("Success");
                // $gritter->setText("Great");
                // $response->add($gritter);

                // if isPaid
                try {

                    $em = $policyService->renewpolicy($fieldsetData, $policyEntity, $em);
                    // var_dump($policyEntity->getEndDate()) ;
                    $em->flush();

                    $notificationParam = array(
                        "topic" => "Policy Renewal",
                        "type" => TriggerService::NOTIFICATION_TYPE_POLICY_ACTION,
                        "action" => TRUE,
                        "initiator" => $user->getId(),
                        "recipient" => $policyEntity->getCoverNote()
                            ->getCustomer()
                            ->getUser()
                            ->getId(),
                        "message" => "An action to renew the policy {$policyEntity->getPolicyCode()} has been initatited, please review",
                        "policy" => $policyEntity->getId(),
                        "url" => $this->url()->fromRoute("policy/default", array(
                            "action" => "premanage",
                            "id" => $id
                        ), array(
                            'force_canonical' => true
                        ))
                    );
                    $this->getEventManager()->trigger(TriggerService::TIGGER_NOTIFICATION, $this, $notificationParam);

                    $gritter->setTitle("Policy Renewal Initiated");
                    $gritter->setText("Renewal of this policy has been initiated");
                    $gritter->setType(GritterMessage::TYPE_SUCCESS);
                    $gritter->setSticky(TRUE);

                    $response->add($gritter);
                    $redirect = new Redirect($this->url()->fromRoute("policy/default", array(
                        "action" => "manage"
                    )));
                    $response->add($redirect);
                } catch (\Exception $e) {
                    // var_dump($e->getMessage());
                    $gritter->setTitle("Error");
                    $gritter->setText("Error renewing policy");
                    $gritter->setType(GritterMessage::TYPE_ERROR);

                    $response->add($gritter);
                    return $this->getResponse()->setContent($response);
                }
            } else {
                $gritter->setTitle("Validation Error");
                $gritter->setText("Error renewing policy");
                $gritter->setType(GritterMessage::TYPE_ERROR);

                $response->add($gritter);
            }
        } else {
            if ($id == NULL) {

                $gritter->setTitle("Error");
                $gritter->setText("Error: Identifier errror");
                $gritter->setType(GritterMessage::TYPE_ERROR);

                $response->add($gritter);
            } else {
                $policyEntity = $em->getRepository("Policy\Entity\Policy")->findOneBy(array(
                    "policyUid" => $id
                ));

                $viewModel = new ViewModel(array(
                    "renewPolicyForm" => $renewPolicyForm,
                    "policyEntity" => $policyEntity,
                    "invoiceEntity" => $this->policyService->getPolicyActiveInvoice($policyEntity)
                    // "data"=>$data
                ));
                $viewModel->setTemplate("policy_renew_policy_customer_form");
                $modal = new WasabiModal("standard", "Renew Policy");
                $modal->setContent($viewModel);
                // $modal->setSize('modal-lg');

                $modalView = new WasabiModalView("#wasabi_modal", $this->renderer, $modal);

                $response->add($modalView);
            }
        }
        return $this->getResponse()->setContent($response);
    }

    /**
     * This function provides an async and modal function call
     *
     * @return mixed
     */
    public function viewpolicymodalAction()
    {
        $em = $this->entityManager;

        $response = new Response();
        $wasabiModal = new WasabiModal("standard", "Policy Details");
        $id = $this->params()->fromQuery("data");

        $policyEntity = $em->find("Policy\Entity\Policy", $id);
        $wasabiModal->setSize(WasabiModalConfigurator::MODAL_LG);

        $viewModel = new ViewModel(array(
            'policyEntity' => $policyEntity
        ));
        $viewModel->setTemplate("policy-modal-policy-certificate-modal");
        $wasabiModal->setContent($viewModel);
        $modalView = new WasabiModalView("#wasabi_modal", $this->renderer, $wasabiModal);

        $response->add($modalView);
        return $this->getResponse()->setContent($response);
    }

    /**
     * Edits the policy
     * In the nearest futiure provide autorization from the mother broker
     *
     * @return mixed
     */
    public function editpolicymodalAction()
    {
        $response = new Response();
        $em = $this->entityManager;
        $policyService = $this->policyService;
        $policySession = $policyService->getPolicySession();
        $policyId = $policySession->policyId;

        $gritter = new GritterMessage();
        if ($policyId == NULL) {
            $gritter->setText("Error: Abssent Identifer");
            $gritter->setTitle("Error");
            $gritter->setType(GritterMessage::TYPE_ERROR);

            $response->add($gritter);
        }

        $policyEntity = $em->getRepository("Policy\Entity\Policy")->findOneBy(array(
            "policyUid" => $policyId
        ));
        $policyForm = $this->policyForm;

        $policyForm->setAttributes(array(
            "id" => "simpleForm",
            "class" => "form-horizontal form-label-left ajax_element",
            "data-ajax-loader" => "editpolicy",
            "action" => $this->url()
                ->fromRoute("policy/default", array(
                "action" => "editpolicymodal"
            ))
        ));

        $policyForm->bind($policyEntity);
        // $policyForm->get("policyFieldset")->get("coverNote")
        $request = $this->getRequest();
        if ($request->isPost()) {
            $post = $request->getPost();
            $policyForm->setData($post);
            $policyForm->setValidationGroup(array(
                "policyFieldset" => array(
                    "policyName",
                    "policyCode",
                    "isAutoRenew",
                    "startDate",
                    "endDate",
                    "extraInfo"
                )
            ));

            if ($policyForm->isValid()) {
                try {
                    $em->persist($policyEntity);
                    $em->flush();

                    $gritter->setTitle("Success");
                    $gritter->setText("Policy Edited Successfully");
                    $gritter->setType(GritterMessage::TYPE_SUCCESS);

                    $response->add($gritter);
                    // $this->url()
                    $redirect = new Redirect($this->url()->fromRoute("policy/default", array(
                        "action" => "manage"
                    )));

                    $this->flashMessenger()->addSuccessMessage("Policy Edited Successfully");
                    $notificationParam = array(
                        "topic" => "Edited Policy",
                        "type" => TriggerService::NOTIFICATION_TYPE_POLICY_ACTION,
                        "message" => "",
                        "policy" => $policyEntity->getId(),
                        "url" => $this->url()->fromRoute("policy/default", array(
                            "action" => "premanage",
                            "id" => $policyId
                        ), array(
                            'force_canonical' => true
                        ))
                    );
                    $this->getEventManager()->trigger(TriggerService::TIGGER_NOTIFICATION, $this, $notificationParam);
                    $response->add($redirect);
                } catch (\Exception $e) {
                    $gritter->setTitle("Hydration Error");
                    $gritter->setText("Error Hydrating data");
                    $gritter->setType(GritterMessage::TYPE_ERROR);

                    $response->add($gritter);
                }
            } else {
                $gritter->setText("Error: Invalid Input");
                $gritter->setTitle("Validation Error");
                $gritter->setType(GritterMessage::TYPE_ERROR);

                $response->add($gritter);
            }
        } else {
            $modal = new WasabiModal("standard", "Edit Policy");
            $viewModel = new ViewModel(array(
                "policyForm" => $policyForm,
                "policyEntity" => $policyEntity
            ));
            $viewModel->setTemplate("edit_policy_form");
            $modal->setContent($viewModel);
            $modalView = new WasabiModalView("#wasabi_modal", $this->renderer, $modal);
            $response->add($modalView);
        }
        return $this->getResponse()->setContent($response);
    }

    public function suspensioninfoAction()
    {
        $response = new Response();
        $em = $this->entityManager;
        $policyService = $this->policyService;
        $policySession = $policyService->getPolicySession();
        $policyId = $policySession->policyId;
        $policyEntity = $em->getRepository("Policy\Entity\Policy")->findOneBy(array(
            "policyUid" => $policyId
        ));

        // $policyEntity = new Policy();
        $modal = new WasabiModal("standard", "Suspension Info");

        $viewModel = new ViewModel(array(
            "reason" => $policyEntity->getSuspendedReason(),
            "description" => $policyEntity->getReasonDescription()
        ));
        $viewModel->setTemplate("policy_suspension_info_snippet");
        $modal->setContent($viewModel);
        $modalView = new WasabiModalView("#wasabi_modal", $this->renderer, $modal);
        $response->add($modalView);
        return $this->getResponse()->setContent($response);
    }

    /**
     * Provides a dialog for confirmation of the revokation attempt
     *
     * @return mixed
     */
    public function revokeconfirmationAction()
    {
        $response = new Response();
        $dialog = new Dialog("Dialog", "Confirm Action", "Are you sure you want to revoke this policy", Dialog::TYPE_SUCCESS);
        $cbutton = new Button("Accept");
        $cbutton->setAction($this->url()
            ->fromRoute("policy/default", array(
            "action" => "revoke"
        )));
        $dialog->setTitle("Policy Revoke/Cancel");
        $dialog->setConfirmButton($cbutton);
        // $dialog->set

        $modalView = new WasabiModalView("#wasabi_modal", $this->renderer, $dialog);
        $response->add($modalView);
        return $this->getResponse()->setContent($response);
    }

    public function unrevokeconfirmationAction()
    {
        $response = new Response();
        $dialog = new Dialog("Dialog", "Confirm Action", "Are you sure you want to activate this policy", Dialog::TYPE_SUCCESS);
        $cbutton = new Button("Accept");
        $cbutton->setAction($this->url()
            ->fromRoute("policy/default", array(
            "action" => "activate"
        )));
        $dialog->setTitle("Activate Policy");
        $dialog->setConfirmButton($cbutton);
        // $dialog->set

        $modalView = new WasabiModalView("#wasabi_modal", $this->renderer, $dialog);
        $response->add($modalView);
        return $this->getResponse()->setContent($response);
    }

    /**
     * Perform suspension on the policy
     * In the nearest future provide authorization from the mother broker
     *
     * @return mixed
     */
    public function revokeAction()
    {
        $em = $this->entityManager;
        $response = new Response();
        $policyRevokeForm = $this->policyRevokeForm;
        $policyRevokeForm->setAttributes(array(
            "id" => "simpleForm",
            "class" => "form-horizontal form-label-left ajax_element",
            "data-ajax-loader" => "revoke",
            "action" => $this->url()
                ->fromRoute("policy/default", array(
                "action" => "revoke"
            ))
        ));
        $modal = new WasabiModal("standard", "Suspend Policy");
        $gritter = new GritterMessage();
        $policyEntity = NULL;
        $policyService = $this->policyService;
        $policySession = $policyService->getPolicySession();
        $id = $policySession->policyId; // policy Uid
                                        // if ($id == NULL) {
                                        // $this->flashMessenger()->addErrorMessage("Policy Session ID absent");
                                        // $this->redirect()->toRoute("proposal/default", array(
                                        // "action" => "all"
                                        // ));
                                        // } else {
        $policyEntity = $em->getRepository("Policy\Entity\Policy")->findOneBy(array(
            "policyUid" => $id
        ));
        // }
        $request = $this->getRequest();

        if ($request->isPost()) {
            $post = $request->getPost();
            $policyRevokeForm->setData($post);

            if ($policyRevokeForm->isValid()) {
                $data = $policyRevokeForm->getData();
                try {
                    $policyEntity->setOtherSuspension($data['revokePolicyFieldset']["otherSuspension"])
                        ->setReasonDescription($data['revokePolicyFieldset']["reasonDescription"])
                        ->setPolicyStatus($em->find("Policy\Entity\PolicyStatus", PolicyService::POLICY_STATUS_SUSPENDED))
                        ->setUpdatedOn(new \DateTime())
                        ->setSuspendedReason($em->find("Settings\Entity\PolicyRevokeReason", $data['revokePolicyFieldset']['suspendedReason']));

                    $em->persist($policyEntity);
                    $em->flush();

                    $gritter->setType(GritterMessage::TYPE_SUCCESS);
                    $gritter->setTitle("Success");
                    $gritter->setText("Policy successfully Suspended");
                    // $gritter->setType(GritterMessage::TYPE_SUCCESS);

                    $response->add($gritter);
                    $redirect = new Redirect($this->url()->fromRoute("policy/default", array(
                        "action" => "manage"
                    )));

                    $this->flashMessenger()->addSuccessMessage("Policy successfully Suspended");

                    $notificationParam = array(
                        "topic" => "Policy was revoked",
                        "type" => TriggerService::NOTIFICATION_TYPE_POLICY_ACTION,
                        "message" => "",
                        "policy" => $policyEntity->getId(),
                        "url" => $this->url()->fromRoute("policy/default", array(
                            "action" => "premanage",
                            "id" => $id
                        ), array(
                            'force_canonical' => true
                        ))
                    );
                    $this->getEventManager()->trigger(TriggerService::TIGGER_NOTIFICATION, $this, $notificationParam);

                    $response->add($redirect);
                } catch (\Exception $e) {
                    $gritter->setTitle("Hydration Error");
                    $gritter->setText("System could not process suspension order");
                    $gritter->setType(GritterMessage::TYPE_ERROR);

                    $response->add($gritter);
                }
            }
        } else {
            $modalView = new WasabiModalView("#wasabi_modal", $this->renderer, $modal);
            $viewModel = new ViewModel(array(
                "policyRevokeForm" => $policyRevokeForm
            ));
            $viewModel->setTemplate("policy_revoke_form");
            $modal->setContent($viewModel);
            $response->add($modalView);
        }
        return $this->getResponse()->setContent($response);
    }

    /**
     * This function activates the policy back
     *
     * @return mixed
     */
    public function activateAction()
    {
        $response = new Response();
        $em = $this->entityManager;
        $policyService = $this->policyService;
        $policySession = $policyService->getPolicySession();
        $policyId = $policySession->policyId;
        $policyEntity = $em->getRepository("Policy\Entity\Policy")->findOneBy(array(
            "policyUid" => $policyId
        ));
        $gritter = new GritterMessage();
        if ($policyId == NULL || $policyEntity == NULL) {
            $gritter->setTitle("Error");
            $gritter->setText("Identifier Error");
            $gritter->setType(GritterMessage::TYPE_ERROR);

            $response->add($gritter);
        } else {
            // $gritter = new GritterMessage();
            // $policyEntity = new Policy();
            $policyEntity->setPolicyStatus($em->find("Policy\Entity\PolicyStatus", PolicyService::POLICY_STATUS_ISSUED_BUT_PENDING))
                ->setUpdatedOn(new \DateTime());
            try {
                $em->persist($policyEntity);
                $em->flush();

                $gritter->setTitle("Success");
                $gritter->setText("Successfully activated policy");
                $gritter->setType(GritterMessage::TYPE_SUCCESS);

                $response->add($gritter);
                $this->flashMessenger()->addSuccessMessage("Successfully activated policy");
                $redirect = new Redirect($this->url()->fromRoute("policy/default", array(
                    "action" => "manage"
                )));

                $notificationParam = array(
                    "topic" => "Policy was re-activated",
                    "type" => TriggerService::NOTIFICATION_TYPE_POLICY_ACTION,
                    "message" => "",
                    "policy" => $policyEntity->getId(),
                    "url" => $this->url()->fromRoute("policy/default", array(
                        "action" => "premanage",
                        "id" => $policyId
                    ), array(
                        'force_canonical' => true
                    ))
                );
                $this->getEventManager()->trigger(TriggerService::TIGGER_NOTIFICATION, $this, $notificationParam);

                $response->add($redirect);
            } catch (\Exception $e) {
                $gritter->setTitle("Error");
                $gritter->setText("Error activating policy");
                $gritter->setType(GritterMessage::TYPE_ERROR);

                $response->add($gritter);
            }
        }
        // $modal = new WasabiModal("standard", "Activate Policy");

        // $modalView = new WasabiModalView("#wasabi_modal", $this->renderer, $dialog);
        // $response->add($modalView);
        return $this->getResponse()->setContent($response);
    }

    /**
     * This function enters the special terms on the policy
     *
     * @return mixed
     */
    public function specialtermsAction()
    {
        $em = $this->entityManager;
        $response = new Response();
        $policySpecialTermsForm = $this->policySpecialTermsForm;
        $policyService = $this->policyService;
        $policySession = $policyService->getPolicySession();
        $id = $policySession->policyId; // policy Uid
        $policyEntity = $em->getRepository("Policy\Entity\Policy")->findOneBy(array(
            "policyUid" => $id
        ));
        $policySpecialTermsForm->bind($policyEntity);
        $gritter = new GritterMessage();
        $request = $this->getRequest();
        if ($request->isPost()) {

            if ($id == NULL || $policyEntity == NULL) {
                $gritter->setTitle("Error");
                $gritter->setType(GritterMessage::TYPE_ERROR);
                $gritter->setText("ERROR: Identifier Error");

                $response->add($gritter);
            } else {
                $post = $request->getPost();
                $policySpecialTermsForm->setData($post);
                if ($policySpecialTermsForm->isValid()) {

                    $data = $policySpecialTermsForm->getData();
                    $policyEntity->setIsSpecialTerms(TRUE)
                        ->setSpecialTerms($data->getSpecialTerms())
                        ->setUpdatedOn(new \DateTime());

                    try {
                        $em->persist($policyEntity);
                        $em->flush();

                        $gritter->setTitle("SUCCESS");
                        $gritter->setType(GritterMessage::TYPE_SUCCESS);
                        $gritter->setText("SUCCESS: Identifier Error");

                        $response->add($gritter);

                        $redirect = new Redirect($this->url()->fromRoute("policy/default", array(
                            "action" => "manage"
                        )));

                        $notificationParam = array(
                            "topic" => "Special terms included",
                            "type" => TriggerService::NOTIFICATION_TYPE_POLICY_ACTION,
                            "message" => substr($data->getSpecialTerms(), 0, 50) . "...",
                            "policy" => $policyEntity->getId(),
                            "url" => $this->url()->fromRoute("policy/default", array(
                                "action" => "premanage",
                                "id" => $id
                            ), array(
                                'force_canonical' => true
                            ))
                        );
                        $this->getEventManager()->trigger(TriggerService::TIGGER_NOTIFICATION, $this, $notificationParam);

                        $response->add($redirect);
                    } catch (\Exception $e) {
                        $gritter->setTitle("Error");
                        $gritter->setType(GritterMessage::TYPE_ERROR);
                        $gritter->setText("ERROR: Hydration Error");

                        $response->add($gritter);
                    }
                }
            }
        } else {
            $policySpecialTermsForm->setAttributes(array(
                "id" => "simpleForm",
                "class" => "form-horizontal form-label-left ajax_element",
                "data-ajax-loader" => "specialTermsf",
                "action" => $this->url()
                    ->fromRoute("policy/default", array(
                    "action" => "specialterms"
                ))
            ));
            $modal = new WasabiModal("standard", "Special Terms");
            $viewModel = new ViewModel(array(
                "form" => $policySpecialTermsForm
            ));
            $viewModel->setTemplate("policy_special_terms_form");
            $modal->setContent($viewModel);

            $modalView = new WasabiModalView("#wasabi_modal", $this->renderer, $modal);
            $response->add($modalView);
        }
        return $this->getResponse()->setContent($response);
    }

    public function clearspecialtermsAction()
    {
        $response = new Response();
        $em = $this->entityManager;
        $policyService = $this->policyService;
        $policySession = $policyService->getPolicySession();
        $policyUid = $policySession->policyId;
        $gritter = new GritterMessage();
        /**
         *
         * @var Policy $policyEntity
         */
        $policyEntity = NULL;
        if ($policyUid == NULL) {
            $gritter->setTitle("Error");
            $gritter->setText("Absent Identifier Error");
            $gritter->setType(GritterMessage::TYPE_ERROR);
            $response->add($gritter);
        } else {
            $policyEntity = $em->getRepository("Policy\Entity\Policy")->findOneBy(array(
                "policyUid" => $policyUid
            ));
            $policyEntity->setIsSpecialTerms(FALSE)
                ->setUpdatedOn(new \DateTime())
                ->setSpecialTerms(NULL);
            try {
                $em->persist($policyEntity);
                $em->flush();

                $gritter->setTitle("Success");
                $gritter->setText("Special terms successfully cleared");
                $gritter->setType(GritterMessage::TYPE_SUCCESS);

                $response->add($gritter);
                $this->flashMessenger()->addSuccessMessage("Special terms successfully cleared");

                $redirect = new Redirect($this->url()->fromRoute("policy/default", array(
                    "action" => "manage"
                )));
                $response->add($redirect);
            } catch (\Exception $e) {
                $gritter->setTitle("Error");
                $gritter->setText("Problem clearing the information");
                $gritter->setType(GritterMessage::TYPE_ERROR);
                $response->add($gritter);
            }
        }
        return $this->getResponse()->setContent($response);
    }

    public function viewspecialtermsAction()
    {
        $response = new Response();
        $em = $this->entityManager;
        // $policySpecialTermsForm = $this->policySpecialTerms;
        $policyService = $this->policyService;
        $policySession = $policyService->getPolicySession();
        $id = $policySession->policyId; // policy Uid
        $gritter = new GritterMessage();
        if ($id == NULL) {
            $gritter->setTitle("Error");
            $gritter->setType(GritterMessage::TYPE_ERROR);
            $gritter->setText("ERROR: Identifier Error");

            $response->add($gritter);
        } else {
            $policyEntity = $em->getRepository("Policy\Entity\Policy")->findOneBy(array(
                "policyUid" => $id
            ));
            $modal = new WasabiModal("standard", "Special Terms");
            $viewModel = new ViewModel(array(
                "details" => $policyEntity->getSpecialTerms()
            ));
            $viewModel->setTemplate("policy_special_terms_details");
            $modal->setContent($viewModel);

            $modalView = new WasabiModalView("#wasabi_modal", $this->renderer, $modal);
            $response->add($modalView);
        }
        return $this->getResponse()->setContent($response);
    }

    // end Modal
    public function allAction()
    {
        $policyService = $this->policyService;
        // var_dump($this->policyUploadForm);
        $myPolicy = $policyService->getMyPolicy();
        // var_dump($myPolicy);
        $view = new ViewModel(array(
            "policy" => $myPolicy
        ));

        return $view;
    }

    // public function preuploadAction(){
    // $customerId
    // return $this->getResponse()->setContent(NULL);
    // }
    public function uploadPolicyAction()
    {
        $em = $this->entityManager;
        $policyUploadForm = $this->policyUploadForm;
        $policyFloatForm = $this->policyFloatForm;
        $request = $this->getRequest();

        $brokerCustomerSession = $this->brokerCustomerSession;
        $customerId = $brokerCustomerSession->customerId;
        if ($customerId == NULL) {
            $this->flashmessenger()->addErrorMessage("We could not find a customer identifier");
            $this->redirect()->toRoute("customer/default", array(
                "action" => "profile"
            ));
        }
        $customerEntity = $em->find("Customer\Entity\Customer", $customerId);

        if ($customerEntity == NULL) {
            $this->flashmessenger()->addErrorMessage("We could not find a customer identifier");
            $this->redirect()->toRoute("customer/default", array(
                "action" => "profile"
            ));
        }

        if ($request->isPost()) {
            $policyFloatForm->bind(new PolicyFloat());
            // var_dump("HIM");
            $post = $request->getPost();
            $policyFloatForm->setData($post);
            $policyFloatForm->setValidationGroup(array(
                "policyFloatFieldset" => array(
                    "floatName"
                )
            ));

            if ($policyFloatForm->isValid()) {
                var_dump("ITS is functioning");
            }

            // var_dump($policyUploadForm);
            if ($policyUploadForm->isValid()) {
                // process form
                // var_dump("MID");
                $data = $policyUploadForm->getData();

                $coverNoteEntity = new CoverNote();
                $policyEntity = new Policy();
                $policyFloatEntity = new PolicyFloat();

                // var_dump($data);

                // $coverNoteEntity->setCoverCategory($em->find("Settings\Entity\CoverCategory", CoverNoteService::COVERNOTE_CATEGORY_FLOAT_POLICY))
                // ->setCoverUid($this->coverNoteService->coverNoteUid())
                // ->setCustomer($customerEntity)
                // ->setDateCreated(new \DateTime())
                // ->setIsHidden(False)
                // ->setIsPolicy(TRUE)
                // ->setPolicyFloat($policyFloatEntity)
                // ->setPolicy($policyEntity)
                // ->setInsurer($data->getInsurer())
                // ->setCoverStatus($em->find("Policy\Entity\CoverNoteStatus", CoverNoteService::COVERNOTE_STATUS_POLICY_ISSUED_AND_VALID));

                // $policyEntity->setCoverNote($coverNoteEntity)
                // ->setPolicyCode($data->getPolicyCode())
                // ->setPolicyName($data->getPolicyName())
                // ->setExtraInfo($data->getExtraInfo())
                // ->setIsAutoRenew($post['policyFieldset']["isAutoRenew"])
                // ->setStartDate($data->getStartDate())
                // ->setEndDate($data->getEndDate())
                // ->setCreatedOn(new \DateTime())
                // ->setIsActive(TRUE)
                // ->setIsLocked(TRUE)
                // ->setPolicyStatus($em->find("Policy\Entity\PolicyStatus", PolicyService::POLICY_STATUS_ISSUED_AND_VALID))
                // ->setPolicyUid($this->policyService->getPolicyUid());

                try {} catch (\Exception $e) {
                    // $this->flashmessenger()->addErrorMessage("We could not upload this policy");
                    // $this->redirect()->toRoute("customer");
                }
            }
        }
        $view = new ViewModel(array(
            "policyUploadForm" => $policyUploadForm,
            "policyFloatForm" => $policyFloatForm
        ));
        return $view;
    }

    public function generatePolicyAction()
    {
        $em = $this->entityManager;
        $policyGenerationForm = $this->policyGenerationForm;
        $policyService = $this->policyService;
        $request = $this->getRequest();
        $coverNoteService = $this->coverNoteService;
        $coverNoteSession = $coverNoteService->getCoverNoteSession();
        $coverNoteId = $coverNoteSession->getCoverNoteId;
        $coverNoteEntity = $em->find("Policy\Entity\CoverNote", $coverNoteId);
        $policyEntity = new Policy();
        if ($coverNoteId == NULL) {
            $this->flashmessenger()->addErrorMessage("CoverNote identity does not exist !");
            $this->redirect()->toRoute("cover-note/default", array(
                "action" => "view"
            ));
        }
        if ($request->isPost()) {
            $post = $request->getPost();
            $policyGenerationForm->setData($post);

            $policyGenerationForm->setValidationGroup(array(
                "policyFieldset" => array(
                    "startDate",
                    "endDate",
                    "extraInfo",
                    "policyName",
                    "policyCode"
                )
            ));

            if ($policyGenerationForm->isValid()) {
                // Hydrate CoverNote
                // Hydrate Policy
                $data = $policyGenerationForm->getData();

                // var_dump($data->getIsAutoRenew());
                try {
                    $message = "Policy " . $policyEntity->getPolicyName() . " is now available please go online and download all documents";
                    $coverNoteEntity->setIsPolicy(TRUE)
                        ->setPolicy($policyEntity)
                        ->setDateUpdated(new \DateTime());
                    $policyEntity->setCoverNote($coverNoteEntity)
                        ->setPolicyCode($data->getPolicyCode())
                        ->setPolicyName($data->getPolicyName())
                        ->setExtraInfo($data->getExtraInfo())
                        ->setIsAutoRenew($post['policyFieldset']["isAutoRenew"])
                        ->setStartDate($data->getStartDate())
                        ->setEndDate($data->getEndDate())
                        ->setCreatedOn(new \DateTime())
                        ->setIsActive(TRUE)
                        ->setIsLocked(TRUE)
                        ->setPolicyStatus($em->find("Policy\Entity\PolicyStatus", PolicyService::POLICY_STATUS_ISSUED_AND_VALID))
                        ->setPolicyUid($this->policyService->getPolicyUid());
                    $em->persist($coverNoteEntity);
                    $em->persist($policyEntity);

                    $em->flush();
                    /**
                     * Send Mail
                     */
                    $messagePointers["to"] = $coverNoteEntity->getCustomer()
                        ->getUser()
                        ->getEmail();
                    $messagePointers['fromName'] = $coverNoteEntity->getCustomer()
                        ->getCustomerBroker()
                        ->getBroker()
                        ->getCompanyName();
                    $messagePointers['subject'] = "Policy Documents Available";

                    $template["var"] = array(
                        "logo" => $coverNoteEntity->getCustomer()
                            ->getCustomerBroker()
                            ->getBroker()
                            ->getCompanyLogo()
                            ->getDocUrl(),
                        "brokerName" => $coverNoteEntity->getCustomer()
                            ->getCustomerBroker()
                            ->getBroker()
                            ->getCompanyName(),
                        "policyEntity" => $policyEntity
                    );
                    // $template["template"] = ""; // TODO create a template for this
                    // $this->generalService->sendMails($messagePointers, $template);
                    // $this->smsService->sendBrokerSms($coverNoteEntity->getCustomer()
                    // ->getUser()
                    // ->getUsername(), $this->smsService->getSenderName(), $message);
                    $policySession = $policyService->getPolicySession();
                    $policySession->policyId = $policyEntity->getId();
                    $this->redirect()->toRoute("policy/default", array(
                        "action" => "view"
                    ));
                } catch (\Exception $e) {
                    $data = $policyGenerationForm->getData();
                    // var_dump($data->getDesc());
                    // echo $e->getTraceAsString();
                    $this->flashmessenger()->addErrorMessage("We could not generate the neccesary Policy at this time");
                    $this->redirect()->toRoute("policy/default", array(
                        "action" => "generate-policy"
                    ));
                }
            }
        }
        $view = new ViewModel(array(
            "policyGenerationFporm" => $policyGenerationForm
        ));
        return $view;
    }

    public function floatallAction()
    {
        $em = $this->entityManager;
        $all = NULL;
        try {
            $all = $em->getRepository("Policy\Entity\PolicyFloat")->findCentralBrokerUnpublishedPolicy($this->centralBrokerId);
        } catch (\Exception $e) {
            var_dump($e->getMessage());
        }
        $viewModel = new ViewModel(array(
            "all" => $all
        ));
        return $viewModel;
    }

    public function floatmanagerAction()
    {
        $em = $this->entityManager;
        $uid = $this->params()->fromRoute("id", NULL);
        $policySession = $this->policyService->getPolicySession();

        if ($uid != NULL) {
            $policySession->floatpolicyUid = $uid;
        } else {
            $uid = $policySession->floatpolicyUid;
        }

        if ($uid == NULL) {
            $this->flashMessenger()->addErrorMessage("Absent Identifier");
            return $this->redirect()->toRoute("policy/default", array(
                "action" => "floatall"
            ));
        } else {
            $floatPolicyEntity = $em->getRepository("Policy\Entity\PolicyFloat")->findOneBy(array(
                "policyFloatUid" => $uid
            ));
        }
        $view = new ViewModel(array(
            "floatPolicyEntity" => $floatPolicyEntity
        ));
        return $view;
    }

    /**
     * View the policy details in nonmodal form
     *
     * @return \Zend\View\Model\ViewModel
     */
    public function viewAction()
    {
        $em = $this->entityManager;
        $policyService = $this->policyService;
        $dropZoneForm = $this->dropZoneForm;
        $policySession = $policyService->getPolicySession();

        $dropZoneForm->setAttributes(array(
            "action" => $this->url()
                ->fromRoute("policy/default", array(
                "action" => "uploaddropzone"
            ))
        ));

        $policyEntity = $em->find("Policy\Entity\Policy", $policySession->policyId);
        if ($policyEntity == NULL) {
            $this->flashmessenger()->addErrorMessage("We could not find this policy");
            $this->redirect()->toRoute("policy");
        }

        $view = new ViewModel(array(
            "policyEntity" => $policyEntity,
            "dropZoneForm" => $dropZoneForm
        ));
        return $view;
    }

    public function premanageAction()
    {
        $policyUid = $this->params()->fromRoute("id", NULL);
        if ($policyUid == NULL) {
            $this->flashMessenger()->addErrorMessage("Identifier error");
            $this->redirect()->toRoute("policy/default", array(
                "action" => "all"
            ));
        } else {
            $policyService = $this->policyService;
            $policySession = $policyService->getPolicySession();
            $policySession->policyId = $policyUid;

            $this->redirect()->toRoute("policy/default", array(
                "action" => "manage"
            ));
        }
        return $this->getResponse()->setContent(NULL);
    }

    public function premanagemodalAction()
    {
        $response = new Response();

        $policyUid = $this->params()->fromQuery("data", NULL);

        $gritter = new GritterMessage();
        // var_dump($policyUid);
        if ($policyUid == NULL) {
            $gritter->setTitle("ERROR");
            $gritter->setText("Error directing to polikcy management portal");
            $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);
            $gritter->setType(GritterMessage::TYPE_ERROR);

            $response->add($gritter);
        } else {
            $policyService = $this->policyService;
            $policySession = $policyService->getPolicySession();
            $policySession->policyId = $policyUid;

            $redirect = new Redirect($this->url()->fromRoute("policy/default", array(
                "action" => "manage"
            )));
            $response->add($redirect);
        }

        return $this->getResponse()->setContent($response);
    }

    public function manageAction()
    {
        $em = $this->entityManager;
        $dropZoneForm = $this->dropZoneForm;
        $dropZoneForm->setAttributes(array(
            "action" => $this->url()
                ->fromRoute("policy/default", array(
                "action" => "uploaddropzone"
            ))
        ));
        $policyEntity = NULL;
        $policyService = $this->policyService;
        $policySession = $policyService->getPolicySession();
        $id = $policySession->policyId; // policy Uid
       
        if ($policySession == NULL || $id == NULL) {
            $this->flashMessenger()->addErrorMessage("Absent Identifier");
            $this->redirect()->toRoute("policy/default", array(
                "action" => "all"
            ));
        } else {
            $policyEntity = $em->getRepository("Policy\Entity\Policy")->findOneBy(array(
                "policyUid" => $id
            ));
        }

        $hooks = $policyService->getPolicyHookRenewable($policyEntity->getId());
        $viewModel = new ViewModel(array(
            "policyEntity" => $policyEntity,
            "dropZoneForm" => $dropZoneForm,
            "hooks"=>$hooks
        ));
        return $viewModel;
    }

    public function messageAction()
    {
        $response = new Response();
        $modal = new WasabiModal("standard", "Policy Message");
        $modalView = new WasabiModalView("#wasabi_modal", $this->renderer, $modal);
        $response->add($modalView);
        return $this->getResponse()->setContent($response);
    }

    public function expiredAction()
    {
        $brokerId = $this->centralBrokerId;
        $em = $this->entityManager;
        $policy = $em->getRepository("Policy\Entity\Policy")->findBrokerExpiredPolicy($brokerId);
        // $policy = $
        $viewModel = new ViewModel(array(
            "policy" => $policy
        ));

        // $viewModel = new ViewModel();
        return $viewModel;
    }

    public function previewAction()
    {
        $em = $this->entityManager;
        $policyService = $this->policyService;
        $id = $this->params()->fromRoute("id", NULL);

        if ($id == NULL) {
            $this->flashmessenger()->addErrorMessage("No identifier found for this policy");
            $this->redirect()->toRoute("policy/default", array(
                "action" => "all"
            ));
        }

        $policySession = $policyService->getPolicySession();
        $policySession->policyId = $id;
        if ($policySession->policyId != NULL) {
            $this->redirect()->toRoute("policy/default", array(
                "action" => "view"
            ));
        } else {
            $this->flashmessenger()->addErrorMessage("No Policy identifer");
            $this->redirect()->toRoute("policy/default", array(
                "action" => "all"
            ));
        }
        return $this->getResponse()->setContent(NULL);
    }

    public function removedocconfirmAction()
    {
        $response = new Response();
        $docId = $this->params()->fromQuery("data", NULL);
        // var_dump($docId);
        if (isset($docId)) {
            $removeDocContainer = new Container("remove_doc_container");
            $removeDocContainer->id = $docId;
            $dialog = new Dialog("Dialog", "Confirm Action", "Are you sure you want to remove this document", Dialog::TYPE_SUCCESS);
            $cbutton = new Button("Accept");
            $cbutton->setAction($this->url()
                ->fromRoute("policy/default", array(
                "action" => "removedoc"
            )));
            $dialog->setTitle("Policy Revoke/Cancel");
            $dialog->setConfirmButton($cbutton);
            // $dialog->set

            $modalView = new WasabiModalView("#wasabi_modal", $this->renderer, $dialog);
            $response->add($modalView);
        }
        return $this->getResponse()->setContent($response);
    }

    /**
     * This removes the document attached to the policy
     *
     * @return mixed
     */
    public function removedocAction()
    {
        $em = $this->entityManager;

        $response = new Response();
        $policyService = $this->policyService;
        $removeDocContainer = new Container("remove_doc_container");
        $gritter = new GritterMessage();
        if (isset($removeDocContainer->id)) {
            $docId = $removeDocContainer->id;

            if ($docId == NULL) {
                // $this->flashmessenger()->addErrorMessage("No identifier to resolve");
                // $this->redirect()->toRoute("policy/default", array(
                // "action" => "view"
                // ));
                $gritter->setTitle("Identifier Error");
                $gritter->setText("DOcument Identifier absent");
                $gritter->setType(GritterMessage::TYPE_ERROR);
                $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);
                $response->add($gritter);
            }
            $policySession = $policyService->getPolicySession();

            $referer = $this->getRequest()->getHeader("referer");
            $uri = $referer->getUri();
            // var_dump("HYYYER");
            $policyId = $policySession->policyId;
            /**
             *
             * @var Policy $policyEntity
             */
            $policyEntity = $em->getRepository("Policy\Entity\Policy")->findOneBy(array(
                "policyUid" => $policyId
            ));
            try {
                /**
                 *
                 * @var Document $docEntity
                 */
                $docEntity = $em->find("GeneralServicer\Entity\Document", $docId);
                $policyEntity->removeDocuments($em->find("GeneralServicer\Entity\Document", $docId))
                    ->setUpdatedOn(new \DateTime());
                // var_dump($docId);

                $em->persist($policyEntity);
                $em->flush();

                $gritter->setTitle("Success");
                $gritter->setText("Successfully removed the document");
                $gritter->setType(GritterMessage::TYPE_SUCCESS);
                $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);

                $response->add($gritter);
                $this->flashmessenger()->addSuccessMessage("Successfully removed the document");
                $redirect = new Redirect($uri);

                $notificationParam = array(
                    "topic" => "Remove Document",
                    "type" => TriggerService::NOTIFICATION_TYPE_POLICY_ACTION,
                    "message" => $docEntity->getDocName() . " was removed ",
                    "policy" => $policyEntity->getId(),
                    "url" => $this->url()->fromRoute("policy/default", array(
                        "action" => "premanage",
                        "id" => $policyId
                    ), array(
                        'force_canonical' => true
                    ))
                );
                $this->getEventManager()->trigger(TriggerService::TIGGER_NOTIFICATION, $this, $notificationParam);

                $removeDocContainer->getManager()
                    ->getStorage()
                    ->clear("remove_doc_container");
                $response->add($redirect);
            } catch (\Exception $e) {
                // $this->flashmessenger()->addErrorMessage($e->getMessage());
                // $this->redirect()->toRoute("policy/default", array(
                // "action" => "view"
                // ));

                $gritter->setTitle("Policy Removal Error");
                $gritter->setText("We had a problem removing this policy");
                $gritter->setType(GritterMessage::TYPE_ERROR);
                $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);
                $removeDocContainer->getManager()
                    ->getStorage()
                    ->clear("remove_doc_container");
                $response->add($gritter);
            }
        }
        return $this->getResponse()->setContent($response);
    }

    public function uploaddropzoneAction()
    {
        $em = $this->entityManager;
        $response = new Response();
        $policyService = $this->policyService;
        // $blobService = $this->blobService;
        $policySession = $policyService->getPolicySession();
        $policyId = $policySession->policyId;
        $policyEntity = $em->find("Policy\Entity\Policy", $policyId);
        $gritter = new GritterMessage();
        $request = $this->getRequest();
        if ($request->isPost() || $request->isXmlHttpRequest()) {
            try {
                $files = $this->params()->fromFiles('file');

                /**
                 *
                 * @var Document $res
                 */
                $res = $this->blobService->uploadBlob($files);
                // $this->redirect()->toRoute("home");
                if ($res != NULL) {
                    $policyEntity = $em->getRepository("Policy\Entity\Policy")->findOneBy(array(
                        "policyUid" => $policyId
                    ));
                    $policyEntity->addDocuments($res)->setUpdatedOn(new \DateTime());
                    $em->persist($policyEntity);
                    $em->persist($res);
                    $em->flush();

                    $notificationParam = array(
                        "topic" => "Uploaded Document",
                        "type" => TriggerService::NOTIFICATION_TYPE_POLICY_ACTION,
                        "message" => $res->getDocName() . " was successfully uploaded",
                        "policy" => $policyEntity->getId(),
                        "url" => $this->url()->fromRoute("policy/default", array(
                            "action" => "premanage",
                            "id" => $policyId
                        ), array(
                            'force_canonical' => true
                        ))
                    );
                    $this->getEventManager()->trigger(TriggerService::TIGGER_NOTIFICATION, $this, $notificationParam);

                    $gritter->setTitle("Upload Successful");
                    $gritter->setText("Document successfully uploaded");
                    $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);
                    $gritter->setType(GritterMessage::TYPE_SUCCESS);
                    $response->add($gritter);

                    return $this->getResponse()->setContent($response);
                }
            } catch (\Exception $e) {

                $gritter->setTitle("Upload Error");
                $gritter->setText($e->getMessage());
                $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);
                $gritter->setType(GritterMessage::TYPE_ERROR);
                $response->add($gritter);

                // $this->flashmessenger()->addErrorMessage($e->getMessage());
                $redirect = new Redirect($this->url()->fromRoute("policy/default", array(
                    "action" => "view"
                )));
                // $response = new Response();
                $response->add($redirect);

                return $this->getResponse()->setContent($response);
            }
        } else {
            $gritter->setTitle("Upload Error");
            $gritter->setText("Document could not be uploaded");
            $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);
            $gritter->setType(GritterMessage::TYPE_ERROR);
            $response->add($gritter);

            // $this->flashmessenger()->addErrorMessage($e->getMessage());
            // $redirect = new Redirect($this->url()->fromRoute("policy/default", array(
            // "action" => "view"
            // )));
            // $response = new Response();
            // $response->add($redirect);
            return $this->getResponse()->setContent($response);
        }
        return $this->getResponse()->setContent($response);
    }

    /**
     * This sends a mail for customer to renew an expired policy
     *
     * @return mixed
     */
    public function renewReminderAction()
    {
        $em = $this->entityManager;

        $policyService = $this->policyService;
        $policySession = $policyService->getPolicySession();
        $policyId = $policySession->policyId;
        if ($policyId == NULL) {
            $this->flashmessenger()->addErrorMessage("No identifier available");
            $this->redirect()->toRoute("policy");
        }
        $policyEntity = $em->find("Policy\Entity\Policy", $policyId);
        $userEntity = $em->find("", $this->identity()
            ->getId());
        $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $this->centralBrokerId);
        $mailService = $this->mailService;
        try {
            $var = array(
                "logo" => $brokerLogo,
                "brokerName" => $brokerEntity->getCompanyName(),
                "policyName" => $policyEntity->getPolicyName(),
                "policyCode" => $userEntity->getUsername(),
                "policyExpireDate" => $policyEntity->getEndDate(),
                "invoiceUrl" => "" // $this->urlPulgin->fromRoute("client_login", array("brokerid"=>$brokerEntity->getBrokerUid())), // generate a canonoical url of the broker for customer to login
            );
            $message = $mailService->getMessage();
            $message->addTo($userEntity->getEmail())
                ->setFrom("info@imapp.ng", $brokerEntity->getCompanyName())
                ->setSubject("Renew Expired Policy " . $brokerEntity->getCompanyName());
            $mailService->setTemplate('general-customer-welcome-aboard', $var); // TODO - change the template here
            $mailService->send();
        } catch (\Exception $e) {
            $this->flashmessenger()->addErrorMessage("We could not remind the customer");
            $this->redirect()->toRoute("policy");
        }

        return $this->getResponse()->setContent(NULL);
    }

    /**
     * This action notifies the customer on upcoming renewal
     */
    public function notifyAction()
    {
        $em = $this->entityManager;
        $data = $this->params()->fromQuery("data", NULL);
        $gritter = new GritterMessage();
        $policyId = NULL;
        $response = new Response();
        if ($data != NULL) {
            $policyId = $data;
        } else {
            $policyService = $this->policyService;
            $policySession = $policyService->getPolicySession();
            $policyId = $policySession->policyId;
        }

        if ($policyId == NULL) {
            $gritter->setTitle("Error");
            $gritter->setText("Error: Absent identifier");
            $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);
            $gritter->setType(GritterMessage::TYPE_ERROR);

            $response->add($gritter);
            ;
        } else {
            $policyEntity = $em->find("Policy\Entity\Policy", $policyId);
            $userEntity = $this->identity();
            $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $this->centralBrokerId);

            // $mailService = $this->mailService;
            try {
                $var = array(
                    // "logo" => $brokerLogo,
                    "brokerName" => $brokerEntity->getCompanyName(),
                    "policyName" => $policyEntity->getPolicyName(),
                    "policyCode" => $userEntity->getUsername(),
                    "policyExpireDate" => $policyEntity->getEndDate()
                    // "invoiceUrl"=>"",//$this->urlPulgin->fromRoute("client_login", array("brokerid"=>$brokerEntity->getBrokerUid())), // generate a canonoical url of the broker for customer to login
                );
                // $message = $mailService->getMessage();
                // $message->addTo($userEntity->getEmail())
                // ->setFrom("info@imapp.ng", $brokerEntity->getCompanyName())
                // ->setSubject("Exoiring Policy " . $brokerEntity->getCompanyName());
                // $mailService->setTemplate('general-customer-welcome-aboard', $var); // TODO - change the template here
                // $mailService->send();
                $gritter->setTitle("Success");
                $gritter->setText("Success: Mail sent to customer");
                $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);
                $gritter->setType(GritterMessage::TYPE_SUCCESS);

                $response->add($gritter);
            } catch (\Exception $e) {
                $gritter->setTitle("Error");
                $gritter->setText("Error: We could not remind the customer");
                $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);
                $gritter->setType(GritterMessage::TYPE_ERROR);

                $response->add($gritter);
                // $this->flashmessenger()->addErrorMessage("We could not remind the customer");
                // $this->redirect()->toRoute("policy");
            }
        }

        return $this->getResponse()->setContent($response);
    }

    // Begin Modal
    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }

    public function setPolicyService($xserv)
    {
        $this->policyService = $xserv;
        return $this;
    }

    public function setMailService($xserv)
    {
        $this->mailService = $xserv;
        return $this;
    }

    public function setCentralBrokerId($id)
    {
        $this->centralBrokerId = $id;
        return $this;
    }

    public function setCoverNoteService($xserv)
    {
        $this->coverNoteService = $xserv;
        return $this;
    }

    public function setPolicyGenerationForm($form)
    {
        $this->policyGenerationForm = $form;
        return $this;
    }

    public function setSmsService($xserv)
    {
        $this->smsService = $xserv;
        return $this;
    }

    public function setGeneralService($xserv)
    {
        $this->generalService = $xserv;
        return $this;
    }

    public function setCustomerService($xserv)
    {
        $this->customerService = $xserv;
        return $this;
    }

    public function setBrokerCustomerSession($sess)
    {
        $this->brokerCustomerSession = $sess;
        return $this;
    }

    public function setPolicyUploadForm($form)
    {
        $this->policyUploadForm = $form;
        return $this;
    }

    public function setPolicyFloatForm($form)
    {
        $this->policyFloatForm = $form;

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

    /**
     *
     * @param object $renderer
     */
    public function setRenderer($renderer)
    {
        $this->renderer = $renderer;
        return $this;
    }

    /**
     *
     * @param mixed $renewPolicyForm
     */
    public function setRenewPolicyForm($renewPolicyForm)
    {
        $this->renewPolicyForm = $renewPolicyForm;
        return $this;
    }

    /**
     *
     * @param mixed $policyForm
     */
    public function setPolicyForm($policyForm)
    {
        $this->policyForm = $policyForm;
        return $this;
    }

    /**
     *
     * @param mixed $policyRevokeForm
     */
    public function setPolicyRevokeForm($policyRevokeForm)
    {
        $this->policyRevokeForm = $policyRevokeForm;
        return $this;
    }

    /**
     *
     * @param mixed $policySpecialTerms
     */
    public function setPolicySpecialTerms($policySpecialTerms)
    {
        $this->policySpecialTermsForm = $policySpecialTerms;
        return $this;
    }

    /**
     *
     * @param mixed $policyStatusForm
     */
    public function setPolicyStatusForm($policyStatusForm)
    {
        $this->policyStatusForm = $policyStatusForm;
        return $this;
    }

    public function setPolicyPremiumPayableForm($form)
    {
        $this->policyPremiumPayableForm = $form;

        return $this;
    }
}

