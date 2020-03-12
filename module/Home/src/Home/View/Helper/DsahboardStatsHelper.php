<?php
namespace Home\View\Helper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;


/**
 *
 * @author swoopfx
 *        
 */
class DsahboardStatsHelper extends AbstractHelper implements ServiceLocatorAwareInterface
{
    
    private $serviceLocator;

    public function __invoke($customers, $proposals, $unsetledClaims, $pendingPolicies, $expiredInvoice){
        $smsService = $this->getServiceLocator()->getServiceLocator()->get('SMS\Service\SMSService');
        $frame = "<div
        class='animated flipInY col-md-2 col-sm-4 col-xs-6 tile_stats_count'>
        <div class='left'></div>
        <div class='right'>
        <span class='count_top'><i class='fa fa-clock-o'></i> My Customers</span>
        <div class='count green'>".count($customers)."</div>
        <!--                             <span class='count_bottom'><i class='green'>4% </i> From last Week</span> -->
        </div>
        </div>
        <div
        class='animated flipInY col-md-2 col-sm-4 col-xs-6 tile_stats_count'>
        <div class='left'></div>
        <div class='right'>
        <span class='count_top'><i class='fa fa-clock-o'></i> Active Proposals </span>
        <div class='count green'>".count($proposals)."</div>
        <!--                             <span class='count_bottom'><i class='green'><i class='fa fa-sort-asc'></i>3% </i> From last Week</span> -->
        </div>
        </div>
        <div
        class='animated flipInY col-md-2 col-sm-4 col-xs-6 tile_stats_count'>
        <div class='left'></div>
        <div class='right'>
        <span class='count_top'><i class='fa fa-clock-o'></i> Unsettled Claims</span>
        <div class='count green'>".count($unsetledClaims)."</div>
        <!--                             <span class='count_bottom'><i class='green'><i class='fa fa-sort-asc'></i>34% </i> From last Week</span> -->
        </div>
        </div>
        <div
        class='animated flipInY col-md-2 col-sm-4 col-xs-6 tile_stats_count'>
        <div class='left'></div>
        <div class='right'>
        <span class='count_top'><i class='fa fa-clock-o'></i> Active Offers</span>
        <div class='count green'>".count($pendingPolicies)."</div>
        <!--                             <span class='count_bottom'><i class='red'><i class='fa fa-sort-desc'></i>12% </i> From last Week</span> -->
        </div>
        </div>
            <div
        class='animated flipInY col-md-2 col-sm-4 col-xs-6 tile_stats_count'>
        <div class='left'></div>
        <div class='right'>
        <span class='count_top'><i class='fa fa-clock-o'></i> Expiring Policy</span>
        <div class='count green'>".count($expiredInvoice)."</div>
        <!--                             <span class='count_bottom'><i class='red'><i class='fa fa-sort-desc'></i>12% </i> From last Week</span> -->
        </div>
        </div>
            <div
        class='animated flipInY col-md-2 col-sm-4 col-xs-6 tile_stats_count'>
        <div class='left'></div>
        <div class='right'>
        <span class='count_top'><i class='fa fa-clock-o'></i> SMS Account</span>
        <div class='count green'>".($smsService->getBrokerSMSCredit() == NULL? 0 : $smsService->getBrokerSMSCredit()->getAvailableCredit())."</div>
        <!--                             <span class='count_bottom'><i class='red'><i class='fa fa-sort-desc'></i>12% </i> From last Week</span> -->
        </div>
        </div>
       ";
        return $frame;
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

   
}

