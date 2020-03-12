<?php
namespace Wallet\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;

class WalletAddFundFieldset extends Fieldset implements InputFilterProviderInterface
{

   
    public function init(){
        $this->add(array(
            "type"=>"text",
            "name"=>"amount",
            "options"=>array(
                'label' => 'Transaction Amount',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            "attributes"=>array(
                "id"=>"amount",
                'class' => 'form-control col-md-3 col-sm-3 col-xs-12',
                //                 "placeholder"=>"0.00",
            ),
        ));
    }

    public function getInputFilterSpecification()
    {

        return array(
            "amount"=>array(
                "allow_empty"=>FALSE,
                "required"=>TRUE,
                'filters' => array(
                    array(
                        'name' => 'Zend\Filter\StringTrim'
                    ),
                    array(
                        'name' => 'StripTags'
                    )
                ),
                'validators' => array(
                    array(
                        'name' => 'Zend\Validator\StringLength',
                        'options' => array(
                            'min' => 1,
                            'max' => 15
                        )
                    )
                )
            )
        );
    }
}

