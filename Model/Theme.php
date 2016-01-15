<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Glory\ThemeBundle\Model;

/**
 * Description of Theme
 *
 * @author ForeverGlory
 */
class Theme
{

    protected $name;
    protected $dir;
    protected $format;
    protected $empty = true;

    public function __construct($data = array())
    {
        if (!empty($data)) {
            foreach ($data as $key => $val) {
                $this->$key = $val;
            }
            $this->empty = false;
        }
    }

    public function getDir()
    {
        return $this->dir;
    }

    public function isEmpty()
    {
        return $this->empty;
    }

    public function getName()
    {
        return $this->name;
    }

    public function generatePath($bundle, $path, $file)
    {
        return $this->dir . '/' . $this->formatBundle($bundle) . '/' . $this->formatPath($path) . '/' . $this->formatFile($file);
    }

    public function formatBundle($bundle)
    {
        return $bundle->getName();
    }

    public function formatPath($path)
    {
        return $path;
    }

    public function formatFile($file)
    {
        return $file;
    }

}
