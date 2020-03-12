<?php
namespace Tools\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class BrokerToolController extends AbstractActionController
{

    public function indexAction()
    {
        return new ViewModel();
    }
}

