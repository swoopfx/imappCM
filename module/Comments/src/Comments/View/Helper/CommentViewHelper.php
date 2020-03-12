<?php
namespace Comments\View\Helper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;
use Comments\Service\CommentService;

class CommentViewHelper extends AbstractHelper implements ServiceLocatorAwareInterface
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
        $dateformat = $this->getServiceLocator()->getServiceLocator()->get("ViewHelperManager")->get("dateformat");
        $frame = "";
//         var_dump(count($commentCollection));
        if (count($commentCollection) == 0) {
            $frame = "No comment available";
           
//             return $frame;
        } else {
            foreach ($commentCollection as $comment) {
                $frame .= "<li>
                        <div class='block'>
                          <div class='block_content'>
                            <h2 class='title'>
                                              <a>{$comment->getTopic()}</a>
                                          </h2>
                            <div class='byline'>
                              <span>{$dateformat($comment->getCreatedOn(), \IntlDateFormatter::MEDIUM, \IntlDateFormatter::NONE, "en_us")}</span> by <strong>".CommentService::commentorName($comment->getCommentor())."</strong>
                            </div>
                            <p class='excerpt'>{$comment->getComment()}
                            </p>
                          </div>
                        </div>
                      </li>";
            }
            
           
        }
        $frame = "<ul class='list-unstyled timeline widget top_profiles scroll-view'> {$frame}</ul>";
        return $frame;
    }
}

