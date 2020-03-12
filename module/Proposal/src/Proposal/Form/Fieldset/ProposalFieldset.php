<?php
namespace Proposal\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Proposal\Entity\Proposal;


/**
 *
 * @author swoopfx
 *        
 */
class ProposalFieldset extends Fieldset implements InputFilterProviderInterface{

    protected $entityManager;

    private $broker;

    private $customerId;
    
    private $serviceLocator;
    
    private $myCurrency;
    
    

    /**
     *
     * @param null|int|string $name
     *            Optional name for the element
     *            
     * @param array $options
     *            Optional options for the element
     *            
     */
    
    // public function __construct(){
    
    // }
    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setHydrator($hydrator)->setObject(new Proposal());
       
        $this->addFields();
    }

    protected function addFields()
    {
       
        $this->add(array(
            'name' => 'currency',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Value Currency',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                // 'empty_option' => 'Unsaved',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\Currency',
                'property' => 'title'
            ),
            'attributes' => array(
                'id' => 'form_status',
                'class' => 'form-control col-md-9 col-xs-12',
                // 'disabled' => 'disabled',
                'placeholder' => 'Unsaved'
            )
        ));
        
        $this->add(array(
            'name' => 'proposalTitle',
            'type' => 'text',
            'options' => array(
                'label' => 'Proposal Title',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'proposal_title',
                'placeholder' => 'e.g Kaltec Motor Insurance Policy',
                'required' => 'required'
            )
        ));
        
        $this->add(array(
            'name' => 'otherServiceType',
            'type' => 'text',
            'options' => array(
                'label' => 'Other Service Type',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'otherServiceType',
//                 'placeholder' => 'e.g Kaltec Motor Insurance Policy',
//                 'required' => 'required'
            )
        ));
        $this->add(array(
            'name' => 'otherSpecificService',
            'type' => 'text',
            'options' => array(
                'label' => 'Other Specific Service',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'otherSpecificService',
//                 'placeholder' => 'e.g Kaltec Motor Insurance Policy',
//                 'required' => 'required'
            )
        ));
        
        
        $this->add(array(
            'name' => 'customService',
            'type' => 'text',
            'options' => array(
                'label' => 'Custom Service Name',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'customService',
                'placeholder' => 'Fire & Theft',
//                 'required' => 'required'
            )
        ));
        
        $this->add(array(
            'name' => 'proposalDesc',
            'type' => 'textarea',
            'options' => array(
                'label' => 'Proposal Description',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'proposal_desc',
                'placeholder' => 'e.g Proposal for 100 vehicles for administrative department of Kaltec Industry',
                'required' => 'required'
            )
        ));
        
        $this->add(array(
            'name' => 'insurer',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Proposed Insurer',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\Insurer',
                'empty_option' => '-- Select a Proposed Insurer --',
                'property' => 'insuranceName',
                'is_method' => true,
                'find_method' => array(
                    'name' => 'findActiveInsurer'
                
                )
            ),
            'attributes' => array(
                //'id' => 'service-type',
                'class' => 'form-control',
                "required"=>"required"
            )
        ));
        
        $this->add(array(
            'name' => 'serviceType',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Proposed Policy ',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\InsuranceServiceType',
                'property' => 'insuranceService',
                'empty_option' => '-- Select a Policy--',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'id' => 'service-type',
                'class' => 'form-control',
                "required"=>"required"
//                 'data-ng-click' => 'onServiceTypeChange()'
            )
        ));
        
        $this->add(array(
            'name' => 'specificService',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Select insurance Service ',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\InsuranceSpecificService',
                'property' => 'specificService',
                'empty_option' => '-- Select a Service --',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
//                 'is_method' => true,
//                 'find_method' => array(
//                     'name' => 'findBy',
//                     'params' => array(
//                         'criteria' => array(
//                             "specificService" => NULL,
                            
//                         )
//                     )
//                 )
            ),
            'attributes' => array(
                'id' => 'specific-service',
                'class' => 'form-control',
                "required"=>"required"
//                 'data-ng-model' => 'selectedService',
//                 'data-ng-change' => 'selectService(selectedService)'
            )
        ));
        
        $this->add(array(
            
            'name' => 'insuranceCategory',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Insurance Category',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\InsuranceType',
                'property' => 'type',
                // 'label_generator' => function ($targetEntity) {
                // return $targetEntity->getObjectName() . " (" . CurrencyService::myCurrency($targetEntity->getCurrency()
                // ->getTitle()) . $targetEntity->getObjectValue() . ") ";
                // },
                'empty_option' => '-- Select Insurance Category --',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                'is_method' => true,
                'find_method' => array(
                    'name' => 'findNonCompositeInsuranceType'
                
                )
            ),
            'attributes' => array(
                'class' => 'form-control col-md-6 col-sm-6 col-xs-12',
                'id' => 'insuranceCategory',
                'required' => 'required'
            
            )
        ));
        
        $this->add(array(
            'name' => 'valueType',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Premium Calculation Type',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\DefinePackageValueType',
                'property' => 'type',
                // 'empty_option' => '-- Select Package Type --',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'class' => 'form-control col-md-9 col-xs-12',
                'id' => 'value_typer',
                "value"=>2,
                'required' => 'required'
                // 'value' => 1
            )
        ));
        
        $this->add(array(
            'name' => 'value',
            'type' => 'text',
            'options' => array(
                'label' => 'Premium Rate Value',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12 ',
                    'data-ng-model' => 'valueLabel',
                    "id"=>"valueLabel"
                )
            ),
            'attributes' => array(
                'class' => 'form-control col-md-9 col-xs-12 money',
                "required" => "required",
                'name' => 'value',
                
            )
        ));
        
//         $this->add(array(
//             'type' => 'DoctrineModule\Form\Element\ObjectSelect',
//             'name' => 'object',
//             'attributes' => array(
//                 'multiple' => true,
//                 'class' => 'col-xs-12 ',
//                 "id"=>"multiple"
//             ),
//             'options' => array(
//                 'object_manager' => $this->entityManager,
//                 'target_class' => 'Object\Entity\Object',
//                 'label' => 'Select Your Property',
//                 'label_generator'=>function($targetEntity){
//                 return " ".$targetEntity->getObjectName()." (".$targetEntity->getValue().")";
//                 },
//                  'column-size' => 'control-label col-md-3 col-sm-3 col-xs-12',
//                 'label_attributes' => array(
//                     'class' => 'control-label col-md-3 col-sm-3 col-xs-12 '
                
//                 ),
//                 'property' => 'objectName',
//                 "style"=>"width: 100%;",
//                 'is_method' => true,
//                 'find_method' => array(
//                     'name' => 'findCustomerBrokerObject',
//                     'params' => array(
//                         'criteria' => array(
//                             "broker" => $this->broker,
//                             'customer' => $this->customerId,
//                             'hidden' => FALSE
//                         )
//                     )
//                 )
            
//             )
//         ));
        
        $this->add(array(
            'name' => 'coverDuration',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Insurance Cover Duration',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\PolicyCoverDuration',
                'property' => 'duration',
                
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'id' => 'coverduration',
                'class' => 'form-control',
//                 'data-ng-model' => 'coverduration',
//                 'data-ng-change' => 'coverDurationCondition(coverduration)'
            )
        ));
        
        $this->add(array(
            'name' => 'termedDuration',
            'type' => 'text',
            'options' => array(
                'label' => 'Termed Duration Value',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12 '
                    // 'data-ng-model'=>'valueLabel'
                )
            ),
            'attributes' => array(
                'class' => 'form-control col-md-9 col-xs-12 money',
                "id"=>"termed_duration"
                // "required"=>"required",
                
                
            )
        ));
        
        // $this->add(array(
        
        // 'name' => 'object',
        // 'type' => 'DoctrineModule\Form\Element\ObjectSelect',
        // 'options' => array(
        // 'label' => 'Select',
        // 'object_manager' => $this->entityManager,
        // 'target_class' => 'Object\Entity\Object',
        // 'property' => 'name',
        // 'label_generator' => function ($targetEntity) {
        // return $targetEntity->getObjectName() . " (" . CurrencyService::myCurrency($targetEntity->getCurrency()
        // ->getTitle()) . $targetEntity->getObjectValue() . ") ";
        // },
        // 'empty_option' => '-- Customers Objects/Property --',
        // 'label_attributes' => array(
        // 'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
        // ),
        // 'is_method' => true,
        // 'find_method' => array(
        // 'name' => 'findCustomerBrokerObject',
        // 'params' => array(
        // 'criteria' => array(
        // 'customer' => $this->customerId,
        // 'broker' => $this->brokerId
        
        // )
        // ),
        // 'orderBy' => array(
        // 'id' => 'DESC'
        // )
        // )
        // ),
        // 'attributes' => array(
        // 'class' => 'form-control col-md-6 col-sm-6 col-xs-12',
        // 'id' => 'customer',
        // 'required' => 'required',
        // 'multiple' => true
        // )
        // ));
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
            
            "proposalTitle"=>array(
                "allow_empty"=>TRUE,
                "required"=>FALSE
                
            ),
            "proposalDesc"=>array(
                "allow_empty"=>TRUE,
                "required"=>FALSE
                
            ),
            "insurer"=>array(
                "allow_empty"=>TRUE,
                "required"=>FALSE
                
            ),
            "serviceType"=>array(
                "allow_empty"=>TRUE,
                "required"=>FALSE
                
            ),
            "specificService"=>array(
                "allow_empty"=>TRUE,
                "required"=>FALSE
                
            ),
            "specificService"=>array(
                "allow_empty"=>TRUE,
                "required"=>FALSE,
            ),
            "insuranceCategory"=>array(
                "allow_empty"=>TRUE,
                "required"=>FALSE,
            ),
            "value"=>array(
                "allow_empty"=>TRUE,
                "required"=>FALSE
                
            ),
            "valueType"=>array(
                "allow_empty"=>TRUE,
                "required"=>FALSE
                
            ),
            "currency"=>array(
                "allow_empty"=>TRUE,
                "required"=>FALSE
                
            ),
            "coverDuration"=>array(
                "allow_empty"=>TRUE,
                "required"=>FALSE
                
            ),
            "termedDuration"=>array(
                "allow_empty"=>TRUE,
                "required"=>FALSE
                
            )
        );
    }

    // Begin Setter
    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        
        return $this;
    }

    public function setBroker($brk)
    {
        $this->broker = $brk;
        return $this;
    }

    public function setCustomerId($cus)
    {
        $this->customerId = $cus;
        return $this;
    }
   
    
    public function setMyCurrency($cur){
        $this->myCurrency = $cur;
        return $this;
    }

    
    // End Setter
}

