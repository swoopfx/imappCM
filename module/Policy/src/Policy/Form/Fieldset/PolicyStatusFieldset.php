<?php
namespace Policy\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Policy\Service\PolicyService;

class PolicyStatusFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;

    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setHydrator($hydrator);

        $this->add(array(
            'name' => 'status',
            'type' => 'select', // make it multi radio
            'options' => array(
                'label' => 'Change Status',
                'label_attributes' => array(
                    'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
                ),
                "value_options"=>array(
                    PolicyService::POLICY_STATUS_PROCESSING=>"Processing",
//                     PolicyService::POLICY_STATUS_SUSPENDED=>"Suspended",
                    PolicyService::POLICY_STATUS_ISSUED_AND_VALID=>"Issued and Valid",
                    PolicyService::POLICY_STATUS_ISSUED_BUT_PENDING=>"Issued but Pending",
                )
//                 'object_manager' => $this->entityManager,
//                 'target_class' => 'Policy\Entity\PolicyStatus',
//                 'empty_option' => '-- Select Status --',
//                 'property' => 'status'
            ),

            "attributes" => array(
                "class" => "form-control col-md-8 col-sm-8 col-xs-12 ",
                "required" => "required",
                'id' => "status"
            )
        ));
    }

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

