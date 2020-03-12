<?php
namespace Customer\View\Helper\CLaims;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;
use Comments\Service\CommentService;

class CustomerClaimsCommentViewHelper extends AbstractHelper implements ServiceLocatorAwareInterface
{

    private $serviceLocator;

    public function __construct()
    {

        // TODO - Insert your code here
    }

    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        return $this;
    }

    public function __invoke($commentCollection)
    {
        $dateformat = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("ViewHelperManager")
            ->get("dateformat");
        $frame = "";
        // var_dump(count($commentCollection));
        if (count($commentCollection) == 0) {
            $frame = "No comment available";

            // return $frame;
        } else {
            foreach ($commentCollection as $comment) {
                $frame .= "<li class='list-group-item'>
                    <div class='media v-middle margin-v-0-10'>
                      <div class='media-body'>
                        <p class='text-subhead'>
                         
                          <a href='#'> : {$comment->getTopic()}</a>
                          <span class='text-caption text-light'>{$dateformat($comment->getCreatedOn(), \IntlDateFormatter::MEDIUM, \IntlDateFormatter::NONE, "en_us")}</span>
                        </p>
                      </div>
                      
                    <p>{$comment->getComment()}</p>
                    <p class='text-light'><span class='caption'>By:</span> <strong>" . CommentService::commentorName($comment->getCommentor()) . "</strong></p>
                  </li>";
            }
        }
        return $frame;
    }
}

