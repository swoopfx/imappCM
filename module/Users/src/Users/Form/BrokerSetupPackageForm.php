<?php
namespace Users\Form;

use Zend\Form\Form;

/**
 *
 * @author swoopfx
 *        
 */
class BrokerSetupPackageForm extends Form
{

    private $entitymanager;

    public function init()
    {
        $this->setAttributes(array(
            'action' => '/user/broker/setup-package',
            'method' => 'POST',
            'class' => 'form-horizontal form-label-left',
            'data-ng-controller'=>'BrokerSetupPackageController',
            'novalidate'=>false
        ));
        $this->addField();
    }

    private function addField()
    {
        $this->add(array(
            'name' => 'broker_package_select',
            'type' => 'Users\Form\Fieldset\BrokerSetupPackageFieldset',
            'options' => array(
                'use_as_base_fiedlset' => true
            )
        ));
    }
    private function addCommon(){
        $this->add(array(
            'name' => 'csrf',
            'type' => 'Zend\Form\Element\Csrf',
            'options' => array(
                 
            )
        ));
        $this->add(array(
            'name' => 'previous',
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
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Begin',
                'class' => 'btn btn-success',
                 
            )
        ));
    }

    public function setEnttityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }
}

