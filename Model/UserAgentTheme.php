<?php

/**
 * @author ForeverGlory
 */

namespace Glory\Bundle\ThemeBundle\Model;

class UserAgentTheme extends AbstractTheme {

    protected $device;

    protected function getDevice($userAgent) {
        if (!class_exists('DeviceDetector')) {
            throw new \LogicException('class DeviceDetector is exists. UserAgentTheme require "piwik/device-detector": "~1.0" ');
        }
        if (is_null($this->device)) {
            $deviceDetector = new \DeviceDetector($userAgent);
            $deviceDetector->parse();
            $device = $deviceDetector->getDevice();
            /* \DeviceDetector::$deviceTypes = array(
              'desktop',          // 0
              'smartphone',       // 1
              'tablet',           // 2
              'feature phone',    // 3
              'console',          // 4
              'tv',               // 5
              'car browser',      // 6
              'smart display',    // 7
              'camera'            // 8
              ); */
            $this->device = $device === '' ? '' : \DeviceDetector::$deviceTypes[$device];
        }
        return $this->device;
    }

    public function getThemes() {
        $themes = array();
        $userAgent = $this->container->get('request_stack')->getCurrentRequest()->headers->get('user-agent');
        //$device = $this->getDevice($userAgent);
        $device = 'desktop';
        if (in_array($device, array('desktop'))) {
            $themes[] = 'complete';
        } else {
            if (is_array($device, array('tablet', 'car browser', 'camera', 'smart display', 'console', 'tv'))) {
                $themes[] = 'custom-' . $device;
            }
            $themes[] = 'simple';
        }
        return $themes;
    }

}
