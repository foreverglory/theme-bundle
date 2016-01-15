<?php

namespace Glory\ThemeBundle\Model;

use Symfony\Component\DependencyInjection\ContainerInterface;
/**
 * Description of ThemeFormat
 *
 * @author ForeverGlory
 */
class ThemeFormat implements ThemeFormatInterface
{

    protected $container;
    protected $theme;
    
    


    public function setTheme($theme)
    {
        $this->theme = $theme;
        return $this;
    }

    public function formatPath()
    {
        
    }

}
