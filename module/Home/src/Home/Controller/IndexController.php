<?php
namespace Home\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
// use Phpro\Chart\ChartJs\Doughnut\DoughnutOptions;
// use Phpro\Chart\ChartJs\Doughnut\DoughnutData;
// use Phpro\Chart\ChartJs\Doughnut\DoughnutDataset;
// use Phpro\Chart\ChartJs\Doughnut\DoughnutChart;
use Phpro\Chart\ChartJs\Line\LineOptions;
use Phpro\Chart\ChartJs\Line\LineData;
use Phpro\Chart\ChartJs\Line\LineDataset;
use Phpro\Chart\ChartJs\Line\LineChart;
use Zend\Session\Container;
use WasabiLib\Ajax\Response;
use WasabiLib\Ajax\GritterMessage;
use WasabiLib\Ajax\Redirect;
use React\EventLoop\Factory;
use Home\Service\HomeEvent;
use Zend\EventManager\EventManager;
use Home\Entity\LoggerTest;
use Policy\Event\PolicyEvent;
use WasabiLib\Modal\WasabiModal;
use WasabiLib\Modal\WasabiModalView;

// use GeneralServicer\Service\DateCalculationService;
class IndexController extends AbstractActionController
{

    protected $options;

    private $renderer;
    
    private $firebase;

    private $activeOffer;

    private $incompletePolicy;

    protected $regObject;

    private $customerService;

    private $generalService;

    private $entityManager;

    private $proposalService;

    private $claimsService;

    private $chatkitService;

    private $invoiceService;

    private $centralBrokerId;

    private $homeService;

    private $offerService;

    private $dateCalculatioService;

    private $policyService;

    private $mailService;

    private $brokerProfileForm;

    private $logoForm;

    private $blobService;

    public function onDispatch(\Zend\Mvc\MvcEvent $e)
    {
        $response = parent::onDispatch($e);
        // $response = parent::on
        try{
        $this->redirectPlugin()->redirectCondition();
        }catch (\Exception $e){
            var_dump($e->getMessage());
        }
        $this->layout()->setTemplate('layout/layout.phtml');
        return $response;
    }

    public function indexAction()
    {
        return new ViewModel();
    }

    public function dashboardAction()
    {
        $this->setupRedirectPlugin()->setupRedirect();
//         var_dump($this->chatkitService->initiate());
//         var_dump($this->identity()->getUsername());

        $generalService = $this->generalService;
        $em = $this->entityManager;

        $logoForm = $this->logoForm;
        $logoForm->setAttributes(array(
            "action" => "/dashboard/uploadlogo"
        ));
        $broker = NULL;
        $sub = $generalService->getSubscription();
        $centralBrokerId = $generalService->getCentralBroker();
        if ($centralBrokerId != NULL) {
            $broker = $em->find("Users\Entity\InsuranceBrokerRegistered", $centralBrokerId);
        }

        $policyService = $this->policyService;
        $customerService = $this->customerService;
        $proposalService = $this->proposalService;
        $claimsService = $this->claimsService;
        $invoiceService = $this->invoiceService;
        $offerService = $this->offerService;

        $expiredInvoice = $invoiceService->getBrokerCustomerExpiredInvoices();
        $expiringInvoice = $invoiceService->getBrokerCustomerExpiringInvoice();
        // var_dump(count($expiringInvoice));
        $expiringPolicy = $policyService->getExpiringPolicy();
        $activeOffer = $offerService->getActiveOffer();
        $customers = $customerService->getMyCustomer();
        $activeProposals = $proposalService->getMyProposals();
        $unSettledClaims = $claimsService->myUnsettledClaims();
        $myExpiredInvoice = $invoiceService->getMyCustomerExpiredInvoice();

        $options = new LineOptions([
            'animation' => false
        ]);
        $data = new LineData();
        $data->setLabels([
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July'
        ]);
        $data->addDataset(new LineDataset([
            'label' => ' ',
            'fillColor' => 'rgba(220,100,220,0.2)',
            'strokeColor' => 'rgba(220,220,220,1)',
            'pointColor' => 'rgba(220,220,220,1)',
            'pointStrokeColor' => '#34f345',
            'pointHighlightFill' => '#E45ODF',
            'pointHighlightStroke' => 'rgba(220,220,220,1)',
            'data' => [
                65,
                59,
                80,
                81,
                56,
                55,
                40
            ]
        ]));

        $chart = new LineChart($options, $data);

        return new ViewModel(array(
            'customers' => $customers,
            'broker' => $broker,
            'sub' => $sub,
            'ap' => $activeProposals,
            'unsettledClaims' => $unSettledClaims,
            'myExpiredInvoice' => $myExpiredInvoice,
            'activeOffers' => $activeOffer,
            "expiringInvoice" => $expiringInvoice,
            "expiringPolicy" => $expiringPolicy,
            // 'customerCount'=>$customerCount,
            "logoForm" => $logoForm,
            'chart' => $chart
        ));
    }

    public function uploadlogoAction()
    {
        // $this->redirect()->toRoute("dashboard");
        $em = $this->entityManager;
        $blobService = $this->blobService;
        $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $this->centralBrokerId);
        $request = $this->getRequest();
        if ($request->isPost() || $request->isXmlHttpRequest()) {
            $files = $this->params()->fromFiles('userImage');
            $res = $this->blobService->uploadBlob($files);
            // $this->redirect()->toRoute("home");
            if ($res != False) {
                $brokerEntity->setCompanyLogo($em->find("GeneralServicer\Entity\Document", $res))
                    ->setDateModified(new \DateTime());
                $em->persist($brokerEntity);
                $em->flush();
                $this->flashmessenger()->addSuccessMessage("Logo Successfully uploaded");
                return $this->redirect()->toRoute("dashboard");
            }
        }
        return $this->getResponse()->setContent(NULL);
    }

    /**
     * This sends a Reminder that
     *
     * @return mixed
     */
    public function sendPolicyReminderAction()
    {
        $em = $this->entityManager;
        $response = new Response();
        // $policyId = $this->params()->from("data", NULL);

        $policyId = $this->params()->fromQuery("data");

        $gritter = new GritterMessage();
        if ($policyId == NULL) {
            $gritter->setTitle("Error");
            $gritter->setText("Error: Absent Identifier");
            $gritter->setType(GritterMessage::TYPE_ERROR);
            $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);

            $response->add($gritter);
            // $this->flashmessenger()->addErrorMessage("There was no identifier to sned the notification mail");
            // $this->redirect()->toRoute("dashboard");
        } else {
            $policyEntity = $em->find("Policy\Entity\Policy", $policyId);
            // $mailService = $this->generalService;

            $brokerName = $policyEntity->getCoverNote()
                ->getCustomer()
                ->getCustomerBroker()
                ->getBroker()
                ->getCompanyName();
            $brokerLogo = $this->generalService->getBrokerAbsoluteLogo();
            $expiringDate = $policyEntity->getEndDate();
            // $policyName = $policyEntity->getPolicyName();
            // $policyCode = $policyEntity->getPolicyCode();
            // $policyLink =""; // this provides a direct link to the policy
            $pointer['to'] = $policyEntity->getCoverNote()
                ->getCustomer()
                ->getUser()
                ->getEmail();
            $pointer['fromName'] = $brokerName;
            $pointer['subject'] = "Expiring Policy";

            $template['var'] = array(
                "logo" => $brokerLogo,
                "customerName" => $policyEntity->getCoverNote()
                    ->getCustomer()
                    ->getName(),
                'brokerName' => $brokerName,
                "brokerEntity" => $policyEntity->getCoverNote()
                    ->getCustomer()
                    ->getCustomerBroker()
                    ->getBroker(),
                "expireDate" => $expiringDate,
                "policyEntity" => $policyEntity
                // // "policyLink"=>$policyLink,
                // "policyName" => $policyName,
                // "policyCode" => $policyCode
            );
            $template['template'] = "general-broker-expiring-policy-notify-mail";

            try {

                $gritter->setText("Renewal reminder has been sent to customer");
                $gritter->setTitle("Notification");
                $gritter->setType(GritterMessage::TYPE_SUCCESS);
                $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);

                $response->add($gritter);

                $this->generalService->sendMails($pointer, $template);
//                 $this->flashmessenger()->addSuccessMessage("Renewal reminder has been sent to customer");
                // $redirect = new Redirect($this->url()->fromRoute("dashboard"));

                // $response->add($redirect);
            } catch (\Exception $e) {

                $this->flashmessenger()->addErrorMessage("System could not notify customer");
                $gritter->setTitle("Error");
                $gritter->setText("Error: Mail Error");
                $gritter->setType(GritterMessage::TYPE_ERROR);
                $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);

                $response->add($gritter);
            }
        }

        return $this->getResponse()->setContent($response);
    }

    public function brokerProfileAction()
    {
        $em = $this->entityManager;
        $brokerProfileForm = $this->brokerProfileForm;
        $brokerProfileEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $this->centralBrokerId);

        $brokerProfileForm->bind($brokerProfileEntity);
        $brokerProfileForm->get("brokerProfileFieldset")
            ->get("idInduranceBoker")
            ->setAttributes(array(
            "disabled" => "disabled"
        ));
        $brokerProfileForm->get("submit")->setAttributes(array(
            "class" => "btn btn-block btn-success"
        ));

        $brokerProfileForm->setAttributes(array(
            "action" => $this->url()
                ->fromRoute("dashboard/default", array(
                "action" => "broker-profile"
            ))
        ));
        $request = $this->getRequest();
        if ($request->isPost()) {
            $post = $request->getPost();
            $brokerProfileForm->setData($post);
            $brokerProfileForm->setValidationGroup(array(
                "brokerProfileFieldset" => array(
                    'brokerEmail',
                    'brokerWebsite',
                    'officialPhone',
                    // 'idInduranceBoker',
                    'brokerProfile',

                    'address1',
                    'address2',
                    'zipCode',
                    'country',
                    'state'
                ),
                "csrf"
            ));
            if ($brokerProfileForm->isValid()) {
                $phone = $string = str_replace("-", "", $brokerProfileEntity->getOfficialPhone());

                $brokerProfileEntity->setDateModified(new \DateTime())->setOfficialPhone($phone);
                /**
                 * TODO Send mail notification that profile content has been changed
                 */
                try {

                    $em->persist($brokerProfileEntity);
                    $em->flush();

                    $this->flashmessenger()->addSuccessMessage("The company profile has been updated");
                    $this->redirect()->toRoute("dashboard/default", array(
                        "action" => "broker-profile"
                    ));
                } catch (\Exception $e) {
                    $this->flashmessenger()->addErrorMessage("!!oops there we could not edit ur profile");
                    $this->redirect()->toRoute("dashboard/default", array(
                        "action" => "broker-profile"
                    ));
                }
            }
        }
        $view = new ViewModel(array(
            "brokerProfileEntity" => $brokerProfileEntity,
            "brokerProfileForm" => $brokerProfileForm
        ));
        return $view;
    }
    
    
    public function goingmobileAction(){
        $response = new Response();
        $modal = new WasabiModal("standard", "Going Mobile");
        
        $viewModel = new ViewModel(array(
            
        ));
        $viewModel->setTemplate("dashboard-going-mobile");
        $modal->setContent($viewModel);
        $modalView = new WasabiModalView("#wasabi_modal", $this->renderer, $modal);
        $response->add($modalView);
        return $this->getResponse()->setContent($response);
        
    }

    private function customerViewCondition()
    {}

    // begin Setters
    public function setIncompletePolicy($policy)
    {
        $this->incompletePolicy = $policy;
        return $this;
    }

    public function setRegObject($object)
    {
        $this->regObject = $object;

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

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }

    public function setProposalService($serv)
    {
        $this->proposalService = $serv;
        return $this;
    }

    public function setClaimsService($xserv)
    {
        $this->claimsService = $xserv;
        return $this;
    }

    public function setInoiveService($xserv)
    {
        $this->invoiceService = $xserv;
        return $this;
    }

    public function setHomeService($xserv)
    {
        $this->homeService = $xserv;
        return $this;
    }

    public function setDateCalculationService($date)
    {
        $this->dateCalculatioService = $date;
        return $this;
    }

    public function setOfferService($serve)
    {
        $this->offerService = $serve;
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

    public function setBrokerProfileForm($form)
    {
        $this->brokerProfileForm = $form;
        return $this;
    }

    public function setLogoForm($logo)
    {
        $this->logoForm = $logo;
        return $this;
    }

    public function setBlobService($xserv)
    {
        $this->blobService = $xserv;
        return $this;
    }

    public function setFirebase($firebase)
    {
        $this->firebase = $firebase;
        return $this;
    }

    // End Setters

    /**
     *
     * @param mixed $chatkitService
     */
    public function setChatkitService($chatkitService)
    {
        $this->chatkitService = $chatkitService;
        return $this;
    }
    /**
     * @param mixed $renderer
     */
    public function setRenderer($renderer)
    {
        $this->renderer = $renderer;
        return $this;
    }

}

