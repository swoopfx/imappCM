<?php
namespace Customer\View\Helper\Board;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 *
 * @author otaba
 *        
 */
class BoardCustomerAccountOfficerHelper extends AbstractHelper implements ServiceLocatorAwareInterface
{

    private $serviceLocator;

    /**
     */
    public function __construct()
    {
        
        // TODO - Insert your code here
    }

    /**
     * (non-PHPdoc)
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

    public function __invoke()
    {
        $customerBoardService = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("Customer\Service\CustomerBoardService");
        $brokers = $customerBoardService->assignedChildBroker();
        return "<div class='item col-xs-12 col-lg-12'>
              <div class='panel panel-default paper-shadow' data-z='0.5'>
                <div class='panel-heading'>
                  <h6>My Account Managers</h6>
                  
                </div>
                <ul class='list-group'>" . $this->frame($brokers) . "
            
            
            
                </ul>
            
              </div>
            </div>";
    }

    private function frame($entity)
    {
        $frame = "";
        if (count($entity) > 0) {
            foreach ($entity as $child) {
                $frame .= "<li class='list-group-item media v-middle'>
                    <div class='media-body'>
                      <a href='#' class='text-subhead list-group-link'><strong>" . $child->getFullName() . "</strong></a><br>
                       <em>" . $child->getUser()->getUsername() . "</em><br>

<em>" . $child->getUser()->getEmail() . "</em><br>
                    </div>
                    
                  </li>";
            }
        } else {
            return "No Account manager Assigned";
        }
        return $frame;
    }
}

