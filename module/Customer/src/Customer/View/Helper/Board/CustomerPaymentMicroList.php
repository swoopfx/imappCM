<?php
namespace Customer\View\Helper\Board;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;
use Transactions\Service\TransactionService;

/**
 * This viewHelper assist to display
 *
 * @author otaba
 *        
 */
class CustomerPaymentMicroList extends AbstractHelper implements ServiceLocatorAwareInterface
{

    private $servicelocator;

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
        return $this->servicelocator;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\ServiceLocatorAwareInterface::setServiceLocator()
     *
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->servicelocator = $serviceLocator;
        return $this;
    }

    public function __invoke($invoiceEntity)
    {
        $clientGeneralService = $this->getServiceLocator()
            ->getServiceLocator()
            ->get('Customer\Service\ClientGeneralService');
        $dateformat = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("ViewHelperManager")
            ->get("dateFormat");
        $em = $clientGeneralService->getEntityManager();
        $microPaymentEntity = $em->getRepository("Transactions\Entity\MicroPayment")->findBy(array(
            "invoice" => $invoiceEntity->getId()
        ));
        $frame = "";
        foreach ($microPaymentEntity as $payment) {
            $frame .= $this->frameee($payment, $invoiceEntity->getCurrency()->getCode());
        }
        
        return $frame;
    }

    private function frameee($payment, $currency)
    {
        $status = '';
        $class = " ";
        if($payment->getStatus()->getId() == TransactionService::TRANSACTION_STATUS_SUCCESS){
            $status = "<span class='plan fa fa-check-circle'><i> Paid</i></span> ";
            $class = "text-center text-success";
        }elseif ($payment->getStatus()->getId() == TransactionService::TRANSACTION_STATUS_FAILED){
            $status ="<span class='fa fa-times-circle'><i> Failed</i></span>";
            $class = "text-center text-danger";
        }elseif ($payment->getStatus()->getId() == TransactionService::TRANSACTION_STATUS_PENDING){
            $status ="<span  class='fa fa-warning'><i> Pending</i></span>";
            $class = "text-center text-warning";
        }
        $dateformat = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("ViewHelperManager")
            ->get("dateFormat");
        
            $myCurrencyFormat = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("ViewHelperManager")
            ->get("myCurrencyFormat");
        
        $fram = "<tr>
									<td>" . $dateformat($payment->getDueDate(), \IntlDateFormatter::MEDIUM, \IntlDateFormatter::NONE, "en_us") . "</td>
<td>".$myCurrencyFormat($payment->getValue(), $currency)."</td>
<td class='".$class."'>".$status."</td>
</tr>";
        return $fram;
    }
}

