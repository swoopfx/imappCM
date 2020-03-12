<?php
namespace Customer\View\Helper\Customer;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Use this to list the assigned brokers to this customer
 * 
 * @author otaba
 *        
 */
class AssignedBrokerListHelper extends AbstractHelper implements ServiceLocatorAwareInterface
{

    private $serviceLocator;

    public function __construct()
    {}

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

    public function __invoke($customerId)
    {
        $customerService = $this->getServiceLocator()
            ->getServicelocator()
            ->get("Customer\Service\CustomerService");
        $fra = "";
        $assignedBroker = $customerService->getAssignedBroker($customerId);
        if (count($assignedBroker) > 0) {
            foreach ($assignedBroker as $broker) {
                $fra .= $this->frame($broker);
            }
        }else{
            $fra = "<li class='media event'>
                            <a class='pull-left border-red profile_thumb'>
                              <i class='fa fa-user red'></i>
                            </a>
                            <div class='media-body'>
                              <a class='title' href=''> No Assigned Broker </a>
                              
                            </div>
                          </li>";
        }
        return $fra;
    }

    private function frame($info)
    {
        $json= json_encode(array("data"=>$info->getBrokerChildUid()));
//         $url = 
        $frame = "<li class='media event'>
                            <a class='pull-left border-green profile_thumb'>
                              <i class='fa fa-user green'></i>
                            </a>
                            <div class='media-body'>
                              <a class='title' href=''>" . $info->getFullName() . " </a><br>
<a class='btn btn-default btn-xs ajax_element' id='sendingData'
									data-href='/broker-tool/viewstaffmodal'
									data-json='{$json}'><i
										class='fa fa-eye'></i>View</a>
                              
                            </div>
                          </li>";
        return $frame;
    }
}

