<?php
namespace IMServices\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use IMServices\Entity\AgricProductInsurance;

/**
 *
 * @author otaba
 *        
 */
class AgricProductInsuranceFieldset extends Fieldset implements InputFilterProviderInterface
{
    private $entityManager;

   public function init(){
       $hydrator = new DoctrineObject($this->entityManager);
       $this->setHydrator($hydrator)->setObject(new AgricProductInsurance());
       
       $this->add(array(
           "name"=>"isCoverProperty",
           "type"=>"checkbox",
           "options"=>array(
               "label"=>"Cover For Property",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
               )
           ),
           "attributes"=>array(
               "class"=>"col-md-6 col-xs-12",
               "id"=>"isCoverProperty",
               "checked"=>true
           )
       ));
       
       
       $this->add(array(
           "name"=>"isCoverAgriculturalProduce",
           "type"=>"checkbox",
           "options"=>array(
               "label"=>"Cover for Agricultural Produce",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
               )
           ),
           "attributes"=>array(
               "class"=>"col-md-6 col-xs-12",
               "id"=>"isCoverAgriculturalProduce",
               "checked"=>true
           )
       ));
       
       $this->add(array(
           "name"=>"totalCoverValue",
           "type"=>"text",
           "options"=>array(
               "label"=>"Total Cover Value",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
               )
           ),
           "attributes"=>array(
               "class"=>"form-control col-md-7 col-xs-12",
               "id"=>"totalCoverValue"
           )
       ));
       
       $this->add(array(
           "name"=>"lastDateInspected",
           "type"=>"date",
           "options"=>array(
               "label"=>"Last Date Inspected",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
               )
           ),
           "attributes"=>array(
               "class"=>"form-control col-md-7 col-xs-12",
               "id"=>"lastDateInspected"
           )
       ));
       
       $this->add(array(
           "name"=>"isRegularlyInspected",
           "type"=>"checkbox",
           "options"=>array(
               "label"=>"Is Regularly Inspected",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
               )
           ),
           "attributes"=>array(
               "class"=>"col-md-6 col-xs-12",
               "id"=>"isRegularlyInspected",
               "checked"=>true
           )
       ));
       
       $this->add(array(
           "name" => "inspectionDuration",
           "type" => 'DoctrineModule\Form\Element\ObjectSelect',
           "options" => array(
               'label' => 'inspection Frequency',
               'object_manager' => $this->entityManager,
               'target_class' => 'Settings\Entity\MicroPaymentStructure',
               'property' => 'microText',
               
               'label_attributes' => array(
                   "class" => "control-label col-md-3 col-sm-3 col-xs-12' "
               )
           ),
           "attributes" => array(
//                'required' => "required",
               "class" => "form-control col-md-7 col-sm-7 col-xs-12 ",
               // "style" => "width: 100%",
               "id" => "inspectionDuration"
               
           )
       ));
       
       $this->add(array(
           "name"=>"isPreviousClaim",
           "type"=>"checkbox",
           "options"=>array(
               "label"=>"Previously had claims",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
               )
           ),
           "attributes"=>array(
               "class"=>"col-md-6 col-xs-12",
               "id"=>"isPreviousClaim"
           )
       ));
       
       $this->add(array(
           "name"=>"isPreviousDecline",
           "type"=>"checkbox",
           "options"=>array(
               "label"=>"Declined by Previous Insurer",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
               )
           ),
           "attributes"=>array(
               "class"=>"col-md-6 col-xs-12",
               "id"=>"isPreviousDecline"
           )
       ));
       
       
       $this->add(array(
           "name"=>"declineDetails",
           "type"=>"textarea",
           "options"=>array(
               "label"=>"Decline Details",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
               )
           ),
           "attributes"=>array(
               "class"=>"form-control col-md-7 col-xs-12",
               "id"=>"declineDetails"
           )
       ));
       
       $this->add(array(
           "name"=>"isCanceled",
           "type"=>"checkbox",
           "options"=>array(
               "label"=>"Declined by Previous Insurer",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
               )
           ),
           "attributes"=>array(
               "class"=>"col-md-6 col-xs-12",
               "id"=>"isCanceled"
           )
       ));
       
       $this->add(array(
           "name"=>"cancelDetails",
           "type"=>"textarea",
           "options"=>array(
               "label"=>"Cancel Details",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
               )
           ),
           "attributes"=>array(
               "class"=>"form-control col-md-7 col-xs-12",
               "id"=>"cancelDetails"
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
            "cancelDetails"=>array(
                "allow_empty"=>true,
                "required"=>FALSE
            ),
            "isCanceled"=>array(
                "allow_empty"=>true,
                "required"=>FALSE
            ),
            "declineDetails"=>array(
                "allow_empty"=>true,
                "required"=>FALSE
            ),
            "isPreviousDecline"=>array(
                "allow_empty"=>true,
                "required"=>FALSE
            ),
            "isPreviousClaim"=>array(
                "allow_empty"=>true,
                "required"=>FALSE
            ),
            "inspectionDuration"=>array(
                "allow_empty"=>true,
                "required"=>FALSE
            ),
            "isRegularlyInspected"=>array(
                "allow_empty"=>true,
                "required"=>FALSE
            ),
            "lastDateInspected"=>array(
                "allow_empty"=>true,
                "required"=>FALSE
            ),
            "totalCoverValue"=>array(
                "allow_empty"=>true,
                "required"=>FALSE
            ),
            "isCoverAgriculturalProduce"=>array(
                "allow_empty"=>true,
                "required"=>FALSE
            ),
            "isCoverProperty"=>array(
                "allow_empty"=>true,
                "required"=>FALSE
            ),
        );
    }
    
    public function setEntityManager($em){
        $this->entityManager = $em;
        return $this;
    }
}

