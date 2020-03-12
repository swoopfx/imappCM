<?php
namespace IMServices\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use IMServices\Entity\DirectorsLiability;

/**
 *
 * @author otaba
 *        
 */
class DirectorsLiabilityFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;
    
   public function init(){
       $hydrator = new DoctrineObject($this->entityManager);
       $this->setHydrator($hydrator)->setObject(new DirectorsLiability());
       
//        companyStatus

//        $this->add(array(
//            'name' => 'companyStatus',
//            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
//            'options' => array(
//                'label' => 'Company',
//                'label_attributes' => array(
//                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
//                ),
//                // 'empty_option' => '--Select Cover Peril -- ',
//                'object_manager' => $this->entityManager,
//                'target_class' => 'Settings\Entity\CompanyStatusType',
//                'property' => 'type',
               
//            ),
//            'attributes' => array(
//                'id' => 'companyStatus',
//                'class' => 'form-control col-md-6 col-xs-12'
//                // 'multiple' => 'multiple'
               
//            )
//        ));
       
//        foriegnSeDetails

       $this->add(array(
           "name"=>"inBusinessDuration",
           "type"=>"text",
           "options"=>array(
               "label"=>"In Business for:",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
               )
           ),
           "attributes" => array(
               "id" => "inBusinessDuration",
               "value"=>1,
               "class" => "form-control col-md-6 col-xs-12"
           )
       ));
       
       $this->add(array(
           "name"=>"businessActivity",
           "type"=>"textarea",
           "options"=>array(
               "label"=>"Business Activity:",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
               )
           ),
           "attributes" => array(
               "id" => "businessActivity",
//                "value"=>1,

               "placeholder"=>"if applicable",
               "class" => "form-control col-md-6 col-xs-12"
           )
       ));
       
       $this->add(array(
           "name"=>"isNameChanged",
           "type"=>"checkbox",
           "options"=>array(
               "label"=>"Name of parent Company changed",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
               )
           ),
           "attributes" => array(
               "id" => "isNameChanged",
//                "value"=>1,
               "class" => "col-md-6 col-xs-12"
           )
       ));
       
       
       $this->add(array(
           "name"=>"isAcquisition",
           "type"=>"checkbox",
           "options"=>array(
               "label"=>"Merger/Acquisition took place",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
               )
           ),
           "attributes" => array(
               "id" => "isAcquisition",
//                "value"=>1,
               "class" => "col-md-6 col-xs-12"
           )
       ));
       
       
       $this->add(array(
           "name"=>"acquisitionDetails",
           "type"=>"textarea",
           "options"=>array(
               "label"=>"Acquisition Details",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
               )
           ),
           "attributes" => array(
               "id" => "acquisitionDetails",
//                "value"=>1,
               "class" => "form-control col-md-6 col-xs-12"
           )
       ));
       
       $this->add(array(
           "name"=>"isCeasedTrading",
           "type"=>"checkbox",
           "options"=>array(
               "label"=>"Has stopped trading",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
               )
           ),
           "attributes" => array(
               "id" => "isCeasedTrading",
               //                "value"=>1,
               "class" => "col-md-6 col-xs-12"
           )
       ));
       
       
       $this->add(array(
           "name"=>"isPendingMerger",
           "type"=>"checkbox",
           "options"=>array(
               "label"=>"Has pending merger/acquisition",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
               )
           ),
           "attributes" => array(
               "id" => "isPendingMerger",
//                "value"=>1,
               "class" => "col-md-6 col-xs-12"
           )
       ));
       
       
       $this->add(array(
           "name"=>"isAcquisitionProposal",
           "type"=>"checkbox",
           "options"=>array(
               "label"=>"has acquisition/merger proposal",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
               )
           ),
           "attributes" => array(
               "id" => "isAcquisitionProposal",
//                "value"=>1,
               "class" => "col-md-6 col-xs-12"
           )
       ));
       
       
       $this->add(array(
           "name"=>"isTendingNewOffering",
           "type"=>"checkbox",
           "options"=>array(
               "label"=>"Intending new public offering",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
               )
           ),
           "attributes" => array(
               "id" => "isTendingNewOffering",
               //                "value"=>1,
               "class" => "col-md-6 col-xs-12"
           )
       ));
       
       $this->add(array(
           "name"=>"companyOffering",
           "type"=>"text",
           "options"=>array(
               "label"=>"Offering Details",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
               )
           ),
           "attributes" => array(
               "id" => "companyOffering",
               //                "value"=>1,
               "class" => "form-control col-md-6 col-xs-12"
           )
       ));
       
       //companyOffering
       
       $this->add(array(
           'name' => 'companyStatus',
           'type' => 'DoctrineModule\Form\Element\ObjectSelect',
           'options' => array(
               'label' => 'Company',
               'label_attributes' => array(
                   'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
               ),
               // 'empty_option' => '--Select Cover Peril -- ',
               'object_manager' => $this->entityManager,
               'target_class' => 'Settings\Entity\CompanyStatusType',
               'property' => 'type',
               
           ),
           'attributes' => array(
               'id' => 'companyStatus',
               'class' => 'form-control col-md-6 col-xs-12'
               // 'multiple' => 'multiple'
               
           )
       ));
       
       //        
       
       $this->add(array(
           "name"=>"foriegnSeDetails",
           "type"=>"textarea",
           "options"=>array(
               "label"=>"Foriegn Stock Details",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
               )
           ),
           "attributes" => array(
               "id" => "foriegnSeDetails",
               //                "value"=>1,
               "class" => "form-control col-md-6 col-xs-12"
           )
       ));
       
       $this->add(array(
           "name"=>"totalShareHolders",
           "type"=>"text",
           "options"=>array(
               "label"=>"Total Number of Share Holders",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
               )
           ),
           "attributes" => array(
               "id" => "totalShareHolders",
               //                "value"=>1,
               "class" => "form-control col-md-6 col-xs-12"
           )
       ));
       
       
       $this->add(array(
           "name"=>"totalSharesIssued",
           "type"=>"text",
           "options"=>array(
               "label"=>"Total Shares Issued",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
               )
           ),
           "attributes" => array(
               "id" => "totalSharesIssued",
               //                "value"=>1,
               "class" => "form-control col-md-6 col-xs-12"
           )
       ));
       
       
       $this->add(array(
           "name"=>"totalDirectorShares",
           "type"=>"text",
           "options"=>array(
               "label"=>"Total Number of Directors shares",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
               )
           ),
           "attributes" => array(
               "id" => "totalDirectorShares",
               //                "value"=>1,
               "class" => "form-control col-md-6 col-xs-12"
           )
       ));
       
       //
       
       $this->add(array(
           "name"=>"isDirectorLiability",
           "type"=>"checkbox",
           "options"=>array(
               "label"=>"Company had Director liability",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
               )
           ),
           "attributes" => array(
               "id" => "isDirectorLiability",
               //                "value"=>1,
               "class" => "col-md-6 col-xs-12"
           )
       ));
       
       
       $this->add(array(
           'name' => 'insurer',
           'type' => 'DoctrineModule\Form\Element\ObjectSelect',
           'options' => array(
               'label' => 'Insurer',
               'label_attributes' => array(
                   'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
               ),
               // 'empty_option' => '--Select Cover Peril -- ',
               'object_manager' => $this->entityManager,
               'target_class' => 'Settings\Entity\Insurer',
               'property' => 'insuranceName',
               
           ),
           'attributes' => array(
               'id' => 'insurer',
               'class' => 'form-control col-md-6 col-xs-12'
               // 'multiple' => 'multiple'
               
           )
       ));
       
       //
       
       
       $this->add(array(
           "name"=>"indemnityLimit",
           "type"=>"text",
           "options"=>array(
               "label"=>"Indemnity Limit",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
               )
           ),
           "attributes" => array(
               "id" => "indemnityLimit",
               //                "value"=>1,
               "class" => "form-control col-md-6 col-xs-12"
           )
       ));
       
       $this->add(array(
           "name"=>"expiryDate",
           "type"=>"date",
           "options"=>array(
               "label"=>"Expiry Date",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
               )
           ),
           "attributes" => array(
               "id" => "expiryDate",
               //                "value"=>1,
               "class" => "form-control col-md-6 col-xs-12"
           )
       ));
       
       $this->add(array(
           "name"=>"isDecline",
           "type"=>"checkbox",
           "options"=>array(
               "label"=>"Previously Decline",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
               )
           ),
           "attributes" => array(
               "id" => "isDecline",
               "class" => "col-md-6 col-xs-12"
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
           "attributes" => array(
               "id" => "declineDetails",
               //                "value"=>1,
               "class" => "form-control col-md-6 col-xs-12"
           )
       ));
       
       $this->add(array(
           "name"=>"isDirectorResign",
           "type"=>"checkbox",
           "options"=>array(
               "label"=>"Director Previously Resigned",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
               )
           ),
           "attributes" => array(
               "id" => "isDirectorResign",
               //                "value"=>1,
               "class" => "col-md-6 col-xs-12"
           )
       ));
       
       $this->add(array(
           "name"=>"resignDetails",
           "type"=>"textarea",
           "options"=>array(
               "label"=>"Resign Details",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
               )
           ),
           "attributes" => array(
               "id" => "resignDetails",
               //                "value"=>1,
               "class" => "form-control col-md-6 col-xs-12"
           )
       ));
       
       $this->add(array(
           "name"=>"isClaims",
           "type"=>"checkbox",
           "options"=>array(
               "label"=>"Previously had claims",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
               )
           ),
           "attributes" => array(
               "id" => "isClaims",
               //                "value"=>1,
               "class" => "col-md-6 col-xs-12"
           )
       ));
       //
       
       
       $this->add(array(
           "name"=>"claimsDetails",
           "type"=>"textarea",
           "options"=>array(
               "label"=>"Claims Details",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
               )
           ),
           "attributes" => array(
               "id" => "claimsDetails",
               //                "value"=>1,
               "class" => "form-control col-md-6 col-xs-12"
           )
       ));
       
       //
       $this->add(array(
           "name"=>"isEmploymentPracticeCover",
           "type"=>"checkbox",
           "options"=>array(
               "label"=>"Require Employment Practices Liability Cover",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
               )
           ),
           "attributes" => array(
               "id" => "isEmploymentPracticeCover",
               //                "value"=>1,
               "class" => "col-md-6 col-xs-12"
           )
       ));
       
       $this->add(array(
           "name"=>"isHumanResourceDept",
           "type"=>"checkbox",
           "options"=>array(
               "label"=>"Company has Human Resource Dept.",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
               )
           ),
           "attributes" => array(
               "id" => "isHumanResourceDept",
               //                "value"=>1,
               "class" => "col-md-6 col-xs-12"
           )
       ));
       
       
       $this->add(array(
           "name"=>"deptNumberOfEmployee",
           "type"=>"text",
           "options"=>array(
               "label"=>"Dept. Number of emplayees",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
               )
           ),
           "attributes" => array(
               "id" => "deptNumberOfEmployee",
               //                "value"=>1,
               "class" => "form-control col-md-6 col-xs-12"
           )
       ));
       
//        $this->add(array(
//            "name"=>"hrFunctionHandled",
//            "type"=>"textarea",
//            "options"=>array(
//                "label"=>"How HR function is handled",
//                "label_attributes"=>array(
//                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
//                )
//            ),
//            "attributes" => array(
//                "id" => "hrFunctionHandled",
//                //                "value"=>1,
//                "class" => "form-control col-md-6 col-xs-12"
//            )
//        ));
       
       
       $this->add(array(
           "name"=>"hrFunctionHandled",
           "type"=>"textarea",
           "options"=>array(
               "label"=>"How HR function is handled",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
               )
           ),
           "attributes" => array(
               "id" => "hrFunctionHandled",
               //                "value"=>1,
               "class" => "form-control col-md-6 col-xs-12"
           )
       ));
       
       $this->add(array(
           "name"=>"sackedEmployees",
           "type"=>"text",
           "options"=>array(
               "label"=>"No. of Sacked Employee",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
               )
           ),
           "attributes" => array(
               "id" => "sackedEmployees",
               //                "value"=>1,
               "class" => "form-control col-md-6 col-xs-12"
           )
       ));
       
       $this->add(array(
           "name"=>"sackedOfficers",
           "type"=>"text",
           "options"=>array(
               "label"=>"No. of Sacked Officers",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
               )
           ),
           "attributes" => array(
               "id" => "sackedOfficers",
               //                "value"=>1,
               "class" => "form-control col-md-6 col-xs-12"
           )
       ));
       
       
       $this->add(array(
           "name"=>"isHRManual",
           "type"=>"checkbox",
           "options"=>array(
               "label"=>"Company has HR manual",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
               )
           ),
           "attributes" => array(
               "id" => "isHRManual",
               //                "value"=>1,
               "class" => "col-md-6 col-xs-12"
           )
       ));
       
       
       $this->add(array(
           "name"=>"otherCompanyStatus",
           "type"=>"text",
           "options"=>array(
               "label"=>"Other Company Status",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
               )
           ),
           "attributes" => array(
               "id" => "otherCompanyStatus",
               //                "value"=>1,
               "class" => "form-control col-md-6 col-xs-12"
           )
       ));
       
       $this->add(array(
           'name' => 'procedureList',
           'type' => 'DoctrineModule\Form\Element\ObjectSelect',
           'options' => array(
               'label' => 'Available Procedure',
               'label_attributes' => array(
                   'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
               ),
               // 'empty_option' => '--Select Cover Peril -- ',
               'object_manager' => $this->entityManager,
               'target_class' => 'Settings\Entity\DirectorLiabilityProcedureList',
               'property' => 'type',
              
           ),
           'attributes' => array(
               'id' => 'procedureList',
               'class' => 'form-control col-md-6 col-xs-12',
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
            "procedureList"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "otherCompanyStatus"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            
            "isHRManual"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "sackedOfficers"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "sackedEmployees"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "hrFunctionHandled"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "deptNumberOfEmployee"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "isHumanResourceDept"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "isEmploymentPracticeCover"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "claimsDetails"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "isClaims"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "resignDetails"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "isDirectorResign"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "declineDetails"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "isDecline"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "expiryDate"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "indemnityLimit"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            
            "insurer"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "isDirectorLiability"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),"totalDirectorShares"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "totalSharesIssued"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "totalShareHolders"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "foriegnSeDetails"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "companyStatus"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "companyOffering"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "isTendingNewOffering"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "isAcquisitionProposal"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "isPendingMerger"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "isCeasedTrading"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "acquisitionDetails"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "isAcquisition"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "isNameChanged"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "businessActivity"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "inBusinessDuration"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
        );
    }
    
    public function setEntityManager($em){
        $this->entityManager = $em;
        return  $this;
    }
}

