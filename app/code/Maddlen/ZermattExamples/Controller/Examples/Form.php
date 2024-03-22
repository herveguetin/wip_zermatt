<?php
/**
 * @author Hervé Guétin <www.linkedin.com/in/herveguetin>
 */

namespace Maddlen\ZermattExamples\Controller\Examples;

use Maddlen\Zermatt\FormRules\FormRulesActionInterface;
use Maddlen\Zermatt\FormRules\Validate;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\UrlInterface;
use Magento\Framework\Validator\EmailAddress;
use Magento\Framework\Validator\NotEmpty;

class Form implements FormRulesActionInterface, HttpPostActionInterface
{
    public function __construct(
        protected readonly ResultFactory    $resultFactory,
        protected readonly Validate         $validate,
        protected readonly ManagerInterface $messageManager,
        protected readonly RequestInterface $request,
        protected readonly UrlInterface     $url
    )
    {
    }


    public function execute()
    {
        if ($this->validate->pass()) {
            $this->messageManager->addSuccessMessage(__('Form is valid.'));
        } else {
            $this->messageManager->addErrorMessage(__('Form is invalid.'));
        }
        return $this->resultFactory->create(ResultFactory::TYPE_JSON)
            ->setData(['redirect' => $this->url->getUrl('zermatt/examples')]);
    }

    public function rules(): array
    {
        return [
            'name' => [NotEmpty::class],
            'email' => [NotEmpty::class, EmailAddress::class]
        ];
    }
}
