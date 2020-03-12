<?php
namespace Policy\Form\Fieldset;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Policy\Entity\Policy;

// use Zend\Form\Element\MonthSelect;
// use Zend\Form\Element\Select;

/**
 *
 * @author otaba
 *        
 */
class PolicyFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;

    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setHydrator($hydrator)->setObject(new Policy());
        $this->addFields();
    }

    private function addFields()
    {
        $this->add(array(
            "name" => "policyName",
            'type' => 'text',
            "options" => array(
                "label" => "Polcy Name/Definition :",
                "label_attributes" => array(
                    "class" => 'control-label col-md-4 col-sm-4 col-xs-12'
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-8 col-sm-8 col-xs-12",
                "id" => "policy_name",
                "required" => "required",
                "placeholder" => "Zolan Motor Comprehensive Motor Insurance"
            )
        ));
        
        $this->add(array(
            "name" => "policyCode",
            'type' => 'text',
            "options" => array(
                "label" => "Policy Number/Code :",
                "label_attributes" => array(
                    "class" => 'control-label col-md-4 col-sm-4 col-xs-12'
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-8 col-sm-8 col-xs-12",
                "id" => "policy_code",
                "required" => "required",
                "placeholder" => "WBD/2017/123/A/7897689"
            )
        ));
        
        $this->add(array(
            "name" => "isAutoRenew",
            "type" => "checkbox",
            "options" => array(
                "label" => "Auto Renew Policy",
                "label_attributes" => array(
                    "class" => "control-label col-md-4 col-sm-4 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "flat",
                "id" => "policy_is_renew",
                'checked' => false
            )
        ));
        
//         $this->add(array(
//             'name' => 'insurer',
//             'type' => 'DoctrineModule\Form\Element\ObjectSelect', // make it multi radio
//             'options' => array(
//                 'label' => 'Policy Insurer',
//                 'label_attributes' => array(
//                     'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
//                 ),
//                 'object_manager' => $this->entityManager,
//                 'target_class' => 'Settings\Entity\Insurer',
//                 'empty_option' => '-- Select Insurer --',
//                 'property' => 'insuranceName',
//                 'is_method' => true,
//                 'find_method' => array(
//                     'name' => 'findActiveInsurer'
//                 )
                
//             ),
            
//             "attributes" => array(
//                 "class" => "form-control col-md-8 col-sm-8 col-xs-12 ",
//                 "required" => "required",
//                 'id' => "insurer"
//             )
//         ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Date',
            'name' => 'startDate',
            'options' => array(
                'label' => 'Policy Start date :',
                'label_attributes' => array(
                    'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
                )
                // 'format' => 'd-m-Y'
            ),
            'attributes' => array(
                'class' => 'form-control col-sm-8 col-md-8 col-xs-12',
                // 'min' => '2016-01-01',
                "required"=>"required",
                'step' => '1'
            )
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Date',
            'name' => 'endDate',
            'options' => array(
                'label' => 'Policy End Date :',
                'label_attributes' => array(
                    'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
                )
                // 'format' => 'd-m-Y'
            ),
            'attributes' => array(
                'class' => 'form-control col-sm-8 col-md-8 col-xs-12',
                // 'min' => '2016-01-01',
                "required"=>"required",
//                 'step' => '1'
            )
        ));
        
        $this->add(array(
            'name' => 'extraInfo',
            'type' => 'textarea',
            'options' => array(
                'label' => 'Additional Info.',
                'label_attributes' => array(
                    'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
                ),
               
            ),
            'attributes' => array(
                'id' => 'extraInfo',
                // 'style' => "display:none;",
                'placeholder' => 'Provide a company profile. Your customers would see these information and evaluate you based on this ',
                'class' => 'form-control col-sm-8 col-md-8 col-xs-12'
            )
        ));
        
                $this->add(array(
                    "type" => "Policy\Form\Fieldset\CoverNoteFieldset",
                    "name" => "coverNote"
                ));
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Zend\InputFilter\InputFilterProviderInterface::getInputFilterSpecification()
     */
    public function getInputFilterSpecification()
    {
        return array(
            "policyName"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "extraInfo"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "endDate"=>array(
                "allow_empty"=>false,
                "required"=>true,
            ),
            "startDate"=>array(
                "allow_empty"=>false,
                "required"=>true,
            ),
            "policyCode"=>array(
                "allow_empty"=>false,
                "required"=>true,
            ),
            "isAutoRenew"=>array(
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

