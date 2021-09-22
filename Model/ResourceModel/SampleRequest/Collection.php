<?php

declare(strict_types=1);

namespace Infiright\SampleRequest\Model\ResourceModel\SampleRequest;

use Infiright\SampleRequest\Model\SampleRequest;
use Infiright\SampleRequest\Model\ResourceModel\SampleRequest as SampleRequestResource;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct(): void
    {
        $this->_init(
            SampleRequest::class,
            SampleRequestResource::class
        );
    }
}
