<?php
namespace GeneralServicer\View\Helper;

use Zend\I18n\View\Helper\CurrencyFormat;

/**
 *
 * @author swoopfx
 *        
 */
class MyCurrencyHelper extends CurrencyFormat
{

   
    public function __construct()
    {
        parent::__construct();
    }
    
    public function __invoke($number, $currencyCode = "NGN",  $showDecimals=TRUE, $locale=NULL, $pattern=NULL){
        $string = parent::__invoke($number, $currencyCode, $showDecimals, $locale, $pattern);
        if(FALSE !== \strpos($string, 'NGN')){
            $string = \str_replace('NGN', '&#x20A6;', $string);
        }else if(FALSE !== "US$"){
        	$string = \str_replace('US$', '&#36;', $string);
        }
        
        return $string;
    }
}

