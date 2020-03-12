<?php
namespace Transactions\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Transactions\Entity\BrokerFlutterwaveAccount;

/**
 *
 * @author otaba
 *        
 */
class BrokierFlutterwaveAccountFieldset extends Fieldset implements InputFilterProviderInterface
{
    
    private $entityManager;

    /**
     *
     * @param null|int|string $name
     *            Optional name for the element
     *            
     * @param array $options
     *            Optional options for the element
     *            
     */
    
    
    public function init(){
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setObject(new BrokerFlutterwaveAccount())->setHydrator($hydrator);
        $this->addFields();
        
    }
    
    private function addFields(){
        $this->add(array(
            'name'=>'merchantId',
            'type'=>'text',
            'options'=>array(
                'label'=>'Flutterwave Merchant Key',
                'label_attributes'=>array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
            ),
            'attributes'=>array(
                'required'=>'required',
                'class' => 'form-control col-sm-9 col-md-9 col-xs-12 url',
                'placeholder' => 'la_xgtq2345htkh'
                
            )
        ));
        $this->add(array(
            'name'=>'encryptKey',
            'type'=>'text',
            'options'=>array(
                'label'=>'Flutterwave API Key',
                'label_attributes'=>array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
            ),
            'attributes'=>array(
                'required'=>'required',
                'class' => 'form-control col-sm-9 col-md-9 col-xs-12 url',
                'placeholder' => 'la_dweeeegrt566'
            ),
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
    
    // Begin seeters
    
    public function setEntityManager($em){
        $this->entityManager = $em ;
        return $this;
    }
    
    // End setters
}

