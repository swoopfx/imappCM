<?php
namespace Welcome\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 *
 * @author swoopfx
 *        
 */
class BrokerController extends AbstractActionController
{

    private $entityManager;

    private $options;

    private $translator;

    public function onDispatch(\Zend\Mvc\MvcEvent $e)
    {
        $response = parent::onDispatch($e);
        $this->layout()->setTemplate('layout/welcome');
        return $response;
    }

    public function __construct()
    {
        
        // TODO - Insert your code here
    }

    public function priceAction()
    {
        $price = NULL;
        $em = $this->entityManager;
        /**
         * Get all objects where value equals the agent
         * That is we are calling all information related to the agent in the feild
         * First get the id of the agent //optional it could be hardcoded
         *
         * @var unknown $repo
         */
        // $agentId = $em->getRepository('Settings\Entity\Packages')->findBy(array(
        // 'packageCategory'=>1,
        // ));
        $repo = $em->getRepository('Settings\Entity\Packages')->findBy(array(
            'packageCategory' => 2
        )); // TODO - Use this to get the object of a certain valus which is u
        
        $view = new ViewModel(array(
            'price' => $repo
        ));
        // select all pricing options form the database
        return $view;
    }

    public function informationAction()
    {
        $view = new ViewModel();
        return $view;
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
    }

    public function setOptions($op)
    {
        $this->options = $op;
    }

    public function setTranslator($tr)
    {
        $this->translator = $tr;
    }
}

?>