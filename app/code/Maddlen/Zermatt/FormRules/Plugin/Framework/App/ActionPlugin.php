<?php
/**
 * @author Hervé Guétin <www.linkedin.com/in/herveguetin>
 */

namespace Maddlen\Zermatt\FormRules\Plugin\Framework\App;

use Maddlen\Zermatt\FormRules\FormRulesActionInterface;
use Maddlen\Zermatt\FormRules\PrecognitionResponse;
use Maddlen\Zermatt\FormRules\Validate;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\Request\Http;

class ActionPlugin
{
    public function __construct(
        protected readonly Validate             $validate,
        protected readonly Http                 $request,
        protected readonly PrecognitionResponse $precognitionResponse
    )
    {
    }

    public function beforeExecute(ActionInterface $action): array
    {
        if ($action instanceof FormRulesActionInterface) {
            $this->validate->request($action->rules());
            if (!$this->validate->pass() || $this->request->getHeader('Precognition')) {
                $this->precognitionResponse->send();
            }
        }

        return [];
    }
}
