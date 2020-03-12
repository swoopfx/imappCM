<?php
namespace Proposal\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use WasabiLib\Ajax\Response;
use WasabiLib\Ajax\InnerHtml;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;
use WasabiLib\Modal\WasabiModal;
use WasabiLib\Modal\WasabiModalView;
use WasabiLib\Ajax\GritterMessage;
use Object\Entity\Object;
use Object\Service\ObjectService;
use WasabiLib\Ajax\Redirect;
use WasabiLib\Modal\WasabiModalConfigurator;
use Transactions\Entity\Invoice;

/**
 * This are major modal call for proposal Module
 * It de- congest object individual controllers
 *
 * @author otaba
 *        
 */
class ProposalmodalController extends AbstractActionController
{

    private $generalService;

    private $objectService;

    private $entityManager;

    // protected $serviceLocator;
    private $renderer;

    private $gitVehicleListForm;

    // private
    private $brokerCustomerSession;

    private $proposalService;

    private $viewRenderer;

    // Begin Form s
    private $motorNonStandardForm;

    private $motorInsuranceForm;

    private $aviationPiltoDetailsFeildet;

    private $professionalIndemnityForm;

    private $boilerCoverDetailsFieldset;

    private $buglarySafeDetailsForm;

    private $contractAllRiskValueListFieldset;

    private $agricProductListFieldset;

    private $groupPersonalWagesFieldset;

    private $groupPersonalFixedFieldset;

    private $cropStaffListFieldset;

    private $cropAgricListFieldset;

    private $groupLifeStaffDetailsFieldset;

    private $selectObjectForm;

    private $livestockInsuredListFieldset;

    private $workmenDecreeListFieldset;

    private $employeeLiabilityDetailsFieldset;

    private $fidelityGaurateeEmployeeListFieldset;

    private $homeHouseholdGoodsFieldset;

    private $homeHouseValueableFiedset;

    private $occupiersLiabilityStaffFieldset;

    private $occupiersLiabilityFamilyFieldset;

    private $publicLiabilityEmployeeFieldset;

    private $workmencontractorlistFieldset;

    private $objectForm;

    // private $
    public function IndexAction()
    {
        return new ViewModel();
    }

    /**
     * This function provides a modal server connection to object property
     * creates a new property and assigns it to object proposal
     *
     * @return mixed
     */
    public function registernewpropertyAction()
    {
        $em = $this->entityManager;
        $proposalService = $this->proposalService;
        $proposalSession = $proposalService->getProposalSession();
        $proposalEntity = $em->find("Proposal\Entity\Proposal", $proposalSession->proposalId);
        $objectForm = $this->objectForm;
        $objectForm->setAttributes(array(
            "id" => "simpleForm",
            "class" => "form-horizontal form-label-left ajax_element",
            "data-ajax-loader" => "registerNewLoader",
            "action" => $this->url()
                ->fromRoute("proposalmodal/default", array(
                "action" => "registernewproperty"
            ))
        ));
        $viewModel = new ViewModel(array(
            "objectForm" => $objectForm
        ));
        $viewModel->setTemplate("object-register-new-object-modal-form");
        $modal = new WasabiModal("standard", "Register Property");
        $modal->setContent($viewModel);

        $modalView = new WasabiModalView("#wasabi_modal", $this->renderer, $modal);

        $response = new Response();

        $request = $this->getRequest();
        if ($request->isPost()) {
            $gritter = new GritterMessage();
            $objectEntity = new Object();
            $post = $request->getPost();
            $objectForm->setData($post);
            $objectForm->setValidationGroup(array(
                "objectFieldset"=>array(
                    "objectName",
                    "objectType",
                    "value",
                    "currency"
                ),
                "csrf"
            ));
            $objectForm->bind($objectEntity);
            if ($objectForm->isValid()) {
                $data = $objectForm->getData();
                $strippedValue = str_replace(',', '', $data->getValue());
                $proposalEntity->setUpdatedOn(new \DateTime());
                $proposalEntity->addObject($objectEntity);
                $objectEntity->setCreatedOn(new \DateTime())
                    ->setCustomer($proposalEntity->getCustomer())
                    ->setValue($strippedValue)
                    ->setIsHidden(FALSE)
                    ->setObjectUid($this->objectService->generateObjectUid())
                    ->setObjectStatus($em->find("Object\Entity\ObjectStatus", ObjectService::OBJECT_STATUS_PROCESSING));

                try {
                    $em->persist($objectEntity);
                    $em->persist($proposalEntity);
                    $em->flush();

                    $this->flashmessenger()->addSuccessMessage("Property Successfully added");

                    $gritter->setTitle("Successful Creation");
                    $gritter->setText("Successfully Created a property");
                    // $gritter->setP
                    $gritter->setType(GritterMessage::TYPE_SUCCESS);
                    $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);
                    $response->add($gritter);

                    $redirect = new Redirect($this->url()->fromRoute("proposal/default", array(
                        "action" => "process"
                    )));

                    $response->add($redirect);
                } catch (\Exception $e) {
                    $gritter->setTitle("Hydration Error");
                    $gritter->setText("objectre was a problem, please try again later");
                    $gritter->setType(GritterMessage::TYPE_ERROR);
                    $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);

                    $response->add($gritter);
                }
            } else {
                // Form error gritter
                $gritter->setTitle("Form Validation Error");
                $gritter->setText("object form failed validation test");
                $gritter->setType(GritterMessage::TYPE_ERROR);
                $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);

//                 var_dump($post);
                $response->add($gritter);
            }
        } else {
            $response->add($modalView);
        }
        return $this->getResponse()->setContent($response);
    }
    
//     private function 

    /**
     * Proceses and select objects for object proposal
     *
     * @return mixed
     */
    public function selectpropertyAction()
    {
        $em = $this->entityManager;
        $proposalService = $this->proposalService;
        $proposalSession = $proposalService->getProposalSession();
        $proposalEntity = $em->find("Proposal\Entity\Proposal", $proposalSession->proposalId);
        $response = new Response();
        $selectObjectForm = $this->selectObjectForm;
        $selectObjectForm->setAttributes(array(
            "id" => "simpleForm",
            "class" => "form-horizontal form-label-left ajax_element",
            "data-ajax-loader" => "selectObjectLoader",
            "action" => $this->url()
                ->fromRoute("proposalmodal/default", array(
                "action" => "selectproperty"
            ))
        ));
        $viewModel = new ViewModel(array(
            "selectObjectForm" => $selectObjectForm
        ));

        $viewModel->setTemplate("object-select-object-form-modal");

        $modal = new WasabiModal("standard", "Select Property");
        $modal->setContent($viewModel);

        $modalView = new WasabiModalView("#wasabi_modal", $this->renderer, $modal);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $post = $request->getPost();
            $gritter = new GritterMessage();

            if (count($post["selectObjectfield"]['object']) > 0) {
                foreach ($post["selectObjectfield"]['object'] as $obj) {

                    $objectEntity = $em->find("Object\Entity\Object", $obj);
                    $proposalEntity->addObject($objectEntity);
                }
            }
            try {
                $em->persist($proposalEntity);
                $em->flush();

                $gritter->setType(GritterMessage::TYPE_SUCCESS);
                $gritter->setTitle("Updated Information");
                $gritter->setText("Successfully updated proposal");
                $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);
                $response->add($gritter);
                $this->flashmessenger()->addSuccessMessage("Successfully updated proposal object list");
                $redirect = new Redirect($this->url()->fromRoute("proposal/default", array(
                    "action" => "process"
                )));

                $response->add($redirect);
            } catch (\Exception $e) {
                $gritter->setTitle("Processing Error");
                $gritter->setText("We could not process object request, Please try again latter");
                $gritter->setPosition(GritterMessage::TYPE_ERROR);
                $gritter->setType(GritterMessage::POSITION_TOP_RIGHT);
                $response->add($gritter);
                $this->flashmessenger()->addErrorMessage("We could not process object request, Please try again latter");
                $redirect = new Redirect($this->url()->fromRoute("proposal/default", array(
                    "action" => "process"
                )));
                $response->add($redirect);
            }
        } else {
            $response->add($modalView);
        }

        return $this->getResponse()->setContent($response);
    }

    /**
     * This shows a modal view of proposal description
     *
     * @return mixed
     */
    public function proposaldescAction()
    {
        $em = $this->entityManager;
        $proposalService = $this->proposalService;
        $proposalSession = $proposalService->getProposalSession();
        $proposalEntity = $em->find("Proposal\Entity\Proposal", $proposalSession->proposalId);

        // $desc = $this->
        $modal = new WasabiModal("standard", "Proposal Description");
        $viewModel = new ViewModel(array(
            "desc" => $proposalEntity->getProposalDesc()
        ));
        $viewModel->setTemplate("proposal-desc-modal");
        $modal->setContent($viewModel);
        $modalView = new WasabiModalView("#wasabi_modal", $this->renderer, $modal);

        $response = new Response();
        $response->add($modalView);
        return $this->getResponse()->setContent($response);
    }

    /**
     * This removes object OneToMany divs on
     * each proposalCoverDetail Specific form
     *
     * @return mixed
     */
    public function removedivAction()
    {
        // if
        $response = new Response();
        $id = $this->params()->fromQuery("data");
        $selector = $id;
        $innerHtml = new InnerHtml();
        $innerHtml->setSelector("#" . $selector);
        $innerHtml->setActionType(InnerHtml::ACTION_TYPE_REMOVE);

        $response->add($innerHtml);
        return $this->getResponse()->setContent($response);
    }

    /**
     * Micro fieldset for group life insurance staff list
     *
     * @return mixed
     */
    public function grouplifestaffdetailsAction()
    {
        $response = new Response();
        $groupLifeStaffDetailsFieldset = $this->groupLifeStaffDetailsFieldset;
        $microFieldsetCounterSession = new Container("micro_fieldset_counter_session");
        $microFieldsetCounterSession->groupLifeStaffList = $microFieldsetCounterSession->groupLifeStaffList + 1;

        $viewModel = new ViewModel(array(
            "field" => $groupLifeStaffDetailsFieldset
        ));

        $beneficiaryObject = $groupLifeStaffDetailsFieldset->get("beneficiary");
        $lifeAssuranceBenefitObject = $groupLifeStaffDetailsFieldset->get("lifeAssuranceBenefit");
        $annualEmolumentObject = $groupLifeStaffDetailsFieldset->get("annualEmolument");
        $employeeNameObject = $groupLifeStaffDetailsFieldset->get("employeeName");

        $employeeNameName = $employeeNameObject->getName();
        $annualEmolumentName = $annualEmolumentObject->getName();
        $lifeAssuranceBenefitName = $lifeAssuranceBenefitObject->getName();
        $beneficiaryName = $beneficiaryObject->getName();

        $employeeNameObject->setName($employeeNameName . "[" . $microFieldsetCounterSession->groupLifeStaffList . "]");
        $annualEmolumentObject->setName($annualEmolumentName . "[" . $microFieldsetCounterSession->groupLifeStaffList . "]");
        $lifeAssuranceBenefitObject->setName($lifeAssuranceBenefitName . "[" . $microFieldsetCounterSession->groupLifeStaffList . "]");
        $beneficiaryObject->setName($beneficiaryName . "[" . $microFieldsetCounterSession->groupLifeStaffList . "]");

        $viewModel->setTemplate("group_life_staff_fieldset");
        $innerHtml = new InnerHtml();
        $innerHtml->setSelector("#div_group_life_staff_fieldset");
        $innerHtml->setActionType(InnerHtml::ACTION_TYPE_APPEND);
        $innerHtml->setContent($this->viewRenderer->render($viewModel));
        $response->add($innerHtml);
        return $this->getResponse()->setContent($response);
    }

    public function fidelitygaurateeemploeelistAction()
    {
        $response = new Response();
        $fidelityEmployeeListFieldset = $this->fidelityGaurateeEmployeeListFieldset;

        $microFieldsetCounterSession = new Container("micro_fieldset_counter_session");
        $microFieldsetCounterSession->fidelityEmployeeListFieldset = $microFieldsetCounterSession->fidelityEmployeeListFieldset + 1;
        $viewModel = new ViewModel(array(
            "field" => $fidelityEmployeeListFieldset
        ));
        $viewModel->setTemplate("fidelity_gauratee_employee_list_fieldset");
        $employeeNameObject = $fidelityEmployeeListFieldset->get("employyefullName");
        $employeeCapacityObjecct = $fidelityEmployeeListFieldset->get("employeeCapacity");
        $employeeGuarateeAmountObject = $fidelityEmployeeListFieldset->get("employeeGuarateeAmount");
        $yearsdOfServiceObject = $fidelityEmployeeListFieldset->get("yearsdOfService");
        $employeeSalaryObject = $fidelityEmployeeListFieldset->get("employeeSalary");

        $employyefullNameName = $employeeNameObject->getName();
        $employeeCapacityName = $employeeCapacityObjecct->getName();
        $employeeGuarateeAmountName = $employeeGuarateeAmountObject->getName();
        $yearsdOfServiceName = $yearsdOfServiceObject->getName();
        $employeeSalaryName = $employeeSalaryObject->getName();

        $employeeNameObject->setName($employyefullNameName . "[" . $microFieldsetCounterSession->fidelityEmployeeListFieldset . "]");
        $employeeCapacityObjecct->setName($employeeCapacityName . "[" . $microFieldsetCounterSession->fidelityEmployeeListFieldset . "]");
        $employeeGuarateeAmountObject->setName($employeeGuarateeAmountName . "[" . $microFieldsetCounterSession->fidelityEmployeeListFieldset . "]");
        $yearsdOfServiceObject->setName($yearsdOfServiceName . "[" . $microFieldsetCounterSession->fidelityEmployeeListFieldset . "]");
        $employeeSalaryObject->setName($employeeSalaryName . "[" . $microFieldsetCounterSession->fidelityEmployeeListFieldset . "]");

        $innerHtml = new InnerHtml();
        $innerHtml->setSelector("#div_employee_list");
        $innerHtml->setActionType(InnerHtml::ACTION_TYPE_APPEND);
        $innerHtml->setContent($this->viewRenderer->render($viewModel));
        $response->add($innerHtml);
        return $this->getResponse()->setContent($response);
    }

    /**
     *
     * @return mixed
     */
    public function cropagriclistAction()
    {
        $response = new Response();
        $microFieldsetCounterSession = new Container("micro_fieldset_counter_session");
        $microFieldsetCounterSession->cropAgricfList = $microFieldsetCounterSession->cropAgricfList + 1;

        $cropAgricListFieldset = $this->cropAgricListFieldset;
        $viewModel = new ViewModel(array(
            "field" => $cropAgricListFieldset
        ));
        $viewModel->setTemplate("crop_agric_details_fieldset");

        $cropTypeInsuredObject = $cropAgricListFieldset->get("cropTypeInsured");
        $cropsBiggestThreatObject = $cropAgricListFieldset->get("cropsBiggestThreat");
        $cropSeedVarietyObject = $cropAgricListFieldset->get("cropSeedVariety");
        $vegetationPeriodObject = $cropAgricListFieldset->get("vegetationPeriod");
        $hectaresObject = $cropAgricListFieldset->get("hectares");
        $noOfPlantsPerHectareObject = $cropAgricListFieldset->get("noOfPlantsPerHectare");
        $annualProductionObject = $cropAgricListFieldset->get("annualProduction");
        $cropSalesValueObject = $cropAgricListFieldset->get("cropSalesValue");
        $sumInsuredObject = $cropAgricListFieldset->get("sumInsured");

        $cropTypeInsuredName = $cropTypeInsuredObject->getName();
        $cropsBiggestThreatName = $cropsBiggestThreatObject->getName();
        $cropSeedVarietyName = $cropSeedVarietyObject->getName();
        $vegetationPeriodName = $vegetationPeriodObject->getName();
        $hectaresName = $hectaresObject->getName();
        $noOfPlantsPerHectareName = $noOfPlantsPerHectareObject->getName();
        $annualProductionName = $annualProductionObject->getName();
        $cropSalesValueName = $cropSalesValueObject->getName();
        $sumInsuredName = $sumInsuredObject->getName();

        $cropTypeInsuredObject->setName($cropTypeInsuredName . "[" . $microFieldsetCounterSession->cropAgricfList . "]");
        $cropsBiggestThreatObject->setName($cropsBiggestThreatName . "[" . $microFieldsetCounterSession->cropAgricfList . "]");
        $cropSeedVarietyObject->setName($cropSeedVarietyName . "[" . $microFieldsetCounterSession->cropAgricfList . "]");
        $vegetationPeriodObject->setName($vegetationPeriodName . "[" . $microFieldsetCounterSession->cropAgricfList . "]");
        $hectaresObject->setName($hectaresName . "[" . $microFieldsetCounterSession->cropAgricfList . "]");
        $noOfPlantsPerHectareObject->setName($noOfPlantsPerHectareName . "[" . $microFieldsetCounterSession->cropAgricfList . "]");
        $annualProductionObject->setName($annualProductionName . "[" . $microFieldsetCounterSession->cropAgricfList . "]");
        $cropSalesValueObject->setName($cropSalesValueName . "[" . $microFieldsetCounterSession->cropAgricfList . "]");
        $sumInsuredObject->setName($sumInsuredName . "[" . $microFieldsetCounterSession->cropAgricfList . "]");

        $innerHtml = new InnerHtml();
        $innerHtml->setActionType(InnerHtml::ACTION_TYPE_APPEND);
        $innerHtml->setSelector("#div_crop_agric_fieldset");
        $innerHtml->setContent($this->viewRenderer->render($viewModel));
        $response->add($innerHtml);
        return $this->getResponse()->setContent($response);
    }

    /**
     * RThis is object fieldset for Crop Insurance Staff List
     *
     * @return mixed
     */
    public function cropstafflistAction()
    {
        $response = new Response();
        $microFieldsetCounterSession = new Container("micro_fieldset_counter_session");
        $microFieldsetCounterSession->cropStaffList = $microFieldsetCounterSession->cropStaffList + 1;

        $cropStaffListFieldset = $this->cropStaffListFieldset;
        $postObjet = $cropStaffListFieldset->get("post");
        $nameObject = $cropStaffListFieldset->get("name");
        $qualificationObject = $cropStaffListFieldset->get("qualification");
        $yearInServiceObject = $cropStaffListFieldset->get("yearsInService");

        $postName = $postObjet->getName();
        $nameName = $nameObject->getName();
        $qualificationName = $qualificationObject->getName();
        $yearInServiceName = $yearInServiceObject->getName();

        $postObjet->setName($postName . "[" . $microFieldsetCounterSession->cropStaffList . "]");
        $nameObject->setName($nameName . "[" . $microFieldsetCounterSession->cropStaffList . "]");
        $qualificationObject->setName($qualificationName . "[" . $microFieldsetCounterSession->cropStaffList . "]");
        $yearInServiceObject->setName($yearInServiceName . "[" . $microFieldsetCounterSession->cropStaffList . "]");

        $viewModel = new ViewModel(array(
            "field" => $cropStaffListFieldset
        ));
        $viewModel->setTemplate("crop_staff_details_fieldset");
        $innerHtml = new InnerHtml();
        $innerHtml->setSelector("#div_crop_staff_fieldset");
        $innerHtml->setActionType(InnerHtml::ACTION_TYPE_APPEND);
        $innerHtml->setContent($this->viewRenderer->render($viewModel));
        $response->add($innerHtml);
        return $this->getResponse()->setContent($response);
    }

    /**
     *
     * @return mixed
     */
    public function grouppersonalwagesdetailAction()
    {
        $response = new Response();
        $microFieldsetCounterSession = new Container("micro_fieldset_counter_session");
        $microFieldsetCounterSession->grouppersonalwagesdetail = $microFieldsetCounterSession->grouppersonalwagesdetail + 1;

        $groupPersonalWagesDetailsFieldset = $this->groupPersonalWagesFieldset;
        $viewModel = new ViewModel(array(
            "field" => $groupPersonalWagesDetailsFieldset
        ));
        $occupationObject = $groupPersonalWagesDetailsFieldset->get("occupation");
        $oobjectrOccupationObject = $groupPersonalWagesDetailsFieldset->get("oobjectrOccupation");
        $numberOfEmployeeObject = $groupPersonalWagesDetailsFieldset->get("numberOfEmployee");
        $grossAnnualSalaryObject = $groupPersonalWagesDetailsFieldset->get("grossAnnualSalary");
        $isDeathObject = $groupPersonalWagesDetailsFieldset->get("isDeath");
        $isLossOfLimbsObject = $groupPersonalWagesDetailsFieldset->get("isLossOfLimbs");
        $isLossOfEyesObject = $groupPersonalWagesDetailsFieldset->get("isLossOfEyes");
        $temporaryDisablementTotalObject = $groupPersonalWagesDetailsFieldset->get("temporaryDisablementTotal");
        $permanentDisablementObject = $groupPersonalWagesDetailsFieldset->get("permanentDisablement");
        $medicalExpenseLimitObject = $groupPersonalWagesDetailsFieldset->get("medicalExpenseLimit");

        $isDeathName = $isDeathObject->getName();
        $occupationName = $occupationObject->getName();
        $oobjectrOccupationName = $oobjectrOccupationObject->getName();
        $numberOfEmployeeName = $numberOfEmployeeObject->getName();
        $grossAnnualSalaryName = $grossAnnualSalaryObject->getName();
        $isLossOfLimbsName = $isLossOfLimbsObject->getName();
        $isLossOfEyesName = $isLossOfEyesObject->getName();
        $temporaryDisablementTotalName = $temporaryDisablementTotalObject->getName();
        $permanentDisablementName = $permanentDisablementObject->getName();
        $medicalExpenseLimitName = $medicalExpenseLimitObject->getName();

        $isDeathNewName = $isDeathName . "[" . $microFieldsetCounterSession->grouppersonalwagesdetail . "]";
        $occupationNewName = $occupationName . "[" . $microFieldsetCounterSession->grouppersonalwagesdetail . "]";
        $oobjectrOccupationNewName = $oobjectrOccupationName . "[" . $microFieldsetCounterSession->grouppersonalwagesdetail . "]";
        $numberOfEmployeeNewName = $numberOfEmployeeName . "[" . $microFieldsetCounterSession->grouppersonalwagesdetail . "]";
        $grossAnnualSalaryNewName = $grossAnnualSalaryName . "[" . $microFieldsetCounterSession->grouppersonalwagesdetail . "]";
        $isLossOfLimbsNewName = $isLossOfLimbsName . "[" . $microFieldsetCounterSession->grouppersonalwagesdetail . "]";
        $isLossOfEyesNewName = $isLossOfEyesName . "[" . $microFieldsetCounterSession->grouppersonalwagesdetail . "]";
        $temporaryDisablementTotalNewName = $temporaryDisablementTotalName . "[" . $microFieldsetCounterSession->grouppersonalwagesdetail . "]";
        $permanentDisablementNewName = $permanentDisablementName . "[" . $microFieldsetCounterSession->grouppersonalwagesdetail . "]";
        $medicalExpenseLimitNewName = $medicalExpenseLimitName . "[" . $microFieldsetCounterSession->grouppersonalwagesdetail . "]";

        $occupationObject->setName($occupationNewName);
        // $occupationObject->setAttributes
        $oobjectrOccupationObject->setName($oobjectrOccupationNewName);
        $isDeathObject->setName($isDeathNewName);
        $numberOfEmployeeObject->setName($numberOfEmployeeNewName);
        $grossAnnualSalaryObject->setName($grossAnnualSalaryNewName);
        $isLossOfEyesObject->setName($isLossOfEyesNewName);
        $isLossOfLimbsObject->setName($isLossOfLimbsNewName);
        $temporaryDisablementTotalObject->setName($temporaryDisablementTotalNewName);
        $permanentDisablementObject->setName($permanentDisablementNewName);
        $medicalExpenseLimitObject->setName($medicalExpenseLimitNewName);

        $viewModel->setTemplate("group_personal_wages_details_fieldset");
        $innerHtml = new InnerHtml();
        $innerHtml->setSelector("#div_group_personal_wages_details");
        $innerHtml->setActionType(InnerHtml::ACTION_TYPE_APPEND);
        $innerHtml->setContent($this->viewRenderer->render($viewModel));
        $response->add($innerHtml);
        return $this->getResponse()->setContent($response);
    }

    public function grouppersonalfixeddetailAction()
    {
        $response = new Response();
        $microFieldsetCounterSession = new Container("micro_fieldset_counter_session");
        $microFieldsetCounterSession->grouppersonalfixeddetail = $microFieldsetCounterSession->grouppersonalfixeddetail + 1;
        // $groupPersonalWagesDetailsFeildset = $this->groupPersonalWagesFieldset;
        // $groupPersonalWagesDetailsFeildset->set

        $groupPersonalFixedDetailsFieldset = $this->groupPersonalFixedFieldset;
        $personsNameObject = $groupPersonalFixedDetailsFieldset->get("name");
        $personDobObject = $groupPersonalFixedDetailsFieldset->get("dob");
        $occupationObject = $groupPersonalFixedDetailsFieldset->get("occupation");
        $temporaryDisablementTotalObject = $groupPersonalFixedDetailsFieldset->get("temporaryDisablementTotal");
        $permanentDisablementObject = $groupPersonalFixedDetailsFieldset->get("permanentDisablement");

        $personsNameName = $personsNameObject->getName();
        $personDobName = $personDobObject->getName();
        $occupationName = $occupationObject->getName();
        $temporaryDisablementTotalName = $temporaryDisablementTotalObject->getName();
        $permanentDisablementName = $permanentDisablementObject->getName();

        $personNameNewName = $personsNameName . "[" . $microFieldsetCounterSession->grouppersonalfixeddetail . "]";
        $personDobNewName = $personDobName . "[" . $microFieldsetCounterSession->grouppersonalfixeddetail . "]";
        $occupationNewName = $occupationName . "[" . $microFieldsetCounterSession->grouppersonalfixeddetail . "]";
        $temporaryDisablementTotalNewName = $temporaryDisablementTotalName . "[" . $microFieldsetCounterSession->grouppersonalfixeddetail . "]";
        $permanentDisablementNewName = $permanentDisablementName . "[" . $microFieldsetCounterSession->grouppersonalfixeddetail . "]";

        $personsNameObject->setName($personNameNewName);
        $personsNameObject->setAttributes(array(
            "id" => $personNameNewName
        ));

        $personDobObject->setName($personDobNewName);
        $personDobObject->setAttributes(array(
            "id" => $personDobNewName
        ));

        $occupationObject->setName($occupationNewName);
        $occupationObject->setAttributes(array(
            "id" => $occupationNewName
        ));

        $temporaryDisablementTotalObject->setName($temporaryDisablementTotalNewName);
        $temporaryDisablementTotalObject->setAttributes(array(
            "id" => $temporaryDisablementTotalNewName
        ));

        $permanentDisablementObject->setName($permanentDisablementNewName);
        $permanentDisablementObject->setAttributes(array(
            "id" => $permanentDisablementNewName
        ));
        $viewModel = new ViewModel(array(
            "field" => $groupPersonalFixedDetailsFieldset
        ));
        $viewModel->setTemplate("group_personal_fixed_details_fieldset");

        $innerHtml = new InnerHtml();
        $innerHtml->setSelector("#div_group_personal_fixed_details");
        $innerHtml->setActionType(InnerHtml::ACTION_TYPE_APPEND);
        $innerHtml->setContent($this->viewRenderer->render($viewModel));
        $response->add($innerHtml);
        return $this->getResponse()->setContent($response);
    }

    public function agricproductlistAction()
    {
        $respons = new Response();
        $microFieldsetCounterSession = new Container("micro_fieldset_counter_session");
        $microFieldsetCounterSession->agricProductList = $microFieldsetCounterSession->agricProductList + 1;
        $agricProductListFieldset = $this->agricProductListFieldset;
        $innerHtml = new InnerHtml();
        $propertyNameObject = $agricProductListFieldset->get("propertyName");
        $valueObject = $agricProductListFieldset->get("value");
        $descObject = $agricProductListFieldset->get("desc");

        $propertyNameName = $propertyNameObject->getName();
        $valueName = $valueObject->getName();
        $descName = $descObject->getName();

        $propertyNamenewName = $propertyNameName . "[" . $microFieldsetCounterSession->agricProductList . "]";
        $valueNewName = $valueName . "[" . $microFieldsetCounterSession->agricProductList . "]";
        $descNewName = $descName . "[" . $microFieldsetCounterSession->agricProductList . "]";

        $propertyNameObject->setName($propertyNamenewName);
        $propertyNameObject->setAttributes(array(
            "id" => $propertyNamenewName
        ));
        $valueObject->setName($valueNewName);
        $valueObject->setAttributes(array(
            "id" => $valueNewName
        ));
        $descObject->setName($descNewName);
        $descObject->setAttributes(array(
            "id" => $descNewName
        ));
        $viewModel = new ViewModel(array(
            "field" => $agricProductListFieldset
        ));
        $viewModel->setTemplate("agric_product_list_fieldset");
        $innerHtml->setActionType(InnerHtml::ACTION_TYPE_APPEND);
        $innerHtml->setSelector("#div_agric_list");

        $innerHtml->setContent($this->viewRenderer->render($viewModel));
        $respons->add($innerHtml);
        return $this->getResponse()->setContent($respons);
    }

    public function buglarysafedetailsAction()
    {
        $microFieldsetCounterSession = new Container("micro_fieldset_counter_session");
        $microFieldsetCounterSession->buglarSafeDetails = $microFieldsetCounterSession->buglarSafeDetails + 1;
        $buglarySafeDetailsFieldset = $this->buglarySafeDetailsForm;
        $innerHtml = new InnerHtml();
        $innerHtml->setSelector("#div_safe_details");
        $innerHtml->setActionType(InnerHtml::ACTION_TYPE_APPEND);
        $viewModel = new ViewModel(array(
            "field" => $buglarySafeDetailsFieldset
        ));
        $productNameObject = $buglarySafeDetailsFieldset->get("productName");
        $makerObject = $buglarySafeDetailsFieldset->get("maker");
        $modelObject = $buglarySafeDetailsFieldset->get("model");
        $costObject = $buglarySafeDetailsFieldset->get("cost");
        $sizeObject = $buglarySafeDetailsFieldset->get("size");

        $productNameName = $productNameObject->getName();
        $makerName = $makerObject->getName();
        $modelName = $modelObject->getName();
        $costName = $costObject->getName();
        $sizeName = $sizeObject->getName();

        $productNameNewName = $productNameName . "[" . $microFieldsetCounterSession->buglarSafeDetails . "]";
        $makerNewName = $makerName . "[" . $microFieldsetCounterSession->buglarSafeDetails . "]";
        $modelNewName = $modelName . "[" . $microFieldsetCounterSession->buglarSafeDetails . "]";
        $costNewName = $costName . "[" . $microFieldsetCounterSession->buglarSafeDetails . "]";
        // $productNameNewName = $productNameName."[".$microFieldsetCounterSession->buglarSafeDetails."]";
        $sizeNewName = $sizeName . "[" . $microFieldsetCounterSession->buglarSafeDetails . "]";

        $productNameObject->setName($productNameNewName);
        $productNameObject->setAttributes(array(
            "id" => $productNameNewName
        ));
        $makerObject->setName($makerNewName);
        $makerObject->setAttributes(array(
            "id" => $makerNewName
        ));

        $modelObject->setName($modelNewName);
        $modelObject->setAttributes(array(
            "id" => $modelNewName
        ));

        $costObject->setName($costNewName);
        $costObject->setAttributes(array(
            "id" => $costNewName
        ));

        $sizeObject->setName($sizeNewName);
        $sizeObject->setAttributes(array(
            "id" => $sizeNewName
        ));

        $viewModel->setTemplate("buglary_safe_details_fieldset");
        $innerHtml->setContent($this->viewRenderer->render($viewModel));
        $response = new Response();
        $response->add($innerHtml);
        return $this->getResponse()->setContent($response);
    }

    public function aviationpilotdetailsAction()
    {
        $microFieldsetCounterSession = new Container("micro_fieldset_counter_session");
        $microFieldsetCounterSession->aviationPilotDetails = $microFieldsetCounterSession->aviationPilotDetails + 1;
        $response = new Response();
        $aviationPilotDetailsFieldset = $this->aviationPiltoDetailsFeildet;

        $pilotNameObject = $aviationPilotDetailsFieldset->get("pilotName");
        $pilotDobObject = $aviationPilotDetailsFieldset->get("pilotDOb");
        $flyingHoursObject = $aviationPilotDetailsFieldset->get("flyingHours");
        $licenceNumberObject = $aviationPilotDetailsFieldset->get("licenceNumber");
        $isPreviousAccidentObject = $aviationPilotDetailsFieldset->get("isPreviousAccident");

        $pilotNameName = $pilotNameObject->getName();
        $pilotDobName = $pilotDobObject->getName();
        $flyingHoursName = $flyingHoursObject->getName();
        $licenceNumberName = $licenceNumberObject->getName();
        $isPreviousAccidentName = $isPreviousAccidentObject->getName();

        $pilotNewName = $pilotNameName . "[" . $microFieldsetCounterSession->aviationPilotDetails . "]";
        $pilotDobNewName = $pilotDobName . "[" . $microFieldsetCounterSession->aviationPilotDetails . "]";
        $flyingHoursNewName = $flyingHoursName . "[" . $microFieldsetCounterSession->aviationPilotDetails . "]";
        $licenceNumberNewName = $licenceNumberName . "[" . $microFieldsetCounterSession->aviationPilotDetails . "]";
        $isPreviousAccidentNewName = $isPreviousAccidentName . "[" . $microFieldsetCounterSession->aviationPilotDetails . "]";

        $pilotNameObject->setName($pilotNewName);
        $pilotNameObject->setAttributes(array(
            "id" => $pilotNewName
        ));

        $pilotDobObject->setName($pilotDobNewName);
        $pilotDobObject->setAttributes(array(
            "id" => $pilotDobNewName
        ));

        $flyingHoursObject->setName($flyingHoursNewName);
        $flyingHoursObject->setAttributes(array(
            "id" => $flyingHoursNewName
        ));

        $licenceNumberObject->setName($licenceNumberNewName);
        $licenceNumberObject->setAttributes(array(
            "id" => "$licenceNumberNewName"
        ));

        $isPreviousAccidentObject->setName($isPreviousAccidentNewName);
        $isPreviousAccidentObject->setAttributes(array(
            "id" => $isPreviousAccidentNewName
        ));

        $viewmodel = new ViewModel(array(
            "field" => $aviationPilotDetailsFieldset
        ));

        $viewmodel->setTemplate("aviation_pilot_details_fiedlset");

        $innerHtml = new InnerHtml();
        $innerHtml->setSelector("#div_pilotDetails");
        $innerHtml->setActionType(InnerHtml::ACTION_TYPE_APPEND);
        $innerHtml->setContent($this->viewRenderer->render($viewmodel));

        $response->add($innerHtml);
        return $this->getResponse()->setContent($response);
    }

    public function boilercoverdetalsAction()
    {
        $microFieldsetCounterSession = new Container("micro_fieldset_counter_session");
        $microFieldsetCounterSession->boilerCoverDetails = $microFieldsetCounterSession->boilerCoverDetails + 1;
        $boilerCoverDetailsFieldset = $this->boilerCoverDetailsFieldset;
        $viewModel = new ViewModel(array(
            "field" => $boilerCoverDetailsFieldset
        ));

        $itemDescriptionObject = $boilerCoverDetailsFieldset->get("itemDescription");
        $manuYearObject = $boilerCoverDetailsFieldset->get("manuYear");
        $replacementValueObject = $boilerCoverDetailsFieldset->get("replacementValue");

        $itemDescriptionName = $itemDescriptionObject->getName();
        $manuYearName = $manuYearObject->getName();
        $replacementValueName = $replacementValueObject->getName();

        $itemDescriptionNewName = $itemDescriptionName . "[" . $microFieldsetCounterSession->boilerCoverDetails . "]";
        $manuYearNewName = $manuYearName . "[" . $microFieldsetCounterSession->boilerCoverDetails . "]";
        $replacementValueNewName = $replacementValueName . "[" . $microFieldsetCounterSession->boilerCoverDetails . "]";

        $itemDescriptionObject->setName($itemDescriptionNewName);
        $itemDescriptionObject->setAttributes(array(
            "id" => $itemDescriptionNewName
        ));

        $manuYearObject->setName($manuYearNewName);
        $manuYearObject->setAttributes(array(
            "id" => $manuYearNewName
        ));

        $replacementValueObject->setName($replacementValueNewName);
        $replacementValueObject->setAttributes(array(
            "id" => $replacementValueNewName
        ));

        $viewModel->setTemplate("boiler_cover_details_fiedlset");
        $innerhtml = new InnerHtml();
        $innerhtml->setSelector("#div_cover_details_fieldset");
        $innerhtml->setActionType(InnerHtml::ACTION_TYPE_APPEND);
        $innerhtml->setContent($this->viewRenderer->render($viewModel));
        $response = new Response();
        $response->add($innerhtml);
        return $this->getResponse()->setContent($response);
    }

    // private
    public function contractallriskvaluelistAction()
    {
        $microFieldsetCounterSession = new Container("micro_fieldset_counter_session");
        $microFieldsetCounterSession->contractorAllRiskValueList = $microFieldsetCounterSession->contractorAllRiskValueList + 1;

        $contractorAllRiskFieldset = $this->contractAllRiskValueListFieldset;
        $viewModel = new ViewModel(array(
            "field" => $contractorAllRiskFieldset
        ));

        $valueNameObject = $contractorAllRiskFieldset->get("valueName");
        $valueObject = $contractorAllRiskFieldset->get("value");

        $valueNameName = $valueNameObject->getName();
        $valueName = $valueObject->getName();

        $valueNameNewName = $valueNameName . "[" . $microFieldsetCounterSession->contractorAllRiskValueList . "]";
        $valueNewName = $valueName . "[" . $microFieldsetCounterSession->contractorAllRiskValueList . "]";

        $valueNameObject->setName($valueNameNewName);
        $valueNameObject->setAttributes(array(
            "id" => $valueNameNewName
        ));

        $valueObject->setName($valueNewName);
        $valueObject->setAttributes(array(
            "id" => $valueNewName
        ));

        $viewModel->setTemplate("contractor_all_risk_value_list_fieldset");
        $innerHtml = new InnerHtml();
        $innerHtml->setSelector("#value_list");
        $innerHtml->setActionType(InnerHtml::ACTION_TYPE_APPEND);
        $innerHtml->setContent($this->viewRenderer->render($viewModel));
        $response = new Response();
        $response->add($innerHtml);
        return $this->getResponse()->setContent($response);
    }

    public function employeeliabilitydetailAction()
    {
        $microFieldsetCounterSession = new Container("micro_fieldset_counter_session");
        $microFieldsetCounterSession->employeeLiabilityDetailFieldset = $microFieldsetCounterSession->employeeLiabilityDetailFieldset + 1;
        $response = new Response();
        $employeeLiabilityDetailsFieldset = $this->employeeLiabilityDetailsFieldset;
        $viewModel = new ViewModel(array(
            "field" => $employeeLiabilityDetailsFieldset
        ));
        $viewModel->setTemplate("employee_liability_detail_fieldset");
        $employeeDescriptionObject = $employeeLiabilityDetailsFieldset->get("employeeDescription");
        $numbersOfEmployeeObject = $employeeLiabilityDetailsFieldset->get("numbersOfEmployee");
        $estimatedPeriodWageObject = $employeeLiabilityDetailsFieldset->get("estimatedPeriodWage");

        $employeeDescriptionName = $employeeDescriptionObject->getName();
        $numbersOfEmployeeName = $numbersOfEmployeeObject->getName();
        $estimatedPeriodWageName = $estimatedPeriodWageObject->getName();

        $employeeDescriptionObject->setName($employeeDescriptionName . "[" . $microFieldsetCounterSession->employeeLiabilityDetailFieldset . "]");
        $numbersOfEmployeeObject->setName($numbersOfEmployeeName . "[" . $microFieldsetCounterSession->employeeLiabilityDetailFieldset . "]");
        $estimatedPeriodWageObject->setName($estimatedPeriodWageName . "[" . $microFieldsetCounterSession->employeeLiabilityDetailFieldset . "]");

        $innerHtml = new InnerHtml();
        $innerHtml->setSelector("#employee_liability_details");
        $innerHtml->setActionType(InnerHtml::ACTION_TYPE_APPEND);
        $innerHtml->setContent($this->viewRenderer->render($viewModel));
        $response = new Response();
        $response->add($innerHtml);
        return $this->getResponse()->setContent($response);
    }

    public function gitvehiclelistAction()
    {
        $response = new Response();
        $microFieldsetCounterSession = new Container("micro_fieldset_counter_session");
        $microFieldsetCounterSession->gitvehiclelist = $microFieldsetCounterSession->gitvehiclelist + 1;
        $gitVehichleListFieldset = $this->gitVehicleListForm;
        $viewModel = new ViewModel(array(
            "field" => $gitVehichleListFieldset
        ));
        $viewModel->setTemplate("git_vehicle_list_fiedlset");

        $regNoObject = $gitVehichleListFieldset->get("regNo");
        $carMakeObject = $gitVehichleListFieldset->get("carMake");
        $oobjectrMakeObject = $gitVehichleListFieldset->get("oobjectrMake");
        $bodyTypeObject = $gitVehichleListFieldset->get("bodyType");
        $manuYearObject = $gitVehichleListFieldset->get("manuYear");
        $maxCapacityObject = $gitVehichleListFieldset->get("maxCapacity");

        $regNoName = $regNoObject->getName();
        $carMakeName = $carMakeObject->getName();
        $oobjectrMakeName = $oobjectrMakeObject->getName();
        $bodyTypeName = $bodyTypeObject->getName();
        $manuYearName = $manuYearObject->getName();
        $maxCapacityName = $maxCapacityObject->getName();

        $regNoObject->setName($regNoName . "[" . $microFieldsetCounterSession->gitvehiclelist . "]");
        $carMakeObject->setName($carMakeName . "[" . $microFieldsetCounterSession->gitvehiclelist . "]");
        $oobjectrMakeObject->setName($oobjectrMakeName . "[" . $microFieldsetCounterSession->gitvehiclelist . "]");
        $bodyTypeObject->setName($bodyTypeName . "[" . $microFieldsetCounterSession->gitvehiclelist . "]");
        $manuYearObject->setName($manuYearName . "[" . $microFieldsetCounterSession->gitvehiclelist . "]");
        $maxCapacityObject->setName($maxCapacityName . "[" . $microFieldsetCounterSession->gitvehiclelist . "]");

        $innerHtml = new InnerHtml();
        $innerHtml->setSelector("#gitVehicleList");
        $innerHtml->setActionType(InnerHtml::ACTION_TYPE_APPEND);
        $innerHtml->setContent($this->viewRenderer->render($viewModel));
        $response->add($innerHtml);
        return $this->getResponse()->setContent($response);
    }

    public function housegoodsvaluelistAction()
    {
        $response = new Response();
        $microFieldsetCounterSession = new Container("micro_fieldset_counter_session");
        $microFieldsetCounterSession->goodslistFieldset = $microFieldsetCounterSession->goodslistFieldset + 1;
        $goodlistFieldset = $this->homeHouseholdGoodsFieldset;
        $viewModel = new ViewModel(array(
            "field" => $goodlistFieldset
        ));
        $viewModel->setTemplate("home_goods_list_fieldset");

        $goodsNameObject = $goodlistFieldset->get("goodsName");
        $valueObject = $goodlistFieldset->get("value");
        $serialNumberObject = $goodlistFieldset->get("serialNumber");

        $goodsNameName = $goodsNameObject->getName();
        $valueName = $valueObject->getName();
        $serialNumberName = $serialNumberObject->getName();

        $goodsNameObject->setName($goodsNameName . "[" . $microFieldsetCounterSession->goodslistFieldset . "]");
        $valueObject->setName($valueName . "[" . $microFieldsetCounterSession->goodslistFieldset . "]");
        $serialNumberObject->setName($serialNumberName . "[" . $microFieldsetCounterSession->goodslistFieldset . "]");

        $innerHtml = new InnerHtml();
        $innerHtml->setSelector("#div_home_goods");
        $innerHtml->setActionType(InnerHtml::ACTION_TYPE_APPEND);
        $innerHtml->setContent($this->viewRenderer->render($viewModel));

        $response->add($innerHtml);

        return $this->getResponse()->setContent($response);
    }

    public function housevaluableslistAction()
    {
        $response = new Response();
        $microFieldsetCounterSession = new Container("micro_fieldset_counter_session");
        $microFieldsetCounterSession->valuableslistFieldset = $microFieldsetCounterSession->valuableslistFieldset + 1;
        $valuablelisFieldset = $this->homeHouseValueableFiedset;
        $viewModel = new ViewModel(array(
            "field" => $valuablelisFieldset
        ));
        $viewModel->setTemplate("home_valuables_list_fieldset");

        $nameObject = $valuablelisFieldset->get("name");
        $costObject = $valuablelisFieldset->get("cost");

        $nameName = $nameObject->getName();
        $costName = $costObject->getName();

        $nameObject->setName($nameName . "[" . $microFieldsetCounterSession->valuableslistFieldset . "]");
        $costObject->setName($costName . "[" . $microFieldsetCounterSession->valuableslistFieldset . "]");

        $innerHtml = new InnerHtml();
        $innerHtml->setSelector("#div_home_valuables");
        $innerHtml->setActionType(InnerHtml::ACTION_TYPE_APPEND);
        $innerHtml->setContent($this->viewRenderer->render($viewModel));

        $response->add($innerHtml);
        return $this->getResponse()->setContent($response);
    }

    /**
     * object motor standard form
     *
     * @return mixed
     */
    public function motornonstandardAction()
    {
        $microFieldsetCounterSession = new Container("micro_fieldset_counter_session");
        // if($microFieldsetCounterSession->motorNonStandardAccessory)
        $microFieldsetCounterSession->motorNonStandardAccessory = $microFieldsetCounterSession->motorNonStandardAccessory + 1;
        $innerHtml = new InnerHtml();

        $form = $this->motorNonStandardForm;
        $accessoryNameObject = $form->get("accessoryName");
        $accessoryValueObject = $form->get("accessoryValue");

        // $accessoryNameString = "accessoryName";

        $accessoryName = $accessoryNameObject->getName();
        $accessoryValueName = $accessoryValueObject->getName();

        $newName = $accessoryName . "[" . $microFieldsetCounterSession->motorNonStandardAccessory . "]";
        $newValue = $accessoryValueName . "[" . $microFieldsetCounterSession->motorNonStandardAccessory . "]";

        // $accessory
        $accessoryNameObject->setName($newName);
        $accessoryNameObject->setAttributes(array(
            "id" => $newName
        ));

        $accessoryValueObject->setName($newValue);
        $accessoryValueObject->setAttributes(array(
            "id" => $newValue
        ));
        $response = new Response();
        $innerHtml->setSelector("#div_non_standard_fieldset");
        $viewModel = new ViewModel(array(
            "motorNonStandarFieldset" => $form
        ));
        $viewModel->setTemplate("motor_non_standard_fiedlset");

        $innerHtml->setContent($this->viewRenderer->render($viewModel));
        $innerHtml->setActionType(InnerHtml::ACTION_TYPE_APPEND);
        // $innerHtml->setRenderer($this->viewRenderer);
        // $innerHtml->setViewModel($viewModel);
        $response->add($innerHtml);
        return $this->getResponse()->setContent($response);
    }

    public function livestockinsurelistAction()
    {
        $response = new Response();
        $microFieldsetCounterSession = new Container("micro_fieldset_counter_session");
        $microFieldsetCounterSession->livestockInsuredList = $microFieldsetCounterSession->livestockInsuredList + 1;
        $livestoclInsuredFieldset = $this->livestockInsuredListFieldset;

        $breedObject = $livestoclInsuredFieldset->get("breed");
        $animalIdObject = $livestoclInsuredFieldset->get("animalId");
        $ageObject = $livestoclInsuredFieldset->get("age");
        $sexObject = $livestoclInsuredFieldset->get("sex");
        $marketValueObject = $livestoclInsuredFieldset->get("marketValue");

        $breedName = $breedObject->getName();
        $animalIdName = $animalIdObject->getName();
        $ageName = $ageObject->getName();
        $sexName = $sexObject->getName();
        $marketValueName = $marketValueObject->getName();

        $breedObject->setName($breedName . "[" . $microFieldsetCounterSession->livestockInsuredList . "]");
        $animalIdObject->setName($animalIdName . "[" . $microFieldsetCounterSession->livestockInsuredList . "]");
        $ageObject->setName($ageName . "[" . $microFieldsetCounterSession->livestockInsuredList . "]");
        $sexObject->setName($sexName . "[" . $microFieldsetCounterSession->livestockInsuredList . "]");
        $marketValueObject->setName($marketValueName . "[" . $microFieldsetCounterSession->livestockInsuredList . ']');

        $viewModel = new ViewModel(array(
            "field" => $livestoclInsuredFieldset
        ));
        $viewModel->setTemplate("livestock-insured_list_fieldset");
        $innerHtml = new InnerHtml();
        $innerHtml->setActionType(InnerHtml::ACTION_TYPE_APPEND);
        $innerHtml->setSelector("#div_livestock_insured_list");
        $innerHtml->setContent($this->viewRenderer->render($viewModel));

        $response->add($innerHtml);
        return $this->getResponse()->setContent($response);
    }

    public function occupiersliabilitystaffAction()
    {
        $response = new Response();
        $microFieldsetCounterSession = new Container("micro_fieldset_counter_session");
        $microFieldsetCounterSession->occupiersLiabityStaffFieldset = $microFieldsetCounterSession->occupiersLiabityStaffFieldset + 1;

        $occupiersLiabityStaffFieldset = $this->occupiersLiabilityStaffFieldset;
        $viewModel = new ViewModel(array(
            "field" => $occupiersLiabityStaffFieldset
        ));

        $fullNameObject = $occupiersLiabityStaffFieldset->get("fullName");
        $wagesObject = $occupiersLiabityStaffFieldset->get("wages");
        $natureOfWorkObject = $occupiersLiabityStaffFieldset->get("natureOfWork");
        $employmentDurationObject = $occupiersLiabityStaffFieldset->get("employmentDuration");

        $fullNameName = $fullNameObject->getName();
        $wagesName = $wagesObject->getName();
        $natureOfWorkName = $natureOfWorkObject->getName();
        $employmentDurationName = $employmentDurationObject->getName();

        $fullNameObject->setName($fullNameName . "[" . $microFieldsetCounterSession->occupiersLiabityStaffFieldset . "]");
        $wagesObject->setName($wagesName . "[" . $microFieldsetCounterSession->occupiersLiabityStaffFieldset . "]");
        $natureOfWorkObject->setName($natureOfWorkName . "[" . $microFieldsetCounterSession->occupiersLiabityStaffFieldset . "]");
        $employmentDurationObject->setName($employmentDurationName . "[" . $microFieldsetCounterSession->occupiersLiabityStaffFieldset . "]");

        $viewModel->setTemplate("occupier_liability_staff_fieldset");

        $innerHtml = new InnerHtml();
        $innerHtml->setActionType(InnerHtml::ACTION_TYPE_APPEND);
        $innerHtml->setSelector("#div_staff_list");
        $innerHtml->setContent($this->viewRenderer->render($viewModel));

        $response->add($innerHtml);
        return $this->getResponse()->setContent($response);
    }

    public function occupiersliabilityfamilyAction()
    {
        $response = new Response();
        $microFieldsetCounterSession = new Container("micro_fieldset_counter_session");
        $microFieldsetCounterSession->occupiersLiabityFamilyFieldset = $microFieldsetCounterSession->occupiersLiabityFamilyFieldset + 1;

        $occupiersLiabityFamilyFieldset = $this->occupiersLiabilityFamilyFieldset;

        $fullNameObject = $occupiersLiabityFamilyFieldset->get("fullNamef");
        $relationshipObject = $occupiersLiabityFamilyFieldset->get("relationship");
        $dobObject = $occupiersLiabityFamilyFieldset->get("dob");
        $sexObject = $occupiersLiabityFamilyFieldset->get("sex");

        $fullNameName = $fullNameObject->getName();
        $relationshipName = $relationshipObject->getName();
        $dobName = $dobObject->getName();
        $sexName = $sexObject->getName();

        $fullNameObject->setName($fullNameName . "[" . $microFieldsetCounterSession->occupiersLiabityFamilyFieldset . "]");
        $relationshipObject->setName($relationshipName . "[" . $microFieldsetCounterSession->occupiersLiabityFamilyFieldset . "]");
        $dobObject->setName($dobName . "[" . $microFieldsetCounterSession->occupiersLiabityFamilyFieldset . "]");
        $sexObject->setName($sexName . "[" . $microFieldsetCounterSession->occupiersLiabityFamilyFieldset . "]");

        $viewModel = new ViewModel(array(
            "field" => $occupiersLiabityFamilyFieldset
        ));
        $viewModel->setTemplate("occupier_liability_family_fieldset");

        $innerHtml = new InnerHtml();
        $innerHtml->setActionType(InnerHtml::ACTION_TYPE_APPEND);
        $innerHtml->setSelector("#div_family_list");
        $innerHtml->setContent($this->viewRenderer->render($viewModel));

        $response->add($innerHtml);
        return $this->getResponse()->setContent($response);
    }

    public function professionalindemnitypartnerdetailsAction()
    {
        $innerHtml = new InnerHtml();
        $response = new Response();
        $form = $this->professionalIndemnityForm;
        $microFieldsetCounterSession = new Container("micro_fieldset_counter_session");
        $microFieldsetCounterSession->professionalindemnitypartnerdetails = $microFieldsetCounterSession->professionalindemnitypartnerdetails + 1;

        $viewModel = new ViewModel(array(
            "field" => $form
        ));

        $partnerNameObject = $form->get("partnerName");
        $qualificationObject = $form->get("qualification");
        $dateQualifiedObject = $form->get("dateQualified");
        $partnerCapacityObject = $form->get("partnerCapacity");

        $partnerNameName = $partnerNameObject->getName();
        $qualificationName = $qualificationObject->getName();
        $dateQualifiedName = $dateQualifiedObject->getName();
        $partnerCapacityName = $partnerCapacityObject->getName();

        $partnerNameObject->setName($partnerNameName . "[" . $microFieldsetCounterSession->professionalindemnitypartnerdetails . "]");
        $qualificationObject->setName($qualificationName . "[" . $microFieldsetCounterSession->professionalindemnitypartnerdetails . "]");
        $dateQualifiedObject->setName($dateQualifiedName . "[" . $microFieldsetCounterSession->professionalindemnitypartnerdetails . "]");
        $partnerCapacityObject->setName($partnerCapacityName . "[" . $microFieldsetCounterSession->professionalindemnitypartnerdetails . "]");
        $viewModel->setTemplate("professional_indemnity_partner_details_fiedlset");
        $html = $this->viewRenderer->render($viewModel);
        $innerHtml->setActionType(InnerHtml::ACTION_TYPE_APPEND);
        $innerHtml->setSelector("#partner_details");
        $innerHtml->setContent($html);
        $response->add($innerHtml);
        return $this->getResponse()->setContent($response);
    }

    public function publicliabilityemployeedetailsAction()
    {
        $response = new Response();

        $microFieldsetCounterSession = new Container("micro_fieldset_counter_session");
        $microFieldsetCounterSession->publicLiabilityEmployeeDetails = $microFieldsetCounterSession->publicLiabilityEmployeeDetails + 1;
        $employeeFielset = $this->publicLiabilityEmployeeFieldset;
        $viewModel = new ViewModel(array(
            "field" => $employeeFielset
        ));

        $noOfEmployeesObject = $employeeFielset->get("noOfEmployees");
        $natureOfWorkObject = $employeeFielset->get("natureOfWork");
        $insuranceConnectionObject = $employeeFielset->get("insuranceConnection");

        $noOfEmployeesName = $noOfEmployeesObject->getName();
        $natureOfWorkName = $natureOfWorkObject->getName();
        $insuranceConnectionName = $insuranceConnectionObject->getName();

        $noOfEmployeesObject->setName($noOfEmployeesName . "[" . $microFieldsetCounterSession->publicLiabilityEmployeeDetails . "]");
        $natureOfWorkObject->setName($natureOfWorkName . "[" . $microFieldsetCounterSession->publicLiabilityEmployeeDetails . "]");
        $insuranceConnectionObject->setName($insuranceConnectionName . "[" . $microFieldsetCounterSession->publicLiabilityEmployeeDetails . "]");

        $viewModel->setTemplate("public_liability_employee_fieldset");
        $innerHtml = new InnerHtml();
        $innerHtml->setActionType(InnerHtml::ACTION_TYPE_APPEND);
        $innerHtml->setSelector("#employee_details");
        $innerHtml->setContent($this->viewRenderer->render($viewModel));

        $response->add($innerHtml);
        return $this->getResponse()->setContent($response);
    }

    /**
     * Workmen Compensation decree list
     * Micro fieldset
     *
     * @return mixed
     */
    public function workmenDecreelistAction()
    {
        $response = new Response();
        $microFieldsetCounterSession = new Container("micro_fieldset_counter_session");
        $microFieldsetCounterSession->workmenDecreeList = $microFieldsetCounterSession->workmenDecreeList + 1;
        $workmenDecreeListFieldset = $this->workmenDecreeListFieldset;
        $viewModel = new ViewModel(array(
            "field" => $workmenDecreeListFieldset
        ));
        $viewModel->setTemplate("workmen_decree_list_fieldset");

        $employeeCategoreeObject = $workmenDecreeListFieldset->get("employeeCategoree");
        $numberOfEmployeeObject = $workmenDecreeListFieldset->get("numberOfEmployee");
        $cashCompensationObject = $workmenDecreeListFieldset->get("cashCompensation");
        $oobjectrCompensationObject = $workmenDecreeListFieldset->get("oobjectrCompensation");
        $totalCompensationObject = $workmenDecreeListFieldset->get("totalCompensation");

        $employeeCategoreeName = $employeeCategoreeObject->getName();
        $numberOfEmployeeName = $numberOfEmployeeObject->getName();
        $cashCompensationName = $cashCompensationObject->getName();
        $oobjectrCompensationName = $oobjectrCompensationObject->getName();
        $totalCompensationName = $totalCompensationObject->getName();

        $employeeCategoreeObject->setName($employeeCategoreeName . "[" . $microFieldsetCounterSession->workmenDecreeList . "]");
        $numberOfEmployeeObject->setName($numberOfEmployeeName . "[" . $microFieldsetCounterSession->workmenDecreeList . "]");
        $cashCompensationObject->setName($cashCompensationName . "[" . $microFieldsetCounterSession->workmenDecreeList . "]");
        $oobjectrCompensationObject->setName($oobjectrCompensationName . "[" . $microFieldsetCounterSession->workmenDecreeList . "]");
        $totalCompensationObject->setName($totalCompensationName . "[" . $microFieldsetCounterSession->workmenDecreeList . "]");

        $innerHtml = new InnerHtml();
        $innerHtml->setSelector("#div_work_decree_list");
        $innerHtml->setActionType($innerHtml::ACTION_TYPE_APPEND);
        $innerHtml->setContent($this->viewRenderer->render($viewModel));
        $response->add($innerHtml);
        return $this->getResponse()->setContent($response);
    }

    public function workmencontractorlistAction()
    {
        $response = new Response();
        $microFieldsetCounterSession = new Container("micro_fieldset_counter_session");
        $microFieldsetCounterSession->workmencontractorlist = $microFieldsetCounterSession->workmencontractorlist + 1;
        $workmenContractListFieldset = $this->workmencontractorlistFieldset;
        $viewModel = new ViewModel(array(
            "field" => $workmenContractListFieldset
        ));
        $viewModel->setTemplate("workmen_contractor_list_fieldset");

        $contratorNameObject = $workmenContractListFieldset->get("contractorName");
        $natureOfWorkObject = $workmenContractListFieldset->get("natureOfWork");
        $contractAmountObject = $workmenContractListFieldset->get("contractAmount");

        $contractorName = $contratorNameObject->getName();
        $natureOfWorkName = $natureOfWorkObject->getName();
        $contractAmountName = $contractAmountObject->getName();

        $contratorNameObject->setName($contractorName . "[" . $microFieldsetCounterSession->workmencontractorlist . "]");
        $natureOfWorkObject->setName($natureOfWorkName . "[" . $microFieldsetCounterSession->workmencontractorlist . "]");
        $contractAmountObject->setName($contractAmountName . "[" . $microFieldsetCounterSession->workmencontractorlist . "]");

        $innerHtml = new InnerHtml();
        $innerHtml->setSelector("#div_work_contrractor_list");
        $innerHtml->setActionType($innerHtml::ACTION_TYPE_APPEND);
        $innerHtml->setContent($this->viewRenderer->render($viewModel));
        $response->add($innerHtml);

        return $this->getResponse()->setContent($response);
    }

    /**
     * THis function object hides to object customer
     *
     * @return mixed
     */
    public function hideAction()
    {
        $em = $this->entityManager;
        $response = new Response();
        $gritter = new GritterMessage();
        $proposalId = $this->proposalService->getProposalSession()->proposalId;
        $proposalEntity = $em->find("Proposal\Entity\Proposal", $proposalId);
        $proposalEntity->setIsVisible(FALSE)->setUpdatedOn(new \DateTime());
        $invoiceEntity = $proposalEntity->getInvoice();
        if ($invoiceEntity != NULL) {
            if ($proposalEntity->getIsVisible() == FALSE) {
                $invoiceEntity->setIsOpen(FALSE);
            } else {
                $invoiceEntity->setIsOpen(TRUE);
            }
            $em->persist($invoiceEntity);
        }
        try {
            $em->persist($proposalEntity);

            $em->flush();
            $gritter->setTitle("Proposal Visible");
            $gritter->setText("Proposal is now invisible to customer");
            $gritter->setType(GritterMessage::TYPE_SUCCESS);
            $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);
            $redirect = new Redirect($this->url()->fromRoute("proposal/default", array("action"=>"process")));
            
            $response->add($redirect);
            $response->add($gritter);
            return $this->getResponse()->setContent($response);
        } catch (\Exception $e) {
            $gritter->setTitle("Error");
            $gritter->setText("Problem processing this request please try again later");
            $gritter->setType(GritterMessage::TYPE_ERROR);
            $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);
            $response = new Response();
            $response->add($gritter);
        }
        return $this->getResponse()->setContent($response);
    }

    /**
     * This shows object proposal to object customer
     *
     * @return mixed
     */
    public function showAction()
    {
        $em = $this->entityManager;
        $generalService = $this->generalService;
        $proposalId = $this->proposalService->getProposalSession()->proposalId;
        $proposalEntity = $em->find("Proposal\Entity\Proposal", $proposalId);
        $customerEntity = $proposalEntity->getCustomer();
        $userEnitity = $customerEntity->getUser();
        $pointers = array();
        $template = array();
        $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $generalService->getCentralBroker());
        $addreplyTo = array();
        foreach ($proposalEntity->getCustomer()->getAssignedChildBroker() as $child) {
            $addreplyTo[] = $child->getUser()->getEmail();
        }
        $pointers['to'] = $userEnitity->getEmail();
        $pointers['fromName'] = $brokerEntity->getBrokerName(); // insurance broker
        $pointers['subject'] = "proposal Available";
        $pointers['replyTo'] = $brokerEntity->getUser()->getEmail();
        $pointers['addReplyTo'] = $addreplyTo;

        $template['template'] = "general_generic";
        $brokerLogo = ($brokerEntity->getCompanyLogo() != NULL ? $brokerEntity->getCompanyLogo()->getDocUrl() : $this->url()->fromRoute("welcome", array(), array(
            'force_canonical' => true
        )) . "images/logow.png");

        $defaultText = "<p>A proposal is available for you to view  at <br><a href='http://imapp.ng', target='_blank'>View Proposal</a</p>";
        $template['var'] = array(
            "brokerLogo" => $brokerLogo, // url to object logo of object broker
            "brokerName" => $brokerEntity->getBrokerName(), // Broker Entity
            "recipient" => $customerEntity->getName(),
            "defaultText" => $defaultText,
            "extraDetailTemplate" => NULL,
            "invoiceTableTemplate" => NULL,
            "socialMediaTemplate" => NULL
        );

        $response = new Response();
        $proposalEntity->setIsVisible(TRUE)->setUpdatedOn(new \DateTime());
        $invoiceEntity = $proposalEntity->getInvoice();
        if ($invoiceEntity != NULL) {
            $invoiceEntity->setIsOpen(TRUE);
            $em->persist($invoiceEntity);
        }
        $gritter = new GritterMessage();
        try {
            // $generalService->sendmails($pointers, $template);
            $em->persist($proposalEntity);

            $em->flush();

            // Send mail notification
            $generalService->sendMails($pointers, $template);
            $gritter->setTitle("Proposal Visible");
            $gritter->setText("Proposal is now visible to customer");
            $gritter->setType(GritterMessage::TYPE_SUCCESS);
            $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);
            $this->flashmessenger()->addSuccessMessage("Customer can now view proposal");
            $response->add($gritter);
            $redirect = new Redirect($this->url()->fromRoute("proposal/default", array(
                "action" => "process"
            )));

            $response->add($redirect);
        } catch (\Exception $e) {
            // $this->flashmessenger()->addErrorMessage("objectre was a problecm making object proposal visible to customers");
            // $redirect = new Redirect($this->url()->fromRoute("proposal/default", array(
            // "action" => "process"
            // )));

            $gritter->setTitle("Error");
            $gritter->setText("Proposal is not visible to customer");
            $gritter->setType(GritterMessage::TYPE_ERROR);
            $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);
            $response = new Response();
            $response->add($gritter);
        }
        return $this->getResponse()->setContent($response);
    }

    /**
     * This opens the portal window for the broker
     *
     * @return mixed
     */
    public function theportalAction()
    {
        $em = $this->entityManager;
        $response = new Response();
        $modal = new WasabiModal("standard", "Portal");
        $proposalId = $this->proposalService->getProposalSession()->proposalId;
        $proposalEntity = $em->find("Proposal\Entity\Proposal", $proposalId);
        $data = $proposalEntity->getInsurerPortal();

        $viewModel = new ViewModel(array(
            "data" => $data
        ));
        $viewModel->setTemplate("general_the_portal_modal");
        $modal->setContent($viewModel);

        $modal->setSize(WasabiModalConfigurator::MODAL_LG);

        $modalView = new WasabiModalView("#wasabi_modal", $this->renderer, $modal);
        $response->add($modalView);

        return $this->getResponse()->setContent($response);
    }

    /**
     * This list object insurance emails information was sent to
     *
     * @return mixed
     */
    public function insurerportalAction()
    {
        $em = $this->entityManager;
        $response = new Response();
        $wasabiModal = new WasabiModal("standard", "Insurer Emails");
        $wasabiModal->setSize(WasabiModal::MODAL_SM);
        // var_dump("FR");
        $proposalId = $this->proposalService->getProposalSession()->proposalId;
        $proposalEntity = $em->find("Proposal\Entity\Proposal", $proposalId);
        $data = $proposalEntity->getInsurerPortal();

        $viewmodel = new ViewModel(array(
            "data" => $data
        ));
        $viewmodel->setTemplate("general_insurer_portal_list");
        $wasabiModal->setContent($viewmodel);

        $modalView = new WasabiModalView("#wasabi_modal", $this->renderer, $wasabiModal);
        $response->add($modalView);
        return $this->getResponse()->setContent($response);
    }

    public function objectportalAction()
    {
        $response = new Response();
        $data = $this->params()->fromQuery("data");
        $em = $this->entityManager;
        $portalEntity = $em->find("IMServices\Entity\InsurePortal", $data);
        $wasabiModal = new WasabiModal("standard", "Insurer Portal");
        $wasabiModal->setSize(WasabiModalConfigurator::MODAL_LG);
        $viewmodel = new ViewModel(array(
            "portalEntity" => $portalEntity
        ));
        $viewmodel->setTemplate("general_object_portal_modal");
        $wasabiModal->setContent($viewmodel);
        $modalView = new WasabiModalView("#wasabi_modal", $this->renderer, $wasabiModal);
        $response->add($modalView);
        return $this->getResponse()->setContent($response);
    }

    // Begin Broker portal functions
    /**
     * This function debplaiys information about the coomunication between insurer and broker
     *
     * @return mixed
     */
    public function insurerportalinfoAction()
    {
        $response = new Response();
        $data = $this->params()->fromQuery("data");
        $gritter = new GritterMessage();
        if ($data == NULL) {
            $gritter->setTitle("Error");
            $gritter->setText("Data Error");
            $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);
            $gritter->setType(GritterMessage::TYPE_ERROR);

            $response->add($gritter);
        } else {
            $viewModel = new ViewModel(array(
                "data" => $data
            ));
            $viewModel->setTemplate("general_portal_info_snippet");
            $html = new InnerHtml();

            // $html->setActionType(InnerHtml::ACTION_TYPE_APPEND);
            $html->setSelector("#portal_info");
            $html->setContent($this->viewRenderer->render($viewModel));

            $response->add($html);
        }
        return $this->getResponse()->setContent($response);
    }

    // End Broker portal functions

    /**
     *
     * @return object $entityManager
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }

    /**
     *
     * @param object $entityManager
     */
    public function setEntityManager($entityManager)
    {
        $this->entityManager = $entityManager;
        return $this;
    }

    /**
     *
     * @return object $renderer
     */
    public function getRenderer()
    {
        return $this->renderer;
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
     * @return object $gitVehicleListForm
     */
    public function getGitVehicleListForm()
    {
        return $this->gitVehicleListForm;
    }

    /**
     *
     * @param object $gitVehicleListForm
     */
    public function setGitVehicleListForm($gitVehicleListForm)
    {
        $this->gitVehicleListForm = $gitVehicleListForm;
        return $this;
    }

    /**
     *
     * @return object $brokerCustomerSession
     */
    public function getBrokerCustomerSession()
    {
        return $this->brokerCustomerSession;
    }

    /**
     *
     * @param object $brokerCustomerSession
     */
    public function setBrokerCustomerSession($brokerCustomerSession)
    {
        $this->brokerCustomerSession = $brokerCustomerSession;
        return $this;
    }

    /**
     *
     * @return object $viewRenderer
     */
    public function getViewRenderer()
    {
        return $this->viewRenderer;
    }

    /**
     *
     * @param object $viewRenderer
     */
    public function setViewRenderer($viewRenderer)
    {
        $this->viewRenderer = $viewRenderer;
        return $this;
    }

    /**
     *
     * @return object $motorNonStandardForm
     */
    public function getMotorNonStandardForm()
    {
        return $this->motorNonStandardForm;
    }

    /**
     *
     * @param object $motorNonStandardForm
     */
    public function setMotorNonStandardForm($motorNonStandardForm)
    {
        $this->motorNonStandardForm = $motorNonStandardForm;
        return $this;
    }

    /**
     *
     * @return object $professionalIndemnityForm
     */
    public function getProfessionalIndemnityForm()
    {
        return $this->professionalIndemnityForm;
    }

    /**
     *
     * @param object $professionalIndemnityForm
     */
    public function setProfessionalIndemnityForm($professionalIndemnityForm)
    {
        $this->professionalIndemnityForm = $professionalIndemnityForm;
        return $this;
    }

    /**
     *
     * @return object $motorInsuranceForm
     */
    public function getMotorInsuranceForm()
    {
        return $this->motorInsuranceForm;
    }

    /**
     *
     * @param object $motorInsuranceForm
     */
    public function setMotorInsuranceForm($motorInsuranceForm)
    {
        $this->motorInsuranceForm = $motorInsuranceForm;
        return $this;
    }

    /**
     *
     * @return object $aviationPiltoDetailsFeildet
     */
    public function getAviationPiltoDetailsFeildet()
    {
        return $this->aviationPiltoDetailsFeildet;
    }

    /**
     *
     * @param object $aviationPiltoDetailsFeildet
     */
    public function setAviationPiltoDetailsFeildet($aviationPiltoDetailsFeildet)
    {
        $this->aviationPiltoDetailsFeildet = $aviationPiltoDetailsFeildet;
        return $this;
    }

    /**
     *
     * @return object $boilerCoverDetailsFieldset
     */
    public function getBoilerCoverDetailsFieldset()
    {
        return $this->boilerCoverDetailsFieldset;
    }

    /**
     *
     * @param object $boilerCoverDetailsFieldset
     */
    public function setBoilerCoverDetailsFieldset($boilerCoverDetailsFieldset)
    {
        $this->boilerCoverDetailsFieldset = $boilerCoverDetailsFieldset;
        return $this;
    }

    /**
     *
     * @return object $buglarySafeDetailsForm
     */
    public function getBuglarySafeDetailsForm()
    {
        return $this->buglarySafeDetailsForm;
    }

    /**
     *
     * @param object $buglarySafeDetailsForm
     */
    public function setBuglarySafeDetailsForm($buglarySafeDetailsForm)
    {
        $this->buglarySafeDetailsForm = $buglarySafeDetailsForm;
        return $this;
    }

    /**
     *
     * @return object $contractAllRiskValueListFieldset
     */
    public function getContractAllRiskValueListFieldset()
    {
        return $this->contractAllRiskValueListFieldset;
    }

    /**
     *
     * @param object $contractAllRiskValueListFieldset
     */
    public function setContractAllRiskValueListFieldset($contractAllRiskValueListFieldset)
    {
        $this->contractAllRiskValueListFieldset = $contractAllRiskValueListFieldset;
        return $this;
    }

    public function setAgricproductListFieldset($fieldset)
    {
        $this->agricProductListFieldset = $fieldset;
        return $this;
    }

    /**
     *
     * @return object $proposalService
     */
    public function getProposalService()
    {
        return $this->proposalService;
    }

    /**
     *
     * @param object $proposalService
     */
    public function setProposalService($proposalService)
    {
        $this->proposalService = $proposalService;
        return $this;
    }

    public function setGeneralService($set)
    {
        $this->generalService = $set;
        return $this;
    }

    public function setSelectObjectForm($form)
    {
        $this->selectObjectForm = $form;
        return $this;
    }

    public function setObjectForm($form)
    {
        $this->objectForm = $form;
        return $this;
    }

    /**
     *
     * @return object $objectService
     */
    public function getObjectService()
    {
        return $this->objectService;
    }

    /**
     *
     * @param object $objectService
     */
    public function setObjectService($objectService)
    {
        $this->objectService = $objectService;
        return $this;
    }

    /**
     *
     * @return object $groupPersonalWagesFieldset
     */
    public function getGroupPersonalWagesFieldset()
    {
        return $this->groupPersonalWagesFieldset;
    }

    /**
     *
     * @param object $groupPersonalWagesFieldset
     */
    public function setGroupPersonalWagesFieldset($groupPersonalWagesFieldset)
    {
        $this->groupPersonalWagesFieldset = $groupPersonalWagesFieldset;
        return $this;
    }

    /**
     *
     * @return object $groupPersonalFixedFieldset
     */
    public function getGroupPersonalFixedFieldset()
    {
        return $this->groupPersonalFixedFieldset;
    }

    /**
     *
     * @param object $groupPersonalFixedFieldset
     */
    public function setGroupPersonalFixedFieldset($groupPersonalFixedFieldset)
    {
        $this->groupPersonalFixedFieldset = $groupPersonalFixedFieldset;
        return $this;
    }

    /**
     *
     * @return object $cropStaffListFieldset
     */
    public function getCropStaffListFieldset()
    {
        return $this->cropStaffListFieldset;
    }

    /**
     *
     * @param object $cropStaffListFieldset
     */
    public function setCropStaffListFieldset($cropStaffListFieldset)
    {
        $this->cropStaffListFieldset = $cropStaffListFieldset;
        return $this;
    }

    /**
     *
     * @return object $cropAgricListFieldset
     */
    public function getCropAgricListFieldset()
    {
        return $this->cropAgricListFieldset;
    }

    /**
     *
     * @param object $cropAgricListFieldset
     */
    public function setCropAgricListFieldset($cropAgricListFieldset)
    {
        $this->cropAgricListFieldset = $cropAgricListFieldset;
        return $this;
    }

    /**
     *
     * @param object $livestockInsuredListFieldset
     */
    public function setLivestockInsuredListFieldset($livestockInsuredListFieldset)
    {
        $this->livestockInsuredListFieldset = $livestockInsuredListFieldset;
        return $this;
    }

    /**
     *
     * @param object $groupLifeStaffDetailsFieldset
     */
    public function setGroupLifeStaffDetailsFieldset($groupLifeStaffDetailsFieldset)
    {
        $this->groupLifeStaffDetailsFieldset = $groupLifeStaffDetailsFieldset;
        return $this;
    }

    /**
     *
     * @param object $workmenDecreeListFieldset
     */
    public function setWorkmenDecreeListFieldset($workmenDecreeListFieldset)
    {
        $this->workmenDecreeListFieldset = $workmenDecreeListFieldset;
        return $this;
    }

    /**
     *
     * @param object $employeeLiabilityDetailsFieldset
     */
    public function setEmployeeLiabilityDetailsFieldset($employeeLiabilityDetailsFieldset)
    {
        $this->employeeLiabilityDetailsFieldset = $employeeLiabilityDetailsFieldset;
        return $this;
    }

    /**
     *
     * @param object $fidelityGaurateeEmployeeListFieldset
     */
    public function setFidelityGaurateeEmployeeListFieldset($fidelityGaurateeEmployeeListFieldset)
    {
        $this->fidelityGaurateeEmployeeListFieldset = $fidelityGaurateeEmployeeListFieldset;
        return $this;
    }

    /**
     *
     * @param object $homeHouseholdGoodsFieldset
     */
    public function setHomeHouseholdGoodsFieldset($homeHouseholdGoodsFieldset)
    {
        $this->homeHouseholdGoodsFieldset = $homeHouseholdGoodsFieldset;
        return $this;
    }

    /**
     *
     * @param object $homeHouseValueableFiedset
     */
    public function setHomeHouseValueableFiedset($homeHouseValueableFiedset)
    {
        $this->homeHouseValueableFiedset = $homeHouseValueableFiedset;
        return $this;
    }

    /**
     *
     * @return object $occupiersLiabilityStaffFieldset
     */
    public function getOccupiersLiabilityStaffFieldset()
    {
        return $this->occupiersLiabilityStaffFieldset;
    }

    /**
     *
     * @param object $occupiersLiabilityStaffFieldset
     */
    public function setOccupiersLiabilityStaffFieldset($occupiersLiabilityStaffFieldset)
    {
        $this->occupiersLiabilityStaffFieldset = $occupiersLiabilityStaffFieldset;
        return $this;
    }

    /**
     *
     * @return object $occupiersLiabilityFamilyFieldset
     */
    public function getOccupiersLiabilityFamilyFieldset()
    {
        return $this->occupiersLiabilityFamilyFieldset;
    }

    /**
     *
     * @param object $occupiersLiabilityFamilyFieldset
     */
    public function setOccupiersLiabilityFamilyFieldset($occupiersLiabilityFamilyFieldset)
    {
        $this->occupiersLiabilityFamilyFieldset = $occupiersLiabilityFamilyFieldset;
        return $this;
    }

    /**
     *
     * @param object $publicLiabilityEmployeeFieldset
     */
    public function setPublicLiabilityEmployeeFieldset($publicLiabilityEmployeeFieldset)
    {
        $this->publicLiabilityEmployeeFieldset = $publicLiabilityEmployeeFieldset;
        return $this;
    }

    /**
     *
     * @param object $workmencontractorlistFieldset
     */
    public function setWorkmencontractorlistFieldset($workmencontractorlistFieldset)
    {
        $this->workmencontractorlistFieldset = $workmencontractorlistFieldset;
        return $this;
    }
}

