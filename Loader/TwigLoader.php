<?php

namespace Glory\Bundle\ThemeBundle\Loader;

use Symfony\Bundle\TwigBundle\Loader\FilesystemLoader;

/**
 * Description of TwigLoader
 *
 * @author foreverglory
 */
class TwigLoader extends FilesystemLoader
{

    /**
     * Adds a path where templates are stored.
     *
     * @param string $path      A path where to look for templates
     * @param string $namespace A path name
     *
     * @throws Twig_Error_Loader
     */
    public function addPath($path, $namespace = self::MAIN_NAMESPACE)
    {
        if (in_array($namespace, [])) {
            //增加路径
        }
        parent::addPath($path, $namespace);
    }

    protected function findTemplate($template, $throw = true)
    {
        //todo: find formatPath Template first
        return parent::findTemplate($template, $throw);
    }

    protected function parseName($name, $default = self::MAIN_NAMESPACE)
    {
        if (isset($name[0]) && '@' == $name[0]) {
            if (false === $pos = strpos($name, '/')) {
                throw new Twig_Error_Loader(sprintf('Malformed namespaced template name "%s" (expecting "@namespace/template_name").', $name));
            }
            //todo: 这里将替换模板 $namespace, $shortname;
            $namespace = substr($name, 1, $pos - 1);
            $shortname = substr($name, $pos + 1);
            $shortname = 'demo/demo.html.twig';
            return array($namespace, $shortname);
        }

        return array($default, $name);
    }

}
