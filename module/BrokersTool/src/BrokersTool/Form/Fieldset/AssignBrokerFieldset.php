<?php
namespace BrokersTool\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;

/**
 *
 * @author swoopfx
 *        
 */
class AssignBrokerFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;
    
    private $centralBrokerId;

    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setHydrator($hydrator);
        $this->addFeilds();
    }

    private function addFeilds()
    {
        $this->add(array(
            'name' => 'brokerChild',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect', // make it multi radio
            'options' => array(
                'label' => 'Assign Staffs to Customer',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                'object_manager' => $this->entityManager,
                'target_class' => 'GeneralServicer\Entity\BrokerChild',
                'property' => 'firstnName',
                'label_generator' => function ($targetEntity) {
                    return $targetEntity->getFullName();
                },
                'empty_option' => '--- No Broker Registered---',
                'is_method' => true,
                // 'option_attributes'=>
                // get all brokerChild in the database associated to this centralBrokerId
                'find_method' => array(
                    'name' => 'findBRokerChild',
                    'params' => array(
                        'brokerId' =>  $this->centralBrokerId
                    ),
                   
                )
            ),
            
            "attributes"=>array(
                "class"=>"form-control col-md-9 col-sm-9 col-xs-12 ",
                "required"=>"required",
                'multiple' => 'multiple',
                'id'=>"chosen-select",
            )
        )
        );
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
    
    public function setCentralBrokerId($id){
        $this->centralBrokerId = $id;
        return $this;
    }
}

