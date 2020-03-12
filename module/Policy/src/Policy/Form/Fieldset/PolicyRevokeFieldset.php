<?php
namespace Policy\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;

class PolicyRevokeFieldset extends Fieldset implements InputFilterProviderInterface
{
    private $entityManager;

//     public function __construct($name = null, $options = null)
//     {
//         parent::__construct($name = null, $options = null);
//         // TODO - Insert your code here
//     }
    
    public function init(){
        $this->add(array(
            "name"=>"suspendedReason",
            "type"=>"DoctrineModule\Form\Element\ObjectSelect",
            "options"=>array(
                'label' => 'Reason',
                'label_attributes' => array(
                    'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
                ),
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\PolicyRevokeReason',
                'property' => 'reason'
            ),
            "attributes"=>array(
                "class" => "form-control col-md-7 col-sm-7 col-xs-12 ",
                "required" => "required",
                // 'multiple' => 'multiple',
                'id' => "suspendedReason"
            ),
            
        ));
        
        $this->add(array(
            "name"=>"otherSuspension",
            "type"=>"text",
            "options"=>array(
                "label"=>"Other Reason",
                'label_attributes' => array(
                    'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
                ),
            ),
            "attributes"=>array(
                "class" => "form-control col-md-7 col-sm-7 col-xs-12 ",
//                 "required" => "required",
                // 'multiple' => 'multiple',
                'id' => "otherSuspension"
            )
        ));
        
        $this->add(array(
            "name"=>"reasonDescription",
            "type"=>"textarea",
            "options"=>array(
                "label"=>"Description",
                'label_attributes' => array(
                    'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
                ),
            ),
            "attributes"=>array(
                "class" => "form-control col-md-7 col-sm-7 col-xs-12 ",
                //                 "required" => "required",
                // 'multiple' => 'multiple',
                'id' => "reasonDescription"
            )
        ));
    }

    public function getInputFilterSpecification()
    {

        return array();
    }
    /**
     * @return mixed
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }

    /**
     * @param mixed $entityManager
     */
    public function setEntityManager($entityManager)
    {
        $this->entityManager = $entityManager;
        return $this;
    }

}

