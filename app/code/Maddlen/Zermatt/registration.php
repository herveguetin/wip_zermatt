<?php
/**
 * @author Hervé Guétin <www.linkedin.com/in/herveguetin>
 */

use Maddlen\Zermatt\Component\Component;
use Maddlen\Zermatt\Service\App\Variable;
use Magento\Framework\Component\ComponentRegistrar;

ComponentRegistrar::register(ComponentRegistrar::MODULE, 'Maddlen_Zermatt', __DIR__);

if (!function_exists('zermatt_variable')) {
    function zermatt_variable(string $name, mixed $value)
    {
        Variable::set($name, $value);
    }
}

if (!function_exists('zermatt_component')) {
    function zermatt_component(string $template, mixed $props = [])
    {
        return Component::add($template, $props);
    }
}
