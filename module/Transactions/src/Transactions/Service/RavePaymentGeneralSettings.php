<?php
namespace Transactions\Service;

use GeneralServicer\Service\GeneralService;
use Zend\Http\Client;
use Transactions\Entity\RaveTransfer;
use ZfcBase\EventManager\EventProvider;

/**
 *
 * @author otaba
 *        
 */
abstract class RavePaymentGeneralSettings extends EventProvider
{

    // TODO - Insert your code here
    const RAVE_DEMO_URL = "https://ravesandboxapi.flutterwave.com/";

    const RAVE_LIVE_URL = "https://api.ravepay.co/";

    const RAVE_CONTENT_TYPE = "application/json";

    const RAVE_PUBLIC_KEY = "FLWPUBK-ac7b6b5cd4cc7def4ed7773d2ac89e56-X";

    const RAVE_SECRET_KEY = "FLWSECK-262dbc2005e0230cce3fd23d629de28c-X";

    const RAVE_OTP_VALIDATION_MODE = "OTP";

    const RAVE_GTBANK_CODE = "058";

    const RAVE_FIRST_BANK_CODE = "011";

    const RAVE_GTB_REDIRECTION_URL = GeneralService::CM_URL . "board/payment";

    const RAVE_GENERAL_REDIRECTION_URL = GeneralService::CM_URL . "board/payment";

    const RAVE_TRANSFER_STATUS_INITIATED = 10;

    const RAVE_TRANSFER_STATUS_SUCCESS = 50;

    const RAVE_TRANSFER_STATUS_FAILED = 100;

    private $entityManager;

    // Transfer data
    private $transferBank;

    private $transferAcc;

    private $transferAmount;

    private $transferCurrency;

    // bank transfer details
    private $bank;

    private $accountNumber;

    private $passcode;

    private $redirect_url;

    /**
     */
    public function __construct()
    {

        // TODO - Insert your code here
    }

    public static function transferRef()
    {
        $const = "trsref";
        $code = \uniqid($const);
        return $code;
    }

    public function getKey($seckey)
    {
        $hashedkey = md5($seckey);
        $hashedkeyLast12 = substr($hashedkey, - 12);

        $secretkeyadjusted = str_replace("FLWSECK-", "", $seckey);
        $secretkeyadjustedfirst12 = substr($secretkeyadjusted, 0, 12);

        $encryptionkey = $secretkeyadjustedfirst12 . $hashedkeyLast12;

        return $encryptionkey;
    }

    public function encrypt3Des($data, $key)
    {
        $encData = openssl_encrypt($data, "DES-EDE3", $key, OPENSSL_RAW_DATA);
        return base64_encode($encData);
    }

    public function process($data)
    {
        $secKey = RavePaymentGeneralSettings::RAVE_SECRET_KEY;

        $key = $this->getKey($secKey);

        $dataReq = json_encode($data);
        $post_enc = $this->encrypt3Des($dataReq, $key);

        $postData = array(
            'PBFPubKey' => RavePaymentGeneralSettings::RAVE_PUBLIC_KEY,
            'client' => $post_enc,
            'alg' => '3DES-24'
        );
        return $postData;
    }

    /**
     * this is the amount transaferable to the broker
     * After successful deductions of 3% and N100
     * 3% = 1.4% flutterwave charge and 1.6
     *
     * @return number
     */
    public static function calculateTransferAmount($clientGeneralService)
    {
        $generalSession = $clientGeneralService->getGeneralSession();
        $calculated = (float) (97 * $generalSession->amountSent) / 100; // calculates 97% of the amount deducted
        $amountTransferable = $calculated - 100; // deducts the transafer fee and our own N55 standard charge
        return $amountTransferable;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Transactions\Service\RaveCardPaymentInterface::initiateCardPayment()
     *
     */
    public function initiateCardPayment()
    {
        $ravePaymentSession = $this->ravePaymentSession;
        $client = new Client();
        $client->setUri(RavePaymentGeneralSettings::RAVE_LIVE_URL . "flwv3-pug/getpaidx/api/charge");
        $client->setMethod("POST");
        $client->setHeaders(array(
            'Content-Type' => 'application/json'
            // 'Authorization' => $this->moneywaveSession->auth
        ));

        $data = array(
            'PBFPubKey' => RavePaymentGeneralSettings::RAVE_PUBLIC_KEY,
            'cardno' => $this->cleanCard($this->cardNo),
            'currency' => $this->currency,
            'country' => 'NG',
            'cvv' => $this->cleanCard($this->cardCvv),
            'amount' => $this->amount,

            'expiryyear' => $this->cardYear,
            'expirymonth' => $this->cardMonth,
            'email' => $this->email,
            'IP' => $this->ip,
            'txRef' => $this->txRef
        );

        $postData = $this->process($data);

        $client->setRawBody(json_encode($postData));
        $response = $client->send();

        if (! $response->isSuccess()) {

            throw new \Exception("There was a problem initiating this card");
        } else {
            $body = json_decode($response->getBody());
            if ($body->status == "success") {
                if (property_exists($body->data, "suggested_auth")) { // requires an extra suggested authorization like PIN
                    $ravePaymentSession->cardNo = $this->cleanCard($this->cardNo);
                    $ravePaymentSession->currency = $this->currency;
                    $ravePaymentSession->cardCvv = $this->cleanCard($this->cardCvv);
                    $ravePaymentSession->cardMonth = $this->cardMonth;
                    $ravePaymentSession->cardYear = $this->cardYear;
                    // $ravePaymentSession->cardPin = $this->cardPin;
                    $ravePaymentSession->suggested_auth = $body->data->suggested_auth;
                    $ravePaymentSession->amount = $this->amount;
                    $ravePaymentSession->email = $this->email;
                    $ravePaymentSession->phoneNumber = $this->phoneNumber;
                    $ravePaymentSession->ip = $this->ip;
                    $ravePaymentSession->txRef = $this->txRef;
                    if ($body->data->suggested_auth == "PIN") {
                        return "PIN";
                    } elseif ($body->data->suggested_auth == "NOAUTH_INTERNATIONAL") {
                        return "NOAUTH";
                    } elseif ($body->data->suggested_auth == "AVS_VBVSECURECODE") {
                        return "AVS";
                    }
                } elseif (property_exists($body->data, "chargeResponseCode")) {
                    if ($body->data->chargeResponseCode == "02") { // Require confirmation
                        if ($body->data->authModelUsed != NULL || ! isEmpty($body->data->authModelUsed)) { // possible OTP or VBVSECURE
                            $ravePaymentSession->chargeResponseMessage = $body->data->chargeResponseMessage;
                            $ravePaymentSession->txRef = $body->data->txRef;
                            $ravePaymentSession->flwRef = $body->data->flwRef;
                            $ravePaymentSession->charged_amount = $body->data->charged_amount;
                            $ravePaymentSession->orderRef = $body->data->orderRef;
                            if ($this->isOtp($body->data->authModelUsed) || $body->data->authModelUsed = "OTP") {
                                return "OTP";
                            } elseif ($body->data->authModelUsed == "VBVSECURECODE") {
                                $ravePaymentSession->authurl = $body->data->authurl;
                                $ravePaymentSession->vbvrespcode = $body->data->vbvrespcode;
                                return "VBV";
                            }
                        }
                    } elseif ($body->data->chargeResponseCode == "00") { // direct charge was successful
                                                                         // redirect to the successful page
                        $ravePaymentSession->responseCode = $body->data->data->responsecode;
                        $ravePaymentSession->chargeResponseCode = $body->data->tx->chargeResponseCode;
                        $ravePaymentSession->chargeCurrency = $body->data->tx->currency;
                        $ravePaymentSession->user_token = $body->data->tx->chargeToken->user_token;
                        $ravePaymentSession->embed_token = $body->data->tx->chargeToken->embed_token;
                        $ravePaymentSession->charged_amount = $body->data->tx->charged_amount;
                        $ravePaymentSession->txRef = $body->data->tx->txRef;
                        return TRUE;
                    }
                }
            } else {
                throw new \Exception($body->message);
            }
        }
    }

    public function transferfunds()
    {
        $em = $this->entityManager;
        $clientGeneralService = $this->clientGeneralService;
        $client = new Client();
        $client->setUri(RavePaymentService::RAVE_LIVE_URL . "v2/gpx/transfers/create");
        $client->setHeaders(array(
            'Content-Type' => 'application/json'
            // 'Authorization' => $this->moneywaveSession->auth
        ));
        $client->setMethod("POST");
        $post = array(
            "account_bank" => $this->transferBank,
            "account_number" => $this->transferAcc,
            "amount" => $this->transferAmount,
            "currency" => $this->transferCurrency,
            "seckey" => RavePaymentGeneralSettings::RAVE_SECRET_KEY,
            "reference" => RavePaymentGeneralSettings::transferRef()
        );

        $client->setRawBody(json_encode($post));
        $response = $client->send();

        if ($response->isSuccess()) {
            $body = json_decode($response->getBody());
            if ($body->status == "success") {
                $raveTransfer = new RaveTransfer();
                $raveTransfer->setCreatedOn(new \DateTime())
                    ->setReference($body->data->reference)
                    ->setStatus($em->find("Transactions\Entity\RaveTransferStatus", RavePaymentService::RAVE_TRANSFER_STATUS_INITIATED))
                    ->setTransferId($body->data->id);
                $em->persist($raveTransfer);
                $em->flush();

                // send mail to broker about transafer initiated

                $generalService = $this->clientGeneralService->getGeneralService();

                $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $clientGeneralService->getBrokerId());
                $messagePointer['to'] = $brokerEntity->getUser()->getEmail();
                $messagePointer['subject'] = "Payout Initiated";
                $messagePointer['fromName'] = GeneralService::APP_NAME;

                $template['template'] = ""; // TODO - Define a payout initiated mail template
                $template['var'] = array(
                    "logo" => $generalService->getImappLogo(),
                    "brokername " => GeneralService::APP_COMPANY_NAME
                    // "broker" => $brokerEntity
                );
                $generalService->sendMails($messagePointer, $template);
            }
        } else {
            // hydrate dataase for error in transfer
            throw new \Exception("There was a problem connecting to the transaferserver");
        }
    }
    
    /**
     * This is a the card to be charged
     *
     * @param string $card
     * @return mixed
     */
    protected function cleanCard($card)
    {
        return str_replace(" ", "", trim($card));
    }
}

