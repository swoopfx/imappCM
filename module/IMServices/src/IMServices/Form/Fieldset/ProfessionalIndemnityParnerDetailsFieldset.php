<?php
namespace IMServices\Form\Fieldset;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use IMServices\Entity\ProfessionalIndemnityPartnerDetails;

/**
 *
 * @author otaba
 *        
 */
class ProfessionalIndemnityParnerDetailsFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;
    
    
    public  function init(){
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setHydrator($hydrator)->setObject(new ProfessionalIndemnityPartnerDetails());
        
        $this->add(array(
            "name"=>"partnerName", 
            "type"=>"text",
            "options"=>array(
                "label"=>"Partner Name",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"partnerName",
                "class"=>"form-control col-md-7 col-sm-7 col-xs-12",
                "placeholder"=>"Microsoft"
            )
        ));
        
        $this->add(array(
            "name"=>"qualification",
            "type"=>"text",
            "options"=>array(
                "label"=>"Qualification",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"qualification",
                "class"=>"form-control col-md-7 col-sm-7 col-xs-12",
                "placeholder"=>"Diploma"
            )
        ));
        
        $this->add(array(
            "name"=>"dateQualified",
            "type"=>"date",
            "options"=>array(
                "label"=>"Date Qualified",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"dateQualified",
                "class"=>"form-control col-md-7 col-sm-7 col-xs-12",
//                 "placeholder"=>"Diploma"
            )
        ));
        
        $this->add(array(
            "name"=>"partnerCapacity",
            "type"=>"text",
            "options"=>array(
                "label"=>"Partners Capacity",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"partnerCapacity",
                "class"=>"form-control col-md-7 col-sm-7 col-xs-12",
                //                 "placeholder"=>"Diploma"
            )
        ));
        
    }
    
    /**
     * {@inheritDoc}
     * @see \Zend\InputFilter\InputFilterProviderInterface::getInputFilterSpecification()
     */
    public function getInputFilterSpecification()
    {
        return array(
            "partnerCapacity"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "dateQualified"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "qualification"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "partnerName"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            //
        );
        
    }
    
    public function setEntityManager($em){
        $this->entityManager = $em;
        return $this;
    }

}

