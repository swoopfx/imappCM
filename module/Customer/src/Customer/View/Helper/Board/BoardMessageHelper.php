<?php

namespace Customer\View\Helper\Board;

use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class BoardMessageHelper extends AbstractHelper implements ServiceLocatorAwareInterface {
	private $serviceLocator;
	public function __invoke($enttt) {
		$clientGeneralService = $this->getServiceLocator ()->getServiceLocator ()->get ( "Customer\Service\ClientGeneralService" );
		$frame = "";
		$frame .= "<div class='item col-xs-12 col-lg-6'>
				<div class='panel panel-default paper-shadow' data-z='0.5'>
					<div class='panel-heading'>
						<h4 class='text-headline margin-none'>Notification  Messages</h4>
						<p class='text-subhead text-light'>My recent messages</p>
					</div>
					<ul class='list-group'>";
		
		$frame .= $this->microFrame ( $enttt );
		
		$frame .= "		</ul>
					<div class='panel-footer text-right'>
						<a href='website-student-courses.html'
							class='btn btn-white paper-shadow relative' data-z='0'
							data-hover-z='1' data-animated href='#'> View all</a>
					</div>
				</div>
			</div>";
		
		return $frame;
	}
	private function microFrame($entiy) {
		$frame = NULL;
		if (count ( $entiy ) == 0) {
			$frame = "No message is available";
		} else {
			foreach ( $entiy as $ent ) {
				$frame = "";
				$frame .= "<li class='list-group-item media v-middle'>
							<div class='media-body'>
								<a href='website-take-course.html'
									class='text-subhead list-group-link'>" . $ent->getMessageName () . "</a>
							</div>
							<div class='media-right'>" . ($ent->getIsRead () == FALSE ? "<span class='badge badge-red pull-right'>unread</span>" : '') . "
							</div>
						</li>";
			}
		}
		return $frame;
	}
	public function getServiceLocator() {
		return $this->serviceLocator;
	}
	public function setServiceLocator(ServiceLocatorInterface $serviceLocator) {
		$this->serviceLocator = $serviceLocator;
		return $this;
	}
}