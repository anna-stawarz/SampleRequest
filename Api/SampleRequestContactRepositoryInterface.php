<?php

declare(strict_types=1);

namespace Infiright\SampleRequest\Api;

use Infiright\SampleRequest\Api\Data\SampleRequestContactInterface;
use Magento\Framework\Exception\NoSuchEntityException;

interface SampleRequestContactRepositoryInterface
{
    /**
     * @throws NoSuchEntityException
     */
    public function getById(int $id): SampleRequestContactInterface;
}
