<?php
namespace Packages\View\Helper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;
use Packages\Service\AcquirePackagesService;


/**
 *
 * @author otaba
 *        
 */
class AcquiredPackageProcessCovernoteHelper extends AbstractHelper implements ServiceLocatorAwareInterface
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

    

    public function __invoke($customerPackageEntity){
        $url = $this->getServiceLocator()
        ->getServiceLocator()
        ->get("ViewHelperManager")
        ->get("url");
        
        $partial = $this->getServiceLocator()
        ->getServiceLocator()
        ->get("ViewHelperManager")
        ->get("partial");
        $coverNoteLabel = "Generate CoverNote";
        if($customerPackageEntity->getAcquiredPackageStatus()->getId() == AcquirePackagesService::ACQUIRED_PACKAGE_PAID_PROCESSING){
            if($customerPackageEntity->getCoverNote() != NULL){
                $coverNoteLabel = "View CoverNote";
                $coverNoteButton = "<a href='" . $url("cover-note/default", array(
                    "action" => "pre-view",
                    "id" => $customerPackageEntity->getCoverNote()->getId()
                )) . "'  class='btn btn-lg btn-primary' style='width: 100%;'>" . $coverNoteLabel . "</a>";
                $coverNoteButton .= "<div class='bs-example' data-example-id='simple-jumbotron'>
                <div class='jumbotron' style='color: red'>CoverNote already Generated</div></div><br>";
                return $coverNoteButton;
            }else {
                // var_dump($partial);
                return "<br><a style='width: 100%' class='btn btn-primary' href='" . $url("acquired-packages/default", array(
                    "action" => "generate-cover-note"
                )) . "'> Generate CoverNote</a>";
                // return "<br>".$partial("policy_covernote_generation_form", array("coverNoteForm"=>$coverNoteForm));
            }
        }elseif ($customerPackageEntity->getAcquiredPackageStatus()->getId() == AcquirePackagesService::ACQUIRED_PACKAGE_SETTLED){
            $coverNoteLabel = "View CoverNote";
            $coverNoteButton = "<a href='" . $url("cover-note/default", array(
                "action" => "pre-view",
                "id" => $customerPackageEntity->getCoverNote()->getId()
            )) . "'  class='btn btn-lg btn-primary' style='width: 100%;'>" . $coverNoteLabel . "</a>";
            $coverNoteButton .= "<div class='bs-example' data-example-id='simple-jumbotron'>
                <div class='jumbotron' style='color: red'>CoverNote already Generated</div></div><br>";
            return $coverNoteButton;
        }
        else {
            // show disabled buton to generate coverNOte
            $disabled = "disabled='disabled'";
            
            $coverNoteButton = "<br><div class='alert alert-danger alert-dismissible fade in' role='alert'>
                
                    <strong>The customer must pay for this service before the coverNote is ACTIVE</strong></div><a href='" . $url("acquired-packages/default", array(
                        "action" => "generate-covernote"
                    )) . "' " . $disabled . " class='btn btn-lg btn-primary' style='width: 100%;'>" . $coverNoteLabel . "</a>";
                    return $coverNoteButton;
        }
    }
}

