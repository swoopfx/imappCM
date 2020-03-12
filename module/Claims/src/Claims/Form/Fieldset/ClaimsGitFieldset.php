<?php
namespace Claims\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Claims\Entity\ClaimsGit;

/**
 *
 * @author otaba
 *        
 */
class ClaimsGitFieldset extends Fieldset implements InputFilterProviderInterface
{
    private $entityManager;

   public function init(){
       $hydrator = new DoctrineObject($this->entityManager);
       $this->setObject(new ClaimsGit())->setHydrator($hydrator);
       
       $this->add(array(
           'name' => 'claims',
           'type' => 'Claims\Form\Fieldset\ClaimsFieldset'
       ));
       
       $this->add(array(
           "name"=>"damageDate",
           "type"=>"date",
           "options"=>array(
               "label"=>"Date of Loss",
               "label_attributes" => array(
                   "class" => "control-label col-md-3 col-sm-3 col-xs-12"
               )
           ),
           "attributes"=>array(
               "class"=>"form-control col-xs-12",
               "id"=>"damageDate",
//                "value"=>date()
           )
       ));
       
//        $this->add(array(
//            "name"=>"lossNotificationDate",
//            "type"=>"date",
//            "options"=>array(
//                "label"=>"Damage Notification Date",
//                "label_attributes" => array(
//                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
//                )
//            ),
//            "attributes"=>array(
//                "class"=>"form-control col-xs-12",
//                "id"=>"lossNotificationDate",
// //                "value"=>date()
//            )
//        ));
       
       $this->add(array(
           "name"=>"deliveryDate",
           "type"=>"date",
           "options"=>array(
               "label"=>"Proposed Goods Delivery Date",
               "label_attributes" => array(
                   "class" => "control-label col-md-3 col-sm-3 col-xs-12"
               )
           ),
           "attributes"=>array(
               "class"=>"form-control col-xs-12",
               "id"=>"deliveryDate",
               //                "value"=>date()
           )
       ));
       
       
       $this->add(array(
           "name"=>"goodsFrom",
           "type"=>"text",
           "options"=>array(
               "label"=>"Goods Coming from ",
               "label_attributes" => array(
                   "class" => "control-label col-md-3 col-sm-3 col-xs-12"
               )
           ),
           "attributes"=>array(
               "class"=>"form-control col-xs-12",
               "id"=>"goodsFrom",
               //                "value"=>date()
           )
       ));
       
       
       $this->add(array(
           "name"=>"goodsTo",
           "type"=>"text",
           "options"=>array(
               "label"=>"Goods Going to ",
               "label_attributes" => array(
                   "class" => "control-label col-md-3 col-sm-3 col-xs-12"
               )
           ),
           "attributes"=>array(
               "class"=>"form-control col-xs-12",
               "id"=>"goodsTo",
               //                "value"=>date()
           )
       ));
       
       $this->add(array(
           "name"=>"driverName",
           "type"=>"text",
           "options"=>array(
               "label"=>"Driver Name",
               "label_attributes" => array(
                   "class" => "control-label col-md-3 col-sm-3 col-xs-12"
               )
           ),
           "attributes"=>array(
               "class"=>"form-control col-xs-12",
               "id"=>"driverName",
               //                "value"=>date()
           )
       ));
       
       
       $this->add(array(
           "name"=>"driverContactDetails",
           "type"=>"textarea",
           "options"=>array(
               "label"=>"Driver Contact Details",
               "label_attributes" => array(
                   "class" => "control-label col-md-3 col-sm-3 col-xs-12"
               )
           ),
           "attributes"=>array(
               "class"=>"form-control col-xs-12",
               "id"=>"driverContactDetails",
               //                "value"=>date()
           )
       ));
       
       
       
       $this->add(array(
           "name"=>"goodsTotalValue",
           "type"=>"text",
           "options"=>array(
               "label"=>"Total Value of Goods",
               "label_attributes" => array(
                   "class" => "control-label col-md-3 col-sm-3 col-xs-12"
               )
           ),
           "attributes"=>array(
               "class"=>"form-control col-xs-12",
               "id"=>"goodsTotalValue",
               //                "value"=>date()
           )
       ));
       
       $this->add(array(
           "name"=>"vehicleRegMark",
           "type"=>"text",
           "options"=>array(
               "label"=>"Distinct mark on vehicle",
               "label_attributes" => array(
                   "class" => "control-label col-md-3 col-sm-3 col-xs-12"
               )
           ),
           "attributes"=>array(
               "class"=>"form-control col-xs-12",
               "id"=>"vehicleRegMark",
               //                "value"=>date()
           )
       ));
       
       
       $this->add(array(
           "name"=>"isReceiptIssued",
           "type"=>"checkbox",
           "options"=>array(
               "label"=>"Way Bill/ Receipt Issued",
               "label_attributes" => array(
                   "class" => "control-label col-md-3 col-sm-3 col-xs-12"
               )
           ),
           "attributes"=>array(
               "class"=>"col-xs-12",
               "id"=>"isReceiptIssued",
               //                "value"=>date()
           )
       ));
       
       $this->add(array(
           "name"=>"goodsInspectionLocation",
           "type"=>"text",
           "options"=>array(
               "label"=>"Location of goods last inspection",
               "label_attributes" => array(
                   "class" => "control-label col-md-3 col-sm-3 col-xs-12"
               )
           ),
           "attributes"=>array(
               "class"=>"form-control col-xs-12",
               "id"=>"goodsInspectionLocation",
               //                "value"=>date()
           )
       ));
       
       $this->add(array(
           "name"=>"isAccompaniedInTransit",
           "type"=>"checkbox",
           "options"=>array(
               "label"=>"Goods is accompanied",
               "label_attributes" => array(
                   "class" => "control-label col-md-3 col-sm-3 col-xs-12"
               )
           ),
           "attributes"=>array(
               "class"=>"col-xs-12",
               "id"=>"isAccompaniedInTransit",
               //                "value"=>date()
           )
       ));
       
       $this->add(array(
           "name"=>"accompaniedByWhom",
           "type"=>"text",
           "options"=>array(
               "label"=>"Accompanied By",
               "label_attributes" => array(
                   "class" => "control-label col-md-3 col-sm-3 col-xs-12"
               )
           ),
           "attributes"=>array(
               "class"=>"form-control col-xs-12",
               "id"=>"accompaniedByWhom",
               //                "value"=>date()
           )
       ));
       
       
       $this->add(array(
           "name"=>"isTheftSuspection",
           "type"=>"checkbox",
           "options"=>array(
               "label"=>"There is a theft suspect",
               "label_attributes" => array(
                   "class" => "control-label col-md-3 col-sm-3 col-xs-12"
               )
           ),
           "attributes"=>array(
               "class"=>"col-xs-12",
               "id"=>"isTheftSuspection",
               //                "value"=>date()
           )
       ));
       
       $this->add(array(
           "name"=>"suspectDetails",
           "type"=>"textarea",
           "options"=>array(
               "label"=>"Suspect Details",
               "label_attributes" => array(
                   "class" => "control-label col-md-3 col-sm-3 col-xs-12"
               )
           ),
           "attributes"=>array(
               "class"=>"form-control col-xs-12",
               "id"=>"suspectDetails",
               //                "value"=>date()
           )
       ));
       
       
       
       $this->add(array(
           "name"=>"isPreviousClaims",
           "type"=>"checkbox",
           "options"=>array(
               "label"=>"Has previously had claims",
               "label_attributes" => array(
                   "class" => "control-label col-md-3 col-sm-3 col-xs-12"
               )
           ),
           "attributes"=>array(
               "class"=>"col-xs-12",
               "id"=>"isPreviousClaims",
               //                "value"=>date()
           )
       ));
       
       
//        $this->add(array(
//            "name"=>"suspectDetails",
//            "type"=>"textarea",
//            "options"=>array(
//                "label"=>"Suspect Details",
//                "label_attributes" => array(
//                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
//                )
//            ),
//            "attributes"=>array(
//                "class"=>"form-control col-xs-12",
//                "id"=>"suspectDetails",
//                //                "value"=>date()
//            )
//        ));
       
      
       
       $this->add(array(
           "name"=>"isPoliceNotified",
           "type"=>"checkbox",
           "options"=>array(
               "label"=>"Police is Notified",
               "label_attributes" => array(
                   "class" => "control-label col-md-3 col-sm-3 col-xs-12"
               )
           ),
           "attributes"=>array(
               "class"=>"col-xs-12",
               "id"=>"isPoliceNotified",
               //                "value"=>date()
           )
       ));
       
       $this->add(array(
           "name"=>"datePoliceNotified",
           "type"=>"date",
           "options"=>array(
               "label"=>"Date Police was Notified",
               "label_attributes" => array(
                   "class" => "control-label col-md-3 col-sm-3 col-xs-12"
               )
           ),
           "attributes"=>array(
               "class"=>"form-control col-xs-12",
               "id"=>"datePoliceNotified",
               //                "value"=>date()
           )
       ));
       
       $this->add(array(
           "name"=>"isAlternativePolicy",
           "type"=>"checkbox",
           "options"=>array(
               "label"=>"Other effective policies over the property concerned",
               "label_attributes" => array(
                   "class" => "control-label col-md-3 col-sm-3 col-xs-12"
               )
           ),
           "attributes"=>array(
               "class"=>"col-xs-12",
               "id"=>"isAlternativePolicy",
               //                "value"=>date()
           )
       ));
       
       $this->add(array(
           "name"=>"alternativePolicy",
           "type"=>"text",
           "options"=>array(
               "label"=>"Other Policy",
               "label_attributes" => array(
                   "class" => "control-label col-md-3 col-sm-3 col-xs-12"
               )
           ),
           "attributes"=>array(
               "class"=>"form-control col-xs-12",
               "id"=>"alternativePolicy",
               //                "value"=>date()
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
    /**
     * @param object $entityManager
     */
    public function setEntityManager($entityManager)
    {
        $this->entityManager = $entityManager;
        return $this;
    }

}

