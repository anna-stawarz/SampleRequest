<?php

declare(strict_types=1);

namespace Infiright\SampleRequest\Model\Repository;

use Infiright\SampleRequest\Api\Data\SampleRequestQuoteInterface;
use Infiright\SampleRequest\Api\Data\SampleRequestQuoteInterfaceFactory;
use Infiright\SampleRequest\Api\SampleRequestQuoteRepositoryInterface;
use Infiright\SampleRequest\Model\ResourceModel\SampleRequestQuote as SampleRequestQuoteResourceModel;
use Magento\Framework\Exception\NoSuchEntityException;

class SampleRequestQuoteRepository implements SampleRequestQuoteRepositoryInterface
{
    /**
     * @var SampleRequestQuoteInterface[]
     */
    private $instancesById = [];

    /**
     * @var SampleRequestQuoteResourceModel
     */
    private $resourceModel;

    /**
     * @var SampleRequestQuoteInterfaceFactory
     */
    private $modelFactory;

    public function __construct(
        SampleRequestQuoteResourceModel $resourceModel,
        SampleRequestQuoteInterfaceFactory $sampleRequestFactory
    ) {
        $this->resourceModel = $resourceModel;
        $this->modelFactory = $sampleRequestFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function getById(int $id): SampleRequestQuoteInterface
    {
        if (isset($this->instancesById[$id])) {
            return $this->instancesById[$id];
        }

        $sampleRequest = $this->modelFactory->create();
        $this->resourceModel->load($sampleRequest, $id);

        if (!$sampleRequest->getId()) {
            throw NoSuchEntityException::singleField(SampleRequestQuoteInterface::ID, $id);
        }

        $this->instancesById[$id] = $sampleRequest;

        return $this->instancesById[$id];
    }
}
