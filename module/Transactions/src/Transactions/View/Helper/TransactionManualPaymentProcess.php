<?php
namespace Transactions\View\Helper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;
use Transactions\Service\TransactionService;

/**
 *
 * @author otaba
 *        
 */
class TransactionManualPaymentProcess extends AbstractHelper implements ServiceLocatorAwareInterface
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

    public function __invoke($manulProcessEntity)
    {
        $dateFormat = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("ViewHelperManager")
            ->get("dateFormat");
        
        $myCurrency = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("ViewHelperManager")
            ->get("myCurrencyFormat");
        
        $url = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("ViewHelperManager")
            ->get("url");
        $paymentMode = $manulProcessEntity->getPaymentMode()->getId();
        $frame = "";
        switch ($paymentMode) {
            case TransactionService::TRANSACTION_PAYMENT_MODE_CASH:
                foreach ($manulProcessEntity->getCash() as $cash) {
                    $frame .= "<tr><td>Amount Paid: " . $myCurrency($cash->getAmountPaid(), $manulProcessEntity->getCurrency()->getCode()) . "<br><strong> Collected By: </strong>" . $cash->getCollectedBy() . "<br><small><strong>Paid On: </strong>" . $dateFormat($cash->getDatePaid(), \IntlDateFormatter::MEDIUM, \IntlDateFormatter::SHORT, "en_us") . "</small></td><td><a style='width:100%;' class='btn btn-info btn-xs' href='" . $url("invoice/default", array(
                        "action" => "view",
                        "id" => $manulProcessEntity->getInvoice()->getId()
                    )) . "'>Process Payment</a></td></tr>";
                }
                
                break;
            case TransactionService::TRANSACTION_PAYMENT_MODE_BANK_TRANSFER:
                foreach ($manulProcessEntity->getBankTransfer() as $transfer) {
                    $frame .= "<tr><td>Amount Transfered: " . $myCurrency($transfer->getAmountPaid(), $manulProcessEntity->getCurrency()->getCode()) . "<br><strong> Transfered From: </strong>" . $transfer->getTransferFrom() . "<br><small><strong>Transfered On: </strong>" . $dateFormat($transfer->getTransferDate(), \IntlDateFormatter::MEDIUM, \IntlDateFormatter::SHORT, "en_us") . "</small></td><td><a style='width:100%;' class='btn btn-info btn-xs' href='" . $url("invoice/default", array(
                        "action" => "view",
                        "id" => $manulProcessEntity->getInvoice()->getId()
                    )) . "'>Process Payment</a></td></tr>";
                }
                // return $this->microFrame($frame);
                break;
            
            case TransactionService::TRANSACTION_PAYMENT_MODE_BANK_DEPOSIT:
                
                foreach ($manulProcessEntity->getBankDeposit() as $deposit) {
                    $frame .= "<tr><td>Amount Deposited: " . $myCurrency($deposit->getAmountPaid(), $manulProcessEntity->getCurrency()->getCode()) . "<br><strong> Deposited By : </strong>" . $deposit->getDepositorName() . "<br><small><strong>Transfered On: </strong>" . $dateFormat($deposit->getDepositDate(), \IntlDateFormatter::MEDIUM, \IntlDateFormatter::SHORT, "en_us") . "</small></td><td><a style='width:100%;' class='btn btn-info btn-xs' href='" . $url("invoice/default", array(
                        "action" => "view",
                        "id" => $manulProcessEntity->getInvoice()->getId()
                    )) . "'>Process Payment</a></td></tr>";
                }
                break;
        }
        return $this->microFrame($frame);
    }

    public function microFrame($data)
    {
        $frame = "<table 
								class='table table-striped table-bordered'>
								


								<tbody>
									" . $data . "
									
								</tbody>
							</table>";
        
        return $frame;
    }
}

