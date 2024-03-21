<?php
/**
 * @author Hervé Guétin <www.linkedin.com/in/herveguetin>
 */

namespace Maddlen\Zermatt\App;

use Magento\Framework\Component\ComponentRegistrarInterface as ComponentRegistrar;
use Magento\Framework\View\Asset\Repository;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class App implements ArgumentInterface
{
    const DIST_DIR = 'zermatt/dist/';

    public function __construct(
        protected readonly Repository         $assetRepo,
        protected readonly ComponentRegistrar $componentRegistrar
    )
    {
    }

    public function sourceDir(): string
    {
        return $this->componentRegistrar->getPath('module', 'Maddlen_Zermatt') . '/view/frontend/web/zermatt';
    }

    public function entryFilepath(): string
    {
        $manifest = $this->assetRepo->createAsset(self::DIST_DIR . '.vite/manifest.json');
        $manifestData = json_decode($manifest->getContent(), true);
        return self::DIST_DIR . $manifestData['index.html']['file'];
    }
}
