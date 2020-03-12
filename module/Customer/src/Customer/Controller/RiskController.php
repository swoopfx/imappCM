<?php
namespace Customer\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * RiskController
 *
 * @author Ajayi Oluwaseun Ezekiel
 * @copyright AJayi Oluwaseun Ezekiel
 * @version
 *
 */
class RiskController extends AbstractActionController
{

    public function onDispatch(\Zend\Mvc\MvcEvent $e)
    {
        $response = parent::onDispatch($e);
        $this->customerRedirectPlugin()->totalRedirection();
        $this->layout()->setTemplate('client-layout-board');
        return $response;
    }
    
    
    public function indexAction()
    {
        // TODO Auto-generated RiskController::indexAction() default action
        return new ViewModel();
    }
}