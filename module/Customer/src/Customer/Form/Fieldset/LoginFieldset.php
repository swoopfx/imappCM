<?php
namespace Customer\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use Zend\Validator\Digits;


/**
 *
 * @author swoopfx
 *        
 */
class LoginFieldset extends Fieldset implements InputFilterProviderInterface
{

    public function init()
    {
        $this->addFields();
    }

    private function addFields()
    {
        $this->add(array(
            'name' => 'phonenumber',
            'type' => 'text',
            'options' => array(
                'label' => 'Username',
                'label_attributes' => array(
                    'class' => ''
                )
            ),
            'attributes' => array(
                'id' => 'username',
                'class' => 'form-control',
                'placeholder' => 'Phone or Email.',
                'required' => 'required'
            )
        ));
        $this->add(array(
            'name' => 'pin',
            'type' => 'password',
            'options' => array(
                'label' => 'PIN',
                'label_attributes' => array(
                    'class' => ''
                )
            ),
            'attributes' => array(
                'id' => 'pin',
                'class' => 'form-control pin',
                'placeholder' => 'PIN',
                'required' => 'required',
                'maxlength'=>4,
            )
        ));
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\InputFilter\InputFilterProviderInterface::getInputFilterSpecification()
     *
     */
    public function getInputFilterSpecification()
    {
        /**
         * phone numbe must be unique,
         */
        return array(
            'phonenumber' => array(
                'required' => true,
                'allow_empty' => false,
                'filters' => array(
                    array(
                        'name' => 'Zend\Filter\StringTrim'
                    ),
                    array(
                        'name' => 'Zend\Filter\StripTags'
                    )
                ),
//                 'validators' => array(
                   
//                 )
                
            ),
            'pin' => array(
                'required' => true,
                'allow_empty' => false,
                'filters' => array(
                    array(
                        'name' => 'Zend\Filter\StringTrim'
                    ),
                    array(
                        'name' => 'Zend\Filter\StripTags'
                    )
                ),
                'validators' => array(
//                     array(
//                         'name' => 'Zend\Validator\Digits',
//                         'options' => array(
//                             'messages' => array(
//                                 Digits::INVALID => "We are expecting only numbers"
//                             )
//                         )
//                     )
                )
                
            )
        );
    }
}

