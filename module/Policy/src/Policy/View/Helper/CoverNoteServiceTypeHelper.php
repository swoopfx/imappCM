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
class CoverNoteServiceTypeHelper extends AbstractHelper implements ServiceLocatorAwareInterface
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

    

    public function __invoke($coverNoteEntity){
        $url = $this->getServiceLocator()
        ->getServiceLocator()
        ->get("ViewHelperManager")
        ->get("url");
        
        $categoryName = $coverNoteEntity->getCoverCategory()->getCategory();
        $categorId = $coverNoteEntity->getCoverCategory()->getId();
        
        switch ($categorId){
            case CoverNoteService::COVERNOTE_CATEGORY_OFFER:
                $service = $coverNoteEntity->getOffer()->getOfferServiceType()->getInsuranceService();
                return $service;
                break;
                
            case CoverNoteService::COVERNOTE_CATEGORY_PACKAGES:
                //$link = "Source : <a class='btn btn-default' href='".$url("offer/default", array("action"=>"pre-view", "id"=>$coverNoteEntity->getPackages()->getId()))."'> Packages</a>";
                //var_dump($coverNoteEntity->getPackage()->getPackages());
                
                if($coverNoteEntity->getPackage()->getPackages()->getServiceType() == NULL){
                   return "<p style='color: red'>No Service Type</p>";
                }else{
                    $service = $coverNoteEntity->getPackage()->getPackages()->getServiceType()->getInsuranceService();
                    return $service;
                }
               
                break;
                
            case CoverNoteService::COVERNOTE_CATEGORY_PROPOSAL:
                $service = $coverNoteEntity->getProposal()->getServiceType()->getInsuranceService();
                return $service;
                break;
                
            case CoverNoteService::COVERNOTE_CATEGORY_FLOAT_POLICY:
                if($coverNoteEntity->getPolicyFloat()->getServiceType() == NULL){
                    return "<p style='color: red'>No Service Type</p>";
                }else{
                    $service = $coverNoteEntity->getPolicyFloat()->getServiceType()->getInsuranceService();
                    return $service;
                }
                break;
        }
    }
}

