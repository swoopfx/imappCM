<?php
namespace Help\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use WasabiLib\Ajax\Response;

/**
 *
 * @author otaba
 *        
 */
class HelpBrokerTool extends AbstractActionController
{

    // TODO - Insert your code here
    
    /**
     */
    public function __construct()
    {
        
        // TODO - Insert your code here
    }
    
    /**
     * This function is modal
     * It displays information about the`addstaff form
     * once the info link is clicked 
     * a modal information box displays
     */
    public function addstaffinfoAction(){
        $response = new Response();
        return $this->getResponse()->setContent($response);
        
    }
}

