<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/General for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace General\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use GeneralServicer\Service\CurrencyService;
use WasabiLib\Ajax\Response;
use Transactions\Service\RaveCardPaymentBrokerService;
use WasabiLib\Ajax\GritterMessage;
use WasabiLib\Modal\WasabiModal;
use WasabiLib\Modal\WasabiModalView;
use Transactions\Form\CardPinForm;
use Transactions\Form\OTPForm;
use GeneralServicer\Service\GeneralService;
use Doctrine\ORM\EntityManager;
use Transactions\Entity\Invoice;
use Transactions\Service\InvoiceService;
use SMS\Service\SMSService;
use WasabiLib\Ajax\Redirect;

class GeneralController extends AbstractActionController
{

    /**
     *
     * @var EntityManager
     */
    private $entityManager;

    /**
     *
     * @var GeneralService
     */
    private $generalService;

    private $invoiceService;

    /**
     *
     * @var RaveCardPaymentBrokerService
     */
    private $raveCardPaymentService;

    /**
     *
     * @var SMSService
     */
    private $smsService;

    /**
     *
     * @var CardPinForm
     */
    private $cardPinForm;

    /**
     *
     * @var OTPForm
     */
    private $otpForm;

    private $cardBillingForm;

    private $renderer;

    public function indexAction()
    {
        return array();
    }

    // Begin Payment logic
    /**
     * This action initiates the payment process
     *
     * @return mixed|string
     */
    public function initiatecardpaymentAction()
    {
        $response = new Response();
        $em = $this->entityManager;
        $userEntity = $this->identity();
        $generalSession = $this->generalService->getGeneralSession();
        $raveCardPaymentService = $this->raveCardPaymentService;
        $raveCardPaymentSession = $raveCardPaymentService->getRavePaymentSession();
        $cardPinForm = $this->cardPinForm;
        $cardPinForm->setAttributes(array(
            "method" => "POST",
            "action" => $this->url()
                ->fromRoute("s-m-s/default", array(
                "action" => "pinprocess"
            )),
            "id" => "simpleForm",
            "class" => "ajax_element"
        ));
        /**
         *
         * @var Invoice $invoiceEntity
         */
        $invoiceEntity = NULL;
        $invoiceId = $generalSession->brokerInvoiceId;
        $invoiceEntity = $em->find("Transactions\Entity\Invoice", $invoiceId);

        $request = $this->getRequest();
        $gritter = new GritterMessage();
        if ($request->isPost()) {
            $cardPaymentFieldset = $this->params()->fromPost();
            $cardNumber = $cardPaymentFieldset['cc_number'];
            $cardMonth = $cardPaymentFieldset['cc_month'];
            $cardYear = $cardPaymentFieldset['cc_year'];
            $cardCvc = $cardPaymentFieldset['cc_cvc'];
            $card = str_replace(" ", "", $cardNumber);
            try {
                $raveCardPaymentService->setAmount($invoiceEntity->getAmount())
                    ->setCardCvv($cardCvc)
                    ->setCardMonth($cardMonth)
                    ->setCardNo($card)
                    ->setCardYear($cardYear)
                    ->setIp($this->generalService->getClientIp())
                    ->setEmail($userEntity->getEmail())
                    ->setTxRef($invoiceEntity->getInvoiceUid() . "_" . microtime())
                    ->setCurrency($invoiceEntity->getCurrency()
                    ->getCode());

                $res = $raveCardPaymentService->initiateCardPayment();
                if ($res == "PIN") {
                    $viewModel = new ViewModel(array(
                        "cardPinForm" => $cardPinForm
                    ));

                    $viewModel->setTemplate("transaction_card_pin-form-snippet");

                    $modal = new WasabiModal("standard", "Card PIN CODE");
                    $modal->setContent($viewModel);

                    $modalView = new WasabiModalView("#wasabi", $this->rendrer, $modal);
                    $response = new Response();
                    $response->add($modalView);
                    return $this->getResponse()->setContent($response);
                } elseif ($res == "NOAUTH") { // this is suggested authorization NOAUTH_INTERNATIONAL
                    /**
                     * At this point a billing information form is displayed
                     */

                    $cardBillingForm = $this->cardBillingForm;
                    $cardBillingForm->setAttributes(array(
                        "data-ajax-loader" => "myLoader",
                        "id" => "simpleForm",
                        "class" => "ajax_element form-horizontal form-label-left ajax_element",
                        "action" => $this->url()
                            ->fromRoute("general/default", array(
                            "action" => "otpmodal"
                        ))
                    ));
                    ;
                    $viewModel = new ViewModel(array(
                        "cardBillingForm" => $cardBillingForm
                    ));
                    $viewModel->setTemplate("transaction-card-billing-form");

                    $modal = new WasabiModal("standard", "CARD BILLING INFORMATION");
                    $modal->setContent($viewModel);

                    $modalView = new WasabiModalView("#wasabi", $this->rendrer, $modal);

                    $response = new Response();
                    $response->add($modalView);
                    return $this->getResponse()->setContent($response);
                } else {
                    return "VBV";
                }
            } catch (\Exception $e) {
                $gritter->setTitle("Error");
                $gritter->setText("Payment initiation error");
                $gritter->setType(GritterMessage::TYPE_ERROR);

                $response->add($gritter);
            }
        }
        return $this->getResponse()->setContent($response);
    }

    public function pinprocessAction()
    {
        $response = new Response();

        $cardPinForm = $this->cardPinForm;
        $raveCardPaymentService = $this->raveCardPaymentService;
        $raveCardPaymentSession = $raveCardPaymentService->getRavePaymentSession();
        $request = $this->getRequest();
        $gritter = new GritterMessage();
        if ($request->isPost()) {
            $cardPin = $this->params()->fromPost("cc_pin", NULL);
            $cardPin = trim($cardPin);

            if ($cardPin != NULL) {

                try {
                    $res = $raveCardPaymentService->setCardPin($cardPin)->pinConfirmation();
                    if ($res == "OTP") {
                        $otpForm = $this->otpForm;
                        $otpForm->setAttributes(array(
                            "data-ajax-loader" => "myLoader",
                            "id" => "simpleForm",
                            "class" => "ajax_element form-horizontal form-label-left ajax_element",
                            "action" => $this->url()
                                ->fromRoute("general/default", array(
                                "action" => "otpmodal"
                            ))
                        ));
                    }
                } catch (\Exception $e) {
                    $gritter->setTitle("Pin Code Error");
                    $gritter->setText("There was a problem, Please try again later");
                    $gritter->setType(GritterMessage::TYPE_ERROR);
                    $response->add($gritter);
                }
                // Empty PIN code
                $gritter->setTitle("Error: Empty PIN");
                $gritter->setText("Pin Code cannot be empty");
                $gritter->setType(GritterMessage::TYPE_ERROR);

                $response->add($gritter);
            }
        }
        return $this->getResponse()->setContent($response);
    }

    public function otpprocessAction()
    {
        $response = new Response();
        $raveCardPaymentService = $this->raveCardPaymentService;
        // $otpForm = $this->otpForm
        $gritter = new GritterMessage();
        $request = $this->getRequest();
        if ($request->isPost()) {
            $otp = $this->params()->fromPost("otp", NULL);
            if ($otp != NULL) {
                $otp = trim($otp);
                try {
                    $res = $raveCardPaymentService->setOtp($otp)->otpConfirmation();
                    if ($res == TRUE) {
                        // All went well

                        // Update required information
                        // $invoiceId = $this->generalService
                        $this->postpayment();
                    }
                } catch (\Exception $e) {
                    $gritter->setTitle("OTP Error");
                    $gritter->setText("Error Processing OTP");
                }
            }
        }
        return $this->getResponse()->setContent($response);
    }

    private function postpayment()
    {
        $generalService = $this->generalService;
        $response = new Response();
        $em = $this->entityManager;
        $generalSession = $generalService->getGeneralSession();
        $smsService = $this->smsService;
        $invoiceId = $generalSession->brokerInvoiceId;
        $gritter = new GritterMessage();
        /**
         *
         * @var Invoice $invoiceEntity
         */
        $invoiceEntity = $em->find("Transactions\Entity\Invoice", $invoiceId);
        if ($invoiceEntity != NULL) {
            $invoiceCategory = $invoiceEntity->getInvoiceCategory()->getId();
            if ($invoiceCategory == InvoiceService::INVOICE_CAT_SMS_SUB) {
                // update
                try {
                    $brokerEntity = $smsService->updateSmsAccount($generalService->getCentralBroker());
                    $em->persist($brokerEntity);
                    $em->flush();
                    $this->flashMessenger()->addSuccessMessage("Successfully acquired SMS credit");

                    $redirect = new Redirect($this->url()->fromRoute("s-m-s/default", array(
                        "action" => "buy-sms"
                    )));
                    $response->add($redirect);
                } catch (\Exception $e) {
                    $gritter->setTitle("Error");
                    $gritter - setText("Error updatng ur SMS account");
                    $gritter->setType(GritterMessage::TYPE_ERROR);

                    $response->add($gritter);
                }
            }
        }

        return $this->getResponse()->setContent($response);
    }

    // End pyment logic
    public function stateAction()
    {
        $em = $this->entityManager;
        $request = $this->getRequest();
        $data = "";
        if ($request->isXmlHttpRequest()) {
            // $data
            $post = $request->getPost()->service;
            $data = $em->getRepository("Settings\Entity\Zone")->findBy(array(
                "country" => $post
            ));
            $html = "";
            foreach ($data as $dat) {
                $html .= "<option value='" . $dat->getId() . "'>" . $dat->getZoneName() . "</option>";
            }
            // $dat = "<option value='" . $dat->getId() . "'>".$dat->getSpecificService()."</option>";
            // $inner = new InnerHtml();
            // $inner->setSelector("#pack_cover");
            // $inner->setContent("<option value='".$post."'>JUST ME</option>");

            // $response = new Response();
            // $response->add($inner);
            return $this->getResponse()->setContent($html);
        }
        // $view = new ViewModel(array(
        // "data"=>"<option value='303'>PUM PUM </option>",
        // ));

        // $view->setTerminal(TRUE);
        // // $view->set
        // return $view;
    }

    /**
     * This actions returns a tabular representation of the micro details
     */
    public function microdetailsAction()
    {
        $invoiceService = $this->invoiceService;
        $response = "";
        // $micropaymentSession = NULL;
        $request = $this->getRequest();
        if ($request->isXmlHttpRequest()) {

            $response = $this->microDetails($invoiceService->generateMicroPayment($request->getPost()->divisor, CurrencyService::cleanInputValueStatic($request->getPost()->premium)));
        }
        return $this->getResponse()->setContent($response);
    }

    /**
     * 
     * @param object $data
     * @return string
     */
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

<p>All Amount payable in Naira</p>
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

                          </div><hr>";

        return $frame;
    }

    // public functoin countr
    public function fooAction()
    {
        // This shows the :controller and :action parameters in default route
        // are working when you browse to /general/general/foo
        return array();
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }

    public function setInvoiceService($service)
    {
        $this->invoiceService = $service;
        return $this;
    }

    public function setRenderer($renderer)
    {
        $this->renderer = $renderer;
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

    /**
     *
     * @param mixed $raveCardPaymentService
     */
    public function setRaveCardPaymentService($raveCardPaymentService)
    {
        $this->raveCardPaymentService = $raveCardPaymentService;
        return $this;
    }

    /**
     *
     * @param mixed $cardPinForm
     */
    public function setCardPinForm($cardPinForm)
    {
        $this->cardPinForm = $cardPinForm;
        return $this;
    }

    /**
     *
     * @param \Transactions\Form\OTPForm $otpForm
     */
    public function setOtpForm($otpForm)
    {
        $this->otpForm = $otpForm;
        return $this;
    }

    /**
     *
     * @param \SMS\Service\SMSService $smsService
     */
    public function setSmsService($smsService)
    {
        $this->smsService = $smsService;
        return $this;
    }
}
