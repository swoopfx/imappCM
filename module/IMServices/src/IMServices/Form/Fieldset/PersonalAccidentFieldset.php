<?php
namespace IMServices\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use IMServices\Entity\PersonalAccident;

/**
 *
 * @author otaba
 *        
 */
class PersonalAccidentFieldset extends Fieldset implements InputFilterProviderInterface
{
    private $entitymanager;

    public function init(){
        $hydrator = new DoctrineObject($this->entitymanager);
        $this->setHydrator($hydrator)->setObject(new PersonalAccident());
        $this->addFields();
    }
    
    private function addFields(){
        $this->add(array(
            "name"=>"estimatedPremium",
            "type"=>"text",
            "options"=>array(
                "label"=>"Expected Premium",
                "label_attributes"=>array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            "attributes"=>array(
                "class"=>"form-control col-md-7 col-xs-12",
                "id"=>"estimatedPremium"
            )
        ));
        
        $this->add(array(
            "name"=>"coverStartDate",
            "type"=>"date",
            "options"=>array(
                "label"=>"Cover Begins",
                "label_attributes"=>array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            "attributes"=>array(
                "class"=>"form-control col-md-7 col-xs-12",
                "id"=>"coverStartDate"
            )
        ));
        
        $this->add(array(
            "name"=>"coverEndDate",
            "type"=>"date",
            "options"=>array(
                "label"=>"Cover Ends",
                "label_attributes"=>array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            "attributes"=>array(
                "class"=>"form-control col-md-7 col-xs-12",
                "id"=>"coverEndDate"
            )
        ));
        
        $this->add(array(
            "name"=>"isEngageInHazardSport",
            "type"=>"checkbox",
            "options"=>array(
                "label"=>"Engaged In Hazard Sport",
                "label_attributes"=>array(
                    'class' => 'control-label col-md-5 col-sm-5 col-xs-12'
                )
            ),
            "attributes"=>array(
                "class"=>"col-md-5 col-xs-12",
                "id"=>"isEngageInHazardSport"
            )
        ));
        
        $this->add(array(
            "name"=>"hazardDetails",
            "type"=>"textarea",
            "options"=>array(
                "label"=>"Details about Harzard",
                "label_attributes"=>array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            "attributes"=>array(
                "class"=>"form-control col-md-7 col-xs-12",
                "id"=>"hazardDetails"
            )
        ));
        
        //hazardDetails
        $this->add(array(
            "name"=>"isAnyAffectedByDisease",
            "type"=>"checkbox",
            "options"=>array(
                "label"=>"Are Affected By Disease",
                "label_attributes"=>array(
                    'class' => 'control-label col-md-5 col-sm-5 col-xs-12'
                )
            ),
            "attributes"=>array(
                "class"=>"col-md-5 col-xs-12",
                "id"=>"isAnyAffectedByDisease"
            )
        ));
        
        $this->add(array(
            "name"=>"diseaseDetails",
            "type"=>"textarea",
            "options"=>array(
                "label"=>"Details about Disease",
                "label_attributes"=>array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            "attributes"=>array(
                "class"=>"form-control col-md-7 col-xs-12",
                "id"=>"diseaseDetails"
            )
        ));
        
        $this->add(array(
            "name"=>"isPreviousInsurer",
            "type"=>"checkbox",
            "options"=>array(
                "label"=>"Previously Insured",
                "label_attributes"=>array(
                    'class' => 'control-label col-md-5 col-sm-5 col-xs-12'
                )
            ),
            "attributes"=>array(
                "class"=>"col-md-5 col-xs-12",
                "id"=>"isPreviousInsurer"
            )
        ));
        
        $this->add(array(
            "name"=>"isPreviousDecline",
            "type"=>"checkbox",
            "options"=>array(
                "label"=>"Previously Declined By Insurer",
                "label_attributes"=>array(
                    'class' => 'control-label col-md-5 col-sm-5 col-xs-12'
                )
            ),
            "attributes"=>array(
                "class"=>"col-md-5 col-xs-12",
                "id"=>"isPreviousDecline"
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
            "isPreviousDecline"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            "isPreviousInsurer"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            "diseaseDetails"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            "isAnyAffectedByDisease"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            "hazardDetails"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            "isEngageInHazardSport"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            "coverEndDate"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            "coverStartDate"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            "estimatedPremium"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
        );
    }
    
    public function setEntityManager($em){
        $this->entitymanager = $em ;
        return $this;
    }
}

