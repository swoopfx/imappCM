<?php
/**
 * Coolcsn Zend Framework 2 Authorization Module
 * 
 * @link https://github.com/coolcsn/CsnAuthorization for the canonical source repository
 * @copyright Copyright (c) 2005-2013 LightSoft 2005 Ltd. Bulgaria
 * @license https://github.com/coolcsn/CsnAuthorization/blob/master/LICENSE BSDLicense
 * @author Stoyan Cheresharov <stoyan@coolcsn.com>, Stoyan Revov <st.revov@gmail.com>
 */
return array(
    'acl' => array(
//         /**
//          * By default the ACL is stored in this config file.
//          * If you activate the database_storage ACL will be constructed from the database via Doctrine
//          * and the roles and resources defined in this config wil be ignored.
//          *
//          * Defaults to false.
//          */
//         'use_database_storage' => false,
//         /**
//          * The route where Users are redirected if access is denied.
//          * Set to empty array to disable redirection.
//          */
//         'redirect_route' => array(
//             'params' => array(
//                 // 'controller' => 'my_controllet',
//                 // 'action' => 'my_action',
//                 // 'id' => '1',
//             ),
//             'options' => array(
//                 // We should redirect to an action Controller accessable for everyone. And this is "home" route
//                 // There should be a rule in the Acl allowing every role access to the action and controller
//                 // Usually this is the homepage action in our case CsnCms\Controller\Index action frontPageAction
//                 // the route 'home' = '/' should be overriden by CsnCms
//                 // In the case we are using login we enter an endless redirect. If you are loged in in the system as a User
//                 // to hide from the navigation the login action the coleagues are using Acl to deny access to login.
//                 // The CsnAuthorisation trys to redirect to not accessable action loginAction and it gets redirected back to it.
//                 // Much better is to redirect to an action for sure accessable from everyone and there is no better candidate than the homepage
//                 // the landing page for the requests to the domain.
//                 'name' => 'permissionerror' // 'login',
//             )
//         ),
//         /**
//          * Access Control List
//          * -------------------
//          */
//         'roles' => array(
//             'guest' => null,
//             'User' => 'guest',
//             'admin' => 'User',

// //             "Broker" => "User",
//             "Agent Setup" => "User",
//             "Broker Setup" => "User",
//             "User Profile Setup" => "User",
//             "Company Profile Setup" => "User",
//             "Customer" => "User",
//             "Company" => "User",
//             "Agent" => "User",
//             "Broker Child" => "User",
//             "Insurance Company" => "guest",
//             "Super Admin" => "User",
//             // "Agent Setup" => "User",

//             "Broker" => "Broker Child",
// //             "Broker"
//             "Super Admin"=>"Broker",
//             "Super Admin"=>"Customer",
//             "Super Admin"=>"Insurance Company"
//         ),
//         'resources' => array(
            
//             'allow' => array(
//                 "Analytics\Controller\Analytics"=>array(
//                     "all"=>"Super Admin"
//                 ),
                
//                 'Application\Controller\Index' => array(
//                     'application' => 'guest'
//                 ),
                
//                 "BrokersTool\Controller\BrokerTool"=>array(
//                     "all"=>"Broker",
                    
//                 ),
//                 "Claims\Controller\Claims"=>array(
//                     "all"=>"Broker Child"
//                 ),
// //                 "WasabiLib\Wizard\Wizard"=>array(
// //                     "all"=>"User"
// //                 ),
// //                 "WasabiLib\Controller\WasabiAbstractActionController"=>array(
// //                     "all"=>"User"
// //                 ),
                
//                 // Begin Customers
                
//                 "Customer\Controller\Index"=>array(
//                     "all"=>"Broker Child",
//                 ),
//                 "Customer\Controller\Client"=>array(
// //                     "all"=>"Customer"
//                     'login' => 'guest',
//                     'logout' => 'User',
//                     'index' => 'guest',
//                     "forgot"=>"guest",
//                     "resetPassword"=>"guest",
//                     "register"=>"User",
//                     "confirm-email"=>"guest",
//                     "landing"=>"guest",
//                 ),
//                 "Customer\Controller\Board"=>array(
//                     "all"=>"Customer",
//                 ),
//                 "Customer\Controller\Invoice"=>array(
//                     "all"=>"Customer",
//                 ),
//                 "Customer\Controller\Claims"=>array(
//                     "all"=>"Customer"
//                 ),
//                 "Customer\Controller\Packages"=>array(
//                     "all"=>"Customer"
//                 ),
//                 "Customer\Controller\Offer"=>array(
//                     "all"=>"Customer"
//                 ),
//                 "Customer\Controller\Policy"=>array(
//                     "all"=>"Customer"
//                 ),
//                 "Customer\Controller\Risk"=>array(
//                     "all"=>"Customer"
//                 ),
//                 "Customer\Controller\Proposal"=>array(
//                     "all"=>"Customer"
//                 ),
//                 "Customer\Controller\Message"=>array(
//                     "all"=>"Customer"
//                 ),
//                 "Customer\Controller\Object"=>array(
//                     "all"=>"Customer"
//                 ),
//                 "Customer\Controller\Transaction"=>array(
//                     "all"=>"Customer"
//                 ),
//                 "Customer\Controller\Payment"=>array(
//                     "all"=>"Customer"
//                 ),
                
//                 // General
//                 "General\Controller\General"=>array(
//                     "all"=>"guest"
//                 ),
                
//                 "GeneralServicer\Controller\Portal"=>array(
//                     "all"=>"guest"
//                 ),
                
//                 // Help
//                 "Help\Controller\Help"=>array(
//                     "all"=>"Super Admin"
//                 ),
                
//                 // Home
//                 "Home\Controller\Index"=>array(
//                     "all"=>"Broker Child"
//                 ),
//                 "Home\Controller\Activate"=>array(
//                     "all"=>"Super Admin"
//                 ),
                
//                 // Begin Job
//                 "Job\Controller\Policyjob"=>array(
//                     "all"=>"guest"
//                 ),
                
//                 "Job\Controller\Policyjob"=>array(
//                     "all"=>"guest"
//                 ),
                
//                 "Job\Controller\Invoicejob"=>array(
//                     "all"=>"guest"
//                 ),
                
//                 "Job\Controller\Objectjob"=>array(
//                     "all"=>"guest"
//                 ),
//                 // End Job
                
//                 "Messages\Controller\Messages"=>array(
//                     "all"=>"User"
//                 ),
                
//                 "Object\Controller\Index"=>array(
//                     "all"=>"User"
//                 ),
//                 "Offer\Controller\Index"=>array(
//                     "all"=>"User"
//                 ),
                
//                 "Packages\Controller\Package"=>array(
//                     "all"=>"User"
//                 ),
//                 "Packages\Controller\AcquirePackages"=>array(
//                     "all"=>"User"
//                 ),
                
//                 // Begin Policy
//                 "Policy\Controller\Index"=>array(
//                     "all"=>"User"
//                 ),
                
//                 "Policy\Controller\Policy"=>array(
//                     "all"=>"User"
//                 ),
                
//                 "Policy\Controller\CoverNote"=>array(
//                     "all"=>"User"
//                 ),
                
//                 // End Policy
                
//                 "Proposal\Controller\Index"=>array(
//                     "all"=>"Broker Child",
// //                     "pre-process"=>"User"
//                 ),
                
//                 "Proposal\Controller\Proposalmodal"=>array(
//                     "all"=>"User"
                    
//                 ),
//                 "Report\Controller\Report"=>array(
//                     "all"=>"Broker",
//                     "all"=>"Customer"
//                 ),
                
//                 "Settings\Controller\Settings"=>array(
//                     "broker-bank-account"=>"Broker",
//                     "newlogoupload"=>"Broker",
//                     "account-name"=>"Broker",
//                     "profile"=>"Broker",
//                     "webconfig"=>"Broker",
                    
//                 ),
                
//                 "Settings\Controller\Account"=>array(
//                     "edit-profile"=>"Broker",
//                     "renew-account"=>"Broker",
//                     "broker-bank-account"=>"Broker",
//                     "profile"=>"Broker",
//                     "newlogoupload"=>"Broker",
                   
//                 ),
                
//                 "SMS\Controller\Index"=>array(
// //                     "all"=>"User"

//                     "processbuysmsmodal"=>"Broker",
//                     "cardpaymentmodal"=>"Broker",
//                     'processcardotp'=>"Broker",
//                     "buy-sms"=>"Broker",
//                 ),
                
//                 "Transactions\Controller\Transactions"=>array(
//                     "all"=>"User"
//                 ),
                
//                 "Transactions\Controller\Invoice"=>array(
//                     "all"=>"guest",
//                     "micro-payment"=>"User"
//                 ),
                
//                 "Users\Controller\Broker"=>array(
//                     "editprofilemodal"=>"Broker",
//                     "setup"=>"Broker Setup",
//                     "setup-data"=>"Broker Setup",
//                     "setup-invoice"=>"Broker Setup",
//                     "upload-logo"=>"Broker",
//                     "info"=>"Broker Setup",
//                     "profile"=>"Broker"
//                 ),
                
//                 "Welcome\Controller\Index"=>array(
//                     "all"=>"guest"
//                 ),
//                 "Welcome\Controller\Manager"=>array(
//                     "all"=>"guest"
//                 ),
                
//                 'CsnUser\Controller\Registration' => array(
//                     'index' => 'guest',
//                     'changePassword' => 'User',
//                     'editProfile' => 'User',
//                     'changeEmail' => 'User',
//                     'forgottenPassword' => 'guest',
//                     'confirmEmail' => 'guest',
//                     'registrationSuccess' => 'guest'
//                     // "proposal"=>"guest"
//                 ),
//                 'CsnUser\Controller\Index' => array(
//                     'login' => 'guest',
//                     'logout' => 'User',
//                     'index' => 'guest'
//                 ),
//                 'CsnCms\Controller\Index' => array(
//                     'all' => 'guest'
//                 ),
//                 'CsnCms\Controller\Article' => array(
//                     'view' => 'guest',
//                     'vote' => 'User',
//                     'index' => 'admin',
//                     'add' => 'admin',
//                     'edit' => 'admin',
//                     'delete' => 'admin'
//                 ),
//                 'CsnCms\Controller\Translation' => array(
//                     'index' => 'admin',
//                     'add' => 'admin',
//                     'edit' => 'admin',
//                     'delete' => 'admin'
//                 ),
//                 'CsnCms\Controller\Comment' => array(
//                     'index' => 'User',
//                     'add' => 'User',
//                     'edit' => 'User',
//                     'delete' => 'User'
//                 ),
//                 'CsnCms\Controller\Category' => array(
//                     'index' => 'admin',
//                     'add' => 'admin',
//                     'edit' => 'admin',
//                     'delete' => 'admin'
//                 ),
//                 'CsnFileManager\Controller\Index' => array(
//                     'all' => 'User'
//                 ),

// //                 "Proposal\Controller\Index" => array(
// // //                     "all" => "Broker",
// //                     "my-proposals" => "Broker"
// //                 ),
//                 'Home\Controller\Index' => array(
//                     'all' => 'User'
//                 ),
//                 'Zend' => array(
//                     'uri' => 'User'
//                 ),
               
//                 // for CMS articles
//                 'all' => array(
//                     'view' => 'guest'
//                 ),
//                 'Public Resource' => array(
//                     'view' => 'guest'
//                 ),
//                 'Private Resource' => array(
//                     'view' => 'User'
//                 ),
//                 'Admin Resource' => array(
//                     'view' => 'admin'
//                 )
//             ),
//             'deny' => array(
//                 'CsnUser\Controller\Index' => array(
//                     'login' => 'User'
//                 ),
//                 'CsnUser\Controller\Registration' => array(
//                     'index' => 'User'
//                 ),
                
//                 "SMS\Controller\Index"=>array(
// //                     "buy-sms"=>"Broker Child"
//                 ),
// //                 "Proposal\Controller\Index" => array(
// // //                     "all" => "Broker",
// //                                         "my-proposals" => "Broker"
// //                 ),
//             )
//         )
    )
);
