<?php

declare(strict_types=1);

namespace Infiright\SampleRequest\Block\LayoutProcessor\Form;

use Infiright\SampleRequest\Block\SampleRequest\LayoutProcessorInterface;
use Magento\ReCaptchaUi\Model\IsCaptchaEnabledInterface;
use Magento\ReCaptchaUi\Model\UiConfigResolverInterface;

class SampleRequestReCaptcha implements LayoutProcessorInterface
{
    private const RECAPTCHA_SAMPLE_REQUEST_KEY = 'sample_request_form';

    /**
     * @var UiConfigResolverInterface
     */
    private $captchaUiConfigResolver;

    /**
     * @var IsCaptchaEnabledInterface
     */
    private $isCaptchaEnabled;

    public function __construct(
        UiConfigResolverInterface $captchaUiConfigResolver,
        IsCaptchaEnabledInterface $isCaptchaEnabled
    ) {
        $this->captchaUiConfigResolver = $captchaUiConfigResolver;
        $this->isCaptchaEnabled = $isCaptchaEnabled;
    }

    public function process(array $jsLayout): array
    {
        if ($this->isCaptchaEnabled->isCaptchaEnabledFor(self::RECAPTCHA_SAMPLE_REQUEST_KEY)) {
            $jsLayout['components']['sample_request']['children']['steps_list']['children']['samples-step']['children']
            ['additional-re-captcha']['settings'] = $this->captchaUiConfigResolver->get(self::RECAPTCHA_SAMPLE_REQUEST_KEY);
        } else {
            if (isset($jsLayout['components']['sample_request']['children']['steps_list']['children']
                ['samples-step']['children']['additional-re-captcha'])) {
                unset($jsLayout['components']['sample_request']['children']['steps_list']['children']['samples-step']['children']
                    ['additional-re-captcha']);
            }
        }

        return $jsLayout;
    }
}
