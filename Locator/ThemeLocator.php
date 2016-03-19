<?php

namespace Glory\Bundle\ThemeBundle\Locator;

use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Config\FileLocatorInterface;
use Glory\Bundle\ThemeBundle\Manager\ThemeManager;

/**
 * Description of ThemeLocator
 *
 * @author ForeverGlory
 */
class ThemeLocator implements FileLocatorInterface
{

    private $kernel;
    private $manager;
    private $locator;

    /**
     * Constructor.
     *
     * @param KernelInterface $kernel A KernelInterface instance
     * @param null|string     $path   The path the global resource directory
     * @param array           $paths  An array of paths where to look for resources
     */
    public function __construct(KernelInterface $kernel, ThemeManager $manager, FileLocatorInterface $locator)
    {
        $this->kernel = $kernel;
        $this->manager = $manager;
        $this->locator = $locator;
    }

    /**
     * {@inheritdoc}
     */
    public function locate($file, $currentPath = null, $first = true)
    {
        $theme = $this->manager->getCurrentTheme();
        if ($theme) {
            $template = $this->locateTheme($file, $theme, $first);
            if ($template) {
                return $template;
            }
        }
        return $this->locator->locate($file, $currentPath, $first);
    }

    private function locateTheme($name, $theme, $first = true)
    {
        $files = array();
        $paths = explode('/', substr($name, 1));
        $bundleName = array_shift($paths);
        array_shift($paths);
        $fileName = array_pop($paths);
        $path = implode('/', $paths);
        $bundles = $this->kernel->getBundle($bundleName, false);
        foreach ($bundles as $bundle) {
            if (file_exists($file = $theme->generatePath($bundle, $path, $fileName))) {
                $files[] = $file;
            }
        }
        return $first && $files ? $files[0] : $files;
    }

}
