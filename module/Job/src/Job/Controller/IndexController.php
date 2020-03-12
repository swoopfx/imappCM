<?php
namespace Job\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 *
 * @author otaba
 *        
 */
class IndexController extends AbstractActionController
{

    /**
     */
    public function __construct()
    {}
    
    public function indexAction(){
        $view = new ViewModel();
        return $view;
    }
}

