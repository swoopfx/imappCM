<?php
namespace Users\Service;

/**
 *
 * @author swoopfx
 *        
 */
class AgentGeneralService
{

    private $entityManager;

    private function getAgentSetupTerms()
    {
        $agentTerm = NULL;
        /**
         * This function gets the setup terms for the agents form the database
         */
        
        return $agentTerm;
    }

    private function generateAgentCode()
    {
        
        /**
         * This function auto generates the code for the agent and its repective token
         */
        $agentConst = 'AGT';
        $agentCode = NULL;
        
        $code = md5(uniqid(mt_rand(), true));
        
        $agentCode = $agentConst . $code;
        return $agentCode;
    }
}

?>