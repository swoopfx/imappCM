<?php
namespace Users\Form\Fieldset;

use Zend\InputFilter\InputProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Users\Entity\BrokerTelephone;

class BrokerTelephoneFieldset extends Fieldset implements InputProviderInterface
{

    private $entityManager;

    public function init()
    {
        
        
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setHydrator($hydrator)->setObject(new BrokerTelephone());
        $this->addfeilds();
    }

    protected function addfeilds()
    {
        $this->add(array(
            'name' => 'brokerTelephone',
            'type' => 'text',
            'options' => array(
                //'label' => 'Broker Phone Number', 
                'label_attributes'=>array(
                    'class'=>'control-label col-md-3 col-sm-3 col-xs-12'
                ),
            ),
            'attributes' => array(
                
               'class'=>'phone form-control col-md-7 col-xs-12',
               'placeholder' => '+234-709-234-2356'
            )
        ));
    }

    public function getInputSpecification()
    {
        return array(
            'brokerTelephone' => array(
                'required' => false,
                'allow_empty' => true,
                'filters' => array(
                    array(
                        'name' => 'Zend\Filter\StringTrim'
                    ),
                    array(
                        'name' => 'Zend\Filter\StripTags'
                    )
                )
            )
            // use javascriot as front end validator
            
        );
    }
    
    //Begin Setters
    
    public function setEntityManager($em){
        $this->entityManager = $em ;
        
        return $this;
    }
    
    
    // End Setters
}

?>