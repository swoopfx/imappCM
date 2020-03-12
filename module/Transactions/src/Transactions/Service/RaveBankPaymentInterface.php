<?php
namespace Transactions\Service;

/**
 *
 * @author otaba
 *        
 */
interface RaveBankPaymentInterface
{
    public function initiateBankPayment();
    
    public function validatePayment();
    
    public function confirmPayment();
}

