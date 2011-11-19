Twitter Bootstrap module for Zend Framework 2
=============================================

This module will allow you to add the JS and CSS for Twitter bootstrap from configuration.

Enabling plugins
----------------
in configs/module.config.php add single entries to the 'plugins' array. For example:
    
        <?php return new Zend\Config\Config(
            array(
              'theme'   => 'container',
              'layout'  => 'layouts/container.phtml',
              'plugins' => array(
                  'dropdown','scrollspy','modal'
              ),
    
to enable the dropdown, scrollspy and modal plugins.
To change the js location for plugins to not use the github CDN, change the relevant entry in pluginPaths.

Layouts
-------
To switch a layout, change the 'theme' and 'layout' entries in the configs/module.config.php.
For example:
    <pre>
        <?php return new Zend\Config\Config(
            array(
                    'theme'   => 'container',
                    'layout'  => 'layouts/container.phtml',
    </pre>
Enables the Container layout, and;
    <pre>
    <?php return new Zend\Config\Config(
        array(
                'theme'   => 'fluid',
                'layout'  => 'layouts/fluid.phtml',
    </pre>
Enables the Fluid layout.
Examples of the layouts:
  [http://twitter.github.com/bootstrap/examples/hero.html] Hero: http://twitter.github.com/bootstrap/examples/hero.html
  [http://twitter.github.com/bootstrap/examples/fluid.html] Fluid: http://twitter.github.com/bootstrap/examples/fluid.html
  [http://twitter.github.com/bootstrap/examples/container-app.html] Container: http://twitter.github.com/bootstrap/examples/container-app.html
                   
