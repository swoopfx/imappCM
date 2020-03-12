<?php
namespace Transactions\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;

/**
 *
 * @author otaba
 *        
 */
class TransactionCardBillingAddress extends Fieldset implements InputFilterProviderInterface
{
    private $entityManager;

    public function init(){
        $this->addFeild();
        
    }
    
    private function addFeild(){
        $this->add(array(
            "name"=>"billingzip",
            "type"=>"text",
            "options"=>array(
                "label"=>"Billing ZipCode",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-6 col-sm-6 col-xs-12",
                ),
            ),
            "attributes"=>array(
                "id"=>"billin_zip",
                "class"=>"form-control col-md-8 col-sm-8 col-xs-12 ",
                "placeholder"=>"E72NB"
            ),
        ));
        
        $this->add(array(
            "name"=>"billingcity",
            "type"=>"text",
            "options"=>array(
                "label"=>"Billing City",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-6 col-sm-6 col-xs-12",
                ),
            ),
            "attributes"=>array(
                "id"=>"billin_city",
                "class"=>"form-control col-md-8 col-sm-8 col-xs-12 ",
                "placeholder"=>"Isolo"
            ),
        ));
        
        $this->add(array(
            "name"=>"billingaddress",
            "type"=>"textarea",
            "options"=>array(
                "label"=>"Billing Address",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-6 col-sm-6 col-xs-12",
                ),
            ),
            "attributes"=>array(
                "id"=>"billin_ziaddress",
                "class"=>"form-control col-md-9 col-sm-9 col-xs-12 ",
                "placeholder"=>"Molofin road "
            ),
        ));
        
        $this->add(array(
            "name" => "billingcountry",
            "type" => 'DoctrineModule\Form\Element\ObjectSelect',
            "options" => array(
                'label' => 'Billing Country',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\Country',
                'property' => 'countryName',
                
                'label_attributes' => array(
                    "class" => "control-label col-md-6 col-sm-6 col-xs-12' "
                )
            ),
            "attributes" => array(
//                 'required' => "required",
                "class" => "form-control col-md-9 col-sm-9 col-xs-12 ",
                // "style" => "width: 100%",
                "id" => "billing_country"
                
            )
        ));
        
        $this->add(array(
            "name" => "billingstate",
            "type" => 'DoctrineModule\Form\Element\ObjectSelect',
            "options" => array(
                'label' => 'Billing State',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\Zone',
                'property' => 'zoneName',
                
                'label_attributes' => array(
                    "class" => "control-label col-md-6 col-sm-6 col-xs-12' "
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-9 col-sm-9 col-xs-12 ",
                 "id" => "billing_state"
                
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
    
    public function setEntityManager($em){
        $this->entityManager = $em;
        return $this;
    }
}

