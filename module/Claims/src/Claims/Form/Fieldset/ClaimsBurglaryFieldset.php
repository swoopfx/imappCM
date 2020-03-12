<?php
namespace Claims\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Claims\Entity\ClaimsBuglary;

class ClaimsBurglaryFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;

    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setObject(new ClaimsBuglary())->setHydrator($hydrator);

        $this->add(array(
            'name' => 'claims',
            'type' => 'Claims\Form\Fieldset\ClaimsFieldset'
        ));

        $this->add(array(
            "name" => "theftDate",
            "type" => "date",
            "options" => array(
                "label" => "Date of Loss",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "theftDate",
                "class" => "form-control col-xs-12",
                "required" => "required"
            )
        ));

        $this->add(array(
            "name" => "theftEntryDesc",
            "type" => "textarea",
            "options" => array(
                "label" => "A brief description of theft",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "theftEntryDesc",
                "class" => "form-control col-xs-12"
                // "required"=>"required",
            )
        ));

        $this->add(array(
            "name" => "theftSuspect",
            "type" => "text",
            "options" => array(
                "label" => "Theft suspect",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "theftSuspect",
                "class" => "form-control col-xs-12"
                // "required"=>"required",
            )
        ));

        $this->add(array(
            "name" => "dateTheftDiscovered",
            "type" => "date",
            "options" => array(
                "label" => "Date Loss was discovered",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "dateTheftDiscovered",
                "class" => "form-control col-xs-12"
                // "required"=>"required",
            )
        ));

        $this->add(array(
            "name" => "datePoliceNotify",
            "type" => "date",
            "options" => array(
                "label" => "Date police was notified",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "datePoliceNotify",
                "class" => "form-control col-xs-12"
                // "required"=>"required",
            )
        ));

        $this->add(array(
            "name" => "stationPoliceNotify",
            "type" => "text",
            "options" => array(
                "label" => "Station notified (Location)",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "stationPoliceNotify",
                "class" => "form-control col-xs-12"
                // "required"=>"required",
            )
        ));

        $this->add(array(
            "name" => "isOccupiedAtBurglary",
            "type" => "checkbox",
            "options" => array(
                "label" => "Was building occupied during burglary",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "isOccupiedAtBurglary",
                "class" => "col-xs-12"
                // "required"=>"required",
            )
        ));

        $this->add(array(
            "name" => "unOccupiedDuration",
            "type" => "text",
            "options" => array(
                "label" => "Amount in days building is left unoccupied",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "unOccupiedDuration",
                "class" => "form-control col-xs-12"
                // "required"=>"required",
            )
        ));

        $this->add(array(
            "name" => "isAvailableSecurity",
            "type" => "checkbox",
            "options" => array(
                "label" => "Premises has security",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "isAvailableSecurity",
                "class" => "col-xs-12"
                // "required"=>"required",
            )
        ));

        $this->add(array(
            "name" => "securityType",
            "type" => "text",
            "options" => array(
                "label" => "Type of security available",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "securityType",
                "class" => "form-control col-xs-12",
                "placeholder" => "watchman, CCTV"
                // "required"=>"required",
            )
        ));

        $this->add(array(
            "name" => "isPreviousLoss",
            "type" => "checkbox",
            "options" => array(
                "label" => "Has previously had loss",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "isPreviousLoss",
                "class" => " col-xs-12"
                // "placeholder"=>"watchman, CCTV"
                // "required"=>"required",
            )
        ));

        $this->add(array(
            "name" => "previousLoss",
            "type" => "textarea",
            "options" => array(
                "label" => "Details about previous loss",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "previousLoss",
                "class" => "form-control col-xs-12"
                // "placeholder"=>"watchman, CCTV"
                // "required"=>"required",
            )
        ));
    }

    public function getInputFilterSpecification()
    {
        return array(
            "previousLoss" => array(
                "allow_emtpty" => true,
                "required" => False
            ),
            "isPreviousLoss" => array(
                "allow_emtpty" => true,
                "required" => False
            ),
            "securityType" => array(
                "allow_emtpty" => true,
                "required" => False
            ),
            "isAvailableSecurity" => array(
                "allow_emtpty" => true,
                "required" => False
            ),
            "unOccupiedDuration" => array(
                "allow_emtpty" => true,
                "required" => False
            ),
            "isOccupiedAtBurglary" => array(
                "allow_emtpty" => true,
                "required" => False
            ),

            "stationPoliceNotify" => array(
                "allow_emtpty" => true,
                "required" => False
            ),
            "datePoliceNotify" => array(
                "allow_emtpty" => true,
                "required" => False
            ),
            "dateTheftDiscovered" => array(
                "allow_emtpty" => true,
                "required" => False
            ),
            "theftSuspect" => array(
                "allow_emtpty" => true,
                "required" => False
            ),
            "theftEntryDesc" => array(
                "allow_emtpty" => true,
                "required" => False
            ),
            "theftDate" => array(
                "allow_emtpty" => true,
                "required"=>False
            ),
        );
    }

    /**
     *
     * @return mixed
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }

    /**
     *
     * @param mixed $entityManager
     */
    public function setEntityManager($entityManager)
    {
        $this->entityManager = $entityManager;
        return $this;
    }
}

