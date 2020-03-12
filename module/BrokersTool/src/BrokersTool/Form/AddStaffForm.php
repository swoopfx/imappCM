<?php
namespace BrokersTool\Form;

use Zend\Form\Form;

/**
 *
 * @author swoopfx
 *        
 */
class AddStaffForm extends Form
{

    // TODO - Insert your code here
    
    /**
     */
    public function init()
    {
        $this->setAttributes(array(
            'name' => 'add-staff',
            'method' => 'POST',
            'action' => '/broker-tool/add-staff',
            'class' => 'form-horizontal form-label-left',
            'id' => 'add-staff',
            "data-ajax-loader"=>"myLoader"
        ));
        $this->addFields();
        $this->addCommon();
    }

    public function addFields()
    {
        $this->add(array(
            'name' => 'userBasicField',
            'type' => 'CsnUser\Form\Fieldset\UserBasicFieldset',
            'options' => array(
                'use_as_base_fieldset' => true
            )
        
        ));
        // $this->add(array(
        // 'name'=>'brokerChildProfile',
        // 'type'=>'BrokersTool\Form\Fieldset\BrokerChildProfileFieldset',
        
        // ));
    }

    public function addCommon()
    {
        $this->add(array(
            'name' => 'csrf',
            'type' => 'Zend\Form\Element\Csrf',
            'options' => array(
                'csrf_options' => array(
                    'timeout' => 600
                )
            )
        ));
        
        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                
                'class' => 'btn btn-primary btn-block',
                'value' => 'Create Staff',
                'type' => 'submit'
            )
        ));
    }
}

