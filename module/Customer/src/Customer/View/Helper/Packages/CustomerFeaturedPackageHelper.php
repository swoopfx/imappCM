<?php
namespace Customer\View\Helper\Packages;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Session\Container;

/**
 *
 * @author otaba
 *        
 */
class CustomerFeaturedPackageHelper extends AbstractHelper implements ServiceLocatorAwareInterface
{

    private $serviceLocator;

    /**
     */
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

    public function __invoke()
    {
        $url = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("ViewHelperManager")
            ->get("url");
        
        $clientGeneralService = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("Customer\Service\ClientGeneralService");
        $em = $clientGeneralService->getEntityManager();
        $session = new Container('clientSession');
        $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $session->brokerId);
        
        $frame = "";
        
        if ($brokerEntity->getFeaturedPackages() != NULL) {
            
            $featuredPackageEntity = $brokerEntity->getFeaturedPackages();
            if ($featuredPackageEntity->getPackage1() != NULL) {
                $frame .= $this->frameFunc($featuredPackageEntity->getPackage1());
            }
            
            if ($featuredPackageEntity->getPackage2() != NULL) {
                $frame .= $this->frameFunc($featuredPackageEntity->getPackage2());
            }
            
            if ($featuredPackageEntity->getPackage3() != NULL) {
                $frame .= $this->frameFunc($featuredPackageEntity->getPackage3());
            }
            
            if ($featuredPackageEntity->getPackage4() != NULL) {
                $frame .= $this->frameFunc($featuredPackageEntity->getPackage4());
            }
            
            if ($featuredPackageEntity->getPackage5() != NULL) {
                $frame .= $this->frameFunc($featuredPackageEntity->getPackage5());
            }
            
            return $frame;
        }
    }

    private function frameFunc($package)
    {
        $packageImabeHelper = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("ViewHelperManager")
            ->get("customer_packages_image_helper");
        
        $url = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("ViewHelperManager")
            ->get("url");
        
        $fra = " 
<div class='item'>
				<div class='panel panel-default paper-shadow' data-z='0.5'
					data-hover-z='1' data-animated>
					<div class='panel-body'>
						<div class='media media-clearfix-xs'>
							<div class='media-left'>
								 <img alt=''
				src='" . $packageImabeHelper($package) . "'
				class='img-circle width-80'>
							</div>
							<div class='media-body'>
								<h4 class='media-heading margin-v-5-3'>
									<a href='" . $url("cus_pack/default", array(
            'action' => 'view',
            'id' => $package->getPackageUid()
        )) . "'>" . $package->getPackageName() . "</a>
								</h4>
								
							</div>
						</div>
					</div>
				</div>
			</div>

";
        return $fra;
    }
}

