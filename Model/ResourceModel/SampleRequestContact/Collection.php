<?php

namespace Infiright\SampleRequest\Model\ResourceModel\SampleRequestContact;

use Infiright\SampleRequest\Model\SampleRequestContact;
use Infiright\SampleRequest\Model\ResourceModel\SampleRequestContact as SampleRequestContactResource;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct(): void
    {
        $this->_init(
            SampleRequestContact::class,
            SampleRequestContactResource::class
        );
    }
}
