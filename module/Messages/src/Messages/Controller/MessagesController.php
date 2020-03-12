<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Messages for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Messages\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class MessagesController extends AbstractActionController
{
    
    private $entityManager;
    /**
     * list all available messages on the application
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        return array();
    }
    
    public function viewmessagesAction(){
        $view = new ViewModel();
        return $view;
    }

    public function fooAction()
    {
        // This shows the :controller and :action parameters in default route
        // are working when you browse to /messages/messages/foo
        return array();
    }
    
    /**
     * Show the message Box 
     */
    public function boxAction(){
        
    }
    
    public function setEntityManager($em){
        $this->entityManager = $em;
        return $this;
    }
}
