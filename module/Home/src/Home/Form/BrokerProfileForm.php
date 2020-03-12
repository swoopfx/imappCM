<?php
namespace Home\Form;

use Zend\Form\Form;

/**
 *
 * @author otaba
 *        
 */
class BrokerProfileForm extends Form
{

    public function init()
    {
        $this->setAttributes(array(
            "method" => "POST",
            "class" => "form-horizontal form-label-left"
        ));
        $this->addField();
        $this->addCommon();
    }

    private function addField()
    {
        $this->add(array(
            "name" => "brokerProfileFieldset",
            'type' => 'Users\Form\Fieldset\BrokerSetUpDataFieldset',
            'options' => array(
                'use_as_base_fieldset' => true
            )
        ));
    }

    private function addCommon()
    {
        $this->add(array(
            'name' => 'csrf',
            'type' => 'Zend\Form\Element\Csrf',
            'options' => array(
                // 'csrf_options' => array(
                // 'timeout' => 600
                // )
            )
        ));
        
        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Set Up',
                'class' => 'btn btn-success',
                'id' => 'create-object'
            )
        ));
    }
}

