<?php
namespace GeneralServicer\View\Helper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 *
 * @author otaba
 *        
 */
class BankLogoHelper extends AbstractHelper implements ServiceLocatorAwareInterface
{

    private $serviceLocator;

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

    public function __invoke($bankId)
    {
        $generalService = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("GeneralServicer\Service\GeneralService");
        $basePath = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("ViewHelperManager")
            ->get("basePath");
        $em = $generalService->getEntityManager();
        $path = "";
        // if($bankId != NULL){
        // $data = $em->find("Settings\Entity\Insurer", $bankId);
        // if($data->getLogo() == NULL || $data->getLogo() == ""){
        // $path = $basePath("img/insure-logo/no_image_available_s_large.jpg");
        // }else{
        // $path = $basePath("img/insure-logo/".$data->getLogo());
        // }
        // }
        
        if($bankId ==  NULL || $bankId == ""){
            $path = $basePath("img/insure-logo/no_image_available_s_large.jpg");
        }else{
            $datq = $em->find("Settings\Entity\Insurer", $bankId);
        }
        
        return $path;
    }
}

