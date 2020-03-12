<?php
namespace IMServices\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use IMServices\Entity\CropAgricInsurance;

/**
 *
 * @author otaba
 *        
 */
class CropInsuranceFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;

    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setObject(new CropAgricInsurance())->setHydrator($hydrator);
        $this->addFields();
    }

    private function addFields()
    {
        $this->add(array(
            "name" => "coverStartDate",
            "type" => "date",
            "options" => array(
                "label" => "Cover Start Date",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "coverStartDate",
                "value" => date("Y-m-d"),
                "min" => date("Y-m-d"),
                "class" => "form-control col-md-7 col-xs-12"
            )
        ));
        
        $this->add(array(
            "name" => "coverEndDate",
            "type" => "date",
            "options" => array(
                "label" => "Cover End Date",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "coverEndDate",
                "value" => date("Y-m-d", strtotime(date("Y-m-d", time()) . " + 1 year")),
                // "placeholder" => date("m/d/Y"),
                // "min" => date("Y-m-d") +,
                "class" => "form-control col-md-7 col-xs-12"
            )
        ));
        
        $this->add(array(
            "name" => "farmAddress",
            "type" => "textarea",
            "options" => array(
                "label" => "Farm Address",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "farmAddress",
                "class" => "form-control col-md-7 col-xs-12"
            )
        ));
        
        $this->add(array(
            "name" => "farmNearestVillage",
            "type" => "text",
            "options" => array(
                "label" => "Nearest Village/LandMark",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "farmNearestVillage",
                "placeholder" => "Igbo Erin",
                "class" => "form-control col-md-7 col-xs-12"
            )
        ));
        
        $this->add(array(
            'name' => 'farmState',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'State',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                // 'empty_option' => '--Select Cover Peril -- ',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\Zone',
                'property' => 'zoneName',
                'is_method' => true,
                'find_method' => array(
                    'name' => 'findBy',
                    'params' => array(
                        'criteria' => array(
                            "country" => 156
                        )
                    )
                
                )
            ),
            'attributes' => array(
                'id' => 'farmState',
                'class' => 'form-control col-md-7 col-xs-12'
                // 'multiple' => 'multiple'
            
            )
        ));
        
        $this->add(array(
            "name" => "farmSize",
            "type" => "text",
            "options" => array(
                "label" => "Farm Size",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "farmSize",
                "class" => "form-control col-md-7 col-xs-12"
            )
        ));
        
        // farmAreaPlanted
        $this->add(array(
            "name" => "farmAreaPlanted",
            "type" => "text",
            "options" => array(
                "label" => "Farm Area Planted",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "farmAreaPlanted",
                "class" => "form-control col-md-7 col-xs-12"
            )
        ));
        
        $this->add(array(
            "name" => "cropPlantingDate",
            "type" => "date",
            "options" => array(
                "label" => "Planting Date",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "cropPlantingDate",
                "class" => "form-control col-md-7 col-xs-12"
            )
        ));
        
        $this->add(array(
            "name" => "estimatedHarvetDate",
            "type" => "date",
            "options" => array(
                "label" => "Harvest Date (Estimated)",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "estimatedHarvetDate",
                "class" => "form-control col-md-7 col-xs-12"
            )
        ));
        
        $this->add(array(
            "name" => "seasonCommencement",
            "type" => "text",
            "options" => array(
                "label" => "Season Begin",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "seasonCommencement",
                "placeholder" => "2013",
                "class" => "form-control col-md-7 col-xs-12"
            )
        ));
        
        // seasonEnd
        $this->add(array(
            "name" => "seasonEnd",
            "type" => "text",
            "options" => array(
                "label" => "Season Ends",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "seasonEnd",
                "placeholder" => "2017",
                "class" => "form-control col-md-7 col-xs-12"
            )
        ));
        
        $this->add(array(
            "name" => "estimatedCostLandClearing",
            "type" => "text",
            "options" => array(
                "label" => "Land Clearing Cost",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "estimatedCostLandClearing",
                "placeholder" => "2,000",
                "class" => "form-control col-md-7 col-xs-12"
            )
        ));
        
        $this->add(array(
            "name" => "estimatedCostPlanting",
            "type" => "text",
            "options" => array(
                "label" => "Planting Cost",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "estimatedCostPlanting",
                "placeholder" => "4,000",
                "class" => "form-control col-md-7 col-xs-12"
            )
        ));
        
        $this->add(array(
            "name" => "estimatesCostIrrigation",
            "type" => "text",
            "options" => array(
                "label" => "Irrigation Cost",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "estimatesCostIrrigation",
                "placeholder" => "4000",
                "class" => "form-control col-md-7 col-xs-12"
            )
        ));
        
        // estimatedCostWeedPestControl
        $this->add(array(
            "name" => "estimatedCostWeedPestControl",
            "type" => "text",
            "options" => array(
                "label" => "Weed/Pest Cost",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "estimatedCostWeedPestControl",
                "placeholder" => "300",
                "class" => "form-control col-md-7 col-xs-12"
            )
        ));
        
        $this->add(array(
            "name" => "estinmatedCostTransportation",
            "type" => "text",
            "options" => array(
                "label" => "Transportation Cost",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "estinmatedCostTransportation",
                "placeholder" => "10,000",
                "class" => "form-control col-md-7 col-xs-12"
            )
        ));
        
        $this->add(array(
            "name" => "estimatedCostInterestLoan",
            "type" => "text",
            "options" => array(
                "label" => "Interest On loan",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "estimatedCostInterestLoan",
                "placeholder" => "8,000",
                "class" => "form-control col-md-7 col-xs-12"
            )
        ));
        
        $this->add(array(
            "name" => "estimatedCostInterestLoan",
            "type" => "text",
            "options" => array(
                "label" => "Interest On loan",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "estimatedCostInterestLoan",
                "placeholder" => "8,000",
                "class" => "form-control col-md-7 col-xs-12"
            )
        ));
        
        // estmatedCostHarvesting
        
        $this->add(array(
            "name" => "estmatedCostHarvesting",
            "type" => "text",
            "options" => array(
                "label" => "Harvesting Cost",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "estmatedCostHarvesting",
                "placeholder" => "8,000",
                "class" => "form-control col-md-7 col-xs-12"
            )
        ));
        
        // estimatedCostMiscellanous
        $this->add(array(
            "name" => "estimatedCostMiscellanous",
            "type" => "text",
            "options" => array(
                "label" => "Miscellaneous Cost",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "estimatedCostMiscellanous",
                "placeholder" => "56,000",
                "class" => "form-control col-md-7 col-xs-12"
            )
        ));
        
       
        
        $this->add(array(
            "name" => "cropDetails",
            "type" => "textarea",
            "options" => array(
                "label" => "Crop Details",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "cropDetails",
                "class" => "form-control col-md-7 col-xs-12"
            )
        ));
        
        
        
        $this->add(array(
            "name" => "yearInBusiness",
            "type" => "number",
            "options" => array(
                "label" => "Years In Business",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "yearInBusiness",
                "placeholder" => "4",
                "class" => "form-control col-md-7 col-xs-12"
            )
        ));
        
        
        
        $this->add(array(
            "name" => "threatManagement",
            "type" => "textarea",
            "options" => array(
                "label" => "Threat Management Methods",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "threatManagement",
                "class" => "form-control col-md-7 col-xs-12"
            )
        ));
        
        $this->add(array(
            "name" => "specialRiskManagment",
            "type" => "textarea",
            "options" => array(
                "label" => "Special Risk Methods",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "specialRiskManagment",
                
                "class" => "form-control col-md-7 col-xs-12"
            )
        ));
        
        $this->add(array(
            'name' => 'cropPerilCoverList',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Cover Peril',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                'empty_option' => '--Select Cover Peril -- ',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\CropAgricPeril',
                'property' => 'peril'
            ),
            'attributes' => array(
                'id' => 'cropPerilCoverList',
                'class' => 'form-control col-md-7 col-xs-12',
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
        return array(
            "cropPerilCoverList" => array(
                "allow_empty" => true,
                "required" => false
            ),
            
            "specialRiskManagment"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            
            "threatManagement"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            
//             "cropsBiggestThreat"=>array(
//                 "allow_empty"=>true,
//                 "required"=>false,
//             ),
            
            "yearInBusiness"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            
//             "cropTypeInsured"=>array(
//                 "allow_empty"=>true,
//                 "required"=>false,
//             ),
            
            "cropDetails"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            
//             "cropSeedVariety"=>array(
//                 "allow_empty"=>true,
//                 "required"=>false,
//             ),
            
            "estimatedCostMiscellanous"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            
            "estmatedCostHarvesting"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            
            "estimatedCostInterestLoan"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            
            "estinmatedCostTransportation"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            
            "estimatedCostWeedPestControl"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            
            "estimatesCostIrrigation"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            
            "estimatedCostPlanting"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            
            "estimatedCostLandClearing"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            
            "seasonEnd"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            
            "farmSize"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            
            "cropPlantingDate"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            
            "estimatedHarvetDate"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            
        );
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }
}

