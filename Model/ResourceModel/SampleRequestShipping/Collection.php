<?php

namespace Infiright\SampleRequest\Model\ResourceModel\SampleRequestShipping;

use Infiright\SampleRequest\Model\SampleRequestShipping;
use Infiright\SampleRequest\Model\ResourceModel\SampleRequestShipping as SampleRequestShippingResource;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct(): void
    {
        $this->_init(
            SampleRequestShipping::class,
            SampleRequestShippingResource::class
        );
    }
}
