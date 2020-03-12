<?php
namespaceClaims\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Claims\Entity\ClaimsContractAllRiskLossList;

class ClaimsContractAllRiskLossListFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;

    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setHydrator($hydrator)->setObject(new ClaimsContractAllRiskLossList());

        $this->add(array(
            "name" => "machineDefinition",
            "type" => "text",
            "options" => array(
                "label" => "Machinery Definition",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-sm-7 col-xs-12",
                "id" => "machineDefinition",
                "required" => "required"
            )
        ));

        $this->add(array(
            "name" => "partnExtentDamaged",
            "type" => "textarea",
            "options" => array(
                "label" => "Parts & extent of damage",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-sm-7 col-xs-12",
                "id" => "partnExtentDamaged"
                // "required"=>"required"
            )
        ));

        $this->add(array(
            "name" => "itemNo",
            "type" => "text",
            "options" => array(
                "label" => "Machinery No.",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-sm-7 col-xs-12",
                "id" => "itemNo"
                // "required"=>"required"
            )
        ));

        $this->add(array(
            "name" => "machineMake",
            "type" => "text",
            "options" => array(
                "label" => "Machine Make",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-sm-7 col-xs-12",
                "id" => "machineMake"
                // "required"=>"required"
            )
        ));

        $this->add(array(
            "name" => "registrationNo",
            "type" => "text",
            "options" => array(
                "label" => "Machiner Reg. No.",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-sm-7 col-xs-12",
                "id" => "registrationNo"
                // "required"=>"required"
            )
        ));

        $this->add(array(
            "name" => "yearOfManu",
            "type" => "text",
            "options" => array(
                "label" => "Machine Manufacture Year",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-sm-7 col-xs-12",
                "id" => "yearOfManu"
                // "required"=>"required"
            )
        ));

//         $this->add(array(
//             "name" => "yearOfManu",
//             "type" => "text",
//             "options" => array(
//                 "label" => "Machine Manufacture Year",
//                 "label_attributes" => array(
//                     "class" => "control-label col-md-3 col-sm-3 col-xs-12"
//                 )
//             ),
//             "attributes" => array(
//                 "class" => "form-control col-md-7 col-sm-7 col-xs-12",
//                 "id" => "yearOfManu"
//                 // "required"=>"required"
//             )
//         ));

//         $this->add(array(
//             "name" => "registrationNo",
//             "type" => "text",
//             "options" => array(
//                 "label" => "Machiner Reg. No.",
//                 "label_attributes" => array(
//                     "class" => "control-label col-md-3 col-sm-3 col-xs-12"
//                 )
//             ),
//             "attributes" => array(
//                 "class" => "form-control col-md-7 col-sm-7 col-xs-12",
//                 "id" => "registrationNo"
//                 // "required"=>"required"
//             )
//         ));

//         $this->add(array(
//             "name" => "dateOfPurchase",
//             "type" => "date",
//             "options" => array(
//                 "label" => "Purchase Date",
//                 "label_attributes" => array(
//                     "class" => "control-label col-md-3 col-sm-3 col-xs-12"
//                 )
//             ),
//             "attributes" => array(
//                 "class" => "form-control col-md-7 col-sm-7 col-xs-12",
//                 "id" => "dateOfPurchase"
//                 // "required"=>"required"
//             )
//         ));

        $this->add(array(
            "name" => "dateOfPurchase",
            "type" => "date",
            "options" => array(
                "label" => "Purchase Date",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-sm-7 col-xs-12",
                "id" => "dateOfPurchase"
                // "required"=>"required"
            )
        ));

        $this->add(array(
            "name" => "machineCostPrice",
            "type" => "text",
            "options" => array(
                "label" => "Machine Cost Price",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-sm-7 col-xs-12",
                "id" => "machineCostPrice"
                // "required"=>"required"
            )
        ));

        $this->add(array(
            "name" => "deduction",
            "type" => "text",
            "options" => array(
                "label" => "Machinery Deduction",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-sm-7 col-xs-12",
                "id" => "deduction"
                // "required"=>"required"
            )
        ));

        $this->add(array(
            "name" => "presentClaimsValue",
            "type" => "text",
            "options" => array(
                "label" => "Claims Value",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-sm-7 col-xs-12",
                "id" => "presentClaimsValue",
                "required" => "required"
            )
        ));

        $this->add(array(
            "name" => "presentClaimsRepairValue",
            "type" => "text",
            "options" => array(
                "label" => "Claims Repair Value",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-sm-7 col-xs-12",
                "id" => "presentClaimsRepairValue",
                "required"=>"required"
            )
        ));
    }

    public function getInputFilterSpecification()
    {
        return array(
            "presentClaimsRepairValue"=>array(
                "allow_empty"=>FALSE,
                "required"=>true
            ),
            "presentClaimsValue"=>array(
                "allow_empty"=>FALSE,
                "required"=>true
            ),
            "deduction"=>array(
                "allow_empty"=>true,
                "required"=>FALSE
            ),
            
            "machineCostPrice"=>array(
                "allow_empty"=>true,
                "required"=>FALSE
            ),
            
            "dateOfPurchase"=>array(
                "allow_empty"=>true,
                "required"=>FALSE
            ),
            
            "yearOfManu"=>array(
                "allow_empty"=>true,
                "required"=>FALSE
            ),
            
            "registrationNo"=>array(
                "allow_empty"=>true,
                "required"=>FALSE
            ),
            
            "machineMake"=>array(
                "allow_empty"=>true,
                "required"=>FALSE
            ),
            
            "itemNo"=>array(
                "allow_empty"=>true,
                "required"=>FALSE
            ),
            
            "partnExtentDamaged"=>array(
                "allow_empty"=>true,
                "required"=>FALSE
            ),
            
            "machineDefinition"=>array(
                "allow_empty"=>true,
                "required"=>FALSE
            ),
        );
    }
}

