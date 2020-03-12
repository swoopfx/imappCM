<?php
namespace Object\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;


/**
 *
 * @author swoopfx
 *        
 */
class SelectObjectFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;

    private $selectObjectContainer;

    private $broker;

    private $serviceLocator;

    private $customerId;

    private $myCurrencyFormat;

    public function init()
    {
        
        $this->addField();
    }

   

    private function addField()
    {
        
        //var_dump($myCurrency);
        $this->add(array(
            
            'name' => 'object',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Select',
                'object_manager' => $this->entityManager,
                'target_class' => 'Object\Entity\Object',
                'property' => 'name',
                'label_generator' => function ($targetEntity) {
                return $targetEntity->getObjectName() . " (" .$targetEntity->getValue() . ") ";
                },
                'empty_option' => '-- Customers Objects/Property --',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                'is_method' => true,
                'find_method' => array(
                    'name' => 'findCustomerBrokerObject',
                    'params' => array(
                        'criteria' => array(
                            "broker" => $this->broker,
                            'customer' => $this->customerId,
                            'hidden' => FALSE
                            // "objectType"=>$this->selectObjectContainer->objectType,
                        
                        )
                    )
                
                )
            ),
            'attributes' => array(
                'class' => 'form-control col-md-6 col-sm-6 col-xs-12',
                'id'=>"object",
                "data-toggle"=>"select2",
                'required' => 'required',
                'multiple' => 'multiple'
            
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
        $this->entityManager;
        return $this;
    }

    public function setCustomerId($cusId)
    {
        $this->customerId = $cusId;
        return $this;
    }

    public function setObjectType($type)
    {
        $this->objectType = $type;
        return $this;
    }

    public function setBroker($broker)
    {
        $this->broker = $broker;
        return $this;
    }

    public function setMyCurrencyFormat($format)
    {
        $this->myCurrencyFormat = $format;
        return $this;
    }
}

