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
class ProposalProcessCustomerVisibilityHelper extends AbstractHelper implements ServiceLocatorAwareInterface
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
    }

    public function __invoke($proposalEntity){
       
        $visibility = $proposalEntity->getIsVisibile();
        $url = $this->getServiceLocator()
        ->getServiceLocator()
        ->get("ViewHelperManager")
        ->get("url");
        $disable = ($proposalEntity->getInvoice() != NULL ? ($proposalEntity->getInvoice()->getStatus()->getId() == InvoiceService::INVOICE_PAID_STATUS ? "disabled='disabled'" : ""): "");
        if($visibility == TRUE){
            /**
             * inidcate the proposalis visible
             * then show the button to make it invisble to customer
             */
            $notification ="";
            
            $button = "<br><a ".$disable."  href='".$url("proposal/default", array("action"=>"make-invisible"))."' style='width: 100%;' data-toggle='tooltip' data-placement='top' title='This proposal can now be viewd by your customer'  class='btn btn-sm btn-danger conV'>Make Invisible to customer</a>";
            return $notification.$button;
        }else{
            /**
             * Inidicate the proposal is invicisble
             * Then show the buttom to make it visible
             */
            $notification ="";
            $button = "<br><a ".$disable." href='".$url("proposal/default", array("action"=>"make-visible"))."'  style='width: 100%;' data-toggle='tooltip' data-placement='top' title='Click to make this proposal visible to you customer' class='btn btn-sm btn-warning conV'>Make Visible to customer</a>";
            return $notification.$button;
        }
    }
}

