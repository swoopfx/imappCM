<?php
namespace Settings\Form;

use Zend\Form\Form;

/**
 *
 * @author swoopfx
 *        
 */
class BrokerBankAccountForm extends Form
{

    private $entityManager;

    public function init()
    {
        $this->setAttributes(array(
            'method' => 'POST',
            'action' => '',
            'id' => '',
            'class' => 'form-control'
        )
        // 'novalidate'=>true,
        
        );
        $this->add(array(
            'name' => 'brokerBankAccountFieldset',
            'type' => 'Users\Form\Fieldset\BrokerBankAccountFieldset',
            'options'=>array(
                'use_as_base_fieldset' => true
            ),
        ));
        
        $this->addCommon();
    }

    private function addCommon()
    {
        // $this->add(array(
        // 'name' => 'csrf',
        // 'type' => 'Zend\Form\Element\Csrf',
        // 'options' => array(
        // // 'csrf_options' => array(
        // // 'timeout' => 600
        // // )
        // )
        // ));
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

