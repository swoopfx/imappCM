<?php
namespace Home\View\Helper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;
use CsnUser\Service\UserService;


/**
 *
 * @author swoopfx
 *        
 */
class SubscriptionExpireNotificationHelper extends AbstractHelper implements ServiceLocatorAwareInterface
{

    private $serviceLocator;
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
    }

  
    public function __invoke(){
        $dateCalculator = $this->getServiceLocator()->getServiceLocator()->get('GeneralServicer\Service\DateCalculationService');
        if ($dateCalculator->getSubscpritionDays() <= 30){
            return "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span>
                    </button>
                    <p style='color: red'><strong>Subscription Alert </strong> Your account will expire soon in ".$dateCalculator->getSubscpritionDays()." days .".$this->showRenewButton()."</p>
                  </div>";
        }
    }
    
    private function showRenewButton(){
        $generalService = $this->getServiceLocator()->getServiceLocator()->get('GeneralServicer\Service\GeneralService');
        $userRoleId = $generalService->getUserRoleId();
        if ($userRoleId == UserService::USER_ROLE_BROKER){
            return "Please subscribe now <a href='/account/renew-account' class='btn btn-default'> subscribe Now</a>";
        }else{
            return "Contact your account administrator to subscribe";
        }
    }
}

