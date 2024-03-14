<?php
/**
 * @author Hervé Guétin <www.linkedin.com/in/herveguetin>
 */

namespace Maddlen\Zermatt\Service;

use Magento\Framework\View\Asset\File;
use Magento\Framework\View\Asset\Repository;

class App
{
    const DIST_DIR = 'zermatt' . DIRECTORY_SEPARATOR . 'dist' . DIRECTORY_SEPARATOR;
    private array $manifestData;
    private File $manifest;

    public function __construct(
        protected readonly Repository $assetRepo
    )
    {
    }

    public function filepath(): string
    {
        $this->manifest = $this->assetRepo->createAsset('Maddlen_Zermatt::' . self::DIST_DIR . '/.vite/manifest.json');
        $this->manifestData = json_decode($this->manifest->getContent(), true);
        return self::DIST_DIR . $this->manifestData['index.html']['file'];
    }
}
