<?php

namespace Infiright\SampleRequest\Model\ResourceModel\SampleRequestQuote;

use Infiright\SampleRequest\Model\SampleRequestQuote;
use Infiright\SampleRequest\Model\ResourceModel\SampleRequestQuote as SampleRequestQuoteResource;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct(): void
    {
        $this->_init(
            SampleRequestQuote::class,
            SampleRequestQuoteResource::class
        );
    }
}
