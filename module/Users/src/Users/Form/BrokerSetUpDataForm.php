<?php
namespace Users\Form;

use Zend\Form\Form;

/**
 *
 * @author swoopfx
 *        
 */
class BrokerSetUpDataForm extends Form
{

    private $entityManager;

    public function init()
    {
        $this->setAttributes(array(
            'name' => 'broker_setup_form',
            'action' => '/user/broker/setup-data',
            'method' => 'POST',
            "data-ajax-loader" => "brokerSetup",
            'class' => 'form-horizontal form-label-left',
            //'novalidate'=>false,
        ));
        $this->addField();
        $this->addCommon();
    }

    private function addField()
    {
        $this->add(array(
            'name'=>'broker_setup_data',
            'type'=>'Users\Form\Fieldset\BrokerSetUpDataFieldset',
            'options'=>array(
                'use_as_base_fieldset' => true
            ),
        )
        );
        
       
    }

    private function addCommon()
    {
        $this->add(array(
            'name' => 'csrf',
            'type' => 'Zend\Form\Element\Csrf',
            'options' => array(
//                 'csrf_options' => array(
//                     'timeout' => 600
//                 )
            )
        ));
        
        
        
        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Set Up',
                'class' => 'btn btn-success btn-block',
                'id' => 'create-object'
            )
        ));
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        
        return $this;
    }
}

