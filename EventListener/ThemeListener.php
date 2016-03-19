<?php

namespace Glory\Bundle\ThemeBundle\EventListener;

use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ThemeListener
{

    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function onKernelController(FilterControllerEvent $event)
    {
        if (HttpKernelInterface::MASTER_REQUEST === $event->getRequestType()) {
            $container = $this->container;
            $theme = $container->get('glory_theme.manager')->getCurrentTheme();
            if ($theme) {
                $twigLoader = $container->get('twig.loader');
                $twigLoader->prependPath($theme->getDir());
            }
        }
    }

}
