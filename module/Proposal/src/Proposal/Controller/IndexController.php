<?php
namespace Proposal\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;
// use Zend\Db\Sql\Ddl\Column\Datetime;
// use WasabiLib\Modal\WasabiModal;
// use WasabiLib\Modal\WasabiModalView;
use WasabiLib\Ajax\Response;
// use WasabiLib\Ajax\InnerHtml;
use Proposal\Service\ProposalService;
use Object\Entity\Object;
use Object\Service\ObjectService;
use Policy\Entity\CoverNote;
use Messages\Service\MessageService;
use Policy\Service\CoverNoteService;
use Messages\Entity\MessageEntered;
use Messages\Entity\Messages;
use GeneralServicer\Entity\ManualPremium;
use WasabiLib\Ajax\InnerHtml;
use WasabiLib\Modal\WasabiModal;
use WasabiLib\Modal\WasabiModalView;
use WasabiLib\Ajax\DomManipulator;
use WasabiLib\Ajax\Redirect;
use Transactions\Entity\MicroPayment;
use Transactions\Service\TransactionService;
use WasabiLib\Modal\Dialog;
use WasabiLib\Modal\Button;
use Transactions\Entity\Invoice;
use Transactions\Service\InvoiceService;
use WasabiLib\Modal\WasabiModalConfigurator;
use Transactions\Entity\ManualPayment;
use Zend\Db\Sql\Ddl\Column\Date;
use Proposal\Entity\Proposal;
use IMServices\Service\IMService;
use IMServices\Entity\MotorData;
use WasabiLib\Ajax\GritterMessage;
use IMServices\Entity\CoverDetails;
use IMServices\Entity\AviationInsurance;
use IMServices\Entity\CropAgricInsurance;
use IMServices\Entity\LiveStockFarmInsurance;
use IMServices\Entity\BuglaryHouseBreaking;
use IMServices\Entity\CashInSafe;
use IMServices\Entity\CashInTransit;
use IMServices\Entity\ContractAllRisk;
use IMServices\Entity\FidelityGaurantee;
use IMServices\Entity\EmployerLiability;
use IMServices\Entity\TravelInsurance;
use IMServices\Entity\Hull;
use IMServices\Entity\MarineCargo;
use IMServices\Entity\FireAndSpecialPeril;
use IMServices\Entity\GoodsInTransit;
use IMServices\Entity\BoilersInsurance;
use IMServices\Entity\OilEnergyInsurance;
use IMServices\Entity\PublicLiability;
use IMServices\Entity\MotorNonStandardAccesory;
use IMServices\Entity\BoilerCoverDetails;
use IMServices\Entity\AviationinsurancePilotDetails;
use IMServices\Entity\BuglarySafeDetails;
// use GeneralServicer\Entity\Portal;
use GeneralServicer\Service\GeneralService;
use IMServices\Entity\InsurePortal;
use IMServices\Entity\DirectorsLiability;
use IMServices\Entity\AgricProductInsurance;
use IMServices\Entity\AgricPropertyInsuranceList;
use IMServices\Entity\LifePolicy;
use IMServices\Entity\GroupPeronalAccident;
use IMServices\Entity\GroupPersonalFixedDetails;
use IMServices\Entity\GroupPersonalWagesDetails;
use IMServices\Entity\GroupLife;
use Zend\Mail\AddressList;
use Zend\Mail\Address;
use IMServices\Entity\CropAgricStaffDetails;
use IMServices\Entity\CropAgricCropDetails;
use IMServices\Entity\LivestockInsuredList;
use IMServices\Entity\GroupLifeEmployeeList;
use IMServices\Entity\ElectronicEquipment;
use IMServices\Entity\WorkmenCompensation;
use IMServices\Entity\ContractAllRiskValueList;
use IMServices\Entity\EmployerLiabilityDetails;
use IMServices\Entity\FidelityGuarateeList;
use IMServices\Entity\GITVehicleDetails;
use IMServices\Entity\HomeInsurance;
use IMServices\Entity\HouseValuables;
use IMServices\Entity\HouseHoldGoods;
use IMServices\Entity\MachineryBreakDown;
use IMServices\Entity\OccupiersLiability;
use IMServices\Entity\OccupiersLiabilityDomesticStaff;
use IMServices\Entity\OccupiersLiabilityFamilyMembers;
use IMServices\Entity\ProfessionalIndemnity;
use IMServices\Entity\ProfessionalIndemnityPartnerDetails;
use IMServices\Entity\PublicLiabilityEmployeeDetails;
use IMServices\Entity\WorkmenDecreeList;
use IMServices\Entity\WorkmenCompensationSubContractorsList;
use Proposal\src\Proposal\Service\ProposalPdf;
use Doctrine\ORM\EntityManager;
use GeneralServicer\Service\CurrencyService;

// use Zend\Http\Header\AbstractLocation;

/**
 *
 * @author swoopfx
 *        
 */
class IndexController extends AbstractActionController
{

    /**
     *
     * @var EntityManager
     */
    private $entityManager;

    private $proposalPdf;

    private $proposalForm;

    private $proposalService;

    private $policyService;

    private $generalServicce;

    private $proposalEntity;

    private $renderer;

    private $centralBrokerId;

    private $objectForm;

    private $selectObjectForm;

    private $objectService;

    private $messageForm;

    private $messageService;

    private $coverNoteservice;

    private $manualPremiumForm;

    private $currencyService;

    private $dropZoneUploadForm;

    private $uploadForm;

    private $manualPaymentForm;

    private $blobService;

    private $microPaymentForm;

    private $invoiceService;

    private $premiumService;

    private $mailService;

    private $exportToInsurerForm;

    private $imService;

    // IM SERVER FORM
    private $motorForm;

    private $cropAgricInsuranceForm;

    private $livestockAgricInsuranceForm;

    private $aviationForm;

    private $houseBuglaryForm;

    private $cashInSafeForm;

    private $cashInTransitForm;

    private $employeeLiabilityForm;

    private $fidelityGuarateeForm;

    private $fireSpecialPerilForm;

    private $gitForm;

    private $groupLifeForm;

    private $homeInsuranceForm;

    private $contractAllRiskForm;

    private $travelInsuranceForm;

    private $machineBreakDownForm;

    private $advanceBondForm;

    // private $liveStockInsuranceForm;
    private $marineHullForm;

    private $marineCargoForm;

    private $buglaryForm;

    // private $motorInsuranceForm
    private $occupiersLiabilityForm;

    private $erectionAllRiskForm;

    private $boilerInsuranceForm;

    private $oilEnergyForm;

    private $publicLiabilityForm;

    private $proffesionalIndemnityForm;

    private $directorsLiabilityForm;

    private $agricPropertyForm;

    private $lifeAssuranceForm;

    private $groupPersonalAccidentForm;

    private $electronicEquipmentForm;

    private $personalAccident;

    private $workmenCompensationForm;

    // private $groupLifeForm;

    // private $
    public function onDispatch(\Zend\Mvc\MvcEvent $e)
    {
        $response = parent::onDispatch($e);
        // $response = parent::on
        $this->redirectPlugin()->redirectCondition();
        return $response;
    }

    /**
     * This function clears all object session that might seep through into object
     * new process page
     * e.g Micro payment session, Premium generation session
     */
    private function clearProposalSession()
    {
        // $proposalService = $this->proposalService;
        $proposalPremiumSession = new Container("proposal_premium");
        $proposalPremiumSession->isAuto = FALSE;
        $microPaymentSession = new Container("micro_payment_session");
        $microPaymentSession->getManager()
            ->getStorage()
            ->clear("micro_payment_session");
        $proposalPremiumSession->getManager()
            ->getStorage()
            ->clear("proposal_premium");

        // $proposalSession->getManager()->getStorage()->clear("proposalSession");
    }

    /**
     * Begin Modal
     */
    public function processredirectAction()
    {
        $response = new Response();

        $redirect = new Redirect($this->url()->fromRoute("proposal/default", array(
            "action" => "process"
        )));
        $response->add($redirect);
        return $this->getResponse()->setContent($response);
    }

    public function createpdfAction()
    {
        $response = new Response();
        $em = $this->entityManager;
        $proposalService = $this->proposalService;
        $proposalSession = $proposalService->getProposalSession();
        $proposalEntity = $em->find("Proposal\Entity\Proposal", $proposalSession->proposalId);
        $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $this->generalServicce->getBroker());
        if ($proposalEntity != NULL) {
            $viewModel = new ViewModel(array(
                "proposalEntity" => $proposalEntity,
                "broker" => $brokerEntity
            ));
            $viewModel->setTemplate("proposal-create-pdf");

            $html = $this->renderer->render($viewModel);
            // get customer
            // get invoice or micro payment details
            // get Proposal Details
            // get list of properties

            // $proposalDetailshtml =

            $pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor("IMAPP");
            $pdf->SetTitle($proposalEntity->getProposalCode());
            $pdf->SetSubject($proposalEntity->getProposalCode());
            // $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

            // set default header data
            $pdf->SetHeaderData("", PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

            // set header and footer fonts
            $pdf->setHeaderFont(Array(
                PDF_FONT_NAME_MAIN,
                '',
                PDF_FONT_SIZE_MAIN
            ));
            $pdf->setFooterFont(Array(
                PDF_FONT_NAME_DATA,
                '',
                PDF_FONT_SIZE_DATA
            ));

            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);

            // set default monospaced font
            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

            // set margins
            $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
            $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

            // set auto page breaks
            $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

            // set image scale factor
            $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

            // add a page
            $pdf->AddPage();

            // set cell padding
            // $tcpdf->setCellPaddings(1, 1, 1, 1);
            // set cell margins
            // $tcpdf->setCellMargins(1, 1, 1, 1);
            $pdf->writeHTML($html, true, 0, true, 0);
            $pdf->lastPage();
            $pdf->Output($proposalEntity->getProposalCode(), "I");
        }
        return $this->getResponse()->setContent($response);
    }

    public function createproposalmodalAction()
    {
        $data = $this->params()->fromQuery("data", NULL);

        $proposalService = $this->proposalService;
        $proposalSession = $proposalService->getProposalSession();
        if ($data != NULL) {
            $proposalSession->customerId = $data;
        }

        $proposalForm = $this->proposalForm;

        $response = new Response();
        $em = $this->entityManager;
        $proposalForm->setAttributes(array(
            "method" => "POST",
            "id" => "simpleForm",
            "data-ajax-loader" => "myLoader",
            "class" => "ajax_element form-horizontal form-label-left",
            "action" => $this->url()
                ->fromRoute("proposal/default", array(
                "action" => "createproposalmodal"
            ))
        ));
        $request = $this->getRequest();
        // else {

        if ($request->isPost()) {
            if ($proposalSession->customerId == NULL) {
                $this->flashmessenger()->addErrorMessage(" Customer Identity is absent please try again later");
                $redirect = new Redirect($this->url()->fromRoute("customer/default", array(
                    "action" => "all"
                )));
                $response->add($redirect);
            }
            $customerEntity = $em->find("Customer\Entity\Customer", $proposalSession->customerId);
            $proposalEntity = new Proposal();
            $post = $request->getPost();
            $proposalForm->setData($post);
            $proposalForm->setValidationGroup(array(
                "csrf",
                "proposalFieldset" => array(
                    "proposalTitle",
                    "proposalDesc",
                    "insurer",
                    "serviceType",
                    "specificService",
                    "value",
                    "valueType",
                    "currency",
                    "coverDuration",
                    "termedDuration"
                    // "object"
                )
            ));

            if ($proposalForm->isValid()) {

                $data = $proposalForm->getData();
                $proposalEntity->setUpdatedOn(new \DateTime())
                    ->setProposalTitle($data->getProposalTitle())
                    ->setCurrency($em->find("Settings\Entity\Currency", $data->getCurrency()))
                    ->setProposalDesc($data->getProposalDesc())
                    ->setInsurer($em->find("Settings\Entity\Insurer", $data->getInsurer()))
                    ->setServiceType($em->find("Settings\Entity\InsuranceServiceType", $data->getServiceType()))
                    ->setSpecificService($em->find("Settings\Entity\InsuranceSpecificService", $data->getSpecificService()))
                    ->setValue($data->getValue())
                    ->setValueType($em->find("Settings\Entity\DefinePackageValueType", $data->getValueType()))
                    ->setCoverDuration($em->find("Settings\Entity\PolicyCoverDuration", $data->getCoverDuration()))
                    ->setIsHidden(FALSE)
                    ->setIsVisible(FALSE)
                    ->setCreatedOn(new \DateTime())
                    ->setIsActive(TRUE)
                    ->setTermedDuration($data->getTermedDuration())
                    ->setIsManualPremium(FALSE)
                    ->setIsFinalized(FALSE)
                    ->setProposalStatus($em->find("Proposal\Entity\ProposalStatus", ProposalService::PROPOSAL_STATUS_WAITING_CUSTOMER_RESPONSE))
                    ->setUpdatedOn(new \DateTime())
                    ->setProposalCode($proposalService->generateProposalCode())
                    ->setCustomer($customerEntity);
                // ->setTermedDuration($em->find("Settings\Entity\PolicyCoverTermedValue", $data->getTermedDuration()));

                if ($data->getValueType()->getId() == 1) {
                    $proposalEntity->setCurrency($em->find("Settings\Entity\Currency", $data->getCurrency()));
                }

                try {
                    $em->persist($proposalEntity);
                    $em->flush();
                    $proposalSession->proposalId = $proposalEntity->getId();

                    $gritter = new GritterMessage();
                    $gritter->setTitle("Success");
                    $gritter->setText("Successfully Created Proposal");
                    $gritter->setType(GritterMessage::TYPE_SUCCESS);
                    $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);

                    $response->add($gritter);

                    $this->flashmessenger()->addSuccessMessage("Proposal information was successfully updated !!");

                    $redirect = new Redirect($this->url()->fromRoute("proposal/default", array(
                        "action" => "process"
                    )));
                    $response->add($redirect);
                } catch (\Exception $e) {
                    $this->flashmessenger()->addErrorMessage("objectre was a problem updating object proposal information");
                    $redirect = new Redirect($this->url()->fromRoute("proposal/default", array(
                        "action" => "process"
                    )));
                    // $response->add($redirect);
                }
            }
        } else {
            $viewModel = new ViewModel(array(
                "proposalForm" => $proposalForm
            ));
            $viewModel->setTemplate("proposal-form-modal-snippet");

            $modal = new WasabiModal("standard", "Create Proposal");
            $modal->setContent($viewModel);

            $modalView = new WasabiModalView("#wasabi_modal", $this->renderer, $modal);
            $response->add($modalView);
        }
        // }
        return $this->getResponse()->setContent($response);
    }

    /**
     * This function completes object proposal
     *
     * @return mixed
     */
    public function completeAction()
    {
        $em = $this->entityManager;
        $proposalForm = $this->proposalForm;
        $response = new Response();
        $red = new Response();
        $proposalService = $this->proposalService;
        $proposalSession = $proposalService->getProposalSession();
        $proposalId = $proposalSession->proposalId;
        $proposalEntity = $em->find("Proposal\Entity\Proposal", $proposalId);

        $proposalForm->setAttributes(array(
            "method" => "POST",
            "id" => "simpleForm",
            "data-ajax-loader" => "myLoader",
            "class" => "ajax_element form-horizontal form-label-left",
            "action" => $this->url()
                ->fromRoute("proposal/default", array(
                "action" => "complete"
            ))
        ));
        $request = $this->getRequest();
        $proposalForm->bind($proposalEntity);
        if ($request->isPost()) {
            $post = $request->getPost();

            // $poste = array(
            // "proposalFieldset" => array(
            // $post
            // )
            // );
            // var_dump($post);
            $proposalForm->setData($post);
            $proposalForm->setValidationGroup(array(
                "csrf",
                "proposalFieldset" => array(
                    "proposalTitle",
                    "proposalDesc",
                    "insurer",
                    "serviceType",
                    "specificService",
                    "value",
                    "valueType",
                    "currency",
                    "coverDuration",
                    "termedDuration"
                    // "object"
                )
            ));
            if ($proposalForm->isValid()) {

                $data = $proposalForm->getData();
                // var_dump( $data->getTermedDuration());
                $proposalEntity->setUpdatedOn(new \DateTime())
                    ->setProposalTitle($data->getProposalTitle())
                    ->setProposalDesc($data->getProposalDesc())
                    ->setInsurer($em->find("Settings\Entity\Insurer", $data->getInsurer()))
                    ->setServiceType($em->find("Settings\Entity\InsuranceServiceType", $data->getServiceType()))
                    ->setSpecificService($em->find("Settings\Entity\InsuranceSpecificService", $data->getSpecificService()))
                    ->setValue($data->getValue())
                    ->setTermedDuration($data->getTermedDuration())
                    ->setValueType($em->find("Settings\Entity\DefinePackageValueType", $data->getValueType()));

                if ($data->getValueType()->getId() == 1) {
                    $proposalEntity->setCurrency($em->find("Settings\Entity\Currency", $data->getCurrency()));
                }

                try {
                    $em->persist($proposalEntity);
                    $em->flush();
                    $this->flashmessenger()->addSuccessMessage("Proposal information was successfully updated !!");

                    $gritter = new GritterMessage();
                    $gritter->setTitle("Success");
                    $gritter->setText("Successfully Created Proposal");
                    $gritter->setType(GritterMessage::TYPE_SUCCESS);
                    $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);

                    $response->add($gritter);
                    $redirect = new Redirect($this->url()->fromRoute("proposal/default", array(
                        "action" => "process"
                    )));
                    $red->add($redirect);
                    return $this->getResponse()->setContent($red);
                } catch (\Exception $e) {
                    $this->flashmessenger()->addErrorMessage("objectre was a problem updating object proposal information");
                    $redirect = new Redirect($this->url()->fromRoute("proposal/default", array(
                        "action" => "process"
                    )));
                    $red->add($redirect);
                    return $this->getResponse()->setContent($red);
                }
            }
        }
        $viewModel = new ViewModel(array(
            "proposalForm" => $proposalForm
        ));

        $viewModel->setTemplate("proposal-form-modal-snippet");
        $modal = new WasabiModal("standard", "Complete Proposal");
        $modal->setContent($viewModel);

        $modalView = new WasabiModalView("#wasabi_modal", $this->renderer, $modal);

        $response->add($modalView);
        return $this->getResponse()->setContent($response);
    }

    /**
     * End Modal
     */

    /**
     * This function updates object invoice at any point a specific change is made
     */
    private function updateInvoice($value, $currency = 1)
    {
        $em = $this->entityManager;
        $proposalService = $this->proposalService;
        $proposalSession = $proposalService->getProposalSession();
        $proposalEntity = $em->find("Proposal\Entity\Proposal", $proposalSession->proposalId);
        if ($proposalEntity->getInvoice() != NULL) {
            $invoiceEntity = $proposalEntity->getInvoice();
            $invoiceEntity->setAmount($value)
                ->setModifiedOn(new \DateTime())
                ->setCurrency($em->find("Settings\Entity\Currency", $currency));

            try {
                $em->persist($invoiceEntity);
                $em->flush();
                return TRUE;
            } catch (\Exception $e) {
                return FALSE;
            }
        }
    }

    // Begin Modal Async calls
    public function exporttoinsurerAction()
    {
        $em = $this->entityManager;
        $renderer = $this->renderer;
        $generalService = $this->generalServicce;
        $proposalService = $this->proposalService;
        $proposalSession = $proposalService->getProposalSession();
        $proposalEntity = $em->find("Proposal\Entity\Proposal", $proposalSession->proposalId);
        $response = new Response();
        $form = $this->exportToInsurerForm;
        $form->setAttributes(array(
            "id" => "simpleForm",
            "class" => "form-horizontal form-label-left ajax_element",
            "data-ajax-loader" => "myLoader",
            "action" => $this->url()
                ->fromRoute("proposal/default", array(
                "action" => "exporttoinsurer"
            ))
        ));
        $request = $this->getRequest();
        if ($request->isPost()) {
            $gritter = new GritterMessage();
            $post = $request->getPost();
            $form->setData($post);
            if ($form->isValid()) {
                $gritter = new GritterMessage();
                $post = $request->getPost();
                $insurer1 = $post["exportToInsurerFieldset"]['insurer1'];
                $insurer2 = $post["exportToInsurerFieldset"]['insurer2'];
                $insurer3 = $post["exportToInsurerFieldset"]['insurer3'];

                $insurer = array();
                $insurer[] = $insurer1;
                $insurer[] = $insurer2;
                $insurer[] = $insurer3;

                foreach ($insurer as $in) {
                    $broker = $em->find("Users\Entity\InsuranceBrokerRegistered", $this->centralBrokerId);

                    $portalEntity = new InsurePortal();
                    $portalEntity->setCreatedOn(new \DateTime())
                        ->setEmail($in)
                        ->setProposal($proposalEntity)
                        ->setPortalUid(GeneralService::portalUid())
                        ->setType($em->find("Settings\Entity\CoverCategory", CoverNoteService::COVERNOTE_CATEGORY_PROPOSAL));

                    // send mail
                    $pointer["to"] = $in;
                    $pointer["fromName"] = $broker->getBrokerName();
                    $pointer["subject"] = "{$broker->getBrokerName()} ";

                    $em->persist($portalEntity);
                    // $child = array();
                    // if (count($broker->getBrokerChild()) > 0) {
                    // foreach ($broker->getBrokerChild() as $ild) {
                    // $child[] = $ild;
                    // }
                    // }

                /**
                 * Send notification to the emails provided
                 * including object port number and and email of object insurer
                 * If objecty dont match in object string objectn objectre is no access to object actual portal
                 */
                }
                try {
                    //
                    $proposalEntity->setIsExport(TRUE);
                    $em->persist($proposalEntity);
                    $em->flush();
                    $gritter->setTitle("Export Success");
                    $gritter->setText("Succesfully sent inofrmation to the insurance company");
                    $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);
                    $gritter->setType(GritterMessage::TYPE_SUCCESS);
                    $response->add($gritter);
                    $this->flashmessenger()->addSuccessMessage("Successfully exported information");
                    $redirect = new Redirect($this->url()->fromRoute("proposal/default", array(
                        "action" => "process"
                    )));
                    $response->add($redirect);
                } catch (\Exception $e) {
                    $gritter->setTitle("Hydration Error");
                    $gritter->setText("We could not export information");
                    $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);
                    $gritter->setType(GritterMessage::TYPE_ERROR);

                    $response->add($gritter);
                }
            } else {
                $gritter->setTitle("Invalid Form");
                $gritter->setType(GritterMessage::TYPE_ERROR);
                $gritter->setText("object form submitted is not valid");
                $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);

                $response->add($gritter);
            }
        } else {
            $viewModel = new ViewModel(array(
                "form" => $form
            ));
            $viewModel->setTemplate("general-modal-export-to-insurer");
            $modal = new WasabiModal("standard", "Export Customer Details");
            $modal->setContent($viewModel);
            $modalView = new WasabiModalView("#wasabi_modal", $this->renderer, $modal);

            $response->add($modalView);
        }
        return $this->getResponse()->setContent($response);
    }

    /**
     * This gets object cover details based on
     */
    public function getcoverdetailsmodalAction()
    {
        $em = $this->entityManager;
        $proposalService = $this->proposalService;
        $proposalSession = $proposalService->getProposalSession();
        $proposalEntity = $em->find("Proposal\Entity\Proposal", $proposalSession->proposalId);

        $coverEntity = $proposalEntity->getCoverDetails();
        $serviceId = $proposalEntity->getSpecificService()->getId();

        $response = new Response();
        $viewModel = new ViewModel(array(
            "serviceId" => $serviceId,
            "coverEntity" => $coverEntity
        ));
        // var_dump($serviceId);
        $viewModel->setTemplate("get_cover_details_modal");
        $modal = new WasabiModal("standard", "Cover Details");
        // $modal->setSize(WasabiModalConfigurator::MODAL);
        $modal->setContent($viewModel);

        $modalView = new WasabiModalView("#wasabi_modal", $this->renderer, $modal);
        $response->add($modalView);
        return $this->getResponse()->setContent($response);
    }

    /**
     * Generates form and processes it
     * This provides a form for completeinmg object proposal specific cover
     * It displays a form to complate object proposal application
     * It is previewd in a modal window
     *
     * @return mixed
     */
    public function coverdetailsmodalAction()
    {
        $response = new Response();

        $imService = $this->imService;

        $proposalCoverSession = new Container("proposal_cover_session");
        // This creates an session object for micro fieldset counter
        $microFieldsetCounterSession = new Container("micro_fieldset_counter_session");
        $em = $this->entityManager;
        $proposalService = $this->proposalService;
        $proposalSession = $proposalService->getProposalSession();
        $proposalEntity = $em->find("Proposal\Entity\Proposal", $proposalSession->proposalId);
        $form = $imService->getImCoverForm($proposalEntity->getSpecificService()
            ->getId());
        $viewModel = new ViewModel(array(
            "coverId" => $proposalEntity->getSpecificService()->getId(),
            "form" => $form
        ));

        $viewModel->setTemplate("proposal-cover-details-modal");

        $modal = new WasabiModal("standard", "Cover Details");
        $modal->setContent($viewModel);
        // $modal->setSize(WasabiModalConfigurator::MODAL_SM);

        $modalView = new WasabiModalView("#wasabi_modal", $this->renderer, $modal);
        $request = $this->getRequest();
        // Initialize counter for Motor Non Standard Accessory micro Fieldet counter
        $microFieldsetCounterSession->getManager()
            ->getStorage()
            ->clear("micro_fieldset_counter_session");
        $microFieldsetCounterSession->motorNonStandardAccessory = 0;
        $microFieldsetCounterSession->boilerCoverDetails = 0;
        $microFieldsetCounterSession->aviationPilotDetails = 0;
        $microFieldsetCounterSession->buglarSafeDetails = 0;
        $microFieldsetCounterSession->contractorAllRiskValueList = 0;
        $microFieldsetCounterSession->agricProductList = 0;
        $microFieldsetCounterSession->grouppersonalfixeddetail = 0;
        $microFieldsetCounterSession->grouppersonalwagesdetail = 0;
        $microFieldsetCounterSession->cropStaffList = 0;
        $microFieldsetCounterSession->cropAgricfList = 0;
        $microFieldsetCounterSession->livestockInsuredList = 0;
        $microFieldsetCounterSession->groupLifeStaffList = 0;
        $microFieldsetCounterSession->workmenDecreeList = 0;
        $microFieldsetCounterSession->employeeLiabilityDetailFieldset = 0;
        $microFieldsetCounterSession->fidelityEmployeeListFieldset = 0;
        $microFieldsetCounterSession->gitvehiclelist = 0;
        $microFieldsetCounterSession->goodslistFieldset = 0;
        $microFieldsetCounterSession->valuableslistFieldset = 0;
        $microFieldsetCounterSession->occupiersLiabityStaffFieldset = 0;
        $microFieldsetCounterSession->occupiersLiabityFamilyFieldset = 0;
        $microFieldsetCounterSession->professionalindemnitypartnerdetails = 0;
        $microFieldsetCounterSession->workmencontractorlist = 0;

        if ($request->isPost()) {

            $post = $request->getPost();
            $coverId = $proposalEntity->getSpecificService()->getId();
            // var_dump($post);
            $coverDetailsEntity = new CoverDetails();
            $proposalEntity->setUpdatedOn(new \DateTime())
                ->setIsCoverDetails(true)
                ->setCoverDetails($coverDetailsEntity);
            switch ($coverId) {
                // Begin Motor Coverdetails
                case IMService::IM_SPECIFIC_SERVICE_MOTOR_COMPREHENSIVE_MOTOR:
                case IMService::IM_SPECIFIC_SERVICE_MOTOR_THIRD_PARTY_MOTOR:
                case IMService::IM_SPECIFIC_SERVICE_MOTOR_THIRD_PARTY_FIRE_THEFT:

                    $motorForm = $this->motorForm;
                    $motorEntity = new MotorData();
                    $motorForm->bind($motorEntity);

                    $motorForm->setData($post);
                    if ($motorForm->isValid()) {
                        $data = $motorForm->getData();

                        try {
                            $proposalCoverSession->coverId = $coverId;
                            // $data = $motorForm->getData();

                            if ((count($post["accessoryName"]) > 0 || count($post["accessoryValue"]) > 0)) {
                                for ($count = 1; $count <= count($post["accessoryName"]); $count ++) {
                                    $motorNonStandardAccessoryEntity = new MotorNonStandardAccesory();
                                    $motorNonStandardAccessoryEntity->setAccessoryName($post["accessoryName"][$count])
                                        ->setAccessoryValue($post["accessoryValue"][$count])
                                        ->setMotorData($motorEntity);
                                    $em->persist($motorNonStandardAccessoryEntity);
                                }
                            }

                            $coverDetailsEntity->setMotorInsurance($motorEntity)->setCreatedOn(new \DateTime());
                            $em->persist($motorEntity);
                            $em->persist($coverDetailsEntity);
                            $em->persist($proposalEntity);
                            $em->flush();

                            $this->flashmessenger()->addSuccessMessage("Successfully Updated motor information ");
                            $refresh = new Redirect($this->url()->fromRoute("proposal/default", array(
                                "action" => "process"
                            )));
                            $response->add($refresh);
                        } catch (\Exception $e) {
                            $response->add($this->coverDetailGritterError("Cover Details Hydration Error", "We could not create object cover details"));
                        }
                    } else {

                        $response->add($this->coverDetailGritterError("Validation Error", "object details of object cover are invalid"));

                        // $response->add($modalView);
                    }

                    break; // end of motor insurace

                // Begin Aviation
                case IMService::IM_SPECIFIC_SERVICE_AVIATION_INSURANCE:
                    $aviationForm = $this->aviationForm;
                    $aviationEntity = new AviationInsurance();
                    $aviationForm->bind($aviationEntity);

                    $aviationForm->setData($post);
                    if ($aviationForm->isValid()) {
                        try {
                            if (count($post['pilotName']) > 0 || count($post('pilotDOb'))) {
                                for ($count = 1; $count <= count($post["accessoryName"]); $count ++) {

                                    $aviationPilotDetails = new AviationinsurancePilotDetails();
                                    $aviationPilotDetails->setPilotName($post['pilotName'][$count])
                                        ->setPilotDOb($post['pilotDOb'][$count])
                                        ->setFlyingHours($post["flyingHours"][$count])
                                        ->setLicenceNumber($post["licenceNumber"][$count])
                                        ->setAviationInsurance($aviationEntity)
                                        ->setIsPreviousAccident($post["isPreviousAccident"][$count]);
                                    $em->persist($aviationEntity);
                                }
                            }
                            $coverDetailsEntity->setAviationInsurance($aviationEntity)->setCreatedOn(new \DateTime());
                            $em->persist($aviationEntity);
                            $em->persist($coverDetailsEntity);
                            $em->persist($proposalEntity);

                            $em->flush();

                            $gritter = new GritterMessage();
                            $gritter->setTitle("Success");
                            $gritter->setText("Successfully updated information ");
                            $gritter->setType(GritterMessage::TYPE_SUCCESS);
                            $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);

                            $response->add($gritter);

                            $refresh = new Redirect($this->url()->fromRoute("proposal/default", array(
                                "action" => "process"
                            )));
                            $response->add($refresh);
                        } catch (\Exception $e) {
                            $response->add($this->coverDetailGritterError("Cover Details Hydration Error", "We could not create object cover details"));
                        }
                    } else {
                        // data not valid
                        $response->add($this->coverDetailGritterError("Validation Error", "object data provided is invalid, please look and  resubmit again"));
                    }

                    break;
                // end of aviation insurance

                case IMService::IM_SPECIFIC_SERVICE_AGRIC_CROP:
                    $cropInsuranceForm = $this->cropAgricInsuranceForm;
                    $cropInsuranceEntity = new CropAgricInsurance();
                    $cropInsuranceForm->bind($cropInsuranceEntity);
                    $cropInsuranceForm->setData($post);

                    if ($cropInsuranceForm->isValid()) {

                        $data = $cropInsuranceForm->getData();

                        try {
                            if (count($post["cropTypeInsured"])) {
                                for ($count = 1; $count <= count($post["cropTypeInsured"]); $count ++) {
                                    $cropAgricDetailEntity = new CropAgricCropDetails();
                                    $cropAgricDetailEntity->setAnnualProduction($post["annualProduction"][$count])
                                        ->setCropAgricInsurance($cropInsuranceEntity)
                                        ->setCropSalesValue($post["cropSalesValue"][$count])
                                        ->setCropsBiggestThreat($post['cropsBiggestThreat'][$count])
                                        ->setCropSeedVariety($post["cropSeedVariety"][$count])
                                        ->seobjectctares($post["hectares"][$count])
                                        ->setNoOfPlantsPerHectare($post["noOfPlantsPerHectare"][$count])
                                        ->setSumInsured($post["sumInsured"][$count])
                                        ->setVegetationPeriod($post["vegetationPeriod"][$count]);
                                    $em->persist($cropAgricDetailEntity);
                                }
                            }
                            if (count($post['post']) > 0) {
                                for ($count = 1; $count <= count($post['post']); $count ++) {
                                    $cropStaffListEntity = new CropAgricStaffDetails();
                                    $cropStaffListEntity->setPost($post['post'][$count])
                                        ->setName($post['name'][$count])
                                        ->setCropAgricInsurance($cropInsuranceEntity)
                                        ->setQualification($post['qualification'][$count])
                                        ->setYearsInService($post['yearsInService'][$count]);

                                    $em->persist($cropStaffListEntity);
                                }
                            }
                            if (count($data->getCropPerilCoverList()) > 0) {
                                foreach ($data->getCropPerilCoverList() as $dat) {
                                    $cropInsuranceEntity->addCropPerilCoverList($dat);
                                }
                            }

                            // var_dump($post['post']);

                            $coverDetailsEntity->setCropAgricIinsurance($cropInsuranceEntity)->setCreatedOn(new \DateTime());
                            $em->persist($cropInsuranceEntity);
                            $em->persist($coverDetailsEntity);
                            $em->persist($proposalEntity);
                            $em->flush();
                            $refresh = new Redirect($this->url()->fromRoute("proposal/default", array(
                                "action" => "process"
                            )));
                            $response->add($refresh);
                        } catch (\Exception $e) {

                            $response->add($this->coverDetailGritterError("Cover Details Hydration Error", "We could not create object cover details"));
                            // var_dump($e->getMessage());
                        }
                    } else {
                        //
                        $response->add($this->coverDetailGritterError("Validation Error", "object details of object cover are invalid"));
                    }
                    break;
                // End Agric Crop insurance

                // Begin Agric Livestock Insurance
                case IMService::IM_SPECIFIC_SERVICE_AGRIC_LIVESTOCK:
                    $liveStockForm = $this->livestockAgricInsuranceForm;
                    $liveStockInsuranceEntity = new LiveStockFarmInsurance();

                    $liveStockForm->bind($liveStockInsuranceEntity);
                    $liveStockForm->setData($post);

                    if ($liveStockForm->isValid()) {
                        $data = $liveStockForm->getData();
                        if (count($post['animalId']) > 0) {
                            for ($count = 1; $count <= count($post['animalId']); $count ++) {
                                $livectockInsuredListEntity = new LivestockInsuredList();
                                $livectockInsuredListEntity->setAge($post['age'][$count])
                                    ->setAnimalId($post['animalId'][$count])
                                    ->setBreed($post["breed"][$count])
                                    ->setLiveStockInsurance($liveStockInsuranceEntity)
                                    ->setMarketValue($post['marketValue'][$count])
                                    ->setSex($em->find("Settings\Entity\Sex", $post['sex'][$count]));
                                $em->persist($livectockInsuredListEntity);
                            }
                        }
                        try {
                            $proposalCoverSession->coverId = $coverId;

                            if (count($data->getUseOfAnimals()) > 0) {
                                foreach ($data->getUseOfAnimals() as $use) {
                                    $liveStockInsuranceEntity->addUseOfAnimals($use);
                                }
                            }

                            $coverDetailsEntity->setLivestockAgricInsurance($liveStockInsuranceEntity)->setCreatedOn(new \DateTime());
                            $em->persist($liveStockInsuranceEntity);
                            $em->persist($coverDetailsEntity);
                            $em->persist($proposalEntity);
                            $em->flush();

                            $gritter = new GritterMessage();
                            $gritter->setType(GritterMessage::TYPE_SUCCESS);
                            $gritter->setTitle("Success");
                            $gritter->setText("Successfull hydration");
                            $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);

                            $response->add($gritter);

                            $refresh = new Redirect($this->url()->fromRoute("proposal/default", array(
                                "action" => "process"
                            )));
                            $response->add($refresh);
                        } catch (\Exception $e) {
                            // var_dump($data->getIsSubsidizedInsurance());
                            // var_dump($e->getMessage());
                            $response->add($this->coverDetailGritterError("Cover Details Hydration Error", "We could not create object cover details"));
                        }
                    } else {
                        // var_dump($liveStockForm->getMessages());
                        $response->add($this->coverDetailGritterError("Validation Eror", "object form filled did not meet minimum validation requirements"));
                    }
                    break;

                // End of Livestock Insurance

                case IMService::IM_SPECIFIC_SERVICE_AGRIC_PROPERTY_PRODUCE:
                    $agriPropertyForm = $this->agricPropertyForm;
                    $agriPropertyEntity = new AgricProductInsurance();
                    $agriPropertyForm->bind($agriPropertyEntity);
                    $agriPropertyForm->setData($post);
                    if ($agriPropertyForm->isValid()) {
                        $data = $agriPropertyForm->getData();
                        $coverDetailsEntity->setAgricPropertyInsurance($agriPropertyEntity)->setCreatedOn(new \DateTime());
                        if (count($post["propertyName"]) > 0) {
                            for ($count = 1; $count <= count($post["propertyName"]); $count ++) {
                                $listEntity = new AgricPropertyInsuranceList();
                                $listEntity->setPropertyName($post["propertyName"][$count])
                                    ->setValue($post['value'][$count])
                                    ->setDesc($post['desc'][$count])
                                    ->setAgricProperty($agriPropertyEntity);

                                $em->persist($listEntity);
                            }
                        }
                        // var_dump($post);
                        try {
                            $em->persist($coverDetailsEntity);
                            $em->persist($agriPropertyEntity);
                            $em->persist($proposalEntity);

                            $em->flush();

                            $gritter = new GritterMessage();
                            $gritter->setType(GritterMessage::TYPE_SUCCESS);
                            $gritter->setTitle("Success");
                            $gritter->setText("Successfull hydration");
                            $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);

                            $response->add($gritter);
                            $redirect = new Redirect($this->url()->fromRoute("proposal/default", array(
                                "action" => "process"
                            )));
                            $this->flashmessenger()->addSuccessMessage("Success");
                            $response->add($redirect);
                        } catch (\Exception $e) {
                            $response->add($this->coverDetailGritterError("Hydration Error", "Hydration Error, please contact administrator"));
                        }
                    } else {
                        $response->add($this->coverDetailGritterError("Validation Error", "Form is invalid, please check object form and try again"));
                    }

                    break;

                // Begin Builder Liability Insurance
                case IMService::IM_SPECIFIC_SERVICE_BUILDERS_LIABILITY:

                    break;

                case IMService::IM_SPECIFIC_SERVICE_BOILER:

                    $boilerInsuranceForm = $this->boilerInsuranceForm;
                    $boilerInsuranceEntity = new BoilersInsurance();
                    $boilerInsuranceForm->bind($boilerInsuranceEntity);
                    $boilerInsuranceForm->setData($post);
                    if ($boilerInsuranceForm->isValid()) {
                        $coverDetailsEntity->setBoilerInsurance($boilerInsuranceEntity)->setCreatedOn(new \DateTime());

                        if (count($post["itemDescription"]) > 0 || count($post["manuYear"]) > 0) {
                            for ($count = 1; $count <= count($post["itemDescription"]); $count ++) {
                                $boilerCoverDetailsEntity = new BoilerCoverDetails();
                                $boilerCoverDetailsEntity->setBoiler($boilerInsuranceEntity)
                                    ->setItemDescription($post["itemDescription"][$count])
                                    ->setManuYear($post["manuYear"][$count])
                                    ->setReplacementValue($post["replacementValue"][$count]);
                                $em->persist($boilerCoverDetailsEntity);
                            }
                        }

                        try {
                            $em->persist($coverDetailsEntity);
                            $em->persist($proposalEntity);
                            $em->persist($boilerInsuranceEntity);

                            $em->flush();
                            $this->flashmessenger()->addSuccessMessage("Boiler information successfully updated");
                            $refresh = new Redirect($this->url()->fromRoute("proposal/default", array(
                                "action" => "process"
                            )));
                            $response->add($refresh);
                        } catch (\Exception $e) {
                            $response->add($this->coverDetailGritterError("Cover Details Hydration Error", "We could not create object cover details"));
                        }
                    } else {
                        $response->add($this->coverDetailGritterError("Validation Eror", "object form filled did not meet minimum validation requirements"));
                    }
                    break;

                case IMService::IM_SPECIFIC_SERVICE_BURGLARY_HOUSE_BREAKING:
                    $buglaryForm = $this->buglaryForm;
                    $buglaryEntity = new BuglaryHouseBreaking();
                    $buglaryForm->bind($buglaryEntity);

                    $buglaryForm->setData($post);
                    if ($buglaryForm->isValid()) {
                        $data = $buglaryForm->getData();
                        if (count($post['productName']) > 0) {
                            for ($count = 1; $count <= count($post["productName"]); $count ++) {
                                $buglarSafeEntity = new BuglarySafeDetails();
                                $buglarSafeEntity->setBuglary($buglaryEntity)
                                    ->setCost($post["cost"][$count])
                                    ->setMaker($post['maker'][$count])
                                    ->setModel($post["model"][$count])
                                    ->setProductName($post["productName"][$count])
                                    ->setSize($post["size"][$count]);
                                $em->persist($buglarSafeEntity);
                            }
                        }
                        try {
                            $coverDetailsEntity->setBuglary($buglaryEntity)->setCreatedOn(new \DateTime());

                            $em->persist($coverDetailsEntity);
                            $em->persist($buglaryEntity);
                            $em->persist($proposalEntity);

                            $em->flush();
                            $this->flashmessenger()->addSuccessMessage("Burgalry information  successful");
                            $refresh = new Redirect($this->url()->fromRoute("proposal/default", array(
                                "action" => "process"
                            )));
                            $response->add($refresh);

                            // if(count($data->)))
                        } catch (\Exception $e) {
                            $response->add($this->coverDetailGritterError("Cover Details Hydration Error", "We could not create object cover details"));
                        }
                    } else {
                        $response->add($this->coverDetailGritterError("Validation Eror", "object form filled did not meet minimum validation requirements"));
                    }

                    break;

                case IMService::IM_SPECIFIC_SERVICE_CASH_IN_SAFE:
                    $cashInSafeForm = $this->cashInSafeForm;
                    $cashInSafeEntity = new CashInSafe();
                    $cashInSafeForm->bind($cashInSafeEntity);

                    $cashInSafeForm->setData($post);
                    if ($cashInSafeForm->isValid()) {
                        $data = $cashInSafeForm->getData();
                        try {
                            $coverDetailsEntity->setCashInSafeInsurance($cashInSafeEntity)->setCreatedOn(new \DateTime());

                            $em->persist($cashInSafeEntity);
                            $em->persist($coverDetailsEntity);
                            $em->persist($proposalEntity);

                            $em->flush();
                            $this->flashmessenger()->addSuccessMessage("Successfully hydrated object information");
                            $refresh = new Redirect($this->url()->fromRoute("proposal/default", array(
                                "action" => "process"
                            )));
                            $response->add($refresh);
                        } catch (\Exception $e) {
                            $response->add($this->coverDetailGritterError("Cover Details Hydration Error", "We could not create object cover details"));
                        }
                    } else {
                        $response->add($this->coverDetailGritterError("Validation Eror", "object form filled did not meet minimum validation requirements"));
                    }
                    break;

                case IMService::IM_SPECIFIC_SERVICE_CASH_IN_TRANSIT:
                    $cashInTransitForm = $this->cashInTransitForm;
                    $cashInTransitEntity = new CashInTransit();

                    $cashInTransitForm->bind($cashInTransitEntity);
                    $cashInTransitForm->setData($post);
                    if ($cashInTransitForm->isValid()) {
                        $data = $cashInTransitForm->getData();

                        try {
                            $coverDetailsEntity->setCashInTransitInsurance($cashInTransitEntity)->setCreatedOn(new \DateTime());

                            $em->persist($coverDetailsEntity);
                            $em->persist($cashInTransitEntity);
                            $em->persist($proposalEntity);
                            $em->flush();
                            $this->flashmessenger()->addSuccessMessage("Cash in Transit successfully hydrated ");
                            $refresh = new Redirect($this->url()->fromRoute("proposal/default", array(
                                "action" => "process"
                            )));
                            $response->add($refresh);
                        } catch (\Exception $e) {
                            $response->add($this->coverDetailGritterError("Cover Details Hydration Error", "We could not create object cover details"));
                        }
                    } else {

                        $response->add($this->coverDetailGritterError("Validation Error", "object form filled did not meet minimum validation requirements"));
                    }
                    break;

                case IMService::IM_SPECIFIC_SERVICE_CONTRACT_RISK_MATERIAL_DAMAGE:
                case IMService::IM_SPECIFIC_SERVICE_CONTRACT_ALL_RISK:
                case IMService::IM_SPECIFIC_SERVICE_CONTRACT_RISK_THIRD_PARTY_LIABILITY:
                    $contractAllRiskForm = $this->contractAllRiskForm;
                    $contractAllRiskEntity = new ContractAllRisk();

                    $contractAllRiskForm->bind($contractAllRiskEntity);
                    $contractAllRiskForm->setData($post);
                    if ($contractAllRiskForm->isValid()) {
                        try {
                            $data = $contractAllRiskForm->getData();
                            if (count($post["valueName"]) > 0 || count($post["value"]) > 0) {
                                // process object contractALlRisk Value list here
                                for ($count = 1; $count <= count($post["valueName"]); $count ++) {
                                    $contractAllRiskValueListEntity = new ContractAllRiskValueList();
                                    $contractAllRiskValueListEntity->setContractAllRisk($contractAllRiskEntity)
                                        ->setCurrency($em->find("Settings\Entity\Currency", CurrencyService::NIGERIA_NAIRA))
                                        ->setValue(CurrencyService::cleanInputValueStatic($post["value"][$count]))
                                        ->setValueName($post["valueName"][$count]);

                                    $em->persist($contractAllRiskValueListEntity);
                                }
                            }
                            $coverDetailsEntity->setContractAllRisk($contractAllRiskEntity)->setCreatedOn(new \DateTime());

                            $em->persist($contractAllRiskEntity);
                            $em->persist($coverDetailsEntity);
                            $em->persist($proposalEntity);

                            $em->flush();
                            $gritter = new GritterMessage();
                            $gritter->setText("Successfully updated Cover");
                            $gritter->setTitle("Success");
                            $gritter->setType(GritterMessage::TYPE_SUCCESS);
                            $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);
                            $response->add($gritter);

                            $this->flashmessenger()->addSuccessMessage("Successfully hydrated object information");
                            $refresh = new Redirect($this->url()->fromRoute("proposal/default", array(
                                "action" => "process"
                            )));

                            $response->add($refresh);
                        } catch (\Exception $e) {
                            $response->add($this->coverDetailGritterError("Cover Details Hydration Error", "We could not create object cover details"));
                        }
                    } else {
                        $response->add($this->coverDetailGritterError("Validation Eror", "object form filled did not meet minimum validation requirements"));
                    }
                    break;

                case IMService::IM_SPECIFIC_SERVICE_DIRECTORS_LIABILITY:
                    $directorsLiabilityEntity = new DirectorsLiability();
                    $directorsLiabilityForm = $this->directorsLiabilityForm;
                    $directorsLiabilityForm->bind($directorsLiabilityEntity);
                    $directorsLiabilityForm->setData($post);
                    if ($directorsLiabilityForm->isValid()) {
                        $data = $directorsLiabilityForm->getData();

                        if (count($data->getProcedureList()) > 0) {
                            foreach ($data->getProcedureList() as $list) {
                                $directorsLiabilityEntity->addProcedureList($list);
                            }
                        }
                        $coverDetailsEntity->setDirectorsLiability($directorsLiabilityEntity)->setCreatedOn(new \DateTime());

                        try {
                            $em->persist($directorsLiabilityEntity);
                            $em->persist($coverDetailsEntity);
                            $em->persist($proposalEntity);
                            $em->flush();
                            
                            $gritter = new GritterMessage();
                            $gritter->setText("Successfully updated Cover");
                            $gritter->setTitle("Success");
                            $gritter->setType(GritterMessage::TYPE_SUCCESS);
                            $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);
                            $response->add($gritter);

                            $this->flashmessenger()->addSuccessMessage("Successfully hydrated cover details");
                            $refresh = new Redirect($this->url()->fromRoute("proposal/default", array(
                                "action" => "process"
                            )));
                            $response->add($refresh);
                            // $redirec
                        } catch (\Exception $e) {
                            $response->add($this->coverDetailGritterError("Cover Details Hydration Error", "We could not create object cover details"));
                        }
                    } else {
                        $response->add($this->coverDetailGritterError("Validation Eror", "object form filled did not meet minimum validation requirements"));
                    }
                    break;
                case IMService::IM_SPECIFIC_SERVICE_ELECTRONIC_EQUIPMENT_EXTERNAL_DATA:
                case IMService::IM_SPECIFIC_SERVICE_ELECTRONIC_EQUIPMENT_INCREASED_COST:
                case IMService::IM_SPECIFIC_SERVICE_ELECTRONIC_EQUIPMENT_MATERIAL_DAMAGE:
                    $electronicEquipmentForm = $this->electronicEquipmentForm;
                    $electronicEquipmentEntity = new ElectronicEquipment();
                    $electronicEquipmentForm->bind($electronicEquipmentEntity);
                    $electronicEquipmentForm->setData($post);

                    if ($electronicEquipmentForm->isValid()) {
                        $data = $electronicEquipmentForm->getData();
                        try {
                            $coverDetailsEntity->setElectonicEquipment($electronicEquipmentEntity)->setCreatedOn(new \DateTime());
                            if (count($data->getScopeOfCover())) {
                                foreach ($data->getScopeOfCover() as $cover) {
                                    $electronicEquipmentEntity->addScopeOfCover($cover);
                                }
                            }
                            $em->persist($coverDetailsEntity);
                            $em->persist($proposalEntity);
                            $em->persist($electronicEquipmentEntity);

                            $em->flush();
                            
                            $gritter = new GritterMessage();
                            $gritter->setText("Successfully updated Cover");
                            $gritter->setTitle("Success");
                            $gritter->setType(GritterMessage::TYPE_SUCCESS);
                            $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);
                            $response->add($gritter);

                            $this->flashmessenger()->addSuccessMessage("Successfully hydrated cover details");
                            $refresh = new Redirect($this->url()->fromRoute("proposal/default", array(
                                "action" => "process"
                            )));
                            $response->add($refresh);
                        } catch (\Exception $e) {
                            $response->add($this->coverDetailGritterError("Cover Details Hydration Error", "We could not create object cover details"));
                        }
                    } else {
                        $response->add($this->coverDetailGritterError("Validation Eror", "object form filled did not meet minimum validation requirements"));
                    }
                    break;

                case IMService::IM_SPECIFIC_SERVICE_EMPLOYERS_LIABILITY:
                    $employeeLiabilityForm = $this->employeeLiabilityForm;
                    $employeeLiabilityEntity = new EmployerLiability();
                    $employeeLiabilityForm->bind($employeeLiabilityEntity);

                    $employeeLiabilityForm->setData($post);
                    if ($employeeLiabilityForm->isValid()) {
                        $data = $employeeLiabilityForm->getData();
                        try {
                            $coverDetailsEntity->setEmployersLiability($employeeLiabilityEntity)->setCreatedOn(new \DateTime());

                            if (count($post["numbersOfEmployee"]) || count($post["estimatedPeriodWage"])) {
                                for ($count = 1; $count <= count($post["estimatedPeriodWage"]); $count ++) {
                                    $employeeLiabilityDetailsEntity = new EmployerLiabilityDetails();
                                    $employeeLiabilityDetailsEntity->setEmployeeDescription($post["employeeDescription"][$count])
                                        ->setEmployerLiability($employeeLiabilityEntity)
                                        ->setEstimatedPeriodWage($post["estimatedPeriodWage"][$count])
                                        ->setNumbersOfEmployee($post["numbersOfEmployee"][$count]);

                                    $em->persist($employeeLiabilityDetailsEntity);
                                }
                            }
                            $em->persist($employeeLiabilityEntity);
                            $em->persist($coverDetailsEntity);
                            $em->persist($proposalEntity);

                            $em->flush();

                            $gritter = new GritterMessage();
                            $gritter->setText("Successfully updated Cover");
                            $gritter->setTitle("Success");
                            $gritter->setType(GritterMessage::TYPE_SUCCESS);
                            $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);
                            $response->add($gritter);
                            
                            $this->flashmessenger()->addSuccessMessage("Successfully hydrated information");
                            $refresh = new Redirect($this->url()->fromRoute("proposal/default", array(
                                "action" => "process"
                            )));
                            $response->add($refresh);
                        } catch (\Exception $e) {
                            $response->add($this->coverDetailGritterError("Cover Details Hydration Error", "We could not create object cover details"));
                        }
                    } else {
                        $response->add($this->coverDetailGritterError("Validation Error", "object form filled did not meet minimum validation requirements"));
                    }
                    break;
                case IMService::IM_SPECIFIC_SERVICE_FIDELITY_GUARATEE:
                    $fidelityGuarateeForm = $this->fidelityGuarateeForm;
                    $fidelityGuarateeEntity = new FidelityGaurantee();

                    $fidelityGuarateeForm->bind($fidelityGuarateeEntity);
                    $fidelityGuarateeForm->setData($post);

                    if ($fidelityGuarateeForm->isValid()) {
                        $data = $fidelityGuarateeForm->getData();
                        try {
                            $coverDetailsEntity->setFidelityGaruantee($fidelityGuarateeEntity)->setCreatedOn(new \DateTime());
                            if (count($post['employyefullName']) > 0 || count($post['employeeSalary']) > 0) {
                                for ($count = 0; $count <= count($post["employeeSalary"]); $count ++) {
                                    $fidelityEmployeListEntity = new FidelityGuarateeList();
                                    $fidelityEmployeListEntity->setFidelityGuaratee($fidelityGuarateeEntity)
                                        ->setEmployeeCapacity($post["employeeCapacity"][$count])
                                        ->setEmployeeGuarateeAmount($post["employeeGuarateeAmount"][$count])
                                        ->setEmployeeSalary($post['employeeSalary'][$count])
                                        ->setEmployyefullName($post['employyefullName'][$count]);

                                    $em->persist($fidelityEmployeListEntity);
                                }
                            }
                            $em->persist($fidelityGuarateeEntity);
                            $em->persist($coverDetailsEntity);
                            $em->persist($proposalEntity);

                            $em->flush();
                            $this->flashmessenger()->addSuccessMessage("Successfully hydrated object information");
                            $gritter = new GritterMessage();
                            $gritter->setText("Successfully hydrated object information");
                            $gritter->setTitle("Success");
                            $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);
                            $gritter->setType(GritterMessage::TYPE_SUCCESS);
                            $response->add($gritter);
                            $refresh = new Redirect($this->url()->fromRoute("proposal/default", array(
                                "action" => "process"
                            )));
                            $response->add($refresh);
                            return $this->getResponse()->setContent($response);
                        } catch (\Exception $e) {
                            $response->add($this->coverDetailGritterError("Cover Details Hydration Error", "We could not create object cover details"));
                        }
                    } else {
                        $response->add($this->coverDetailGritterError("Validation Error", "object form filled did not meet minimum validation requirements"));
                    }
                    break;

                case IMService::IM_SPECIFIC_SERVICE_FIRE_PERIL:
                    $fireNSpecialPerilForm = $this->fireSpecialPerilForm;
                    $fireNSpecialPerilEntity = new FireAndSpecialPeril();
                    $fireNSpecialPerilForm->bind($fireNSpecialPerilEntity);
                    $fireNSpecialPerilForm->setData($post);

                    if ($fireNSpecialPerilForm->isValid()) {
                        $coverDetailsEntity->setFireNSpecialPeril($fireNSpecialPerilEntity)->setCreatedOn(new \DateTime());
                        try {
                            $em->persist($coverDetailsEntity);
                            $em->persist($fireNSpecialPerilEntity);
                            $em->persist($proposalEntity);

                            $em->flush();
                            $this->flashmessenger()->addSuccessMessage("Successfully hydrated object information");
                            $gritter = new GritterMessage();
                            $gritter->setText("Successfully hydrated object information");
                            $gritter->setTitle("Success");
                            $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);
                            $gritter->setType(GritterMessage::TYPE_SUCCESS);
                            $response->add($gritter);
                            $refresh = new Redirect($this->url()->fromRoute("proposal/default", array(
                                "action" => "process"
                            )));
                            $response->add($refresh);
                            return $this->getResponse()->setContent($response);
                        } catch (\Exception $e) {
                            $response->add($this->coverDetailGritterError("Cover Details Hydration Error", "We could not create object cover details"));
                        }
                    } else {

                        $response->add($this->coverDetailGritterError("Validation Error", "object form filled did not meet minimum validation requirements"));
                    }
                    break;
                case IMService::IM_SPECIFIC_SERVICE_GROUP_LIFE_ASSURANCE:
                    $groupLifeForm = $this->groupLifeForm;
                    $groupLifeEntity = new GroupLife();
                    $groupLifeForm->bind($groupLifeEntity);
                    $groupLifeForm->setData($post);
                    if ($groupLifeForm->isValid()) {
                        $coverDetailsEntity->setGroupLife($groupLifeEntity)->setCreatedOn(new \DateTime());
                        if (count($post["employeeName"]) > 0) {
                            for ($count = 1; $count <= count($post["employeeName"]); $count ++) {
                                $groupLifeEmployeeEntity = new GroupLifeEmployeeList();
                                $groupLifeEmployeeEntity->setAnnualEmolument($post["annualEmolument"][$count])
                                    ->setBeneficiary($post["beneficiary"][$count])
                                    ->setEmployeeName($post["employeeName"][$count])
                                    ->setGroupLife($groupLifeEntity)
                                    ->setLifeAssuranceBenefit($post["lifeAssuranceBenefit"][$count]);

                                $em->persist($groupLifeEmployeeEntity);
                            }
                        }
                        try {
                            $em->persist($coverDetailsEntity);
                            $em->persist($proposalEntity);
                            $em->persist($groupLifeEntity);

                            $em->flush();

                            $this->flashmessenger()->addSuccessMessage("Successfully hydrated information");
                            $gritter = new GritterMessage();
                            $gritter->setTitle("Success");
                            $gritter->setText("Successfully hydrated information");
                            $gritter->setType(GritterMessage::TYPE_SUCCESS);
                            $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);

                            $response->add($gritter);

                            $refresh = new Redirect($this->url()->fromRoute("proposal/default", array(
                                "action" => "process"
                            )));
                            $response->add($refresh);
                        } catch (\Exception $e) {
                            var_dump($e->getMessage());
                            $response->add($this->coverDetailGritterError("Hydration Error", "Data could not be processed"));
                        }
                    } else {
                        $response->add($this->coverDetailGritterError("Validation Error", "object form filled did not meet minimum validation requirements"));
                    }
                    break;
                case IMService::IM_SPECIFIC_SERVICE_GIT_ALL_RISK:
                case IMService::IM_SPECIFIC_SERVICE_GIT_RESTRICTED_COVER:
                    $gitForm = $this->gitForm;
                    $gitEntity = new GoodsInTransit();
                    $gitForm->bind($gitEntity);
                    $gitForm->setData($post);

                    if ($gitForm->isValid()) {
                        $data = $gitForm->getData();
                        $coverDetailsEntity->setGit($gitEntity)->setCreatedOn(new \DateTime());

                        if (count($data->getSpecificGoods()) > 0) {
                            foreach ($data->getSpecificGoods() as $goods) {

                                $gitEntity->addSpecificGoods($goods);
                            }
                        }

                        if (count($post["regNo"]) > 0 || count($post["carMake"])) {
                            for ($count = 0; $count < count($post["regNo"]); $count ++) {
                                $vehicleDetailsEntity = new GITVehicleDetails();
                                $vehicleDetailsEntity->setBodyType($post["bodyType"][$count])
                                    ->setCarMake($post["carMake"][$count])
                                    ->setGit($gitEntity)
                                    ->setManuYear($post["manuYear"][$count])
                                    ->setMaxCapacity($post["maxCapacity"][$count])
                                    ->setOobjectrMake($post["oobjectrMake"][$count])
                                    ->setRegNo($post["regNo"][$count]);

                                $em->persist($vehicleDetailsEntity);
                            }
                        }

                        try {

                            $em->persist($coverDetailsEntity);
                            $em->persist($gitEntity);
                            $em->persist($proposalEntity);

                            $em->flush();
                            $this->flashmessenger()->addSuccessMessage("Successfully hydrated object information");
                            $refresh = new Redirect($this->url()->fromRoute("proposal/default", array(
                                "action" => "process"
                            )));
                            $response->add($refresh);
                        } catch (\Exception $e) {

                            $response->add($this->coverDetailGritterError("Cover Details Hydration Error", "We could not create object cover details"));
                        }
                    } else {
                        $response->add($this->coverDetailGritterError("Validation Error", "object form filled did not meet minimum validation requirements"));
                    }
                    break;

                case IMService::IM_SPECIFIC_SERVICE_GROUP_OCCUPATIONAL_ACCIDENT:
                case IMService::IM_SPECIFIC_SERVICE_GROUP_PERSONAL_ALL_ACCIDENT:
                    $groupPersonalAccidentForm = $this->groupPersonalAccidentForm;
                    $groupPersonalAccidentEntity = new GroupPeronalAccident();
                    $groupPersonalAccidentForm->bind($groupPersonalAccidentEntity);
                    $groupPersonalAccidentForm->setData($post);
                    if ($groupPersonalAccidentForm->isValid()) {
                        $data = $groupPersonalAccidentForm->getData();
                        try {
                            if ($data->getPersonalAccidentType()->getId() == "10") {
                                if (count($post['name']) > 0) {
                                    for ($count = 1; $count <= count($post['name']); $count ++)
                                        $groupPersonalFixedDetailsEntity = new GroupPersonalFixedDetails();
                                    $groupPersonalFixedDetailsEntity->setDob(new \DateTime($post['dob'][$count]))
                                        ->setName($post["name"][$count])
                                        ->setOccupation($post["occupation"][$count])
                                        ->setPermanentDisablement($post['permanentDisablement'][$count])
                                        ->setTemporaryDisablementTotal($post["temporaryDisablementTotal"][$count])
                                        ->setGroupPersonalAccident($groupPersonalAccidentEntity);

                                    // $em->persist($groupPersonalFixedDetailsEntity);
                                }
                            }

                            if ($data->getPersonalAccidentType()->getId() == "20") {
                                if (count($post['occupation']) > 0) {
                                    for ($count = 1; $count <= count($post['occupation']); $count ++) {
                                        $groupPersonalWagesDetailsEntity = new GroupPersonalWagesDetails();
                                        $groupPersonalWagesDetailsEntity->setGrossAnnualSalary($post["grossAnnualSalary"][$count])
                                            ->setIsDeath($post['isDeath'][$count])
                                            ->setIsLossOfEyes($post["isLossOfEyes"][$count])
                                            ->setIsLossOfLimbs($post['isLossOfLimbs'][$count])
                                            ->setMedicalExpenseLimit($post['medicalExpenseLimit'][$count])
                                            ->setNumberOfEmployee($post['numberOfEmployee'][$count])
                                            ->setOccupation($em->find("Settings\Entity\OccupationalCategory", $post['occupation'][$count]))
                                            ->setOobjectrOccupation($post["oobjectrOccupation"][$count])
                                            ->setPermanentDisablement($post['permanentDisablement'][$count])
                                            ->setTemporaryDisablementTotal($post['temporaryDisablementTotal'][$count])
                                            ->setGroupPersonalAccident($groupPersonalAccidentEntity);

                                        $em->persist($groupPersonalWagesDetailsEntity);
                                    }
                                }
                            }
                            //
                            $coverDetailsEntity->setGroupPersonalAccident($groupPersonalAccidentEntity)->setCreatedOn(new \DateTime());

                            $em->persist($coverDetailsEntity);
                            $em->persist($proposalEntity);
                            $em->persist($groupPersonalAccidentEntity);

                            $em->flush();

                            $gritter = new GritterMessage();
                            $gritter->setType(GritterMessage::TYPE_SUCCESS);
                            $gritter->setTitle("Success");
                            $gritter->setText("Successfully hydrated information");
                            $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);

                            $response->add($gritter);
                            $this->flashmessenger()->addSuccessMessage("Successfully hydrated information");

                            $refresh = new Redirect($this->url()->fromRoute("proposal/default", array(
                                "action" => "process"
                            )));

                            $response->add($refresh);
                        } catch (\Exception $e) {
                            $response->add($this->coverDetailGritterError("Cover Details Hydration Error", "We could not create object cover details"));
                        }
                    } else {
                        $response->add($this->coverDetailGritterError("Validation Error", "object form is invalid pleas try again"));
                    }
                    break;

                case IMService::IM_SPECIFIC_SERVICE_HOME_COMPREHENSIVE:
                    $homeInsuranceForm = $this->homeInsuranceForm;
                    $homeInsuranceEntity = new HomeInsurance();
                    $homeInsuranceForm->bind($homeInsuranceEntity);
                    $homeInsuranceForm->setData($post);
                    if ($homeInsuranceForm->isValid()) {
                        $coverDetailsEntity->setHomeInsurance($homeInsuranceEntity)->setCreatedOn(new \DateTime());

                        if (count($post["goodsName"]) > 0 || count($post["value"])) {
                            for ($count = 1; $count <= count($post["goodsName"]); $count ++) {
                                $houseGoodsEntity = new HouseHoldGoods();
                                $houseGoodsEntity->setGoodsName($post["goodsName"][$count])
                                    ->setSerialNumber($post["serialNumber"][$count])
                                    ->setValue($post["value"][$count])
                                    ->setHomeInsurance($homeInsuranceEntity);

                                $em->persist($houseGoodsEntity);
                            }
                        }

                        if (count($post["name"]) > 0 || count($post["cost"])) {
                            for ($count = 1; $count <= count($post["goodsName"]); $count ++) {
                                $houseValuablesENtity = new HouseValuables();
                                $houseValuablesENtity->setCost($post["cost"][$count])
                                    ->setName($post["name"][$count])
                                    ->setHomeInsurance($homeInsuranceEntity);
                                $em->persist($houseValuablesENtity);
                            }
                        }

                        try {
                            $em->persist($homeInsuranceEntity);
                            $em->persist($proposalEntity);
                            $em->persist($coverDetailsEntity);

                            $em->flush();

                            $gritter = new GritterMessage();
                            $gritter->setTitle("Success");
                            $gritter->setText("Successfully Hydrated Information");
                            $gritter->setType(GritterMessage::TYPE_SUCCESS);
                            $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);

                            $response->add($gritter);

                            $this->flashmessenger()->addSuccessMessage("Successfully hydrated information");

                            $refresh = new Redirect($this->url()->fromRoute("proposal/default", array(
                                "action" => "process"
                            )));
                            $response->add($refresh);
                        } catch (\Exception $e) {
                            $response->add($this->coverDetailGritterError("Cover Details Hydration Error", "We could not create object cover details"));
                        }
                    } else {
                        $response->add($this->coverDetailGritterError("Validation Error", "object form is invalid pleas try again"));
                    }
                    break;

                case IMService::IM_SPECIFIC_SERVICE_HULL_YACHT:
                case IMService::IM_SPECIFIC_SERVICE_HULL_FISHING_VESSEL:
                case IMService::IM_SPECIFIC_SERVICE_HULL_PORT_RISK:
                case IMService::IM_SPECIFIC_SERVICE_HULL_TIME_HULL:
                case IMService::IM_SPECIFIC_SERVICE_HULL_SPEED_BOAT:
                case IMService::IM_SPECIFIC_SERVICE_HULL_VOYAGE_CLAUSE:
                    $marineHullForm = $this->marineHullForm;
                    $marineHullEntity = new Hull();
                    $marineHullForm->bind($marineHullEntity);
                    $marineHullForm->setData($post);
                    if ($marineHullForm->isValid()) {
                        $coverDetailsEntity->setMarineHull($marineHullEntity)->setCreatedOn(new \DateTime());
                        try {
                            $em->persist($coverDetailsEntity);
                            $em->persist($marineHullEntity);
                            $em->persist($proposalEntity);

                            $em->flush();
                            $this->flashmessenger()->addSuccessMessage("Successfully hydrated object information");
                            $refresh = new Redirect($this->url()->fromRoute("proposal/default", array(
                                "action" => "process"
                            )));
                            $response->add($refresh);
                        } catch (\Exception $e) {
                            $response->add($this->coverDetailGritterError("Cover Details Hydration Error", "We could not create object cover details"));
                        }
                    } else {
                        // var_dump($marineHullForm->getMessages());
                        $response->add($this->coverDetailGritterError("Validation Error", "object form filled did not meet minimum validation requirements"));
                    }
                    break;
                case IMService::IM_SPECIFIC_SERVICE_LIFE_ASSURANCE:
                    $lifePolicyForm = $this->lifeAssuranceForm;
                    $lifePolicyEntity = new LifePolicy();
                    $lifePolicyForm->bind($lifePolicyEntity);
                    $lifePolicyForm->setData($post);
                    if ($lifePolicyForm->isValid()) {
                        // if($pos)
                        $coverDetailsEntity->setLifePolicy($lifePolicyEntity)->setCreatedOn(new \DateTime());
                        try {
                            $em->persist($proposalEntity);
                            $em->persist($coverDetailsEntity);
                            $em->persist($lifePolicyEntity);

                            $em->flush();
                            $gritter = new GritterMessage();
                            $gritter->setTitle("Success");
                            $gritter->setText("Successfully Hydrated Information");
                            $gritter->setType(GritterMessage::TYPE_SUCCESS);
                            $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);

                            $response->add($gritter);

                            $this->flashmessenger()->addSuccessMessage("Successfully hydrated data");
                            $redirect = new Redirect($this->url()->fromRoute("proposal/default", array(
                                "action" => "process"
                            )));
                            $response->add($redirect);
                        } catch (\Exception $e) {
                            $response->add($this->coverDetailGritterError("Hyration Error", "Data could not be hydrated please contact admin"));
                        }
                    } else {
                        $response->add($this->coverDetailGritterError("Validation Error", "object form filled did not meet minimum validation requirements"));
                    }
                    break;

                case IMService::IM_SPECIFIC_SERVICE_MACHINE_BREAKDOWN:
                    $machineBreakdownForm = $this->machineBreakDownForm;
                    $machineBreakdownEntity = new MachineryBreakDown();
                    $machineBreakdownForm->bind($machineBreakdownEntity);
                    $machineBreakdownForm->setData($post);

                    if ($machineBreakdownForm->isValid()) {
                        $coverDetailsEntity->setMachineryBreakdown($machineBreakdownEntity)->setCreatedOn(new \DateTime());

                        try {
                            $em->persist($coverDetailsEntity);
                            $em->persist($proposalEntity);
                            $em->persist($machineBreakdownEntity);

                            $em->flush();

                            $gritter = new GritterMessage();
                            $gritter->setTitle("Success");
                            $gritter->setText("Successfully Hydrated Information");
                            $gritter->setType(GritterMessage::TYPE_SUCCESS);
                            $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);

                            $response->add($gritter);

                            $this->flashmessenger()->addSuccessMessage("Successfully hydrated data");
                            $redirect = new Redirect($this->url()->fromRoute("proposal/default", array(
                                "action" => "process"
                            )));
                            $response->add($redirect);
                        } catch (\Exception $e) {
                            $response->add($this->coverDetailGritterError("Hyration Error", "Data could not be hydrated please contact admin"));
                        }
                    } else {
                        $response->add($this->coverDetailGritterError("Validation Error", "object form filled did not meet minimum validation requirements"));
                    }
                    break;
                case IMService::IM_SPECIFIC_SERVICE_MARINE_CARGO_ICC_A:
                case IMService::IM_SPECIFIC_SERVICE_MARINE_CARGO_ICC_B:
                case IMService::IM_SPECIFIC_SERVICE_MARINE_CARGO_ICC_C:
                    $marineCargoForm = $this->marineCargoForm;
                    $marineCargoEntity = new MarineCargo();
                    $marineCargoForm->bind($marineCargoEntity);
                    $marineCargoForm->setData($post);

                    if ($marineCargoForm->isValid()) {
                        $coverDetailsEntity->setMarineCargo($marineCargoEntity)->setCreatedOn(new \DateTime());
                        try {
                            $em->persist($coverDetailsEntity);
                            $em->persist($marineCargoEntity);
                            $em->persist($proposalEntity);
                            $em->flush();

                            $gritter = new GritterMessage();
                            $gritter->setType(GritterMessage::TYPE_SUCCESS);
                            $gritter->setTitle("Success");
                            $gritter->setText("Successfull hydration");
                            $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);

                            $response->add($gritter);

                            $this->flashmessenger()->addSuccessMessage("Successfully hydrated object information");
                            $refresh = new Redirect($this->url()->fromRoute("proposal/default", array(
                                "action" => "process"
                            )));
                            $response->add($refresh);
                        } catch (\Exception $e) {
                            $response->add($this->coverDetailGritterError("Cover Details Hydration Error", "We could not create object cover details"));
                        }
                    } else {
                        $response->add($this->coverDetailGritterError("Validation Error", "object form filled did not meet minimum validation requirements"));
                    }

                    break;

                case IMService::IM_SPECIFIC_SERVICE_OCUPPIERS_LIABILITY:
                    $occupierLiabilityForm = $this->occupiersLiabilityForm;
                    $occupierLiabilityEntity = new OccupiersLiability();
                    $occupierLiabilityForm->setData($post);
                    $occupierLiabilityForm->bind($occupierLiabilityEntity);

                    if ($occupierLiabilityForm->isValid()) {
                        $coverDetailsEntity->setCreatedOn(new \Datetime())->setOccupiersLiability($occupierLiabilityEntity);

                        try {
                            if (count($post["fullname"]) != 0 || count($post["natureOfWork"]) != 0) {
                                for ($count = 1; $count <= count($post["natureOfWork"]); $count ++) {
                                    $occupierStaffEntity = new OccupiersLiabilityDomesticStaff();
                                    $occupierStaffEntity->setEmploymentDuration($post["employmentDuration"]["$count"])
                                        ->setFullName($post["fullName"][$count])
                                        ->setNatureOfWork($post["natureOfWork"][$count])
                                        ->setOccupiersLiability($occupierLiabilityEntity)
                                        ->setWages($post["wages"][$count]);

                                    $em->persist($occupierStaffEntity);
                                }
                            }

                            if (count($post["fullNamef"]) != 0 || count($post["relationship"])) {
                                for ($count = 1; $count <= count($post["fullNamef"]); $count ++) {
                                    $occupierFamilyEntity = new OccupiersLiabilityFamilyMembers();
                                    $occupierFamilyEntity->setDob(new \Datetime($post["dob"][$count]))
                                        ->setFullNamef($post["fullNamef"][$count])
                                        ->setOccupiersLiability($occupierLiabilityEntity)
                                        ->setRelationship($post["relationship"][$count])
                                        ->setSex($em->find("Settings\Entity\Sex", $post["sex"][$count]));
                                    $em->persist($occupierFamilyEntity);
                                }
                            }

                            $em->persist($occupierLiabilityEntity);
                            $em->persist($proposalEntity);
                            $em->persist($coverDetailsEntity);

                            $em->flush();

                            $gritter = new GritterMessage();
                            $gritter->setType(GritterMessage::TYPE_SUCCESS);
                            $gritter->setTitle("Success");
                            $gritter->setText("Successfull hydration");
                            $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);

                            $response->add($gritter);

                            $this->flashmessenger()->addSuccessMessage("Successfully hydrated object information");
                            $refresh = new Redirect($this->url()->fromRoute("proposal/default", array(
                                "action" => "process"
                            )));
                            $response->add($refresh);
                        } catch (\Exception $e) {
                            $response->add($this->coverDetailGritterError("Cover Details Hydration Error", "We could not create object cover details"));
                        }
                    } else {
                        $response->add($this->coverDetailGritterError("Validation Error", "object form filled did not meet minimum validation requirements"));
                    }
                    break;
                case IMService::IM_SPECIFIC_SERVICE_OIL_GAS_ENERGY:
                    $oilEnergyForm = $this->oilEnergyForm;
                    $oilEnergyEntity = new OilEnergyInsurance();
                    $oilEnergyForm->bind($oilEnergyEntity);
                    $oilEnergyForm->setData($post);

                    if ($oilEnergyForm->isValid()) {
                        $data = $oilEnergyForm->getData();
                        $coverDetailsEntity->setOilEnergyInsurance($oilEnergyEntity)->setCreatedOn(new \DateTime());
                        if (count($data->getNonOilRisk()) > 0) {
                            foreach ($data->getNonOilRisk() as $nonOilRisk) {
                                // foreach ($nonOilRisk as $nrisk){
                                $oilEnergyEntity->addNonOilRisk($nonOilRisk);
                                // }
                            }
                        }
                        $oilRisk = NULL;
                        if (count($data->getOilRisk()) > 0) {
                            foreach ($data->getOilRisk() as $oilRisk) {
                                // foreach ($oilRisk as $oRisk){
                                $oilEnergyEntity->addOilRisk($oilRisk);
                                // }
                            }
                        }
                        try {

                            $em->persist($coverDetailsEntity);
                            $em->persist($oilEnergyEntity);
                            $em->persist($proposalEntity);

                            $em->flush();
                            $this->flashmessenger()->addSuccessMessage("Successfully hydrated object information");
                            $refresh = new Redirect($this->url()->fromRoute("proposal/default", array(
                                "action" => "process"
                            )));
                            $gritter = new GritterMessage();
                            $gritter->setText("Successfully Hydrated Information");
                            $gritter->setTitle("Success");
                            $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);
                            $gritter->setTitle(GritterMessage::TYPE_SUCCESS);
                            $response->add($refresh);
                        } catch (\Exception $e) {
                            $response->add($this->coverDetailGritterError("Cover Details Hydration Error", "We could not create object cover details"));
                        }
                    } else {
                        $response->add($this->coverDetailGritterError("Validation Error", "object form filled did not meet minimum validation requirements"));
                    }
                    break;

                case IMService::IM_SPECIFIC_SERVICE_PERSONAL_ACCIDENT:
                    // $personalAccidentForm = $this->perso
                    // $personalAccidentForm = $this->per;
                    break;

                case IMService::IM_SPECIFIC_SERVICE_PLANT_ALL_RISK:
                    $plantAllRiskForm = $this->machineBreakDownForm;
                    $plantAllRiskEntity = new MachineryBreakDown();
                    $plantAllRiskForm->bind($plantAllRiskEntity);
                    $plantAllRiskForm->setData($post);

                    if ($plantAllRiskForm->isValid()) {
                        $coverDetailsEntity->setCreatedOn(new \Datetime())->setPlantAllRisk($plantAllRiskEntity);

                        try {

                            $plantAllRiskEntity->setIsPlantAllRisk(TRUE);

                            $em->persist($coverDetailsEntity);
                            $em->persist($proposalEntity);
                            $em->persist($plantAllRiskEntity);

                            $em->flush();

                            $gritter = new GritterMessage();
                            $gritter->setTitle("Success");
                            $gritter->setText("Successfully Hydrated Information");
                            $gritter->setType(GritterMessage::TYPE_SUCCESS);
                            $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);

                            $response->add($gritter);

                            $this->flashmessenger()->addSuccessMessage("Successfully hydrated data");
                            $redirect = new Redirect($this->url()->fromRoute("proposal/default", array(
                                "action" => "process"
                            )));
                            $response->add($redirect);
                        } catch (\Exception $e) {
                            $response->add($this->coverDetailGritterError("Cover Details Hydration Error", "We could not create object cover details"));
                        }
                    } else {
                        $response->add($this->coverDetailGritterError("Validation Error", "object form filled did not meet minimum validation requirements"));
                    }
                    break;

                case IMService::IM_SPECIFIC_SERVICE_PUBLIC_LIABILTY:
                    $publicLiabilityForm = $this->publicLiabilityForm;
                    $publicLiabilityEntity = new PublicLiability();
                    $publicLiabilityForm->bind($publicLiabilityEntity);
                    $publicLiabilityForm->setData($post);

                    if ($publicLiabilityForm->isValid()) {
                        $coverDetailsEntity->setPublicLiability($publicLiabilityEntity)->setCreatedOn(new \DateTime());
                        if (count($post["noOfEmployees"]) > 0 || count($post["natureOfWork"]) > 0) {
                            for ($count = 1; $count <= count($post['noOfEmployees']); $count ++) {
                                $publicLiabilityEmployeeDetailsEntity = new PublicLiabilityEmployeeDetails();
                                $publicLiabilityEmployeeDetailsEntity->setInsuranceConnection($post["insuranceConnection"][$count])
                                    ->setNatureOfWork($post["natureOfWork"][$count])
                                    ->setNoOfEmployees($post["noOfEmployees"][$count])
                                    ->setPublicLiability($publicLiabilityEntity);

                                $em->persist($publicLiabilityEmployeeDetailsEntity);
                            }
                        }
                        try {
                            $em->persist($coverDetailsEntity);
                            $em->persist($publicLiabilityEntity);
                            $em->persist($proposalEntity);

                            $em->flush();
                            // $em->flush();

                            $gritter = new GritterMessage();
                            $gritter->setTitle("Success");
                            $gritter->setText("Successfully Hydrated Information");
                            $gritter->setType(GritterMessage::TYPE_SUCCESS);
                            $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);

                            $response->add($gritter);

                            $this->flashmessenger()->addSuccessMessage("Successfully hydrated data");
                            $redirect = new Redirect($this->url()->fromRoute("proposal/default", array(
                                "action" => "process"
                            )));
                            $response->add($redirect);
                        } catch (\Exception $e) {
                            $response->add($this->coverDetailGritterError("Cover Details Hydration Error", "We could not create object cover details"));
                        }
                    } else {
                        $response->add($this->coverDetailGritterError("Validation Error", "object form filled did not meet minimum validation requirements"));
                    }
                    break;

                case IMService::IM_SPECIFIC_SERVICE_PROFESSIONAL_INDEMNTY:
                    $professionalIndemnityForm = $this->proffesionalIndemnityForm;
                    $professionalIndemnityEntity = new ProfessionalIndemnity();
                    $professionalIndemnityForm->bind($professionalIndemnityEntity);
                    $professionalIndemnityForm->setData($post);

                    if ($professionalIndemnityForm->isValid()) {
                        $coverDetailsEntity->setCreatedOn(new \Datetime())->setProfessionalIndemnity($professionalIndemnityEntity);

                        if (count($post["partnerName"]) > 0 || count($post["qualification"])) {
                            for ($count = 1; $count <= count($post["partnerName"]); $count ++) {

                                $partnerEntity = new ProfessionalIndemnityPartnerDetails();
                                $partnerEntity->setDateQualified(new \Datetime($post["dateQualified"][$count]))
                                    ->setPartnerCapacity($post["partnerCapacity"][$count])
                                    ->setPartnerName($post["partnerName"][$count])
                                    ->setProfessionalIndemnity($professionalIndemnityEntity)
                                    ->setQualification($post["qualification"][$count]);
                                $em->persist($partnerEntity);
                            }
                        }
                        try {

                            $em->persist($professionalIndemnityEntity);
                            $em->persist($proposalEntity);
                            $em->persist($coverDetailsEntity);

                            $em->flush();

                            $gritter = new GritterMessage();
                            $gritter->setTitle("Success");
                            $gritter->setText("Successfully Hydrated Information");
                            $gritter->setType(GritterMessage::TYPE_SUCCESS);
                            $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);

                            $response->add($gritter);

                            $this->flashmessenger()->addSuccessMessage("Successfully hydrated data");
                            $redirect = new Redirect($this->url()->fromRoute("proposal/default", array(
                                "action" => "process"
                            )));
                            $response->add($redirect);
                        } catch (\Exception $e) {
                            $response->add($this->coverDetailGritterError("Cover Details Hydration Error", "We could not create object cover details"));
                        }
                    } else {
                        $response->add($this->coverDetailGritterError("Validation Error", "object form filled did not meet minimum validation requirements"));
                    }
                    break;
                case IMService::IM_SPECIFIC_SERVICE_TRAVEL_INSURANCE:
                    // Not functioning
                    $travelInsuranceForm = $this->travelInsuranceForm;
                    $travelInsuranceEntity = new TravelInsurance();
                    $travelInsuranceForm->bind($travelInsuranceEntity);
                    $travelInsuranceForm->setData($post);

                    if ($travelInsuranceForm->isValid()) {

                        try {

                            $coverDetailsEntity->setTravelInsurance($travelInsuranceEntity)->setCreatedOn(new \DateTime());

                            $em->persist($coverDetailsEntity);

                            $em->persist($travelInsuranceEntity);

                            $em->persist($proposalEntity);

                            $em->flush();

                            $gritter = new GritterMessage();
                            $gritter->setTitle("Success");
                            $gritter->setText("Successfully Hydrated Information");
                            $gritter->setType(GritterMessage::TYPE_SUCCESS);
                            $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);

                            $response->add($gritter);

                            $this->flashmessenger()->addSuccessMessage("Successfully hydrated object information");
                            $refresh = new Redirect($this->url()->fromRoute("proposal/default", array(
                                "action" => "process"
                            )));
                            $response->add($refresh);
                        } catch (\Exception $e) {
                            // var_dump($e->getMessage());
                            $response->add($this->coverDetailGritterError("Cover Details Hydration Error", "We could not create object cover details"));
                        }
                    } else {
                        $response->add($this->coverDetailGritterError("Validation Error", "object form filled did not meet minimum validation requirements"));
                    }
                    break;
                case IMService::IM_SPECIFIC_SERVICE_WORKMEN_COMPENSATION:
                    $workmenCompensationForm = $this->workmenCompensationForm;
                    $workmenCompensationEntity = new WorkmenCompensation();
                    $workmenCompensationForm->bind($workmenCompensationEntity);
                    $workmenCompensationForm->setData($post);
                    if ($workmenCompensationForm->isValid()) {
                        // $workmenCompensationEntity->se
                        if (count($post["employeeCategoree"]) > 0 || count($post["numberOfEmployee"]) > 0) {
                            for ($count = 1; $count <= count($post['numberOfEmployee']); $count ++) {
                                $workmenDecreeListEntity = new WorkmenDecreeList();
                                $workmenDecreeListEntity->setCashCompensation($post["cashCompensation"][$count])
                                    ->setEmployeeCategoree($em->find("Settings\Entity\GroupLifeMemberClass", $post["employeeCategoree"][$count]))
                                    ->setNumberOfEmployee($post["numberOfEmployee"][$count])
                                    ->setOobjectrCompensation($post["oobjectrCompensation"][$count])
                                    ->setWorkmenCopensation($workmenCompensationEntity)
                                    ->setTotalCompensation($post["totalCompensation"][$count]);

                                $em->persist($workmenDecreeListEntity);
                            }
                        }

                        if (count($post["contractorName"]) > 0 || count($post["natureOfWork"]) > 0) {
                            for ($count = 1; $count <= count($post["natureOfWork"]); $count ++) {
                                $workmenContratorListEntity = new WorkmenCompensationSubContractorsList();
                                $workmenContratorListEntity->setContractAmount($post["contractAmount"][$count])
                                    ->setContractorName($post["contractorName"][$count])
                                    ->setNatureOfWork($post["natureOfWork"][$count])
                                    ->setWorkmenCopensation($workmenCompensationEntity);

                                $em->persist($workmenContratorListEntity);
                            }
                        }
                        try {
                            $coverDetailsEntity->setWorkmenCompensation($workmenCompensationEntity)->setCreatedOn(new \DateTime());

                            $em->persist($coverDetailsEntity);
                            $em->persist($proposalEntity);
                            $em->persist($workmenCompensationEntity);

                            $em->flush();

                            $gritter = new GritterMessage();
                            $gritter->setTitle("Success");
                            $gritter->setText("Successfully Hydrated Information");
                            $gritter->setType(GritterMessage::TYPE_SUCCESS);
                            $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);

                            $response->add($gritter);

                            $this->flashmessenger()->addSuccessMessage("Successfully hydrated information");
                            $refresh = new Redirect($this->url()->fromRoute("proposal/default", array(
                                "action" => "process"
                            )));

                            $response->add($refresh);
                        } catch (\Exception $e) {
                            $response->add($this->coverDetailGritterError("Cover details Hydration Error", "We could not submit object details please trye again later"));
                        }
                    } else {
                        $response->add($this->coverDetailGritterError("Validation Error", "object form filled did not meet minimum validation requirements"));
                    }
                    break;
            }
        } else {
            $response->add($modalView);
        }

        return $this->getResponse()->setContent($response);
    }

    private function coverDetailGritterError($title, $text)
    {
        $gritter = new GritterMessage();
        $gritter->setTitle($title);
        $gritter->setText($text);
        $gritter->setType(GritterMessage::TYPE_ERROR);
        $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);
        $gritter->setSticky(TRUE);
        return $gritter;
    }

    /**
     * Provide a modal view to enter payment customer made manually
     * This is meant to be only used if object customer does note pay through object electronic channel
     * It also make processes object invoice and changes its status to paid
     * It al;so only be used at a onetime payment of, and not for micro payment
     *
     * @return mixed
     */
    public function customerpaymentmodalAction()
    {
        $em = $this->entityManager;
        $proposalService = $this->proposalService;
        $proposalSession = $proposalService->getProposalSession();
        $proposalEntity = $em->find("Proposal\Entity\Proposal", $proposalSession->proposalId);
        $invoiceEntity = $proposalEntity->getInvoice();
        $userEntity = $this->identity();
        $manualPaymentForm = $this->manualPaymentForm;
        $manualPaymentForm->setAttributes(array(
            "id" => "simpleForm",
            "class" => "form-horizontal form-label-left ajax_element",
            "data-ajax-loader" => "myLoader",
            "action" => $this->url()
                ->fromRoute("proposal/default", array(
                "action" => "customerpaymentmodal"
            ))
        ));

        $viewModel = new ViewModel(array(
            "manualPaymentForm" => $manualPaymentForm
        ));
        $manualPaymentForm->get("manualPaymentFieldset")
            ->get("amountPaid")
            ->setValue($invoiceEntity->getAmount());
        $manualPaymentForm->get("manualPaymentFieldset")
            ->get("currency")
            ->setValue($invoiceEntity->getCurrency()
            ->getId());
        $viewModel->setTemplate("proposal-customer-payment-form-admin");

        $modal = new WasabiModal("standard", "ENTER PAYMENT FOR CUSTOMER");
        // $modal->setSize(WasabiModalConfigurator::MODAL_LG);
        $modal->setContent($viewModel);

        $modalView = new WasabiModalView("#wasabi_modal", $this->renderer, $modal);
        $response = new Response();
        $response->add($modalView);

        $request = $this->getRequest();
        if ($request->isPost()) {
            $post = $request->getPost();
            $manualPaymentForm->setData($post);
            $manualPaymentForm->setValidationGroup(array(
                "manualPaymentFieldset" => array(
                    "datePaid",
                    "paymentMode",
                    "currency",
                    "amountPaid"
                )
            ));

            if ($post["manualPaymentFieldset"]["paymentMode"] == TransactionService::TRANSACTION_MANUAL_PAYMENT_MODE_CHEQUE) {
                $manualPaymentForm->setValidationGroup(array(
                    "manualPaymentFieldset" => array(
                        "checkNumber",
                        "datePaid",
                        "paymentMode",
                        "currency",
                        "amountPaid"
                    )
                ));
            }

            if ($manualPaymentForm->isValid()) {
                $data = $manualPaymentForm->getData();

                $manualPaymentEntity = new ManualPayment();
                $manualPaymentEntity->setCreatedOn(new \DateTime())
                    ->setInvoice($invoiceEntity)
                    ->setAmountPaid($this->currencyService->cleanInputedValue($data->getAmountPaid()))
                    ->setDatePaid($data->getDatePaid())
                    ->setPaymentMode($data->getPaymentMode())
                    ->setCurrency($data->getCurrency())
                    ->setCheckNumber($data->getCheckNumber())
                    ->setUser($userEntity);
                $invoiceEntity->setStatus($em->find("Transactions\Entity\InvoiceStatus", InvoiceService::INVOICE_PAID_STATUS))
                    ->setModifiedOn(new \DateTime())
                    ->setIsMicro(False);
                $proposalEntity->setProposalStatus($em->find("Proposal\Entity\ProposalStatus", ProposalService::PROPOSAL_STATUS_PAID))
                    ->setUpdatedOn(new \DateTime())
                    ->setIsVisible(TRUE)
                    ->setIsFinalized(TRUE);
                try {
                    $em->persist($manualPaymentEntity);
                    $em->persist($invoiceEntity);
                    $em->persist($proposalEntity);
                    $em->flush();

                    // Send a mail notification to customer
                    // Send a mail notification to broker indicating payment
                    // Change invoice status to payed
                    $this->flashmessenger()->addSuccessMessage("Payment successfully processed, a receipt would be sent to customer");
                    $redirect = new Redirect($this->url()->fromRoute("proposal/default", array(
                        "action" => "process"
                    )));
                    $response->add($redirect);
                } catch (\Exception $e) {
                    $this->flashmessenger()->addErrorMessage("objectre was a problem processing object payment, please try again later");
                    $redirect = new Redirect($this->url()->fromRoute("proposal/default", array(
                        "action" => "process"
                    )));
                    $response->add($redirect);
                }
            }
        }

        return $this->getResponse()->setContent($response);
    }

    public function invoicepreviewAction()
    {
        $em = $this->entityManager;
        $invoiceService = $this->invoiceService;

        $proposalService = $this->proposalService;
        $proposalSession = $proposalService->getProposalSession();
        $proposalEntity = $em->find("Proposal\Entity\Proposal", $proposalSession->proposalId);
        $invoiceEntity = $proposalEntity->getInvoice();
        if ($invoiceEntity->getAmount() != $this->premiumService->getProposalUsablePremium($proposalEntity)) {
            $invoiceEntity->setAmount($this->premiumService->getProposalUsablePremium($proposalEntity));
            if ($proposalEntity->getIsManualPremium() == TRUE) {
                $invoiceEntity->setCurrency($proposalEntity->getManualPremium()
                    ->getCurrency());
            } else {
                $invoiceEntity->setCurrency($proposalEntity->getCurrency());
            }
            $em->persist($invoiceEntity);
            $em->flush();
        }

        // $invoiceEntity = $proposalEntity->getInvoice();
        $broker = $em->find("Users\Entity\InsuranceBrokerRegistered", $this->centralBrokerId);
        $viewModel = new ViewModel(array(
            "invoice" => $invoiceEntity,
            "broker" => $broker
        ));
        $viewModel->setTemplate("proposal-invoice-preview-modal");
        $modal = new WasabiModal("standard", "Invoice Preview");
        $modal->setSize(WasabiModalConfigurator::MODAL_LG);
        $modal->setContent($viewModel);

        $modalView = new WasabiModalView("#wasabi_modal", $this->renderer, $modal);

        $response = new Response();
        $response->add($modalView);
        return $this->getResponse()->setContent($response);
    }

    /**
     * This action displays object micro payment details as a spread
     * In a modal View Format
     *
     * @return mixed
     */
    public function micropaymentspreadAction()
    {
        $em = $this->entityManager;
        $modal = new WasabiModal("standard", "Payment Spread");
        $proposalService = $this->proposalService;
        $proposalSession = $proposalService->getProposalSession();
        $proposalEntity = $em->find("Proposal\Entity\Proposal", $proposalSession->proposalId);
        $invoiceEntity = $proposalEntity->getInvoice();

        $microPaymentEntity = $em->getRepository("Transactions\Entity\MicroPayment")->findBy(array(
            "invoice" => $invoiceEntity->getId()
        ));

        $viewModel = new ViewModel(array(
            "datas" => $microPaymentEntity,
            "invoiceEntity" => $invoiceEntity
        ));
        $viewModel->setTemplate("transaction-micro-payment-view-details");
        $modal->setContent($viewModel);
        $modalView = new WasabiModalView("#wasabi_modal", $this->renderer, $modal);
        $response = new Response();

        $response->add($modalView);

        return $this->getResponse()->setContent($response);
    }

    /**
     * This action deactivates object micro payment
     * object call is Async
     *
     * @return mixed
     */
    public function deactivatemicropayAction()
    {
        $em = $this->entityManager;
        $response = new Response();
        // if ($request->isPost()) {
        $proposalService = $this->proposalService;
        $proposalSession = $proposalService->getProposalSession();
        $proposalEntity = $em->find("Proposal\Entity\Proposal", $proposalSession->proposalId);
        $invoiceEntity = $proposalEntity->getInvoice();
        $invoiceEntity->setIsMicro(False);
        try {
            $em->persist($invoiceEntity);
            $em->flush();

            $this->flashmessenger()->addSuccessMessage("Micro Payment Successfully Deactivated");
            $redirect = new Redirect($this->url()->fromRoute("proposal/default", array(
                "action" => "process"
            )));
            $response->add($redirect);
        } catch (\Exception $e) {
            $this->flashmessenger()->addErrorMessage("Micro Paymentcould not be deactivated");
            $redirect = new Redirect($this->url()->fromRoute("proposal/default", array(
                "action" => "process"
            )));
            $response->add($redirect);
        }

        return $this->getResponse()->setContent($response);
    }

    /**
     * This generates object micropayment
     * object call is async
     *
     * @return mixed
     */
    public function generatemicropaymentAction()
    {
        $em = $this->entityManager;
        $invoiceService = $this->invoiceService;
        // if ($request->isPost()) {
        $proposalService = $this->proposalService;
        $proposalSession = $proposalService->getProposalSession();
        $proposalEntity = $em->find("Proposal\Entity\Proposal", $proposalSession->proposalId);

        $microPaymentSession = $this->invoiceService->getMicroPaymentSession();
        $microPaymentSession->isMicroPayment = TRUE;
        $divisor = $microPaymentSession->divisor;
        $value = $microPaymentSession->value;
        $microPaymentEntity = "";
        $redirect = new Redirect($this->url()->fromRoute("proposal/default", array(
            "action" => "process"
        )));
        // $offerEntity->getInvoice()->getIsMicro() == NULL || $offerEntity->getInvoice()->getIsMicro() == FALSE

        $data = $this->invoiceService->generateMicroPayment($microPaymentSession->divisor, $microPaymentSession->value);
        $invoiceEntity = "";
        $payable = "";
        $currency = "";
        if ($proposalEntity->getInvoice() != NULL) {
            $invoiceEntity = $proposalEntity->getInvoice();
            $this->removeMicro($invoiceEntity->getId());
            if ($proposalEntity->getIsManualPremium() == TRUE) {
                $payable = $proposalEntity->getManualPremium()->getPremium();
                $currency = $proposalEntity->getManualPremium()->getCurrency();
            } else {
                $payable = $this->premiumService->getProposalUsablePremium($proposalEntity);
                $currency = $proposalEntity->getCurrency();
            }
        } else {

            if ($proposalEntity->getIsManualPremium() == TRUE) {
                $payable = $proposalEntity->getManualPremium()->getPremium();
                $currency = $proposalEntity->getManualPremium()->getCurrency();
            } else {
                $payable = $this->premiumService->getProposalUsablePremium($proposalEntity);
                $currency = $proposalEntity->getCurrency();
            }
            $invoiceEntity = new Invoice();
        }
        if ($proposalEntity->getIsVisible() == TRUE) {
            $invoiceEntity->setIsOpen(TRUE);
        } else {
            $invoiceEntity->setIsOpen(FALSE);
        }
        $invoiceEntity->setAmount($payable)
            ->setCustomer($proposalEntity->getCustomer())
            ->setCurrency($currency)
            ->setInvoiceCategory($em->find("Transactions\Entity\InvoiceCategory", InvoiceService::INVOICE_CAT_PROPOSAL))
            ->setStatus($em->find("Transactions\Entity\InvoiceStatus", InvoiceService::INVOICE_UNPAID_STATUS))
            ->setProposal($proposalEntity)
            ->setGeneratedOn(new \DateTime())
            ->setInvoiceUid($invoiceService->generateInvoiceNumber())
            ->setIsMicro(TRUE)
            ->setExpiryDate(new \DateTime());

        $em->persist($invoiceEntity);
        // $proposalEntity->getInvoice()->setIsMicro(True);

        // $em->persist($proposalEntity);

        for ($i = 0; $i < count($data["value"]); $i ++) {

            $microPaymentEntity = new MicroPayment();

            $microPaymentEntity->setCreatedOn(new \DateTime())
                ->setDueDate($data["dueDate"][$i])
                ->setValue($data["value"][$i])
                ->setInvoice($invoiceEntity)
                ->setMicroPaymentStructure($em->find("Settings\Entity\MicroPaymentStructure", $microPaymentSession->divisor))
                ->setStatus($em->find("Transactions\Entity\TransactionStatus", TransactionService::TRANSACTION_STATUS_PENDING));

            $em->persist($microPaymentEntity);
        }
        $em->flush();
        $this->flashmessenger()->addSuccessMessage("Successfully Generated MicroPayment");
        $response = new Response();
        $response->add($redirect);
        return $this->getResponse()->setContent($response);

        // }
        // $response = new Response();
        // return $this->getResponse()->setContent($response);
    }

    /**
     * This removes Micro Payment in object database
     *
     * @param object $id
     */
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

    /**
     * This generate and view object micro payment structure
     *
     * @return mixed
     */
    public function micropayAction()
    {
        $em = $this->entityManager;
        $microPaymentForm = $this->microPaymentForm;
        $microPaymentForm->setAttributes(array(
            "id" => "simpleForm",
            "class" => "form-horizontal form-label-left ajax_element",
            "data-ajax-loader" => "myLoader",
            "action" => $this->url()
                ->fromRoute("proposal/default", array(
                "action" => "micropay"
            ))
        ));
        $request = $this->getRequest();
        if ($request->isPost()) {
            $post = $request->getPost();

            $microPaymentSession = $this->invoiceService->getMicroPaymentSession();
            $microPaymentSession->divisor = $post['microPayment'];
            $proposalService = $this->proposalService;
            $proposalSession = $proposalService->getProposalSession();
            $proposalEntity = $em->find("Proposal\Entity\Proposal", $proposalSession->proposalId);
            $microPaymentSession->value = $this->premiumService->getProposalUsablePremium($proposalEntity);
            // if ($proposalEntity->getIsManualPremium() == TRUE) {
            // $microPaymentSession->value = $proposalEntity->getManualPremium()->getPremium();
            // } else {
            // $microPaymentSession->value = $this->premiumService;
            // }
            $innerHtml = new InnerHtml();

            /**
             * deactivate object activate micropayment if object micropaymentsession value is empty
             */
            $innerHtml->setSelector("#microdetails");
            $innerHtml->setContent($this->microDetails($this->invoiceService->generateMicroPayment($microPaymentSession->divisor, $microPaymentSession->value)));
            $innerHtml->setVariables(array(
                "details" => "microDetails"
            ));

            // $innerHtml->setTemplate("transaction-micro-payment-view-details");
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

        $modalView = new WasabiModalView("#wasabi_modal", $this->renderer, $modal);
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
            for ($i = 0; $i < count($data['value']); $i ++) {
                $info .= "<tr>
                    
                                  <td>Payment " . ($i + 1) . "</td>
                                  <td>" . number_format((float) $data['value'][$i], 2, '.', '') . "</td>
                                  <td>" . $data['dueDate'][$i]->format("D, d M Y ") . "</td>
                                      
                                </tr>";
            }
        }

        $frame = "<div class='panel-body'>
                            <table class='table table-striped'>
                              <objectad>
                                <tr>
            
                                  <th>Payment</th>
                                  <th>Amount Payable</th>
                                  <th>Date</th>
                                </tr>
                              </objectad>
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

    public function removedocconfirmAction()
    {
        $response = new Response();
        $dialog = new Dialog("Dialog", "Confirm Action", "Are you sure you want to remove this document", Dialog::TYPE_SUCCESS);
        $cbutton = new Button("Accept");
        $cbutton->setAction($this->url()
            ->fromRoute("proposal/default", array(
            "action" => "removedoc",
            "id" => $this->params()
                ->fromQuery("data", NULL)
        )));
        $dialog->setTitle("Remove Document");
        $dialog->setConfirmButton($cbutton);
        // $dialog->set

        $modalView = new WasabiModalView("#wasabi_modal", $this->renderer, $dialog);
        $response->add($modalView);
        return $this->getResponse()->setContent($response);
    }

    /**
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
        $proposalService = $this->proposalService;
        $proposalSession = $proposalService->getProposalSession();
        /**
         * 
         * @var Proposal $proposalEntity
         */
        $proposalEntity = $em->find("Proposal\Entity\Proposal", $proposalSession->proposalId);
        try {
            $proposalEntity->removeDocument($docEntity)->setUpdatedOn(new \DateTime());
            $em->persist($proposalEntity);
            $em->flush();
            $this->flashmessenger()->addSuccessMessage("Successfully removed object document");
            $gritter->setTitle("Success");
            $gritter->setText("Successfully removed the document");
            $gritter->setType(GritterMessage::TYPE_SUCCESS);

            $response->add($gritter);
            $redirect = new Redirect($this->url()->fromRoute("proposal/default", array(
                "action" => "process"
            )));

            $response->add($redirect);
        } catch (\Exception $e) {
            $this->flashmessenger()->addErrorMessage($e->getMessages());
            $this->redirect()->toRoute("proposal/default", array(
                "action" => "process"
            ));
        }

        return $this->getResponse()->setContent($response);
    }

    public function uploaddropzoneAction()
    {
        $em = $this->entityManager;
        // $blobService = $this->blobService;
        $responce = new Response();
        // $docUrl = "<img src='http://127.0.0.1:10000/devstoreaccount1/brk5a854a6ede76f1/1520200169icon-property.png' height=50>";
        // $docUrl = "HIS";
        // $responce = new Response(new InnerHtml("#uploaded_doc", $docUrl));
        $proposalService = $this->proposalService;
        // $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $this->centralBrokerId);
        $request = $this->getRequest();
        if ($request->isPost() || $request->isXmlHttpRequest()) {
            $files = $this->params()->fromFiles('file');
            // var_dump($files[0]);
            $res = $this->blobService->uploadBlob($files);
            // $this->redirect()->toRoute("home");
            if ($res != NULL) {
                try {
                    $proposalSession = $proposalService->getProposalSession();
                    // $docEntity = $em->find("GeneralServicer\Entity\Document", $res);
                    $proposalId = $proposalSession->proposalId;
                    $proposalEntity = $em->find("Proposal\Entity\Proposal", $proposalId);
                    $proposalEntity->addDocument($res)->setUpdatedOn(new \DateTime());

                    $em->persist($proposalEntity);
                    $em->persist($res);
                    $em->flush();
                } catch (\Exception $e) {
                    var_dump($e->getMessage());
                }

                // $url = $docEntity->getDocUrl();
                // $docUrl = "<img src='" . $url . "' height=50>";
                // $this->flashmessenger()->addSuccessMessage("Logo Successfully uploaded" . $url); // $this->flashmessenger()->addSuccessMessage("Logo Successfully uploaded");
                // return $this->redirect()->toRoute("proposal/default", array(
                // "action" => "process"
                // ));
                // return $this->redirect()->toRoute("dashboard");
                // $responce = new Response(new InnerHtml("#uploaded_doc", $docUrl)) ; // this should be a thumbnail of object uploaded file
            }
        }
        return $this->getResponse()->setContent($responce);
    }

    public function removeManualPremiumAction()
    {
        $response = new Response();
        $em = $this->entityManager;
        $premiumSession = new Container("proposal_premium");
        $proposalService = $this->proposalService;
        $proposalSession = $proposalService->getProposalSession();
        $proposalId = $proposalSession->proposalId;
        $proposalEntity = $em->find("Proposal\Entity\Proposal", $proposalId);
        $gritter = new GritterMessage();
        $manualPremium = $proposalEntity->getManualPremium();

        $proposalEntity->setIsManualPremium(False)->setUpdatedOn(new \DateTime());

        $manualPremium->setProposal(NULL);
        try {

            $em->persist($proposalEntity);
            $em->persist($manualPremium);
            $this->proposalService->proposalPremiumGenerator($proposalEntity);
            $invoiceEntity = $proposalEntity->getInvoice();
            if ($invoiceEntity != NULL) {
                //
                $this->removeMicro($invoiceEntity->getId());
                $invoiceEntity->setIsMicro(False)->setAmount($premiumSession->premium);

                $em->persist($invoiceEntity);
            }
            $em->flush();

            $this->flashmessenger()->addSuccessMessage("Premium is now auto generated");

            $gritter->setTitle("Success");
            $gritter->setText("Successfully removed the manual premium");
            $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);
            $gritter->setType(GritterMessage::TYPE_SUCCESS);

            $response->add($gritter);
            $redirect = new Redirect($this->url()->fromRoute("proposal/default", array(
                "action" => "process"
            )));

            $response->add($redirect);

            // $this->redirect()->toRoute("proposal/default", array(
            // "action" => "process"
            // ));
        } catch (\Exception $e) {
            $this->flashmessenger()->addErrorMessage("objectre was a problem removing object manual premium");
            $gritter->setTitle("Error");
            $gritter->setText("Error removing the manual premium, please try again later");
            $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);
            $gritter->setType(GritterMessage::TYPE_ERROR);

            $response->add($gritter);

            $redirect = new Redirect($this->url()->fromRoute("proposal/default", array(
                "action" => "process"
            )));

            $response->add($redirect);
        }
        return $this->getResponse()->setContent($response);
    }

    /**
     *
     * @return mixed
     */
    public function manualPremiumAction()
    {
        $em = $this->entityManager;
        $response = new Response();
        $manualPremiumForm = $this->manualPremiumForm;
        $gritter = new GritterMessage();
        $manualPremiumForm->setAttributes(array(
            "id" => "simpleForm",
            "method" => "POST",
            "class" => "form-horizontal form-label-left ajax_element",
            "data-ajax-loader" => "myLoader",
            "action" => $this->url()
                ->fromRoute("proposal/default", array(
                "action" => "manual-premium"
            ))
        ));
        $proposalService = $this->proposalService;
        $proposalSession = $proposalService->getProposalSession();
        $proposalId = $proposalSession->proposalId;
        $proposalEntity = $em->find("Proposal\Entity\Proposal", $proposalId);
        $invoiceEntity = $proposalEntity->getInvoice();
        $request = $this->getRequest();

        if ($proposalEntity == NULL) {
            $this->flashmessenger()->addErrorMessage("We could not find a proposalidentifier");
            $this->redirect()->toRoute("proposal/default", array(
                "action" => "my-proposals"
            ));
        }

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

                $proposalEntity->setIsManualPremium(True)->setManualPremium($manulPremiumEntity);
                $premium = $this->currencyService->cleanInputedValue($data->getPremium());

                $manulPremiumEntity->setPremium($premium)
                    ->setCreated(new \DateTime())
                    ->setCurrency($em->find("Settings\Entity\Currency", $data->getCurrency()))
                    ->setProposal($proposalEntity)
                    ->setDescription($data->getDescription());
                try {
                    // $em->persist($manulPremiumEntity);
                    $this->updateInvoice($premium, $data->getCurrency()
                        ->getId());
                    $em->persist($proposalEntity);

                    $em->flush();

                    $this->flashmessenger()->addSuccessMessage("Successfully Updated manual premium value");
                    // $this->redirect()->toRoute("proposal/default", array(
                    // "action" => "process"
                    // ));
                    $gritter->setTitle("Success");
                    $gritter->setText("Success Generating Premium");
                    $gritter->setType(GritterMessage::TYPE_SUCCESS);

                    $response->add($gritter);
                    $redirect = new Redirect($this->url()->fromRoute("proposal/default", array(
                        "action" => "process"
                    )));
                    $response->add($redirect);

                    // return $this->getResponse()->setContent($response);
                } catch (\Exception $e) {

                    $gritter->setTitle("Error");
                    $gritter->setText("Error Gnereateing Premium");
                    $gritter->setType(GritterMessage::TYPE_ERROR);
                    // $this->flashmessenger()->addErrorMessage("we could not create object manual premium value");
                    // $this->redirect()->toRoute("proposal/default", array(
                    // "action" => "my-proposals"
                    // ));

                    $response->add($gritter);
                    $redirect = new Redirect($this->url()->fromRoute("proposal/default", array(
                        "action" => "my-proposals"
                    )));
                    $response->add($redirect);
                    // return $this->getResponse()->setContent($response);
                }
            } else {

                // $this->flashmessenger()->addErrorMessage("Please enter valid information into object form");
                // $redirect = new Redirect($this->url()->fromRoute("proposal/default", array(
                // "action" => "my-proposals"
                // )));
                // $response->add($redirect);
                // return $this->getResponse()->setContent($response);
            }
        } else {
            $viewModel = new ViewModel(array(
                "manualPremiumForm" => $manualPremiumForm
            ));
            $viewModel->setTemplate("general-manual-premium-form");
            $modal = new WasabiModal("standard", "Manual Premium");
            $modal->setContent($viewModel);

            $modalView = new WasabiModalView("#wasabi_modal", $this->renderer, $modal);

            $response->add($modalView);
        }

        return $this->getResponse()->setContent($response);
    }

    /**
     * This action changes object status
     */
    public function preProcessAction()
    {
        $em = $this->entityManager;
        $generalService = $this->generalServicce;
        $proposalService = $this->proposalService;
        $this->clearProposalSession();
        $proposalPremiumSession = new Container("proposal_premium");
        $proposalPremiumSession->getManager()
            ->getStorage()
            ->clear("proposal_premium");
        $proposalSession = $proposalService->getProposalSession();
        $id = $this->params()->fromRoute("id", NULL);

        // $process = $this->params()->fromRoute("pro", NULL);

        if ($id == NULL) {
            $this->flashmessenger()->addErrorMessage("A proposal identity was not selected");
            $this->redirect()->toRoute("proposal/default", array(
                "action" => "my-proposals"
            ));
        }

        // $this->notAuthorised($id);

        $proposalEntity = $em->getRepository("Proposal\Entity\Proposal")->findOneBy(array(
            "proposalCode" => $id
        ));
        // var_dump($proposalEntity);

        // var_dump($proposalEntity);
        // $proposalEntity = $proposalEntity[0];

        if ($proposalEntity->getProposalStatus()->getId() == ProposalService::PROPOSAL_STATUS_CUSTOMER_VIEWED) {
            $proposalEntity->setProposalStatus($em->find("Proposal\Entity\ProposalStatus", ProposalService::PROPOSAL_STATUS_PROCESSING));
        } elseif ($proposalEntity->getProposalStatus()->getId() == ProposalService::PROPOSAL_STATUS_PROCESSING) {
            // Make No changes
        } else {

            $proposalEntity->setProposalStatus($em->find("Proposal\Entity\ProposalStatus", ProposalService::PROPOSAL_STATUS_WAITING_CUSTOMER_RESPONSE))
                ->setUpdatedOn(new \DateTime());
        }
        // if ($process == "true") {
        // $proposalEntity->setProposalStatus($em->find("Proposal\Entity\ProposalStatus", ProposalService::PROPOSAL_STATUS_PROCESSING));
        // }

        try {

            $em->persist($proposalEntity);
            $em->flush();
            $proposalSession->proposalId = $proposalEntity->getId();

            $this->redirect()->toRoute("proposal/default", array(
                "action" => "process"
            ));
        } catch (\Exception $e) {
            $this->redirect()->toRoute("proposal/default", array(
                "action" => "my-proposals"
            ));
        }

        $this->getResponse()->setContent(NULL);
    }

    public function previewdetailsAction()
    {
        $em = $this->entityManager;
        $response = new Response();
        $invoiceService = $this->invoiceService;
        $proposalService = $this->proposalService;
        $proposalSession = $proposalService->getProposalSession();
        $proposalId = $proposalSession->proposalId;
        $gritter = new GritterMessage();
        $currency = NULL;
        $payable = NULL;
        $proposalEntity = $em->find("Proposal\Entity\Proposal", $proposalId);
        $dropZoneForm = $this->dropZoneUploadForm;
        $dropZoneForm->setAttributes(array(
            "action" => $this->url()
                ->fromRoute("policy/default", array(
                "action" => "uploaddropzone"
            ))
        ));
        if ($proposalEntity->getCoverNote() != NULL) {
            if ($proposalEntity->getCoverNote()->getPolicy() != NULl) {
                // $policyService = $this
            }
        }
        if ($proposalEntity->getInvoice() == NULL && $this->premiumService->getProposalUsablePremium($proposalEntity) != NULL) {
            if ($proposalEntity->getIsManualPremium() == TRUE) {
                $payable = $proposalEntity->getManualPremium()->getPremium();
                $currency = $proposalEntity->getManualPremium()->getCurrency();
            } else if ($proposalEntity->getIsManualPremium() == FALSE) {
                $payable = $this->premiumService->getProposalUsablePremium($proposalEntity);
                $currency = $proposalEntity->getCurrency();
            } else {
                $premiumSession = new Container("proposal_premium");
                $premiumSession->isAuto = FALSE;
            }
            $invoiceEntity = new Invoice();

            if ($proposalEntity->getIsVisible()) {
                $invoiceEntity->setIsOpen(True);
            } else {
                $invoiceEntity->setIsOpen(FALSE);
            }
            $invoiceEntity->setAmount($payable)
                ->setCustomer($proposalEntity->getCustomer())
                ->setCurrency($currency)
                ->setInvoiceCategory($em->find("Transactions\Entity\InvoiceCategory", InvoiceService::INVOICE_CAT_PROPOSAL))
                ->setStatus($em->find("Transactions\Entity\InvoiceStatus", InvoiceService::INVOICE_UNPAID_STATUS))
                ->setProposal($proposalEntity)
                ->setGeneratedOn(new \DateTime())
                ->setInvoiceUid($invoiceService->generateInvoiceNumber())
                ->setExpiryDate(new \DateTime());
            try {
                $em->persist($invoiceEntity);
                $em->flush();
            } catch (\Exception $e) {
                $gritter->setTitle("Error");
                $gritter->setType("Could not open preview page");
                $gritter->setType(GritterMessage::TYPE_ERROR);
            }
        }
        $viewModel = new ViewModel(array(
            "proposalEntity" => $proposalEntity
        ));
        $viewModel->setTemplate("proposal-preview-details-snippet");
        $modal = new WasabiModal("standard", "Proposal Preview");

        $modal->setContent($viewModel);

        $modalView = new WasabiModalView("#wasabi_modal", $this->renderer, $modal);

        $response->add($modalView);

        return $this->getResponse()->setContent($response);
    }

    public function processAction()
    {
        // $this->redirectPlugin()->redirectCondition();
        // $premiumSession = new Container("proposal_premium");
        // $proposalPremiumSession = new Container("proposal_premium");
        // var_dump($proposalPremiumSession->isAuto);
        // var_dump($proposalPremiumSession->premium);
        $policyService = $this->policyService;
        // $objectEntity = "";
        $dropZoneUploadForm = $this->dropZoneUploadForm;
        $dropZoneUploadForm->setAttributes(array(
            "action" => $this->url()
                ->fromRoute("proposal/default", array(
                "action" => "uploaddropzone"
            ))
        ));

        $uploadForm = $this->uploadForm;
        $uploadForm->get('file')->setAttributes(array(
            "multiple" => false
        ));
        $em = $this->entityManager;
        $selectObjectForm = $this->selectObjectForm;
        $proposalService = $this->proposalService;
        $proposalForm = $this->proposalForm;
        $objectForm = $this->objectForm;
        $generalService = $this->generalServicce;
        $manualPremiumForm = $this->manualPremiumForm;
        $manualPremiumForm->setAttributes(array(
            "method" => "POST",
            "action" => $this->url()
                ->fromRoute("proposal/default", array(
                "action" => "manual-premium"
            ))
        ));
        $generalSession = $generalService->getGeneralSession();
        $messageForm = $this->messageForm;
        $messageForm->setAttributes(array(
            "method" => "POST",
            "action" => $this->url()
                ->fromRoute("proposal/default", array(
                "action" => "send-message"
            ))
        ));
        $proposalSession = $proposalService->getProposalSession();
        $broker = $em->find("Users\Entity\InsuranceBrokerRegistered", $this->centralBrokerId);

        $proposalId = $proposalSession->proposalId;

        if ($proposalId == NULL) {
            $this->flashmessenger()->addErrorMessage("We could not find a proposal identity");
            $this->redirect()->toRoute("proposal/default", array(
                "action" => "my-proposals"
            ));
        }

        $proposalEntity = $em->find("Proposal\Entity\Proposal", $proposalId);
        // $this->proposalService->proposalPremiumGenerator($proposalEntity);
        $generalSession->currentCustomerid = $proposalEntity->getCustomer()->getId();

        if ($proposalEntity->getCoverNote() != NULL) {
            if ($proposalEntity->getCoverNote()->getPolicy() != NULl) {
                // $policyService = $this
                $policySession = $policyService->getPolicySession();
                $policySession->policyId = $proposalEntity->getCoverNote()
                    ->getPolicy()
                    ->getId();
            }
        }

        if ($proposalEntity->getCoverNote() != NULL) {
            $coverNoteService = $this->coverNoteservice;
            $coverNoteSession = $coverNoteService->getCoverNoteSession();
            $coverNoteSession->getCoverNoteId = $proposalEntity->getCoverNote()->getId();
        }

        /**
         * This sets object ciustomer ID which would be used by selectObjectFieldset
         */

        $proposalForm->bind($proposalEntity);
        $request = $this->getRequest();

        // $ur = $request->geobjectader("referer")->getUri();

        // var_dump($request->geobjectader("referer")->getUri());
        // var_dump(substr ( $ur, -1, 10 ));

        $view = new ViewModel(array(
            "proposalForm" => $proposalForm,
            "proposalEntity" => $proposalEntity,
            "objectForm" => $objectForm,
            "selectObjectForm" => $selectObjectForm,
            "broker" => $broker,
            "messageForm" => $messageForm,
            "manualPremiumForm" => $manualPremiumForm,
            "dropZoneForm" => $dropZoneUploadForm,
            "uploadForm" => $uploadForm
            // "manualPaymentForm"=>$manualPaymentForm
        ));
        return $view;
    }

    /**
     * $this function notifies the User what would happen
     * if he proceeds with object finanlization
     */
    public function finalizedialogAction()
    {
        $dialog = new Dialog("Dialog", "Are you sure", "object Proposal would be visible to object customer<br> A notification would be sent to object customer<br> An Invoice would be generated <br> Customer would be able to make payments", Dialog::TYPE_SUCCESS);
        $cbutton = new Button("Accept");
        $cbutton->setAction($this->url()
            ->fromRoute("proposal/default", array(
            "action" => "finalize"
        )));

        $dialog->setConfirmButton($cbutton);
        $modalView = new WasabiModalView("#wasabi_modal", $this->renderer, $dialog);
        $response = new Response();
        $response->add($modalView);
        return $this->getResponse()->setContent($response);
    }

    /**
     * This action finanlises object proposal by
     * Making it visible
     * Sending a notification to object customer with information on what to do next
     * generating an invoice
     * If Notify with SMS is on an SMS is sent to object customers phone number
     *
     * @return mixed
     */
    public function finalizeAction()
    {
        /**
         * Proposal is visible
         * Mail is sent to customer
         */
        $em = $this->entityManager;
        $response = new Response();
        $gritter = new GritterMessage();
        $proposalService = $this->proposalService;
        $proposalSession = $proposalService->getProposalSession();
        $microPaymentSession = $this->invoiceService->getMicroPaymentSession();
        $proposalId = $proposalSession->proposalId;
        $generalService = $this->generalServicce;

        // Change ProposalStatus
        $proposalEntity = $em->find("Proposal\Entity\Proposal", $proposalId);
        $proposalEntity->setIsVisible(TRUE)
            ->setIsFinalized(True)
            ->setUpdatedOn(new \DateTime())
            ->setProposalStatus($em->find("Proposal\Entity\ProposalStatus", ProposalService::PROPOSAL_STATUS_PROCESSING));
        $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $this->centralBrokerId);

        // Generate an Invoice

        if ($proposalEntity->getInvoice() != NULL) {
            $invoiceEntity = $proposalEntity->getInvoice();
            // $invoiceEntity = new Invoice();
            $invoiceEntity->setModifiedOn(new \DateTime())->setIsOpen(True);
            if ($invoiceEntity->getAmount() != $this->premiumService->getProposalUsablePremium($proposalEntity)) {
                $invoiceEntity->setAmount($this->premiumService->getProposalUsablePremium($proposalEntity));
                if ($proposalEntity->getIsManualPremium() == TRUE) {
                    $invoiceEntity->setCurrency($proposalEntity->getManualPremium()
                        ->getCurrency());
                } else {
                    $invoiceEntity->setCurrency($proposalEntity->getCurrency());
                }
            }
            $em->persist($invoiceEntity);
        } else {
            $invoiceEntity = new Invoice();
            $invoiceEntity->setProposal($proposalEntity)
                ->setCustomer($proposalEntity->getCustomer())
                ->setGeneratedOn(new \DateTime())
                ->setInvoiceCategory($em->find("Transactions\Entity\InvoiceCategory", InvoiceService::INVOICE_CAT_PROPOSAL))
                ->setInvoiceUid($this->invoiceService->generateInvoiceNumber())
                ->setIsOpen(TRUE)
                ->setExpiryDate(new \DateTime())
                ->setIsMicro(($microPaymentSession->isMicroPayment == NULL ? FALSE : TRUE))
                ->setStatus($em->find("Transactions\Entity\InvoiceStatus", InvoiceService::INVOICE_UNPAID_STATUS))
                ->setUser($this->identity());
            if ($invoiceEntity->getAmount() != $this->premiumService->getProposalUsablePremium($proposalEntity)) {
                $invoiceEntity->setAmount($this->premiumService->getProposalUsablePremium($proposalEntity));
                if ($proposalEntity->getIsManualPremium() == TRUE) {
                    $invoiceEntity->setCurrency($proposalEntity->getManualPremium()
                        ->getCurrency());
                } else {
                    $invoiceEntity->setCurrency($proposalEntity->getCurrency());
                }
            }
            $em->persist($invoiceEntity);
        }

        // Send email to customer that proposal can now be paid for and it it visisble
        // $replyTo = new AddressList();
        // foreach ($proposalEntity->getCustomer()->getAssignedChildBroker() as $child) {
        // $replyTo->add($child->getUser()
        // ->getEmail());
        // }
        $template = array(
            "var" => array(
                "brokerLogo" => $generalService->getBrokerAbsoluteLogo(),
                "brokerName" => $brokerEntity->getCompanyName(),
                // "brokerName" => $brokerEntity->getBrokerName(), // Broker Entity
                "recipient" => $proposalEntity->getCustomer()->getName(),
                "defaultText" => $brokerEntity->getCompanyName() . " has generated a proposal titled <strong>" . $proposalEntity->getProposalTitle() . "</strong> for you. Please login to your account to process and finalize", // a message is meant to be created

                "extraDetailTemplate" => NULL,
                "invoiceTableTemplate" => NULL,
                "socialMediaTemplate" => NULL // "invoice"=>$invoice,
            ),
            "template" => "general_generic"
        );
        $messagePointers = array(
            "to" => $proposalEntity->getCustomer()
                ->getUser()
                ->getEmail(),
            "fromName" => $brokerEntity->getCompanyName(),
            "subject" => $brokerEntity->getCompanyName() . " New Proposal"
        );

        $replyTo = $brokerEntity->getUser()->getEmail();
        $addReplyTo = $replyTo;

        // $messagePointers["addReplyTo"] = $replyTo;

        // var_dump($replyTo);
        try {

            $generalService->sendMails($messagePointers, $template);
            $em->persist($proposalEntity);
            // $em->persist($invoiceEntity);
            // $em->
            $em->flush();
            $gritter->setTitle("Finalization Success");
            $gritter->setText("Successfuly Finanlized proposal");
            $gritter->setType(GritterMessage::TYPE_SUCCESS);
            $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);

            $response->add($gritter);

            $this->flashmessenger()->addSuccessMessage("Successfuly finalized object proposal, now object customer would be able to see this proposal");
            $redirect = new Redirect($this->url()->fromRoute("proposal/default", array(
                "action" => "process"
            )));

            $response->add($redirect);
        } catch (\Exception $e) {
            $gritter->setTitle("Finalization Error");
            $gritter->setText("Document count not be finalized please try again");
            $gritter->setType(GritterMessage::TYPE_ERROR);
            $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);

            $response->add($gritter);
            // var_dump($e->getMessage());
            $this->flashmessenger()->addErrorMessage("We could not finalize object proposal");
            $redirect = new Redirect($this->url()->fromRoute("proposal/default", array(
                "action" => "process"
            )));
            $response->add($redirect);
        }

        return $this->getResponse()->setContent($response);
    }

    public function messagesAction()
    {
        $em = $this->entityManager;
        $proposalService = $this->proposalService;
        $mailService = $this->generalServicce;
        $proposalSession = $proposalService->getProposalSession();
        $proposalId = $proposalSession->proposalId;
        $proposalEntity = $em->find("Proposal\Entity\Proposal", $proposalId);
        $messageForm = $this->messageForm;
        $messageForm->setAttributes(array(
            "method" => "POST",
            "data-ajax-loader" => "myLoader",
            "class" => "ajax_element",
            "action" => $this->url()
                ->fromRoute("proposal/default", array(
                "action" => "send-message"
            ))
        ));
        $viewModel = new ViewModel(array(
            "messageForm" => $messageForm,
            "proposalEntity" => $proposalEntity
        ));
        $viewModel->setTemplate("proposal-message-snipet");
        $modal = new WasabiModal("standard", "Communicate with Customer");
        $modal->setContent($viewModel);

        $modalView = new WasabiModalView("#wasabi_modal", $this->renderer, $modal);
        $response = new Response();
        $response->add($modalView);
        return $this->getResponse()->setContent($response);
    }

    /**
     * This sends a message to s the party involved that a messages has been sent
     */
    public function sendMessageAction()
    {
        $em = $this->entityManager;

        $messageService = $this->messageService;
        $proposalService = $this->proposalService;

        $request = $this->getRequest();
        $proposalId = $proposalService->getProposalSession()->proposalId;
        $proposalEntity = $em->find("Proposal\Entity\Proposal", $proposalId);
        $messageEntity = NULL;
        if ($proposalEntity->getMessages() == NULL) {
            $messageEntity = new Messages();
        } else {
            $messageEntity = $proposalEntity->getMessages();
        }
        $request = $this->getRequest();
        // $messageEntity = new Messages();
        if ($request->isPost()) {
            $post = $request->getPost();
            $messageEntered = new MessageEntered();
            $messageEntity->setCreatedOn(new \DateTime())
                ->setMessageCategory($em->find("Settings\Entity\CoverCategory", CoverNoteService::COVERNOTE_CATEGORY_PROPOSAL))
                ->setProposals($proposalEntity)
                ->setMessageUid($messageService->messageUid())
                ->addMessageEntered($messageEntered);

            $postMessageEntered = $post['messageEntered']['messageText'];
            // var_dump("hello");
            $messageEntered->setCreatedOn(new \DateTime())
                ->setBrokerFunction($em->find("Messages\Entity\MessageFunction", MessageService::MESSAGES_FUNCTION_SENDER))
                ->setCustomerFunction($em->find("Messages\Entity\MessageFunction", MessageService::MESSAGE_FUNCTION_RECEIVER))
                ->setMessageStatus($em->find("Messages\Entity\MessageStatus", MessageService::MESSAGE_STATUS_UNREAD))
                ->setMessageText($postMessageEntered)
                ->setMessages($messageEntity);

            try {
                $em->persist($messageEntity);

                $em->flush();

                /**
                 * Send Email notification to object customer inicatng a message has been sent
                 */
                $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $this->centralBrokerId);
                $pointer = NULL;
                $template = NULL;
                $pointer['to'] = $proposalEntity->getCustomer()
                    ->getUser()
                    ->getEmail();
                $pointer["fromName"] = $brokerEntity->getBrokerName();
                $pointer["subject"] = "Message from broker";

                $template["var"] = array(
                    "logo" => $this->generalServicce->getBrokerAbsoluteLogo(),
                    "brokerName" => $brokerEntity->getBrokerName(),
                    "sender" => $brokerEntity->getBrokerName(),
                    "message" => $postMessageEntered
                );

                $template['template'] = "general-servicer-message-sent-mail";
                $replyTo = array(
                    $brokerEntity->getUser()->getEmail()
                );

                foreach ($proposalEntity->getCustomer()->getAssignedChildBroker() as $child) {
                    $replyTo[] = $child->getUser()->getEmail();
                }
                ;

                $this->generalServicce->sendMails($pointer, $template, $replyTo);

                // end mail
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
                return $this->getResponse()->setContent($response);
            } catch (\Exception $e) {
                $inner = new InnerHtml("#error", "Could not deliver message");
                // $css = new DomManipulator("#message", "background-color", "#83B719");
                $response = new Response();
                $response->add($inner);
            }
        }

        return $this->getResponse()->setContent($response);
    }

    /**
     * Selects an unassigned ppropoerty and assigns it tio object proposal
     *
     * @return mixed
     */
    public function selectObjectProcessAction()
    {
        $em = $this->entityManager;
        $proposalService = $this->proposalService;
        $objectService = $this->objectService;
        $request = $this->getRequest();
        $proposalId = $proposalService->getProposalSession()->proposalId;
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
                $this->redirect()->toRoute("proposal/default", array(
                    "action" => "process"
                ));
            } catch (\Exception $e) {
                $this->flashmessenger()->addErrorMessage("object property could not be included");
                $this->redirect()->toRoute("proposal/default", array(
                    "action" => "process"
                ));
            }
        }
        return $this->getResponse()->setContent(NULL);
    }

    public function objectFormProcessAction()
    {
        $em = $this->entityManager;
        $proposalService = $this->proposalService;
        $objectService = $this->objectService;
        $request = $this->getRequest();

        $proposalId = $proposalService->getProposalSession()->proposalId;

        $proposalEntity = $em->find("Proposal\Entity\Proposal", $proposalId);

        $objectEntity = new Object();
        $objectForm = $this->objectForm;
        $objectForm->bind($objectEntity);
        if ($request->isPost()) {
            $post = $request->getPost();
            $strippedValue = str_replace(',', '', $post["value"]);

            $objectEntity->setCreatedOn(new \DateTime())
                ->setCustomer($em->find("Customer\Entity\Customer", $proposalEntity->getCustomer()
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

            $proposalEntity->addObject($objectEntity);
            $proposalEntity->setUpdatedOn(new \DateTime());

            try {
                $em->persist($objectEntity);

                $em->persist($proposalEntity);
                $em->flush();

                $this->flashmessenger()->addSuccessMessage("object property was successfully created");
                $this->redirect()->toRoute("proposal/default", array(
                    "action" => "process"
                ));
            } catch (\Exception $e) {
                $this->flashmessenger()->addError("objectre was an Error creating this Property");
                $this->redirect()->toRoute("proposal\default", array(
                    "action" => "process"
                ));
            }
        }
        return $this->getResponse()->setContent(NULL);
    }

    public function removeObjectAction()
    {
        $em = $this->entityManager;
        $proposalService = $this->proposalService;
        $objectService = $this->objectService;
        $objectId = $this->params()->fromRoute("id", NULL);
        $proposalId = $proposalService->getProposalSession()->proposalId;
        // $offerId = $offerService->getOfferSession()->offerId;
        $objectEntity = $em->find("Object\Entity\Object", $objectId);
        $proposalEntity = $em->find("Proposal\Entity\Proposal", $proposalId);
        $proposalEntity->setUpdatedOn(new \DateTime());
        $proposalEntity->removeObject($objectEntity);

        try {
            $em->persist($proposalEntity);
            $em->flush();
            $this->flashmessenger()->addSuccessMessage("object Property was successfully removed");
            $this->redirect()->toRoute("proposal/default", array(
                "action" => "process"
            ));
        } catch (\Exception $e) {
            $this->flashmessenger()->addErrorMessage("objectre was an error while removing object property");
            $this->redirect()->toRoute("proposal/default", array(
                "action" => "process"
            ));
        }

        return $this->getResponse()->setContent(NULL);
    }

    /**
     * This is an ajax call to generate object covernote
     *
     * @return mixed
     */
    public function generateCoverNoteAction()
    {
        $em = $this->entityManager;
        $gritter = new GritterMessage();
        $response = new Response();
        $coverNoteService = $this->coverNoteservice;
        $coverNoteSession = $coverNoteService->getCoverNoteSession();
        $proposalId = $this->proposalService->getProposalSession()->proposalId;
        $proposalEntity = $em->find("Proposal\Entity\Proposal", $proposalId);
        // var_dump("HI");
        if ($proposalEntity->getCoverNote() == NULL) {
            $coverNoteEntity = new CoverNote();
            // var_dump("LOWM");
            $coverNoteEntity->setDateCreated(new \DateTime());
        } else {
            $coverNoteEntity = $proposalEntity->getCoverNote();
        }

        $proposalEntity->setIsActive(TRUE)->setUpdatedOn(new \DateTime());

        $coverNoteEntity->setInsurer($proposalEntity->getInsurer());

        $dueDate = new \DateTime();
        $addMonths = 'P1M'; // sets object string for object date interval
        $interval = new \DateInterval($addMonths); // sets object actual interval
        $dueDate->add($interval);

        $coverNoteEntity->setCoverUid($coverNoteService->coverNoteUid())
            ->setCustomer($proposalEntity->getCustomer())
            ->setBroker($em->find("Users\Entity\InsuranceBrokerRegistered", $this->centralBrokerId))
            ->setIsHidden(false)
            ->setCoverStatus($em->find("Policy\Entity\CoverNoteStatus", CoverNoteService::COVERNOTE_STATUS_PROCESSING_POLICY))
            ->setCoverCategory($em->find("Settings\Entity\CoverCategory", CoverNoteService::COVERNOTE_CATEGORY_PROPOSAL))
            ->setProposal($proposalEntity)
            ->setIsPolicy(FALSE)
            ->setDueDate($dueDate);

        try {
            $em->persist($proposalEntity);
            $em->persist($coverNoteEntity);
            $em->flush();
            /**
             * TODO - Send Email Notification to customer
             */
            $coverNoteSession->getCoverNoteId = $coverNoteEntity->getId();

            $gritter->setTitle("Successfully");
            $gritter->setText("Successfully generated object  covernote");
            $gritter->setType(GritterMessage::TYPE_SUCCESS);
            $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);

            $response->add($gritter);
            $redirect = new Redirect($this->url()->fromRoute("proposal/default", array(
                "action" => "process"
            )));
            $this->flashmessenger()->addSuccessMessage("Cover Note was successfuly Generated and object customer has beeen Notified");

            $response->add($redirect);
            // $this->redirect()->toRoute("cover-note/default", array(
            // "action" => "view"
            // ));
        } catch (\Exception $e) {
            $gritter->setTitle("Processing Error");
            $gritter->setText("Error generated object  covernote");
            $gritter->setType(GritterMessage::TYPE_ERROR);
            $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);

            $response->add($gritter);
            $this->flashmessenger()->addErrorMessage("objectre was a problem generating object coverNote");

            $redirect = new Redirect($this->url()->fromRoute("proposal/default", array(
                "action" => "process"
            )));
            $response->add($redirect);
            // $this->redirect()->toRoute("proposal/default", array(
            // "action" => "process"
            // ));
        }
        return $this->getResponse()->setContent($response);
    }

    /**
     * This function displays object covernote in a modal form
     *
     * @return mixed
     */
    public function viewcovernoteAction()
    {
        $em = $this->entityManager;
        $proposalId = $this->proposalService->getProposalSession()->proposalId;
        if ($proposalId == NULL) {
            $proposalId = $this->params()->fromQuery("data");
        }
        $proposalEntity = $em->find("Proposal\Entity\Proposal", $proposalId);
        $response = new Response();
        $wasabiModal = new WasabiModal("standard", "Covernote Preview");
        $viewModel = new ViewModel(array(
            "coverNote" => $proposalEntity->getCoverNote()
        ));
        $viewModel->setTemplate("proposal-modal-view-covernote");
        $wasabiModal->setContent($viewModel);

        $modalView = new WasabiModalView("#wasabi_modal", $this->renderer, $wasabiModal);

        $response->add($modalView);

        return $this->getResponse()->setContent($response);
    }

    public function coverNoteAction()
    {
        $em = $this->entityManager;
        $proposalId = $this->proposalService->getProposalSession()->proposalId;
        $proposalEntity = $em->find("Proposal\Entity\Proposal", $proposalId);
        $coverNoteEntity = new CoverNote();
        // $coverNoteEntity->
        return $this->getResponse()->setContent(NULL);
    }

    public function createAction()
    {
        $em = $this->entityManager;
        $proposalEntity = $this->proposalEntity;

        $proposalService = $this->proposalService;
        $customerId = $this->params()->fromRoute('customer', NULL);

        if ($customerId == NULL) {
            $this->flashmessenger()->addErrorMessage("A proposal must be assigned to a customer");
            $this->redirect()->toRoute("customer/default", array(
                "action" => "all"
            ));
        }
        $proposalEntity->setCreatedOn(new \DateTime())
            ->setCustomer($em->find("Customer\Entity\Customer", $customerId))
            ->setProposalCode($proposalService->generateProposalCode())
            ->setProposalStatus($em->find("Proposal\Entity\ProposalStatus", ProposalService::PROPOSAL_STATUS_WAITING_CUSTOMER_RESPONSE))
            ->setIsActive(True)
            ->setIsVisible(FALSE)
            ->setIsHidden(false);

        try {

            $em->persist($proposalEntity);

            $em->flush();

            $this->redirect()->toRoute("proposal/default", array(
                "action" => "pre-process",
                "id" => $proposalEntity->getId()
            ));
        } catch (\Exception $e) {
            $this->flashmessenger()->addErrorMessage("objectre was a problem generating object proposal");
            $this->redirect()->toRoute("proposals/default", array(
                "action" => "my-proposals"
            ));
        }

        // $this->redirect()->toRoute("proposal/default", array(
        // "action" => "my-proposals"
        // ));
        return $this->getResponse()->setContent(NULL);
    }

    public function indexAction()
    {
        // $info = new Info("Info", "Saved", "Your settings has been saved successfully.");

        // $modal = new WasabiModalView("#wasabi_modal", $this->renderer, $info);
        // $response = new Response();
        // $response->add($modal);

        // return $this->getResponse()->setContent($response);new

        // new InnerHtml();
        // $innerHtml = new InnerHtml("inner_html_id1",
        // "I am object first example to fill in content with object InnerHtml class.");

        // $response = new Response();
        // $response->add($innerHtml);

        // return $this->getResponse()->setContent($response);
    }

    // public function sertAction()
    // {
    // $postArray = $this->getRequest()->getPost();
    // $input = $postArray['written_text'];
    // $response = new Response(new InnerHtml("#element_simple_form", "Server Response: " . $input));

    // return $this->getResponse()->setContent($response);
    // }
    public function deleteAction()
    {
        $em = $this->entityManager;
        $id = $this->params()->fromRoute("id", NULL);
        $proposalService = $this->proposalService;
        if ($id == NULL) {
            $this->flashmessenger()->addErrorMessage("A proposal identity was not selected");
            return $this->redirect()->toRoute("proposal/default", array(
                "action" => "my-proposals"
            ));
        }

        $this->notAuthorised($id);
        $proposalEntity = $em->find("Proposal\Entity\Proposal", $id);
        try {

            $proposalEntity->setIsHidden(True)->setUpdatedOn(new \DateTime());
            $em->persist($proposalEntity);
            $em->flush();
            $this->flashmessenger()->addSuccessMessage("Proposal successfully Deleted");
            $this->redirect()->toRoute("proposal/default", array(
                "action" => "my-proposals"
            ));
        } catch (\Exception $e) {}

        $view = new ViewModel();
        return $view;
    }

    private function notAuthorised($id)
    {
        $proposalService = $this->proposalService;

        if ($proposalService->getProposalBrokerId($id) != $this->centralBrokerId) {
            $this->flashmessenger()->addErrorMessage("You are not authorized to access that Object");
            $this->redirect()->toRoute("proposal/default", array(
                "action" => "my-proposal"
            ));
        }
    }

    // private function callPremiumCalculator(){
    // $premiumSession = new Container("proposal_premium");
    // $premiumSerivice = $this->premiumService;
    // $premium = $premiumSerivice->premiumCalculator();

    // $premiumSession->isAuto = TRUE;
    // // $premiumSession->premiumCurrency = $objectArray[count($objectArray) - 1]->getCurrency()->getId();
    // $premiumSession->premium = $premium;
    // }
    public function viewAction()
    {
        $em = $this->entityManager;
        $proposalService = $this->proposalService;
        $id = $this->params()->fromRoute('id', NULL);
        if ($id == NULL) {
            $this->redirect()->toRoute('proposal/default', array(
                'action' => 'my-proposals'
            ));
        }

        $proposal = $em->find("Proposal\Entity\Proposal", $id);

        $view = new ViewModel(array(
            'proposal' => $proposal
        ));

        return $view;
    }

    private function getProposalInvoice($id)
    {
        $em = $this->entityManager;
        $criteria = array(
            'proposal' => $id
        );
        $order = array(
            'id' => 'DESC'
        );

        $limit = 10;
        $data = $em->getRepository("Transactions\Entity\Proposal")->findBy($criteria, $order, $limit);
        return $data;
    }

    public function myProposalsAction()
    {
        $em = $this->entityManager;
        $proposalService = $this->proposalService;
        $myProposal = $proposalService->getMyProposals();

        $view = new ViewModel(array(
            'myProposals' => $myProposal
        ));
        return $view;
    }

    private function noCustomerRedirection($customer)
    {
        if ($customer == NULL) {
            $this->flashmessenger()->addErrorMessage("You must select a customer");
            $this->redirect()->toRoute('customer/default', array(
                'action' => 'all'
            ));
        }
    }

    public function addObjectAction()
    {

        /**
         * This selects all registered property related to this customer
         * Get object proposal Entity
         * Display avalailable object as a form on proposal entiy
         * when submit is clicked
         * persist object object collectio n on object pr
         *
         * @var Ambiguous $view
         */
        $sess = new Container('proposal');

        $view = new ViewModel(array());
        return $view;
    }

    public function extAction()
    {
        $em = $this->entityManager;
        $id = $this->params()->fromRoute('id', NULL);
        if ($id == NULL) {
            $this->redirect()->toRoute('proposal/default', array(
                'action' => 'my-proposals'
            ));
        }
        $proposal = $em->find("Proposal\Entity\Proposal", $id);
        $view = new ViewModel(array(
            'proposal' => $proposal
        ));
        return $this;
    }

    /**
     * This sets object validation condition for object form
     * such that if a certain select is active validation shift
     *
     * @param object $form
     */
    private function validationCondition($form)
    {
        $group = array(
            'csrf',
            'proposalFieldset' => array(
                'proposalTitle',
                'proposalDesc',
                'customer',
                'insuranceCategory',
                // 'createdOn',
                // 'object',
                'insurer',
                'serviceType'
                // 'updatedOn',
                // 'specificService'
            )
        );
        return $form->setValidationGroup($group);
    }

    // public function multiFormAction()
    // {
    // $session = $yourSessionContainer();

    // if (false === $session->hasStepOneBeenDone()) {
    // $form = new FormStepOne();
    // // Check for Post
    // // Validate Form
    // // Render Form on Error or Post
    // // If Valid, safe Form Data into Session
    // }

    // if (false === $session->hasStepTwoBeenDone()) {
    // $form = new FormStepTwo();
    // // Check for Post
    // // Validate Form
    // // Render Form on Error or Post
    // // If Valid, safe Form Data into Session
    // }

    // if (false === $session->hasStepNBeenDone()) {
    // $form = new FormStepTwo();
    // // Check for Post
    // // Validate Form
    // // Render Form on Error or Post
    // // If Valid, safe Form Data into Session
    // }
    // }
    public function selectCustomerAction()
    {
        $view = new ViewModel(array());
        return $view;
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;

        return $this;
    }

    public function setProposalForm($form)
    {
        $this->proposalForm = $form;

        return $this;
    }

    public function setProposalService($xserv)
    {
        $this->proposalService = $xserv;
        return $this;
    }

    public function setGeneralService($xserv)
    {
        $this->generalServicce = $xserv;
        return $this;
    }

    public function setProposalEntity($entity)
    {
        $this->proposalEntity = $entity;
        return $this;
    }

    public function setViewRenderer($xser)
    {
        $this->renderer = $xser;
        return $this;
    }

    public function setCentralBrokerId($id)
    {
        $this->centralBrokerId = $id;
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

    public function setCoverNoteService($xserv)
    {
        $this->coverNoteservice = $xserv;
        return $this;
    }

    public function setManualPremiumForm($prem)
    {
        $this->manualPremiumForm = $prem;
        return $this;
    }

    public function setCurrencyService($xserv)
    {
        $this->currencyService = $xserv;
        return $this;
    }

    public function setDropZoneUploadForm($form)
    {
        $this->dropZoneUploadForm = $form;
        return $this;
    }

    public function setBlobService($xserv)
    {
        $this->blobService = $xserv;
        return $this;
    }

    public function setUploadForm($form)
    {
        $this->uploadForm = $form;
        return $this;
    }

    public function setMicroPaymentForm($form)
    {
        $this->microPaymentForm = $form;
        return $this;
    }

    public function setInvoiceService($xserv)
    {
        $this->invoiceService = $xserv;
        return $this;
    }

    public function setPremiumService($xserv)
    {
        $this->premiumService = $xserv;
        return $this;
    }

    public function setMailService($xserv)
    {
        $this->mailService = $xserv;
        return $this;
    }

    public function setManualPaymentForm($form)
    {
        $this->manualPaymentForm = $form;
        return $this;
    }

    public function setExportToInsurerForm($form)
    {
        $this->exportToInsurerForm = $form;
        return $this;
    }

    /**
     *
     * @return object $motorForm
     */
    public function getMotorForm()
    {
        return $this->motorForm;
    }

    /**
     *
     * @param object $motorForm
     */
    public function setMotorForm($motorForm)
    {
        $this->motorForm = $motorForm;
        return $this;
    }

    /**
     *
     * @return object $cropAgricInsuranceForm
     */
    public function getCropAgricInsuranceForm()
    {
        return $this->cropAgricInsuranceForm;
    }

    /**
     *
     * @param object $cropAgricInsuranceForm
     */
    public function setCropAgricInsuranceForm($cropAgricInsuranceForm)
    {
        $this->cropAgricInsuranceForm = $cropAgricInsuranceForm;
        return $this;
    }

    /**
     *
     * @return object $livestockAgricInsuranceForm
     */
    public function getLivestockAgricInsuranceForm()
    {
        return $this->livestockAgricInsuranceForm;
    }

    /**
     *
     * @param object $livestockAgricInsuranceForm
     */
    public function setLivestockAgricInsuranceForm($livestockAgricInsuranceForm)
    {
        $this->livestockAgricInsuranceForm = $livestockAgricInsuranceForm;
        return $this;
    }

    /**
     *
     * @return object $imService
     */
    public function getImService()
    {
        return $this->imService;
    }

    /**
     *
     * @param object $imService
     */
    public function setImService($imService)
    {
        $this->imService = $imService;
        return $this;
    }

    /**
     *
     * @return object $aviationForm
     */
    public function getAviationForm()
    {
        return $this->aviationForm;
    }

    /**
     *
     * @param object $aviationForm
     */
    public function setAviationForm($aviationForm)
    {
        $this->aviationForm = $aviationForm;
        return $this;
    }

    /**
     *
     * @return object $houseBuglaryForm
     */
    public function getHouseBuglaryForm()
    {
        return $this->houseBuglaryForm;
    }

    /**
     *
     * @param object $houseBuglaryForm
     */
    public function setHouseBuglaryForm($houseBuglaryForm)
    {
        $this->houseBuglaryForm = $houseBuglaryForm;
        return $this;
    }

    /**
     *
     * @return object $cashInSafeForm
     */
    public function getCashInSafeForm()
    {
        return $this->cashInSafeForm;
    }

    /**
     *
     * @param object $cashInSafeForm
     */
    public function setCashInSafeForm($cashInSafeForm)
    {
        $this->cashInSafeForm = $cashInSafeForm;
        return $this;
    }

    /**
     *
     * @return object $cashInTransitForm
     */
    public function getCashInTransitForm()
    {
        return $this->cashInTransitForm;
    }

    /**
     *
     * @param object $cashInTransitForm
     */
    public function setCashInTransitForm($cashInTransitForm)
    {
        $this->cashInTransitForm = $cashInTransitForm;
        return $this;
    }

    /**
     *
     * @return object $employeeLiabilityForm
     */
    public function getEmployeeLiabilityForm()
    {
        return $this->employeeLiabilityForm;
    }

    /**
     *
     * @param object $employeeLiabilityForm
     */
    public function setEmployeeLiabilityForm($employeeLiabilityForm)
    {
        $this->employeeLiabilityForm = $employeeLiabilityForm;
        return $this;
    }

    /**
     *
     * @return object $fidelityGuarateeForm
     */
    public function getFidelityGuarateeForm()
    {
        return $this->fidelityGuarateeForm;
    }

    /**
     *
     * @param object $fidelityGuarateeForm
     */
    public function setFidelityGuarateeForm($fidelityGuarateeForm)
    {
        $this->fidelityGuarateeForm = $fidelityGuarateeForm;
        return $this;
    }

    /**
     *
     * @return object $fireSpecialPerilForm
     */
    public function getFireSpecialPerilForm()
    {
        return $this->fireSpecialPerilForm;
    }

    /**
     *
     * @param object $fireSpecialPerilForm
     */
    public function setFireSpecialPerilForm($fireSpecialPerilForm)
    {
        $this->fireSpecialPerilForm = $fireSpecialPerilForm;
        return $this;
    }

    /**
     *
     * @return object $gitForm
     */
    public function getGitForm()
    {
        return $this->gitForm;
    }

    /**
     *
     * @param object $gitForm
     */
    public function setGitForm($gitForm)
    {
        $this->gitForm = $gitForm;
        return $this;
    }

    /**
     *
     * @return object $groupLifeForm
     */
    public function getGroupLifeForm()
    {
        return $this->groupLifeForm;
    }

    /**
     *
     * @param object $groupLifeForm
     */
    public function setGroupLifeForm($groupLifeForm)
    {
        $this->groupLifeForm = $groupLifeForm;
        return $this;
    }

    /**
     *
     * @return object $homeInsuranceForm
     */
    public function getHomeInsuranceForm()
    {
        return $this->homeInsuranceForm;
    }

    /**
     *
     * @param object $homeInsuranceForm
     */
    public function setHomeInsuranceForm($homeInsuranceForm)
    {
        $this->homeInsuranceForm = $homeInsuranceForm;
        return $this;
    }

    /**
     *
     * @return object $machineBreakDownForm
     */
    public function getMachineBreakDownForm()
    {
        return $this->machineBreakDownForm;
    }

    /**
     *
     * @param object $machineBreakDownForm
     */
    public function setMachineBreakDownForm($machineBreakDownForm)
    {
        $this->machineBreakDownForm = $machineBreakDownForm;
        return $this;
    }

    /**
     *
     * @return object $marineCargoForm
     */
    public function getMarineCargoForm()
    {
        return $this->marineCargoForm;
    }

    /**
     *
     * @param object $marineCargoForm
     */
    public function setMarineCargoForm($marineCargoForm)
    {
        $this->marineCargoForm = $marineCargoForm;
        return $this;
    }

    /**
     *
     * @return object $marineHullForm
     */
    public function getMarineHullForm()
    {
        return $this->marineHullForm;
    }

    /**
     *
     * @param object $marineHullForm
     */
    public function setMarineHullForm($marineHullForm)
    {
        $this->marineHullForm = $marineHullForm;
        return $this;
    }

    /**
     *
     * @return object $occupiersLiabilityForm
     */
    public function getOccupiersLiabilityForm()
    {
        return $this->occupiersLiabilityForm;
    }

    /**
     *
     * @param object $occupiersLiabilityForm
     */
    public function setOccupiersLiabilityForm($occupiersLiabilityForm)
    {
        $this->occupiersLiabilityForm = $occupiersLiabilityForm;
        return $this;
    }

    /**
     *
     * @return object $travelInsuranceForm
     */
    public function getTravelInsuranceForm()
    {
        return $this->travelInsuranceForm;
    }

    /**
     *
     * @param object $travelInsuranceForm
     */
    public function setTravelInsuranceForm($travelInsuranceForm)
    {
        $this->travelInsuranceForm = $travelInsuranceForm;
        return $this;
    }

    /**
     *
     * @return object $contractAllRiskForm
     */
    public function getContractAllRiskForm()
    {
        return $this->contractAllRiskForm;
    }

    /**
     *
     * @param object $contractAllRiskForm
     */
    public function setContractAllRiskForm($contractAllRiskForm)
    {
        $this->contractAllRiskForm = $contractAllRiskForm;
        return $this;
    }

    /**
     *
     * @return object $advanceBondForm
     */
    public function getAdvanceBondForm()
    {
        return $this->advanceBondForm;
    }

    /**
     *
     * @param object $advanceBondForm
     */
    public function setAdvanceBondForm($advanceBondForm)
    {
        $this->advanceBondForm = $advanceBondForm;
        return $this;
    }

    public function setBuglaryForm($bug)
    {
        $this->buglaryForm = $bug;
        return $this;
    }

    /**
     *
     * @param object $erectionAllRiskForm
     */
    public function setErectionAllRiskForm($erectionAllRiskForm)
    {
        $this->erectionAllRiskForm = $erectionAllRiskForm;
        return $this;
    }

    /**
     *
     * @param object $boilerInsuranceForm
     */
    public function setBoilerInsuranceForm($boilerInsuranceForm)
    {
        $this->boilerInsuranceForm = $boilerInsuranceForm;
        return $this;
    }

    /**
     *
     * @param object $oilEnergyForm
     */
    public function setOilEnergyForm($oilEnergyForm)
    {
        $this->oilEnergyForm = $oilEnergyForm;
        return $this;
    }

    /**
     *
     * @param object $publicLiabilityForm
     */
    public function setPublicLiabilityForm($publicLiabilityForm)
    {
        $this->publicLiabilityForm = $publicLiabilityForm;
        return $this;
    }

    /**
     *
     * @param object $proffesionalIndemnityForm
     */
    public function setProffesionalIndemnityForm($proffesionalIndemnityForm)
    {
        $this->proffesionalIndemnityForm = $proffesionalIndemnityForm;
        return $this;
    }

    public function setPolicySevice($xserv)
    {
        $this->policyService = $xserv;
        return $this;
    }

    /**
     *
     * @param object $directorsLiabilityForm
     */
    public function setDirectorsLiabilityForm($directorsLiabilityForm)
    {
        $this->directorsLiabilityForm = $directorsLiabilityForm;
        return $this;
    }

    /**
     *
     * @param object $agricPropertyForm
     */
    public function setAgricPropertyForm($agricPropertyForm)
    {
        $this->agricPropertyForm = $agricPropertyForm;
        return $this;
    }

    /**
     *
     * @param object $lifeAssuranceForm
     */
    public function setLifeAssuranceForm($lifeAssuranceForm)
    {
        $this->lifeAssuranceForm = $lifeAssuranceForm;
        return $this;
    }

    /**
     *
     * @param object $groupPersonalAccidentForm
     */
    public function setGroupPersonalAccidentForm($groupPersonalAccidentForm)
    {
        $this->groupPersonalAccidentForm = $groupPersonalAccidentForm;
        return $this;
    }

    /**
     *
     * @param object $electronicEquipmentForm
     */
    public function setElectronicEquipmentForm($electronicEquipmentForm)
    {
        $this->electronicEquipmentForm = $electronicEquipmentForm;
        return $this;
    }

    /**
     *
     * @return object $workmenCompensationForm
     */
    public function getWorkmenCompensationForm()
    {
        return $this->workmenCompensationForm;
    }

    /**
     *
     * @param object $workmenCompensationForm
     */
    public function setWorkmenCompensationForm($workmenCompensationForm)
    {
        $this->workmenCompensationForm = $workmenCompensationForm;
        return $this;
    }

    /**
     *
     * @param object $personalAccident
     */
    public function setPersonalAccident($personalAccident)
    {
        $this->personalAccident = $personalAccident;
        return $this;
    }
}

