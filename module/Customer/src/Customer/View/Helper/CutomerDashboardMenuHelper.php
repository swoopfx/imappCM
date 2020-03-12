<?php
namespace Customer\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 *
 * @author swoopfx
 *        
 */
class CutomerDashboardMenuHelper extends AbstractHelper implements ServiceLocatorAwareInterface
{
    
    private $serviceLocator;
    
    
    
    public function getServiceLocator(){
        
    }
    
    public function setServicelocator(ServiceLocatorInterface $serviceLocator){
        $this->serviceLocator = $serviceLocator;
        return $this;
    }

    public function __invoke()
    {
        
        return $this->frame();
       
        
    }

    private function frame()
    {
        $url = $this->getServiceLocator()
        ->getServiceLocator()
        ->get("ViewHelperManager")
        ->get("url");
        $frame = "<div class='panel panel-default' data-toggle='panel-collapse' data-open='true'>
            <div class='panel-heading panel-collapse-trigger'>
              <h4 class='panel-title'>Board Menu</h4>
            </div>
            <div class='panel-body list-group'>
              <ul class='list-group list-group-menu'>
                <li class='list-group-item active'><a class='link-text-color' href='".$url("board")."'>Dashboard</a></li>
                <li class='list-group-item'><a class='link-text-color' href='".$url("cus_policy")."'>My Policy</a></li>
                <li class='list-group-item'><a class='link-text-color' href='".$url("cus_offer")."'>My Offer</a></li>
                <li class='list-group-item'><a class='link-text-color' href='website-student-messages.html'>Proposals</a></li>
            <li class='list-group-item'><a class='link-text-color' href='website-student-messages.html'>Broker Packages</a></li>
            <li class='list-group-item'><a class='link-text-color' href='website-student-messages.html'>Transactions</a></li>
                <li class='list-group-item'><a class='link-text-color' href='login.html'><span>Logout</span></a></li>
              </ul>
            </div>
          </div>";
        return $frame;
    }
}

