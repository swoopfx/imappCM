<?php
namespace GeneralServicer\Service;

/**
 *
 * @author swoopfx
 *        
 */
class CurrencyService
{

    const NIGERIA_NAIRA = 1;
    
    const UNITED_STATE_DOLLAR = 2;
    
    const NIGERIA_NAIRA_CODE = "NGN";
    public function __construct()
    {}
    
    public function cleanInputedValue($value){
        $val = str_replace(",", "", $value);
        return $val;
    }
    
    public static function  cleanInputValueStatic($value){
        $val = str_replace(",", "", $value);
        return $val;
    }
    
    public static function myCurrency($string){
        if(FALSE !== \strpos($string, 'NGN')){
         $string = \str_replace('NGN', '&#x20A6;', $string);
        }
        
    }
}

