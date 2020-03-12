<?php
namespace Settings\Service;

/**
 *
 * @author swoopfx
 *        
 */
class SettingsService
{
    
    const BROKER_ACTIVATION_CONTRACT = 100;
    
    const BROKER_ACTIVATION_COMMISION = 10;

    const TERMS_BROKER_SETUP = 5;

    const TERMS_AGENT_SETUP = 4;

    const TERMS_PACKAGE_TERMS = 3;

    const TERMS_PAYMENT_TERMS = 2;

    const TERMS_USER_REGISTER = 1;
    
    const NOTIFICATION_TYPE_MANUAL_PAYMENT_PROCESS = 1;
    
    const SEX_MALE = 1;
    
    const SEX_FEMALE = 2;

    private $entityManager;

    public function hydrateRenewAccount()
    {
        // this provides the hydration of the renewal of the account
    }

    public function accountRenewalStatus()
    {
        // this sets the start duration of the subscription
        // equivocally sets the end duration / date of the renewal subscriptuin
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }
}

