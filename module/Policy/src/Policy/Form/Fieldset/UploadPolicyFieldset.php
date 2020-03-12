<?php
namespace Policy\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Policy\Entity\PolicyFloat;

/**
 * This is used to upload any floating policy
 *
 * @author otaba
 *        
 */
class UploadPolicyFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;

    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setHydrator($hydrator)->setObject(new PolicyFloat());
        $this->addFields();
    }

    private function addFields()
    {
//         $this->add(array(
//             "name" => "policy",
//             "type" => "Policy\Form\Fieldset\PolicyFieldset"
        
//         ));
        
        // $this->add(array(
        // "name" => "floatName",
        // "type" => "text",
        // "options" => array(
        // "label" => "Policy Name",
        // "label_attaributes" => array(
        // "class" => "control-label col-md-3 col-sm-3 col-xs-12"
        // )
        // ),
        // "attributes" => array(
        // "class" => "form-control col-md-9 col-sm-9 col-xs-12 ",
        // "id" => "",
        // "required" => "required"
        // )
        // ));
        
        $this->add(array(
            "name" => "premium",
            "type" => "text",
            "options" => array(
                "label" => "Premium Payable",
                "label_attributes" => array(
                    "class" => "control-label col-md-4 col-sm-4 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-8 col-sm-8 col-xs-12 ",
                "id" => "",
                "required" => "required"
            )
        ));
        
        $this->add(array(
            'name' => 'currency',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect', // make it multi radio
            'options' => array(
                'label' => 'Premium Currency',
                'label_attributes' => array(
                    'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
                ),
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\Currency',
                'property' => 'title'
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
                "required" => "required"
                // 'multiple' => 'multiple',
                // 'id' => "chosen-select"
            )
        ));
        
        $this->add(array(
            'name' => 'coverDuration',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect', // make it multi radio
            'options' => array(
                'label' => 'Cover Duration',
                'label_attributes' => array(
                    'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
                ),
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\PolicyCoverDuration',
                'property' => 'duration',
                // 'label_generator' => function ($targetEntity) {
                // return $targetEntity->getFullName();
                // },
                // 'empty_option' => '--- No Broker Registered---',
                'is_method' => true
                // 'option_attributes'=>
                // get all brokerChild in the database associated to this centralBrokerId
            
            ),
            
            "attributes" => array(
                "class" => "form-control col-md-8 col-sm-8 col-xs-12 ",
                "required" => "required"
                // 'multiple' => 'multiple',
                // 'id' => "chosen-select"
            )
        ));
        
        $this->add(array(
            'name' => 'termedDuration',
            'type' => 'Settings\Form\Fieldset\GeneralPolicyCoverTermedValueFieldset' // make it multi radio
        
        ));
        
        $this->add(array(
            'name' => 'serviceType',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect', // make it multi radio
            'options' => array(
                'label' => 'Insurance Policy',
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
                "required" => "required"
                // 'multiple' => 'multiple',
                // 'id' => "chosen-select"
            )
        ));
        
        $this->add(array(
            'name' => 'insurer',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect', // make it multi radio
            'options' => array(
                'label' => 'Insurance Company',
                'label_attributes' => array(
                    'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
                ),
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\Insurer',
                //'empty_option' => '-- Select a Proposed Insurer --',
                'property' => 'insuranceName',
                'is_method' => true,
                'find_method' => array(
                    'name' => 'findActiveInsurer'
                    
                )
            
            ),
            
            "attributes" => array(
                "class" => "form-control col-md-8 col-sm-8 col-xs-12 ",
                "required" => "required"
                // 'multiple' => 'multiple',
                // 'id' => "chosen-select"
            )
        ));
        
        $this->add(array(
            'name' => 'specificService',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect', // make it multi radio
            'options' => array(
                'label' => 'Insurance Cover',
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
                "required" => "required"
                // 'multiple' => 'multiple',
                // 'id' => "chosen-select"
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

