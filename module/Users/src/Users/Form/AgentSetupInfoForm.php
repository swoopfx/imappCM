<?php
namespace Users\Form;

use Zend\Form\Form;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Validator\Digits;

/**
 *
 * @author swoopfx
 *        
 */
class AgentSetupInfoForm extends Form implements InputFilterProviderInterface
{

    /**
     */
    public function init()
    {
         $this->setAttributes(array(
            'name' => 'agentsetupForm',
            'action' => '/user/agent/setup',
            'method' => 'POST',
            'enctype' => 'multipart/form-data',
            'class' => 'form-horizontal form-label-left'
        ));
         $this->addCommon();
         $this->setUpacceptCheck();
      
    }
    
    private function addCommon(){
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
                'value' => 'Next',
                'class' => 'btn btn-success',
                'id' => 'create-object'
            )
        ));
    }
    
    private function setUpacceptCheck(){
        $this->add(array(
            'name' => 'acceptance',
            'type' => 'Zend\Form\Element\Checkbox',
            'options' => array(
                'use_hidden_element' => true,
                'checked_value' => 1,
                'unchecked_value' => 'no',
                'label' => 'I understand and accept the terms and conditions specified above',
                'label_attributes'=>array(
                    'class'=>'col-md-5 col-sm-5 col-xs-12',
                ),
               
            )
            ,
            'attributes' => array(
                'value' => 'no',
                //'class' => 'flat',
                'checked' => false,
                'required'=>'required'
            )
        ));
    }
    /**
     * {@inheritDoc}
     * @see \Zend\InputFilter\InputFilterProviderInterface::getInputFilterSpecification()
     */
    public function getInputFilterSpecification()
    {
       return array(
           'acceptance'=>array(
              'validators' => array(
                            array(
                                'name' => 'Digits',
                                'break_chain_on_failure' => true,
                                'options' => array(
                                    'messages' => array(
                                        Digits::NOT_DIGITS => 'You must agree to the terms of use.',
                                    ),
                                ),
                            ),
                        ),
               
           )
       );
        
    }

}

