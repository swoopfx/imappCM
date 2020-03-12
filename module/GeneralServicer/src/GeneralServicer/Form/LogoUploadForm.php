<?php
namespace GeneralServicer\Form;

use Zend\Form\Form;

/**
 *
 * @author otaba
 *        
 */
class LogoUploadForm extends Form
{

    private $entityManager;

    public function init()
    {
        $this->setAttributes(array(
            "action" => "",
            "method" => "POST",
            "id"=>"uploadForm"
            
        
        ));
        
        $this->addFields();
    }

    private function addFields()
    {
        $this->add(array(
            'name' => 'userImage',
            'type' => 'Zend\Form\Element\File',
            'options' => array(
                'label' => 'Upload Logo',
                'label_attributes' => array(
                    'class' => 'control-label col-md-12 col-sm-12 col-xs-12'
                )
            ),
            'attributes' => array(
                'id' => 'userImage',
                'class' => 'form-control col-md-12 col-sm-12 col-xs-12 demoInputBox',
                "required"=>"required"
                //'multiple' => true
            )
        ));
        
        $this->add(array(
            'name' => 'upload',
            'type' => 'submit',
            'options' => array(
            ),
            'attributes' => array(
                'value' => 'Submit',
                "id"=>"btnSubmit",
                "class" => "btn btn-block btn-primary btnSubmit"
            )
        ));
    }
}

