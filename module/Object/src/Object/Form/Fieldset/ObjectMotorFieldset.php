<?php
namespace Object\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Zend\Form\Element\Number;
use Object\Entity\ObjectMotorData;

/**
 *
 * @author swoopfx
 *        
 */
class ObjectMotorFieldset extends Fieldset implements InputFilterProviderInterface
{

    protected $entityManager;

    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setHydrator($hydrator)->setObject(new ObjectMotorData());
        $this->addFields();
    }

    private function addFields()
    {
        // $this->add(array(
        // 'name'=>'object',
        // 'type'=>'hidden',
        // ));
        $this->add(array(
            'name' => 'name',
            'type' => 'text',
            'options' => array(
                'label' => 'Name',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
            )
        ));
        // $this->add(array(
        // 'name'=>'objectValue',
        // 'type'=>'Object\Form\Fieldset\ObjectValueFieldset',
        
        // ));
        
        $this->add(array(
            'name' => 'motorModel',
            'type' => 'text',
            'options' => array(
                'label' => 'Motor Model',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                "required" => "required",
                "id" => "",
                "placeholder" => "Camry",
                "class" => 'form-control col-md-3 col-sm-3 col-xs-12'
            )
        ));
        $this->add(array(
            'name' => 'motorType',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Make of Motor',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\MotorType',
                'property' => 'motor',
                'empty_option' => '-- Select Motor Brand --',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                'is_method' => true,
                'find_method' => array(
                    'name' => 'findBy',
                    'params' => array(
                        'criteria' => array(
                           // 'useCategory' => 2
                        )
                    
                    ),
                    'orderBy' => array(
                        'id' => 'ASC'
                    )
                )
            ),
            'attributes' => array(
                'id' => 'object_type',
                'class' => 'form-control col-md-3 col-sm-3 col-xs-12'
            
            )
        ));
        
        $this->add(array(
            "name" => "makeYear",
            "type" => "monthselect",
            'options' => array(
                'label' => 'Year of Make',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                "month_attributes" => array(
                    'class' => 'form-control col-md-3 col-sm-3 col-xs-12',
                    "style" => "width: 0%; "
                    // "disabled" => "disabled"
                ),
                "year_attributes" => array(
                    'class' => 'form-control col-sm-5 col-md-5 col-xs-5 col-md-offset-3',
                    'id' => 'expiry',
                    "style" => "width: 50%;"
                )
            
            ),
            
            "attributes" => array(
            )
        ));
        
        // $this->add(array(
        // 'name'=>'motorModel',
        // 'type'=>'DoctrineModule\Form\Element\ObjectSelect',
        // ));
        
        $this->add(array(
            'name' => 'motorValueType',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Motor Acquired Status',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\VehicleValueType',
                'property' => 'valueType',
                'empty_option' => '-- Select Motor Value Type --',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'id' => 'object_type',
                'class' => 'form-control col-md-3 col-sm-3 col-xs-12'
            )
        ));
        $this->add(array(
            'name' => 'motorNumber',
            'type' => 'text',
            'options' => array(
                'label' => 'Motor Plate Number',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'id' => 'motor_number',
                'class' => 'form-control col-md-3 col-sm-3 col-xs-12',
                'placeholder' => 'MKT123KT'
            )
        ));
        
        $this->add(array(
            'name' => 'engineNumber',
            'type' => 'text',
            'options' => array(
                'label' => 'Engine Number',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'id' => 'engine_number',
                'class' => 'form-control col-md-3 col-sm-3 col-xs-12',
                'placeholder' => '312FKK8674998'
            )
        ));
        
        $this->add(array(
            'name' => 'chasisNumber',
            'type' => 'text',
            'options' => array(
                'label' => 'Chasis Number',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'id' => 'engine_number',
                'class' => 'form-control col-md-3 col-sm-3 col-xs-12',
                'placeholder' => '312Uop078308995dti'
                // "required"=>"required",
            )
        ));
        
        $this->add(array(
            'name' => 'numberOfSeats',
            'type' => 'Zend\Form\Element\Number',
            'options' => array(
                'label' => 'Number of seats',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'id' => 'engine_number',
                'class' => 'form-control col-md-3 col-sm-3 col-xs-12',
                'placeholder' => '0',
                'value' => 0
            )
        ));
        
        // $this->add(array(
        // 'name' => 'typeOfBody',
        // 'type' => 'DoctrineModule\Form\Element\ObjectSelect',
        // 'options' => array(
        // 'label' => 'Type Of Motor',
        // 'object_manager' => $this->entityManager,
        // 'target_class' => 'Settings\Entity\MotorTypeOfBody',
        // 'property' => 'typeOfBody',
        // 'empty_option' => '-- Select Body Type --',
        // 'label_attributes' => array(
        // 'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
        // )
        // ),
        // 'attributes' => array(
        // 'id' => 'object_type',
        // 'class' => 'form-control col-md-3 col-sm-3 col-xs-12'
        // )
        // ));
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\InputFilter\InputFilterProviderInterface::getInputFilterSpecification()
     *
     */
    public function getInputFilterSpecification()
    {
        return array(
            'numberOfSeats' => array(
                'required' => false,
                'allow_empty' => true
            )
        );
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        
        return $this;
    }
}

?>