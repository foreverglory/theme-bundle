<?php

namespace Glory\ThemeBundle\Model;

/**
 *
 * @author ForeverGlory
 */
interface ThemeFormatInterface
{
    public function setTheme($theme);
    public function formatPath();
}
