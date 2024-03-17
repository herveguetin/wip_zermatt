<?php
/**
 * @author Hervé Guétin <www.linkedin.com/in/herveguetin>
 */

namespace Maddlen\Zermatt\Component;

class Component
{
    const PLACEHOLDER = 'zermatt_component:';
    protected static array $components = [];

    public static function add(string $template, mixed $props): string
    {
        $id = self::PLACEHOLDER . uniqid();
        static::$components[$id] = [
            'id' => $id,
            'template' => $template,
            'props' => $props
        ];

        echo $id;
        return $id;
    }

    public static function all(): array
    {
        return static::$components;
    }
}
