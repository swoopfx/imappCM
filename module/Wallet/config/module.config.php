<?php
namespace Wallet;

return array(
    "controllers" => array(
        "factories" => array(
            "Wallet\Controller\Wallet" => "Wallet\Controller\Factory\WalletControllerFactory"
        )
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'Wallet' => __DIR__ . '/../view'
        ),
        "template_map" => array(
            'wallet_transactions_list_snippet' => __DIR__ . '/../view/wallet/partials/wallet_transaction_list_snippet.phtml',
            "wallet_transaction_fieldset_snippet" => __DIR__ . '/../view/wallet/partials/wallet_transaction_fieldset_snippet.phtml',
            "wallet_passcode_fieldset_snippet" => __DIR__ . '/../view/wallet/partials/wallet_passcode_fieldset_snippet.phtml',
            "wallet_add_funds_fieldset_snippet" => __DIR__ . '/../view/wallet/partials/wallet_add_fund_fieldset_snippet.phtml',
            "wallet_change_passcode_fieldset_snippet" => __DIR__ . '/../view/wallet/partials/wallet_change_passcode_fieldset_snippet.phtml',
            
            "wallet_transaction_modal_form_snippet" => __DIR__ . '/../view/wallet/partials/modal/wallet_transaction_modal_form_snippet.phtml',
            "wallet_passcode_modal_form_snippet" => __DIR__ . '/../view/wallet/partials/modal/wallet_passcode_modal_form_snippet.phtml',
            "wallet_add_fund_modal_form_snippet" => __DIR__ . '/../view/wallet/partials/modal/wallet_add_fund_modal_form_snippet.phtml',
            "wallet_change_passcode_modal_form_snippet" => __DIR__ . '/../view/wallet/partials/modal/wallet_change_passcode_modal_form_snippet.phtml'
            
        )
    ),

    'service_manager' => array(
        'factories' => array(
            "Wallet\Service\WalletService" => "Wallet\Service\Factory\WalletServiceFactory"
        )
    ),

    'router' => array(
        'routes' => array(

            'wallet' => array(
                'type' => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/wallet',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Wallet\Controller',
                        'controller' => 'Wallet',
                        'action' => 'overview'
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
    "form_elements" => array(
        "factories" => array(
            "Wallet\Form\Fieldset\WalletTransactionFieldset" => "Wallet\Form\Fieldset\Factory\WalletTransactionFieldsetFactory",
            "Wallet\Form\Fieldset\WalletPasscodeFieldset" => "Wallet\Form\Fieldset\Factory\WalletPasscodeFieldsetFactory",
            "Wallet\Form\Fieldset\WalletAddFundFieldset" => "Wallet\Form\Fieldset\Factory\WalletAddFundFieldsetFactory",
            "Wallet\Form\Fieldset\WalletChangePasscodeFieldset" => "Wallet\Form\Fieldset\Factory\WalletChangePasscodeFieldsetFactory",
            
            "Wallet\Form\WalletTransactionForm" => "Wallet\Form\Factory\WalletTransactionFormFactory",
            "Wallet\Form\WalletPasscodeForm" => "Wallet\Form\Factory\WalletPasscodeFormFactory",
            "Wallet\Form\WalletAddFundForm" => "Wallet\Form\Factory\WalletAddFundFormFactory",
            "Wallet\Form\WalletChangePasscodeFormFactory" => "Wallet\Form\Factory\WalletChangePasscodeFormFactory",
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
    )
);