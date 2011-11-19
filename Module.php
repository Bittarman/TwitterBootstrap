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
            $this->config = include __DIR__ . '/configs/module.config.php';
        }
        return $this->config;
    }

    public function initializeView($e)
    {
        $app    = $e->getParam('application');
        $view   = $this->getView($app);
        $config = $this->getConfig();
        if (isset($config['cssPath'])) {
            $cssPath = $config['cssPath']; 
        }
        $plugins = isset($config['plugins']) ? $config['plugins'] : array();
        if (isset($config['theme'])) {
            if (isset($config['layouts'][$config['theme']]['plugins'])){
                // Merge plugin config with base theme config
                $themePlugins = $config['layouts'][$config['theme']]['plugins'];
                $plugins = $themePlugins->merge($plugins);
            }
            $view->resolver()->addPath(__DIR__ . '/views/'.$config['theme']);
        }
        foreach ($plugins as $plugin) {
            $view->plugin('headScript')->appendFile($config['pluginPaths'][$plugin]);
        }
        $view->plugin('headScript')->prependFile($config['jqueryPath']);
        $view->plugin('headLink')->appendStylesheet($cssPath);
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
