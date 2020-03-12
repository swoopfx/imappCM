<?php
namespace Offer\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Offer\Entity\Offer;
use DoctrineModule\Form\Element\ObjectSelect;

/**
 *
 * @author swoopfx
 *        
 */
class OfferFieldset extends Fieldset implements InputFilterProviderInterface
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
    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setHydrator($hydrator)->setObject(new Offer());
        
        $this->addField();
    }

    private function addField()
    {
        $this->add(array(
            'name' => 'offerName',
            'type' => 'text',
            'options' => array(
                'label' => 'Offer Title',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'id' => 'offer_name',
                'required' => 'required',
                'class' => 'form-control col-xs-12',
                'title' => 'Give a descriptive name to your Offer proposal',
                'placeholder' => 'E.g My Nissan SUV cover'
            )
        ));
        
        $this->add(array(
            'name' => 'valueType',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Premium Calculation Type',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\DefinePackageValueType',
                'property' => 'type',
                'empty_option' => '-- Select A Type --',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'class' => 'form-control col-md-9 col-xs-12',
                'id' => 'value_typer',
                'required' => 'required'
                // 'value' => 1
            )
        ));
        
        $this->add(array(
            'name' => 'value',
            'type' => 'text',
            'options' => array(
                'label' => 'Premium Rate Value',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12 ',
                    'data-ng-model' => 'valueLabel'
                )
            ),
            'attributes' => array(
                'class' => 'form-control col-md-9 col-xs-12 money',
                "required" => "required"
            )
        ));
        
        $this->add(array(
            'name' => 'idPreferdInsurer',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Prefered Insurance Company',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\Insurer',
                'property' => 'insuranceName',
                'empty_option' => '-- Prefered Insurance Company --',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'class' => 'form-control col-md-7 col-xs-12',
                'id' => 'id_prefered_insurer'
            )
        ));
        
        $this->add(array(
            'name' => 'offerServiceType',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Select Service Category ',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\InsuranceServiceType',
                'property' => 'insuranceService',
                'empty_option' => '-- Select a Service Category --',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'id' => 'service-type',
                'class' => 'form-control'
            
            )
        
        ));
        
        $this->add(array(
            'name' => 'offerSpecificService',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Select insurance Service ',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\InsuranceSpecificService',
                'property' => 'specificService',
                'empty_option' => '-- Select a Service --',
//                 'is_method' => true,
//                 'find_method' => array(
//                     'name' => 'find',
//                     'params' => array(
//                         'criteria' => array(
//                             "specificService"=>NULL
//                         )
//                     )
                    
//                 ),
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'id' => 'specific-service',
                'class' => 'form-control'
                // 'data-ng-model' => 'selectedService',
                // 'data-ng-change' => 'selectService(selectedService)'
            )
        ));
        
        $this->add(array(
            'name' => 'coverDuration',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Insurance Cover Duration',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\PolicyCoverDuration',
                'property' => 'duration',
                
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'id' => 'coverduration',
                'class' => 'form-control',
                'data-ng-model' => 'coverduration',
                'data-ng-change' => 'coverDurationCondition(coverduration)'
            )
        ));
        
        $this->add(array(
            'name' => 'currency',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Premium Currency',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\Currency',
                'property' => 'title',
                
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'id' => 'currency',
                'class' => 'form-control',
                
            )
        ));
        
        $this->add(array(
            'name' => 'termedDuration',
            'type' => 'text',
            'options' => array(
                'label' => 'Termed Duration Value',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12 '
                    // 'data-ng-model'=>'valueLabel'
                )
            ),
            'attributes' => array(
                'class' => 'form-control col-md-9 col-xs-12 money'
                // "required"=>"required",
            
            )
        ));
    }

    private function addMotorServices()
    {
        $this->add(array(
            'name' => 'motor_offer',
            'type' => 'IMServices\Form\Fieldset\MotorOfferDataFieldset'
        ));
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
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
            'offerName' => array(
                'required' => true,
                'allow_empty' => 'false',
                'filters' => array(
                    array(
                        'name' => 'Zend\Filter\StringTrim'
                    ),
                    array(
                        'name' => 'StripTags'
                    )
                ),
                'validators' => array(
                    array(
                        'name' => 'Zend\Validator\StringLength',
                        'options' => array(
                            'min' => 5,
                            'max' => 256
                        )
                    )
                )
            )
        
        );
    }
}

?>