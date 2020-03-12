<?php
namespace Packages;

return array(
    'controllers' => array(
        'invokables' => array(
            // 'Packages\Controller\Package' => 'Packages\Controller\PackageController'
        ),
        'factories' => array(
            'Packages\Controller\Package' => 'Packages\Controller\Factory\PackageControllerFactory',
            'Packages\Controller\AcquirePackages' => 'Packages\Controller\Factory\AcquirePackagesControllerFactory'
        )
    ),
    'router' => array(
        'routes' => array(
            'packages' => array(
                'type' => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/package',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Packages\Controller',
                        'controller' => 'Package',
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
                                // 'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '[a-zA-Z0-9_-]*'
                            ),
                            'defaults' => array()
                        )
                    )
                )
            ),
            
            'acquired-packages' => array(
                'type' => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/acquired-package',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Packages\Controller',
                        'controller' => 'AcquirePackages',
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
                                // 'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
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
            'Packages' => __DIR__ . '/../view'
        ),
        'template_map' => array(
            'package-create-snipet' => __DIR__ . '/../view/packages/partial/package-create-snipet.phtml',
            'package-view-snipet' => __DIR__ . '/../view/packages/partial/package-view-snipet.phtml',
            'packages-all-snipet' => __DIR__ . '/../view/partials/packages-all-snipet.phtml',
            "package_banner_upload_form"=>__DIR__ . '/../view/partials/packages_banner_upload_form_snippet.phtml',
            
            // Begin acquired Packages snippet
            "packages-acquired-packages-all-snipet" => __DIR__ . '/../view/partials/acquired-packages/packages-acquired-packages-all-snipet.phtml',
            "packages-acquire-package-info-view" => __DIR__ . '/../view/partials/acquired-packages/packages-acquired-package-info-view.phtml',
            "acuired-package-process-selected-objects" => __DIR__ . '/../view/partials/acquired-packages/packages-acquired-packages-object-list.phtml',
            "packages-acquired-package-message-snipet"=> __DIR__ . '/../view/partials/acquired-packages/packages-acquired-package-message-snipet.phtml',
            // End Acquired packages snipets
        ),
        "strategies"=>array(
            "ViewJsonStrategy"
        )
    ),
    
    'form_elements' => array(
        'factories' => array(
            'Packages\Form\Fieldset\PackageFieldset' => 'Packages\Form\Fieldset\Factory\PackageFieldsetFactory',
            "Packages\Form\Fieldset\FeaturedPackagesFieldset" => "Packages\Form\Fieldset\Factory\FeaturedPackagesFieldsetFactory",
            'Packages\Form\Fieldset\TravelPackageFieldset' => 'Packages\Form\Fieldset\Factory\TravelPackageFieldsetFactory',
            'Packages\Form\CreatePackagesForm' => 'Packages\Form\Factory\CreatePackageFormFactory',
            "Packages\Form\FeaturedPackageForm"=>"Packages\Form\Factory\FeaturedPackageFormFactory"
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
            'Packages\Service\PackageService' => 'Packages\Service\Factory\PackageServiceFactory',
            "Packages\Service\AcquirePackagesService" => "Packages\Service\Factory\AcquiredPackageServiceFactory"
        
        )
    ),
    
    "view_helpers" => array(
        'invokables' => array(
            "package_view_banner_image_helper"=>"Packages\View\Helper\PackageBannerViewPageHelper",
            "package_category_menu_for_customers" => "Customer\View\Helper\Packages\PackageCategoryMenuViewHelper",
            "package_banner_view" => "Packages\View\Helper\PackageBannerHelper",
            "acuired_package_process_selected_object_list" => "Packages\View\Helper\AcquiredPackagesSelectedObjectsHelper",
            "package_acquired_package_list_button" => "Packages\View\Helper\AcquiredPackagesButtonConditionHelper",
            "acquiredPackagesEstimatedPremium" => "Packages\View\Helper\AcquiredPackagesEstimatedPremiumHelper",
            "acquiredPackageInvoiceProcess" => "Packages\View\Helper\AcquiredPackagesInvoiceProcess",
            "acquiredPackageStatusInvoice" => "Packages\View\Helper\AcquirePackagePaymentStatus",
            "acquiredPackagesProcessCoverNote" => "Packages\View\Helper\AcquiredPackageProcessCovernoteHelper"
        )
    )
);
