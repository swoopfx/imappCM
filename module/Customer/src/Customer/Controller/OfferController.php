<?php
namespace Customer\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Offer\Entity\Offer;
use Zend\Session\Container;
use Offer\Service\OfferService;
use Object\Entity\Object;
use Object\Service\ObjectService;
use Messages\Entity\Messages;
use Messages\Entity\MessageEntered;
use Policy\Service\CoverNoteService;
use Messages\Service\MessageService;
use WasabiLib\Modal\WasabiModal;
use WasabiLib\Ajax\Response;
use WasabiLib\Modal\WasabiModalView;
use WasabiLib\Ajax\Redirect;

class OfferController extends AbstractActionController
{

    private $entityManager;

    private $customerBoardService;

    private $offerForm;

    private $offerService;

    private $clientGeneralService;

    private $objectForm;

    private $objectServie;

    private $messageForm;

    private $messageService;

    private $generalSession;

    private $selectObjectForm;

    private $renderer;

    public function onDispatch(\Zend\Mvc\MvcEvent $e)
    {
        $response = parent::onDispatch($e);
        $this->customerRedirectPlugin()->totalRedirection();
        $this->layout()->setTemplate('client-layout-board');
        return $response;
    }

    public function indexAction()
    {
        $view = new ViewModel();
        return $view;
    }

    /**
     * Accepts reccemended Insurer
     */
    public function acceptInsurerAction()
    {
        $em = $this->entityManager;
        $customerOfferSession = new Container("customer_offer_session");
        $id = $customerOfferSession->offerId;
        $offerEntity = $em->find("Offer\Entity\Offer", $id);
        $offerEntity->setIsRecommendedInsurer(TRUE)->setUpdatedOn(new \DateTime());
        try {
            $em->persist($offerEntity);
            $em->flush();
            
            $this->flashmessenger()->addSuccessMessage("You have accepted the recommended Insurer");
            $this->redirect()->toRoute("cus_offer/default", array(
                "action" => "now"
            ));
        } catch (\Exception $e) {
            $this->flashmessenger()->addErrorMessage("We coiuld not process this request at this moment");
            $this->redirect()->toRoute("cus_offer/default", array(
                "action" => "now"
            ));
        }
        $request = $this->getRequest();
        if ($request->isPost()) {}
        return $this->getRequest()->setContent(NULL);
    }

    public function rejectInsurerAction()
    {
        $em = $this->entityManager;
        $customerOfferSession = new Container("customer_offer_session");
        $id = $customerOfferSession->offerId;
        $offerEntity = $em->find("Offer\Entity\Offer", $id);
        $offerEntity->setIsRecommendedInsurer(FALSE)->setUpdatedOn(new \DateTime());
        try {
            $em->persist($offerEntity);
            $em->flush();
            
            $this->flashmessenger()->addSuccessMessage("You have accepted the recommended Insurer");
            $this->redirect()->toRoute("cus_offer/default", array(
                "action" => "now"
            ));
        } catch (\Exception $e) {
            $this->flashmessenger()->addErrorMessage("We coiuld not process this request at this moment");
            $this->redirect()->toRoute("cus_offer/default", array(
                "action" => "now"
            ));
        }
        $request = $this->getRequest();
        if ($request->isPost()) {}
        return $this->getRequest()->setContent(NULL);
    }

    public function prenewAction()
    {
        /**
         * The unsaved status is equivalent to UNsubmited in the database
         *
         * @var unknown $em
         */
        $em = $this->entityManager;
        $offerService = $this->offerService;
        $customerOfferSession = new Container("customer_offer_session");
        $offerCode = $offerService->generateOfferCode();
        $offerEntity = new Offer();
        $offerEntity->setCreatedOn(new \DateTime())
            ->setOfferCode($offerCode)
            ->setIsPolicized(FALSE)
            ->setCustomer($em->find("Customer\Entity\Customer", $this->clientGeneralService->getCustomerId()))
            ->setIsRenewable(TRUE)
            ->setIsHidden(FALSE)
            ->setOfferStatuses($em->find("Offer\Entity\OfferStatus", OfferService::OFFER_STATUS_UNSAVED));
        
        try {
            $em->persist($offerEntity);
            $em->flush();
            $customerOfferSession->offerId = $offerEntity->getId();
            $this->redirect()->toRoute("cus_offer/default", array(
                "action" => "now"
            
            ));
        } catch (\Exception $e) {
            $this->flashmessenger()->addErrorMessage("There was an error creating the offer ");
            $this->redirect()->toRoute("cus_offer");
        }
        return $this->getResponse()->setContent(NULL);
    }

    // Begin modal funstions
    
    /**
     * This action selects a property / object
     * 
     * @return mixed
     */
    public function selectobjectAction()
    {
        $em = $this->entityManager;
        $selectObjectForm = $this->selectObjectForm;
        
        // $objectService = $this->objectService;
        $request = $this->getRequest();
        // $offerService = $this->offerService;
        // $offerId = $offerService->getOfferSession()->offerId;
        $customerOfferSession = new Container("customer_offer_session");
        $offerId = $customerOfferSession->offerId;
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
               $redirect = new Redirect($this->url()->fromRoute("cus_offer/default", array("action"=>"now")));
               $response = new Response();
               $response->add($redirect);
               return $this->getResponse()->setContent($response);
            } catch (\Exception $e) {
                $this->flashmessenger()->addErrorMessage("The property could not be included");
                $redirect = new Redirect($this->url()->fromRoute("cus_offer/default", array("action"=>"now")));
                $response = new Response();
                $response->add($redirect);
                return $this->getResponse()->setContent($response);
            }
        }
        
        $selectObjectForm->setAttributes(array(
            "id" => "simpleForm",
            "class" => "form-horizontal form-label-left ajax_element",
            "data-ajax-loader" => "myLoader",
            "action" => $this->url()
                ->fromRoute("cus_offer/default", array(
                "action" => "selectobject"
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
        $modal = new WasabiModal("standard", "Select A Property");
        $modal->setContent($viewModel);
        
        $modalView = new WasabiModalView("#wasabi", $this->renderer, $modal);
        
        $response = new Response();
        $response->add($modalView);
        
        return $this->getResponse()->setContent($response);
    }

    public function completeofferAction()
    {
        $em = $this->entityManager;
        $request = $this->getRequest();
        $offerForm = $this->offerForm;
        $customerOfferSession = new Container("customer_offer_session");
        
        $offerForm->setAttributes(array(
            "id" => "simpleForm",
            "class" => "form-horizontal form-label-left ajax_element",
            "data-ajax-loader" => "myLoader",
            "action" => $this->url()
                ->fromRoute("cus_offer/default", array(
                "action" => "completeoffer"
            ))
        ));
        
        $id = $customerOfferSession->offerId;
        $offerEntity = $em->find("Offer\Entity\Offer", $id);
        // $offerEntity = new Offer();
        
        // $request = $this->getRequest();
        if ($request->isPost()) {
            $post = $this->params()->fromPost();
            // var_dump($post);
            $postn = array(
                "offerFieldset" => $post
            );
            
            $offerForm->setValidationGroup(array(
                
                "offerFieldset" => array(
                    "offerName",
                    "offerServiceType",
                    "idPreferdInsurer",
                    // "offerStatuses",
                    "offerSpecificService"
                )
            ));
            // var_dump($post);
            $offerForm->setData($postn);
            
            if ($offerForm->isValid()) {
                $data = $offerForm->getData();
                $offerEntity->setUpdatedOn(new \DateTime())
                    ->setOfferName($data->getOfferName())
                    ->setOfferServiceType($em->find("Settings\Entity\InsuranceServiceType", $data->getOfferServiceType()))
                    ->setIdPreferdInsurer($em->find("Settings\Entity\Insurer", $data->getIdPreferdInsurer()))
                    ->setOfferStatuses($em->find("Offer\Entity\OfferStatus", OfferService::OFFER_STATUS_SUBMITTED))
                    ->setOfferSpecificService($em->find("Settings\Entity\InsuranceSpecificService", $data->getOfferSpecificService()));
                try {
                    $em->persist($offerEntity);
                    $em->flush();
                    
                    $this->flashmessenger()->addSuccessMessage("The offer information was successfully updated");
                    
                    $redirect = new Redirect($this->url()->fromRoute("cus_offer/default", array(
                        "action" => "now"
                    )));
                    
                    $response = new Response();
                    $response->add($redirect);
                    return $this->getResponse()->setContent($response);
                } catch (\Exception $e) {
                    $this->flashmessenger()->addErrorMessage("There was a problem updating the offer information");
                    $this->flashmessenger()->addSuccessMessage("The offer information was successfully updated");
                    
                    $redirect = new Redirect($this->url()->fromRoute("cus_offer/default", array(
                        "action" => "now"
                    )));
                    
                    $response = new Response();
                    $response->add($redirect);
                }
            }
        }
        $offerForm->bind($offerEntity);
        $viewmodel = new ViewModel(array(
            "offerForm" => $offerForm
        ));
        $viewmodel->setTemplate("offer-form-modal-snippet");
        $modal = new WasabiModal("standard", "Complete Offer Details");
        $modal->setContent($viewmodel);
        $modalView = new WasabiModalView("#message", $this->renderer, $modal);
        
        $response = new Response();
        $response->add($modalView);
        return $this->getResponse()->setContent($response);
    }

    public function nowAction()
    {
        $em = $this->entityManager;
        $request = $this->getRequest();
        $offerForm = $this->offerForm;
        $objectForm = $this->objectForm;
        $messageForm = $this->messageForm;
        $selectObjectForm = $this->selectObjectForm;
        $messageForm->setAttributes(array(
            "action" => $this->url()
                ->fromRoute("cus_offer/default", array(
                "action" => "send-message"
            )),
            "method" => "POST"
        ));
        $customerOfferSession = new Container("customer_offer_session");
        $customerOfferSession->isFromOfferNowAction = TRUE;
        $id = $customerOfferSession->offerId;
        $offerEntity = $em->find("Offer\Entity\Offer", $id);
        $offerForm->bind($offerEntity);
        $this->generalSession->currentCustomerid = $this->clientGeneralService->getCustomerId();
        // var_dump($this->generalSession->currentCustomerid);
        $offerForm->setAttributes(array(
            "action" => $this->url()
                ->fromRoute("cus_offer/default", array(
                "action" => "now"
            ))
        ));
        if ($request->isPost()) {
            $post = $request->getPost();
            $offerForm->setValidationGroup(array(
                'csrf',
                "offerFieldset" => array(
                    "offerName",
                    "offerServiceType",
                    "idPreferdInsurer",
                    // "offerStatuses",
                    "offerSpecificService"
                )
            ));
            
            $offerForm->setData($post);
            if ($offerForm->isValid()) {
                $data = $offerForm->getData();
                $offerEntity->setUpdatedOn(new \DateTime())
                    ->setOfferName($data->getOfferName())
                    ->setOfferServiceType($em->find("Settings\Entity\InsuranceServiceType", $data->getOfferServiceType()))
                    ->setIdPreferdInsurer($em->find("Settings\Entity\Insurer", $data->getIdPreferdInsurer()))
                    ->setOfferStatuses($em->find("Offer\Entity\OfferStatus", OfferService::OFFER_STATUS_SUBMITTED))
                    ->setOfferSpecificService($em->find("Settings\Entity\InsuranceSpecificService", $data->getOfferSpecificService()));
                try {
                    $em->persist($offerEntity);
                    $em->flush();
                    
                    $this->flashmessenger()->addSuccessMessage("The offer information was successfully updated");
                    $this->redirect()->toRoute("cus_offer/default", array(
                        "action" => "now"
                    ));
                } catch (\Exception $e) {
                    $this->flashmessenger()->addErrorMessage("There was a problem updating the offer information");
                    $this->redirect()->toRoute("cus_offer/default", array(
                        "action" => "now"
                    ));
                }
            }
        }
        
        // var_dump($this->url()->fromRoute("cus_offer/default", array("action"=>"now")));
        $view = new ViewModel(array(
            "offerEntity" => $offerEntity,
            "offerForm" => $offerForm,
            "objectForm" => $objectForm,
            "messageForm" => $messageForm
        
        ));
        return $view;
    }

    public function sendmessageAction()
    {
        $em = $this->entityManager;
        $messageForm = $this->messageForm;
        $messageForm->setAttributes(array(
            "id" => "simpleForm",
            "class" => "form-horizontal form-label-left ajax_element",
            "data-ajax-loader" => "myLoader",
            "action" => $this->url()
                ->fromRoute("cus_offer/default", array(
                "action" => "send-message"
            ))
        ));
        $customerOfferSession = new Container("customer_offer_session");
        // $customerOfferSession->isFromOfferNowAction = TRUE;
        $messageService = $this->messageService;
        $id = $customerOfferSession->offerId;
        $offerEntity = $em->find("Offer\Entity\Offer", $id);
        
        $messageEntity = "";
        
        if ($offerEntity->getMessages() == NULL) {
            $messageEntity = new Messages();
        } else {
            $messageEntity = $offerEntity->getMessages();
        }
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $post = $request->getPost();
            $messageEntered = new MessageEntered();
            $messageEntity->setCreatedOn(new \DateTime())
                ->setMessageCategory($em->find("Settings\Entity\CoverCategory", CoverNoteService::COVERNOTE_CATEGORY_OFFER))
                ->setOffer($offerEntity)
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
                
                $em->flush();
                /**
                 * Send Email Notification
                 */
                
                $this->flashmessenger()->addSuccessMessage("Message was successfully Delivered");
                $redirect = new Redirect($this->url()->fromRoute("cus_offer/default", array(
                    "action" => "now"
                )));
                $response = new Response();
                $response->add($redirect);
                return $this->getResponse()->setContent($response);
            } catch (\Exception $e) {
                $this->flashmessenger()->addErrorMessage("The message could not be send now, please try again later ");
                $redirect = new Redirect($this->url()->fromRoute("cus_offer/default", array(
                    "action" => "now"
                )));
                $response = new Response();
                $response->add($redirect);
                return $this->getResponse()->setContent($response);
            }
        }
        $viewModel = new ViewModel(array(
            "messageForm" => $messageForm,
            "offerEntity" => $offerEntity
        ));
        $viewModel->setTemplate("customer-message-offer-form");
        
        $modal = new WasabiModal("standard", "Communicate with the Broker");
        $modal->setContent($viewModel);
        
        $modalView = new WasabiModalView("#message", $this->renderer, $modal);
        $response = new Response();
        $response->add($modalView);
        return $this->getResponse()->setContent($response);
    }

    public function objectFormProcessAction()
    {
        $em = $this->entityManager;
        $customerOfferSession = new Container("customer_offer_session");
        $objectForm = $this->objectForm;
        $objectService = $this->objectServie;
        $clientGeneralService = $this->clientGeneralService;
        $offerId = $customerOfferSession->offerId;
        $request = $this->getRequest();
        $objectEntity = new Object();
        
        $offerEntity = $em->find("Offer\Entity\Offer", $offerId);
        
        if ($request->isPost()) {
            $post = $request->getPost();
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
            
            $offerEntity->addObject($objectEntity);
            $offerEntity->setUpdatedOn(new \DateTime());
            try {
                $em->persist($objectEntity);
                $em->persist($offerEntity);
                $em->flush();
                
                $this->flashmessenger()->addSuccessMessage("The Property was successfully registered");
                $this->redirect()->toRoute("cus_offer/default", array(
                    "action" => "now"
                ));
            } catch (\Exception $e) {
                $this->flashmessenger()->addErrorMessage("THe proprety was not successfully registered");
                $this->redirect()->toRoute("cus_offer/default", array(
                    "action" => "now"
                ));
            }
        }
        return $this->getResponse()->setContent(NULL);
    }

    public function removeObjectAction()
    {
        $em = $this->entityManager;
        $objectId = $this->params()->fromRoute("id", NULL);
        $objectEntity = $em->find("Object\Entity\Object", $objectId);
        $customerOfferSession = new Container("customer_offer_session");
        
        $offerId = $customerOfferSession->offerId;
        
        $offerEntity = $em->find("Offer\Entity\Offer", $offerId);
        
        $offerEntity->setUpdatedOn(new \DateTime());
        
        $offerEntity->removeObject($objectEntity);
        
        try {
            $em->persist($offerEntity);
            $em->flush();
            $this->flashmessenger()->addSuccessMessage("The property was successfully removed ");
            $this->redirect()->toRoute("cus_offer/default", array(
                "action" => "now"
            ));
        } catch (\Exception $e) {
            $this->flashmessenger()->addErrorMessage("There was a challenge removing this property from the package");
            $this->redirect()->toRoute("cus_offer/default", array(
                "action" => "now"
            ));
        }
        return $this->getResponse()->setContent(NULL);
    }

    public function prePaymentAction()
    {
        $em = $this->entityManager;
        $generalSession = $this->clientGeneralService->getGeneralSession();
        $customerOfferSession = new Container("customer_offer_session");
        $id = $customerOfferSession->offerId;
        $offerEnitity = $em->find("Offer\Entity\Offer", $id);
        $invoiceEntity = $offerEnitity->getInvoice();
        $generalSession->InvoiceId = $invoiceEntity->getId();
        if ($customerOfferSession->isFromOfferNowAction == TRUE) {
            // Regenrate the invoice here
            try {
                $generalSession->InvoiceId = $invoiceEntity->getId(); // This would be used accross all boards
                
                $customerOfferSession->isFromOfferNowAction = FALSE;
                $this->redirect()->toRoute("board/default", array(
                    "action" => "payment"
                ));
            } catch (\Exception $e) {
                $this->flashmessenger()->addErrorMessage("There was a problem calling the payment page");
                $this->redirect()->toRoute("cus_offer");
            }
        } else {
            $this->flashmessenger()->addErrorMessage("we could not find the offer identifier");
            $this->redirect()->toRoute("cus_offer");
        }
        return $this->getResponse()->setContent(NULL);
    }

    public function viewAction()
    {
        $em = $this->entityManager;
        $customerOfferSession = new Container("customer_offer_session");
        $id = (int) $this->params()->fromRoute("id", NULL);
        if ($id == NULL) {
            $this->flashmessenger()->addErrorMessage("There is no identifier for this offer");
            $this->redirect()->toRoute("cus_offer");
        }
        
        $offerEntity = $em->find("Offer\Entity\Offer", $id);
        if ($offerEntity == NULL) {
            $this->flashmessenger()->addErrorMessage("This offer does not exist");
            $this->redirect()->toRoute("cus_offer");
        }
        
        $customerOfferSession->offerId = $offerEntity->getId();
        $this->redirect()->toRoute("cus_offer/default", array(
            "action" => "now"
        ));
        
        return $this->getResponse()->setContent(NULL);
    }

    public function activeAction()
    {
        $customerBoardServcie = $this->customerBoardService;
        $activeOffer = $customerBoardServcie->customerActiveOffers();
        $view = new ViewModel(array(
            "offer" => $activeOffer
        ));
        return $view;
    }

    public function deleteAction()
    {
        $em = $this->entityManager;
        
        $id = $this->params()->fromRoute("id", NULL);
        $offerEntity = $em->find("Offer\Entity\Offer", $id);
        $offerEntity->setIsHidden(TRUE)->setUpdatedOn(new \DateTime());
        try {
            $em->persist($offerEntity);
            $em->flush();
            $this->flashmessenger()->addSuccessMessage("Successfully deleted the offer");
            $this->redirect()->toRoute("cus_offer");
        } catch (\Exception $e) {
            $this->flashmessenger()->addErrorMessage("Offer could not be deleted");
            $this->redirect()->toRoute("cus_offer");
        }
        return $this->getResponse()->setContent(NULL);
    }

    public function editAction()
    {
        $em = $this->entityManager;
        $id = $this->params()->fromRoute("id", NULL);
        if ($id == NULL) {
            $this->redirect()->toRoute("cus_offer");
        }
        $offer = $em->find("Offer\Entity\Offer", $id);
        $view = new ViewModel();
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

    public function setOfferForm($form)
    {
        $this->offerForm = $form;
        return $this;
    }

    public function setOfferService($xserv)
    {
        $this->offerService = $xserv;
        return $this;
    }

    public function setClientGeneralService($xserv)
    {
        $this->clientGeneralService = $xserv;
        return $this;
    }

    public function setObjectForm($form)
    {
        $this->objectForm = $form;
        return $this;
    }

    public function setObjectService($xserv)
    {
        $this->objectServie = $xserv;
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

    public function setGeneralSession($sess)
    {
        $this->generalSession = $sess;
        return $this;
    }

    public function setSelectObjectForm($form)
    {
        $this->selectObjectForm = $form;
        return $this;
    }

    public function setRenderer($ren)
    {
        $this->renderer = $ren;
        return $this;
    }
}