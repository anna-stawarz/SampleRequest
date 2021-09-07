<?php

declare(strict_types=1);

namespace Infiright\SampleRequest\Registry;

use Infiright\SampleRequest\Api\Data\SampleRequestInterface;
use Infiright\SampleRequest\Api\Data\SampleRequestInterfaceFactory;

class CurrentSampleRequest
{
    /**
     * @var SampleRequestInterface
     */
    private $sampleRequest;

    /**
     * @var SampleRequestInterfaceFactory
     */
    private $sampleRequestFactory;

    public function __construct(
        SampleRequestInterfaceFactory $sampleRequestFactory
    ) {
        $this->sampleRequestFactory = $sampleRequestFactory;
    }

    public function set(SampleRequestInterface $sampleRequest)
    {
        $this->sampleRequest = $sampleRequest;
    }

    public function get(): SampleRequestInterface
    {
       return $this->sampleRequest ?? $this->createNullSampleRequest();
    }

    private function createNullSampleRequest(): SampleRequestInterface
    {
        return $this->sampleRequestFactory->create();
    }
}
