<?php
namespace Customer\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Claims\Entity\Claims;

/**
 *
 * @author otaba
 *        
 */
class CustomerClaimsPreFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;

    private $customerId;

    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setHydrator($hydrator)->setObject(new Claims());
        $this->addFiedlset();
    }

    public function addFiedlset()
    {
        $this->add(array(
            "name" => "claimTopic",
            "type" => "text",
            'options' => array(
                "label" => "Claims Topic",
                
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class"=>"form-control col-md-3 col-sm-3 col-xs-12",
                "id"=>"",
                'required' => 'required'
            ),
           
        ));
        $this->add(array(
            "name" => "policy",
            "type" => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Select Policy',
                'empty_option' => '-- Select a Package --',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                'object_manager' => $this->entityManager,
                'target_class' => 'Policy\Entity\Policy',
                'property' => 'policyName',
                'label_generator' => function ($targetEntity) {
                    return " " . $targetEntity->getPolicyName() . " (" . $targetEntity->getPolicyCode() . ")";
                },
                // 'option_attributes'=>
                'is_method' => true,
                'find_method' => array(
                    'name' => 'findCustomerActivePolicy',
                    'params' => array(
                        // 'criteria' => array(
                        'customer' => $this->customerId
                        // )
                    )
                
                )
            ),
            'attributes' => array(
                'data-ng-change' => 'showpackageDetails()',
                'id' => 'active_policy',
                'class' => 'form-control col-md-3 col-sm-3 col-xs-12',
                'value' => 1,
                'data-ng-model' => "activePolicy",
                'required' => 'required'
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

    public function setCustomerId($cusId)
    {
        $this->customerId = $cusId;
        return $this;
    }
}

