<?php
namespace Object\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Object\Entity\Object;

/**
 *
 * @author swoopfx
 *        
 */
class ObjectFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;

    /**
     *
     * @param null|int|string $name
     *            Optional name for the element
     *            
     * @param array $options
     *            Optional options for the element
     *            
     */
    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setHydrator($hydrator)->setObject(new Object());
        
        $this->addFeilds();
        //$this->conditionalFieldset();
    }

    private function addFeilds()
    {
        $this->add(array(
            "name" => "objectName",
            "type" => "text",
            "options" => array(
                "label" => "Property Name/Title",
                "label_attributes" => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'id' => 'object_name',
                'required' => 'required',
                'class' => 'form-control col-md-9 col-xs-12',
                'title' => 'Provide a name for the property',
                'placeholder' => 'Nissan Almera SUV'
            )
        ));
        
        $this->add(array(
            'name' => 'currency',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Currency',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\Currency',
                'property' => 'title',
                //'empty_option' => '-- Select Category  --',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'id' => 'currency',
                'class' => 'form-control col-md-3 col-sm-3 col-xs-12',
//                 "required" => "required"
                // 'data-ng-model' => 'selectedService',
                // 'data-ng-change' => 'onCategoryChange(selectedService)'
            )
        ));
        
        $this->add(array(
            'name' => "value",
            'type' => "text",
            'options' => array(
                'label' => "Property Value/Sum Assured",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            'attributes' => array(
                "id"=>"objectValue",
                "value"=>"0",
                'class' => "form-control col-md-9 col-sm-9 col-xs-12 money",
                'placeholder' => "$10,000",
//                 'required' => "required"
                // 'id'=>""
            )
        ));
        
        $this->add(array(
            'name' => 'objectType',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Category Of Property',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\ObjectType',
                'property' => 'objectType',
                'empty_option' => '-- Select Category  --',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'id' => 'objectType',
                'class' => 'form-control col-md-7 col-sm-7 col-xs-12',
                "required" => "required"
            )
        ));
        
        $this->add(array(
            "name"=>"otherType",
            "type"=>"text",
            "options"=>array(
                'label' => 'Other Type',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            "attributes"=>array(
                'id' => 'otherType',
                'class' => 'form-control col-md-7 col-sm-7 col-xs-12',
            )
        ));
        
        $this->conditionalFieldset();
    }
    
    private function conditionalFieldset(){
       $this->add(array(
           "name"=>"objectMotor",
           "type"=>"Object\Form\Fieldset\ObjectMotorFieldset"
       ));
       
       $this->add(array(
           "name"=>"businessEquipment",
           "type"=>"Object\Form\Fieldset\ObjectBusinessEquipmentFieldset"
       ));
       
       $this->add(array(
           "name"=>"objectTravel",
           "type"=>"Object\Form\Fieldset\ObjectTravelFieldset"
       ));
       $this->add(array(
           "name"=>"objectBusiness",
           "type"=>"Object\Form\Fieldset\ObjectBusinessFeildset"
       ));
       

       $this->add(array(
           "name"=>"objectOthers",
           "type"=>"Object\Form\Fieldset\ObjectOthersFieldset",
       ));
       
       $this->add(array(
           "name"=>"objectLife",
           "type"=>"Object\Form\Fieldset\ObjectPersonFieldset"
       ));
       
       $this->add(array(
           "name"=>"objectBuilding",
           "type"=>"Object\Form\Fieldset\ObjectBuildingFieldset",
       ));
       
       $this->add(array(
           "name"=>"objectNonBusinessEquipment",
           "type"=>"Object\Form\Fieldset\NonBusinessEquipmentFieldset",
       ));
       
      
    }

    /**
     * (non-PHPdoc)
     *
     *
     * @see \Zend\InputFilter\InputFilterProviderInterface::getInputFilterSpecification()
     *
     */
    public function getInputFilterSpecification()
    {
        return array(
            "objectName"=>array(
                "allow_empty"=>false,
                "required"=>true,
            ),
            "currency"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "value"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "objectType"=>array(
                "allow_empty"=>false,
                "required"=>true,
            ),
        );
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
    }
}

?>