<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Customer for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Customer\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use CsnUser\Service\UserService;
use Customer\Service\CustomerService;
use Object\Entity\Object;
use Object\Service\ObjectService;
use WasabiLib\Modal\WasabiModal;
use WasabiLib\Modal\WasabiModalView;
use WasabiLib\Ajax\Response;
// use WasabiLib\Modal\Info;
use Messages\Entity\MessageEntered;
use Policy\Service\CoverNoteService;
use Messages\Entity\Messages;
use Messages\Service\MessageService;
use WasabiLib\Ajax\InnerHtml;
use WasabiLib\Ajax\DomManipulator;
use Policy\Entity\PolicyFloat;
use Policy\Entity\CoverNote;
use Policy\Entity\Policy;
use WasabiLib\Ajax\Redirect;
use Policy\Service\PolicyService;
use Transactions\Entity\Invoice;
use Transactions\Service\InvoiceService;
use WasabiLib\Ajax\GritterMessage;
use Customer\Entity\Customer;
use WasabiLib\Modal\WasabiModalConfigurator;
use WasabiLib\Modal\WasabiModalViewConfigurator;
use GeneralServicer\Service\CurrencyService;
use Doctrine\ORM\EntityManager;
use WasabiLib\Modal\Dialog;
use WasabiLib\Modal\Button;

class IndexController extends AbstractActionController
{

    /**
     *
     * @var EntityManager
     */
    private $entityManager;

    private $customerForm;

    private $customerEntity;

    private $customerService;

    private $generalService;

    private $policyService;

    private $objectPreForm;

    private $brokerCustomerSession;

    private $objectService;

    private $claimsService;

    private $coverNoteService;

    private $invoiceService;

    private $assignBrokerForm;

    private $customerPinForm;

    private $centralBrokerId;

    private $smsService;

    private $otpForm;

    private $policyUploadForm;

    private $policyFloatForm;

    private $messageForm;

    private $messageService;

    private $renderer;

    private $pincodeForm;

    public function onDispatch(\Zend\Mvc\MvcEvent $e)
    {
        $response = parent::onDispatch($e);
        $this->redirectPlugin()->redirectCondition();
        $this->layout()->setTemplate('layout/layout.phtml');
        return $response;
    }

    /**
     * Begin Modal
     */

    /**
     * End Modal
     */

    /**
     * Begin Asyn Calls
     */
    public function analysisAction()
    {
        $response = new Response();
        $modal = new WasabiModal("standard", "ANALYTICS");
        $modal->setSize(WasabiModalConfigurator::MODAL_SM);
        $viewmodel = new ViewModel(array());
        $viewmodel->setTemplate("customer-analytics");
        $modal->setContent($viewmodel);
        $modalView = new WasabiModalView("#wasabi_modal_view", $this->renderer, $modal);
        $response->add($modalView);
        return $this->getResponse()->setContent($response);
    }

    public function deleteconfirmAction()
    {
        $response = new Response();
        $data = $this->params()->fromQuery("data", NULL);
        $dialog = new Dialog("Dialog", "Confirm Action", "Are you sure you want to remove this customer", Dialog::TYPE_SUCCESS);
        $cbutton = new Button("Accept");
        $cbutton->setAction($this->url()
            ->fromRoute("customer/default", array(
            "action" => "delete",
            "id" => $data
        )));
        $cbutton->addClass("ajax_element");
        // $cbutton->
        $dialog->setTitle("Remove Customer");
        $dialog->setConfirmButton($cbutton);
        // $dialog->set

        // $
        $modalView = new WasabiModalView("#wasabi_modal", $this->renderer, $dialog);
        $response->add($modalView);
        return $this->getResponse()->setContent($response);
    }

    public function deleteAction()
    {
        $em = $this->entityManager;
        $response = new Response();
        $id = $this->params()->fromRoute("id", NULL);
        $customerEntity = $em->getRepository("Customer\Entity\Customer")->findOneBy(array(
            "accountId" => $id
        ));
        $this->noAuthorization();

        $customerEntity->setUpdatedOn(new \DateTime())->setIsHidden(TRUE);
        try {
            $em->persist($customerEntity);
            $em->flush();
            $this->flashmessenger()->addSuccessMessage("Successfully deleted the customer");
            // $this->redirect()->toRoute("customer/default", array(
            // "action" => "all"
            // ));
            $redirect = new Redirect($this->url()->fromRoute("customer/default", array(
                "action" => "all"
            )));
            $response->add($redirect);
        } catch (\Exception $e) {
            $this->flashmessenger()->addErrorMessage("Some thing went wrong deleting this customer");
        }
        return $this->getResponse()->setContent($response);
    }

    /**
     * Provides form and logic for changing the customer pincode
     * VIa Wasabi Modal
     *
     * @return mixed
     */
    public function pinchangemodalAction()
    {
        $em = $this->entityManager;
        $response = new Response();
        $modal = new WasabiModal("standard", "Change pin");
        $modal->setSize(WasabiModalViewConfigurator::MODAL_SM);
        $pincodeForm = $this->pincodeForm;
        $pincodeForm->setAttributes(array(
            "id" => "simpleForm",
            "data-ajax-loader" => "myLoader",
            "class" => "ajax_element ",
            "action" => $this->url()
                ->fromRoute("customer/default", array(
                "action" => "pinchangemodal"
            ))
        ));
        $viewModel = new ViewModel(array(
            "customerPinForm" => $pincodeForm
        ));
        $viewModel->setTemplate("customer-pin-form-form");
        $modal->setContent($viewModel);
        $request = $this->getRequest();
        $modalView = new WasabiModalView("#wasabi_modal_view", $this->renderer, $modal);
        if ($request->isPost()) {
            $gritter = new GritterMessage();

            $id = $this->brokerCustomerSession->customerId;
            if ($id == NULL) {
                $gritter->setText("No customer identifier");
                $gritter->setTitle("Identifier Error");
                $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);
                $gritter->setType(GritterMessage::TYPE_ERROR);

                $response->add($gritter);
                return $this->getResponse()->setContent($response);
                // $this->flashmessenger()->addErrorMessage("No customer identifier available");
                // $this->redirect()->toRoute("customer");
            }
            $customerEntity = $em->find("Customer\Entity\Customer", $id);
            if ($customerEntity == NULL) {
                $gritter->setText("Customer session not identitifed");
                $gritter->setTitle("Session Error");
                $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);
                $gritter->setType(GritterMessage::TYPE_ERROR);

                $response->add($gritter);
                return $this->getResponse()->setContent($response);

                // $this->flashmessenger()->addErrorMessage("Customer session not identitifed");
                // $this->redirect()->toRoute("customer");
            }

            try {
                $post = $request->getPost();
                $pin = $post['pinCodeFieldset']['pin'];
                $customerUserEntity = $customerEntity->getUser();
                $customerUserEntity->setPassword(UserService::encryptPassword($pin))->setUpdatedOn(new \DateTime());
                $em->persist($customerUserEntity);
                $em->flush();
                $message = "We have Successfullly changed your pin number to " . $pin;
                // $this->smsService->sendBrokerSms($customerUserEntity->getUsername(), $this->smsService->getSenderName(), $message);
                $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $this->centralBrokerId);
                $message2 = "<br><br>If this change was not requested by you please notify us at " . $brokerEntity->getBrokerEmail();
                $messagePointers = array();
                $template = array();
                $messagePointers["to"] = $customerUserEntity->getEmail();
                $messagePointers['fromName'] = $brokerEntity->getBrokerName();
                $messagePointers['subject'] = "PinCode Reset";

                $template["template"] = "general-mail-default";
                $template["var"] = array(
                    "topic" => "PinCode Reset",
                    "logo" => $this->generalService->getBrokerAbsoluteLogo(),
                    "message" => $message . $message2,
                    "brokerName" => $brokerEntity->getBrokerName()
                );

                // Fix Email Notification
                $this->generalService->sendMails($messagePointers, $template);

                $gritter->setText("Pin Code Change Success");
                $gritter->setTitle("Success");
                $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);
                $gritter->setType(GritterMessage::TYPE_SUCCESS);

                $response->add($gritter);

                $this->flashmessenger()->addSuccessMessage("Customer Pincode successfully changed");

                $redirect = new Redirect($this->url()->fromRoute("customer/default", array(
                    "action" => "profile"
                )));
                $response->add($redirect);
                return $this->getResponse()->setContent($response);
            } catch (\Exception $e) {
                $gritter->setText("We could not finalize the request");
                $gritter->setTitle("Hydration Error");
                $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);
                $gritter->setType(GritterMessage::TYPE_ERROR);

                $response->add($gritter);
                return $this->getResponse()->setContent($response);
            }
        } else {
            $response->add($modalView);
        }

        return $this->getResponse()->setContent($response);
    }

    public function messagingAction()
    {
        $em = $this->entityManager;
        $messageService = $this->messageService;
        $request = $this->getRequest();
        $customerId = $this->brokerCustomerSession->customerId;
        $customerEntity = $em->find("Customer\Entity\Customer", $customerId);

        $messageForm = $this->messageForm;
        $messageForm->setAttributes(array(
            "data-ajax-loader" => "myLoader",
            "class" => "ajax_element ",
            "action" => "sendMessage"
        ));
        $view = new ViewModel(array(
            "messageForm" => $messageForm,
            "customer" => $customerEntity
        ));
        $view->setTemplate("customer-message-form-snippet");
        $modal = new WasabiModal("Standard", "Messaging Platform");

        $modal->setContent($view);

        $modalView = new WasabiModalView("#wasabi_modal_view", $this->renderer, $modal);
        $response = new Response();
        $response->add($modalView);
        return $this->getResponse()->setContent($response);
    }

    public function sendMessageAction()
    {
        $em = $this->entityManager;
        $messageService = $this->messageService;
        $request = $this->getRequest();
        if ($request->isXmlHttpRequest() || $request->isPost()) {
            $post = $request->getPost();
            $customerId = $this->brokerCustomerSession->customerId;
            $customerEntity = $em->find("Customer\Entity\Customer", $customerId);
            $messageEntered = new MessageEntered();
            if ($customerEntity->getMessages() == NULL) {
                $messageEntity = new Messages();
            } else {
                $messageEntity = $customerEntity->getMessages();
            }

            $messageEntity->setCreatedOn(new \DateTime())
                ->setMessageCategory($em->find("Settings\Entity\CoverCategory", CoverNoteService::COVERNOTE_CATEGORY_CUSTOMER))
                ->setCustomer($customerEntity)
                ->setMessageUid($messageService->messageUid())
                ->addMessageEntered($messageEntered);

            $postMessageEntered = $post['messageEntered']['messageText'];
            //
            $messageEntered->setCreatedOn(new \DateTime())
                ->setBrokerFunction($em->find("Messages\Entity\MessageFunction", MessageService::MESSAGES_FUNCTION_SENDER))
                ->setCustomerFunction($em->find("Messages\Entity\MessageFunction", MessageService::MESSAGE_FUNCTION_RECEIVER))
                ->setMessageStatus($em->find("Messages\Entity\MessageStatus", MessageService::MESSAGE_STATUS_UNREAD))
                ->setMessageText($postMessageEntered)
                ->setMessages($messageEntity);

            try {
                $em->persist($messageEntity);
                // $em->persist($messageEntered);
                $em->flush();

                /**
                 * Send Email notification to the customer inicatng a message has been sent
                 */
                // $this->flashmessenger()->addSuccessMessage("Message was successfully Delivered");
                $inner = new InnerHtml("#success", "<div id='message'><span class='btn btn-success btn-sm' style='width: 100%'>Sucessfuly sent message to customer</span></div>");
                $message = new InnerHtml("#sentmessage", "<li>
					<div class='block'>
						<div class='tags'>
							<a href='' class='" . ($messageEntered->getBrokerFunction()->getId() == MessageService::MESSAGES_FUNCTION_SENDER ? 'tag' : 'tagr') . "'> <span>" . ($messageEntered->getBrokerFunction()->getId() == MessageService::MESSAGES_FUNCTION_SENDER ? 'Broker' : 'Customer') . "</span>
							</a>
						</div>
						<div class='block_content'>
                    
							<div class='byline'>
								<span> Just Now</span>
							</div>
							<p class='excerpt'>
								" . $messageEntered->getMessageText() . "
							</p>
						</div>
					</div>
				</li>");
                $css = new DomManipulator("#message", "background-color", "#83B719");
                $response = new Response();
                $response->add($inner);
                // $response->add($css);
                $response->add($message);
            } catch (\Exception $e) {
                // $this->flashmessenger()->addErrorMessage("The message could not be send now, please try again later ");
                // $this->redirect()->toRoute("offer/default", array(
                // "action" => "process"
                // ));
                $inner = new InnerHtml("#error", "Could not deliver message");
                // $inner = new InnerHtml("#error", $e->getMessage());
                // $css = new DomManipulator("#message", "background-color", "#83B719");
                $response = new Response();
                $response->add($inner);
            }
        }
    }

    public function policyuploadformAction()
    {
        $em = $this->entityManager;
        $response = new Response();
        $request = $this->getRequest();
        $policyFloatEntity = new PolicyFloat();
        $policyEntity = new Policy();
        $coverNoteEntity = new CoverNote();
        $policyFloatForm = $this->policyFloatForm;
        $gritter = new GritterMessage();
        $policyFloatForm->setAttributes(array(
            "action" => $this->url()
                ->fromRoute("customer/default", array(
                "action" => "policyuploadform"
            )),
            "id" => "simpleForm",
            "class" => "form-horizontal form-label-left ajax_element",
            "data-ajax-loader" => "myLoader"
        ));

        if ($request->isPost()) {
            // $policyFloatForm->bind($policyFloatEntity);

            $post = $request->getPost();
            $policyFloatForm->bind($policyFloatEntity);
            $policyFloatForm->setData($post);

            if ($policyFloatForm->isValid()) {
                $policyService = $this->policyService;

                $data = $policyFloatForm->getData();

                $invoiceEntity = new Invoice();

                $cleanPremium = \floatval(\str_replace(',', '', $data->getCoverNote()->getPremiumPayable()));

                $coverNoteEntity->setCoverCategory($em->find("Settings\Entity\CoverCategory", CoverNoteService::COVERNOTE_CATEGORY_FLOAT_POLICY))
                    ->setCoverStatus($em->find("Policy\Entity\CoverNoteStatus", CoverNoteService::COVERNOTE_STATUS_POLICY_ISSUED_AND_VALID))
                    ->setInsurer($em->find("Settings\Entity\Insurer", $data->getCoverNote()
                    ->getInsurer()))
                    ->setIsHidden(FALSE)
                    ->setDueDate(new \DateTime())
                    ->setCoverUid($this->coverNoteService->coverNoteUid())
                    ->setCustomer($em->find("Customer\Entity\Customer", $this->brokerCustomerSession->customerId))
                    ->setDateCreated(new \DateTime())
                    ->setPremiumPayable($cleanPremium)
                    ->setPolicyFloat($policyFloatEntity)
//                     ->setIsHidden(true)
                    ->setIsPolicy(true);

                $policyFloatEntity->setCreatedOn(new \DateTime())
                    ->setPolicyFloatUid($policyService->getPolicyFloatUid())
                    ->setServiceType($em->find("Settings\Entity\InsuranceServiceType", $data->getCoverNote()
                    ->getPolicyFloat()
                    ->getServiceType()))
                    ->setSpecificService($em->find("Settings\Entity\InsuranceSpecificService", $data->getCoverNote()
                    ->getPolicyFloat()
                    ->getSpecificService()))
                    ->setCoverNote($coverNoteEntity);

                // var_dump($post);

                $policyEntity->setCoverNote($coverNoteEntity)
                    ->setCreatedOn(new \DateTime())
                    ->setIsActive(TRUE)
                    ->setIsLocked(TRUE)
                    ->setStartDate(new \DateTime($post["policyFieldset"]['startDate']))
                    ->setEndDate(new \DateTime($post["policyFieldset"]['endDate']))
                    ->setPolicyCode($post["policyFieldset"]['policyCode'])
                    ->setPolicyStatus($em->find("Policy\Entity\PolicyStatus", PolicyService::POLICY_STATUS_ISSUED_BUT_PENDING))
                    ->setPolicyUid($policyService->getPolicyUid())
                    ->setIsAutoRenew($post['policyFieldset']['isAutoRenew'])
                    ->setPolicyName($post["policyFieldset"]["policyName"]);

                $invoiceEntity->setAmount($cleanPremium)
                    ->setCurrency($em->find("Settings\Entity\Currency", CurrencyService::NIGERIA_NAIRA))
                    ->setCustomer($em->find("Customer\Entity\Customer", $this->brokerCustomerSession->customerId))
                    ->setGeneratedOn(new \DateTime())
                    ->setInvoiceCategory($em->find("Transactions\Entity\InvoiceCategory", InvoiceService::INVOICE_CAT_POLICY))
                    ->setInvoiceUid($this->invoiceService->generateInvoiceNumber())
                    ->setIsMicro(FALSE)
                    ->
                // ->setPolicyFloat($policyFloatEntity)
                setIsOpen(true)
                    ->setExpiryDate(new \DateTime())
                    ->setStatus($em->find("Transactions\Entity\InvoiceStatus", InvoiceService::INVOICE_PAID_STATUS));
                // End invoice

                try {
                    $em->persist($invoiceEntity);
                    $em->persist($policyFloatEntity);
                    $em->persist($policyEntity);
                    $em->persist($coverNoteEntity);

                    $em->flush();

                    $gritter->setTitle("Success");
                    $gritter->setText("Successfully uploaded customer Policy");
                    $gritter->setType(GritterMessage::TYPE_SUCCESS);

                    $response->add($gritter);

                    $redirect = new Redirect($this->url()->fromRoute("policy/default", array(
                        "action" => "premanage",
                        "id" => $policyEntity->getPolicyUid()
                    )));
                    $response = new Response();
                    $response->add($redirect);
                    return $this->getResponse()->setContent($response);
                } catch (\Exception $e) {
                    // var_dump($e->getMessage());

                    $gritter->setTitle("Policy Generation Error");
                    $gritter->setText("Policy could not be generated at this time, please try again later");
                    $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);
                    $gritter->setType(GritterMessage::TYPE_ERROR);
                    $gritter->setSticky(TRUE);
                    $response->add($gritter);
                }
            } else {

                $gritter = new GritterMessage();
                $gritter->setTitle("Validation Error");
                $gritter->setText("Policy did not meet minimum validation, please go through the form");
                $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);
                $gritter->setType(GritterMessage::TYPE_ERROR);
                $response->add($gritter);

                // var_dump($policyFloatForm)
            }
        } else {

            $view = new ViewModel(array(
                "policyFloatForm" => $policyFloatForm
                // "offerEntity" => $offerEntity
            ));
            $view->setTemplate("customer-upload-policy-form-modal-snippet");
            $modal = new WasabiModal("standard", "Upload Existing Policy");

            $modal->setContent($view);

            $modalView = new WasabiModalView("#wasabi_modal_view", $this->renderer, $modal);

            $response->add($modalView);
        }
        return $this->getResponse()->setContent($response);
    }

    /**
     * End Async Call
     */
    public function noAuthorization()
    {}

    public function newAction()
    {
        $em = $this->entityManager;
        $customerForm = $this->customerForm;
        $customerEntity = $this->customerEntity;
        $message = NULL;
        $res = NULL;
        $customerForm->bind($customerEntity);
        // var_dump($this->generalService->getBrokerAbsoluteLogo());
        $customerService = $this->customerService;
        $myCustomers = $customerService->getMyCustomer();
        $request = $this->getRequest();
        // $centralBroker = $em->find("Users\Entity\InsuranceBrokerRegistered", $this->centralBrokerId);

        // $brokerLogo = ($centralBroker->getCompanyLogo() != NULL ? $centralBroker->getCompanyLogo()->getDocUrl() : $this->url()->fromRoute("welcome", array(), array( 'force_canonical' => true))."images/logow.png");
        // var_dump($brokerLogo);
        if ($request->isPost()) {
            $post = $request->getPost();
            // var_dump($post);
            // die(print_r($post));
            $customerForm->setData($post);
            $this->setNewValidationGroup($customerForm);
            if ($customerForm->isValid()) {
                $data = $customerForm->getData();

                if ($post['individual'] == '0') {
                    $customerEntity->setCustomerCategory($em->find("Customer\Entity\CustomerCategory", CustomerService::CUSTOMER_CATEGORY_IND));
                    $customerEntity->setDob(new \DateTime($post['customerFieldset']['dob']));
                } else {
                    $customerEntity->setCustomerCategory($em->find("Customer\Entity\CustomerCategory", CustomerService::CUSTOMER_CATEGORY_ORG));
                }

                $res = NULL;
                try {
                    // $this->url()->fromRoute()
                    $res = $customerService->hydrateCustomer($customerEntity);

                    if ($res != NULL) {
                        $template = NULL;
                        $messagePointers = NULL;
                        $centralBroker = $em->find("Users\Entity\InsuranceBrokerRegistered", $this->centralBrokerId);

                        $brokerLogo = ($centralBroker->getCompanyLogo() != NULL ? $centralBroker->getCompanyLogo()->getDocUrl() : $this->url()->fromRoute("welcome", array(), array(
                            'force_canonical' => true
                        )) . "images/logow.png");
                        $pinCode = $res["pinCode"];
                        $customerEntity = $res["customerEntity"];
                        $userEntity = $customerEntity->getUser();
                        $var = array(
                            "logo" => $brokerLogo,
                            "brokerName" => $centralBroker->getCompanyName(),
                            "pin" => $pinCode,
                            "username" => $userEntity->getUsername(),
                            "brokerSite" => $centralBroker->getBrokerWebsite(),
                            "loginUrl" => $this->url()->fromRoute("client_login", array(
                                "brokerid" => $centralBroker->getBrokerUid()
                            ), array(
                                'force_canonical' => true
                            ))
                        );

                        $template = array(
                            "var" => $var,
                            "template" => "general-customer-welcome-aboard"
                        );

                        $messagePointers = array(
                            "to" => $userEntity->getEmail(),
                            "fromName" => $centralBroker->getCompanyName(),
                            "subject" => "Successfull Registration"
                        );

                        $replyTo = $centralBroker->getUser()->getEmail();
                        $this->generalService->sendMails($messagePointers, $template, $replyTo);
                        $this->flashmessenger()->addSuccessMessage("Customer Successfully registered" . $res);
                        $this->redirect()->toRoute('customer/default', array(
                            'action' => 'pre-profile',
                            'id' => $customerEntity->getAccountId()
                        ));
                    } else {
                        $this->flashmessenger()->addErrorMessage("Something went wrong");
                    }
                } catch (\Exception $e) {
                    $this->flashMessenger()->addErrorMessage("Error ! Customer hydration error");
                }
            } else {
                $this->flashMessenger()->addErrorMessage('Validation Error ');
            }
        }
        $view = new ViewModel(array(
            'customerForm' => $customerForm,
            'myCustomers' => $myCustomers
        ));
        return $view;
    }

    private function setNewValidationGroup($form)
    {
        return $form->setValidationGroup(array(
            'csrf',
            'customerFieldset' => array(
                'user' => array(
                    'username',
                    'email'
                ),
                'name',
                'address1',
                'address2',
                'city',
                'state',
                'country'
            )
        ));
    }

    public function allAction()
    {
        $customerService = $this->customerService;
        $customer = $customerService->getMyCustomer();

        $view = new ViewModel(array(
            'customer' => $customer
        ));
        return $view;
    }

    public function assignstaffmodalAction()
    {
        $em = $this->entityManager;
        $customerId = $this->brokerCustomerSession->customerId;
        $customerEntity = $em->find("Customer\Entity\Customer", $customerId);
        $request = $this->getRequest();
        $response = new Response();
        $assignBrokerForm = $this->assignBrokerForm;
        $assignBrokerForm->setAttributes(array(
            "id" => "simpleForm",
            "class" => "form-horizontal form-label-left ajax_element",
            "data-ajax-loader" => "myLoader",
            "action" => $this->url()
                ->fromRoute("customer/default", array(
                "action" => "assignstaffmodal"
            ))
        ));
        // $assignBrokerForm->bind($customerEntity->getAssignedChildBroker());
        $viewModel = new ViewModel(array(
            "assignBrokerForm" => $assignBrokerForm
        ));
        $viewModel->setTemplate("broker-tool-assign-broker-form-snippet");
        if ($request->isPost()) {
            $post = $request->getPost();
            $childBRokerArray = $post['assignBrokerFieldset']['brokerChild'];
            // var_dump($childBRokerArray);
            foreach ($childBRokerArray as $childBroker) {
                $customerEntity->addAssignedChildBroker($em->find("GeneralServicer\Entity\BrokerChild", $childBroker));
            }
            // $customerEntity->getAssignedChildBroker()->addAssignedCustomer($customerEntity);

            try {
                $em->persist($customerEntity);
                $em->flush();

                $this->flashmessenger()->addSuccessMessage("Staffs Successfully assigned to the customer");
                $redirect = new Redirect($this->url()->fromRoute("customer/default", array(
                    "action" => "profile"
                )));
                $response->add($redirect);
            } catch (\Exception $e) {
                $gritter = new GritterMessage();
                $gritter->setTitle("Hydration Error");
                $gritter->setText("We could not save the information, please try again latter");
                $response->add($gritter);
            }
        } else {

            $modal = new WasabiModal("standard", "Assign Broker");
            $modal->setContent($viewModel);
            $modalView = new WasabiModalView("#wasabi_modal", $this->renderer, $modal);
            $response->add($modalView);
        }

        return $this->getResponse()->setContent($response);
    }

    public function addpropertymodalAction()
    {
        $em = $this->entityManager;
        $request = $this->getRequest();
        $response = new Response();
        $customerId = $this->brokerCustomerSession->customerId;
        $objectEntity = new Object();
        $objectPreForm = $this->objectPreForm;
        $objectPreForm->setAttributes(array(
            "id" => "simpleForm",
            "class" => "form-horizontal form-label-left ajax_element",
            "data-ajax-loader" => "myLoader",
            "action" => $this->url()
                ->fromRoute("customer/default", array(
                "action" => "addpropertymodal"
            ))
        ));
        $objectPreForm->bind($objectEntity);

        $viewModel = new ViewModel(array(
            "objectPreForm" => $objectPreForm
        ));
        if ($request->isPost()) {
            $post = $request->getPost();

            $objectPreForm->setData($post);

            $objectPreForm->setValidationGroup(array(
                "csrf",
                "objectFieldset" => array(
                    "objectName",
                    "currency",
                    "value",
                    "objectType"
                )
            ));
            if ($objectPreForm->isValid()) {
                $data = $objectPreForm->getData();
                $customerId = $this->brokerCustomerSession->customerId;
                $strippedValue = str_replace(',', '', $data->getValue());
                $objectEntity->setCreatedOn(new \DateTime())
                    ->setCustomer($em->find("Customer\Entity\Customer", $customerId))
                    ->setIsHidden(FALSE)
                    ->setObjectStatus($em->find("Object\Entity\ObjectStatus", ObjectService::OBJECT_STATUS_PROCESSING))
                    ->setValue($strippedValue)
                    ->setObjectUid($this->objectService->generateObjectUid())
                    ->setValueLocked(TRUE);

                try {

                    $em->persist($objectEntity);
                    $em->flush();
                    $this->objectService->getObjectSession()->objectId = $objectEntity->getId();
                    $this->flashmessenger()->addSuccessMessage("The property was successfuly created");
                    $redirect = new Redirect($this->url()->fromRoute("customer/default", array(
                        "action" => "profile"
                    )));
                    $response->add($redirect);
                } catch (\Exception $e) {
                    $gritter = new GritterMessage();
                    $gritter->setTitle("Hydration Error");
                    $gritter->setText("Could not  ");
                    $response->add($gritter);
                }
            }
        } else {
            $viewModel->setTemplate("object-modal-form");

            $modal = new WasabiModal("standard", "Add Property");
            $modal->setContent($viewModel);

            $modalView = new WasabiModalView("#wasabi_modal", $this->renderer, $modal);

            $response->add($modalView);
        }
        return $this->getResponse()->setContent($response);
    }

    public function changepinAction()
    {
        $em = $this->entityManager;
        $request = $this->getRequest();

        $id = $this->brokerCustomerSession->customerId;
        if ($id == NULL) {
            $this->flashmessenger()->addErrorMessage("No customer identifier available");
            $this->redirect()->toRoute("customer");
        }
        $customerEntity = $em->find("Customer\Entity\Customer", $id);
        if ($customerEntity == NULL) {
            $this->flashmessenger()->addErrorMessage("Customer session not identitifed");
            $this->redirect()->toRoute("customer");
        }
        if ($request->isPost()) {
            $post = $request->getPost();
            $pin = $post['pinCodeFieldset']['pin'];
            $customerUserEntity = $customerEntity->getUser();
            $customerUserEntity->setPassword(UserService::encryptPassword($pin))->setUpdatedOn(new \DateTime());
            $em->persist($customerUserEntity);
            $em->flush();
            $message = "We have Successfullly changed your pin number to " . $pin;
            $this->smsService->sendBrokerSms($customerUserEntity->getUsername(), $this->smsService->getSenderName(), $message);
            $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $this->centralBrokerId);
            $message2 = "<br>If this change was not requested by you please notify us at " . $brokerEntity->getBrokerEmail();

            $messagePointers["to"] = $customerUserEntity->getEmail();
            $messagePointers['fromName'] = $brokerEntity->getBrokerName();
            $messagePointers['subject'] = "PinCode Reset";

            $template["template"] = "general-mail-default";
            $template["var"] = array(
                "topic" => "PinCode Reset",
                "logo" => $this->generalService->getBrokerLogo(),
                "message" => $message . $message2,
                "brokerName" => $brokerEntity->getBrokerName()
            );
            $this->generalService->sendMails($messagePointers, $template);

            $this->flashmessenger()->addSuccessMessage("Customer Pincode successfully changed" . $pin);
            $this->redirect()->toRoute("customer/default", array(
                "action" => "profile"
            ));
        }
        return $this->getResponse()->setContent(NULL);
    }

    public function editAction()
    {
        $response = new Response();
        $em = $this->entityManager;
        $customerForm = $this->customerForm;
        // $id = $this->params()->fromRoute("id", NULL);
        $data = $this->params()->fromQuery("data", NULL);
        if ($data != NULL) {
            $this->brokerCustomerSession->customerId = $data;
            $id = $this->brokerCustomerSession->customerId;
        } else {
            $id = $this->brokerCustomerSession->customerId;
        }
        $modal = new WasabiModal("standard", "Edit Customer Profile");
        $entity = "Customer\Entity\Customer";
        $request = $this->getRequest();
        $this->redirectPlugin()->idStatusRedirection($id, $entity);
        // get If User has authorization to edit this Customer

        $customerEntity = $em->find($entity, $id);
        $customerForm->bind($customerEntity);
        $customerForm->setAttributes(array(
            "id" => "simpleForm",
            "class" => "form-horizontal form-label-left ajax_element",
            "data-ajax-loader" => "myLoader",
            "action" => $this->url()
                ->fromRoute("customer/default", array(
                "action" => "edit"
            ))
        ));

        if ($request->isPost()) {
            $data = $request->getPost();

            $customerForm->setData($data);
            $customerForm->setValidationGroup(array(
                'csrf',
                "individual",
                'customerFieldset' => array(
                    'dob',
                    'name',
                    'address1',
                    'address2',
                    'city',
                    'state',
                    'country'
                )
            ));
            //
            if ($customerForm->isValid()) {
                $data = $customerForm->getData();

                if ($this->params()->fromPost("individual") == '0') {
                    $customerEntity->setCustomerCategory($em->find("Customer\Entity\CustomerCategory", CustomerService::CUSTOMER_CATEGORY_IND));
                    $customerEntity->setDob($data->getDob());
                } else {
                    $customerEntity->setCustomerCategory($em->find("Customer\Entity\CustomerCategory", CustomerService::CUSTOMER_CATEGORY_ORG));
                }
                $customerEntity->setName($data->getName())
                    ->setAddress1($data->getAddress1())
                    ->setAddress2($data->getAddress2())
                    ->setCity($data->getCity())
                    ->setState($data->getState())
                    ->setCountry($data->getCountry())
                    ->setUpdatedOn(new \DateTime());

                $em->persist($customerEntity);
                $em->flush();

                $gritter = new GritterMessage();
                $gritter->setType(GritterMessage::TYPE_SUCCESS);
                $gritter->setText("Successfully Updated customer information");
                $gritter->setTitle("Update Successfull");
                $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);
                $redirect = new Redirect($this->url()->fromRoute("customer/default", array(
                    "action" => "profile"
                )));
                $response->add($redirect);
                $response->add($gritter);
            }
        } else {

            $view = new ViewModel(array(
                'customerForm' => $customerForm,
                "myCustomers" => $customerEntity
            ));
            $view->setTemplate("customer-edit-profile-modal-snippet");
            $modal->setContent($view);
            $modalView = new WasabiModalView("#wasabi_modal_view", $this->renderer, $modal);
            $response->add($modalView);
        }
        // return $view;
        return $this->getResponse()->setContent($response);
    }

    public function viewAction()
    {
        $customer = NULL;
        $view = new ViewModel(array(
            'cutomer' => $customer
        ));

        return $view;
    }

    /**
     * Defines if the customer belongs to the broker
     * get the customer broker
     * Get the current broker
     * if customer broker is not == current broker
     * Show Error message
     * redirect to the all customer page
     */
    private function customerIsMine($customerId)
    {
        $em = $this->entityManager;

        $customerEntity = $em->find("Customer\Entity\Customer", $customerId);
        // var_dump("hii");
        // var_dump($customerEntity->getCustomerBroker()->getBroker());
        $customerBrokerId = $customerEntity->getCustomerBroker()
            ->getBroker()
            ->getId();

        $this->generalService->getCentralBroker();
        $brokerId = $this->generalService->getCentralBroker();
        // var_dump("Low");
        if ($customerBrokerId != $brokerId) {
            $this->flashmessenger()->addErrorMessage("This customer is does not belong to you");
        }
    }

    public function preProfileAction()
    {
        $em = $this->entityManager;
        $uid = $this->params()->fromRoute("id", NULL);
        // var_dump("hi");
        // $this->customerIsMine($id); // this defines if the customer belongs to the caller
        // var_dump("low");
        if ($uid == NULL) {
            $this->flashmessenger()->addErrorMessage("The identifier is not available");
            $this->redirect()->toRoute("customer/default", array(
                "action" => "all"
            ));
        } else {
            $customerEntity = $em->getRepository("Customer\Entity\Customer")->findOneBy(array(

                "accountId" => $uid
            ));
            $id = $customerEntity->getId();
            $this->brokerCustomerSession->customerId = $id;
            $this->redirect()->toRoute("customer/default", array(
                "action" => "profile"
            ));
        }

        $this->getResponse()->setContent(NULL);
    }

    public function profileAction()
    {
        $customer = NULL;
        $em = $this->entityManager;
        $objectPreForm = $this->objectPreForm;
        $claimsService = $this->claimsService;
        $invoiceService = $this->invoiceService;
        $customerService = $this->customerService;
        $assignBrokerForm = $this->assignBrokerForm;
        $id = $this->brokerCustomerSession->customerId;
        $entity = "Customer\Entity\Customer";
        // $id = $this->params()->fromRoute('id', NULL);
        $red = $this->redirectPlugin();
        $customerPinForm = $this->customerPinForm;
        $customerPinForm->setAttributes(array(
            "action" => $this->url()
                ->fromRoute("customer/default", array(
                "action" => "changepin"
            ))
        ));
        $assignBrokerForm->setAttributes(array(
            "action" => $this->url()
                ->fromRoute("customer/default", array(
                "action" => "assign-broker"
            ))
        ));
        $red->idStatusRedirection($id, $entity);
        if ($id == NULL) {
            $this->flashmessenger()->addErrorMessage("No identifier found for thie customer");
            $this->redirect()->toRoute('customer');
        }

        $customer = $em->find("Customer\Entity\Customer", $id);
        if ($customer == NULL) {
            $this->flashmessenger()->addErrorMessage("System Could not find this customer");
            $this->redirect()->toRoute('customer');
        }
        $customerActiveOffers = "";
        $customerPolicy = $this->policyService->setCustomerId($id)->getBrokerCustomerPolicy();
        // $customeSess = new Container("CUST" . $this->identity()->getId());
        // $customeSess->customer = $id;
        $customerService->setCustomer($id);
        $expiringInvoice = $invoiceService->getCustomerExpiringInvoice($id);
        $customerClaims = $claimsService->getCustomerUnsettleClaims($id); // get Unsettled Claims
        $customerProposals = $customerService->getSpecificCustomerProposals();
        $customerActiveOffers = $customerService->getSpecificCustomerOffers();

        $unpublishedPolicy = $em->getRepository("Policy\Entity\PolicyFloat")->findCustomerUnpublishedPolicy($id, $this->centralBrokerId);
        // var_dump($unpublishedPolicy);
        $view = new ViewModel(array(
            'customer' => $customer,
            'customerPolicy' => $customerPolicy,
            'unsettledClaims' => $customerClaims,
            'customerProposal' => $customerProposals,
            'customerActiveOffer' => $customerActiveOffers,
            "objectPreForm" => $objectPreForm,
            "expiringInvoices" => $expiringInvoice,
            "assignBrokerForm" => $assignBrokerForm,
            "customerPinForm" => $customerPinForm,
            "messageForm" => $this->messageForm,
            "unpublishedPolicy" => $unpublishedPolicy
        ));
        return $view;
    }

    public function customerObjectAction()
    {
        $em = $this->entityManager;
        // $customerId = $this->params()->fromRoute("id", NULL);
        $customerId = $this->brokerCustomerSession->customerId;
        if ($customerId == NULL) {
            $this->flashmessenger()->addErrorMessage("No identifier available for this property");
            $this->redirect()->toRoute("object");
        }
        // $objects = $em->getRepository("Object\Entity\Object")->findBy(array(
        // "customer" => $customerId
        // ));
        // $this->objectNotMine($customerId);
        $objects = $em->getRepository("Object\Entity\Object")->findBy(array(
            "customer" => $customerId
        ), array(
            "id" => "DESC"
        ));

        $customerEntity = $em->find("Customer\Entity\Customer", $customerId);
        $view = new ViewModel(array(
            "objects" => $objects,
            "customer" => $customerEntity
        ));
        return $view;
    }

    /**
     * This funtion assigns a Broker to a customer
     *
     * @return mixed
     */
    public function assignBrokerAction()
    {
        $em = $this->entityManager;
        $customerId = $this->brokerCustomerSession->customerId;
        $customerEntity = $em->find("Customer\Entity\Customer", $customerId);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $post = $request->getPost();
            $childBRokerArray = $post['assignBrokerFieldset']['brokerChild'];
            // var_dump($childBRokerArray);
            foreach ($childBRokerArray as $childBroker) {
                $customerEntity->addAssignedChildBroker($em->find("GeneralServicer\Entity\BrokerChild", $childBroker));
            }
            // $customerEntity->getAssignedChildBroker()->addAssignedCustomer($customerEntity);

            try {
                $em->persist($customerEntity);
                $em->flush();

                $this->flashmessenger()->addSuccessMessage("Staffs Successfully assigned to the customer");
                $this->redirect()->toRoute("customer/default", array(
                    "action" => "profile"
                ));
            } catch (\Exception $e) {
                $this->flashmessenger()->addErrorMessage("This staff Could not be assigned to this customer at this time please try again later");
                $this->redirect()->toRoute("customer/default", array(
                    "action" => "profile"
                ));
            }
        }
        return $this->getResponse()->setContent(NULL);
    }

    /**
     * This action processes the creation of a new property and object
     *
     * @return mixed
     */
    public function objectPreProcessAction()
    {
        $em = $this->entityManager;
        // $objectEntity = new Object();
        $request = $this->getRequest();
        $customerId = $this->brokerCustomerSession->customerId;
        $objectEntity = new Object();
        $objectPreForm = $this->objectPreForm;
        $objectPreForm->bind($objectEntity);

        if ($request->isPost()) {
            // var_dump("baby");
            $post = $request->getPost();

            $objectPreForm->setData($post);

            $objectPreForm->setValidationGroup(array(
                "csrf",
                "objectFieldset" => array(
                    "objectName",
                    "currency",
                    "value",
                    "objectType"
                )
            ));

            if ($objectPreForm->isValid()) {
                // var_dump("babty");
                $data = $objectPreForm->getData();
                $customerId = $this->brokerCustomerSession->customerId;
                $strippedValue = str_replace(',', '', $data->getValue());
                $objectEntity->setCreatedOn(new \DateTime())
                    ->setCustomer($em->find("Customer\Entity\Customer", $customerId))
                    ->setIsHidden(FALSE)
                    ->setObjectStatus($em->find("Object\Entity\ObjectStatus", ObjectService::OBJECT_STATUS_PROCESSING))
                    ->setValue($strippedValue)
                    ->setObjectUid($this->objectService->generateObjectUid())
                    ->setValueLocked(TRUE);
                try {
                    $em->persist($objectEntity);
                    $em->flush();
                    $this->objectService->getObjectSession()->objectId = $objectEntity->getId();
                    $this->flashmessenger()->addSuccessMessage("The property was successfuly created");
                    $this->redirect()->toRoute("customer/default", array(
                        "action" => "profile"
                    ));
                } catch (\Exception $e) {
                    $this->flashmessenger()->addErrorMessage("There was a problem creating this property");
                    $this->redirect()->toRoute("customer/default", array(
                        "action" => "profile"
                    ));
                }
            }
        }
        return $this->getResponse()->setContent(NULL);
    }

    /**
     * This collects all the customers of the Mother Broker
     *
     * @return \Zend\View\Model\ViewModel
     */
    public function motherBrokerAction()
    {
        $customerService = $this->customerService;
        $motherBrokerCustomer = $customerService->getMotherBrokerCustomers();

        if ($this->identity()
            ->getRole()
            ->getId() != UserService::USER_ROLE_BROKER_CHILD) {
            // $this->redirect()->toRoute('customer/default', array('action'=>'all'));
        }
        $view = new ViewModel(array(
            'customer' => $motherBrokerCustomer
        ));
        return $view;
    }

    // Begin Setter Tools
    public function setEntityManager($em)
    {
        $this->entityManager = $em;

        return $this;
    }

    public function setCustomerForm($form)
    {
        $this->customerForm = $form;

        return $this;
    }

    public function setCustomerEntity($entity)
    {
        $this->customerEntity = $entity;

        return $this;
    }

    public function setCustomerService($service)
    {
        $this->customerService = $service;

        return $this;
    }

    public function setGeneralService($xserv)
    {
        $this->generalService = $xserv;
        return $this;
    }

    public function setObjectPreForm($form)
    {
        $this->objectPreForm = $form;
        return $this;
    }

    public function setBrokerCustomerSession($session)
    {
        $this->brokerCustomerSession = $session;
        return $this;
    }

    public function setObjectService($xserv)
    {
        $this->objectService = $xserv;
        return $this;
    }

    public function setClaimsService($xserv)
    {
        $this->claimsService = $xserv;
        return $this;
    }

    public function setInvoiceService($xserv)
    {
        $this->invoiceService = $xserv;
        return $this;
    }

    public function setAssignBrokerForm($form)
    {
        $this->assignBrokerForm = $form;
        return $this;
    }

    public function setCentralBrokerId($id)
    {
        $this->centralBrokerId = $id;
        return $this;
    }

    public function setCustomerPinForm($form)
    {
        $this->customerPinForm = $form;
        return $this;
    }

    public function setSmsService($serv)
    {
        $this->smsService = $serv;
        return $this;
    }

    public function setOtpForm($form)
    {
        $this->otpForm = $form;
        return $this;
    }

    public function setPolicyUploadForm($form)
    {
        $this->policyUploadForm = $form;
        return $this;
    }

    public function setPolicyService($xserv)
    {
        $this->policyService = $xserv;
        return $this;
    }

    public function setMessageForm($form)
    {
        $this->messageForm = $form;
        return $this;
    }

    public function setRenderer($ren)
    {
        $this->renderer = $ren;
        return $this;
    }

    public function setMessageService($xserv)
    {
        $this->messageService = $xserv;
        return $this;
    }

    public function setPolicyFloatForm($form)
    {
        $this->policyFloatForm = $form;
        return $this;
    }

    public function setCoverNoteService($xserv)
    {
        $this->coverNoteService = $xserv;
        return $this;
    }

    public function setPincodeForm($form)
    {
        $this->pincodeForm = $form;
        return $this;
    }

    // End Setter Tools
}
