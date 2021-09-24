<?php

declare(strict_types=1);

namespace Infiright\SampleRequest\Observer;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\RequestContentInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Exception\InputException;
use Magento\ReCaptchaCustomer\Model\AjaxLogin\ErrorProcessor;
use Magento\ReCaptchaUi\Model\CaptchaResponseResolverInterface;
use Magento\ReCaptchaUi\Model\IsCaptchaEnabledInterface;
use Magento\ReCaptchaUi\Model\ValidationConfigResolverInterface;
use Magento\ReCaptchaValidationApi\Api\ValidatorInterface;
use Psr\Log\LoggerInterface;

class ReCaptchaSaveSampleRequestForm implements ObserverInterface
{
    private const RECAPTCHA_SAMPLE_REQUEST_KEY = 'sample_request_form';

    /**
     * @var CaptchaResponseResolverInterface
     */
    private $captchaResponseResolver;

    /**
     * @var ValidationConfigResolverInterface
     */
    private $validationConfigResolver;

    /**
     * @var ValidatorInterface
     */
    private $captchaValidator;

    /**
     * @var IsCaptchaEnabledInterface
     */
    private $isCaptchaEnabled;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var ErrorProcessor
     */
    private $errorProcessor;

    /**
     * @var RequestContentInterface
     */
    private $requestContent;

    public function __construct(
        CaptchaResponseResolverInterface $captchaResponseResolver,
        ValidationConfigResolverInterface $validationConfigResolver,
        ValidatorInterface $captchaValidator,
        IsCaptchaEnabledInterface $isCaptchaEnabled,
        LoggerInterface $logger,
        ErrorProcessor $errorProcessor,
        RequestContentInterface $requestContent
    ) {
        $this->captchaResponseResolver = $captchaResponseResolver;
        $this->validationConfigResolver = $validationConfigResolver;
        $this->captchaValidator = $captchaValidator;
        $this->isCaptchaEnabled = $isCaptchaEnabled;
        $this->logger = $logger;
        $this->errorProcessor = $errorProcessor;
        $this->requestContent = $requestContent;
    }

    public function execute(Observer $observer): void
    {
        if ($this->isCaptchaEnabled->isCaptchaEnabledFor(self::RECAPTCHA_SAMPLE_REQUEST_KEY)) {
            /** @var Action $controller */
            $controller = $observer->getControllerAction();
            $response = $controller->getResponse();
            $request = $this->requestContent;

            $validationConfig = $this->validationConfigResolver->get(self::RECAPTCHA_SAMPLE_REQUEST_KEY);

            try {
                $reCaptchaResponse = $this->captchaResponseResolver->resolve($request);
            } catch (InputException $e) {
                $this->logger->error($e);
                $this->errorProcessor->processError(
                    $response,
                    [],
                    self::RECAPTCHA_SAMPLE_REQUEST_KEY
                );

                return;
            }

            $validationResult = $this->captchaValidator->isValid($reCaptchaResponse, $validationConfig);
            if (false === $validationResult->isValid()) {
                $this->errorProcessor->processError(
                    $response,
                    $validationResult->getErrors(),
                    self::RECAPTCHA_SAMPLE_REQUEST_KEY
                );
            }
        }
    }
}
