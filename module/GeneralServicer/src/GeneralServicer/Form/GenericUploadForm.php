<?php
namespace GeneralServicer\Form;

use Zend\Form\Form;

/**
 *
 * @author otaba
 *        
 */
class GenericUploadForm extends Form
{

    // TODO - Insert your code here
    
    /**
     */
    public function init(){
        $this->setAttributes(array(
            "method"=>"POST",
            "action"=>"",
            "class"=>"form-horizontal form-label-left"
        ));
        $this->add(array(
            "name"=>"uploadFeild",
            "type"=>"GeneralServicer\Form\Fieldset\UploadFieldset",
            "options"=>array(
                "use_as_base_fieldset"=>true
            ),
        ));
    }
    
    private function addFields(){
        
       
    }
}

