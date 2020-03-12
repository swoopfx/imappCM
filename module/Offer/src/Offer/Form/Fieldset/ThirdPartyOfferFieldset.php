<?php

/**
 * 
 * This claass defines the third party form for generating offer
 * This is used for generatiing offer for thrid parties 
 */
namespace Offer\Form\Fieldset;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

class ThirdPartyOfferFieldset extends Fieldset implements InputFilterProviderInterface
{

    public function __construct()
    {
        parent::__construct('thirdPartyOfferFieldset');
        $this->addFields();
    }

    public function addFields()
    {
        $this->add(array(
            'name' => 'third_party_name',
            'type' => 'text',
            'options' => array(
                'label' => 'Third Party Name'
            ),
            'attributes' => array(
                'class' => 'form-control'
            )
        ));
        
        $this->add(array(
            'name' => 'third_party_email',
            'type' => 'text',
            'options' => array(
                'label' => 'Third Party Email'
            )
            ,
            'attributes' => array(
                'class' => 'form-control'
            )
        ));
        $this->add(array(
            'name' => 'third_party_phone',
            'type' => 'text',
            'options' => array(
                'label' => 'Third Party Phone'
            )
            ,
            'attributes' => array(
                'class' => 'form-control phone'
            )
            
        ));
    }

    public function getInputFilterSpecification()
    {
        return array()

        ;
    }
}