<?php
namespace Offer\Form;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Form;

/**
 *
 * @author otaba
 *        
 */
class ReccomendInsurerForm extends Form implements InputFilterProviderInterface
{

    private $entityManager;
    
    public function init(){
        $this->setAttributes(array(
            "method"=>"POST",
            'class' => 'form-horizontal form-label-left'
        ));
        $this->addForm();
        $this->addCommon();
    }
    
    private function addForm(){
        $this->add(array(
            'name' => 'recommendedInsurer',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Recomended Insurance Company',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\Insurer',
                'property' => 'insuranceName',
                'empty_option' => '-- Prefered Insurance Company --',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'class' => 'form-control col-md-7 col-xs-12',
                'id' => 'id_recomended_insurer'
            )
        ));
    }
    
    private function addCommon()
    {
       
        
       
        
        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Recommend Insurer',
                'class' => 'btn btn-lg btn-primary btn-block'
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
    {
        return array();
    }
    
    public function setEntityManager($em){
        $this->entityManager = $em;
        return $this;
    }
}

