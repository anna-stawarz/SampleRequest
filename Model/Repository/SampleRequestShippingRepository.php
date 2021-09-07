<?php

declare(strict_types=1);

namespace Infiright\SampleRequest\Model\Repository;

use Infiright\SampleRequest\Api\Data\SampleRequestShippingInterface;
use Infiright\SampleRequest\Api\Data\SampleRequestShippingInterfaceFactory;
use Infiright\SampleRequest\Api\SampleRequestShippingRepositoryInterface;
use Infiright\SampleRequest\Model\ResourceModel\SampleRequestShipping as SampleRequestShippingResourceModel;
use Magento\Framework\Exception\NoSuchEntityException;

class SampleRequestShippingRepository implements SampleRequestShippingRepositoryInterface
{
    /**
     * @var SampleRequestShippingInterface[]
     */
    private $instancesById = [];

    /**
     * @var SampleRequestShippingResourceModel
     */
    private $resourceModel;

    /**
     * @var SampleRequestShippingInterfaceFactory
     */
    private $modelFactory;

    public function __construct(
        SampleRequestShippingResourceModel    $resourceModel,
        SampleRequestShippingInterfaceFactory $sampleRequestFactory
    ) {
        $this->resourceModel = $resourceModel;
        $this->modelFactory = $sampleRequestFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function getById(int $id): SampleRequestShippingInterface
    {
        if (isset($this->instancesById[$id])) {
            return $this->instancesById[$id];
        }

        $sampleRequest = $this->modelFactory->create();
        $this->resourceModel->load($sampleRequest, $id);

        if (!$sampleRequest->getId()) {
            throw NoSuchEntityException::singleField(SampleRequestShippingInterface::ID, $id);
        }

        $this->instancesById[$id] = $sampleRequest;

        return $this->instancesById[$id];
    }
}
