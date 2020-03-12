<?php
namespace Navigations;

use Zend\View\HelperPluginManager;
use Authorization\Acl\Acl;
return array(
    'navigation' => [
        'offer-to-policy' => [],
        /**
         * This navigation provides a lin fro offer to policy
         */

        'create-user' => []
    /**
     * This navigation make provides a link for administrators to create users
     */
    ],

//     "view_helpers" => array(
//         'factories' => array(
//             // This will overwrite the native navigation helper
//             'main-navigation' => function (HelperPluginManager $pm) {
//                 $sm = $pm->getServiceLocator();
//                 $config = $sm->get('Config');

//                 // $acl = $sm->get('acl');

//                 $acl = new Acl($config);

//                 $auth = $sm->get('Zend\Authentication\AuthenticationService');
//                 $role = \Authorization\Acl\Acl::DEFAULT_ROLE;

//                 if ($auth->hasIdentity()) {
//                     $user = $auth->getIdentity();
//                     $role = $user->getRole()->getName();
//                 }

// //                 var_dump($role);
//                 // Get an instance of the proxy helper
//                 $navigation = $pm->get('Zend\View\Helper\Navigation');

//                 // Store ACL and role in the proxy helper:
//                 $navigation->setAcl($acl)->setRole($role);

//                 // Return the new navigation helper instance
//                 return $navigation;
//             }
//         )
//     ),

    'service_manager' => array(
        'factories' => []
    /**
     * This instantiates the vavigation above individually ie an object icreated for
     * create-user is different form that created for offer-to-policy navigation
     */
    )
);