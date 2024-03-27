<?php
/**
 * @author Hervé Guétin <www.linkedin.com/in/herveguetin>
 */

namespace Maddlen\Zermatt\Controller\FormRules;

use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\CsrfAwareActionInterface;
use Magento\Framework\App\Request\InvalidRequestException;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;

class FormKey implements HttpPostActionInterface, CsrfAwareActionInterface
{
    public function __construct(
        protected readonly ResultFactory                        $resultFactory,
        protected readonly \Magento\Framework\Data\Form\FormKey $formKey
    )
    {
    }

    public function execute(): ResultInterface
    {
        $result = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $result->setData(['form_key' => $this->formKey->getFormKey()]);
        return $result;
    }

    public function createCsrfValidationException(RequestInterface $request): ?InvalidRequestException
    {
        return null;
    }

    public function validateForCsrf(RequestInterface $request): ?bool
    {
        return true; // This route requests the form key... so we must leave it opened.
    }
}
