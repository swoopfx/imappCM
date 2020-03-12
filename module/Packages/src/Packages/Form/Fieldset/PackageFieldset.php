<?php
namespace Packages\Form\Fieldset;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Packages\Entity\Packages;
use Zend\Validator\StringLength;

class PackageFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;

    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setHydrator($hydrator)->setObject(new Packages());
        $this->addFields();
    }

    private function addFields()
    {
        $this->add(array(
            'name' => 'packageName',
            'type' => 'text',
            'options' => array(
                'label' => 'Package Name',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'id' => 'pack_name',
                'required' => 'required',
                'class' => 'form-control col-md-9 col-xs-12',
                'title' => 'Give a uniqe name to your package',
                'placeholder' => 'Motor Insurance Saphire'
            )
        ));
        
        $this->add(array(
            'name' => 'description',
            'type' => 'textarea',
            'options' => array(
                'label' => 'Package Description',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
               
            ),
            'attributes' => array(
                'class' => 'form-control col-md-9 col-xs-12',
                'title' => 'Give a uniqe name to your package',
                "id" => "pack_desc"
            )
        ));
        
        $this->add(array(
            'name' => 'serviceType',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Policy Category',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\InsuranceServiceType',
                'property' => 'insuranceService',
                'empty_option' => '-- Select a Policy--',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'id' => 'pack_service',
                'class' => 'form-control',
                "required" => "required"
                // 'onChange' => 'getState(this.value)'
            
            )
        ));
        
        $this->add(array(
            'name' => 'coverDuration',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Package Cover Duration',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\PolicyCoverDuration',
                'property' => 'duration',
                // 'empty_option' => '-- Select a Policy--',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'id' => 'pack_cover_duration',
                'class' => 'form-control',
                "required" => "required"
                // 'onChange' => 'getState(this.value)'
            
            )
        ));
        
        $this->add(array(
            'name' => 'specificService',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Insurance Policy',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\InsuranceSpecificService',
                'property' => 'specificService',
                'empty_option' => '-- Select a Service --',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'id' => 'pack_cover',
                'class' => 'form-control',
                "required" => "required"
            
            )
        ));
        
        $this->add(array(
            "name"=>"sumAssured",
            "type"=>"text",
            "options"=>array(
                "label"=>"Sum Assured",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12",
                ),
            ),
            "attributes"=>array(
                "class"=>"form-control col-md-9 col-xs-12",
                "placeholder"=>"if applicable",
                "id"=>"sun_assured",
            ),
        ));
        
//         $this->add(array(
//             'name' => 'packageCategory',
//             'type' => 'DoctrineModule\Form\Element\ObjectSelect',
//             'options' => array(
//                 'label' => 'Package Type',
//                 'object_manager' => $this->entityManager,
//                 'target_class' => 'Settings\Entity\ObjectType',
//                 'property' => 'objectType',
//                 'empty_option' => '-- Select Package Type --',
//                 'label_attributes' => array(
//                     'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                
//                 )
//             ),
//             'attributes' => array(
//                 'class' => 'form-control col-md-9 col-xs-12',
//                 'id' => 'pack_type',
//                 'required' => 'required',
//                 'onChange' => 'getState(this.value)'
            
//             )
//         ));
        
        $this->add(array(
            'name' => 'packagedInsurer',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Package Insurer',
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
                'id' => 'service-type',
                'class' => 'form-control'
            )
        ));
        
        $this->add(array(
            'name' => 'currency',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Package Type',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\Currency',
                'property' => 'title',
                // 'empty_option' => '-- Select Package Type --',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'class' => 'form-control col-md-9 col-xs-12',
                'id' => 'currency',
                'required' => 'required',
                'value' => 1
            )
        ));
        $this->add(array(
            'name' => 'valueType',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Premium Category',
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
                'id' => 'pack_value_type',
                'required' => 'required'
                // 'value' => 1
            )
        ));
        
        $this->add(array(
            'name' => 'value',
            'type' => 'text',
            'options' => array(
                'label' => 'Premium Payable',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12 ',
                    'data-ng-model' => 'valueLabel'
                )
            ),
            'attributes' => array(
                'class' => 'form-control col-md-9 col-xs-12 money',
                "id" => "pack_value"
            )
        ));
        
        // $this->add(array(
        // 'name'=>'travel',
        // 'type'=>'Packages\Form\Fieldset\TravelPackageFieldset'
        // ));
    }

    public function getInputFilterSpecification()
    {
        return array(
            'packageName' => array(
                'required' => true,
                'allow_empty' => false,
                'filters' => array(
                    array(
                        'name' => 'Zend\Filter\StringTrim'
                    ),
                    array(
                        'name' => 'StripTags'
                    )
                ),
                'validators' => array(
                    array(
                        'name' => 'Zend\Validator\StringLength',
                        'options' => array(
                            'min' => 2,
                            'max' => 500,
                            'messages' => array(
                                StringLength::TOO_SHORT => 'This package name is too short',
                                StringLength::TOO_LONG => 'We belive this is too long a  name'
                            )
                        )
                    )
                )
            )
        );
    }

    public function setEntityanager($em)
    {
        $this->entityManager = $em;
        return $this;
    }
}