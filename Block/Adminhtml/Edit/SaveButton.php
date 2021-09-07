<?php

declare(strict_types=1);

namespace Infiright\SampleRequest\Block\Adminhtml\Edit;

use Infiright\SampleRequest\Api\Data\SampleRequestInterface;
use Infiright\SampleRequest\Registry\CurrentSampleRequest;
use Magento\Backend\Model\UrlInterface;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class SaveButton implements ButtonProviderInterface
{
    /**
     * @var UrlInterface
     */
    protected $urlBuilder;

    /**
     * @var SampleRequestInterface
     */
    protected $sampleRequest;

    public function __construct(
        UrlInterface         $urlBuilder,
        CurrentSampleRequest $currentSampleRequest
    ) {
        $this->urlBuilder = $urlBuilder;
        $this->sampleRequest = $currentSampleRequest->get();
    }

    public function getSampleRequestId(): ?int
    {
        return $this->sampleRequest->getId();
    }

    public function getButtonData(): array
    {
        return [
            'label' => __('Save Sample Request'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => ['button' => ['event' => 'save']],
                'form-role' => 'save',
            ],
            'sort_order' => 90,
        ];
    }
}
