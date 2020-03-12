<?php
namespace Claims\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Claims\Entity\ClaimsMotorAccident;

/**
 *
 * @author otaba
 *        
 */
class ClaimsMotorAccidentFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;

    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setHydrator($hydrator)->setObject(new ClaimsMotorAccident());
        $this->addFields();
    }

    private function addFields()
    {
        $this->add(array(
            'name' => 'claims',
            'type' => 'Claims\Form\Fieldset\ClaimsFieldset'
            // 'options'=>array(
            // 'use_as_base_fieldset'=>true
            // ),
        ));
        $this->add(array(
            "name" => "driverDetails",
            "type" => "Claims\Form\Fieldset\ClaimsDriverDetailsFieldset"
        ));

        $this->add(array(
            "name" => "witness1",
            "type" => "text",
            "options" => array(
                "label" => "First Witness",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "witness1",
                "class" => "form-control col-xs-12",
                "placholder" => "Segun ChukwuEmeka"
            )
        ));

        $this->add(array(
            "name" => "witness2",
            "type" => "text",
            "options" => array(
                "label" => "Second Witness",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "witness2",
                "class" => "form-control col-xs-12",
                "placholder" => "Hamza"
            )
        ));

        $this->add(array(
            "name" => "witness2Address",
            "type" => "text",
            "options" => array(
                "label" => "Second Witness Address",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "witness2Address",
                "class" => "form-control col-xs-12",
                "placholder" => "Hamza"
            )
        ));

        $this->add(array(
            "name" => "witness1Phone",
            "type" => "text",
            "options" => array(
                "label" => "First Witness Phone No.",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "witness1Phone",
                "class" => "form-control col-xs-12",
                "placholder" => "0809192929292"
            )
        ));

        $this->add(array(
            "name" => "witness1Address",
            "type" => "text",
            "options" => array(
                "label" => "First Witness Address.",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "witness1Address",
                "class" => "form-control col-xs-12",
                "placholder" => " No 2 Olugegun Close Ikeja Lagos "
            )
        ));

        $this->add(array(
            "name" => "damageDetails",
            "type" => "textarea",
            "options" => array(
                "label" => "Details on damage.",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "damageDetails",
                "class" => "form-control col-xs-12",
                "placholder" => " No 2 Olugegun Close Ikeja Lagos "
            )
        ));

        $this->add(array(
            "name" => "repairEstimate",
            "type" => "text",
            "options" => array(
                "label" => "Estimated repair",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "repairEstimate",
                "class" => "form-control col-xs-12",
                "placholder" => "N500000",
                "required" => "required"
            )
        ));

        // $this->add(array(
        // "name" => "repairEstimate",
        // "type" => "text",
        // "options" => array(
        // "label" => "Estimated repair",
        // "label_attributes" => array(
        // "class" => "control-label col-md-3 col-sm-3 col-xs-12"
        // )
        // ),
        // "attributes" => array(
        // "id" => "",
        // "class" => "form-control col-xs-12",
        // "placholder" => "N500000"
        // )
        // ));

        $this->add(array(
            "name" => "repairerName",
            "type" => "text",
            "options" => array(
                "label" => "Name of Repairer",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "repairerName",
                "class" => "form-control col-xs-12",
                "placholder" => "Kola Folawiyo"
            )
        ));

        $this->add(array(
            "name" => "repairerPhone",
            "type" => "text",
            "options" => array(
                "label" => "Repairer Phone ",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "repairerPhone",
                "class" => "form-control col-xs-12"
                // "placholder" => "N500000"
            )
        ));

        $this->add(array(
            "name" => "repairerAddress",
            "type" => "text",
            "options" => array(
                "label" => "Address of Repairer",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "repairerAddress",
                "class" => "form-control col-xs-12"
                // "placholder" => "N500000"
            )
        ));

        $this->add(array(
            "name" => "motorLocation",
            "type" => "text",
            "options" => array(
                "label" => "Motor Present Location",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "motorLocation",
                "class" => "form-control col-xs-12"
                // "placholder" => "N500000"
            )
        ));

        // $this->add(array(
        // "name" => "thirdpartyDetails",
        // "type" => "text",
        // "options" => array(
        // "label" => "Address of Repairer",
        // "label_attributes" => array(
        // "class" => "control-label col-md-3 col-sm-3 col-xs-12"
        // )
        // ),
        // "attributes" => array(
        // "id" => "thirdpartyDetails",
        // "class" => "form-control col-xs-12"
        // // "placholder" => "N500000"
        // )
        // ));
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
            // "thirdpartyDetails" => array(
            // "allow_empty" => true,
            // "required" => false
            // ),
            "motorLocation" => array(
                "allow_empty" => true,
                "required" => false
            ),

            "repairerAddress" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "repairerPhone" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "repairerName" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "repairEstimate" => array(
                "allow_empty" => false,
                "required" => true
            ),
            "damageDetails" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "witness1Address" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "witness1Phone" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "witness2Address" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "witness2" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "witness1" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "claims" => array(
                "allow_empty" => true,
                "required" => FALSE
            )
        );
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }
}

