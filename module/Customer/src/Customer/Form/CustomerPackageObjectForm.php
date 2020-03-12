<?php
namespace Customer\Form;

use Zend\Form\Form;

/**
 *
 * @author otaba
 *        
 */
class CustomerPackageObjectForm extends Form
{

    
    public function init(){
        $this->setAttributes(array(
            "method" => "POST",
            "id" => "ajax_element",
            "action"=>"uploadobjects",
            'data-ajax-loader'=>"myLoader"
        ));
        
        $this->addField();
        $this->addCommon();
    }
    
    private function addField()
    {
        $this->add(array(
            'type' => 'Object\Form\Fieldset\ObjectFieldset',
            'name' => 'objectFieldset',
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
                'csrf_options' => array(
                    'timeout' => 600
                )
            )
        ));
        
        $this->add(array(
            'name' => 'reset',
            'type' => 'Zend\Form\Element',
            'options' => array(),
            
            'attributes' => array(
                'class' => 'btn btn-primary',
                'value' => 'Reset',
                'id' => 'reset'
            )
        ));
        
        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Create',
                'class' => 'btn btn-success',
                'id' => 'create-object'
            )
        ));
    }
}

