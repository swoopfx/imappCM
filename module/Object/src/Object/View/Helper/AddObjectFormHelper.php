<?php
namespace Object\View\Helper;

use Zend\View\Helper\AbstractHelper;

/**
 *
 * @author swoopfx
 *        
 */
class AddObjectFormHelper extends AbstractHelper
{

    /**
     */
    public function __invoke($form)
    {
        $output = $this->view->form()->openTag();
        $elements = $form->getElements();
        foreach ($elements as $element) {
            $output .= $this->view->formRow();
        }
        
        $output = $this->view->form()->closeTag();
    }
}

?>