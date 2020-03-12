<?php
namespace Claims\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Claims\Entity\ClaimsFidelityGuaratee;

class ClaimsFidelityGaurateeFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;

    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);

        $this->setObject(new ClaimsFidelityGuaratee())->setHydrator($hydrator);

        $this->add(array(
            'name' => 'claims',
            'type' => 'Claims\Form\Fieldset\ClaimsFieldset'
        ));

        $this->add(array(
            "name" => "defaultersName",
            "type" => "text",
            "options" => array(
                "label" => "Defaulters Name",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-xs-12",
                "id" => "defaultersName"
            )
        ));

        $this->add(array(
            "name" => "defaulterAddress",
            "type" => "textarea",
            "options" => array(
                "label" => "Defaulters Address",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-xs-12",
                "id" => "defaulterAddress"
            )
        ));
        $this->add(array(
            "name" => "defaulterPhone",
            "type" => "text",
            "options" => array(
                "label" => "Defaulters Phone No.",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-xs-12",
                "id" => "defaulterPhone"
            )
        ));
        $this->add(array(
            "name" => "defaultersAge",
            "type" => "number",
            "options" => array(
                "label" => "Defaulters Age",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-xs-12",
                "id" => "defaultersAge"
            )
        ));
        $this->add(array(
            "name" => "defaultDescoveryDate",
            "type" => "date",
            "options" => array(
                "label" => "Date Loss was discovered",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-xs-12",
                "id" => "defaultDescoveryDate"
            )
        ));
        $this->add(array(
            "name" => "defaultersOccupation",
            "type" => "text",
            "options" => array(
                "label" => "Defaulters Occupation",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-xs-12",
                "id" => "defaultersOccupation"
            )
        ));
        $this->add(array(
            "name" => "defaultersNextOfKin",
            "type" => "textarea",
            "options" => array(
                "label" => "Defaulters Next of kin details",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-xs-12",
                "id" => "defaultersNextOfKin"
            )
        ));

        $this->add(array(
            "name" => "defaultDurationExplanation",
            "type" => "textarea",
            "options" => array(
                "label" => "How long default been carried on and concealed?",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-xs-12",
                "id" => "defaultDurationExplanation"
            )
        ));
        $this->add(array(
            "name" => "defaultDescovery",
            "type" => "textarea",
            "options" => array(
                "label" => "What led to the discovery",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-xs-12",
                "id" => "defaultDescovery"
            )
        ));
        $this->add(array(
            "name" => "defaultAmount",
            "type" => "text",
            "options" => array(
                "label" => "Default amount ascertained",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-xs-12",
                "id" => "defaultAmount"
            )
        ));

        $this->add(array(
            "name" => "isPreviousIrregularity",
            "type" => "checkbox",
            "options" => array(
                "label" => "Has there previously been an irregularity",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-xs-12",
                "id" => "isPreviousIrregularity"
            )
        ));

        $this->add(array(
            "name" => "previousIrregularity",
            "type" => "textarea",
            "options" => array(
                "label" => "Details about previous irregularity",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-xs-12",
                "id" => "previousIrregularity"
            )
        ));

        $this->add(array(
            "name" => "lastAuditDate",
            "type" => "date",
            "options" => array(
                "label" => "Date of last audit",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-xs-12",
                "id" => "lastAuditDate"
            )
        ));
        $this->add(array(
            "name" => "otherSecurity",
            "type" => "text",
            "options" => array(
                "label" => "Other insurance policy",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-xs-12",
                "id" => "otherSecurity"
            )
        ));
        $this->add(array(
            "name" => "isDefaulterHasSalary",
            "type" => "checkbox",
            "options" => array(
                "label" => "Defaulter has salary",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-xs-12",
                "id" => "isDefaulterHasSalary"
            )
        ));

        $this->add(array(
            "name" => "defaulterSalary",
            "type" => "text",
            "options" => array(
                "label" => "Salary of defaulter",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-xs-12",
                "id" => "defaulterSalary"
            )
        ));

        $this->add(array(
            "name" => "isDefaulterOtherSecurity",
            "type" => "checkbox",
            "options" => array(
                "label" => "Defaulter has other security",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-xs-12",
                "id" => "isDefaulterOtherSecurity"
            )
        ));
        $this->add(array(
            "name" => "isDefaulterSettlement",
            "type" => "checkbox",
            "options" => array(
                "label" => "Proposal for settlement put forward",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-xs-12",
                "id" => "isDefaulterSettlement"
            )
        ));
        $this->add(array(
            "name" => "isDefaulterDischarged",
            "type" => "checkbox",
            "options" => array(
                "label" => "Defaulter has been discharged from duty",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => " col-xs-12",
                "id" => "isDefaulterDischarged"
            )
        ));
        $this->add(array(
            "name" => "dischargeDate",
            "type" => "date",
            "options" => array(
                "label" => "Date of discharge",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-xs-12",
                "id" => "dischargeDate"
            )
        ));
    }

    public function getInputFilterSpecification()
    {
        return array(
            "dischargeDate"=>array(
                "allow_empty"=>true,
                "required"=>False
            ),
            "isDefaulterDischarged"=>array(
                "allow_empty"=>true,
                "required"=>False
            ),
            "isDefaulterSettlement"=>array(
                "allow_empty"=>true,
                "required"=>False
            ),
            "isDefaulterOtherSecurity"=>array(
                "allow_empty"=>true,
                "required"=>False
            ),
            "defaulterSalary"=>array(
                "allow_empty"=>true,
                "required"=>False
            ),
            "isDefaulterHasSalary"=>array(
                "allow_empty"=>true,
                "required"=>False
            ),
            "otherSecurity"=>array(
                "allow_empty"=>true,
                "required"=>False
            ),
            "lastAuditDate"=>array(
                "allow_empty"=>true,
                "required"=>False
            ),
            "previousIrregularity"=>array(
                "allow_empty"=>true,
                "required"=>False
            ),
            "isPreviousIrregularity"=>array(
                "allow_empty"=>true,
                "required"=>False
            ),
            "defaultDescoveryDate"=>array(
                "allow_empty"=>true,
                "required"=>False
            ),
        );
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }
}

