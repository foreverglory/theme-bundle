<?php

/**
 * @author ForeverGlory
 */

namespace Glory\Bundle\ThemeBundle\Switcher;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

class ThemeSwitcher implements ThemeSwitcherInterface, ContainerAwareInterface
{

    /**
     * ContainerInterface 
     */
    protected $container;
    protected $themes;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function setThemes($themes)
    {
        $this->themes = $themes;
        return $this;
    }

    /**
     * get Current theme
     * @return string
     */
    public function getChecked()
    {
        return '';
    }

}
