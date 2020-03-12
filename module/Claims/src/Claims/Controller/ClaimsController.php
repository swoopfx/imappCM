<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Claims for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Claims\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use CsnUser\Service\UserService;
use Claims\Service\ClaimsService;
use WasabiLib\Ajax\Response;
use WasabiLib\Ajax\GritterMessage;
use GeneralServicer\Service\GeneralService;
use WasabiLib\Ajax\Redirect;
use Comments\Form\CommentForm;
use Comments\Entity\Comments;
use WasabiLib\Modal\WasabiModal;
use WasabiLib\Modal\WasabiModalView;
use Comments\Service\CommentService;
use Claims\Form\ClaimsProcessingForm;
use WasabiLib\Wizard\StepController;
use WasabiLib\Wizard\ClosureArguments;
use WasabiLib\Wizard\Wizard;
use WasabiLib\Modal\Dialog;
use WasabiLib\Modal\Button;
use Claims\Entity\CLaims;
use Claims\Entity\ClaimsSettlement;
use GeneralServicer\Service\CurrencyService;
use GeneralServicer\Service\TriggerService;
use Users\Entity\InsuranceBrokerRegistered;
use WasabiLib\Ajax\InnerHtml;

class ClaimsController extends AbstractActionController
{

    private $entityManager;

    /**
     *
     * @var GeneralService
     */
    private $generalService;

    private $claimsForm;

    private $claimsExportForm;

    private $claimsApprovedForm;

    private $claimsRejectedForm;

    private $customer;

    private $motherBroker;

    private $claimsService;

    private $brokerClaimsSession;

    private $mailService;

    private $messageForm;

    private $messageService;

    private $blobService;

    private $claimsMotorForm;

    private $commentForm;

    private $dropZoneForm;

    private $renderer;

    private $locator;

    // private $serviceLocator;
    public function onDispatch(\Zend\Mvc\MvcEvent $e)
    {
        $response = parent::onDispatch($e);
        // $response = parent::on
        $this->redirectPlugin()->redirectCondition();
        return $response;
    }

    public function pdfexportAction()
    {
        $response = new Response();
        return $this->getResponse()->setContent($response);
    }
    
    /**
     * Shows details about the rejected claims
     * @return mixed
     */
    public function rejectfulldetailsAction(){
        $em = $this->entityManager;
        $response = new Response();
        $modal = new WasabiModal("standard", "Claims Rejection Details");
        $brokerClaimsSession = $this->brokerClaimsSession;
        $claimsId = $brokerClaimsSession->claimsId;
        /**
         *
         * @var CLaims $claimsEntity
         */
        $claimsEntity= $em->find("Claims\Entity\CLaims", $claimsId);
        $viewModel = new ViewModel(array(
            "desc"=>$claimsEntity->getReasonDescription()
        ));
        $viewModel->setTemplate("proposal-desc-modal");
        $modal->setContent($viewModel);
        $modalView = new WasabiModalView("#wasabi", $this->renderer, $modal);
        $response->add($modalView);
        return $this->getResponse()->setContent($response);
    }
    
    /**
     * Shows details about the approved claims
     * @return mixed
     */
    public function approvedfulldetailsAction(){
        $em = $this->entityManager;
        $response = new Response();
        $modal = new WasabiModal("standard", "Claims Aprroval Details");
        $brokerClaimsSession = $this->brokerClaimsSession;
        $claimsId = $brokerClaimsSession->claimsId;
        /**
         *
         * @var CLaims $claimsEntity
         */
        $claimsEntity= $em->find("Claims\Entity\CLaims", $claimsId);
        $viewModel = new ViewModel(array(
            "desc"=>$claimsEntity->getClaimsSettled()->getInformation()
        ));
        $viewModel->setTemplate("proposal-desc-modal");
        $modal->setContent($viewModel);
        $modalView = new WasabiModalView("#wasabi", $this->renderer, $modal);
        $response->add($modalView);
        return $this->getResponse()->setContent($response);
    }
    
    /**
     * This function changes the state of the approved calims from unpaid to paid 
     * @return mixed
     */
    public function ajaxchangetopaidconfirmationAction(){
        $response = new Response();
        $dialog = new Dialog("Dialog", "Confirm Action", "You are about to confirm claims payment has been disbursed <br>  Once this is confirmed it cannot be changed ", Dialog::TYPE_SUCCESS);
        $cbutton = new Button("Accept");
        $cbutton->addClass("btn  btn-success");
        $cbutton->setAction($this->url()
            ->fromRoute("claims/default", array(
                "action" => "ajaxchangetopaidclaims"
            )));
        $dialog->setTitle("Confirm Payment");
        $dialog->setConfirmButton($cbutton);
        // $dialog->set
        
        $modalView = new WasabiModalView("#wasabi", $this->renderer, $dialog);
        $response->add($modalView);
        return $this->getResponse()->setContent($response);
    }
    
    /**
     * This function uses ajax to change the state of the claims to paid 
     * @return mixed
     */
    public function ajaxchangetopaidclaimsAction(){
        $response = new Response();
        $em = $this->entityManager;
        $brokerClaimsSession = $this->brokerClaimsSession;
        $claimsId = $brokerClaimsSession->claimsId;
        $gritter = new GritterMessage();
        if($claimsId == NULL){
            $gritter->setTitle("Identifier Error");
            $gritter->setText("Absent Identifier");
            $gritter->setType(GritterMessage::TYPE_ERROR);
            
            $response->add($gritter);
        }else{
            /**
             * 
             * @var CLaims $claimsEntity
             */
            $claimsEntity= $em->find("Claims\Entity\CLaims", $claimsId);
            $claimsEntity->setClaimStatus($em->find("Claims\Entity\ClaimStatus", ClaimsService::CLAIMS_STATUS_SETTLED_AND_PAID))->setUpdatedOn(new \DateTime());
            try {
                $em->persist($claimsEntity);
                $em->flush();
                
                $gritter->setTitle("Success");
                $gritter->setText("Successfully changed status to paid");
                $gritter->setType(GritterMessage::TYPE_SUCCESS);
                
                $response->add($gritter);
                
                /**
                 *
                 * @var InsuranceBrokerRegistered $broker
                 */
                $broker = $this->generalService->getBroker();
                $mailParams = array(
                    "messagePointers" => array(
                        "to" => $claimsEntity->getPolicy()
                        ->getCoverNote()
                        ->getCustomer()
                        ->getUser()
                        ->getEmail(),
                        "fromName" => $broker->getBrokerName(),
                        "subject" => "Claims funds disbursed"
                    ),
                    "template" => array(
                        "template" => "general-mail-default",
                        "var" => array(
                            "logo" => $this->generalService->getBrokerAbsoluteLogo(),
                            "message" => "Your claim title {$claimsEntity->getClaimTopic()} funds has been disbursed",
                            "title" => "Claims Disbursed"
                                )
                        )
                        //
                    
                    // "templateString" =>, // use generic mail design
                    );
                // trigger mails sent to the customer
                // trigger a notification to cuustomer dashboard
                
                $this->getEventManager()->trigger(TriggerService::TRIGGER_GENERAL_EMAIL_SEND, $this, $mailParams);
                
                
                $redirect = new Redirect($this->url()->fromRoute("claims/default", array("action"=>"process")));
                $response->add($redirect);
                
            } catch (\Exception $e) {
                $gritter->setTitle("Error");
                $gritter->setText("Error disbursing claim funds");
                $gritter->setType(GritterMessage::TYPE_ERROR);
                
                $response->add($gritter);
            }
        }
        return $this->getResponse()->setContent($response);
    }

    /**
     * This action gets the neccessary claims information and sends it as a mail to the
     * information required by insurer
     * Information submitted by customer
     *
     * @return mixed
     */
    public function exporttomailAction()
    {
        $em = $this->entityManager;
        $response = new Response();
        $form = $this->claimsExportForm;
        // $generalService = $this->generalService;

        $form->setAttributes(array(
            "id" => "simpleForm",
            "class" => "form-horizontal form-label-left ajax_element",
            "data-ajax-loader" => "exporttomailajax",
            "action" => $this->url()
                ->fromRoute("claims/default", array(
                "action" => "exporttomail"
            ))
        ));
        $brokerClaimsSession = $this->brokerClaimsSession;
        $claimsId = $brokerClaimsSession->claimsId;
        $request = $this->getRequest();
        $gritter = new GritterMessage();
        if ($request->isPost()) {
            $post = $request->getPost();
            $form->setData($post);
            if ($form->isValid()) {
                $email = $post['exportEmailFieldset']["exportEmail"];
                // send information to email;
                $claimsEntity = $em->find("Claims\Entity\CLaims", $claimsId);
            } else {
                $gritter->setTitle("InValid Form");
                $gritter->setText("The form filled is not valid, please check information and try again latter");
                $gritter->setType(GritterMessage::TYPE_ERROR);
                $gritter->setSticky(TRUE);

                $response->add($gritter);
            }
        } else {

            $modal = new WasabiModal("standard", "Enter Email");
            $viewModel = new ViewModel(array(
                "form" => $form
            ));
            $viewModel->setTemplate("claims_export_form_snippet");
            $modal->setContent($viewModel);
            $modalView = new WasabiModalView("#wasabi", $this->renderer, $modal);
            $response->add($modalView);
        }
        return $this->getResponse()->setContent($response);
    }

    /**
     * Provides a confirmation for the user that a claim is about to be approved
     *
     * @return mixed
     */
    public function approveclaimconfirmAction()
    {
        $response = new Response();
        $dialog = new Dialog("Dialog", "Confirm Action", "By Aproving this, <br>  Insurer approved value would be set <br> Any Additional information additional information would be attached<br> Some buttons would be disabled for further use once the claim approval has been effected", Dialog::TYPE_SUCCESS);
        $cbutton = new Button("Accept");
        $cbutton->addClass("btn  btn-success");
        $cbutton->setAction($this->url()
            ->fromRoute("claims/default", array(
            "action" => "approveclaim"
        )));
        $dialog->setTitle("Approve Claims");
        $dialog->setConfirmButton($cbutton);
        // $dialog->set

        $modalView = new WasabiModalView("#wasabi", $this->renderer, $dialog);
        $response->add($modalView);
        return $this->getResponse()->setContent($response);
    }

    /**
     * This action provides the logic for processing approved claims
     * It changes the status of the claims and notifies the customer
     *
     * @return mixed
     */
    public function approveclaimAction()
    {
        $response = new Response();
        $em = $this->entityManager;
        $brokerClaimsSession = $this->brokerClaimsSession;
        $claimsId = $brokerClaimsSession->claimsId;
        $gritter = new GritterMessage();
        $form = $this->claimsApprovedForm;
        $form->setAttributes(array(
            "id" => "simpleForm",
            "class" => "form-horizontal form-label-left ajax_element",
            "data-ajax-loader" => "approvedajax",
            "action" => $this->url()
                ->fromRoute("claims/default", array(
                "action" => "approveclaim"
            ))
        ));

        if ($claimsId != NULL) {

            $request = $this->getRequest();
            if ($request->isPost()) {
                $post = $request->getPost();
                $form->setData($post);
                if ($form->isValid()) {
                    $claimsEntity = $em->find("Claims\Entity\CLaims", $claimsId);
                    $data = $form->getData();
                    $claimsSettlementEntity = new ClaimsSettlement();
                    $claimsSettlementEntity->setClaims($claimsEntity)
                        ->setAmountApproved(CurrencyService::cleanInputValueStatic($data->getAmountApproved()))
                        ->setCreatedOn(new \DateTime())
                        ->setDateApproved($data->getDateApproved())
                        ->setInformation($data->getInformation());
                    /**
                     *
                     * @var CLaims $claimsEntity
                     */

                    try {
                        $claimsEntity->setIsSettled(TRUE)
                            ->setUpdatedOn(new \DateTime())
                            ->setClaimsSettledDate(new \DateTime())
                            ->setClaimStatus($em->find("Claims\Entity\ClaimStatus", ClaimsService::CLAIMS_STATUS_SETTLED_AND_UNPAID));

                        $em->persist($claimsSettlementEntity);
                        $em->persist($claimsEntity);
                        $em->flush();

                        // var_dump("MINE");

                        $gritter->setType(GritterMessage::TYPE_SUCCESS);
                        $gritter->setTitle("Approval Successful");
                        $gritter->setText("Claims has been approved");
                        $gritter->setSticky(TRUE);

                        /**
                         *
                         * @var InsuranceBrokerRegistered $broker
                         */
                        $broker = $this->generalService->getBroker();
                        $mailParams = array(
                            "messagePointers" => array(
                                "to" => $claimsEntity->getPolicy()
                                    ->getCoverNote()
                                    ->getCustomer()
                                    ->getUser()
                                    ->getEmail(),
                                "fromName" => $broker->getBrokerName(),
                                "subject" => "Approved Claims"
                            ),
                            "template" => array(
                                "template" => "general-mail-default",
                                "var" => array(
                                    "logo" => $this->generalService->getBrokerAbsoluteLogo(),
                                    "message" => "Your claim title {$claimsEntity->getClaimTopic()} has been approved, please log into your web account to view details",
                                    "title" => "Approved Claims"
                                )
                            )
                            //

                            // "templateString" =>, // use generic mail design
                        );
                        // trigger mails sent to the customer
                        // trigger a notification to cuustomer dashboard

                        $this->getEventManager()->trigger(TriggerService::TRIGGER_GENERAL_EMAIL_SEND, $this, $mailParams);

                        $approvedClaimsParam = array(
                            "claims" => $claimsEntity->getId()
                        );
                        $this->getEventManager()->trigger(TriggerService::TRIGGER_CLAIMS_APPROVED_CLAIMS, $this, $approvedClaimsParam);
                        $response->add($gritter);

                        $redirect = new Redirect($this->url()->fromRoute("claims/default", array(
                            "action" => "process"
                        )));
                        $response->add($redirect);
                    } catch (\Exception $e) {
                        $gritter->setTitle("Error");
                        $gritter->setText("Claim approval error");
                        $gritter->setType(GritterMessage::TYPE_ERROR);
                        $gritter->setSticky(TRUE);
                        $response->add($gritter);
                    }
                } else {
                    $gritter->setTitle("Validation Error");
                    $gritter->setText("Form submitted does not meet minimum validation requirement");
                    $gritter->setSticky(TRUE);
                    $gritter->setType(GritterMessage::TYPE_ERROR);

                    $response->add($gritter);
                }
            } else {
                $modal = new WasabiModal("standard", "Approve Claims");
                $viewModel = new ViewModel(array(
                    "form" => $form
                ));
                $viewModel->setTemplate("claims--approve-claims-form");
                $modal->setContent($viewModel);

                $modalView = new WasabiModalView("#wasabi", $this->renderer, $modal);
                $response->add($modalView);
            }
        } else {
            $gritter->setTitle("Identifier Error");
            $gritter->setText("Absent Identifier");
            $gritter->setType(GritterMessage::TYPE_ERROR);
            $gritter->setSticky(TRUE);

            $response->add($gritter);
        }
        return $this->getResponse()->setContent($response);
    }

    /**
     * Relection confirmation modal function 
     * @return mixed
     */
    public function rejectconfirmationAction()
    {
        $response = new Response();
        $dialog = new Dialog("Dialog", "Confirm Action", "This action cannot be undone, Please be very sure  about this action", Dialog::TYPE_SUCCESS);
        $cbutton = new Button("Accept");
        $cbutton->addClass("btn  btn-success ");
        $cbutton->setAction($this->url()
            ->fromRoute("claims/default", array(
            "action" => "rejectclaim"
        )));
        $dialog->setTitle("Reject Claims");
        $dialog->setConfirmButton($cbutton);
        // $dialog->set

        $modalView = new WasabiModalView("#wasabi", $this->renderer, $dialog);
        $response->add($modalView);
        return $this->getResponse()->setContent($response);
    }

    /**
     * This function provides logic for the rejection/decline of the claims
     * @return mixed
     */
    public function rejectclaimAction()
    {
        $response = new Response();
        $em = $this->entityManager;
        $brokerClaimsSession = $this->brokerClaimsSession;
        $claimsId = $brokerClaimsSession->claimsId;
        $gritter = new GritterMessage();
        $form = $this->claimsRejectedForm;
        $form->setAttributes(array(
            "id" => "simpleForm",
            "class" => "form-horizontal form-label-left ajax_element",
            "data-ajax-loader" => "rejectajax",
            "action" => $this->url()
                ->fromRoute("claims/default", array(
                "action" => "rejectclaim"
            ))
        ));
        $request = $this->getRequest();
        if ($request->isPost()) {
            $post = $request->getPost();
            $form->setData($post);
            if ($form->isValid()) {
                /**
                 *
                 * @var CLaims $claimsEntity
                 */
                $claimsEntity = $em->find("Claims\Entity\CLaims", $claimsId);
                $data = $form->getData();
                try {

                    $claimsEntity->setDeclineResason($data['claimsRejectedFieldset']['declineResason'])
                        ->setReasonDescription($data['claimsRejectedFieldset']['reasonDescription'])
                        ->setIsSettled(FALSE)
//                         ->set
                        ->setClaimStatus($em->find("Claims\Entity\ClaimStatus", ClaimsService::CLAIMS_STATUS_DECLINED))
                        ->setUpdatedOn(new \DateTime());

                    $em->persist($claimsEntity);
                    $em->flush();

                    $gritter->setType(GritterMessage::TYPE_SUCCESS);
                    $gritter->setTitle("Success");
                    $gritter->setText("Claims successfully rejected");
                    $gritter->setSticky(TRUE);

                    $response->add($gritter);

                    /**
                     *
                     * @var InsuranceBrokerRegistered $broker
                     */
                    $broker = $this->generalService->getBroker();
                    $mailParams = array(
                        "messagePointers" => array(
                            "to" => $claimsEntity->getPolicy()
                                ->getCoverNote()
                                ->getCustomer()
                                ->getUser()
                                ->getEmail(),
                            "fromName" => $broker->getBrokerName(),
                            "subject" => "Rejected Claims"
                        ),
                        "template" => array(
                            "template" => "general-mail-default",
                            "var" => array(
                                "logo" => $this->generalService->getBrokerAbsoluteLogo(),
                                "message" => "Your claim title {$claimsEntity->getClaimTopic()} has been declined, please log into your web account to view details",
                                "title" => "Declined Claims"
                            )
                        )
                        //

                        // "templateString" =>, // use generic mail design
                    );
                    // trigger mails sent to the customer
                    // trigger a notification to cuustomer dashboard

                    $this->getEventManager()->trigger(TriggerService::TRIGGER_GENERAL_EMAIL_SEND, $this, $mailParams);

                    $redirect = new Redirect($this->url()->fromRoute("claims/default", array(
                        "action" => "process"
                    )));
                    $response->add($redirect);

                    // process claims rejection
                } catch (\Exception $e) {
                    $gritter->setTitle("Hydration Error");
                    $gritter->setType(GritterMessage::TYPE_ERROR);
                    $gritter->setText("The form could not be hydrated as of now");
                    $gritter->setSticky(TRUE);

                    $response->add($gritter);
                }
            } else {
                $gritter->setTitle("Invalid Error");
                $gritter->setText("The form is invalid, Please check and resubmit");
                $gritter->setType(GritterMessage::TYPE_ERROR);
                $gritter->setSticky(TRUE);

                $response->add($gritter);
            }
        } else {
            $modal = new WasabiModal("standard", "Reject Claim");
            $viewModel = new ViewModel(array(
                "form" => $form
            ));
            $viewModel->setTemplate("claims-rejected-claims-form");
            $modal->setContent($viewModel);
            $modalView = new WasabiModalView("#wasabi", $this->renderer, $modal);
            $response->add($modalView);
        }
        return $this->getResponse()->setContent($response);
    }

    /**
     * This function provides a confirmation modal for the closure of the claim
     * @return mixed
     */
    public function closeclaimsconfirmationAction()
    {
        $response = new Response();
        $dialog = new Dialog("Dialog", "Confirm Action", "This action cannot be undone, Please be very sure  about this action", Dialog::TYPE_SUCCESS);
        $cbutton = new Button("Close Claims");
        $cbutton->addClass("btn  btn-success ");
        $cbutton->setAction($this->url()
            ->fromRoute("claims/default", array(
            "action" => "closeclaims",
            "id" => 1
        )));
        $dialog->setTitle("Close Claims");
        $dialog->setConfirmButton($cbutton);
        // $dialog->set

        $modalView = new WasabiModalView("#wasabi", $this->renderer, $dialog);
        $response->add($modalView);
        return $this->getResponse()->setContent($response);
    }

    /**
     * This function finalizes the closure of the claims
     * @return mixed
     */
    public function closeclaimsAction()
    {
        $response = new Response();
        $em = $this->entityManager;
        $id = $this->params()->fromRoute("id", NULL);
        $gritter = new GritterMessage();
        if ($id == 1) {
            $brokerClaimsSession = $this->brokerClaimsSession;
            $claimsId = $brokerClaimsSession->claimsId;
            /**
             *
             * @var CLaims $claimsEntity
             */
            $claimsEntity = $em->find("Claims\Entity\CLaims", $claimsId);
            $claimsEntity->setIsHidden(TRUE)->setUpdatedOn(new \DateTime());
            try {
                $em->persist($claimsEntity);
                $em->flush();

                $gritter->setTitle("Success");
                $gritter->setText("Claims successfully closed");
                $gritter->setType(GritterMessage::TYPE_SUCCESS);
                $gritter->setSticky(TRUE);

                $response->add($gritter);

                /**
                 *
                 * @var InsuranceBrokerRegistered $broker
                 */
                $broker = $this->generalService->getBroker();
                $mailParams = array(
                    "messagePointers" => array(
                        "to" => $claimsEntity->getPolicy()
                            ->getCoverNote()
                            ->getCustomer()
                            ->getUser()
                            ->getEmail(),
                        "fromName" => $broker->getBrokerName(),
                        "subject" => "Claims Closed"
                    ),
                    "template" => array(
                        "template" => "general-mail-default",
                        "var" => array(
                            "logo" => $this->generalService->getBrokerAbsoluteLogo(),
                            "message" => "Your claim title {$claimsEntity->getClaimTopic()} has been closed, and it is not accessible anymore",
                            "title" => "Closed Claims"
                        )
                    )
                    //

                    // "templateString" =>, // use generic mail design
                );
                // trigger mails sent to the customer
                // trigger a notification to cuustomer dashboard

                $this->getEventManager()->trigger(TriggerService::TRIGGER_GENERAL_EMAIL_SEND, $this, $mailParams);

                $redirect = new Redirect($this->url()->fromRoute("claims/default", array(
                    "action" => "process"
                )));
                $response->add($redirect);
            } catch (\Exception $e) {
                $gritter->setTitle("Error");
                $gritter->setText("Error closing claims ");
                $gritter->setType(GritterMessage::TYPE_ERROR);
                $gritter->setSticky(TRUE);

                $response->add($gritter);
            }
        } else {
            $gritter->setTitle("Authorization Error");
            $gritter->setText("You are not authorized to handle this process");
            $gritter->setType(GritterMessage::TYPE_ALERT);
            $gritter->setSticky(TRUE);
            
            $response->add($gritter);
        }
        return $this->getResponse()->setContent($response);
    }
    
    
    
    public function uploadsettledclaimdocAction(){
        $response = new Response();
        $em = $this->entityManager;
        $brokerClaimsSession = $this->brokerClaimsSession;
        $claimsId = $brokerClaimsSession->claimsId;
        $gritter = new GritterMessage();
        if ($claimsId == NULL) {
            $gritter->setText("Error: Identifier absent");
            $gritter->setTitle("Error");
            $gritter->setType(GritterMessage::TYPE_ERROR);
            $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);
            
            $response->add($gritter);
        } else {
            $request = $this->getRequest();
            if ($request->isPost() || $request->isXmlHttpRequest()) {
                $files = $this->params()->fromFiles('file');
                
                $docEntity = $this->blobService->uploadBlob($files);
                try {
                    // $docEntity = $em->find("GeneralServicer\Entity\Document", $res);
                    /**
                     * 
                     * @var CLaims $claimsEntity
                     */
                    $claimsEntity = $em->find("Claims\Entity\CLaims", $claimsId);
                    
//                     $claimsEntity->addClaimsDoc($docEntity)->setUpdatedOn(new \DateTime());
                    $claimsSettlementEntity = $claimsEntity->getClaimsSettled();
                    $claimsSettlementEntity->addDocument($docEntity)->setUpdateOn(new \DateTime());
                    $em->persist($docEntity);
                    $em->persist($claimsSettlementEntity);
                    $em->flush();
                    
                    $gritter->setTitle("Success");
                    $gritter->setText("Success: Uploaded document");
                    $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);
                    $gritter->setType(GritterMessage::TYPE_SUCCESS);
                    
                    // $gritter->set
                    
                    $response->add($gritter);
                } catch (\Exception $e) {
                    $gritter->setType(GritterMessage::TYPE_ERROR);
                    $gritter->setTitle("Error");
                    $gritter->setText("Error: Problem uploading documents");
                    $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);
                    
                    $response->add($gritter);
                }
            }
        }
        return $this->getResponse()->setContent($response);
    }
    

    /**
     * This is a quick preview for export options
     * IT show 2 buttons on mode of export
     * Export to pDF
     * Export to mail
     *
     * @return mixed
     */
    public function exportclaimsdetailsmodalAction()
    {
        $response = new Response();
        $modal = new WasabiModal("standard", "Export Method");
        $modalView = new WasabiModalView("#wasabi", $this->renderer, $modal);
        $viewModel = new ViewModel();
        $viewModel->setTemplate("claims_export_detals_button");
        $modal->setContent($viewModel);
        $response->add($modalView);
        return $this->getResponse()->setContent($response);
    }

    /**
     * Modified simple wizard
     *
     * @return mixed
     */
    public function simplewizardAction()
    {
        $serviceLocator = $this->locator;
        $request = $this->getRequest();

        $stepCollectionClosure = $this->stepCollectionClosure();
        $wizard = new Wizard("#Wizard .modal-body", $request, $stepCollectionClosure, $serviceLocator);
        $wizard->disablePrevButton();
        $response = new Response();
        if ($wizard->isFirstCall()) {
            $wizard->getStorageContainer()->clearStorage();
            $modal = new WasabiModal("Wizard", "Claims Form", $wizard->getViewResult()->getViewModel());

            $modalView = new WasabiModalView("#wasabi", $this->renderer, $modal);
            $response->add($modalView);
        } else {
            $response->add($wizard->getViewResult());
        }
        // $response = new Response();

        // $response->add($wizard);
        return $this->getResponse()->setContent($response);
    }

    private function stepCollectionClosure()
    {
        $stepCollectionClosure = function () {
            $stepCollection = new \WasabiLib\Wizard\StepCollection();
            $stepCollection->add($this->simpleStepOne());
            $stepCollection->add($this->simpleStepTwo());

            return $stepCollection;
        };
        return $stepCollectionClosure;
    }

    private function simpleStepOne()
    {
        $stepOne = new StepController("Call Information", "information");
        $viewModel = new ViewModel();
        $viewModel->setTemplate("claims-test");
        $stepOne->setFormAction("simpleWizard");
        $stepOne->setViewModel($viewModel);
        return $stepOne;
    }

    private function simpleStepTwo()
    {
        $stepTwo = new StepController("Second Step", "SecondStep");
        $viewModel = new ViewModel();
        $viewModel->setTemplate("claims-test");
        $stepTwo->setFormAction("simpleWizard");
        $stepTwo->setViewModel($viewModel);
        return $stepTwo;
    }

    /**
     * The confirmation button for removing documents from the claim
     *
     * @return mixed
     */
    public function removedocconfirmAction()
    {
        $response = new Response();
        $dialog = new Dialog("Dialog", "Confirm Action", "Are you sure you want to remove this document", Dialog::TYPE_SUCCESS);
        $cbutton = new Button("Accept");
        $cbutton->setAction($this->url()
            ->fromRoute("claims/default", array(
            "action" => "removedoc",
            "id" => $this->params()
                ->fromQuery("data", NULL)
        )));
        $dialog->setTitle("Remove Document");
        $dialog->setConfirmButton($cbutton);
        // $dialog->set

        $modalView = new WasabiModalView("#wasabi", $this->renderer, $dialog);
        $response->add($modalView);
        return $this->getResponse()->setContent($response);
    }

    /**
     * The document removal action itself
     * Removes the document from the
     *
     * @return mixed
     */
    public function removedocAction()
    {
        $response = new Response();
        $em = $this->entityManager;
        $gritter = new GritterMessage();
        $docId = $this->params()->fromRoute("id", NULL);
        if ($docId == NULL) {
            // $this->flashmessenger()->addErrorMessage("No visible identity to be remoived");
            // $this->redirect()->toRoute("proposal/default", array(
            // "action" => "process"
            // ));

            $gritter->setTitle("ERROR");
            $gritter->setText("Absent Identifier");
            $gritter->setType(GritterMessage::TYPE_ERROR);

            $response->add($gritter);
        }
        // $docEntity = $em->getRepository("GeneralServicer\Entity\Document")->findOneBy(array("docCode"=> $docId));
        $docEntity = $em->find("GeneralServicer\Entity\Document", $docId);
        $brokerClaimsSession = $this->brokerClaimsSession;
        $claimsId = $brokerClaimsSession->claimsId;
        $claimsEntity = $em->find("Claims\Entity\CLaims", $claimsId);
        try {
            $claimsEntity->removeClaimsDoc($docEntity)->setUpdatedOn(new \DateTime());
            $em->persist($claimsEntity);
            $em->flush();
            $this->flashmessenger()->addSuccessMessage("Successfully removed object document");
            $gritter->setTitle("Success");
            $gritter->setText("Successfully removed the document");
            $gritter->setType(GritterMessage::TYPE_SUCCESS);

            $response->add($gritter);
            $redirect = new Redirect($this->url()->fromRoute("claims/default", array(
                "action" => "process"
            )));
            $response->add($redirect);
        } catch (\Exception $e) {
            $this->flashmessenger()->addErrorMessage($e->getMessages());
            $this->redirect()->toRoute("claims/default", array(
                "action" => "process"
            ));
        }

        return $this->getResponse()->setContent($response);
    }

    /**
     * This processes the comment made by the claims controller
     *
     * @return mixed
     */
    public function commentajaxAction()
    {
        $response = new Response();
        $em = $this->entityManager;
        $generalService = $this->generalService;
        $brokerClaimsSession = $this->brokerClaimsSession;
        $claimsId = $brokerClaimsSession->claimsId;
        $commentForm = $this->commentForm;
        $gritter = new GritterMessage();
        if ($claimsId == NULL) {
            $gritter->setText("Error: Identifier absent");
            $gritter->setTitle("Error");
            $gritter->setType(GritterMessage::TYPE_ERROR);
            $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);

            $response->add($gritter);
        } else {
            $claimsEntity = $em->find("Claims\Entity\CLaims", $claimsId);
            $request = $this->getRequest();
            $commentEntity = new Comments();
            if ($request->isPost()) {
                $post = $request->getPost();

                $commentForm->setData($post);
                if ($commentForm->isValid()) {
                    $data = $commentForm->getData();
                    $commentEntity->setCreatedOn(new \DateTime())
                        ->setBroker($em->find("Users\Entity\InsuranceBrokerRegistered", $generalService->getCentralBroker()))
                        ->setCustomer($claimsEntity->getPolicy()
                        ->getCoverNote()
                        ->getCustomer())
                        ->setCommmentUid(CommentService::commentUid())
                        ->setComment($data->getComment())
                        ->setTopic($data->getTopic())
                        ->setIsRead(FALSE)
                        ->setClaims($claimsEntity)
                        ->setCommentor($this->identity())
                        ->setCommentCategory($em->find("Settings\Entity\CommentCategory", CommentService::COMMENT_CATEGORY_CLAIMS));

                    // var_dump($data->getComment());
                    try {
                        $em->persist($commentEntity);
                        $em->flush();

                        $gritter->setTitle("Success");
                        $gritter->setText("Successfully sent comment");
                        $gritter->setType(GritterMessage::TYPE_SUCCESS);
                        $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);
                        $response->add($gritter);

                        /**
                         * Update the comment page
                         *
                         * Send mail
                         */

                        $redirect = new Redirect($this->url()->fromRoute("claims/default", array(
                            "action" => "process"
                        )));
                        $response->add($redirect);
                    } catch (\Exception $e) {

                        $gritter->setTitle("Error");
                        $gritter->setText("");
                        $gritter->setType(GritterMessage::TYPE_ERROR);
                        $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);

                        $response->add($gritter);
                    }
                    //
                }
            }
        }

        return $this->getResponse()->setContent($response);
    }

    /**
     * This action displays the submitted claims information
     *
     * @return mixed
     */
    public function claimdetailsmodalAction()
    {
        $em = $this->entityManager;
        $response = new Response();
        $brokerClaimsSession = $this->brokerClaimsSession;
        $claimsId = $brokerClaimsSession->claimsId;
        $gritter = new GritterMessage();
        if ($claimsId == NULL) {
            $gritter->setText("Error: Identifier absent");
            $gritter->setTitle("Error");
            $gritter->setType(GritterMessage::TYPE_ERROR);
            $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);

            $response->add($gritter);
        } else {
            $claimsEntity = $em->find("Claims\Entity\CLaims", $claimsId);
            $modal = new WasabiModal("standard", "Claims Details");
            $viewModel = new ViewModel(array(
                "claimsEntity" => $claimsEntity
            ));
            $modal->setContent($viewModel);
            $viewModel->setTemplate("claims-details-snippet");

            $modalView = new WasabiModalView("#wasabi", $this->renderer, $modal);
            $response->add($modalView);
        }
        return $this->getResponse()->setContent($response);
    }

    /**
     * This manages the state of a claim
     *
     * @return mixed
     */
    public function processclaimsAction()
    {
        $response = new Response();
        $modal = new WasabiModal("standard", "Claims Management");
        $processForm = new ClaimsProcessingForm();
        $processForm->setAttributes(array(
            "id" => "simpleForm",
            "class" => "form-horizontal form-label-left ajax_element",
            "data-ajax-loader" => "commentajax",
            "action" => $this->url()
                ->fromRoute("claims/default", array(
                "action" => "commentajax"
            ))
        ));
        $viewModel = new ViewModel(array(
            "manageForm" => $processForm
        ));
        $viewModel->setTemplate("claims-processing-snippet");
        $modal->setContent($viewModel);

        $modalView = new WasabiModalView("#wasabi", $this->renderer, $modal);
        $response->add($modalView);
        return $this->getResponse()->setContent($response);
    }

    private function selectprocess()
    {
        $stepone = new StepController("Select Process", "selectprocess");
        $processForm = new ClaimsProcessingForm();
        $viewModel = new ViewModel(array());
        $viewModel->setTemplate("processclaims");
        $close = new ClosureArguments();
        $stepone->setFormAction();
        $stepone->setForm($processForm);
        $stepone->setViewModel($viewModel);
        return $stepone;
    }

    public function policydetailsAction()
    {
        $em = $this->entityManager;
        $response = new Response();
        $brokerClaimsSession = $this->brokerClaimsSession;
        $claimsId = $brokerClaimsSession->claimsId;
        $gritter = new GritterMessage();
        if ($claimsId == NULL) {
            $gritter->setText("Error: Identifier absent");
            $gritter->setTitle("Error");
            $gritter->setType(GritterMessage::TYPE_ERROR);
            $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);

            $response->add($gritter);
        } else {
            $claimsEntity = $em->find("Claims\Entity\CLaims", $claimsId);
            $modal = new WasabiModal("standard", "Policy Details");
            $viewModel = new ViewModel(array(
                "policyEntity" => $claimsEntity->getPolicy()
            ));
            $viewModel->setTemplate("policy-modal-policy-certificate-modal");
            $modal->setContent($viewModel);

            $modalView = new WasabiModalView("#wasabi", $this->renderer, $modal);

            $response->add($modalView);
        }
        return $this->getResponse()->setContent($response);
    }

    public function uploaddocAction()
    {
        $em = $this->entityManager;
        $response = new Response();

        $brokerClaimsSession = $this->brokerClaimsSession;
        $claimsId = $brokerClaimsSession->claimsId;
        $gritter = new GritterMessage();
        if ($claimsId == NULL) {
            $gritter->setText("Error: Identifier absent");
            $gritter->setTitle("Error");
            $gritter->setType(GritterMessage::TYPE_ERROR);
            $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);

            $response->add($gritter);
        } else {
            $request = $this->getRequest();
            if ($request->isPost() || $request->isXmlHttpRequest()) {
                $files = $this->params()->fromFiles('file');

                $docEntity = $this->blobService->uploadBlob($files);
                try {
                    // $docEntity = $em->find("GeneralServicer\Entity\Document", $res);
                    $claimsEntity = $em->find("Claims\Entity\CLaims", $claimsId);

                    $claimsEntity->addClaimsDoc($docEntity)->setUpdatedOn(new \DateTime());

                    $em->persist($docEntity);
                    $em->persist($claimsEntity);
                    $em->flush();

                    $gritter->setTitle("Success");
                    $gritter->setText("Success: Uploaded document");
                    $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);
                    $gritter->setType(GritterMessage::TYPE_SUCCESS);

                    // $gritter->set

                    $response->add($gritter);
                } catch (\Exception $e) {
                    var_dump($e->getMessage());
                    $gritter->setType(GritterMessage::TYPE_ERROR);
                    $gritter->setTitle("Error");
                    $gritter->setText("Error: Problem uploading documents");
                    $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);

                    $response->add($gritter);
                }
            }
        }
        return $this->getResponse()->setContent($response);
    }

    // End ajax call
    public function indexAction()
    {
        $claimsForm = $this->claimsForm;
        $view = new ViewModel(array(
            'claimsForm' => $claimsForm
        ));
        return $view;
    }

    public function allAction()
    {
        $em = $this->entityManager;
        $claimsService = $this->claimsService;
        $unSettledClaims = $claimsService->getUnsettledClaims();
        $view = new ViewModel(array(
            "unsettledClaims" => $unSettledClaims
        ));
        return $view;
    }

    public function claimAction()
    {
        $em = $this->entityManager;

        $claimsForm = $this->claimsMotorForm;
        // var_dump($claimsForm);

        $request = $this->getRequest();
        if ($request->isPost()) {
            $post = $request->getPost();
            $claimsForm->setData($post);
            if ($claimsForm->isValid()) {
                var_dump("Valid");
            } else {
                var_dump("NOt Valid");
            }
        }
        $view = new ViewModel(array(
            "form" => $claimsForm
        ));
        return $view;
    }

    public function preProcessAction()
    {
        $em = $this->entityManager;
        $response = new Response();
        $claimsSession = $this->brokerClaimsSession;
        // $pusher = new Pusher
        $claimsId = $this->params()->fromQuery("data", NULL);
        /**
         *
         * @var CLaims $claimsEntity
         */
        $claimsEntity = $em->find("Claims\Entity\CLaims", $claimsId);
        if ($claimsEntity->getClaimStatus()->getId() == ClaimsService::CLAIMS_STATUS_COMPLETED) {
            $claimsEntity->setClaimStatus($em->find("Claims\Entity\ClaimStatus", ClaimsService::CLAIMS_STATUS_PROCESSING))
                ->setClaimsProcessingDate(new \DateTime());

            // $this->getEventManager()->trigger($event) trigger an event to notify the processing has begun
        }

        try {
            $em->persist($claimsEntity);
            $em->flush();
            $claimsSession->claimsId = $claimsEntity->getId();
            // $this->flashmessenger()->addSuccessMessage("");

            $redirect = new Redirect($this->url()->fromRoute("claims/default", array(
                "action" => "process"
            )));

            $response->add($redirect);
        } catch (\Exception $e) {

            $this->flashmessenger()->addErrorMessage("There was a problem processing this claim");
            $redirect = new Redirect($this->url()->fromRoute("claims/default", array(
                "action" => "all"
            )));

            $response->add($redirect);
        }
        return $this->getResponse()->setContent($response);
    }

    /**
     * This function reminds the customer of his unfinalized claims
     *
     * @return mixed
     */
    public function remindAction()
    {
        $em = $this->entityManager;
        // $mailService = $this->mailService;
        $generalService = $this->generalService;
        $response = new Response();
        $centralBrokerId = $this->generalService->getCentralBroker();
        $id = $this->params()->fromQuery("data", NULL);
        $gritter = new GritterMessage();
        if ($id == NULL) {
            $gritter->setText("Error : Absent identifier");
            $gritter->setTitle("Error");
            $gritter->setType(GritterMessage::TYPE_ERROR);
            $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);

            $response->add($gritter);

            ; // $this->flashmessenger()->addErrorMessage("No identifier available for this claims");
              // $this->redirect()->toRoute("claims/default", array(
              // "action" => "all"
              // ));
        } else {
            $claimsEnitty = $em->find("Claims\Entity\CLaims", $id);
            $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $centralBrokerId);

            $imapLogo = $this->url()->fromRoute('welcome', array(), array(
                'force_canonical' => true
            )) . "/images/logow.png";

            /**
             * We are waiting for you to complete your claim form
             * So we can begin processing your claims as soon as possible
             * please note the earleir you coplete this claims details the earlier we finalize your claims
             * Claims Details
             * ClaimsTopic
             * ClaimsUid
             * Claims dAte Created
             *
             * ClaimsPolicy Name
             * Claims Policy UID
             */

            $customerEntity = $claimsEnitty->getPolicy()
                ->getCoverNote()
                ->getCustomer();
            $pointer["to"] = $customerEntity->getUser()->getEmail();
            $pointer['subject'] = "Incomplete Claims Details";
            $pointer['fromName'] = $brokerEntity->getCompanyName();

            $template["template"] = "general_claims_remind_customer";
            $template["var"] = array(
                "logo" => GeneralService::getBrokerogoStatic($brokerEntity),
                // "claimsName" => $claimsEnitty->get,
                "claimsTopic" => $claimsEnitty->getClaimTopic(),
                "policy" => $claimsEnitty->getPolicy()
            );

            // Begin Mail
            try {

                $generalService->sendMails($pointer, $template);
                // $mailService->send();
                // $this->flashmessenger()->addSuccessMessage("notification successfuly delivered to customer");
                // $this->redirect()->toRoute("claims/default", array(
                // "action" => "all"
                $gritter->setTitle("Success");
                $gritter->setType(GritterMessage::TYPE_SUCCESS);
                $gritter->setText("Successfully reminded customer");
                $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);

                $response->add($gritter);
                // ));
            } catch (\Exception $e) {
                $gritter->setText("Error : Notification error");
                $gritter->setTitle("Error");
                $gritter->setType(GritterMessage::TYPE_ERROR);
                $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);

                $response->add($gritter);
            }
        }
        return $this->getResponse()->setContent($response);
    }

    public function processAction()
    {
        $em = $this->entityManager;
        $claimsForm = $this->claimsForm;
        $dropzoneForm = $this->dropZoneForm;
        $dropzoneForm->setAttributes(array(
            // "id" => "simpleForm",
            // "class" => "ajax_element",
            "action" => $this->url()
                ->fromRoute("claims/default", array(
                "action" => "uploaddoc"
            ))
        ));
        $commentForm = $this->commentForm;
        $commentForm->setAttributes(array(
            "id" => "simpleForm",
            "class" => "form-horizontal form-label-left ajax_element",
            "data-ajax-loader" => "commentajax",
            "action" => $this->url()
                ->fromRoute("claims/default", array(
                "action" => "commentajax"
            ))
        ));

        $brokerClaimsSession = $this->brokerClaimsSession;
        $claimsId = $brokerClaimsSession->claimsId;
        $claimsEntity = $em->find("Claims\Entity\CLaims", $claimsId);
        $view = new ViewModel(array(
            "claimsEntity" => $claimsEntity,
            "commentForm" => $commentForm,
            "dropZoneForm" => $this->dropZoneForm
        ));
        return $view;
    }

    public function viewAction()
    {
        $view = new ViewModel();
    }

    /**
     * This action views all claims available by the company
     *
     * @return \Zend\View\Model\ViewModel
     */
    public function allBrokerAction()
    {
        $claims = $this->getBrokerClaims();
        $view = new ViewModel(array(
            'claims' => $claims
        ));
        return $view;
    }

    private function getBrokerClaims()
    {
        $generalService = $this->generalService;
        $em = $generalService->getEntityManager();
        $criteria = array(
            'broker' => $this->brokerAdminstratorLogic()
        );
        $order = array(
            'id' => 'DESC'
        );
        $limit = 50;
        $data = $em->getRepository('Claims\Entity\ClaimsBroker')->findBy($criteria, $order, $limit);
        return $data;
    }

    public function setGeneralService($service)
    {
        $this->generalService = $service;
        return $this;
    }

    public function setClaimsForm($form)
    {
        $this->claimsForm = $form;
        return $this;
    }

    public function setClaimsService($xserv)
    {
        $this->claimsService = $xserv;
        return $this;
    }

    public function setBrokerClaimsSession($sess)
    {
        $this->brokerClaimsSession = $sess;
        return $this;
    }

    public function setMailsService($xserv)
    {
        $this->mailService = $xserv;
        return $this;
    }

    /**
     *
     * @param mixed $entityManager
     */
    public function setEntityManager($entityManager)
    {
        $this->entityManager = $entityManager;
        return $this;
    }

    public function setClaimsMotorForm($form)
    {
        $this->claimsMotorForm = $form;
        return $this;
    }

    public function setCommentForm($form)
    {
        $this->commentForm = $form;
        return $this;
    }

    /**
     *
     * @param mixed $dropZoneForm
     */
    public function setDropZoneForm($dropZoneForm)
    {
        $this->dropZoneForm = $dropZoneForm;
        return $this;
    }

    /**
     *
     * @param mixed $renderer
     */
    public function setRenderer($renderer)
    {
        $this->renderer = $renderer;
        return $this;
    }

    public function setBlobService($blobService)
    {
        $this->blobService = $blobService;
        return $this;
    }

    public function setLocator($locator)
    {
        $this->locator = $locator;
        return $this;
    }

    /**
     *
     * @param mixed $claimsExportForm
     */
    public function setClaimsExportForm($claimsExportForm)
    {
        $this->claimsExportForm = $claimsExportForm;
        return $this;
    }

    /**
     *
     * @param mixed $claimsApprovedForm
     */
    public function setClaimsApprovedForm($claimsApprovedForm)
    {
        $this->claimsApprovedForm = $claimsApprovedForm;
        return $this;
    }

    /**
     *
     * @param mixed $claimsRejectedForm
     */
    public function setClaimsRejectedForm($claimsRejectedForm)
    {
        $this->claimsRejectedForm = $claimsRejectedForm;
        return $this;
    }
}
