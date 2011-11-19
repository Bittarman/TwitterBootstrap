<?php

namespace TwitterBootstrap\Plugin;

/**
 *
 * @package    TwitterBootstrap
 * @subpackage Plugins
 * @author     Ryan Mauger
 * @copyright  Ryan Mauger 2011
 */
class Buttons
{
    protected $elements;

    public function __construct(array $options)
    {
        if (isset($options['elements'])) {
            $this->elements = $options['elements'];
        }
    }

    public function __toString()
    {
        if (!$this->elements) {
            return '';
        }
        return "$('{$this->elements}').button()";
    }
}
