<?php
namespace GeneralServicer\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use GeneralServicer\Entity\ManualPremium;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;

/**
 *
 * @author otaba
 *        
 */
class ManualPremiumFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;

    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setHydrator($hydrator)->setObject(new ManualPremium());
        $this->addField();
    }

    private function addField()
    {
        $this->add(array(
            "name" => "premium",
            "type" => "text",
            "options" => array(
                "label" => "Premium Value",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-sm-9 col-md-9 col-xs-12",
                "id" => "manual_premium",
                "placeholder" => "30,000",
                "required"=>"required"
            )
        ));
        
        $this->add(array(
            "name" => "currency",
            'type' => 'DoctrineModule\Form\Element\ObjectSelect', // make it multi radio
            'options' => array(
                'label' => 'Premium Currency',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\Currency',
                'property' => 'title'
            
            ),
            
            "attributes" => array(
                "class" => "form-control col-md-9 col-sm-9 col-xs-12 ",
                "required" => "required",
                
                'id' => "premium_currency"
            )
        ));
        
        $this->add(array(
            "name" => "description",
            "type" => "textarea",
            "options" => array(
                "label" => "Description",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-9 col-sm-9 col-xs-12",
                "id" => "premium_description"
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
}

