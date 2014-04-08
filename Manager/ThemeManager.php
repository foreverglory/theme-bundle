<?php

/**
 * @author ForeverGlory
 */

namespace Glory\ThemeBundle\Manager;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Glory\ThemeBundle\Model\ThemeInterface;

class ThemeManager {

    /**
     * ContainerInterface 
     */
    protected $container;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function getTheme() {
        $themeModel = new $this->container->getParameter('glory_theme_model') . '' . ($this->container);
    }

}
