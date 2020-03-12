<?php
namespace GeneralServicer\View\Helper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;
use Transactions\Service\InvoiceService;

/**
 *
 * @author otaba
 *        
 */
class PaymentStatus extends AbstractHelper implements ServiceLocatorAwareInterface
{

    private $serviceLocator;

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

    public function __invoke($invoiceEntity)
    {
        $basePath = $this->getServiceLocator()
        ->getServiceLocator()
        ->get("ViewHelperManager")
        ->get("basePath");
        
            if ($invoiceEntity->getStatus()->getId() != InvoiceService::INVOICE_PAID_STATUS) {
                
                // Show Unpaid Image
                $imgLink = $basePath("/img/unpaid.png");
                $img = "<img src='" . $imgLink . "' title='unpaid Status' alt='Unpaid' style='width: 100%' >";
                //$img = "<h2 style='color: red;'>UNPAID</h2>";
                return $img;
            }else{
                $imgLink = $basePath("/img/paid.png");
                $img = "<img src='" . $imgLink . "' title='unpaid Status' alt='paid' style='width: 100%' >";
                // $img = "<h2 style='color: green;'>PAID</h2>";
                return $img;
                // Show paid img with link to receipt
                
            }
            
        }
       
    
}

