<?php
namespace Navigations\Service\Factory;

use Zend\Navigation\Service\DefaultNavigationFactory;

class MainNavigationFactory extends DefaultNavigationFactory
{

    protected function getName()
    {
        return 'mnavigation';
    }
}