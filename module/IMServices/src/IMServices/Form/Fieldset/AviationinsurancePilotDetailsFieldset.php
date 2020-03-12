<?php
namespace IMServices\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use IMServices\Entity\AviationinsurancePilotDetails;

/**
 *
 * @author otaba
 *        
 */
class AviationinsurancePilotDetailsFieldset extends Fieldset implements InputFilterProviderInterface
{
    
    private $entityManager;

   public function init(){
       $hydrator = new DoctrineObject($this->entityManager);
       $this->setHydrator($hydrator)->setObject(new AviationinsurancePilotDetails());
       
       $this->add(array(
           "name"=>"pilotName",
           "type"=>"text",
           "options"=>array(
               "label"=>"Pilot Name",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
               )
           ),
           "attributes"=>array(
               "id"=>"pilotName",
               "class"=>"form-control col-md-7 col-xs-12"
           )
       ));
       
       $this->add(array(
           "name"=>"pilotDOb",
           "type"=>"date",
           "options"=>array(
               "label"=>"Pilot Birth Date",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
               )
           ),
           "attributes"=>array(
               "id"=>"pilotDOb",
               "class"=>"form-control col-md-7 col-xs-12"
           )
       ));
       
       $this->add(array(
           "name"=>"flyingHours",
           "type"=>"text",
           "options"=>array(
               "label"=>"Pilot Flying Hours",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
               )
           ),
           "attributes"=>array(
               "id"=>"flyingHours",
               "class"=>"form-control col-md-7 col-xs-12",
               "placeholder"=>"if applicable"
           )
       ));
       
       $this->add(array(
           "name"=>"licenceNumber",
           "type"=>"text",
           "options"=>array(
               "label"=>"Pilot Licence",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
               )
           ),
           "attributes"=>array(
               "id"=>"licenceNumber",
               "class"=>"form-control col-md-7 col-xs-12"
           )
       ));
       
       //isPreviousAccident
       
       $this->add(array(
           "name"=>"isPreviousAccident",
           "type"=>"checkbox",
           "options"=>array(
               "label"=>"Pilot previously had accident",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
               )
           ),
           "attributes"=>array(
               "id"=>"isPreviousAccident",
               "class"=>"col-md-7 col-xs-12"
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
            "isPreviousAccident"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "licenceNumber"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "flyingHours"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "pilotDOb"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "pilotName"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
        );
    }
    
    public function setEntityManager($em){
        $this->entityManager = $em;
        return $this;
    }
}

