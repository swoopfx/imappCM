<?php
namespace Webhook;

return array(
    "controllers" => array(
//         "invokables"=>array(
//             "Webhook\Controller\Webhook" => "Webhook\Controller\WebHookController"
//         ),
        
        "factories" => array(
            "Webhook\Controller\Initiatebrokertransfer" => "Webhook\Controller\Factory\InitiatebrokertransferControllerFactory",
           
        )
    ),
    'view_manager' => array(
        'strategies' => array(
            'ViewJsonStrategy',
        ),
//         'template_path_stack' => array(
//             'Webhook' => __DIR__ . '/../view'
//         ),
//        
       
    ),
    "service_manager" => array(
        "factories" => array()
    ),
    "router" => array(
        "routes" => array(
            "webhook" => array(
                "type" => "Literal",
                "options" => array(
                    "route" => "/webhook",
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Webhook\Controller',
                        'controller' => 'Initiatebrokertransfer'
                        // 'action' => 'overview'
                    )
                ),
                "may_terminate" => true,
                "child_routes" => array(
                    // This route is a sane default when developing a module;
                    // as you solidify the routes for your module, however,
                    // you may want to remove it and replace it with more
                    // specific routes.
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '[/:controller[/:id]]',
                            'constraints' => array(

                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '[0-9]+'
                            ),
                            'defaults' => array()
                        )
                    )
                )
            ),

//             "hook" => array(
//                 "type" => "segment",
//                 "options" => array(
//                     "route" => "/hook",
//                     'defaults' => array(
//                         // Change this value to reflect the namespace in which
//                         // the controllers for your module are found
//                         '__NAMESPACE__' => 'Webhook\Controller',
//                         'controller' => 'Webhook',
//                         'action' => 'index'
//                     )
//                 ),
//                 "may_terminate" => true,
//                 "child_routes" => array(
//                     // This route is a sane default when developing a module;
//                     // as you solidify the routes for your module, however,
//                     // you may want to remove it and replace it with more
//                     // specific routes.
//                     'default' => array(
//                         'type' => 'Segment',
//                         'options' => array(
//                             'route' => '[/:controller[/:action]]',
//                             'constraints' => array(

//                                 'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
//                                 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
//                                 'id' => '[0-9]+'
//                             ),
//                             'defaults' => array()
//                         )
//                     )
//                 )
//             )
        )
    )
);