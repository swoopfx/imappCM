<?php
namespace Users\Service;

/**
 *
 * @author swoopfx
 *        
 */
class UserProfileService
{

    const USER_AGENT = "Insurance Agent";

    const USER_BROKER = "Insurance Broker";

    const USER_INDIVIDUAL = "Individual";

    const USER_ORGANISATION = "Organisation";

    protected $entitymanager;

    /**
     * This hold the auth level of the user
     * 
     * @var unknown
     */
    protected $auth;

    /**
     * This holds the value of the user role
     * 
     * @var unknown
     */
    protected $userRole;

    /**
     * This holds the user identity value
     * 
     * @var unknown
     */
    protected $userId;

    protected function setBrokerProfile()
    {
        // TODO - use this to display profile form for the broker
    }

    protected function setAgentProfile()
    {
        // TODO - use this to display profile for the agent
    }

    protected function setIndividualProfile()
    {
        // TODO - use this to display and process form for the individual profile
    /**
     * If the user is logged in successfulle
     * get the user role from the users profile
     * If the us
     */
    }

    protected function setCompanyProfile()
    {
        // TODO - use this to display and process the organisations profile
    }

    public function runCondition()
    {
        /**
         * This function checks the profile status of the user
         * Checks f the isProfiled varpiable is true
         * If the varible is true
         */
        /**
         * TODO - Upon successful completioon of the user profile
         * This functions reload or redirect the login page
         * To make sure
         */
        if ($this->userRole == 20) {
            // Do something
        } 

        else 
            if ($this->userRole == 30) {
                // Do something
            } 

            elseif ($this->userRole == 40) {}
    }

    public function setAuth($auth)
    {
        $this->auth = $auth;
    }

    public function setEntityManager($em)
    {
        $this->entitymanager = $em;
    }
}

?>