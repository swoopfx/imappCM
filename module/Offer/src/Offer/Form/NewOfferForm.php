<?php
namespace Offer\Form;

use Zend\Form\Form;

class NewOfferForm extends Form
{

    public function __construct()
    {
        parent::__construct('newOfferForm');
        $this->setAttribute('action', '');
        $this->setAttribute('method', 'post');
        $this->addThirdPartyCheckBox();
        $this->requireBroker();
        $this->add(array(
            'type' => 'Offer\Form\Fieldset\NewOfferFieldset',
            'options' => array(
                'use_as_base_fieldset' => true
            )
        ));
        
        $this->add(array(
            'type' => 'Object\Form\Fieldset\NewObjectFieldset',
            'name' => 'newObjectFields'
        ));
        
        $this->add(array(
            'type' => 'Offer\Form\Fieldset\ThirdPartyOfferFieldset',
            'name' => 'thirdPartyOfferFieldset'
        ));
        
        $this->add(array(
            'type' => 'Object\Form\Fieldset\SelectObjectFieldset'
        )
        // 'name'=>'selectObjectFieldset'
        );
        
        // include Object form here
        // include Primium aggregator here which is a combination of hiidden elements
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Csrf',
            'name' => 'csrf'
        ));
        
        // $this->add(array(
        // 'name' => 'submit',
        // 'attributes' => array(
        // 'type' => 'submit',
        // 'value' => 'Sumbit'
        // ),
        // ));
    }

    protected function requireBroker()
    {
        $this->add(array(
            'name' => 'requireBroker',
            'type' => 'checkbox',
            'options' => array(
                'label' => 'I require A Broker',
                'checked_value' => 'yes',
                'unchecked_value' => 'no'
            )
            ,
            'attributes' => array(
                'value' => 'no',
                'data-ng-click' => 'requireBroker()',
                'class' => 'flat'
            )
            
        ));
    }

    protected function addThirdPartyCheckBox()
    {
        $this->add(array(
            'name' => 'thirdPartyCheckBox',
            'type' => 'checkbox',
            'options' => array(
                'label' => 'Offer For Third Party',
                'checked_value' => 'yes',
                'unchecked_value' => 'no'
            )
            ,
            'attributes' => array(
                'value' => 'no',
                'data-ng-click' => 'thirdPartyForm()'
            )
            
        ));
    }

    /**
     * This function provides a form that selects all available services in the database
     * It presents a of avaible services rendered by Insurance Manager
     * This function uses the angular ng-change function to
     */
    protected function selectService()
    {
        $this->add(array(
            'name' => 'availableServices',
            'type' => 'select',
            'options' => array(),
            'attributes' => array(
                'data-ng-change' => 'selecteService()'
            )
        ));
    }
}