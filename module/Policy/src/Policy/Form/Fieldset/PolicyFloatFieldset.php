<?php
namespace Policy\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Policy\Entity\PolicyFloat;

/**
 *
 * @author otaba
 *        
 */
class PolicyFloatFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;

    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setHydrator($hydrator)->setObject(new PolicyFloat());
        $this->addField();
    }

    private function addField()
    {
        
        
        $this->add(array(
            'name' => 'serviceType',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect', // make it multi radio
            'options' => array(
                'label' => 'Policy Category',
                'label_attributes' => array(
                    'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
                ),
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\InsuranceServiceType',
                'property' => 'insuranceService'
                // 'label_generator' => function ($targetEntity) {
                // return $targetEntity->getFullName();
                // },
                // 'empty_option' => '--- No Broker Registered---',
                // 'is_method' => true
                // 'option_attributes'=>
                // get all brokerChild in the database associated to this centralBrokerId
            
            ),
            
            "attributes" => array(
                "class" => "form-control col-md-8 col-sm-8 col-xs-12 ",
                "required" => "required",
                // 'multiple' => 'multiple',
                'id' => "float_service"
            )
        ));
        
        
        
        $this->add(array(
            'name' => 'specificService',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect', // make it multi radio
            'options' => array(
                'label' => 'Insurance Policy',
                'label_attributes' => array(
                    'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
                ),
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\InsuranceSpecificService',
                'property' => 'specificService'
                // 'label_generator' => function ($targetEntity) {
                // return $targetEntity->getFullName();
                // },
                // 'empty_option' => '--- No Broker Registered---',
                // 'is_method' => true
                // 'option_attributes'=>
                // get all brokerChild in the database associated to this centralBrokerId
            
            ),
            
            "attributes" => array(
                "class" => "form-control col-md-8 col-sm-8 col-xs-12 ",
                "required" => "required",
                // 'multiple' => 'multiple',
                'id' => "float_specific_service"
            )
        ));
        
//         $this->add(array(
//             "name" => "premium",
//             "type" => "text",
//             "options" => array(
//                 "label" => "Premium Value",
//                 "label_attributes" => array(
//                     "class" => "control-label col-md-4 col-sm-4 col-xs-12"
//                 )
//             ),
//             "attributes" => array(
//                 "class" => "form-control col-md-8 col-sm-8 col-xs-12",
//                 "id" => "premium",
//                 "placeholder" => "3,000",
//                 "value" => "0",
//                 "required" => "required"
//             )
//         ));
        
//         $this->add(array(
//             "name" => "currency",
//             "type" => "DoctrineModule\Form\Element\ObjectSelect",
//             "options" => array(
//                 'label' => 'Currency',
//                 'label_attributes' => array(
//                     'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
//                 ),
//                 'object_manager' => $this->entityManager,
//                 'target_class' => 'Settings\Entity\Currency',
//                 // 'empty_option' => '-- Select a Proposed Insurer --',
//                 'property' => 'title'
            
//             ),
//             "attributes" => array(
//                 "class" => "form-control col-md-8 col-sm-8 col-xs-12",
//                 "id" => "currency"
//                 // "placeholder"=>"3,000",
//                 // "value"=>"0",
//             )
        
//         ));
        
//         $this->add(array(
//             "name" => "coverDuration",
//             "type" => "DoctrineModule\Form\Element\ObjectSelect",
//             "options" => array(
//                 'label' => 'Cover Duration',
//                 'label_attributes' => array(
//                     'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
//                 ),
//                 'object_manager' => $this->entityManager,
//                 'target_class' => 'Settings\Entity\PolicyCoverDuration',
//                 // 'empty_option' => '-- Select a Proposed Insurer --',
//                 'property' => 'duration'
//             ),
//             "attributes" => array(
//                 "class" => "form-control col-md-8 col-sm-8 col-xs-12",
//                 "id" => "cover_curation"
//             )
//         ));
        
//         $this->add(array(
//             "name" => "termedDuration",
//             "type" => "Settings\Form\Fieldset\GeneralPolicyCoverTermedValueFieldset"
        
//         ));
//         $this->add(array(
//             "type" => "Policy\Form\Fieldset\CoverNoteFieldset",
//             "name" => "coverNote"
//         ));
        
//         $this->add(array(
//             "name" => "floatName",
//             "type" => "text",
//             "options" => array(
//                 "label" => "Policy name",
//                 "label_attributes" => array(
//                     "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
//                 )
//             ),
//             "attributes" => array(
//                 "class" => "form-control  col-md-8 col-sm-8 col-xs-12",
//                 "id" => "floatName"
//             )
//         ));
        
//         $this->add(array(
//             "name" => "isAutoRenew",
//             "type" => "checkbox",
//             "options" => array(
//                 "label" => "Auto Renew Policy",
//                 "label_attributes" => array(
//                     "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
//                 )
//             ),
//             "attributes" => array(
//                 "class" => "col-md-8 col-sm-8 col-xs-12",
//                 "id" => "isMicro",
//                 "checked"=>true
//             )
//         ));
        
//         $this->add(array(
//             'type' => 'Zend\Form\Element\Date',
//             'name' => 'policyStartDate',
//             'options' => array(
//                 'label' => 'Policy Start date :',
//                 'label_attributes' => array(
//                     'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
//                 )
//                 // 'format' => 'd-m-Y'
//             ),
//             'attributes' => array(
//                 'class' => 'form-control col-sm-8 col-md-8 col-xs-12',
//                 // 'min' => '2016-01-01',
//                 "required"=>"required",
//                 'step' => '1'
//             )
//         ));
        
//         $this->add(array(
//             'type' => 'Zend\Form\Element\Date',
//             'name' => 'policyEndDate',
//             'options' => array(
//                 'label' => 'Policy End Date :',
//                 'label_attributes' => array(
//                     'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
//                 )
//                 // 'format' => 'd-m-Y'
//             ),
//             'attributes' => array(
//                 'class' => 'form-control col-sm-8 col-md-8 col-xs-12',
// //                 'min' => '2016-01-01',
//                 "required"=>"required",
//                 //                 'step' => '1'
//             )
//         ));
        
        
//         $this->add(array(
//             'name' => 'extraInfo',
//             'type' => 'textarea',
//             'options' => array(
//                 'label' => 'Additional Info.',
//                 'label_attributes' => array(
//                     'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
//                 ),
                
//             ),
//             'attributes' => array(
//                 'id' => 'extraInfo',
//                 // 'style' => "display:none;",
//                 'placeholder' => 'Provide a company profile. Your customers would see these information and evaluate you based on this ',
//                 'class' => 'form-control col-sm-8 col-md-8 col-xs-12'
//             )
//         ));
        
//        
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
           
            "serviceType"=>array(
                "allow_empty"=>false,
                "required"=>true
            ),
            "specificService"=>array(
                "allow_empty"=>false,
                "required"=>true
            ),
            
        );
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }
}

