<?php
namespace GeneralServicer\View\Helper;

use Zend\View\Helper\AbstractHelper;

/**
 *
 * @author swoopfx
 *        
 */
class StatusViewHelper extends AbstractHelper
{

    protected $entityManager;

    protected $serviceLocator;

    public function __invoke($state)
    {
        
        /**
         * Display the selected ststaus
         * if the selected ststaus is processing
         * show yellow span
         */
        $stateId = $state->getId();
        $stateWord = $state->getStatusWord();
        $ho = '';
        switch ($stateId) {
            case '6':
            case '5':
            case '10':
            case '1':
            case '2':
            case '3':
            case '11':
            case "75":
            case '12':
            case "47":
            case "43":
            case "71":
            case "73":
            case '61':
            case "27":
                $ho = $this->frame($stateWord, 'label label-warning');
                break;
            
            case '7':
            case '8':
            case '13':
            case '14':
            case '17':
            case '19':
            case '25':
            case '40':
            case '90':
            case "72":
           
            case "74":
            case '21':
            case '22':
            case '26':
            case '55':
            case '60':
                
                $ho = $this->frame($stateWord, 'label label-success');
                break;
            
            case '4':
            case '15':
            case '16':
            case '9':
            case '18':
            case '20':
            case '38':
            case '91':
           
            case '24':
            case '41':
            case '56':
            case '57':
                
                $ho = $this->frame($stateWord, 'label label-danger');
                break;
            default:
        }
        
        return $ho;
    }

    private function frame($info, $class)
    {
        $frame = "<span style='width: 100%' class='" . $class . "'>" . $info . "</span>";
        return $frame;
    }
}
