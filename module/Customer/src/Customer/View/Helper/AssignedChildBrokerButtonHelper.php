<?php
namespace Customer\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorAwareInterface;

/**
 *
 * @author swoopfx
 *        
 */
class AssignedChildBrokerButtonHelper extends AbstractHelper implements ServiceLocatorAwareInterface
{

    private $serviceLocator;

    public function __invoke($customerId)
    {
        return $this->frame($customerId);
    }

    private function frame($customerId)
    {
        $in = $this->getServiceLocator()
            ->getServiceLocator()
            ->get('Customer\Service\CustomerService');
        
            $info = $in->getCustomerAssginedChildBroker($customerId);
//             var_dump($info);
        $frame = "<div class='btn-group'>
                      <button type='button' class='btn btn-default btn-xs'>Assigned Brokers</button>
                      <button type='button' class='btn btn-default btn-xs dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>
                        <span class='caret'></span>
                        <span class='sr-only'>Toggle Dropdown</span>
                      </button>
                      <ul class='dropdown-menu' role='menu'>
                        " . $this->listee($info) . "
                      </ul>
                    </div><br><br>";
        
        return $frame;
    }

    private function listee($info)
    {
        if ($info != NULL) {
            $der = "";
            $link = ""; // link to proofile of the child broker
            
            foreach ($info as $in) {
                foreach ($in->getBrokerChild() as $inf) {
                    $json= "'data':'.$info->getBrokerChildUid().'";
                    $der .= "<li><a href='#'>" . $inf->getFullName() . "</a>
                        </li>
 <li> <a class='btn btn-default btn-xs ajax_element' id='sendingData'
									data-href='viewstaffmodal'
									data-json='{$json}'><i
										class='fa fa-eye'></i>View</a>  </li>
               ";
                }
            }
            return $der;
        } else {
            return "<li><a href='#'>No Staff Assigned </a>
                        </li>
                ";
        }
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Zend\ServiceManager\ServiceLocatorAwareInterface::setServiceLocator()
     */
    public function setServiceLocator(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        return $this;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Zend\ServiceManager\ServiceLocatorAwareInterface::getServiceLocator()
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }
}

