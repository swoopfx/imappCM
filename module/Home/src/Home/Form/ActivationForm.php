<?php
namespace Home\Form;

use Zend\Form\Form;

/**
 *
 * @author otaba
 *        
 */
class ActivationForm extends Form
{

    private $entityManager;

    /**
     */
    public function init()
    {
        $this->setAttributes(array(
            "method" => "POST",
            "class" => "form-horizontal form-label-left"
        ));
        $this->addFeilds();
    }

    private function addFeilds()
    {
        $this->add(array(
            'name' => 'brokerInfo',
            'type' => 'Users\Form\Fieldset\BrokerSetUpDataFieldset',
            'options' => array(
                'use_as_base_fieldset' => true
            )
        ));
        
        $this->add(array(
            "name"=>"promoMonths",
            "type"=>"select",
            "options"=>array(
                "label"=>"Subscription Month",
                "label_attributes"=>array(
                    "class"=>""
                ),
                'empty_option' => 'Promo Period',
                "value_options"=>array(
                    "1"=>"One Month",
                    "3"=>"Three months",
                    "6"=>"Six Months",
                    "12"=>"One Year"
                ),
            ),
            "attributes"=>array(
                "class"=>"form-control col-md-9 col-xs-12",
                "required"=>"required",
            ),
            
        ));
        
        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                // 'type' => 'submit',
                'value' => 'ACTIVATE',
                'class' => 'btn btn-block'
                
            )
        ));
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }
}

