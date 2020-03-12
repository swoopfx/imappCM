<?php
namespace Customer\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Customer\Service\CustomerService;

/**
 *
 * @author swoopfx
 *        
 */
class CustomerCategoryHelper extends AbstractHelper
{

    public function __construct()
    {
        
        // TODO - Insert your code here
    }

    public function __invoke($category)
    {
        $frame = "";
        switch ($category) {
            case CustomerService::CUSTOMER_CATEGORY_ORG: // ORGANISATIO
                
                $frame = "<button type='button' class='btn btn-success btn-xs'>ORGANISATION</button>";
                break;
            case CustomerService::CUSTOMER_CATEGORY_IND:
                $frame = "<button type='button' class='btn btn-warning btn-xs'>INDIVIDUAL</button>";
                break;
        }
        return $frame;
    }
}

