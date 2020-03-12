<?php
namespace Customer\View\Helper\Offer;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;


/**
 *
 * @author otaba
 *        
 */
class AcceptRecommendedInsurerViewHelper extends AbstractHelper implements ServiceLocatorAwareInterface
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

    public function __invoke($offerEntity){
        $url = $this->getServiceLocator()
        ->getServiceLocator()
        ->get("ViewHelperManager")
        ->get("url");
        $isRecommendedInsurer = $offerEntity->getIsRecommendedInsurer();
        if($isRecommendedInsurer == FALSE || $isRecommendedInsurer == NULL){
            return "<a class='btn btn-xs btn-primary' href='".$url("cus_offer/default", array("action"=>"accept-insurer"))."'></a>"; // show dont accept recommended insurer
        }else{
            return "<a class='btn btn-xs btn-success' href='".$url("cus_offer/default", array("action"=>"reject-insurer"))."'></a>"; // show accept recommended insurer
        }
    }
}


