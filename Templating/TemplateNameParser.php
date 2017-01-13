<?php

/*
 * This file is part of the current project.
 * 
 * (c) ForeverGlory <http://foreverglory.me/>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Glory\Bundle\ThemeBundle\Templating;

use Symfony\Bundle\FrameworkBundle\Templating\TemplateNameParser as BaseTemplateNameParser;

/**
 * Description of TemplateNameParser
 *
 * @author ForeverGlory <foreverglory@qq.com>
 */
class TemplateNameParser extends BaseTemplateNameParser
{

    public function parse($name)
    {
        if ($name instanceof TemplateReferenceInterface) {
            return $name;
        } elseif (isset($this->cache[$name])) {
            return $this->cache[$name];
        }
        $template = parent::parse($name);
        //todo: 此处可以进行更改模板位置
        //$template->set('controller', 'Demo');
        //$template->set('name', 'demo');
        return $this->cache[$name] = $template;
    }

}
