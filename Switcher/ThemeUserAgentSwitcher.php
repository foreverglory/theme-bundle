<?php

namespace Glory\ThemeBundle\Switcher;

/**
 * Description of ThemeUserAgentSwitcher
 *
 * @author ForeverGlory
 */
class ThemeUserAgentSwitcher extends ThemeSwitcher implements ThemeSwitcherInterface
{

    protected $device;

    public function getChecked()
    {
        if (empty($this->device)) {
            if (!$this->container->has('mobile_detect.mobile_detector')) {
                throw new \LogicException(sprintf('must dependence MobileDetectBundle, you can ["suncat/mobile-detect-bundle": "~0.10"] add it'));
            }
            $mobileDetector = $this->container->get('mobile_detect.mobile_detector');
            if ($mobileDetector->isMobile()) {
                $this->device = 'mobile';
            } elseif ($mobileDetector->isTablet()) {
                $this->device = 'tablet';
            } else {
                //todo: more device, you decision
                $this->device = 'desktop';
            }
        }
        return $this->device;
    }

}
