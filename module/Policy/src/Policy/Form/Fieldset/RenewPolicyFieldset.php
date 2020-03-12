<?php
namespace Policy\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;

/**
 *
 * @author otaba
 *        
 */
class RenewPolicyFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;

    public function init()
    {
        $this->addField();
    }

    private function addField()
    {
        $this->add(array(
            "name" => "selectDate",
            "type" => "date",
            "options" => array(
                "label" => "Select Expiry Date",
                "label_attributes" => array(
                    "class" => "control-label col-md-3"
                )
            ),
            "attributes" => array(
                "id" => "selectDate",
                "class" => "form-control",
                "value"=>date("Y-m-d")
            )
        ));
        
        $this->add(array(
            "name" => "specificDate", // determines the type of date to be used
            "type" => "checkbox",
            "options" => array(
                "label" => "Use Specific Date ",
                "label_attributes" => array(
                    "class" => "control-label col-md-3"
                )
            ),
            "attributes" => array(
                "id" => "specificDate",
                "class" => "col-md-7 col-sm-7 col-xs-12",
                
            )
        ));
        
        $this->add(array(
            "name" => "insurer",
            "type" => "text",
            "options" => array(
                "label" => "Insurer",
                "label_attributes" => array(
                    "class" => "control-label col-md-4 col-sm-4 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-8 col-sm-8 col-xs-12 ",
                "id" => "",
                
            )
        ));
        
        
        $this->add(array(
            "name" => "expiringDate",
            "type" => "text",
            "options" => array(
                "label" => "Policy Expering Date",
                "label_attributes" => array(
                    "class" => "control-label col-md-4 col-sm-4 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-8 col-sm-8 col-xs-12 ",
               
               
            )
        ));
        
        $this->add(array(
            "name" => "renewDuration",
            "type" => "DoctrineModule\Form\Element\ObjectSelect",
            "options" => array(
                "label" => "Cover Duration",
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\PolicyCoverDuration',
                'property' => 'duration',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            "attributes" => array(
                "id" => "renewDuration",
                "class" => "form-control col-md-7 col-sm-7 col-xs-12"
            )
        ));
//         $this->add(array(
//             'name' => 'termedDuration',
//             'type' => 'Settings\Form\Fieldset\GeneralPolicyCoverTermedValueFieldset' // make it multi radio
        
//         ));
        
        $this->add(array(
            "name" => "isMicro",
            "type" => "checkbox",
            "options" => array(
                "label" => "Activate MicroPayment",
                
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isMicro",
                //                 "checked" => true
            )
        ));
        
        $this->add(array(
            "name"=>"microPAymentFieldset",
            "type"=>"Transactions\Form\Fieldset\MicroPaymentFieldset",
           
        ));
        
        $this->add(array(
            "name"=>"manualPayment",
            "type"=>"Transactions\Form\Fieldset\ManualPaymentFieldset",
        ));
        
        $this->add(array(
            "name" => "isChangePremium",
            "type" => "checkbox",
            "options" => array(
                "label" => "Change Premium Value",
                
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isChangePremium",
                //                 "checked" => true
            )
        ));
        
        
        
        $this->add(array(
            "name" => "premium",
            "type" => "text",
            "options" => array(
                "label" => "Premium Payable",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-sm-7 col-xs-12 ",
                "id" => "premium",
                "required" => "required"
            )
        ));
        
        /**
         * This is only possible if the premium value is changed
         */
        $this->add(array(
            "name" => "changeReason",
            "type" => "textarea",
            "options" => array(
                "label" => "Reason For Change in Preimium",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-sm-7 col-xs-12 ",
                "id" => "changeReason",
//                 "required" => "required"
            )
        ));
        
        $this->add(array(
            "name" => "isPaid",
            "type" => "checkbox",
            "options" => array(
                "label" => "Premium is fully Paid",
                
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isPaid",
                //                 "checked" => true
            )
        ));
        
        
//         $this->add(array(
//             "name" => "specificDate",
//             "type" => "checkbox",
//             "options" => array(
//                 "label" => "Premium is fully Paid",
                
//                 "label_attributes" => array(
//                     "class" => "control-label col-md-3 col-sm-3 col-xs-12"
//                 )
//             ),
//             "attributes" => array(
//                 "class" => "col-md-7 col-xs-12",
//                 "id" => "isPaid",
//                 //                 "checked" => true
//             )
//         ));
        
        
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
            "isPaid"=>array(
                "allow_empty"=>true,
                "required"=>FALSE,
            ),
            "changeReason"=>array(
                "allow_empty"=>true,
                "required"=>FALSE,
            ),
            "premium"=>array(
                "allow_empty"=>FALSE,
                "required"=>TRUE,
            ),
            "isChangePremium"=>array(
                "allow_empty"=>true,
                "required"=>FALSE,
            ),
            "isMicro"=>array(
                "allow_empty"=>true,
                "required"=>FALSE,
            ),
            "specificDate"=>array(
                "allow_empty"=>true,
                "required"=>False
            ),
            "renewDuration"=>array(
                "allow_empty"=>true,
                "required"=>False
            ),
            "selectDate"=>array(
                "allow_empty"=>true,
                "required"=>False
            ),
            "insurer"=>array(
                "allow_empty"=>true,
                "required"=>False
            ),
            "microPAymentFieldset"=>array(
                "allow_empty"=>true,
                "required"=>False
            ),
            
        );
    }
}

