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
class ProposalObjectListHelper extends AbstractHelper implements ServiceLocatorAwareInterface
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

    public function __invoke($proposalEntity)
    {
        $objectArray = $proposalEntity->getObject();
        
        $url = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("ViewHelperManager")
            ->get("url");
        
        // $GRT =
        $currencyFormat = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("ViewHelperManager")
            ->get("myCurrencyFormat");
        $frame = "";
        $disable = ($proposalEntity->getInvoice() != NULL ? ($proposalEntity->getInvoice()
            ->getStatus()
            ->getId() == InvoiceService::INVOICE_PAID_STATUS ? "disabled='disabled'" : "") : "");
        
        $json = json_encode(array(
            "type"=>"standard"
        ));
        
        $objectTotal = 0;
        $link = "<p style='text-align: center;'><a id='btn3' class='ajax_element btn btn-xs btn-default' data-json=".$json."  " . $disable . "data-href='" . $url('proposalmodal/default', array(
            'action' => 'selectproperty'
        )) . "'
							style='width: 100%;'>Select Property</a> OR <a id='btn3' class='ajax_element btn btn-xs btn-primary' data-json=".$json."  " . $disable . "data-href='" . $url('proposalmodal/default', array(
            'action' => 'registernewproperty'
        )) . "'
							style='width: 100%;'>Register a New Property</a></p>";
        
        if (count($objectArray) == 0) {
            return $link;
        } else {
            
            for ($i = 0; $i < count($objectArray); $i ++) {
                $objectTotal = $objectTotal + $objectArray[$i]->getValue();
                $frame .= "<li>
                            <p style='text-align: center;'>
                              " . $objectArray[$i]->getObjectName() . " (" . $currencyFormat($objectArray[$i]->getValue(), $objectArray[$i]->getCurrency()->getCode()) . ") <br> <a style='width: 100%;' href='" . $url("proposal/default", array(
                    "action" => "remove-object",
                    "id" => $objectArray[$i]->getId()
                )) . "' " . ($proposalEntity->getInvoice() == NULL ? "" : ($proposalEntity->getInvoice()
                    ->getStatus()
                    ->getId() == InvoiceService::INVOICE_PAID_STATUS ? "disabled='disabled'" : "")) . " class='btn btn-xs btn-danger confirmation'>Remove</a></p>
                          </li>";
            }
            return $frame . "<li><strong>Total Property SUM = " . $currencyFormat($objectTotal, $objectArray[count($objectArray) - 1]->getCurrency()->getCode()) . "</strong></li><hr>" . $link;
        }
    }
}

