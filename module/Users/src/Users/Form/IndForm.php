<?php
namespace Users\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Zend\Form\Element;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;

/**
 *
 * @author swoopfx
 *        
 */
class IndForm extends Form
{

    protected $entityManager;

    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setHydrator($hydrator);
        $this->setAttributes(array(
            'name' => 'individual_profile_form',
            'action' => '/user/ind/set-profile',
            'method' => 'POST',
            'enctype' => 'multipart/form-data',
            'class' => 'form-horizontal form-label-left input_mask'
        ))->setInputFilter(new InputFilter());
        $this->addCommon();
        
        $this->addProfile();
    }

    private function addProfile()
    {
        $this->add(array(
            'name' => 'ind_fieldset',
            'type' => 'Users\Form\Fieldset\UserProfileFieldset',
            'options' => array(
                'use_as_base_fieldset' => true
            )
        ));
    }

    private function addCommon()
    {
        
        // $this->add(array(
        // 'type' => 'Zend\Form\Element\Csrf',
        // 'name' => 'csrf',
        // ));
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
                'value' => 'Create Profile',
                'class' => 'btn btn-success',
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

