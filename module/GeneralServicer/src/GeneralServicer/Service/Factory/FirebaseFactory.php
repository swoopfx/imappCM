<?php
namespace GeneralServicer\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Factory;
use GeneralServicer\Service\FireBaseService;

/**
 *
 * @author otaba
 *        
 */
class FirebaseFactory implements FactoryInterface
{

    /**
     */
    public function __construct()
    {

        // TODO - Insert your code here
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $xserv = new FireBaseService();
        
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__."/chat-8c5cb-firebase-adminsdk-7it2z-bc7531037b.json");
//         var_dump(__DIR__);
//         $firebase = new Factory();
//         var_dump($serviceAccount);
//         $firebase->withServiceAccount($serviceAccount)
//             ->withDatabaseUri('https://chat-8c5cb.firebaseio.com')
//             ->create();

        $firebase = (new Factory)
        ->withServiceAccount($serviceAccount)
//         ->withDatabaseUri('https://chat-8c5cb.firebaseio.com')
        ->create();
        $database = $firebase->getDatabase();
//         die(print_r($database));

//         var_dump();

//         var_dump($database);
        $ref = $database->getReference('brk123');
//         die(print_r($ref->getKey()));
//         die(print_r());
//         try{
//             var_dump($ref->getChild("isyping")->getValue());
//         }catch (\Exception $e){
//                 die(printf($e->getMessage()));
//             }
//         ->push([
//             'title' => 'Post title',
//             'body' => 'This should probably be longer.'
//         ]);
        
//         var_dump($database->getReference("/brk123/cus456/content")->getSnapshot()->getValue());
//         try{
//             $database->getReference("brk123/cus123")->update([
// //                 'name' => 'My Application',
// //                 'emails' => [
// //                     'support' => 'support@domain.tld',
// //                     'sales' => 'sales@domain.tld',
// //                 ],
// //                 'website' => 'https://app.domain.tld',

//                 "mail"=>"Blsessed"
//             ]);
            
//         }catch (\Exception $e){
//                             die(printf($e->getMessage()));
//                         }
        
//         $snapshot = $reference->getSnapshot();
//         var_dump($snapshot);
        
//             var_dump($serviceAccount);

//         $database = $firebase->getData();
//         var_dump($database);

//             var_dump($firebase);
        $xserv->setConnection($firebase);
        return $xserv;
    }
}

/**
 * <!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/6.5.0/firebase-app.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#config-web-app -->

<script>
  // Your web app's Firebase configuration
  var firebaseConfig = {
    apiKey: "AIzaSyD16uZJTCaXBiNGtk6L7c7F_osRqaXA6z0",
    authDomain: "chat-7bf7e.firebaseapp.com",
    databaseURL: "https://chat-7bf7e.firebaseio.com",
    projectId: "chat-7bf7e",
    storageBucket: "",
    messagingSenderId: "630983853221",
    appId: "1:630983853221:web:1184a74fc339561a"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
</script>
 */

