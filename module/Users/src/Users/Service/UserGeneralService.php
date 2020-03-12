<?php
namespace Users\Service;

/**
 * Use this class to determine the sertup of the accout
 * 
 * @author swoopfx
 *        
 */
class UserGeneralService
{

    private $entityManager;

    /**
     * This defines if the category is either agent or Broker
     * 
     * @var unknown
     */
    private $userCat;

    public function __construct()
    {}

    public function runSetUp()
    {}

    private function displaTerms()
    {
        $repo = $this->entityManager->getRepository('Settings\Entity\Terms')->find(1);
        // get terms acceptance checkbox form form feild
        return null;
    }

    private function verifyCompany()
    {
    /**
     */
    }

    private function setUpProfile()
    {
        $profileForm = null;
        /**
         * Get Profile form
         * Get company name
         * get company address
         * get companyphone numbers
         * get company profile
         * get company brief description
         */
        return $profileForm;
    }

    private function finalSetup()
    {
    /**
     * This contains the preview and final submit button
     */
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
    }
}

?>