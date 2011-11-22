<?php
/**
 * TwitterBootstrap Configuration
 *
 * If you have a config/autoload/ directory set up for your project, you can 
 * drop this config file in it and change the values as you wish.
 */
$twitterBootstrapSettings = array(
    /**
     * Twitter Bootstrap Version
     */
    'version' => '1.4.0',

    /**
     * Twitter Bootstrap Theme
     *
     * Accepted values: 'container', 'fluid', or 'hero' 
     */
    'theme' => 'container',

    /**
     * Twitter Bootstrap Plugins
     */
    'plugins' => array(
    
    ),

    /**
     * End of EdpUser configuration
     */
);

/**
 * You do not need to edit below this line
 */
return array(
    'layout' => "layouts/{$twitterBootstrapSettings['theme']}.phtml",
    'twitterbootstrap' => array(
        // @TODO: Not this
        'jquery_path' => 'http://code.jquery.com/jquery-1.5.2.min.js',
        'theme' => $twitterBootstrapSettings['theme'],
        'themes' => array(
            'hero' => array(
                'plugins'  => array(
                    'buttons', 'dropdown',
                ),
            ),
            'container' => array(
                'plugins' => array(
                ),
            ),
            'fluid' => array(
                'plugins' => array(
                ),
            ),
        ),
        'plugins' => $twitterBootstrapSettings['plugins'],
        'css_path' => "http://twitter.github.com/bootstrap/{$twitterBootstrapSettings['version']}/bootstrap.min.css",
        'plugin_paths' => array(
            'modal'     => "http://twitter.github.com/bootstrap/{$twitterBootstrapSettings['version']}/bootstrap-modal.js",
            'dropdown'  => "http://twitter.github.com/bootstrap/{$twitterBootstrapSettings['version']}/bootstrap-dropdown.js",
            'scrollspy' => "http://twitter.github.com/bootstrap/{$twitterBootstrapSettings['version']}/bootstrap-scrollspy.js",
            'buttons'   => "http://twitter.github.com/bootstrap/{$twitterBootstrapSettings['version']}/bootstrap-buttons.js",
            'tabs'      => "http://twitter.github.com/bootstrap/{$twitterBootstrapSettings['version']}/bootstrap-tabs.js",
            'twipsy'    => "http://twitter.github.com/bootstrap/{$twitterBootstrapSettings['version']}/bootstrap-twipsy.js",
            'popovers'  => "http://twitter.github.com/bootstrap/{$twitterBootstrapSettings['version']}/bootstrap-popover.js",
            'alerts'    => "http://twitter.github.com/bootstrap/{$twitterBootstrapSettings['version']}/bootstrap-alerts.js",
        ),
    ),
);
