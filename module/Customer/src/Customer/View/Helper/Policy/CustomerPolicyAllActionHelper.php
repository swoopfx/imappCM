<?php
namespace Customer\View\Helper\Policy;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;
use Policy\Service\PolicyService;

/**
 *
 * @author otaba
 *        
 */
class CustomerPolicyAllActionHelper extends AbstractHelper implements ServiceLocatorAwareInterface
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

    public function __invoke($policyEntity)
    {
        $url = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("ViewHelperManager")
            ->get("url");
        
        $policyStatus = $policyEntity->getPolicyStatus();
        switch ($policyStatus->getId()) {
            case PolicyService::POLICY_STATUS_INACTIVE:
                return "<a class='btn btn-success btn-xs' style='width: 100%' href='" . $url('cus_policy/default', array(
                    'action' => 'pre-renew',
                    'id' => $policyEntity->getId
                )) . "'>Renew Policy</a>"; // return renew button
                break;
            
            case PolicyService::POLICY_STATUS_ISSUED_AND_VALID:
                
                /**
                 * TODO If the number of days is less than 30 show renew button
                 * 
                 */
                $json = json_encode(array(
                'data'=>$policyEntity->getId()
                ));
                $claismButton = "<a href=''>Lay Claims</a>";
                $viewButton = "<a style='width:100%' class='btn btn-primary btn-xs' href='".$url("cus_policy/default", array("action"=>"view", "id"=>$policyEntity->getPolicyUid()))."'>View Policy</a>";
                $renewButton = "<a  id='sending_data_button' class='btn btn-success btn-xs ajax_element'
							data-json='".$json."'  style='width: 100%' data-href='" . $url('cus_policy/default', array(
                    'action' => 'renewpolicy',
                   
                )) . "'>Renew Policy</a>";
                
                return $viewButton . " <br> <br>" . $renewButton;
                break;
            case PolicyService::POLICY_STATUS_SUSPENDED:
                return "<p style='color: red;'>" . $policyEntity->getSuspendedReason() . "</p>";
                break;
                
            case PolicyService::POLICY_STATUS_ISSUED_BUT_PENDING:
                return "<p style='color: green;'>Policy has been issued but some pending issues are being finalized</p>";
                break;
                
            
        }
    }
}

