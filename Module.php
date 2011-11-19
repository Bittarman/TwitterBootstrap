<?php

namespace TwitterBootstrap;

use Zend\Module\Manager,
    Zend\EventManager\StaticEventManager,
    Zend\Module\Consumer\AutoloaderProvider;

class Module implements AutoloaderProvider
{
    protected $view;
    protected $viewListener;

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
        return include __DIR__ . '/configs/module.config.php';        
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
            // Merge plugin config with base theme config
            $plugins = array_merge_recursive(
                $config['layouts'][$config['theme']]['plugins'],
                $plugins
            );
        }
        $loadScript = '';
        foreach ($plugins as $plugin => $pluginOptions) {
            $view->plugin('headScript')->appendFile($config['pluginPaths'][$plugin]);
            $plugin = $this->loadPlugin($plugin, $pluginOptions);
            $loadScript .= $plugin . "\n";
        }
        if (strlen($loadScript) > 1) {
            $view->plugin('headScript')->prependFile($config['jqueryPath']);
            $view->plugin('headScript')->appendScript(printf('$(function(){%s})', $loadScript));
        }

        $view->plugin('headLink')->appendStylesheet($cssPath);
    }

    public function loadPlugin($plugin, $pluginOptions)
    {
        $pluginName = 'TwitterBootstrap\\Plugin\\' . ucfirst($plugin);
        return new $pluginName($pluginOptions);
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
