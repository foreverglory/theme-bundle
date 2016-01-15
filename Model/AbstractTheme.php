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
    
    protected $root;
    protected $path;
    protected $file;

    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }

    public function getThemes() {
        return array();
    }
    
    public function getRoot()
    {
        return $this->root;
    }
    
    public function getPath()
    {
        return $this->path;
    }
    
    public function getFile()
    {
        return $this->file;
    }

}
