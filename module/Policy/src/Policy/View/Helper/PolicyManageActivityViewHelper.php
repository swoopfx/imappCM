<?php
namespace Policy\View\Helper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;
use Policy\Entity\PolicyNotification;

class PolicyManageActivityViewHelper extends AbstractHelper implements ServiceLocatorAwareInterface
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

    public function __invoke($policy)
    {
        /**
         *
         * @var PolicyNotification $activitys
         */
        $activitys = $policy->getPolicyActivity();
        $dateFormat = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("ViewHelperManager")
            ->get("dateFormat");
        $frame = "<li>
							<div class='block'>
								<div class='block_content'>
									<h2 class='title'>
										<a>CREATED </a>
									</h2>
									<div class='byline'>
										: on <a>{$dateFormat($policy->getCreatedOn(), \IntlDateFormatter::MEDIUM, \IntlDateFormatter::NONE, "en_us")}</a>
									</div>
									
								</div>
							</div>
						</li>";

        if (count($activitys) > 0) {
            foreach ($activitys as $activity) {
                // var_dump("SE");

                $message = ($activity->getNotification()->getMessage() != NULL ? $activity->getNotification()->getMessage() : "");
                $frame .= "<li>
							<div class='block'>
								<div class='block_content'>
									<h2 class='title'>
										<a>{$activity->getNotification()->getTopic()}</a>
<p>{$message}</p>
									</h2>
									<div class='byline'>
										<a>{$dateFormat($activity->getNotification()->getCreatedOn(), \IntlDateFormatter::MEDIUM, \IntlDateFormatter::SHORT, "en_us")}</a>
									</div>
									
								</div>
							</div>
						</li>";
            }
        }
        return $frame;
    }
}

