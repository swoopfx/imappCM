<?php
namespace Offer\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;

/**
 *
 * @author swoopfx
 *        
 */
class OfferPremiumForm extends Form
{

    protected $entityManager;

    public function init()
    {
        $this->setAttributes(array(
            'action' => '',
            'method' => 'POST',
            'class' => 'form-horizontal form-label-left',
            'enctype' => 'multipart/form-data',
            'data-ng-controller'=>"offerInfoController",
            'novalidate'=>true
        ))->setInputFilter(new InputFilter());
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

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }
}

