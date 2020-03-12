<?php
namespace Object\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Object\Entity\ObjectBusinessEquipment;

/**
 *
 * @author otaba
 *        
 */
class ObjectBusinessEquipmentFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;

    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setHydrator($hydrator)->setObject(new ObjectBusinessEquipment());
        $this->addField();
    }

    private function addField()
    {
        $this->add(array(
            "name" => "equipmentCategory",
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Equipment Category',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\BusinessEquipments',
                'property' => 'equipments',
                'empty_option' => '-- Select a Category  --',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
               // 'id' => 'country',
                'class' => 'form-control col-md-8 col-sm-8 col-xs-12',
                "required" => "required",
                "multiple"=>true,
                "data-toggle"=>"select2",
                "data-placeholder"=>"Select a State ..",
                "data-allow-clear"=>true
            )
        ));
        $this->add(array(
            'name' => 'equipmentDesc',
            'type' => 'textarea',
            'options' => array(
                'label' => 'Description of Equipment',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'class' => 'form-control col-md-9 col-xs-12',
                'placeholder' => 'Brief description of the Equipment'
            
            )
        ));
        
        $this->add(array(
            "name" => "itemNo",
            'type' => 'text',
            'options' => array(
                'label' => 'Equipment Identitifer',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'class' => 'form-control col-md-9 col-xs-12',
                'placeholder' => 'E.g Machine Serial Number'
            
            )
        ));
        
        $this->add(array(
            "name" => "make",
            "type" => "text",
            "options" => array(
                "label" => "Equipment Make/Brand",
                "label_attributes" => array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-9 col-xs-12",
                "placeholder" => "Honda",
//                 "required"=>"required"
            
            )
        ));
        
        $this->add(array(
            "name" => "regNo",
            "type" => "text",
            "options" => array(
                "label" => "Equipment Reg. Number",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-9 col-xs-12",
                "placeholder" => "HONDA 213"
            )
        ));
        
        $this->add(array(
            "name" => "yearManufacture",
            "type" => "monthSelect",
            "options" => array(
                "label" => "Manufactured Year",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                ),
                "month_attributes" => array(
                    "style"=>"width: 40%",
                    "class" => "form-control col-md-9 col-xs-12",
                ),
                "year_attributes" => array(
                    "style"=>"width: 40%",
                    "class" => "form-control col-md-9 col-xs-12",
                )
            ),
            
            "attributes" => array(
                "class" => "form-control col-md-9 col-xs-12",
                "placeholder" => "2003"
            )
        ));
        
        $this->add(array(
            "name" => "purchaseDate",
            "type" => "date",
            "options" => array(
                "label" => "Purchase Date",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-9 col-xs-12",
                "required"=>"required"
            )
        ));
        
        $this->add(array(
            "name" => "purchaseValue",
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Purchase Value',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\EquipmentPurchaseValue',
                'property' => 'value',
                'empty_option' => '-- Select Purchase Value  --',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                // 'id' => 'country',
                'class' => 'form-control col-md-8 col-sm-8 col-xs-12',
                "required" => "required"
                // "value" => 152
                // 'data-ng-model' => 'selectedService',
                // 'data-ng-change' => 'onCategoryChange(selectedService)'
            )
        ));
        
        // include purchasemode EquipmentPurchaseValue
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

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }
}

