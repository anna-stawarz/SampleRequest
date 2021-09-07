<?php

declare(strict_types=1);

namespace Infiright\SampleRequest\Api;

use Infiright\SampleRequest\Api\Data\SampleRequestInterface;
use Magento\Framework\Exception\NoSuchEntityException;

interface SampleRequestRepositoryInterface
{
    /**
     * @throws NoSuchEntityException
     */
    public function getById(int $id): SampleRequestInterface;
}
