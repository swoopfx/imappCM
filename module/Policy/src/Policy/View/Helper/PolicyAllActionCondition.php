<?php
namespace Policy\View\Helper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;
use Policy\Service\PolicyService;

/**
 *
 * @author otaba
 *        
 */
class PolicyAllActionCondition extends AbstractHelper implements ServiceLocatorAwareInterface
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

    public function __invoke($coverNoteEntity)
    {
        
        $url = $this->getServiceLocator()->getServiceLocator()->get("ViewHelperManager")->get("url");
       $json = json_encode(array(
           "data"=>$coverNoteEntity->getPolicy()->getId()
        ));
        switch ($coverNoteEntity->getPolicy()->getPolicyStatus()
            ->getId()) {
            case PolicyService::POLICY_STATUS_ACTIVE:
            case PolicyService::POLICY_STATUS_ISSUED_AND_VALID:
                if (date_diff($coverNoteEntity->getPolicy()->getEndDate(), new \DateTime())->format("%a") < 30) { // TODO Compare the two dates and look for the highest
                    return "<a data-ajax-loader='policyd' id='sending_data_button' data-json='{$json}' data-href='".$url("policy/default", array("action"=>"notify"))."' class='ajax_element btn btn-success' style='width: 100%;'><i class='fa fa-send'></i> Send Reminder  </a><br><p style='color: red;'> Policy Expires in " . date_diff($coverNoteEntity->getPolicy()->getEndDate(), new \DateTime(), TRUE)->format("%a") . " days </p>";
                }
                break;
            
            case PolicyService::POLICY_STATUS_INACTIVE:
                return "<a href='".$url("policy/default", array("action"=>"renew-reminder"))."' class='btn btn-success' style='width: 100%;'>Send Renewal Notification </a>"; // TODO remind the customer that he is not covered and make it known that any claim would not be covered
                break;
            default:
                return "";
                break;
        }
    }
}

