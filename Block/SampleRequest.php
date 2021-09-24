<?php

declare(strict_types=1);

namespace Infiright\SampleRequest\Block;

use Infiright\SampleRequest\Block\SampleRequest\LayoutProcessorInterface;
use Magento\Framework\Data\Form\FormKey;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Serialize\SerializerInterface;
use Magento\Framework\View\Element\Template;

class SampleRequest extends Template
{
    /**
     * @var FormKey
     */
    protected $formKey;

    /**
     * @var SerializerInterface
     */
    protected $serializer;

    /**
     * @var array
     */
    protected $jsLayout;

    /**
     * @var array|LayoutProcessorInterface[]
     */
    protected $layoutProcessors;

    public function __construct(
        Template\Context    $context,
        FormKey             $formKey,
        SerializerInterface $serializer,
        array               $layoutProcessors = [],
        array               $data = []
    ) {
        parent::__construct($context, $data);
        $this->formKey = $formKey;
        $this->serializer = $serializer;
        $this->jsLayout = isset($data['jsLayout']) && is_array($data['jsLayout']) ? $data['jsLayout'] : [];
        $this->layoutProcessors = $layoutProcessors;
    }

    /**
     * {@inheritdoc}
     */
    public function getJsLayout()
    {
        foreach ($this->layoutProcessors as $processor) {
            $this->jsLayout = $processor->process($this->jsLayout);
        }

        return $this->serializer->serialize($this->jsLayout);
    }

    /**
     * @throws LocalizedException
     */
    public function getFormKey(): string
    {
        return $this->formKey->getFormKey();
    }

    public function getSerializedSampleRequestConfig(): string
    {
        $config = [
            'sampleRequestUrl' => $this->getSampleRequestUrlPart(),
            'sampleRequestFormDataSavePath' => $this->getSampleRequestFormDataPath(),
        ];

        return $this->serializer->serialize($config);
    }

    protected function getSampleRequestUrlPart(): string
    {
        return 'sample-request';
    }

    protected function getSampleRequestFormDataPath(): string
    {
        return 'sample-request/index/saveData';
    }
}
