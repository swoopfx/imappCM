<?php
namespace IMServices\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use IMServices\Entity\PublicLiability;

/**
 *
 * @author otaba
 *        
 */
class PublicLiabilityFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;

    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setHydrator($hydrator)->setObject(new PublicLiability());
        
       
        
        $this->add(array(
            "name" => "ownPremisesTotalWages",
            "type" => "text",
            "options" => array(
                "label" => "Total Annual Wages in Premises",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-xs-12",
                "id" => "ownPremisesTotalWages"
            )
        ));
        
        $this->add(array(
            "name" => "elsewhereTotalWages",
            "type" => "text",
            "options" => array(
                "label" => "Total Annual Wages in Other Premises",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-xs-12",
                "id" => "elsewhereTotalWages"
            )
        ));
        
        $this->add(array(
            "name" => "ownSubContractorsPayment",
            "type" => "text",
            "options" => array(
                "label" => "Total Annual Wages for subcontractors on premises",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-xs-12",
                "id" => "ownSubContractorsPayment"
            )
        ));
        
        $this->add(array(
            "name" => "elseSubContractorsPayment",
            "type" => "text",
            "options" => array(
                "label" => "Total Wages for subcontractors else where ",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
        "class"=>"form-control col-md-7 col-xs-12",
        "id"=>"ownSubContractorsPayment"
        )
        ));
        
        $this->add(array(
            "name" => "isGoodState",
            "type" => "checkbox",
            "options" => array(
                "label" => "Premises in Good Condition",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isGoodState"
            )
        ));
        
        $this->add(array(
            "name" => "isGoodLifts",
            "type" => "checkbox",
            "options" => array(
                "label" => "Have you any good lifts, cranes or hoists",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isGoodLifts"
            )
        ));
        //
        
        $this->add(array(
            "name" => "isCraneRegularlyinspected",
            "type" => "checkbox",
            "options" => array(
                "label" => "Cranes are regularly Inpected",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isGoodState"
            )
        ));
        
        $this->add(array(
            "name" => "inspectionBy",
            "type" => "text",
            "options" => array(
                "label" => "Inspections Made by",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-xs-12",
                "id" => "inspectionBy"
            )
        ));
        
        $this->add(array(
            "name" => "isExplosiveMaterial",
            "type" => "checkbox",
            "options" => array(
                "label" => "Has acids, gases, chemicals, explosives or radio-active materials",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isExplosiveMaterial"
            )
        ));
        
        
        
        $this->add(array(
            "name" => "explosiveAcids",
            "type" => "text",
            "options" => array(
                "label" => "Acids, Chemicals and explosives list",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-xs-12",
                "id" => "explosiveAcids"
            )
        ));
        
        $this->add(array(
            "name" => "indemnityLimit",
            "type" => "text",
            "options" => array(
                "label" => "Limits of indemnity required",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-xs-12",
                "id" => "indemnityLimit"
            )
        ));
        
        $this->add(array(
            "name" => "isFoodpoison",
            "type" => "checkbox",
            "options" => array(
                "label" => "Include Food Poison",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isFoodpoison"
            )
        ));
        
        $this->add(array(
            "name" => "isFireNExplosion",
            "type" => "checkbox",
            "options" => array(
                "label" => "Include fire & explosion",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isFireNExplosion"
            )
        ));
        
        $this->add(array(
            "name" => "isSpecial",
            "type" => "checkbox",
            "options" => array(
                "label" => "Include special term",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isSpecial"
            )
        ));
        
        $this->add(array(
            "name" => "specialDetails",
            "type" => "text",
            "options" => array(
                "label" => "Special Details",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "specialDetails"
            )
        ));
        
        //
        $this->add(array(
            "name" => "isPreviousInsure",
            "type" => "checkbox",
            "options" => array(
                "label" => "Previously Insured",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isPreviousInsure"
            )
        ));
        
        $this->add(array(
            "name" => "isDeclined",
            "type" => "checkbox",
            "options" => array(
                "label" => "Was Declined",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isDeclined"
            )
        ));
        
        $this->add(array(
            "name" => "isRefusedRenew",
            "type" => "checkbox",
            "options" => array(
                "label" => "insurer refused renewal",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isRefusedRenew"
            )
        ));
        
        $this->add(array(
            "name" => "isPecialReason",
            "type" => "checkbox",
            "options" => array(
                "label" => "Insurer provided special reason",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isPecialReason"
            )
        ));
        
        $this->add(array(
            "name" => "specialReason",
            "type" => "textarea",
            "options" => array(
                "label" => "Special Reason ",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "specialReason"
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
            "specialReason" => array(
                "allow_empty" => true,
                'required' => false
            ),
            "isPecialReason" => array(
                "allow_empty" => true,
                'required' => false
            ),
            "isRefusedRenew" => array(
                "allow_empty" => true,
                'required' => false
            ),
            "isDeclined" => array(
                "allow_empty" => true,
                'required' => false
            ),
            "isPreviousInsure" => array(
                "allow_empty" => true,
                'required' => false
            ),
            "specialDetails" => array(
                "allow_empty" => true,
                'required' => false
            ),
            "isSpecial" => array(
                "allow_empty" => true,
                'required' => false
            ),
            "isFoodpoison" => array(
                "allow_empty" => true,
                'required' => false
            ),
            "isFireNExplosion" => array(
                "allow_empty" => true,
                'required' => false
            ),
            "indemnityLimit" => array(
                "allow_empty" => true,
                'required' => false
            ),
            "isExplosiveMaterial" => array(
                "allow_empty" => true,
                'required' => false
            ),
            "inspectionBy" => array(
                "allow_empty" => true,
                'required' => false
            ),
            "isCraneRegularlyinspected" => array(
                "allow_empty" => true,
                'required' => false
            ),
            
            "isGoodLifts" => array(
                "allow_empty" => true,
                'required' => false
            ),
            
            "isGoodState" => array(
                "allow_empty" => true,
                'required' => false
            ),
            
            "ownSubContractorsPayment" => array(
                "allow_empty" => true,
                'required' => false
            ),
            
            "elsewhereTotalWages" => array(
                "allow_empty" => true,
                'required' => false
            ),
            
            "ownPremisesTotalWages" => array(
                "allow_empty" => true,
                'required' => false
            ),
            
            "noOfEmployees" => array(
                "allow_empty" => true,
                'required' => false
            ),
            "natureOfWork" => array(
                "allow_empty" => true,
                'required' => false
            ),
            "insuranceConnection" => array(
                "allow_empty" => true,
                'required' => false
            )
        );
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }
}

