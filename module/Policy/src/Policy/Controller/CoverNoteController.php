<?php
namespace Policy\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use WasabiLib\Ajax\Response;
use WasabiLib\Modal\WasabiModal;
use WasabiLib\Modal\WasabiModalView;
use WasabiLib\Modal\Info;
use Policy\Entity\Policy;
use Policy\Service\PolicyService;
// use WasabiLib\Wizard\StepController;
// use WasabiLib\Wizard\ClosureArguments;
use Zend\Session\Container;
use WasabiLib\Ajax\InnerHtml;
use WasabiLib\Ajax\Redirect;
use WasabiLib\Ajax\GritterMessage;
use GeneralServicer\Service\GeneralService;
use Policy\Form\PolicyForm;
use GeneralServicer\Service\TriggerService;

/**
 *
 * @author otaba
 *        
 */
class CoverNoteController extends AbstractActionController
{

    private $entityManager;

    private $policyService;

    private $coverNoteService;

    /**
     * 
     * @var PolicyForm
     */
    private $policyForm;

    private $renderer;

    private $centralBrokerId;

    private $generalService;

    private $uploadForm;

    public function onDispatch(\Zend\Mvc\MvcEvent $e)
    {
        $response = parent::onDispatch($e);
        // $this->layout("layout/layout.phtml");
        $this->redirectPlugin()->redirectCondition();
        return $response;
    }

    public function __construct()
    {}

    public function allAction()
    {
        $em = $this->entityManager;
        $policyService = $this->policyService;
        $coverNote = $policyService->getMyCoverNote();

        $view = new ViewModel(array(
            "coverNote" => $coverNote
        ));

        return $view;
    }

    public function pdfAction()
    {
        $response = new Response();
        $em = $this->entityManager;
        $coverId = $this->params()->fromRoute("id", NULL);
//         $coverId = 50;
        $gritter = new GritterMessage();
        if ($coverId != NULL) {
            $covernoteEntity = $em->getRepository("Policy\Entity\CoverNote")->findOneBy(array("coverUid"=>$coverId));
            $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $this->centralBrokerId);
            $viewModel = new ViewModel(array(
                "coverNote" => $covernoteEntity,

                "brokerEntity" => $brokerEntity
            ));
            $viewModel->setTemplate("policy_covernote_view_snippet");
            $html = $this->renderer->render($viewModel);

            $title = "Issued by : {$brokerEntity->getBrokerName()}";
            $tcpdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

            $tcpdf->SetCreator($brokerEntity->getBrokerName());
            $tcpdf->SetAuthor($brokerEntity->getBrokerName());
            $tcpdf->SetSubject($title);

            $tcpdf->setHeaderData("", PDF_HEADER_LOGO_WIDTH, $title);

            $tcpdf->setHeaderFont(Array(
                PDF_FONT_NAME_MAIN,
                '',
                PDF_FONT_SIZE_MAIN
            ));
            $tcpdf->setFooterFont(Array(
                PDF_FONT_NAME_DATA,
                '',
                PDF_FONT_SIZE_DATA
            ));

            $tcpdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

            $tcpdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            $tcpdf->SetHeaderMargin(PDF_MARGIN_HEADER);
            $tcpdf->SetFooterMargin(PDF_MARGIN_FOOTER);
            
//             $tcpdf->setPrintHeader(false);
//             $tcpdf->setPrintFooter(false);
//             $tcpdf->setImageScale("0.5");

            // set auto page breaks
            $tcpdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

            // set image scale factor
            $tcpdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

            // add a page
            $tcpdf->AddPage();

            // set cell padding
//             $tcpdf->setCellPaddings(1, 1, 1, 1);
            // set cell margins
//             $tcpdf->setCellMargins(1, 1, 1, 1);
            $tcpdf->writeHTML($html, true, 0, true, 0);
            $tcpdf->lastPage();
            $tcpdf->Output(time(), "I");
        } else {
            $this->flashMessenger()->addErrorMessage("Problem generating pdf ");
        }
        return $this->getResponse()->setContent($response);
    }

    /**
     * This is the modal form for generating a policy
     *
     * @return mixed
     */
    public function policymodalformAction()
    {
        $em = $this->entityManager;
        $response = new Response();
        $user = $this->identity();
//         $policyGenerationSession = new Container("policy_generation_session");
        $policyForm = $this->policyForm;
        $policyForm->setAttributes(array(
            "action" => $this->url()
                ->fromRoute("cover-note/default", array(
                "action" => "policymodalform"
            )),
            "id" => "simpleForm",
            "class" => "form-horizontal form-label-left ajax_element",
            "data-ajax-loader" => "myLoader"
        ));
        // $uploadForm = $this->uploadForm;

        $request = $this->getRequest();
        $response = new Response();
        if ($request->isPost()) {
            $info = new GritterMessage();
            $policyEntity = new Policy();
            $post = $request->getpost();
            
            $policyForm->setData($post);
            $policyForm->setValidationGroup(array(
                "policyFieldset"=>array(
                    "policyName",
//                     "coverNote",
                    "policyCode",
                    "isAutoRenew",
                    "startDate",
                    "endDate",
                    "extraInfo",
                )
                
            ));
            if ($policyForm->isValid()) {

                $data = $policyForm->getData();
                
                $coverNoteService = $this->coverNoteService;
                $coverNoteSession = $coverNoteService->getCoverNoteSession();
                $coverNoteId = $coverNoteSession->getCoverNoteId;
                $coverNoteEntity = $em->find("Policy\Entity\CoverNote", $coverNoteId);
                $coverNoteEntity->setIsPolicy(TRUE)->setDateUpdated(new \DateTime());
                $insurerId = NULL;
//                 $insurerId = $post["policyFieldset"]["coverNote"]['insurer'];
                if ($insurerId != NULL) {
                    $coverNoteEntity->setInsurer($em->find("Settings\Entity\Insurer", $insurerId));
                }
                $policyEntity->setCoverNote($coverNoteEntity);
                $policyEntity = $this->policyService->hydratePolicyInfo($data, $policyEntity);
                try {
                    $em->persist($policyEntity);
                    $em->persist($coverNoteEntity);
                    $em->flush();

                    // Send email
//                     $pointers = NULL;
//                     $template = NULL;
//                     $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $this->generalService->getCentralBroker());
//                     $pointers["to"] = "Customer Email";
//                     $pointers["fromname"] = $brokerEntity->getBrokerName();
//                     $pointers['subject'] = "Insurance policy is Ready";
//                     $template['var'] = array(
//                         "logo"=>"",
//                     ); // template variables
//                     $template['template'] = "general-successful-transaction";
//                     $this->generalService->sendMails($pointers, $template);

                    // End
                    $info->setTitle("Certificate Generated");
                    $info->setText("Policy Certificate successfully generated");
                    $info->setType(GritterMessage::TYPE_SUCCESS);
                    $info->setPosition(GritterMessage::POSITION_TOP_RIGHT);
                    $response->add($info);

                    $redirect = new Redirect($this->url()->fromRoute("policy/default", array(
                        "action" => "premanage",
                        "id"=>$policyEntity->getPolicyUid()
                    )));
                    $triggerParram = array(
                        "user"=>$user->getId()
                    );
                    $this->getEventManager()->trigger(TriggerService::TRIGGER_POLICY_GENERATION_COMPLETED, $this, $triggerParram);
                    $response->add($redirect);
                    return $this->getResponse()->setContent($response);
                } catch (\Exception $e) {
                    $info->setText("Something went wrong while generating policy");
                    $info->setTitle("hydration Error");
                    $info->setType(GritterMessage::TYPE_ERROR);
                    $info->setPosition(GritterMessage::POSITION_TOP_RIGHT);
                    $info->setSticky(TRUE);
//                     $this->flashmessenger()->addErrorMessage("Hydration Error");
                    $response->add($info);
//                     $redirect = new Redirect($this->url()->fromRoute("proposal/default", array(
//                         "action" => "process"
//                     )));
//                     $response->add($redirect);
                }
            } else {

                $info->setText("Form is invalid please go through it and resubmit");
                $info->setTitle("Validation Error");
                $info->setSticky(TRUE);
                $info->setType(GritterMessage::TYPE_ERROR);
                $info->setPosition(GritterMessage::POSITION_TOP_RIGHT);

                $response->add($info);
            }
        } else {

            $viewModel = new ViewModel(array(
                "policyForm" => $policyForm
            ));

            $modal = new WasabiModal("Standard", "Generate Policy");
            $viewModel->setTemplate("policy_policy_generation_form");

            $modal->setContent($viewModel);

            $modalView = new WasabiModalView("#wasabi_modal", $this->renderer, $modal);
            $response->add($modalView);
        }
        return $this->getResponse()->setContent($response);
    }

    /**
     * This function displays the entered details of the policy
     * And then shows a generate button which futher generates the policy
     *
     * @return mixed
     */
    public function viewPolicyAction()
    {
        $policyGenerationSession = new Container("policy_generation_session");
        $request = $this->getRequest();
        if ($request->isPost() || $request->isXmlHttpRequest()) {

            $post = $request->getPost();
            $policyFieldset = $post["policyFieldset"];
            $policyGenerationSession->policyName = $policyFieldset['policyName'];
        }
        $view = new ViewModel(array(
            "policyName" => $policyGenerationSession->policyName
        ));
        $view->setTemplate("policy-modal-view-details-snippet");
        $innerHtml = new InnerHtml("#policyView", $view);
        $response = new Response();
        return $this->getResponse()->setContent($response);
    }

    public function generatePolicyAction()
    {
        $em = $this->entityManager;
        $coverNoteService = $this->coverNoteService;
        $coverNoteSession = $coverNoteService->getCoverNoteSession();
        $coverNoteId = $coverNoteSession->getCoverNoteId;
        $coverNOteEntity = $em->find("Policy\Entity\CoverNote", $coverNoteId);
        $policyService = $this->policyService;
        $policyEntity = new Policy();
        $request = $this->getRequest();
        if ($request->isPost()) {
            $post = $request->getPost();
            $policyName = $post['policyFieldset']['policyName'];
            $policyCode = $post['policyFieldset']['policyCode'];
            $startDate = $post['policyFieldset']['startDate'];
            $endDate = $post['policyFieldset']['endDate'];
            $policyEntity->setIsActive(true)
                ->setCreatedOn(new \DateTime())
                ->setCoverNote($coverNOteEntity)
                ->setPolicyUid($policyService->getPolicyUid())
                ->setStartDate(new \DateTime($startDate))
                ->setEndDate(new \DateTime($endDate))
                ->setIsActive(TRUE)
                ->setPolicyCode($policyCode)
                ->setIsLocked(TRUE)
                ->setPolicyName($policyName)
                ->setPolicyStatus($em->find("Policy\Entity\PolicyStatus", PolicyService::POLICY_STATUS_ISSUED_AND_VALID));
            // var_dump($policyEntity);
            $coverNOteEntity->setIsPolicy(TRUE)->setDateUpdated(new \DateTime());
            try {
                $em->persist($coverNOteEntity);
                $em->persist($policyEntity);
                $em->flush();

                $this->flashmessenger()->addSuccessMessage("Policy was successfully generated");
                /**
                 * Send a mail to the customer on the url to the policy generated
                 * With a link to download all adjoining documents including certificates
                 */

                $this->redirect()->toRoute("policy/default", array(
                    "action" => "pre-view",
                    "id" => $policyEntity->getId()
                ));
            } catch (\Exception $e) {
                // $this->flashmessenger()->addErrorMessage("There was a problem generating the policy, please try again later");
                // $this->redirect()->toRoute("cover-note/default", array(
                // "action" => "view"
                // ));
            }
        }
        return $this->getResponse()->setContent(NULL);
    }

    public function uploadDocAction()
    {
        $em = $this->entityManager;

        $this->getResponse()->setContent(NULL);
    }

    public function infoAction()
    {
        $info = new Info("info", "Saved", "Getting every thing right now .");
        $modal = new WasabiModalView("#wasabi_modal_view", $this->renderer, $info);

        $response = new Response();
        $response->add($modal);

        return $this->getResponse()->setContent($response);
    }

    public function preViewAction()
    {
        $em = $this->entityManager;
        $id = $this->params()->fromRoute("id", NULL);
        $coverNoteService = $this->coverNoteService;
        $coverNoteSession = $coverNoteService->getCoverNoteSession();
        if ($id == NULL) {
            $this->flashmessenger()->addErrorMessage("No identifier available");
            $this->redirect()->toRoute("cover-note/default", array(
                "action" => "all"
            ));
        }
        $coverNoteService = $this->coverNoteService;
        $coverNoteSession = $coverNoteService->getCoverNoteSession();
        $coverNoteSession->getCoverNoteId = $id;
        $this->redirect()->toRoute("cover-note/default", array(
            "action" => "view"
        ));
        return $this->getResponse()->setContent(NULL);
    }

    public function viewAction()
    {
        $em = $this->entityManager;
        $policyForm = $this->policyForm;
        $policyForm->setAttributes(array(
            "action" => $this->url()
                ->fromRoute("cover-note/default", array(
                "action" => "generate-policy"
            ))
        ));

        $coverNoteService = $this->coverNoteService;
        $coverNoteSession = $coverNoteService->getCoverNoteSession();
        $coverNoteId = $coverNoteSession->getCoverNoteId;
        $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $this->centralBrokerId);
        if ($coverNoteId == NULL) {
            $this->flashmessenger()->addErrorMessage("No Cover Note identifier for this");
            $this->redirect()->toRoute("cover-note/default", array(
                "action" => "all"
            ));
        }
        $coverNoteEntity = $em->find("Policy\Entity\CoverNote", $coverNoteId);
        $view = new ViewModel(array(
            "coverNote" => $coverNoteEntity,
            "policyForm" => $policyForm,
            "brokerEntity" => $brokerEntity
        ));
        return $view;
    }

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

    public function setCoverNoteService($xserv)
    {
        $this->coverNoteService = $xserv;
        return $this;
    }

    public function setPolicyForm($form)
    {
        $this->policyForm = $form;
        return $this;
    }

    public function setRenderer($ren)
    {
        $this->renderer = $ren;
        return $this;
    }

    public function setCentralBrokerId($id)
    {
        $this->centralBrokerId = $id;
        return $this;
    }

    public function setUploadForm($form)
    {
        $this->uploadForm = $form;
        return $this;
    }

    /**
     *
     * @param mixed $generalService
     */
    public function setGeneralService($generalService)
    {
        $this->generalService = $generalService;
        return $this;
    }
}

