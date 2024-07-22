<?php
/**
 * @author Hervé Guétin <www.linkedin.com/in/herveguetin>
 */

namespace Sand\Box\Block;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class Price extends Template
{
    public function __construct(
        private ProductRepositoryInterface $productRepository,
        Context                            $context,
        array                              $data = []
    )
    {
        parent::__construct($context, $data);
    }

    public function getProduct(): ProductInterface
    {
        return $this->productRepository->getById(1);
    }
}
