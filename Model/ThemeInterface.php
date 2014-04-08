<?php

/**
 * @author ForeverGlory
 */

namespace Glory\ThemeBundle\Model;

interface ThemeInterface {

    public function get($default = null);

    public function set($theme);
}
