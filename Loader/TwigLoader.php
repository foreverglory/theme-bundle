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

    protected function findTemplate($template, $throw = true)
    {
        //todo: find formatPath Template first
        return parent::findTemplate($template, $throw);
    }

}
