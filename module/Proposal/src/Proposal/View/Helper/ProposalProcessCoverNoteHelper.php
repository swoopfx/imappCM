<?php
namespace Proposal\View\Helper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;
use Transactions\Service\InvoiceService;

/**
 *
 * @author otaba
 *        
 */
class ProposalProcessCoverNoteHelper extends AbstractHelper implements ServiceLocatorAwareInterface
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

    public function __invoke($proposalEntity)
    {
        $url = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("ViewHelperManager")
            ->get("url");
        
        $basePath = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("ViewHelperManager")
            ->get("basePath");
        
        $json = json_encode(array(
            "type" => "standard"
        ));
        
        
        
        $processing1 = "<div style=' text-align: center;'>
<i id='generateCoverNote' class='fa fa-lg' style='display: none; text-align: center;'><img
	alt=''
	src='" . $basePath('/processin.gif') . "'
	height=50><hr></i>
	</div>";
        
        $processing2 = "<div style=' text-align: center;'>
<i id='viewCoverNote' class='fa fa-lg' style='display: none; text-align: center;'><img
	alt=''
	src='" . $basePath('/processin.gif') . "'
	height=50><hr></i>
	</div>";
        
        $dataJson = json_encode(array(
            "data" => $proposalEntity->getId()
        ));
        if ($proposalEntity->getInvoice() != NULL) {
            if ($proposalEntity->getInvoice()
                ->getStatus()
                ->getId() == InvoiceService::INVOICE_PAID_STATUS) {
                if ($proposalEntity->getCoverNote() != NULL) {
                    $coverNoteLabel = "View CoverNote";
                    $coverNoteButton = "<br><a data-ajax-loader = 'viewCoverNote' id='btn3' " . $dataJson . "  data-href='" . $url("proposal/default", array(
                        "action" => "viewcovernote"
                    
                    )) . "' class=' ajax_element btn btn-xs btn-primary' style='width: 100%;'>" . $coverNoteLabel . "</a>";
                    return $coverNoteButton . $processing2;
                } else {
                    $coverNoteLabel = "Generate CoverNote";
                    $coverNoteButton = "<br><a  data-ajax-loader = 'generateCoverNote' id='btn3' data-json='" . $json . "' data-href='" . $url("proposal/default", array(
                        "action" => "generate-cover-note"
                    )) . "'  class='ajax_element btn btn-xs btn-primary' style='width: 100%;'>" . $coverNoteLabel . "</a>";
                    return $coverNoteButton . $processing1;
                }
            } else {
                $disabled = "disabled='disabled'";
                $coverNoteLabel = "Generate CoverNote";
                $coverNoteButton = "<br><div class='alert alert-danger alert-dismissible fade in' role='alert'>
                        
                    <strong>The customer must pay for this service before the covernote is ACTIVE and can be generated</strong></div><a data-toggle='tooltip' data-placement='top' title='This proposal can now be viewd by your customer' href='" . $url("proposal/default", array(
                    "action" => "generate-cover-note"
                )) . "' " . $disabled . " class='btn btn-lg btn-primary' style='width: 100%;'>" . $coverNoteLabel . "</a>";
                return $coverNoteButton;
            }
        } else {
            $disabled = "disabled='disabled'";
            $coverNoteLabel = "Generate CoverNote";
            $coverNoteButton = "<br><div class='alert alert-danger alert-dismissible fade in' role='alert'>
                
                    <strong>The customer must pay for this service before the covernote is ACTIVE and can be generated</strong></div><a data-toggle='tooltip' data-placement='top' title='This proposal can now be viewd by your customer' href='" . $url("proposal/default", array(
                "action" => "generate-cover-note"
            )) . "' " . $disabled . " class='btn btn-lg btn-primary' style='width: 100%;'>" . $coverNoteLabel . "</a>";
            return $coverNoteButton;
        }
    }
}

