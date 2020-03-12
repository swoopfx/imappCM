<?php
namespace Transactions\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use WasabiLib\Ajax\Response;



/**
 * This provides information about 
 * @author otaba
 *        
 */
class WebhookController extends AbstractActionController
{

   private $entityManager;
   
   
   public function initiatebrokertransfercallbackAction(){
       $response = new Response();
       $em = $this->entityManager;
       $request = $this->getRequest();
       if($request->isPost()){
           $data = $request->getPost()->toArray();
       }else{
           
       }
       return $this->getResponse()->setContent(NULL);
   }
   
//    public function 
    
    /**
     */
    public function __construct()
    {
        
        // TODO - Insert your code here
    }
    /**
     * @return mixed
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }

    /**
     * @param mixed $entityManager
     */
    public function setEntityManager($entityManager)
    {
        $this->entityManager = $entityManager;
        return $this;
    }

}

