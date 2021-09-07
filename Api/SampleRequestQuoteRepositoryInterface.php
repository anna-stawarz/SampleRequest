<?php

declare(strict_types=1);

namespace Infiright\SampleRequest\Api;

use Infiright\SampleRequest\Api\Data\SampleRequestQuoteInterface;
use Magento\Framework\Exception\NoSuchEntityException;

interface SampleRequestQuoteRepositoryInterface
{
    /**
     * @throws NoSuchEntityException
     */
    public function getById(int $id): SampleRequestQuoteInterface;
}
