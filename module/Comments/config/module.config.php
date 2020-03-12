<?php
namespace Comments;

return array(
    'controllers' => array(

        "factories" => array(
            'Comments\Controller\Index' => 'Comments\Controller\Factory\IndexControllerFactory'
        )
    ),
    'router' => array(
        'routes' => array(
            'comments' => array(
                'type' => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/index',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Comments\Controller',
                        'controller' => 'Index',
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
            )
        )
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Comments' => __DIR__ . '/../view'
        ),
        "template_map" => array(
            'comment-form' => __DIR__ . '/../view/form/comment_form_snippet.phtml'
        )
    ),
    "form_elements" => array(
        'factories'=>array(
            "Comments\Form\Fieldset\CommentFieldset" => "Comments\Form\Fieldset\Factory\CommentFieldsetFactory",

            "Comments\Form\CommentForm" =>"Comments\Form\Factory\CommentFormFactory"
        )
    ),
    
    'view_helpers' => array(
        'invokables' => array(
            "commentViewHelper"=>"Comments\View\Helper\CommentViewHelper"
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
