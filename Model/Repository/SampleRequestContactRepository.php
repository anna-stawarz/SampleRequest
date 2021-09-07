<?php

declare(strict_types=1);

namespace Infiright\SampleRequest\Model\Repository;

use Infiright\SampleRequest\Api\Data\SampleRequestContactInterface;
use Infiright\SampleRequest\Api\Data\SampleRequestContactInterfaceFactory;
use Infiright\SampleRequest\Api\SampleRequestContactRepositoryInterface;
use Infiright\SampleRequest\Model\ResourceModel\SampleRequestContact as SampleRequestContactResourceModel;
use Magento\Framework\Exception\NoSuchEntityException;

class SampleRequestContactRepository implements SampleRequestContactRepositoryInterface
{
    /**
     * @var SampleRequestContactInterface[]
     */
    private $instancesById = [];

    /**
     * @var SampleRequestContactResourceModel
     */
    private $resourceModel;

    /**
     * @var SampleRequestContactInterfaceFactory
     */
    private $modelFactory;

    public function __construct(
        SampleRequestContactResourceModel $resourceModel,
        SampleRequestContactInterfaceFactory $sampleRequestFactory
    ) {
        $this->resourceModel = $resourceModel;
        $this->modelFactory = $sampleRequestFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function getById(int $id): SampleRequestContactInterface
    {
        if (isset($this->instancesById[$id])) {
            return $this->instancesById[$id];
        }

        $sampleRequest = $this->modelFactory->create();
        $this->resourceModel->load($sampleRequest, $id);

        if (!$sampleRequest->getId()) {
            throw NoSuchEntityException::singleField(SampleRequestContactInterface::ID, $id);
        }

        $this->instancesById[$id] = $sampleRequest;

        return $this->instancesById[$id];
    }
}
