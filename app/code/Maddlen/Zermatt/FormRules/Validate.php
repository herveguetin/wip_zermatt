<?php
/**
 * @author Hervé Guétin <www.linkedin.com/in/herveguetin>
 */

namespace Maddlen\Zermatt\FormRules;

use InvalidArgumentException;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Validator\ValidatorInterface;

class Validate
{
    private array $rules;
    private array $invalidParams = [];

    public function __construct(
        protected readonly RequestInterface $request
    )
    {
    }

    public function request(array $rules = []): void
    {
        $this->invalidParams = [];
        $this->rules = $rules;
        $requestParams = $this->request->isAjax() ? json_decode($this->request->getContent(), true) : $this->request->getParams();
        $paramsToValidate = array_filter($requestParams, fn($v, $param) => in_array($param, array_keys($rules)), ARRAY_FILTER_USE_BOTH);
        array_walk($paramsToValidate, function ($value, $param) {
            $this->validateParam($param, $value);
        });
    }

    private function validateParam($param, $value): void
    {
        array_walk($this->rules[$param], function ($validatorClass) use ($param, $value) {
            $validator = $this->getValidator($validatorClass);
            $isPrecognition = $this->request->getHeader('Precognition');
            $isValid = $validator->isValid($value);
            if (
                $isPrecognition && $value && !$isValid
                || !$isPrecognition && !$isValid
            ) {
                $messages = $validator->getMessages();
                $this->invalidParams[$param] = __(reset($messages))->render();
            }
        });
    }

    private function getValidator($validatorClass): ValidatorInterface
    {
        $validator = new $validatorClass();
        if (!$validator instanceof ValidatorInterface) {
            throw new InvalidArgumentException(
                'Rule class must implement \Laminas\Validator\ValidatorInterface'
            );
        }
        return $validator;
    }

    public function results(): array
    {
        if (!$this->pass()) {
            return [
                'message' => implode(' ', [
                    reset($this->invalidParams),
                    count($this->invalidParams) > 1 ? __('and %1 more errors', count($this->invalidParams)) : ''
                ]),
                'errors' => $this->invalidParams
            ];
        }

        return [];
    }

    public function pass(): bool
    {
        return !count($this->invalidParams);
    }
}
