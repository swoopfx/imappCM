<?php
namespace Object\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Object\Entity\ObjectValue;

/**
 *
 * @author otaba
 *        
 */
class ObjectValueFieldset extends Fieldset implements InputFilterProviderInterface
{
    
    private $entityManager;

    public function init(){
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setHydrator($hydrator)->setObject(new ObjectValue());
        $this->addFields();
    }
    
    private function addFields(){
        $this->add(array(
            'name'=>'value',
            'type'=>'text',
            'options'=>array(
                'label'=>'Value' ,// ,This is sum assured
                 'label_attributes'=>array(
                     'class'=>'control-label col-md-3 col-sm-3 col-xs-12'
                 ),   
            ),
            'attributes'=>array(
                'class'=>'form-control col-md-3 col-sm-3 col-xs-12'
            ),
        ));
        
        $this->add(array(
            'name' => 'currency',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Value Currency',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\Currency',
                'property' => 'title',
                
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'id' => 'currency',
                'class' => 'form-control col-md-3 col-sm-3 col-xs-12'
                // 'data-ng-model' => 'selectedService',
                // 'data-ng-change'=>'onCategoryChange(selectedService)'
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

