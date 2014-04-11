<?php

namespace Glory\ThemeBundle\EventListener;

use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Glory\ThemeBundle\Manager\ThemeManager;

class ThemeListener {

    /**
     *
     * @var ThemeManager
     */
    protected $themeManager;

    public function __construct(ThemeManager $themeManager) {
        $this->themeManager = $themeManager;
    }

    public function onKernelController(FilterControllerEvent $event) {
        if (HttpKernelInterface::MASTER_REQUEST === $event->getRequestType()) {
            $this->themeManager->enableTheme();
        }
    }

}
