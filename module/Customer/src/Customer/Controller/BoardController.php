<?php
namespace Customer\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Transactions\Service\PaymentService;
// use Zend\Session\Container;
use Claims\Entity\Claims;
use Claims\Service\ClaimsService;
use Transactions\Service\TransactionService;
// use Transactions\Entity\Transaction;
use Transactions\Entity\TransactionManualProcess;
use Transactions\Entity\PaymentCash;
use GeneralServicer\Entity\Notifications;
use Settings\Service\SettingsService;
use Transactions\Entity\PaymentTransfer;
use Transactions\Entity\PaymentBankDeposit;
use Zend\Session\Container;
use CsnUser\Service\UserService;
use Transactions\Entity\Transaction;
use Zend\Json\Json;
// use Transactions\Entity\PaystackResponse;
use Transactions\Entity\PaystackUserAutorizationCode;
use Transactions\Service\InvoiceService;
use WasabiLib\Modal\WasabiModal;
use WasabiLib\Ajax\Response;
use WasabiLib\Modal\WasabiModalView;
use WasabiLib\Ajax\InnerHtml;
use WasabiLib\Ajax\Redirect;
use WasabiLib\Modal\WasabiModalConfigurator;
use WasabiLib\Ajax\GritterMessage;

// use Proposal\Service\ProposalService;
// use Offer\Service\OfferService;
// use Packages\Service\AcquirePackagesService;

/**
 *
 * @author swoopfx
 *        
 */
class BoardController extends AbstractActionController
{

    private $entityManager;

    private $paymentForm;

    private $generalService;

    private $clientSession;

    private $clientGeneralService;

    private $transactionService;

    private $customerBoardService;

    private $editProfileForm;

    private $paymentService;

    private $moneyWaveService;

    private $paystackPaymentService;

    private $ravePaymentService;

    private $claimsPreForm;

    private $claimsService;

    private $manualProcessForm;

    private $mailService;

    private $otpForm;

    private $cardBillingForm;

    private $bankPaymentForm;

    // this form is for automated bank payment
    private $pinCodeForm;

    // this is the pin/password code
    private $cardPinForm;

    private $rendrer;

    public function onDispatch(\Zend\Mvc\MvcEvent $e)
    {
        $response = parent::onDispatch($e);
        $this->customerRedirectPlugin()->totalRedirection();
        $this->layout()->setTemplate('client-layout-board');
        return $response;
    }

    /**
     * Begin Modal
     */
    public function invoicepreviewmodalAction()
    {
        $em = $this->entityManager;
        $response = new Response();
        $invoiceId = $this->params()->fromQuery("data", NULL);
        // var_dump($this->centralBrokerId);
        if ($invoiceId == NULL) {
            $gritter = new GritterMessage();
            $gritter->setType(GritterMessage::TYPE_ERROR);
            $gritter->setText("Invoice ID not transmitted");
            $gritter->setTitle("Invoice Id Error");
            $response->add($gritter);
        } else {
            $invoiceEntity = $em->find("Transactions\Entity\Invoice", $invoiceId);
            $broker = $em->find("Users\Entity\InsuranceBrokerRegistered", $this->clientSession->brokerId);
            $viewModel = new ViewModel(array(
                "invoice" => $invoiceEntity,
                "broker" => $broker
            ));
            $viewModel->setTemplate("transaction-invoice-preview-snipet");
            $modal = new WasabiModal("standard", "Invoice Preview");
            $modal->setSize(WasabiModalConfigurator::MODAL_LG);
            $modal->setContent($viewModel);

            $modalView = new WasabiModalView("#wasabi", $this->rendrer, $modal);

            $response->add($modalView);
        }
        return $this->getResponse()->setContent($response);
    }

    /**
     * End Modal
     */

    /**
     * This function displays the document of from the customers point of view
     * In an iframe
     * Tgis can be accessed from any point in the customer page
     */
    public function displaydocAction()
    {
        $em = $this->entityManager;
        $id = $this->params()->fromQuery("data", NULL);
        $documentEntity = $em->find("GeneralServicer\Entity\Document", $id);
        $viewModel = new ViewModel(array(
            "doc" => $documentEntity
        ));
        $viewModel->setTemplate("general-modal-view-document");
        $modal = new WasabiModal("standard", "Document");
        $modal->setSize(WasabiModalConfigurator::MODAL_LG);
        $modal->setContent($viewModel);

        $modalView = new WasabiModalView("#wasabi", $this->rendrer, $modal);

        $response = new Response();
        $response->add($modalView);
        return $this->getResponse()->setContent($response);
    }

    /**
     * This action adds a card to the rave account
     * It notifies the user of a standar deduction of 50Naira as a confirmation
     * notifiy Of the security level
     * Notify of the customer data protection
     *
     * @return mixed
     */
    public function addcardAction()
    {
        $em = $this->entityManager;
        $paymentForm = $this->paymentForm;
        $paymentForm->get("submit")->setAttributes(array(
            "value" => "ADD CARD",
            'class' => "btn btn-block"
        ));
        $view = new ViewModel(array(
            "paymentForm" => $paymentForm
        ));

        $view->setTemplate("transaction-user-card-payment-modal-form");
        $modal = new WasabiModal("standard", "Add Card To Account");
        $modal->setContent($view);

        $modalView = new WasabiModalView("#wasabi", $this->rendrer, $modal);

        $response = new Response();
        $response->add($modalView);
        return $this->getResponse()->setContent($response);
    }

    /**
     * This function processes payment for the card on rave system
     *
     * @return mixed
     */
    public function tokenpaymentAction()
    {
        $response = new Response();
        return $this->getResponse()->setContent($response);
    }

    /**
     * Yhis function displays a modal form for the lay claims
     *
     * @return mixed
     */
    public function layclaimmodalAction()
    {
        $em = $this->entityManager;
        $claimsPreForm = $this->claimsPreForm;
        $claimsPreForm->setAttributes(array(
            "id" => "simpleForm",
            "class" => "form-horizontal form-label-left ajax_element",
            "data-ajax-loader" => "layClaimsSubmit",
            "action" => $this->url()
                ->fromRoute("board", array(
                "action" => "pre-claims"
            ))
        ));
        $viewModel = new ViewModel(array(
            "claimsPreForm" => $claimsPreForm
        ));
        $viewModel->setTemplate("customer_claims_lay_pre_claims_snippet");
        $modal = new WasabiModal("standard", "Initialize Claim");
        $modal->setContent($viewModel);

        $modalView = new WasabiModalView("#wasabi", $this->rendrer, $modal);

        $response = new Response();
        $response->add($modalView);
        return $this->getResponse()->setContent($response);
    }

    /**
     * This function provides logic for showing a modal viewl
     * which permits a login frame for bank payment for either gtb or fbn
     *
     * @param string $link
     * @return mixed
     */
    private function showModalIframe($link)
    {
        $em = $this->entityManager;
        $viewModel = new ViewModel(array(
            "link" => $link
        ));
        $viewModel->setTemplate("general-modal-iframe-view");
        $modal = new WasabiModal("standard", "LOGIN");
        $modal->setContent($viewModel);

        $modalView = new WasabiModalView("#wasabi", $this->rendrer, $modal);

        $response = new Response();
        $response->add($modalView);
        return $this->getResponse()->setContent($response);
    }

    /**
     * This shows an OTP form which would be processed by the action parameters provided
     *
     * @param string $action
     */
    private function showModalOtpForm($action)
    {
        $otpForm = $this->otpForm;
        $otpForm->setAttributes(array(
            "data-ajax-loader" => "myLoader",
            "id" => "simpleForm",
            "class" => "ajax_element form-horizontal form-label-left ajax_element",
            "action" => $this->url()
                ->fromRoute("board/default", array(
                "action" => $action
            ))
        ));
        $viewModel = new ViewModel(array(
            "otpForm" => $otpForm
        ));
        $viewModel->setTemplate("transaction_otp-form-snippet");
        $modal = new WasabiModal("standard", "ENTER  OTP");

        $modalView = new WasabiModalView("#wasabi", $this->rendrer, $modal);
        $response = new Response();
        $response->add($modalView);
    }

    /**
     * This action makes sure all bank payment process is finalized
     * Once it is called, it gets all hidden variable defined in a session
     * and processes the invoice
     * It also finalized the notification of the broker of payment made and what channel
     * It changes the status of the invoice based on the status micro or not
     *
     * @return mixed
     */
    public function gtbfbnredirectionprocessAction()
    {
        return $this->getResponse()->setContent(NULL);
    }

    public function initiatebankmodalAction()
    {
        $em = $this->entityManager;
        $bankPaymentForm = $this->bankPaymentForm;
        $transactionService = $this->transactionService;
        $ravePaymentService = $this->ravePaymentService;
        $clientGeneralService = $this->clientGeneralService;
        $otpForm = $this->otpForm;
        $otpForm->setAttributes(array(
            "data-ajax-loader" => "myLoader",
            "id" => "simpleForm",
            "class" => "ajax_element form-horizontal form-label-left ajax_element",
            "action" => $this->url()
                ->fromRoute("board/default", array(
                "action" => "otpmodal"
            ))
        ));
        $request = $this->getRequest();

        $userEntity = $this->identity();
        $generalSession = $this->clientGeneralService->getGeneralSession();
        $generalService = $this->clientGeneralService->getGeneralService();

        /**
         * Get invoice Entity
         *
         * @var string $invoiceId
         */
        $invoiceId = $generalSession->InvoiceId;
        if ($invoiceId == NULL) {
            $this->flashmessenger()->addErrorMessage("There is no invoice attached to the payment");
            $this->redirect()->toRoute("board/default", array(
                "action" => "transactions"
            ));
        }

        $invoiceEntity = $em->find("Transactions\Entity\Invoice", $invoiceId);
        if ($request->isPost()) {
            $data = $request->getPost();
            $bankPaymentForm->setData($data);

            $amount = "";
            if ($invoiceEntity->getIsMicro() == TRUE) {
                $payable = $transactionService->getpayableAmount($invoiceEntity);
                $amount = $payable->getValue();
            } else {
                $amount = $invoiceEntity->getAmount();
            }

            if ($bankPaymentForm->isValid()) {
                $gotData = $bankPaymentForm->getData();
                $ip = $generalService->getClientIp();

                $generalSession->amountPayed = $amount;

                $ravePaymentService->setBank($gotData["bankPaymentFieldset"]["bank"])
                    ->setAccountNumber($gotData["bankPaymentFieldset"]["bank"])
                    ->setCurrency($invoiceEntity->getCurrency()
                    ->getCode())
                    ->setAmount($amount)
                    ->setEmail($userEntity->getEmail())
                    ->setPhonenumber($userEntity->getUsername())
                    ->setIp($ip)
                    ->setFirtname()
                    ->setLastname()
                    ->setTxRef($invoiceEntity->getInvoiceUid() . "_" . microtime());
                try {
                    $res = $ravePaymentService->initiateBankPayment();
                    if ($res == "GTB") {
                        $this->showModalIframe($ravePaymentService->authUrl);
                    } elseif ($res == "FBN") {
                        $this->showModalIframe($ravePaymentService->authUrl);
                    } elseif ($res == "OTP") {
                        $this->showModalOtpForm("otpbankmodal");
                    } else {
                        // At this point everything worked fine
                    }
                } catch (\Exception $e) {
                    $this->flashmessenger()->addErrorMessage("There was a problem initiating, and charging the bank account");
                    $redirect = new Redirect($this->url()->fromRoute("board/default", array(
                        "action" => "payment"
                    )));

                    $response = new Response();
                    $response->add($redirect);

                    return $this->getResponse()->setContent($response);
                }
            }
        }
        $response = new Response();

        return $this->getResponse()->setContent($response);
    }

    /**
     * This function initiates the payment request on rave payment
     * for card Payment
     * View is previewd on a modal plane
     *
     * @return mixed
     */
    public function initiatepaymentmodalAction()
    {
        $em = $this->entityManager;
        $transactionService = $this->transactionService;
        $clientGeneralService = $this->clientGeneralService;
        $paymentForm = $this->paymentForm;
        $pinCodeForm = $this->pinCodeForm;
        $pinCodeForm->setAttributes(array(
            "data-ajax-loader" => "myLoader",
            "id" => "simpleForm",
            "class" => "ajax_element form-horizontal form-label-left ajax_element",
            "action" => $this->url()
                ->fromRoute("board/default", array(
                "action" => "cardpincodemodal"
            ))
        ));
        // $invoiceEntity = "";
        $ravePaymentService = $this->ravePaymentService;
        $request = $this->getRequest();
        $userEntity = $this->identity();
        $generalSession = $this->clientGeneralService->getGeneralSession();
        $generalSession->savecc = FALSE;

        /**
         * Get invoice Entity
         *
         * @var string $invoiceId
         */
        $invoiceId = $generalSession->InvoiceId;
        if ($invoiceId == NULL) {
            $this->flashmessenger()->addErrorMessage("There is no invoice attached to the payment");
            $this->redirect()->toRoute("board/default", array(
                "action" => "transactions"
            ));
        }

        $invoiceEntity = $em->find("Transactions\Entity\Invoice", $invoiceId);

        /**
         * if Inovice is paid for redirect to all invoice page with a notification
         * Invoice has been paid for
         */
        if ($invoiceEntity->getStatus()->getId() == InvoiceService::INVOICE_PAID_STATUS) {
            $this->flashmessenger()->addSuccessMessage("Invoice is paid for");
            $this->redirect()->toRoute("cus_invoice");
        }
        $brokerId = $clientGeneralService->getBrokerId();

        $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $brokerId);
        $generalService = $this->clientGeneralService->getGeneralService();

        if ($request->isPost()) {
            $data = $request->getPost();
            $paymentForm->setData($data);
            $paymentForm->setValidationGroup(array(
                // "csrf",
                "card_payment" => array(
                    "cc_name",
                    "cc_number",
                    "cc_month",
                    "cc_year",
                    "cc_cvc",
                    "save_cc"
                    // "cc_pin"
                )
            ));

            if ($paymentForm->isValid()) {
                if ($paymentForm['card_payment']['save_cc'] == TRUE) {
                    $generalSession->savecc = TRUE;
                }
                $amount = "";
                if ($invoiceEntity->getIsMicro() == TRUE) {
                    $payable = $transactionService->getpayableAmount($invoiceEntity);
                    $amount = $payable->getValue();
                } else {
                    $amount = $invoiceEntity->getAmount();
                }

                $cardNumber = $data['card_payment']['cc_number'];

                $card = str_replace(" ", "", $cardNumber);
                $cardCvc = $data['card_payment']['cc_cvc'];
                $month = $data['card_payment']['cc_month'];
                $year = $data['card_payment']['cc_year'];
                $currency = $invoiceEntity->getCurrency()->getCode();
                $email = $userEntity->getEmail();
                $ip = $generalService->getClientIp();
                $txRef = $invoiceEntity->getInvoiceUid() . "_" . microtime();

                $generalSession->amountSent = $amount;

                $ravePaymentService->setCardNo($card)
                    ->setCardDvv($cardCvc)
                    ->setAmount($amount)
                    ->setCurrency($invoiceEntity->getCurrency()
                    ->getCode())
                    ->setEmail($email)
                    ->setIp($ip)
                    ->setTxRef($txRef)
                    ->setCardMonth($month)
                    ->setCardYear($year);
                try {
                    $res = $ravePaymentService->initiateCardPayment();

                    if ($res == "PIN") { // If the confirmation notification is Pin show the PIN form
                        $viewModel = new ViewModel(array(
                            "pinCodeForm" => $pinCodeForm
                        ));

                        $viewModel->setTemplate("customer-board-change-login-pin-form");

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
                                ->fromRoute("board/default", array(
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
                    } else { // This is the VBV suggested authorization
                             // Display an iframe form here
                    }
                } catch (\Exception $e) {
                    // display an error dialog box showing the actual error generated
                }
            }

            // $ravePaymentService->setCardNo($post[])
        }

        // $content = new Response();
        // $content->add($object)
        // return $this->getResponse()->setContent($content);
    }

    /**
     * This is the main function that process the cardpincode
     * And shows the necessary Validation form i.e the One time password form
     *
     * @return mixed
     */
    public function cardpincodemodalAction()
    {
        $em = $this->entityManager;
        $otpForm = $this->otpForm;
        $otpForm->setAttributes(array(
            "data-ajax-loader" => "myLoader",
            "id" => "simpleForm",
            "class" => "ajax_element form-horizontal form-label-left ajax_element",
            "action" => $this->url()
                ->fromRoute("board/default", array(
                "action" => "otpmodal"
            ))
        ));
        $ravePaymentService = $this->ravePaymentService;
        $request = $this->getRequest();

        if ($request->isPost()) {
            $post = $this->params()->fromPost();
            // $otp = $post['otp'];

//             $pin = "";
            $ravePaymentService->setCardPin($pin);

            try {
                $res = $ravePaymentService->confirmCardPayment();
                if ($res == "OTP") { // Requires a onetime password
                    $viewModel = new ViewModel(array(
                        "otpForm" => $otpForm
                    ));
                    $viewModel->setTemplate("transaction_otp-form-snippet");
                    $modal = new WasabiModal("standard", "ENTER  OTP");

                    $modalView = new WasabiModalView("#wasabi", $this->rendrer, $modal);
                    $response = new Response();
                    $response->add($modalView);

                    return $this->getRequest()->setContent($response);
                } elseif ($res == TRUE) { // Successfully chrged the card without any otp required
                                          // display a dialog indicating successful deduction of the said amount
                                          // call The transfer request here
                }
            } catch (\Exception $e) {

                // display an error dialog box showing the actual error generated
            }
        }
    }

    /**
     * This functon processes the international master and visa card,
     * Such that the billing address is sent to the server
     * the function processes the information sent to the server
     *
     * @return mixed
     */
    public function cardbillingmodalAction()
    {
        $em = $this->entityManager;
        $ravePaymentService = $this->ravePaymentService;
        $request = $this->getRequest();
        if ($request->isPost()) {
            $post = $this->params()->fromPost();
            $res = $ravePaymentService->confirmCardPayment();
            if ($res == TRUE) {
                // verify transaction at this point
            } elseif ($res == "AVS") {
                // redirect to iframe
            }
        }
        $response = new Response();
        return $this->getResponse()->setContent($response);
    }

    /**
     * This function process otp for bank transfer
     * It take the otp sent to the customer, processes it and notify broker
     * Provided it waas successful
     * or throws an exception if not successful
     *
     * @return mixed
     */
    public function otpbankmodalAction()
    {
        $em = $this->entityManager;
        $ravePaymentService = $this->ravePaymentService;
        $request = $this->getRequest();
        $clientGeneralService = $this->clientGeneralService;
        $brokerId = $clientGeneralService->getBrokerId();
        $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $brokerId);
        $brokerBankAccEntity = $brokerEntity->getBankAccount();
        if ($request->isPost()) {
            $post = $this->params()->fromRoute();
            $otp = $post['otp'];
            try {
                // Validate through OTP sent to the customer
                $ravePaymentService->setOtp($otp);
                $res = $ravePaymentService->otpbankValidate();
                // verify payment
                // and transfer the calculalet amount

                if ($res == TRUE) {
                    // Initiate Transfer
                    $ravePaymentService->setTransferBank($brokerBankAccEntity[0]->getBankName()
                        ->getMoneyWaveCode())
                        ->setTransferAcc($brokerBankAccEntity[0]->getBankAccountNo())
                        ->setTransferAmount($ravePaymentService->calculateTransferAmount()); // this is after a deduction of 3% and N100
                    $ravePaymentService->raveTransfer();

                    $this->flashmessenger()->addSuccessMessage("We have successfully charged your bank account");
                    $redirect = new Redirect($this->url()->fromRoute("board/default", array(
                        "action" => "payment"
                    )));
                    $response = new Response();
                    $response->add($redirect);

                    return $this->getResponse()->setContent($response);
                }
            } catch (\Exception $e) {
                $this->flashmessenger()->addErrorMessage("We had problem charging your bank account");
                $redirect = new Redirect($this->url()->fromRoute("board/default", array(
                    "action" => "payment"
                )));
                $response = new Response();
                $response->add($redirect);
                return $this->getResponse()->setContent($response);
            }
        }
        // $status = "";
        // $response = new Response();
        // $response->add($status);

        // return $this->getResponse()->setContent($response);
    }

    /**
     * This is a card payment OTP confirmation
     * This funcction proceses the sent otp and provides result
     * This assumes the final stage of the local card processing
     * @deprecated
     * @return mixed
     */
    public function otpmodalAction()
    {
        $ravePaymentService = $this->ravePaymentService;
        $generalSession = $this->clientGeneralService->getGeneralSession();

        $request = $this->getRequest();
        if ($request->isPost()) {
            $post = $this->params()->fromRoute();
            $otp = $post['otp'];
            try {
                $ravePaymentService->setOtp($otp);
                $res = $ravePaymentService->validateCardPayment();

                if ($res == TRUE) {
                    // Verify the transaction
                    // And Redirect
                    $verRes = $ravePaymentService->verifyCardPayment();
                    if ($generalSession->savecc == TRUE) { // save the card if customer decides to save card
                        $ravePaymentService->saveCard($this->identity());
                    }

                    if ($verRes == TRUE) { // meaning the verification was successful
                                           // redirect to the payment page
                        $this->flashmessenger()->addSuccessMessage("Transaction Successful");
                        $redirect = new Redirect($this->url()->fromRoute("board/default", array(
                            "action" => "payment"
                        )));
                        $response = new Response();
                        $response->add($redirect);

                        return $this->getResponse()->setContent($response);
                    }
                }
            } catch (\Exception $e) {
                $this->flashmessenger()->addErrorMessage($e->getMessage());
                $redirect = new Redirect($this->url()->fromRoute("board/default", array(
                    "action" => "payment"
                )));
                $response = new Response();
                $response->add($redirect);
                return $this->getResponse()->setContent($response);
            }
        }
        $status = "";
        $response = new Response();
        $response->add($status);

        return $this->getResponse()->setContent($response);
    }

    // End of payment Login

    /**
     * This function displays the customer profile
     *
     * @return \Zend\View\Model\ViewModel
     */
    public function profileAction()
    {
        $em = $this->entityManager;
        $editProfileForm = $this->editProfileForm;
        $pinCodeForm = $this->pinCodeForm;
        // var_dump($pinCodeForm);
        $request = $this->getRequest();
        $clientGeneralService = $this->clientGeneralService;
        $customerEntity = $em->find("Customer\Entity\Customer", $clientGeneralService->getCustomerId());
        $editProfileForm->bind($customerEntity);
        $pinCodeForm->setAttributes(array(
            "action" => $this->url()
                ->fromRoute("board/default", array(
                "action" => "repin"
            )),
            "method" => "POST"
        ));

        $view = new ViewModel(array(
            "customerEntity" => $customerEntity,
            "editProfileForm" => $editProfileForm,
            "pinCodeForm" => $pinCodeForm
        ));
        return $view;
    }

    /**
     * Tis provides a function for creating another pin code
     *
     * @return mixed
     */
    public function repinAction()
    {
        $em = $this->entityManager;
        $generalService = $this->generalService;
        $userEntity = $this->identity();
        $brokerId = $this->clientGeneralService->getBrokerId();
        $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $brokerId);
        $response = new Response();
        $pincodeForm = $this->pinCodeForm;
        $request = $this->getRequest();
        if ($request->isPost()) {
            $post = $request->getPost();
            $pincodeForm->setData($post);
            $pincode = $post['pinCodeFieldset']['pin'];

            // if($pincodeForm->isValid()){
            $userEntity->setUpdatedOn(new \DateTime())->setPassword(UserService::encryptPassword($pincode));
            $message['to'] = $userEntity->getEmail();
            $message['fromName'] = $brokerEntity->getCompanyName();
            $message['subject'] = "PINCODE CHANGED";

            $template = array();

            $template['var'] = array(
                "logo" => $this->clientGeneralService->getBrokerLogo(),
                "title" => "PINCODE CHANGED",
                "message" => "PIN Code has been successfully changed",
                "broker" => $brokerEntity->getCompanyName()
            );
            $template['template'] = "general-customer-default-mail";
            $generalService->sendMails($message, $template);
            try {

                $em->persist($userEntity);
                $em->flush();

                $this->flashmessenger()->addSuccessMessage("Pin Code Successfully changed");

                $rediect = new Redirect($this->url()->fromRoute("board/default", array(
                    "action" => "profile"
                )));
                $response->add($rediect);
                return $this->getResponse()->setContent($response);
            } catch (\Exception $e) {
                $this->flashmessenger()->addErrorMessage("There was a problem changing your pin");

                $rediect = new Redirect($this->url()->fromRoute("board/default", array(
                    "action" => "profile"
                )));
                $response->add($rediect);
                return $this->getResponse()->setContent($response);
            }
            // }else{
            // $this->flashmessenger()->addErrorMessage("The input entered is not valid");
            // $this->redirect()->toRoute("board/default", array("action"=>"profile"));
            // }
        }
        $viewModel = new ViewModel(array(
            "pinCodeForm" => $pincodeForm
        ));
        $viewModel->setTemplate("customer-board-change-login-pin-form");

        $modal = new WasabiModal("standard", "RESET PIN");
        $modal->setContent($viewModel);

        $modalView = new WasabiModalView("#wasabi", $this->rendrer, $modal);
        $response = new Response();
        $response->add($modalView);

        return $this->getResponse()->setContent($response);
    }

    public function dashboardAction()
    {
        $clientGeneralService = $this->clientGeneralService;
        $customerBoardService = $this->customerBoardService;
        $claimsPreForm = $this->claimsPreForm;
        $claimsPreForm->setAttributes(array(
            "action" => $this->url()
                ->fromRoute("board", array(
                "action" => "pre-claims"
            ))
        ));
        $customerMessages = NULL;
        $proposals = $customerBoardService->customerProposals();
        $activeOffer = $customerBoardService->customerOffer();
        $unsettledClaims = $customerBoardService->customerClaims();
        $coverNote = $customerBoardService->customerCoverNote();
        // var_dump($this->clientSession->brokerId);
        $myPolicy = $customerBoardService->customerPolicy();

        $invoices = $customerBoardService->customerInvoices();
        $activePackages = $customerBoardService->customerActivePackage();
        // var_dump($activePackages[0]->getPackages());
        // var_dump($activeOffer);

        $view = new ViewModel(array(
            // 'messages'=>$customerMessages
            'activeOffer' => $activeOffer,
            'proposals' => $proposals,
            'claims' => $unsettledClaims,
            'policy' => $myPolicy,
            'invoices' => $invoices,
            'activePackage' => $activePackages,
            "claimsPreForm" => $claimsPreForm,
            "coverNote" => $coverNote
        ));
        return $view;
    }

    public function editprofileAction()
    {
        $em = $this->entityManager;
        $response = new Response();
        $editProfileForm = $this->editProfileForm;
        $editProfileForm->setAttributes(array(
            "id" => "simpleForm",
            "class" => "form-horizontal form-label-left ajax_element",
            "data-ajax-loader" => "myLoader",
            "action" => $this->url()
                ->fromRoute("board/default", array(
                "action" => "editprofile"
            ))
        ));
        $clientGeneralService = $this->clientGeneralService;
        $customerEntity = $em->find("Customer\Entity\Customer", $clientGeneralService->getCustomerId());
        $editProfileForm->bind($customerEntity);

        $request = $this->getRequest();
        if ($request->isPost()) {
            $post = $request->getPost();
            // var_dump($post);
            $editProfileForm->setData($post);
            $editProfileForm->setValidationGroup(array(
                "csrf",
                "customerFieldset" => array(
                    "name",
                    "address1",
                    'address2',
                    'city',
                    'state',
                    "country"
                )
            ));
            if ($editProfileForm->isValid()) {

                $customerEntity->setUpdatedOn(new \DateTime());

                try {
                    $em->persist($customerEntity);
                    $em->flush();
                    $this->flashmessenger()->addSuccessMessage("Your profile has been edited");
                    // $this->redirect()->toRoute("board/default", array(
                    // "action" => "profile"
                    // ));

                    $redirect = new Redirect($this->url()->fromRoute("board/default", array(
                        "action" => "profile"
                    )));

                    $response->add($redirect);
                    return $this->getResponse()->setContent($response);
                } catch (\Exception $e) {
                    $this->flashmessenger()->addErrorMessage("There was a problem eidting your profile");
                    // $this->redirect()->toRoute("board/default", array(
                    // "action" => "profile"
                    // ));
                    $redirect = new Redirect($this->url()->fromRoute("board/default", array(
                        "action" => "profile"
                    )));
                    $response->add($redirect);
                    return $this->getResponse()->setContent($response);
                }
            }
        }

        $viewModel = new ViewModel(array(
            "editProfileForm" => $editProfileForm
        ));
        $viewModel->setTemplate("customer-board-edit-profile-form");
        $modal = new WasabiModal("standard", "Edit My Profile");
        $modal->setContent($viewModel);

        $modalView = new WasabiModalView("#wasabi", $this->rendrer, $modal);
        $response->add($modalView);
        return $this->getResponse()->setContent($response);
    }

    /**
     * This processes the otp sent to the server
     *
     * @return mixed
     */
    // public function otpAction()
    // {
    // $em = $this->entityManager;
    // $moneyWaveService = $this->moneyWaveService;
    // $transactionService = $this->transactionService;
    // $clientGeneralService = $this->clientGeneralService;
    // $generalSession = $this->clientGeneralService->getGeneralSession();
    // $invoiceId = $generalSession->InvoiceId;
    // $response = new Response();
    // $otpForm = $this->otpForm;
    // $request = $this->getRequest();
    // if ($request->isPost()) {
    // $post = $this->params()->fromPost();
    // $otpForm->setData($post);
    // if ($otpForm->isValid()) {
    // $moneyWaveService->setOtp($post["otp"]);
    // $response = $moneyWaveService->sendOtp();
    // if ($response['status'] == TRUE) {
    // $res = $response['response'];
    // $body = Json::decode($res->getBody());
    // if ($body->status == "success" && ($body->data->transfer->flutterChargeResponseCode == "00" || $body->data->transfer->flutterChargeResponseCode == "0")) { // Needs card validation
    // // call successful transaction

    // $transact = $transactionService->transactionSuccess(); // This encompases sending mail and changing the neccesary invoice and micro payment mail
    // if ($transact != False) {
    // $redirect = new Redirect($this->url()->fromRoute("cus_transact/default", array(
    // "action" => "view",
    // "id" => $transact
    // ))); // complete redirection to the present invoice

    // $response->add($redirect);
    // }
    // } else {
    // $redirect = new Redirect($this->url()->fromRoute("board/default", array(
    // "action" => "payment"
    // ))); // complete redirection to the present invoice
    // $response->add($redirect);
    // }
    // }
    // }
    // }

    // return $this->getResponse()->setContent($response);
    // }

    // /**
    // * This function is called on a direct charge to account
    // * It DIrectly charges a card by a customer entiering the card details
    // * and credites the neccesary broker
    // * In modal view
    // */
    // public function directchargeAction()
    // {
    // $em = $this->entityManager;
    // $paymentForm = $this->paymentForm;
    // $moneyWaveService = $this->moneyWaveService;
    // $transactionService = $this->transactionService;
    // $clientGeneralService = $this->clientGeneralService;
    // $generalSession = $this->clientGeneralService->getGeneralSession();
    // $invoiceId = $generalSession->InvoiceId;
    // $response = new Response();

    // $request = $this->getRequest();

    // // $moneyWaveService->setAmount();

    // // If invoice Id is empty
    // // Redirect to transactions page
    // if ($invoiceId == NULL) {
    // $this->flashmessenger()->addErrorMessage("There is no invoice attached to the payment");
    // $this->redirect()->toRoute("cus_invoice/default", array(
    // "action" => "transactions"
    // ));

    // $redirect = new Redirect($this->url()->fromRoute("cus_invoice"));
    // $response->add($redirect);
    // }
    // // generate ther invoice Entity
    // $invoiceEntity = $em->find("Transactions\Entity\Invoice", $invoiceId);

    // /**
    // * if Inovice is paid for redirect to all invoice page with a notification
    // * Invoice has been paid for
    // */
    // if ($invoiceEntity->getStatus()->getId() == InvoiceService::INVOICE_PAID_STATUS) {
    // $this->flashmessenger()->addSuccessMessage("Invoice is paid for");
    // $this->redirect()->toRoute("cus_invoice");
    // }
    // $brokerId = $clientGeneralService->getBrokerId();
    // $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $brokerId);
    // if ($request->isPost()) {
    // $post = $this->params()->fromPost();
    // $paymentForm->setData($post);
    // $paymentForm->setValidationGroup(array(
    // "card_payment" => array(
    // // "cc_name",
    // "cc_number",
    // 'cc_month',
    // "cc_year",
    // "cc_cvc",
    // "cc_pin"
    // ),
    // "csrf"

    // ));

    // if ($paymentForm->isValid()) {
    // $data = $paymentForm->getData();
    // $microPayEntity = $transactionService->getpayableAmount($invoiceEntity);

    // $amount = "";
    // if ($invoiceEntity->getIsMicro() == FALSE) {
    // $amount = $invoiceEntity->getAmount();
    // } else {
    // $amount = $microPayEntity->getValue();
    // }

    // // Get Customer Name From Customer Session
    // $customerEntity = $em->find("Customer\Entity\Customer", $clientGeneralService->getCustomerId());

    // // $otpSession = new Container("otp_session");
    // // $otpSession->setExpirationSeconds(60 * 10);

    // $this_moneywave_session = new Container("this_moneywave_session"); // This session defines the present activated payment session
    // $this_moneywave_session->setExpirationSeconds(60 * 10);
    // $brokerBankAccounts = $brokerEntity->getBrokerBankAccount();

    // $defaultAccount = $brokerBankAccounts[0];

    // // var_dump($moneyWaveService->calculateAmountPayable($amount));
    // // Charge the card
    // $moneyWaveService = $this->moneyWaveService;
    // $moneyWaveService->setAmount($amount)
    // ->setCvc($data->getCcCvc())
    // ->setPin($data->getPin())
    // ->setExpireMonth($data->getCcMonth())
    // ->setExpireYear($data->getCcYear())
    // ->setCardName($customerEntity->getName())
    // ->setCardNo($data->getCcNumber())
    // ->setRecipientsAcc($defaultAccount->getBankAccountNo())
    // ->setMoneyWaveBankCode($defaultAccount->getBankName()
    // ->getMoneyWaveCode())
    // ->setNarration("");
    // // Receive Response

    // try {
    // $response = $moneyWaveService->sendMoney(); // calls money sent to moneywave engine
    // if ($response['status'] == TRUE) {
    // $res = $response['response'];
    // $body = Json::decode($res->getBody());
    // $this_moneywave_session->moneyWaveRespose = $body;

    // if ($body->status == "success" && $body->data->transfer->flutterChargeResponseCode == "02") { // Needs card validation
    // $moneyWaveService->setMoneyWaveResponse($body); // TODO finalize this logic
    // $moneyWaveService->moneyWaveSuccess();
    // $this_moneywave_session->ref = $body->data->transfer->flutterChargeReference; // transaction reference
    // if ($body->data->transfer->meta->chargeMethod == "VBVSECURECODE") { // defines if the authorization is a VBVSECURECODE

    // /**
    // * TODO please fix on logic required
    // * If the charge method is VBVSECURECODE
    // * The card system returns a modal with processing
    // * and awaits the response from the engine
    // */
    // } else { // this defines a OTP charge method
    // $otpForm = $this->otpForm;
    // $otpForm->setAttributes(array(
    // "id" => "simpleForm",
    // "class" => "form-horizontal form-label-left ajax_element",
    // "data-ajax-loader" => "myLoader",
    // "action" => $this->url()
    // ->fromRoute("board/default", array(
    // "action" => "otp"
    // ))
    // ));
    // $viewModel = new ViewModel(array(
    // "otpForm" => $otpForm
    // ));
    // $viewModel->setTemplate("transaction_otp-form-snippet");
    // $modal = new WasabiModal("standard", "Enter OTP");
    // $modal->setContent($viewModel);

    // $modalView = new WasabiModalView("#wasabi", $this->rendrer, $modal);
    // $response->add($modalView);
    // }
    // } elseif ($body->status == "success" && ($body->data->transfer->flutterChargeResponseCode == "00" || $body->data->transfer->flutterChargeResponseCode == "0")) { // a direct debit was made without verification

    // $transact = $transactionService->transactionSuccess(); // This encompases sending mail and changing the neccesary invoice and micro payment mail
    // if ($transact != False) { // Meaning the transaction entity was successful
    // $redirect = new Redirect($this->url()->fromRoute("cus_transact/default", array(
    // "action" => "view",
    // "id" => $transact
    // )));
    // // complete redirection to the present invoice

    // $response->add($redirect);
    // }
    // } else {
    // $viewModel = new ViewModel(array(
    // "error" => $body->message
    // ));
    // $viewModel->setTemplate("transaction-modal-payment-error");
    // $modal = new WasabiModal("standard", "Payment Error");
    // $modal->setContent($viewModel);

    // $modalView = new WasabiModalView("#wasabi", $this->rendrer, $modal);
    // $response->add($modalView);
    // }
    // }
    // } catch (\Exception $e) {
    // $viewModel = new ViewModel(array(
    // "error" => $e->getMessage()
    // ));
    // $viewModel->setTemplate("transaction-modal-payment-error");
    // $modal = new WasabiModal("standard", "Payment Error");
    // $modal->setContent($viewModel);

    // $modalView = new WasabiModalView("#wasabi", $this->rendrer, $modal);
    // $response->add($modalView);
    // }
    // }
    // }

    // return $this->getResponse()->setContent($response);
    // }
    public function paymentAction()
    {
        $em = $this->entityManager;
        $paymentForm = $this->paymentForm;
        $bankPaymentForm = $this->bankPaymentForm;
        $paymentForm->setAttributes(array(
            "id" => "simpleForm",
            // "class" => "form-horizontal form-label-left ajax_element",
            "data-ajax-loader" => "myLoader",
            "action" => $this->url()
                ->fromRoute("board/default", array(
                "action" => "directcharge"
            ))
        ));
        $userEntity = $this->identity();

        $otpForm = $this->otpForm;
        $cardPinForm = $this->cardPinForm;
        $paystackPaymentSession = new Container("paystack_payment_session");
        $paystackPaymentSession->setExpirationSeconds(60 * 10);
        $paymentSession = new Container("paymentSession");
        $paymentSession->setExpirationSeconds(60 * 30);
        $paymentService = $this->paymentService;
        $paystackPaymentService = $this->paystackPaymentService;
        $manualProcessForm = $this->manualProcessForm;
        $manualProcessForm->setAttributes(array(
            "action" => $this->url()
                ->fromRoute("board/default", array(
                "action" => "manual-process"
            ))
        ));
        $clientGeneralService = $this->clientGeneralService;
        $request = $this->getRequest();
        $generalSession = $this->clientGeneralService->getGeneralSession();
        $invoiceId = $generalSession->InvoiceId;
        if ($invoiceId == NULL) {
            $this->flashmessenger()->addErrorMessage("There is no invoice attached to the payment");
            $this->redirect()->toRoute("board/default", array(
                "action" => "transactions"
            ));
        }

        $invoiceEntity = $em->find("Transactions\Entity\Invoice", $invoiceId);
        // var_dump($this->transactionService->getpayableValue($invoiceEntity));

        /**
         * if Inovice is paid for redirect to all invoice page with a notification
         * Invoice has been paid for
         */
        if ($invoiceEntity->getStatus()->getId() == InvoiceService::INVOICE_PAID_STATUS) {
            $this->flashmessenger()->addSuccessMessage("Invoice is paid for");
            $this->redirect()->toRoute("cus_invoice");
        }
        $brokerId = $clientGeneralService->getBrokerId();

        $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $brokerId);

        $view = new ViewModel(array(
            // if the broker has created the flutterwave
            "invoiceEntity" => $invoiceEntity,
            "paymentForm" => $paymentForm,
            "brokerEntity" => $brokerEntity,
            "manualProcessForm" => $manualProcessForm,
            "bankPaymentForm" => $bankPaymentForm
        ));
        return $view;
    }

    // public function authpaymodalAction()
    // {
    // $em = $this->entityManager;
    // $paystackPaymentService = $this->paystackPaymentService;
    // $authId = $this->params()->fromQuery("data", NULL);
    // if ($authId == NULL) {
    // $redirect = new Redirect($this->url()->fromRoute("board", array(
    // "action" => "payment"
    // )));
    // $response = new Response();
    // $response->add($redirect);
    // return $this->getResponse()->setContent($response);
    // }
    // $modal = new WasabiModal("standard", "Payment");
    // $html = new InnerHtml("#ht", $authId);

    // $modalView = new WasabiModalView("#authpay", $this->rendrer, $modal);
    // $response = new Response();
    // $response->add($modalView);
    // // $response->add($html);
    // return $this->getResponse()->setContent($response);
    // }

    // public function authpaymentAction()
    // {
    // $em = $this->entityManager;
    // $paystackPaymentService = $this->paystackPaymentService;
    // $request = $this->getRequest();
    // try {
    // if ($request->isPost()) {
    // $post = $request->getPost();
    // $post['auth'];
    // }
    // } catch (\Exception $e) {
    // $this->flashmessenger()->addErrorMessage($e->getMessage());
    // $this->redirect()->toRoute("board/default", array(
    // "action" => "payment"
    // ));
    // }
    // return $this->getResponse()->setContent(NULL);
    // }

    // private function isCardInSystem($card, $user)
    // {
    // $em = $this->entityManager;
    // $auth = $em->getRepository("Transactions\Entity\PaystackUserAutorizationCode")->findOneBy(array(
    // "lastFour" => $card,
    // "user" => $user
    // ));
    // if ($auth == NULL) {
    // return false; // defines it is empty
    // } else {
    // return true; // defines a value of this nature exist
    // }
    // }

    // public function manualProcessAction()
    // {
    // $em = $this->entityManager;
    // $request = $this->getRequest();
    // $mailService = $this->mailService;
    // $manualProcessForm = $this->manualProcessForm;
    // $generalSession = $this->clientGeneralService->getGeneralSession();
    // $invoiceId = $generalSession->InvoiceId;
    // $invoiceEntity = $em->find("Transactions\Entity\Invoice", $invoiceId);
    // $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $this->clientGeneralService->getBrokerId());
    // $manulaProcessEntity = NULL;
    // $notificationEntity = new Notifications();
    // if ($invoiceEntity->getManualProcess() == NULL) {
    // $manulaProcessEntity = new TransactionManualProcess();

    // $manulaProcessEntity->setInvoice($invoiceEntity);
    // } else {
    // $manulaProcessEntity = $invoiceEntity->getManualProcess();
    // }

    // if ($request->isPost()) {
    // $post = $request->getPost();
    // $paymentMode = $post["paymentMode"];
    // // $manualProcessForm->setData($post);
    // // $manualProcessForm = $this->manualProcessValidationCondition($manualProcessForm, $post);
    // // var_dump("hello");
    // // if ($manualProcessForm->isValid()) {

    // switch ($paymentMode) {

    // case TransactionService::TRANSACTION_PAYMENT_MODE_BANK_DEPOSIT:
    // $bankDeposit = new PaymentBankDeposit();
    // // hydrate Bank Deposit

    // $manulaProcessEntity->setPaymentMode($em->find("Settings\Entity\PaymentMode", $post["paymentMode"]))
    // ->setCurrency($em->find("Settings\Entity\Currency", $post['currency']))
    // ->addBankDeposit($bankDeposit)
    // ->setPaymentStatus($em->find("Transactions\Entity\TransactionStatus", TransactionService::TRANSACTION_STATUS_PENDING));

    // $bankDeposit->setBank($em->find("Settings\Entity\NigeriaBanks", $post["bankDeposit"]["bank"]))
    // ->setDepositorName($post["bankDeposit"]["depositorName"])
    // ->setDepositDate(new \DateTime($post['bankDeposit']['depositDate']))
    // ->setAmountPaid($post["amountPaid"])
    // ->setCreatedOn(new \DateTime())
    // ->setManualProcess($manulaProcessEntity);
    // $em->persist($bankDeposit);
    // break;

    // case TransactionService::TRANSACTION_PAYMENT_MODE_BANK_TRANSFER:

    // $paymentTransfer = new PaymentTransfer();
    // $manulaProcessEntity->setPaymentMode($em->find("Settings\Entity\PaymentMode", $post["paymentMode"]))
    // ->setCurrency($em->find("Settings\Entity\Currency", $post['currency']))
    // ->addBankTransfer($paymentTransfer)
    // ->setPaymentStatus($em->find("Transactions\Entity\TransactionStatus", TransactionService::TRANSACTION_STATUS_PENDING));

    // // $bankTransferEntity = $manulaProcessEntity->getBankTransfer();
    // $paymentTransfer->setBank($em->find("Settings\Entity\NigeriaBanks", $post["bankTransfer"]["bank"]))
    // ->setTransferFrom($post['bankTransfer']["transferFrom"])
    // ->setAmountPaid($post["amountPaid"])
    // ->setTransferDate(new \DateTime($post["bankTransfer"]["transferDate"]))
    // ->setCreatedOn(new \DateTime())
    // ->setManualProcess($manulaProcessEntity);
    // // var_dump($post);
    // $em->persist($paymentTransfer);
    // break;

    // case TransactionService::TRANSACTION_PAYMENT_MODE_CASH:

    // $cashEntity = new PaymentCash();

    // $manulaProcessEntity->setPaymentMode($em->find("Settings\Entity\PaymentMode", $post["paymentMode"]))
    // ->setCurrency($em->find("Settings\Entity\Currency", $post['currency']))
    // ->setPaymentStatus($em->find("Transactions\Entity\TransactionStatus", TransactionService::TRANSACTION_STATUS_PENDING))
    // ->addCash($cashEntity);

    // $cashEntity->setCollectedBy($post['cash']['collectedBy'])
    // ->setAmountPaid($post["amountPaid"])
    // ->setCreatedOn(new \DateTime())
    // ->setDatePaid(new \DateTime($post['cash']['datePaid']));

    // $em->persist($cashEntity);
    // // var_dump("cash here");
    // break;
    // }
    // $notitiicationUrl = $this->url()->fromRoute("invoice/default", array(
    // "action" => "view",
    // "id" => $invoiceEntity->getId()
    // ), array(
    // 'force_canonical' => true
    // )); // set the route to the manual Payment entered
    // $message = "";
    // $notificationEntity->setCreatedOn(new \DateTime())
    // ->setNotificationUrl($notitiicationUrl)
    // ->setInvoice($invoiceEntity)
    // ->setMessage($message)
    // ->setNotificationType($em->find("Settings\Entity\NotificationType", SettingsService::NOTIFICATION_TYPE_MANUAL_PAYMENT_PROCESS));

    // try {
    // $em->persist($manulaProcessEntity);
    // $em->persist($notificationEntity);
    // $em->flush();

    // $this->flashmessenger()->addSuccessMessage("A notification has been sent to the broker for payment");
    // $this->flashmessenger()->addSuccessMessage("Please wait while the Broker confirms payment");
    // // $this->manualProcessMail($invoiceEntity, $brokerEntity, $post);
    // $this->redirect()->toRoute("board/default", array(
    // "action" => "payment"
    // ));
    // } catch (\Exception $e) {
    // $this->flashmessenger()->addErrorMessage("There was a problem creating this payment Notification");
    // $this->redirect()->toRoute("board/default", array(
    // "action" => "payment"
    // ));
    // }
    // // } else {
    // // var_dump($post);
    // // // $this->flashmessenger()->addErrorMessage("Validation Error");
    // // // $this->redirect()->toRoute("board/default", array("action"=>"payment"));
    // // }
    // // if($manualProcessForm->isValid())
    // }
    // return $this->getResponse()->setContent(NULL);
    // }

    // private function manualProcessMail($invoiceEntity, $brokerEntity, $post = "")
    // {
    // $em = $this->entityManager;
    // $mailService = $this->mailService;
    // $imapLogo = $this->url()->fromRoute('welcome', array(), array(
    // 'force_canonical' => true
    // )) . "images/logow.png";
    // $currencyEntity = $em->find("Settings\Entity\Currency", $post['currency']);
    // $var = array(
    // "logo" => $imapLogo,
    // "invoiceUid" => $invoiceEntity->getInvoiceUid,
    // "invoiceService" => $invoiceEntity->getInvoiceCategory()->getCategory(),
    // "amounPaid" => $post["amountPaid"],
    // "currency" => $currencyEntity->getCode()
    // // "notificationUrl"=>$notitiicationUrl
    // );
    // $message = $mailService->getMessage();
    // $message->addTo(array(
    // $brokerEntity->getUser()
    // ->getEmail()

    // ))
    // ->setFrom("info@imapp.ng", "IMAPP CM")
    // ->setSubject("NON ELECTRONIC PAYMENT");
    // $mailService->setTemplate('general-user-confirm-email', $var); // TODO set a nmail templet for non electronic payment
    // $mailService->send();
    // }

    // private function manualProcessValidationCondition($form, $data)
    // {
    // /**
    // * if data
    // */
    // if ($data['paymentMode'] == TransactionService::TRANSACTION_PAYMENT_MODE_CASH) {
    // // var_dump($data['paymentMode']."1");
    // $form->setValidationGroup(array(
    // "csrf",
    // "paymentMode",
    // "currency",
    // "amountPaid",
    // "cash" => array(
    // "collectedBy"
    // // "datePaid"

    // )

    // ));
    // // var_dump($data['paymentMode']);
    // return $form;
    // } elseif (TransactionService::TRANSACTION_PAYMENT_MODE_BANK_DEPOSIT) {
    // $form->setValidationGroup(array(
    // "csrf",
    // "paymentMode",
    // "currency",
    // "amountPaid",
    // "bankDeposit" => array(
    // "bank",
    // "depositDate",
    // "depositorName"

    // )

    // ));
    // return $form;
    // } elseif (TransactionService::TRANSACTION_PAYMENT_MODE_BANK_TRANSFER) {
    // $form->setValidationGroup(array(
    // "csrf",
    // "paymentMode",
    // "currency",
    // "amountPaid",
    // "bankTransfer" => array(
    // "bank",
    // "transferFrom",
    // "transferDate"

    // )

    // ));
    // return $form;
    // }
    // // return $form;
    // }
    public function preClaimsAction()
    {
        $em = $this->entityManager;
        $response = new Response();
        $claimsService = $this->claimsService;
        $customerClaimsSession = $claimsService->getCustomerClaimsSession();
        $request = $this->getRequest();
        $gritter = new GritterMessage();
        $claimsPreForm = $this->claimsPreForm;
        $claimsPreForm->bind(new Claims());
        if ($request->isPost()) {

            $post = $request->getPost();
            $claimsPreForm->setData($post);
            if ($claimsPreForm->isValid()) {

                $claimsEntity = new Claims();
                $claimsEntity
                    ->setCreatedOn(new \DateTime())
                    ->setIsHidden(FALSE)
                    ->setClaimUid($claimsService->createUniqueId())
                    ->setIsDefaultClaims(FALSE)
                    ->setPolicy($em->find("Policy\Entity\Policy", $post['pre_claims_field']['policy']))
                    ->setClaimTopic($post['pre_claims_field']['claimTopic'])
                    ->setClaimStatus($em->find("CLaims\Entity\ClaimStatus", ClaimsService::CLAIMS_STATUS_INITIATED));

                try {
                    $em->persist($claimsEntity);
                    $em->flush();
                    $customerClaimsSession->claimsId = $claimsEntity->getId();
                    $gritter->setTitle("Success");
                    $gritter->setText("You have successfully initiated a claim");
                    $gritter->setType(GritterMessage::TYPE_SUCCESS);
                    
                    $response->add($gritter);
                    $this->flashmessenger()->addSuccessMessage("You have initiated a claim");
//                     $this->redirect()->toRoute("cus_claims/default", array(
//                         "action" => "lay"
//                     ));

                    $redirect = new Redirect($this->url()->fromRoute("cus_claims/default", array(
                                            "action" => "lay"
                                        )));
                    
                    $response->add($redirect);
                    
                   
                } catch (\Exception $e) {
                    $gritter->setTitle("Error");
                    $gritter->setText($e->getMessage());
                    $gritter->setPosition(GritterMessage::POSITION_TOP_RIGHT);
                    $gritter->setType(GritterMessage::TYPE_ERROR);

                    $response->add($gritter);
                    // $this->flashmessenger()->addErrorMessage("There was a problem initiating your claims request");
                    // $this->redirect()->toRoute("board");
                }
            }
        }

        return $this->getResponse()->setContent($response);
    }

    public function manualPaymentAction()
    {
        $em = $this->entityManager;
        return $this->getResponse()->setContent(NULL);
    }

    // Begin Setters
    public function setClientGeneralService($xserv)
    {
        $this->clientGeneralService = $xserv;
        return $this;
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }

    public function setGeneralService($xserv)
    { // / This is cllient general service
        $this->generalServicen = $xserv;
        return $this;
    }

    public function setClientSession($sess)
    {
        $this->clientSession = $sess;
        return $this;
    }

    public function setCustomerBoardService($xserv)
    {
        $this->customerBoardService = $xserv;
        return $this;
    }

    public function setPaymentForm($form)
    {
        $this->paymentForm = $form;
        return $this;
    }

    public function setEditProfileForm($form)
    {
        $this->editProfileForm = $form;
        return $this;
    }

    public function setPaymentService($xserv)
    {
        $this->paymentService = $xserv;
        return $this;
    }

    public function setPaystackPaymentService($xserv)
    {
        $this->paystackPaymentService = $xserv;
        return $this;
    }

    public function setClaimsPreForm($claimsPreForm)
    {
        $this->claimsPreForm = $claimsPreForm;
        return $this;
    }

    public function setClaimsService($xserv)
    {
        $this->claimsService = $xserv;
        return $this;
    }

    public function setManualProcessForm($form)
    {
        $this->manualProcessForm = $form;
        return $this;
    }

    public function setMailService($mail)
    {
        $this->mailService = $mail;
        return $this;
    }

    public function setOtpForm($form)
    {
        $this->otpForm = $form;
        return $this;
    }

    public function setPinCodeForm($form)
    {
        $this->pinCodeForm = $form;
        return $this;
    }

    public function setTransactionService($trans)
    {
        $this->transactionService = $trans;
        return $this;
    }

    public function setCardPinForm($form)
    {
        $this->cardPinForm = $form;
        return $this;
    }

    public function setRendrer($ren)
    {
        $this->rendrer = $ren;
        return $this;
    }

    public function setMoneyWaveService($xserv)
    {
        $this->moneyWaveService = $xserv;
        return $this;
    }

    public function setRavePaymentService($xserv)
    {
        $this->ravePaymentService = $xserv;
        return $this;
    }

    public function setBankPaymentForm($form)
    {
        $this->bankPaymentForm = $form;
        return $this;
    }

    public function setCardBillingForm($billing)
    {
        $this->cardBillingForm = $billing;
        return $this;
    }

    // End Setters
}

