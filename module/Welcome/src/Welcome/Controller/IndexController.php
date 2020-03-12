<?php
namespace Welcome\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{

    public function onDispatch(\Zend\Mvc\MvcEvent $e)
    {
        $response = parent::onDispatch($e);

        return $response;
    }

    public function indexAction()
    {
        $this->layout()->setTemplate('welcome/welcome/layout');
        // $this->layout()->setTemplate('welcome/welcome/layout');
        $view = new ViewModel();
        return $view;
    }

    public function permissionerrorAction()
    {
        $this->layout()->setTemplate("error/4033");
        $request = $this->getRequest();


        if ($request->getHeader("referer") == FALSE) {

            $referBack = $this->url()->fromRoute("welcome", array(), array(
                "force_canonical" => true
            ));
        } else {

            $referBack = $request->getHeader("referer")->getUri();
        }

        $viewModel = new ViewModel(array(
            "referBack" => $referBack
        ));
        return $viewModel;
    }

    // public function aboutAction()
    // {
    // $view = new ViewModel();
    // return $view;
    // }

    // public function priceAction()
    // {
    // $view = new ViewModel();
    // return $view;
    // }
}