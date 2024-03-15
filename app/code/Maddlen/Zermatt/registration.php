<?php
/**
 * @author Hervé Guétin <www.linkedin.com/in/herveguetin>
 */

use Maddlen\Zermatt\Service\App\Variable;
use Magento\Framework\Component\ComponentRegistrar;

ComponentRegistrar::register(ComponentRegistrar::MODULE, 'Maddlen_Zermatt', __DIR__);

if (!function_exists('zermatt_variable')) {
    function zermatt_variable(string $name, mixed $value)
    {
        Variable::set($name, $value);
    }
}
