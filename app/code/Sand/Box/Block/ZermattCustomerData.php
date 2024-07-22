<?php
/**
 * @author Hervé Guétin <www.linkedin.com/in/herveguetin>
 */

namespace Sand\Box\Block;

use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Framework\Data\Collection;
use Magento\Framework\DataObject;
use Magento\Framework\View\Element\Context;

class ZermattCustomerData extends \Magento\Framework\View\Element\Text
{
    public function __construct(
        private CustomerRepositoryInterface $customerRepository,
        private \Magento\Customer\Model\ResourceModel\Customer\Collection $customerCollection,
        Context                             $context,
        array                               $data = []
    )
    {
        // Using __construct rather than data model for demo purposes
        parent::__construct($context, $data);
    }


    public function getText(): string
    {
        //$customer = $this->customerRepository->get('john.doe@mail.com');
        //$customer = new DataObject(["name" => "John Doe", "email" => "john.doe@mail.com"]);
        //$customers = $this->customerCollection->load();
        $customers = $this->customerRepository->getList(new \Magento\Framework\Api\SearchCriteria());
        //$customer = ['name' => 'John Doe', 'email' => 'john.doe@mail.com'];
        zermatt_variable('customerData', $customers);
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
