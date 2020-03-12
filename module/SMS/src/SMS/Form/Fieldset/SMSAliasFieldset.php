<?php
namespace SMS\Form\Fieldset;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

class SMSAliasFieldset extends Fieldset implements InputFilterProviderInterface
{

    /**
     *
     * {@inheritdoc}
     *
     * @see \Zend\InputFilter\InputFilterProviderInterface::getInputFilterSpecification()
     */
    public function init()
    {}

    private function addFeilds()
    {
        $this->add(array(
            'name' => 'alais',
            'type' => 'text',
            'options' => array(
                'label' => 'SMS ALIAS',
                'label_attributes' => array(
                    'class' => ''
                )
                ,
                'attributes' => array(
                    'id'=>'sms_alias',
                    'class'=>'form-control col-md-6 col-sm-6 col-xs-12 alias',
                    'placeholder' => 'A minimum of 11 letter ',
                    'required' => "required",
                    'data-validate-words' => "2",
                    'data-validate-length-range' => '6' 
                )

                
            )
            
        ));
    }

    public function getInputFilterSpecification()
    {
        return array()

        ;
    }
}

