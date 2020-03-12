<?php
namespace Claims\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Claims\Entity\ClaimsContractAllRisk;

class ClaimsContractorAllRiskFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;
    
   
    public function init(){
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setHydrator($hydrator)->setObject(new ClaimsContractAllRisk());
        
        $this->add(array(
            'name' => 'claims',
            'type' => 'Claims\Form\Fieldset\ClaimsFieldset'
        ));

        $this->add(array(
            "name"=>"lossDate",
            "type"=>"date",
            "options"=>array(
                "label"=>"Date of Loss",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"lossDate",
                "class"=>"form-control col-md-6 col-sm-6 col-xs-12",
            )
        ));
        
        $this->add(array(
            "name"=>"locationOfLoss",
            "type"=>"text",
            "options"=>array(
                "label"=>"Location of Loss",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"locationOfLoss",
                "class"=>"form-control col-md-8 col-sm-8 col-xs-12",
            )
        ));
        
        $this->add(array(
            "name"=>"lossCircumstances",
            "type"=>"textarea",
            "options"=>array(
                "label"=>"Circumstances Behind loss",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"lossCircumstances",
                "class"=>"form-control col-md-8 col-sm-8 col-xs-12",
            )
        ));
        
        $this->add(array(
            "name"=>"isSuspiciousDamage",
            "type"=>"checkbox",
            "options"=>array(
                "label"=>"Damage is suspicious",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"isSuspiciousDamage",
                "class"=>"col-xs-12",
            )
        ));
        $this->add(array(
            "name"=>"suspeciousDetails",
            "type"=>"textarea",
            "options"=>array(
                "label"=>"Suspecion Details",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"suspeciousDetails",
                "class"=>"form-control col-md-8 col-sm-8 col-xs-12",
            )
        ));
        
        $this->add(array(
            "name"=>"isLossByTheft",
            "type"=>"checkbox",
            "options"=>array(
                "label"=>"Loss is by theft",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"isLossByTheft",
                "class"=>" col-xs-12",
            )
        ));
        
        $this->add(array(
            "name"=>"isPoliceNotified",
            "type"=>"checkbox",
            "options"=>array(
                "label"=>"Police is notified",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"isPoliceNotified",
                "class"=>"col-xs-12",
            )
        ));
        
        $this->add(array(
            "name"=>"policeDetails",
            "type"=>"textarea",
            "options"=>array(
                "label"=>"Police Details",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"policeDetails",
                "class"=>"form-control col-xs-12",
            )
        ));
        
//         $this->add(array(
//             "name"=>"lossDate",
//             "type"=>"date",
//             "options"=>array(
//                 "label"=>"Date of Loss",
//                 "label_attributes" => array(
//                     "label" => "control-label col-md-3 col-sm-3 col-xs-12"
//                 )
//             ),
//             "attributes"=>array(
//                 "id"=>"lossDate",
//                 "label"=>"form-control col-xs-12",
//             )
//         ));
        
//         $this->add(array(
//             "name"=>"lossDate",
//             "type"=>"date",
//             "options"=>array(
//                 "label"=>"Date of Loss",
//                 "label_attributes" => array(
//                     "label" => "control-label col-md-3 col-sm-3 col-xs-12"
//                 )
//             ),
//             "attributes"=>array(
//                 "id"=>"lossDate",
//                 "label"=>"form-control col-xs-12",
//             )
//         ));
        
//         $this->add(array(
//             "name"=>"lossDate",
//             "type"=>"date",
//             "options"=>array(
//                 "label"=>"Date of Loss",
//                 "label_attributes" => array(
//                     "label" => "control-label col-md-3 col-sm-3 col-xs-12"
//                 )
//             ),
//             "attributes"=>array(
//                 "id"=>"lossDate",
//                 "label"=>"form-control col-xs-12",
//             )
//         ));
        
//         $this->add(array(
//             "name"=>"lossDate",
//             "type"=>"date",
//             "options"=>array(
//                 "label"=>"Date of Loss",
//                 "label_attributes" => array(
//                     "label" => "control-label col-md-3 col-sm-3 col-xs-12"
//                 )
//             ),
//             "attributes"=>array(
//                 "id"=>"lossDate",
//                 "label"=>"form-control col-xs-12",
//             )
//         ));
        
//         $this->add(array(
//             "name"=>"lossDate",
//             "type"=>"date",
//             "options"=>array(
//                 "label"=>"Date of Loss",
//                 "label_attributes" => array(
//                     "label" => "control-label col-md-3 col-sm-3 col-xs-12"
//                 )
//             ),
//             "attributes"=>array(
//                 "id"=>"lossDate",
//                 "label"=>"form-control col-xs-12",
//             )
//         ));
        
//         $this->add(array(
//             "name"=>"lossDate",
//             "type"=>"date",
//             "options"=>array(
//                 "label"=>"Date of Loss",
//                 "label_attributes" => array(
//                     "label" => "control-label col-md-3 col-sm-3 col-xs-12"
//                 )
//             ),
//             "attributes"=>array(
//                 "id"=>"lossDate",
//                 "label"=>"form-control col-xs-12",
//             )
//         ));
        
//         $this->add(array(
//             "name"=>"lossDate",
//             "type"=>"date",
//             "options"=>array(
//                 "label"=>"Date of Loss",
//                 "label_attributes" => array(
//                     "label" => "control-label col-md-3 col-sm-3 col-xs-12"
//                 )
//             ),
//             "attributes"=>array(
//                 "id"=>"lossDate",
//                 "label"=>"form-control col-xs-12",
//             )
//         ));
        
//         $this->add(array(
//             "name"=>"lossDate",
//             "type"=>"date",
//             "options"=>array(
//                 "label"=>"Date of Loss",
//                 "label_attributes" => array(
//                     "label" => "control-label col-md-3 col-sm-3 col-xs-12"
//                 )
//             ),
//             "attributes"=>array(
//                 "id"=>"lossDate",
//                 "label"=>"form-control col-xs-12",
//             )
//         ));
        
//         $this->add(array(
//             "name"=>"lossDate",
//             "type"=>"date",
//             "options"=>array(
//                 "label"=>"Date of Loss",
//                 "label_attributes" => array(
//                     "label" => "control-label col-md-3 col-sm-3 col-xs-12"
//                 )
//             ),
//             "attributes"=>array(
//                 "id"=>"lossDate",
//                 "label"=>"form-control col-xs-12",
//             )
//         ));
        
//         $this->add(array(
//             "name"=>"lossDate",
//             "type"=>"date",
//             "options"=>array(
//                 "label"=>"Date of Loss",
//                 "label_attributes" => array(
//                     "label" => "control-label col-md-3 col-sm-3 col-xs-12"
//                 )
//             ),
//             "attributes"=>array(
//                 "id"=>"lossDate",
//                 "label"=>"form-control col-xs-12",
//             )
//         ));
        
//         $this->add(array(
//             "name"=>"lossDate",
//             "type"=>"date",
//             "options"=>array(
//                 "label"=>"Date of Loss",
//                 "label_attributes" => array(
//                     "label" => "control-label col-md-3 col-sm-3 col-xs-12"
//                 )
//             ),
//             "attributes"=>array(
//                 "id"=>"lossDate",
//                 "class"=>"form-control col-xs-12",
//             )
//         ));
        
//         $this->add(array(
//             "name"=>"lossDate",
//             "type"=>"date",
//             "options"=>array(
//                 "label"=>"Date of Loss",
//                 "label_attributes" => array(
//                     "label" => "control-label col-md-3 col-sm-3 col-xs-12"
//                 )
//             ),
//             "attributes"=>array(
//                 "id"=>"lossDate",
//                 "class"=>"form-control col-xs-12",
//             )
//         ));
    }

    public function getInputFilterSpecification()
    {

        return array();
    }
    /**
     * @return mixed
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }

    /**
     * @param mixed $entityManager
     */
    public function setEntityManager($entityManager)
    {
        $this->entityManager = $entityManager;
        return $this;
    }

}

