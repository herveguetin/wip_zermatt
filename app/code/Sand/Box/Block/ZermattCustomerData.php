<?php
/**
 * @author Hervé Guétin <www.linkedin.com/in/herveguetin>
 */

namespace Sand\Box\Block;

use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Framework\View\Element\Context;

class ZermattCustomerData extends \Magento\Framework\View\Element\Text
{
    public function __construct(
        private CustomerRepositoryInterface $customerRepository,
        Context                             $context,
        array                               $data = []
    )
    {
        // Using __construct rather than data model for demo purposes
        parent::__construct($context, $data);
    }


    public function getText(): string
    {
        zermatt_variable('customerData', $this->customerData());
        return '';
    }

    private function customerData(): array
    {
        $customer = $this->customerRepository->get('john.doe@mail.com');
        return [
            'firstName' => $customer->getFirstname(),
            'lastName' => $customer->getLastname(),
        ];
    }
}
