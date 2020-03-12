<?php
namespace Messages\Form;

use Zend\Form\Form;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Messages\Entity\Messages;

/**
 *
 * @author otaba
 *        
 */
class MessageForm extends Form
{
    
    private $entityManager;

    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setHydrator($hydrator)->setObject(new Messages());
        $this->setAttributes(array(
            "method" => "POST",
            "id"=>"simpleForm",
            "class" => "ajax_element",
            'data-ajax-loader' => "myLoader",
            "action"=>"sendMessage",
        ));
        $this->addField();
        $this->addCommon();
    }

    private function addField()
    {
        $this->add(array(
            "name" => "messageEntered",
            "type" => "Messages\Form\Fieldset\MessageEnteredFieldset",
            "options" => array(
                'use_as_base_fieldset' => true
            )
        ));
    }

    private function addCommon()
    {
        $this->add(array(
            'name' => 'reset',
            'type' => 'Zend\Form\Element',
            'options' => array(),
            
            'attributes' => array(
                'class' => 'btn btn-success',
                'value' => 'Reset',
                'id' => 'reset'
            )
        ));
        
        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                // 'type' => 'submit',
                'value' => 'SEND',
                'class' => 'btn btn-primary'
            
            )
        ));
    }
    
    public function setEntityManager($em){
        $this->entityManager = $em;
        return $this;
    }
}

