<?php
namespace Offer\Form;

use Zend\Form\Form;

/**
 *
 * @author swoopfx
 *        
 */
class OfferForm extends Form
{

    // TODO - Insert your code here
    
    /**
     */
    public function init()
    {
        $this->setAttributes(array(
            //'action' => '/offer/process',
            'method' => 'POST',
            'class' => 'form-horizontal form-label-left',
            "data-ng-controller"=>"OfferForm"
        
        ));
        
        $this->addOfferFieldset();
        $this->addCommon();
    }

    private function addOfferFieldset()
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
                'csrf_options' => array(
                    'timeout' => 600
                )
            )
        ));
        
        $this->add(array(
            'name' => 'reset',
            'type' => 'Zend\Form\Element',
            'options' => array(),
            
            'attributes' => array(
                'class' => 'btn btn-default',
                'value' => 'Reset',
                'id' => 'reset'
            )
        ));
        
        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Submit',
                'class' => 'btn btn-lg btn-primary btn-block'
            )
        ));
    }

   

   
}

?>