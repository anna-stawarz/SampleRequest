<?php

declare(strict_types=1);

namespace Infiright\SampleRequest\Model\Service;

use Infiright\SampleRequest\Api\Data\SampleRequestInterface;
use Infiright\SampleRequest\Api\RequestData\SampleRequestDataInterface;

interface SampleRequestManagerInterface
{
    /**
     * @throws \Exception
     */
    public function saveSampleRequest(SampleRequestDataInterface $sampleRequestData): SampleRequestInterface;
}
