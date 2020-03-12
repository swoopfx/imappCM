<?php
namespace Customer\View\Helper\Board;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 *
 * @author otaba
 *        
 */
class CustomerPaymentAmountPayableHelper extends AbstractHelper implements ServiceLocatorAwareInterface
{

    private $serviceLocator;

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

    public function __invoke($invoiceEntity)
    {
        $myCurrencyFormat = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("ViewHelperManager")
            ->get("myCurrencyFormat");
        
        $transactionService = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("Transactions\Service\TransactionService");
        $res = $transactionService->getpayableAmount($invoiceEntity);
        if ($res != NULL) {
            if ($invoiceEntity->getIsMicro() == TRUE) {
                return "<strong>Payable : </strong>".$myCurrencyFormat($res->getValue(), $invoiceEntity->getCurrency()->getCode()) ;
            } else {
                return "<strong>Payable : </strong>".$myCurrencyFormat($invoiceEntity->getAmount(), $invoiceEntity->getCurrency()->getCode());
            }
        }
        
        // return "HHEJ";
    }
}

