<?php

namespace Glory\ThemeBundle\Switcher;

/**
 * Description of ThemeUserAgentSwitcher
 *
 * @author ForeverGlory
 */
class ThemeMobileSwitcher extends ThemeSwitcher implements ThemeSwitcherInterface
{

    protected $isMobile;

    public function getChecked()
    {
        if (!isset($this->isMobile)) {
            if (!$this->container->has('mobile_detect.mobile_detector')) {
                throw new \LogicException(sprintf('must dependence MobileDetectBundle, you can ["suncat/mobile-detect-bundle": "~0.10"] add it'));
            }
            $mobileDetector = $this->container->get('mobile_detect.mobile_detector');
            if ($mobileDetector->isMobile()) {
                $this->isMobile = true;
            } else {
                $this->isMobile = false;
            }
        }
        return $this->isMobile ? 'mobile' : '';
    }

}
