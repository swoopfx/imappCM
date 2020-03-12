<?php
namespace IMServices\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use IMServices\Entity\WorkmenCompensation;

/**
 *
 * @author otaba
 *        
 */
class WorkmenCompensationFieldset extends Fieldset implements InputFilterProviderInterface
{
    
    private $entityManager;

   public function init(){
       
       $hydrator = new DoctrineObject($this->entityManager);
       $this->setHydrator($hydrator)->setObject(new WorkmenCompensation());
       
       $this->add(array(
           "name"=>"total12monthwages",
           "type"=>"text",
           "options"=>array(
               "label"=>"Total Annual Wages",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-4 col-sm-4 col-xs-12",
               )
           ),
           "attributes"=>array(
               "id"=>"total12monthwages",
               "class"=>"form-control col-md-6 col-sm-6 col-xs-12",
//                ""
           )
       ));
       
       $this->add(array(
           "name"=>"isMedicalIndemnity",
           "type"=>"checkbox",
           "options"=>array(
               "label"=>"Include medical expenses indemnity",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-4 col-sm-4 col-xs-12",
               )
           ),
           "attributes"=>array(
               "id"=>"isMedicalIndemnity",
               "class"=>"col-md-4"
               //                ""
           )
       ));
       
       $this->add(array(
           "name"=>"isInsureSubContractor",
           "type"=>"checkbox",
           "options"=>array(
               "label"=>"Provide insurance for sub contractors",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-4 col-sm-4 col-xs-12",
               )
           ),
           "attributes"=>array(
               "id"=>"isInsureSubContractor",
               "class"=>"col-md-4",
               //                ""
           )
       ));
       
       $this->add(array(
           "name"=>"total12monthSubContractorwages",
           "type"=>"text",
           "options"=>array(
               "label"=>"Annual wages for sub contractors",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-4 col-sm-4 col-xs-12",
               )
           ),
           "attributes"=>array(
               "id"=>"total12monthSubContractorwages",
               "class"=>"form-control",
               //                ""
           )
       ));
       
       $this->add(array(
           "name"=>"totalProvisionalAnnualPremium",
           "type"=>"text",
           "options"=>array(
               "label"=>"Total Provisiional annual premium",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-4 col-sm-4 col-xs-12",
               )
           ),
           "attributes"=>array(
               "id"=>"totalProvisionalAnnualPremium",
               "class"=>"form-control",
               //                ""
           )
       ));
       
       $this->add(array(
           "name"=>"isAllPersonsInservice",
           "type"=>"checkbox",
           "options"=>array(
               "label"=>"Cover all person in service",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-4 col-sm-4 col-xs-12",
               )
           ),
           "attributes"=>array(
               "id"=>"isAllPersonsInservice",
               "class"=>"col-md-4",
               //                ""
           )
       ));
       
       $this->add(array(
           "name"=>"isAllSubContractors",
           "type"=>"checkbox",
           "options"=>array(
               "label"=>"Cover all Sub contrators",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-4 col-sm-4 col-xs-12",
               )
           ),
           "attributes"=>array(
               "id"=>"isAllSubContractors",
               "class"=>"col-md-4",
               //                ""
           )
       ));
       
       $this->add(array(
           "name"=>"isMaintenanceRegulation",
           "type"=>"checkbox",
           "options"=>array(
               "label"=>"Premises meet maintenance regulation",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-4 col-sm-4 col-xs-12",
               )
           ),
           "attributes"=>array(
               "id"=>"isMaintenanceRegulation",
               "class"=>"col-md-4",
               //                ""
           )
       ));
       
       $this->add(array(
           "name"=>"regulation",
           "type"=>"textarea",
           "options"=>array(
               "label"=>"The regulation",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-4 col-sm-4 col-xs-12",
               )
           ),
           "attributes"=>array(
               "id"=>"regulation",
               "class"=>"form-control",
               //                ""
           )
       ));
       
       $this->add(array(
           "name"=>"isCarriedOutObligation",
           "type"=>"checkbox",
           "options"=>array(
               "label"=>"Carried out decree regulation",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-4 col-sm-4 col-xs-12",
               )
           ),
           "attributes"=>array(
               "id"=>"isCarriedOutObligation",
               "class"=>"col-md-4",
               //                ""
           )
       ));
       
       $this->add(array(
           "name"=>"isFenceMachine",
           "type"=>"checkbox",
           "options"=>array(
               "label"=>"Machine are fenced and good condition",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-4 col-sm-4 col-xs-12",
               )
           ),
           "attributes"=>array(
               "id"=>"isFenceMachine",
               "class"=>"col-md-4",
               //                ""
           )
       ));
       
      
       
       $this->add(array(
           "name"=>"isBoilers",
           "type"=>"checkbox",
           "options"=>array(
               "label"=>"Has Boilers ",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-4 col-sm-4 col-xs-12",
               )
           ),
           "attributes"=>array(
               "id"=>"isBoilers",
               "class"=>"col-md-4",
               //                ""
           )
       ));
       
       $this->add(array(
           "name"=>"boilerDetails",
           "type"=>"textarea",
           "options"=>array(
               "label"=>"Boiler Details",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-4 col-sm-4 col-xs-12",
               )
           ),
           "attributes"=>array(
               "id"=>"boilerDetails",
               "class"=>"form-control",
               //                ""
           )
       ));
       
       $this->add(array(
           "name"=>"isSaw",
           "type"=>"checkbox",
           "options"=>array(
               "label"=>"Contains circular saws or other machinery driven by steam, gas",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-4 col-sm-4 col-xs-12",
               )
           ),
           "attributes"=>array(
               "id"=>"isSaw",
               "class"=>"col-md-4",
               //                ""
           )
       ));
       
       
       $this->add(array(
           "name"=>"sawDetails",
           "type"=>"textarea",
           "options"=>array(
               "label"=>"Give particulars of any circular saws or other machinery",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-4 col-sm-4 col-xs-12",
               )
           ),
           "attributes"=>array(
               "id"=>"sawDetails",
               "class"=>"form-control",
               //                ""
           )
       ));
       
       $this->add(array(
           "name"=>"isAcidExplosiveMaterials",
           "type"=>"checkbox",
           "options"=>array(
               "label"=>"Contains acids, gases, chemicals explosive or fissionable materials",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-4 col-sm-4 col-xs-12",
               )
           ),
           "attributes"=>array(
               "id"=>"isAcidExplosiveMaterials",
               "class"=>"col-md-4",
               //                ""
           )
       ));
       
       
       $this->add(array(
           "name"=>"acidDetails",
           "type"=>"textarea",
           "options"=>array(
               "label"=>"Give particulars acids, gases, chemicals explosive or fissionable materials",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-4 col-sm-4 col-xs-12",
               )
           ),
           "attributes"=>array(
               "id"=>"acidDetails",
               "class"=>"form-control",
               //                ""
           )
       ));
       
       $this->add(array(
           "name"=>"isPreviouslyInsured",
           "type"=>"checkbox",
           "options"=>array(
               "label"=>"Is previously insured ",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-4 col-sm-4 col-xs-12",
               )
           ),
           "attributes"=>array(
               "id"=>"isPreviouslyInsured",
               "class"=>"col-md-4",
               //                ""
           )
       ));
       
       $this->add(array(
           "name"=>"isPreviousDecline",
           "type"=>"checkbox",
           "options"=>array(
               "label"=>"Was previously declined by insurer ",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-4 col-sm-4 col-xs-12",
               )
           ),
           "attributes"=>array(
               "id"=>"isPreviousDecline",
               "class"=>"col-md-4",
               //                ""
           )
       ));
       
       $this->add(array(
           "name"=>"isSpecialTerms",
           "type"=>"checkbox",
           "options"=>array(
               "label"=>"Insurer required special terms",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-4 col-sm-4 col-xs-12",
               )
           ),
           "attributes"=>array(
               "id"=>"isSpecialTerms",
               "class"=>"col-md-4",
               //                ""
           )
       ));
       
       $this->add(array(
           "name"=>"isPreviousClaims",
           "type"=>"checkbox",
           "options"=>array(
               "label"=>"Had claims in past 5 years",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-4 col-sm-4 col-xs-12",
               )
           ),
           "attributes"=>array(
               "id"=>"isPreviousClaims",
               "class"=>"col-md-4",
               //                ""
           )
       ));
       
       
       $this->add(array(
           "name"=>"claimsDetails",
           "type"=>"textarea",
           "options"=>array(
               "label"=>"Details about previous claims",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-4 col-sm-4 col-xs-12",
               )
           ),
           "attributes"=>array(
               "id"=>"claimsDetails",
               "class"=>" form-control col-md-4",
               //                ""
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
           
            "isCarriedOutObligation"=>array(
                "allow_empty"=>true,
                "required"=>FALSE,
            ),
            
            "regulation"=>array(
                "allow_empty"=>true,
                "required"=>FALSE,
            ),
            
            "isMaintenanceRegulation"=>array(
                "allow_empty"=>true,
                "required"=>FALSE,
            ),
            
            "isAllSubContractors"=>array(
                "allow_empty"=>true,
                "required"=>FALSE,
            ),
            
            "isAllPersonsInservice"=>array(
                "allow_empty"=>true,
                "required"=>FALSE,
            ),
            
            "totalProvisionalAnnualPremium"=>array(
                "allow_empty"=>true,
                "required"=>FALSE,
            ),
            
            "isInsureSubContractor"=>array(
                "allow_empty"=>true,
                "required"=>FALSE,
            ),
            
            "total12monthwages"=>array(
                "allow_empty"=>true,
                "required"=>FALSE,
            ),
            
            "boilerDetails"=>array(
                "allow_empty"=>true,
                "required"=>FALSE,
            ),
            
            "isBoilers"=>array(
                "allow_empty"=>true,
                "required"=>FALSE,
            ),
            
            "sawDetails"=>array(
                "allow_empty"=>true,
                "required"=>FALSE,
            ),
            
            "isSaw"=>array(
                "allow_empty"=>true,
                "required"=>FALSE,
            ),
            
            "isAcidExplosiveMaterials"=>array(
                "allow_empty"=>true,
                "required"=>FALSE,
            ),
            
            "acidDetails"=>array(
                "allow_empty"=>true,
                "required"=>FALSE,
            ),
            
            "isPreviouslyInsured"=>array(
                "allow_empty"=>true,
                "required"=>FALSE,
            ),
            
            "isPreviousDecline"=>array(
                "allow_empty"=>true,
                "required"=>FALSE,
            ),
            
            "isSpecialTerms"=>array(
                "allow_empty"=>true,
                "required"=>FALSE,
            ),
            
            "isPreviousClaims"=>array(
                "allow_empty"=>true,
                "required"=>FALSE,
            ),
            
            "claimsDetails"=>array(
                "allow_empty"=>true,
                "required"=>FALSE,
            ),
            
            "isFenceMachine"=>array(
                "allow_empty"=>true,
                "required"=>FALSE,
            ),
            "total12monthSubContractorwages"=>array(
                "allow_empty"=>true,
                "required"=>FALSE,
            ),
            
            
        );
    }
    /**
     * @param field_type $entityManager
     */
    public function setEntityManager($entityManager)
    {
        $this->entityManager = $entityManager;
        return $this;
    }

}

