<?php
namespace Customer\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use GeneralServicer\Service\GeneralService;
use Zend\Mvc\Controller\Plugin\FlashMessenger;
use WasabiLib\Ajax\Response;
use WasabiLib\Ajax\GritterMessage;
use WasabiLib\Modal\WasabiModal;
use WasabiLib\Modal\WasabiModalView;
use WasabiLib\Modal\WasabiModalConfigurator;
use IMServices\Service\IMService;
use Claims\Service\ClaimsService;
use Policy\Service\CoverNoteService;
use GeneralServicer\Service\CurrencyService;
use Claims\Entity\ClaimsMotorAccident;
use Claims\Entity\CLaims;
use WasabiLib\Ajax\Redirect;
use Claims\Entity\ClaimsDriverDetails;
use Assetic\Filter\DartFilter;
use Claims\Entity\ClaimsCashInTransit;
use Claims\Entity\ClaimsGit;
use Claims\Entity\ClaimsBuglary;
use Claims\Entity\ClaimsFidelityGuaratee;
use Claims\Entity\ClaimsDefault;
use Comments\Entity\Comments;
use Comments\Service\CommentService;
use Claims\Entity\ClaimsContractAllRisk;
use Claims\Entity\ClaimsMarineCargo;
use Claims\Entity\ClaimsEmployersLiability;
use Claims\Entity\CLaimsFireLoss;
use Claims\Entity\ClaimsProfessionalindemnity;

// use Doctrine\ORM\Tools\Pagination\Paginator;
class ClaimsController extends AbstractActionController
{

    private $entityManager;

    private $claimsService;

    private $clientGeneralService;

    private $claimsForm;

    private $commentForm;

    private $dropZoneForm;

    private $blobService;

    private $customerBoardService;

    private $customerClaimsSession;

    private $renderer;

    // Begin Form initiation
    private $claismCashInTransitForm;

    private $claimsMotorForm;

    private $claimsDefaultForm;

    private $claimsGitForm;

    private $claimsBurglaryForm;

    private $claimsFidelityGuarateeForm;

    private $claimsContractorAllRiskForm;

    private $claimsMarineCargoForm;

    private $claimsFireLossForm;

    private $claimsEmployerLiabilityForm;

    private $claimsProfessionalindemnityForm;

    public function onDispatch(\Zend\Mvc\MvcEvent $e)
    {
        $response = parent::onDispatch($e);
        $this->customerRedirectPlugin()->totalRedirection();
        $this->layout()->setTemplate('client-layout-board');
        return $response;
    }

    // public function policymodalAction(){
    // $em = $this->entityManager;
    // $response = new Response();
    // $customerClaimsSession = $this->customerClaimsSession;
    // $claimsId = $customerClaimsSession->claimsId ;
    // $gritter = new GritterMessage();
    // if($claimsId == NULL){
    // $gritter->setTitle("Error");
    // $gritter->setText("Error: Absent Identifier");
    // $gritter->setType(GritterMessage::TYPE_ERROR);
    // $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);

    // $response->add($gritter);
    // }else{
    // $claimsEntity = $em->find("Claims\Entity\CLaims", $claimsId);
    // $modal = new WasabiModal("standard", "Policy Details");
    // $viewModel = new ViewModel(array(
    // "policyEntity"=>$claimsEntity->getPolicy()
    // ));
    // $viewModel->setTemplate("policy-modal-policy-certificate-modal");
    // $modal->setContent($viewModel);

    // $modalView = new WasabiModalView("#wasabi", $this->renderer, $modal);

    // $response->add($modalView);
    // }

    // return $this->getResponse()->setContent($response);
    // }
    public function indexAction()
    {
        $customerClaimsSession = $this->customerClaimsSession;
        $customerClaimsSession->getManager()
            ->getStorage()
            ->clear('CustomerClaimsSession');

        $em = $this->entityManager;
        $customerBoardService = $this->customerBoardService;

        $unsettledClaims = $customerBoardService->customerClaims();

        // $unsettledClaimses = new Paginator($unsettledClaims);
        $view = new ViewModel(array(
            "unsettleClaims" => $unsettledClaims
        ));
        return $view;
    }

    public function initiateAction()
    {
        $this->flashmessenger()->addMessage("Please click the 'PRESS TO LAY CLAIM' red button to begin your claims processing");

        $this->redirect()->toRoute("board");
        return $this->getResponse()->setContent(NULL);
    }

    public function preLayAction()
    {
        $id = $this->params()->fromRoute("id", NULL); // claims UID
        $em = $this->entityManager;
        if ($id == NULL) {
            $this->flashmessenger()->addErrorMessage("No Identitfier for this claims");
            $this->redirect()->toRoute("cus_claims/default", array(
                "action" => "index"
            ));
        }
        $claimsEntity = $em->getRepository("Claims\Entity\CLaims")->findOneBy(array(
            "claimUid" => $id
        ));
        $customerClaimsSession = $this->customerClaimsSession;
        $customerClaimsSession->claimsId = $claimsEntity->getId();
        if ($customerClaimsSession->claimsId == NULL) {
            $this->flashmessenger()->addErrorMessage("We could not retrieve the claims session");
            $this->redirect()->toRoute("cus_claims/default", array(
                "action" => "index"
            ));
        }
        $this->redirect()->toRoute("cus_claims/default", array(
            "action" => "lay"
        ));
        return $this->getResponse()->setContent(NULL);
    }

    public function commentajaxAction()
    {
        $em = $this->entityManager;
        $response = new Response();
        $customerClaimsSession = $this->customerClaimsSession;
        $claimsId = $customerClaimsSession->claimsId;
        $gritter = new GritterMessage();
        if ($claimsId == NULL) {
            $gritter->setTitle("Error");
            $gritter->setText("Error: Absent Identifier");
            $gritter->setType(GritterMessage::TYPE_ERROR);
            $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);

            $response->add($gritter);
        } else {
            $claimsEntity = $em->find("Claims\Entity\CLaims", $claimsId);
            $commentForm = $this->commentForm;
            $request = $this->getRequest();
            $commentEntity = new Comments();
            if ($request->isPost()) {
                $post = $request->getPost();

                $commentForm->setData($post);
                if ($commentForm->isValid()) {
                    $data = $commentForm->getData();
                    $commentEntity->setCreatedOn(new \DateTime())
                        ->setBroker($em->find("Users\Entity\InsuranceBrokerRegistered", $this->clientGeneralService->getBrokerId()))
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

                    try {
                        $em->persist($commentEntity);

                        $em->flush();

                        /**
                         * Send mail to broker
                         */
                        $gritter->setTitle("Success");
                        $gritter->setText("Successfully posted comment");
                        $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);
                        $gritter->setType(GritterMessage::TYPE_SUCCESS);

                        $this->flashMessenger()->addSuccessMessage("Successfully posted comment");
                        $response->add($gritter);

                        $redirect = new Redirect($this->url()->fromRoute("cus_claims/default", array(
                            "action" => "board"
                        )));

                        $response->add($redirect);
                    } catch (\Exception $e) {
                        $gritter->setTitle("Error");
                        $gritter->setText("Error: Comment Hydration error");
                        $gritter->setType(GritterMessage::TYPE_ERROR);
                        $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);

                        $response->add($gritter);
                    }
                }
            }
        }

        return $this->getResponse()->setContent($response);
    }

    /**
     * This uploads all documents of occurence of accident
     *
     * @return mixed
     */
    public function uploadevdropzoneAction()
    {
        $em = $this->entityManager;
        $response = new Response();
        $customerClaimsSession = $this->customerClaimsSession;
        $claimsId = $customerClaimsSession->claimsId;
        $clientBlobService = $this->blobService;
        $clientBlobService->setCentralBrokerUid($this->clientGeneralService->getBrokerUid());
        $claimsEntity = $em->find("Claims\Entity\CLaims", $claimsId);
        // $blobService = $this->blobService;
        $request = $this->getRequest();

        if ($request->isPost() || $request->isXmlHttpRequest()) {
            $files = $this->params()->fromFiles('file');

            $res = $clientBlobService->uploadBlob($files);

            if ($res != False) {
                try {
                    $claimsEntity->addClaimsDoc($res)->setUpdatedOn(new \DateTime());

                    $em->persist($claimsEntity);
                    $em->persist($res);
                    $em->flush();
                } catch (\Exception $e) {}
            }
        }

        // $response = new Response();
        return $this->getResponse()->setContent(NULL);
    }

    public function preBoardAction()
    {
        $response = new Response();
        $em = $this->entityManager;
        $uid = $this->params()->fromQuery("data", NULL);
        $gritter = new GritterMessage();
        if ($uid == NULL) {
            $gritter->setTitle("Error");
            $gritter->setText("Error: Absent unique identifier");
            $gritter->setType(GritterMessage::TYPE_ERROR);
            $gritter->setPosition(GritterMessage::POSITION_BOTTOM_RIGHT);

            $response->add($gritter);
        } else {
            $claimsEntity = $em->getRepository("Claims\Entity\CLaims")->findOneby(array(
                "claimUid" => $uid
            ));

            $customerClaimsSession = $this->customerClaimsSession;
            $customerClaimsSession->claimsId = $claimsEntity->getId();
            $redirect = new Redirect($this->url()->fromRoute("cus_claims/default", array(
                "action" => "board"
            )));

            $response->add($redirect);
        }
        return $this->getResponse()->setContent($response);
    }

    /**
     * This is the board for the claims showing information abouut thie specific claims
     *
     * @return \Zend\View\Model\ViewModel
     */
    public function boardAction()
    {
        $em = $this->entityManager;
        $dropZoneForm = $this->dropZoneForm;
        $commentForm = $this->commentForm;
        $dropZoneForm->setAttributes(array(
            "action" => $this->url()
                ->fromRoute("cus_claims/default", array(
                "action" => "uploadevdropzone"
            ))
        ));

        $commentForm->setAttributes(array(
            "id" => "simpleForm",
            "class" => "form-horizontal form-label-left ajax_element",
            "data-ajax-loader" => "commentajax",
            "action" => $this->url()
                ->fromRoute("cus_claims/default", array(
                "action" => "commentajax"
            ))
        ));

        $customerClaimsSession = $this->customerClaimsSession;
        $id = $customerClaimsSession->claimsId;
        if ($id == NULL) {
            $this->flashMessenger()->addErrorMessage("Absent Identifier");
            $this->redirect()->toRoute("cus_claims/default", array(
                "action" => "index"
            ));
        } else {
            $claimsEntity = $em->find("Claims\Entity\CLaims", $id);
            $view = new ViewModel(array(
                "claimsEntity" => $claimsEntity,
                "dropZoneForm" => $dropZoneForm,
                "commentForm" => $commentForm
            ));
        }

        return $view;
    }

    public function layAction()
    {
        $em = $this->entityManager;
        $dropZoneForm = $this->dropZoneForm;
        $response = new Response();
        $gritter = new GritterMessage();
        $dropZoneForm->setAttributes(array(
            "action" => $this->url()
                ->fromRoute("cus_claims/default", array(
                "action" => "uploadevdropzone"
            ))
        ));
        $claimsForm = NULL;

        $customerClaimsSession = $this->customerClaimsSession;

        $claimsId = $customerClaimsSession->claimsId;
        if ($claimsId == NULL) {
            return $this->redirect()->toRoute("cus_claims/default", array(
                "action" => "index"
            ));
        }

        $claimsEntity = $em->find("Claims\Entity\CLaims", $claimsId);
        $coverNoteEntity = $claimsEntity->getPolicy()->getCoverNote();
        $specificServiceId = $this->clientGeneralService->getGeneralService()->getSpecificServiceTypeId($coverNoteEntity);

        switch ($specificServiceId) {
            // case IMService::IM_SPECIFIC_SERVICE_AVIATION_INSURANCE:
            // break;

            // case IMService::IM_SPECIFIC_SERVICE_ADVANCE_PAYMENT_BOND:
            // break;

            // case IMService::IM_SPECIFIC_SERVICE_AGRIC_CROP:
            // break;

            // case IMService::IM_SPECIFIC_SERVICE_AGRIC_GENERAL:
            // break;

            // case IMService::IM_SPECIFIC_SERVICE_AGRIC_LIVESTOCK:
            // break;

            // case IMService::IM_SPECIFIC_SERVICE_AGRIC_PROPERTY_PRODUCE:
            // break;

            // case IMService::IM_SPECIFIC_SERVICE_BOILER:
            // break;

            // case IMService::IM_SPECIFIC_SERVICE_BUILDERS_LIABILITY:
            // break;

            case IMService::IM_SPECIFIC_SERVICE_BURGLARY_HOUSE_BREAKING:

                $claimsForm = $this->claimsBurglaryForm;
                $claimsBurglaryEntity = new ClaimsBuglary();
                $claimsBurglaryEntity->setClaims($claimsEntity);

                $claimsForm->bind($claimsBurglaryEntity);
                break;

            // case IMService::IM_SPECIFIC_SERVICE_CASH_BOND:
            // break;

            // case IMService::IM_SPECIFIC_SERVICE_CASH_IN_SAFE:
            // //
            // break;

            case IMService::IM_SPECIFIC_SERVICE_CASH_IN_TRANSIT:
                $claimsForm = $this->claismCashInTransitForm;
                // var_dump($claimsForm);
                $claimsCashInTransitEntity = new ClaimsCashInTransit();

                $claimsCashInTransitEntity->setClaims($claimsEntity);
                $claimsForm->bind($claimsCashInTransitEntity);
                break;

            // case IMService::IM_SPECIFIC_SERVICE_CASH_IN_TRANSIT:
            // break;

            // case IMService::IM_SPECIFIC_SERVICE_CONSEQUENTIAL_LOSS:
            // break;

            case IMService::IM_SPECIFIC_SERVICE_CONTRACT_ALL_RISK:
            case IMService::IM_SPECIFIC_SERVICE_CONTRACT_RISK_MATERIAL_DAMAGE:
            case IMService::IM_SPECIFIC_SERVICE_CONTRACT_RISK_THIRD_PARTY_LIABILITY:

                $claimsForm = $this->claimsContractorAllRiskForm;
                $claimsContractorAllRiskEntity = new ClaimsContractAllRisk();
                $claimsContractorAllRiskEntity->setClaims($claimsEntity);
                $claimsForm->bind($claimsContractorAllRiskEntity);
                break;

            // case IMService::IM_SPECIFIC_SERVICE_CONTRACT_RISK_THIRD_PARTY_LIABILITY:
            // break;

            case IMService::IM_SPECIFIC_SERVICE_EMPLOYERS_LIABILITY:
                $claimsForm = $this->claimsEmployerLiabilityForm;

                $claimsEmployerLiabilityEntity = new ClaimsEmployersLiability();
                $claimsEmployerLiabilityEntity->setClaims($claimsEntity);
                $claimsForm->bind($claimsEmployerLiabilityEntity);
                break;

            case IMService::IM_SPECIFIC_SERVICE_FIRE_PERIL:
                $claimsForm = $this->claimsFireLossForm;
                $claimsFireLossEntity = new CLaimsFireLoss();
                $claimsFireLossEntity->setClaims($claimsEntity);
                $claimsForm->bind($claimsFireLossEntity);
                break;

            case IMService::IM_SPECIFIC_SERVICE_FIDELITY_GUARATEE:

                $claimsForm = $this->claimsFidelityGuarateeForm;
                $claimsFidelityGuarateeEntity = new ClaimsFidelityGuaratee();
                $claimsFidelityGuarateeEntity->setClaims($claimsEntity);
                $claimsForm->bind($claimsFidelityGuarateeEntity);
                break;

            case IMService::IM_SPECIFIC_SERVICE_GIT_ALL_RISK:
            case IMService::IM_SPECIFIC_SERVICE_GIT_RESTRICTED_COVER:
                $claimsForm = $this->claimsGitForm;
                $claimsGitEntity = new ClaimsGit();
                $claimsGitEntity->setClaims($claimsEntity);
                $claimsForm->bind($claimsGitEntity);

                break;

            case IMService::IM_SPECIFIC_SERVICE_MARINE_CARGO_ICC_A:
            case IMService::IM_SPECIFIC_SERVICE_MARINE_CARGO_ICC_B:
            case IMService::IM_SPECIFIC_SERVICE_MARINE_CARGO_ICC_C:
                $claimsForm = $this->claimsMarineCargoForm;
                $claimsMarineCargoEntity = new ClaimsMarineCargo();
                $claimsMarineCargoEntity->setClaims($claimsEntity);
                $claimsForm->bind($claimsMarineCargoEntity);
                break;
            case IMService::IM_SPECIFIC_SERVICE_MOTOR_COMPREHENSIVE_MOTOR:
            case IMService::IM_SPECIFIC_SERVICE_MOTOR_THIRD_PARTY_FIRE_THEFT:
            case IMService::IM_SPECIFIC_SERVICE_MOTOR_THIRD_PARTY_MOTOR:

                $claimsMotorEntity = new ClaimsMotorAccident();
                $claimsForm = $this->claimsMotorForm;
                $claimsMotorEntity->setClaims($claimsEntity);
                $claimsForm->bind($claimsMotorEntity);

                break;

            case IMService::IM_SPECIFIC_SERVICE_PROFESSIONAL_INDEMNTY:

                $claimsProfessionalIndemnityEntity = new ClaimsProfessionalindemnity();
                $claimsForm = $this->claimsProfessionalindemnityForm;
                $claimsProfessionalIndemnityEntity->setClaims($claimsEntity);

                $claimsForm->bind($claimsProfessionalIndemnityEntity);
                break;

            default:

                $claimsForm = $this->claimsDefaultForm;
                $claimsDefaultEntity = new ClaimsDefault();
                $claimsDefaultEntity->setClaims($claimsEntity);
                $claimsForm->bind($claimsDefaultEntity);
                break;
        }

        $claimsForm->setAttributes(array(
            "method" => "POST",
            "id" => "simpleForm",
            "data-ajax-loader" => "myLoader",
            "class" => "ajax_element form-horizontal form-label-left",
            "action" => $this->url()
                ->fromRoute("cus_claims/default", array(
                "action" => "lay"
            ))
        ));
        // var_dump($claimsForm);

        // $coverNoteEntity->getCoverCategory()->getId();
        // $claimsFieldset = $claimsForm->get("claimsFeildset");

        // $claimsForm->bind($claimsEntity);
        $gritter = new GritterMessage();
        $request = $this->getRequest();
        if ($request->isPost()) {
            // var_dump($claimsFieldset->get("claimsMotor"));
            $post = $request->getPost();
            $claimsForm->setData($post);

            if ($claimsForm->isValid()) {
                // $serviceId = CoverNoteService::getServiceTypeId($covernoteEntity);

                $data = $claimsForm->getData();

                $serviceId = CoverNoteService::getSpecificTypeId($claimsEntity->getPolicy()->getCoverNote());

                switch ($serviceId) {

                    case IMService::IM_SPECIFIC_SERVICE_BURGLARY_HOUSE_BREAKING:

                        $claimsBurglaryEntity->setClaims($claimsEntity)
                            ->setCreatedOn(new \DateTime())
                            ->setDatePoliceNotify($data->getDatePoliceNotify())
                            ->setDateTheftDiscovered($data->getDateTheftDiscovered())
                            ->setTheftDate($data->getTheftDate());

                        $claimsEntity->setUpdatedOn(new \DateTime())
                            ->setClaimsCompletedDate(new \DateTime())
                            ->setClaimStatus($em->find("Claims\Entity\ClaimStatus", ClaimsService::CLAIMS_STATUS_COMPLETED));

                        $em->persist($claimsBurglaryEntity);
                        $em->persist($claimsEntity);
                        $em->flush();

                        $gritter->setTitle("Succes");
                        $gritter->setText("Successfully completed claims form");
                        $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);
                        $gritter->setType(GritterMessage::TYPE_SUCCESS);
                        // $cleanRepairEstimate = CurrencyService::cleanInputValueStatic($data->getRepairEstimate());
                        $response->add($gritter);

                        /*
                         * Send mail to broker
                         * Log Notification
                         */

                        $redirect = new Redirect($this->url()->fromRoute("cus_claims/default", array(
                            "action" => "board"
                        )));

                        $response->add($redirect);
                        return $this->getResponse()->setContent($response);
                        break;

                    case IMService::IM_SPECIFIC_SERVICE_CASH_IN_TRANSIT:
                        try {
                            $claimsCashInTransitEntity->setClaims($claimsEntity)->setEmployeeSalary(CurrencyService::cleanInputValueStatic($data->getEmployeeSalary()));

                            $claimsEntity->setUpdatedOn(new \DateTime())
                                ->setClaimsCompletedDate(new \DateTime())
                                ->setClaimStatus($em->find("Claims\Entity\ClaimStatus", ClaimsService::CLAIMS_STATUS_COMPLETED));

                            $em->persist($claimsCashInTransitEntity);
                            $em->persist($claimsEntity);
                            $em->flush();

                            $gritter->setTitle("Succes");
                            $gritter->setText("Successfully completed claims form");
                            $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);
                            $gritter->setType(GritterMessage::TYPE_SUCCESS);
                            // $cleanRepairEstimate = CurrencyService::cleanInputValueStatic($data->getRepairEstimate());
                            $response->add($gritter);

                            /*
                             * Send mail to broker
                             * Log Notification
                             */

                            $redirect = new Redirect($this->url()->fromRoute("cus_claims/default", array(
                                "action" => "board"
                            )));

                            $response->add($redirect);
                            return $this->getResponse()->setContent($response);
                        } catch (\Exception $e) {
                            $gritter->setTitle("Error");
                            $gritter->setText("Error: Hydration Error");
                            $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);
                            $gritter->setType(GritterMessage::TYPE_ERROR);

                            $response->add($gritter);
                        }
                        break;

                    case IMService::IM_SPECIFIC_SERVICE_CONTRACT_ALL_RISK:
                    case IMService::IM_SPECIFIC_SERVICE_CONTRACT_RISK_MATERIAL_DAMAGE:
                    case IMService::IM_SPECIFIC_SERVICE_CONTRACT_RISK_THIRD_PARTY_LIABILITY:
                        $claimsEntity->setUpdatedOn(new \DateTime())
                            ->setClaimsCompletedDate(new \DateTime())
                            ->setClaimStatus($em->find("Claims\Entity\ClaimStatus", ClaimsService::CLAIMS_STATUS_COMPLETED));

                        $claimsContractorAllRiskEntity->setClaims($claimsEntity);

                        try {
                            $em->persist($claimsContractorAllRiskEntity);
                            $em->persist($claimsEntity);
                        } catch (\Exception $e) {
                            $gritter->setTitle("Error");
                            $gritter->setText("Error completing claims details");
                            $gritter->setType(GritterMessage::TYPE_ERROR);
                            $gritter->setSticky(TRUE);

                            $response->add($gritter);
                            return $this->getResponse()->setContent($response);
                        }
                        break;

                    case IMService::IM_SPECIFIC_SERVICE_EMPLOYERS_LIABILITY:
                        $claimsEntity->setUpdatedOn(new \DateTime())
                            ->setClaimsCompletedDate(new \DateTime())
                            ->setClaimStatus($em->find("Claims\Entity\ClaimStatus", ClaimsService::CLAIMS_STATUS_COMPLETED));

                        $claimsEmployerLiabilityEntity->setClaims($claimsEntity);
                        try {

                            $em->persist($claimsEntity);
                            $em->persist($claimsEmployerLiabilityEntity);

                            $em->flush();
                            $gritter = new GritterMessage();
                            $gritter->setTitle("Succes");
                            $gritter->setText("Successfully completed claims form");
                            $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);
                            $gritter->setType(GritterMessage::TYPE_SUCCESS);
                            // $cleanRepairEstimate = CurrencyService::cleanInputValueStatic($data->getRepairEstimate());
                            $response->add($gritter);

                            /*
                             * Send mail to broker
                             * Log Notification
                             */

                            $redirect = new Redirect($this->url()->fromRoute("cus_claims/default", array(
                                "action" => "board"
                            )));

                            $response->add($redirect);
                            return $this->getResponse()->setContent($response);
                        } catch (\Exception $e) {
                            // var_dump();
                            $gritter->setTitle("Error");
                            $gritter->setText("Error completing claims details");
                            $gritter->setType(GritterMessage::TYPE_ERROR);
                            $gritter->setSticky(TRUE);

                            $response->add($gritter);
                            return $this->getResponse()->setContent($response);
                        }
                        break;

                    case IMService::IM_SPECIFIC_SERVICE_FIDELITY_GUARATEE:
                        // $claimsFidelityGuaranteeForm = $this->claimsFidelityGuarateeForm;
                        $claimsEntity->setUpdatedOn(new \DateTime())
                            ->setClaimsCompletedDate(new \DateTime())
                            ->setClaimStatus($em->find("Claims\Entity\ClaimStatus", ClaimsService::CLAIMS_STATUS_COMPLETED));

                        $claimsFidelityGuarateeEntity->setClaims($claimsEntity)
                            ->setDefaultersName($data->getDefaultersName())
                            ->setDefaultAmount(CurrencyService::cleanInputValueStatic($data->getDefaultAmount()))
                            ->setDefaultDescovery($data->getDefaultDescovery())
                            ->setDefaultDurationExplanation($data->getDefaultDurationExplanation());

                        try {
                            $em->persist($claimsEntity);
                            $em->persist($claimsFidelityGuarateeEntity);

                            $em->flush();

                            $gritter->setTitle("Success");
                            $gritter->setText("Successfully Completed  Claims");
                            $gritter->setType(GritterMessage::TYPE_SUCCESS);

                            $response->add($gritter);

                            /*
                             * Send mail to broker
                             * Log Notification
                             */

                            $redirect = new Redirect($this->url()->fromRoute("cus_claims/default", array(
                                "action" => "board"
                            )));

                            $response->add($redirect);
                            return $this->getResponse()->setContent($response);
                        } catch (\Exception $e) {
                            $gritter->setTitle("Error");
                            $gritter->setText("Error completing claims details");
                            $gritter->setType(GritterMessage::TYPE_ERROR);
                            $gritter->setSticky(TRUE);

                            $response->add($gritter);
                            return $this->getResponse()->setContent($response);
                        }
                        break;

                    case IMService::IM_SPECIFIC_SERVICE_FIRE_PERIL:
                        $claimsEntity->setUpdatedOn(new \DateTime())
                            ->setClaimsCompletedDate(new \DateTime())
                            ->setClaimStatus($em->find("Claims\Entity\ClaimStatus", ClaimsService::CLAIMS_STATUS_COMPLETED));
                        // TODO if fireloss List is greater than one persist
                        $claimsFireLossEntity->setEstimatedLoss(CurrencyService::cleanInputValueStatic($data->getEstimatedLoss()));
                        try {
                            $em->persist($claimsEntity);
                            $em->persist($claimsFireLossEntity);

                            $em->flush();

                            $gritter->setTitle("Success");
                            $gritter->setText("Successfully Completed  Claims");
                            $gritter->setType(GritterMessage::TYPE_SUCCESS);
                            $gritter->setSticky(TRUE);
                            $response->add($gritter);

                            /*
                             * Send mail to broker
                             * Log Notification
                             */

                            $redirect = new Redirect($this->url()->fromRoute("cus_claims/default", array(
                                "action" => "board"
                            )));

                            $response->add($redirect);
                            return $this->getResponse()->setContent($response);
                        } catch (\Exception $e) {
                            $gritter->setTitle("Error");
                            $gritter->setText("Error completing claims details");
                            $gritter->setType(GritterMessage::TYPE_ERROR);
                            $gritter->setSticky(TRUE);

                            $response->add($gritter);
                            return $this->getResponse()->setContent($response);
                        }
                        break;

                    case IMService::IM_SPECIFIC_SERVICE_GIT_ALL_RISK:
                    case IMService::IM_SPECIFIC_SERVICE_GIT_RESTRICTED_COVER:

                        $claimsForm = $this->claimsGitForm;
                        $claimsGitEntity->setClaims($claimsEntity)->setGoodsTotalValue(CurrencyService::cleanInputValueStatic($data->getGoodsTotalValue()));

                        try {

                            $claimsEntity->setUpdatedOn(new \DateTime())
                                ->setClaimsCompletedDate(new \DateTime())
                                ->setClaimStatus($em->find("Claims\Entity\ClaimStatus", ClaimsService::CLAIMS_STATUS_COMPLETED));

                            $em->persist($claimsGitEntity);
                            $em->persist($claimsEntity);
                            $em->flush();

                            $gritter->setTitle("Succes");
                            $gritter->setText("Successfully completed claims form");
                            $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);
                            $gritter->setType(GritterMessage::TYPE_SUCCESS);
                            // $cleanRepairEstimate = CurrencyService::cleanInputValueStatic($data->getRepairEstimate());
                            $response->add($gritter);

                            /*
                             * Send mail to broker
                             * Log Notification
                             */

                            $redirect = new Redirect($this->url()->fromRoute("cus_claims/default", array(
                                "action" => "board"
                            )));

                            $response->add($redirect);
                            return $this->getResponse()->setContent($response);
                        } catch (\Exception $e) {
                            $gritter->setTitle("Error");
                            $gritter->setText("Error: Hydration Error");
                            $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);
                            $gritter->setType(GritterMessage::TYPE_ERROR);

                            $response->add($gritter);
                            return $this->getResponse()->setContent($response);
                        }

                        break;

                    case IMService::IM_SPECIFIC_SERVICE_MARINE_CARGO_ICC_A:
                    case IMService::IM_SPECIFIC_SERVICE_MARINE_CARGO_ICC_B:
                    case IMService::IM_SPECIFIC_SERVICE_MARINE_CARGO_ICC_C:
                        $claimsEntity->setUpdatedOn(new \DateTime())
                            ->setClaimsCompletedDate(new \DateTime())
                            ->setClaimStatus($em->find("Claims\Entity\ClaimStatus", ClaimsService::CLAIMS_STATUS_COMPLETED));

                        try {

                            $em->persist($claimsEntity);
                            $em->persist($claimsMarineCargoEntity);

                            $em->flush();

                            $gritter->setTitle("Success");
                            $gritter->setText("Successfully Completed  Claims");
                            $gritter->setType(GritterMessage::TYPE_SUCCESS);

                            $response->add($gritter);

                            /*
                             * Send mail to broker
                             * Log Notification
                             */

                            $redirect = new Redirect($this->url()->fromRoute("cus_claims/default", array(
                                "action" => "board"
                            )));

                            $response->add($redirect);
                            return $this->getResponse()->setContent($response);
                        } catch (\Exception $e) {
                            $gritter->setTitle("Error");
                            $gritter->setText("Hydration Error");
                            $gritter->setType(GritterMessage::TYPE_ERROR);
                            $gritter->setSticky(TRUE);

                            $response->add($gritter);
                            return $this->getResponse()->setContent($response);
                        }

                        break;

                    case IMService::IM_SPECIFIC_SERVICE_MOTOR_COMPREHENSIVE_MOTOR:
                    case IMService::IM_SPECIFIC_SERVICE_MOTOR_THIRD_PARTY_FIRE_THEFT:
                    case IMService::IM_SPECIFIC_SERVICE_MOTOR_THIRD_PARTY_MOTOR:

                        // $claimsMotorEntity = new ClaimsMotorAccident();
                        $claimsForm = $this->claimsMotorForm;
                        $claimsMotorEntity->setClaims($claimsEntity);

                        try {
                            $driverDetailsEntity = new ClaimsDriverDetails();
                            $driverDetails = $data->getDriverDetails();
                            $driverDetailsEntity->setClaimsMotorAccident($claimsMotorEntity)
                                ->setDriverAge($driverDetails->getDriverAge())
                                ->setDriverName($driverDetails->getDriverName())
                                ->setLicenceExpireDate($driverDetails->getLicenceExpireDate())
                                ->setLicenceIssueDate($driverDetails->getLicenceIssueDate())
                                ->setDrivingLicenceNo($driverDetails->getDrivingLicenceNo());
                            $claimsMotorEntity->setCreatedOn(new \DateTime())
                                ->setRepairerName($data->getRepairerName())
                                ->setDriverDetails($driverDetailsEntity)
                                ->setMotorLocation($data->getMotorLocation())
                                ->
                            // ->setRepairerAddress($data->getRepairerAddress())
                            // ->setRepairerPhone($data->getRepairerPhone())
                            // ->setWitness1($data->getWitness1())
                            // ->setWitness1Address($data->getWitness1Address())
                            // ->setWitness1Phone($data->getWitness1Phone())
                            // ->setWitness2($data->getWitness2())
                            // ->setWitness2Address($data->getWitness2Address())
                            setDamageDetails($data->getDamageDetails())
                                ->setMotorLocation($data->getMotorLocation())
                                ->setRepairEstimate($data->getRepairEstimate());
                            // $claimsEntity = new CLaims();
                            $claimsEntity->setUpdatedOn(new \DateTime())
                                ->setClaimsCompletedDate(new \DateTime())
                                ->setClaimStatus($em->find("Claims\Entity\ClaimStatus", ClaimsService::CLAIMS_STATUS_COMPLETED));

                            $em->persist($claimsMotorEntity);
                            $em->persist($claimsEntity);
                            $em->flush();

                            $gritter->setTitle("Success");
                            $gritter->setText("Successfullt completed claims ");
                            $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);
                            $gritter->setType(GritterMessage::TYPE_SUCCESS);
                            // $cleanRepairEstimate = CurrencyService::cleanInputValueStatic($data->getRepairEstimate());
                            $response->add($gritter);

                            /*
                             * Send mail to broker
                             * Log Notification
                             */

                            $redirect = new Redirect($this->url()->fromRoute("cus_claims/default", array(
                                "action" => "board"
                            )));

                            $response->add($redirect);
                            return $this->getResponse()->setContent($response);
                        } catch (\Exception $e) {

                            $gritter->setTitle("Error");
                            $gritter->setText("Error: Hydration Error");
                            $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);
                            $gritter->setType(GritterMessage::TYPE_ERROR);

                            $response->add($gritter);

                            // return $this->getResponse()->setC
                        }
                        // var_dump($post);1
                        // var_dump("Validated");
                        // die(print_r($data->getRepairEstimate()));

                        // var_dump("DERT");
                        // var_dump($data);

                        break;

                    case IMService::IM_SPECIFIC_SERVICE_PROFESSIONAL_INDEMNTY:
                        $claimsForm = $this->claimsProfessionalindemnityForm;
                        $claimsEntity->setUpdatedOn(new \DateTime())
                            ->setClaimsCompletedDate(new \DateTime())
                            ->setClaimStatus($em->find("Claims\Entity\ClaimStatus", ClaimsService::CLAIMS_STATUS_COMPLETED));

                        $claimsProfessionalIndemnityEntity->setClaims($claimsEntity);

                        try {
                            $em->persist($claimsEntity);
                            $em->persist($claimsProfessionalIndemnityEntity);

                            $em->flush();

                            $gritter->setTitle("Success");
                            $gritter->setText("Successfully Completed  Claims");
                            $gritter->setType(GritterMessage::TYPE_SUCCESS);

                            $response->add($gritter);

                            /*
                             * Send mail to broker
                             * Log Notification
                             */

                            $redirect = new Redirect($this->url()->fromRoute("cus_claims/default", array(
                                "action" => "board"
                            )));

                            $response->add($redirect);
                            return $this->getResponse()->setContent($response);
                        } catch (\Exception $e) {
                            $gritter->setTitle("Error");
                            $gritter->setText("Error: Hydration error");
                            $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);
                            $gritter->setType(GritterMessage::TYPE_SUCCESS);

                            $response->add($gritter);
                            return $this->getResponse()->setContent($response);
                        }
                        break;

                    default:

                        $claimsForm = $this->claimsDefaultForm;
                        $claimsDefaultEntity->setClaims($claimsEntity);
                        try {
                            $claimsDefaultEntity->setCreatedOn(new \DateTime())->setEstimatedClaims(CurrencyService::cleanInputValueStatic($data->getEstimatedClaims()));

                            $claimsEntity->setUpdatedOn(new \DateTime())
                                ->setIsDefaultClaims(TRUE)
                                ->setClaimsCompletedDate(new \DateTime())
                                ->setClaimStatus($em->find("Claims\Entity\ClaimStatus", ClaimsService::CLAIMS_STATUS_COMPLETED));

                            $em->persist($claimsDefaultEntity);
                            $em->persist($claimsEntity);
                            $em->flush();

                            $gritter->setTitle("Success");
                            $gritter->setText("Successfult claims completion ");
                            $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);
                            $gritter->setType(GritterMessage::TYPE_SUCCESS);
                            // $cleanRepairEstimate = CurrencyService::cleanInputValueStatic($data->getRepairEstimate());
                            $response->add($gritter);

                            /*
                             * Send mail to broker
                             * Log Notification
                             */

                            $redirect = new Redirect($this->url()->fromRoute("cus_claims/default", array(
                                "action" => "board"
                            )));

                            $response->add($redirect);
                            return $this->getResponse()->setContent($response);
                        } catch (\Exception $e) {
                            $gritter->setTitle("Error");
                            $gritter->setText("Error: Hydration error");
                            $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);
                            $gritter->setType(GritterMessage::TYPE_SUCCESS);

                            $response->add($gritter);
                        }

                        // $
                        break;
                }
            } else {
                $gritter->setTitle("Error");
                $gritter->setText("Error: Validation error");
                $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);
                $gritter->setType(GritterMessage::TYPE_ERROR);

                $response->add($gritter);

                // die(print_r("No validation"));

                $this->flashMessenger()->addErrorMessage("Validation Error");
                // $this->redirect()->refresh();
                // return $this->getResponse()->setContent($response);

                // die()
            }
        }

        $view = new ViewModel(array(
            "claimsForm" => $claimsForm,
            "claimsEntity" => $claimsEntity,
            "dropZoneForm" => $dropZoneForm
        ));
        return $view;
    }

    private function claimsFormValidationCondition($claimsForm)
    {
        // if ($this->claimsService->claimsFormServiceType == GeneralService::INSURANCE_SERVICE_MOTOR) {
        $claimsForm->setValidationGroup(array(
            // "csrf",
            "claimsFeildset" => array(
                "claimTopic",
                "claimInfo",
                "claimsMotor" => array(
                    // "driverDetails" => array(
                    // // "claimsMotorAccident",
                    // "driverName",
                    // "driverAge",
                    // "drivingLicenceNo",
                    // "licenceIssueDate",
                    // "licenceExpireDate"
                    // ),
                    // "witness1",
                    // "witness1Phone",
                    "repairEstimate"
                    // "witness1Address",
                    // "witness2",
                    // "witness2Address",
                    // "damageDetails",
                    // "damageDetails",
                    // "repairerName",
                    // "repairerPhone",
                    // "repairerAddress",
                    // "motorLocation",
                    // "repairEstimate",
                    // "thirdpartyDetails"
                )
            )
        ));

        return $claimsForm;
        // }
    }

    // // Begin Modal View
    // public function completeclaimsmodalAction()
    // {
    // $em = $this->entityManager;
    // $response = new Response();
    // $claimsForm = $this->claimsForm;
    // $gritter = new GritterMessage();
    // $request = $this->getRequest();
    // $customerClaimsSession = $this->customerClaimsSession;
    // $claimsId = $customerClaimsSession->claimsId;
    // $claimsEntity = $em->find("Claims\Entity\CLaims", $claimsId);
    // $specificServiceId = $this->clientGeneralService->getGeneralService()->getSpecificServiceTypeId($coverNoteEntity);
    // // $coverNoteEntity->getCoverCategory()->getId();
    // $claimsFieldset = $claimsForm->get("claimsFeildset");
    // switch ($specificServiceId) {
    // case IMService::IM_SPECIFIC_SERVICE_MOTOR_COMPREHENSIVE_MOTOR:
    // case IMService::IM_SPECIFIC_SERVICE_MOTOR_THIRD_PARTY_FIRE_THEFT:
    // case IMService::IM_SPECIFIC_SERVICE_MOTOR_THIRD_PARTY_MOTOR:
    // $claimsFieldset->add(array(
    // "name" => "claimsMotor",
    // "type" => "Claims\Form\Fieldset\ClaimsMotorAccidentFieldset"
    // ));
    // break;
    // // case IMService::IM_SPECI
    // default:
    // $claimsFieldset->add(array(
    // "name" => "claimsDefault",
    // "type" => "Claims\Form\Fieldset\ClaimsDefaultFieldset"
    // ));
    // break;
    // }

    // if ($request->isPost()) {

    // $post = $request->getPost();
    // $claimsForm->setData($post);
    // if ($claimsForm->isValid()) {
    // // $serviceId = CoverNoteService::getServiceTypeId($covernoteEntity);

    // $data = $claimsForm->getData();
    // $serviceId = CoverNoteService::getSpecificTypeId($claimsEntity->getPolicy()->getCoverNote());
    // // var_dump($post);
    // switch ($serviceId) {
    // case IMService::IM_SPECIFIC_SERVICE_MOTOR_COMPREHENSIVE_MOTOR:
    // case IMService::IM_SPECIFIC_SERVICE_MOTOR_THIRD_PARTY_FIRE_THEFT:
    // case IMService::IM_SPECIFIC_SERVICE_MOTOR_THIRD_PARTY_MOTOR:
    // var_dump("DERT");
    // var_dump($data);
    // $gritter->setTitle("Motor");
    // $gritter->setText("Motor Insurance ");
    // $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);
    // $gritter->setType(GritterMessage::TYPE_SUCCESS);
    // // $cleanRepairEstimate = CurrencyService::cleanInputValueStatic($data->getRepairEstimate());
    // $response->add($gritter);
    // return $this->getResponse()->setContent($response);
    // break;

    // default:

    // $gritter->setTitle("Error");
    // $gritter->setText("Error: Validation error");
    // $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);
    // $gritter->setType(GritterMessage::TYPE_SUCCESS);

    // $response->add($gritter);
    // // $
    // break;
    // }
    // } else {
    // $gritter->setTitle("Error");
    // $gritter->setText("Error: Validation error");
    // $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);
    // $gritter->setType(GritterMessage::TYPE_ERROR);

    // $response->add($gritter);
    // }
    // }
    // return $this->getResponse()->setContent($response);
    // }

    /**
     * This function provides a modal details of the policy associated to this claims form
     *
     * @return mixed
     */
    public function policydetailsAction()
    {
        $em = $this->entityManager;
        $response = new Response();
        $customerClaimsSession = $this->customerClaimsSession;
        $claimsId = $customerClaimsSession->claimsId;
        $gritter = new GritterMessage();
        if ($claimsId == NULL) {
            $gritter->setTitle("Error");
            $gritter->setText("Error: No claims Identity");
            $gritter->setType(GritterMessage::TYPE_ERROR);
            $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);

            $response->add($gritter);
        } else {
            $claimsEntity = $em->find("Claims\Entity\CLaims", $claimsId);
            $policyEntity = $claimsEntity->getPolicy();
            $modal = new WasabiModal("standard", "Policy Details");
            // $modal->setSize(WasabiModalConfigurator::MODAL_SM);
            $viewModel = new ViewModel(array(
                "policyEntity" => $policyEntity
            ));
            $viewModel->setTemplate("customer-claims-policy-details");
            $modal->setContent($viewModel);

            $modalView = new WasabiModalView("#wasabi", $this->renderer, $modal);
            $response->add($modalView);
        }
        return $this->getResponse()->setContent($response);
    }

    // End modal View

    // Begin ajax form call

    // End ajax form call

    // Begin Setters
    public function setEntityManager($em)
    {
        $this->entityManager = $em;
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

    public function setCustomerClaimsSession($sess)
    {
        $this->customerClaimsSession = $sess;
        return $this;
    }

    public function setCustomerBoardService($xserv)
    {
        $this->customerBoardService = $xserv;
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

    public function setClientrGeneralService($cli)
    {
        $this->clientGeneralService = $cli;
        return $this;
    }

    // End setters

    /**
     *
     * @param $this $clientGeneralService
     */
    public function setClientGeneralService($clientGeneralService)
    {
        $this->clientGeneralService = $clientGeneralService;
        return $this;
    }

    /**
     *
     * @param $this $renderer
     */
    public function setRenderer($renderer)
    {
        $this->renderer = $renderer;
        return $this;
    }

    /**
     *
     * @return mixed
     */
    public function getClaimsMotorForm()
    {
        return $this->claimsMotorForm;
    }

    /**
     *
     * @param mixed $claimsMotorForm
     */
    public function setClaimsMotorForm($claimsMotorForm)
    {
        $this->claimsMotorForm = $claimsMotorForm;
        return $this;
    }

    /**
     *
     * @return mixed
     */
    public function getClaimsDefaultForm()
    {
        return $this->claimsDefaultForm;
    }

    /**
     *
     * @param mixed $claimsDefaultForm
     */
    public function setClaimsDefaultForm($claimsDefaultForm)
    {
        $this->claimsDefaultForm = $claimsDefaultForm;
        return $this;
    }

    /**
     *
     * @return mixed
     */
    public function getClaismCashInTransitForm()
    {
        return $this->claismCashInTransitForm;
    }

    /**
     *
     * @param mixed $claismCashInTransitForm
     */
    public function setClaismCashInTransitForm($claismCashInTransitForm)
    {
        $this->claismCashInTransitForm = $claismCashInTransitForm;
        return $this;
    }

    /**
     *
     * @return mixed
     */
    public function getClaimsGitForm()
    {
        return $this->claimsGitForm;
    }

    /**
     *
     * @param mixed $claimsGitForm
     */
    public function setClaimsGitForm($claimsGitForm)
    {
        $this->claimsGitForm = $claimsGitForm;
        return $this;
    }

    /**
     *
     * @return mixed
     */
    public function getClaimsBurglaryForm()
    {
        return $this->claimsBurglaryForm;
    }

    /**
     *
     * @param mixed $claimsBurglaryForm
     */
    public function setClaimsBurglaryForm($claimsBurglaryForm)
    {
        $this->claimsBurglaryForm = $claimsBurglaryForm;
        return $this;
    }

    /**
     *
     * @return mixed
     */
    public function getClaimsFidelityGuarateeForm()
    {
        return $this->claimsFidelityGuarateeForm;
    }

    /**
     *
     * @param mixed $claimsFidelityGuarateeForm
     */
    public function setClaimsFidelityGuarateeForm($claimsFidelityGuarateeForm)
    {
        $this->claimsFidelityGuarateeForm = $claimsFidelityGuarateeForm;
        return $this;
    }

    public function setCommentForm($commentForm)
    {
        $this->commentForm = $commentForm;
        return $this;
    }

    /**
     *
     * @param mixed $claimsContractorAllRiskForm
     */
    public function setClaimsContractorAllRiskForm($claimsContractorAllRiskForm)
    {
        $this->claimsContractorAllRiskForm = $claimsContractorAllRiskForm;
        return $this;
    }

    public function setClaimsMarineCargoForm($claimsMarineCargoForm)
    {
        $this->claimsMarineCargoForm = $claimsMarineCargoForm;
        return $this;
    }

    public function setClaimsEmployerLiabilityForm($form)
    {
        $this->claimsEmployerLiabilityForm = $form;
        return $this;
    }

    public function setClaimsFirelossForm($form)
    {
        $this->claimsFireLossForm = $form;
        return $this;
    }

    /**
     *
     * @param mixed $claimsProfessionalindemnityForm
     */
    public function setClaimsProfessionalindemnityForm($claimsProfessionalindemnityForm)
    {
        $this->claimsProfessionalindemnityForm = $claimsProfessionalindemnityForm;
        return $this;
    }
}