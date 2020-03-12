<?php
namespace Offer\View\Helper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;
use Transactions\Service\InvoiceService;

/**
 *
 * @author otaba
 *        
 */
class OfferObjectListViewHelper extends AbstractHelper implements ServiceLocatorAwareInterface
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
        $objectArray = $offerEntity->getObject();
        
        $url = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("ViewHelperManager")
            ->get("url");
        
        $currencyFormat = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("ViewHelperManager")
            ->get("myCurrencyFormat");
        $frame = "";
        $objectTotal = 0;
        $link = "<p style='text-align: center;'><a style='width: 100%;' href='' data-toggle='modal' data-target='.select-property-modal-lg' " . ($offerEntity->getInvoice() == NULL ? "" : ($offerEntity->getInvoice()
            ->getStatus()
            ->getId() == InvoiceService::INVOICE_PAID_STATUS ? "disabled='disabled'" : "")) . "   class='btn btn-xs btn-default'>Add a Property</a> OR <a style='width: 100%;' href='' data-toggle='modal' data-target='.bs-object-modal-lg' " . ($offerEntity->getInvoice() == NULL ? "" : ($offerEntity->getInvoice()
            ->getStatus()
            ->getId() == InvoiceService::INVOICE_PAID_STATUS ? "disabled='disabled'" : "")) . " class='btn btn-xs btn-primary'>Register a New Property</a></p>";
        
        if (count($objectArray) == 0) {
            // var_dump("gt");
            return $link;
        } else {
            
            for ($i = 0; $i < count($objectArray); $i ++) {
                $objectTotal = $objectTotal + $objectArray[$i]->getValue();
                $frame .= "<li>
                            <p style='text-align: center;'>
                              " . $objectArray[$i]->getObjectName() . " (" . $currencyFormat($objectArray[$i]->getValue(), $objectArray[$i]->getCurrency()->getCode()) . ") <br> <a style='width: 100%;' href='" . $url("offer/default", array(
                    "action" => "remove-object",
                    "id" => $objectArray[$i]->getId()
                )) . "' " . ($offerEntity->getInvoice() == NULL ? "" : ($offerEntity->getInvoice()
                    ->getStatus()
                    ->getId() == InvoiceService::INVOICE_PAID_STATUS ? "disabled='disabled'" : "")) . " class='btn btn-xs btn-danger confirmation'>Remove</a></p>
                          </li>";
            }
            return $frame . "<li><strong>Total Property SUM = " . $currencyFormat($objectTotal, $objectArray[count($objectArray) - 1]->getCurrency()->getCode()) . "</strong></li><hr>" . $link;
        }
    }
}

