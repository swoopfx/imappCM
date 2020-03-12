<?php
namespace Customer\Form;

use Zend\Form\Form;


/**
 *
 * @author swoopfx
 *        
 */
class CustomerForm extends Form
{

    /**
     */
    public function init()
    {
        
        $this->setAttributes(array(
            'action' => '/customer/new',
            'method' => 'POST',
            'class' => 'form-horizontal form-label-left',
           
            'data-ng-controller'=>"customerController",
            //'novalidate'=>false
        ));
        $this->addCommon();
        $this->addFieldset();
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
                'label' => 'Is not a company',
                'value_options' => array(
                    '0' => 'Individual',
                    '1' => 'Company/Organisation',
                   
                ),
            ),
            'attributes'=>array(
                'value' => '0',
                'data-ng-model'=>"dob",
                //'class'=>'flat',
                'data-ng-change' => "isDobF(dob)",
                'required'=>'required'
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
            'name' => 'reset',
            'type' => 'Zend\Form\Element',
            'options' => array()
    
            ,
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
                'value' => 'Register Customer',
                'class' => 'btn btn-success',
                 
            )
        ));
    }
}

