<?php
namespace Customer\Form;

use Zend\Form\Form;

/**
 *
 * @author swoopfx
 *        
 */
class ClientRegisterForm extends Form
{
   
    public function init(){
        $this->setAttributes(array(
            'action'=>'',
            'method'=>'POST',
            'data-ng-controller'=>"customerController",
        		'role'=>'form'
        ));
        $this->addFieldset();
        $this->addCommon();
        $this->isIndividual();
    }
    
    private function addFieldset(){
        $this->add(array(
            'name'=>'customerFieldset',
            'type'=>'Customer\Form\Fieldset\CustomerFieldset',
            'options'=>array(
                'use_as_base_fieldset'=>true,
            ),
        ));
    }
    
    private function isIndividual(){
    
        $this->add(array(
            'name'=>'individual',
            'type'=>'radio',
            'options'=>array(
                'label' => 'Customer Category',
                'value_options'=>array(
                    '1'=>'Organisation / Company',
                    '2'=>'Individual / Person'
                )
            ),
            'attributes'=>array(
                'value' => '1',
                // 'class'=>'flat',
                
            ),
        ));
    }
    
    private function addCommon()
    {
        $this->add(array(
            'name' => 'csrf',
            'type' => 'Zend\Form\Element\Csrf',
            'options' => array(
                'csrf_options' => array(
                    'timeout' => 1200
                )
            )
        ));
        $this->add(array(
            'name' => 'terms',
            'type' => 'checkbox',
            'options' => array(
                'label'=>'I Agree with Terms and Conditions'
            ) ,
            'attributes' => array(
               'value'=>'yes',
               'required'=>'required',
                'id'=>'agree'
                
            )
        ));
    
        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Register',
                'class' => 'btn btn-success',
                 
            )
        ));
    }
}

