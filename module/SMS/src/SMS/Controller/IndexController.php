<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/SMS for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace SMS\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;
use Transactions\Entity\Transaction;
// use Transactions\Entity\PaystackResponse;
use Zend\Json\Json;
use Transactions\Entity\PaystackUserAutorizationCode;
use Transactions\Service\TransactionService;
use Transactions\Entity\Invoice;
use SMS\Service\SMSService;
use Transactions\Service\InvoiceService;
use WasabiLib\Modal\WasabiModal;
use WasabiLib\Modal\WasabiModalView;
use WasabiLib\Ajax\Response;
use WasabiLib\Ajax\Redirect;
use WasabiLib\Modal\WasabiModalConfigurator;
use GeneralServicer\Service\GeneralService;
use Transactions\Service\PaymentService;
use WasabiLib\Ajax\GritterMessage;
use Transactions\Service\RaveCardPaymentBrokerService;
use Transactions\Form\CardPinForm;

class IndexController extends AbstractActionController
{

    /**
     * 
     * @var GeneralService
     */
    private $generalService;
    

    private $smsService;

    private $buySMSForm;
    
    /**
     * 
     * @var CardPinForm
     */
    private $cardPinForm;

    private $entityManager;

    private $sendSmsForm;

    private $otpForm;

    private $pinCodeForm;

    private $cardPaymentForm;

    private $transactionService;

    private $paystackPaymentService;

    private $centralBrokerId;

    private $invoiceService;

    private $moneyWaveService;

    /**
     *
     * @var RaveCardPaymentBrokerService
     */
    private $raveCardPaymentService;

    // private
    private $renderer;

    public function onDispatch(\Zend\Mvc\MvcEvent $e)
    {
        $response = parent::onDispatch($e);
        // $response = parent::on
        $this->redirectPlugin()->redirectCondition();
        return $response;
    }

    private function isCardInSystem($card, $user)
    {
        $em = $this->entityManager;
        $auth = $em->getRepository("Transactions\Entity\PaystackUserAutorizationCode")->findOneBy(array(
            "lastFour" => $card,
            "user" => $user
        ));
        if ($auth == NULL) {
            return false; // defines it is empty
        } else {
            return true; // defines a value of this nature exist
        }
    }

    // Begin Modal
    /**
     * This function shows the payment form and
     * on entering the card details and clicking the payment button
     * it processes the details
     *
     * @return mixed
     */
    public function processbuysmsmodalAction()
    {
        $em = $this->entityManager;
        $cardPaymentForm = $this->cardPaymentForm;
        $transactionService = $this->transactionService;
        $invoiceService = $this->invoiceService;
        $generalSession = $this->generalService->getGeneralSession();
//         $raveCardPaymentService = $this->raveCardPaymentService;
        $smsService = $this->smsService;
        $userEntity = $this->identity();
        $request = $this->getRequest();
        $response = new Response();
        $gritter = new GritterMessage();
        $cardPaymentForm->setAttributes(array(
            "data-ajax-loader" => "myLoader",
            "id" => "simpleForm",
            "class" => "form-horizontal form-label-left ajax_element",
            "action" => $this->url()
                ->fromRoute("general/default", array(
                "action" => "initiatecardpayment"
            ))
        ));
        // $amountPayable =
        if ($request->isPost()) {
            $post = $this->params()->fromPost();
            $unit = $post['smsUnitFieldset']['smsUnit'];
            // return $data;
            if ($unit != NULL) {
                $smsPrice = $unit * SMSService::SMS_PRICE; // Calculation of te SMS price
                $amountPayable = $smsPrice + ($smsPrice * (float) TransactionService::TRANSACTION_VAT / 100); // This is VAT inclusive
                $invoiceEntity = new Invoice();
                $invoiceEntity->setAmount($amountPayable)
                    ->setCurrency($em->find("Settings\Entity\Currency", InvoiceService::NIGERIA_NAIRA_CURRENCY))
                    ->setExpiryDate(new \DateTime())
                    ->setGeneratedOn(new \DateTime())
                    ->setInvoiceCategory($em->find("Transactions\Entity\InvoiceCategory", InvoiceService::INVOICE_CAT_SMS_SUB))
                    ->setInvoiceUid($this->invoiceService->generateInvoiceNumber())
                    ->setUser($userEntity)
                    ->setIsMicro(false)
                    ->setIsOpen(true)
                    ->setModifiedOn(new \DateTime())
                    ->setStatus($em->find("Transactions\Entity\InvoiceStatus", InvoiceService::INVOICE_UNPAID_STATUS));

                $em->persist($invoiceEntity);
                try {
                    $em->flush();
                    $generalSession->brokerInvoiceId = $invoiceEntity->getId();
                    $viewModel = new ViewModel(array(
                        "paymentForm" => $cardPaymentForm,
                        "invoiceEntity" => $invoiceEntity
                    ));
                    $viewModel->setTemplate("customer-payment-credit-card-form");
                    $modal = new WasabiModal("standard", "Card Payment");
                    // $modal->setSize(WasabiModalConfigurator::MODAL_);
                    $modal->setContent($viewModel);

                    $modalView = new WasabiModalView("#wasabi_modal", $this->renderer, $modal);
                    $response->add($modalView);

                    // }
                    // }

                    return $this->getResponse()->setContent($response);
                } catch (\Exception $e) {
                    $gritter->setTitle("Payment initiation Error");
                    $gritter->setText($e->getMessage());
                    $gritter->setType(GritterMessage::TYPE_ERROR);
                    $response->add($gritter);
                    return $this->getResponse()->setContent($response);

                    $response->add($gritter);
                }
            }
        }
        // else {

        // if ($generalSession->brokerInvoiceId != NULL) {
    }

   
    
    /**
     * This action procecesses the pin submition for payment 
     * @return mixed
     */
    public function pinprocessAction(){
        $response = new Response();
       
        return $this->getResponse()->setContent($response);
    }

//     /**
//      * Processe the card payment
//      * Sends the payment to the rave card payment service
//      * Displays the appropriate form or dialog for continuation
//      *
//      * @return mixed
//      */
//     public function cardpaymentmodalAction()
//     {
//         $em = $this->entityManager;
//         $userEntity = $this->identity();
//         $response = new Response();
//         $generalSession = $this->generalService->getGeneralSession();
//         $raveCardPaymentService = $this->raveCardPaymentService;
//         $cardPaymentForm = $this->cardPaymentForm;
//         $ravePaymentSession = new Container("rave_payment_session");
//         $request = $this->getRequest();
//         if ($request->isPost()) {
//             // call the card payment service
//             $cardPaymentFieldset = $this->params()->fromPost();
//             // $post = $this->params()->fromPost();

//             $cardNumber = $cardPaymentFieldset['cc_number'];
//             $cardMonth = $cardPaymentFieldset['cc_month'];
//             $cardYear = $cardPaymentFieldset['cc_year'];
//             $cardCvc = $cardPaymentFieldset['cc_cvc'];
//             $card = str_replace(" ", "", $cardNumber);
//             if ($generalSession->brokerInvoiceId != NULL) {
//                 $invoiceEntity = $em->find("Transactions\Entity\Invoice", $generalSession->brokerInvoiceId);
//                 $amountPayable = $invoiceEntity->getAmount();
//                 $raveCardPaymentService->setAmount($amountPayable)
//                     ->setCardNo($card)
//                     ->setCardCvv($cardCvc)
//                     ->setCardMonth($cardMonth)
//                     ->setCardYear($cardYear)
//                     ->setCurrency($invoiceEntity->getCurrency()
//                     ->getCode())
//                     ->setAmount($amountPayable)
//                     ->setEmail($userEntity->getEmail())
//                     ->setTxRef($invoiceEntity->getInvoiceUid() . "_" . str_replace(" ", "_", microtime()))
//                     ->setIp(GeneralService::getClientIp());

//                 try {
//                     $paymentResponse = $raveCardPaymentService->initiateCardPayment();
//                     $generalSession->amountSent = $amountPayable;
//                 } catch (\Exception $e) {
//                     $response->add($this->failedpayment($e->getMessage()));
//                 } finally {

//                     // if (! $paymentResponse instanceof \Exception && $paymentResponse != "") {
//                     if ($paymentResponse == "PIN") {
//                         $pinCodeModal = $this->pinform();
//                         $response->add($pinCodeModal);
//                     } elseif ($paymentResponse == "NOAUTH") {
//                         // No authorization required
//                         // Assumed to be international card
//                         // All authentication would nmade over the customers billiing address
//                         $addressBilling = $this->cardbillingform();
//                         $response->add($addressBilling);
//                     } elseif ($paymentResponse == "OTP") {
//                         $otpForm = $this->otpForm;
//                         $otpForm->setAttributes(array(
//                             "data-ajax-loader" => "myLoader",
//                             "id" => "simpleForm",
//                             "class" => "ajax_element form-horizontal form-label-left ajax_element",
//                             "action" => $this->url()
//                                 ->fromRoute("s-m-s/default", array(
//                                 "action" => "processcardotp" // while processing this, defaul settings
//                                                              // First identify if the call is account or card
//                             ))
//                         ));
//                         $otpForm = $this->otpform($ravePaymentSession->chargeResponseMessage, $otpForm);
//                         $response->add($otpForm);
//                     } elseif ($paymentResponse == "VBV") {
//                         // send vbv form
//                     }
//                 }
//             } else {}
//         }
//         // $modal = new WasabiModal("standard", "");

//         return $this->getResponse()->setContent($response);
//     }

    public function processcardotpAction()
    {
        $raveCardService = $this->raveCardPaymentService;
        $response = new Response();
        $viewModel = new ViewModel();
        $viewModel->setTemplate("");

        $modal = new WasabiModal("standard", "PAYMENT STATUS");
        $modal->setSize(WasabiModalConfigurator::MODAL_SM);
        $modal->setContent($viewModel);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $post = $this->params()->fromPost();
            $otpData = $post['otp'];
            $otpData = trim($otpData);
            if ($otpData != "") {
                try {
                    $raveCardService->setOtp($otpData);
                    $res = $raveCardService->otpValidation();
                } catch (\Exception $e) {
                    $response->add($this->failedpayment($e->getMessage()));
                } finally {
                    // verify payment here
                    if ($res) {
                        $response->add($this->successpayment());
                        // Notify Broker and account Managers
                        // Send Emails for transaction
                    } else {
                        $response->add($this->failedpayment("Payment could not be verified"));
                    }
                }
            }
        }
        return $this->getResponse()->setContent($response);
    }

    /**
     * This function processes the OTP required by the card
     * and eventually aggregates the SMS by udating the sms account
     * It also defines and implements a mail notification
     *
     * @return mixed
     */
    public function otpmodalAction()
    {
        $em = $this->entityManager;
        $moneywaveService = $this->moneyWaveService;
        $generalSession = $this->generalService->getGeneralSession();
        $smsService = $this->smsService;
        $smsService->setUnits($generalSession->smsCredit);
        $brokerEntity = $smsService->updateSmsAccount();

        try {
            $em->persist($brokerEntity);
            $em->flush();

            // Send Mail Notification here
            // TODO Create a mail notification template idicating the amount of sms acquired

            $redirect = new Redirect($this->url()->fromRoute("dashboard"));
            $this->flashmessenger()->addSuccessMessage("Successfully acquired SMS");
            $response = new Response();
            $response->add($redirect);
            return $this->getResponse()->setContent($response);
        } catch (\Exception $e) {
            $redirect = new Redirect($this->url()->fromRoute("s-m-s/default", array(
                "action" => "buy-sms"
            )));
            $this->flashmessenger()->addErrorMessage("There was a problem acquiring this sms please try again later");
            $response = new Response();
            $response->add($redirect);
            return $this->getResponse()->setContent($response);
        }
    }

    // End Modal

    /**
     * This method display the form and view required to acquire SMS
     * It also gives a quick preview of the price involved
     *
     * @return \Zend\View\Model\ViewModel
     */
    public function buySmsAction()
    {
        $em = $this->generalService->getEntityManager();

        // $paystackPaymentService = $this->paystackPaymentService;
        $invoiceService = $this->invoiceService;
        $transactionService = $this->transactionService;
        $generalSession = $this->generalService->getGeneralSession();
        $smsService = $this->smsService;
        // $paystackPaymentSession = new Container("paystack_payment_session");
        // $paystackPaymentSession->setExpirationSeconds(60 * 10);
        $buySmsForm = $this->buySMSForm;
        $buySmsForm->setAttributes(array(
            "data-ajax-loader" => "myLoader",
            "id" => "simpleForm",
            "class" => "ajax_element form-horizontal form-label-left ajax_element",
            "action" => $this->url()
                ->fromRoute("s-m-s/default", array(
                "action" => "processbuysmsmodal"
            ))
        ));
        $avalableSms = $this->smsService->getAvailableCredit();
        $userEntity = $this->identity();
        $request = $this->getRequest();

        $view = new ViewModel(array(
            'availableSms' => $avalableSms,
            'smsForm' => $buySmsForm
        ));
        return $view;
    }

    /**
     *
     * @return \Zend\View\Model\ViewModel
     */
    public function sendSmsAction()
    {
        $em = $this->entityManager;
        $sendSmsForm = $this->sendSmsForm;

        $request = $this->getRequest();
        if ($request->isPost()) {
            $data = $request->getData();
            $sendSmsForm->setData($data);
            if ($sendSmsForm->isValid()) {
                // Process the the sms
            }
        }
        /**
         * Define form for sending sms with javascript library attached
         *
         * @var Ambiguous $view
         */
        $view = new ViewModel(array(
            "sendSMsForm" => $sendSmsForm
        ));
        return $view;
    }

    private function buySmsValidationGroup($form)
    {
        $group = array();
        return $form->validationGroup($group);
    }

    private function pinform()
    {
        $em = $this->entityManager;
        $pinCodeForm = $this->pinCodeForm;
        $pinCodeForm->setAttributes(array(
            "data-ajax-loader" => "myLoader",
            "id" => "simpleForm",
            "class" => "ajax_element form-horizontal form-label-left ajax_element",
            "action" => $this->url()
                ->fromRoute("cus_payment/default", array(
                "action" => "initiatecard"
            ))
        ));
        $viewModel = new ViewModel(array(
            "pinCodeForm" => $pinCodeForm
        ));
        $viewModel->setTemplate("customer-board-change-login-pin-form");
        $modal = new WasabiModal("standard", "Card PIN CODE");
        $modal->setSize(WasabiModalConfigurator::MODAL_SM);
        $modal->setContent($viewModel);

        $modalView = new WasabiModalView("#wasabi_modal", $this->renderer, $modal);
        // $response = new Response();
        // $response->add($modalView);

        return $modalView;
    }

    private function otpform($message = "", $form = "")
    {
        // $em = $this->entityManager;
        $otpForm = $this->otpForm;
        if ($form == "") {
            $otpForm->setAttributes(array(
                "data-ajax-loader" => "myLoader",
                "id" => "simpleForm",
                "class" => "ajax_element form-horizontal form-label-left ajax_element",
                "action" => $this->url()
                    ->fromRoute("board/default", array(
                    "action" => "processcardotp" // while processing this, defaul settings
                                                 // First identify if the call is account or card
                ))
            ));
        } else {
            $otpForm = $form;
        }

        $viewModel = new ViewModel(array(
            "otpForm" => $otpForm,
            "message" => $message
        ));
        $viewModel->setTemplate("transaction_otp-form-snippet");
        $modal = new WasabiModal("standard", "OTP");
        $modal->setSize(WasabiModalConfigurator::MODAL_SM);
        $modal->setContent($viewModel);

        $modalView = new WasabiModalView("#wasabi_modal", $this->renderer, $modal);
        // $response = new Response();
        // $response->add($modalView);
        return $modalView;
    }

    /**
     * This displays the success page
     * modal format
     */
    private function successpayment()
    {
        $viewModel = new ViewModel();
        $viewModel->setTemplate("transaction-payment-success-modal");
        $modal = new WasabiModal("standard", "Success");
        $modal->setSize(WasabiModalConfigurator::MODAL_SM);
        $modal->setContent($viewModel);

        $modalView = new WasabiModalView("#wasabi_modal", $this->rendrer, $modal);

        return $modalView;
    }

    /**
     * This should also include the Type of Error
     * Also Provide A link to the payment Page or the Pay modal
     *
     * @return \WasabiLib\Modal\WasabiModalView
     */
    private function failedpayment($message = "")
    {
        $viewModel = new ViewModel(array(
            "message" => $message
        ));
        $viewModel->setTemplate("transaction-payment-error-modal");
        $modal = new WasabiModal("standard", "Error");
        $modal->setSize(WasabiModalConfigurator::MODAL_SM);
        $modal->setContent($viewModel);

        $modalView = new WasabiModalView("#wasabi_modal", $this->rendrer, $modal);

        return $modalView;

        // $response = new Response();
        // $response->add($modalView);

        // return $this->getResponse()->setContent($response);
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }

    public function setGeneralService($gs)
    {
        $this->generalService = $gs;
        return $this;
    }

    public function setSmsService($serv)
    {
        $this->smsService = $serv;
        return $this;
    }

    public function setBuySMSForm($form)
    {
        $this->buySMSForm = $form;
        return $this;
    }

    public function setOtpForm($form)
    {
        $this->otpForm = $form;
        return $this;
    }

    public function setSendSmsForm($form)
    {
        $this->sendSmsForm = $form;
        return $this;
    }

    public function setPaystackPaymentService($xserv)
    {
        $this->paystackPaymentService = $xserv;
        return $this;
    }

    public function setCentralBrokerId($id)
    {
        $this->centralBrokerId = $id;
        return $this;
    }

    /**
     *
     * @param object $cardPaymentForm
     */
    public function setCardPaymentForm($cardPaymentForm)
    {
        $this->cardPaymentForm = $cardPaymentForm;
        return $this;
    }

    public function setInvoiceService($xserv)
    {
        $this->invoiceService = $xserv;
        return $this;
    }

    public function setTransactionService($xserv)
    {
        $this->transactionService = $xserv;
        return $this;
    }

    public function setMoneyWaveService($xserv)
    {
        $this->moneyWaveService = $xserv;
        return $this;
    }

    public function setRenderer($rend)
    {
        $this->renderer = $rend;
        return $this;
    }

    /**
     *
     * @return object $raveCardPaymentService
     */
    public function getRaveCardPaymentService()
    {
        return $this->raveCardPaymentService;
    }

    /**
     *
     * @param object $raveCardPaymentService
     */
    public function setRaveCardPaymentService($raveCardPaymentService)
    {
        $this->raveCardPaymentService = $raveCardPaymentService;
        return $this;
    }
    /**
     * @param mixed $cardPinForm
     */
    public function setCardPinForm($cardPinForm)
    {
        $this->cardPinForm = $cardPinForm;
        return $this;
    }

}
