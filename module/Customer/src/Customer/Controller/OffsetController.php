<?php
namespace Customer\Controller; 

/**
 * This handles all unconcvetional Customer functionalities
 * @author otaba
 * @copyright Ajayi Oluwaseun Ezekiel
 */

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class OffsetController extends AbstractActionController{
	
	
	public function indexAction(){
		
		$view = new ViewModel();
		return $view;
	}
}