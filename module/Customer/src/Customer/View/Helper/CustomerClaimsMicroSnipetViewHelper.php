<?php
namespace Customer\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorAwareInterface;

/**
 *
 * @author swoopfx
 *        
 */
class CustomerClaimsMicroSnipetViewHelper extends AbstractHelper implements ServiceLocatorAwareInterface
{
    
    private $serviceLocator;

   public function __invoke($setled, $claimsId){
       return $this->frame($setled, $claimsId);
   }
   
   private function frame($settled, $id){
       $isSettled = "green";
       $unSettled = "red";
       $url = $this->getServiceLocator()->getServiceLocator()->get('ViewHelperManager')->get('url');
       $frame = "<li class='media event'>
                            <a class='pull-left border-".($settled == True? $isSettled : $unSettled)." profile_thumb'>
                              <i class='fa fa-user ".($settled == True? $isSettled : $unSettled)." '></i>
                            </a>
                            <div class='media-body'>
                              <a class='title' href='".$url('claims')."'>Ms. Mary Jane</a>
                              <p><strong>$2300. </strong> Agent Avarage Sales </p>
                              <p> <small>12 Sales Today</small>
                              </p>
                            </div>
                          </li>";
       
       return $frame;
   }
/**
     * {@inheritDoc}
     * @see \Zend\ServiceManager\ServiceLocatorAwareInterface::setServiceLocator()
     */
    public function setServiceLocator(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        return $this;
        
    }

/**
     * {@inheritDoc}
     * @see \Zend\ServiceManager\ServiceLocatorAwareInterface::getServiceLocator()
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
        
    }

   
}

