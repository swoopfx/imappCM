<?php
namespace Policy\View\Helper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;
use Policy\Service\CoverNoteService;

/**
 *
 * @author otaba
 *        
 */
class CoverNoteSourceHelper extends AbstractHelper implements ServiceLocatorAwareInterface
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
        
        $clientGeneralService = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("Customer\Service\ClientGeneralService");
        
        $categoryName = $coverNoteEntity->getCoverCategory()->getCategory();
        $categorId = $coverNoteEntity->getCoverCategory()->getId();
        if ($clientGeneralService->getClientSession()->brokerId != NULL) {} else {
            switch ($categorId) {
                case CoverNoteService::COVERNOTE_CATEGORY_OFFER:
                    $link = "Source : <a class='btn btn-default btn-xs' href='" . $url("offer/default", array(
                        "action" => "pre-view",
                        "id" => $coverNoteEntity->getOffer()->getId()
                    )) . "'>Offer Service</a>";
                    return $link;
                    break;
                
                case CoverNoteService::COVERNOTE_CATEGORY_PACKAGES:
                    $link = "Source : <a class='btn btn-default' href='" . $url("acquired-packages/default", array(
                        "action" => "pre-process",
                        "id" => $coverNoteEntity->getPackage()->getId()
                    )) . "'> Packages</a>";
                    return $link;
                    break;
                
                case CoverNoteService::COVERNOTE_CATEGORY_PROPOSAL:
                    $link = "Source : <a class='btn btn-default' href='" . $url("proposal/default", array(
                        "action" => "pre-process",
                        "id" => $coverNoteEntity->getProposal()->getProposalCode()
                    )) . "'>Proposals</a>";
                    return $link;
                    break;
            }
        }
    }
}

