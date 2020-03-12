<?php
namespace Offer\View\Helper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;
use Transactions\Service\InvoiceService;

/**
 * This provide condition for the enables the invoice status of the processing
 * 
 * @author otaba
 *        
 */
class OfferProcessInvoiceConditionButton extends AbstractHelper implements ServiceLocatorAwareInterface
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
        
        
        $status = "";
        
        if (count($offerEntity->getObject()) == 0 || $offerEntity->getValue() == NULL) {
            $status = "disabled = 'disabled'";
            $link = $this->linkFrame($status);
            $link .= "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
                    
                    You must register a property and also fill the Offer form before you can generate an Invoice 
                </div><br>";
            return $link;
        }else{
            
            
            $status = " ";
           
            $link = $this->linkFrame($status);
            if($offerEntity->getInvoice()== NULL){
                
            }
            elseif($offerEntity->getInvoice() != NULL){
              $link .= "<a href='' style='width:100%;' data-toggle='modal' data-target='.bs-invoice-modal-lg' class='btn btn-default btn-xs' ><i class='fa fa-credit-card'></i> Invoice Generated </a>";
               
            }elseif($offerEntity->getInvoice()->getStatus()->getId() == InvoiceService::INVOICE_PAID_STATUS){
                $status = "disabled = 'disabled'";
            }
            return $link;
        }
    }
    
    private function linkFrame($status){
        $url = $this->getServiceLocator()
        ->getServiceLocator()
        ->get("ViewHelperManager")
        ->get("url");
       
        
        $link = "<a  href='" . $url("offer/default", array(
            "action" => "invoice-generate",
            
        )) . "' class='btn btn-success btn-lg' " . $status . " style='width: 100%;'> <i class='fa fa-send'></i> Generate Invoice</a>";
        
        return $link;
    }
}

