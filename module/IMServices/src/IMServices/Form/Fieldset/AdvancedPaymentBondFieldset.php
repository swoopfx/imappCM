<?php
namespace IMServices\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use IMServices\Entity\AdvancedPaymentBond;

/**
 *
 * @author otaba
 *        
 */
class AdvancedPaymentBondFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;

    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setObject(new AdvancedPaymentBond())->setHydrator($hydrator);
        $this->addFields();
    }

    private function addFields()
    {
        $this->add(array(
            "name" => "bondValue",
            "type" => "text",
            "options" => array(
                "label" => "Bond Value Required",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-sm-7 col-xs-12",
                "id" => "bondValue",
                "placeholder" => "20,000"
            )
        ));
        
        $this->add(array(
            "name" => "commenceDate",
            "type" => "date",
            "options" => array(
                "label" => "Bond Commence Date ",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-sm-7 col-xs-12",
                "id" => "commenceDate"
                // "placeholder"=>"20,000"
            )
        ));
        
        $this->add(array(
            "name" => "finishDate",
            "type" => "date",
            "options" => array(
                "label" => "Bond Finish Date ",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-sm-7 col-xs-12",
                "id" => "finishDate"
                // "placeholder"=>"20,000"
            )
        ));
        
        $this->add(array(
            'name' => 'currency',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Currency',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\Currency',
                // 'empty_option' => '-- Select a Proposed Insurer --',
                'property' => 'title'
            
            ),
            'attributes' => array(
                'id' => 'currency',
                'class' => 'form-control'
            )
        ));
        
        $this->add(array(
            
            "name" => "partyName",
            "type" => "text",
            "options" => array(
                "label" => "Full Name Of Party Bond Favours",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-sm-7 col-xs-12",
                "id" => "partyName"
                // "placeholder"=>"20,000"
            )
        ));
        
        $this->add(array(
            "name" => "partyAddress",
            "type" => "textarea",
            "options" => array(
                "label" => "Full Address Of Party Bond Favours",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-sm-7 col-xs-12",
                "id" => "partyAddress"
                // "placeholder"=>"20,000"
            )
        ));
        
        $this->add(array(
            "name" => "contractPrice",
            "type" => "text",
            "options" => array(
                "label" => "Contract Price",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-sm-7 col-xs-12",
                "id" => "contractPrice",
                "placeholder" => "20,000"
            )
        ));
        
        $this->add(array(
            "name" => "isAwardedByTender",
            "type" => "checkbox",
            "options" => array(
                "label" => "Contract Awarded Via Tender",
                'unchecked_value' => false,
                'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isAwardedByTender",
                "checked" => false
            )
        ));
        
        $this->add(array(
            "name" => "tenderDetails",
            "type" => "textarea",
            "options" => array(
                "label" => "Tender Details",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-sm-7 col-xs-12",
                "id" => "tenderDetails"
                // "placeholder"=>"20,000"
            )
        ));
        
        $this->add(array(
            "name" => "contractNo",
            "type" => "text",
            "options" => array(
                "label" => "Contract Number",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-sm-7 col-xs-12",
                "id" => "contractNo"
                // "placeholder"=>"20,000"
            )
        ));
        
        $this->add(array(
            "name" => "contractDetails",
            "type" => "textarea",
            "options" => array(
                "label" => "Contract Details",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-sm-7 col-xs-12",
                "id" => "contractDetails"
                // "placeholder"=>"20,000"
            )
        ));
        
        $this->add(array(
            "name" => "maintenancePeriod",
            "type" => "text",
            "options" => array(
                "label" => "Maintenance Period",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-sm-7 col-xs-12",
                "id" => "maintenancePeriod",
                "placeholder" => "5 months"
            )
        ));
        
        $this->add(array(
            "name" => "contractLocation",
            "type" => "text",
            "options" => array(
                "label" => "Contract Details",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-sm-7 col-xs-12",
                "id" => "contractLocation",
                "placeholder" => "Lagos Nigeria"
            )
        ));
        
        $this->add(array(
            "name" => "isRetentionForMaintenance",
            "type" => "checkbox",
            "options" => array(
                "label" => "Has Rentention for Maintenance",
                'unchecked_value' => false,
                'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => " col-md-7 col-xs-12",
                "id" => "isRetentionForMaintenance",
                "checked" => false
            )
        ));
        
        $this->add(array(
            "name" => "maintenanceRententionValue",
            "type" => "text",
            "options" => array(
                "label" => "Retention Value",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-sm-7 col-xs-12",
                "id" => "maintenanceRententionValue",
                "placeholder" => "3.2"
            )
        ));
        
        $this->add(array(
            "name" => "isReimbuseIncresedCost",
            "type" => "checkbox",
            "options" => array(
                "label" => "Re-imburse increased Cost",
                'unchecked_value' => false,
                'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isReimbuseIncresedCost",
                "checked" => false
            )
        ));
        
        $this->add(array(
            "name" => "isPreviousContractWithPrincipal",
            "type" => "checkbox",
            "options" => array(
                "label" => "Previously Done Contract with Principal",
                'unchecked_value' => false,
                'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isPreviousContractWithPrincipal",
                "checked" => false
            )
        ));
        
        $this->add(array(
            "name" => "isOwnPlantUsed",
            "type" => "checkbox",
            "options" => array(
                "label" => "Is Using Own Equipment",
                'unchecked_value' => false,
                'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isOwnPlantUsed",
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
        return array();
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }
}

