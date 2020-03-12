<?php
namespace Customer\Service;

class CustomerPackageService
{

    private $entityManager;
    
    private $customerPackageId;

    private $absoluteValue;

    private $percentageValue;

    private $objectValue;

    private $clientGeneralService;

    private $customerPackageSession;

    private $objectTypeCategory;

    private $objectForm;
    
    private $objectEntity;

    public function getPremium()
    {}

    public function objectEntryForm()
    {
        $form = $this->objectForm;
        //var_dump($this->objectEntity);
        $form->bind($this->objectEntity);
       // var_dump($form);
        $objectTypeId = $this->objectTypeCategory;
        switch ($objectTypeId) {
            case "1": // thisd is motor
                $form->setValidationGroup(array(
                    'objectFieldset' => array(
                        "currency",
                        'value',
                        'objectType',
                        'objectMotor' => array(
                            "name",
                            'motorType',
                            "motorModel",
                            'motorValueType',
                            "motorNumber",
                            'engineNumber',
                            'chasisNumber'
                        )
                    ),
                    'csrf',
                    'reset',
                    'submit'
                ));
                break;
            
            case "2":
               // $form = NULL; // this store building form
                break;
                default:
                    break;
        }
        return $form;
    }
    
    /**
     * $tis gets the total amount of objects associated to a certain customerPackage
     * @return array
     */
    public function customerPackageObject(){
        $em = $this->entityManager;
        $data = $em->getRepository("Object\Entity\Object")->findBy(array(
            "customerPackage"=> $this->customerPackageId,
        ));
        return $data;
    }
    
    public function objectTotalValue(){
        $objectCount = count($this->customerPackageObject());
        
    }

    /**
     */
    private function getMotorObjectCount()
    {
        $objectType = $this->objectTypeCategory; // this is an integer
        $em = $this->entityManager;
        $avalaibleMotorObject = "";
    }

    private function premiumCondition()
    {
        // $val = NULL;
        // if ($valueType == "1") {
        // $val = $this->absoluteValue;
        // } elseif ($valueType == "2") {
        // $val = $this->calculatePercentilePremium ();
        // }
        // return $val;
    }

    private function calculatePercentilePremium()
    {
        $value = $this->percentageValue * $this->objectValue;
        return $value;
    }

    // public function getActivePackages(){
    // $em = $this->entityManager;
    // $data = $em->getRepository("Customer\Entity\CustomerPackage")->findBy(array(
    // 'customer'=>$this->clientGeneralService->getCustomerId(),
    // 'isActive'=>TRUE,
    // ));
    // }
    
    // Begin In House Setters wbhich is called at the controller level
    public function setObjectTypeCategory($id)
    {
        $this->objectTypeCategory = $id;
        return $this;
    }
    
    public function setCustomerPackageId($id){
        $this->customerPackageId = $id;
        return $this;
    }
    // End House setters

    
    
    // Begin factory Setters
    public function setObjectValue($val)
    {
        $this->objectValue = $val;
        return $this;
    }

    public function setCustomerPackageSession($sess)
    {
        $this->customerPackageSession = $sess;
        return $this;
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }

    public function setClientGeneralService($xserv)
    {
        $this->clientGeneralService = $xserv;
        return $this;
    }

    public function setObjectForm($form)
    {
        $this->objectForm = $form;
        return $this;
    }
    
    public function setObjectEntity($entity){
        $this->objectEntity = $entity;
        return $this;
    }
    
    // End Setter
}