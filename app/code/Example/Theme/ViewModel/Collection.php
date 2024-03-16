<?php
/**
 * @author Hervé Guétin <www.linkedin.com/in/herveguetin>
 */

namespace Example\Theme\ViewModel;

use Magento\Catalog\Api\ProductAttributeRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class Collection implements ArgumentInterface
{
    public function __construct(
        protected readonly ProductAttributeRepositoryInterface $productAttributeRepository,
        protected readonly SearchCriteriaBuilder               $searchCriteriaBuilder
    )
    {
    }

    public function getCollection()
    {
        $attributes = $this->productAttributeRepository->getList($this->searchCriteriaBuilder->create());
        return array_map(function ($attribute) {
            return [
                'attribute_code' => $attribute->getAttributeCode(),
                'label' => $attribute->getFrontend()->getLabel(),
            ];
        }, $attributes->getItems());
    }

}
