<?php
namespace IMServices\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use IMServices\Entity\AviationInsurance;

/**
 *
 * @author otaba
 *        
 */
class AviationInsuranceFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;

    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setObject(new AviationInsurance())->setHydrator($hydrator);
        $this->addFields();
    }

    private function addFields()
    {
        $this->add(array(
            "name" => "aircraftUsage",
            "type" => "textarea",
            "options" => array(
                "label" => "AirCraft Usage",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-xs-12",
                "id" => "aircraft_usage"
            
            )
        ));
        
        $this->add(array(
            'name' => 'geographicalOperation',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Geographical Operation',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\TravelRegion',
                // 'empty_option' => '-- Select a Proposed Insurer --',
                'property' => 'region'
            
            ),
            'attributes' => array(
                // 'id' => 'service-type',
                'class' => 'form-control'
            )
        ));
        
        $this->add(array(
            "name" => "airlineBackground",
            "type" => "textarea",
            "options" => array(
                "label" => "Airline Background",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-xs-12",
                "id" => "airline_background"
            
            )
        ));
        
        $this->add(array(
            "name" => "aircraftMakeNType",
            "type" => "text",
            "options" => array(
                "label" => "Aircraft Make/Type",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-xs-12",
                "id" => "aircraft_capacity"
            
            )
        ));
        
        $this->add(array(
            "name" => "constructionYear",
            "type" => "text",
            "options" => array(
                "label" => "Construction Year",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-xs-12",
                "id" => "construction_year"
            
            )
        ));
        
        $this->add(array(
            "name" => "serialNumber",
            "type" => "text",
            "options" => array(
                "label" => "Serial Number",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-xs-12",
                "id" => "serialNumber"
            
            )
        ));
        
        $this->add(array(
            "name" => "isRegularMaintenance",
            "type" => "checkbox",
            "options" => array(
                "label" => "Performs Regular Maintenance",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isRegularMaintenance"
            
            )
        ));
        
        $this->add(array(
            "name" => "isRegularlyHangered",
            "type" => "checkbox",
            "options" => array(
                "label" => "Is Kept in Hanger",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isRegularlyHangered"
            
            )
        ));
        
        $this->add(array(
            "name" => "hangeredLocation",
            "type" => "text",
            "options" => array(
                "label" => "Hanger Location",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-xs-12",
                "id" => "hangeredLocation"
            
            )
        ));
        
        $this->add(array(
            "name" => "maintenanceBy",
            "type" => "text",
            "options" => array(
                "label" => "Maintenance By",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-xs-12",
                "id" => "maintenanceBy"
            
            )
        ));
        
        $this->add(array(
            "name" => "lastMaintenanceDate",
            "type" => "date",
            "options" => array(
                "label" => "Last Maintenance",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-xs-12",
                "id" => "lastMaintenanceDate"
            
            )
        ));
        
        $this->add(array(
            "name" => "isMaintenanceIncludeEngine",
            "type" => "checkbox",
            "options" => array(
                "label" => "Include Engine Maintenace",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isMaintenanceIncludeEngine"
            
            )
        ));
        
        // $this->add(array(
        // "name" => "agreedHullValue",
        // "type" => "text",
        // "options" => array(
        // "label" => "Agreed Hull Value",
        // "label_attributes" => array(
        // "class" => "control-label col-md-3 col-sm-3 col-xs-12"
        // )
        // ),
        // "attributes" => array(
        // "class" => "form-control col-md-7 col-xs-12",
        // "id" => "agreedHullValue"
        
        // )
        // ));
        
        $this->add(array(
            "name" => "isLien",
            "type" => "checkbox",
            "options" => array(
                "label" => "Is Lien/Mortgage",
//                 'unchecked_value' => false,
//                 'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isLien",
                "checked" => false
            )
        ));
        
        $this->add(array(
            "name" => "lienAmount",
            "type" => "text",
            "options" => array(
                "label" => "Lien Amount",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-xs-12",
                "id" => "lien_amount"
            
            )
        ));
        
        $this->add(array(
            "name" => "lienHolder",
            "type" => "text",
            "options" => array(
                "label" => "Lien Holder",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-xs-12",
                "id" => "lien_holder"
            
            )
        ));
        
        $this->add(array(
            "name" => "agreedHullValue",
            "type" => "text",
            "options" => array(
                "label" => "Agreed Hull Value",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-xs-12",
                "id" => "agreedHullValue"
            
            )
        ));
        
        $this->add(array(
            "name" => "annualUtilization",
            "type" => "text",
            "options" => array(
                "label" => "Annual Utilization",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-xs-12",
                "id" => "annual_utilization"
            
            )
        ));
        
        $this->add(array(
            "name" => "coveredPersons",
            "type" => "textarea",
            "options" => array(
                "label" => "Covered Persons",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-xs-12",
                "id" => "covered_persons",
                "placeholder" => "Steve Monte, Kule Filat"
            
            )
        ));
        
        $this->add(array(
            "name" => "isCertificateOfAirWorthiness",
            "type" => "checkbox",
            "options" => array(
                "label" => "Has Certificate Of Worthiness",
                
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "is_certificate_of_worthiness",
                "checked" => true
            )
        ));
        
        $this->add(array(
            "name" => "isIncludeRisk",
            "type" => "checkbox",
            "options" => array(
                "label" => "Include Risk",
                
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isIncludeRisk"
                // "checked" => true
            )
        ));
        
        $this->add(array(
            "name" => "isIncludeFlightRisk",
            "type" => "checkbox",
            "options" => array(
                "label" => "Include Flight Risk",
                
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isIncludeFlightRisk"
                // "checked" => true
            )
        ));
        
        $this->add(array(
            "name" => "isIncludeTaxiRisk",
            "type" => "checkbox",
            "options" => array(
                "label" => "Include Taxi Risk",
                
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isIncludeTaxiRisk"
                // "checked" => true
            )
        ));
        
        $this->add(array(
            "name" => "isIncludeGroundRisk",
            "type" => "checkbox",
            "options" => array(
                "label" => "Include Ground Risk",
                
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isIncludeGroundRisk"
                // "checked" => true
            )
        ));
        
        $this->add(array(
            "name" => "isMotoringRisk",
            "type" => "checkbox",
            "options" => array(
                "label" => "Include Motoring Risk",
                
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isMotoringRisk"
                // "checked" => true
            )
        ));
        
        $this->add(array(
            "name" => "isIndemnityLimit",
            "type" => "checkbox",
            "options" => array(
                "label" => "Has Indemnity Limit",
                
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isIndemnityLimit"
                // "checked" => true
            )
        ));
        
        $this->add(array(
            "name" => "indemnityLimit",
            "type" => "text",
            "options" => array(
                "label" => "Indemnity Limit",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-xs-12",
                "id" => "indemnityLimit"
            
            )
        ));
        
        $this->add(array(
            "name" => "indemnityLimitOnePassenger",
            "type" => "text",
            "options" => array(
                "label" => "Indemnity Limit any One Passenger",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-xs-12",
                "id" => "indemnityLimitOnePassenger"
            
            )
        ));
        
        $this->add(array(
            "name" => "indemnityLimitOneAccident",
            "type" => "text",
            "options" => array(
                "label" => "Indemnity Limit any One Accident",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-xs-12",
                "id" => "indemnityLimitOneAccident"
            
            )
        ));
        
        $this->add(array(
            "name" => "isPreviousInsurer",
            "type" => "checkbox",
            "options" => array(
                "label" => "Has Previous Insurer",
                
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isPreviousInsurer"
                // "checked" => true
            )
        ));
        
        $this->add(array(
            "name" => "isPreviousDecline",
            "type" => "checkbox",
            "options" => array(
                "label" => "Was Declined",
                
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isPreviousDecline"
                // "checked" => true
            )
        ));
        
        $this->add(array(
            "name" => "isPreviousCancel",
            "type" => "checkbox",
            "options" => array(
                "label" => "Was Cancelled",
                
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isPreviousCancel"
                // "checked" => true
            )
        ));
        // isPreviousCancel
        
        // TODO include hte road worthiness here
        
        // $this->add(array(
        // "name"=>"certificate",
        // "type"=>"file",
        // "options"=>array(
        // "label"=>"Certificate Of Worthiness",
        // "label_attributes"=>array(
        // "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
        // )
        // ),
        // "attributes"=>array(
        // "class"=>"form-control col-md-7 col-xs-12",
        // "id"=>"certificate_doc",
        
        // )
        // ));
        
        $this->add(array(
            "name" => "declineReason",
            "type" => "text",
            "options" => array(
                "label" => "Decline Reason",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-xs-12",
                "id" => "declineReason"
            
            )
        ));
        
        $this->add(array(
            "name" => "cancelReason",
            "type" => "text",
            "options" => array(
                "label" => "Cancel Reason",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-xs-12",
                "id" => "cancelReason"
            
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
            "cancelReason" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "declineReason" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "isPreviousCancel" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "isPreviousDecline" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "isPreviousInsurer" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "indemnityLimitOneAccident" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "indemnityLimitOnePassenger" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "indemnityLimit" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "isMotoringRisk" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "isIncludeGroundRisk" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "isIncludeTaxiRisk" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "isIncludeTaxiRisk" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "isIncludeFlightRisk" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "isIncludeRisk" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "isCertificateOfAirWorthiness" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "coveredPersons" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "annualUtilization" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "agreedHullValue" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "lienHolder" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "lienAmount" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "isLien" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "isMaintenanceIncludeEngine" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "lastMaintenanceDate" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "maintenanceBy" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "hangeredLocation" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "isRegularlyHangered" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "isRegularMaintenance" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "serialNumber" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "aircraftUsage" => array(
                "allow_empty" => true,
                "required" => false
            ),
            
            "geographicalOperation" => array(
                "allow_empty" => true,
                "required" => false
            ),
            
            "airlineBackground" => array(
                "allow_empty" => true,
                "required" => false
            ),
            
            "aircraftMakeNType" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "constructionYear" => array(
                "allow_empty" => true,
                "required" => false
            )
        
        );
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }
}

