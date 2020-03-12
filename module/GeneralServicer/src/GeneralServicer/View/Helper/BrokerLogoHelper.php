<?php
namespace GeneralServicer\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 *
 * @author otaba
 *        
 */
class BrokerLogoHelper extends AbstractHelper implements ServiceLocatorAwareInterface
{

    private $serviceLocator;

    public function __construct()
    {}

    public function __invoke($logoId)
    {
        $generalService = $this->getServiceLocator()->getServiceLocator()->get("GeneralServicer\Service\GeneralService");
        $basePath = $this->getServiceLocator()->getServiceLocator()->get("ViewHelperManager")->get("basePath");
       
        $em = $generalService->getEntityManager();
        $link = "";
        if ($logoId == NULL) {
            $link = $basePath("img/empty-broker-logo.jpg");
        }else {
            $em->find("", $logoId);
        }
        return $link;
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
}

