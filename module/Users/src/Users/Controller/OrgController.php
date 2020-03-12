<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * OrgController
 * This Controller makes all information for the profile odf organisation available
 * It also provides tool s required for the properer setup of organisational acount
 * 
 * @author
 *
 * @version
 *
 */
class OrgController extends AbstractActionController
{

    /**
     * The default action - show the home page
     */
    public function indexAction()
    {
        // TODO Auto-generated OrgController::indexAction() default action
        return new ViewModel();
    }
}