<?php
/**
 * @author Hervé Guétin <www.linkedin.com/in/herveguetin>
 */

namespace Maddlen\Zermatt\Plugin\Framework\View\Asset;

use Maddlen\Zermatt\App\App;
use Magento\Framework\View\Asset\File;

class FilePlugin
{
    public function __construct(
        protected readonly App $app
    )
    {
    }

    /**
     * @param File $subject
     * @param $result
     */
    public function afterGetPath(File $subject, $result)
    {
        if (str_contains($result, 'Maddlen_Zermatt/index.js')) {
            $result = str_replace('index.js', $this->app->entryFilepath(), $result);
            $result = str_replace('Maddlen_Zermatt/', '', $result);
        }
        return $result;
    }
}
