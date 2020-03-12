<?php
namespace Users\Form;

use Zend\Form\Form;

class BrokerLogoUploadForm extends Form
{

    public function init()
    {
        $this->setAttributes(array(
            'method' => 'POST',
            'class' => 'form-horizontal form-label-left',
            //'data-ng-show'=>"formShow"
        ));
        
        $this->add(array(
            'name' => 'upload',
            'type' => 'Users\Form\Fieldset\BrokerLogoUploadFieldset',
            'options' => array(
                'use_as_base_fieldset' => true
            )
        ));
        
        $this->add(array(
            'name' => 'send',
            'type' => 'button',
            'options' => array(
                'label' => 'Upload'
            ),
            'attributes' => array(
                'data-ng-click' => 'upload()',
                'class'=>'btn btn-default col-md-6 col-sm-6 col-xs-12 col-md-offset-6'
            )
        ));
    }
}

?>