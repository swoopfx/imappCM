<?php
namespace Users\Service;

/**
 *
 * @author swoopfx
 *        
 */
class UserRegisterService
{

    protected $entityManager;

    protected $options;

    public function getAgentRegisterCode()
    {}

    private function generateAgentRegsiterCode()
    {
        // TODO - use this function to generate agents registration code
        // This code would be used as a sort of identification by thesystem
        $agentCode = NULL;
        
        return $agentCode;
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
    }

    public function setOptions($op)
    {
        $this->options = $op;
    }
}

?>