<?php
namespace Welcome\View\Helper;

use Zend\View\Helper\AbstractHelper;

/**
 * This class creates an helper for the package pricing page
 * Such that it collects a stringand a boolean
 * if the boolean is true the class shows green else it show red
 * 
 * @author swoopfx
 *        
 */
class PackageViewHelper extends AbstractHelper
{

    public function __invoke($cond, $context)
    {
        $output = "<li class='available'>
										<div class='icon-holder'>
											<i class='" . $this->condition($cond) . "'> </i>
										</div>
										<div class='desc'>
											<span class='text-black'>" . $context . " </span>

										</div>
									</li>";
        
        return $output;
    }

    private function condition($cond)
    {
        if ($cond) {
            return "fa fa-check text-success";
        } else {
            return "fa fa-times text-error";
        }
    }
}

?>