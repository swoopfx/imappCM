<?php
namespace IMServices\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use IMServices\Entity\CropAgricCropDetails;

/**
 *
 * @author otaba
 *        
 */
class CropAgricCropDetailsFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;

    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setObject(new CropAgricCropDetails())->setHydrator($hydrator);
        
        $this->add(array(
            "name" => "cropTypeInsured",
            "type" => "text",
            "options" => array(
                "label" => "Crop Type Insured",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "cropTypeInsured",
                "placeholder" => "Cucumber, Carrot",
                "class" => "form-control col-md-7 col-xs-12"
            )
        ));
        
        $this->add(array(
            "name" => "cropsBiggestThreat",
            "type" => "text",
            "options" => array(
                "label" => "Crops Biggest Threat",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "cropsBiggestThreat",
                "placeholder" => "Tomato Ebola",
                "class" => "form-control col-md-7 col-xs-12"
            )
        ));
        
        $this->add(array(
            "name" => "cropSeedVariety",
            "type" => "text",
            "options" => array(
                "label" => "Crop/Seed Variety",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "cropSeedVariety",
                "placeholder" => "Leriga 4 rice",
                "class" => "form-control col-md-7 col-xs-12"
            )
        ));
        
        $this->add(array(
            "name" => "vegetationPeriod",
            "type" => "text",
            "options" => array(
                "label" => "Vegetation Period",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "vegetationPeriod",
                "placeholder" => "3",
                "class" => "form-control col-md-7 col-xs-12"
            )
        ));
        
        $this->add(array(
            "name" => "hectares",
            "type" => "text",
            "options" => array(
                "label" => "Vegetation Size",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "hectares",
                "placeholder" => "4",
                "class" => "form-control col-md-7 col-xs-12"
            )
        ));
        
        $this->add(array(
            "name" => "noOfPlantsPerHectare",
            "type" => "text",
            "options" => array(
                "label" => "Number of Plant per Hectare",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "noOfPlantsPerHectare",
                "placeholder" => "300",
                "class" => "form-control col-md-7 col-xs-12"
            )
        ));
        
        $this->add(array(
            "name" => "annualProduction",
            "type" => "text",
            "options" => array(
                "label" => "Annual Ton Production",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "annualProduction",
                "placeholder" => "300",
                "class" => "form-control col-md-7 col-xs-12"
            )
        ));
        
        $this->add(array(
            "name" => "cropSalesValue",
            "type" => "text",
            "options" => array(
                "label" => "Value per metric tonne",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "cropSalesValue",
                // "placeholder" => "300",
                "class" => "form-control col-md-7 col-xs-12"
            )
        ));
        
        $this->add(array(
            "name" => "sumInsured",
            "type" => "text",
            "options" => array(
                "label" => "Sum Insured",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "sumInsured",
                
                "class" => "form-control col-md-7 col-xs-12"
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
            "sumInsured" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "cropSalesValue" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "annualProduction" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "noOfPlantsPerHectare" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "hectares" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "vegetationPeriod" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "cropSeedVariety" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "cropsBiggestThreat" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "cropTypeInsured" => array(
                "allow_empty" => true,
                "required" => false
            )
        );
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }
}

