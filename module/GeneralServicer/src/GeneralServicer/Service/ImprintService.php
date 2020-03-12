<?php
namespace GeneralServicer\Service;

use CsnUser\Entity\Role;
use CsnUser\Service\UserService;

/**
 * This application is used to get imprint
 * for the web layout
 *
 * @author swoopfx
 *        
 */
class ImprintService
{

    private $entitmanager;

    private $logo;

    private $name;

    private $userId;

    private $basePath;

    private $profiled;

    private $centralBrokerId;

    private $generalServie;

    /**
     * This is used to get the role of the user
     * IF the user is a specific role select information from the related part
     *
     * @var Role
     */
    private $roleId;

    public function __construct()
    {
        $this->name = 'IMAPP';
    }

    public function imprintLogo()
    {
        /**
         * If brokers session is set
         * get brokers logo from the datase and set it as the imprint
         * else display IMAPP imprint
         */
//         $basePath = $this->basePath;
//         $logo = $basePath('images/img.jpg'); // $this->basePath('images/img.jpg');
        
        return $logo;
    }

    public function imprintName()
    {
        $brokerName = NULL;
        $generalService = $this->generalServie;
        $name = $this->entitmanager->getRepository('Users\Entity\IndividualInfo')->findOneBy(array(
            'user' => $this->userId
        ));
        
        if ($this->userId != NULL && $this->profiled != False) {
            switch ($this->roleId) {
                case UserService::USER_ROLE_BROKER:
                case UserService::USER_ROLE_SETUP_BROKER:
                    $brokerName = $this->getBrokerName();
                    break;
                
                case UserService::USER_ROLE_BROKER_CHILD:
                    $brokerName = $this->getMotherBrokerName();
                    break;
                default:
                    $brokerName = "Unprofile User";
                    break;
            }
            
            // $brokerName = $generalService->UseCaseConditionFunction($this->getBrokerName(), $this->getMotherBrokerName());
        } else {
            $brokerName = "Unprofiled User";
        }
        /**
         * if user is logged in
         * get UserRole
         * If User Role is 300 get Broker name
         *
         * else if it is 200 get Agent Name
         *
         *
         * else show unprfiled user
         */
        
        // if ($name != NULL) {
        // // $nam = array();
        // // $nam[0]= $name->getFirstname();
        // $nam = $name->getLastName() . ' ' . $name->getFirstname();
        // return $nam;
        // } else {
        // return 'Unprofiled User';
        // }
        
        /**
         * If broker session is set
         * get Brokers Name from Database and set it as the imprint Name
         * E.g Welcome to hilltop Insurance Brokers Portal
         */
        
        return $brokerName;
    }

    private function getBrokerName()
    {
        $em = $this->entitmanager;
        $name = $em->getRepository('Users\Entity\InsuranceBrokerRegistered')->findOneBy(array(
            'user' => $this->userId
        ));
        
        return $name->getIdInduranceBoker()->getCompanyName();
    }

    private function getMotherBrokerName()
    {
        $em = $this->entitmanager;
        $name = $em->find('Users\Entity\InsuranceBrokerRegistered', $this->centralBrokerId);
        //var_dump($name->getCompanyName());
        return $name->getCompanyName();
    }

    // Begin setters
    public function setEnetityManager($em)
    {
        $this->entitmanager = $em;
        return $this;
    }

    public function setUserId($user)
    {
        $this->userId = $user;
        
        return $this;
    }

    public function setRole($role)
    {
        $this->roleId = $role;
        
        return $this;
    }

    public function setbasePath($basePath)
    {
        $this->basePath = $basePath;
        
        return $this;
    }

    public function setIsProfiled($bool)
    {
        $this->profiled = $bool;
        return $this;
    }

    public function setCentralBrokerId($id)
    {
        $this->centralBrokerId = $id;
        return $this;
    }

    public function setGeneralService($xserv)
    {
        $this->generalServie = $xserv;
        return $this;
    }
    
    // End Setters
}

?>