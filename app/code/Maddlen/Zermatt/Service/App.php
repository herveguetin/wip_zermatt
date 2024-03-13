<?php
/**
 * @author Hervé Guétin <www.linkedin.com/in/herveguetin>
 */

namespace Maddlen\Zermatt\Service;

use Magento\Framework\View\Asset\File;
use Magento\Framework\View\Asset\Repository;

class App
{
    private array $manifestData;
    private File $manifest;

    public function __construct(
        protected readonly Repository $assetRepo
    )
    {
    }

    public function filepath(): string
    {
        $this->manifest = $this->assetRepo->createAsset('Maddlen_Zermatt::dist/.vite/manifest.json');
        $this->manifestData = json_decode($this->manifest->getContent(), true);
        return 'dist' . DIRECTORY_SEPARATOR . $this->manifestData['index.html']['file'];
    }
}
