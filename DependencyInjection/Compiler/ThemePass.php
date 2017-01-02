<?php

/*
 * This file is part of the current project.
 * 
 * (c) ForeverGlory <http://foreverglory.me/>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Glory\Bundle\ThemeBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

/**
 * Description of ThemeCompiler
 *
 * @author ForeverGlory <foreverglory@qq.com>
 */
class ThemePass implements CompilerPassInterface
{

    public function process(ContainerBuilder $container)
    {
        //$twigFilesystemLoaderDefinition = $container->getDefinition('twig.loader');
        //$twigFilesystemLoaderDefinition->addMethodCall('addPath', array('D:\Projects'));
    }

}
