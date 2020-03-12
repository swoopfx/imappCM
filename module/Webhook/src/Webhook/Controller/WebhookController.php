<?php
namespace Webhook\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class WebhookController extends AbstractActionController
{

    // TODO - Insert your code here
    public function __construct()
    {

        // TODO - Insert your code here
    }
    
    public function indexAction(){
        $viewModel = new ViewModel();
        return $viewModel;
    }
}

