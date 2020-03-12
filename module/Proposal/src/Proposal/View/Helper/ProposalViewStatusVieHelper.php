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
class ProposalViewStatusVieHelper extends AbstractHelper implements ServiceLocatorAwareInterface
{

    private $serviceLocator;

    /**
     */
    public function __construct()
    {
        
        // TODO - Insert your code here
    }

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
        $statusHelper = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("ViewHelperManager")
            ->get("statusHelper");
        
        $invoiceEntity = $proposalEntity->getInvoice();
        if ($invoiceEntity != NULL) {
            if ($invoiceEntity->getStatus()->getId() == InvoiceService::INVOICE_PAID_STATUS || $invoiceEntity->getStatus()->getId() == InvoiceService::INVOICE_PAYING_STATUS) {
                return "<span style='width: 100%' class='label label-success'>Paid</span>";
            } else {
                return $statusHelper($proposalEntity->getProposalStatus()->getStatus());
            }
        } else {
            return $statusHelper($proposalEntity->getProposalStatus()->getStatus());
        }
    }
}

