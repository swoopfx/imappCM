<?php
namespace Transactions\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;
use Transactions\Service\InvoiceService;
use Transactions\Entity\MicroPayment;
use WasabiLib\Modal\WasabiModal;
use WasabiLib\Ajax\GritterMessage;
use WasabiLib\Ajax\Response;
use WasabiLib\Modal\WasabiModalConfigurator;
use WasabiLib\Modal\WasabiModalView;
use Transactions\Entity\Invoice;
use Users\Entity\InsuranceBrokerRegistered;
use GeneralServicer\Service\GeneralService;

/**
 * InvoiceController
 *
 * @author
 *
 * @version
 *
 */
class InvoiceController extends AbstractActionController
{

    private $entityManager;

    private $invoiceService;

    private $brokerId;

    private $mailService;

    private $processForm;

    // This is the manual Process form
    private $messageForm;

    private $offerService;

    /**
     * 
     * @var GeneralService
     */
    private $generalService;

    private $renderer;

    private $centralBrokerId;

    public function onDispatch(\Zend\Mvc\MvcEvent $e)
    {
        $response = parent::onDispatch($e);

        $this->redirectPlugin()->redirectCondition();
        return $response;
    }

    /*
     * Begin modal
     */

    /**
     * This makes a modal preview of the invoice
     *
     * @return mixed
     */
    public function invoicepreviewmodalAction()
    {
        $em = $this->entityManager;
        $response = new Response();
        $invoiceId = $this->params()->fromQuery("data", NULL);

        if ($invoiceId == NULL) {
            $gritter = new GritterMessage();
            $gritter->setType(GritterMessage::TYPE_ERROR);
            $gritter->setText("Invoice ID not transmitted");
            $gritter->setTitle("Invoice Id Error");
            $response->add($gritter);
        } else {
            $invoiceEntity = $em->find("Transactions\Entity\Invoice", $invoiceId);
            $broker = $em->find("Users\Entity\InsuranceBrokerRegistered", $this->centralBrokerId);
            $viewModel = new ViewModel(array(
                "invoice" => $invoiceEntity,
                "broker" => $broker
            ));
            $viewModel->setTemplate("proposal-invoice-preview-modal");
            $modal = new WasabiModal("standard", "Invoice Preview");
            $modal->setSize(WasabiModalConfigurator::MODAL_LG);
            $modal->setContent($viewModel);

            $modalView = new WasabiModalView("#dialog", $this->renderer, $modal);

            $response->add($modalView);
        }
        return $this->getResponse()->setContent($response);
    }

    /*
     * End Modal
     */

    /**
     * This gets a list the Broker Customer Invoice
     *
     * {@inheritdoc}
     *
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $invoiceService = $this->invoiceService;
        $invoices = $invoiceService->getBrokerCustomerInvoices();
        $view = new ViewModel(array(
            "invoices" => $invoices
        ));
        return $view;
    }

    /**
     * This action gets customers invoices
     *
     * @return \Zend\View\Model\ViewModel
     */
    public function viewAction()
    {
        $em = $this->entityManager;
        $processForm = $this->processForm;
        $processForm->setAttributes(array(
            "action" => $this->url()
                ->fromRoute("invoice/default", array(
                "action" => "is-submit"
            ))
        ));
        $invoiceSession = new Container("invoice_session");

//         $paramId = $this->params()->fromRoute("id", NULL);
        $invoiceuid =  $this->params()->fromRoute("id", NULL);
// var_dump("LOLO");
        $invoice = NULL;
        if ($invoiceuid != NULL) {
            $invoice = $em->getRepository("Transactions\Entity\Invoice")->findOneBy(array(
                "invoiceUid"=>$invoiceuid
            )); 
        } else {
            $id = $invoiceSession->invoiceId;
            $invoice = $em->find("Transactions\Entity\Invoice", $id);
        }
        if ($invoice == NULL) {
            $this->redirect()->toRoute("invoice");
        }
        
        
                $invoiceSession->invoiceId = $invoice->getId();
        $broker = $em->find("Users\Entity\InsuranceBrokerRegistered", $this->brokerId);
        $view = new ViewModel(array(
            "invoice" => $invoice,
            "broker" => $broker,
            "processForm" => $processForm
        ));
        return $view;
    }

    public function expiredAction()
    {
        $view = new ViewModel();
        return $view;
    }

    public function isSubmitAction()
    {
        $em = $this->entityManager;
        $invoiceService = $this->invoiceService;
        $invoiceSession = new Container("invoice_session");
        $invoiceEntity = $em->find("Transactions\Entity\Invoice", $invoiceSession->invoiceId);
        $request = $this->getRequest();
        if ($request->isPost()) {

            $res = $invoiceService->processPayment();
            if ($res == false) {

                $this->redirect()->toRoute("invoice/default", array(
                    "action" => "view"
                ));
            } else {
                $invoiceCategory = $invoiceEntity->getInvoiceCategory()->getId();
                if ($invoiceCategory == InvoiceService::INVOICE_CAT_OFFER) {
                    $offerId = $invoiceEntity->getOffer()->getId();
                    $this->redirect()->toRoute("offer/default", array(
                        "action" => "pre-process",
                        "id" => $offerId
                    ));
                } elseif ($invoiceCategory == InvoiceService::INVOICE_CAT_PACKAGE) {
                    $packageId = $invoiceEntity->getPackages()->getId();
                    $this->redirect()->toRoute("acquired-packages/default", array(
                        "action" => "pre-process",
                        "id" => $packageId
                    ));
                } elseif ($invoiceCategory == InvoiceService::INVOICE_CAT_PROPOSAL) {
                    $proposalId = $invoiceEntity->getProposal()->getId();
                    $this->redirect()->toRoute("proposal/default", array(
                        "action" => "pre-process",
                        "id" => $proposalId
                    ));
                }
            }
        }
        return $this->getResponse()->setContent(NULL);
    }

    public function sendReminderAction()
    {
        $em = $this->entityManager;
        $centralBrokerId = $this->brokerId;
        $mailService = $this->mailService;
        $id = $this->params()->fromRoute("id", NULL);
        $id = $this->params()->fromQuery("data", NULL);
        $gritter = new GritterMessage();
        $response = new Response();
        if ($id == NULL) {
            $gritter->setTitle("Error");
            $gritter->setText("Absent Identifier");
            $gritter->setType(GritterMessage::TYPE_ERROR);
            $response->add($gritter);
        } else {

            try {
                /**
                 * 
                 * @var Invoice $invoiceEntity
                 */
                $invoiceEntity = $em->getRepository("Transactions\Entity\Invoice")->findOneBy(array("invoiceUid"=>$id));
                /**
                 * 
                 * @var InsuranceBrokerRegistered $brokerEntity
                 */
                $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $centralBrokerId);

                $var = array(
                    "brokerName" => $brokerEntity->getCompanyName(),
                    "broker" => $brokerEntity,
                    "logo" => $this->generalService->getBrokerLogo(),
                    "invoice" => $invoiceEntity
                );
                
                $template = array(
                    "template"=>"general-broker-customer-outstanding-invoice-email",
                    "var"=>$var
                );
                $pointers["to"] = $invoiceEntity->getCustomer()->getUser()->getEmail();
                $pointers["fromName"] = $brokerEntity->getCompanyName();
                $pointers["subject"] = "Outstanding Invoice reminder";
                
                
                
                $this->generalService->sendMails($pointers, $template, $brokerEntity->getUser()->getEmail());
                
                

//                 $message = $mailService->getMessage();
//                 $message->addTo($invoiceEntity->getCustomer()
//                     ->getUser()
//                     ->getEmail())
//                     ->setFrom("info@imapp.ng", $brokerEntity->getCompanyName())
//                     ->setSubject("INVOICE REMINDER");
//                 $mailService->setTemplate('general-broker-customer-outstanding-invoice-email', $var);
//                 $mailService->send();

//                 $this->flashmessenger()->addSuccessMessage("Reminder successfully delivered to customer");
//                 $this->redirect()->toRoute("invoice");

                $gritter->setTitle("Success");
                $gritter->setText("Reminder successfully delivered to customer");
                $gritter->setType(GritterMessage::TYPE_SUCCESS);
                
                $response->add($gritter);
            } catch (\Exception $e) {
//                 $this->flashmessenger()->addErrorMessage("There was a problem sending reminders to the customer");
//                 $this->redirect()->toRoute("invoice");

                $gritter->setTitle("Error");
                $gritter->setText("There was a problem sending reminders to the customer");
                $gritter->setType(GritterMessage::TYPE_ERROR);
                $response->add($gritter);
            }
        }

        return $this->getResponse()->setContent($response);
    }

    /**
     * This provides a a view of the micro payment
     *
     * @return mixed
     */
    public function microPaymentAction()
    {
        $em = $this->entityManager;
        $invoiceService = $this->invoiceService;
        $request = $this->getRequest();
        $requestUri = $request->getHeader("referer")->getUri();
        $offerUri = "/offer/process";
        $proposalUri = "/proposal/process";
        $packageUri = "/acquired-package/process";
        $microPaymentEntity = new MicroPayment();

        if ($request->isPost()) {
            $post = $request->getPost();
            if ($requestUri == $offerUri) {
                // The request is form offer page
                // Get offer session
                $offerSession = $this->offerService->getOfferSession();
                $offerId = $offerSession->offerId;
                $offerEntity = $em->find("Offer\Entity\Offer", $offerId);
                $invoiceEntity = $offerEntity->getInvoice();
                $invoiceEntity->setIsMicro(true);
                $res = $invoiceService->generateMicroPayment($post['microPayment'], $invoiceEntity->getAmount());
                for ($i = 0; $i < $post['microPayment']; $i ++) {
                    $microPaymentEntity->setCreatedOn(new \DateTime())
                        ->setDueDate($res["dueDate"][$i])
                        ->setFlatRate($res["flatrate"][$i])
                        ->setInvoice($invoiceEntity)
                        ->setMicroPaymentStructure($em->find("Transactions\Entity\MicroPayment", $post["microPayment"]))
                        ->setOtherRate(NULL);
                }
                $invoiceEntity->addMicroPayment($microPaymentEntity);
                $em->persist($microPaymentEntity);
                $em->persist($invoiceEntity);
                $em->persist($offerEntity);
            } elseif ($requestUri == $proposalUri) {} elseif ($requestUri == $packageUri) {
            /**
             * Packages
             */
            }

            try {
                // $em->persist();
                $em->flush();
                $this->flashmessenger()->addSuccessMessage("Successfully activated micro payment");
                if ($requestUri == $offerUri) {
                    $this->redirect()->toUrl($offerUri);
                } elseif ($requestUri == $proposalUri) {
                    $this->redirect()->toUrl($proposalUri);
                } elseif ($requestUri == $packageUri) {
                    $this->redirect()->toUrl($packageUri);
                }
            } catch (\Exception $e) {
                $this->flashmessenger()->addErrorMessage("There was a problem activating thee microPayment");
                if ($requestUri == $offerUri) {
                    $this->redirect()->toUrl($offerUri);
                } elseif ($requestUri == $proposalUri) {
                    $this->redirect()->toUrl($proposalUri);
                } elseif ($requestUri == $packageUri) {
                    $this->redirect()->toUrl($packageUri);
                }
            }
        }
        return $this->getResponse()->setContent(NULL);
    }

    public function upcomingAction()
    {
        $view = new ViewModel();
        return $view;
    }

    /**
     * This shows all outstingd invoices
     */
    public function outstandingAction()
    {}

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }

    public function setInvoiceService($xserv)
    {
        $this->invoiceService = $xserv;
        return $this;
    }

    public function setBrokerId($id)
    {
        $this->brokerId = $id;
        return $this;
    }

    public function setMailSerive($xserv)
    {
        $this->mailService = $xserv;
        return $this;
    }

    public function setProcessForm($form)
    {
        $this->processForm = $form;
        return $this;
    }

    public function setMessageForm($form)
    {
        $this->messageForm = $form;
        return $this;
    }

    public function setOfferService($xserv)
    {
        $this->offerService = $xserv;
        return $this;
    }

    public function setGeneralService($xserv)
    {
        $this->generalService = $xserv;
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
}