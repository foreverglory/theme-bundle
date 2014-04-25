<?php

/**
 * @author ForeverGlory
 */

namespace Glory\ThemeBundle\Manager;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Glory\ThemeBundle\Model\ThemeInterface;

class ThemeManager {

    /**
     * ContainerInterface 
     */
    protected $container;
    protected $model;
    protected $path;
    protected $themes;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function getModel() {
        if (is_null($this->model)) {
            if ($this->container->hasParameter('glory_theme_model')) {
                $class = $this->container->getParameter('glory_theme_model');
                $this->model = new $class();
                if ($this->model instanceof ContainerAwareInterface) {
                    $this->model->setContainer($this->container);
                }
                if (!$this->model instanceof ThemeInterface) {
                    throw new \LogicException('glory_theme model must implements \\Glory\\ThemeBundle\\Model\\ThemeInterface');
                }
            }
        }
        return $this->model;
    }

    public function getThemePath() {
        if (is_null($this->path)) {
            $this->path = $this->container->getParameter('glory_theme_path');
        }
        return $this->path;
    }

    public function getThemes() {
        if (is_null($this->themes)) {
            $model = $this->getModel();
            if (is_null($model)) {
                $this->themes = array();
            } else {
                $this->themes = array_reverse($model->getThemes());
            }
        }
        return $this->themes;
    }

    public function enableTheme($themes = null) {
        if (is_null($themes)) {
            $themes = $this->getThemes();
        }
        if (empty($themes)) {
            return;
        } elseif (!is_array($themes)) {
            $themes = array($themes);
        }
        $themePath = $this->getThemePath();
        $twigLoader = $this->container->get('twig.loader');
        $this->addPaths($twigLoader, $this->container->getParameter('kernel.root_dir') . '/Resources/views/' . $themePath, $themes);
        foreach ($this->container->getParameter('kernel.bundles') as $bundle => $class) {
            $reflection = new \ReflectionClass($class);
            $path = dirname($reflection->getFilename()) . '/Resources/views/' . $themePath;
            $this->addPaths($twigLoader, $path, $themes, $bundle);
            $path = $this->container->getParameter('kernel.root_dir') . '/Resources/' . $bundle . '/views/' . $themePath;
            $this->addPaths($twigLoader, $path, $themes, $bundle);
        }
    }

    private function addPaths($twigLoader, $themePath, $themes, $bundle = '') {
        $namespace = $bundle;
        if ('Bundle' === substr($bundle, -6)) {
            $namespace = substr($bundle, 0, -6);
        }
        foreach ($themes as $theme) {
            if (is_dir($path = $themePath . '/' . $theme)) {
                if (empty($namespace)) {
                    $twigLoader->prependPath($path);
                } else {
                    $twigLoader->prependPath($path, $namespace);
                }
            }
        }
    }

}
