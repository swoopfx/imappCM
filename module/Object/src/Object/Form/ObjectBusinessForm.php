<?php
namespace Object\Form;

use Zend\Form\Form;

/**
 *
 * @author otaba
 *        
 */
class ObjectBusinessForm extends Form
{

    
    
    public function init(){
        $this->setAttributes(array(
            "method"=>"POST",
        ));
        $this->addFields();
        $this->addCommon();
    }
    
    private function addFields()
    {
        $this->add(array(
            'name' => "objectBusinessFieldset",
            "type" => "Object\Form\Fieldset\ObjectBusinessFeildset",
            'options' => array(
                'use_as_base_fieldset' => true
            )
        ));
    }
    
    private function addCommon()
    {
//         $this->add(array(
//             'name' => 'csrf',
//             'type' => 'Zend\Form\Element\Csrf',
//             'options' => array(
//                 'csrf_options' => array(
//                     'timeout' => 600
//                 )
//             )
//         ));
        
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
                'value' => 'COMPLETE',
                'class' => 'btn btn-lg btn-primary btn-block  btn-xs',
                'id' => 'create-object'
            )
        ));
    }
}

