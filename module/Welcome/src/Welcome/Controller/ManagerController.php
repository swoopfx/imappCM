<?php
namespace Welcome\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 *
 * @author swoopfx
 *        
 */
class ManagerController extends AbstractActionController
{

    public function onDispatch(\Zend\Mvc\MvcEvent $e)
    {
        $response = parent::onDispatch($e);
        $this->layout()->setTemplate('layout/welcome');
        return $response;
    }
    
    // public function __construct()
    // {
    
    // // TODO - Insert your code here
    // }
    public function indexAction()
    {
        $view = new ViewModel();
        return $view;
    }

    public function priceAction()
    {
        $view = new ViewModel();
        return $view;
    }
}

?>