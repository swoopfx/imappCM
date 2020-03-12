<?php
namespace General\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use General\Controller\GeneralController;

/**
 *
 * @author otaba
 *        
 */
class GeneralControllerFactory implements FactoryInterface
{

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $ctr = new GeneralController();
        $generalService = $serviceLocator->getServicelocator()->get("GeneralServicer\Service\GeneralService");
        $invoiceService = $serviceLocator->getServiceLocator()->get("Transactions\Service\InvoiceService");
        $raveCardPaymentService = $serviceLocator->getServiceLocator()->get("Transactions\Service\RaveCardPaymentBrokerService");
        $smsService = $serviceLocator->getServiceLocator()->get("SMS\Service\SMSService");
        
        $cardPinForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get("Transactions\Form\CardPinForm");

        $otpForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get('Transactions\Form\OTPForm');

        $renderer = $generalService->getViewRender();
        $ctr->setEntityManager($generalService->getEntityManager())
            ->setInvoiceService($invoiceService)
            ->setRenderer($renderer)
            ->setGeneralService($generalService)
            ->setOtpForm($otpForm)
            ->setCardPinForm($cardPinForm)
            ->setSmsService($smsService)
//             ->setTra
            ->setRaveCardPaymentService($raveCardPaymentService);
        return $ctr;
    }
}

