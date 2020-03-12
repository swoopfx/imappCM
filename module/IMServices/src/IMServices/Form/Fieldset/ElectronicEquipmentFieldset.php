<?php
namespace IMServices\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use IMServices\Entity\ElectronicEquipment;

/**
 *
 * @author otaba
 *        
 */
class ElectronicEquipmentFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;
    
    public function init(){
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setObject(new ElectronicEquipment())->setHydrator($hydrator);
        
        $this->add(array(
            "name"=>"isInsureAll",
            "type"=>"checkbox",
            "options"=>array(
                "label"=>"Insure All",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isInsureAll",
                "checked"=>true,
                
            )
        ));
        
        $this->add(array(
            "name"=>"isAllNew",
            "type"=>"checkbox",
            "options"=>array(
                "label"=>"All Acquired New",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isAllNew",
                "checked"=>true
                
            )
        ));
        
        $this->add(array(
            "name"=>"estimatedSumTotal",
            "type"=>"text",
            "options"=>array(
                "label"=>"Estimated Sum Total ",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-xs-12",
                "id" => "estimatedSumTotal",
                
            )
        ));
        
        $this->add(array(
            "name"=>"businesType",
            "type"=>"text",
            "options"=>array(
                "label"=>"Business Type",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-xs-12",
                "id" => "businesType",
                
            )
        ));
        
        
        $this->add(array(
            "name"=>"equipmentLocation",
            "type"=>"textarea",
            "options"=>array(
                "label"=>"Equipment Location",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-xs-12",
                "id" => "equipmentLocation",
                
            )
        ));
        
        $this->add(array(
            "name"=>"isPreviouslyInsured",
            "type"=>"checkbox",
            "options"=>array(
                "label"=>"Equipment Location",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isPreviouslyInsured",
                
            )
        ));
        
        $this->add(array(
            "name"=>"coverStartDate",
            "type"=>"date",
            "options"=>array(
                "label"=>"Cover Start Date",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-xs-12",
                "id" => "coverStartDate",
                
            )
        ));
        
        $this->add(array(
            "name"=>"isMaintenaceSpec",
            "type"=>"checkbox",
            "options"=>array(
                "label"=>"All Acquired New",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isMaintenaceSpec",
                "checked"=>true
                
            )
        ));
        
        
        $this->add(array(
            "name"=>"isTrainedOperators",
            "type"=>"checkbox",
            "options"=>array(
                "label"=>"Device has trained Operators",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isTrainedOperators",
                "checked"=>true
                
            )
        ));
        
        
        $this->add(array(
            "name"=>"isTheftRIsk",
            "type"=>"checkbox",
            "options"=>array(
                "label"=>"Include theft risk",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isTheftRIsk",
                
            )
        ));
        
        
        $this->add(array(
            "name"=>"isDangerousMaterial",
            "type"=>"checkbox",
            "options"=>array(
                "label"=>"Premises has dangerous materials",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isDangerousMaterial",
                
            )
        ));
        
        $this->add(array(
            'name' => 'scopeOfCover',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Scope Of Cover',
                'label_attributes' => array(
                    'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
                ),
                'empty_option' => '--Select Scope of Cover-- ',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\ElectronicEquipmentScopeOfCover',
                'property' => 'scope'
            ),
            'attributes' => array(
                'id' => 'scopeOfCover',
                'class' => 'form-control col-md-7 col-xs-12 ui dropdown',
                'multiple' => 'multiple'
                
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
        
        return array(
            "scopeOfCover"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "isDangerousMaterial"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            
            "isTheftRIsk"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            
            "isTrainedOperators"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            
            "isMaintenaceSpec"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            
            "coverStartDate"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            
            "isPreviouslyInsured"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            
            "equipmentLocation"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            
            "businesType"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            
            "estimatedSumTotal"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            
            "isAllNew"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            
            "isInsureAll"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
        );
    }
    
    public function setEntityManager($em){
        $this->entityManager = $em;
        return $this;
    }
    
}

