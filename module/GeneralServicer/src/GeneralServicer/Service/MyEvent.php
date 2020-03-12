<?php
namespace GeneralServicer\src\GeneralServicer\Service;

use Zend\EventManager\EventManager;

class MyEvent
{

    private $eventManager;

    // TODO - Insert your code here
    public function __construct()
    {

        // TODO - Insert your code here
    }

    public function getEventManager()
    {
        if (! $this->eventManager) {
            $this->eventManager = new EventManager(__CLASS__);
            return $this->eventManager;
        }
    }

    public function findMe($id)
    {
        $response = $this->getEventManager()->trigger("findMe.begin", $this, array(
            "id" => $id
        ));

        if ($response->count() > 0) {
            $id = $response->last();
        }

        $returnValue = "Original Value  {$id}";

        $this->getEventManager()->trigger("findMe.end", $this, array(
            "returnnValue" => $returnValue
        ));

        return $returnValue;
    }
}

