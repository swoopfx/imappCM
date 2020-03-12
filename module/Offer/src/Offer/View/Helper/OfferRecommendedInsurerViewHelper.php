<?php
namespace Offer\View\Helper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 *
 * @author otaba
 *        
 */
class OfferRecommendedInsurerViewHelper extends AbstractHelper implements ServiceLocatorAwareInterface
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

    public function __invoke($offerEntity)
    {
        $insurerLogohelper = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("ViewHelperManager")
            ->get("insurerLogohelper");
        
        if ($offerEntity->getRecommendedInsurer() != NULL) {
            return "<strong>Prefered Insurer</strong><img alt='' src='" . $insurerLogohelper($offerEntity->getIdPreferdInsurer()->getId()) . "' class='img-circle   img-responsive' width=80 ><br><strong>Recommended Insurer</strong><img alt='' src='" . $insurerLogohelper($offerEntity->getRecommendedInsurer()->getId()) . "' class='img-circle   img-responsive' width=80 >";
        } elseif ($offerEntity->getRecommendedInsurer() == NULL && $offerEntity->getIdPreferdInsurer() != NULL) {
            return "<strong>Prefered Insurer</strong><img alt='' src='" . $insurerLogohelper($offerEntity->getIdPreferdInsurer()->getId()) . "' class='img-circle   img-responsive' width=100 >";
        } elseif ($offerEntity->getRecommendedInsurer() == NULL && $offerEntity->getIdPreferdInsurer() == NULL) {
            return "No Insurer Selected";
        }
    }
}

