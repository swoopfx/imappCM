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
class BrokerAccountHelper extends AbstractHelper implements ServiceLocatorAwareInterface
{

    private $serviceLocator;

    public function __invoke($info)
    {
        return $this->frame($info);
    }

    private function frame($info)
    {
        $frame = "<div class='col-md-3 col-xs-12 widget widget_tally_box'>
		<div class='x_panel fixed_height_390'>
			
			<div class='x_content'>


				<div>
					<ul class='list-inline widget_tally'>
						<li>
							
								<h3 class='name_title'>" . $info->getCompanyName() . "</h3>
							
						</li>
								    <li>
								    <p>
							
								<strong>Address: </strong>" . $info->getBrokerAddress() . "</p>
							
						</li>
								    <li>
							<p>
								<strong>Email: </strong>" . $info->getBrokerEmail() . "</p>
							
						</li>
								    
								    <li>
							<p>
								<strong>Website: </strong>" . $info->getBrokerWebsite() . "</p>
							
						</li>
								    <li>
							<p>
								<strong>Phone: </strong>" . $info->getOfficialPhone() . "</p>
							
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

