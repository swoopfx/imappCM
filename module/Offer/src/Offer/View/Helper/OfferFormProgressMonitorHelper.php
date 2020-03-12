<?php
namespace Offer\View\Helper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;



/**
 *
 * @author swoopfx
 *        
 */
class OfferFormProgressMonitorHelper extends AbstractHelper implements ServiceLocatorAwareInterface
{
    
    protected $serviceLocator;
    
    protected $serviceManager;
    
    private $session;

    /**
     */
    public function __invoke($session)
    {
        /**
         * Used to check if a certain session is available
         *  which ids further used to change the colour of the progress circle 
         *  
         */
        $this->session = $session;
        $plung = array();
        $plung .= "<div id='wizard' class='form_wizard wizard_horizontal'>";
        $plung .= "<ul class='wizard_steps'>";
        $plung .= $this->firstStep();
        $plung .= $this->secoundStep();
        $plung .= $this->
        $plung .= " </ul>";
        $plung .= "</div>";
       return $plung;
    }
    private function firstStep(){
       
        $this->serviceManager = $this->getServiceLocator();
        $url = $this->serviceManager->getServiceLocator()->get('ControllerPluginManager')->get('url');
       
            $route = $url('offer/default', array('action'=>'offer-information'));
            $dat = $this->frame("Offer Information", $route);;
            
            return $dat;
            
        
        
    }
    
    private function secoundStep(){
        if ($this->session->firstStep == TRUE){
            $url = $this->serviceManager->getServiceLocator()->get('ControllerPluginManager')->get('url');
            $route = $url('offer/default', array('action'=>'offer-object'));
            $dat = $this->frame("Offer Object", $route);;
            
            return $dat;
        }
    }
    private function frame( $stepName, $route = '#'){
        $frame = "<li>
    ".$route."
    <span class='step_no'></span>
    <span class='step_descr'>
   <br />".
   $stepName."
    </span>
    </a>
    </li>";
        return $frame;
    }

    /**
     * (non-PHPdoc),,
     *
     * @see \Zend\ServiceManager\ServiceLocatorAwareInterface::getServiceLocator()
     *
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\ServiceLocatorAwareInterface::setServiceLocator()
     *
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        return $this;
    }

   
    
    

    
}

