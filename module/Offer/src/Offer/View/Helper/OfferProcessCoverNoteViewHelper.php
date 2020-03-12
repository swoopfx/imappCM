<?php
namespace Offer\View\Helper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;
use Offer\Service\OfferService;
use Transactions\Service\InvoiceService;

/**
 *
 * @author otaba
 *        
 */
class OfferProcessCoverNoteViewHelper extends AbstractHelper implements ServiceLocatorAwareInterface
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
        $url = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("ViewHelperManager")
            ->get("url");
        
        $partial = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("ViewHelperManager")
            ->get("partial");
        
        $disabled = "";
        $info = "<";
        $coverNoteLabel = "Generate CoverNote";
        $coverNoteButton = "<a href='" . $url("offer/default", array(
            "action" => "generate-covernote"
        )) . "' " . $disabled . " class='btn btn-lg btn-primary btn-xs' style='width: 100%;'>" . $coverNoteLabel . "</a>";
        if ($offerEntity->getInvoice() != NULL) {
            if ($offerEntity->getInvoice()
                ->getStatus()
                ->getId() == InvoiceService::INVOICE_PAID_STATUS) {
                if ($offerEntity->getCoverNote() != NULL) {
                    // provide link to coverNote
                    $coverNoteLabel = "View CoverNote";
                    $coverNoteButton = "<a href='" . $url("cover-note/default", array(
                        "action" => "pre-view",
                        "id" => $offerEntity->getCoverNote()->getId()
                    )) . "'  class='btn btn-lg btn-primary  btn-xs' style='width: 100%;'>" . $coverNoteLabel . "</a>";
                    $coverNoteButton .= "<div class='bs-example' data-example-id='simple-jumbotron'>
                <div class='jumbotron' style='color: red'>CoverNote already Generated</div></div><br>";
                    return $coverNoteButton;
                } else {
                    // var_dump($partial);
                    return "<br><a style='width: 100%' class='btn btn-primary btn-xs' href='" . $url("offer/default", array(
                        "action" => "generate-cover-note"
                    )) . "'> Generate CoverNote</a>";
                    // return "<br>".$partial("policy_covernote_generation_form", array("coverNoteForm"=>$coverNoteForm));
                }
            } else {
                // show disabled buton to generate coverNOte
                $disabled = "disabled='disabled'";
                
                $coverNoteButton = "<br><div class='alert alert-danger alert-dismissible fade in' role='alert'>
                    
                    <strong>The customer must pay for this service before the coverNote is ACTIVE</strong></div><a href='" . $url("offer/default", array(
                    "action" => "generate-covernote"
                )) . "' " . $disabled . " class='btn btn-lg btn-primary btn-xs' style='width: 100%;'>" . $coverNoteLabel . "</a>";
                return $coverNoteButton;
            }
        }
    }
}

