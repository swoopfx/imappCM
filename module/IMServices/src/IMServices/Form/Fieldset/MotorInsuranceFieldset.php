<?php
namespace IMServices\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use IMServices\Entity\MotorData;

/**
 *
 * @author otaba
 *        
 */
class MotorInsuranceFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;

    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setObject(new MotorData())->setHydrator($hydrator);
        $this->addFeilds();
    }

    private function addFeilds()
    {
        $this->add(array(
            "name" => "purposeOfUse",
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Purpose Of Use',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                // 'empty_option' => '--Select Geographical Location -- ',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\MotorPurposeOfUse',
                'property' => 'motorPurpose'
            ),
            'attributes' => array(
                'id' => 'purposeOfUse',
                'class' => 'form-control col-md-7 col-xs-12'
            
            )
        ));
        

        
        $this->add(array(
            "name" => "extraPurposeOfUse",
            "type" => "textarea",
            "options" => array(
                "label" => "Alternate Use",
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            "attributes" => array(
                "placeholder" => "if applicable",
                "id" => "extraPurposeOfUse",
                // "required"=>"required",
                "class" => 'form-control col-md-7 col-xs-12'
            )
        ));
        
        $this->add(array(
            "name" => "isLimitedToOnlyMe",
            "type" => "checkbox",
            "options" => array(
                "label" => "Policy cover only owner",
                // 'unchecked_value' => false,
                // 'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isLimitedToOnlyMe",
                "checked" => true
            )
        ));
        
        $this->add(array(
            "name" => "isCommercialGoods",
            "type" => "checkbox",
            "options" => array(
                "label" => "Commercial Carriage of goods",
                // 'unchecked_value' => false,
                // 'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isCommercialGoods"
                // "checked" => true
            )
        ));
        
        $this->add(array(
            "name" => "isCommercialTraveling",
            "type" => "checkbox",
            "options" => array(
                "label" => "Commercial Travelling",
                // 'unchecked_value' => false,
                // 'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isCommercialTraveling"
                // "checked" => true
            )
        ));
        
        $this->add(array(
            "name" => "commercialDetails",
            "type" => "textarea",
            "options" => array(
                "label" => "Carriage/Tavelling details",
                // 'unchecked_value' => false,
                // 'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-xs-12",
                "id" => "commercialDetails",
                // "checked" => true
                "placeholder" => "if applicable"
            )
        ));
        
        $this->add(array(
            "name" => "peopleDrivingCar",
            "type" => "textarea",
            "options" => array(
                "label" => "Alternate Drivers",
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            "attributes" => array(
                // "placeholder"=>"Comercial Transportation",
                "id" => "peopleDrivingCar",
                "class" => 'form-control col-md-7 col-xs-12'
            )
        ));
        
        // isPreviousClaims
        
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
                "class" => "col-md-7 col-xs-12",
                "id" => "isPreviousClaims"
                // "value"=>false
                // "checked" => true
            )
        ));
        
        $this->add(array(
            "name" => "isSoleOwner",
            "type" => "checkbox",
            "options" => array(
                "label" => "I am Sole Owner",
                // 'unchecked_value' => false,
                // 'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "isSoleOwner",
                "class" => "col-md-7 col-xs-12",
                "checked" => true
                // "required"=>"required"
            )
        ));
        
        $this->add(array(
            "name" => "owner",
            "type" => "text",
            "options" => array(
                "label" => "Motor Owner",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-xs-12",
                "id" => "owner",
                "placeholder" => "Kunle Folawiyo"
            )
        ));
        
        $this->add(array(
            "name" => "isLockedUp",
            "type" => "checkbox",
            "options" => array(
                "label" => "Motor is Locked up at night",
                // 'unchecked_value' => false,
                // 'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "isLockedUp",
                "class" => "col-md-7 col-xs-12",
                "checked" => true
                // "required"=>"required"
            )
        ));
        
        // isSafetyDevice
        $this->add(array(
            "name" => "isSafetyDevice",
            "type" => "checkbox",
            "options" => array(
                "label" => "Has Safety/Security Device",
                // 'unchecked_value' => false,
                // 'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "isSafetyDevice",
                "class" => "col-md-7 col-xs-12",
                "checked" => true
                // "required"=>"required"
            )
        ));
        
        $this->add(array(
            "name" => "isDriverLicense",
            "type" => "checkbox",
            "options" => array(
                "label" => "Driver has License",
                // 'unchecked_value' => false,
                // 'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "isDriverLicense",
                "class" => "col-md-7 col-xs-12",
                "checked" => true
                // "required"=>"required"
            )
        ));
        
        // $this->add(array(
        // "name" => "isPreviousClaim",
        // "type" => "checkbox",
        // "options" => array(
        // "label" => "Has a Previous Claim",
        // 'unchecked_value' => false,
        // 'checked_value' => true,
        // "label_attributes" => array(
        // "class" => "control-label col-md-3 col-sm-3 col-xs-12"
        // )
        // ),
        // "attributes" => array(
        // "id" => "isPreviousClaim",
        // "class" => "col-md-7 col-xs-12",
        // "checked" => false,
        // "value"=>false
        // // "required"=>"required"
        // )
        // ));
        
        $this->add(array(
            "name" => "isDecline",
            "type" => "checkbox",
            "options" => array(
                "label" => "An Insurer has previously declined",
                // 'unchecked_value' => false,
                // 'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "isDecline",
                "class" => "col-md-7 col-xs-12",
                "checked" => false
                // "value"=>false
                // "required"=>"required"
            )
        ));
        
        $this->add(array(
            "name" => "declineDetails",
            "type" => "textarea",
            "options" => array(
                "label" => "Decline Reason",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "declineDetails",
                "class" => "form-control  col-md-7 col-xs-12",
                "placeholder" => "Reason for decline"
            )
        ));
        
        $this->add(array(
            "name" => "isCancel",
            "type" => "checkbox",
            "options" => array(
                "label" => "Insurer Canceled Policy",
                // 'unchecked_value' => false,
                // 'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "isCancel",
                "class" => "col-md-7 col-xs-12 switch",
                "checked" => false
                // "value"=>false
                // "required"=>"required"
            )
        ));
        
        $this->add(array(
            "name" => "cancelReason",
            "type" => "textarea",
            "options" => array(
                "label" => "Cancel Reason",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "cancelReason",
                "class" => "form-control col-md-7 col-xs-12",
                "placeholder" => "Reason for decline"
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
            "isCancel" => array(
                "allow_empty" => true,
                'required' => false
            ),
            
            "isPreviousClaim" => array(
                "allow_empty" => true,
                'required' => false
            ),
            
            "isDecline" => array(
                "allow_empty" => true,
                'required' => false
            ),
            
            "isPreviousClaims" => array(
                "allow_empty" => true,
                'required' => false
            ),
            "cancelReasons" => array(
                "allow_empty" => true,
                'required' => false
            ),
            "isCancel" => array(
                "allow_empty" => true,
                'required' => false
            ),
            "isDriverLicense" => array(
                "allow_empty" => true,
                'required' => false
            ),
            "isSafetyDevice" => array(
                "allow_empty" => true,
                'required' => false
            ),
            "isLockedUp" => array(
                "allow_empty" => true,
                'required' => false
            ),
            "isSoleOwner" => array(
                "allow_empty" => true,
                'required' => false
            ),
            "extraPurposeOfUse" => array(
                "allow_empty" => true,
                'required' => false
            ),
            "purposeOfUse" => array(
                "allow_empty" => true,
                'required' => false
            ),
            "isLimitedToOnlyMe" => array(
                "allow_empty" => true,
                'required' => false
            ),
            "peopleDrivingCar" => array(
                "allow_empty" => true,
                'required' => false
            ),
            "commercialDetails" => array(
                "allow_empty" => true,
                'required' => false
            ),
            "isCommercialTraveling" => array(
                "allow_empty" => true,
                'required' => false
            ),
            "isCommercialGoods" => array(
                "allow_empty" => true,
                'required' => false
            )
            //
        
        );
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }
}

