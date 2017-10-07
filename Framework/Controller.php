<?php

namespace Framework;

abstract class Controller
{
    const DEFAULT_LAYOUT = 'layout.phtml';
    
    const ADMIN_LAYOUT = 'admin_layout.phtml';
    
    protected $layout = self::DEFAULT_LAYOUT;
    
    protected $container;
    
    public function setContainer(ContainerInterface $container)
    {
        $this->container = $container;
    }
    
    public function setAdminLayout()
    {
        $this->layout = self::ADMIN_LAYOUT;
    }
    
    protected function render($view, array $args = [])
    {
        extract($args);
        
        $path = str_replace(['Controller', '\\'], '', get_class($this));
        $file = VIEW_DIR . $path . DS . $view;
        
        if (!file_exists($file)) {
            throw new \Exception("{$file} not found");
        }
        
        ob_start();
        require $file;
        $content = ob_get_clean();
        
        ob_start();
        require VIEW_DIR . $this->layout;
        $html = ob_get_clean();
        
        return new Response($html);
    }
}