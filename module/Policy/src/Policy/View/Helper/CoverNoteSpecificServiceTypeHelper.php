<?php
namespace Policy\View\Helper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;
use Policy\Service\CoverNoteService;
use Policy\Entity\CoverNote;

/**
 *
 * @author otaba
 *        
 */
class CoverNoteSpecificServiceTypeHelper extends AbstractHelper implements ServiceLocatorAwareInterface
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

    public function __invoke($coverNoteEntity)
    {
        $url = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("ViewHelperManager")
            ->get("url");
        
        $categoryName = $coverNoteEntity->getCoverCategory()->getCategory();
        $categorId = $coverNoteEntity->getCoverCategory()->getId();
        
        switch ($categorId) {
            case CoverNoteService::COVERNOTE_CATEGORY_OFFER:
                $service = $coverNoteEntity->getOffer()
                    ->getOfferSpecificService()
                    ->getSpecificService();
                return $service;
                break;
            
            case CoverNoteService::COVERNOTE_CATEGORY_PACKAGES:
                if ($coverNoteEntity->getPackage()
                    ->getPackages()
                    ->getSpecificService() == NULL) {
                    return "<p style='color: red'>No Service Type</p>";
                } else {
                    $service = $coverNoteEntity->getPackage()
                        ->getPackages()
                        ->getSpecificService()
                        ->getSpecificService();
                    return $service;
                }
                
                break;
            
            case CoverNoteService::COVERNOTE_CATEGORY_PROPOSAL:
                $service = $coverNoteEntity->getProposal()
                    ->getSpecificService()
                    ->getSpecificService();
                return $service;
                break;
            case CoverNoteService::COVERNOTE_CATEGORY_FLOAT_POLICY:
                if ($coverNoteEntity->getPolicyFloat()->getSpecificService() == NULL) {
                    return "<p style='color: red'>No Service Type</p>";
                } else {
                    $service = $coverNoteEntity->getPolicyFloat()
                        ->getSpecificService()
                        ->getSpecificService();
                    return $service;
                }
                break;
        }
    }
}

