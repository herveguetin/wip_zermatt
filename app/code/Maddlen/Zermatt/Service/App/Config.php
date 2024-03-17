<?php
/**
 * @author Hervé Guétin <www.linkedin.com/in/herveguetin>
 */

namespace Maddlen\Zermatt\Service\App;

use Magento\Framework\Escaper;
use Magento\Framework\Locale\Resolver;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Framework\View\Element\Text;
use Magento\Framework\View\Element\TextFactory;

class Config implements ArgumentInterface
{
    private Text $emptyBlock;

    public function __construct(
        protected readonly UrlInterface $url,
        protected readonly TextFactory  $blockFactory,
        protected readonly Resolver     $locale,
        protected readonly Escaper      $escaper
    )
    {
        $this->emptyBlock = $this->blockFactory->create();
    }

    public function get(): array
    {
        $config = $this->_get();
        array_walk($config, fn(&$value) => $value = is_string($value) ? $this->escaper->escapeJs($value) : $value);
        return $config;

    }

    private function _get(): array
    {
        return [
            'locale' => $this->locale->getLocale(),
            'baseUrl' => $this->url->getUrl('/'),
            'viewUrl' => $this->emptyBlock->getViewFileUrl('/'),
            'translationUrl' => $this->emptyBlock->getViewFileUrl('/js-translation.json'),
        ];
    }
}
