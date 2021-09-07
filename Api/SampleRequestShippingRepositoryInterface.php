<?php

declare(strict_types=1);

namespace Infiright\SampleRequest\Api;

use Infiright\SampleRequest\Api\Data\SampleRequestShippingInterface;
use Magento\Framework\Exception\NoSuchEntityException;

interface SampleRequestShippingRepositoryInterface
{
    /**
     * @throws NoSuchEntityException
     */
    public function getById(int $id): SampleRequestShippingInterface;
}
