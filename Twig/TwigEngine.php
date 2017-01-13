<?php

/*
 * This file is part of the current project.
 * 
 * (c) ForeverGlory <http://foreverglory.me/>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Glory\Bundle\ThemeBundle\Twig;

use Symfony\Bundle\TwigBundle\TwigEngine as Engine;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

/**
 * Description of TwigEngine
 *
 * @author ForeverGlory <foreverglory@qq.com>
 */
class TwigEngine extends Engine
{

    /**
     * @var EngineInterface 
     */
    protected $twigEngine;

    public function __construct(EngineInterface $engine)
    {
        
    }

}
