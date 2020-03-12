<?php
namespace Customer\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;

/**
 *
 * @author otaba
 *        
 */
class CustomerManualPaymentFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;
    
    public function init(){
        
    }
    
    private function addFields(){
        
        $this->add(array(
            'name' => 'payingBank',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Bank you paid from :',
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
     * (non-PHPdoc)
     *
     * @see \Zend\InputFilter\InputFilterProviderInterface::getInputFilterSpecification()
     *
     */
    public function getInputFilterSpecification()
    {}
}

