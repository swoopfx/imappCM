<?php
namespace Home\View\Helper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;

class InfoDuckerHelper extends AbstractHelper implements ServiceLocatorAwareInterface
{

    private $servicelocator;

    public function getServiceLocator()
    {
        return $this->servicelocator;
    }

    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->servicelocator = $serviceLocator;
        return $this;
    }

    public function __invoke($broker)
    {
        $homeService = $this->getServiceLocator()
            ->getServiceLocator()
            ->get('Home\Service\HomeService');
        $general_dashboard_notification_helper = $currencyFormat = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("ViewHelperManager")
            ->get("general_dashboard_notification_helper");

        $info = $homeService->isNotificatioReady();
        $frame = '';
        $notication = "<span class='badge bg-red'>NOTIFICATIONS</span>";
        $outstanding = "<span class='badge bg-red'>OUTSTANDING SETUP</span>";
        if ($info == TRUE) {
                        $this->general_dashboard_notification_helper($broker);
            $frame = "
            <div class='col-md-3 col-xs-12 widget widget_tally_box'>
		<div class='x_panel ui-ribbon-container fixed_height_390 scroll-view'>
                
			<div class='x_title'>
				<h2>" . $notication . "</h2>
				<div class='clearfix'></div>
			</div>
			<div class='x_content'>
				    
                      <div class=''>
                        <ul class='to_do'>
                           
                              
                              
                        </ul>
                      </div>
                    </div>
		</div>
	</div>";
        } else {
            $frame = "
            <div class='col-md-3 col-xs-12 widget widget_tally_box'>
		<div class='x_panel ui-ribbon-container fixed_height_390'>
			
			<div class='x_title'>
				<h2>" . $outstanding . "</h2>
				<div class='clearfix'></div>
			</div>
			<div class='x_content'>
       
                      <div class=''>
                        <ul class='to_do'>
                          " . $homeService->brokerAccountDetailsCondition() . "
           
                             
                          " . $homeService->staffRegisterCondition() . "
                          
                          

                           " . $homeService->ceoProfileCondition() . "
             
                        </ul>
                      </div>
                    </div>
		</div>
	</div>";
        }
        return $frame;
    }
}

