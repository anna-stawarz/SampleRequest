<?php

declare(strict_types=1);

namespace Infiright\SampleRequest\Model\Repository;

use Infiright\SampleRequest\Api\Data\SampleRequestInterface;
use Infiright\SampleRequest\Api\Data\SampleRequestInterfaceFactory;
use Infiright\SampleRequest\Api\SampleRequestRepositoryInterface;
use Infiright\SampleRequest\Model\ResourceModel\SampleRequest as SampleRequestResourceModel;
use Magento\Framework\Exception\NoSuchEntityException;

class SampleRequestRepository implements SampleRequestRepositoryInterface
{
    /**
     * @var SampleRequestInterface[]
     */
    private $instancesById = [];

    /**
     * @var SampleRequestResourceModel
     */
    private $resourceModel;

    /**
     * @var SampleRequestInterfaceFactory
     */
    private $modelFactory;

    public function __construct(
        SampleRequestResourceModel $resourceModel,
        SampleRequestInterfaceFactory $sampleRequestFactory
    ) {
        $this->resourceModel = $resourceModel;
        $this->modelFactory = $sampleRequestFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function getById(int $id): SampleRequestInterface
    {
        if (isset($this->instancesById[$id])) {
            return $this->instancesById[$id];
        }

        $sampleRequest = $this->modelFactory->create();
        $this->resourceModel->load($sampleRequest, $id);

        if (!$sampleRequest->getId()) {
            throw NoSuchEntityException::singleField(SampleRequestInterface::ID, $id);
        }

        $this->instancesById[$id] = $sampleRequest;

        return $this->instancesById[$id];
    }
}
