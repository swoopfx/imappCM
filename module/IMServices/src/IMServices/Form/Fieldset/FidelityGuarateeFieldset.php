<?php
namespace IMServices\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use IMServices\Entity\FidelityGaurantee;

/**
 *
 * @author otaba
 *        
 */
class FidelityGuarateeFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;

    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setObject(new FidelityGaurantee())->setHydrator($hydrator);
        $this->addFields();
    }

    private function addFields()
    {
        $this->add(array(
            "name" => "briefDescription",
            "type" => "textarea",
            "options" => array(
                "label" => "Brief operations description",
                "label_attributes" => array(
                    "class" => "control-label col-md-4 col-sm-4 col-xs-12"
                )
            ),
            "attributes" => array(
                'id' => 'briefDescription',
                'class' => 'form-control col-md-7 col-xs-12',
//                 "placeholder" => "$250,000 claims on Segun Awolowo"
            )
        ));
        
        $this->add(array(
            "name" => "isOtherInstruments",
            "type" => "checkbox",
            "options" => array(
                "label" => "Has other instruments, articles or goods involved in your operation",
                "label_attributes" => array(
                    "class" => "control-label col-md-4 col-sm-4 col-xs-12"
                )
            ),
            "attributes" => array(
                'id' => 'isOtherInstruments',
                'class' => 'col-md-7 col-xs-12',
                //                 "placeholder" => "$250,000 claims on Segun Awolowo"
            )
        ));
        
        $this->add(array(
            "name" => "otherInstrument",
            "type" => "text",
            "options" => array(
                "label" => "Other instruments, articles or goods involved in your operation list",
                "label_attributes" => array(
                    "class" => "control-label col-md-4 col-sm-4 col-xs-12"
                )
            ),
            "attributes" => array(
                'id' => ' otherInstrument',
                'class' => 'form-control col-md-7 col-xs-12',
                //                 "placeholder" => "$250,000 claims on Segun Awolowo"
            )
        ));
        
       
        
        $this->add(array(
            "name" => "operationDuration",
            "type" => "text",
            "options" => array(
                "label" => "How long have you or the Company had been operating",
                "label_attributes" => array(
                    "class" => "control-label col-md-4 col-sm-4 col-xs-12"
                )
            ),
            "attributes" => array(
                'id' => 'operationDuration',
                'class' => 'form-control col-md-7 col-xs-12',
                //                 "placeholder" => "$250,000 claims on Segun Awolowo"
            )
        ));
        
        $this->add(array(
            "name" => "isReferenceForm",
            "type" => "checkbox",
            "options" => array(
                "label" => "All Employee Submitted Refrence Form",
                'unchecked_value' => false,
                'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-4 col-sm-4 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "isReferenceForm",
                "class" => "col-md-7 col-xs-12",
                "checked" => false
                // "required"=>"required"
            )
        ));
        
        $this->add(array(
            "name" => "isPreviousInsure",
            "type" => "checkbox",
            "options" => array(
                "label" => "Has a previous Insurer",
//                 'unchecked_value' => false,
//                 'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-4 col-sm-4 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "isPreviousInsure",
                "class" => "col-md-7 col-xs-12",
                "checked" => false
                // "required"=>"required"
            )
        ));
        
        $this->add(array(
            'name' => 'previousInsure',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Previous Insurer',
                'label_attributes' => array(
                    'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
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
                'id' => 'form_status',
                'class' => 'form-control col-md-7 col-xs-12'
                // 'disabled' => 'disabled',
                // 'placeholder' => 'Unsaved'
            )
        ));
        
        $this->add(array(
            "name" => "isPrevuiousLoss",
            "type" => "checkbox",
            "options" => array(
                "label" => "Has a previous Loss/Claim",
                //                 'unchecked_value' => false,
            //                 'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-4 col-sm-4 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "isPrevuiousLoss",
                "class" => "col-md-7 col-xs-12",
                "checked" => false
                // "required"=>"required"
            )
        ));
        
        $this->add(array(
            "name" => "lossNumberOfOccurence",
            "type" => "text",
            "options" => array(
                "label" => "Number of loses made",
                "label_attributes" => array(
                    "class" => "control-label col-md-4 col-sm-4 col-xs-12"
                )
            ),
            "attributes" => array(
                'id' => 'lossNumberOfOccurence',
                'class' => 'form-control col-md-7 col-xs-12',
                "placeholder"=>"4"
                //                 "placeholder" => "$250,000 claims on Segun Awolowo"
            )
        ));
        
        $this->add(array(
            "name" => "maxAmountOfLoss",
            "type" => "text",
            "options" => array(
                "label" => "Maximum amount of direct loss per occurrence",
                "label_attributes" => array(
                    "class" => "control-label col-md-4 col-sm-4 col-xs-12"
                )
            ),
            "attributes" => array(
                'id' => 'maxAmountOfLoss',
                'class' => 'form-control col-md-7 col-xs-12',
                //                 "placeholder" => "$250,000 claims on Segun Awolowo"
            )
        ));
        
        $this->add(array(
            "name" => "previousLoss",
            "type" => "textarea",
            "options" => array(
                "label" => "Previous Loss",
                "label_attributes" => array(
                    "class" => "control-label col-md-4 col-sm-4 col-xs-12"
                )
            ),
            "attributes" => array(
                'id' => 'previous_loss',
                'class' => 'form-control col-md-7 col-xs-12',
                "placeholder" => "$250,000 claims on Segun Awolowo"
            )
        ));
        
        
        
        
        $this->add(array(
            "name" => "isEmployeePowerOnAcc",
            "type" => "checkbox",
            "options" => array(
                "label" => "Employee has Access to account.",
//                 'unchecked_value' => false,
//                 'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-4 col-sm-4 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "isEmployeePowerOnAcc",
                "class" => "col-md-7 col-xs-12",
                "checked" => false
                // "required"=>"required"
            )
        ));
        
//         $this->add(array(
//             "name" => "isUnamedBasis",
//             "type" => "checkbox",
//             "options" => array(
//                 "label" => "Unnamed Basis",
//                 //                 'unchecked_value' => false,
//             //                 'checked_value' => true,
//                 "label_attributes" => array(
//                     "class" => "control-label col-md-4 col-sm-4 col-xs-12"
//                 )
//             ),
//             "attributes" => array(
//                 "id" => "isUnamedBasis",
//                 "class" => "col-md-7 col-xs-12",
//                 "checked" => false
//                 // "required"=>"required"
//             )
//         ));
        
//         $this->add(array(
//             "name" => "unamedTotalNumberOfStaff",
//             "type" => "text",
//             "options" => array(
//                 "label" => "Total Number of Staff ",
//                 "label_attributes" => array(
//                     "class" => "control-label col-md-4 col-sm-4 col-xs-12"
//                 )
//             ),
//             "attributes" => array(
//                 'id' => 'unamedTotalNumberOfStaff',
//                 'class' => 'form-control col-md-7 col-xs-12',
//                 "placeholder" => "40"
//             )
//         ));
        
        
//         $this->add(array(
//             "name" => "unamedAmountPerPerson",
//             "type" => "text",
//             "options" => array(
//                 "label" => "Amount Per Person",
//                 "label_attributes" => array(
//                     "class" => "control-label col-md-4 col-sm-4 col-xs-12"
//                 )
//             ),
//             "attributes" => array(
//                 'id' => 'unamedAmountPerPerson',
//                 'class' => 'form-control col-md-7 col-xs-12',
//                 "placeholder" => "40,000"
//             )
//         ));
        
//         $this->add(array(
//             "name" => "unamedTotalAmountGuarateed",
//             "type" => "text",
//             "options" => array(
//                 "label" => "Total Amount guarateed",
//                 "label_attributes" => array(
//                     "class" => "control-label col-md-4 col-sm-4 col-xs-12"
//                 )
//             ),
//             "attributes" => array(
//                 'id' => 'unamedTotalAmountGuarateed',
//                 'class' => 'form-control col-md-7 col-xs-12',
//                 "placeholder" => "40,000"
//             )
//         ));
        
//         $this->add(array(
//             "name" => "aggregatedAmountGaurateed",
//             "type" => "text",
//             "options" => array(
//                 "label" => "Aggregated Amount guarateed",
//                 "label_attributes" => array(
//                     "class" => "control-label col-md-4 col-sm-4 col-xs-12"
//                 )
//             ),
//             "attributes" => array(
//                 'id' => 'aggregatedAmountGaurateed',
//                 'class' => 'form-control col-md-7 col-xs-12',
//                 "placeholder" => "40,000"
//             )
//         ));
        
        $this->add(array(
            "name" => "employeeMaxAccPayout",
            "type" => "text",
            "options" => array(
                "label" => "Employee Max Access ",
                "label_attributes" => array(
                    "class" => "control-label col-md-4 col-sm-4 col-xs-12"
                )
            ),
            "attributes" => array(
                'id' => 'employeeMaxAccPayout',
                'class' => 'form-control col-md-7 col-xs-12',
                "placeholder" => "250000"
            )
        ));
        
        $this->add(array(
            "name" => "fictiousPayroll",
            "type" => "textarea",
            "options" => array(
                "label" => "Fictitious Payroll System ",
                "label_attributes" => array(
                    "class" => "control-label col-md-4 col-sm-4 col-xs-12"
                )
            ),
            "attributes" => array(
                'id' => 'fictiousPayroll',
                'class' => 'form-control col-md-7 col-xs-12'
                // "placeholder"=>"250000"
            )
        ));
        
        // securityMeasure
        
        $this->add(array(
            "name" => "securityMeasure",
            "type" => "textarea",
            "options" => array(
                "label" => "Security Measure",
                "label_attributes" => array(
                    "class" => "control-label col-md-4 col-sm-4 col-xs-12"
                )
            ),
            "attributes" => array(
                'id' => 'securityMeasure',
                'class' => 'form-control col-md-7 col-xs-12'
                // "placeholder"=>"250000"
            )
        ));
        
        $this->add(array(
            "name" => "balanceBookFrequency",
            "type" => "text",
            "options" => array(
                "label" => "How frequently do u balance books",
                "label_attributes" => array(
                    "class" => "control-label col-md-4 col-sm-4 col-xs-12"
                )
            ),
            "attributes" => array(
                'id' => 'balanceBookFrequency',
                'class' => 'form-control col-md-7 col-xs-12',
                "placeholder" => "Yearly"
            )
        ));
        
        $this->add(array(
            "name" => "isAudit",
            "type" => "checkbox",
            "options" => array(
                "label" => "Audit on account takes place",
                "label_attributes" => array(
                    "class" => "control-label col-md-4 col-sm-4 col-xs-12"
                )
            ),
            "attributes" => array(
                'id' => 'isAudit',
                'class' => 'col-md-7 col-xs-12',
//                 "placeholder" => "Yearly"
            )
        ));
        
        $this->add(array(
            "name" => "auditDuration",
            "type" => "text",
            "options" => array(
                "label" => "Audit Duration",
                "label_attributes" => array(
                    "class" => "control-label col-md-4 col-sm-4 col-xs-12"
                )
            ),
            "attributes" => array(
                'id' => 'auditDuration',
                'class' => 'form-control col-md-7 col-xs-12',
                "placeholder" => "Yearly"
            )
        ));
        
        $this->add(array(
            "name" => "auditor",
            "type" => "text",
            "options" => array(
                "label" => "Auditor In charge",
                "label_attributes" => array(
                    "class" => "control-label col-md-4 col-sm-4 col-xs-12"
                )
            ),
            "attributes" => array(
                'id' => 'auditor',
                'class' => 'form-control col-md-7 col-xs-12',
                "placeholder" => "Olugbede Chattered accountant"
            )
        ));
        
        $this->add(array(
            "name" => "isUnamedBasis",
            "type" => "checkbox",
            "options" => array(
                "label" => "Use unamed Basis",
                "label_attributes" => array(
                    "class" => "control-label col-md-4 col-sm-4 col-xs-12"
                )
            ),
            "attributes" => array(
                'id' => 'isUnamedBasis',
                'class' => 'col-md-7 col-xs-12',
                "checked"=>true
//                 "placeholder" => "Yearly"
            )
        ));
        
        
        $this->add(array(
            "name" => "unamedTotalNumberOfStaff",
            "type" => "text",
            "options" => array(
                "label" => "Total number of staff (Unnamed)",
                "label_attributes" => array(
                    "class" => "control-label col-md-4 col-sm-4 col-xs-12"
                )
            ),
            "attributes" => array(
                'id' => 'unamedTotalNumberOfStaff',
                'class' => 'form-control col-md-7 col-xs-12',
                //                 "placeholder" => "Yearly"
            )
        ));
        
        $this->add(array(
            "name" => "unamedAmountPerPerson",
            "type" => "text",
            "options" => array(
                "label" => "Amount per person(Unnamed)",
                "label_attributes" => array(
                    "class" => "control-label col-md-4 col-sm-4 col-xs-12"
                )
            ),
            "attributes" => array(
                'id' => 'unamedAmountPerPerson',
                'class' => 'form-control col-md-7 col-xs-12',
                //                 "placeholder" => "Yearly"
            )
        ));
        
        $this->add(array(
            "name" => "unamedTotalAmountGuarateed",
            "type" => "text",
            "options" => array(
                "label" => "Total amount to be gaurateed(Unnamed)",
                "label_attributes" => array(
                    "class" => "control-label col-md-4 col-sm-4 col-xs-12"
                )
            ),
            "attributes" => array(
                'id' => 'unamedTotalAmountGuarateed',
                'class' => 'form-control col-md-7 col-xs-12',
                //                 "placeholder" => "Yearly"
            )
        ));
        
        $this->add(array(
            "name" => "unamedAggregatedAmountGaurateed",
            "type" => "text",
            "options" => array(
                "label" => "Aggregat amount gaurateed(Unnamed)",
                "label_attributes" => array(
                    "class" => "control-label col-md-4 col-sm-4 col-xs-12"
                )
            ),
            "attributes" => array(
                'id' => 'unamedAggregatedAmountGaurateed',
                'class' => 'form-control col-md-7 col-xs-12',
                //                 "placeholder" => "Yearly"
            )
        ));
        
//         $this->add(array(
//             "name" => "unamedAggregatedAmountGaurateed",
//             "type" => "text",
//             "options" => array(
//                 "label" => "Aggregat amount gaurateed(Unnamed)",
//                 "label_attributes" => array(
//                     "class" => "control-label col-md-4 col-sm-4 col-xs-12"
//                 )
//             ),
//             "attributes" => array(
//                 'id' => 'unamedAggregatedAmountGaurateed',
//                 'class' => 'form-control col-md-7 col-xs-12',
//                 //                 "placeholder" => "Yearly"
//             )
//         ));
        
        
//         $this->add(array(
//             "name"=>"employeeFidelityList",
//             "type"=>"Zend\Form\Element\Collection",
//             "options"=>array(
//                 'label' => 'Enter Employee details',
//                 'count' => 1,
//                 'should_create_template' => false,
//                 'allow_add' => true,
//                 'target_element' => array(
//                     'type' => 'IMServices\Form\Fieldset\FidelityGaurateeEmployeeListFieldset'
//                 )
//             ),
//             "attributes"=>array()
//         ));
        
        // TODO - show the employee fideliidity List 
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
            "unamedAggregatedAmountGaurateed"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "unamedTotalAmountGuarateed"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "unamedAmountPerPerson"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "unamedTotalNumberOfStaff"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "isUnamedBasis"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "auditor"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "isAudit"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "auditDuration"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "balanceBookFrequency"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "securityMeasure"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "fictiousPayroll"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            
            "employeeMaxAccPayout"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "isEmployeePowerOnAcc"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "previousLoss"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "maxAmountOfLoss"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "isPrevuiousLoss"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "previousInsure"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            
            "isPreviousInsure"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            
            "isReferenceForm"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "isOtherInstruments"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "isPreviousInsure"=>array(
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

