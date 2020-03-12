<?php
namespace Home\View\Helper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;
use Users\Entity\InsuranceBrokerRegistered;

class SMSExpireNotification extends AbstractHelper implements ServiceLocatorAwareInterface
{

    private $serviceLocator;
    
    public function __construct()
    {

        // TODO - Insert your code here
    }

    public function getServiceLocator()
    {

        return $this->serviceLocator;
    }

    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {

        $this->serviceLocator = $serviceLocator;
        return $this;
    }

    /**
     * 
     * @param InsuranceBrokerRegistered $brokerEntity
     * @return string
     */
    public function __invoke($brokerEntity){
        $url = $this->getServiceLocator()->getServiceLocator()->get("ViewHelperManager")->get("url");
        $smsCount = $brokerEntity->getSmsBroker()->getAvailableCredit();
        if ($smsCount < 100){
            return "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span>
                    </button>
                    <p style='color: red'><strong>SMS Alert !!!</strong> Please refill your SMS credit. <a href='".$url("s-m-s/default", array("action"=>"buy-sms"))."' class='btn btn-xs' >CLICK HERE</a> to top up</p>
                  </div>";
        }
    }
}

