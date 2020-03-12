<?php
namespace Users\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use GeneralServicer\Entity\BrokerSubscription;
use DoctrineModule\Form\Element\ObjectSelect;

/**
 *
 * @author swoopfx
 *        
 */
class BrokerSetupPackageFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;
    
    private $currencyFormat;

    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setHydrator($hydrator)->setObject(new BrokerSubscription());
        //var_dump($this->currencyFormat);
        $this->addFields();
    }

    private function addFields()
    {
        $this->add(array(
            'name' => 'package',
            'type' => 'hidden',
            'options' => array(
                'label' => 'Select a Package',
               // 'empty_option' => '-- Select a Package --',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\Packages',
                'property' => 'packageName',
                'label_generator'=>function($targetEntity){
                    return " ".$targetEntity->getPackageName()." (".$targetEntity->getPrice().")";
                },
               // 'option_attributes'=>
                'is_method' => true,
                'find_method' => array(
                    'name' => 'findBy',
                    'params' => array(
                        'criteria' => array(
                            'packageCategory' => 2,
                            
                        )
                    ),
                    'orderBy' => array(
                        'id' => 'ASC'
                    )
                )
            ),
            'attributes' => array(
                //'data-ng-change' => 'showpackageDetails()',
                'id' => 'package_select',
                'class' => 'form-control col-md-3 col-sm-3 col-xs-12',
                //'value'=>1,
                //'data-ng-model'=>"packages",
                'required'=>'required'
            )
        )
        );
        
        $this->add(array(
            'name' => 'months',
            'type' => 'number',
            'options' => array(
                'label' => 'How many Months',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                //'data-ng-change' => 'showpackageDetails()',
                'placeholer' => 'Select your start Date',
                'class' => 'form-control col-md-9 col-xs-12',
                'value' => 3,
                'min'=> 3,
                'step'=>3
                //'data-ng-model'=>"packagemonths"
                
            )
        ));
        $this->add(array(
            'name' => 'startDate',
            'type' => 'Zend\Form\Element\MonthSelect',
            'options' => array(
                'label' => 'Start Date',
                
                'create_empty_option' => true,
                'min_year' => date('Y'),
                'max_year' => date('Y') + 10,
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                'month_attributes' => array(
                    'data-placeholder' => 'Month',
                    'style' => 'width: 50%',
                    'class' => 'form-control col-md-3 col-xs-12',
                    'empty_option' => '-- Month --'
                ),
                'year_attributes' => array(
                    'date-placeholder' => 'Year',
                    'style' => 'width: 50%',
                    'class' => 'form-control col-md-3 col-xs-12',
                    'empty_option' => '-- Year --'
                ),
                'attributes' => array(
                    
                    'placeholer' => 'Select your start Date',
                    'class' => 'form-control col-md-9 col-xs-12'
                )
            )
        )
        );
        
        $this->add(array(
            'name' => 'endDate',
            'type' => 'Zend\Form\Element\MonthSelect',
            'options' => array(
                'label' => 'End Date',
                
                'create_empty_option' => true,
                'min_year' => date('Y'),
                'max_year' => date('Y') + 10,
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                'month_attributes' => array(
                    'placeholder' => 'Month',
                    'style' => 'width: 50%',
                    'class' => 'form-control col-md-3 col-xs-12',
                    'empty_option' => '-- Month --'
                ),
                'year_attributes' => array(
                    'create_empty_option' => true,
                    'placeholder' => 'Year',
                    'style' => 'width: 50%',
                    'class' => 'form-control col-md-3 col-xs-12',
                    'empty_option' => '-- Year --'
                ),
                'attributes' => array(
        
        'placeholer' => 'Select your start Date',
        'class' => 'form-control col-md-9 col-xs-12'
        )
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
            'package' => array(
                'required' => true,
                'allow_empty' => false,
                'filters' => array(),
                'validators' => array()
            )
        )
        // End date should not be more than start date
        // 'endDate' => array(
        // 'required' => true,
        // 'allow_empty' => false,
        // 'validators' => array(
        // array(
        // 'name' => 'callback',
        // 'options' => array(
        // 'messages' => array(
        // \Zend\Validator\Callback::INVALID_VALUE => 'The End date is less than the Start date'
        // ),
        // 'callback' => function ($value, $context = array()) {
        // $startDate = \DateTime::createFromFormat('d-m-Y', $context['startDate']);
        // $endDate = \DateTime::createFromFormat('d-m-Y', $value);
        // return $endDate >= $startDate;
        // }
        // )
        // )
        // )
        // ),
        // 'startDate' => array()
        ;
    }
    
    // Begin Setters
    public function setEntityManager($em)
    {
         $this->entityManager = $em;
        
        return $this;
    }
    
    public function setCurrencyFormat($format){
        $this->currencyFormat = $format;
        return $this;
    }
    // End Setters
}

