<?php

declare(strict_types=1);

namespace Infiright\SampleRequest\Model\Captcha;

use Magento\Framework\App\RequestContentInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Exception\InputException;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\ReCaptchaUi\Model\CaptchaResponseResolverInterface;

class CaptchaResponseResolver implements CaptchaResponseResolverInterface
{
    /**
     * @var Json
     */
    private $jsonSerializer;

    public function __construct(
        Json $jsonSerializer
    ) {
        $this->jsonSerializer = $jsonSerializer;
    }

    public function resolve(RequestInterface $request): string
    {
        $reCaptchaParam = '';

        if ($request instanceof RequestContentInterface) {
            $content = $request->getContent();
            $content = $this->jsonSerializer->unserialize($content);

            if (array_key_exists(self::PARAM_RECAPTCHA, $content)) {
                $reCaptchaParam = $content[self::PARAM_RECAPTCHA];
            }
        } else {
            $reCaptchaParam = $request->getParam(self::PARAM_RECAPTCHA);
        }

        if (empty($reCaptchaParam)) {
            throw new InputException(__('Can not resolve reCAPTCHA parameter.'));
        }

        return $reCaptchaParam;
    }
}
