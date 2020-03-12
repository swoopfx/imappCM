<?php
namespace Policy\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Policy\Entity\CoverNote;

/**
 *
 * @author otaba
 *        
 */
class CoverNoteFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;

    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setObject(new CoverNote())->setHydrator($hydrator);
        
        $this->addField();
    }

    private function addField()
    {
//         $this->add(array(
//             "name" => "cover_duration",
//             "type" => 'DoctrineModule\Form\Element\ObjectSelect',
//             "options" => array(
//                 'label' => 'Cover Duration Tyep',
//                 'object_manager' => $this->entityManager,
//                 'target_class' => 'Settings\Entity\CoverDuration',
//                 'property' => 'duration',
                
//                 'label_attributes' => array(
//                     'class' => 'control-label col-md-12 col-sm-12 col-xs-12'
//                 )
//             ),
//             "attributes" => array(
//                 'required' => "required",
//                 "class"=>"form-control col-md-12 col-sm-12 col-xs-12",
//                 "style"=>"width: 100%"
//             )
//         ));

        $this->add(array(
            'name' => 'insurer',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect', // make it multi radio
            'options' => array(
                'label' => 'Policy Insurer',
                'label_attributes' => array(
                    'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
                ),
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\Insurer',
                // 'empty_option' => '-- Select a Proposed Insurer --',
                'property' => 'insuranceName',
                'is_method' => true,
                'find_method' => array(
                    'name' => 'findActiveInsurer'
                    
                )
                
            ),
            
            "attributes" => array(
                "class" => "form-control col-md-8 col-sm-8 col-xs-12 ",
                "required" => "required",
                // 'multiple' => 'multiple',
                'id' => "insurer"
            )
        ));
        
        
        
        $this->add(array(
            "name" => "premiumPayable",
            'type' => 'text',
            "options" => array(
                "label" => "Premium Payable :",
                "label_attributes" => array(
                    "class" => 'control-label col-md-4 col-sm-4 col-xs-12'
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-8 col-sm-8 col-xs-12",
                "id" => "premium",
                "required" => "required",
                "placeholder" => "0.00"
            )
        ));
        
        $this->add(array(
            "name"=>"policyFloat",
            "type"=>"Policy\Form\Fieldset\PolicyFloatFieldset"
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
            "insurer"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "premiumPayable"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            "policy"=>array(
                "allow_empty"=>true,
                "required"=>false
            )
        );
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }
}

