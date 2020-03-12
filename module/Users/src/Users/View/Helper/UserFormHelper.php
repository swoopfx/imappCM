<?php
namespace Users\View\Helper;

use Zend\View\Helper\AbstractHelper;

/**
 *
 * @author swoopfx
 *        
 */
class UserFormHelper extends AbstractHelper
{

    public function __invoke($form)
    {
        
        /*
         * TODO - use this function to design the layout of the from
         * which would be called from the view of the action
         */
        $form->prepare();
        $output = $this->view->form()->openTag($form);
        $elements = $form->getElements();
        foreach ($elements as $element) {
            // $output = $this->view->formRo
        }
        ;
        
        $output = $this->view->form()->closeTag();
    }
}

?>