<?php return new Zend\Config\Config(
    array(
        'plugins' => array(
            'modal'   => array(),
            'buttons' => array(),
        ),
        'cssPath'     => 'http://twitter.github.com/bootstrap/1.4.0/bootstrap.min.css',    
        'pluginPaths' => array(
            'modal'     => 'http://twitter.github.com/bootstrap/1.4.0/bootstrap-modal.js',
            'dropdown'  => 'http://twitter.github.com/bootstrap/1.4.0/bootstrap-dropdown.js',
            'scrollspy' => 'http://twitter.github.com/bootstrap/1.4.0/bootstrap-scrollspy.js',
            'buttons'   => 'http://twitter.github.com/bootstrap/1.4.0/bootstrap-buttons.js',
            'tabs'      => 'http://twitter.github.com/bootstrap/1.4.0/bootstrap-tabs.js',
            'twipsy'    => 'http://twitter.github.com/bootstrap/1.4.0/bootstrap-twipsy.js',
            'popovers'  => 'http://twitter.github.com/bootstrap/1.4.0/bootstrap-popover.js',
            'alerts'    => 'http://twitter.github.com/bootstrap/1.4.0/bootstrap-alerts.js',
        ),
        'jqueryPath' => 'http://code.jquery.com/jquery-1.5.2.min.js',
        'layouts' => array(
            'hero' => array(
                'plugins'  => array(
                    'buttons' => array(
                        'elements' => '.btn'
                    ),
                    'dropdown' => array(
                        'elements' => '#nav'
                    )
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
        )

    )
);
