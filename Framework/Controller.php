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
        $content = ob_get_clean();
        
        ob_start();
        require VIEW_DIR . 'layout.phtml';
        
        return ob_get_clean();
    }
}