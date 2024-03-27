<?php
/**
 * @author Hervé Guétin <www.linkedin.com/in/herveguetin>
 */

namespace Maddlen\Zermatt\FormRules;

use Magento\Framework\Validator\ValidatorInterface;

interface FormRulesActionInterface
{
    /**
     * The validations to run against some
     * fields from the request payload.
     *
     * @see /vendor/magento/framework/Validator
     *
     * @return ValidatorInterface[]
     */
    public function rules(): array;
}
