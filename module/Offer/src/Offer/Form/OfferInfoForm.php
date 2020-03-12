<?php
namespace Offer\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;

/**
 *
 * @author swoopfx
 *        
 */
class OfferInfoForm extends Form
{

    protected $entityManager;

    public function init()
    {
        $this->setAttributes(array(
            'action' => '/offer/offer-information',
            'method' => 'POST',
            'class' => 'form-horizontal form-label-left',
            'enctype' => 'multipart/form-data',
            'data-ng-controller'=>"offerInfoController"
        ))->setInputFilter(new InputFilter());
        $this->addCommon();
        $this->offerFieldset();
        $this->requireBroker();
        
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }

    private function offerFieldset()
    {
        $this->add(array(
            'name' => 'offerFieldset',
            'type' => 'Offer\Form\Fieldset\OfferFieldset',
            'options' => array(
                'use_as_base_fieldset' => true
            )
        ));
    }

    

    private function addCommon()
    {
        $this->add(array(
            'name' => 'csrf',
            'type' => 'Zend\Form\Element\Csrf',
            'options' => array(
               
            )
        ));
        $this->add(array(
            'name' => 'reset',
            'type' => 'Zend\Form\Element',
            'options' => array()
        
            ,
            'attributes' => array(
                'class' => 'btn btn-primary',
                'value' => 'Reset',
                'id' => 'reset'
            )
        ));
        
        $this->add(array(
            'name' => 'next',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Next',
                'class' => 'btn btn-success',
               
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
            ),
            'attributes' => array(
                'value' => 'no',
                'data-ng-click' => 'thirdPartyForm()'
            )
        )
        );
    }

    protected function requireBroker()
    {
        $this->add(array(
            'name' => 'requireAdvice',
            'type' => 'checkbox',
            'options' => array(
                'label' => 'I Require Professional Advice',
                // 'label_attributes' => array(
                // 'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                // ),
                'checked_value' => TRUE,
                'unchecked_value' => False
            ),
            'attributes' => array(
                'value' => False,
                'data-ng-click' => 'requireBroker()'
            )
        )
        );
    }
}

