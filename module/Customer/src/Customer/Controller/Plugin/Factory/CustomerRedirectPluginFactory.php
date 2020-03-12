<?php
namespace Customer\Controller\Plugin\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Customer\Controller\Plugin\CustomerRedirectPlugin;

class CustomerRedirectPluginFactory implements FactoryInterface {
	public function createService(ServiceLocatorInterface $serviceLocator) {
		$plugin = new CustomerRedirectPlugin ();
		$clientGeneralService = $serviceLocator->getServiceLocator ()->get ( "Customer\Service\ClientGeneralService" );
		$em = $clientGeneralService->getEntityManager ();
		$request = $clientGeneralService->getRequest();
		$auth = $clientGeneralService->getClientAuth ();
		$brokerId = $clientGeneralService->getBrokerId ();
		$referer = $clientGeneralService->getReferer();
		$clientSession = $clientGeneralService->getClientSession ();
		$hiddenSession = $clientGeneralService->getHiddenSession();
		$redirect = $clientGeneralService->getRedirect();
		//var_dump($redirect);
		$plugin->setBrokerId ( $brokerId )
		->setAuth ( $auth )
		->setEntityManager ( $em )
		->setCLientSession ( $clientSession )
		->setReferer($referer)->setRequest($request)
		->setRedirect($redirect)
		->setHiddenSession($hiddenSession);
		return $plugin;
	}
}