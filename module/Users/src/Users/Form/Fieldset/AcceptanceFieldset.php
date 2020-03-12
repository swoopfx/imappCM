<?php
namespace Users\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use Zend\Form\Element\Checkbox;
use Zend\Validator\Digits;

/**
 *
 * @author swoopfx
 *        
 */
class AcceptanceFieldset extends Fieldset implements InputFilterProviderInterface
{

    protected $entityManager;

    /**
     *
     * @param null|int|string $name
     *            Optional name for the element
     *            
     * @param array $options
     *            Optional options for the element
     *            
     */
    public function init($name = null, $options = null)
    {
        $this->addField();
    }

    private function addField()
    {
        $this->add(array(
            'name' => 'acceptance',
            'type' => 'Zend\Form\Element\Checkbox',
            'options' => array(
                'label' => 'I understand and accept the terms and conditions specified above',
                'use_hidden_element' => true,
                'checked_value' => 1,
                'unchecked_value' => 'no'
            )
            ,
            'attributes' => array(
                'value' => 'no',
                'class' => 'flat',
                'checked' => false
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
        return array(
            'acceptance' => array(
                
                'validators' => array(
                    array(
                        'name' => 'Digits',
                        'break_chain_on_failure' => true,
                        'options' => array(
                            'messages' => array(
                                Digits::NOT_DIGITS => 'You must agree to the terms of use.'
                            )
                        )
                    )
                )
            )
        );
    }
}

?>