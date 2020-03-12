<?php
namespace Transactions\Form;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Form;

/**
 *
 * @author otaba
 *        
 */
class CardPinForm extends Form implements InputFilterProviderInterface
{

    public function init()
    {
        $this->setAttributes(array(
            "action" => "",
            "method" => "POST"
        ));
        
        $this->addField();
    }

    private function addField()
    {
        $this->add(array(
            "name" => "cc_pin",
            'type' => "password",
            "options" => array(
                "label" => "card Pin"
            ),
            "attributes" => array(
               
                "id" => "cc_pin",
                "required"=>"required",
                "class"=>"form-control col-md-12 col-sm-12 col-xs-12 ",
                'minlength' => "4",
                'maxlength' => "4"
            )
        ));
        
        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'CONFIRM PAYMENT',
                'class' => 'btn btn-primary btn-block',
                'id' => 'pay-now'
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
        return array();
    }
}

