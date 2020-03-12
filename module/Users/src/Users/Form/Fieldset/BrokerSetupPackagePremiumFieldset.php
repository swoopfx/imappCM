<?php
namespace Users\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use GeneralServicer\Entity\BrokerSubscription;

/**
 *
 * @author otaba
 *        
 */
class BrokerSetupPackagePremiumFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;

    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setHydrator($hydrator)->setObject(new BrokerSubscription());
        // var_dump($this->currencyFormat);
        $this->addFields();
    }

    private function addFields()
    {
        $this->add(array(
            'name' => 'package',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Select a Package',
                // 'empty_option' => '-- Select a Package --',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\Packages',
                'property' => 'packageName',
                'label_generator' => function ($targetEntity) {
                    return " " . $targetEntity->getPackageName() . " (" . $targetEntity->getPrice() . ")";
                },
                // 'option_attributes'=>
                'is_method' => true,
                'find_method' => array(
                    'name' => 'findBy',
                    'params' => array(
                        'criteria' => array(
                            'packageCategory' => 2,
                            "id" => 2
                        )
                    ),
                    'orderBy' => array(
                        'id' => 'ASC'
                    )
                )
            ),
            'attributes' => array(
                // 'data-ng-change' => 'showpackageDetails()',
                'id' => 'package_select',
                'class' => 'form-control col-md-3 col-sm-3 col-xs-12',
                // 'value'=>1,
                // 'data-ng-model'=>"packages",
                'required' => 'required'
            )
        ));
        
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
                // 'data-ng-change' => 'showpackageDetails()',
                'placeholer' => 'Select your start Date',
                'class' => 'form-control col-md-9 col-xs-12',
                'value' => 3,
                'min' => 3,
                'step' => 3
                // 'data-ng-model'=>"packagemonths"
            
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
            "package" => array(
                "required" => true,
                "allow_empty" => false,
                "validators" => array(),
                "filters" => array()
            )
        );
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }
}

