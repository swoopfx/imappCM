<?php
namespace Users\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Users\Entity\BrokerBankAccount;


/**
 *
 * @author swoopfx
 *        
 */
class BrokerBankAccountFieldset extends Fieldset implements InputFilterProviderInterface
{
    
    private $entityManager;

   
    public function init(){
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setHydrator($hydrator)->setObject(new BrokerBankAccount());
        $this->addFields();
    }
    
private function addFields()
    {
        $this->add(array(
            'name' => 'bankName',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => "Your Bank Name",
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\NigeriaBanks',
                'property' => 'bankName',
                'empty_option' => '-- Select Your Bank --'
            ),
            'attributes' => array(
                'class' => 'form-control col-md-3 col-sm-3 col-xs-12',
                'required'=>'required'
            )
        ));
        $this->add(array(
            'name' => 'accountName',
            'type' => 'text',
            'options' => array(
                'label' => 'Your Bank Account Name',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'class' => 'form-control col-md-3 col-sm-3 col-xs-12',
                'id' => 'account-name',
                'placeholder' => 'Enter Bank Account name Here',
                'required'=>'required'
            )
        ));
        $this->add(array(
            'name' => 'swiftCode',
            'type' => 'text',
            'options' => array(
                'label' => 'Bank Swift Code ',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'class' => 'form-control col-md-3 col-sm-3 col-xs-12',
                'id' => '',
                'placeholder' => 'GTBLGA123'
            )
        ));
        
        $this->add(array(
            'name' => 'bankAccountNo',
            'type' => 'Zend\Form\Element\Text',
            'options' => array(
                'label' => 'Bank Account Number (NUBAN) ',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'class' => 'form-control col-md-3 col-sm-3 col-xs-12',
                'id' => 'accountno',
                'placeholder' => '0001989898',
                'required' => 'required'
            )
            
        ));
        
        $this->add(array(
            'name' => 'bankAddress',
            'type' => 'textarea',
            'options' => array(
                'label' => 'Bank Address ',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'class' => 'form-control col-md-3 col-sm-3 col-xs-12',
                'id' => '',
                'placeholder' => 'Enter Bank Address here ',
                //'required' => 'required'
            )
        ));
        
        $this->add(array(
            'name' => 'sortCode',
            'type' => 'Zend\Form\Element\Text',
            'options' => array(
                'label' => 'Bank SORTCODE ',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'class' => 'form-control col-md-3 col-sm-3 col-xs-12',
                'id' => '',
                'placeholder' => 'Enter Bank SORTCODE if available ',
                //'required' => 'required'
            )
        ));
        
        $this->add(array(
            'name' => 'swiftCode',
            'type' => 'Zend\Form\Element\Text',
            'options' => array(
                'label' => 'Bank SWIFT ',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'class' => 'form-control col-md-3 col-sm-3 col-xs-12',
                'id' => '',
                'placeholder' => 'Enter Bank SWIFT if available for international transactions  ',
                //'required' => 'required'
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
        return array(
            'bankName'=>array(
                'required'=>true,
                'allow_empty'=>false,
                'filters'=>array(
                    array(
                        'name' => 'Zend\Filter\StringTrim'
                    ),
                    array(
                        'name' => 'Zend\Filter\StripTags',
                    )
                ),
                'validators'=>array(
                    
                )
            ),
            'accountName'=>array(
                'required'=>true,
                'allow_empty'=>false,
                'filters'=>array(
                    array(
                        'name' => 'Zend\Filter\StringTrim'
                    ),
                    array(
                        'name' => 'Zend\Filter\StripTags',
                    )
                ),
                'validators'=>array(
            
                )
            ),
            'bankAccountNo'=>array(
                'required'=>true,
                'allow_empty'=>false,
                'filters'=>array(
                    array(
                        'name' => 'Zend\Filter\StringTrim'
                    ),
                    array(
                        'name' => 'Zend\Filter\StripTags',
                    )
                ),
                'validators'=>array(
            
                )
            )
        );
    }
    
    // Begin Setters
    
    public function setEntityManager($em){
        $this->entityManager = $em ;
        
        return $this;
    }
    // End Setters
}

