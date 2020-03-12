<?php
namespace GeneralServicer\Service;

class TriggerService
{

    const TIGGER_NOTIFICATION = "notification";
    
    // Policy Events

    const TRIGGER_POLICY_GENERATION_INITIATED = "policyGenerationIinitiated";

    const TRIGGER_POLICY_GENERATION_COMPLETED = "policyGenerationCompleted";

    const TRIGGER_REGISTER_BROKER = "registerBroker";
    
    const TRIGGER_POLICY_RENEWED = "";
    
    const TRIGGER_POLICY_RENEWED_POLICY_HOOK = "policyRenewedPolicyHook";
    
    const TRIGGER_POLICY_RENEWED_MAIL = "policyRenewedMail";
    
    const TRIGGER_POLICY_RENEWED_NOTIFICATION = "policyRenewedNotification";

    // Wallet Events
    const TRIGGER_WALLET_PASSCODE_CREATED = "passcodeCreated";

    // Email Notification
    const TRIGGER_GENERAL_EMAIL_SEND = "sendGeneralEmail";

    // Claims Events

    // const TRIGGER_CLAIMS_COMMENT
    
    //otification Types
    const NOTIFICATION_TYPE_MANUAL_PAYMENT = 1;

    const NOTIFICATION_TYPE_POLICY_ACTION = 10;

    const NOTIFICATION_TYPE_COVERNOTE_ACTION = 20;

    const NOTIFICATION_TYPE_INVOICE_ACTION = 100;

    const NOTIFICATION_TYPE_CUSTOMER_ACTION = 250;
    
//     const 
    
    
    
    // Claims Action Events 
    
    const TRIGGER_CLAIMS_APPROVED_CLAIMS = "claimsApproved";

    // Finaincial Events
    const TRIGGER_BROKER_TRANSFER_INITIATED = "brokerTransferInitiated";

    const TRIGGER_CUSTOMER_CARD_PAYMENT_INITIATED_PRE = "preCustomerCardPaymentInitiated";

    // pre card initiated event trigger
    const TRIGGER_CUSTOMER_CARD_PAYMENT_INITITIATED_POST = "postCustomerCardPaymentInitiated";

    // post card initiated event trigger
    const TRIGGER_CUSTOMER_CARD_PAYMENT_PIN_PRE = "preCustomerCardPinValidation";

    // Post event for card PIN validation
    const TRIGGER_CUSTOMER_CARD_PAYMENT_PIN_POST = "postCustomerCardPinValidation";

    // 
    /**
     * pre event for otp card validation
     * @var string
     */
    const TRIGGER_CUSTOMER_CARD_PAYMENT_OTP_PRE = "preCustomerCardOtpValidation";

    // 
    /**
     * post event for otp card validation
     * @var string
     */
    const TRIGGER_CUSTOMER_CARD_PAYMENT_OTP_POST = "postCustomerCardOtpValidation";

    

    /**
     * Throws an error verificcation error due to multiple reasons
     * charged amount is less that required amount
     *
     * @var string
     */
    const TRIGGER_CUSTOMER_CARD_VERIFICATION_ERROR = "customerCardVerificationError";

    // At this the card payment could not be verified

    /**
     * This is also the balance all other transaction pends verification
     *
     * @var string
     */
    const TRIGGER_CUSTOMER_BOOK_BALANCE_VERIFIED = "customerBookBalanceVerified";

    // this is triggered when the transaction is approved for view in the book balance

    /**
     * This is the balnce all customer withrawal takes place
     * It also the place all verified payment takes place
     *
     * @var string
     */
    const TRIGGER_CUSTOMER_AVAILABLE_BALANCE_VERIFIED = "customerAvailaibleBalanceVerified";

    // this is triggered when theere is when there is a confirmation of transaction of theprevious book balance

    
    // Transaction Events
    const TRIGGER_TRANSACTION_SUCCESS_MAIL = "transactionSuccessMail";
    // const
    // Error Log Events
    public function __construct()
    {

        // TODO - Insert your code here
    }
}

