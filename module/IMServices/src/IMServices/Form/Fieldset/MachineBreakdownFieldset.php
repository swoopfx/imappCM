<?php
namespace IMServices\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use IMServices\Entity\MachineryBreakDown;

/**
 * This also works for computer All risk and electronic all risk
 *
 * @author otaba
 *        
 */
class MachineBreakdownFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;

    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setHydrator($hydrator)->setObject(new MachineryBreakDown());
        $this->addFields();
    }

    private function addFields()
    {
        $this->add(array(
            "name" => "machineUniqueId",
            "type" => "text",
            "options" => array(
                "label" => "Machine unique ID",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "machineUniqueId",
                "class" => "form-control col-md-7 col-xs-12",
                "placeholder" => "IM1298B67"
            )
        ));
        
        // purchaseDate
        
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
                "id" => "machineUniqueId",
                "class" => "form-control col-md-7 col-xs-12"
                // "placeholder"=>"IM1298B67"
            )
        ));
        
        $this->add(array(
            "name" => "coverEndDate",
            "type" => "date",
            "options" => array(
                "label" => "Cover End Date",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "coverEndDate",
                "class" => "form-control col-md-7 col-xs-12"
                // "placeholder"=>"IM1298B67"
            )
        ));
        
        $this->add(array(
            "name" => "coverStartDate",
            "type" => "date",
            "options" => array(
                "label" => "Cover Start Date",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "coverStartDate",
                "class" => "form-control col-md-7 col-xs-12"
                // "placeholder"=>"IM1298B67"
            )
        ));
        
        $this->add(array(
            "name" => "isCoverFoundation",
            "type" => "checkbox",
            "options" => array(
                "label" => "Provide cover for machine foundation",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "isCoverFoundation",
                "class" => "col-md-7 col-xs-12"
                // "placeholder"=>"IM1298B67"
            )
        ));
        
        $this->add(array(
            "name" => "isPreviousLoss",
            "type" => "checkbox",
            "options" => array(
                "label" => "Previously had a loss",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "isPreviousLoss",
                "class" => "form-control col-md-7 col-xs-12"
                // "placeholder"=>"IM1298B67"
            )
        ));
        
        // machineDesc
        
        $this->add(array(
            "name" => "machineDesc",
            "type" => "textarea",
            "options" => array(
                "label" => "Machine Description:",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "machineDesc",
                "class" => "form-control col-md-7 col-xs-12"
                // "placeholder"=>"IM1298B67"
            )
        ));
        
        $this->add(array(
            'name' => 'machinePurchaseType',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Purchase Type',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                // 'empty_option' => '--Member Class -- ',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\VehicleValueType',
                'property' => 'valueType'
            ),
            'attributes' => array(
                'id' => 'machinePurchaseType',
                'class' => 'form-control col-md-7 col-xs-12'
            
            )
        ));
        
        $this->add(array(
            "name" => "machineUse",
            "type" => "textarea",
            "options" => array(
                "label" => "Machine Use",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "machineUse",
                "class" => "form-control col-md-7 col-xs-12"
                // "placeholder"=>"IM1298B67"
            )
        ));
        
        // lastServiceDate
        
        $this->add(array(
            "name" => "lastServiceDate",
            "type" => "date",
            "options" => array(
                "label" => "Last Service Date:",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "lastServiceDate",
                "class" => "form-control col-md-7 col-xs-12"
                // "placeholder"=>"IM1298B67"
            )
        ));
        
        $this->add(array(
            "name" => "serviceCompany",
            "type" => "textarea",
            "options" => array(
                "label" => "Service Company",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "serviceCompany",
                "class" => "form-control col-md-7 col-xs-12"
                // "placeholder"=>"IM1298B67"
            )
        ));
        
        $this->add(array(
            "name" => "isFireBuglary",
            "type" => "checkbox",
            "options" => array(
                "label" => "Has Fire Buglary Cover",
                'unchecked_value' => false,
                'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "isFireBuglary",
                "class" => "col-md-7 col-xs-12",
                "checked" => false
                // "required"=>"required"
            )
        ));
        
        $this->add(array(
            'name' => 'fireBuglaryInsurer',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Fire Buglary Insurer',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                // 'empty_option' => 'Unsaved',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\Insurer',
                'property' => 'insuranceName',
                'is_method' => true,
                'find_method' => array(
                    'name' => 'findActiveInsurer'
                
                )
            ),
            'attributes' => array(
                'id' => 'fireBuglaryInsurer',
                'class' => 'form-control col-md-7 col-xs-12'
                // 'disabled' => 'disabled',
                // 'placeholder' => 'Unsaved'
            )
        ));
        
        // isPreviousDecline
        
        $this->add(array(
            "name" => "isPreviousDecline",
            "type" => "checkbox",
            "options" => array(
                "label" => "Cover Previously Declined",
                'unchecked_value' => false,
                'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "isPreviousDecline",
                "class" => "col-md-7 col-xs-12",
                "checked" => false
                // "required"=>"required"
            )
        ));
        
        // declineDetails
        
        $this->add(array(
            "name" => "declineDetails",
            "type" => "textarea",
            "options" => array(
                "label" => "Decline Details",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "declineDetails",
                "class" => "form-control col-md-7 col-xs-12"
                // "placeholder"=>"IM1298B67"
            )
        ));
        
        $this->add(array(
            "name" => "previousLoss",
            "type" => "textarea",
            "options" => array(
                "label" => "Details about previous loss",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "previousLoss",
                "class" => "form-control col-md-7 col-xs-12"
                // "placeholder"=>"IM1298B67"
            )
        ));
        
        $this->add(array(
            "name" => "isPreviousLoss",
            "type" => "checkbox",
            "options" => array(
                "label" => "Previously had a loss",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "isPreviousLoss",
                "class" => "col-md-7 col-xs-12"
                // "placeholder"=>"IM1298B67"
            )
        ));
        
        $this->add(array(
            "name" => "declineDetails",
            "type" => "textarea",
            "options" => array(
                "label" => "Decline Details",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "declineDetails",
                "class" => "form-control col-md-7 col-xs-12"
                // "placeholder"=>"IM1298B67"
            )
        ));
        
        $this->add(array(
            "name" => "materialFacts",
            "type" => "textarea",
            "options" => array(
                "label" => "Additional Details/Facts",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "materialFacts",
                "class" => "form-control col-md-7 col-xs-12"
                // "placeholder"=>"IM1298B67"
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
            "materialFacts" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "declineDetails" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "isPreviousDecline" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "previousLoss" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "declineDetails" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "fireBuglaryInsurer" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "isFireBuglary" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "lastServiceDate" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "serviceCompany" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "machineUse" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "machinePurchaseType" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "machineDesc" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "isPreviousLoss" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "isCoverFoundation" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "coverStartDate" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "coverEndDate" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "purchaseDate" => array(
                "allow_empty" => true,
                "required" => false
            )
        
        );
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }
}

