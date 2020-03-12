<?php
namespace GeneralServicer\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;


/**
 * DocumentController
 *
 * @author
 *
 * @version
 *
 */
class DocumentController extends AbstractActionController
{

  private $uploadForm;
   
  public function uploadAction(){
  	$uploadForm = $this->uploadForm;
  	$view = new ViewModel();
  	return $view;
  }
  
  public function setUploadForm($form){
  	$this->uploadForm = $form;
  	return $this;
  }
}