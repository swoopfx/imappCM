<?php
namespace Offer\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Offer\Entity\Offer;
use Offer\Service\OfferService;
use Object\Entity\Object;
use Object\Service\ObjectService;
use Zend\Session\Container;
use Transactions\Service\InvoiceService;
use Policy\Entity\CoverNote;
use Policy\Service\CoverNoteService;
use WasabiLib\Modal\WasabiModal;
use WasabiLib\Modal\WasabiModalView;
use WasabiLib\Ajax\Response;
use Messages\Entity\Messages;
use Messages\Service\MessageService;
use Messages\Entity\MessageEntered;
use Transactions\Entity\Invoice;
use GeneralServicer\Entity\ManualPremium;
use WasabiLib\Modal\Info;
use WasabiLib\Ajax\InnerHtml;
use WasabiLib\Ajax\DomManipulator;
use WasabiLib\Ajax\Redirect;
use Zend\Http\Request;
use Transactions\Entity\MicroPayment;
use Transactions\Service\TransactionService;

class IndexController extends AbstractActionController
{

    /**
     *
     * @var ModuleOptions
     */
    protected $options = null;

    /**
     *
     * @var Doctrine\ORM\EntityManager
     */
    protected $entityManager = null;

    /**
     *
     * @var Zend\Mvc\I18n\Translator
     */
    protected $translatorHelper = null;

    /**
     *
     * @var Zend\Form\Form
     */
    protected $offerForm = null;

    private $offerSession;

    protected $offerInfoForm;

    protected $activeOffer;

    protected $offerEntity;

    protected $offerId;

    private $offerService;

    protected $offerUid;

    private $objectForm;

    protected $allObjects;

    protected $userService;

    private $mailService;

    private $generalService;

    private $centralBrokerId;

    private $objectService;

    private $invoiceService;

    private $coverNoteForm;

    private $coverNoteService;

    private $messageForm;

    private $messageService;

    private $renderer;

    private $selectObjectForm;

    private $recommendForm;

    private $microPaymentForm;

    private $manualPremiumForm;

    private $currencyService;

    private $dropZoneForm;

    private $blobService;

    public function onDispatch(\Zend\Mvc\MvcEvent $e)
    {
        $response = parent::onDispatch($e);
        $this->redirectPlugin()->redirectCondition();
        return $response;
    }

    public function generatemicropaymentAction()
    {
        $em = $this->entityManager;
        
        // if ($request->isPost()) {
        $offerService = $this->offerService;
        $offerId = $offerService->getOfferSession()->offerId;
        $offerEntity = $em->find("Offer\Entity\Offer", $offerId);
        $microPaymentSession = $this->invoiceService->getMicroPaymentSession();
        $divisor = $microPaymentSession->divisor;
        $value = $microPaymentSession->value;
        $microPaymentEntity = "";
        $redirect = new Redirect($this->url()->fromRoute("offer/default", array(
            "action" => "process"
        )));
        // $offerEntity->getInvoice()->getIsMicro() == NULL || $offerEntity->getInvoice()->getIsMicro() == FALSE
        
        $data = $this->invoiceService->generateMicroPayment($microPaymentSession->divisor, $microPaymentSession->value);
        $offerEntity->getInvoice()->setIsMicro(True);
        
        $em->persist($offerEntity);
        
        $this->removeMicro($offerEntity->getInvoice());
        
        for ($i = 0; $i < count($data["value"]); $i ++) {
            
            $microPaymentEntity = new MicroPayment();
            
            $microPaymentEntity->setCreatedOn(new \DateTime())
                ->setDueDate($data["dueDate"][$i])
                ->setValue($data["value"][$i])
                ->setInvoice($offerEntity->getInvoice())
                ->setMicroPaymentStructure($em->find("Settings\Entity\MicroPaymentStructure", $microPaymentSession->divisor))
                ->setStatus($em->find("Transactions\Entity\TransactionStatus", TransactionService::TRANSACTION_STATUS_SETTLED));
            
            $em->persist($microPaymentEntity);
            $em->flush();
        }
        
        $this->flashmessenger()->addSuccessMessage("Successfully Generated MicroPayment" . count($data["value"]));
        $response = new Response();
        $response->add($redirect);
        return $this->getResponse()->setContent($response);
        
        // }
        // $response = new Response();
        // return $this->getResponse()->setContent($response);
    }

    public function removeMicro($id)
    {
        if ($id != NULL) {
            $em = $this->entityManager;
            $dataArray = $em->getRepository("Transactions\Entity\MicroPayment")->findBy(array(
                "invoice" => $id
            ));
            foreach ($dataArray as $arr) {
                $em->remove($arr);
                $em->flush();
            }
        }
    }

    public function micropayAction()
    {
        $em = $this->entityManager;
        $microPaymentForm = $this->microPaymentForm;
        $microPaymentForm->setAttributes(array(
            "id" => "simpleForm",
            "class" => "form-horizontal form-label-left ajax_element",
            "data-ajax-loader" => "myLoader",
            "action" => $this->url()
                ->fromRoute("offer/default", array(
                "action" => "micropay"
            ))
        ));
        $request = $this->getRequest();
        if ($request->isPost()) {
            $post = $request->getPost();
            $microPaymentSession = $this->invoiceService->getMicroPaymentSession();
            $microPaymentSession->divisor = $post['microPayment'];
            $offerService = $this->offerService;
            $offerId = $offerService->getOfferSession()->offerId;
            $offerEntity = $em->find("Offer\Entity\Offer", $offerId);
            $microPaymentSession->value = "";
            if ($offerEntity->getIsManualPremium() == TRUE) {
                $microPaymentSession->value = $offerEntity->getManualPremium()->getPremium();
            } else {
                $microPaymentSession->value = $offerEntity->getInvoice()->getAmount();
            }
            $innerHtml = new InnerHtml();
            
            $innerHtml->setSelector("#microdetails");
            $innerHtml->setContent($this->microDetails($this->invoiceService->generateMicroPayment($microPaymentSession->divisor, $microPaymentSession->value)));
            $innerHtml->setVariables(array(
                "details" => "microDetails"
            ));
            $innerHtml->setTemplate("transaction-micro-payment-view-details");
            // $innerHtml->setContent($microPaymentSession->value);
            // $innerHtml->setViewModel($viewModel);
            $response = new Response();
            $response->add($innerHtml);
            return $this->getResponse()->setContent($response);
            // }
        }
        $view = new ViewModel(array(
            "microPaymentForm" => $microPaymentForm
        ));
        $view->setTemplate("transaction-micro-payment-snipet");
        $modal = new WasabiModal("standard", "Micro Payment Generator");
        $modal->setContent($view);
        
        $modalView = new WasabiModalView("#micropayment", $this->renderer, $modal);
        $response = new Response();
        $response->add($modalView);
        
        return $this->getResponse()->setContent($response);
    }

    private function microDetails($data)
    {
        $json = array(
            "type" => "standard"
        );
        $da = new \DateTime();
        // $da->format($format)
        
        $info = "";
        if (count($data) > 0) {
            for ($i = 0; $i < count($data["value"]); $i ++) {
                $info .= "<tr>

                                  <td>Payment " . ($i + 1) . "</td>
                                  <td>" . number_format((float) $data['value'][$i], 2, '.', '') . "</td>
                                  <td>" . $data['dueDate'][$i]->format("D, d M Y ") . "</td>
                                  
                                </tr>";
            }
        }
        
        $frame = "<div class='panel-body'>
                            <table class='table table-striped'>
                              <thead>
                                <tr>
                                  
                                  <th>Payment</th>
                                  <th>Amount Payable</th>
                                  <th>Date</th>
                                </tr>
                              </thead>
                              <tbody>
                                
                                " . $info . "

                              </tbody>
                            </table>
<button id='btn3' class='ajax_element btn btn-xs btn-success'
						data-json='" . json_encode($json) . "' data-ajax-loader='ver_loader' data-href='generatemicropayment'
						style='width: 100%;'>
						 Generate MicroPayment
					</button>

                          </div>";
        
        return $frame;
    }

    /**
     * Use this action to remind the Customer of his incomplete offer form
     */
    public function remindAction()
    {
        $em = $this->entityManager;
        $offerService = $this->offerService;
        $centralBrokerId = $this->centralBrokerId;
        $offerId = $this->params()->fromRoute("id", NULL);
        $mailService = $this->mailService;
        if ($offerId == NULL) {
            $this->flashmessenger()->addErrorMessage("No identifier available");
            $this->redirect()->toRoute("offer");
        }
        $offerEntity = $em->find("Offer\Entity\Offer", $offerId);
        $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $centralBrokerId);
        $customerEmail = $offerEntity->getCustomer()
            ->getUser()
            ->getEmail();
        $messagePointers = array(
            "to" => $customerEmail,
            "from" => $brokerEntity->getBrokerName(),
            "subject" => "Incomplete Offer"
        );
        $var = array(
            "logo" => "" // company logo
        );
        
        $template = "";
        
        try {
            $offerService->offerMail($messagePointers, $var, $template);
            $this->flashmessenger()->addSuccessMessage("Successfully reminded the customer");
            $this->redirect()->toRoute("offer");
        } catch (\Exception $e) {
            $this->flashmessenger()->addErrorMessage("There was a problem reminding the customer");
            $this->redirect()->toRoute("offer");
        }
        return $this->getResponse()->setContent(NULL);
    }

    private function noAuthorization($id)
    {}

    /**
     * This function updates the recommended Insurer information for the customer
     *
     * @return mixed
     */
    public function recommendAction()
    {
        $em = $this->entityManager;
        $offerService = $this->offerService;
        $offerId = $offerService->getOfferSession()->offerId;
        $offerEntity = $em->find("Offer\Entity\Offer", $offerId);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $post = $request->getPost();
            
            $offerEntity->setRecommendedInsurer($em->find("Settings\Entity\Insurer", $post['recommendedInsurer']))
                ->setUpdatedOn(new \DateTime());
            // var_dump($post);
            try {
                $em->persist($offerEntity);
                $em->flush();
                
                $this->flashmessenger()->addSuccessMessage("Insurer recommended to customer");
                $this->redirect()->toRoute("offer/default", array(
                    "action" => "process"
                ));
            } catch (\Exception $e) {
                $this->flashmessenger()->addErrorMessage("We could not recommend this Insurer");
                $this->redirect()->toRoute("offer/default", array(
                    "action" => "process"
                ));
            }
        }
        return $this->getResponse()->setContent(NULL);
    }

    public function preProcessAction()
    {
        $em = $this->entityManager;
        $offerService = $this->offerService;
        $offerSession = $this->offerSession;
        $id = $this->params()->fromRoute("id", NULL);
        $process = $this->params()->fromRoute("pro", NULL);
        if ($id == NULL) {
            $this->flashmessenger()->addErrorMessage("An identity does not exist for this oofer");
            $this->redirect()->toRoute("offer");
        }
        $this->noAuthorization($id);
        $offerEntity = $em->find("Offer\Entity\Offer", $id);
        if ($offerEntity->getOfferStatuses()->getId() == OfferService::OFFER_STATUS_SUBMITTED) {
            $offerEntity->setOfferStatuses($em->find("Offer\Entity\OfferStatus", OfferService::OFFER_STATUS_PROCESSING))
                ->setUpdatedOn(new \DateTime())
                ->setIsPolicized(FALSE)
                ->setIsHidden(FALSE);
        }
        if ($offerEntity->getInvoice() != NULL) {
            if ($offerEntity->getInvoice()
                ->getStatus()
                ->getId() == InvoiceService::INVOICE_PAID_STATUS) {
                $offerEntity->setOfferStatuses($em->find("Offer\Entity\OfferStatus", OfferService::OFFER_STATUS_PAID_PROCESSING))
                    ->setUpdatedOn(new \DateTime());
            }
        }
        try {
            
            $em->persist($offerEntity);
            $em->flush();
            $offerSession->offerId = $id;
            $this->redirect()->toRoute("offer/default", array(
                "action" => "process"
            ));
        } catch (\Exception $e) {
            $this->flashmessenger()->addErrorMessage("The selected offer could not be pre-processed");
            $this->redirect()->toRoute("offer");
        }
        return $this->getResponse()->setContent(NULL);
    }

    /**
     * This removes the manual premium on submitted on the offer
     *
     * @return mixed
     */
    public function removeManualPremiumAction()
    {
        $em = $this->entityManager;
        $offerService = $this->offerService;
        $offerId = $offerService->getOfferSession()->offerId;
        $offerEntity = $em->find("Offer\Entity\Offer", $offerId);
        $manualPremium = $offerEntity->getManualPremium();
        
        $offerEntity->setIsManualPremium(False)->setUpdatedOn(new \DateTime());
        $manualPremium->setOffer(NULL);
        try {
            
            $em->persist($offerEntity);
            $em->persist($manualPremium);
            
            $em->flush();
            
            $this->flashmessenger()->addSuccessMessage("Premium is now auto generated");
            $this->redirect()->toRoute("offer/default", array(
                "action" => "process"
            ));
        } catch (\Exception $e) {
            $this->flashmessenger()->addErrorMessage("There was a problem removing the manual premium");
            $this->redirect()->toRoute("offer/default", array(
                "action" => "process"
            ));
        }
        return $this->getResponse()->setContent(NULL);
    }

    /**
     *
     * This processes the manual premium information submitted
     *
     * @return mixed
     */
    public function manualPremiumAction()
    {
        $em = $this->entityManager;
        $offerService = $this->offerService;
        $offerId = $offerService->getOfferSession()->offerId;
        $offerEntity = $em->find("Offer\Entity\Offer", $offerId);
        $request = $this->getRequest();
        $manualPremiumForm = $this->manualPremiumForm;
        if ($request->isPost()) {
            $post = $request->getPost();
            $manualPremiumForm->setData($post);
            $manualPremiumForm->setValidationGroup(array(
                "manualPremiumFieldset" => array(
                    "premium",
                    "currency",
                    "description"
                )
            ));
            $manulPremiumEntity = new ManualPremium();
            if ($manualPremiumForm->isValid()) {
                $data = $manualPremiumForm->getData();
                $offerEntity->setIsManualPremium(True);
                
                $manulPremiumEntity->setPremium($this->currencyService->cleanInputedValue($data->getPremium()))
                    ->setCreated(new \DateTime())
                    ->setCurrency($em->find("Settings\Entity\Currency", $data->getCurrency()))
                    ->setOffer($offerEntity)
                    ->setDescription($data->getDescription());
                try {
                    $em->persist($manulPremiumEntity);
                    $em->persist($offerEntity);
                    
                    $em->flush();
                    
                    $this->flashmessenger()->addSuccessMessage("Successfully Updated manual premium value");
                    $this->redirect()->toRoute("offer/default", array(
                        "action" => "process"
                    ));
                } catch (\Exception $e) {
                    $this->flashmessenger()->addErrorMessage("we could not create the manual premium value");
                    $this->redirect()->toRoute("offer/default", array(
                        "action" => "process"
                    ));
                }
            } else {
                $this->flashmessenger()->addErrorMessage("Please enter valid information into the form");
                $this->redirect()->toRoute("offer/default", array(
                    "action" => "process"
                ));
            }
        }
        
        return $this->getResponse()->setContent(NULL);
    }

    /**
     * This action displays the the messaging form
     *
     * @return mixed
     */
    public function messageAction()
    {
        $em = $this->entityManager;
        $offerService = $this->offerService;
        $offerId = $offerService->getOfferSession()->offerId;
        $offerEntity = $em->find("Offer\Entity\Offer", $offerId);
        
        $messageForm = $this->messageForm;
        
        $standard = new WasabiModal('standard', "Send Message To Customer");
        $view = new ViewModel();
        $view->setTemplate("offer-message-snippet");
        $view->setVariables(array(
            "messageForm" => $messageForm,
            "offerEntity" => $offerEntity
        ));
        $standard->setContent($view);
        
        $modalView = new WasabiModalView("#wasabi_modal", $this->renderer, $standard);
        $response = new Response();
        $response->add($modalView);
        
        $messageEntit = $offerEntity->getMessages();
        $messageEnteredEntit = $messageEntit->getMessageEntered();
        foreach ($messageEnteredEntit as $mes) {
            $mes->setMessageStatus($em->find("Messages\Entity\MessageStatus", MessageService::MESSAGE_STATUS_READ));
        }
        try {
            $em->persist($offerEntity);
            $em->flush();
        } catch (\Exception $e) {
            $this->flashmessenger()->addErrorMessage("We could not display messages");
            $redirect = new Redirect($this->url()->fromRoute("offer/default", array(
                "action" => "process"
            )));
            $response = new Response();
            $response->add($redirect);
            
            return $this->getResponse()->setContent($response);
        }
        return $this->getResponse()->setContent($response);
    }

    /**
     * This displays a modal form that a service specific formis provided in a modal view
     * This form is dependent on the specific service selected
     */
    public function serviceSpecificAction()
    {
        $em = $this->entityManager;
        
        $viewModel = new ViewModel(array());
        
        $modal = new WasabiModal("standard", "Cover Specific Details");
        $modal->setContent($viewModel);
        
        $modalView = new WasabiModalView("#wasabi_modal", $this->renderer, $modal);
        
        $response = new Response();
        $response->add($modalView);
        return $this->getResponse()->setContent($modalView);
    }

    /**
     * This function shows an overview of the offer
     * Upon which a satisfied bbutton would be maked avaialble
     * if the satisfied button is clicked ,
     * An invoice is automatically generated for the subjesct
     * and the content is ready for payment
     */
    public function previewdetailsAction()
    {
        $em = $this->entityManager;
        $offerService = $this->offerService;
        $offerId = $offerService->getOfferSession()->offerId;
        $offerEntity = $em->find("Offer\Entity\Offer", $offerId);
        
        $viewModel = new ViewModel(array(
            "offerEntity" => $offerEntity
        ));
        $viewModel->setTemplate("offer-preview-details-snippet");
        $modal = new WasabiModal("standard", "Offer Preview");
        $modal->setContent($viewModel);
        
        $modalView = new WasabiModalView("#wasabi_modal", $this->renderer, $modal);
        
        $response = new Response();
        $response->add($modalView);
        return $this->getResponse()->setContent($response);
    }

    public function uploaddropzoneAction()
    {
        
        // $this->redirect()->toRoute("dashboard");
        $offerService = $this->offerService;
        $offerId = $offerService->getOfferSession()->offerId;
        $em = $this->entityManager;
        $blobService = $this->blobService;
        // $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $this->centralBrokerId);
        $request = $this->getRequest();
        if ($request->isPost() || $request->isXmlHttpRequest()) {
            $files = $this->params()->fromFiles('file');
            // $res = $this->blobService->uploadBlob($files);
            $res = $this->blobService->uploadBlob($files);
            // $this->redirect()->toRoute("home");
            if ($res != False) {
                $offerEntity = $em->find("Offer\Entity\Offer", $offerId);
                $offerEntity->addIdDoc($em->find("GeneralServicer\Entity\Document", $res))
                    ->setUpdatedOn(new \DateTime());
                $em->persist($offerEntity);
                $em->flush();
            }
        }
        return $this->getResponse()->setContent(NULL);
    }

    public function removedocAction()
    {
        $em = $this->entityManager;
        
        $docId = $this->params()->fromRoute("id", NULL);
        if ($docId == NULL) {
            $this->flashmessenger()->addErrorMessage("No identifier to resolve");
            $this->redirect()->toRoute("offer/default", array(
                "action" => "process"
            ));
        }
        $offerService = $this->offerService;
        $offerId = $offerService->getOfferSession()->offerId;
        $em = $this->entityManager;
        $offerEntity = $em->find("Offer\Entity\Offer", $offerId);
        $offerEntity->removeIdDoc($em->find("GeneralServicer\Entity\Document", $docId))
            ->setUpdatedOn(new \DateTime());
        try {
            $em->persist($offerEntity);
            $em->flush();
            
            $this->flashmessenger()->addSuccessMessage("Successfully removed the Document");
            $this->redirect()->toRoute("offer/default", array(
                "action" => "process"
            ));
        } catch (\Exception $e) {
            
            $this->flashmessenger()->addErrorMessage("There was a problem removing this document");
            $this->redirect()->toRoute("offer/default", array(
                "action" => "process"
            ));
        }
        
        return $this->getResponse()->setContent(NULL);
    }

    public function processAction()
    {
        // var_dump($this->invoiceService->generateMicroPayment(2, 3000));
        $em = $this->entityManager;
        $offerService = $this->offerService;
        $offerForm = $this->offerForm;
        $objectForm = $this->objectForm;
        $coverNoteForm = $this->coverNoteForm;
        $selectObjectForm = $this->selectObjectForm;
        $centralBrokerId = $this->centralBrokerId;
        $recommendForm = $this->recommendForm;
        $messageForm = $this->messageForm;
        $manualPremiumForm = $this->manualPremiumForm;
        $microPaymentForm = $this->microPaymentForm;
        $dropZoneForm = $this->dropZoneForm;
        $manualPremiumForm->setAttributes(array(
            "method" => "POST",
            "action" => $this->url()
                ->fromRoute("offer/default", array(
                "action" => "manual-premium"
            ))
        ));
        $microPaymentForm->setAttributes(array(
            "method" => "POST",
            "action" => $this->url()
                ->fromRoute("invoice/default", array(
                "action" => "micro-payment"
            ))
        ));
        $messageForm->setAttributes(array(
            "method" => "POST",
            "action" => $this->url()
                ->fromRoute("offer/default", array(
                "action" => "send-message"
            ))
        ));
        $dropZoneForm->setAttributes(array(
            "action" => $this->url()
                ->fromRoute("offer/default", array(
                "action" => "uploaddropzone"
            ))
        ));
        $broker = $em->find("Users\Entity\InsuranceBrokerRegistered", $centralBrokerId);
        $objectSelectContainer = new Container("selectObject");
        $offerId = $offerService->getOfferSession()->offerId;
        if ($offerId == NULL) {
            $this->flashmessenger()->addErrorMessage("The system cannot find an identifier for this offer");
            $this->redirect()->toRoute("offer");
        }
        $offerEntity = $em->find("Offer\Entity\Offer", $offerId);
        // var_dump($offerEntity->getMessages());
        // echo $offerEntity->getMessages()->getId();
        $unreadMessages = NULL;
        $unreadMessages = $em->getRepository("Messages\Entity\Messages")->findOfferUnreadMessages($offerEntity->getMessages());
        $offerForm->bind($offerEntity);
        // set the customer for the object selector
        $this->generalService->getGeneralSession()->currentCustomerid = $offerEntity->getCustomer()->getId();
        $objectSelectContainer->customerId = $offerEntity->getCustomer()->getId();
        $objectSelectContainer->objectType = NULL;
        
        $request = $this->getRequest();
        // var_dump(count($this->invoiceService->generateMicroPayment(4, 2000)));
        $res = $this->invoiceService->generateMicroPayment(12, 54980);
        
        if ($request->isPost()) {
            $post = $request->getPost();
            // var_dump($post);
            $offerForm->setData($post);
            $offerForm->setValidationGroup(array(
                'csrf',
                "offerFieldset" => array(
                    // "offerName",
                    "value",
                    "offerServiceType",
                    "valueType",
                    // "idPreferdInsurer",
                    // "offerStatuses",
                    "coverDuration",
                    "termedDuration",
                    "offerSpecificService"
                )
            ));
            // var_dump($post);
            if ($offerForm->isValid()) {
                $data = $offerForm->getData();
                // var_dump($post);
                
                $offerEntity->setUpdatedOn(new \DateTime())
                    ->setOfferName($data->getOfferName())
                    ->setOfferServiceType($em->find("Settings\Entity\InsuranceServiceType", $data->getOfferServiceType()))
                    ->setValue(\floatval(\str_replace(',', '', $data->getValue())))
                    ->setValueType($data->getValueType())
                    ->setIdPreferdInsurer($em->find("Settings\Entity\Insurer", $data->getIdPreferdInsurer()))
                    ->setOfferStatuses($em->find("Offer\Entity\OfferStatus", OfferService::OFFER_STATUS_PROCESSING))
                    ->setOfferSpecificService($em->find("Settings\Entity\InsuranceSpecificService", $data->getOfferSpecificService()));
                
                try {
                    $em->persist($offerEntity);
                    $em->flush();
                    $this->flashmessenger()->addSuccessMessage("The offer information was successfully updated");
                    $this->redirect()->toRoute("offer/default", array(
                        "action" => "process"
                    ));
                } catch (\Exception $e) {
                    $this->flashmessenger()->addErrorMessage("There was a problem updating the OfferInformation");
                    $this->redirect()->toRoute("offer/default", array(
                        "action" => "process"
                    ));
                }
            }
            // else {
            // $this->flashmessenger()->addErrorMessage("Validation Error");
            // $this->redirect()->toRoute("offer/default", array(
            // "action" => "process"
            // ));
            // }
        }
        
        $view = new ViewModel(array(
            "offerEntity" => $offerEntity,
            "offerForm" => $offerForm,
            "objectForm" => $objectForm,
            "broker" => $broker,
            "coverNoteForm" => $coverNoteForm,
            "messageForm" => $messageForm,
            "selectObjectForm" => $selectObjectForm,
            "recommendForm" => $recommendForm,
            "microPaymentForm" => $microPaymentForm,
            "manualPremiumForm" => $manualPremiumForm,
            "dropZoneForm" => $dropZoneForm,
            "unread" => $unreadMessages
        ));
        return $view;
    }

    public function completeofferAction()
    {
        $em = $this->entityManager;
        $offerService = $this->offerService;
        $offerId = $offerService->getOfferSession()->offerId;
        $request = $this->getRequest();
        
        $offerEntity = $em->find("Offer\Entity\Offer", $offerId);
        $offerForm = $this->offerForm;
        $offerForm->setAttributes(array(
            "data-ajax-loader" => "myLoader",
            "class" => "ajax_element form-horizontal form-label-left",
            "id" => "simpleForm",
            "action" => $this->url()
                ->fromRoute("offer/default", array(
                "action" => "completeoffer"
            ))
        ));
        $offerForm->bind($offerEntity);
        
        if ($offerId == NULL) {
            $this->flashmessenger()->addErrorMessage("The system cannot find an identifier for this offer");
            $this->redirect()->toRoute("offer");
        }
        if ($request->isPost()) {
            $post = $this->params()->fromPost();
            $postn = array(
                "offerFieldset" => $post
            );
            $offerForm->setData($postn);
            $offerForm->setValidationGroup(array(
                // 'csrf',
                "offerFieldset" => array(
                    // "offerName",
                    "value",
                    "offerServiceType",
                    "valueType",
                    // "idPreferdInsurer",
                    // "offerStatuses",
                    "coverDuration",
                    // "termedDuration",
                    "offerSpecificService"
                )
            ));
            
            if ($offerForm->isValid()) {
                $data = $offerForm->getData();
                // var_dump($post);
                
                $offerEntity->setUpdatedOn(new \DateTime())
                    ->setOfferName($data->getOfferName())
                    ->setOfferServiceType($em->find("Settings\Entity\InsuranceServiceType", $data->getOfferServiceType()))
                    ->setValue($data->getValue())
                    ->setValueType($data->getValueType())
                    ->setIdPreferdInsurer($em->find("Settings\Entity\Insurer", $data->getIdPreferdInsurer()))
                    ->setOfferStatuses($em->find("Offer\Entity\OfferStatus", OfferService::OFFER_STATUS_PROCESSING))
                    ->setOfferSpecificService($em->find("Settings\Entity\InsuranceSpecificService", $data->getOfferSpecificService()));
                
                try {
                    $em->persist($offerEntity);
                    $em->flush();
                    $this->flashmessenger()->addSuccessMessage("The offer information was successfully updated");
                    $redirect = new Redirect($this->url()->fromRoute("offer/default", array(
                        "action" => "process"
                    )));
                    $response = new Response();
                    $response->add($redirect);
                    return $this->getResponse()->setContent($response);
                } catch (\Exception $e) {
                    $this->flashmessenger()->addErrorMessage("There was a problem updating the OfferInformation");
                    $redirect = new Redirect($this->url()->fromRoute("offer/default", array(
                        "action" => "process"
                    )));
                    $response = new Response();
                    $response->add($redirect);
                    return $this->getResponse()->setContent($response);
                }
            }
        }
        $viewModel = new ViewModel(array(
            "offerForm" => $offerForm
        ));
        $viewModel->setTemplate("offer-form-modal-process-snippet");
        
        $modal = new WasabiModal("standard", "Complete Offer Information");
        $modal->setContent($viewModel);
        
        $modalView = new WasabiModalView("#wasabi_modal", $this->renderer, $modal);
        
        $response = new Response();
        $response->add($modalView);
        return $this->getResponse()->setContent($response);
    }

    public function messagingAction()
    {
        $em = $this->entityManager;
        $offerService = $this->offerService;
        $offerId = $offerService->getOfferSession()->offerId;
        $offerEntity = $em->find("Offer\Entity\Offer", $offerId);
        
        $messageForm = $this->messageForm;
        $messageForm->setAttributes(array(
            "data-ajax-loader" => "myLoader",
            "class" => "ajax_element",
            "action" => "sendMessage"
        ));
        $view = new ViewModel(array(
            "messageForm" => $messageForm,
            "offerEntity" => $offerEntity
        ));
        
        $view->setTemplate("offer-message-snippet");
        $modal = new WasabiModal("Standard", "Messaging Platform");
        
        $modal->setContent($view);
        
        $modalView = new WasabiModalView("#wasabi_modal_view", $this->renderer, $modal);
        
        $response = new Response();
        $response->add($modalView);
        return $this->getResponse()->setContent($response);
    }

    public function selectObjectProcessAction()
    {
        $em = $this->entityManager;
        
        $objectService = $this->objectService;
        $request = $this->getRequest();
        $offerService = $this->offerService;
        $offerId = $offerService->getOfferSession()->offerId;
        $offerEntity = $em->find("Offer\Entity\Offer", $offerId);
        if ($request->isPost()) {
            $post = $request->getPost();
            if (count($post["selectObjectfield"]['object']) > 0) {
                foreach ($post["selectObjectfield"]['object'] as $obj) {
                    
                    $objectEntity = $em->find("Object\Entity\Object", $obj);
                    $offerEntity->addObject($objectEntity);
                }
            }
            
            try {
                $em->persist($offerEntity);
                $em->flush();
                
                $this->flashmessenger()->addSuccessMessage("Property successfully included");
                $this->redirect()->toRoute("offer/default", array(
                    "action" => "process"
                ));
            } catch (\Exception $e) {
                $this->flashmessenger()->addErrorMessage("The property could not be included");
                $this->redirect()->toRoute("offer/default", array(
                    "action" => "process"
                ));
            }
        }
        return $this->getResponse()->setContent(NULL);
    }

    public function sendMessageAction()
    {
        $em = $this->entityManager;
        $response = NULL;
        $offerService = $this->offerService;
        $messageService = $this->messageService;
        $offerId = $offerService->getOfferSession()->offerId;
        $offerEntity = $em->find("Offer\Entity\Offer", $offerId);
        $messageEntity = "";
        if ($offerEntity->getMessages() == NULL) {
            $messageEntity = new Messages();
        } else {
            $messageEntity = $offerEntity->getMessages();
        }
        $request = $this->getRequest();
        // $messageEntity = new Messages();
        if ($request->isPost() || $request->isXmlHttpRequest()) {
            $post = $request->getPost();
            $messageEntered = new MessageEntered();
            $messageEntity->setCreatedOn(new \DateTime())
                ->setMessageCategory($em->find("Settings\Entity\CoverCategory", CoverNoteService::COVERNOTE_CATEGORY_OFFER))
                ->setOffer($offerEntity)
                ->setMessageUid($messageService->messageUid())
                ->addMessageEntered($messageEntered);
            
            $postMessageEntered = $post['messageEntered']['messageText'];
            
            $messageEntered->setCreatedOn(new \DateTime())
                ->setBrokerFunction($em->find("Messages\Entity\MessageFunction", MessageService::MESSAGES_FUNCTION_SENDER))
                ->setCustomerFunction($em->find("Messages\Entity\MessageFunction", MessageService::MESSAGE_FUNCTION_RECEIVER))
                ->setMessageStatus($em->find("Messages\Entity\MessageStatus", MessageService::MESSAGE_STATUS_UNREAD))
                ->setMessageText($postMessageEntered)
                ->setMessages($messageEntity);
            
            // var_dump("Hello");
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
                // $css = new DomManipulator("#message", "background-color", "#83B719");
                $response = new Response();
                $response->add($inner);
            }
        }
        
        return $this->getResponse()->setContent($response);
    }

    public function objectFormProcessAction()
    {
        $em = $this->entityManager;
        $offerService = $this->offerService;
        $objectService = $this->objectService;
        $request = $this->getRequest();
        $offerId = $offerService->getOfferSession()->offerId;
        
        $offerEntity = $em->find("Offer\Entity\Offer", $offerId);
        
        $objectEntity = new Object();
        $objectForm = $this->objectForm;
        $objectForm->bind($objectEntity);
        if ($request->isPost()) {
            $post = $request->getPost();
            $strippedValue = str_replace(',', '', $post["value"]);
            
            $objectEntity->setCreatedOn(new \DateTime())
                ->setCustomer($em->find("Customer\Entity\Customer", $offerEntity->getCustomer()
                ->getId()))
                ->setCurrency($em->find("Settings\Entity\Currency", $post['currency']))
                ->setValue($strippedValue)
                ->setObjectName($post["objectName"])
                ->setIsHidden(FALSE)
                ->setObjectStatus($em->find("Object\Entity\ObjectStatus", ObjectService::OBJECT_STATUS_PROCESSING))
                ->setObjectType($em->find("Settings\Entity\ObjectType", $post["objectType"]))
                ->setObjectUid($objectService->generateObjectUid())
                ->setValueLocked(FALSE);
            //
            
            $offerEntity->addObject($objectEntity);
            $offerEntity->setUpdatedOn(new \DateTime());
            
            try {
                $em->persist($objectEntity);
                
                $em->persist($offerEntity);
                $em->flush();
                
                $this->flashmessenger()->addSuccessMessage("The property was successfully created");
                $this->redirect()->toRoute("offer/default", array(
                    "action" => "process"
                ));
            } catch (\Exception $e) {
                $this->flashmessenger()->addError("There was an Error creating this Property");
                $this->redirect()->toRoute("offer\default", array(
                    "action" => "process"
                ));
            }
        }
        return $this->getResponse()->setContent(NULL);
    }

    public function addObjectAction()
    {
        return $this->getResponse()->setContent(NULL);
    }

    public function removeObjectAction()
    {
        $em = $this->entityManager;
        $offerService = $this->offerService;
        // $objectService = $this->objectService;
        $objectId = $this->params()->fromRoute("id", NULL);
        $offerId = $offerService->getOfferSession()->offerId;
        $objectEntity = $em->find("Object\Entity\Object", $objectId);
        $offerEntity = $em->find("Offer\Entity\Offer", $offerId);
        $offerEntity->setUpdatedOn(new \DateTime());
        $offerEntity->removeObject($objectEntity);
        
        try {
            $em->persist($offerEntity);
            $em->flush();
            $this->flashmessenger()->addSuccessMessage("The Property was successfully removed");
            $this->redirect()->toRoute("offer/default", array(
                "action" => "process"
            ));
        } catch (\Exception $e) {
            $this->flashmessenger()->addErrorMessage("There was an error while removing the property");
            $this->redirect()->toRoute("offer/default", array(
                "action" => "process"
            ));
        }
        
        return $this->getResponse()->setContent(NULL);
    }

    public function invoiceGenerateAction()
    {
        $em = $this->entityManager;
        $offerService = $this->offerService;
        $invoiceService = $this->invoiceService;
        
        $offerId = $offerService->getOfferSession()->offerId;
        
        $offerEntity = $em->find("Offer\Entity\Offer", $offerId);
        // var_dump($offerEntity->getInvoice());
        if ($offerEntity->getInvoice() == NULL) {
            $invoiceEntity = new Invoice();
        } else {
            $invoiceEntity = $offerEntity->getInvoice();
        }
        $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $this->centralBrokerId);
        // var_dump("HI");
        
        $premiumSession = new Container("offer_premium");
        
        $invoiceEntity->setAmount($premiumSession->premium)
            ->setCustomer($em->find("Customer\Entity\Customer", $offerEntity->getCustomer()
            ->getId()))
            ->setGeneratedOn(new \DateTime())
            ->setExpiryDate(new \DateTime())
            ->setInvoiceCategory($em->find("Transactions\Entity\InvoiceCategory", InvoiceService::INVOICE_CAT_OFFER))
            ->setInvoiceUid($invoiceService->generateInvoiceNumber())
            ->setStatus($em->find("Transactions\Entity\InvoiceStatus", InvoiceService::INVOICE_UNPAID_STATUS))
            ->setCurrency($em->find("Settings\Entity\Currency", $premiumSession->premiumCurrency))
            ->setIsOpen(TRUE)
            ->setOffer($offerEntity);
        // var_dump("LOW");
        try {
            
            $messagePointer['to'] = $offerEntity->getCustomer()
                ->getUser()
                ->getEmail();
            $messagePointer['fromName'] = $brokerEntity->getCompanyName();
            $messagePointer['subject'] = "Invoice Generated";
            
            $template["template"] = ""; // TODO generate a template for this
            $template['var'] = array(
                "logo" => $this->generalService->getBrokerLogo(),
                "brokerName" => $brokerEntity->getCompanyName()
            );
            // $this->generalService->sendMails($messagePointer, $template);
            $em->persist($invoiceEntity);
            
            $em->flush();
            $this->flashmessenger()->addSuccessMessage("Invoice Successfully Generated");
            $this->redirect()->toRoute("offer/default", array(
                "action" => "process"
            ));
        } catch (\Exception $e) {
            $this->flashmessenger()->addErrorMessage("The invoice could not be generated ");
            $this->redirect()->toRoute("offer/default", array(
                "action" => "process"
            ));
        }
        
        return $this->getResponse()->setContent(NULL);
    }

    public function generateCoverNoteAction()
    {
        $em = $this->entityManager;
        $coverNoteService = $this->coverNoteService;
        $coverNoteSession = $coverNoteService->getCoverNoteSession();
        $offerService = $this->offerService;
        $offerId = $offerService->getOfferSession()->offerId;
        $offerEntity = $em->find("Offer\Entity\Offer", $offerId);
        $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $this->centralBrokerId);
        if ($offerEntity->getCoverNote() == NULL) {
            $coverNoteEntity = new CoverNote();
            $coverNoteEntity->setDateCreated(new \DateTime());
        } else {
            $coverNoteEntity = $offerEntity->getCoverNote();
        }
        
        $offerEntity->setIsPolicized(TRUE)->setUpdatedOn(new \DateTime());
        
        if ($offerEntity->getIsRecommendedInsurer() == TRUE) {
            $coverNoteEntity->setInsurer($offerEntity->getRecommendedInsurer());
        } else {
            $coverNoteEntity->setInsurer($offerEntity->getIdPreferdInsurer());
        }
        $dueDate = new \DateTime();
        $addMonths = 'P1M'; // sets the string for the date interval
        $interval = new \DateInterval($addMonths); // sets the actual interval
        $dueDate->add($interval);
        
        $coverNoteEntity->setCoverUid($this->coverNoteService->coverNoteUid())
            ->setCustomer($offerEntity->getCustomer())
            ->setBroker($em->find("Users\Entity\InsuranceBrokerRegistered", $this->centralBrokerId))
            ->setIsHidden(false)
            ->setCoverStatus($em->find("Policy\Entity\CoverNoteStatus", CoverNoteService::COVERNOTE_STATUS_PROCESSING_POLICY))
            ->setCoverCategory($em->find("Settings\Entity\CoverCategory", CoverNoteService::COVERNOTE_CATEGORY_OFFER))
            ->setOffer($offerEntity)
            ->setIsPolicy(FALSE)
            ->setDueDate($dueDate);
        
        try {
            
            $messagePointer['to'] = $offerEntity->getCustomer()
                ->getUser()
                ->getEmail();
            $messagePointer['fromName'] = $brokerEntity->getCompanyName();
            $messagePointer['subject'] = "Invoice Generated";
            
            $template["template"] = ""; // TODO generate a template for this
            $template['var'] = array(
                "logo" => $this->generalService->getBrokerLogo(),
                "brokerName" => $brokerEntity->getCompanyName()
            );
            $this->generalService->sendMails($messagePointer, $template);
            $em->persist($offerEntity);
            $em->persist($coverNoteEntity);
            $em->flush();
            /**
             * Send Email Notification with a link
             */
            $coverNoteSession->getCoverNoteId = $coverNoteEntity->getId();
            $this->flashmessenger()->addSuccessMessage("Cover Note was successfuly Generated and the customer has beeen Notified");
            $this->redirect()->toRoute("cover-note/default", array(
                "action" => "view"
            ));
        } catch (\Exception $e) {
            $this->flashmessenger()->addSuccessMessage("There was a problem generating the coverNote");
            $this->redirect()->toRoute("offer/default", array(
                "action" => "process"
            ));
        }
        
        return $this->getResponse()->setContent(NULL);
    }

    public function preViewAction()
    {
        $em = $this->entityManager;
        $offerService = $this->offerService;
        $offerSession = $this->offerSession;
        $id = $this->params()->fromRoute("id", NULL);
        $offerSession->offerId = $id;
        $this->redirect()->toRoute("offer/default", array(
            "action" => "process"
        ));
        $this->getResponse()->setContent(NULL);
    }

    public function continueAction()
    {
        $em = $this->entityManager;
        $offerService = $this->offerService;
        $offerSession = $this->offerSession;
        $id = $this->params()->fromRoute("id", NULL);
        
        if ($id == NULL) {
            $this->flashmessenger()->addErrorMessage("An identity does not exist for this oofer");
            $this->redirect()->toRoute("offer");
        }
        $this->noAuthorization($id);
        $offerEntity = $em->find("Offer\Entity\Offer", $id);
        
        $offerEntity->setUpdatedOn(new \DateTime())
            ->setIsPolicized(FALSE)
            ->setIsHidden(FALSE);
        
        try {
            
            $em->persist($offerEntity);
            $em->flush();
            $offerSession->offerId = $id;
            $this->redirect()->toRoute("offer/default", array(
                "action" => "process"
            ));
        } catch (\Exception $e) {
            $this->flashmessenger()->addErrorMessage("The selected offer could not be pre-processed");
            $this->redirect()->toRoute("offer");
        }
        return $this->getResponse()->setContent(NULL);
    }

    public function sendOfferInvoiceAction()
    {
        $em = $this->entityManager;
        $mailService = $this->mailService;
        $offerSession = $this->offerSession;
        $offerId = $offerSession->offerId;
        $offerEntity = $em->find("Offer\Entity\Offer", $offerId);
        $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $this->centralBrokerId);
        // create a template for sending mails tto the customer of the
        // $mailService->setTemplate("", $data);
        return $this->getResponse()->setContent(NULL);
    }

    public function viewAllAction()
    {
        $this->redirectPlugin()->redirectToLogout();
        
        $offerService = $this->offerService;
        $activeOffer = $offerService->getActiveOffer();
        $view = new ViewModel(array(
            'offers' => $activeOffer
        ));
        return $view;
    }

    public function viewOfferAction()
    {
        // $this->redirectPlugin()->redirectToLogout();
        $em = $this->entityManager;
        $id = $this->params()->fromRoute('id', NULL); // this gets the identity for the offer
        $entity = "Offer\Entity\Offer";
        $this->redirectPlugin()->idStatusRedirection($id, $entity);
        
        $offerInfo = $em->find($entity, $id);
        // $userInfo = $this->identity();
        $id = \urldecode($id);
        $user = $this->identity();
        $userInfo = $this->usersService->getUserInfo();
        
        $policyInfo = NULL;
        
        $view = new ViewModel(array(
            'offerInfo' => $offerInfo,
            
            'userInfo' => $userInfo
        ));
        
        return $view;
    }

    public function editAction()
    {
        /**
         * This is used to edit the
         *
         * @var unknown
         */
        $this->redirectPlugin()->redirectToLogout();
        $id = $this->params()->fromRoute('sess', NULL);
        $em = $this->entityManager;
        if ($id == NULL) {
            $this->redirect()->toRoute('offer/default', array(
                'action' => 'view-all'
            ));
        }
        $id = \strip_tags($id);
        $offerInfoForm = NULL;
        $offerPremiumForm = NULL;
        $offerObjetForm = NULL;
        $OfferInfo = $em->find('Offer\Entity\Offer', $id);
        // $offerInfoForm->bind($OfferInfo);
        $userInfo = $this->identity();
        
        $view = new ViewModel(array(
            'offerInfo' => $OfferInfo,
            'userInfo' => $userInfo
        ));
        
        return $view;
    }

    public function offerInformationAction()
    {
        $this->redirectPlugin()->redirectToLogout();
        $em = $this->entityManager;
        $offerEntity = $this->offerEntity;
        $motorEntity = $this->offerMotorEntity;
        $offerInfoForm = $this->offerInfoForm;
        $offerInfoForm->bind($offerEntity);
        $controllerService = $this->offerIndexControllerService;
        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost();
            $offerInfoForm->setData($data);
            switch ($data['offerFieldset']['offerSpecificService']) {
                case '1': // comprehensive motor non-commercial
                    $this->motorValidationGroup($offerInfoForm);
                    if ($offerInfoForm->isValid()) {
                        
                        $data = $controllerService->motorPolicySubmitted($offerEntity, $motorEntity, $data);
                        $this->offerId = $data[0];
                        $this->offerUid = \strip_tags($data[1]);
                        /**
                         * Insted of making it a query
                         * put it in a session
                         */
                        echo $this->offerUid;
                        if ($this->offerUid != NULL) {
                            $this->setSession();
                            $this->setFirstStep();
                            $this->redirect()->toRoute('offer/default', array(
                                'action' => 'offer-object',
                                'sess' => $this->offerUid
                            ));
                        }
                        
                        // echo $this->session->offerId;
                    /**
                     * If flush was successful,
                     * create a session with name offerIfoForm set to true
                     * Set a session that containd offer id in it
                     * Then redirect to the next page
                     */
                    }
                    break;
                
                case '2':
                    
                    break;
            }
            
            // remove this and set validation group
            
            // $em->persist($this->offerEntity);
            // if flush was successful
        }
        $view = new ViewModel(array(
            'offerInfo' => $offerInfoForm
        ));
        return $view;
    }

    // Begin Validation group
    
    // private function
    
    // End Validation Group
    public function offerObjectAction()
    {
        /**
         * Most of the call here would be done via ajax Call
         * New Object Created would be made asynchronously
         */
        $this->redirectPlugin()->redirectToLogout();
        
        $allObjects = $this->getAllObjects();
        $em = $this->entityManager;
        $offerUid = $this->params()->fromRoute('sess');
        $this->offerUid = $offerUid;
        
        $offerObjectForm = $this->offerObjectForm;
        $request = $this->getRequest();
        
        if ($request->isXmlHttpRequest()) {}
        if ($request->isPost()) {
            
            $data = $this->getRequest()->getPost();
            \var_dump($data);
            // $data = array_merge_recursive(
            // $this->getRequest()->getPost()->toArray(),
            // $this->getRequest()->getFiles()->toArray()
            // );
        /**
         * upon loading of the form
         * Make angular Js disable the Next form
         * it would be activated once the user loads an object
         * once object is greater than one enable the next button
         * let angular js validate the create object form
         * once submit is entered,
         * upload all information into the database
         *
         * when submit is clicked
         * an ng click is attached to the submit button
         * 1. an ajax call to hydrate the database is made
         * if possible all information should be hydrate via ajax and a redirection made
         * 2.an action call to hydrate the database is made
         * uppon successful uploading of the information,
         * redirect to the premium page with the offerUid
         * Automatically generate an Invoice Number for this offer
         */
        }
        // $this->confirmOfferStarted();
        $view = new ViewModel(array(
            'offerObjectForm' => $offerObjectForm,
            'allObjects' => $allObjects
        ));
        return $view;
    }

    // private function makeCheckBoxes($form, $objects)
    // {
    // foreach ($objects as $object) {
    
    // // $element->setValue($object->getId());
    // $element->setAttributes(array(
    // 'class' => 'flat'
    // ));
    // $form->add($element);
    // }
    // return $form;
    // }
    public function offerPremiumAction()
    {
        /**
         * At this point payments are made
         * isPolicy status are chanded
         * policy data are entered
         * that is the auto generated policy number is entered into the database
         * and the next button is enabled
         * Upon Successful Payment
         */
        $this->redirectPlugin()->redirectToLogout();
        
        $selectedObject = array();
        $offerPremiumForm = $this->offerPremiumForm;
        $invoiceData = NULL; // This get the invoce Data for this offer
        $userInfo = NULL; // This gets the userInfoemation including address and all
        $offerInfo = NULL;
        $payment = NULL;
        $policy = NULL; // Gets the Policy Status number and all
        if ($this->getRequest()->isPost()) {}
        $view = new ViewModel(array(
            'offerPremiumForm' => $offerPremiumForm,
            'invoiceData' => $invoiceData,
            'userInfo' => $userInfo,
            'offerInfo' => $offerInfo,
            'payment' => $payment,
            'policy' => $policy
        ));
        return $view;
    }

    public function offerSummaryAction()
    {
        /**
         * first checks if the user has paid
         * if so Provide a check out form
         * If not Povide a payment form
         * The offer is available for processing by administrator
         * It no longer becomes an active Offer
         */
        $this->redirectPlugin()->redirectToLogout();
        $offerSummary = $this->offerSummary;
        $view = new ViewModel(array(
            'offerSummary' => $offerSummary
        ));
        return $view;
    }

    private function motorValidationGroup($form)
    {
        $group = array(
            'csrf',
            'offerFieldset' => array(
                'offerName',
                'idPreferdInsurer',
                'offerServiceType',
                'offerSpecificService',
                'motor_offer' => array(
                    'typeOfVehicle',
                    // 'purposeOfUse',
                    'vehicleValueType'
                )
            )
        );
        return $form->setValidationGroup($group);
    }

    // Begin Set Factory data
    public function setOptions($op)
    {
        $this->options = $op;
        return $this;
    }

    public function setOfferForm($offerForm)
    {
        $this->offerForm = $offerForm;
        return $this;
    }

    public function setOfferService($os)
    {
        $this->offerService = $os;
        
        return $this;
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }

    public function setGeneralService($xserv)
    {
        $this->generalService = $xserv;
        return $this;
    }

    public function setOfferEntity($entity)
    {
        $this->offerEntity = $entity;
        
        return $this;
    }

    public function setOfferObjectForm($form)
    {
        $this->offerObjectForm = $form;
        
        return $this;
    }

    public function setAllObjects($object)
    {
        $this->allObjects = $object;
        
        return $this;
    }

    public function setOfferIndexControllerService($service)
    {
        $this->offerIndexControllerService = $service;
        return $this;
    }

    public function setMotorOfferEntity($entity)
    {
        $this->offerMotorEntity = $entity;
        return $this;
    }

    public function setUserService($serv)
    {
        $this->usersService = $serv;
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

    public function setOfferSession($sess)
    {
        $this->offerSession = $sess;
        return $this;
    }

    public function setObjectForm($form)
    {
        $this->objectForm = $form;
        return $this;
    }

    public function setObjectService($xserv)
    {
        $this->objectService = $xserv;
        return $this;
    }

    public function setInvoiceService($xserv)
    {
        $this->invoiceService = $xserv;
        return $this;
    }

    public function setCoverNoteForm($form)
    {
        $this->coverNoteForm = $form;
        return $this;
    }

    public function setCoverNoteService($xserv)
    {
        $this->coverNoteService = $xserv;
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

    public function setSelectObjectForm($form)
    {
        $this->selectObjectForm = $form;
        return $this;
    }

    public function setRecommnedForm($form)
    {
        $this->recommendForm = $form;
        return $this;
    }

    public function setMicroPaymentForm($form)
    {
        $this->microPaymentForm = $form;
        return $this;
    }

    public function setManualPremiumForm($form)
    {
        $this->manualPremiumForm = $form;
        return $this;
    }

    public function setCurrencyService($xserv)
    {
        $this->currencyService = $xserv;
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
    
    // End Set Factory data
}

