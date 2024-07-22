<?php
/**
 * @author Hervé Guétin <www.linkedin.com/in/herveguetin>
 */

namespace Sand\Box\Block;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\View\Element\Template;

class Product extends \Magento\Framework\View\Element\Template
{
    public function __construct(
        // Not using view model for demo purposes
        private \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \Magento\Framework\View\Element\Template\Context        $context,
        array                                                   $data = []
    )
    {
        parent::__construct($context, $data);
    }

    public function getProduct(): \Magento\Catalog\Api\Data\ProductInterface
    {
        return $this->productRepository->getById(1);
    }
}
