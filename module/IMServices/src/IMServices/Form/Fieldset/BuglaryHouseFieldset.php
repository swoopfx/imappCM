<?php
namespace IMServices\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use IMServices\Entity\BuglaryHouseBreaking;

/**
 *
 * @author otaba
 *        
 */
class BuglaryHouseFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;

    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setHydrator($hydrator)->setObject(new BuglaryHouseBreaking());
        $this->addFields();
    }

    private function addFields()
    {
        $this->add(array(
            "name" => "isResidential",
            "type" => "checkbox",
            "options" => array(
                "label" => "Is Residential",
                // 'unchecked_value' => false,
                // 'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isResidential",
                "checked" => true
            )
        ));
        
        $this->add(array(
            "name" => "propertyType",
            "type" => "DoctrineModule\Form\Element\ObjectSelect",
            'options' => array(
                'label' => 'Non-Residential Type',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\NonResidentialType',
                'empty_option' => '-- Select a Type --',
                'property' => 'type'
            
            ),
            "attributes" => array(
                "id" => "propertyType",
                "class" => "form-control col-md-7 col-xs-12"
                // "placeholder"=>"Warehouse"
            )
        ));
        
        // otherProperty
        
        $this->add(array(
            "name" => "otherProperty",
            "type" => "text",
            "options" => array(
                "label" => "Other Property",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "otherProperty",
                "class" => "form-control col-md-7 col-xs-12"
                // "checked" => true
            
            )
        ));
        
        $this->add(array(
            "name" => "isAlwaysOccupied",
            "type" => "checkbox",
            "options" => array(
                "label" => "Property Always Occupied",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "isAlwaysOccupied",
                "class" => "col-md-7 col-xs-12",
                "checked" => true
                // "placeholder"=>"Warehouse"
            )
        ));
        
        $this->add(array(
            "name" => "notOccupiedDuaration",
            "type" => "text",
            "options" => array(
                "label" => "Duration Not Occupied",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "notOccupiedDuaration",
                "class" => "form-control col-md-7 col-xs-12",
                // "checked"=>true
                
                "placeholder" => "6 months"
            )
        ));
        
        $this->add(array(
            "name" => "isLockInGoodState",
            "type" => "checkbox",
            "options" => array(
                "label" => "Stock Contains Jewelry",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => " isLockInGoodState",
                "class" => "form-control col-md-7 col-xs-12",
                "checked" => false
                // "placeholder"=>"Warehouse"
            )
        ));
        
        $this->add(array(
            "name" => "isStockContainsJewelry",
            "type" => "checkbox",
            "options" => array(
                "label" => "Stock Contains Jewelry",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "isStockContainsJewelry",
                "class" => "form-control col-md-7 col-xs-12",
                "checked" => false
                // "placeholder"=>"Warehouse"
            )
        ));
        
        $this->add(array(
            "name" => "jewelryValue",
            "type" => "text",
            "options" => array(
                "label" => "Stock Contains Jewelry",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "isStockContainsJewelry",
                "class" => "form-control col-md-7 col-xs-12",
                "checked" => false
                // "placeholder"=>"Warehouse"
            )
        ));
        
        $this->add(array(
            "name" => "isAntiTheftDevice",
            "type" => "checkbox",
            "options" => array(
                "label" => "Has Anti-Theft Device",
                // 'unchecked_value' => false,
                // 'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => " col-md-7 col-xs-12",
                "id" => "isAntiTheftDevice",
                "checked" => true
            )
        ));
        
        $this->add(array(
            "name" => "isPreviousClaims",
            "type" => "checkbox",
            "options" => array(
                "label" => "Has Previous Claims",
                // 'unchecked_value' => false,
                // 'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => " col-md-7 col-xs-12",
                "id" => "isPreviousClaims",
                "checked" => true
            )
        ));
        
        $this->add(array(
            "name" => "isSafe",
            "type" => "checkbox",
            "options" => array(
                "label" => "Building has A safe",
                // 'unchecked_value' => false,
                // 'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => " col-md-7 col-xs-12",
                "id" => "isSafe",
                "checked" => false
            )
        ));
        
        // one to many safe details
        
        $this->add(array(
            "name" => "isRegularStock",
            "type" => "checkbox",
            "options" => array(
                "label" => "Always Take regular stock",
                // 'unchecked_value' => false,
                // 'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => " col-md-7 col-xs-12",
                "id" => "isRegularStock",
                "checked" => true
            )
        ));
        
        $this->add(array(
            "name" => "isSoleOccupier",
            "type" => "checkbox",
            "options" => array(
                "label" => "Sole Occupier",
                // 'unchecked_value' => false,
                // 'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => " col-md-7 col-xs-12",
                "id" => "is_sole_occupeir",
                "checked" => true
            )
        ));
        
        $this->add(array(
            "name" => "otherOccupier",
            "type" => "textarea",
            "options" => array(
                "label" => "Other Occupier",
                
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-xs-12",
                "id" => "otherOccupier",
                "placeholder" => "Segun Olawale, Issa Abdulahi"
            )
        ));
        
        $this->add(array(
            "name" => "occupyDuration",
            "type" => "date",
            "options" => array(
                "label" => "Occupied Since",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-xs-12",
                "id" => "occupyDuration"
            )
        ));
        $this->add(array(
            "name" => "isDomesticServants",
            "type" => "checkbox",
            "options" => array(
                "label" => "Contains Domestic Servants",
                // 'unchecked_value' => false,
                // 'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => " col-md-7 col-xs-12",
                "id" => "isDomesticServants",
                "checked" => false
            )
        ));
        
        $this->add(array(
            "name" => "isDaySecurity",
            "type" => "checkbox",
            "options" => array(
                "label" => "Has Day Security",
                // 'unchecked_value' => false,
                // 'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => " col-md-7 col-xs-12",
                "id" => "isDaySecurity",
                "checked" => false
            )
        ));
        
        $this->add(array(
            "name" => "isNightSecurity",
            "type" => "checkbox",
            "options" => array(
                "label" => "Has Night Security",
                // 'unchecked_value' => false,
                // 'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => " col-md-7 col-xs-12",
                "id" => "isNightSecurity",
                "checked" => false
            )
        ));
        
        $this->add(array(
            "name" => "isTradeOnPremises",
            "type" => "checkbox",
            "options" => array(
                "label" => "Has Trade On Premises",
                // 'unchecked_value' => false,
                // 'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => " col-md-7 col-xs-12",
                "id" => "isTradeOnPremises",
                "checked" => false
            )
        ));
        
        $this->add(array(
            "name" => "isTradeAroundPremises",
            "type" => "checkbox",
            "options" => array(
                "label" => "Trade Off/Around Premises",
                // 'unchecked_value' => false,
                // 'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => " col-md-7 col-xs-12",
                "id" => "isTradeAroundPremises",
                "checked" => false
            )
        ));
        
        $this->add(array(
            "name" => "isPreviousProposal",
            "type" => "checkbox",
            "options" => array(
                "label" => "Previously Insured",
                // 'unchecked_value' => false,
                // 'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isPreviousProposal",
                "checked" => false
            )
        ));
        
        $this->add(array(
            "name" => "isDeclinedInsurer",
            "type" => "checkbox",
            "options" => array(
                "label" => "Previously Declined By an Insurer",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isDeclinedInsurer",
                "checked" => false
            )
        ));
        
        $this->add(array(
            "name" => "declineReason",
            "type" => "textarea",
            "options" => array(
                "label" => "Decline Reason",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "declineReason",
                "checked" => false
            )
        ));
        
        $this->add(array(
            "name" => "isSufferedLoss",
            "type" => "checkbox",
            "options" => array(
                "label" => "Previously Suffered loss",
                // 'unchecked_value' => false,
                // 'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isSufferedLoss",
                "checked" => false
            )
        ));
        
        $this->add(array(
            "name" => "expectedPremium",
            "type" => "text",
            "options" => array(
                "label" => "Expected Premium",
                // 'unchecked_value' => false,
                // 'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "expectedPremium",
                "checked" => false
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
            "expectedPremium"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "isSufferedLoss"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "declineReason"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "isDeclinedInsurer"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "isPreviousProposal"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "isTradeAroundPremises"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "isTradeOnPremises"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "isNightSecurity"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "isDaySecurity"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "isDomesticServants"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "occupyDuration"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "otherOccupier"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "isSoleOccupier"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "isRegularStock"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "isSafe"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "isPreviousClaims"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "isAntiTheftDevice"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "jewelryValue"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "isStockContainsJewelry"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "isLockInGoodState"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ), 
            "notOccupiedDuaration"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ), 
            "isAlwaysOccupied"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ), 
            "otherProperty"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ), 
            "propertyType"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ), 
            "isResidential"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ), 
            
        );
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }
}

