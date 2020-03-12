<?php
namespace Tools\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AgentToolController extends AbstractActionController
{

    public function indexAction()
    {
        return new ViewModel();
    }
}

