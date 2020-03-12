<?php
namespace Comments\Form;

use Zend\Form\Form;

class CommentForm extends Form
{

    public function init()
    {
        $this->setAttributes(array(
            "method"=>"POST"
        ));

        $this->add(array(
            "name" => "commentFieldset",
            "type" => "Comments\Form\Fieldset\CommentFieldset",
            'options'=>array(
                'use_as_base_fieldset'=>true
            ),
        ));
        
        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'SEND',
                'class' => 'btn btn-success btn-block btn-xs', // col-lg-offset-2
                'id' => 'send'
            )
        ));
    }
}

