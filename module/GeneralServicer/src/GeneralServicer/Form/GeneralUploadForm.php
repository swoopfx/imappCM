<?php
namespace GeneralServicer\Form;

use Zend\Form\Form;

/**
 *
 * @author otaba
 *        
 */
class GeneralUploadForm extends Form
{

    public function init(){
        $this->setAttributes(array(
            "method"=>"POST",
            'class'=>'form-horizontal form-label-left',
            'class'=>'dropzone',
        ));
        $this->addFields();
    }
    
    public function  addFields(){
        $this->add(array(
            'name'=>'uploadField',
            'type'=>'GeneralServicer\Form\Fieldset\UploadFieldset',
            'options'=>array(
                'use_as_base_fieldset' => true
            ),
        ));
    }
}

