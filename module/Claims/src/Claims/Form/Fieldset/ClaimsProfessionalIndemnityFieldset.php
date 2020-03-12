<?php
namespace Claims\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Claims\Entity\ClaimsProfessionalindemnity;

class ClaimsProfessionalIndemnityFieldset extends Fieldset implements InputFilterProviderInterface
{
    
    private $entityManager;

    public function init(){
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setHydrator($hydrator)->setObject(new ClaimsProfessionalindemnity());
        
        $this->add(array(
            'name' => 'claims',
            'type' => 'Claims\Form\Fieldset\ClaimsFieldset'
        ));
        
        $this->add(array(
            "name"=>"claimnantDetails",
            "type"=>"textarea",
            "options"=>array(
                "label"=>"Claimnant Details",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"claimnantDetails",
                "class" => "form-control col-md-7 col-sm-7 col-xs-12",
            )
        ));
        
        $this->add(array(
            "name"=>"retainerReason",
            "type"=>"textarea",
            "options"=>array(
                "label"=>"What Claimnant was retained to do",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"retainerReason",
                "class" => "form-control col-md-7 col-sm-7 col-xs-12",
            )
        ));
        
        $this->add(array(
            "name"=>"isEvidenced",
            "type"=>"checkbox",
            "options"=>array(
                "label"=>"Was retained contract put in writing",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"isEvidenced",
                "class" => "col-md-7 col-sm-7 col-xs-12",
            )
        ));
        
        $this->add(array(
            "name"=>"workDate",
            "type"=>"date",
            "options"=>array(
                "label"=>"When was the work performed which the claim arise",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"workDate",
                "class" => "form-control col-md-7 col-sm-7 col-xs-12",
            )
        ));
        
        
        
        $this->add(array(
            "name"=>"companyClaimPrincipal",
            "type"=>"text",
            "options"=>array(
                "label"=>"who actually performed the work within the firm",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"companyClaimPrincipal",
                "class" => "form-control col-md-7 col-sm-7 col-xs-12",
            )
        ));
        
        $this->add(array(
            "name"=>"principalClaimTitle",
            "type"=>"text",
            "options"=>array(
                "label"=>"Principal Title/Designation",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"principalClaimTitle",
                "class" => "form-control col-md-7 col-sm-7 col-xs-12",
            )
        ));
        
        
        $this->add(array(
            "name"=>"claimNature",
            "type"=>"textarea",
            "options"=>array(
                "label"=>"Precise Nature of Claim",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"claimNature",
                "class" => "form-control col-md-7 col-sm-7 col-xs-12",
            )
        ));
        
        $this->add(array(
            "name"=>"isProceeding",
            "type"=>"checkbox",
            "options"=>array(
                "label"=>"Have legal proceedings commenced?",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"isProceeding",
                "class" => "col-md-7 col-sm-7 col-xs-12",
            )
        ));
        
        
        $this->add(array(
            "name"=>"claimDate",
            "type"=>"date",
            "options"=>array(
                "label"=>"Date claimnant aware of claims circumstance",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"claimDate",
                "class" => "form-control col-md-7 col-sm-7 col-xs-12",
            )
        ));
        
        $this->add(array(
            "name"=>"isClaimsInWriting",
            "type"=>"checkbox",
            "options"=>array(
                "label"=>"Was the first intimation of a claim in writing?",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"isClaimsInWriting",
                "class" => "col-md-7 col-sm-7 col-xs-12",
            )
        ));
        
        $this->add(array(
            "name"=>"claimAmount",
            "type"=>"text",
            "options"=>array(
                "label"=>"What amount is claimed",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"claimAmount",
                "class" => "form-control col-md-7 col-sm-7 col-xs-12",
            )
        ));
        
        
        $this->add(array(
            "name"=>"amountDetails",
            "type"=>"textarea",
            "options"=>array(
                "label"=>"Claims Amount details",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"amountDetails",
                "class" => "form-control col-md-7 col-sm-7 col-xs-12",
            )
        ));
        
        $this->add(array(
            "name"=>"claimFactsNdComments",
            "type"=>"textarea",
            "options"=>array(
                "label"=>"Claims Fact and Comments",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"claimFactsNdComments",
                "class" => "form-control col-md-7 col-sm-7 col-xs-12",
            )
        ));
        $this->add(array(
            "name"=>"isActinSolicitor",
            "type"=>"checkbox",
            "options"=>array(
                "label"=>"Claimnant has acquired solicitors",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"isActinSolicitor",
                "class" => "col-md-7 col-sm-7 col-xs-12",
            )
        ));
        $this->add(array(
            "name"=>"solicitorDetails",
            "type"=>"textarea",
            "options"=>array(
                "label"=>"Solicitors Cost and Rates",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"solicitorDetails",
                "class" => "form-control col-md-7 col-sm-7 col-xs-12",
            )
        ));
    }

    public function getInputFilterSpecification()
    {

        return array(
            "solicitorDetails"=>array(
                "allow_empty"=>true,
                "required"=>FALSE
            )
        );
    }
    
    public function setEntityManager($em){
        $this->entityManager = $em;
        return $this;
    }
}

