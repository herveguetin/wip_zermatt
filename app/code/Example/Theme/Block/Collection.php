<?php
/**
 * @author Hervé Guétin <www.linkedin.com/in/herveguetin>
 */

namespace Example\Theme\Block;

use Magento\Framework\View\Element\Template;

class Collection extends Template
{
    public function getCollection()
    {
        /** @var \Example\Theme\ViewModel\Collection $viewModel */
        $viewModel = $this->getData('view_model');
        return $viewModel->getCollection();
    }
}
