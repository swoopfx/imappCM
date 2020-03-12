<?php
namespace Object\Form;

use Zend\Form\Form;
use Zend\Form\Element;


class AddObjectForm extends Form
{

    protected $entityManager;

    public function init()
    {
        
        // parent::__construct('addObjectForm');
        $this->setAttributes(array(
            'action'=>'/object/new',
            'method'=>'POST',
            'class' => 'form-horizontal form-label-left',
            'novalidate' => true,
            'data-ng-controller'=>'ObjectController',
        ));
       // $this->addAttributes();
        $this->gatherObjectForm();
        $this->addCommon();
       
    }

    protected function gatherObjectForm()
    {
        $this->add(array(
            'type' => 'Object\Form\Fieldset\ObjectFieldset',
            'name' => 'objectFieldset',
            'options' => array(
                'use_as_base_fieldset' => true
            )
            
        ));
        

    }

    protected function addCommon()
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
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Create',
                'class' => 'btn btn-success',
                'id' => 'create-object'
            )
        ));
    }

   
}

