<?php

/**
 * @author ForeverGlory
 */

namespace Glory\ThemeBundle\Model;

use Symfony\Component\DependencyInjection\ContainerInterface;

abstract class AbstractTheme implements ThemeInterface {

    /**
     * ContainerInterface 
     */
    protected $container;
    protected $theme;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function get() {
        return $this->theme;
    }

    public function set($theme) {
        $this->theme = $theme;
        return $this;
    }

}
