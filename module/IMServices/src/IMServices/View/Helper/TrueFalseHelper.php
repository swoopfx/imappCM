<?php
namespace IMServices\View\Helper;

use Zend\View\Helper\AbstractHelper;

/**
 *
 * @author otaba
 *        
 */
class TrueFalseHelper extends AbstractHelper
{

    /**
     */
    public function __construct()
    {
        
        // TODO - Insert your code here
    }

    public function __invoke($data){
        if($data == 1){
            return "<span class='badge bg-green'>TRUE</span>";
        }else{
            return "<span class='badge bg-red'>FALSE</span>";
        }
    }
}

