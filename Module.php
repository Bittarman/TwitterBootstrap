<?php

namespace TwitterBootstrap;

use Zend\Module\Manager,
    Zend\EventManager\StaticEventManager,
    Zend\Module\Consumer\AutoloaderProvider;

class Module implements AutoloaderProvider
{
    protected $view;
    protected $config;

    public function init(Manager $moduleManager)
    {
        $events = StaticEventManager::getInstance();
        $events->attach('bootstrap', 'bootstrap', array($this, 'initializeView'), 110);
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\\Loader\\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\\Loader\\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                )
            )
        );
    }

    public function getConfig($env = null)
    {
        if (!$this->config) {
            $this->config = include __DIR__ . '/config/module.config.php';
        }
        return $this->config;
    }

    public function initializeView($e)
    {
        $app    = $e->getParam('application');
        $view   = $this->getView($app);
        $config = $e->getParam('config');
        $config = $config['twitterbootstrap'];
        if (isset($config['css_path'])) {
            $view->headLink()->appendStylesheet($config['css_path']);
        }
        $plugins = isset($config['plugins']) ? $config['plugins'] : array();
        if (is_object($plugins)) {
            $plugins = $plugins->toArray();
        }
        if (isset($config['theme'])) {
            if (isset($config['themes'][$config['theme']]['plugins'])){
                // Merge plugin config with base theme config
                $themePlugins = $config['themes'][$config['theme']]['plugins'];
                if (is_object($themePlugins)) {
                    $themePlugins = $themePlugins->toArray();
                }
                $plugins = array_replace_recursive($plugins, $themePlugins);
            }
            //$view->resolver()->addPath(__DIR__ . '/views/'.$config['theme']);
        }
        foreach ($plugins as $plugin) {
            $view->headScript()->appendFile($config['plugin_paths'][$plugin]);
        }
        // @TODO: Not this
        $view->headScript()->prependFile($config['jquery_path']);
    }
    
    protected function getView($app)
    {
        if ($this->view) {
            return $this->view;
        }

        $di     = $app->getLocator();
        $view   = $di->get('view');
        $this->view = $view;
        return $view;
    }
}
