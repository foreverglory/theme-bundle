<?php

/**
 * @author ForeverGlory
 */

namespace Glory\Bundle\ThemeBundle\Manager;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Glory\Bundle\ThemeBundle\Model\Theme;
use Glory\Bundle\ThemeBundle\Switcher\ThemeSwitcherInterface;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

class ThemeManager
{

    /**
     * ContainerInterface 
     */
    protected $container;

    /**
     * @var Request 
     */
    protected $request;
    protected $themes = [];
    protected $default;
    protected $defaultTheme;
    protected $currentTheme;
    protected $switch;

    public function __construct(ContainerInterface $container, \Symfony\Component\HttpFoundation\RequestStack $requestStack)
    {
        $this->container = $container;
        $this->request = $requestStack->getCurrentRequest();
    }

    public function setThemes($themes)
    {
        if (!empty($themes) && is_array($themes)) {
            foreach ($themes as $name => $theme) {
                $this->themes[$name] = new Theme($theme);
            }
        }
        return $this;
    }

    public function getThemes()
    {
        return $this->themes;
    }

    public function setDefault($default = null)
    {
        if (!empty($default) && !$this->themeExists($default)) {
            throw new \RuntimeException(sprintf('%s theme not exists.', $default));
        }
        $this->default = $default;
        return $this;
    }

    public function setSwitchClass($class = null)
    {
        if (!empty($class)) {
            if (!class_exists($class)) {
                throw new \RuntimeException(sprintf('%s theme switch class not exists.', $class));
            }
            $this->switch = new $class();
            if (!$this->switch instanceof ContainerAwareInterface) {
                throw new \RuntimeException(sprintf('%s theme switch class must instanceof ContainerAwareInterface.', $class));
            } elseif (!$this->switch instanceof ThemeSwitcherInterface) {
                throw new \RuntimeException(sprintf('%s theme switch class must instanceof ThemeSwitchInterface.', $class));
            }
            $this->switch->setContainer($this->container);
            $this->switch->setThemes($this->themes);
        }
        return $this;
    }

    public function themeExists($name)
    {
        return array_key_exists($name, $this->themes);
    }

    /**
     * 
     * @return Theme
     */
    public function getCurrentTheme()
    {
        if (empty($this->currentTheme)) {
            foreach ($this->getThemes() as $theme) {
                $expressionLanguage = new ExpressionLanguage();
                if ($expressionLanguage->evaluate($theme->getCondition(), [
                            'container' => $this->container,
                            'request' => $this->request
                        ])
                ) {
                    return $this->currentTheme = $theme;
                }
            }
            if ($this->switch) {
                $theme = $this->switch->getChecked();
            }
            if (empty($theme)) {
                $theme = $this->default;
            }
            if (!empty($theme)) {
                $this->currentTheme = $this->getTheme($theme);
            }
        }
        return $this->currentTheme;
    }

    public function getTheme($name)
    {
        if (!$this->themeExists($name)) {
            throw new \RuntimeException(sprintf('%s theme is not exists.', $name));
        }
        return $this->themes[$name];
    }

    public function getDefaultTheme()
    {
        if ($this->defaultTheme) {
            $this->defaultTheme = $this->getTheme($this->default);
        }
        return $this->defaultTheme;
    }

    public function formatThemePath()
    {
        
    }

}
