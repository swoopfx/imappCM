<?php
namespace Job;

return array(
    'controllers' => array(
        'invokables' => array(
            'Job\Controller\Job' => 'Job\Controller\JobController',
            
        ),
        'factories' => array(
            "Job\Controller\Policyjob"=>"Job\Controller\Factory\PolicyjobControllerFactory",
            "Job\Controller\Invoicejob"=>"Job\Controller\Factory\InvoicejobControllerFactory",
            "Job\Controller\Objectjob"=>"Job\Controller\Factory\ObjectjobControllerFactory",
            
        ),
    ),
    'router' => array(
        'routes' => array(
            'job' => array(
                'type'    => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route'    => '/job',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Job\Controller',
                        'controller'    => 'Job',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    // This route is a sane default when developing a module;
                    // as you solidify the routes for your module, however,
                    // you may want to remove it and replace it with more
                    // specific routes.
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        ),
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
            "Job\Service\PaymentJobService"=>"Job\Service\Factory\PaymentJobServiceFactory",
            
        ),
    ),
    
    'view_manager' => array(
        'template_path_stack' => array(
            'Job' => __DIR__ . '/../view',
        ),
    ),
);
