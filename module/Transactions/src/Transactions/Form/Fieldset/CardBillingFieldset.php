<?php
namespace Transactions\Form\Fieldset;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

/**
 * This is the fieldset for billing intrmation on a card 
 * @author otaba
 *        
 */
class CardBillingFieldset extends Fieldset implements InputFilterProviderInterface
{
    
    private $entityManager;

    // TODO - Insert your code here
    public function init()
    {}

    private function addFields()
    {
        $this->add(array(
            "name" => "billingzip",
            "type" => "text",
            "options" => array(
                "label" => "Billing Zip",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => 'form-control col-md-8 col-sm-8 col-xs-12 ',
                "placeholder" => "E7786NE"
            )
        ));
        
        $this->add(array(
            "name" => "billingcity",
            "type" => "text",
            "options" => array(
                "label" => "Billing City",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => 'form-control col-md-8 col-sm-8 col-xs-12 ',
                "placeholder" => "Hilltop"
            )
        ));
        
        $this->add(array(
            "name" => "billingaddress",
            "type" => "text",
            "options" => array(
                "label" => "Billing Address",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => 'form-control col-md-8 col-sm-8 col-xs-12 ',
                "placeholder" => "470 Mundet PI"
            )
        ));
        
        $this->add(array(
            'name' => 'billingstate',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'State:',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\Zone',
                'property' => 'zoneName',
                'empty_option' => '--- Select State/Region ---',
                'is_method' => true,
                'find_method' => array(
                    'name' => 'findSpecificZone'
                )
            ),
            'attributes' => array(
                'id' => 'customer_state',
                
                'class' => 'form-control col-md-7 col-xs-12',
                'placeholder' => 'Ikeja '
            )
        ));
        
        $this->add(array(
            'name' => 'billingcountry',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Country :',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                'empty_option' => '--- Select a Country ---',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\Country',
                'property' => 'countryName'
            ),
            'attributes' => array(
                'id' => 'form_status',
                'class' => 'form-control col-md-7 col-xs-12'
            )
        ));
        
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Zend\InputFilter\InputFilterProviderInterface::getInputFilterSpecification()
     */
    public function getInputFilterSpecification()
    {
        return array();
    }
    
    public function setEntityManager($em){
        $this->entityManager = $em;
        return $this;
    }
}

