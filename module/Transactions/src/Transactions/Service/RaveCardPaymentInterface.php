<?php
namespace Transactions\Service;

/**
 *
 * @author otaba
 *        
 */
interface RaveCardPaymentInterface
{
    
    public function initiateCardPayment();
    
    public function confirmCardPayment();
    
    public function validateCardPayment();
}

