<?php

declare(strict_types=1);

namespace Infiright\SampleRequest\Api\RequestData;

use Infiright\SampleRequest\Api\Data\SampleRequestContactInterface;
use Infiright\SampleRequest\Api\Data\SampleRequestInterface;
use Infiright\SampleRequest\Api\Data\SampleRequestQuoteInterface;
use Infiright\SampleRequest\Api\Data\SampleRequestQuoteItemInterface;
use Infiright\SampleRequest\Api\Data\SampleRequestShippingInterface;

interface SampleRequestDataInterface
{
    public function getContact(): SampleRequestContactInterface;

    public function getShipping(): SampleRequestShippingInterface;

    public function getQuote(): SampleRequestQuoteInterface;

    /**
     * @return SampleRequestQuoteItemInterface[]
     */
    public function getQuoteItems(): array;

    public function getSampleRequest(): SampleRequestInterface;
}
