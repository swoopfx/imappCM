<?php
namespace Transactions;

return array(
    'controllers' => array(
        'invokables' => array()
        // 'Transactions\Controller\Transactions' => 'Transactions\Controller\TransactionsController'
        ,
        'factories' => array(
            'Transactions\Controller\Transactions' => 'Transactions\Controller\Factory\TransactionControllerFactory',
            'Transactions\Controller\Payment' => 'Transactions\Controller\Factory\PaymentControllerFactory',
            "Transactions\Controller\Invoice"=>"Transactions\Controller\Factory\InvoiceControllerFactory"
        )
    ),
    'router' => array(
        'routes' => array(
            'transactions' => array(
                'type' => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/transactions',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Transactions\Controller',
                        'controller' => 'Transactions',
                        'action' => 'index'
                    )
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    // This route is a sane default when developing a module;
                    // as you solidify the routes for your module, however,
                    // you may want to remove it and replace it with more
                    // specific routes.
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*'
                            ),
                            'defaults' => array()
                        )
                    )
                )
            ),
            
            'invoice' => array(
                'type' => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/invoices',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Transactions\Controller',
                        'controller' => 'Invoice',
                        'action' => 'index'
                    )
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    // This route is a sane default when developing a module;
                    // as you solidify the routes for your module, however,
                    // you may want to remove it and replace it with more
                    // specific routes.
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '[/:action[/:id]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '[a-zA-Z0-9_-]*'
                            ),
                            'defaults' => array()
                        )
                    )
                )
            ),
            
            'payment' => array(
                'type' => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/payment',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Transactions\Controller',
                        'controller' => 'Payment',
                        'action' => 'index'
                    )
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    // This route is a sane default when developing a module;
                    // as you solidify the routes for your module, however,
                    // you may want to remove it and replace it with more
                    // specific routes.
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '[/:action[/:id]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '[a-zA-Z0-9_-]*'
                            ),
                            'defaults' => array()
                        )
                    )
                )
            )
        )
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Transactions' => __DIR__ . '/../view'
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),
        'template_map' => array(
            'invoice_offer_partial_view' => __DIR__ . '/../view/partials/offer-invoice.phtml',
            'transaction_user_card_payment_snipet'=>__DIR__ . '/../view/partials/user-payment-card-snipet.phtml',
            "transaction_user_card_payment_form"=>__DIR__ . '/../view/partials/user-card-payment-form.phtml',
            'transaction_otp-form-snippet'=>__DIR__ . '/../view/partials/transaction-otp-form-snippet.phtml',
            'transaction_auth-form-snippet'=>__DIR__ . '/../view/partials/transaction-auth-form-snipet.phtml',
            'transaction_card_pin-form-snippet'=>__DIR__ . '/../view/partials/transaction-pin-form-snippet.phtml',
            'transaction-invoice-all-snipet'=>__DIR__ . '/../view/partials/transactions-invoice-all-snipet.phtml',
            'transaction-bank-payment-fieldset-snippet'=>__DIR__ . '/../view/partials/transaction-bank-payment-fieldset-snippet.phtml',
            'transaction_bank_payment_forme'=>__DIR__ . '/../view/partials/transaction-bank-payment-form.phtml',
            
            // Begin manual process snipets
            "transaction-manual-process-form"=>__DIR__ . '/../view/transactions/transactions/form/transaction-manual-process-form-snipet.phtml',
            "transaction-form-payment-bank-deposit-snipet"=>__DIR__ . '/../view/transactions/transactions/form/transaction-form-payment-bank-deposit-snippet.phtml',
            "transaction-form-payment-bank-transfer"=>__DIR__ . '/../view/transactions/transactions/form/transaction-form-payment-bank-transfer.phtml',
            "transaction-form-payment-cash-snipet"=>__DIR__ . '/../view/transactions/transactions/form/transaction-form-payment-cash-snippet.phtml',
            "transaction-manual-process-view-all"=>__DIR__ . '/../view/partials/transaction-manual-process-view-all.phtml',
            // End manual process form
            
            // Begin Invoice snippets
            'transaction-invoice-preview-snipet'=>__DIR__ . '/../view/partials/invoice/transaction-invoice-preview-snipet.phtml',
            'transaction-process-manual-payment-details-snipet'=>__DIR__ . '/../view/partials/invoice/transaction-process-manual-payment-details-snippet.phtml',
            
            
            // Modal 
            "transaction-micro-payment-fieldset-snippet"=>__DIR__ . "/../view/partials/modal/transaction-micro-payment-fieldset.phtml",
            "transaction-micro-payment-view-details"=>__DIR__ . "/../view/partials/modal/trnsaction-micro-payment-view-details.phtml",
            "transaction-user-card-payment-modal-form"=>__DIR__ . "/../view/partials/modal/transaction-user-card-payment-modal-form.phtml",
            "transaction-modal-payment-error"=>__DIR__ . "/../view/partials/modal/transaction-modal-payment-error.phtml",
            "transaction-manul-payment-fieldset"=>__DIR__ . "/../view/partials/modal/transaction-manual-payment-fieldset.phtml",
            "transaction-card-billing-form"=>__DIR__ . "/../view/partials/modal/transaction-card-billing-form-snippet.phtml",
            "transaction-payment-success-modal"=>__DIR__ . "/../view/partials/modal/transaction-success-payment-modal.phtml",
            "transaction-payment-error-modal"=>__DIR__ . "/../view/partials/modal/transaction-error-payment-modal.phtml",
            "transaction-preauth-payment-card-modal" =>__DIR__ . "/../view/partials/modal/transaction-preauth-card-modal-payment.phtml",
            
            
            // Micro payment snippet
            "transaction-micro-payment-snipet"=>__DIR__ . '/../view/partials/transaction-micro-payment-snippet.phtml'
        )
    ),
    
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(
                    __DIR__ . '/../src/' . __NAMESPACE__ . '/Entity'
                )
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                )
            )
        )
    ),
    'service_manager' => array(
        'factories' => array(
            "Transactions\Service\PayStackPaymentService"=>"Transactions\Service\Factory\PaystackPaymentServiceFactory",
            'Transactions\Service\InvoiceService' => 'Transactions\Service\Factory\InvoiceServiceFactory',
            'Transactions\Service\TransactionService' => 'Transactions\Service\Factory\TransactionFactory',
            "Transactions\Service\MoneyWavePaymentService"=>"Transactions\Service\Factory\MoneyWavePaymentServiceFactory",
            'Transactions\Service\PaymentService' => 'Transactions\Service\Factory\PaymentServiceFactory',
            "Transactions\Service\RavePaymentService"=>"Transactions\Service\Factory\RavePaymentServiceFactory",
            "Transactions\Service\RaveCardPaymentService"=>"Transactions\Service\Factory\RaveCardPaymentFactory",
            "Transactions\Service\RaveCardPaymentBrokerService"=>"Transactions\Service\Factory\RaveCardPaymentBrokerServiceFactory",
            "Transactions\Service\RaveBankPaymentService"=>"Transactions\Service\Factory\RaveCardPaymentFactory",
            
//             ""=>"",
        )
    ),
    
    'view_helpers' => array(
        'invokables' => array(
            "transactionRavePreAuthCardHelper"=>"Transactions\View\Helper\RavePayUserCardHelper",
            "transactionAuthFormHelper"=>"Transactions\View\Helper\PaystackUserCardHelper",
            "invoiceStatusViewHelper"=>"Transactions\View\Helper\InvoiceStatusViewHelper",
            'ImappInvoiceOfficeViewHelper' => 'Transactions\View\Helper\ImappInvoiceOfficeViewHelper',
            "transactionManualPaymentDetails"=>"Transactions\View\Helper\TransactionManualPaymentProcess",
            "transactionInvoiceManualPaymentDetails"=>"Transactions\View\Helper\Invoice\TransactionInvoiceManualPaymentDetails"
        )
        
    )
    ,
    'form_elements' => array(
        'factories' => array(
            "Transactions\Form\Fieldset\MicroPaymentFieldset"=>"Transactions\Form\Fieldset\Factory\MicroPaymentFieldsetFactory",
            'Transactions\Form\Fieldset\UserCardPaymentFieldset' => 'Transactions\Form\Fieldset\Factory\UserCardPaymentFieldsetFactory',
            'Transactions\Form\Fieldset\BrokerFlutterwaveAccountFieldset'=>'Transactions\Form\Fieldset\Factory\BrokerFlutterwaveAccountFieldsetFactory',
            'Transactions\Form\UserCardPaymentForm'=>'Transactions\Form\Factory\UserCardPaymentFormFactory',
            'Transactions\Form\BrokerFlutterwaveForm'=>'Transactions\Form\Factory\BrokerFlutterwaveFormFactory',
            "Transactions\Form\CardPinForm"=>"Transactions\Form\Factory\CardPinFormFactory",
            "Transactions\Form\AuthPaymentForm"=>"Transactions\Form\Factory\AuthPaymentFormFactory",
            // Paymens form and Fieldset and Form 
            "Transactions\Form\Fieldset\TransactionCardBillingAddress"=>"Transactions\Form\Fieldset\Factory\TransactionCardBillingAddressFactory",
            "Transactions\Form\Fieldset\ManualPaymentFieldset"=>"Transactions\Form\Fieldset\Factory\ManualPaymentFieldsetFactory",
            "Transactions\Form\Fieldset\TransactionBankPaymentFieldset"=>"Transactions\Form\Fieldset\Factory\TransactionBankPaymentFieldsetFactory",
            "Transactions\Form\TransactionBankPaymentForm"=>"Transactions\Form\Factory\TransactionBankPaymentFormFactory",
            "Transactions\Form\CardBillingForm"=>"Transactions\Form\Factory\CardBillingFormFactory",
            "Transactions\Form\Fieldset\CardBillingFieldset"=>"Transactions\Form\Fieldset\Factory\CardBillingFieldsetFactory",
            "Transactions\Form\OTPForm"=>"Transactions\Form\Factory\OTPFormFactory",
            "Transactions\Form\TransactionManualProcessForm"=>"Transactions\Form\Factory\TransactionManualProcessFormFactory",
            "Transactions\Form\Fieldset\PaymentTransferFieldset"=>"Transactions\Form\Fieldset\Factory\PaymentTransferFieldsetFactory",
            "Transactions\Form\Fieldset\PaymentCashFieldset"=>"Transactions\Form\Fieldset\Factory\PaymentCashFieldsetFactory" ,
            "Transactions\Form\Fieldset\PaymentBankDepositFieldset"=>"Transactions\Form\Fieldset\Factory\PaymentBankDepositFieldsetFactory",
            "Transactions\Form\TransactionInvoiceProcessManualPaymentForm"=>"Transactions\Form\Factory\TransactionInvoiceProcessManualPaymentFormFactory",
            "Transactions\Form\ManualPaymentForm"=>"Transactions\Form\Factory\ManualPaymentFormFactory",
            "Transactions\Form\TransactionCardBillingAddressForm"=>"Transactions\Form\Factory\TransactionCardBillingAddressFormFactory",
            // Micro payment form 
            "Transactions\Form\MicroPaymentForm"=>"Transactions\Form\Factory\MicroPaymentFormFactory"
            
        )
    )
);
