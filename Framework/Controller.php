<?php

namespace Framework;

abstract class Controller
{
    protected function render($view, array $args = [])
    {
        extract($args);
        
        $path = str_replace(['Controller', '\\'], '', get_class($this));
        ob_start();
        require VIEW_DIR . $path . DS . $view;
        
        return ob_get_clean();
    }
}