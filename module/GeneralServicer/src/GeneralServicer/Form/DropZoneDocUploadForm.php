<?php
namespace GeneralServicer\Form;

use Zend\Form\Form;

/**
 *
 * @author otaba
 *        
 */
class DropZoneDocUploadForm extends Form
{

    
    
    /**
     */
   public function init(){
       $this->setAttributes(array(
           "class"=>"dropzone",
           "method"=>"POST",
          // "action"=>"gooo",
          // "id"=>"dropzone"
       ));
       
       $this->add(array(
           "name"=>"upload",
           "type"=>"submit",
           "options"=>array(),
           'attributes' => array(
               'value' => 'Upload',
               "class" => "btn btn-block btn-primary"
           )
       ));
   }
}

