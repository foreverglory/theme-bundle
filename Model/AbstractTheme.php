<?php

/**
 * @author ForeverGlory
 */

namespace Glory\ThemeBundle\Model;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

abstract class AbstractTheme implements ThemeInterface, ContainerAwareInterface {

    /**
     * ContainerInterface 
     */
    protected $container;
    protected $theme;

    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }

    public function getThemes() {
        return array();
    }

}
