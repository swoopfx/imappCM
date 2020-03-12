<?php
namespace Customer\Controller;

use WasabiLib\Ajax\Response;
use WasabiLib\Modal\WasabiModal;
use WasabiLib\Modal\WasabiModalConfigurator;
use WasabiLib\Modal\WasabiModalView;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use GeneralServicer\Service\GeneralService;
use Zend\Escaper\Escaper;
use Zend\Session\Container;
use WasabiLib\Ajax\Redirect;
use WasabiLib\Ajax\TriggerEventManager;
use WasabiLib\Ajax\GritterMessage;
use Transactions\Service\RaveCardPaymentService;

/**
 *
 * @author otaba
 *        
 */
class PaymentController extends AbstractActionController
{

    private $entityManager;

    private $cardPaymentForm;

    private $generalService;

    private $clientSession;

    private $clientGeneralService;

    private $transactionService;

    private $customerBoardService;

    /**
     * 
     * @var RaveCardPaymentService
     */
    private $raveCardPaymentService;

    private $raveBankPaymentService;

    private $paymentService;

    // private $
    private $otpForm;

    private $cardBillingForm;

    private $bankPaymentForm;

    // this form is for automated bank payment
    private $pinCodeForm;

    // this is pin/password code
    private $cardPinForm;

    private $rendrer;

    private $redirect_url;

    // TODO - Insert your code here

    /**
     */
    public function __construct()
    {

        // TODO - Insert your code here
    }

    // Begin send mails
    private function sendCustomerTransactionMail()
    {
        $tribee = new TriggerEventManager();
    }

    private function sendBrokerTransactionMail()
    {}

    private function sendManagerTransactionMail()
    {}

    // End send Mails

    /*
     * Begin card processing
     */

    /**
     * Resends the otp for payment
     *
     * @return mixed
     */
    public function resendotpAction()
    {
        // $modal = new WasabiModal("standard", "")
        $response = new Response();
        return $this->getResponse()->setContent($response);
    }

    /**
     * This provides a modal information for paying using the card in database
     *
     * @return mixed
     */
    public function preauthmodalAction()
    {
        $em = $this->entityManager;
        $clientGeneralService = $this->clientGeneralService;
        $generalSession = $clientGeneralService->getGeneralSession();
        $invoiceId = $generalSession->InvoiceId;
        $response = new Response();
        if ($invoiceId == NULL) {
            $redirect = new Redirect("/board/payment");
            $response->add($redirect);
        } else {
            $invoiceEntity = $em->find("Transactions\Entity\Invoice", $invoiceId);
            $viewModel = new ViewModel(array(
                "invoiceEntity" => $invoiceEntity
            ));
            $viewModel->setTemplate("transaction-preauth-payment-card-modal");

            $modal = new WasabiModal("standard", "Authorized Charge");
            $modal->setContent($viewModel);
            // $modal->setSize(WasabiModalConfigurator::MODAL_SM);

            $modalView = new WasabiModalView("#wasabi", $this->rendrer, $modal);

            $response->add($modalView);
        }
        return $this->getResponse()->setContent($response);
    }

    public function preauthprocessAction()
    {
        $em = $this->entityManager;
        $raveCardPaymentService = $this->raveCardPaymentService;
        $clientGeneralService = $this->clientGeneralService;
        $generalSession = $clientGeneralService->getGeneralSession();
        $invoiceId = $generalSession->InvoiceId;
        $response = new Response();
        $userEntity = $this->identity();
        if ($invoiceId == NULL) {
            $redirect = new Redirect("/board/payment");
            $response->add($redirect);
        } else {
            $invoiceEntity = $em->find("Transactions\Entity\Invoice", $invoiceId);

            $raveCardTokenEntity = $em->getRepository("Transactions\Entity\RaveCardToken")->findOneBy(array(
                "user" => $userEntity->getId()
            ));
            $raveCardPaymentService->setCurrency($invoiceEntity->getCurrency()
                ->getCode())
                ->setEmbededToken($raveCardTokenEntity->getEmbededToken())
                ->setEmail($userEntity->getEmail())
                ->setAmount($invoiceEntity->getAmount())
                ->setIp(GeneralService::getClientIp())
                ->setTxRef($invoiceEntity->getInvoiceUid() . "_" . str_replace(" ", "_", microtime()));
            try {
                $preauthResponse = $raveCardPaymentService->preAuthCharge();
            } catch (\Exception $e) {
                $response->add($this->failedpayment($e->getMessage()));
            } finally {
                if ($preauthResponse == TRUE) {
                    $response->add($this->successpayment());
                    // notify customer
                    // notify broker and account managers
                } else {
                    $response->add($this->failedpayment("avaiable card could not be charged at this moment"));
                }
            }
        }

        return $this->getResponse()->setContent($response);
    }

    /**
     * This show and initiate card payment form
     *
     * @return mixed
     */
    public function showcardformmodalAction()
    {
        $em = $this->entityManager;
        $userEntity = $this->identity();
        $clientGeneralService = $this->clientGeneralService;
        $generalService = $this->generalService;
        $raveCardService = $this->raveCardPaymentService;
        $response = new Response();
        $transactionService = $this->transactionService;
        $generalSession = $this->clientGeneralService->getGeneralSession();
        $cardPaymentForm = $this->cardPaymentForm;
        $brokerId = $clientGeneralService->getBrokerId();
        $invoiceId = $generalSession->InvoiceId;
        $ravePaymentSession = new Container("rave_payment_session");
        $request = $this->getRequest();
        $gritter = new GritterMessage();
        if ($invoiceId == NULL) {
            $gritter->setTitle("INVOICE ERROR");
            $gritter->setText("Invoice entity is absent, please refresh the page and try again");
            $gritter->setType(GritterMessage::TYPE_ERROR);
            $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);
            $response->add($gritter);

            // $this->flashmessenger()->addErrorMessage("There is no invoice attached to the payment");
        }
        $invoiceEntity = $em->find("Transactions\Entity\Invoice", $invoiceId);

        $cardPaymentForm->setAttributes(array(
            "data-ajax-loader" => "myLoader",
            "id" => "simpleForm",
            "class" => "ajax_element form-horizontal form-label-left ajax_element",
            "action" => $this->url()
                ->fromRoute("cus_payment/default", array(
                "action" => "showcardformmodal"
            ))
        ));

        $viewModel = new ViewModel(array(
            "paymentForm" => $cardPaymentForm,
            "invoiceEntity" => $invoiceEntity
        ));

        $viewModel->setTemplate("customer-payment-credit-card-form");
        $modal = new WasabiModal("standard", "Card Payment");
        $modal->setSize(WasabiModalConfigurator::MODAL_SM);
        $modal->setContent($viewModel);

        $modalView = new WasabiModalView("#wasabi", $this->rendrer, $modal);

        $response->add($modalView);

        // Process Payment
        if ($request->isPost()) {

            $cardPaymentFieldset = $this->params()->fromPost();
            // $post = $this->params()->fromPost();
            $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $brokerId);

            $cardNumber = $cardPaymentFieldset['cc_number'];
            $cardMonth = $cardPaymentFieldset['cc_month'];
            $cardYear = $cardPaymentFieldset['cc_year'];
            $cardCvc = $cardPaymentFieldset['cc_cvc'];

            $paymentResponse = "";

            $card = str_replace(" ", "", $cardNumber);
            $cardMonth = str_replace(" ", "", $cardMonth);
            $cardYear = str_replace(" ", "", $cardYear);
            $cardCvc = str_replace(" ", "", $cardCvc);
            $amountPayable = $transactionService->getpayableValue($invoiceEntity);
            if (! $amountPayable == 0 || ! isEmpty($amountPayable)) {
                $raveCardService->setAmount($amountPayable)
                    ->setCardNo($card)
                    ->setCardCvv($cardCvc)
                    ->setCardMonth($cardMonth)
                    ->setCardYear($cardYear)
                    ->setCurrency($invoiceEntity->getCurrency()
                    ->getCode())
                    ->setAmount($amountPayable)
                    ->setEmail($userEntity->getEmail())
                    ->setTxRef($invoiceEntity->getInvoiceUid() . "_" . str_replace(" ", "_", microtime()))
                    ->setIp(GeneralService::getClientIp());

                try {

                    $paymentResponse = $raveCardService->initiateCardPayment();
                    $generalSession->amountSent = $amountPayable;
                } catch (\Exception $e) {
                    // Call the error that it could not process the card and display
                    // Show a somewhat flash message
                    $response->add($this->failedpayment($e->getMessage()));
                } finally {
                    // if (! $paymentResponse instanceof \Exception && $paymentResponse != "") {
                    if ($paymentResponse == "PIN") {
                        
                        $pinCodeModal = $this->pinform();
                        $response->add($pinCodeModal);
                    } elseif ($paymentResponse == "AVS") {
                        // Perform AVS confirmation
                    } elseif ($paymentResponse == "NOAUTH") {
                        // No authorization required
                        // Assumed to be international card
                        // All authentication would nmade over the customers billiing address
                        $addressBilling = $this->cardbillingform();
                        $response->add($addressBilling);
                    } elseif ($paymentResponse == "OTP") {
                        $otpForm = $this->otpForm;
                        $otpForm->setAttributes(array(
                            "data-ajax-loader" => "myLoader",
                            "id" => "simpleForm",
                            "class" => "ajax_element form-horizontal form-label-left ajax_element",
                            "action" => $this->url()
                                ->fromRoute("cus_payment/default", array(
                                "action" => "processcardotp" 
                            ))
                        ));
                        $otpForm = $this->otpform($ravePaymentSession->chargeResponseMessage, $otpForm);
                        $response->add($otpForm);
                    } elseif ($paymentResponse == "VBV") {
                        // send vbv form
                    } elseif ($paymentResponse == TRUE) {
                        // No further validation is required
                        // Call confirmTransaction
                        $confirmRes = $raveCardService->confirmCardPayment();
                        if ($confirmRes == TRUE) {
                            $generalSession = $this->clientGeneralService->getGeneralSession();

                            $invoiceId = $generalSession->InvoiceId;
                            $request = $this->getRequest();
                            $userEntity = $this->identity();
                            $invoiceEntity = $em->find("Transactions\Entity\Invoice", $invoiceId);
                            $raveCardService->postpaymentmail($raveCardService->getRavePaymentSession(), $brokerEntity, $userEntity, $invoiceEntity, $clientGeneralService, $generalService);

                            $this->brokerPostTransactionmail($brokerEntity); // sends a mail to the broker and customer manager
                        }else{
                            // meaning a false was sent 
                            
                        }
                    }
                }
            } else {
                $response->add($this->failedpayment("Amount payable shouild be more than 10"));
            }
        }

        return $this->getResponse()->setContent($response);
    }

    private function validateCardData($cardNumber, $cardMonth, $cardYear, $cardCvc)
    {
        if (isEmpty($cardNumber) || isEmpty($cardMonth) || isEmpty($cardYear) || isEmpty($cardCvc)) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /**
     * This generate the bank tranfer request
     *
     * @return mixed
     */
    public function showbankformAction()
    {
        $clientGeneralService = $this->clientGeneralService;
        $em = $this->entityManager;
        $raveBankPaymentService = $this->raveBankPaymentService;
        $generalSession = $this->clientGeneralService->getGeneralSession();
        $bankPaymentForm = $this->bankPaymentForm;
        $brokerId = $clientGeneralService->getBrokerId();
        $invoiceId = $generalSession->InvoiceId;
        $request = $this->getRequest();
        $userEntity = $this->identity();
        if ($invoiceId == NULL) {
            $this->flashmessenger()->addErrorMessage("There is no invoice attached to the payment");
            $this->redirect()->toRoute("board/default", array(
                "action" => "transactions"
            ));
        }
        $invoiceEntity = $em->find("Transactions\Entity\Invoice", $invoiceId);

        $bankPaymentForm->setAttributes(array(
            "data-ajax-loader" => "myLoader",
            "id" => "simpleForm",
            "class" => "ajax_element form-horizontal form-label-left ajax_element",
            "action" => $this->url()
                ->fromRoute("cus_payment/default", array(
                "action" => "showbankform"
            ))
        ));

        $viewModel = new ViewModel(array(
            "bankPaymentForm" => $bankPaymentForm
        ));
        $viewModel->setTemplate("transaction_bank_payment_forme");
        $modal = new WasabiModal("standard", "Bank Transfer");
        $modal->setSize(WasabiModalConfigurator::MODAL_SM);
        $modal->setContent($viewModel);

        $modalView = new WasabiModalView("#wasabi", $this->rendrer, $modal);
        $response = new Response();
        $response->add($modalView);

        $request = $this->getRequest();
        if ($request->isPost()) {
            $post = $this->params()->fromPost();
            $ravePaymentSession = new Container("rave_payment_session");
            $bank = $post['bankPaymentFieldset']['bank'];
            $bankEntity = $em->find("Settings\Entity\NigeriaBanks", $bank);
            $accNumber = $post['bankPaymentFieldset']['accNumber'];
            $dob = $post['bankPaymentFieldset']['dob'];
            $redirecturl = $this->url()->fromRoute("board/default", array(
                "action" => "banksuccess"
            ), array(
                'force_canonical' => true
            ));
            $raveBankPaymentService->setAmount()
                ->setBank($bankEntity->getMoneyWaveCode())
                ->setAccountNumber($accNumber)
                ->setEmail($userEntity->getEmail())
                ->setPasscode()
                ->setPhoneNumber($userEntity->getUsername())
                ->setIp(GeneralService::getClientIp())
                ->setTxRef($invoiceEntity->getInvoiceUid() . "_" . microtime())
                ->setRedirect_url();
            // TODO process date of birth here

            try {
                $res = $raveBankPaymentService->initiateBankPayment();
            } catch (\Exception $e) {
                // throe the exception
            } finally {
                if ($res == "GTB" || $res == "FBN") {
                    $frame = $this->showIframe($ravePaymentSession->authUrl);
                    $response->add($frame);
                } elseif ($res == "OTP") {
                    $otpForm = $this->otpForm;
                    $otpForm->setAttributes(array(
                        "data-ajax-loader" => "myLoader",
                        "id" => "simpleForm",
                        "class" => "ajax_element form-horizontal form-label-left ajax_element",
                        "action" => $this->url()
                            ->fromRoute("board/default", array(
                            "action" => "otp" // while processing this, defaul settings
                                              // First identify if the call is account or card
                        ))
                    ));
                    $otpForm = $this->otpform($otpForm);
                    $response->add($otpForm);
                } elseif ($res == TRUE) {
                    $response->add($this->successpayment());
                } else {
                    $response->add($this->failedpayment());
                }
            }
        }

        return $this->getResponse()->setContent($response);
    }

    /**
     * This finalizes the initiate card process
     * Thorugh the pin verification
     * Sends PIN Code to the patment gateway
     */
    public function initiatecardAction()
    {
        $em = $this->entityManager;
        $raveCardService = $this->raveCardPaymentService;
        // $pinCodeForm = $this->pinCodeForm;
        $request = $this->getRequest();
        $respone = new Response();
        $res = "";
        if ($request->isPost()) {

            $post = $this->params()->fromPost();

            $pin = $post['pinCodeFieldset']['pin'];
            $pin = str_repeat(" ", "", $pin);
            $raveCardService->setPin($pin);
            try {
                $res = $raveCardService->pinConfirmation();
            } catch (\Exception $e) {
                // Display error from the the server
                // Not operaAtional error
                $respone->add($this->failedpayment("PIN CODE ERROR"));
            } finally {
                // If an error was indicated,
                // Show the error
                // Else show the otpForm

                if ($res == "OTP") {
                    $otpForm = $this->otpform();
                    $respone->add($otpForm);
                } elseif ($res == TRUE) {
                    // Show ajax flasmessenger that the card charge was successfull
                    $gritter = new GritterMessage();
                    // $gritter->setText("Successfully Pro")
                    // Inititate broker trnasfer here;
                    $successPayment = $this->successpayment();
                    $respone->add($successPayment);
                } else {
                    // Display there was an error requesting the otp
                    $errorPayment = $this->failedpayment("ERROR REQUESTING OTP");
                    $respone->add($errorPayment);
                }
            }
        }
    }

    /**
     * This Finalize international transaction
     * It sends the card Billing address to payment gateway
     *
     * @return mixed
     */
    public function initiatebillingAction()
    {
        $em = $this->entityManager;
        $raveCardService = $this->raveCardPaymentService;
        $ravePaymentSession = new Container("rave_payment_session");
        $request = $this->getRequest();
        $response = new Response();
        $redirecturl = $this->url()->fromRoute("board/default", array(
            "action" => "payment"
        ), array(
            'force_canonical' => true
        ));
        if ($request->isPost()) {
            // Process Billing information

            $post = $this->params()->fromPost();
            $billigFieldset = $post['cardBillingFieldset'];
            $cityEntity = $em->find("Settings\Entity\Zone", $billigFieldset['billingstate']);
            $countryEntity = $em->find("Settings\Entity\Country", $billigFieldset["billingcountry"]);
            $raveCardService->setBillingzip($this->cleanBillingData($billigFieldset['billingzip']))
                ->setBillingcity($this->cleanBillingData($billigFieldset['billingcity']))
                ->setBillingaddress($this->cleanBillingData($billigFieldset['billingaddress']))
                ->setBillingstate($cityEntity->getZoneName())
                ->setBillingcountry($countryEntity->getCountryName())
                ->setRedirect_url($redirecturl);
            try {
                $res = $raveCardService->avsConfirmation();
            } catch (\Exception $e) {
                $response->add($this->failedpayment("International Transaction Error"));
                // define the specific error
            } finally {
                // if() define instance of an object
                if ($res == TRUE) {
                    $response->add($this->successpayment());
                } elseif ($res == "AVS") {
                    $response->add($this->showIframe($ravePaymentSession->vbvUrl));
                } elseif ($res == "ERR") {
                    $errorPayment = $this->failedpayment("AVS verification error");
                    $response->add($errorPayment);
                }
            }
        }

        return $this->getResponse()->setContent($response);
    }

    /**
     * This function provides logic for showing a modal viewl
     * which permits a login frame for bank payment for either gtb or fbn
     *
     * @param string $link
     * @return mixed
     */
    private function showIframe($link)
    {
        $em = $this->entityManager;
        $viewModel = new ViewModel(array(
            "link" => $link
        ));
        $viewModel->setTemplate("general-modal-iframe-view");
        $modal = new WasabiModal("standard", "LOGIN");
        $modal->setContent($viewModel);

        $modalView = new WasabiModalView("#wasabi", $this->rendrer, $modal);
        return $modalView;
        // $response = new Response();
        // $response->add($modalView);
        // return $this->getResponse()->setContent($response);
    }

    public function paymenthook()
    {}

    /**
     * This cleans and escape data from the form
     *
     * @param string $data
     * @return string
     */
    private function cleanBillingData($data)
    {
        $data = trim($data);
        $escaper = new Escaper();
        $data = $escaper->escapeHtml($data);
        return $data;
    }

    private function cardbillingform()
    {
        $cardBillingForm = $this->cardBillingForm;
        $cardBillingForm->setAttributes(array(
            "data-ajax-loader" => "myLoader",
            "id" => "simpleForm",
            "class" => "ajax_element form-horizontal form-label-left ajax_element",
            "action" => $this->url()
                ->fromRoute("cus_payment/default", array(
                "action" => "initiatebilling"
            ))
        ));
        $viewModel = new ViewModel(array(
            "cardBillingForm" => $cardBillingForm
        ));
        $viewModel->setTemplate("transaction-card-billing-form");
        $modal = new WasabiModal("standard", "BILLING ADDRESS");
        $modal->setSize(WasabiModalConfigurator::MODAL_SM);
        $modal->setContent($viewModel);

        $modalView = new WasabiModalView("#wasabi", $this->rendrer, $modal);
        return $modalView;
    }

    /**
     * This substitue the card payment form with the Pin confirmation form
     *
     * @return \WasabiLib\Modal\WasabiModalView
     */
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

        $modalView = new WasabiModalView("#wasabi", $this->rendrer, $modal);
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

        $modalView = new WasabiModalView("#wasabi", $this->rendrer, $modal);
        // $response = new Response();
        // $response->add($modalView);
        return $modalView;
    }

    public function processcardotpAction()
    {
        $raveCardService = $this->raveCardPaymentService;
        $em = $this->entityManager;
        $generalService = $this->generalService;
        $clientGeneralService = $this->clientGeneralService;
        $response = new Response();
        // $viewModel = new ViewModel();
        // $viewModel->setTemplate("");
        $gritter = new GritterMessage();
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

                    if ($res) {
                        $response->add($this->successpayment());
                        $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $clientGeneralService->getBrokerId());
                        // Notify Broker and account Managers
                        // Provide details of the service being paid for
                        // Communicate the possible action to take
                        //
                        $this->brokerPostTransactionmail($brokerEntity);
                        // Send Emails for transaction
                    } else {
                        $response->add($this->failedpayment("Payment could not be verified"));
                    }
                }
            } else {
                $gritter->setTitle("EMPTY OTP");
                $gritter->setText("The OTP cannot be empty");
                $gritter->setType(GritterMessage::TYPE_ERROR);
                $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);

                $response->add($gritter);
            }
        }

        return $this->getResponse()->getContent($response);
    }

    private function brokerPostTransactionmail($brokerEntity)
    {
        $pointers = array();
        $pointers['to'] = $brokerEntity->getUser()->getEmail();
        $pointers["subject"] = "Successful Transaction";

        $template = array();
        $template["template"] = "";
        $template["var"] = array();

        $this->generalService->sendMails($pointers, $template);
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

        $modalView = new WasabiModalView("#wasabi", $this->rendrer, $modal);

        return $modalView;

        // $response = new Response();
        // $response->add($modalView);

        // return $this->getResponse()->setContent($response);
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

        $modalView = new WasabiModalView("#wasabi", $this->rendrer, $modal);

        return $modalView;

        // $response = new Response();
        // $response->add($modalView);

        // return $this->getResponse()->setContent($response);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        // TODO Auto-generated method stub
        return parent::indexAction();
    }

    /*
     * End Card processing
     */

    /**
     *
     * @return $entityManager
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }

    /**
     *
     * @return $cardPaymentForm
     */
    public function getCardPaymentForm()
    {
        return $this->cardPaymentForm;
    }

    /**
     *
     * @return $generalService
     */
    public function getGeneralService()
    {
        return $this->generalService;
    }

    /**
     *
     * @return $clientSession
     */
    public function getClientSession()
    {
        return $this->clientSession;
    }

    /**
     *
     * @return $clientGeneralService
     */
    public function getClientGeneralService()
    {
        return $this->clientGeneralService;
    }

    /**
     *
     * @return $transactionService
     */
    public function getTransactionService()
    {
        return $this->transactionService;
    }

    /**
     *
     * @return $customerBoardService
     */
    public function getCustomerBoardService()
    {
        return $this->customerBoardService;
    }

    /**
     *
     * @return $otpForm
     */
    public function getOtpForm()
    {
        return $this->otpForm;
    }

    /**
     *
     * @return $cardBillingForm
     */
    public function getCardBillingForm()
    {
        return $this->cardBillingForm;
    }

    /**
     *
     * @return $bankPaymentForm
     */
    public function getBankPaymentForm()
    {
        return $this->bankPaymentForm;
    }

    /**
     *
     * @return $pinCodeForm
     */
    public function getPinCodeForm()
    {
        return $this->pinCodeForm;
    }

    /**
     *
     * @return $cardPinForm
     */
    public function getCardPinForm()
    {
        return $this->cardPinForm;
    }

    /**
     *
     * @return $rendrer
     */
    public function getRendrer()
    {
        return $this->rendrer;
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
     * @param object $cardPaymentForm
     */
    public function setCardPaymentForm($cardPaymentForm)
    {
        $this->cardPaymentForm = $cardPaymentForm;

        return $this;
    }

    /**
     *
     * @param object $generalService
     */
    public function setGeneralService($generalService)
    {
        $this->generalService = $generalService;
        return $this;
    }

    /**
     *
     * @param object $clientSession
     */
    public function setClientSession($clientSession)
    {
        $this->clientSession = $clientSession;
        return $this;
    }

    /**
     *
     * @param object $clientGeneralService
     */
    public function setClientGeneralService($clientGeneralService)
    {
        $this->clientGeneralService = $clientGeneralService;
        return $this;
    }

    /**
     *
     * @param object $transactionService
     */
    public function setTransactionService($transactionService)
    {
        $this->transactionService = $transactionService;
        return $this;
    }

    /**
     *
     * @param object $customerBoardService
     */
    public function setCustomerBoardService($customerBoardService)
    {
        $this->customerBoardService = $customerBoardService;
        return $this;
    }

    /**
     *
     * @param object $otpForm
     */
    public function setOtpForm($otpForm)
    {
        $this->otpForm = $otpForm;
        return $this;
    }

    /**
     *
     * @param object $cardBillingForm
     */
    public function setCardBillingForm($cardBillingForm)
    {
        $this->cardBillingForm = $cardBillingForm;
        return $this;
    }

    /**
     *
     * @param object $bankPaymentForm
     */
    public function setBankPaymentForm($bankPaymentForm)
    {
        $this->bankPaymentForm = $bankPaymentForm;
        return $this;
    }

    /**
     *
     * @param object $pinCodeForm
     */
    public function setPinCodeForm($pinCodeForm)
    {
        $this->pinCodeForm = $pinCodeForm;
        return $this;
    }

    /**
     *
     * @param object $cardPinForm
     */
    public function setCardPinForm($cardPinForm)
    {
        $this->cardPinForm = $cardPinForm;
        return $this;
    }

    /**
     *
     * @param object $rendrer
     */
    public function setRendrer($rendrer)
    {
        $this->rendrer = $rendrer;
        return $this;
    }

    /**
     *
     * @return $paymentService
     */
    public function getPaymentService()
    {
        return $this->paymentService;
    }

    /**
     *
     * @param object $paymentService
     */
    public function setPaymentService($paymentService)
    {
        $this->paymentService = $paymentService;
        return $this;
    }

    /**
     *
     * @return $raveCardPaymentService
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

    public function getRaveBankPaymentService()
    {
        return $this->raveBankPaymentService;
    }

    public function setRaveBankPaymentService($set)
    {
        $this->raveBankPaymentService = $set;
        return $this;
    }

    /**
     *
     * @return object $redirect_url
     */
    public function getRedirect_url()
    {
        return $this->redirect_url;
    }

    /**
     *
     * @param object $redirect_url
     */
    public function setRedirect_url($redirect_url)
    {
        $this->redirect_url = $redirect_url;
        return $this;
    }
}

