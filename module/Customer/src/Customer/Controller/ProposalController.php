<?php
namespace Customer\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;
use Transactions\Entity\Invoice;
use Transactions\Service\InvoiceService;
use Proposal\Service\ProposalService;
use Messages\Service\MessageService;
use Messages\Entity\MessageEntered;
use Policy\Service\CoverNoteService;
use Messages\Entity\Messages;
use Object\Entity\Object;
use Object\Service\ObjectService;
use WasabiLib\Ajax\Response;
use WasabiLib\Modal\WasabiModal;
use WasabiLib\Modal\WasabiModalView;
use WasabiLib\Ajax\InnerHtml;
use WasabiLib\Ajax\DomManipulator;
use WasabiLib\Ajax\GritterMessage;
use GeneralServicer\Service\CurrencyService;
use WasabiLib\Ajax\Redirect;
use WasabiLib\Modal\Dialog;
use WasabiLib\Modal\Button;
use WasabiLib\Modal\WasabiModalConfigurator;
use Proposal\Entity\Proposal;
use GeneralServicer\Entity\Document;
use Customer\Service\ClientGeneralService;

class ProposalController extends AbstractActionController
{

    private $entityManager;

    private $clientGeneralService;

    private $customerBoardService;

    private $invoiceService;

    private $messageForm;

    private $messageService;

    private $objectForm;

    private $selectObjectForm;

    private $objectService;

    private $generalSession;

    private $renderer;

    private $dropZoneForm;

    private $blobService;

    public function onDispatch(\Zend\Mvc\MvcEvent $e)
    {
        $response = parent::onDispatch($e);
        $this->customerRedirectPlugin()->totalRedirection();
        $this->layout()->setTemplate('client-layout-board');
        return $response;
    }

    // Modals
    public function viewalldocumentmodalAction()
    {
        $em = $this->entityManager;
        $response = new Response();
        $modal = new WasabiModal("standard", "All Documents");
        $clientGeneralService = $this->clientGeneralService;
        $customerProposalSession = $clientGeneralService->getCustomerProposalSession();
        $proposalId = $customerProposalSession->proposalId;
        $gritter = new GritterMessage();
        $request = $this->getRequest();
        if ($proposalId == NULL) {
            $gritter->setTitle("Identifier Error");
            $gritter->setText("Absent identifier");
            $gritter->setType(GritterMessage::TYPE_ERROR);
            $gritter->setSticky(TRUE);

            $response->add($gritter);
        } else {
            
            /**
             * 
             * @var Proposal $proposalEntity
             */
            $proposalEntity = $em->find("Proposal\Entity\Proposal", $proposalId);
            $documents = $proposalEntity->getDocument();
            $viewModel = new ViewModel(array(
                'docs'=>$documents
            ));
            $viewModel->setTemplate("customer_proposal_document_modal_list");
            $modal->setContent($viewModel);
            $modalView = new WasabiModalView("#wasabi", $this->renderer, $modal);
            $response->add($modalView);
            
        }
        return $this->getResponse()->setContent($response);
    }
    
    
    
    public function removedocumentAction(){
        $response = new Response();
        $em = $this->entityManager;
        $gritter = new GritterMessage();
        $docId = $this->params()->fromQuery("data", NULL);
        if($docId == NULL){
            $gritter->setTitle("Identifier Error");
            $gritter->setText("Absent Identifier");
            $gritter->setType(GritterMessage::TYPE_ERROR);
            $gritter->setSticky(TRUE);
            
            $response->add($gritter);
            
        }else{
            $clientGeneralService = $this->clientGeneralService;
            $customerProposalSession = $clientGeneralService->getCustomerProposalSession();
            $proposalId = $customerProposalSession->proposalId;
            /**
             * 
             * @var Proposal $proposalEntity
             */
            $docEntity = $em->find("GeneralServicer\Entity\Document", $docId);
            $proposalEntity = $em->find("Proposal\Entity\Proposal", $proposalId);
            $proposalEntity->removeDocument($docEntity)->setUpdatedOn(new \DateTime());
            try {
                $em->persist($proposalEntity);
                $em->flush();
                
                $gritter->setText("Document Removed");
                $gritter->setTitle("Success");
                $gritter->setType(GritterMessage::TYPE_SUCCESS);
                $gritter->setSticky(TRUE);
                
                $response->add($gritter);
                
                $redirect = new Redirect($this->url()->fromRoute("cus_proposal/default", array("action"=>"view")));
                $response->add($redirect);
            } catch (\Exception $e) {
                $gritter->setTitle("Hydration Error");
                $gritter->setText("We could not remove the doc at this moment, please try again later");
                $gritter->setType(GritterMessage::TYPE_ERROR);
                $gritter->setSticky(TRUE);
                // trigger error log
                $response->add($gritter);
            }
        }
        return $this->getResponse()->setContent($response);
    }

    /**
     * This removes objects from the list
     *
     * @return mixed
     */
    public function removeobjectdialogAction()
    {
        $dialog = new Dialog("Dialog", "Are you sure", "The property would be removed from the list ", Dialog::TYPE_SUCCESS);
        $id = $this->params()->fromQuery("data");
        $cbutton = new Button("Accept");
        $cbutton->setAction($this->url()
            ->fromRoute("cus_proposal/default", array(
            "action" => "remove-object",
            "id" => $id
        )));

        $dialog->setConfirmButton($cbutton);
        $modalView = new WasabiModalView("#wasabi", $this->renderer, $dialog);
        $response = new Response();
        $response->add($modalView);
        return $this->getResponse()->setContent($response);
    }

    /**
     *
     * @return mixed
     */
    public function getcoverdetailsmodalAction()
    {
        $em = $this->entityManager;
        $response = new Response();
        $clientGeneralService = $this->clientGeneralService;
        $customerProposalSession = $clientGeneralService->getCustomerProposalSession();
        $proposalId = $customerProposalSession->proposalId;
        $proposalEntity = NULL;

        if ($proposalId == NULL) {
            $gritter = new GritterMessage();
            $gritter->setText("Absent proposal ID");
            $gritter->setTitle("Error");
            $gritter->setType(GritterMessage::TYPE_ERROR);
            $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);
            return $response->add($gritter);
        } else {
            $proposalEntity = $em->find("Proposal\Entity\Proposal", $proposalId);
        }
        $coverEntity = $proposalEntity->getCoverDetails();
        $serviceId = $proposalEntity->getSpecificService()->getId();

        $viewModel = new ViewModel(array(
            "serviceId" => $serviceId,
            "coverEntity" => $coverEntity
        ));
        // var_dump($serviceId);
        $viewModel->setTemplate("get_cover_details_modal");
        $modal = new WasabiModal("standard", "Cover Details");
        $modal->setContent($viewModel);

        $modalView = new WasabiModalView("#wasabi", $this->renderer, $modal);
        $response->add($modalView);
        return $this->getResponse()->setContent($response);
    }

    /**
     *
     * @return mixed
     */
    public function uploaddropzoneAction()
    {
        $em = $this->entityManager;
        $clientBlobService = $this->blobService;
        $clientBlobService->setCentralBrokerUid($this->clientGeneralService->getBrokerUid());
        $response = new Response();
        $clientGeneralService = $this->clientGeneralService;
        $customerProposalSession = $clientGeneralService->getCustomerProposalSession();
        $proposalId = $customerProposalSession->proposalId;
        $request = $this->getRequest();
        if ($request->isPost() || $request->isXmlHttpRequest()) {
            $files = $this->params()->fromFiles('file');

            $res = $this->blobService->uploadBlob($files); // which is the docEntity

            $gritter = new GritterMessage();
            try {
                if ($res != NULL) {

                    // $docEntity = $em->find("GeneralServicer\Entity\Document", $res);

                    $proposalEntity = $em->find("Proposal\Entity\Proposal", $proposalId);
                    $proposalEntity->addDocument($res)->setUpdatedOn(new \DateTime());

                    $em->persist($proposalEntity);
                    $em->persist($res);
                    $em->flush();

                    $gritter->setTitle("Success");
                    $gritter->setText("Success: Uploaded document");
                    $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);
                    $gritter->setType(GritterMessage::TYPE_SUCCESS);

                    // $gritter->set

                    $response->add($gritter);
                }
            } catch (\Exception $e) {
                $gritter->setType(GritterMessage::TYPE_ERROR);
                $gritter->setTitle("Error");
                $gritter->setText("Error: Problem uploading documents");
                $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);

                $response->add($gritter);
            }
        }
        return $this->getResponse()->setContent($response);
    }

    /**
     * This function provides a modal server connection to the property
     * creates a new property and assigns it to the proposal
     *
     *
     * @return mixed
     */
    public function registernewpropertyAction()
    {
        $em = $this->entityManager;
        $response = new Response();
        $objectForm = $this->objectForm;
        $clientGeneralService = $this->clientGeneralService;
        $customerProposalSession = $clientGeneralService->getCustomerProposalSession();
        $proposalId = $customerProposalSession->proposalId;

        if ($proposalId == NULL) {
            $gritter = new GritterMessage();
            $gritter->setTitle("Error");
            $gritter->setText("Could not create property information");
            $gritter->setType(GritterMessage::TYPE_ERROR);
            $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);

            $response->add($gritter);
        } else {

            $viewModel = new ViewModel(array(
                "objectForm" => $objectForm
            ));
            $objectForm->setAttributes(array(
                "class" => "form-horizontal form-label-left ajax_element",
                "id" => "simpleForm",
                "data-ajax-loader" => "registerNewLoader",
                "action" => $this->url()
                    ->fromRoute("cus_proposal/default", array(
                    "action" => "registernewproperty"
                ))
            ));
            $viewModel->setTemplate("object-register-new-object-modal-form");
            $modal = new WasabiModal("standard", "Register Property");
            $modal->setContent($viewModel);

            $modalView = new WasabiModalView("#wasabi", $this->renderer, $modal);
            $request = $this->getRequest();
            if ($request->isPost()) {
                $objectEntity = new Object();
                $post = $request->getPost();
                $objectForm->setData($post);
                $objectForm->bind($objectEntity);
                if ($objectForm->isValid()) {
                    $data = $objectForm->getData();
                    try {
                        $proposalEntity = $em->find("Proposal\Entity\Proposal", $proposalId);
                        $value = CurrencyService::cleanInputValueStatic($data->getValue());
                        $proposalEntity->addObject($objectEntity);
                        $objectEntity->setValue($value)
                            ->setCreatedOn(new \Datetime())
                            ->setObjectUid($this->objectService->generateObjectUid())
                            ->setIsHidden(FALSE)
                            ->setCustomer($proposalEntity->getCustomer())
                            ->setObjectStatus($em->find("Object\Entity\ObjectStatus", ObjectService::OBJECT_STATUS_PROCESSING));

                        $em->persist($objectEntity);
                        $em->persist($proposalEntity);

                        $em->flush();
                        $gritter = new GritterMessage();
                        $gritter->setTitle("Success");
                        $gritter->setText("Successfully created property");
                        $gritter->setType(GritterMessage::TYPE_SUCCESS);
                        $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);
                        $response->add($gritter);

                        $redirect = new Redirect($this->url()->fromRoute("cus_proposal/default", array(
                            "action" => "view"
                        )));
                        $response->add($redirect);
                    } catch (\Exception $e) {
                        $gritter = new GritterMessage();
                        $gritter->setTitle("Error");
                        $gritter->setText("Could not create property information");
                        $gritter->setType(GritterMessage::TYPE_ERROR);
                        $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);

                        $response->add($gritter);
                    }
                }
            } else {
                $response->add($modalView);
            }
        }

        return $this->getResponse()->setContent($response);
    }

    /**
     * Selects an unassigned ppropoerty and assigns it tio the proposal
     * This is an ajax call / modal form to creating a
     *
     * @return mixed
     */
    public function selectpropertyAction()
    {
        $em = $this->entityManager;
        $response = new Response();
        $clientGeneralService = $this->clientGeneralService;
        $customerProposalSession = $clientGeneralService->getCustomerProposalSession();
        $proposalId = $customerProposalSession->proposalId;
        $selectObjectForm = $this->selectObjectForm;
        $selectObjectForm->setAttributes(array(
            "class" => "form-horizontal form-label-left ajax_element",

            "id" => "simpleForm",
            "data-ajax-loader" => "myLoader",
            "action" => $this->url()
                ->fromRoute("cus_proposal/default", array(
                "action" => "selectproperty"
            ))
        ));
        $selectObjectForm->get('selectObjectfield')
            ->get('object')
            ->setAttributes(array(
            "class" => "selectpicker"
        ));

        $viewModel = new ViewModel(array(
            "selectObjectForm" => $selectObjectForm
        ));

        $viewModel->setTemplate("customer_select_object_offer_snippet");

        $modal = new WasabiModal("standard", "Select Property");
        $modal->setContent($viewModel);

        $modalView = new WasabiModalView("#wasabi", $this->renderer, $modal);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $post = $request->getPost();
            $selectObjectForm->setData($post);
            // $selectObjectForm->bind()
            // if($selectObjectForm->isValid()){

            // }
            try {
                // var_dump($post);
                // var_dump($post["selectObjectfield"]);
                $proposalEntity = $em->find("Proposal\Entity\Proposal", $proposalId);
                foreach ($post["selectObjectfield"]["object"] as $select) {
                    $proposalEntity->addObject($em->find("Object\Entity\Object", $select));
                }

                $em->persist($proposalEntity);
                $em->flush();
                $gritter = new GritterMessage();
                $gritter->setTitle("Success");
                $gritter->setText("Successfully created property");
                $gritter->setType(GritterMessage::TYPE_SUCCESS);
                $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);

                $redirect = new Redirect($this->url()->fromRoute("cus_proposal/default", array(
                    "action" => "view"
                )));

                $response->add($gritter);

                $redirect = new Redirect($this->url()->fromRoute("cus_proposal/default", array(
                    "action" => "view"
                )));
                $response->add($redirect);
            } catch (\Exception $e) {
                $gritter = new GritterMessage();
                $gritter->setTitle("Error");
                $gritter->setText("Could not create property information");
                $gritter->setType(GritterMessage::TYPE_ERROR);
                $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);

                $response->add($gritter);
            }
        } else {
            $response->add($modalView);
        }

        return $this->getResponse()->setContent($response);
    }

    public function pdfproposalAction()
    {
        $response = new Response();
        $pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Nicola Asuni');
        $pdf->SetTitle('TCPDF Example 001');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
        $pdf->Open();
        $viewModel = new ViewModel(array(
            "pdf" => $pdf
        ));
        $viewModel->setTemplate("customer-proposal-pdf");

        $innerHtml = new InnerHtml();
        $innerHtml->setActionType(InnerHtml::ACTION_TYPE_REPLACE);
        $innerHtml->setSelector("#pdf");
        $innerHtml->setContent($this->renderer->render($viewModel));

        $response->add($innerHtml);
        return $this->getResponse()->setContent($response);
    }

    /**
     * Removes a property from the proposal via ajax
     *
     * @return mixed
     */
    public function removeObjectAction()
    {
        $em = $this->entityManager;
        $response = new Response();
        $objectId = $this->params()->fromRoute("id", NULL);
        $objectEntity = $em->find("Object\Entity\Object", $objectId);
        $clientGeneralService = $this->clientGeneralService;
        $customerProposalSession = $clientGeneralService->getCustomerProposalSession();
        $proposalId = $customerProposalSession->proposalId;

        $proposalEntity = $em->find("Proposal\Entity\Proposal", $proposalId);

        $proposalEntity->setUpdatedOn(new \DateTime());

        $proposalEntity->removeObject($objectEntity);
        $gritter = new GritterMessage();

        // $tcpdf = new T

        try {
            $em->persist($proposalEntity);
            $em->flush();
            $this->flashmessenger()->addSuccessMessage("The property was successfully removed ");
            // $this->redirect()->toRoute("cus_proposal/default", array(
            // "action" => "view"
            // ));

            $gritter->setTitle("Success");
            $gritter->setText("Successfully removed property from list");
            $gritter->setType(GritterMessage::TYPE_SUCCESS);
            $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);

            $response->add($gritter);
            $redirect = new Redirect($this->url()->fromRoute("cus_proposal/default", array(
                "action" => "view"
            )));
            $response->add($redirect);
        } catch (\Exception $e) {
            $this->flashmessenger()->addErrorMessage("There was a challenge removing this property from the package");
            $gritter->setTitle("Error");
            $gritter->setText("Error removing property from list");
            $gritter->setType(GritterMessage::TYPE_ERROR);
            $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);

            $response->add($gritter);

            $redirect = new Redirect($this->url()->fromRoute("cus_proposal/default", array(
                "action" => "view"
            )));
            $response->add($redirect);
        }
        return $this->getResponse()->setContent($response);
    }

    // public function removeobjectmodalAction()
    // {
    // $response = new Response();
    // $id = $this->params()->fromQuery("id", NULL);

    // return $this->getResponse()->setContent($response);
    // }

    /**
     * This functions provide the logic and form to send message to the customer
     *
     * @return mixed
     */
    public function sendmessageAction()
    {
        $em = $this->entityManager;
        $messageForm = $this->messageForm;
        $messageForm->setAttributes(array(
            "id" => "simpleForm",
            "class" => "form-horizontal form-label-left ajax_element",
            "data-ajax-loader" => "myLoader",
            "action" => $this->url()
                ->fromRoute("cus_proposal/default", array(
                "action" => "sendmessage"
            ))
        ));
        $messageService = $this->messageService;
        /**
         * 
         * @var ClientGeneralService $clientGeneralService
         */
        $clientGeneralService = $this->clientGeneralService;
        $customerProposalSession = $clientGeneralService->getCustomerProposalSession();
        $proposalId = $customerProposalSession->proposalId;

        $proposalEntity = $em->find("Proposal\Entity\Proposal", $proposalId);

        $messageEntity = "";

        if ($proposalEntity->getMessages() == NULL) {
            $messageEntity = new Messages();
        } else {
            $messageEntity = $proposalEntity->getMessages();
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $post = $request->getPost();
            $messageEntered = new MessageEntered();
            $messageEntity->setCreatedOn(new \DateTime())
                ->setMessageCategory($em->find("Settings\Entity\CoverCategory", CoverNoteService::COVERNOTE_CATEGORY_PROPOSAL))
                ->setProposals($proposalEntity)
                ->setBroker($em->find("Users\Entity\InsuranceBrokerRegistered", $clientGeneralService->getBrokerId()))
                ->setMessageUid($messageService->messageUid())
                ->addMessageEntered($messageEntered);

            $postMessageEntered = $post['messageEntered']['messageText'];

            $messageEntered->setCreatedOn(new \DateTime())
                ->setBrokerFunction($em->find("Messages\Entity\MessageFunction", MessageService::MESSAGE_FUNCTION_RECEIVER))
                ->setCustomerFunction($em->find("Messages\Entity\MessageFunction", MessageService::MESSAGES_FUNCTION_SENDER))
                ->setMessageStatus($em->find("Messages\Entity\MessageStatus", MessageService::MESSAGE_STATUS_UNREAD))
                ->setMessageText($postMessageEntered)
                ->setMessages($messageEntity);

            try {
                $em->persist($messageEntity);
                // $em->persist($messageEntered);
                $em->flush();
                /**
                 * Send Email Notification
                 */

                $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $this->clientGeneralService->getBrokerId());

                $pointer = NULL;
                $template = NULL;
                $pointer['to'] = $proposalEntity->getCustomer()
                    ->getUser()
                    ->getEmail();
                $pointer["fromName"] = $brokerEntity->getBrokerName();
                $pointer["subject"] = "Message from broker";

                $template["var"] = array(
                    "logo" => $this->clientGeneralService->getBrokerLogo(),
                    "brokerName" => $brokerEntity->getBrokerName(),
                    "sender" => $proposalEntity->getCustomer()->getName(),
                    "message" => $postMessageEntered
                );

                $template['template'] = "general-servicer-message-sent-mail";

                $this->clientGeneralService->getGeneralService()->sendMails($pointer, $template);

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
                $this->flashmessenger()->addErrorMessage("The message could not be sent now, please try again later ");
                $this->redirect()->toRoute("cus_proposal/default", array(
                    "action" => "view"
                ));
            }
        }

        $viewModel = new ViewModel(array(
            "messageForm" => $messageForm,
            "proposalEntity" => $proposalEntity
        ));

        $viewModel->setTemplate("customer_message_proposal_form");

        $modal = new WasabiModal("standard", "Send Message To Broker");
        $modal->setContent($viewModel);
        $modalView = new WasabiModalView("#messagemodal", $this->renderer, $modal);
        $response = new Response();
        $response->add($modalView);
        return $this->getResponse()->setContent($response);
    }

    // End Modals

    /**
     * Provides a list of all available proposal
     *
     * @return \Zend\View\Model\ViewModel
     */
    public function indexAction()
    {
        $em = $this->entityManager;
        $customerBoardService = $this->customerBoardService;
        $proposal = $customerBoardService->customerProposals();
        // var_dump($proposal);
        $view = new ViewModel(array(
            "proposals" => $proposal
        ));

        return $view;
    }

    /**
     * Provides a preprocess logic form viewing the proposal
     * Sets up the proposal for view
     *
     * @return mixed
     */
    public function preViewAction()
    {
        $id = $this->params()->fromRoute("id", NULL);
        $clientGeneralService = $this->clientGeneralService;
        if ($id == NULL) {
            $this->flashmessenger()->addErrorMessage("No identifier available for this this proposal");
            $this->redirect()->toRoute("cus_proposal");
        }
        $customerProposalSession = $clientGeneralService->getCustomerProposalSession();
        $customerProposalSession->proposalId = $id;
        if ($customerProposalSession->proposalId != NULL) {
            $this->redirect()->toRoute("cus_proposal/default", array(
                "action" => "view"
            ));
        }
        return $this->getResponse()->setContent(NULL);
    }

    public function sendMessagAction()
    {
        $em = $this->entityManager;
        // $customerOfferSession = new Container("customer_offer_session");
        // $customerOfferSession->isFromOfferNowAction = TRUE;
        $messageService = $this->messageService;
        $clientGeneralService = $this->clientGeneralService;
        $customerProposalSession = $clientGeneralService->getCustomerProposalSession();
        $proposalId = $customerProposalSession->proposalId;

        $proposalEntity = $em->find("Proposal\Entity\Proposal", $proposalId);

        $messageEntity = "";

        if ($proposalEntity->getMessages() == NULL) {
            $messageEntity = new Messages();
        } else {
            $messageEntity = $proposalEntity->getMessages();
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $post = $request->getPost();
            $messageEntered = new MessageEntered();
            $messageEntity->setCreatedOn(new \DateTime())
                ->setMessageCategory($em->find("Settings\Entity\CoverCategory", CoverNoteService::COVERNOTE_CATEGORY_PROPOSAL))
                ->setProposals($proposalEntity)
                ->setMessageUid($messageService->messageUid())
                ->addMessageEntered($messageEntered);

            $postMessageEntered = $post['messageEntered']['messageText'];

            $messageEntered->setCreatedOn(new \DateTime())
                ->setBrokerFunction($em->find("Messages\Entity\MessageFunction", MessageService::MESSAGE_FUNCTION_RECEIVER))
                ->setCustomerFunction($em->find("Messages\Entity\MessageFunction", MessageService::MESSAGES_FUNCTION_SENDER))
                ->setMessageStatus($em->find("Messages\Entity\MessageStatus", MessageService::MESSAGE_STATUS_UNREAD))
                ->setMessageText($postMessageEntered)
                ->setMessages($messageEntity);

            try {
                $em->persist($messageEntity);
                // $em->persist($messageEntered);
                $em->flush();
                /**
                 * Send Email Notification
                 */

                $this->flashmessenger()->addSuccessMessage("Message was successfully Delivered");
                $this->redirect()->toRoute("cus_proposal/default", array(
                    "action" => "view"
                ));
            } catch (\Exception $e) {
                $this->flashmessenger()->addErrorMessage("The message could not be sent now, please try again later ");
                $this->redirect()->toRoute("cus_proposal/default", array(
                    "action" => "view"
                ));
            }
        }
        return $this->getResponse()->setContent(NULL);
    }

    public function viewinvoicemodalAction()
    {
        $response = new Response();
        $em = $this->entityManager;
        $clientGeneralService = $this->clientGeneralService;
        $customerProposalSession = $clientGeneralService->getCustomerProposalSession();
        $proposalId = $customerProposalSession->proposalId;
        $proposalEntity = $em->find("Proposal\Entity\Proposal", $proposalId);
        $invoiceEntity = $proposalEntity->getInvoice();
        $broker = $em->find("Users\Entity\InsuranceBrokerRegistered", $clientGeneralService->getBrokerId());
        $modal = new WasabiModal("standard", "Invoice Preview");
        $viewmodel = new ViewModel(array(
            "invoice" => $invoiceEntity,
            "broker" => $broker
        ));
        $viewmodel->setTemplate("transaction-invoice-preview-snipet");
        $modal->setContent($viewmodel);
        $modal->setSize(WasabiModalConfigurator::MODAL_LG);
        $modalView = new WasabiModalView("#wasabi", $this->renderer, $modal);
        $response->add($modalView);
        return $this->getResponse()->setContent($response);
    }

    /**
     * This provides a view for the details of a micro payment structure
     *
     * @return mixed
     */
    public function viewmicropaymentAction()
    {
        $em = $this->entityManager;

        $response = new Response();
        $invoiceId = $this->params()->fromQuery("data", NULL);
        $microPaymentEntity = $em->getRepository("Transactions\Entity\MicroPayment")->findBy(array(
            "invoice" => $invoiceId
        ));
        $invoiceEntity = $em->find("Transactions\Entity\Invoice", $invoiceId);
        $viewModel = new ViewModel(array(
            "datas" => $microPaymentEntity,
            "invoiceEntity" => $invoiceEntity
        ));
        $viewModel->setTemplate("transaction-micro-payment-view-details");
        $modal = new WasabiModal("standard", "View MicroPayment");
        $modal->setContent($viewModel);

        $modalView = new WasabiModalView("#wasabi", $this->renderer, $modal);
        $response->add($modalView);

        return $this->getResponse()->setContent($response);
    }

    /**
     * This provide the view of the proposal
     *
     * @return \Zend\View\Model\ViewModel
     */
    public function viewAction()
    {
        $em = $this->entityManager;
        $messageForm = $this->messageForm;
        $selectObjectForm = $this->selectObjectForm;
        $objectForm = $this->objectForm;
        $dropZoneForm = $this->dropZoneForm;
        $clientGeneralService = $this->clientGeneralService;
        $customerProposalSession = $clientGeneralService->getCustomerProposalSession();
        $proposalId = $customerProposalSession->proposalId;
        $this->generalSession->currentCustomerid = $this->clientGeneralService->getCustomerId();
        $messageForm->setAttributes(array(
            "action" => $this->url()
                ->fromRoute("cus_proposal/default", array(
                "action" => "send-message"
            )),
            "method" => "POST"
        ));

        $dropZoneForm->setAttributes(array(
            "action" => $this->url()
                ->fromRoute("cus_proposal/default", array(
                "action" => "uploaddropzone"
            ))
        ));
        // $criteria = array(
        // "proposalCode" => $proposalCode
        // );
        if ($proposalId == NULL) {

            $this->flashmessenger()->addErrorMessage("There was no identifier for this proposal");
            $this->redirect()->toRoute("cus_proposal/default");
        }
        $proposalEntity = $em->find("Proposal\Entity\Proposal", $proposalId);
        if ($proposalEntity == NULL) {
            $this->flashmessenger()->addErrorMessage("This proposal does not exist in our database");
            $this->redirect()->toRoute("cus_proposal/default");
        }
        if ($proposalEntity->getProposalStatus()->getId() == ProposalService::PROPOSAL_STATUS_WAITING_CUSTOMER_RESPONSE) {
            $proposalEntity->setProposalStatus($em->find("Proposal\Entity\ProposalStatus", ProposalService::PROPOSAL_STATUS_CUSTOMER_VIEWED));
            try {
                $em->persist($proposalEntity);
                $em->flush();
            } catch (\Exception $e) {
                return NULL;
            }
        }
        /**
         * if the status is waiting for customer to view
         * change it to customer viewed
         */
        // $customerProposalSession->proposalId = $proposalEntity->getId();
        $customerProposalSession->isFromProposalViewAction = TRUE;
        $view = new ViewModel(array(
            "proposalEntity" => $proposalEntity,
            "messageForm" => $messageForm,
            "objectForm" => $objectForm,
            "selectObjectForm" => $selectObjectForm,
            "dropZoneForm" => $dropZoneForm
        ));
        return $view;
    }

    public function selectObjectProcessAction()
    {
        $em = $this->entityManager;
        // $objectService = $this->objectService;
        $request = $this->getRequest();
        $clientGeneralService = $this->clientGeneralService;
        $customerProposalSession = $clientGeneralService->getCustomerProposalSession();
        $proposalId = $customerProposalSession->proposalId;
        $proposalEntity = $em->find("Proposal\Entity\Proposal", $proposalId);
        if ($request->isPost()) {
            $post = $request->getPost();
            if (count($post["selectObjectfield"]['object']) > 0) {
                foreach ($post["selectObjectfield"]['object'] as $obj) {

                    $objectEntity = $em->find("Object\Entity\Object", $obj);
                    $proposalEntity->addObject($objectEntity);
                }
            }

            try {
                $em->persist($proposalEntity);
                $em->flush();

                $this->flashmessenger()->addSuccessMessage("Property successfully included");
                $this->redirect()->toRoute("cus_proposal/default", array(
                    "action" => "view"
                ));
            } catch (\Exception $e) {
                $this->flashmessenger()->addErrorMessage("The property could not be included");
                $this->redirect()->toRoute("cus_offer/default", array(
                    "action" => "view"
                ));
            }
        }
        return $this->getResponse()->setContent(NULL);
    }

    public function objectFormProcessAction()
    {
        $em = $this->entityManager;
        $clientGeneralService = $this->clientGeneralService;
        $customerProposalSession = $clientGeneralService->getCustomerProposalSession();
        $proposalId = $customerProposalSession->proposalId;
        $objectForm = $this->objectForm;
        $objectService = $this->objectService;
        $clientGeneralService = $this->clientGeneralService;

        $request = $this->getRequest();
        $objectEntity = new Object();

        $proposalEntity = $em->find("Proposal\Entity\Proposal", $proposalId);

        if ($request->isPost()) {

            $postR = $request->getPost();
            $post = $postR["objectFieldset"];
            // var_dump($post);
            $strippedValue = str_replace(',', '', $post["value"]);
            $objectEntity->setCreatedOn(new \DateTime())
                ->setCustomer($em->find("Customer\Entity\Customer", $clientGeneralService->getCustomerId()))
                ->setCurrency($em->find("Settings\Entity\Currency", $post['currency']))
                ->setValue($strippedValue)
                ->setObjectName($post["objectName"])
                ->setIsHidden(FALSE)
                ->setObjectStatus($em->find("Object\Entity\ObjectStatus", ObjectService::OBJECT_STATUS_PROCESSING))
                ->setObjectType($em->find("Settings\Entity\ObjectType", $post["objectType"]))
                ->setObjectUid($objectService->generateObjectUid())
                ->setValueLocked(FALSE);

            // var_dump("dert");

            $proposalEntity->addObject($objectEntity);
            $proposalEntity->setUpdatedOn(new \DateTime());
            try {
                var_dump("HI");
                $em->persist($objectEntity);
                $em->persist($proposalEntity);
                $em->flush();

                $this->flashmessenger()->addSuccessMessage("The Property was successfully registered");
                $this->redirect()->toRoute("cus_proposal/default", array(
                    "action" => "view"
                ));
            } catch (\Exception $e) {
                $this->flashmessenger()->addErrorMessage("THe proprety was not successfully registered");
                $this->redirect()->toRoute("cus_proposal/default", array(
                    "action" => "view"
                ));
            }
        }
        return $this->getResponse()->setContent(NULL);
    }

    public function prePaymentAction()
    {
        $em = $this->entityManager;
        $generalSession = $this->clientGeneralService->getGeneralSession();
        $customerProposalSession = new Container("customer_proposal_session");
        $proposalEntity = $em->find("Proposal\Entity\Proposal", $customerProposalSession->proposalId);
        $premiumSession = new Container("proposal_premium");
        if ($proposalEntity->getInvoice() != NULL) {
            $invoiceEntity = $proposalEntity->getInvoice();
        } else {
            $invoiceEntity = new Invoice();
        }

        // $invoiceEntity->setAmount($premiumSession->premium)
        // ->setCurrency($em->find("Settings\Entity\Currency", $premiumSession->premiumCurrency))
        // ->setCustomer($em->find("Customer\Entity\Customer", $this->clientGeneralService->getCustomerId()))
        // ->setGeneratedOn(new \DateTime())
        // ->setExpiryDate(new \DateTime())
        // ->setInvoiceCategory($em->find("Transactions\Entity\InvoiceCategory", InvoiceService::INVOICE_CAT_PROPOSAL))
        // ->setProposal($proposalEntity)
        // ->setInvoiceUid($this->invoiceService->generateInvoiceNumber())
        // ->setIsOpen(TRUE)
        // ->setStatus($em->find("Transactions\Entity\InvoiceStatus", InvoiceService::INVOICE_UNPAID_STATUS))
        // ->setModifiedOn(new \DateTime());
        // $thisgenerates an invoice
        // If all process works make the redirection to board paymet
        // Else make the redirection to the present
        if ($customerProposalSession->isFromProposalViewAction == TRUE) {
            try {

                // $em->persist($invoiceEntity);
                // $em->flush();
                $generalSession->InvoiceId = $invoiceEntity->getId(); // This would be used accross all boards
                $customerProposalSession->isFromProposalViewAction = FALSE;
                $this->redirect()->toRoute("board/default", array(
                    "action" => "payment"
                ));
            } catch (\Exception $e) {
                $this->flashmessenger()->addErrorMessage("There was a problem processing payment");
                $this->redirect()->toRoute("cus_proposal");
            }
        } else {
            $this->flashmessenger()->addErrorMessage("Please select a proposal to pay");
            $this->redirect()->toRoute("cus_proposal");
        }
        return $this->getResponse()->setContent(NULL);
    }

    public function preProcessAction()
    {
        /**
         * This pre processes the functionality
         * prepares the process and creates a session for the processing
         */
        $em = $this->entityManager;
        $id = $this->params()->fromRoute("id", NULL);
        $customerProposalSession = new Container("customerProposalSession");
        $customerProposalSession->proposalId = $id;
        $proposalEntity = $em->find("Proposal\Entity\Proposal", $id);
        return $this->getResponse()->setContent(NULL);
    }

    /**
     * This processes the proposal for response to broker
     *
     * @return \Zend\View\Model\ViewModel
     */
    public function processAction()
    {
        $view = new ViewModel();
        return $view;
    }

    public function deleteAction()
    {
        $this->getResponse()->setContent(NULL);
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }

    public function setClientGeneralService($xserv)
    {
        $this->clientGeneralService = $xserv;
        return $this;
    }

    public function setCustomerBoardService($xserv)
    {
        $this->customerBoardService = $xserv;
        return $this;
    }

    public function setInvoiceService($xserv)
    {
        $this->invoiceService = $xserv;
        return $this;
    }

    public function setMessageForm($form)
    {
        $this->messageForm = $form;
        return $this;
    }

    public function setMessageService($xserv)
    {
        $this->messageService = $xserv;
        return $this;
    }

    public function setObjectForm($form)
    {
        $this->objectForm = $form;
        return $this;
    }

    public function setSelectObjectForm($form)
    {
        $this->selectObjectForm = $form;
        return $this;
    }

    public function setObjectService($xserv)
    {
        $this->objectService = $xserv;
        return $this;
    }

    public function setGeneralSession($sess)
    {
        $this->generalSession = $sess;
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

    public function setBlobService($xserv)
    {
        $this->blobService = $xserv;
        return $this;
    }
}