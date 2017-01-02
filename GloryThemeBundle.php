<?php

namespace Glory\Bundle\ThemeBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Glory\Bundle\ThemeBundle\DependencyInjection\Compiler\ThemePass;

class GloryThemeBundle extends Bundle
{

    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new ThemePass());
    }

}
