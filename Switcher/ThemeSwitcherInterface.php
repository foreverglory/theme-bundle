<?php

namespace Glory\Bundle\ThemeBundle\Switcher;

/**
 * Description of ThemeSwitchInterface
 *
 * @author ForeverGlory
 */
interface ThemeSwitcherInterface
{
    public function setThemes($themes);

    public function getChecked();
}
