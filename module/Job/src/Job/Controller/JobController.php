<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Job for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Job\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class JobController extends AbstractActionController
{
    
    private $entityManager;
    
    private $clientGeneralService;
    
    private $generalService;
    
    public function indexAction()
    {
        return array();
    }

    public function fooAction()
    {
        // This shows the :controller and :action parameters in default route
        // are working when you browse to /job/job/foo
        return array();
    }
    
    /**
     * This function is run at the beginning of the month 
     * It provides an overview of the customers whole information on the platform
     * Anount of Objects 
     * @return mixed
     */
    public function jobAccountStatusAction(){
        return $this->getResponse()->setContent(NULL);
    }
    
    public function setGeneralService($xserv){
        $this->generalService = $xserv;
        return $this;
    }
    
    public function setClientGeneralService($xserv){
        $this->clientGeneralService = $xserv;
        return $this;
    }
    
    public function setEntityManager($em){
        $this->entityManager = $em;
        return $this;
    }
}
