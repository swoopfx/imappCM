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
class BrokerSubcriptionHelper extends AbstractHelper implements ServiceLocatorAwareInterface
{

    private $serviceLocator;

    public function __invoke($info)
    {
        return  $this->frame($info);
    }

    private function frame($info)
    {
        $brokerToolService = $this->getServiceLocator()->getServiceLocator()->get('BrokersTool\Service\BrokerToolService');
        $dateFormat = $this->getServiceLocator()->getServiceLocator()->get('ViewHelperManager')->get('dateFormat');
        $frame = "<div class='col-md-3 col-xs-12 widget widget_tally_box'>
		<div class='x_panel fixed_height_390'>
			
			<div class='x_content'>
				<div class='col-md-12'>
					<br>
					<h3 class='name_title'>My Package</h3>
					<p>".$info->getPackage()->getPackageName()."</p>
					<br>
				</div>




				<div>
					<ul class='list-inline widget_tally'>
						<li>
							<p>
								<span class='month'>Maximum Staff</span> <span class='count badge bg-blue'>".$info->getPackage()->getMaxEmployee()."</span>
							</p>
						</li>
						<li>
							<p>
								<span class='month'>Registered Staff </span> <span class='count badge bg-red'>".count($brokerToolService->getRegisteredStaffs())."</span>
							</p>
						</li>
						<li>
							<p></p>
						</li>
						<li>
							<p><strong>Expires</strong></p>
						</li>

						<li>
							<p>".$dateFormat($info->getEndDate(), \IntlDateFormatter::LONG,  \IntlDateFormatter::NONE, "en_US")."</p>
						</li>
					</ul>
				</div>

			</div>
		</div>
	</div>";
        
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

